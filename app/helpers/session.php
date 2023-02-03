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
               ' . $mensaje . '
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';

			unset($_SESSION['alerta']);
			unset($_SESSION['mensaje']);
		}

	}

              //               <div class="alert alert-warning  alert-dismissible fade show" role="alert">
              //   <h4 class="alert-heading">Warning Heading</h4>
              //   <p>Et suscipit deserunt earum itaque dignissimos recusandae dolorem qui. Molestiae rerum perferendis laborum. Occaecati illo at laboriosam rem molestiae sint.</p>
              //   <hr>
              //   <p class="mb-0">Temporibus quis et qui aspernatur laboriosam sit eveniet qui sunt.</p>
              //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              // </div>


?>