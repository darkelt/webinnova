<?php
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
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
	<script>
	/* Script written by Miguel Nunez @ minuvasoft10.com */
	function _(el){
		return document.getElementById(el);
	}
	function uploadFile(){
		var file = _("file1").files[0];
		//alert(file.name+" | "+file.size+" | "+file.type);
		var formdata = new FormData();
		formdata.append("file1", file);
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
		ajax.open("POST", "upload4.php");
		ajax.send(formdata);
	}
	function progressHandler(event){
		_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
		var percent = (event.loaded / event.total) * 100;
		_("progressBar").value = Math.round(percent);
		_("status").innerHTML = Math.round(percent)+"% Subiendo... espere porfavor";
	}
	function completeHandler(event){
		_("status").innerHTML = event.target.responseText;
		_("progressBar").value = 0;
	}
	function errorHandler(event){
		_("status").innerHTML = "Upload Failed";
	}
	function abortHandler(event){
		_("status").innerHTML = "Upload Aborted";
	}
	</script>

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
										<li><a href="cursos_sup_pack.php">Pack Cursos</a></li>
										<li><a href="cursos_sup_all.php">Todos los Cursos</a></li>
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
							          <a class="fh5co-sub-ddown" href="#"><b>Login</b></a>
										<ul id="login-dp" >
										</ul>
							        </li>
							  
							
							</ul>
						</nav>
					</div>
				</div>
			</header>		
		</div>
		<div class="clear"><br><br></div>
		<div id="fh5co-team-section">
						<div class="container">
							<div class="col-md-8 col-md-offset-2 ">
			   				
			   					<h2 class="heading-section text-center">Proyecto Final: REVIT</h2>
			   					<p class="bg-success">Seleccionar tu archivo de proyecto final  con sus nombres y apellidos : Ejemplo JUAN_PEREZ_MAMANI.rvt</p>
			   				
								<form id="upload_form" enctype="multipart/form-data" method="post">
								  <input  class="form-control" type="file" name="file1" id="file1"><br>

								  <input type="button" value="Subir Archivo" class="btn btn-default" onclick="uploadFile()">
								  <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
								  <h3 id="status"></h3>
								  <p id="loaded_n_total"></p>
								</form>
											   				
			   			</div>

						</div>
					<?php
								if ($stmt = $mysqli->prepare("SELECT `usuario`.`id_usuario`,
							    `usuario`.`apell_p_usuario`,
							    `usuario`.`apell_m_usuario`,
							    `usuario`.`nom_usuario`,
							    `usuario`.`password_usuario`,
							    `usuario`.`salt_usuario`
							FROM `u292000437_bdi`.`usuario` WHERE  `usuario`.`id_usuario`='1002' ;")) {
							$stmt->execute();

							/* vincular variables a la sentencia preparada */
							$stmt->bind_result($id, $nom1,$nom2,$nom, $pass, $sal);
							/* obtener valores */
							$stmt->fetch();


							echo $id."<br>";
							echo $nom1."<br>";
							echo $nom2."<br>";
							echo $nom."<br>";
							echo $pass."<br>";
							echo $sal."<br>";

							$pass_ini = $pass.$sal;
							echo $pass_ini."<br>";
						}


						exec("php -f ".JPATH_SITE."/campusinnova/enrol/database/cli/sync.php");



					?>
		</div>	
<footer>
			<div id="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<h3 class="section-title">Nosotros</h3>
							<p>Somos un grupo de profesionales con la visión de llegar a ser la mejor empresa de capacitación a nivel nacional e internacional, brindando un servicio de calidad en cada uno de nuestros cursos.</p>
						</div>
						<div class="col-md-4">
							<h3 class="section-title">Nuestra Dirección</h3>
							<ul class="contact-info">
								<li><i class="icon-map2"></i>Arequipa - Perú<br />
									Calle Ibañez #102<br />
									Urb. María Isabel, Cercado.</li>
								<li><i class="icon-phone2"></i>(054) #959-486461 RPM /(054)  959-155233 RPC</li>
								<li><i class="icon-envelope2"></i><a href="#">cursos@innovatrainingperu.com</a></li>
								<li><i class="icon-globe2"></i><a href="www.innovatrainingperu.com">www.innovatrainingperu.com</a></li>
							</ul>
						</div>
						
					</div>
					
				</div>
			</div>
		</footer>
	

	</div>
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->


	<!-- jQuery -->


	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>

	<!-- Main JS (Do not remove) -->
	<script src="js/main.js"></script>
	<script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script><script src="js/main.js"></script>

	</body>
</html>