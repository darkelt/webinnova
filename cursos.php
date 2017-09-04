<?php 
include 'header.php'
?>

		<!-- end:fh5co-header -->
		<aside id="fh5co-hero" class="js-fullheight">
			<div class="flexslider js-fullheight">
				<ul class="slides">
			   	<li style="background-image: url(images/slide_1.jpg);">
			   		<div class="overlay-gradient"></div>
			   		<div class="container">
			   			<div class="col-md-10 col-md-offset-1 text-center js-fullheight slider-text">
			   				<div class="slider-text-inner desc">
			   					<h2 class="heading-section">Lineas de Carrera</h2>
			   					<p class="fh5co-lead">Desarrollando con <i class="icon-heart2"></i> la nueva enseñanza <a href="#" target="_blank">InnovaTrainingCenter</a></p>
			   				</div>
			   			</div>
			   		</div>
			   	</li>
			  	</ul>
		  	</div>
		</aside>
		<div id="fh5co-work-section">
			<div class="container">
				<div class="row">
		<?php

			if ($stmt = $mysqli->prepare("SELECT * FROM u292000437_bdi.clase_cursos;")) {
			$stmt->execute();

			/* vincular variables a la sentencia preparada */
			$stmt->bind_result($id,$nom, $nomcorto, $des, $img);
			/* obtener valores */
			while ($stmt->fetch()) {
				
					echo "<div class='col-md-4 text-center project'>
								<a href='cursos_sup.php?xcod=$id&xnom=$nom' class='grid-project'>
									<div class='image'><img src='images/rama/$img' alt='Project' class='img-responsive'></div>
									<div class='desc'>
										
										<span>$nomcorto</span>
									</div>
								</a>
							</div>";
						
						
				
			}

			/* cerrar la sentencia */
			$stmt->close();
		}
		$mysqli->close();
	?>

				</div>
			</div>
		</div>
		<?php 
include 'footer.php'
	?>