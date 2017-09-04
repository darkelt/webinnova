<?php include 'header.php' ?>

		<!-- end:fh5co-header -->
		<aside id="fh5co-hero" class="js-fullheight">
			<div class="flexslider js-fullheight">
				<ul class="slides">
			   	<li style="background-image: url(images/contact.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container">
			   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
			   				<div class="slider-text-inner desc">
			   					<h2 class="heading-section">¿Donde puedes encontrarnos?</h2>
			   				</div>
			   			</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<div id="map" class="fh5co-map"></div>
		<!-- END map -->
		<div id="fh5co-contact-section">
			<div class="container">
				<form method="post" action="sendbymail.php">
					<div class="row">
						<div class="col-md-6 col-md-push-6">
							<h3 class="section-title">Nuestra Dirección</h3>
							<p>Somos un grupo de profesionales con la visión de llegar a ser la mejor empresa de capacitación a nivel nacional e internacional, brindando un servicio de calidad en cada uno de nuestros cursos.</p>
							<ul class="contact-info">
								<li><i class="icon-location-pin"></i>Urbanización Magisterial , Calle Juana Espinoza 300 - Etapa  1 - Umacollo - Arequipa  - Arequipa - Perú.</li></li>
								<li><i class="icon-phone2"></i>(054) #959-486461 RPM /(051)  993655595 RPC</li>
								<li><i class="icon-mail"></i><a href="#"cursos@innovatrainingperu.com</a></li>
								<li><i class="icon-globe2"></i><a href="#">www.innovatrainingperu.com</a></li>
							</ul>
						</div>
						<div class="col-md-6 col-md-pull-6">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="name" class="form-control"  name="first_name" id="name" placeholder="Name" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<textarea class="form-control" id="message" name="comments" cols="30" rows="7" placeholder="Message" required></textarea>
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<input type="submit" value="Enviar Mensaje" class="btn btn-primary">
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- END fh5co-contact -->
	</div>
<footer>
			<div id="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-4">
							<h3 class="section-title">Nosotros</h3>
							<p>Somos un grupo de profesionales con la visión de llegar a ser la mejor empresa de capacitación a nivel nacional e internacional, brindando un servicio de calidad en cada uno de nuestros cursos.</p>
						</div>
						<div class="col-md-4">
							<h3 class="section-title">Nuestra Dirección</h3>
							<ul class="contact-info">
								<li><i class="icon-map2"></i>Arequipa - Perú<br />
									Calle Ibañez #102<br />
									Urb. María Isabel, Cercado.</li>
								<li><i class="icon-phone2"></i>(054) #959-486461 RPM /(054)  959-155233 RPC</li>
								<li><i class="icon-envelope2"></i><a href="#">cursos@innovatrainingperu.com</a></li>
								<li><i class="icon-globe2"></i><a href="www.innovatrainingperu.com">www.innovatrainingperu.com</a></li>
							</ul>
						</div>
						<div class="col-md-4">
							<h3 class="section-title">Dejanos tu Comentario</h3>
							<form class="contact-form" method="post"  action="sendbymail.php">
								<div class="form-group">
									<label for="name" class="sr-only">Nombre</label>
									<input type="name" class="form-control" id="name" placeholder="Name" required>
								</div>
								<div class="form-group">
									<label for="email" class="sr-only">Email</label>
									<input type="email" class="form-control" id="email" placeholder="Email" required>
								</div>
								<div class="form-group">
									<label for="message" class="sr-only">Mensaje</label>
									<textarea class="form-control" id="message" rows="7" placeholder="Message" required></textarea>
								</div>
								<div class="form-group">
									<input type="submit" id="btn-submit" class="btn btn-send-message btn-md" value="Enviar Comentario">
								</div>
							</form>
						</div>
					</div>
					<div class="row copy-right">
						<div class="col-md-6 col-md-offset-3 text-center">
							<p class="fh5co-social-icons">
								<a href="#"><i class="icon-twitter2"></i></a>
								<a href="https://www.facebook.com/innovatraining"><i class="icon-facebook2"></i></a>
								<a href="#"><i class="icon-instagram"></i></a>
								<a href="#"><i class="icon-dribbble2"></i></a>
								<a href="#"><i class="icon-youtube"></i></a>
							</p>
							<p>&copy; 2016 <a href="#">Innova Training Center</a>.Todos los derechos reservados. <br>Desarrollado por <i class="icon-user"></i> by <a href="http://teamcomputersac.com/" target="_blank">Team Computer S.A.C.</a> / Images: <a href="#" target="_blank">Cgarnen </a>,<a href="#" target="_blank"> C</a> <br> Colored Icons: <a href="http://flaticon.com" target="_blank">Flaticon</a></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
	

	</div>
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->


	<!-- jQuery -->


	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
	<script src="js/google_map.js"></script>

	<!-- Main JS (Do not remove) -->
	<script src="js/main.js"></script>
	<script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script><script src="js/main.js"></script>

	</body>
</html>

 