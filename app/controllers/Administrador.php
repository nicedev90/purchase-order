<?php 
    class Administrador extends Controller {
        public function __construct() {
            if (!userLoggedIn()) {
                redirect('users/login');
            }

            $this->admin = $this->model('Admin');
        }

        public function index() {
            $minas = $this->admin->getMinas();
            $data = [
                'minas' => $minas
            ];
			
            $this->view('administrador/index', $data);
        }

        public function crear($id) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $centro = $_POST['centro_costo'];
                $categoria = $_POST['categoria'];
                echo $id . $centro . $categoria;
            } else {

                $minas = $this->admin->getMinas();
                $cc = $this->admin->getMinaByID($id)->nombre;
                $categorias = $this->admin->getCategorias($id);
                // $centro = $cc->nombre;

                $data = [
                    'id' => $id,
                    'centro_costo' => $cc,
                    'minas' => $minas,
                    'categorias' => $categorias
                ];
                $this->view('administrador/crear', $data);
                
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