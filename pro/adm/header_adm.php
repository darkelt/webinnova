
<?php  
		$xhoy = date("Y-m-d H:i:s");
		if ($_SESSION['permiso'] == 'A'){
			echo '		
						<div>
							<h2>Consola Administrador</h2>
						 </div>
						<nav class="navbar navbar-inverse">
							<div class="container-fluid">
								<ul class="nav navbar-nav">
									<li><a href="adm_cursos.php">Cursos</a></li>
									<li><a href="adm_user.php">Usuarios</a></li>
									<li><a href="adm_matricula.php">Matricula</a></li>
									<li><a href="adm_matricula_grupo.php">Grupos Matriculados</a></li>
									<li><a href="adm_grupos.php">Grupos</a></li>
									<li><a href="adm_pack.php">Pack</a></li>
									<li><a href="adm_desc.php">Descuentos</a></li>
									<li><a href="adm_horario.php">Horarios</a></li>
									<li><a href="adm_clase_cursos.php">Clase de curso</a></li>
									<li><a href="reportes.php">Reportes</a></li>
									<li><a href="adm_promocion.php">Promoción <span class="label label-warning">Nuevo</span></a></li>
									<li><a href="adm_promociones.php">Inscritos a Promoción <span class="label label-warning">Nuevo</span></a></li>
								</ul>
							</div>
						</nav>';	
		}

		else if($_SESSION['permiso'] == 'P'){
		 
			echo '		
						<div>
							<h2>Consola Profesor</h2>
						 </div>
						<nav class="navbar navbar-inverse">
							<div class="container-fluid">
								<ul class="nav navbar-nav">
									<li><a href="prof_matricula_grupo.php">Grupos</a></li>
									<li><a href="#">'.$xhoy .'</a></li>
									
								</ul>
							</div>
						</nav>';	
		}

?>
