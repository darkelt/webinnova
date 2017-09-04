<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
		
?>
<!-------------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 
<?php
		$id_pack = leerParam("xcod","");
		if ($stmt = $mysqli->prepare("SELECT 
								    `pack`.`nom_pack`,
								    `pack`.`factor_pack`,
								    `pack`.`descrip_pack`,
								    `pack`.`horas_pack`,
								    `pack`.`fecha_ini`,
								    `pack`.`estado`,
								    `pack`.`id_horario`
								FROM `pack` WHERE `pack`.`id_pack` = ?;")) {
			$stmt->bind_param('i', $id_pack);
			$stmt->execute();
				/* vincular variables a la sentencia preparada */
			$stmt->bind_result($xnom, $factor,$descrip, $horas ,$fecha_ini , $estado, $xhora);
				/* obtener valores */
			$stmt->fetch();
			$stmt->close();
		}
?>
<script language="javascript">
var s_a = new Array();
s_a[180] = "Amazonas|Ancash|Apurimac|Arequipa|Ayacucho|Cajamarca|Callao|Cusco|Huancavelica|Huanuco|Ica|Junin|La Libertad|Lambayeque|Lima|Loreto|Madre de Dios|Moquegua|Pasco|Piura|Puno|San Martin|Tacna|Tumbes|Ucayali";

function populateStates(stateElementId) {
    var stateElement = document.getElementById(stateElementId);
    stateElement.length = 0; // Fixed by Julian Woods
    stateElement.options[0] = new Option('Selecciona Ciudad', '');
    stateElement.selectedIndex = 0;
    var state_arr = s_a[180].split("|");
    for (var i = 0; i < state_arr.length; i++) {
        stateElement.options[stateElement.length] = new Option(state_arr[i], state_arr[i]);
    }
}

</script>

							<h3>Editar PACK</h3>
							
							<form method="post" action="adm_pack_grabar.php">
							  <input type=hidden name=tipo value="UPDATE">
							  <input type="hidden" name="xcod" value="<?php echo $id_pack; ?>">
							  <div class="row">
							    <div class="col-md-12">
								    <div class="form-group">
								    	<label for="name">Nombre del Pack</label>
										<input class="form-control" title="requiere un nombre" type="text" name="nom_pack" value="<?= $xnom ?>" required/>
								    </div>
								</div>
								<div class="col-md-12">
								    <div class="form-group">
								    	<label for="name">Descripcion Pack</label>
										<textarea class="form-control" name="descrip_pack" id="demo-message" rows="6" required><?= $descrip ?></textarea>
								    </div>
								</div>
								<div class="col-md-6">
								    <div class="form-group">
								    	<label for="demo-name">Fecha de inico</label>
										<input class="form-control" type="date" name="fechini" id="date" value="<?= $fecha_ini ?>"  required/>
								    </div>
							    </div>
							     <div class="col-md-6">
								    <div class="form-group">
								    	<label for="name">Duracion del pack</label>
										<input class="form-control" type="text" name="dura" value="<?= $horas ?>" required/>
								    </div>
							    </div>
							   
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="name">% descuento "00.00"</label>
										<input class="form-control" type="text" id="xfdes" name="fdes_pack" value="<?= $factor ?>" onkeyup="myFunction2()"  required>
								    </div>
							    </div>
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="demo-category">Horario</label>
										<select class="form-control" name="xhora" id="demo-category"required>
											<option value="<?php echo $xhora; ?>"><?php echo $xhora; ?></option>
											<?php
												if ($stmt = $mysqli->prepare("
														SELECT `horario`.`id_horario`,
															`horario`.`nom_horario`,
															`horario`.`desscripcion`
														FROM `u292000437_bdi`.`horario`;")) {
														$stmt->execute();
														/* vincular variables a la sentencia preparada */
														$stmt->bind_result($id,$nom,$des);
														/* obtener valores */
													while ($stmt->fetch()) {
														echo "<option value=$id>$nom :$des</option>";
													}
													/* cerrar la sentencia */
													$stmt->close();
												}
												
										  ?>
										</select>
								    </div>
							    </div>
							    <div class="col-md-12">
								    <div class="form-group">
								    	<label class="radio-inline" for="demo-priority-low">
								    	<input type="radio" id="demo-priority-low" name="xestado" value="A" checked >Activo</label>
										<label class="radio-inline" for="demo-priority-normal" >
										<input type="radio" id="demo-priority-normal" name="xestado" value="X" >Inactivo</label>
								    </div>
							    </div>
							    <div class="col-md-12">
								    <button type="submit" class="btn btn-default">Modificar</button>
							    </div>
							  </div>
							</form>
		</div>
	</div>
</div>
		<script language="javascript">
			 populateStates("state");
		</script>

<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
 <?php }
			else { 
				header('Location: ../../login.php?error=2');
			} 
	} else { 

		header('Location: ../../login.php?error=3');
    } 
 include 'footer.php';?>		