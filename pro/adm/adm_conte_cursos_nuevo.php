<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
	$xcodc = leerParam("xcodc","");	
	$xnomc = leerParam("xnomc","");	?>						 
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 

						<h2>Nuevo Tema <?php echo $xnomc; ?></h2>
 						 <form method="post" action="adm_conte_cursos_grabar.php">
							<input type=hidden name=tipo value="INSERT">
							<input type=hidden name=xcodc value="<?php echo $xcodc; ?>">
							<input type=hidden name=xnomc value="<?php echo $xnomc; ?>">
						  <div class="row">
						    <div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Tema del curso</label>
									<input class="form-control" title="requiere un nombre" type="text" name="xdeta"  required/>
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
 
 
 