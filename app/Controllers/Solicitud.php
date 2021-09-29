<?php 
namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\SolicitudModel;
use CodeIgniter\Controller;

header('Access-Control-Allow-Origin: *'); 
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept"); 
		header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE'); 

class Solicitud extends Controller{
		
		use ResponseTrait;
		protected $solicitud;
		private $db;

	public function __construct(){
		$this->db = db_connect();
		$this->solicitud = new SolicitudModel();
	}
		
	// Lista de Solicitudes
    public function index(){
		
		$sql = $this->db->table("solicitud as so");
		$sql->select('so.id,
			so.codigo,
			so.descripcion,
			so.resumen,
			em.nombre,
            em.id as id_emp');
		$sql->join('empleado as em', 'em.id = so.id_empleado');
		
		$data['solicitudes'] = $sql->get()->getResult();

		return $this->respond($data['solicitudes']);
	  
    }
	
	// Registrar Solicitudes
    public function create() {
        
		$request = json_decode(file_get_contents("php://input"));

		$data = [
			'codigo' => $request->codigo,
            'descripcion'  => $request->descripcion,
            'resumen'  => $request->resumen,
            'id_empleado'  => $request->id_emp,
        ];

		if($this->solicitud->insert($data)){
			$response = [
				'messages' => [
					'success' => 'Se registro una nueva solicitud'
				]
			];
		}else{
			$response = [
				'messages' => [
					'success' => 'Error registrando una nueva Solicitud'
				]
			];
		}
	  
		return $this->respondCreated($response);
		
    }
	
}

?>