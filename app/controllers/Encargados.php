<?php 
	class Encargados extends Controller {
		private $encargado;

		public function __construct() {
			$this->encargado = $this->model('Encargado');
		}

		public function index() {
			if (userLoggedIn() && $_SESSION['user_rol'] == 'Encargado') {

				$minas = $this->getMinas();
				$ordenes = $this->getOrdenes();
		
				$data = [
					'minas' => $minas,
					'ordenes' => $ordenes
				];

				$this->view('encargado/index', $data);

			} else {
				$this->view('pages/login');
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
        	
        	

	        // echo  '<img src=' . URLROOT . '/files/' . $i_name . '>';
	        
	        // echo "<pre>";
					// print_r($files);
					// echo "</pre>";
	        
	        // die('detenido');

        // $adjunto = $_FILES['adjunto'][0];
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
        // $this->encargado->guardarAdjuntoPe($data);
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
				if ($guardado) {
					$usuario = $data[1]['usuario'];
					$num_os = $data[1]['num_os'];
					//$sede = $_SESSION['user_sede'];

					$this->sendBot($usuario,$num_os);
				}

      } else {
        $guardado = $this->encargado->registrarOrdenCl($data);
				
					$usuario = $data[1]['usuario'];
					$num_os = $data[1]['num_os'];
					$nombre = $_SESSION['user_nombre'];
					$mina = $data[1]['mina'];
					//$sede = $_SESSION['user_sede'];
					//print_r($data);
					//echo $data[1]['usuario'];
					//die('detenido');
					$this->sendBot($nombre,$num_os,$mina);

				
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
	}
?>