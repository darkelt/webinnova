<?php
include_once 'db_connect.php';
include_once 'functions.php';
 
sec_session_start(); // Nuestra manera personalizada segura de iniciar sesión PHP.
 
if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if (recupera_pass($email, $mysqli) == true) {
        // Inicio de sesión exitosa
        header('Location: ../res_pass.php?tipo=1');
    } else {
        // Inicio de sesión exitosa
       header('Location: ../res_pass.php?tipo=2');
		
    }
} else {
    // Las variables POST correctas no se enviaron a esta página.
    echo 'Solicitud no válida';
}

?>