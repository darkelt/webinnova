
<?php
include 'header.php';

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
					<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
							<div class="row">
								<div class="col-md-12">
									<h3>Login via</h3>
									<div>
										<a  <?php echo 'href="' . htmlspecialchars($loginUrl) . '"'; ?> class="btn btn-block btn-social btn-facebook" onclick="_gaq.push(['_trackEvent', 'btn-social', 'click', 'btn-facebook']);" style="font: 98% Sans-serif; color:white" >
								            <i class="icon-facebook3" style="color:white; font-size: 23px;"></i>Facebook
								          </a>
									</div>
					                or
									 <form class="form" role="form" accept-charset="UTF-8" id="login-nav" action="includes/process_login.php" method="post" name="formulario1">
								
									 		<?php if(isset($_SESSION["xurl"])){
									 					$xurl = $_SESSION['xurl'];
									 					echo"<input type='hidden'  value='$xurl' name='url'>";
									 				}else{
									 					echo"<input type='hidden'  value='index.php' name='url'>";
									 				}

									 		?>

											<div class="form-group">
												 <label class="sr-only" for="exampleInputEmail2" >Email address</label>
												 <input type="email" class="form-control" id="exampleInputEmail2" placeholder="Email address"  name="email" required>
											</div>
											<div class="form-group">
												 <label class="sr-only" for="exampleInputPassword2">Password</label>
												  <input class="form-control" type="password" name="password" id="password" placeholder="Password"  onkeypress="javascript:if(event.keyCode == 13){ formhash(this.main, this.main.password)}" required>
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
			
<?php 
 include 'footer.php';
?>