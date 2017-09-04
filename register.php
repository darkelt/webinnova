
<?php
include 'header.php';
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';

if (login_check($mysqli) == true) {
    $logged = 'in';
	header('Location: pro/index.php');
} else {
    $logged = 'out';
}

?>

<div id="fh5co-team-section">
	<div class="container">
		<div class="row about">
				<br>
		</div>
		<div class="row">
				<div class="container">
			   			<div class="col-md-10 col-md-offset-1 text-center ">
			   				<div class="slider-text-inner desc">
			   					<h2 class="heading-section">Registro de Usuario</h2>
			   					<p class="fh5co-lead">Desarrollando con <i class="icon-heart2"></i> la nueva enseñanza <a href="#" target="_blank">InnovaTrainingCenter</a></p>
			   				</div>
			   			</div>
			   		</div>
							<?php
								if (!empty($error_msg)) {
									echo $error_msg;
								}
							?>
		<form method="post" action="<?php echo esc_url($_SERVER['PHP_SELF']);?>" name="registration_form">
			<div class="row col-md-10 col-md-offset-1">
				<div class="col-md-6">
					<label for="name">Apellido Paterno</label>
					<input class="form-control" type="text" name="apell_p"  />
				</div>
				<div class="col-md-6">
					<label for="name">Apellido Materno</label>
					<input class="form-control" type="text" name="apell_m"   />
				</div>
				<div class="col-md-6">
					<label for="name">Nombres</label>
					<input class="form-control" type="text" name="username" />
				</div>
				<div class="col-md-6">
					<label for="email">Email</label>
					<input class="form-control" type="email" name="email" id="email" />
					
				</div>
				<div class="col-md-6">
					<label for="password">Contraseña</label>
					<input class="form-control" type="password" name="password"   />
				</div>
				<div class="col-md-6">
					<label for="password">Rep-Contraseña</label>
					<input class="form-control" type="password" name="confirmpwd" />
				</div>		
				<div class="col-md-12">		
				<label for="sexo">Sexo</label>	
					<div class="row">
						<div class="col-md-10">
					    	<label class="radio-inline" for="demo-priority-low">
					    	<input type="radio" id="demo-priority-low" name="sexo" value="m" checked >Masculino</label>
							<label class="radio-inline" for="demo-priority-normal" >
							<input type="radio" id="demo-priority-normal" name="sexo" value="f" >Femenino</label>
							<label class="radio-inline" for="demo-priority-high" >
							<input type="radio" id="demo-priority-high" name="sexo" value="o" >Otros</label>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<label for="demo-category">Pais</label>
					<div class="select-wrapper">
						<select class="form-control" id="country" name="country"></select>
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
				<div class="col-md-6">
					<label for="name">Direccion</label>
					<input class="form-control" type="text" name="direc" />
				</div>
				<div class="col-md-6">
					<label for="demo-name">Fecha de nacimiento</label>
					<input class="form-control" type="date" name="date" id="date"  />
				</div>
				<div class="col-md-6">
					<label for="tel">Telefono 1</label>
					<input class="form-control" type="text" name="telephone1" id="tel"   />
				</div>
				<div class="col-md-6">
					<label for="demo-category">Operador</label>
					<div class="select-wrapper">
						<select class="form-control" name="opera" id="demo-category">
							<option value="">Selecciona Operador</option>
							<option value="rpc">Claro(RPC)</option>
							<option value="c">Claro</option>
							<option value="rpm">Movistar(RPM)</option>
							<option value="m">Movistar</option>
							<option value="e">Entel</option>
							<option value="b">Bitel</option>
							<option value="o">Otro</option>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<label for="name">Grado Academico y Profesión</label>
					<input class="form-control" type="text" name="grado"  />
				</div>
				<div class="col-md-6">
					<label for="name">Institución de Procedencia</label>
					<input class="form-control" type="text" name="institu"   />
				</div>
				<div class="col-md-6">
					<input type="checkbox" id="demo-copy" name="demo-copy">
					<label for="demo-copy">Acepto los terminos y condiciones.</label>
				</div>
				
				
				<div class="col-md-12">
					<input type="button" 
								   value="Registro" 
								   onclick="return regformhash(this.form,
													   this.form.username,
													   this.form.email,
													   this.form.password,
													   this.form.confirmpwd,
													    this.form.telephone1,
														this.form.opera,
														this.form.direc,
														this.form.country,
														this.form.state,
														this.form.date);"
								  
								   class="btn btn-primary" />
				</div>
			</div>
		</form>
			
		</div>
	</div>
</div>			
<?php 
 include 'footer.php';
?>