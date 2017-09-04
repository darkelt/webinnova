<?php 
include 'header.php';
$url="concurso.php";
$_SESSION["xurl"]=$url;
?>
		<!-- end:fh5co-header -->
		<aside>
			<img src="images/sorteo.jpg"  alt="innovatrainingcenter" width="100%" ">
		</aside>
		<div id="fh5co-team-section">
			<div class="container">
				<div class="row about">
					<div class="col-md-12">
						
						<div class="col-md-4">
							<h3>Procedimiento de Inscripción</h3>	
								<small><li>Solo participaran en el sorteo, los alumnos que hayan asistido a la charla: Introducción a la Metodología BIM</li></small>
								<small><li>Cada alumno deberá registrarse en nuestra página web:</li></small>
								<small><li>En la charla los alumnos recibieron un código genérico, que deberán ingresar en nuestra página web.</li></small>
								<small><li>Recibirá un correo de Confirmación de Participación, y su código de participación.</li></small>
								<small><li>El sorteo iniciará con todos los códigos registrados en nuestra página web</li></small>
								<small><li>Si los participantes ingresan su código después de la fecha y hora establecidas en el párrafo anterior,no participaran del sorteo sin lugar a reclamos posteriores.</li></small>
								<small><li>El proceso para elegir a los ganadores.</li></small>
								<small><li>La transmisión del sorteo será en vivo por nuestra página de Facebook.</li></small>	
								<spam><code class="text-primary">Innova Training Center desea muchísima suerte a cada uno de los participantes.</code></spam>
							
								
						
						</div>
						<div class="col-md-8">
							<div class="row">
														<div class="col-md-12">
															Login via
															<div >
																<a  <?php echo 'href="' . htmlspecialchars($loginUrl) . '"'; ?> class="btn btn-block btn-social btn-facebook" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" style="font: 98% Sans-serif; color:white" >
														            <i class="icon-facebook3" style="color:white; font-size: 23px;"></i>Facebook
														          </a>
															</div>
							                                or
															 <form class="form" role="form" accept-charset="UTF-8" id="login-nav" action="includes/process_login.php" method="post" name="formulario1">
															 	<input type="hidden"  value="<?php if($url = leerParam("url","")){ echo "$url"; }else{echo "index.php";} ?>" name="url">
																	 
																	<div class="form-group">
																		 <label class="sr-only" for="exampleInputEmail2" >Email address</label>
																		 <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address"  name="email" required>
																	</div>
																	<div class="form-group">
																		 <label class="sr-only" for="exampleInputPassword2">Password</label>
																		 <input class="form-control" type="password" name="password" id="password" placeholder="Password"  onkeypress="javascript:if(event.keyCode == 13) formhash(this.main, this.main.password);" required>
							                                             <div class="help-block text-right"><a href="">Olvidaste tu password ?</a></div>
																	</div>
																	<div class="form-group">
																		 <input type="button" 
																		   value="Login" 
																		   onclick="formhash(this.form, this.form.password);"
																		   class="btn btn-primary btn-block" style="font-size: 22px;" />
																	</div>
																	

															 </form>
														</div>
														<div class="bottom text-center">
															<a href="register.php" style="font-size: 12px;"> <span >Eres nuevo?   </span><b>Registrate</b></a>
														</div>
												 </div>



						</div>	
										
										
				</div>
			</div>
		</div>
	</div>
<?php 
include 'footer.php' ?>