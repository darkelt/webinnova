<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){
					
			$xnomclasecur = leerParam("xnom","");
			$img_clase = leerParam("img","");
?>
	<aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
		   	<li style="background-image: url(../images/clase/<?=$img_clase ?>)">
		   		<div class="overlay-gradient"></div>
		   		<div class="container">
		   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
		   				<div class="slider-text-inner desc">
		   					<h2 class="heading-section"><?php echo"$xnomclasecur";?></h2>
		   					<p class="fh5co-lead">Solidez en el saber, Destreza en el hacer e Integridad en el ser.</p>
		   				</div>
		   			</div>
		   		</div>
		   	</li>
		  	</ul>
	  	</div>
	</aside>
	<div id="fh5co-team-section">
		<div class="container">
			<div class="row acti">
				<div class="col-md-8">
									
<?php					
	$xcodid = leerParam("xcod","");	
	revisardesc($mysqli, $xcodid);

	if ($stmt = $mysqli->prepare("SELECT `g`.`id_grupo`,
										`g`.`nom_grupo`,
										`u`.`nom_usuario`,
										`u`.`apell_p_usuario`,
										`u`.`apell_m_usuario`,
										`h`.`nom_horario`,
										`h`.`desscripcion`,
										`c`.`nom_cursos`,
										`c`.`des_cursos`,
										`g`.`precio_curso_grupo`,
										`g`.`fecha_ini`,
										`g`.`fecha_fin`,
										`g`.`duracion_grupo`,
										`g`.`modalidad_grupo`,
										`g`.`estado_grupo`,
										`g`.`id_cursos`
									FROM `grupos` `g`, `usuario` `u`,`horario` `h`  ,`cursos` `c`
									WHERE `g`.`id_profesor`=`u`.`id_usuario`
									AND  `g`.`id_horario`=`h`.`id_horario` 
									AND  `g`.`id_cursos`=`c`.`id_cursos` 
									AND `g`.`estado_grupo` = 'A'
									AND `g`.`id_grupo`= ? ;")) {
	$stmt->bind_param('i', $xcodid);
	$stmt->execute();
	/* vincular variables a la sentencia preparada */
	$stmt->bind_result($xid, $xnom, $xprofn,$xprofp, $xprofm,$nomhora, $xhora, $xcurso, $descurso,$xprecio, $xfechini, $xfechfin, $xdura, $xmoda, $xesta, $id_cursos);
	/* obtener valores */

	$stmt->fetch();
	$stmt->close();
	if ($stmt = $mysqli->prepare("SELECT `contenido_cursos`.`primer_contenido_cursos`
									FROM `u292000437_bdi`.`contenido_cursos` 
									WHERE `contenido_cursos`.`id_cursos` = ?;")) {
			$stmt->bind_param('i',  $id_cursos);
			$stmt->execute();
			/* vincular variables a la sentencia preparada */
			$stmt->bind_result($xcontec);
			/* obtener valores */
			$c=0;
		while ($stmt->fetch()) {
			$contenido[$c] = $xcontec;
			$c++;
		}
		/* cerrar la sentencia */
																	
	}
	$stmt->close();

	if ($stmt = $mysqli->prepare("SELECT `d`.`nom_desc`,`d`.`descrip_desc` FROM `descuentos` `d` , `grupos` `g` WHERE `d`.`id_grupo` = `g`.`id_grupo` AND `d`.`id_grupo`  = ?  AND `d`.`estado`='A' AND not (`d`.`nom_desc` LIKE '%pack%'); ")) {
	    $stmt->bind_param('i',  $xcodid);
		$stmt->execute();
		/* vincular variables a la sentencia preparada */	
		$stmt->store_result();
		$stmt->bind_result($xnomd, $xdesd);
		/* obtener valores */
		$c=0;
		while ($stmt->fetch()) {
			$descuento[$c] = $xnomd.": ".$xdesd;
			$c++;
		}
		/* cerrar la sentencia */																		
	}
	
	if($xmoda=='P'){
		$temp = substr($xcurso, 0, 4); 
		$img = $id_cursos."_".$temp."_P";
	}else{
		$temp = substr($xnom, 0, 4); 
		$img = $xid."_".$temp;
	}

	echo "	<h3>";
	if($xmoda=='P'){
		echo $xcurso;
	}else{
		echo $xnom;
	}
	echo "</h3>							
			<h4>DATOS DEL CURSO</h4>
			<ul>
				<li><b>Descripción:</b>
				$descurso
				</li>
				<li><b>Duración: </b>
					   $xdura </li>
				<li><b>Docente: </b>
				 Ing. $xprofn $xprofp  $xprofm
				</li>";
				if($xmoda=='P'){
					echo "<li><b>Ciudades disponibles:</b>"; 
					if ($stmt = $mysqli->prepare("SELECT `grupos`.`id_horario`,
														`horario`.`nom_horario`,
												        `horario`.`desscripcion`,
														`grupos`.`localidad`
												FROM `grupos` ,  `horario`  WHERE `grupos`.`id_horario` = `horario`.`id_horario` AND`id_cursos` = ? AND `modalidad_grupo`= 'P' AND `estado_grupo`='A';")) {
							$stmt->bind_param('i',  $id_cursos);
							$stmt->execute();
							/* vincular variables a la sentencia preparada */
							$stmt->bind_result($id_hora, $nom , $desc , $local);
							/* obtener valores */
							$c=0;
							$temps=0;
							while ($stmt->fetch()) {
								$con[$c] = $nom." - ".$desc;
								$c++;
								$array_local[$c] = $local;
							}
						/* cerrar la sentencia */
																					
					}
					$un = array_unique($array_local); 
					$un=array_values($un);
					foreach($un as $value) {
						echo $value ."/";
					}

					$uniq = array_unique($con); 
					$uniq=array_values($uniq);
					echo"</li>";
					echo "<li><b>Horario disponibles:</b><br>";
					foreach($uniq as $value) {
						echo $value ."/<br>";
					}
					"</li>";
				}
				else if($xmoda=='V'){
				}

				echo"
				<li><b>Inicio: </b>";
				if($xfechini=='0001-01-01'){
					echo "Acceso inmediato";
				}
				else{ 
					echo"$xfechini";
				}	



					 echo"</li>
				<li><b>Modalidad: </b>";
				if($xmoda=='P'){
					echo "Presencial";
				}
				else if($xmoda=='V'){
					echo "Virtual";
				}
				echo"</li>
			</ul>
			<h4>CONTENIDO</h4>
			<ul>";
			$arrlength = count($contenido);
			for($x = 0; $x < $arrlength; $x++) {
				echo "<li>";
				echo $contenido[$x];
				echo "</li>";
			}
			echo "
			</ul>";
			/* cerrar la sentencia */
			$stmt->close();
		}
		$mysqli->close();
?>
									
				</div>
				<div class="col-md-4">
					<?php echo "<img src='../images/curso/$img.jpg' alt='$img' class='img-responsive'>"; ?>
					<br>
					<h4>PROCEDIMIENTO DE INSCRIPCIÓN</h4>	
									<ol>
										<li>Reserva Tu Matricula (PRE - INSCRIPCIÓN)</li>
										<li>Deposito: Deposito en el Banco BCP </li>
										<li>Enviar Voucher Escaneado al correo:cursos@innovatrainingperu.com</li>
										<li>Recibirán- un correo de confirmación de su Matricula.</li>

					</ol>
						<h4>DESCUENTOS</h4>	
									<ul>
								<?php $arrlength = count($descuento);
												for($x = 0; $x < $arrlength; $x++) {
													echo "<li>";
													echo $descuento[$x];
													echo "</li>";
												}
							

						$url="cursos_acti_pro.php?xcod=".$xcodid;
						
						
						echo "<i>* Los descuentos no son acumulables.</i>
									</ul>
									<a class='btn btn-primary' href='matricula.php?xcod=$xid'> Pre-Matriculate</a>
							
						";?>
				</div>
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
