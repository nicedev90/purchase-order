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
				$ordenes = $this->getOrdenes($user);

				$data = [
					'minas' => $minas,
					'ordenes' => $ordenes
				];

				$this->view('usuario/index', $data);
			} else {
				$this->view('pages/login');
			}
		}

		public function crear($id = null) {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$num_os = $this->getNumOrden();
				$data = $_POST['item'];

				$enviarData = $this->enviarOrden($data);

				if ($enviarData == 0) {
					$_SESSION['alerta'] = 'success';
					$_SESSION['mensaje'] = 'Se creó correctamente la orden';
					redirect('usuarios/index');
				} else {
					die('Algo salió mal.');
				}

			} else {
				// obtener numero de orden segun sede del usuario
				$num_os = $this->getNumOrden();

				// obtener minas segun sede de usuario
				$user = $_SESSION['user_usuario'];
				$minas = $this->getMinas();
				$ordenes = $this->getOrdenes($user);

				if (is_null($id)) {
					$mina_nombre = '';
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

				$this->view('usuario/crear', $data);				

			}
		}

		public function getMinaCateg($id) {
			if ($_SESSION['user_sede'] == 'Peru') {
				$minaCateg = $this->usuario->getMinaCategPe($id);
				return $minaCateg;
			} else {
				$minaCateg = $this->usuario->getMinaCategCl($id);
				return $minaCateg;
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
        $this->usuario->registrarOrdenPe($data);
      } else {
        $this->usuario->registrarOrdenCl($data);
      }
	  }


	}
?>