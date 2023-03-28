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

      $this->db->execute();
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


    public function getUserLog($usuario) {
      $this->db->query('SELECT * FROM logs WHERE usuario = :usuario');
      $this->db->bind(':usuario', $usuario);
      $res = $this->db->getSet();
      return $res;  
    }



	}
?>