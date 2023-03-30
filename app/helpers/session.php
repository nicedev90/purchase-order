<?php 
	session_start();

	function userLoggedIn() {
		if (isset($_SESSION['user_rol'])) {
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



?>