<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){
					?>	
<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->		
<div class="clear"><br><br></div>
<div id="fh5co-team-section">
				<div class="container">
					<?php include 'header_adm.php' ?> 

<?php

 $xcod = leerParam("xcod","");
 
 if ($stmt = $mysqli->prepare("SELECT		`m`.`fecha_matricula`,	
 												`m`.`pago_matricula`,
 												`m`.`pago_dolar_matricula`,
												`m`.`id_usuario`,
                                                `u`.`nom_usuario`,
												`u`.`apell_p_usuario`,
                                                `u`.`apell_m_usuario`,
												`m`.`id_grupos`,
												`g`.`nom_grupo`,
												`m`.`id_desc`,
												`m`.`estado_matricula`
											FROM `matricula` `m`, `usuario` `u`,  `grupos` `g`
											WHERE  `m`.`id_usuario` =  `u`.`id_usuario` 
											AND  `m`.`id_grupos` = `g`.`id_grupo` 
											AND `id_matricula` = ?;")) {
            // Une “$user_id” al parámetro.
            $stmt->bind_param('i', $xcod);
            $stmt->execute();   // Ejecuta la consulta preparada.
            $stmt->store_result();
 
            // Si el usuario existe, obtiene las variables del resultado.
            $stmt->bind_result($xfecha, $xpago, $xpago_dolar, $xuserid, $xusernom, $xuserp, $xuserm, $xgrupoid, $xgruponom , $xdescnom, $xestado);
            $stmt->fetch();    
        }

		$completo = $xuserid." ".$xusernom ." ".$xuserp." ".$xuserm;	


?>
						<h3>Validar Matricula</h3>
						<form name="formulario" method="post" action="adm_matricula_grabar.php">
						 	<input type="hidden" name="tipo" value="VALIDAR">
							<input type="hidden" name="xcod" value="<?php echo $xcod; ?>">
							<input type="hidden" name="xnom" value="<?php echo $completo; ?>">
						  <div class="row">
						    <div class="col-md-3">
								<label for="name">Nombre de Usuario:</label>
							</div>
							<div class="col-md-9">
								<label for="demo-category"><?php echo $completo;?> </label>
							</div>
							<div class="col-md-3">
								<label for="name">Grupo Matriculado:</label>
							</div>
							<div class="col-md-9">
								<label for="demo-category"><?php echo  $xgrupoid." ".$xgruponom;?> </label>
							</div>
							<div class="col-md-3">
								<label for="name"> Soles:</label>
							</div>
							<div class="col-md-9">
								<label for="demo-category"> S/.<?php echo $xpago;?> </label>
							</div>
							<div class="col-md-3">
								<label for="name">Dolares:</label>
							</div>
							<div class="col-md-9">
								<label for="demo-category"> $ <?php echo $xpago_dolar;?> </label>
							</div>
							<div class="col-md-3">
								<label for="name">Tipo de  descuento:</label>
							</div>
							<div class="col-md-9">
								<label for="demo-category"><?php echo $xdescnom;?> </label>
							</div>
							<div class="col-md-3">
								<label for="name">Fecha de Pre-Matricula:</label>
							</div>
							<div class="col-md-9">
								<label for="demo-category"><?php echo $xfecha;?> </label>
							</div>
							<div class="col-md-12">
								<label for="name"><b>Desea enviar correo de Confirmacion?  </b></label>
							</div>
							<div class="col-md-12">
							 	<select class="form-control" name="op" id="demo-category"  required>
												<option value="">----</option>
												<option value="si">Enviar Correo</option>
												<option value="no">No enviar Correo</option>
								</select>
							</div>
							<div class="col-md-12">
							<label for="name">Nro de Operacion</label>
								<input class="form-control" type="text" name="nopera" size="12px" required>
							</div>
						    <div class="col-md-12">
							    <button type="submit" class="btn btn-default">Validar</button>
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
 