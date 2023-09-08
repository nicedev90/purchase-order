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
    // ************ BEGIN EDITAR AREAS SUPERVISORES
		public function edit_revision() {
			// Editar Areas de Fondo
			if (isset($_POST['btn_fondo'])) {
      	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      		$sede = $_SESSION['user_sede'];
      		$tipo = $_POST['tipo_fondo'];

      		$area_1 = $_POST['area_fondo_1'];
      		$area_2 = $_POST['area_fondo_2'];

      	$updated = $this->coordinador->updateRevFondos($sede,$tipo,$area_1,$area_2);
      	if ($updated) {
      	  $_SESSION['alerta'] = 'success';
					$_SESSION['mensaje'] = 'Actualizado correctamente.';
      		redirect('coordinadores/edit_revision');
      	}
			}

			// Editar areas de Compra
			if (isset($_POST['btn_compra'])) {
      	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      		$sede = $_SESSION['user_sede'];
      		$tipo = $_POST['tipo_compra'];

      		$area_1 = $_POST['area_compra_1'];
      		$area_2 = $_POST['area_compra_2'];

      	$updated = $this->coordinador->updateRevCompras($sede,$tipo,$area_1,$area_2);
      	if ($updated) {
      		$_SESSION['alerta'] = 'success';
					$_SESSION['mensaje'] = 'Actualizado correctamente.';
      		redirect('coordinadores/edit_revision');
      	}
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
    // ************ BEGIN AGREGAR EDITAR ELIMINAR USUARIOS
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

    		$password = password_hash($password, PASSWORD_DEFAULT);

      	$created = $this->coordinador->addUser($rol_id,$sede_id,$funcion,$nombre,$usuario,$email,$password,$estado);

      	if ($created) {
	      	$_SESSION['alerta'] = 'success';
					$_SESSION['mensaje'] = 'Usuario creado correctamente.';
	      	redirect('coordinadores/add_user');
      	}

			} else {

				$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$roles = $this->coordinador->getRoles();
				// array_diff , excluir del array los indices 0 y 1
				$roles = array_diff_key($roles, [0,1]);

				$data = [
					'roles' => $roles,
					'controller' => $controller,
					'pagename' => $method
				];

				$this->view('coordinador/add_user', $data);
			}
		}

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

    		$password = password_hash($password, PASSWORD_DEFAULT);

      	$user_updated = $this->coordinador->updateUser($user_id,$rol_id,$sede_id,$funcion,$nombre,$usuario,$email,$password,$estado);

      	if ($user_updated) {
      		$_SESSION['alerta'] = 'success';
					$_SESSION['mensaje'] = 'Usuario Actualizado';
					redirect('coordinadores/edit_user');
      	}

			}

			if (isset($_POST['eliminar_user'])) {
				$user_id = $_POST['user_id'];

      	$user_deleted = $this->coordinador->deleteUser($user_id);

      	if ($user_deleted) {
      		$_SESSION['alerta'] = 'danger';
					$_SESSION['mensaje'] = 'Usuario Eliminado';
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
	  // ************ END AGREGAR EDITAR ELIMINAR USUARIOS
	  // 
    // ************ BEGIN CONFIG PERFIL USUARIO
    public function config_general() {
    	if ( coordinadorLoggedIn() ) { 
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
					
		    	$nombre = $_POST['nombre'];

		      $updated = $this->coordinador->updateProfile($_SESSION['user_id'], $nombre);

					if ($updated) {
						$_SESSION['success_alert'] = 'success_modal';
						$_SESSION['msg_success'] = 'Actualizado correctamente.';
						redirect('coordinadores/config_seguridad');
						exit();

					} else {
						$_SESSION['warning_alert'] = 'warning_modal';
						$_SESSION['msg_warning'] = 'Ocurrió un error.';
						redirect('coordinadores/config_seguridad');
						exit();
					}

				} else {

					$dataUser = $this->coordinador->getDataUser($_SESSION['user_id']);

					$data = [
						'dataUser' => $dataUser,
						'controller' => strtolower(get_called_class()),
						'pagename' => ucwords(__FUNCTION__)
					];

					$this->view('coordinador/config_general', $data);
				}

    	} else {
				$this->view('pages/login');
			}
    }

    public function config_seguridad() {
    	if ( coordinadorLoggedIn() ) { 
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
					$password = $_POST['password'];
					$password_confirm = $_POST['password_confirm'];

					if ($password == $password_confirm) {
						$password = password_hash($password, PASSWORD_DEFAULT);
						$updatedPass = $this->coordinador->updateUserPassword($_SESSION['user_id'], $password);

						if ($updatedPass) {
							$_SESSION['success_alert'] = 'success_modal';
							$_SESSION['msg_success'] = 'Contraseña actualizada.';
							redirect('coordinadores/config_seguridad');
							exit();
						}

					} else {
						$_SESSION['warning_alert'] = 'warning_modal';
						$_SESSION['msg_warning'] = 'Contraseñas no coinciden.';
						redirect('coordinadores/config_seguridad');
						exit();
					}

				} else {

					$dataUser = $this->coordinador->getDataUser($_SESSION['user_id']);

					$data = [
						'dataUser' => $dataUser,
						'controller' => strtolower(get_called_class()),
						'pagename' => ucwords(__FUNCTION__)
					];

					$this->view('coordinador/config_seguridad', $data);
				}
    	} else {
				$this->view('pages/login');
			}
    }
	  // ************ END CONFIG PERFIL USUARIO
	  // 
    // ************ BEGIN CONFIG PERFIL USUARIO
    public function version() {
    	if ( coordinadorLoggedIn() ) { 

				$data = [
					'controller' => strtolower(get_called_class()),
					'pagename' => ucwords(__FUNCTION__)
				];

				$this->view('coordinador/version', $data);
				
    	}
    }

	  public function registros() {
	  	if ( coordinadorLoggedIn() ) { 

				$userLogs = $this->coordinador->getUserLog($_SESSION['user_usuario']);

				$data = [
					'logs' => $userLogs,
					'controller' => strtolower(get_called_class()),
					'pagename' => ucwords(__FUNCTION__)
				];

				$this->view('coordinador/registros', $data);
	  	}
	  }

	  public function edit_unidad()
	  {
	    if (userLoggedIn() && $_SESSION['user_rol'] == 'Coordinador') {
	    	if (isset($_POST['add_unidad'])) {
	    		$sede = $_POST['sede'];
	    		$unidad = $_POST['unidad'];

	      	$this->coordinador->addUnidad($sede,$unidad);

	      	redirect('coordinadores/edit_unidad');

	    	}

	    	if (isset($_POST['delete_unidad'])) {
	    		$id = $_POST['unidad_id'];

	      	$this->coordinador->deleteUnidad($id);

	      	redirect('coordinadores/edit_unidad');

	    	} 

	  		$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$unidades = $this->coordinador->getUnidadesSede($_SESSION['user_sede']);
				$data = [
					'unidades' => $unidades,
					'controller' => $controller,
					'pagename' => $method
				];

				$this->view('coordinador/edit_unidad', $data);
	    	
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

    public function edit_cc() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Coordinador') {
	    	if (isset($_POST['add_cc'])) {
	    		$sede = $_POST['sede'];
	    		$codigo = $_POST['codigo'];
	    		$centro_costo = $_POST['centro_costo'];

	      	$this->addMina($codigo,$centro_costo,$sede);

	      	redirect('coordinadores/edit_cc');

	    	}

	    	if (isset($_POST['delete_cc'])) {
	    		$id = $_POST['cc_id'];

	      	$this->deleteMina($id);

	      	redirect('coordinadores/edit_cc');

	    	} 

	  		$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$minas = $this->getMinas();
				
				$nextCode = end($minas);
				$nextCode = $nextCode->codigo + 100;

				$data = [
					'nextCode' => $nextCode,
					'minas' => $minas,
					'controller' => $controller,
					'pagename' => $method
				];

				// echo "<pre>";
				// print_r($data);
				// die();

				$this->view('coordinador/edit_cc', $data);
	    	
	    }
    }

	  public function getMinas() {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$minas = $this->coordinador->getMinasPe();
				return $minas;
			} else {
				$minas = $this->coordinador->getMinasCl();
				return $minas;
			}
	  }

	  public function addMina($codigo,$centro_costo,$sede) {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$result = $this->coordinador->addMinaPe($codigo,$centro_costo,$sede);
				return $result;
			} else {
				$result = $this->coordinador->addMinaCl($codigo,$centro_costo,$sede);
				return $result;
			}
	  }

	  public function deleteMina($id) {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$result = $this->coordinador->deleteMinaPe($id);
				return $result;
			} else {
				$result = $this->coordinador->deleteMinaCl($id);
				return $result;
			}
	  }

    public function edit_categoria($cc = null) {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Coordinador') {

    		if (is_null($cc)) {
    			$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);

					$minas = $this->getMinas();

					$data = [
						'minas' => $minas,
						'controller' => $controller,
						'pagename' => $method
					];

					// echo "<pre>";
					// print_r($data);
					// die();

					$this->view('coordinador/edit_categoria', $data);

    		} else {


    			if (isset($_POST['add_categoria'])) {
    				$mina_id = $_POST['mina_id'];
		    		$tipo = $_POST['tipo'];
		    		$codigo = $_POST['codigo'];
		    		$categoria = $_POST['categoria'];

		      	$this->addCategoria($mina_id,$codigo,$tipo,$categoria);

		      	redirect('coordinadores/edit_categoria' . '/' . $cc);

		    	}

		    	if (isset($_POST['delete_categoria'])) {
		    		$id = $_POST['categoria_id'];

		      	$this->deleteCategoria($id);

		      	redirect('coordinadores/edit_categoria' . '/' . $cc);

		    	} 

		  		$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);

					$minas = $this->getMinas();
					$categorias = $this->getCategorias($cc);
					
					$nextCode = current($categorias);
					$nextCode = $nextCode->codigo + 1;
					$mina = $this->getMinaById($cc);
					// $mina = $mina->id;

					$data = [
						'nextCode' => $nextCode,
						'minas' => $minas,
						'mina' => $mina,
						'categorias' => $categorias,
						'controller' => $controller,
						'pagename' => $method
					];

					// echo "<pre>";
					// print_r($data);
					// die();

					$this->view('coordinador/edit_categoria', $data);
    		}
	    	
	    }     
    }

	  public function getCategorias($cc) {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$minas = $this->coordinador->getCategoriasPe($cc);
				return $minas;
			} else {
				$minas = $this->coordinador->getCategoriasCl($cc);
				return $minas;
			}
	  }


		public function getMinaById($id) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$minaId = $this->coordinador->getMinaByIdPe($id);
				return $minaId;
			} else {
				$minaId = $this->coordinador->getMinaByIdCl($id);
				return $minaId;
			}
		}

	  public function addCategoria($mina_id,$codigo,$tipo,$categoria) {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$result = $this->coordinador->addCategoriaPe($mina_id,$codigo,$tipo,$categoria);
				return $result;
			} else {
				$result = $this->coordinador->addCategoriaCl($mina_id,$codigo,$tipo,$categoria);
				return $result;
			}
	  }

	  public function deleteCategoria($id) {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$result = $this->coordinador->deleteCategoriaPe($id);
				return $result;
			} else {
				$result = $this->coordinador->deleteCategoriaCl($id);
				return $result;
			}
	  }


	}
?>