<?php include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'U' OR $_SESSION['permiso'] == 'A'  OR $_SESSION['permiso'] == 'P' ){

	function enviarconcurso($nom, $id, $email_user){
			 $to =$email_user;
			$modo = 0;
		      
	    $adjunto = "becas.pdf";
		$boundary= md5(time()); //valor boundary
		$htmlalt_boundary= $boundary. "_htmlalt"; //boundary suplementario
		$subject="CONFIRMACION DE PARTICIPACION INNOVA "; //titulo del correo
	 
		//cabeceras para enviar correo en formato HTML
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: multipart/mixed; boundary=\"". $boundary. "\"\r\n"; //datos mixteados 
		$headers .= 'From: Innova Training Center<cursos@innovatrainingperu.com>' . "\r\n";
	 	$headers .= 'Reply-To: cursos@innovatrainingperu.com' . "\r\n";
		//incia cuerpo del mensaje que se visualiza
		$cuerpo="--". $boundary. "\r\n";
		$cuerpo .= "Content-Type: multipart/alternative; boundary=\"". $htmlalt_boundary. "\"\r\n\r\n"; //contenido alternativo: texto o html
		$cuerpo .= "--". $htmlalt_boundary. "\r\n";
		//modo de contenido del cuerpo del mensaje a mostrar
		//if( !strcmp($modo_envio, "texto") ) //modo texto plano
		//	{
		//	$cuerpo .= "Content-Type: text/plain; charset=iso-8859-1\r\n";
		//	$cuerpo .= "Content-Transfer-Encoding: 8bits\r\n\r\n";
		//	$cuerpo .= strip_tags(str_replace("<br>", "\n", substr($_POST["email_contenido"], (strpos($_POST["email_contenido"], "<body>")+6)))). "\r\n\r\n";
		//	}
		//else //modo html
		//	{
		$cuerpo .= "Content-Type: text/html; charset=iso-8859-1\r\n";
		$cuerpo .= "Content-Transfer-Encoding: 8bits\r\n\r\n";
		//	}
			//Cuerpo o contexto del mensaje, la esencia del correo, el todo ;) 
				
				
		$cuerpo .= '<html xmlns:v="urn:schemas-microsoft-com:vml"
	<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
	<meta name=ProgId content=Word.Document>
	<meta name=Generator content="Microsoft Word 15">
	<meta name=Originator content="Microsoft Word 15">
	<style>
	<!--
	 /* Font Definitions */
	 @font-face
		{font-family:"Cambria Math";
		panose-1:2 4 5 3 5 4 6 3 2 4;
		mso-font-charset:0;
		mso-generic-font-family:roman;
		mso-font-pitch:variable;
		mso-font-signature:-536870145 1107305727 0 0 415 0;}
	@font-face
		{font-family:Calibri;
		panose-1:2 15 5 2 2 2 4 3 2 4;
		mso-font-charset:0;
		mso-generic-font-family:swiss;
		mso-font-pitch:variable;
		mso-font-signature:-536870145 1073786111 1 0 415 0;}
	@font-face
		{font-family:Cambria;
		panose-1:2 4 5 3 5 4 6 3 2 4;
		mso-font-charset:0;
		mso-generic-font-family:roman;
		mso-font-pitch:variable;
		mso-font-signature:-536870145 1073743103 0 0 415 0;}
	 /* Style Definitions */
	 p.MsoNormal, li.MsoNormal, div.MsoNormal
		{mso-style-unhide:no;
		mso-style-qformat:yes;
		mso-style-parent:"";
		margin-top:0cm;
		margin-right:0cm;
		margin-bottom:8.0pt;
		margin-left:0cm;
		line-height:107%;
		mso-pagination:widow-orphan;
		font-size:11.0pt;
		font-family:"Calibri","sans-serif";
		mso-ascii-font-family:Calibri;
		mso-ascii-theme-font:minor-latin;
		mso-fareast-font-family:Calibri;
		mso-fareast-theme-font:minor-latin;
		mso-hansi-font-family:Calibri;
		mso-hansi-theme-font:minor-latin;
		mso-bidi-font-family:"Times New Roman";
		mso-bidi-theme-font:minor-bidi;
		mso-fareast-language:EN-US;}
	span.GramE
		{mso-style-name:"";
		mso-gram-e:yes;}
	.MsoChpDefault
		{mso-style-type:export-only;
		mso-default-props:yes;
		font-family:"Calibri","sans-serif";
		mso-ascii-font-family:Calibri;
		mso-ascii-theme-font:minor-latin;
		mso-fareast-font-family:Calibri;
		mso-fareast-theme-font:minor-latin;
		mso-hansi-font-family:Calibri;
		mso-hansi-theme-font:minor-latin;
		mso-bidi-font-family:"Times New Roman";
		mso-bidi-theme-font:minor-bidi;
		mso-fareast-language:EN-US;}
	.MsoPapDefault
		{mso-style-type:export-only;
		margin-bottom:8.0pt;
		line-height:107%;}
	@page WordSection1
		{size:595.3pt 841.9pt;
		margin:70.85pt 3.0cm 70.85pt 3.0cm;
		mso-header-margin:35.4pt;
		mso-footer-margin:35.4pt;
		mso-paper-source:0;}
	div.WordSection1
		{page:WordSection1;}
	-->
	</style>
	</head>

	<body lang=ES-PE style="tab-interval:35.4pt">

	<div class=WordSection1>

	<p class=MsoNormal align=center style="text-align:center"><b style="mso-bidi-font-weight:
	normal"><span style="font-size:12.0pt;mso-bidi-font-size:11.0pt;line-height:
	107%;font-family:"Cambria","serif"">CONFIRMACION DE PARTICIPACION<o:p></o:p></span></b></p>

	<p class=MsoNormal align=center style="text-align:center"><b style="mso-bidi-font-weight:
	normal"><span style="font-family:"Cambria","serif""><o:p>&nbsp;</o:p></span></b></p>

	<p class=MsoNormal><span style="font-family:"Cambria","serif"">'.$nom.'está
	correctamente inscrito en el sorteo para una de las becas que Innova Training
	Center sorteara.<o:p></o:p></span></p>

	<p class=MsoNormal><b style="mso-bidi-font-weight:normal"><span
	style="font-family:"Cambria","serif"">Fecha de Sorteo: </span></b><span
	class=GramE><span style="font-family:"Cambria","serif""></span></span><span
	style="font-family:"Cambria","serif""> 5 de octubre.<o:p></o:p></span></p>

	<p class=MsoNormal><b style="mso-bidi-font-weight:normal"><span
	style="font-family:"Cambria","serif"">Hora:</span></b><span style="font-family:
	"Cambria","serif""> 6:00pm<o:p></o:p></span></p>

	<p class=MsoNormal><b style="mso-bidi-font-weight:normal"><span
	style="font-family:"Cambria","serif"">Transmisión:</span></b><span
	style="font-family:"Cambria","serif""> En vivo por nuestra página de Facebook<o:p></o:p></span></p>

	<p class=MsoNormal><b style="mso-bidi-font-weight:normal"><span
	style="font-family:"Cambria","serif"">Beca:</span></b><span style="font-family:
	"Cambria","serif""> Valida para cualquier curso en modalidad presencial,
	organizado por Innova Training Center.<o:p></o:p></span></p>

	<p class=MsoNormal><b style="mso-bidi-font-weight:normal"><span
	style="font-family:"Cambria","serif"">Código de Participación:</span></b><span
	style="font-family:"Cambria","serif"">'.$id.'<o:p></o:p></span></p>

	<p class=MsoNormal align=right style="text-align:right"><span style="font-family:
	"Cambria","serif"">¡Le deseamos mucha suerte!<o:p></o:p></span></p>

	</div>

	</body>

	</html>';	

		//y mas modos....
		//....
	 
		$cuerpo .= "\r\n\r\n";
		$cuerpo .= "--". $htmlalt_boundary. "--\r\n\r\n"; //fin cuerpo mensaje a mostrar
	 	$no=0;
		//archivos adjuntos
		//if( strcmp($adjunto, "0") && strcmp($adjunto, "vacio")  ){
		if($no == 1){
			$archivo= $adjunto;
			$buf_type= "application/pdf"; //obtenemos tipo archivo
	 
			$fp= fopen( "../pdf/".$archivo, "r" ); //abrimos archivo
			$buf= fread( $fp, filesize("../pdf/".$archivo) ); //leemos archivo completamente
			fclose($fp); //cerramos apuntador;
	 
			$cuerpo .= "--". $boundary. "\r\n";
			$cuerpo .= "Content-Type: ". $buf_type. "; name=\"". $archivo. "\"\r\n"; //envio directo de datos
			$cuerpo .= "Content-Transfer-Encoding: base64\r\n";
			$cuerpo .= "Content-Disposition: attachment; filename=\"". $archivo. "\"\r\n\r\n";
			$cuerpo .= base64_encode($buf). "\r\n\r\n";

		}
		$cuerpo .= "--". $boundary. "--\r\n\r\n"; 
	 
		//funcion para enviar correo
		
			if( mail($to, $subject, $cuerpo, $headers) ){
			return true;
			}
			else{
				return false;
			}
	}

?>
<aside>
			<img src="../images/sorteo.jpg"  alt="innovatrainingcenter" width="100%" ">
		</aside>
			<br>
			<div  class="container">
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
							<h3 id="cuestionario" >Cuestionario</h3>
							<p>*Responde todas las preguntas correctamente para acceder al Formulario de inscripción</p>
									<h4 id="test_status"></h4>
									<div style="height: 180px;" id="test"> </div>
									
									
						
							

<?php
						$xtipo = leerParam("tipo","");

						if( $xtipo  =='valido'){


				    				$xfecha = date("Y-m-d H:i:s");
									$id_user=$_SESSION['user_id'];
									$selected = $_POST['checklist'];

									if ($stmt = $mysqli->prepare("SELECT `sorteo`.`id_sorteo`
																FROM `u292000437_bdi`.`sorteo` 
																WHERE  `sorteo`.`id_usuario` = ? 
																AND `sorteo`.`desc`='UNAPUNO';")){
									// Une “$user_id” al parámetro.
									$stmt->bind_param('i', $id_user);
									$stmt->execute();
				    				$stmt->store_result();

									$existe = $stmt->num_rows;
									// Si el usuario existe, obtiene las variables del resultado.   
									}

									if($existe >=1){
									 echo "<h3 class='alert alert-info'>Felicidades Ud. Ya se encuentra participando Codigo:".$id_user ."<br> Mucha suerte </h3>";


									}else{

										$stmt = $mysqli->prepare("INSERT INTO `u292000437_bdi`.`sorteo` (`id_usuario`, `fecha`, `desc`, `esta`,`descrip` )
									   	 VALUES (?,?,'UNAPUNO', 'a' , ?)");
										$stmt->bind_param("iss", $id_user, $xfecha,$selected);
										$stmt->execute();

										if ($stmt = $mysqli->prepare("SELECT `usuario`.`id_usuario`,
																	    `usuario`.`apell_p_usuario`,
																	    `usuario`.`apell_m_usuario`,
																	    `usuario`.`nom_usuario`,
																	    `usuario`.`email_usuario`
																	FROM `u292000437_bdi`.`usuario` WHERE`id_usuario` = ?  ;")){
										// Une “$user_id” al parámetro.
										$stmt->bind_param('i', $id_user);
										$stmt->execute();
					    				$stmt->bind_result($id,$nom_p, $nom_m, $nom_u, $email_user);
					    				$stmt->fetch();
										// Si el usuario existe, obtiene las variables del resultado.   
										}



										$nom = $nom_u." ".$nom_p." ".$nom_m;				
										$nom= strtoupper($nom);
										$valor=enviarconcurso($nom, $id, $email_user);
										if($valor == true){
											  echo "<h3 class='alert alert-info' > Felicidades esta correctamente inscrito, Mensaje enviado a: ".$email_user."</h3>";
										}else{
											echo "Error al enviar: " . $mail­>ErrorInfo;	
										}
									}

					}				
					else{
						header('Location: ../concurso.php?error=2');

					}

		?>		

				</div>								
				</div>
			</div>
		</div>

<!---------------------------------------------------------- Hmtl Seguro-------------------------------------------------------------------------------->
<?php							
			}else { 
				header('Location: ../../login.php?error=2');
			} 
	} else { 

		header('Location: ../../login.php?error=3');
    } 
 include 'footer.php';?>	