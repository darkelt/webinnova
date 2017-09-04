<?php
include 'header.php';
if(isset($_POST['email'])) {

			// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
			$email_to = "cursos@innovatrainingperu.com";
			$email_subject = "Contacto desde el sitio web";

			// Aquí se deberían validar los datos ingresados por el usuario
			if(!isset($_POST['first_name']) ||
				!isset($_POST['email']) ||
				!isset($_POST['comments'])) {

							echo "			<header>
												<div class='inner'>
													<h3 class='error'> <span>Ocurrió un error y el formulario no ha sido enviado. </span></h3>
											  </div>
											";
							echo "<h3 class='error'> <span>Por favor, vuelva atrás y verifique la información ingresada </span></h3>
									</header>";
							die();
			}
			
			$email_from = $_POST['email'];
			$email_message = "Detalles del formulario de contacto:\n\n";
			$email_message .= "Nombre: " . $_POST['first_name'] . "\n";
			$email_message .= "E-mail: " . $_POST['email'] . "\n";
			$email_message .= "Comentarios: " . $_POST['comments'] . "\n\n";


			// Ahora se envía el e-mail usando la función mail() de PHP
			$headers = 'From: '.$email_from."\r\n".
			'Reply-To: '.$email_from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
			@mail($email_to, $email_subject, $email_message, $headers);

			echo "


								<header>
															<div class='inner'>
																<h3> <span>¡El formulario se ha enviado con éxito! </span></h3>
																
															</div>
														</header>";
}

include 'footer.php';
?>