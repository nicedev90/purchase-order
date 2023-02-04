<?php 
    class Admin {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getMinas() {
            $this->db->query('SELECT * FROM minas');
            $minas = $this->db->getSet();
            return $minas;
        }

        public function getMinaById($id) {
            $this->db->query('SELECT nombre FROM minas WHERE id = :id');
            $this->db->bind(':id', $id);

            $result = $this->db->getSingle();
            return $result;
        }

        public function getCategorias($id) {
            $this->db->query('SELECT * FROM categorias WHERE mina_id = :id');
            $this->db->bind(':id', $id);
            $result = $this->db->getSet();
            return $result;
        }

    }
?>