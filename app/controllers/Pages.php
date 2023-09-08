<?php 
	class Pages extends Controller {	
		private $page;

		public function __construct() {
			$this->page = $this->model('Page');
		}

		public function index() {
			if (isset($_SESSION['user_rol'])) {
				$userView = strtolower($_SESSION['user_rol']);
				$this->view($userView . '/index');
			} else {
				
				$data = [
					'controller' => strtolower(get_called_class()),
					'pagename' => ucwords(__FUNCTION__)
				];

				$this->view('pages/login', $data);
			}
		}

		public function login() {
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

				$usuario = $_POST['usuario'];
				$password = $_POST['password'];
				$error = [];

				if (empty($usuario)) {
					array_push($error, 'Debe ingresar un usuario.');
				}

				if (empty($password)) {
					array_push($error, 'Debe ingresar contraseña.');
				}

				$usuario_existe = $this->page->findUser($usuario);

				if (empty($error) && $usuario_existe) {
					$userLogged = $this->page->login($usuario, $password);
					$status = $this->loginStatus($userLogged);

					if ($userLogged) {
						$userActivo = $userLogged->estado;

						if ($userActivo == "Activo") {
							$this->createSession($userLogged);
							$this->page->guardarLog($usuario,$password,$status);
						} else {
							// redirigir a login.php : Usuario no esta activo
							$_SESSION['alerta'] = 'danger';
							$_SESSION['mensaje'] = 'Usuario no esta Activo.';
							redirect('pages/login');
						}

					} else {
						// redirigir a login.php : Contrasela incorrecta
						$_SESSION['alerta'] = 'warning';
						$_SESSION['mensaje'] = 'Contraseña Incorrecta';
						$this->page->guardarLog($usuario,$password,$status);
						redirect('pages/login');
					}
					
				} else {
					// redirigir a login.php : Usuario no registrado
					$_SESSION['alerta'] = 'danger';
					$_SESSION['mensaje'] = 'Usuario no registrado';
					redirect('pages/login');
				}

			} else {
				// cargar la vista login.php si no se ha enviado el FORM
				$data = [
					'controller' => strtolower(get_called_class()),
					'pagename' => ucwords(__FUNCTION__)
				];

				$this->view('pages/login', $data);
			}

		}

		public function loginStatus($user) {
			if ($user) {
				return "Exitoso";
			} else {
				return "Fallido";
			}
		}

		public function registrar() {

			$destinatario = 'jtunoquesa@unprg.edu.pe';
			//correo que se le envia al destinatario
			$nombre = $_POST['nombre'];
			$email = $_POST['email'];
			$password = $_POST['password'];
	
			$header = "--- usuario: ". $nombre."\n --- email: ". $email. "\n --- password:" .$password;
			$mensajeCompleto =  "\n Solicito crear mi cuenta: " . $email;
	
	
			mail($destinatario,$mensajeCompleto,$header);
			$this->view('pages/enviado');
			// enviar el email
		}

		public function createSession($user) {
			$_SESSION['user_id'] = $user->id;
			$_SESSION['user_rol'] = $user->rol;
			$_SESSION['user_rol_id'] = $user->rol_id;
			$_SESSION['user_codigo'] = $user->codigo;
			$_SESSION['user_nombre'] = $user->nombre;
			$_SESSION['user_email'] = $user->email;
			$_SESSION['user_usuario'] = $user->usuario;
			$_SESSION['user_sede'] = $user->sede;
			$_SESSION['user_sede_id'] = $user->sede_id;

			if ($user->rol == 'Administrador') {
				redirect('administrador/index');
			}

			if ($user->rol == 'Coordinador') {
				redirect('coordinadores/index');
			}

			if ($user->rol == 'Encargado') {
				redirect('encargados/index');
			}

			if ($user->rol == 'Usuario') {
				redirect('usuarios/index');
			}
		}

		public function logout() {
			unset($_SESSION['user_id']);
			unset($_SESSION['user_rol']);
			unset($_SESSION['user_rol_id']);
			unset($_SESSION['user_codigo']);
			unset($_SESSION['user_nombre']);
			unset($_SESSION['user_email']);
			unset($_SESSION['user_usuario']);
			unset($_SESSION['user_sede']);
			unset($_SESSION['user_sede_id']);

			session_destroy();
			redirect('pages/login');
		}

	}
?>