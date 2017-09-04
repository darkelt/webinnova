<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 

 						<h2>Nuevo Clase de Curso</h2>
 						 <form  method="post" action="adm_clase_cursos_grabar.php">
						  <input type=hidden name=tipo value="INSERT">
						  <div class="row">
						    <div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Nombre de la Clase</label>
									<input  class="form-control"  title="requiere un nombre" type="text" name="xnom"  required/>
							    </div>
							</div>
							<div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Codigo Corto de la Clase</label>
									<input class="form-control" type="text" name="xnomcor"   required/>
							    </div>
						    </div>
						    <div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Nombre de la imagen</label>
									<input class="form-control" type="text" name="xnomimg" required/>
							    </div>
						    </div>
						    <div class="col-md-12">
							    <div class="form-group">
							    	<label for="demo-message">Descripción de la Clase</label>
									<textarea class="form-control" name="xdescrip" id="demo-message" rows="6" required></textarea>
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
 
 
 