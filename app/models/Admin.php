<?php 
    class Admin {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function getMinas($sede) {
            $this->db->query('SELECT * FROM minas WHERE pais = :sede');
            $this->db->bind(':sede', $sede);
            $minas = $this->db->getSet();
            return $minas;
        }

        public function getMinaById($id) {
            $this->db->query('SELECT * FROM minas WHERE id = :id');
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

        public function getNumeroCl() {
            $this->db->query('SELECT id,num_os FROM os_chile GROUP BY id DESC LIMIT 1');
            $res =  $this->db->getSingle();
            return $res;
        }

        public function getNumeroPe() {
            $this->db->query('SELECT id,num_os FROM os_peru GROUP BY id DESC LIMIT 1');
            $res =  $this->db->getSingle();
            return $res;
        }

        public function registrarOrdenCl($data) {
            foreach($data as $row) {
                $this->db->query('INSERT INTO os_chile (num_os,usuario,mina,categoria,item,cantidad,unidad,descripcion,proveedor) 
                    VALUES (:num_os, :usuario, :mina, :categoria, :item, :cantidad, :unidad, :descripcion, :proveedor)');
                $this->db->bind(':num_os', $row['num_os']);
                $this->db->bind(':usuario', $row['usuario']);
                $this->db->bind(':mina', $row['mina']);
                $this->db->bind(':categoria', $row['categoria']);
                $this->db->bind(':item', $row['item']);
                $this->db->bind(':cantidad', $row['cantidad']);
                $this->db->bind(':unidad', $row['unidad']);
                $this->db->bind(':descripcion', $row['descripcion']);
                $this->db->bind(':proveedor', $row['proveedor']);

                $this->db->execute();
            }            
        }

        public function registrarOrdenPe($data) {
            foreach($data as $row) {
                $this->db->query('INSERT INTO os_peru (num_os,usuario,mina,categoria,item,cantidad,unidad,descripcion,proveedor) 
                    VALUES (:num_os, :usuario, :mina, :categoria, :item, :cantidad, :unidad, :descripcion, :proveedor)');
                $this->db->bind(':num_os', $row['num_os']);
                $this->db->bind(':usuario', $row['usuario']);
                $this->db->bind(':mina', $row['mina']);
                $this->db->bind(':categoria', $row['categoria']);
                $this->db->bind(':item', $row['item']);
                $this->db->bind(':cantidad', $row['cantidad']);
                $this->db->bind(':unidad', $row['unidad']);
                $this->db->bind(':descripcion', $row['descripcion']);
                $this->db->bind(':proveedor', $row['proveedor']);

                $this->db->execute();
            }            
        }



    }
?>