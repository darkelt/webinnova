<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){
					?>
		<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">

<?php
// Debes editar las próximas dos líneas de código de acuerdo con tus preferencias
$email_to = "cursos@innovatrainingperu.com";
$email_subject = "Contacto desde el sitio web";

// Aquí se deberían validar los datos ingresados por el usuario
		if(!isset($_POST['comments'])) {

				echo "			<header>
									<div class='inner'>
										<h3 class='error'> <span>Ocurrió un error y el formulario no ha sido enviado. </span></h3>
								  </div>
								";
				echo "<h3 class='error'> <span>Por favor, vuelva atrás y verifique la información ingresada </span></h3>
						</header>";
				die();
		}


    if (isset($_SESSION['user_id'],$_SESSION['username'])) {
 
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['username'];
 
        $stmt = $mysqli->prepare("SELECT email_usuario, tel1_usuario, tel1_opera_usuario
                                      FROM u292000437_bdi.usuario 
                                      WHERE id_usuario = ? LIMIT 1"); 
            // Une “$user_id” al parámetro.
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Ejecuta la consulta preparada.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // Si el usuario existe, obtiene las variables del resultado.
                $stmt->bind_result($email , $tel1 , $operatel1);
                $stmt->fetch();
                
 
                
                    // ¡¡Conectado!! 
                   
				   
					
					$email_message = "Detalles del formulario de contacto:\n\n";
					$email_message .= "Nombre: " . $username. "\n";
					$email_message .= "E-mail: " . $email . "\n";
					$email_message .= "Teléfono: " . $tel1 ." ". $operatel1."\n";
					$email_message .= "Comentarios: " . $_POST['comments'] . "\n\n";


					// Ahora se envía el e-mail usando la función mail() de PHP
					$headers = 'From: '.$email."\r\n".
					'Reply-To: '.$email."\r\n" .
					'X-Mailer: PHP/' . phpversion();
					@mail($email_to, $email_subject, $email_message, $headers);
					echo "


					<header>
												<div class='inner'>
												<br>
												<br>
												<br>
													<h3> <span>¡El formulario se ha enviado con éxito! </span></h3>
													
												</div>
											</header>";
				   
				   
				   
				   
				
            } else {
   
   
				echo "<h3 class='error'> <span>Por favor, vuelva atrás y verifique la información ingresada </span></h3>
						</header>";
				die();
   
   
            }
             
 
   
        

	}
?>

		</div>
</div>		
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
	<?php }
			else { 
				header('Location: ../login.php?error=2');
			} 
	} else { 

		header('Location: ../login.php?error=3');
    } 
 include 'footer.php';?>		
 
 
 