<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?>
				
						<h3>Nuevo Descuento</h3>

						<form method="post" action="adm_desc_grabar.php">
						<input type=hidden name=tipo value="INSERT">
						  <div class="row">
						    <div class="col-md-12">
							    <div class="form-group">
							    	<label for="name">Nombre del Descuento</label>
									<input class="form-control" title="requiere un nombre" type="text" name="xnom"  required/>
							    </div>
							</div>
							<div class="col-md-12">
							    <label for="demo-category">Grupo</label>
							    <select class="form-control" name="xgrupo" id="precio" onchange="myFunction1()"required>
									<option value="">- Selecciona Grupo</option>
									<?php
										if ($stmt = $mysqli->prepare("
											SELECT `grupos`.`id_grupo`,
													`grupos`.`nom_grupo`,
													`grupos`.`precio_curso_grupo`,
													`grupos`.`precio_dolar_grupo`,
													`grupos`.`tipo_cambio_grupo`,
													 `grupos`.`localidad`,
													`grupos`.`modalidad_grupo`
												FROM `u292000437_bdi`.`grupos`  
												WHERE `grupos`.`estado_grupo`= 'A' 
												ORDER BY `localidad`,`id_grupo` ;")) {
												$stmt->execute();
												/* vincular variables a la sentencia preparada */
												$stmt->bind_result($id_g,$nom_g,$xprecio, $xprecio_dolar , $tc, $localidad , $moda);
												/* obtener valores */
											while ($stmt->fetch()) {
												echo "<option value='$tc:$xprecio_dolar:$xprecio:$id_g'>$id_g - $nom_g - $localidad /$moda</option>";
											}
											/* cerrar la sentencia */
											$stmt->close();
										}
									?>
								</select>						
						    </div>
						    <div class="col-md-4">
							    <div class="form-group">
							    	<label for="name">% descuento "00.00"</label>
									<input class="form-control" type="text" id="xfdes" name="xfdes" value="" onkeyup="myFunction2()"  required>
							    </div>
						    </div>
						    <div class="col-md-4">
							    <div class="form-group">
							    	<label for="name">Precio del Grupo S/.</label>
									<input class="form-control" type="text" id="imprecio" value=""   readonly="yes" required>
							    </div>
						    </div>
						    <div class="col-md-4">
							    <div class="form-group">
							    	<label for="name">Precio a Pagar S/.</label>
									<input class="form-control" type="text" id="total" value="" onkeyup="myFunction3()"  required>
							    </div>
						    </div>
						    <div class="col-md-4">
							    <div class="form-group">
							    	<label for="name">Tipo de Cambio</label>
									<input class="form-control" type="text" id="tc" value="" readonly="yes"  required>
							    </div>
						    </div>
						    <div class="col-md-4">
							    <div class="form-group">
							    	<label for="name">Precio del Grupo $.</label>
									<input class="form-control" type="text" id="imprecio_dolar" value=""   readonly="yes" required>
							    </div>
						    </div>
						    <div class="col-md-4">
							    <div class="form-group">
							    	<label for="name">Precio a Pagar $.</label>
									<input class="form-control" type="text" id="total_dolar" value="" onkeyup="myFunction4()"  required>
							    </div>
						    </div>
						     <div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Fecha de inicio de descuento</label>
									<input class="form-control" type="date" name="date_ini" id="date_ini" />
							    </div>
						    </div>
						     <div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Fecha de fin de descuento</label>
									<input class="form-control" type="date" name="date_fin" id="date_fin" />
							    </div>
						    </div>
						    <div class="col-md-12">
							    <div class="form-group">
							    	<label for="name">Descripción de descuento</label>
									<input class="form-control" title="requiere un nombre" type="text" name="xdescrip"  required/>
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

	<script>
		function myFunction1() {
			  var x = document.getElementById("precio").value;
			  var myarr = x.split(":");
			  var myvar = myarr[0] + ":" + myarr[1] + ":" + myarr[2] + ":" + myarr[3];
			  var tc =  myarr[0];
			  var precio_dolar =  myarr[1];
			  var precio =  myarr[2];
			  var id =  myarr[3];
			
		  	 document.getElementById("imprecio").value = precio;
			 document.getElementById("imprecio").innerHTML = precio;

			 document.getElementById("imprecio_dolar").value = precio_dolar;
			 document.getElementById("imprecio_dolar").innerHTML = precio_dolar;

			 document.getElementById("tc").value = tc;
			 document.getElementById("tc").innerHTML = tc;
		}
		function myFunction2() {
			var y = document.getElementById("xfdes");
			var precio = document.getElementById("imprecio").value;
			var precio_dolar = document.getElementById("imprecio_dolar").value;
			var fdes = y.value;
			var total = precio - (precio*fdes);
			var total_dolar = precio_dolar - (precio_dolar*fdes);

			total = total.toFixed(2);
			total_dolar = total_dolar.toFixed(2);
		   document.getElementById("total").value = total;

		   document.getElementById("total_dolar").value = total_dolar;
		   
		}

		function myFunction3() {
			var z = document.getElementById("total");
			var precio = document.getElementById("imprecio").value;
			var precio_dolar = document.getElementById("imprecio_dolar").value;
			total = z.value;
			var fdes = -1*((total-precio)/precio);
			var total_dolar = precio_dolar - (precio_dolar*fdes);
			total_dolar = total_dolar.toFixed(2);

		    document.getElementById("xfdes").value = fdes;
		    document.getElementById("total_dolar").value = total_dolar;
			
		}

		function myFunction4() {
			var a = document.getElementById("total_dolar");
			var precio = document.getElementById("imprecio").value;
			var precio_dolar = document.getElementById("imprecio_dolar").value;
			total_dolar = a.value;
			var fdes = -1*((total_dolar-precio_dolar)/precio_dolar);
			var total =  precio - (precio*fdes);
			total = total.toFixed(2);

		    document.getElementById("xfdes").value = fdes;
		    document.getElementById("total").value = total;
		}
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
 