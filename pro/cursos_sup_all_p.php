<?php 
include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){
		$error_msg = "";
		$xnomclasecur = leerParam("xnom","");
?>	

<!-- Wrapper -->
		<aside id="fh5co-hero" class="js-fullheight">
			<div class="flexslider ">
				<ul class="slides">
			   	<li style="background-image: url(../images/all_cursos.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container">
			   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
			   				<div class="slider-text-inner desc">
			   					<h2 class="heading-section">Todos Nuestros Cursos</h2>
			   					<p class="fh5co-lead">Desarrollando con <i class="icon-heart2"></i> la nueva enseñanza <a href="#" target="_blank">InnovaTrainingCenter</a></p>
			   				</div>
			   			</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<div id="fh5co-team-section">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
						<h2>Innova Training Center</h2>
						<p>Cada día más alumnos satisfechos con nuestros cursos. Siempre innovando en temas de Capacitación, siempre pensando en llevar tu carrera al siguiente nivel. </p>
					</div>
															
<?php					
	$n = 3;																	
	$cont= 2;
	if ($stmt = $mysqli->prepare("
		SELECT `g`.`id_grupo`,
			`g`.`nom_grupo`,
			`u`.`nom_usuario`,
			`u`.`apell_p_usuario`,
			`u`.`apell_m_usuario`,
			`h`.`desscripcion`,
			`c`.`nom_cursos`,
			`c`.`des_cursos`,
			`g`.`precio_curso_grupo`,
			`g`.`fecha_ini`,
			`g`.`fecha_fin`,
			`g`.`duracion_grupo`,
			`g`.`modalidad_grupo`,
			`g`.`estado_grupo`,
			`cla`.`id_clase_cursos`,
			`g`.`id_cursos`
		FROM `grupos` `g`, `usuario` `u`,`horario` `h`  ,`cursos` `c`,`clase_cursos` `cla`
		WHERE `g`.`id_profesor`=`u`.`id_usuario`
		AND  `g`.`id_horario`=`h`.`id_horario`
		AND  `c`.`id_clase_cursos`=`cla`.`id_clase_cursos`
		AND `g`.`estado_grupo` = 'A' 
		AND  `g`.`id_cursos`=`c`.`id_cursos` AND `modalidad_grupo` = 'P' ORDER BY `id_cursos` DESC;")) {

	$stmt->execute();
	/* vincular variables a la sentencia preparada */
	$stmt->bind_result($xid, $xnom, $xprofn,$xprofp, $xprofm, $xhora, $xcurso, $descurso,$xprecio, $xfechini, $xfechfin, $xdura, $xmoda, $xesta,$id_clase,$id_cursos);
	/* obtener valores */
	$anul=0;
	while ($stmt->fetch()) {
		if($anul != $id_cursos){
			$anul = $id_cursos;
			$img_clase = $id_clase."_clase.jpg";
			$temp = substr($xcurso, 0, 4); 
			$img = $id_cursos."_".$temp."_P";
			$descurso = substr($descurso, 0, 300);
			if($xmoda=='P'){
				$xmoda = "Presencial";
				$xnom = $xcurso;
			}
			else if($xmoda=='V'){
				$xmoda = "Virtual";
			}
			if(($n%3) == 0){
				echo "</div><div class='row'>";
			}
 			
				echo "<div class='col-md-4 fh5co-staff'>
						<a href='cursos_acti.php?xcod=$xid&xnom=$xnom&img=$img_clase'><img src='../images/curso/$img.jpg' alt='$img' class='img-responsive'></a>
						
					
						<table>
							<tr><b>$xnom</b></tr>
							<tr style='width:200px;'>
								<td><a class='curso-icons' href='#'><i class='icon-list22'></i></a></td>
								<td class='ajustar'><p>$descurso . . . .</p></td>
							</tr>
							<tr>
								<td><a class='curso-icons' href='#'><i class='icon-clock4'></i></a></td>
								<td><b>Horas:</b> $xdura</td>
							</tr>
							<tr>
								<td><a class='curso-icons' href='#'><i class='icon-write'></i></a></td>
								<td><b>Modalidad:</b>$xmoda</td>
							</tr>
							<tr>
								<td><a class='curso-icons' href='#'><i class='icon-credit-card'></i></a></td>
								<td><b>Inversion :</b> S/. $xprecio</td>
							</tr>
							<tr><td colspan='2'>
								<i>*Precio varia según localidad </i></td>
							</tr>
							<tr>
								<td  colspan='2'>
								<a class='btn btn-primary' href='matricula.php?xcod=$xid'> Pre-Matriculate</a>
								<a class='btn' href='cursos_acti.php?xcod=$xid&xnom=$xnom&img=$img_clase'> Mas detalles</a>
								</td>
							</tr>
						</table>
						<hr size='18px' color='black' />
					</div>
					";
				$n++;
		}				
	}

		/* cerrar la sentencia */
		$stmt->close();
	}
	$mysqli->close();
?>	
		</div>
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
 
 
 