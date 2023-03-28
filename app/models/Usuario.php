<?php 
	class Usuario {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

    // ************ BEGIN INDEX VIEW
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
      $this->db->query('SELECT o.num_os,o.tipo,o.usuario,o.estado,DATE_FORMAT(o.creado, "%d-%b-%Y") AS creado,m.nombre AS mina_nombre FROM os_peru o INNER JOIN minas_pe m ON o.mina = m.codigo WHERE usuario = :user GROUP BY creado DESC LIMIT 5');
      $this->db->bind(':user', $user);
      $ordenes = $this->db->getSet();
      return $ordenes;
    }

    public function getOrdenesCl($user) {
      $this->db->query('SELECT o.num_os,o.tipo,o.usuario,o.estado,DATE_FORMAT(o.creado, "%d-%b-%Y") AS creado,m.nombre AS mina_nombre FROM os_chile o INNER JOIN minas_cl m ON o.mina = m.codigo WHERE usuario = :user GROUP BY creado DESC LIMIT 5');
      $this->db->bind(':user', $user);
      $ordenes = $this->db->getSet();
      return $ordenes;
    }
    // ************ END INDEX VIEW
    // 
    // ************ BEGIN HISTORIAL VIEW
    public function getAllOrdenesUserPe($user) {
      $this->db->query('SELECT o.*,DATE_FORMAT(o.creado, "%d-%b-%Y") AS creado, m.nombre AS mina_nombre FROM os_peru o INNER JOIN minas_pe m ON o.mina = m.codigo WHERE usuario = :user GROUP BY creado DESC');
      $this->db->bind(':user', $user);
      $res = $this->db->getSet();
      return $res;
    }

    public function getAllOrdenesUserCl($user) {
      $this->db->query('SELECT o.*,DATE_FORMAT(o.creado, "%d-%b-%Y") AS creado, m.nombre AS mina_nombre FROM os_chile o INNER JOIN minas_cl m ON o.mina = m.codigo WHERE usuario = :user GROUP BY creado DESC');
      $this->db->bind(':user', $user);
      $res = $this->db->getSet();
      return $res;
    }
    // ************ END HISTORIAL VIEW
    // 
    // ************ BEGIN DETALLES VIEW
    public function getOrdenDataPe($num_os) {
      $this->db->query('SELECT o.*, 
        c.categoria AS name_categ, 
        m.nombre AS name_mina
        FROM os_peru o
        INNER JOIN  minas_pe m ON o.mina = m.codigo 
        INNER JOIN categ_peru c ON o.categoria = c.codigo
        WHERE o.num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getOrdenDataCl($num_os) {
      $this->db->query('SELECT o.*, 
        c.categoria AS name_categ, 
        m.nombre AS name_mina
        FROM os_chile o
        INNER JOIN  minas_cl m ON o.mina = m.codigo 
        INNER JOIN categ_chile c ON o.categoria = c.codigo
        WHERE o.num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getEnlacesPe($num_os) {
      $this->db->query('SELECT * FROM enlaces_pe WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getEnlacesCl($num_os) {
      $this->db->query('SELECT * FROM enlaces_cl WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getObsPe($num_os) {
      $this->db->query('SELECT * FROM obs_pe WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getObsCl($num_os) {
      $this->db->query('SELECT * FROM obs_cl WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getAdjuntosPe($num_os) {
      $this->db->query('SELECT * FROM adjuntos_pe WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getAdjuntosCl($num_os) {
      $this->db->query('SELECT * FROM adjuntos_cl WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }


    // ************ END DETALLES VIEW
    // 
    // ************ BEGIN CREAR ORDEN
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

    public function getMinaCategCl($id,$tipo) {
      $this->db->query('SELECT * FROM categ_chile WHERE mina_cl_id = :id AND tipo = :tipo');
      $this->db->bind(':id', $id);
      $this->db->bind(':tipo', $tipo);
      $res = $this->db->getSet();
      return $res;
    }

    public function setObsPe($num_os,$obs) {
      $this->db->query('INSERT INTO obs_pe (num_os, observaciones) VALUES (:num_os, :obs)');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':obs', $obs);
      $this->db->execute();
    }

    public function setObsCl($num_os,$obs) {
      $this->db->query('INSERT INTO obs_cl (num_os, observaciones) VALUES (:num_os, :obs)');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':obs', $obs);
      $this->db->execute();
    }

    public function setEnlacesPe($enlaces) {
      foreach($enlaces as $link) {
        $this->db->query('INSERT INTO enlaces_pe (num_os,enlace) VALUES (:num_os, :enlace)');
        $this->db->bind(':num_os', $link['num_os']);
        $this->db->bind(':enlace', $link['enlace']);
        $this->db->execute();
      }            
    }

    public function setEnlacesCl($enlaces) {
      foreach($enlaces as $row) {
        $this->db->query('INSERT INTO enlaces_cl (num_os,enlace) VALUES (:num_os, :enlace)');
        $this->db->bind(':num_os', $row['num_os']);
        $this->db->bind(':enlace', $row['enlace']);
        $this->db->execute();
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

    public function getNumeroCl() {
      $this->db->query('SELECT id,num_os FROM os_chile GROUP BY id DESC LIMIT 1');
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

    public function guardarAdjuntoCl($enlaces) {
      foreach($enlaces as $row) {
        $this->db->query('INSERT INTO adjuntos_cl (num_os, archivo)
          VALUES (:num_os, :archivo)');
        $this->db->bind(':num_os', $row['num_os']);
        $this->db->bind(':archivo', $row['archivo']);
        $this->db->execute();
      }
    }

    public function getSuperPe($sede,$tipo) {
      $this->db->query('SELECT funcion,nombre,email FROM supervisores WHERE sede = :sede AND tipo = :tipo');
      $this->db->bind(':sede', $sede);
      $this->db->bind(':tipo', $tipo);
      $res = $this->db->getSet();
      return $res;
    }

    public function getSuperCl($sede,$tipo) {
      $this->db->query('SELECT funcion,nombre,email FROM supervisores WHERE sede = :sede AND tipo = :tipo');
      $this->db->bind(':sede', $sede);
      $this->db->bind(':tipo', $tipo);
      $res = $this->db->getSet();
      return $res;
    }

    public function setRevisionPe($num_os,$tipo,$rev1,$rev2) {
      $this->db->query('INSERT INTO revision_pe (num_os, tipo, obs_1, aprob_1, revisor_1, obs_2, aprob_2, revisor_2)
        VALUES (:num_os, :tipo, :obs_1, :aprob_1, :rev1, :obs_2, :aprob_2, :rev2)');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':tipo', $tipo);
      $this->db->bind(':obs_1', '-');
      $this->db->bind(':aprob_1', '-');
      $this->db->bind(':rev1', $rev1);
      $this->db->bind(':obs_2', '-');
      $this->db->bind(':aprob_2', '-');
      $this->db->bind(':rev2', $rev2);
      $this->db->execute();
    }

    public function setRevisionCl($num_os,$tipo,$rev1,$rev2) {
      $this->db->query('INSERT INTO revision_cl (num_os, tipo, obs_1, aprob_1, revisor_1, obs_2, aprob_2, revisor_2)
        VALUES (:num_os, :tipo, :obs_1, :aprob_1, :rev1, :obs_2, :aprob_2, :rev2)');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':tipo', $tipo);
      $this->db->bind(':obs_1', '-');
      $this->db->bind(':aprob_1', '-');
      $this->db->bind(':rev1', $rev1);
      $this->db->bind(':obs_2', '-');
      $this->db->bind(':aprob_2', '-');
      $this->db->bind(':rev2', $rev2);
      $this->db->execute();
    }

    // ************ END CREAR ORDEN
    // 
    // ************ BEGIN EDITAR ORDEN
    public function updateEnlacePe($id,$enlace) {
      $this->db->query('UPDATE enlaces_pe SET enlace = :enlace  WHERE id = :id');
      $this->db->bind(':id', $id);
      $this->db->bind(':enlace', $enlace);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateEnlaceCl($id,$enlace) {
      $this->db->query('UPDATE enlaces_cl SET enlace = :enlace  WHERE id = :id');
      $this->db->bind(':id', $id);
      $this->db->bind(':enlace', $enlace);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateObsPe($id,$observ) {
      $this->db->query('UPDATE obs_pe SET observaciones = :observ  WHERE id = :id');
      $this->db->bind(':id', $id);
      $this->db->bind(':observ', $observ);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateObsCl($id,$observ) {
      $this->db->query('UPDATE obs_cl SET observaciones = :observ  WHERE id = :id');
      $this->db->bind(':id', $id);
      $this->db->bind(':observ', $observ);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function subirAdjuntoPe($num_os,$urlAdjunto) {
      $this->db->query('INSERT INTO adjuntos_pe (num_os, archivo) VALUES (:num_os, :urlAdjunto)');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':urlAdjunto', $urlAdjunto);
      $this->db->execute();
    }

    public function subirAdjuntoCl($num_os,$urlAdjunto) {
      $this->db->query('INSERT INTO adjuntos_cl (num_os, archivo) VALUES (:num_os, :urlAdjunto)');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':urlAdjunto', $urlAdjunto);
      $this->db->execute();
    }

    public function setItemPe($id,$cantidad,$unidad,$descripcion,$proveedor,$valor) {
      $this->db->query('UPDATE os_peru SET 
        cantidad = :cantidad,
        unidad = :unidad,
        descripcion = :descripcion,
        proveedor = :proveedor,
        valor = :valor 
        WHERE id = :id');
      $this->db->bind(':id', $id);
      $this->db->bind(':cantidad', $cantidad);
      $this->db->bind(':unidad', $unidad);
      $this->db->bind(':descripcion', $descripcion);
      $this->db->bind(':proveedor', $proveedor);
      $this->db->bind(':valor', $valor);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function setItemCl($id,$cantidad,$unidad,$descripcion,$proveedor,$valor) {
      $this->db->query('UPDATE os_chile SET 
        cantidad = :cantidad,
        unidad = :unidad,
        descripcion = :descripcion,
        proveedor = :proveedor,
        valor = :valor 
        WHERE id = :id');
      $this->db->bind(':id', $id);
      $this->db->bind(':cantidad', $cantidad);
      $this->db->bind(':unidad', $unidad);
      $this->db->bind(':descripcion', $descripcion);
      $this->db->bind(':proveedor', $proveedor);
      $this->db->bind(':valor', $valor);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    // ************ END EDITAR ORDEN
    // 
    // ********  BEGIN CREAR PDF
    public function getOrdenItemsPe($num_os) {
      $this->db->query('SELECT o.*, m.nombre AS nombre_mina, c.categoria AS categ, u.nombre AS nombre_user FROM os_peru o 
        INNER JOIN minas_pe m ON o.mina = m.codigo 
        INNER JOIN categ_peru c ON o.categoria = c.codigo
        INNER JOIN usuarios u ON o.usuario = u.usuario
        WHERE num_os = :num_os');
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

    public function getOrdenRevisionPe($num_os) {
      $this->db->query('SELECT * FROM revision_pe WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getOrdenEnlacesPe($num_os) {
      $this->db->query('SELECT * FROM enlaces_pe WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getOrdenObsPe($num_os) {
      $this->db->query('SELECT * FROM obs_pe WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getRevisionAreasPe($sede, $tipo) {
      $this->db->query('SELECT * FROM revision_areas WHERE sede = :sede AND tipo = :tipo');
      $this->db->bind(':sede', $sede);
      $this->db->bind(':tipo', $tipo);
      $res = $this->db->getSet();
      return $res;
    }

    public function getOrdenItemsCl($num_os) {
      $this->db->query('SELECT o.*, m.nombre AS nombre_mina, c.categoria AS categ, u.nombre AS nombre_user FROM os_chile o 
        INNER JOIN minas_cl m ON o.mina = m.codigo 
        INNER JOIN categ_chile c ON o.categoria = c.codigo
        INNER JOIN usuarios u ON o.usuario = u.usuario
        WHERE num_os = :num_os');
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

    public function getOrdenRevisionCl($num_os) {
      $this->db->query('SELECT * FROM revision_cl WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }


    // ********  END CREAR PDF
    // 
    // ********  BEGIN EDITAR USUARIO
    public function getDataUser($id) {
      $this->db->query('SELECT u.*, r.rol AS rol , s.sede AS sede FROM usuarios u 
        INNER JOIN roles r ON u.rol_id = r.id 
        INNER JOIN sedes s ON u.sede_id = s.id 
        WHERE u.id = :id');
      $this->db->bind(':id', $id);
      $res = $this->db->getSingle();
      return $res;
    }
    // ********  END EDITAR USUARIO


    public function getUserLog($usuario) {
      $this->db->query('SELECT * FROM logs WHERE usuario = :usuario');
      $this->db->bind(':usuario', $usuario);
      $res = $this->db->getSet();
      return $res;  
    }




	}
?>