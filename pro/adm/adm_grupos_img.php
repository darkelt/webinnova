<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<script>
	/* Script written by Miguel Nunez @ minuvasoft10.com */
	function _(el){
		return document.getElementById(el);
	}
	function uploadFile(){
		var file = _("file1").files[0];
		//alert(file.name+" | "+file.size+" | "+file.type);
		var formdata = new FormData();
		formdata.append("file1", file);
		var ajax = new XMLHttpRequest();
		ajax.upload.addEventListener("progress", progressHandler, false);
		ajax.addEventListener("load", completeHandler, false);
		ajax.addEventListener("error", errorHandler, false);
		ajax.addEventListener("abort", abortHandler, false);
		ajax.open("POST", "upload4.php");
		ajax.send(formdata);
	}
	function progressHandler(event){
		_("loaded_n_total").innerHTML = "Uploaded "+event.loaded+" bytes of "+event.total;
		var percent = (event.loaded / event.total) * 100;
		_("progressBar").value = Math.round(percent);
		_("status").innerHTML = Math.round(percent)+"% Subiendo... espere porfavor";
	}
	function completeHandler(event){
		_("status").innerHTML = event.target.responseText;
		_("progressBar").value = 0;
	}
	function errorHandler(event){
		_("status").innerHTML = "Upload Failed";
	}
	function abortHandler(event){
		_("status").innerHTML = "Upload Aborted";
	}
	</script>
<?php 

	$datos  = leerParam("xgrupo","");
	$buscar = leerParam("buscar","");
	if ($datos != NULL){
		list($xcod_g, $xnom_g) = explode("*", $datos);
		$buscar = 'pack';
		$pos  = strripos($xnom_g, $buscar);
			if($pos === false){
				$temp = substr($xnom_g, 0, 4); 
				$nomimg = $xcod_g."_".$temp.".jpg";
			}else{

				$nomimg = str_replace(' ','', $xnom_g);
	 			$nomimg = str_replace(':','', $nomimg);
	 			$nomimg = $nomimg.".jpg";
			}
	}else{
		$nomimg = 'Elige un grupo o curso';
	}
?>
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 
					<div class="col-md-8 col-md-offset-2 ">	
						<h3 class="heading-section">Subir imagenes web</h3>
			   			<p class="bg-success">Seleccionar el grupo o paquete</p>
			   				
						<form method="post" action="adm_grupos_img.php">
							<input type=hidden name=buscar value="NGRUPO">
						  	<div class="row">
						    	<div class="col-md-8">
							   		<div class="form-group">
							    	<select class="form-control" name="xgrupo"  required>
										<option value="">Elije Grupo</option>
										<?php
											if ($stmt = $mysqli->prepare("SELECT `grupos`.`id_grupo`,`grupos`.`nom_grupo` FROM `grupos` WHERE `grupos`.`estado_grupo`= 'A';")) {
													$stmt->execute();
													/* vincular variables a la sentencia preparada */
													$stmt->bind_result($id,$nom);
													/* obtener valores */
												while ($stmt->fetch()) {
													echo "<option value='$id*$nom'>$nom</option>";
														
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
					<div class="col-md-8 col-md-offset-2 ">	
						<form method="post" action="adm_grupos_img.php">
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


		
	</div>
	<div class="container">
							<div class="col-md-8 col-md-offset-2 ">
			   					<p class="bg-success">Seleccionar tu archivo, Cambiar el nombre  a:  <a class="bg-info"><?php  echo $nomimg;?></a></p>
			   				
								<form id="upload_form" enctype="multipart/form-data" method="post">
								  <input  class="form-control" type="file" name="file1" id="file1"><br>

								  <input type="button" value="Subir Archivo" class="btn btn-default" onclick="uploadFile()">
								  <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
								  <h3 id="status"></h3>
								  <p id="loaded_n_total"></p>
								</form>
											   				
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
 