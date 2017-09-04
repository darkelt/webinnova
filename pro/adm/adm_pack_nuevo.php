<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
		$tipo = leerParam("xtipo",null);
		$ciudad = leerParam("state",null);
		if($tipo == 'P'){
			$sentsql = "SELECT `grupos`.`id_grupo`, `grupos`.`nom_grupo`, `grupos`.`localidad` FROM `grupos` WHERE `modalidad_grupo`= 'P' AND `localidad` = '$ciudad'  AND `estado_grupo` = 'A' ORDER BY `id_grupo` DESC ";

		}
		if($tipo == 'V'){
			$sentsql= "SELECT `grupos`.`id_grupo`, `grupos`.`nom_grupo`, `grupos`.`localidad` FROM `grupos` WHERE `modalidad_grupo`= 'V'  AND  `estado_grupo` = 'A' ORDER BY `id_grupo` DESC;";
		}
?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		

<script language="javascript">
var s_a = new Array();
s_a[180] = "Amazonas|Ancash|Apurimac|Arequipa|Ayacucho|Cajamarca|Callao|Cusco|Huancavelica|Huanuco|Ica|Junin|La Libertad|Lambayeque|Lima|Loreto|Madre de Dios|Moquegua|Pasco|Piura|Puno|San Martin|Tacna|Tumbes|Ucayali|Mexico-Chiapas";

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

<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 
							<h3>Nuevo Pack</h3>
							<form method="post" action="adm_pack_nuevo.php">
								<input type=hidden name=buscar value="NGRUPO">
								  <div class="row">
								    <div class="col-md-6">
									    <div class="form-group">
									    	<select class="form-control" name="xtipo" id="demo-category" onchange="myFunction()" required>
												<option value="">Elije Modalilad</option>
												<option value="V">Virtual</option>
												<option value="P">Presencial</option>
											</select>
									    </div>
									</div>
									<div class="col-md-6">
										<div class="select-wrapper">
											 <select class="form-control" name="state" id="state"></select>
											</select>
										</div>
									</div>
								    <div class="col-md-12">
									    <button type="submit" class="btn btn-default">Empezar</button>
								    </div>
							  </div>
							</form>

<?php
					if(isset($tipo)){
?>
 
							<form method="post" action="adm_pack_grabar.php">
							  <input type=hidden name=tipo value="INSERT">
							  <input type=hidden name=moda value="<?=$tipo?>">
							  <div class="row">
							    <div class="col-md-12">
								    <div class="form-group">
								    	<label for="name">Nombre del Pack</label>
										<input class="form-control" title="requiere un nombre" type="text" name="nom_pack"  required/>
								    </div>
								</div>
								<div class="col-md-12">
								    <div class="form-group">
								    	<label for="name">Descripcion Pack</label>
										<textarea class="form-control" name="descrip_pack" id="demo-message" rows="6" required></textarea>
								    </div>
								</div>
								<div class="col-md-6">
								    <div class="form-group">
								    	<label for="demo-name">Fecha de inico</label>
										<input class="form-control" type="date" name="fechini" id="date"  required/>
								    </div>
							    </div>
							     <div class="col-md-6">
								    <div class="form-group">
								    	<label for="name">Duracion del pack</label>
										<input class="form-control" type="text" name="dura" required/>
								    </div>
							    </div>
							    <div class="col-md-12">
								    <div class="form-group">
								    	<label for="demo-category">Eliga cursos</label>
									</div>
									<?php
										if ($stmt = $mysqli->prepare($sentsql)){
														$stmt->execute();
														/* vincular variables a la sentencia preparada */
														$stmt->bind_result($id, $nom , $local);
														/* obtener valores */
													while ($stmt->fetch()) {
														echo '
														<div class="col-md-6">
														<div class = "checkbox">
															   <label>
															      <input type="checkbox"  name="grupos[]" value='.$id.'>'.$nom.'
															   </label>
															</div></div>
															';
													}
													/* cerrar la sentencia */
													$stmt->close();
												}
												
										  ?>
										</select>



								    
							    </div>
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="name">% descuento "00.00"</label>
										<input class="form-control" type="text" id="xfdes" name="fdes_pack" value="" onkeyup="myFunction2()"  required>
								    </div>
							    </div>
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="demo-category">Horario</label>
										<select class="form-control" name="xhora" id="demo-category"required>
											<option value="">Elija uno</option>
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
														echo "<option value=$id>$nom : $des</option>";
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
								    <button type="submit" class="btn btn-default">Crear Pack</button>
							    </div>
							  </div>
							</form>	


	</div>
</div>
<?php }?>
		<script language="javascript">
			 populateStates("state");
		</script>

<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
 <?php 
	}
			else { 
				header('Location: ../../login.php?error=2');
			} 
	} else { 

		header('Location: ../../login.php?error=3');
    } 
 include 'footer.php';?>		
 