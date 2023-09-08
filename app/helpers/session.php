<?php 
	session_start();

	// function userLoggedIn() {
	// 	if (isset($_SESSION['user_rol'])) {
	// 		return true;
	// 	} else {
	// 		return false;
	// 	}
	// }

	function userFromSede_1() {
		if (isset($_SESSION['user_sede_id']) && $_SESSION['user_sede_id'] == 1) {
			return true;
		} else {
			return false;
		}
	}

	function userFromSede_2() {
		if (isset($_SESSION['user_sede_id']) && $_SESSION['user_sede_id'] == 2) {
			return true;
		} else {
			return false;
		}
	}

	function adminLoggedIn() {
		if (isset($_SESSION['user_rol_id']) && $_SESSION['user_rol_id'] == 1) {
			return true;
		} else {
			return false;
		}
	}

	function coordinadorLoggedIn() {
		if (isset($_SESSION['user_rol_id']) && $_SESSION['user_rol_id'] == 2) {
			return true;
		} else {
			return false;
		}
	}

	function encargadoLoggedIn() {
		if (isset($_SESSION['user_rol_id']) && $_SESSION['user_rol_id'] == 3) {
			return true;
		} else {
			return false;
		}
	}

	function usuarioLoggedIn() {
		if (isset($_SESSION['user_rol_id']) && $_SESSION['user_rol_id'] == 4) {
			return true;
		} else {
			return false;
		}
	}

	function setName($tipo) {
		if ($_SESSION['user_sede'] == 'Peru') {
			echo "CAJA CHICA";
		} else {
			echo strtoupper($tipo);
		}
	}

	function setTipoBySede() {
		if ($_SESSION['user_sede'] == 'Peru') {
			echo "CAJA CHICA";
		} else {
			echo "FONDOS";
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

	function createdAlert() {
		if (isset($_SESSION['alerta'])) {
			echo 'success_modal';
			unset($_SESSION['alerta']);
		}
	}

	function success_alert() {
		if (isset($_SESSION['success_alert'])) {
			echo $_SESSION['success_alert'];
			unset($_SESSION['success_alert']);
		}
	}

	function warning_alert() {
		if (isset($_SESSION['warning_alert'])) {
			echo $_SESSION['warning_alert'];
			unset($_SESSION['warning_alert']);
		}
	}

	function msg_success() {
		if (isset($_SESSION['msg_success'])) {
			echo $_SESSION['msg_success'];
			unset($_SESSION['msg_success']);
		}
	}

	function msg_warning() {
		if (isset($_SESSION['msg_warning'])) {
			echo $_SESSION['msg_warning'];
			unset($_SESSION['msg_warning']);
		}
	}

	function bgFondos() {
		echo "btn btn-secondary";
	}

	function bgCompra() {
		echo "btn btn-info";
	}
	
	function bgAprobado() {
		echo "btn btn-success";
	}

	function bgRechazado() {
		echo "btn btn-danger";
	}

	function bgEnProceso() {
		echo "btn btn-warning";
	}

	function setCurrency() {
		if (isset($_SESSION['user_sede']) && $_SESSION['user_sede'] == 'Peru') {
			echo 'S/. ';
		} elseif (isset($_SESSION['user_sede']) && $_SESSION['user_sede'] == 'Chile') {
			echo '$. ';
		} else {
			echo '';
		}
	}

	function fixedFecha($date) {
		setlocale(LC_TIME, "spanish");
		$fecha = $date;
		$fecha = str_replace("/", "-", $fecha); 
		$fecha = strftime("%d-%m-%Y", strtotime($fecha));
		return $fecha;
	}

	function fixedMes($date) {
		setlocale(LC_TIME, "spanish");
		$fecha = $date;
		$fecha = strftime("%B", strtotime($fecha));
		$fecha = strtoupper($fecha);
		return $fecha;
	}

	function checkSedePeru() {
		if (isset($_SESSION['user_sede']) && $_SESSION['user_sede'] == 'Peru') {
			return true;
		} else {
			return false;
		}
	}



?>