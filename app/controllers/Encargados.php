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

        // get todas las minas que el user tiene acceso (SEDE)
        // $sede = $_SESSION['user_sede'];

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
        $numero = $numero->num_os;
        // $numero = intval($numero);
        $numero = $numero+1;
        return $numero;
      } else {
        $numero = $this->encargado->getNumeroCl();
        $numero = $numero->num_os;
        // $numero = intval($numero);
        $numero = $numero+1;
        return $numero;
      }
	  }

	  public function enviarOrden($data) {
      if ($_SESSION['user_sede'] == 'Peru') {
        $this->encargado->registrarOrdenPe($data);
      } else {
        $this->encargado->registrarOrdenCl($data);
      }
	  }


	}
?>