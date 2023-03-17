<?php 
	class Usuario {
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

		public function getOrdenesPe($user) {
			$this->db->query('SELECT *,DATE_FORMAT(creado, "%d-%b-%Y") AS creado FROM os_peru WHERE usuario = :user GROUP BY num_os');
			$this->db->bind(':user', $user);
			$ordenes = $this->db->getSet();
			return $ordenes;
		}

		public function getOrdenesCl($user) {
			$this->db->query('SELECT num_os,usuario,mina,proveedor,DATE_FORMAT(creado, "%d-%b-%Y") AS creado FROM os_chile WHERE usuario = :user  GROUP BY num_os');
			$this->db->bind(':user', $user);
			$ordenes = $this->db->getSet();
			return $ordenes;
		}

    public function getOrdenDataPe($num_os) {
      $this->db->query('SELECT * FROM os_peru WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getOrdenDataCl($num_os) {
      $this->db->query('SELECT * FROM os_chile WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
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

    public function getMinaCategPe($id,$tipo) {
    	$this->db->query('SELECT * FROM categ_peru WHERE mina_pe_id = :id AND tipo = :tipo');
      $this->db->bind(':id', $id);
    	$this->db->bind(':tipo', $tipo);
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
        $this->db->query('INSERT INTO os_chile (tipo,num_os,usuario,mina,categoria,item,cantidad,unidad,descripcion,proveedor,valor,estado) 
            VALUES (:tipo, :num_os, :usuario, :mina, :categoria, :item, :cantidad, :unidad, :descripcion, :proveedor, :valor, :estado)');
        $this->db->bind(':tipo', $row['tipo']);
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
        $this->db->bind(':valor', $row['valor']);

        $this->db->execute();
      }            
    }

    public function registrarOrdenPe($data) {
      foreach($data as $row) {
        $this->db->query('INSERT INTO os_peru (tipo,num_os,usuario,mina,categoria,item,cantidad,unidad,descripcion,proveedor,valor,estado) 
            VALUES (:tipo, :num_os, :usuario, :mina, :categoria, :item, :cantidad, :unidad, :descripcion, :proveedor, :valor, :estado)');
        $this->db->bind(':tipo', $row['tipo']);
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
        $this->db->bind(':valor', $row['valor']);

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



	}
?>