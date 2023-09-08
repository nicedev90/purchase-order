<?php 
	class Coordinador {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

    // ************** BEGIN INDEX VIEW
    public function getAllUsers($sede) {
      $this->db->query('SELECT u.*, r.id AS rol_id, r.rol AS user_rol FROM usuarios u 
        INNER JOIN roles r ON u.rol_id = r.id
        WHERE sede_id = :sede AND rol_id IN (3,4)');
      $this->db->bind(':sede', $sede);
      $users = $this->db->getSet();
      return $users;
    }

    public function getSupervSede($sede) {
      $this->db->query('SELECT * FROM supervisores WHERE sede = :sede');
      $this->db->bind(':sede', $sede);
      $superv = $this->db->getSet();
      return $superv;
    }

    public function getRoles() {
      $this->db->query('SELECT * FROM roles');
      $roles = $this->db->getSet();
      return $roles;
    }
    // ************ END INDEX VIEW
    //
    // ************ BEGIN EDITAR AREAS SUPERVISORES
    public function updateRevFondos($sede,$tipo,$area_1,$area_2) {
      $this->db->query('UPDATE revision_areas SET area_1 = :area_1, area_2 = :area_2 WHERE sede = :sede AND tipo = :tipo');
      $this->db->bind(':area_1', $area_1);
      $this->db->bind(':area_2', $area_2);
      $this->db->bind(':sede', $sede);
      $this->db->bind(':tipo', $tipo);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateRevCompras($sede,$tipo,$area_1,$area_2) {
      $this->db->query('UPDATE revision_areas SET area_1 = :area_1, area_2 = :area_2 WHERE sede = :sede AND tipo = :tipo');
      $this->db->bind(':area_1', $area_1);
      $this->db->bind(':area_2', $area_2);
      $this->db->bind(':sede', $sede);
      $this->db->bind(':tipo', $tipo);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function getRevAreas($sede) {
      $this->db->query('SELECT * FROM revision_areas WHERE sede = :sede');
      $this->db->bind(':sede', $sede);
      $res = $this->db->getSet();
      return $res;
    }
    // ************ END EDITAR AREAS SUPERVISORES
    // 
    // ************ BEGIN  EDITAR USUARIO
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

    public function deleteUser($user_id) {
      $this->db->query('DELETE FROM usuarios WHERE id = :user_id');
      $this->db->bind(':user_id', $user_id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    // ************ END EDITAR USUARIO
    // 
    // ************ BEGIN  AGREGAR USUARIO
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

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    // ************ END AGREGAR USUARIO
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
    // 
    // ********  BEGIN EDITAR MI PERFIL DE USUARIO
    public function updateProfile($user_id,$nombre) {
      $this->db->query('UPDATE usuarios SET nombre = :nombre WHERE id = :user_id');
      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':nombre', $nombre);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function updateUserPassword($user_id, $password) {
      $this->db->query('UPDATE usuarios SET password = :password WHERE id = :user_id');
      $this->db->bind(':user_id', $user_id);
      $this->db->bind(':password', $password);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
    // ********  END EDITAR MI PERFIL DE USUARIO

    // 
    // ********  BEGIN AGREGAR EDITAR UNIDADES
    public function getUserLog($usuario) {
      $this->db->query('SELECT * FROM logs WHERE usuario = :usuario ORDER BY fecha DESC');
      $this->db->bind(':usuario', $usuario);
      $res = $this->db->getSet();
      return $res;  
    }

    public function getUnidadesSede($sede) {
      $this->db->query('SELECT * FROM unidades WHERE sede = :sede');
      $this->db->bind(':sede', $sede);
      $res = $this->db->getSet();
      return $res;
    }

    public function addUnidad($sede,$unidad) {
      $this->db->query('INSERT INTO unidades (sede, unidad) VALUES (:sede, :unidad)');

      $this->db->bind(':sede', $sede);
      $this->db->bind(':unidad', $unidad);

      $this->db->execute();
    }

    public function deleteUnidad($id) {
      $this->db->query('DELETE FROM unidades WHERE id = :id');
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
    // ********  END EDITAR UNIDADES
    // 
    // ********  BEGIN EDITAR CENTROS DE COSTO
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

    public function addMinaPe($codigo,$centro_costo,$sede) {
      $this->db->query('INSERT INTO minas_pe (codigo,nombre,pais) VALUES (:codigo, :centro_costo, :sede)');

      $this->db->bind(':codigo', $codigo);
      $this->db->bind(':centro_costo', $centro_costo);
      $this->db->bind(':sede', $sede);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function addMinaCl($sede,$unidad) {
      $this->db->query('INSERT INTO minas_cl (codigo,nombre,pais) VALUES (:codigo, :centro_costo, :sede)');

      $this->db->bind(':codigo', $codigo);
      $this->db->bind(':centro_costo', $centro_costo);
      $this->db->bind(':sede', $sede);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function deleteMinaPe($id) {
      $this->db->query('DELETE FROM minas_pe WHERE id = :id');
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function deleteMinaCl($id) {
      $this->db->query('DELETE FROM minas_cl WHERE id = :id');
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
    // ********  END EDITAR CENTROS DE COSTO
    // 
    // ********  BEGIN EDITAR CATEGORIAS
    public function getCategoriasPe($cc) {
      $this->db->query('SELECT * FROM categ_peru WHERE mina_pe_id = :cc ORDER BY id DESC');
      $this->db->bind(':cc', $cc);
      $categorias = $this->db->getSet();
      return $categorias;
    }

    public function getCategoriasCl($cc) {
      $this->db->query('SELECT * FROM categ_chile WHERE mina_cl_id = :cc ORDER BY id DESC');
      $this->db->bind(':cc', $cc);
      $categorias = $this->db->getSet();
      return $categorias;
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

    public function addCategoriaPe($mina_id,$codigo,$tipo,$categoria) {
      $this->db->query('INSERT INTO categ_peru (mina_pe_id,codigo,tipo,categoria) VALUES (:mina_id, :codigo, :tipo, :categoria)');

      $this->db->bind(':mina_id', $mina_id);
      $this->db->bind(':codigo', $codigo);
      $this->db->bind(':tipo', $tipo);
      $this->db->bind(':categoria', $categoria);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function addCategoriaCl($mina_id,$codigo,$tipo,$categoria) {
      $this->db->query('INSERT INTO categ_chile (mina_pe_id,codigo,tipo,categoria) VALUES (:mina_id, :codigo, :tipo, :categoria)');

      $this->db->bind(':mina_id', $mina_id);
      $this->db->bind(':codigo', $codigo);
      $this->db->bind(':tipo', $tipo);
      $this->db->bind(':categoria', $categoria);

      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function deleteCategoriaPe($id) {
      $this->db->query('DELETE FROM categ_peru WHERE id = :id');
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    public function deleteCategoriaCl($id) {
      $this->db->query('DELETE FROM categ_chile WHERE id = :id');
      $this->db->bind(':id', $id);

      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }

    // ********  END EDITAR CATEGORIAS
    // 
    // ********  BEGIN EDITAR CENTROS DE COSTO



	}
?>