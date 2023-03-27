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

				if ($_SESSION['user_sede'] == 'Peru') {
					$enlaces = $this->usuario->getEnlacesPe($num_os);
					$observ = $this->usuario->getObsPe($num_os);
					$files = $this->usuario->getAdjuntosPe($num_os);
					if (count($files) > 0) {
						$adjuntos = $files;
					} else {
						$adjuntos = '';
					}
				} else {
					$enlaces = $this->usuario->getEnlacesCl($num_os);
					$observ = $this->usuario->getObsCl($num_os);
					$files = $this->usuario->getAdjuntosCl($num_os);
					if (count($files) > 0) {
						$adjuntos = $files;
					} else {
						$adjuntos = '';
					}
				}


				$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$data = [
					'orden' => $orden,
					'enlaces' => $enlaces,
					'observ' => $observ,
					'adjuntos' => $adjuntos,
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

					if (count($archivos) > 0) {
	        	// array de archivos name="adjunto[]"
	      		$files = $_FILES['adjunto'];
	      		$urlFiles = $this->uploadFiles($files,$num_os);
	        } else {
	        	$files = '';
	        }

				$enlaces = $_POST['enlaces'];

				$this->setEnlaces($enlaces);

				// enviar aprobaciones
        $tipoOs = $_POST['item'][1]['tipo'];
        $revs = $this->getSupervisores($tipoOs);
        $rev1 = $revs[0]->nombre;
        $rev2 = $revs[1]->nombre;

        $this->setRevision($num_os,$tipoOs,$rev1,$rev2);

					// enviar observaciones
					if (isset($_POST['observaciones'])) {
	        	$obs = $_POST['observaciones'];

	        	$this->setObservaciones($num_os,$obs);
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

		//  IF is POST the form
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

    		// mkdir('../public/files/pe/' . $num_os);
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

    		// mkdir('../public/files/cl/' . $num_os);
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

		public function setEnlaces($enlaces) {
			if ($_SESSION['user_sede'] == 'Peru') {
        $this->usuario->setEnlacesPe($enlaces);
      } else {
        $this->usuario->setEnlacesCl($enlaces);
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

		public function setObservaciones($num_os,$obs) {
			if ($_SESSION['user_sede'] == 'Peru') {
        $this->usuario->setObsPe($num_os,$obs);
      } else {
        $this->usuario->setObsCl($num_os,$obs);
      }
		}

		// public function enviarOrden($data) {
    //   if ($_SESSION['user_sede'] == 'Peru') {
    //     return $this->usuario->registrarOrdenPe($data);
    //   } else {
    //     return $this->usuario->registrarOrdenCl($data);
    //   }
	  // }


	  public function enviarOrden($data) {
      if ($_SESSION['user_sede'] == 'Peru') {
        $guardado = $this->usuario->registrarOrdenPe($data);

					$usuario = $data[1]['usuario'];
					$num_os = $data[1]['num_os'];
					$nombre = $_SESSION['user_nombre'];
					$mina = $data[1]['mina'];

					$this->sendBot($nombre,$num_os,$mina);
					$this->sendMail($nombre,$num_os,$mina);	

      } else {
        $guardado = $this->usuario->registrarOrdenCl($data);
				
					$usuario = $data[1]['usuario'];
					$num_os = $data[1]['num_os'];
					$nombre = $_SESSION['user_nombre'];
					$mina = $data[1]['mina'];

					$this->sendBot($nombre,$num_os,$mina);
					$this->sendMail($nombre,$num_os,$mina);				
      }
	  }

		public function sendBot($nombre,$num_os,$mina) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$grupo = '@BOTJACK2'; // BOT PERU
				$zona = 'America/Lima'; // zona Lima Peru
			} else {
				$grupo = '@BOTJACK4';  // BOT CHILE
				$zona = 'America/Santiago'; // zona Santiago Chile
			}

			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			date_default_timezone_set($zona);
			
			$token = "6165299682:AAHgtqE7iHoZfRFFwMnSweD8SJ5X13agnDY";
			
			$bot_chat= 'Hola soy el Bot Makuko, para informar que se ha generado una nueva orden de servicio 

					Orden : *N°00'.$num_os.' * 
					Creado Por : *'.$nombre.' * 
					N° Centro de Costo: *'.$mina.' * \
					
				Por favor revisar la orden creada\. Si tienes alguna duda o inconveniente contactate con Área TI \. Para soporte dirigite a este [sitio](https://www.clonsaingenieria.cl/)\.';
			
			$datos = [
					'chat_id' => $grupo,
					#'chat_id' => '@el_canal si va dirigido a un canal',
					'text' => $bot_chat,
					'parse_mode' => 'MarkdownV2' #formato del mensaje
			];

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, "https://api.telegram.org/bot" . $token . "/sendMessage");
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $datos);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$r_array = json_decode(curl_exec($ch), true);
			curl_close($ch);
		}

		public function sendMail($nombre,$num_os,$mina) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$destinatario = 'jtunoquesa@unprg.edu.pe';
			} else {
				$destinatario = 'jtunoquesa@unprg.edu.pe';
			}

      $contenido = "Creado por: ". $nombre."\n Numero de Orden: ". $num_os. "\n Centro de Costo:" .$mina;
      $mensajeCompleto =  "\n Se ha creado la orden de servicio: " . $num_os;
  
      mail($destinatario,$mensajeCompleto,$contenido);

    }



	  // If is not POST the form
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
		// 
		// ************ BEGIN EDITAR  ORDEN
		public function editar($num_os = null) {

			// click en el boton editar item
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

			// click en boton editar enlace
			if (isset($_POST['edit_link'])) {
				$id = $_POST['id'];
				$enlace = $_POST['enlace'];
				$num_os = $_POST['num_os'];

				$upLink = $this->updateEnlace($id,$enlace);

				if ($upLink) {
					redirect('usuarios/editar' . '/' . $num_os);
				}
			}

			// click en boton editar observacion
			if (isset($_POST['edit_obs'])) {
				$id = $_POST['id'];
				$observ = $_POST['observaciones'];
				$num_os = $_POST['num_os'];

				$updateObs = $this->updateObs($id,$observ);

				if ($updateObs) {
					redirect('usuarios/editar' . '/' . $num_os);
				}
			} 

			// click en boton SUBIR ADJUNTO
			if (isset($_POST['subir_adjunto'])) {
		  	if ($_SESSION['user_sede'] == 'Peru') {

		  		$adjunto = $_FILES['subir_file'];

	      	if (isset($adjunto['name'])) {
	      		$num_os = $_POST['num_os'];
	      		$filesDir = '../public/files/pe/' . $num_os . '/';

	      		$i_name = $adjunto['name'];
						$i_tmp = $adjunto['tmp_name'];

						move_uploaded_file($i_tmp, $filesDir . $i_name);

						$urlAdjunto = '/files/pe/' . $num_os . '/' . $i_name;

						$updateObs = $this->usuario->subirAdjuntoPe($num_os,$urlAdjunto);

						if ($updateObs) {
							redirect('usuarios/editar' . '/' . $num_os);
						}
	      	}

	      } else {
	      	$adjunto = $_FILES['subir_file'];

	      	if (isset($adjunto['name'])) {
	      		$num_os = $_POST['num_os'];
	      		$filesDir = '../public/files/cl/' . $num_os . '/';

	      		$i_name = $adjunto['name'];
						$i_tmp = $adjunto['tmp_name'];

						move_uploaded_file($i_tmp, $filesDir . $i_name);

						$urlAdjunto = '/files/cl/' . $num_os . '/' . $i_name;

						$updateObs = $this->usuario->subirAdjuntoCl($num_os,$urlAdjunto);

						if ($updateObs) {
							redirect('usuarios/editar' . '/' . $num_os);
						}
	      	}
	      }

			} 

			if (is_null($num_os)) {
				redirect('usuarios/index');
			} else {

			// obtener data de la orden
				$orden = $this->getOrdenData($num_os);

				$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				// obtener numero de orden segun sede del usuario
				if ($_SESSION['user_sede'] == 'Peru') {
					$enlaces = $this->usuario->getEnlacesPe($num_os);
					$observ = $this->usuario->getObsPe($num_os);
					$files = $this->usuario->getAdjuntosPe($num_os);
					if (count($files) > 0) {
						$adjuntos = $files;
					} else {
						$adjuntos = '';
					}
				} else {

					$enlaces = $this->usuario->getEnlacesCl($num_os);
					$observ = $this->usuario->getObsCl($num_os);
					$files = $this->usuario->getAdjuntosCl($num_os);
					if (count($files) > 0) {
						$adjuntos = $files;
					} else {
						$adjuntos = '';
					}
				}

				$data = [
					'orden' => $orden,
					'enlaces' => $enlaces,
					'observ' => $observ,
					'adjuntos' => $adjuntos,
					'pagename' => $method,
					'controller' => $controller
				];

				$this->view('usuario/editar', $data);
			}				

		}

		public function updateEnlace($id,$enlace) {
			if ($_SESSION['user_sede'] == 'Peru') {
        return $this->usuario->updateEnlacePe($id,$enlace);
      } else {
        return $this->usuario->updateEnlaceCl($id,$enlace);
      }
		}

		public function updateObs($id,$observ) {
			if ($_SESSION['user_sede'] == 'Peru') {
        return $this->usuario->updateObsPe($id,$observ);
      } else {
        return $this->usuario->updateObsCl($id,$observ);
      }
		}

		public function setItem($id,$cantidad,$unidad,$descripcion,$proveedor,$valor) {
      if ($_SESSION['user_sede'] == 'Peru') {
        return $this->usuario->setItemPe($id,$cantidad,$unidad,$descripcion,$proveedor,$valor);
      } else {
        return $this->usuario->setItemCl($id,$cantidad,$unidad,$descripcion,$proveedor,$valor);
      }
	  }


	  // public function updateOrden($data) {
    //   if ($_SESSION['user_sede'] == 'Peru') {
    //     return $this->usuario->updateOrdenPe($data);
    //   } else {
    //     return $this->usuario->updateOrdenCl($data);
    //   }
	  // }




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


    // ************ VISTAS SIDEBAR
    public function config_general() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Usuario') { 
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				} else {

					$id = $_SESSION['user_id'];
					$dataUser = $this->usuario->getDataUser($id);

					$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);


					$data = [
						'dataUser' => $dataUser,

						'controller' => $controller,
						'pagename' => $method
					];

				//  echo "<pre>";
				// print_r($data);
				// echo $_SESSION['user_id'];
				// die();

					$this->view('usuario/config_general', $data);
				}
    	}
    }

    public function config_seguridad() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Usuario') { 
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				} else {

					$id = $_SESSION['user_id'];
					$dataUser = $this->usuario->getDataUser($id);

					$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);


					$data = [
						'dataUser' => $dataUser,

						'controller' => $controller,
						'pagename' => $method
					];

				//  echo "<pre>";
				// print_r($data);
				// echo $_SESSION['user_id'];
				// die();

					$this->view('usuario/config_seguridad', $data);
				}
    	}
    }

    public function version() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Usuario') { 
  			$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$data = [

					'controller' => $controller,
					'pagename' => $method
				];


				$this->view('usuario/version', $data);
				
    	}
    }

    public function registros() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Usuario') { 
  			$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$userLogs = $this->usuario->getUserLog($_SESSION['user_usuario']);
				$data = [
					'logs' => $userLogs,

					'controller' => $controller,
					'pagename' => $method

				];


				$this->view('usuario/registros', $data);
				
    	}
    }
    
    

	}
?>