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
                    redirect('administrador/index');
                } else {
                    die('Algo salió mal.');
                }

            } else {
                $num_os = $this->getNumOrden();
                // get todas las minas que el user tiene acceso (SEDE)
                $sede = $_SESSION['user_sede'];
                $minas = $this->admin->getMinas($sede);
                if (is_null($id)) {
                    $mina_nombre= '';
                    $mina_codigo = '';

                } else {
                    // get nombre de la mina y sus categorias
                    $mina = $this->admin->getMinaById($id);
                    $mina_nombre = $mina->nombre;
                    $mina_codigo = $mina->codigo;
                    $mina_categ = $this->admin->getCategorias($id);
                }
                
                $data = [
                    'id' => $id,
                    'minas' => $minas,
                    'mina_nombre' => $mina_nombre,
                    'mina_codigo' => $mina_codigo,
                    'mina_categ' => $mina_categ,
                    'numero_os' => $num_os
                ];

                $this->view('administrador/crear', $data);
            }
        }

        public function getNumOrden() {
            if ($_SESSION['user_sede'] == 'Peru') {
                $numero = $this->admin->getNumeroPe();
                $numero = $numero->num_os;
                // $numero = intval($numero);
                $numero = $numero+1;
                return $numero;
            } else {
                $numero = $this->admin->getNumeroCl();
                $numero = $numero->num_os;
                // $numero = intval($numero);
                $numero = $numero+1;
                return $numero;
            }
        }

        public function enviarOrden($data) {
            if ($_SESSION['user_sede'] == 'Peru') {
                $this->admin->registrarOrdenPe($data);
            } else {
                $this->admin->registrarOrdenCl($data);
            }
        }
    }
?>