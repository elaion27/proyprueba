<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>

<body>

	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

	<table class="table">
	<thead>	
		<th>Codigo</th>
		<th>Razon social</th>
		<th>Nombre Comercial</th>
	</thead>
	@foreach($clientes as $cliente)
	<tbody>
		<td>{{$cliente->COD_CLIENT}}</td>
		<td>{{$cliente->RAZON_SOCI}}</td>
		<td>{{$cliente->NOM_COM}}</td>
	</tbody>
	@endforeach


	</table>

	

	
	
</body>


</html>