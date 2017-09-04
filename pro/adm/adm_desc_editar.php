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
 $xcod = leerParam("xcod","");
 
 if ($stmt = $mysqli->prepare("SELECT 
									`descuentos`.`id_desc`,
									`descuentos`.`nom_desc`,
									`descuentos`.`factor_desc`,
									`descuentos`.`descrip_desc`,
									`descuentos`.`id_grupo`,
                                    `grupos`.`nom_grupo`,
                                    `grupos`.`tipo_cambio_grupo`,
                                    `grupos`.`precio_curso_grupo`,
                                    `grupos`.`precio_dolar_grupo`,
                                    `descuentos`.`fecha_ini_desc`,
                                    `descuentos`.`fecha_fin_desc`
							FROM `descuentos`, `grupos`
							WHERE `descuentos`.`id_grupo` = `grupos`.`id_grupo`
                            AND `descuentos`.`id_desc` = ? LIMIT 1;")) {
            // Une “$user_id” al parámetro.
            $stmt->bind_param('i', $xcod);
            $stmt->execute();   // Ejecuta la consulta preparada.
            $stmt->store_result();
 
            // Si el usuario existe, obtiene las variables del resultado.
            $stmt->bind_result($e_xcod, $e_nom , $e_fdes, $e_des, $e_grupo,  $nom_grupo , $tc, $soles, $dolares , $f_ini , $f_fin);
            $stmt->fetch();    
        }

      $id_concat =$tc.":".$dolares.":".$soles.":".$e_grupo;



?>

						<h3>Editar Curso</h3>
						<form name="formulario" method="post" action="adm_desc_grabar.php" onsubmit="return revisar()">
							<input type="hidden" name="tipo" value="UPDATE">
							<input type="hidden" name="xcod" value="<?php echo $e_xcod; ?>">
						  <div class="row">
						    <div class="col-md-12">
							    <div class="form-group">
							    	<label for="name">Nombre del Descuento</label>
									<input class="form-control" title="requiere un nombre" type="text" name="xnom" value="<?php echo $e_nom; ?>" required/>
							    </div>
							</div>
							<div class="col-md-12">
							    <label for="demo-category">Grupo</label>
							    <select class="form-control" name="xgrupo" readonly="yes" id="precio"  onclick="myFunction1()" required>
									<option value="<?php echo $id_concat; ?>"><?php echo $nom_grupo; ?></option>
								</select>
						    </div>
						    <div class="col-md-4">
							    <div class="form-group">
							    	<label for="name">% descuento "00.00"</label>
									<input class="form-control" type="text" id="xfdes" name="xfdes"onkeyup="myFunction2()" value="<?php echo $e_fdes; ?>" required>
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
									<input class="form-control" type="text" id="total" value="" onkeyup="myFunction3()" >
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
									<input class="form-control" type="text" id="total_dolar" value="" onkeyup="myFunction4()"  >
							    </div>
						    </div>
						    <div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Fecha de inicio de descuento</label>
									<input class="form-control" type="date" name="date_ini" id="date_ini" value="<?php echo $f_ini; ?>" />
							    </div>
						    </div>
						     <div class="col-md-6">
							    <div class="form-group">
							    	<label for="name">Fecha de fin de descuento</label>
									<input class="form-control" type="date" name="date_fin" id="date_fin" value="<?php echo $f_fin; ?>"/>
							    </div>
						    </div>
						    <div class="col-md-12">
							    <div class="form-group">
							    	<label for="name">Descripción de descuento</label>
									<input class="form-control"  title="requiere un nombre" type="text" name="xdescrip"  value="<?php echo $e_des; ?>" required/>
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
						    <div class="col-md-11">
							    <button type="submit" class="btn btn-default">Grabar</button>
						    </div>
						    <div class="col-md-1">
							    <?php echo"<a   href='adm_desc_grabar.php?tipo=del&xcod=$xcod' class='btn btn-danger btn-xs'>Eliminar</a>";?>
						    </div>
						  </div>
						</form>	
	</div>
</div>	

															
	<script>
		window.addEventListener("load", myFunction1, false);
		window.addEventListener("load", myFunction2, false);
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
 
 
 