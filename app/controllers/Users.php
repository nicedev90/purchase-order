<?php 
	class Users extends Controller {	
		public function __construct() {
			$this->model = $this->model('User');
		}

		public function index() {
			if (isset($_SESSION['user_rol'])) {
				$userView = strtolower($_SESSION['user_rol']);
				$this->view($userView . '/index');
			} else {
				$this->view('pages/login');
			}
		}

		public function forgot() { 
			if (!isset($_SESSION['user_rol'])) {
				$this->view('pages/forgot');
			} else {
				$userView = strtolower($_SESSION['user_rol']);
				$this->view($userView . '/index');
			}
		}

		public function pending() {
			if (!isset($_SESSION['user_rol'])) {
				$this->view('pages/pending');
			} else {
				$userView = strtolower($_SESSION['user_rol']);
				$this->view($userView . '/index');
			}
		}

		
		public function sendMail() {


			$this->view('pages/enviado');
			// enviar el email
		}

		public function createSession($user) {
			$_SESSION['user_rol'] = $user->rol;
			$_SESSION['user_nombre'] = $user->nombre;
			$_SESSION['user_email'] = $user->email;
			$_SESSION['user_usuario'] = $user->usuario;

			if ($user->rol == 'Administrador') {
				redirect('administrador/index');
			}

			if ($user->rol == 'Encargado') {
				redirect('encargados/index');
			}

			if ($user->rol == 'Usuario') {
				redirect('usuarios/index');
			}
		}

		public function logout() {
			unset($_SESSION['user_rol']);
			unset($_SESSION['user_nombre']);
			unset($_SESSION['user_email']);
			unset($_SESSION['user_usuario']);

			session_destroy();
			redirect('users/login');
		}

	}
?>