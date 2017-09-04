<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 

					    <h3>Nuevo Horario</h3>
						<form method="post" action="adm_horario_grabar.php">
						  <input type=hidden name=tipo value="INSERT">
						  <div class="row">
						    <div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Nombre del horario</label>
									<input class="form-control" title="requiere un nombre" type="text" name="xnom"  required/>
							    </div>
							</div>
							<div class="col-md-12">
							    <div class="form-group">
							    	<label for="demo-message">Descripción de la Clase</label>
									<textarea class="form-control" name="xdescrip" id="demo-message" rows="6" required></textarea>
							    </div>
						    </div>
						    <div class="col-md-6">
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
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
 <?php }
			else { 
				header('Location: ../../login.php?error=2');
			} 
	} else { 

		header('Location: ../../login.php?error=3');
    } 
 include 'footer.php';?>		
 