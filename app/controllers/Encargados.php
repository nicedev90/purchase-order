<?php 
	class Encargados extends Controller {
		private $encargado;
		private $coordinador;

		public function __construct() {
			$this->encargado = $this->model('Encargado');
			$this->coordinador = $this->model('Coordinador');
		}

		// ************ BEGIN INDEX VIEW
		public function index() {

			if ( encargadoLoggedIn() ) {

				$ordenes_user = $this->getOrdenesByUser($_SESSION['user_usuario']);
				$total_ordenes_user = count($ordenes_user) > 0 ? count($ordenes_user) : 0;

				$ultima_orden_sede =  $this->getUltimaOrdenBySede();
				$ultima_orden = current($ultima_orden_sede[0]);

				$data = [
					'minas' => $minas = $this->getMinas(),
					'ordenes' => $this->getOrdenesBySedeIndex(),
					'total' => $this->getCountOrdenesBySede(),
					'total_aprobado' =>  $this->getCountOrdenesBySede_aprobado('Aprobado'),
					'ordenes_user' => $total_ordenes_user,
					'revisorCaja' => $this->getRevisorCaja(TIPO_REVISOR_CAJA),
					'ultima_orden' => $ultima_orden,
					'controller' => strtolower(get_called_class()),
					'pagename' => ucwords(__FUNCTION__)
				];

				$this->view('encargado/index', $data);

			} else {
				$this->view('pages/login');
			}
		}

		public function getRevisorCaja($tipo) {

			$_where = array(
				array('t1', 'tipo', $tipo),
			);

			$_cols = array(
				array('t1', 'usuario'),
			);

			// $_where = array(
			// 	array('t1', 'tipo', $tipo, ' AND '),
			// 	array('t1', 'sede', 'Peru'),
			// );

			if ( userFromSede_1() ) {
				$revisor = $this->encargado->read('single', 'supervisores', $_cols, $_where, null, null);
				return $revisor->usuario;
			} else if ( userFromSede_2() ) {
				$revisor = $this->encargado->read('single', 'supervisores', $_cols, $_where, null, null);
				return $revisor->usuario;
			}
		}

	  public function getMinas() {
	  	if ( userFromSede_1() ) {
				$minas = $this->encargado->readMinas('minas_pe');
				return $minas;
			} else if ( userFromSede_2() ) {
				$minas = $this->encargado->readMinas('minas_cl');
				return $minas;
			}
	  }

		public function getOrdenesBySedeIndex() {
	  	if ( userFromSede_1() ) {
				$ordenes = $this->encargado->readOrdenesBySede('os_peru', 'o', 'Aprobado', 'creado', 'DESC', 5);
				return $ordenes;
			} else if ( userFromSede_2() ) {
				$ordenes = $this->encargado->readOrdenesBySede('os_chile', 'o', 'Aprobado', 'creado', 'DESC', 5);
				return $ordenes;
			}
		}

		public function getUltimaOrdenBySede() {

      $_cols = array(
        array('t1', 'num_os', null),
        array('t1', 'tipo', null),
        array('t1', 'usuario', null),
        array('t1', 'estado', null),
        array(null, "DATE_FORMAT(t1.creado, '%d-%b-%Y')", 'creado'),
        array('t2', 'nombre', 'mina_nombre'),
        array('t3', 'aprob_1', 'rev'),
        array('t4', 'nombre', 'nombre_usuario'),
      );

      $_where = array(
        array('t1', 'estado', 'Aprobado'),
      );


      $_group = array('t1', 'creado');

      // $_order = array('ASC', 't1', 'creado');
      // $_order = array('DESC', 't1', 'creado');
      $_order = array('DESC', null, null);


      $_limit = array(1, null, null);
      // $_limit = array(5, 10, null);
      // $_limit = array(10, 5, 'OFFSET');

	  	if ( userFromSede_1() ) {

				$_from = array('os_peru', 't1');

	      $_joins = array(
	        array('minas_pe', 't2', 'codigo', 't1', 'mina'),
	        array('revision_pe', 't3', 'num_os', 't1', 'num_os'),
	        array('usuarios', 't4', 'usuario', 't1', 'usuario'),
	      );

				$last = $this->encargado->readJoin('set', $_from, $_joins, $_cols, $_where, $_group, $_order, $_limit);
				return $last;

			} else if ( userFromSede_2() ) {

				$_from = array('os_chile', 't1');

	      $_joins = array(
	        array('minas_cl', 't2', 'codigo', 't1', 'mina'),
	        array('revision_cl', 't3', 'num_os', 't1', 'num_os'),
	        array('usuarios', 't4', 'usuario', 't1', 'usuario'),
	      );

				$last = $this->encargado->readJoin('set', $_from, $_joins, $_cols, $_where, $_group, $_order, $_limit);
				return $last;
			}
		}

	  public function getCountOrdenesBySede() {
	  	if ( userFromSede_1() ) {
				$total = $this->encargado->readCountOrdenesBySede('os_peru', 'All');
				return $total;
			} else if ( userFromSede_2() ) {
				$total = $this->encargado->readCountOrdenesBySede('os_chile', 'All');
				return $total;
			}
	  }

	  public function getCountOrdenesBySede_aprobado($status) {
	  	if ( userFromSede_1() ) {
				$total = $this->encargado->readCountOrdenesBySede('os_peru', $status);
				return $total;
			} else if ( userFromSede_2() ) {
				$total = $this->encargado->readCountOrdenesBySede('os_chile', $status);
				return $total;
			}
	  }


	  public function getOrdenesByUser($user) {
	  	if ( userFromSede_1() ) {
				$ordenes = $this->encargado->readOrdenesByUser($user, 'os_peru', 'o', 'creado', 'DESC');
				return $ordenes;
			} else if ( userFromSede_2() ) {
				$ordenes = $this->encargado->readOrdenesByUser($user, 'os_chile', 'o', 'creado', 'DESC');
				return $ordenes;
			}
	  }

	  // ************ END INDEX VIEW
		// 
		// ************ BEGIN HISTORIAL VIEW
		public function historial() {
			if ( encargadoLoggedIn() ) {

				$AllOrdenesSede = $this->getOrdenesBySedeHistorial();

				$data = [
					'ordenes' => $AllOrdenesSede,
					'controller' => strtolower(get_called_class()),
					'pagename' => ucwords(__FUNCTION__)
				];

				$this->view('encargado/historial', $data);

			} else {
				$this->view('pages/login');
			}			
		}


		public function getOrdenesBySedeHistorial() {
	  	if ( userFromSede_1() ) {
				$ordenes = $this->encargado->readOrdenesBySede('os_peru', 'o', 'All', 'creado', 'DESC', 50);
				return $ordenes;
			} else if ( userFromSede_2() ) {
				$ordenes = $this->encargado->readOrdenesBySede('os_chile', 'o', 'All', 'creado', 'DESC', 50);
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
					$unidades = $this->encargado->getUnidadesSede($_SESSION['user_sede']);

					$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);
					
					$data = [
						'id' => $id,
						'mina_nombre' => $mina_nombre,
						'mina_codigo' => $mina_codigo,
						'mina_categ' => $mina_categ,
						'numero_os' => $num_os,
						'tipo_os' => $tipo,
						'unidades' => $unidades,
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
    	if ( encargadoLoggedIn() ) { 
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		    	$nombre = $_POST['nombre'];

		      $updated = $this->coordinador->updateProfile($_SESSION['user_id'], $nombre);

					if ($updated) {
						$_SESSION['success_alert'] = 'success_modal';
						$_SESSION['msg_success'] = 'Actualizado correctamente.';
						redirect('encargados/config_general');
						exit();

					} else {
						$_SESSION['warning_alert'] = 'warning_modal';
						$_SESSION['msg_warning'] = 'Ocurrió un error.';
						redirect('encargados/config_general');
						exit();
					}

				} else {

					$dataUser = $this->coordinador->getDataUser($_SESSION['user_id']);

					$data = [
						'dataUser' => $dataUser,
						'controller' => strtolower(get_called_class()),
						'pagename' => ucwords(__FUNCTION__)
					];

					$this->view('encargado/config_general', $data);
				}

    	} else {
				$this->view('pages/login');
			}
    }

    public function config_seguridad() {
    	if ( encargadoLoggedIn() ) { 
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
							redirect('encargados/config_seguridad');
							exit();
						}

					} else {
						$_SESSION['warning_alert'] = 'warning_modal';
						$_SESSION['msg_warning'] = 'Contraseñas no coinciden.';
						redirect('encargados/config_seguridad');
						exit();
					}

				} else {

					$dataUser = $this->coordinador->getDataUser($_SESSION['user_id']);

					$data = [
						'dataUser' => $dataUser,
						'controller' => strtolower(get_called_class()),
						'pagename' => ucwords(__FUNCTION__)
					];

					$this->view('encargado/config_seguridad', $data);
				}

    	} else {
				$this->view('pages/login');
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
    	if ( encargadoLoggedIn() ) { 

				$userLogs = $this->coordinador->getUserLog($_SESSION['user_usuario']);

				$data = [
					'logs' => $userLogs,
					'controller' => strtolower(get_called_class()),
					'pagename' => ucwords(__FUNCTION__)
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
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') {
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

				// Vista inicial de la pagina
				  $sede = ($_SESSION['user_sede'] == 'Peru') ? 1 : 2;
					$usuarios = $this->encargado->getAllUsers($sede);

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
						'usuarios' => $usuarios,
						'controller' => $controller,
						'pagename' => $method
					];

					$this->view('encargado/reportes_cc', $data);
			} else {
				$this->view('pages/login');
			}

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




    public function reportes_caja($mina = null, $mes = null) {

    	if (!is_null($mina) && !is_null($mes)) {
    		// Vista inicial 
    		$reporte = $this->encargado->getReporteCaja($mina,$mes);

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

				$this->view('encargado/reportes_caja', $data);
    	}

			// Vista inicial 
			  $sede = ($_SESSION['user_sede'] == 'Peru') ? 1 : 2;
				$usuarios = $this->encargado->getAllUsers($sede);

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
					'usuarios' => $usuarios,
					'controller' => $controller,
					'pagename' => $method
				];

				$this->view('encargado/reportes_caja', $data);


    }

    public function sustentar() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
					$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
					
					$usuario = $_SESSION['user_usuario'];
					$num_caja = $_POST['num_caja'];

					$cajaAdjuntos = $_FILES['adjunto']['name'];

				  	if (count($cajaAdjuntos) > 0) {
				  		$files = $_FILES['adjunto'];
			      	$totalFiles = count($files['name']);

			      	if(file_exists('../public/files/caja/' . $usuario)) {
								$filesDir = '../public/files/caja/' . $usuario . '/' . $num_caja . '/';
			      	} else {
			    			mkdir('../public/files/caja/' . $usuario);
			    			mkdir('../public/files/caja/' . $usuario . '/' . $num_caja);
								$filesDir = '../public/files/caja/' . $usuario . '/' . $num_caja . '/';
			      	}

			      	$enlaces = [];
			        // array de archivos, primer index = 1
				        for ($i = 1; $i <= $totalFiles; $i++) {
				        	$i_name = $files['name'][$i];
									$i_tmp = $files['tmp_name'][$i];

									move_uploaded_file($i_tmp, $filesDir . $i_name);

									$urlAdjunto[$i] = '/files/caja/' . $usuario . '/' . $num_caja . '/' . $i_name;
					        $enlaces[$i]['usuario'] = $usuario;
					        $enlaces[$i]['num_caja'] = $num_caja;
					        $enlaces[$i]['archivo'] = $urlAdjunto[$i];
				        }

			        $this->encargado->registrarCajaAdjuntos($enlaces);

			      }



					$obs = $_POST['observaciones'];

					$this->encargado->registrarCajaObs($usuario, $num_caja, $obs);
					
					$data = $_POST['item'];
					$this->encargado->registrarCaja($data);

					redirect('encargados/rep_mi_caja');

				} else {

					$num_caja = $this->encargado->getNumCaja($_SESSION['user_usuario']);
					$minas = $this->getMinas();
					$saldo = $this->encargado->getSaldoCaja($_SESSION['user_usuario']);

					$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);
					
					$data = [
						'saldo' => $saldo,
						'minas' => $minas,
						'pagename' => $method,
						'controller' => $controller,
						'num_caja' => $num_caja
					];


					// echo "<pre>";
					// print_r( $num_caja);
					// die();

					$this->view('encargado/sustentar', $data);
				}
			// end userLoggedIn
			} else {
				redirect('pages/login');
			}

		}

    public function rep_mi_caja() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 

				$totalCajas = $this->encargado->getTotalCajas($_SESSION['user_usuario']);
				$saldo = $this->encargado->getSaldoCaja($_SESSION['user_usuario']);
				
				$data = [
					'saldo' => $saldo,
					'totalCajas' => $totalCajas,
					'pagename' => ucwords(__FUNCTION__),
					'controller' => strtolower(get_called_class())
				];


				// echo "<pre>";
				// print_r( $num_caja);
				// die();

				$this->view('encargado/rep_mi_caja', $data);
				
			} else {
				redirect('pages/login');
			}

		}


    public function detalles_caja($num_caja = null) {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 

				$caja = $this->encargado->getDetalleCaja($num_caja, $_SESSION['user_usuario']);
				$observ = $this->encargado->getObservacionesCaja($num_caja, $_SESSION['user_usuario']);
				$adjuntos = $this->encargado->getAdjuntosCaja($num_caja, $_SESSION['user_usuario']);
				
				$data = [
					'caja' => $caja,
					'adjuntos' => $adjuntos,
					'observ' => $observ,
					'pagename' => ucwords(__FUNCTION__),
					'controller' => strtolower(get_called_class())
				];


				// echo "<pre>";
				// print_r( $num_caja);
				// die();

				$this->view('encargado/detalles_caja', $data);
				
			} else {
				redirect('pages/login');
			}

		}

    public function editar_caja($num_caja = null) {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 

				// click en el boton editar item
				if (isset($_POST['edit_item'])) {
					$id = $_POST['id'];
					$fecha = $_POST['fecha'];
					$centro_costo = $_POST['centro_costo'];
					$descripcion = $_POST['descripcion'];
					$proveedor = $_POST['proveedor'];
					$documento = $_POST['documento'];
					$monto = $_POST['monto'];

					$updated = $this->encargado->setItemCaja($id,$fecha,$centro_costo,$descripcion,$proveedor,$documento,$monto);

					if ($updated) {
						redirect('encargados/editar_caja/' . $num_caja);
					}
				}

				// click en form aprobacion
				if (isset($_POST['btn_revisar'])) {

					$observacion = $_POST['observacion'];
					$aprobacion = $_POST['aprobacion'];
					$num_caja = $_POST['num_caja'];
					$usuario = $_POST['usuario'];

					$revisado = $this->encargado->setCajaRevision($usuario, $num_caja, $observacion);
					$upCaja = $this->encargado->updateCajaStatus($usuario,$num_caja,$aprobacion);

					if ($revisado) {
						redirect('encargados/rep_mi_caja');
					}
				} 

				$revisorCaja = $this->getRevisorCaja(TIPO_REVISOR_CAJA);
				$revisorCaja = $revisorCaja->usuario;

				$caja = $this->encargado->getDetalleCaja($num_caja, $_SESSION['user_usuario']);
				$observ = $this->encargado->getObservacionesCaja($num_caja, $_SESSION['user_usuario']);
				$adjuntos = $this->encargado->getAdjuntosCaja($num_caja, $_SESSION['user_usuario']);
				
				$data = [
					'caja' => $caja,
					'adjuntos' => $adjuntos,
					'observ' => $observ,
					'revisorCaja' => $revisorCaja,
					'pagename' => ucwords(__FUNCTION__),
					'controller' => strtolower(get_called_class())
				];


				// echo "<pre>";
				// print_r( $num_caja);
				// die();

				$this->view('encargado/editar_caja', $data);
				
			} else {
				redirect('pages/login');
			}

		}

    public function sustentar1($tipo,$num_os) {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 
				if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
					$obs = $_POST['observaciones'];
					
					$this->encargado->saveCaja($num_os,$obs);

				redirect('encargados/index');

				} else {

					$controller = strtolower(get_called_class());
					$method = ucwords(__FUNCTION__);
					
					$data = [
						'tipo' => $tipo,
						'num_os' => $num_os,
						'pagename' => $method,
						'controller' => $controller
					];

					$this->view('encargado/sustentar', $data);
				}
			// end userLoggedIn
			} else {
				$this->view('pages/login');
			}

		}


		public function rep_mi_caja12() {
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
					'userOrdenes' => $userOrdenes,
				];

				$this->view('encargado/rep_mi_caja', $data);

			} else {
				$this->view('pages/login');
			}
		}



		public function getTotalCajasSede() {
			if ($_SESSION['user_sede'] == 'Peru') {
        return $this->encargado->getTotalCajasPe();
      } else {
        return $this->encargado->getTotalCajasCl();
      }
		}

    public function revisar_caja() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') { 

				$totalCajasSede = $this->getTotalCajasSede();
				
				$data = [
					'totalCajasSede' => $totalCajasSede,
					'pagename' => ucwords(__FUNCTION__),
					'controller' => strtolower(get_called_class())
				];


				// echo "<pre>";
				// print_r( $num_caja);
				// die();

				$this->view('encargado/revisar_caja', $data);
				
			} else {
				redirect('pages/login');
			}

		}


	}
?>