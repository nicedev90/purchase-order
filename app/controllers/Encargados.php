<?php 
	class Encargados extends Controller {
		private $encargado;

		public function __construct() {
			$this->encargado = $this->model('Encargado');
		}

		// ************ BEGIN INDEX VIEW
		public function index() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') {
				$user = $_SESSION['user_usuario'];
				$minas = $this->getMinas();
				$controller = strtolower(get_called_class());

				$ordenes = $this->getOrdenes();
				$method = ucwords(__FUNCTION__);
				$AllOrdenesSede = $this->getAllOrdenesSede();
				$totalOrdenesSede = count($AllOrdenesSede);
				$userOrdenes = $this->getOrdenesUser($user);

				$data = [
					'minas' => $minas,
					'controller' => $controller,
					'ordenes' => $ordenes,
					'pagename' => $method,
					'totalOrdenes' => $AllOrdenesSede,
					'total' => $totalOrdenesSede,
					'userOrdenes' => $userOrdenes
				];

				$this->view('encargado/index', $data);

				// $user = $_SESSION['user_usuario'];

				// $minas = $this->getMinas();
				// $ordenes = $this->getOrdenes();
				// $lastOrder = $this->getLastOrder();
				// $num_os  = $lastOrder->num_os;
				// $lastOrderData = $this->getOrdenData($num_os);
				// // $userLastOrder = $this->getUserLastOrder($user);
		
				// $data = [
				// 	'minas' => $minas,
				// 	'ordenes' => $ordenes,
				// 	'lastOrder' => $lastOrder,
				// 	'lastOrderData' => $lastOrderData
				// ];

				// $this->view('encargado/index', $data);

			} else {
				$this->view('pages/login');
			}
		}

	  public function getMinas() {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$minas = $this->encargado->getMinasPe();
				return $minas;
			} else {
				$minas = $this->encargado->getMinasCl();
				return $minas;
			}
	  }

		public function getOrdenes() {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$ordenes = $this->encargado->getOrdenesPe();
				return $ordenes;
			} else {
				$ordenes = $this->encargado->getOrdenesCl();
				return $ordenes;
			}
	  }

	  public function getOrdenesUser($user) {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$ordenes = $this->encargado->getOrdenesUserPe($user);
				return $ordenes;
			} else {
				$ordenes = $this->encargado->getOrdenesUserCl($user);
				return $ordenes;
			}
	  }

	  // ************ END INDEX VIEW
		// 
		// ************ BEGIN HISTORIAL VIEW
		public function historial() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') {
				$user = $_SESSION['user_usuario'];

				$controller = strtolower(get_called_class());
				$AllOrdenesSede = $this->getAllOrdenesSede();
				$method = ucwords(__FUNCTION__);

				$data = [
					'controller' => $controller,
					'ordenes' => $AllOrdenesSede,
					'pagename' => $method
					
				];

				$this->view('encargado/historial', $data);

			} else {
				$this->view('pages/login');
			}			
		}

		public function getAllOrdenesSede() {
			if ($_SESSION['user_sede'] == 'Peru') {
				$ordenes = $this->encargado->getAllOrdenesSedePe();
				return $ordenes;
			} else {
				$ordenes = $this->encargado->getAllOrdenesSedeCl();
				return $ordenes;
			}
		}
		// ************ END HISTORIAL VIEW
		// 
		// ************ BEGIN DETALLES VIEW
		public function detalles($num_os = null) {
			if (is_null($num_os)) {
				redirect('encargados/index');
			} else {
				// obtener data de la orden
				$orden = $this->getOrdenData($num_os);

				if ($_SESSION['user_sede'] == 'Peru') {
					$enlaces = $this->encargado->getEnlacesPe($num_os);
					$observ = $this->encargado->getObsPe($num_os);
					$files = $this->encargado->getAdjuntosPe($num_os);
					if (count($files) > 0) {
						$adjuntos = $files;
					} else {
						$adjuntos = '';
					}
				} else {
					$enlaces = $this->encargado->getEnlacesCl($num_os);
					$observ = $this->encargado->getObsCl($num_os);
					$files = $this->encargado->getAdjuntosCl($num_os);
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

				$this->view('encargado/detalles', $data);

			}
		}

		public function getOrdenData($num_os) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$orden = $this->encargado->getOrdenDataPe($num_os);
				return $orden;
			} else {
				$orden = $this->encargado->getOrdenDataCl($num_os);
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
					redirect('encargados/index');
				} else {
					die('Algo salió mal.');
				}

			} else {

				if (is_null($tipo) || is_null($id)) {
					redirect('encargados/index');
				} else {
					// obtener numero de orden segun sede del usuario
					$num_os = $this->getNumOrden();

					// obtener info de mina y sus categorias
					$mina = $this->getMinaById($id);
					$mina_nombre = $mina->nombre;
					$mina_codigo = $mina->codigo;
					$mina_categ = $this->getMinaCateg($id,$tipo);

					$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);
					
					$data = [
						'id' => $id,
						'mina_nombre' => $mina_nombre,
						'mina_codigo' => $mina_codigo,
						'mina_categ' => $mina_categ,
						'numero_os' => $num_os,
						'tipo_os' => $tipo,
						'pagename' => $method,
						'controller' => $controller
					];

					$this->view('encargado/crear', $data);
				}				

			}
		}

		//  IF is POST the form
		public function getNumOrden() {
      if ($_SESSION['user_sede'] == 'Peru') {
        $numero = $this->encargado->getNumeroPe();
	        if ($numero) {
						$numero = $numero->num_os;
	       		$numero = $numero+1;
	        } else {
	        	$numero = 1;
	        }
        return $numero;
      } else {
        $numero = $this->encargado->getNumeroCl();
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

        $this->encargado->guardarAdjuntoPe($enlaces);

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

        $this->encargado->guardarAdjuntoCl($enlaces);
      }
	  }

		public function setEnlaces($enlaces) {
			if ($_SESSION['user_sede'] == 'Peru') {
        $this->encargado->setEnlacesPe($enlaces);
      } else {
        $this->encargado->setEnlacesCl($enlaces);
      }
		}

		public function getSupervisores($tipo) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$sede = $_SESSION['user_sede'];
				$revs = $this->encargado->getSuperPe($sede,$tipo);
				return $revs;
			} else {
				$sede = $_SESSION['user_sede'];
				$revs = $this->encargado->getSuperCl($sede,$tipo);
				return $revs;
			}
		}

		public function setRevision($num_os,$tipo,$rev1,$rev2) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$revs = $this->encargado->setRevisionPe($num_os,$tipo,$rev1,$rev2);
				return $revs;
			} else {
				$revs = $this->encargado->setRevisionCl($num_os,$tipo,$rev1,$rev2);
				return $revs;
			}
		}

		public function setObservaciones($num_os,$obs) {
			if ($_SESSION['user_sede'] == 'Peru') {
        $this->encargado->setObsPe($num_os,$obs);
      } else {
        $this->encargado->setObsCl($num_os,$obs);
      }
		}

		public function enviarOrden($data) {
      if ($_SESSION['user_sede'] == 'Peru') {
        return $this->encargado->registrarOrdenPe($data);
      } else {
        return $this->encargado->registrarOrdenCl($data);
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
				$minaId = $this->encargado->getMinaByIdPe($id);
				return $minaId;
			} else {
				$minaId = $this->encargado->getMinaByIdCl($id);
				return $minaId;
			}
		}

		public function getMinaCateg($id, $tipo) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$minaCateg = $this->encargado->getMinaCategPe($id,$tipo);
				return $minaCateg;
			} else {
				$minaCateg = $this->encargado->getMinaCategCl($id,$tipo);
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
					redirect('encargados/editar' . '/' . $num_os);
				}
			}

			// click en boton editar enlace
			if (isset($_POST['edit_link'])) {
				$id = $_POST['id'];
				$enlace = $_POST['enlace'];
				$num_os = $_POST['num_os'];

				$upLink = $this->updateEnlace($id,$enlace);

				if ($upLink) {
					redirect('encargados/editar' . '/' . $num_os);
				}
			}

			// click en boton editar observacion
			if (isset($_POST['edit_obs'])) {
				$id = $_POST['id'];
				$observ = $_POST['observaciones'];
				$num_os = $_POST['num_os'];

				$updateObs = $this->updateObs($id,$observ);

				if ($updateObs) {
					redirect('encargados/editar' . '/' . $num_os);
				}
			}

			// click en form aprobacion 1
			if (isset($_POST['btn_aprobacion1'])) {

				$observacion = $_POST['observacion'];
				$aprobacion = $_POST['aprobacion'];
				$num_os = $_POST['num_os'];

				if (strtoupper($aprobacion) == 'RECHAZADO') {
					$update = $this->setRevision1($num_os,$observacion,$aprobacion);
					$upOrden = $this->updateOrdenStatus($num_os,$aprobacion);
				} else {
					$update = $this->setRevision1($num_os,$observacion,$aprobacion);
				}

				

				if ($update) {
					redirect('encargados/editar' . '/' . $num_os);
				}
			}

			// click en form aprobacion 2
			if (isset($_POST['btn_aprobacion2'])) {

				$observacion = $_POST['observacion'];
				$aprobacion = $_POST['aprobacion'];
				$num_os = $_POST['num_os'];

				$update = $this->setRevision2($num_os,$observacion,$aprobacion);
				$upOrden = $this->updateOrdenStatus($num_os,$aprobacion);

				if ($update) {
					redirect('encargados/editar' . '/' . $num_os);
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

						$updateObs = $this->encargado->subirAdjuntoPe($num_os,$urlAdjunto);

						if ($updateObs) {
							redirect('encargados/editar' . '/' . $num_os);
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

						$updateObs = $this->encargado->subirAdjuntoCl($num_os,$urlAdjunto);

						if ($updateObs) {
							redirect('encargados/editar' . '/' . $num_os);
						}
	      	}
	      }

			} 

			if (is_null($num_os)) {
				redirect('encargados/index');
			} else {

			// obtener data de la orden
				$orden = $this->getOrdenData($num_os);

				$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				// obtener numero de orden segun sede del usuario
				if ($_SESSION['user_sede'] == 'Peru') {
					$enlaces = $this->encargado->getEnlacesPe($num_os);
					$observ = $this->encargado->getObsPe($num_os);
					$files = $this->encargado->getAdjuntosPe($num_os);

					if (count($files) > 0) {
						$adjuntos = $files;
					} else {
						$adjuntos = '';
					}

					$revisores = $this->encargado->getRevisoresPe($num_os);
					$revisor1 = $revisores->revisor_1;

					if (!empty($revisores->aprob_1)) {
						$revisor2 = $revisores->revisor_2;
					} else {
						$revisor2 = '';
					}

				} else {

					$enlaces = $this->encargado->getEnlacesCl($num_os);
					$observ = $this->encargado->getObsCl($num_os);
					$files = $this->encargado->getAdjuntosCl($num_os);

					if (count($files) > 0) {
						$adjuntos = $files;
					} else {
						$adjuntos = '';
					}

					$revisores = $this->encargado->getRevisoresCl($num_os);
					$revisor1 = $revisores->revisor_1;

					if (!empty($revisores->aprob_1)) {
						$revisor2 = $revisores->revisor_2;
					} else {
						$revisor2 = '';
					}
				}

				$data = [
					'orden' => $orden,
					'enlaces' => $enlaces,
					'observ' => $observ,
					'adjuntos' => $adjuntos,
					'revisor1' => $revisor1,
					'aprob_1' => $revisores->aprob_1,
					'aprob_2' => $revisores->aprob_2,
					'revisor2' => $revisor2,
					'pagename' => $method,
					'controller' => $controller
				];

				$this->view('encargado/editar', $data);
			}				

		}

		public function setRevision1($num_os,$observacion,$aprobacion) {
			if ($_SESSION['user_sede'] == 'Peru') {
        return $this->encargado->setRevision1Pe($num_os,$observacion,$aprobacion);
      } else {
        return $this->encargado->setRevision1Cl($num_os,$observacion,$aprobacion);
      }
		}

		public function setRevision2($num_os,$observacion,$aprobacion) {
			if ($_SESSION['user_sede'] == 'Peru') {
        return $this->encargado->setRevision2Pe($num_os,$observacion,$aprobacion);
      } else {
        return $this->encargado->setRevision2Cl($num_os,$observacion,$aprobacion);
      }
		}

		public function updateOrdenStatus($num_os,$status) {
			if ($_SESSION['user_sede'] == 'Peru') {
        return $this->encargado->updateOrdenStatusPe($num_os,$status);
      } else {
        return $this->encargado->updateOrdenStatusCl($num_os,$status);
      }	
		}

		public function updateEnlace($id,$enlace) {
			if ($_SESSION['user_sede'] == 'Peru') {
        return $this->encargado->updateEnlacePe($id,$enlace);
      } else {
        return $this->encargado->updateEnlaceCl($id,$enlace);
      }
		}

		public function updateObs($id,$observ) {
			if ($_SESSION['user_sede'] == 'Peru') {
        return $this->encargado->updateObsPe($id,$observ);
      } else {
        return $this->encargado->updateObsCl($id,$observ);
      }
		}

		public function setItem($id,$cantidad,$unidad,$descripcion,$proveedor,$valor) {
      if ($_SESSION['user_sede'] == 'Peru') {
        return $this->encargado->setItemPe($id,$cantidad,$unidad,$descripcion,$proveedor,$valor);
      } else {
        return $this->encargado->setItemCl($id,$cantidad,$unidad,$descripcion,$proveedor,$valor);
      }
	  }
	  // ************ END EDITAR  ORDEN
	  // 
	  // ************ BEGIN CREAR PDF
	  public function crear_pdf($num_os) {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$items = $this->encargado->getOrdenItemsPe($num_os);
				$adjuntos = $this->encargado->getOrdenFilesPe($num_os);
				$revision = $this->encargado->getOrdenRevisionPe($num_os);
				$enlaces = $this->encargado->getOrdenEnlacesPe($num_os);
				$observ = $this->encargado->getOrdenObsPe($num_os);

				$sede = $_SESSION['user_sede'];
				$tipo = $revision[0]->tipo;
				$areas = $this->encargado->getRevisionAreasPe($sede,$tipo);
				
				$data = [
					'items' => $items,
					'adjuntos' => $adjuntos,
					'revision' => $revision,
					'enlaces' => $enlaces,
					'observ' => $observ,
					'areas' => $areas
				];

				// echo "<pre>";
				// print_r($data);
				// die();

				$this->view('encargado/crear_pdf', $data);

      } else {

				$items = $this->encargado->getOrdenItemsCl($num_os);
				$adjuntos = $this->encargado->getOrdenFilesCl($num_os);
				$revision = $this->encargado->getOrdenRevisionCl($num_os);
				$enlaces = $this->encargado->getOrdenEnlacesCl($num_os);
				$observ = $this->encargado->getOrdenObsCl($num_os);

				$sede = $_SESSION['user_sede'];
				$tipo = $revision[0]->tipo;
				$areas = $this->encargado->getRevisionAreasCl($sede,$tipo);
				
				$data = [
					'items' => $items,
					'adjuntos' => $adjuntos,
					'revision' => $revision,
					'enlaces' => $enlaces,
					'observ' => $observ,
					'areas' => $areas
				];


				// echo "<pre>";
				// print_r($data);
				// die();

				$this->view('encargado/crear_pdf', $data);
      }
    }
	  // ************ END CREAR PDF
    // 
    // ************ VISTAS SIDEBAR
    public function config_general() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				} else {

					$id = $_SESSION['user_id'];
					$dataUser = $this->encargado->getDataUser($id);

					$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);


					$data = [
						'dataUser' => $dataUser,

						'controller' => $controller,
						'pagename' => $method
					];

					$this->view('encargado/config_general', $data);
				}
    	}
    }

    public function config_seguridad() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				} else {

					$id = $_SESSION['user_id'];
					$dataUser = $this->encargado->getDataUser($id);

					$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);

					$data = [
						'dataUser' => $dataUser,
						'controller' => $controller,
						'pagename' => $method
					];

					$this->view('encargado/config_seguridad', $data);
				}
    	}
    }

    public function version() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 
  			$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$data = [
					'controller' => $controller,
					'pagename' => $method
				];

				$this->view('encargado/version', $data);
				
    	}
    }

    public function registros() {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 
  			$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$userLogs = $this->encargado->getUserLog($_SESSION['user_usuario']);
				$data = [
					'logs' => $userLogs,
					'controller' => $controller,
					'pagename' => $method
				];

				$this->view('encargado/registros', $data);
    	}
    }

    // 
    // ********* BEGIN REPORTES
    public function reportes_user($user = null, $mes = null) {
    	if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 
    		if (!is_null($user) && !is_null($mes)) {

    			if ($_SESSION['user_sede'] == 'Peru') {
		        $dataUser = $this->encargado->getReporteUserPe($user,$mes);
		      } else {
		        $dataUser = $this->encargado->getReporteUserCl($user,$mes);
		      }

		      $sede = ($_SESSION['user_sede'] == 'Peru') ? 1 : 2;
					$usuarios = $this->encargado->getAllUsers($sede);

	  			$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);

					$meses = [
						'01' => 'Enero',
						'02' => 'Febrero',
						'03' => 'Marzo',
						'04' => 'Abril',
						'05' => 'Mayo',
						'06' => 'Junio',
						'07' => 'Julio',
						'08' => 'Agosto',
						'09' => 'Setiembre',
						'10' => 'Octubre',
						'11' => 'Noviembre',
						'12' => 'Diciembre'
					];

		      $data = [
						'dataUser' => $dataUser,
						'usuarios' => $usuarios,
						'meses' => $meses,
						'mes' => $mes,
						'controller' => $controller,
						'pagename' => $method
					];


					// echo "<pre>";
					// print_r($data);
					// die();

		      $this->view('encargado/reportes_user', $data);

    		} 

    		if (!is_null($user) && is_null($mes)) {
    			redirect('encargados/reportes_user');
    		}

    			$sede = ($_SESSION['user_sede'] == 'Peru') ? 1 : 2;
					$usuarios = $this->encargado->getAllUsers($sede);

	  			$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);

					$meses = [
						'01' => 'Enero',
						'02' => 'Febrero',
						'03' => 'Marzo',
						'04' => 'Abril',
						'05' => 'Mayo',
						'06' => 'Junio',
						'07' => 'Julio',
						'08' => 'Agosto',
						'09' => 'Setiembre',
						'10' => 'Octubre',
						'11' => 'Noviembre',
						'12' => 'Diciembre'
					];

					$data = [
						'usuarios' => $usuarios,
						'meses' => $meses,
						'controller' => $controller,
						'pagename' => $method
					];

					$this->view('encargado/reportes_user', $data);

    	}
    }

    public function reportes_cc($tipo = null, $mina = null, $mes = null) {

    	if (!is_null($tipo) && !is_null($mina) && !is_null($mes)) {
    		// Vista inicial 
    		$reporte = $this->getReporteMina($tipo,$mina,$mes);

		    $minas = $this->getMinas();
				$meses = [
					'01' => 'Enero',
					'02' => 'Febrero',
					'03' => 'Marzo',
					'04' => 'Abril',
					'05' => 'Mayo',
					'06' => 'Junio',
					'07' => 'Julio',
					'08' => 'Agosto',
					'09' => 'Setiembre',
					'10' => 'Octubre',
					'11' => 'Noviembre',
					'12' => 'Diciembre'
				];

  			$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$data = [
					'tipo' => $tipo,
					'mina' => $mina,
					'mes' => $mes,
					'minas' => $minas,
					'meses' => $meses,
					'reporte' => $reporte,
					'controller' => $controller,
					'pagename' => $method
				];

				// echo "<pre>";
				// print_r($data);
				// die();

				$this->view('encargado/reportes_cc', $data);
    	}

			// Vista inicial 
		    $minas = $this->getMinas();
				$meses = [
					'01' => 'Enero',
					'02' => 'Febrero',
					'03' => 'Marzo',
					'04' => 'Abril',
					'05' => 'Mayo',
					'06' => 'Junio',
					'07' => 'Julio',
					'08' => 'Agosto',
					'09' => 'Setiembre',
					'10' => 'Octubre',
					'11' => 'Noviembre',
					'12' => 'Diciembre'
				];

  			$controller = strtolower(get_called_class());
				$method = ucwords(__FUNCTION__);

				$data = [
					'minas' => $minas,
					'meses' => $meses,
					'controller' => $controller,
					'pagename' => $method
				];

				$this->view('encargado/reportes_cc', $data);


    }

    public function getReporteMina($tipo,$mina,$mes) {
    	if ($_SESSION['user_sede'] == 'Peru') {
        return $this->encargado->getReporteMinaPe($tipo,$mina,$mes);
      } else {
        return $this->encargado->getReporteMinaCl($tipo,$mina,$mes);
      }
    }

    public function reporte_pdf($tipo,$mina,$mes) {
    	if ($_SESSION['user_sede'] == 'Peru') {
    		$reporte = $this->encargado->getReporteMinaPe($tipo,$mina,$mes);

				$data = [
					'reporte' => $reporte
				];

				// echo "<pre>";
				// print_r($data);
				// die();

				$this->view('encargado/reporte_pdf', $data);
			}
    }
    // ********* END REPORTES


	}
?>