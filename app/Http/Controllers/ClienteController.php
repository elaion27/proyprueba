<?php
namespace App\Http\Controllers;

//use App\Http\Middleware\find;


use Mockery as M;
use App\Http\Requests;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;

use App\User;
use App\Cliente;
use Session;
use Redirect;
use Illuminate\Routing\Route;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Container\ContextualBindingBuilder;

use NotificationChannels\SMSC\SMSCChannel;
use NotificationChannels\SMSC\SMSCMessage;
use Illuminate\Contracts\Events\Dispatcher;
use NotificationChannels\SMSC\SMSCMessageInterface;
use NotificationChannels\SMSC\Clients\SMSCClientInterface;
use NotificationChannels\SMSC\Clients\SMSCApiResponseInterface;
use NotificationChannels\SMSC\Exceptions\CouldNotSendNotification;
use NotificationChannels\SMSC\SMSCServiceProvider;

class ClienteController extends Controller
{

    private $message;
    private $client;
    private $channel;
    private $apiResponse;
    private $eventDispatcher;
	private $provider ;
	private $app;
	private $contextualBindingBuilder;

    public function listar()
    {
  	    $this->app = M::mock(Application::class);
  	    $this->contextualBindingBuilder = M::mock(ContextualBindingBuilder::class);

		$this->app->shouldReceive('when')
                  ->once()
                  ->andReturn($this->contextualBindingBuilder);
        $this->contextualBindingBuilder->shouldReceive('needs')
                                       ->once()
                                       ->andReturn($this->contextualBindingBuilder);
        $this->contextualBindingBuilder->shouldReceive('give')
                                       ->once();



    	//$provider = new SMSCServiceProvider($this->app) ;
    	

    	//$this->client = $provider->boot();

        $this->client = M::mock(SMSCClientInterface::class);
        $this->eventDispatcher = M::mock(Dispatcher::class);
        $this->channel = new SMSCChannel($this->client, $this->eventDispatcher);
        $this->message = M::mock(SMSCMessageInterface::class);
        $this->apiResponse = M::mock(SMSCApiResponseInterface::class);

      // {!!Auth::user()->name!!}  para la vista


    	//return "Estoy en el index";
      	//$users = User::All();
      	$clientes = Cliente::paginate(2);        	
        //$clientes = Cliente::All();



   $this->client->shouldReceive('addToRequest')
                     ->once();
        $this->client->shouldReceive('sendRequest')
                     ->once()
                     ->andReturn($this->apiResponse);
        $this->eventDispatcher->shouldReceive('fire')
                              ->twice();


      	///$dev = new SMSCMessage("Test notification", "+543795019291");	
      	//$this->channel->send(new TestNotifiable(), new TestNotificationWithTooLongContent());
      	$this->channel->send(new TestNotifiable(), new TestNotification());

      	//$dev2 = $dev->toArray();
        return view('index',compact('clientes'));
        //return view('index')->with('dev2',implode(" ",$dev2));


    }

}

class TestNotifiable
{
    public function routeNotificationFor()
    {
        return '+543795019291';
    }
}

class TestNotification extends Notification
{
    public function toSMSC()
    {
        return new SMSCMessage('hello', '+543795019291');
    }
}

class TestNotificationWithString extends Notification
{
    public function toSMSC()
    {
        return 'hello';
    }
}
class TestNotificationWithTooLongContent extends Notification
{
    public function toSMSC()
    {
        return 'Esto es una prueba de sms ';
    }
}
