<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		

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
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 


							<h3>Nuevo Grupo</h3>
							<form method="post" action="adm_grupos_grabar.php">
							  <input type=hidden name=tipo value="INSERT">
							  <div class="row">
							    <div class="col-md-12">
								    <div class="form-group">
								    	<label for="name">Nombre del Grupo</label>
										<input class="form-control" title="requiere un nombre" type="text" name="xnom"  required/>
								    </div>
								</div>
								<div class="col-md-6">
								    <div class="form-group">
									    <label for="demo-category">Profesor</label>
										<select class="form-control" name="xprof" id="demo-category"required>
											<option value="">Elija uno</option>
											<?php
												if ($stmt = $mysqli->prepare("
														SELECT `usuario`.`id_usuario`,
															   `usuario`.`nom_usuario`,
															   `usuario`.`apell_p_usuario`
														FROM `u292000437_bdi`.`usuario` WHERE `usuario`.`permiso_usuario` = 'P';")) {
														$stmt->execute();
														/* vincular variables a la sentencia preparada */
														$stmt->bind_result($id_p,$nom_p,$apell_p);
														/* obtener valores */
													while ($stmt->fetch()) {
														echo "<option value=$id_p>$nom_p $apell_p</option>";
													}
													/* cerrar la sentencia */
													$stmt->close();
												}
												
										  ?>
										</select>
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
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="demo-category">Curso</label>
										<select class="form-control" name="xcurso" id="demo-category"required>
											<option value="">Elija uno</option>
											<?php
												if ($stmt = $mysqli->prepare("
														SELECT `cursos`.`id_cursos`,
															`cursos`.`nom_cursos`
														FROM `u292000437_bdi`.`cursos`;")){
														$stmt->execute();
														/* vincular variables a la sentencia preparada */
														$stmt->bind_result($id, $nom);
														/* obtener valores */
													while ($stmt->fetch()) {
														echo "<option value=$id>$nom</option>";
													}
													/* cerrar la sentencia */
													$stmt->close();
												}
												
										  ?>
										</select>
								    </div>
							    </div>
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="name">Precio del Grupo </label>
										<input class="form-control" type="text" name="xprecio"  pattern="^\d+(?:\.\d{0,2})$" required/>
								    </div>
							    </div>
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="name">Precio del Grupo Dolar </label>
										<input class="form-control" type="text" name="xprecio_dolar"  pattern="^\d+(?:\.\d{0,2})$" required/>
								    </div>
							    </div>
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="name">Tipo de cambio </label>
										<input class="form-control" type="text" name="tc"  pattern="^\d+(?:\.\d{0,2})$" required/>
								    </div>
							    </div>
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="demo-name">Fecha de inico</label>
										<input class="form-control" type="date" name="xfechini" id="date"  required/>
								    </div>
							    </div>
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="demo-name">Fecha de Finalización</label>
										<input class="form-control" type="date" name="xfechfin" id="date"  required/>
								    </div>
							    </div>
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="name">Duracion del grupo</label>
										<input class="form-control" type="text" name="xdura" required/>
								    </div>
							    </div>
							    <div class="col-md-6">
								    <div class="form-group">
								    	<label for="demo-category">Modalidad</label>
										<select class="form-control" name="xmoda" id="demo-category" required>
											<option value="">- Selecciona Estado -</option>
											<option value="P">Presencial </option>
											<option value="V">Virtual</option>
										</select>
								    </div>
							    </div>
								<div class="col-md-6">
									<label for="demo-category">Ciudad</label>
									<div class="select-wrapper">
										 <select class="form-control" name="state" id="state"></select>
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
								    <button type="submit" class="btn btn-default">Grabar</button>
							    </div>
							  </div>
							</form>	
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
 