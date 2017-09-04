<!--

// Matriculas por fecha 

// Todos los matriculados en todos los cursos

// Los no matriculados en ningun curso

// Todos los usuarios

// Matriculados de arequipa (ciudad)

// Matriculados por pack

-->

<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<style type="text/css">
	.card-report {
  border-radius: 4px;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05), 0 0 0 1px rgba(63, 63, 68, 0.1);
  background-color: #FFFFFF;
  margin-bottom: 30px;
  padding: 15px;
}

</style>

<script type="text/javascript">


    $(document).ready(function(){
        periodoChange();

        $('#matriculas').submit(function(event){
        	var val=$("#grupo").val();

			var obj=$("#grupos").find("option[value='"+val+"']")

			if(obj !=null && obj.length>0)
				console.log("valid");  // allow form submission
			else
				console.log("invalid"); // don't allow form submission
        })

        function periodoChange()
        {
            var valorPeriodo = $('#periodo').val();
            console.log(valorPeriodo);

            if (valorPeriodo == "0")
            {
            	$('#fechainicio').removeAttr('disabled');
                $('#fechafin').removeAttr('disabled');
                $('#filtrarfecha').removeAttr('disabled');
            } else {
            	$('#fechainicio').attr('disabled', 'disabled');
            	$('#fechafin').attr('disabled', 'disabled');
            	$('#filtrarfecha').attr('disabled', 'disabled');
            	$('#filtrarfecha').val(false);
            }
        }

        function filtrarFechaChange(){
        	var valorFiltrarFecha = $('#filtrarfecha').val();
        	if (valorFiltrarFecha){

        	} else {

        	}
        }

        $('#periodo').change(periodoChange);
        $('#filtrarfecha').change(filtrarFechaChange);

    })

</script>



<script language="javascript">
var s_a = new Array();
s_a[180] = "Amazonas|Ancash|Apurimac|Arequipa|Ayacucho|Cajamarca|Callao|Cusco|Huancavelica|Huanuco|Ica|Junin|La Libertad|Lambayeque|Lima|Loreto|Madre de Dios|Moquegua|Pasco|Piura|Puno|San Martin|Tacna|Tumbes|Ucayali";


//select DISTINCT ciudad_usuario from usuario

function populateStates(stateElementId) {

    var stateElement = document.getElementById(stateElementId);

    stateElement.length = 0;
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
			<h3>Reportes</h3>
			<div class="card-report">
				<form method="post" id="matriculas" action="../reportes/matriculas.php">
				<h4>Matricula</h4>
				<div class="row">
					<div class="col-md-4">
			  			<label for="demo-category">Periodo</label>
						<div class="select-wrapper">
							 <select class="form-control" name="periodo" id="periodo">
							 	<option value="0">Todos</option>
							 	<option value="1">Enero</option>
							 	<option value="2">Febrero</option>
							 	<option value="3">Marzo</option>
							 	<option value="4">Abril</option>
							 	<option value="5">Mayo</option>
							 	<option value="6">Junio</option>
							 	<option value="7">Julio</option>
							 	<option value="8">Agosto</option>
							 	<option value="9">Septiembre</option>
							 	<option value="10">Octubre</option>
							 	<option value="11">Noviembre</option>
							 	<option value="12">Diciembre</option>
							</select>
						</div>
			  		</div>
			  		<div class="col-md-2">
			  			<div class="form-group">
			  				<br>
							<div class = "checkbox">
							   <label>
							      <input id="filtrarfecha" name="filtrarfecha" type="checkbox" unchecked>¿Filtar por fecha?
							   </label>
							</div>
					    </div>
			  		</div>
			  		<div class="col-md-3">
					    <div class="form-group">
					    	<label for="demo-name">Fecha de Inicio</label>
							<input class="form-control" type="date" name="fechainicio" id="fechainicio" name="fechainicio" required value="<?php echo date('Y-m-d');?>" />
					    </div>
					</div>
					<div class="col-md-3">
					    <div class="form-group">
					    	<label for="demo-name">Fecha de Fin</label>
							<input class="form-control" type="date" name="fechafin" id="fechafin" name="fechafin" required value="<?php echo date('Y-m-d');?>"/>
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
						<label for="demo-name">Matricula</label>
							<select name="confirma_matricula" class="form-control">
								<option value="all">-------Todos-----</option>
								<option value="x">Prematricula</option>
								<option value="M">Matriculado</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						<label for="demo-name">Estado de Matricula</label>
							<select name="estado_matricula" class="form-control">
								<option value="all">-------Todos-----</option>
								<option value="a">Activa</option>
								<option value="x">Eliminada</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for="demo-name">Grupo</label>
							<input type="text" name="id_grupo" id="grupo" class="form-control" list="grupos" value="all">
					    	<datalist name="grupo_id" id="grupos" required>
								<option data-value="-----Todos-----" value="all">-------Todos-----</option>
								<?php
									if ($stmt = $mysqli->prepare("
											SELECT `grupos`.`id_grupo`,
												`grupos`.`nom_grupo`,
										    `grupos`.`localidad`,
										    `grupos`.`modalidad_grupo`
											FROM `u292000437_bdi`.`grupos`  
											WHERE `grupos`.`estado_grupo`= 'A'
											OR `grupos`.`estado_grupo`= 'F'  
											ORDER BY `localidad`,`id_grupo` ;")) {
											$stmt->execute();
											/* vincular variables a la sentencia preparada */
											$stmt->bind_result($id,$nom,$local,$moda);
											/* obtener valores */
										while ($stmt->fetch()) {
											echo "<option value='$id'>$id - $nom - $local /$moda</option>";
												
										}
										$stmt->close();
									}
									//$mysqli->close();
									$xbuscar = "";
							  ?>
							</datalist>
					    </div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
						<label for="demo-name">Ciudad</label>
							<select name="ciudad" class="form-control">
								<option value="all">-------Todos-----</option>
								<?php
									if ($stmt = $mysqli->prepare("
											SELECT DISTINCT ciudad_usuario from usuario;")) {
											$stmt->execute();
											/* vincular variables a la sentencia preparada */
											$stmt->bind_result($ciudad_usuario);
											/* obtener valores */
										while ($stmt->fetch()) {
											echo "<option value=$ciudad_usuario>$ciudad_usuario</option>";
										}
										/* cerrar la sentencia */
										$stmt->close();
									}
									
							  ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12" align="right">
						<button type="submit" class="btn btn-primary" style="white-space: normal;">Matriculas(Excel)</button>
					</div>
				</div>	
				</form>	
			</div>

			<div class="card-report">
				<h4>Matriculas por Pack</h4>
				<form method="post" id="matriculaspack" action="../reportes/matriculaspack.php">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="demo-name">Pack</label>
								<input type="text" name="id_pack" id="pack" class="form-control" list="packs">
						    	<datalist id="packs"required>
									<?php
										if ($stmt = $mysqli->prepare("
												SELECT id_pack, nom_pack, fecha_ini FROM pack ORDER BY nom_pack;")) {
												$stmt->execute();
												/* vincular variables a la sentencia preparada */
												$stmt->bind_result($id,$nombre, $fecha_ini);
												/* obtener valores */
											while ($stmt->fetch()) {
												echo "<option value='$id'>$nombre - Inicio: $fecha_ini</option>";
													
											}

											$stmt->close();
										}
										$xbuscar = "";
								  ?>
								</datalist>
						    </div>
							
						</div>
						<div class="col-md-3" align="right middle">
							<br>
							<button type="submit" class="btn btn-primary">Matriculas (Excel)</button>
						</div>
						<div class="col-md-2"></div>
					</div>
				</form>
			</div>


			<div class="card-report">
				<h4>Matricula por Usuario</h4>
				<form method="post" id="matriculasusuario" action="../reportes/matriculasusuario.php">
					<div class="row">
						<div class="col-md-2"></div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="demo-name">Usuario</label>
								<input type="text" name="id_usuario" id="usuario" class="form-control" list="usuarios">
						    	<datalist id="usuarios"required>
									<?php
										if ($stmt = $mysqli->prepare("
												SELECT id_usuario, apell_p_usuario, apell_m_usuario, nom_usuario FROM usuario ORDER BY apell_p_usuario;")) {
												$stmt->execute();
												/* vincular variables a la sentencia preparada */
												$stmt->bind_result($id,$apellp,$apellm,$nom);
												/* obtener valores */
											while ($stmt->fetch()) {
												echo "<option value='$id'>$apellp $apellm $nom</option>";
													
											}

											/* cerrar la sentencia */
											$stmt->close();
										}
										//$mysqli->close();
										$xbuscar = "";
								  ?>
								</datalist>
						    </div>
							
						</div>
						<div class="col-md-3" align="right middle">
							<br>
							<button type="submit" class="btn btn-primary">Matriculas (Excel)</button>
						</div>
						<div class="col-md-2"></div>
					</div>
				</form>
			</div>

			<div class="card-report">
				<h4>Generales</h4>
				<div class="row">

					<div class="col-md-4">
			  			<?php echo "<a href='../reportes/nomatriculadocursos.php' class='btn btn-primary' style='white-space: normal;'>Generar Reporte Excel (No matriculados en ningun curso) </a>"; ?>
			    	</div>
	    			<div class="col-md-4">
						<?php echo "<a href='../reportes/allusers.php' class='btn btn-primary' style='white-space: normal; width:100%'>Todos los usuarios (Excel) </a>"; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

 <?php }
			else { 
				header('Location: ../../login.php?error=2');
			} 
	} else { 

		header('Location: ../../login.php?error=3');
    } 
 include 'footer.php';?>		
 