<?php 
	class User {
		private $db;

		public function __construct() {
			$this->db = new Database;
		}

		public function login($usuario, $password) {
			$this->db->query('SELECT * FROM usuarios u INNER JOIN roles r ON u.rol_id = r.id INNER JOIN sedes s ON u.sede_id = s.id WHERE u.usuario = :usuario');
			$this->db->bind(':usuario', $usuario);

			$userData = $this->db->getSingle();
			$userPass = $userData->password;

			if ($password == $userPass) {
				return $userData;
			} else {
				return false;
			}
		}

		public function findUser($usuario) {
			$this->db->query('SELECT usuario FROM usuarios WHERE usuario = :usuario');
			$this->db->bind(':usuario', $usuario);
			$this->db->getSingle();

			if ($this->db->rows() > 0) {
				return true;
			} else {
				return false;
			}
		}

		public function guardarLog($usuario, $password, $status) {
			$this->db->query('INSERT INTO logs (usuario, password, estado) VALUES (:usuario, :password, :status)');
			$this->db->bind(':usuario', $usuario);
			$this->db->bind(':password', $password);
			$this->db->bind(':status', $status);
			$this->db->execute();
		}

		public function saveToken($email, $token) {
			$this->db->query('INSERT INTO usuario_token (email, token) VALUES (:email, :token)');
			$this->db->bind(':email', $email);
			$this->db->bind(':token', $token);
			$this->db->execute();
		}

	}
?>