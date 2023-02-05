<?php 
    class Administrador extends Controller {
        private $admin;

        public function __construct() {
            $this->admin = $this->model('Admin');
        }

        public function index() {
            if (userLoggedIn() && $_SESSION['user_rol'] == 'Administrador') {

                $sede = $_SESSION['user_sede'];

                $minas = $this->admin->getMinas($sede);
                $data = [
                    'minas' => $minas
                ];
                
                $this->view('administrador/index', $data);
            } else {
                $this->view('pages/login');
            }            
        }

        public function historial() {
            $minas = $this->admin->getMinas();
            $data = [
                'minas' => $minas
            ];
            
            $this->view('administrador/historial', $data);
        }

        // public function crear() {
        //     $minas = $this->admin->getMinas();
        //     $data = [
        //         'minas' => $minas
        //     ];
            
        //     $this->view('administrador/historial', $data);
        // }


        public function crear($id = null) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $sede = $_SESSION['user_sede'];

                $centro = $_POST['centro_costo'];
                $categoria = $_POST['categoria'];

                echo $id . $centro . $categoria;

            } else {

                $sede = $_SESSION['user_sede'];

                $minas = $this->admin->getMinas($sede);
                if (is_null($id)) {
                    $centro_costo = '';
                    $categorias = '';
                } else {
                    $centro_costo = $this->admin->getMinaByID($id)->nombre;
                    $categorias = $this->admin->getCategorias($id);
                }
                
                $data = [
                    'id' => $id,
                    'centro_costo' => $centro_costo,
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