<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){
					
		$xnomclasecur = leerParam("xnom","");
		$xcodid = leerParam("xcod","");	
		$img_clase = $xcodid."_clase.jpg";
?>	

<!-- Wrapper -->
		<aside id="fh5co-hero" class="js-fullheight">
			<div class="flexslider ">
				<ul class="slides">
			   	<li style="background-image: url(../images/clase/<?=$img_clase ?>)">
			   		<div class="overlay-gradient"></div>
			   		<div class="container">
			   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
			   				<div class="slider-text-inner desc">
			   					<h2 class="heading-section"><?= $xnomclasecur ?></h2>
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
						<h2>Cursos <?= $xnomclasecur ?></h2>
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
			`g`.`estado_grupo`
		FROM `grupos` `g`, `usuario` `u`,`horario` `h`  ,`cursos` `c`
		WHERE `g`.`id_profesor`=`u`.`id_usuario`
		AND  `g`.`id_horario`=`h`.`id_horario` 
		AND  `g`.`id_cursos`=`c`.`id_cursos` 
		AND `g`.`estado_grupo` = 'A'
		AND `c`.`id_clase_cursos`= ? ;")) {
	$stmt->bind_param('i', $xcodid);
	$stmt->execute();
	/* vincular variables a la sentencia preparada */
	$stmt->bind_result($xid, $xnom, $xprofn,$xprofp, $xprofm, $xhora, $xcurso, $descurso,$xprecio, $xfechini, $xfechfin, $xdura, $xmoda, $xesta);
	/* obtener valores */
	while ($stmt->fetch()) {
			$temp = substr($xnom, 0, 4); 
			$img = $xid."_".$temp;
			$descurso = substr($descurso, 0, 300);
			if($xmoda=='P'){
				$xmoda = "Presencial";
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
							<tr>
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
			$n ++;	
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
 
 
 