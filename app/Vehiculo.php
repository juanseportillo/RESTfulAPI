<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model{

	protected $table = 'vehiculos';
	protected $primarykEY = 'serie';
	protected $fillable = array('color', 'clindraje', 'potencia', 'peso');

}