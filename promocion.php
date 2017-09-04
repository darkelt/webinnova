<?php

include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
include_once 'includes/fb_init.php';
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Innova Training Center</title>
	<link rel="icon" type="image/ico" href="images/icoinnova.ico" />
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!-- 
	//////////////////////////////////////////////////////
	Desarrollo: Sandro Chambi Carpio
	Empresa: Innova Training Center
	Año : 2016
	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="css/superfish.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<script src="js/countries2.js"></script> 
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->


	<?php
		if (isset($_GET['error'])) {
			
			$error=$_GET['error'];

			if ($error == '1'){
			echo '
			<script>

			    alert("Error al Ingresar !!!.. Intente nuevamente");

			</script>';
			}
			if ($error == '2'){
			echo '
			<script>

			    alert("No Tiene los permisos para acceder a esta página.");

			</script>';
			}
			if ($error == '3'){
			echo '
			<script>

			    alert("No está autorizado para acceder a esta página.");

			</script>';
			}
			if ($error == '4'){
			echo '
			<script>

			    alert("Login porfavor");

			</script>';
			}



	}

	?>
	</head>
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">
		<div id="fh5co-header">
			<header id="fh5co-header-section">
				<div class="container">
					<div class="nav-header">
						<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
						<h1 id="fh5co-logo"><a href="index.php"><img src="images/logo.jpg" width="206" height="67" aling="top" alt="Logo innova Training"></a></h1>
						<!-- START #fh5co-menu-wrap -->
						<nav id="fh5co-menu-wrap" role="navigation">
							<ul class="sf-menu" id="fh5co-primary-menu">
								<li>
									<a class="<?php  
												if(strstr($_SERVER['REQUEST_URI'], 'index.php')){
												echo 'active';
												}
												?>" href="index.php">Inicio</a>
								</li>
								<li>
									<a  class="fh5co-sub-ddown <?php 
												if(strstr($_SERVER['REQUEST_URI'], 'cursos.php')){
												echo 'active';
												}
												?>">Cursos</a>
									 <ul class="fh5co-sub-menu">
										<li>
											<a href="cursos.php" class="fh5co-sub-ddown">Clases de cursos</a>
											<ul class="fh5co-sub-menu" style='width: 280px'>
											<?php
														if ($stmt = $mysqli->prepare("SELECT * FROM u292000437_bdi.clase_cursos;")) {
														$stmt->execute();

														/* vincular variables a la sentencia preparada */
														$stmt->bind_result($id,$nom, $nomcorto, $des, $img);
														/* obtener valores */
														while ($stmt->fetch()) {
															$nom=mb_convert_case($nom, MB_CASE_TITLE, "utf8");
															    
																echo "<li><a href='cursos_sup.php?xcod=$id&xnom=$nom'>$nom</a></li>";
															
														}
														$stmt->close();
													}
											?>
											</ul>
										</li>
										<li><a href="cursos_sup_pack_v.php">Packs Virtuales</a></li>
										<li><a href="cursos_sup_all.php">Cursos Virtuales</a></li>
										<li><a href="cursos_sup_pack_p.php">Packs Presenciales</a></li>
										<li><a href="cursos_sup_all_p.php">Cursos Presenciales</a></li>
										
									</ul>
								</li>
								<li>
									<a class="<?php 
												if(strstr($_SERVER['REQUEST_URI'], '#')){
												echo 'active';
												}
												?>" href="#">Certificación
									</a>
								</li>
								<li>
									<a class="<?php 
												if(strstr($_SERVER['REQUEST_URI'], '#')){
												echo 'active';
												}
												?>" href="#">Servicios
									</a>
								</li>
								<li><a class="<?php 
												if(strstr($_SERVER['REQUEST_URI'], 'about.php')){
												echo 'active';
												}
												?>" href="about.php">Nosotros</a>
								</li>
								<li><a class="<?php 
												if(strstr($_SERVER['REQUEST_URI'], 'contact.php')){
												echo 'active';
												}
												?>" href="contact.php">Contacto</a>
								</li>
							      
							        <li>
							          <a class="fh5co-sub-ddown" href="login.php"><b>Login</b></a>
										<ul id="login-dp" >
											<li>
												 <div class="row">
														<div class="col-md-12">
															Login via
															<div >
																<a  <?php echo 'href="' . htmlspecialchars($loginUrl) . '"'; ?> class="btn btn-block btn-social btn-facebook" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" style="font: 98% Sans-serif; color:white" >
														            <i class="icon-facebook3" style="color:white; font-size: 23px;"></i>Facebook
														          </a>
															</div>
							                                or
															 <form class="form" role="form" accept-charset="UTF-8" id="login-nav" action="includes/process_login.php" method="post" name="formulario1">
															 	<input type="hidden"  value="<?php if($url = leerParam("url","")){ echo "$url"; }else{echo "index.php";} ?>" name="url">
																	 
																	<div class="form-group">
																		 <label class="sr-only" for="exampleInputEmail2" >Email address</label>
																		 <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address"  name="email" required>
																	</div>
																	<div class="form-group">
																		 <label class="sr-only" for="exampleInputPassword2">Password</label>
																		 <input class="form-control" type="password" name="password" id="password" placeholder="Password"  onkeypress="javascript:if(event.keyCode == 13) formhash(this.main, this.main.password);" required>
							                                             <div class="help-block text-right"><a href="">Olvidaste tu password ?</a></div>
																	</div>
																	<div class="form-group">
																		 <input type="button" 
																		   value="Login" 
																		   onclick="formhash(this.form, this.form.password);"
																		   class="btn btn-primary btn-block" style="font-size: 22px;" />
																	</div>
																	

															 </form>
														</div>
														<div class="bottom text-center">
															<a href="register.php" style="font-size: 12px;"> <span >Eres nuevo?   </span><b>Registrate</b></a>
														</div>
												 </div>
											</li>
										</ul>
							        </li>
							  
							
							</ul>
						</nav>
					</div>
				</div>
			</header>		
		</div>

<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
?>

<link rel="stylesheet" type="text/css" href="./css/bootstrap-darkly.min.css">
<script src="js/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="./css/sweetalert.css">

<?php

$query = "SELECT id, titulo, descripcion, portada, premio FROM promocion LIMIT 1";
$stmt1 = $mysqli->prepare($query);
$stmt1->execute();
$stmt1->bind_result($id, $titulo, $descripcion, $portada, $premio);
$stmt1->fetch();
$stmt1->close();


if(isset($_POST['SubmitButton'])){ //check if form was submitted
	try {
		  $apellidopaterno = $_POST['apellidopaterno'];
		  $apellidomaterno = $_POST['apellidomaterno'];
		  $nombres = $_POST['nombres'];
		  $email = $_POST['email'];
		  $pais = $_POST['pais'];
		  $direccion = $_POST['direccion'];
		  $telefono = $_POST['telefono'];
		  $alumnoinnova = $_POST['alumnoinnova'];
		  $cursogustaria = $_POST['cursogustaria'];
		  $sugerencias = $_POST['sugerencias'];

		  $sqlpromocion ="INSERT INTO promociones (apellidopaterno, apellidomaterno, nombres, email, pais, direccion, telefono, alumnoinnova, cursogustaria, sugerencias)
		                     VALUES (?, ?, ?, ?, ?, ?, ? ,? ,? ,?)";
		$stmt = $mysqli->prepare($sqlpromocion);
		$stmt->bind_param("ssssssssss",$apellidopaterno, $apellidomaterno, $nombres, $email, $pais, $direccion, $telefono, $alumnoinnova, $cursogustaria, $sugerencias);
		$stmt->execute();
		?>

		<script type="text/javascript">
			alert("Bien hecho!", "Registramos tus datos correctamente!", "success")	
		</script>

		<?php

		  //$filename = 'congrat-you-paid-it.pdf'; //Name to display
		  //$file = $premio;    
		  
		  $file = './documentos/1.rar';
		  //$ext = pathinfo($premio, PATHINFO_EXTENSION);
		  // $filename = 'documento'.'.'.$ext;



		  //header("Content-Length: " . filesize ( $file ) ); 
		  //header('Content-type: application/octet-stream');
		  //header('Content-Disposition: attachment; filename=documento.rar');
		  //header('Expires: 0');
		//	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		//	ob_clean();
		//	flush();
		  //header('Content-Length: ' . filesize($file));
		//	set_time_limit( 0 );
		  //readfile($file);
		  //exit;
			
		header ("Location: $file");
		

			?>
			
			<?php
			//$stmt->execute(array($apellidopaterno, $apellidomaterno, $nombres, $email, $pais, $direccion, $telefono, $alumnoinnova, $cursogustaria, $sugerencias));
	} catch (Exception $ex) {
		?>
		<script type="text/javascript">
			sweetAlert("Oops...", "Something went wrong!", "error");
		</script>
		
		<?php
		
		//die ($ex->getMessage());

	}
  

}   

if (login_check($mysqli) == true) {
    $logged = 'in';
	#header('Location: pro/index.php');
} else {
    $logged = 'out';
}

?>
<!-- end:fh5co-header -->
<aside id="fh5co-hero" class="js-fullheight">
	<div class="flexslider js-fullheight">
		<ul class="slides">
	
	   	<li style="background-image: url('<?php echo $portada; ?>');">
	   	</li>
	  	</ul>
  	</div>
</aside>

<div id="fh5co-team-section">
	<div class="container">
		<div class="row">
				<div class="container">
			   			<div class="col-md-10 col-md-offset-1 text-center ">
			   				<div class="slider-text-inner desc">
			   					<h2 class="heading-section"><?php echo $titulo;?></h2>
			   					<p class="fh5co-lead">Desarrollando con <i class="icon-heart2"></i> la nueva enseñanza <a href="#" target="_blank">InnovaTrainingCenter</a></p>
			   				</div>
			   			</div>
			   		</div>
							<?php
								if (!empty($error_msg)) {
									echo $error_msg;
								}
							?>


		<div class="row" style="margin-left: 5%; margin-right: 5%;">
			<div class="col-lg-3">
            <div class="bs-component">
              <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Info!</strong> Lee esto <a href="#" class="alert-link">es un mensaje importante</a>.
                <p><?php echo $descripcion;?></p>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
          	<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']);?>" name="registration_form">
          		<input type="hidden" name="id" value="<?php echo $id;?>">
			<div class="row col-md-12">
				<div class="col-md-6">
					<label for="name">Apellido Paterno</label>
					<input required class="form-control" type="text" name="apellidopaterno"  />
				</div>
				<div class="col-md-6">
					<label for="name">Apellido Materno</label>
					<input required class="form-control" type="text" name="apellidomaterno"   />
				</div>
				<div class="col-md-6">
					<label for="name">Nombres</label>
					<input required class="form-control" type="text" name="nombres" />
				</div>
				<div class="col-md-6">
					<label for="email">Email</label>
					<input required class="form-control" type="email" name="email" id="email" />
					
				</div>
				<!--
				<div class="col-md-6">
					<label for="password">Telefono</label>
					<input class="form-control" type="password" name="password"   />
				</div>
				
				<div class="col-md-6">
					<label for="password">Rep-Contraseña</label>
					<input class="form-control" type="password" name="confirmpwd" />
				</div>		
				<div class="col-md-12">		
				<label for="sexo">Sexo</label>	
					<div class="row">
						<div class="col-md-10">
					    	<label class="radio-inline" for="demo-priority-low">
					    	<input type="radio" id="demo-priority-low" name="sexo" value="m" checked >Masculino</label>
							<label class="radio-inline" for="demo-priority-normal" >
							<input type="radio" id="demo-priority-normal" name="sexo" value="f" >Femenino</label>
							<label class="radio-inline" for="demo-priority-high" >
							<input type="radio" id="demo-priority-high" name="sexo" value="o" >Otros</label>
						</div>
					</div>
				</div>-->
				<div class="col-md-6">
					<label for="demo-category">Pais</label>
					<div class="select-wrapper">
						<select class="form-control" id="country" name="pais"></select>
						</select>
					</div>
				</div>
				<!--
				<div class="col-md-6">
					<label for="demo-category">Ciudad</label>
					<div class="select-wrapper">
						 <select class="form-control" name="state" id="state"></select>
						</select>
					</div>
				</div>-->
				<div class="col-md-6">
					<label for="name">Direccion</label>
					<input required class="form-control" type="text" name="direccion" />
				</div>
				<!--
				<div class="col-md-6">
					<label for="demo-name">Fecha de nacimiento</label>
					<input class="form-control" type="date" name="date" id="date"  />
				</div>-->
				<div class="col-md-6">
					<label for="tel">Telefono</label>
					<input required class="form-control" type="text" name="telefono" id="telefono"   />
				</div>
				<!--
				<div class="col-md-6">
					<label for="demo-category">Operador</label>
					<div class="select-wrapper">
						<select class="form-control" name="opera" id="demo-category">
							<option value="">Selecciona Operador</option>
							<option value="rpc">Claro(RPC)</option>
							<option value="c">Claro</option>
							<option value="rpm">Movistar(RPM)</option>
							<option value="m">Movistar</option>
							<option value="e">Entel</option>
							<option value="b">Bitel</option>
							<option value="o">Otro</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<label for="name">Grado Academico y Profesión</label>
					<input class="form-control" type="text" name="grado"  />
				</div>
				<div class="col-md-6">
					<label for="name">Institución de Procedencia</label>
					<input class="form-control" type="text" name="institu"   />
				</div>-->

				<!-- PREGUNTAS -->

				<div class="col-md-6">		
				<label for="alumnoinnova">¿Es alumno Innova en la actualidad?</label>	
					<div class="row">
						<div class="col-md-12">
					    	<label class="radio-inline" for="demo-priority-low">
					    	<input type="radio" id="demo-priority-low" name="alumnoinnova" value="y" checked >Si</label>
							<label class="radio-inline" for="demo-priority-normal" >
							<input type="radio" id="demo-priority-normal" name="alumnoinnova" value="n" >No</label>
						</div>
					</div>
				</div>


				<div class="col-md-12">		
					<label for="cursogustaria">¿Que curso le gustaria que se dicte en modalidad virtual?</label>	
					<input required class="form-control" type="text" name="cursogustaria" id="tel"   />
				</div>

				<div class="col-md-12">
					<label for="sugerencias">Por favor dejenos sugerencias para seguir mejorando</label>
					<textarea required class="form-control" name="sugerencias" rows="4" id="sugerencias"></textarea>
				</div>

				<!-- PREGUNTA END-->

				<div class="col-md-12" style="margin-top: 20px; text-align: center">	
					<button type="submit" name="SubmitButton" class="btn btn-info btn-lg btn-block">Participar</button>
				</div>
			</div>
		</form>
          </div>
		</div>
		
			
		</div>
	</div>
</div>			
<?php 
 include 'footer.php';
?>