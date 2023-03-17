<?php 
	class Encargados extends Controller {
		private $encargado;

		public function __construct() {
			$this->encargado = $this->model('Encargado');
		}

		public function index() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') {
				$user = $_SESSION['user_usuario'];

				$minas = $this->getMinas();
				$ordenes = $this->getOrdenes();
				$lastOrder = $this->getLastOrder();
				$num_os  = $lastOrder->num_os;
				$lastOrderData = $this->getOrdenData($num_os);
				// $userLastOrder = $this->getUserLastOrder($user);
		
				$data = [
					'minas' => $minas,
					'ordenes' => $ordenes,
					'lastOrder' => $lastOrder,
					'lastOrderData' => $lastOrderData
				];

				$this->view('encargado/index', $data);

			} else {
				$this->view('pages/login');
			}
		}

		public function edit_revision() {
			if (isset($_POST['btn_fondo'])) {
        	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        		$sede = $_SESSION['user_sede'];
        		$tipo = $_POST['tipo_fondo'];

        		$area_1 = $_POST['area_fondo_1'];
        		$area_2 = $_POST['area_fondo_2'];
        		$area_3 = $_POST['area_fondo_3'];

        	$this->encargado->updateRevFondos($sede,$tipo,$area_1,$area_2,$area_3);

        	redirect('encargados/edit_revision');
			}

			if (isset($_POST['btn_compra'])) {
        	$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        		$sede = $_SESSION['user_sede'];
        		$tipo = $_POST['tipo_compra'];

        		$area_1 = $_POST['area_compra_1'];
        		$area_2 = $_POST['area_compra_2'];

        	$this->encargado->updateRevCompras($sede,$tipo,$area_1,$area_2);

        	redirect('encargados/edit_revision');
			}


			$user = $_SESSION['user_usuario'];

			$sede = $_SESSION['user_sede'];

			$areas = $this->encargado->getRevAreas($sede);
	
			$data = [
				'areas' => $areas
			];

			$this->view('encargado/edit_revision', $data);
			
		}

		public function getOrdenData($num_os) {
			if ($_SESSION['user_sede'] == 'Peru') {
				// $ordenData = $this->encargado->getOrdenDataPe($num_os);
				$ordenData = $this->encargado->getOrdenItemsPe($num_os);

				return $ordenData;
			} else {
				$ordenData = $this->encargado->getOrdenItemsCl($num_os);
				return $ordenData;
			}
		}

		public function crear_pdf($num_os) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$items = $this->encargado->getOrdenItemsPe($num_os);
				$adjuntos = $this->encargado->getOrdenFilesPe($num_os);
				$revision = $this->encargado->getOrdenRevisionPe($num_os);
				
				$data = [
					'items' => $items,
					'adjuntos' => $adjuntos,
					'revision' => $revision
				];

				// echo "<pre>";
				// print_r($data);
				// die();


				$this->view('encargado/crear_pdf', $data);
			} else {
				$data = $this->encargado->getDataToPdfCl($num_os);
				$this->view('encargado/crear_pdf', $data);
			}
			
		}

		public function getLastOrder() {
			if ($_SESSION['user_sede'] == 'Peru') {
				$last = $this->encargado->getLastOrderPe();
				return $last;
			} else {
				$last = $this->encargado->getLastOrderCl();
				return $last;
			}
		}



		public function editar($num_os = null) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {

				$files = $this->getOrdenFiles($num_os);
				$items = $this->getOrdenItems($num_os);
				// $items = $items[1]->num_os;
				echo '<pre>';
				print_r($items);

				die('detenido');
				$data = [
					'files' => $files,
					'items' => $items,
					'num_os' => $num_os
				];

				$this->view('encargado/editar', $data);

			} else {

				

				if (is_null($num_os)) {
          $mina_nombre= '';
          $mina_codigo = '';

        } else {
          // obtener info de la orden 
          $files = $this->getOrdenFiles($num_os);
					$items = $this->getOrdenItems($num_os);
					// $items = $items[1]->num_os;
          // $mina = $this->getMinaById($num_os);
          // $mina_nombre = $items[1]->mina;
          $mina_codigo = $items[1]->mina;
          $mina_categ = $items[1]->categoria;
          $estado = $items[1]->estado;
        }

				// echo '<pre>';
				// print_r(count($items));

				// die('detenido');

				$data = [
          'id' => $id,
          'items' => $items,
          'mina_nombre' => $mina_nombre,
          'mina_codigo' => $mina_codigo,
          'mina_categ' => $mina_categ,
          'numero_os' => $num_os,
          'estado' => $estado
        ];

				$this->view('encargado/editar', $data);
			}
		}

		public function getOrdenFiles($num_os) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$files = $this->encargado->getOrdenFilesPe($num_os);
				return $files;
			} else {
				$files = $this->encargado->getOrdenFilesCl($num_os);
				return $files;
			}
		}

		public function getOrdenItems($num_os) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$orden = $this->encargado->getOrdenItemsPe($num_os);
				return $orden;
			} else {
				$orden = $this->encargado->getOrdenItemsCl($num_os);
				return $orden;
			}
		}

		public function crear($id = null) {
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

        if ($enviarData == 0) {
            // luego de guardado el form, volver a index
            $_SESSION['alerta'] = 'success';
            $_SESSION['mensaje'] = 'Se creó correctamente la orden';
            redirect('encargados/index');
        } else {
            die('Algo salió mal.');
        }

      } else {
      	// obtener numero de orden segun sede del Usuario
        $num_os = $this->getNumOrden();

        // obtener minas segun sede de usuario
        $minas = $this->getMinas();
				$ordenes = $this->getOrdenes();

        if (is_null($id)) {
          $mina_nombre= '';
          $mina_codigo = '';

        } else {
          // obtener info de mina y sus categorias
          $mina = $this->getMinaById($id);
          $mina_nombre = $mina->nombre;
          $mina_codigo = $mina->codigo;
          $mina_categ = $this->getMinaCateg($id);
        }
        
        $data = [
          'id' => $id,
          'minas' => $minas,
          'mina_nombre' => $mina_nombre,
          'mina_codigo' => $mina_codigo,
          'mina_categ' => $mina_categ,
          'numero_os' => $num_os,
          'ordenes' => $ordenes
        ];

        $this->view('encargado/crear', $data);
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

      	// $num = array('04','05');
      	// $enlaces = [
      	// 	'num_os' => '01',
      	// 	'archivo' => 'imagen'
      	// ];

      	// $data = [
      	// 	'archivo' => $enlaces
      	// ];
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

      	// $num = array('04','05');
      	// $enlaces = [
      	// 	'num_os' => '01',
      	// 	'archivo' => 'imagen'
      	// ];

      	// $data = [
      	// 	'archivo' => $enlaces
      	// ];
        $this->encargado->guardarAdjuntoCl($enlaces);
      }



      // tamaño maximo del archivo
      // $max_size = 5000000;
      // $file_types = array('image/jpeg','image/png');

  		// if (!empty($files) {

			// 	$img_name = $_FILES['imageUp']['name'];
			// 	$img_tmp = $_FILES['imageUp']['tmp_name'];
			// 	$img_type = $_FILES['imageUp']['type'];
			// 	$img_size = $_FILES['imageUp']['size'];
			// 	$img_dir = 'img/';

			// 	if ($img_size <= 1000000) {
			// 		if ($img_type=='image/jpeg' || $img_type=='image/jpg' || $img_type=='image/png' || $img_type=='image/gif') {
			// 			// move_uploaded_file($img_tmp, $img_dir . $img_name);

			// 			if (move_uploaded_file($img_tmp, $img_dir . $img_name)) {
			// 				$data['image'] = $img_name;
			// 			} else {
			// 				$data['image'] = '';
			// 			}

			// 		} else {
			// 			$data['image_err_type'] = 'no es una imagen';
			// 		}
			// 	} else {
			// 		$data['image_err_size'] = 'la imagen excede el tamaño';
			// 	}

				// if (move_uploaded_file($img_tmp, $img_dir . $img_name)) {
				// 	$data['image'] = $_FILES['imageUp']['name'];
				// } else {
				// 	$data['image'] = '';
				// }
	  }


	  public function getMinaCateg($id) {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$minaCateg = $this->encargado->getMinaCategPe($id);
				return $minaCateg;
			} else {
				$minaCateg = $this->encargado->getMinaCategCl($id);
				return $minaCateg;
			}
	  }

	  public function getMinaById($id) {
	  	if ($_SESSION['user_sede'] == 'Peru') {
				$minaId = $this->encargado->getMinaByIdPe($id);
				return $minaId;
			} else {
				$minaId = $this->encargado->getMinaByIdCl($id);
				return $minaId;
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

	  public function enviarOrden($data) {
      if ($_SESSION['user_sede'] == 'Peru') {
        $guardado = $this->encargado->registrarOrdenPe($data);

					$usuario = $data[1]['usuario'];
					$num_os = $data[1]['num_os'];
					$nombre = $_SESSION['user_nombre'];
					$mina = $data[1]['mina'];

					$this->sendBot($nombre,$num_os,$mina);
					$this->sendMail($nombre,$num_os,$mina);	

      } else {
        $guardado = $this->encargado->registrarOrdenCl($data);
				
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

    // funciones para Cards


	}
?>