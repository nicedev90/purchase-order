<?php 
    class Administrador extends Controller {
        public function __construct() {
            $this->admin = $this->model('Admin');
        }

        public function index() {
            if (isset($_SESSION['user_rol'])) {
				$userView = strtolower($_SESSION['user_rol']);
                $minas = $this->admin->getMinas();

                $data = [
                    'minas' => $minas
                ];
				$this->view($userView . '/index', $data);
			} else {
				$this->view('pages/login');
			}
        }

        public function mostrarMinas() {
            $this->admin->getMinas();
        }

        public function crearOrden() {
            $this->admin->getMinas();
        }
    }
?>