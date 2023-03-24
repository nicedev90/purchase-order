<?php 
	class Usuarios extends Controller {
		private $usuario;

		public function __construct() {
			$this->usuario = $this->model('Usuario');
		}

		// ************ BEGIN INDEX VIEW
		public function index() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Usuario') {
				$user = $_SESSION['user_usuario'];
				$minas = $this->getMinas();
				$controller = strtolower(get_called_class());
				// $parentDir = basename(dirname(__FILE__));

				$ordenes = $this->getOrdenes($user);
				$method = ucwords(__FUNCTION__);
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

		public function getMinas() {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$minas = $this->usuario->getMinasPe();
				return $minas;
			} else {
				$minas = $this->usuario->getMinasCl();
				return $minas;
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
		// ************ END INDEX VIEW
		// 
		// ************ BEGIN HISTORIAL VIEW
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

		public function getAllOrdenesUser($user) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$ordenes = $this->usuario->getAllOrdenesUserPe($user);
				return $ordenes;
			} else {
				$ordenes = $this->usuario->getAllOrdenesUserCl($user);
				return $ordenes;
			}
		}
		// ************ END HISTORIAL VIEW
		// 
		// ************ BEGIN DETALLES VIEW
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

		public function getOrdenData($num_os) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$orden = $this->usuario->getOrdenDataPe($num_os);
				return $orden;
			} else {
				$orden = $this->usuario->getOrdenDataCl($num_os);
				return $orden;
			}
		}
    // ************ END DETALLES VIEW
		// 
		// ************ BEGIN CREAR ORDEN
		public function crear($tipo = null, $id = null) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$num_os = $this->getNumOrden();
				$data = $_POST['item'];

				$archivos = $_FILES['adjunto']['name'];

				if (!empty($archivos)) {
        	// array de archivos name="adjunto[]"
      		$files = $_FILES['adjunto'];
      		$urlFiles = $this->uploadFiles($files,$num_os);
        } else {
        	$files = '';
        }

				$enviarData = $this->enviarOrden($data);


        // $tipo = $_POST['item'][1]['tipo'];

        // $revs = $this->getSupervisores($tipo);

        // $rev1 = $revs[0]->nombre;
        // $rev2 = $revs[1]->nombre;

        // $this->setRevision($num_os,$tipo,$rev1,$rev2);
				

			// echo "<pre>";
			// echo $tipo . "<br>" . $num_os . ' ' . $rev1 . '   ' . $rev2;
			// print_r($revs);

			// die();


				// si enviarData es falso (return 0) redirigir al index, sino terminar la ejecucion die()
				if ($enviarData) {
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

	  public function uploadFiles($files,$num_os) {

	  	if ($_SESSION['user_sede'] == 'Peru') {
        $totalFiles = count($files['name']);

    		// mkdir('../public/files/pe/' . $num_os, 6640, true);
    		mkdir('../public/files/pe/' . $num_os);
    		// $old = umask(0000);
    		// mkdir('/var/www/html/purchase-order/public/files/pe/' . $num_os, 6640, true);
    		// umask($old);
        // $filesDir = '../public/files/pe/' . $num_os . '/';
        $filesDir = '../public/files/pe/' . $num_os;

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

		public function enviarOrden($data) {
      if ($_SESSION['user_sede'] == 'Peru') {
        return $this->usuario->registrarOrdenPe($data);
      } else {
        return $this->usuario->registrarOrdenCl($data);
      }
	  }

		public function getSupervisores($tipo) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$sede = $_SESSION['user_sede'];
				$revs = $this->usuario->getSuperPe($sede,$tipo);
				return $revs;
			} else {
				$sede = $_SESSION['user_sede'];
				$revs = $this->usuario->getSuperCl($sede,$tipo);
				return $revs;
			}
		}

		public function setRevision($num_os,$tipo,$rev1,$rev2) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$revs = $this->usuario->setRevisionPe($num_os,$tipo,$rev1,$rev2);
				return $revs;
			} else {
				$revs = $this->usuario->setRevisionCl($num_os,$tipo,$rev1,$rev2);
				return $revs;
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

		// ************ END CREAR ORDEN




		public function editar($num_os = null) {

			if (isset($_POST['edit_item'])) {
				$id = $_POST['id'];
				$cantidad = $_POST['cantidad'];
				$unidad = $_POST['unidad'];
				$descripcion = $_POST['descripcion'];
				$proveedor = $_POST['proveedor'];
				$valor = $_POST['valor'];

				$num_os = $_POST['num_os'];


				$updated = $this->setItem($id,$cantidad,$unidad,$descripcion,$proveedor,$valor);

				if ($updated) {
					redirect('usuarios/editar' . '/' . $num_os);
				}

			}  

			if (is_null($num_os)) {
				redirect('usuarios/index');
			} else {
				// obtener numero de orden segun sede del usuario
			// obtener data de la orden
				$orden = $this->getOrdenData($num_os);

				$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$data = [
					'orden' => $orden,
					'pagename' => $method,
					'controller' => $controller
				];

				$this->view('usuario/editar', $data);
			}				

			
		

			// $updateOrden = $this->updateOrden($data);
		}

		public function setItem($id,$cantidad,$unidad,$descripcion,$proveedor,$valor) {
      if ($_SESSION['user_sede'] == 'Peru') {
        return $this->usuario->setItemPe($id,$cantidad,$unidad,$descripcion,$proveedor,$valor);
      } else {
        return $this->usuario->setItemCl($id,$cantidad,$unidad,$descripcion,$proveedor,$valor);
      }
	  }


	  public function updateOrden($data) {
      if ($_SESSION['user_sede'] == 'Peru') {
        return $this->usuario->updateOrdenPe($data);
      } else {
        return $this->usuario->updateOrdenCl($data);
      }
	  }




	  public function crear_pdf($num_os) {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$items = $this->usuario->getOrdenItemsPe($num_os);
				$adjuntos = $this->usuario->getOrdenFilesPe($num_os);
				$revision = $this->usuario->getOrdenRevisionPe($num_os);
				
				$data = [
					'items' => $items,
					'adjuntos' => $adjuntos,
					'revision' => $revision
				];

				// echo "<pre>";
				// print_r($data);
				// die();

				$this->view('usuario/crear_pdf', $data);

      } else {

				$items = $this->usuario->getOrdenItemsCl($num_os);
				$adjuntos = $this->usuario->getOrdenFilesCl($num_os);
				$revision = $this->usuario->getOrdenRevisionCl($num_os);
				
				$data = [
					'items' => $items,
					'adjuntos' => $adjuntos,
					'revision' => $revision
				];

				// echo "<pre>";
				// print_r($data);
				// die();

				$this->view('usuario/crear_pdf', $data);
      }
    }

			


	}
?>