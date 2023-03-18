<?php 
	class Usuarios extends Controller {
		private $usuario;

		public function __construct() {
			$this->usuario = $this->model('Usuario');
		}

		public function index() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Usuario') {
				$user = $_SESSION['user_usuario'];
				$minas = $this->getMinas();
				$controller = strtolower(get_called_class());
				// $parentDir = basename(dirname(__FILE__));

				$ordenes = $this->getOrdenes($user);
				$method = ucwords(__FUNCTION__);
				// $totalOrdenes = sizeof(json_decode($AllOrdenesUser, true));
				$AllOrdenesUser = $this->getAllOrdenesUser($user);
				$totalOrdenes = count($AllOrdenesUser);


				$data = [
					'minas' => $minas,
					'controller' => $controller,
					'ordenes' => $ordenes,
					'pagename' => $method,
					'totalOrdenes' => $AllOrdenesUser,
					'total' => $totalOrdenes
				];

			//  echo "<pre>";
			// print_r($data);
			// die();

				$this->view('usuario/index', $data);

			} else {
				$this->view('pages/login');
			}			
		}

		public function historial() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Usuario') {
				$user = $_SESSION['user_usuario'];

				$controller = strtolower(get_called_class());
				$AllOrdenesUser = $this->getAllOrdenesUser($user);
				$method = ucwords(__FUNCTION__);

				$data = [
					'controller' => $controller,
					'ordenes' => $AllOrdenesUser,
					'pagename' => $method
					
				];

			//  echo "<pre>";
			// print_r($data);
			// die();

				$this->view('usuario/historial', $data);

			} else {
				$this->view('pages/login');
			}			
		}

		public function detalles($num_os = null) {
			if (is_null($num_os)) {
				redirect('usuarios/index');
			} else {
				// obtener data de la orden
				$orden = $this->getOrdenData($num_os);

				$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$data = [
					'orden' => $orden,
					'pagename' => $method,
					'controller' => $controller
				];

				$this->view('usuario/detalles', $data);

			}
		}

		public function editar($num_os) {
						// echo "<pre>";
			// echo $tipo . "<br>" . $id;

			// die();

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$num_os = $this->getNumOrden();
				$data = $_POST['item'];

				$archivos = $_FILES['adjunto']['name'];

				if (count($archivos) > 0) {
        	// array de archivos name="adjunto[]"
      		$files = $_FILES['adjunto'];
      		$urlFiles = $this->uploadFiles($files,$num_os);
        } else {
        	$files = '';
        }

				$enviarData = $this->enviarOrden($data);
				// si enviarData es falso (return 0) redirigir al index, sino terminar la ejecucion die()
				if ($enviarData == 0) {
					// set index 'alerta' para mostrar modal SUCCESS en INDEX
					$_SESSION['alerta'] = 'success';
					redirect('usuarios/index');

				} else {
					die('Algo salió mal.');
				}

			} else {

				if (is_null($tipo) || is_null($id)) {
					redirect('usuarios/index');
				} else {
					// obtener numero de orden segun sede del usuario
					$num_os = $this->getNumOrden();

					// obtener info de mina y sus categorias
					$mina = $this->getMinaById($id);
					$mina_nombre = $mina->nombre;
					$mina_codigo = $mina->codigo;
					$mina_categ = $this->getMinaCateg($id,$tipo);
					
					$data = [
						'id' => $id,
						'mina_nombre' => $mina_nombre,
						'mina_codigo' => $mina_codigo,
						'mina_categ' => $mina_categ,
						'numero_os' => $num_os,
						'tipo_os' => $tipo
					];

					$this->view('usuario/crear', $data);
				}				

			}
		

			$updateOrden = $this->updateOrden($data);
		}

		public function getOrdenData($num_os) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$orden = $this->usuario->getOrdenDataPe($num_os);
				return $orden;
			} else {
				$orden = $this->usuario->getOrdenDataCl($num_os);
				return $orden;
			}
		}

		public function getAllOrdenesUser($user) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$ordenes = $this->usuario->getAllOrdenesUserPe($user);
				return $ordenes;
			} else {
				$ordenes = $this->usuario->getAllOrdenesUserCl($user);
				return $ordenes;
			}
		}

		public function crear($tipo = null, $id = null) {
			// echo "<pre>";
			// echo $tipo . "<br>" . $id;

			// die();

			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$num_os = $this->getNumOrden();
				$data = $_POST['item'];

				$archivos = $_FILES['adjunto']['name'];

				if (count($archivos) > 0) {
        	// array de archivos name="adjunto[]"
      		$files = $_FILES['adjunto'];
      		$urlFiles = $this->uploadFiles($files,$num_os);
        } else {
        	$files = '';
        }

				$enviarData = $this->enviarOrden($data);
				// si enviarData es falso (return 0) redirigir al index, sino terminar la ejecucion die()
				if ($enviarData == 0) {
					// set index 'alerta' para mostrar modal SUCCESS en INDEX
					$_SESSION['alerta'] = 'success';
					redirect('usuarios/index');

				} else {
					die('Algo salió mal.');
				}

			} else {

				if (is_null($tipo) || is_null($id)) {
					redirect('usuarios/index');
				} else {
					// obtener numero de orden segun sede del usuario
					$num_os = $this->getNumOrden();

					// obtener info de mina y sus categorias
					$mina = $this->getMinaById($id);
					$mina_nombre = $mina->nombre;
					$mina_codigo = $mina->codigo;
					$mina_categ = $this->getMinaCateg($id,$tipo);
					
					$data = [
						'id' => $id,
						'mina_nombre' => $mina_nombre,
						'mina_codigo' => $mina_codigo,
						'mina_categ' => $mina_categ,
						'numero_os' => $num_os,
						'tipo_os' => $tipo
					];

					$this->view('usuario/crear', $data);
				}				

			}
		}

		public function getMinas() {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$minas = $this->usuario->getMinasPe();
				return $minas;
			} else {
				$minas = $this->usuario->getMinasCl();
				return $minas;
			}
	  }

		public function getMinaById($id) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$minaId = $this->usuario->getMinaByIdPe($id);
				return $minaId;
			} else {
				$minaId = $this->usuario->getMinaByIdCl($id);
				return $minaId;
			}
		}

		public function getMinaCateg($id, $tipo) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$minaCateg = $this->usuario->getMinaCategPe($id,$tipo);
				return $minaCateg;
			} else {
				$minaCateg = $this->usuario->getMinaCategCl($id,$tipo);
				return $minaCateg;
			}
		}


		public function getOrdenes($user) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$ordenes = $this->usuario->getOrdenesPe($user);
				return $ordenes;
			} else {
				$ordenes = $this->usuario->getOrdenesCl($user);
				return $ordenes;
			}
		}


		public function getNumOrden() {
      if ($_SESSION['user_sede'] == 'Peru') {
        $numero = $this->usuario->getNumeroPe();
	        if ($numero) {
						$numero = $numero->num_os;
	       		$numero = $numero+1;
	        } else {
	        	$numero = 1;
	        }
        return $numero;
      } else {
        $numero = $this->usuario->getNumeroCl();
	        if ($numero) {
						$numero = $numero->num_os;
	       		$numero = $numero+1;
	        } else {
	        	$numero = 1;
	        }
        return $numero;
      }
	  }

	  public function enviarOrden($data) {
      if ($_SESSION['user_sede'] == 'Peru') {
        return $this->usuario->registrarOrdenPe($data);
      } else {
        return $this->usuario->registrarOrdenCl($data);
      }
	  }

	  public function updateOrden($data) {
      if ($_SESSION['user_sede'] == 'Peru') {
        return $this->usuario->updateOrdenPe($data);
      } else {
        return $this->usuario->updateOrdenCl($data);
      }
	  }

	  public function uploadFiles($files,$num_os) {

	  	if ($_SESSION['user_sede'] == 'Peru') {
        $totalFiles = count($files['name']);

    		mkdir('../public/files/pe/' . $num_os);
        $filesDir = '../public/files/pe/' . $num_os . '/';

      	$enlaces = [];
        // array de archivos, primer index = 1
	        for ($i = 1; $i <= $totalFiles; $i++) {
	        	$i_name = $files['name'][$i];
						$i_tmp = $files['tmp_name'][$i];

						move_uploaded_file($i_tmp, $filesDir . $i_name);

						$urlAdjunto[$i] = '/files/pe/' . $num_os . '/' . $i_name;
		        $enlaces[$i]['num_os'] = $num_os;
		        $enlaces[$i]['archivo'] = $urlAdjunto[$i];
	        }

        $this->usuario->guardarAdjuntoPe($enlaces);
      } else {

    		$totalFiles = count($files['name']);

    		mkdir('../public/files/cl/' . $num_os);
        $filesDir = '../public/files/cl/' . $num_os . '/';

      	$enlaces = [];
        // array de archivos, primer index = 1
	        for ($i = 1; $i <= $totalFiles; $i++) {
	        	$i_name = $files['name'][$i];
						$i_tmp = $files['tmp_name'][$i];

						move_uploaded_file($i_tmp, $filesDir . $i_name);

						$urlAdjunto[$i] = '/files/cl/' . $num_os . '/' . $i_name;
		        $enlaces[$i]['num_os'] = $num_os;
		        $enlaces[$i]['archivo'] = $urlAdjunto[$i];
	        }

        $this->usuario->guardarAdjuntoCl($enlaces);
      }
	  }


	}
?>