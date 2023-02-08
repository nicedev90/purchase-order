<?php 
	session_start();

	function userLoggedIn() {
		if (isset($_SESSION['user_rol'])) {
			return true;
		} else {
			return false;
		}
	}

	function showAlert() {

		if (!empty($_SESSION['alerta']) && !empty($_SESSION['mensaje'])) {
			$alerta = $_SESSION['alerta'];
			$mensaje = $_SESSION['mensaje'];

			echo '<div class="alert-' . $alerta . '">
				<i class="bi bi-exclamation-triangle fa-2x"></i>
				' . $mensaje . '</div>';

			unset($_SESSION['alerta']);
			unset($_SESSION['mensaje']);
		}

	}

	function submitAlert() {

		if (!empty($_SESSION['alerta']) && !empty($_SESSION['mensaje'])) {
			$alerta = $_SESSION['alerta'];
			$mensaje = $_SESSION['mensaje'];

			echo '<div class="alert alert-' . $alerta . ' alert-dismissible fade show" role="alert">
        			<i class="bi bi-check-circle me-1"></i>
              ' . $mensaje . '
        			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      			</div>';

			unset($_SESSION['alerta']);
			unset($_SESSION['mensaje']);
		}
	}

	function fixedFecha($date) {
		setlocale(LC_TIME, "spanish");
		$fecha = $date;
		$fecha = str_replace("/", "-", $fecha); 
		$fecha = strftime("%d-%m-%Y", strtotime($fecha));
		return $fecha;
	}


?>