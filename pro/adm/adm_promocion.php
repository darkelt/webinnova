<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#Foto')
                    .attr('src', e.target.result);
                    //.width(400)
                    //.height(350);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }    
    
</script>

<style type="text/css">
	.fileUpload {
    position: relative;
    overflow: hidden;
    margin: 10px;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
</style>


<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	

<?php
$query = "SELECT id, titulo, descripcion, portada, premio FROM promocion LIMIT 1";
$stmt = $mysqli->prepare($query);
$stmt->execute();
/* ligar variables de resultado */
$stmt->bind_result($id, $titulo, $descripcion, $portada, $premio);

/* obtener valor */
$stmt->fetch();

?>
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 

						<h3>Sección Promoción</h3>
						<form method="post" action="adm_promocion_grabar.php" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo $id;?>">
						  <input type=hidden name=tipo value="INSERT">
						  <div class="row">						  	
					  		<div class="col-md-12">
							    <div class="form-group">
							    	<label for="name">Titulo de la Promoción</label>
									<input class="form-control" title="requiere un nombre" type="text" name="titulo"  required value="<?php echo $titulo;?>" />
							    </div>
							</div>

						    <div class="col-md-12" style="padding-left: 0px;  padding-right: 0px; padding-bottom: 0px; padding-top:0px;">
                                <div class="card card-user text-center">
                                        <label>Portada</label>    
                                        <br>

                                        <img  class="img-responsive center-block" src="<?php echo '../../'.$portada;?>" id="Foto">

                                        <br>
                                        <div class="fileUpload btn btn-info">
                                            <span>Subir Foto</span>
                                            <input type="file" class="upload" accept="image/*" name="Foto" Id="fileImage" onchange="readURL(this);" />
                                        </div>
                                </div>
                            </div>

						    <div class="col-md-12">
							    <div class="form-group">
							    	<label for="demo-message">Descripción de la Promoción</label>
									<textarea class="form-control" name="descripcion" id="demo-message" rows="6" required><?php echo $descripcion;?></textarea>
							    </div>
						    </div>

						    <div class="col-md-12">
							    <div class="form-group">
							    	<label for="demo-message">Premio al inscribirse</label>
									<input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
                                    <input type="file" name="DocumentoDigital" />
							    </div>
						    </div>

						    
						    <div class="col-md-12">
							    <button type="submit" class="btn btn-success">Guardar</button>
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
 