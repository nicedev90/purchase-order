<?php 
    class Administrador extends Controller {
        public function __construct() {
            $this->admin = $this->model('Admin');
        }

        public function index() {
            if (isset($_SESSION['user_rol'])) {
				$userView = strtolower($_SESSION['user_rol']);
				$this->view($userView . '/index');
			} else {
				$this->view('pages/login');
			}
        }
    }
?>