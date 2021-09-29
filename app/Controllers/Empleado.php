<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\EmpleadoModel;
use CodeIgniter\Controller;

header('Access-Control-Allow-Origin: *'); 
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
		header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE'); 

class Empleado extends Controller{
		
		use ResponseTrait;
		protected $empleado;

	public function __construct(){
		
		$this->empleado = new EmpleadoModel();
	}
		
	// Lista de empleados
    public function index(){
		
		$data['empleados'] = $this->empleado->orderBy('id', 'ASC')->findAll();
		
		return $this->respond($data['empleados']);
	  
    }
	
	// Registrar empleado
    public function create() {
        
		$request = json_decode(file_get_contents("php://input"));
		
		$year = $request->fecha->year;
		$month = ($request->fecha->month < 10)? '0'.$request->fecha->month : $request->fecha->month;
		$day = ($request->fecha->day < 10)? '0'.$request->fecha->day : $request->fecha->day;
		
		$date = $year.'-'.$month.'-'.$day;
		
		$data = [
			'fecha_ingreso' => $date,
            'nombre'  => $request->nombre,
            'salario'  => $request->salario,
        ];

		if($this->empleado->insert($data)){
			$response = [
				'messages' => [
					'success' => 'Se registro un nuevo empleado'
				]
			];
		}else{
			$response = [
				'messages' => [
					'success' => 'Error registrando un nuevo empleado'
				]
			];
		}
	  
		return $this->respondCreated($response);
		
    }
	
}

?>