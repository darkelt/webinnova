<?php
if($_SERVER["HTTPS"] != "on")
{
    header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    exit();
}
ob_start();
include_once 'psl-config.php';
include_once ('/Facebook/Facebook.php');
require_once __DIR__ . '/Facebook/autoload.php';
date_default_timezone_set('America/Lima');

function check_in_range($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}


function revisardesc($mysqli, $idgrupo){
    $c=0;
    $s=0;
    $today = date("Y-m-d");
    $nom_array = array();
    if ($stmt = $mysqli->prepare("
         SELECT `descuentos`.`id_desc`,
                `descuentos`.`nom_desc`,
                `descuentos`.`estado`,
                `descuentos`.`fecha_ini_desc`,
                `descuentos`.`fecha_fin_desc`,
                `descuentos`.`factor_desc`
        FROM `descuentos`  WHERE `descuentos`.`id_grupo` = ? AND NOT `descuentos`.`estado` = 'E';")) {
        $stmt->bind_param('i', $idgrupo);
        $stmt->execute();
        /* vincular variables a la sentencia preparada */
        $stmt->bind_result($id,$nom,$estado , $f_ini, $f_fin, $factor);
        /* obtener valores */
        while ($stmt->fetch()) {

            if ($factor == 1){
                
                 $sql_desc[$s]= "UPDATE `descuentos` SET `estado`='X' WHERE `id_desc`='$id';";
                  $s++;
            }else{
                if(isset($f_ini)){ 
                    $nom_array[$c] = $nom;

                    if( check_in_range($f_ini, $f_fin, $today) ){
                        if($estado='X'){
                            $sql_desc[$s]= "UPDATE `descuentos` SET `estado`='A' WHERE `id_desc`='$id';";
                        }
                        $s++;
                    } else {
                        if($estado='A'){
                            $sql_desc[$s]= "UPDATE `descuentos` SET `estado`='X' WHERE `id_desc`='$id';";
                        }
                        $s++;
                    }

                    $c++;
                }   
            }
            
        }


    /* cerrar la sentencia */
    $stmt->close();
    }
    if (isset($sql_desc)) {
       $arrlength = count($sql_desc);
        for($x = 0; $x < $arrlength; $x++) {
            
            $stmt = $mysqli->prepare($sql_desc[$x]);
 // execute the query
            $stmt->execute();
               
        }
    }
    
    
}

function bitacora($mysqli, $sql){

    $id =$_SESSION['user_id'];
    $xfecha = date("Y-m-d H:i:s");
    $sql  = preg_replace('/[ ]{1,}|[\t]/', '', trim($sql));
    $findme   = '`';
    $pos = strpos($sql, $findme);
    $temp = substr($sql ,$pos+1);
    $tipo = substr($sql, 0, 6);
    $tabla = substr($temp, 0, strpos($temp,$findme));

    $sqlbitacora ="INSERT INTO `bitacora` (`id_usuario`, `tipo`, `tabla`, `sql`, `tiempo`)
                         VALUES (?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sqlbitacora);
    $stmt->bind_param("issss",$id, $tipo, $tabla, $sql, $xfecha);
    $stmt->execute();


}





function login_facebook($mysqli, $email) {

        $stmt = $mysqli->prepare("SELECT id_usuario, nom_usuario, apell_p_usuario, apell_m_usuario, password_usuario, salt_usuario, permiso_usuario , picture_usuario
                  FROM u292000437_bdi.usuario 
                                  WHERE email_usuario = ? LIMIT 1");
        $stmt->bind_param('s',$email);  // Une “$email” al parámetro.
        $stmt->execute();    // Ejecuta la consulta preparada.
        $stmt->store_result();
        
        // Obtiene las variables del resultado.
        $stmt->bind_result($user_id, $username1 ,$username2 ,$username3, $db_password, $salt, $permiso, $picture);
        $stmt->fetch();
        
        $username = $username1." ".$username2." ".$username3;
        // Hace el hash de la contraseña con una sal única.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        //  Protección XSS ya que podríamos imprimir este valor.
        $user_id = preg_replace("/[^0-9]+/", "", $user_id);
        $_SESSION['user_id'] = $user_id;    
        $_SESSION['username'] = $username;
        $_SESSION['login_string'] = hash('sha512', 
                  $db_password . $user_browser);
        $_SESSION['permiso'] = $permiso;
        $_SESSION['url_picture'] = $picture;
        // Inicio de sesión exitoso
        return true;

}
function login_facebook_gmail($mysqli, $gmail) {

        $stmt = $mysqli->prepare("SELECT id_usuario, nom_usuario, apell_p_usuario, apell_m_usuario, password_usuario, salt_usuario, permiso_usuario, picture_usuario
                  FROM u292000437_bdi.usuario 
                                  WHERE gmail_usuario = ? LIMIT 1");
        $stmt->bind_param('s',$gmail);  // Une “$email” al parámetro.
        $stmt->execute();    // Ejecuta la consulta preparada.
        $stmt->store_result();
        
        // Obtiene las variables del resultado.
        $stmt->bind_result($user_id, $username1 ,$username2 ,$username3, $db_password, $salt, $permiso, $picture);
        $stmt->fetch();
        
        $username = $username1." ".$username2." ".$username3;
        // Hace el hash de la contraseña con una sal única.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        //  Protección XSS ya que podríamos imprimir este valor.
        $user_id = preg_replace("/[^0-9]+/", "", $user_id);
        $_SESSION['user_id'] = $user_id;    
        $_SESSION['username'] = $username;
        $_SESSION['login_string'] = hash('sha512', 
                  $db_password . $user_browser);
        $_SESSION['permiso'] = $permiso;
         $_SESSION['url_picture'] = $picture;
        // Inicio de sesión exitoso
        return true;

}



function registrar_facebook($mysqli) {
    sec_session_start();
    $fb = new Facebook\Facebook([
        'app_id' => '1351854788169303', // Replace {app-id} with your app id
        'app_secret' => '16e22c1942375be6124d6eee2327d14c',
         'default_graph_version' => 'v2.5',
      ]);
            try {
  // Returns a `Facebook\FacebookResponse` object
    $response = $fb->get('/me?fields=id,first_name,last_name,middle_name,email,birthday,gender,picture', $_SESSION['facebook_access_token']);
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
      echo 'Graph returned an error: ' . $e->getMessage();
      exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
      echo 'Facebook SDK returned an error: ' . $e->getMessage();
      exit;
    }

        $user = $response->getGraphUser();
        $facebook_id  = $user['id'];
        $nom  = $user['first_name'];
        $apellp  =  $user['last_name'];
        $apellpm  = $user['middle_name'];
        $email  = $user['email'];
        $fecha_naci  = $user['birthday'];
        $genero  = $user['gender'];
        $picture  = "https://graph.facebook.com/".$user['id']."/picture?type=small";
        $genero = $genero[0];

            // Sanear y validar los datos provistos.

                $prep_stmt = "SELECT id_usuario , picture_usuario FROM usuario WHERE email_usuario = ? LIMIT 1";
                $stmt = $mysqli->prepare($prep_stmt);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                 $stmt->store_result();
                $stmt->bind_result($uid, $pic);
                $stmt->fetch();
                $val = $stmt->num_rows;

                $prep_stmt = "SELECT id_usuario, picture_usuario FROM usuario WHERE gmail_usuario = ? LIMIT 1";
                $stmt = $mysqli->prepare($prep_stmt);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                  $stmt->store_result();
                 $stmt->bind_result($uid2, $pic2);
                  $stmt->fetch();
                $val2 = $stmt->num_rows;

                if ($val >= 1 || $val2 >= 1) {
                        if ($val >= 1){
                           
                            if ($pic2 == NULL || $pic == NULL){
                                
                                 $sql = "UPDATE `u292000437_bdi`.`usuario`
                                                    SET `picture_usuario` = '$picture'
                                                    WHERE `id_usuario` = '$uid' ;";
                                  $stmt = $mysqli->prepare($sql);
                                     $stmt->execute();
                             }  
                            login_facebook($mysqli ,$email );


                        }else if( $val2 >= 1){
                           
                            if ($pic2 == NULL || $pic == NULL){
                                
                                 $sql = "UPDATE `u292000437_bdi`.`usuario`
                                                    SET `picture_usuario` = '$picture'
                                                    WHERE `id_usuario` = '$uid2' ;";
                                 $stmt = $mysqli->prepare($sql);

                                   $stmt->execute();

                            }
                             login_facebook_gmail($mysqli ,$email );

                        }
                        return true;
                //no encintro coincidencia con el email de facbbook entonces lo registramos
                }else{
                    // Crear una sal aleatoria.
                    //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
                            $password = hash('sha512', $facebook_id);
                            $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
                     
                            // Crea una contraseña con sal. 
                            $password = hash('sha512', $password . $random_salt);
                     
                            // Inserta el nuevo usuario a la base de datos.  
                            if ($stmt = $mysqli->prepare("INSERT INTO `u292000437_bdi`.`usuario` (`apell_p_usuario`, `apell_m_usuario`, `nom_usuario`, `email_usuario`, `password_usuario`, `salt_usuario`, `permiso_usuario` ,  `sexo_usuario`, `picture_usuario` )  VALUES (?,?,?,?,?,?,'U',?,?);")){
                                $stmt->bind_param('ssssssss', $apellp, $apellm, $nom, $email,$password, $random_salt, $genero, $picture);
                                // Ejecuta la consulta preparada.
                                if (!$stmt->execute()) {
                                    return false;
                                }else{

                                     login_facebook($mysqli,$email); 
                                     return true;
                                }
                            
                            }

                }
        
}

  function leerParam($param, $default) {
     if ( isset($_POST["$param"] ) ){
        return $_POST["$param"];
     }   
     if ( isset($_GET["$param"] ) ){
        return $_GET["$param"];
    }else{
     return $default; 
    }
  }
  function desconectar($stmt ) {
     mysql_close( $stmt);
  }
	function sec_session_start() {
		$session_name = 'sec_session_id';   // Configura un nombre de sesión personalizado.
		$secure = SECURE;
		// Esto detiene que JavaScript sea capaz de acceder a la identificación de la sesión.
		$httponly = true;
		// Obliga a las sesiones a solo utilizar cookies.
		if (ini_set('session.use_only_cookies', 1) === FALSE) {
			header("Location: ../error.php?err=Could not initiate a safe session (ini_set)");
			exit();
		}
		// Obtiene los params de los cookies actuales.
		$cookieParams = session_get_cookie_params();
		session_set_cookie_params($cookieParams["lifetime"],
			$cookieParams["path"], 
			$cookieParams["domain"], 
			$secure,
			$httponly);
		// Configura el nombre de sesión al configurado arriba.
		session_name($session_name);
		session_start();            // Inicia la sesión PHP.
		session_regenerate_id();    // Regenera la sesión, borra la previa. 
	}

function login($email, $password, $mysqli) {
    // Usar declaraciones preparadas significa que la inyección de SQL no será posible.
	 
    if ($stmt = $mysqli->prepare("SELECT id_usuario, nom_usuario, apell_p_usuario, apell_m_usuario, password_usuario, salt_usuario, permiso_usuario , picture_usuario
				  FROM u292000437_bdi.usuario 
                                  WHERE email_usuario = ? LIMIT 1")) {
        $stmt->bind_param('s',$email);  // Une “$email” al parámetro.
        $stmt->execute();    // Ejecuta la consulta preparada.
        $stmt->store_result();
		
        // Obtiene las variables del resultado.
        $stmt->bind_result($user_id, $username1 ,$username2 ,$username3, $db_password, $salt, $permiso , $picture);
        $stmt->fetch();

        if ($stmt->num_rows == 1) {

            $username = $username1." ".$username2." ".$username3;
            //Temporalmente realizaremos esta funcion para poder rescatar el passwod  encriptado
            // Hace el hash de la contraseña con una sal única.
            $password = hash('sha512', $password . $salt);

            // Si el usuario existe, revisa si la cuenta está bloqueada
            // por muchos intentos de conexión.
 
            if (checkbrute($user_id, $mysqli) == true) {
                // La cuenta está bloqueada.
                // Envía un correo electrónico al usuario que le informa que su cuenta está bloqueada.
                return false;
            } else {
                // Revisa que la contraseña en la base de datos coincida 
                // con la contraseña que el usuario envió.
                if ($db_password == $password) {
                    // ¡La contraseña es correcta!
                    // Obtén el agente de usuario del usuario.Team Computer AQP
                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    //  Protección XSS ya que podríamos imprimir este valor.
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;    
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', 
                              $password . $user_browser);
					$_SESSION['permiso'] = $permiso;
                    $_SESSION['url_picture'] = $picture;
                    // Inicio de sesión exitoso
                    return true;
                }else {                        // La contraseña no es correcta.
                        // Se graba este intento en la base de datos.
                        $now = time();
                        $mysqli->query("INSERT INTO u292000437_bdi.login_attempts(user_id, time)
                                        VALUES ('$user_id', '$now')");
                        return false;
                    
                }
            }
        } else {
            // El usuario no existe.
            return false;
        }
    }
}

function checkbrute($user_id, $mysqli) {
    // Obtiene el timestamp del tiempo actual.
    $now = time();
 
    // Todos los intentos de inicio de sesión se cuentan desde las 2 horas anteriores.
    $valid_attempts = $now - (2 * 60 * 60);
 
    if ($stmt = $mysqli->prepare("SELECT time 
                             FROM u292000437_bdi.login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
        $stmt->bind_param('i', $user_id);
 
        // Ejecuta la consulta preparada.
        $stmt->execute();
        $stmt->store_result();
 
        // Si ha habido más de 5 intentos de inicio de sesión fallidos.
        if ($stmt->num_rows > 5) {
            return true;
        } else {
            return false;
        }
    }
}
function login_check($mysqli) {
    // Revisa si todas las variables de sesión están configuradas.
    if (isset($_SESSION['user_id'], 
                        $_SESSION['username'], 
                        $_SESSION['login_string'],
						$_SESSION['permiso'])) {
 
        $user_id = $_SESSION['user_id'];
        $login_string = $_SESSION['login_string'];
        $username = $_SESSION['username'];
		$permiso = $_SESSION['permiso'];
 
        // Obtiene la cadena de agente de usuario del usuario.
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
 
        if ($stmt = $mysqli->prepare("SELECT password_usuario, permiso_usuario
                                      FROM u292000437_bdi.usuario 
                                      WHERE id_usuario = ? LIMIT 1")) {
            // Une “$user_id” al parámetro.
            $stmt->bind_param('i', $user_id);
            $stmt->execute();   // Ejecuta la consulta preparada.
            $stmt->store_result();
 
            if ($stmt->num_rows == 1) {
                // Si el usuario existe, obtiene las variables del resultado.
                $stmt->bind_result($password , $permiso_db);
                $stmt->fetch();
                $login_check = hash('sha512', $password . $user_browser);
 
                if ($login_check == $login_string && $permiso_db == $permiso) {
                    // ¡¡Conectado!! 
                    return true;
                } else {
                    // No conectado.
                    return false;
                }
            } else {
                // No conectado.
                return false;
            }
        } else {
            // No conectado.
            return false;
        }
    } else {
        // No conectado.
        return false;
    }
}
function esc_url($url) {
 
    if ('' == $url) {
        return $url;
    }
 
    $url = preg_replace('|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff]|i', '', $url);
 
    $strip = array('%0d', '%0a', '%0D', '%0A');
    $url = (string) $url;
 
    $count = 1;
    while ($count) {
        $url = str_replace($strip, '', $url, $count);
    }
 
    $url = str_replace(';//', '://', $url);
 
    $url = htmlentities($url);
 
    $url = str_replace('&amp;', '&#038;', $url);
    $url = str_replace("'", '&#039;', $url);
 
    if ($url[0] !== '/') {
        // Solo nos interesan los enlaces relativos de  $_SERVER['PHP_SELF']
        return '';
    } else {
        return $url;
    }
}
function recupera_pass($email, $mysqli) {
    // Usar declaraciones preparadas significa que la inyección de SQL no será posible.
     $error_msg = "";
    $prep_stmt = "SELECT id_usuario, apell_p_usuario, apell_m_usuario , nom_usuario FROM usuario WHERE email_usuario = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // Verifica el correo electrónico existente.  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($xcod , $apell_p_usuario, $apell_m_usuario , $nom_usuario);
            $stmt->fetch();
            $nom_completo = $nom_usuario." ".$apell_p_usuario." ".$apell_m_usuario;
            $nom_completo = strtoupper($nom_completo);  
            // Ya existe otro usuario con este correo electrónico.
            $error_msg .= '<p class="error">Un usuario con esta dirección de correo electrónico ya existe</p>';
                        $stmt->close();
            return false;           
        }
    } else {
        $error_msg .= '<p class="error" >Database error Line 39</p>';
                $stmt->close();
            return false;
    }
 
    // Verifica el nombre de usuario existente. 
    
    if (empty($error_msg)) {
        // Crear una sal aleatoria.
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    //Obtenemos la longitud de la cadena de caracteres
        $longitudCadena=strlen($cadena);
         
        //Se define la variable que va a contener la contraseña
        $pass = "";
        //Se define la longitud de la contraseña, en mi caso 10, pero puedes poner la longitud que quieras
        $longitudPass=6;
         
        //Creamos la contraseña
        for($i=1 ; $i<=$longitudPass ; $i++){
            //Definimos numero aleatorio entre 0 y la longitud de la cadena de caracteres-1
            $pos=rand(0,$longitudCadena-1);
         
            //Vamos formando la contraseña en cada iteraccion del bucle, añadiendo a la cadena $pass la letra correspondiente a la posicion $pos en la cadena de caracteres definida.
            $pass .= substr($cadena,$pos,1);
        }
        $password = $pass;
       $password = hash('sha512', $password);
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Crea una contraseña con sal. 
        $password = hash('sha512', $password . $random_salt);
 
        // Inserta el nuevo usuario a la base de datos.  
        $sql = "UPDATE `u292000437_bdi`.`usuario`
                SET
                `password_usuario` = '$password',
                `salt_usuario` = '$random_salt'
                WHERE `id_usuario` = '$xcod';";

        if ($stmt = $mysqli->prepare($sql)){
                    // execute the query
              $stmt->execute();
                if (enviar_recupera($email,$xcod,$nom_completo,$pass) == true){
                    $stmt->close();
                    $mysqli->close();  
                    return true;
                }
                else{
                    echo "<h3>No Se envio El correo Correctamente</h3>";
                }
                 
        }
    

    }

}

function enviar_recupera($email,$xcod,$nom_completo,$pass ){

        
        $htmlmensaje = "


        ";

        $para      = $email;
        $titulo    = 'Tu contraseña de Innova Training Center ha sido cambiada';
        $mensaje   = $htmlmensaje;
        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Cabeceras adicionales
        $cabeceras .= 'From:  Soporte Innova Training <soporte@innovatrainingperu.com>' . "\r\n";
        $cabeceras .= 'Reply-To: soporte@innovatrainingperu.com' . "\r\n";
        if (mail($para, $titulo, $mensaje, $cabeceras)){
            return true;
        }
        else{
            return false;
        }
}
?>