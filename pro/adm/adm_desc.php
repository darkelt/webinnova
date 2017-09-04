<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 

					<?php 
						$datos  = leerParam("xgrupo","");
						$buscar  = leerParam("buscar","");
						if ($datos != NULL){
							list($xcod_g, $xnom_g) = explode("*", $datos);
						}else{

							$xcod_g = "0";
							$xnom_g = "Escoge un grupo";
						}
					?>
					<div class="col-md-12  text-center">
						<h3><?php echo $xnom_g;?></h3>
					</div>
					<div class="col-md-12">	
						<form method="post" action="adm_desc.php">
							<input type=hidden name=buscar value="NGRUPO">
						  	<div class="row">
						    	<div class="col-md-8">
							   		<div class="form-group">
							    	<select class="form-control" name="xgrupo"  required>
										<option value="">Elije Grupo</option>
										<?php
											if ($stmt = $mysqli->prepare("SELECT `grupos`.`id_grupo`,
																				`grupos`.`nom_grupo`,
																				`grupos`.`localidad`,
																				`grupos`.`modalidad_grupo`
																								FROM `grupos`  
																								WHERE `grupos`.`estado_grupo`= 'A' 
																								ORDER BY `localidad` ,`id_grupo`;")) {
													$stmt->execute();
													/* vincular variables a la sentencia preparada */
													$stmt->bind_result($id,$nom,$localidad,$moda);
													/* obtener valores */
												while ($stmt->fetch()) {
													echo "<option value='$id*$nom'>$id - $nom - $localidad /$moda</option>";
														
												}

												/* cerrar la sentencia */
											}
									  ?>
									</select>
							    </div>
							</div>
						    <div class="col-md-4">
							    <button type="submit" class="btn btn-default">Buscar</button>
						    </div>
						  </div>
						</form>
					</div>
					<div class="col-md-12">	
						<form method="post" action="adm_desc.php">
							<input type=hidden name=buscar value="NPACK">
						  	<div class="row">
						    	<div class="col-md-8">
							   		<div class="form-group">
							    	<select class="form-control" name="xgrupo"  required>
										<option value="">Elije Paquete</option>
										<?php
										if ($stmt = $mysqli->prepare("SELECT
												`d`.`id_desc`,
                                                `d`.`nom_desc`
											FROM  `descuentos` `d`
                                            WHERE  `d`.`nom_desc` LIKE '%PACK%'  order by `nom_desc` ;")) {
												$stmt->execute();																		
												/* vincular variables a la sentencia preparada */
												$stmt->bind_result($xid, $xnom);
												/* obtener valores */
												$c = 0;
												while ($stmt->fetch()) {
													$array[$c] = $xnom;
													$c++ ;
												}
												$stmt->close();
											}
											$uniq = array_unique($array); 
											$uniq=array_values($uniq);
											foreach($uniq as $value) {//imprimimos $sin_duplicados
											 		$nom= $value;
											 		echo "<option value='$nom*$nom'>$nom</option>";				
											 			
															
											 }
							 		
									  ?>
									</select>
							    </div>
							</div>
						    <div class="col-md-4">
							    <button type="submit" class="btn btn-default">Buscar</button>
						    </div>
						  </div>
						</form>
					</div>
					<div class="col-md-12">
						<a href="adm_desc_nuevo.php" class="btn btn-primary" role="button">Nuevo Descuento</a>	
					</div>
					<table class="table table-striped">
						<thead>
							<tr><th>Id</th>
								<th>Name</th>
								<th>% Descuento</th>
								<th>Descripción</th>
								<th>Grupo</th>
								<th>Estado</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
													
<?php		
	if($buscar =="NGRUPO"){
		if ($stmt = $mysqli->prepare("
				SELECT `descuentos`.`id_desc`,
					`descuentos`.`nom_desc`,
					`descuentos`.`factor_desc`,
					`descuentos`.`descrip_desc`,
					`descuentos`.`id_grupo`,
                    `grupos`.`nom_grupo`,
					`descuentos`.`estado`
				FROM `descuentos`, `grupos`  WHERE `descuentos`.`id_grupo`= `grupos`.`id_grupo` AND `descuentos`.`id_grupo` = ? AND `grupos`.`estado_grupo` = 'A';")) {
				$stmt->bind_param('i', $xcod_g);
				$stmt->execute();
				/* vincular variables a la sentencia preparada */
				$stmt->bind_result($id,$nom, $fdesc, $des ,$id_grup, $grup ,$estado);
				/* obtener valores */
			while ($stmt->fetch()) {
				echo "<tr>	
							<td>$id</td>
							<td>$nom</td>
							<td>";echo number_format($fdesc, 2); echo"</td>								
							<td>$des</td>
							<td>$grup</td>
							<td>$estado</td>
							<td><a href='adm_desc_editar.php?xcod=$id' class='btn btn-default'>Editar</a><br>
					  </tr>";							
			}

			/* cerrar la sentencia */
			$stmt->close();
		}
	}
	if($buscar == "NPACK"){
		if ($stmt = $mysqli->prepare("
				SELECT `descuentos`.`id_desc`,
					`descuentos`.`nom_desc`,
					`descuentos`.`factor_desc`,
					`descuentos`.`descrip_desc`,
					`descuentos`.`id_grupo`,
                    `grupos`.`nom_grupo`,
					`descuentos`.`estado`
				FROM `descuentos`, `grupos`  WHERE `descuentos`.`id_grupo`= `grupos`.`id_grupo` AND `descuentos`.`nom_desc` = ? AND NOT `descuentos`.`estado` = 'E';")) {
				$stmt->bind_param('s', $xcod_g);
				$stmt->execute();
				/* vincular variables a la sentencia preparada */
				$stmt->bind_result($id,$nom, $fdesc, $des ,$id_grup, $grup ,$estado);
				/* obtener valores */
			while ($stmt->fetch()) {
				echo "<tr>	
							<td>$id</td>
							<td>$nom</td>
							<td>";echo number_format($fdesc, 2); echo"</td>								
							<td>$des</td>
							<td>$grup</td>
							<td>$estado</td>
							<td><a href='adm_desc_editar.php?xcod=$id' class='btn btn-default'>Editar</a><br>
					  </tr>";							
			}

			/* cerrar la sentencia */
			$stmt->close();
		}
	}

?>
														
					</tbody>
				</table>
			</div>									
		</div>
</div>													
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
 <?php }
			else { 
				header('Location: ../../login.php?error=2');
			} 
	} else { 

		header('Location: ../../login.php?error=3');
    } 
 include 'footer.php';?>		
 
 
 