<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
header("Content-Type: text/html;charset=utf-8");
$error_msg = "";

if (isset($_POST['username'], $_POST['email'], $_POST['p'])){
 

	$apellp = $_POST['apell_p'];
	$apellm = $_POST['apell_m']; 
	$nom = $_POST['username'];
	$sex = $_POST['sexo'];
	$pais = $_POST['country'];
	$ciudad = $_POST['state'];
	$direc = $_POST['direc'];
	$dat = $_POST['date'];
	$tel1 = $_POST['telephone1'];
	$opera = $_POST['opera'];
	$pwd  = $_POST['p'];
	$grado  = $_POST['grado'];
	$institu  = $_POST['institu'];
/**
echo "
$apellp <br>
	$apellm <br>
	$nom <br>
	$sex <br>
	$pais <br>
	$ciudad <br>
	$direc <br>
	$dat <br>
	$tel1 <br>
	$opera <br>
	$pwd  <br>";	*/

 // Sanear y validar los datos provistos.
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // No es un correo electrónico válido.
        $error_msg .= '<p class="error" >El email que has introducido no es valido </p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
     $password_moodle =  $password;
    if (strlen($password) != 128) {
        // La contraseña con hash deberá ser de 128 caracteres.
        // De lo contrario, algo muy raro habrá sucedido. 
        $error_msg .= '<p class="error">Password no Valido</p>';
    }
 
    // La validez del nombre de usuario y de la contraseña ha sido verificada en el cliente.
    // Esto será suficiente, ya que nadie se beneficiará de
    // violar estas reglas.
    //
 
    $prep_stmt = "SELECT id_usuario FROM usuario WHERE email_usuario = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Verifica el correo electrónico existente.  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            // Ya existe otro usuario con este correo electrónico.
            $error_msg .= '<p class="error">Un usuario con esta dirección de correo electrónico ya existe</p>';
                        $stmt->close();
        }
    } else {
        $error_msg .= '<p class="error" >Database error Line 39</p>';
                $stmt->close();
    }
 
    // Verifica el nombre de usuario existente. 
    
    if (empty($error_msg)) {
        // Crear una sal aleatoria.
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Crea una contraseña con sal. 
        $password = hash('sha512', $password . $random_salt);
        $apll_moodle = $apellp." ".$apellm;
        // Inserta el nuevo usuario a la base de datos.  
        if ($insert_stmt = $mysqli->prepare("INSERT INTO `u292000437_bdi`.`usuario` (`apell_p_usuario`, `apell_m_usuario`, `nom_usuario`, `email_usuario`, `password_usuario`, `salt_usuario`, `naci_usuario`, `sexo_usuario`, `tel1_usuario`, `tel1_opera_usuario`, `direc_usuario`, `pais_usuario`, `ciudad_usuario`, `permiso_usuario`,`gr_academ_usuario`,`centr_estu_usuario`, `apell_moodle`) 
			VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,'U',?,?,?);")){
            $insert_stmt->bind_param('ssssssssssssssss', $apellp, $apellm, $nom, $email,$password, $random_salt, $dat, $sex, $tel1, $opera, $direc, $pais, $ciudad,$grado,$institu,$apll_moodle);
            // Ejecuta la consulta preparada.
            if (!$insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: INSERT');
            }
			header('Location: ../register_success.php');
        }
        
    }
}

?>