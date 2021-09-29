<?php

namespace App\Models;
use CodeIgniter\Model;

class solicitudModel extends Model{
	
	protected $table = 'solicitud';
	protected $primarKey = 'id';
	
	protected $allowedFields = [
		'codigo',
		'descripcion',
		'resumen',
		'id_empleado'
	];
	
}

?>