<?php
include_once '../includes/register.inc.php';
include_once '../includes/functions.php';

sec_session_start();

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
	<link rel="icon" type="image/ico" href="../images/icoinnova.ico" />
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
	<link rel="stylesheet" href="../css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="../css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="../css/bootstrap-social.css">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="../css/superfish.css">
	<!-- Flexslider  -->
	<link rel="stylesheet" href="../css/flexslider.css">

	<link rel="stylesheet" href="../css/style.css">



	<!-- Modernizr JS -->
	<script type="text/JavaScript" src="../js/countries2.js"></script>
	<script src="../js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="../js/respond.min.js"></script>
	<![endif]-->


	<?php
		if (isset($_GET['error'])) {
			echo '
<script>

    alert("Error al Ingresar !!!.. Intente nuevamente");

</script>>';
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
						<h1 id="fh5co-logo"><a href="index.php"><img src="../images/logo.jpg" width="206" height="67" aling="top" alt="Logo innova Training"></a></h1>
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
									<a class="fh5co-sub-ddown <?php 
												if(strstr($_SERVER['REQUEST_URI'], 'cursos.php')){
												echo 'active';
												}
												?>">Cursos</a>
									 <ul class="fh5co-sub-menu">
										<li>
											<a href="cursos.php"  class="fh5co-sub-ddown">Clases de cursos</a>
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
						          <a  class="fh5co-sub-ddown user-icons" href=<?php if ($_SESSION['permiso'] == 'A'){
															echo "'adm/admin.php'";	
														}
														else if($_SESSION['permiso'] == 'U'){
														  echo "perfil.php";	
														}
														else if($_SESSION['permiso'] == 'P'){
														  echo "adm/prof_matricula_grupo.php";	
														}
												?>><?php if (isset($_SESSION['username'])){
													       $temp = htmlentities($_SESSION['username']);
													       $picture = str_replace("http", "https", htmlentities($_SESSION['url_picture']));
													       $nomuser = explode(" ", $temp);
													       echo $nomuser[0]." ";
													       if (!$_SESSION['url_picture']==NULL){
													       		echo "<img src='".$picture."' style='position: absolute; top: 25px; left: 105px;'class='img-circle' alt='facebook' width='50' height='50'>"; 
													       }else{
													       		echo "<i class='icon-user3'></i>";

													       }
													       

														}
														else{
														echo "Ingresa a Innova";	
														}
												?></a>
						         
									<ul id="login-dp" >
										<li><a href="../pro/perfil.php"><?php if (isset($_SESSION['username'])){
														echo htmlentities($_SESSION['username']);
														echo " - ";
														echo htmlentities($_SESSION['user_id']);
														}
														else{
															
														echo "Ingresa a Innova";	
														}
												?></a></li>	
										<li class="text-center";><a href="../includes/logout.php"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesion</a></li>
									</ul>
						        

						        </li>
							  
							
							</ul>
						</nav>
					</div>
				</div>
			</header>		
		</div>