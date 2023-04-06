<?php 
	class Coordinadores extends Controller {
		private $coordinador;

		public function __construct() {
			$this->coordinador = $this->model('Coordinador');
		}

		// ************ BEGIN INDEX VIEW
		public function index() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Coordinador') {

				$sede = ($_SESSION['user_sede'] == 'Peru') ? 1 : 2;
				$usuarios = $this->coordinador->getAllUsers($sede);
				$roles = $this->coordinador->getRoles();
				$superv = $this->coordinador->getSupervSede($_SESSION['user_sede']);

				$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$data = [
					'usuarios' => $usuarios,
					'roles' => $roles,
					'superv' => $superv,
					'controller' => $controller,
					'pagename' => $method
				];

				$this->view('coordinador/index', $data);

			} else {
				$this->view('pages/login');
			}
		}
	  // ************ END INDEX VIEW
		//
		// *********** BEGIN EDIT USER
		public function edit_user() {

			if (isset($_POST['guardar'])) {

				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$user_id = $_POST['user_id'];
    		$rol_id = $_POST['rol_id'];
    		$sede_id = ($_SESSION['user_sede'] == 'Peru') ? 1 : 2;

    		$funcion = $_POST['funcion'];
    		$nombre = $_POST['nombre'];
    		$usuario = $_POST['usuario'];
    		$email = $_POST['email'];
    		$password = $_POST['password'];
    		$estado = $_POST['estado'];

      	$user_updated = $this->coordinador->updateUser($user_id,$rol_id,$sede_id,$funcion,$nombre,$usuario,$email,$password,$estado);

      	if ($user_updated) {
					redirect('coordinadores/edit_user');
      	}

			}

			if (isset($_POST['eliminar_user'])) {
				$user_id = $_POST['user_id'];

      	$user_deleted = $this->coordinador->deleteUser($user_id);

      	if ($user_deleted) {
					redirect('coordinadores/edit_user');
      	}

			}


				$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$sede = ($_SESSION['user_sede'] == 'Peru') ? 1 : 2;
				$usuarios = $this->coordinador->getAllUsers($sede);
				$roles = $this->coordinador->getRoles();

				$roles = array_diff_key($roles, [0,1]);

				$data = [
					'usuarios' => $usuarios,
					'roles' => $roles,
					'controller' => $controller,
					'pagename' => $method
				];
				
				$this->view('coordinador/edit_user', $data);
			
			
		}
		// *********** END EDIT USER
	  // 
    // ************ BEGIN EDITAR AREAS SUPERVISORES
		public function edit_revision() {
			// Editar Areas de Fondo
			if (isset($_POST['btn_fondo'])) {
      	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      		$sede = $_SESSION['user_sede'];
      		$tipo = $_POST['tipo_fondo'];

      		$area_1 = $_POST['area_fondo_1'];
      		$area_2 = $_POST['area_fondo_2'];

      	$this->coordinador->updateRevFondos($sede,$tipo,$area_1,$area_2);

      	redirect('coordinadores/edit_revision');
			}

			// Editar areas de Compra
			if (isset($_POST['btn_compra'])) {
      	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      		$sede = $_SESSION['user_sede'];
      		$tipo = $_POST['tipo_compra'];

      		$area_1 = $_POST['area_compra_1'];
      		$area_2 = $_POST['area_compra_2'];

      	$this->coordinador->updateRevCompras($sede,$tipo,$area_1,$area_2);

      	redirect('coordinadores/edit_revision');
			}

			$user = $_SESSION['user_usuario'];
			$sede = $_SESSION['user_sede'];

			$areas = $this->coordinador->getRevAreas($sede);
			$controller = strtolower(get_called_class());
			$method = ucwords(__FUNCTION__);

			$data = [
				'areas' => $areas,
				'controller' => $controller,
				'pagename' => $method
			];

			$this->view('coordinador/edit_revision', $data);
			
		}

	  // ************ END EDITAR AREAS SUPERVISORES
	  // 

		public function add_user() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    		$sede_id = $_POST['sede_id'];
    		$rol_id = $_POST['rol_id'];

    		$funcion = $_POST['funcion'];
    		$nombre = $_POST['nombre'];
    		$usuario = $_POST['usuario'];
    		$email = $_POST['email'];
    		$password = $_POST['password'];
    		$estado = $_POST['estado'];

      	$this->coordinador->addUser($rol_id,$sede_id,$funcion,$nombre,$usuario,$email,$password,$estado);

      	redirect('coordinadores/add_user');

			} else {

				$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$roles = $this->coordinador->getRoles();
				$roles = array_diff_key($roles, [0,1]);

				$data = [
					'roles' => $roles,
					'controller' => $controller,
					'pagename' => $method
				];

				$this->view('coordinador/add_user', $data);
			}
		}



    // ************ VISTAS SIDEBAR
    public function config_general() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Coordinador') { 
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
					  $user_id = $_POST['user_id'];
		    		$nombre = $_POST['nombre'];

		      	$this->coordinador->updateProfile($user_id,$nombre);

		      	redirect('coordinadores/config_general');

				} else {

					$id = $_SESSION['user_id'];
					$dataUser = $this->coordinador->getDataUser($id);

					$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);


					$data = [
						'dataUser' => $dataUser,
						'controller' => $controller,
						'pagename' => $method
					];

					$this->view('coordinador/config_general', $data);
				}
    	}
    }

    public function config_seguridad() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Coordinador') { 
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				} else {

					$id = $_SESSION['user_id'];
					$dataUser = $this->coordinador->getDataUser($id);

					$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);

					$data = [
						'dataUser' => $dataUser,
						'controller' => $controller,
						'pagename' => $method
					];

					$this->view('coordinador/config_seguridad', $data);
				}
    	}
    }

    public function version() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Coordinador') { 
  			$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$data = [
					'controller' => $controller,
					'pagename' => $method
				];

				$this->view('coordinador/version', $data);
				
    	}
    }

    public function registros() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Coordinador') { 
  			$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$userLogs = $this->coordinador->getUserLog($_SESSION['user_usuario']);
				$data = [
					'logs' => $userLogs,
					'controller' => $controller,
					'pagename' => $method
				];

				$this->view('coordinador/registros', $data);
    	}
    }

/**
 * Saluda al visitante
 * 
 * Une la palabra hola con el nombre del visitante
 * 
 * @param string $nombre nombre del visitante
 * @return string saludo completo
 */

/**
 * @template T of int|array<int>
 * @param T $id
 * @return (T is int ? static : array<static>)
 */

    public function add_cc() {
    	
    }

    public function edit_cc()
    {
        
    }

    public function edit_unidad()
    {
        
    }


	}
?>