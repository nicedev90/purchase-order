<?php 
	class Coordinador {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function getMinasPe() {
			$this->db->query('SELECT * FROM minas_pe');
			$minas = $this->db->getSet();
			return $minas;
		}

		public function getMinasCl() {
			$this->db->query('SELECT * FROM minas_cl');
			$minas = $this->db->getSet();
			return $minas;
		}


		public function getOrdenesPe() {
			$this->db->query('SELECT num_os,usuario,mina,descripcion,estado,proveedor,DATE_FORMAT(creado, "%d-%b-%Y") AS creado FROM os_peru ORDER BY num_os DESC LIMIT 5');
			$ordenes = $this->db->getSet();
			return $ordenes;
		}

		public function getOrdenesCl() {
			$this->db->query('SELECT num_os,usuario,mina,descripcion,estado,proveedor,DATE_FORMAT(creado, "%d-%b-%Y") AS creado FROM os_chile GROUP BY num_os DESC LIMIT 5');
			$ordenes = $this->db->getSet();
			return $ordenes;
		}

    public function getMinaByIdPe($id) {
      $this->db->query('SELECT * FROM minas_pe WHERE id = :id');
      $this->db->bind(':id', $id);

      $result = $this->db->getSingle();
      return $result;
    }

    public function getMinaByIdCl($id) {
      $this->db->query('SELECT * FROM minas_cl WHERE id = :id');
      $this->db->bind(':id', $id);

      $result = $this->db->getSingle();
      return $result;
    }

    public function getMinaCategPe($id) {
    	$this->db->query('SELECT * FROM categ_peru WHERE mina_pe_id = :id');
    	$this->db->bind(':id', $id);
    	$res = $this->db->getSet();
    	return $res;
    }

    public function getMinaCategCl($id) {
    	$this->db->query('SELECT * FROM categ_chile WHERE mina_cl_id = :id');
    	$this->db->bind(':id', $id);
    	$res = $this->db->getSet();
    	return $res;
    }

		public function getNumeroCl() {
      $this->db->query('SELECT id,num_os FROM os_chile GROUP BY id DESC LIMIT 1');
      $res =  $this->db->getSingle();
      if ($this->db->rows() > 0) {
      	return $res;
      } else {
      	return false;
      }
    }

    public function getNumeroPe() {
      $this->db->query('SELECT id,num_os FROM os_peru GROUP BY id DESC LIMIT 1');
      $res =  $this->db->getSingle();
      if ($this->db->rows() > 0) {
      	return $res;
      } else {
      	return false;
      }
    }

    public function registrarOrdenCl($data) {
      foreach($data as $row) {
        $this->db->query('INSERT INTO os_chile (num_os,usuario,mina,categoria,item,cantidad,unidad,descripcion,proveedor,estado) 
            VALUES (:num_os, :usuario, :mina, :categoria, :item, :cantidad, :unidad, :descripcion, :proveedor, :estado)');
        $this->db->bind(':num_os', $row['num_os']);
        $this->db->bind(':usuario', $row['usuario']);
        $this->db->bind(':mina', $row['mina']);
        $this->db->bind(':categoria', $row['categoria']);
        $this->db->bind(':item', $row['item']);
        $this->db->bind(':cantidad', $row['cantidad']);
        $this->db->bind(':unidad', $row['unidad']);
        $this->db->bind(':descripcion', $row['descripcion']);
        $this->db->bind(':proveedor', $row['proveedor']);
        $this->db->bind(':estado', $row['estado']);

        $this->db->execute();
      }            
    }

    public function registrarOrdenPe($data) {
      foreach($data as $row) {
        $this->db->query('INSERT INTO os_peru (num_os,usuario,mina,categoria,item,cantidad,unidad,descripcion,proveedor,estado) 
            VALUES (:num_os, :usuario, :mina, :categoria, :item, :cantidad, :unidad, :descripcion, :proveedor, :estado)');
        $this->db->bind(':num_os', $row['num_os']);
        $this->db->bind(':usuario', $row['usuario']);
        $this->db->bind(':mina', $row['mina']);
        $this->db->bind(':categoria', $row['categoria']);
        $this->db->bind(':item', $row['item']);
        $this->db->bind(':cantidad', $row['cantidad']);
        $this->db->bind(':unidad', $row['unidad']);
        $this->db->bind(':descripcion', $row['descripcion']);
        $this->db->bind(':proveedor', $row['proveedor']);
        $this->db->bind(':estado', $row['estado']);

        $this->db->execute();
      }            
    }

    public function guardarAdjuntoPe($enlaces) {
      foreach($enlaces as $row) {
        $this->db->query('INSERT INTO adjuntos_pe (num_os, archivo)
          VALUES (:num_os, :archivo)');
        $this->db->bind(':num_os', $row['num_os']);
        $this->db->bind(':archivo', $row['archivo']);

        $this->db->execute();
      }
    }

    public function guardarAdjuntoCl($enlaces) {
      foreach($enlaces as $row) {
        $this->db->query('INSERT INTO adjuntos_cl (num_os, archivo)
          VALUES (:num_os, :archivo)');
        $this->db->bind(':num_os', $row['num_os']);
        $this->db->bind(':archivo', $row['archivo']);

        $this->db->execute();
      }
    }

    public function getOrdenItemsPe($num_os) {
      $this->db->query('SELECT * FROM os_peru WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getOrdenItemsCl($num_os) {
      $this->db->query('SELECT * FROM os_chile WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getOrdenFilesPe($num_os) {
      $this->db->query('SELECT * FROM adjuntos_pe WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getOrdenFilesCl($num_os) {
      $this->db->query('SELECT * FROM adjuntos_cl WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }


        public function getRevAreas($sede) {
      $this->db->query('SELECT * FROM revision_areas WHERE sede = :sede');
      $this->db->bind(':sede', $sede);
      $res = $this->db->getSet();
      return $res;
    }


    public function updateRevFondos($sede,$tipo,$area_1,$area_2,$area_3) {
      $this->db->query('UPDATE revision_areas SET area_1 = :area_1, area_2 = :area_2, area_3 = :area_3 WHERE sede = :sede AND tipo = :tipo');
      $this->db->bind(':area_1', $area_1);
      $this->db->bind(':area_2', $area_2);
      $this->db->bind(':area_3', $area_3);
      $this->db->bind(':sede', $sede);
      $this->db->bind(':tipo', $tipo);
      

      $this->db->execute();
    }

    public function updateRevCompras($sede,$tipo,$area_1,$area_2) {
      $this->db->query('UPDATE revision_areas SET area_1 = :area_1, area_2 = :area_2 WHERE sede = :sede AND tipo = :tipo');
      $this->db->bind(':area_1', $area_1);
      $this->db->bind(':area_2', $area_2);
      $this->db->bind(':sede', $sede);
      $this->db->bind(':tipo', $tipo);

      $this->db->execute();
    }

    public function getRoles() {
      $this->db->query('SELECT * FROM roles');
      $roles = $this->db->getSet();
      return $roles;
    }

    public function addUser($rol_id,$sede_id,$funcion,$nombre,$usuario,$email,$password,$estado) {
      $this->db->query('INSERT INTO usuarios (rol_id,sede_id,funcion,nombre,usuario,email,password,estado)
       VALUES (:rol_id, :sede_id, :funcion, :nombre, :usuario, :email, :password, :estado)');

      $this->db->bind(':rol_id', $rol_id);
      $this->db->bind(':sede_id', $sede_id);
      $this->db->bind(':funcion', $funcion);
      $this->db->bind(':nombre', $nombre);
      $this->db->bind(':usuario', $usuario);
      $this->db->bind(':email', $email);
      $this->db->bind(':password', $password);
      $this->db->bind(':estado', $estado);

      $this->db->execute();
    }

    public function getAllUsers($sede) {
      $this->db->query('SELECT u.*, r.id AS rol_id, r.rol AS user_rol FROM usuarios u 
        INNER JOIN roles r ON u.rol_id = r.id
        WHERE sede_id = :sede AND rol_id IN (3,4)');
      $this->db->bind(':sede', $sede);
      $users = $this->db->getSet();
      return $users;
    }

    public function updateUser($user_id,$rol_id,$sede_id,$funcion,$nombre,$usuario,$email,$password,$estado) {
      $this->db->query('UPDATE usuarios SET rol_id = :rol_id, sede_id = :sede_id, funcion = :funcion, nombre = :nombre,
        usuario = :usuario, email = :email, password = :password, estado = :estado WHERE id = :user_id');
      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':rol_id', $rol_id);
      $this->db->bind(':sede_id', $sede_id);
      $this->db->bind(':funcion', $funcion);
      $this->db->bind(':nombre', $nombre);
      $this->db->bind(':usuario', $usuario);
      $this->db->bind(':email', $email);
      $this->db->bind(':password', $password);
      $this->db->bind(':estado', $estado);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }

    }



	}
?>