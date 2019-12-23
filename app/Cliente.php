<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['COD_CLIENT', 'RAZON_SOCI', 'NOM_COM'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

    protected $table = "GVA14";
    //protected $primaryKey = "id"
    public $timestamps = false ;  // created_at  y updated_at  en cada tabla
    
}
