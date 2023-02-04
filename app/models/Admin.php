<?php 
    class Admin {
        private $db;

        public function __constructor() {
            $this->db = new Database;
        }

        public function getMinas() {
            $this->db->query('SELECT * FROM minas');
            $minas = $this->db->getSet();
            return $minas;
        }

        public function crearOrden() {
            $this->db->query('SELECT');
        }
    }
?>