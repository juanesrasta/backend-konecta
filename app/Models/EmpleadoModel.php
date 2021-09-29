<?php

namespace App\Models;
use CodeIgniter\Model;

class EmpleadoModel extends Model{
	
	protected $table = 'empleado';
	protected $primarKey = 'id';
	protected $returnType = 'array';
	
	protected $allowedFields = [
		'fecha_ingreso',
		'nombre',
		'salario'
	];
	
}

?>