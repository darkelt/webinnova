<?php
include_once 'db_connect.php';
include_once 'functions.php';
include_once 'fb_init.php';
// Nuestra manera personalizada segura de iniciar sesión PHP.
if (isset($_POST['email'], $_POST['p'])) {
    $email = $_POST['email'];
    $password = $_POST['p'];// La contraseña con hash
    $url=$_SESSION["xurl"];
	
    if (login($email, $password, $mysqli) == true) {
        // Inicio de sesión exitosa
        header('Location: ../pro/'.$url);
    } else {
        // Inicio de sesión exitosa
       header('Location: ../login.php?error=1');
		
    }
} 

 if (isset($_SESSION['facebook_access_token'])){
    $url= $_SESSION["xurl"];

    if (registrar_facebook($mysqli)==true){
            header('Location: ../pro/'.$url);

    } else{
         header('Location: ../login.php?error=0');
        

    } 
  
}else{

    echo"Ah ocurro un Error... ";
}
?>