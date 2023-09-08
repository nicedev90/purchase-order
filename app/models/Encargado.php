<?php 
	class Encargado {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

    // ************ BEGIN INDEX VIEW
    public function readMinas($_table) {

      if ($_table) { 
        $stmt = 'SELECT * FROM ' . $_table;
      } 

      $this->db->query($stmt);
      $minas = $this->db->getSet();
      return $minas;
    }


    public function readOrdenesByUser($user, $sede_table, $alias_table, $_group, $_order, $_limit = null) {

      if ($sede_table) {

        if ($sede_table == 'os_peru') {
          $minas_table = 'minas_pe';
          $revision_table = 'revision_pe';

        } else {
          $minas_table = 'minas_cl';
          $revision_table = 'revision_cl';

        }

        if ($_group) {
          $group = ' GROUP BY ' . $alias_table . '.' . $_group;
        } else {
          $group = '';
        }

        if ($_order != 'DESC' && $_order != 'ASC') {
          $order = ' ORDER BY ' . $alias_table . '.' . $_order;
        } else {
          $order = ' ' . $_order . ' ';
        }

        if ($_limit) {
          $limit = ' LIMIT ' . $_limit;
        } else {
          $limit = '';
        }

        $stmt = 'SELECT o.num_os, o.tipo, o.usuario, o.estado, DATE_FORMAT(o.creado, "%d-%b-%Y") AS creado, m.nombre AS mina_nombre, rev.aprob_1 AS rev, u.nombre AS nombre_usuario';
        $stmt .= ' FROM ' . $sede_table . ' ' . $alias_table;
        $stmt .= ' INNER JOIN ' . $minas_table . ' m ON o.mina = m.codigo ';
        $stmt .= ' INNER JOIN ' . $revision_table . ' rev ON o.num_os = rev.num_os ';
        $stmt .= ' INNER JOIN usuarios u ON o.usuario = u.usuario ';
        $stmt .= ' WHERE o.usuario = :user ';
        $stmt .= $group . $order . $limit; ;

      } 

      $this->db->query($stmt);

      $this->db->bind(':user', $user);
      $ordenes = $this->db->getSet();
      return $ordenes;
    }


    // ************ END INDEX VIEW
    // 
    // ************ BEGIN HISTORIAL VIEW
    public function readOrdenesBySede($sede_table, $alias_table, $_where, $_group, $_order, $_limit) {

        if ($sede_table == 'os_peru') {
          $minas_table = 'minas_pe';
          $revision_table = 'revision_pe';
        } else {
          $minas_table = 'minas_cl';
          $revision_table = 'revision_cl';
        }

        if ($_where != 'All') {
          $where = ' WHERE ' . $alias_table . '.estado = :_where ';
        } else {
          $where = null;
        }

        if ($_group) {
          $group = ' GROUP BY ' . $alias_table . '.' . $_group;
        } else {
          $group = '';
        }

        if ($_order != 'DESC' && $_order != 'ASC') {
          $order = ' ORDER BY ' . $alias_table . '.' . $_order;
        } else {
          $order = ' ' . $_order . ' ';
        }

        if ($_limit) {
          $limit = ' LIMIT ' . $_limit;
        } else {
          $limit = '';
        }

      $stmt = 'SELECT o.num_os, o.tipo, o.usuario, o.estado, DATE_FORMAT(o.creado, "%d-%b-%Y") AS creado, m.nombre AS mina_nombre, rev.aprob_1 AS rev, u.nombre AS nombre_usuario ';
      $stmt .= ' FROM ' . $sede_table . ' ' . $alias_table;
      $stmt .= ' INNER JOIN ' . $minas_table . ' m ON o.mina = m.codigo ';
      $stmt .= ' INNER JOIN ' . $revision_table . ' rev ON o.num_os = rev.num_os ';
      $stmt .= ' INNER JOIN usuarios u ON o.usuario = u.usuario ';
      $stmt .= $where . $group . $order . $limit;
    
      $this->db->query($stmt);

      if ( !is_null($where) ) {
        $this->db->bind(':_where', $_where);
      }

      $result = $this->db->getSet();
      return $result;
    }


    public function readCountOrdenesBySede($sede_table, $_where) {
 
        if ($_where != 'All') {
          $where = ' WHERE estado = :_where ';
        } else {
          $where = null;
        }

      $stmt = 'SELECT COUNT(DISTINCT num_os) AS total ';
      $stmt .= ' FROM ' . $sede_table;
      $stmt .= $where ;

      $this->db->query($stmt);

      if ( !is_null($where) ) {
        $this->db->bind(':_where', $_where);
      }

      $result = $this->db->getSingle();
      return $result->total;
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

    public function getUnidadesSede($sede) {
      $this->db->query('SELECT * FROM unidades WHERE sede = :sede');
      $this->db->bind(':sede', $sede);
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

    public function getRevisoresPe($num_os) {
      $this->db->query('SELECT revisor_1, aprob_1, revisor_2, aprob_2 FROM revision_pe WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSingle();
      return $res;
    }

    public function getRevisoresCl($num_os) {
      $this->db->query('SELECT revisor_1, aprob_1, revisor_2, aprob_2 FROM revision_cl WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSingle();
      return $res;
    }



    public function setRevision1Pe($num_os,$observacion,$aprobacion) {
      $this->db->query('UPDATE revision_pe SET obs_1 = :observacion, aprob_1 = :aprobacion, fecha_aprob_1 = NOW()  WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':observacion', $observacion);
      $this->db->bind(':aprobacion', $aprobacion);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function setRevision2Pe($num_os,$observacion,$aprobacion) {
      $this->db->query('UPDATE revision_pe SET obs_2 = :observacion, aprob_2 = :aprobacion, fecha_aprob_2 = NOW()  WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':observacion', $observacion);
      $this->db->bind(':aprobacion', $aprobacion);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function setRevision1Cl($num_os,$observacion,$aprobacion) {
      $this->db->query('UPDATE revision_cl SET obs_1 = :observacion, aprob_1 = :aprobacion, fecha_aprob_1 = NOW()  WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':observacion', $observacion);
      $this->db->bind(':aprobacion', $aprobacion);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function setRevision2Cl($num_os,$observacion,$aprobacion) {
      $this->db->query('UPDATE revision_cl SET obs_2 = :observacion, aprob_2 = :aprobacion, fecha_aprob_2 = NOW()  WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':observacion', $observacion);
      $this->db->bind(':aprobacion', $aprobacion);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateOrdenStatusPe($num_os,$status) {
      $this->db->query('UPDATE os_peru SET estado = :status, actualizado = NOW() WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':status', $status);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateOrdenStatusCl($num_os,$status) {
      $this->db->query('UPDATE os_chile SET estado = :status, actualizado = NOW() WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $this->db->bind(':status', $status);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }



    // ************ END EDITAR ORDEN
    // 
    // ********  BEGIN CREAR PDF
    // Funciones para SEDE PERU
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

    // Funciones para SEDE CHILE
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

    public function getOrdenEnlacesCl($num_os) {
      $this->db->query('SELECT * FROM enlaces_cl WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getOrdenObsCl($num_os) {
      $this->db->query('SELECT * FROM obs_cl WHERE num_os = :num_os');
      $this->db->bind(':num_os', $num_os);
      $res = $this->db->getSet();
      return $res;
    }

    public function getRevisionAreasCl($sede, $tipo) {
      $this->db->query('SELECT * FROM revision_areas WHERE sede = :sede AND tipo = :tipo');
      $this->db->bind(':sede', $sede);
      $this->db->bind(':tipo', $tipo);
      $res = $this->db->getSet();
      return $res;
    }


    // ********  END CREAR PDF
    // 



    // ********  BEGIN GENERAR REPORTE MINA
    public function getReporteMinaPe($tipo,$mina,$mes) {
      $this->db->query('SELECT o.*, m.nombre AS mina_nom, SUM(o.valor) AS valor_total, c.categoria AS categ_nom FROM os_peru o 
        INNER JOIN minas_pe m ON o.mina = m.codigo 
        INNER JOIN categ_peru c ON o.categoria = c.codigo
        WHERE o.mina = :mina AND o.tipo = :tipo AND MONTH(o.actualizado) = :mes GROUP BY o.num_os ORDER BY o.actualizado DESC');
      $this->db->bind(':mina', $mina);
      $this->db->bind(':tipo', $tipo);
      $this->db->bind(':mes', $mes);
      $res = $this->db->getSet();
      return $res;
    }

    public function getReporteMinaCl($tipo,$mina,$mes) {
      $this->db->query('SELECT o.*, m.nombre AS mina_nom, SUM(o.valor) AS valor_total, c.categoria AS categ_nom FROM os_chile o 
        INNER JOIN minas_cl m ON o.mina = m.codigo 
        INNER JOIN categ_chile c ON o.categoria = c.codigo
        WHERE o.mina = :mina AND o.tipo = :tipo AND MONTH(o.actualizado) = :mes GROUP BY o.num_os ORDER BY o.actualizado DESC');
      $this->db->bind(':mina', $mina);
      $this->db->bind(':tipo', $tipo);
      $this->db->bind(':mes', $mes);
      $res = $this->db->getSet();
      return $res;
    }
    // ********  END GENERAR REPORTE MINA


    public function getAllUsers($sede) {
      $this->db->query('SELECT u.*, r.id AS rol_id, r.rol AS user_rol FROM usuarios u 
        INNER JOIN roles r ON u.rol_id = r.id
        WHERE sede_id = :sede AND rol_id IN (3,4)');
      $this->db->bind(':sede', $sede);
      $users = $this->db->getSet();
      return $users;
    }


    public function getReporteUserPe($user,$mes) {
      $this->db->query('SELECT o.*, m.nombre AS mina_nom, SUM(o.valor) AS valor_total, c.categoria AS categ_nom, u.nombre AS nombre_user FROM os_peru o 
        INNER JOIN minas_pe m ON o.mina = m.codigo 
        INNER JOIN categ_peru c ON o.categoria = c.codigo
        INNER JOIN usuarios u ON o.usuario = u.usuario
        WHERE o.usuario = :user AND MONTH(o.actualizado) = :mes 
        GROUP BY o.num_os ORDER BY o.actualizado DESC');
      $this->db->bind(':user', $user);
      $this->db->bind(':mes', $mes);
      $res = $this->db->getSet();
      return $res;
    }


    public function getReporteCaja($mina,$mes) {
      $this->db->query('SELECT * FROM caja_chica 
        WHERE centro_costo = :mina AND MONTH(fecha) = :mes ');
      $this->db->bind(':mina', $mina);
      $this->db->bind(':mes', $mes);
      $res = $this->db->getSet();
      return $res;
    }


    public function registrarCaja($data) {
      foreach($data as $row) {
        $this->db->query('INSERT INTO caja_chica (usuario,item,num_caja,fecha,centro_costo,descripcion,proveedor,documento,monto) 
            VALUES (:usuario, :item, :num_caja, :fecha, :centro_costo, :descripcion, :proveedor, :documento, :monto)');
        $this->db->bind(':usuario', $row['usuario']);
        $this->db->bind(':item', $row['item']);
        $this->db->bind(':num_caja', $row['num_caja']);
        $this->db->bind(':fecha', $row['fecha']);
        $this->db->bind(':centro_costo', $row['centro_costo']);
        $this->db->bind(':descripcion', $row['descripcion']);
        $this->db->bind(':proveedor', $row['proveedor']);
        $this->db->bind(':documento', $row['documento']);
        $this->db->bind(':monto', $row['monto']);
        $this->db->execute();
      }            
    }

    public function registrarCajaObs($usuario, $num_caja, $obs) {
      $this->db->query('INSERT INTO caja_chica_obs (usuario, num_caja, observaciones) VALUES (:usuario, :num_caja, :obs)');
      $this->db->bind(':usuario', $usuario);
      $this->db->bind(':num_caja', $num_caja);
      $this->db->bind(':obs', $obs);
      $this->db->execute();
    }

    public function registrarCajaAdjuntos($enlaces) {
      foreach($enlaces as $row) {
        $this->db->query('INSERT INTO caja_chica_adj (usuario, num_caja, archivo) VALUES (:usuario, :num_caja, :archivo)');
        $this->db->bind(':usuario', $row['usuario']);
        $this->db->bind(':num_caja', $row['num_caja']);
        $this->db->bind(':archivo', $row['archivo']);
        $this->db->execute();
      }
    }


    public function getTotalCajas($user) {
      $this->db->query('SELECT c.usuario,c.num_caja,SUM(c.monto) as total, c.estado, DATE_FORMAT(c.creado, "%d-%b-%Y") AS creado, u.nombre, u.codigo FROM caja_chica c INNER JOIN usuarios u ON u.usuario = c.usuario WHERE c.usuario = :user GROUP BY creado');
      $this->db->bind(':user', $user);
      $totalCajas = $this->db->getSet();
      return $totalCajas;
    }

    public function getDetalleCaja($num_caja, $user) {
      $this->db->query('SELECT c.*,u.nombre, u.codigo  FROM caja_chica c INNER JOIN usuarios u ON u.usuario = c.usuario WHERE c.usuario = :user AND c.num_caja = :num_caja');
      $this->db->bind(':num_caja', $num_caja);
      $this->db->bind(':user', $user);
      $caja = $this->db->getSet();
      return $caja;
    }

    public function getObservacionesCaja($num_caja, $usuario) {
      $this->db->query('SELECT * FROM caja_chica_obs WHERE num_caja = :num_caja AND usuario = :usuario');
      $this->db->bind(':usuario', $usuario);
      $this->db->bind(':num_caja', $num_caja);
      $obs = $this->db->getSet();
      return $obs;
    }

    public function getAdjuntosCaja($num_caja, $usuario) {
      $this->db->query('SELECT * FROM caja_chica_adj WHERE num_caja = :num_caja AND usuario = :usuario');
      $this->db->bind(':usuario', $usuario);
      $this->db->bind(':num_caja', $num_caja);
      $adjuntos = $this->db->getSet();
      return $adjuntos;
    }

    public function getSaldoCaja($usuario) {
      $this->db->query('SELECT saldo FROM saldos_pe WHERE usuario = :usuario');
      $this->db->bind(':usuario', $usuario);
      $saldo = $this->db->getSingle();
      return $saldo->saldo;
    }

    public function readRevisorCaja($tipo) {
      $this->db->query('SELECT usuario FROM supervisores WHERE tipo = :tipo');
      $this->db->bind(':tipo', $tipo);
      $revisor = $this->db->getSingle();
      return $revisor->usuario;
    }

    public function getNumCaja($usuario) {
      $this->db->query('SELECT MAX(num_caja) AS numero from caja_chica WHERE usuario = :usuario');
      $this->db->bind(':usuario', $usuario);
      $num = $this->db->getSingle();

      if (is_null($num->numero)) {
        $num = 1 ;
      } else {
        $num = $num->numero +1 ;
      }

      return $num;
    }


    public function setItemCaja($id,$fecha,$centro_costo,$descripcion,$proveedor,$documento,$monto) {
      $this->db->query('UPDATE caja_chica SET fecha = :fecha,
        centro_costo = :centro_costo,
        descripcion = :descripcion,
        proveedor = :proveedor,
        documento = :documento,
        monto = :monto 
        WHERE id = :id');
      
      $this->db->bind(':fecha', $fecha);
      $this->db->bind(':centro_costo', $centro_costo);
      $this->db->bind(':descripcion', $descripcion);
      $this->db->bind(':proveedor', $proveedor);
      $this->db->bind(':documento', $documento);
      $this->db->bind(':monto', $monto);
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }

    }


    public function updateCajaStatus($usuario, $num_caja, $aprobacion) {
      $this->db->query('UPDATE caja_chica SET estado = :aprobacion  WHERE num_caja = :num_caja AND usuario = :usuario');

      $this->db->bind(':aprobacion', $aprobacion);
      $this->db->bind(':usuario', $usuario);
      $this->db->bind(':num_caja', $num_caja);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }

    }

    public function setCajaRevision($usuario, $num_caja, $observacion) {
      $this->db->query('INSERT INTO caja_chica_rev (num_caja, usuario, observacion) VALUES (:num_caja, :usuario, :observacion)');

      $this->db->bind(':observacion', $observacion);
      $this->db->bind(':usuario', $usuario);
      $this->db->bind(':num_caja', $num_caja);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }


    public function getTotalCajasPe() {
      $this->db->query('SELECT c.usuario,c.num_caja,SUM(c.monto) as total, c.estado, DATE_FORMAT(c.creado, "%d-%b-%Y") AS creado, u.nombre, u.codigo FROM caja_chica c INNER JOIN usuarios u ON u.usuario = c.usuario GROUP BY creado');
      $cajas = $this->db->getSet();
      return $cajas;
    }

	}
?>
