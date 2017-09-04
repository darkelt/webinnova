<?php 
include 'header.php';
if (login_check($mysqli) == true ) {
	if ($_SESSION['permiso'] == 'A'){




?>
<script>
var pos = 0, test, test_status, question, choice, choices, chA, chB, chC, correct = 0;
var dato = 0;
var questions = [
    [ "1. ¿Qué es el Revit?", "Un software que trabaja con metodología BIM ", "Un software que trabaja con tecnología RVT", "Un software que trabaja con tecnología CAD.", "A" ],
	[ "2. ¿Qué significa las siglas BIM?", "Big Information Modeling", "Building Inteligence Modeling", "Building Information Modeling", "C" ],
	[ "3. BIM es:", "Es un sistema de gestión para las obras de construcción", "Es solo modelado 3D", "Es un software de diseño", "A" ],
	[ "4. En cuales de las etapas del ciclo de vida de un  proyecto nos ayuda la metodologia BIM?", "En la etapa de diseño", "En todas las etapas del ciclo de vida del proyecto", "En la etapa de construcción", "B" ],
	[ "5. La contrucción en nuestro pais en un proceso eficiente?", "Si, es un proceso  eficiente", "Es un proceso sin perdidas ni desperdicios", "No, Es un proceso ineficiente", "C" ],
	[ "6. A quienes beneficia la implementación de la metodología BIM?", "Solo a los ingenieros y arquitectos", "Solamente al propietario", "A todos los involucrados en el proyecto", "C" ],
	[ "7. Cual de la siguiente alternativas no es un uso del BIM", "Detección de interferencias", "Analisis estructural", "Ensayos de geotécnia", "C" ]
];

function _(x){
	return document.getElementById(x);
}
function check(){
	opciones = document.getElementsByName("check_list[]");
	 
	var seleccionado = false;
	var cadena = '';
	for(var i=0; i<opciones.length; i++) {    


	 if(opciones[i].checked) {
	   cadena = cadena+'-'+opciones[i].value;
	  }
	  
	}
	for(var i=0; i<opciones.length; i++) {    

	  if(opciones[i].checked) {
	   	 seleccionado = true;
	     // el input del formulario
		  dato = document.getElementById("checklist");
		  // dar el valor que ha recibido la función
		  dato.value = cadena;
		 
		  // enviar el formulario
		  document.formularioconcurso.submit();
	  }
	}
	 
	if(!seleccionado) {
	 alert('Seleccione por lo menos un Curso por favor...! ');
	  return false;
	}
}

function renderQuestion(){
	test = _("test");
	if(pos >= questions.length){
		if( correct == questions.length){
		
			_("test_status").innerHTML = "<div class='alert alert-success'>Felicitaciones - Tu tienes "+correct+" de "+questions.length+" respuestas correctas</div>";
			test.innerHTML = "<p>*Escoje los cursos de tu interes</p>";
			test.innerHTML += "<div class='col-md-6'><div class='checkbox'><label><input type='checkbox' id='check' name='check_list[]' value='RA' required>Revit Arquitectura</label></div><div class='checkbox'><label><input type='checkbox' id='check' name='check_list[]' value='RS'>Revit Structure</label></div><div class='checkbox'><label><input type='checkbox' id='check' name='check_list[]' value='RMEP'>Revit MEP Instalaciones</label></div><div class='checkbox'><label><input type='checkbox' id='check' name='check_list[]' value='NAV'>Navisworks</label></div><div class='checkbox'><label><input type='checkbox' id='check' name='check_list[]' value='ROB'>Robot Structural</label></div></div>";
			test.innerHTML += "<div class='col-md-6'><div class='checkbox'><label><input type='checkbox' id='check' name='check_list[]' value='AUT'>Autocad</label></div><div class='checkbox'><label><input type='checkbox' id='check' name='check_list[]' value='C3D'>Civil 3D</label></div><div class='checkbox'><label><input type='checkbox' id='check' name='check_list[]' value='S10'>Costos y Presupuestos con S10</label></div><div class='checkbox'><label><input type='checkbox' id='check' name='check_list[]' value='MBIM'>Metrados con BIM</label></div><div class='checkbox'><label><input type='checkbox' id='check' name='check_list[]' value='MSP'>Programación de obras con MS Proyect</label></div></div>";
			
			boton.innerHTML += "<button type='submit'  class='btn btn-success'  > Participa Aquí....!!</button>";
			correct = 0;
			return false;
			
		}
		else{
		_("test_status").innerHTML = "<div class='alert alert-danger'>Tu tienes "+correct+" de "+questions.length+" respuestas correctas- Intentalo  una ves más</div>";
		boton.innerHTML += "<button type='button' class='btn btn-danger' onclick='renderQuestion()'>Intentalo Denuevo</button>";
		pos = 0;
		correct = 0;
		return false;
			
		}
	}
	
	
	_("test_status").innerHTML = "<div class='alert alert-info'>Pregunta "+(pos+1)+" de "+questions.length+"</div>";
	question = questions[pos][0];
	chA = questions[pos][1];
	chB = questions[pos][2];
	chC = questions[pos][3];
	test.innerHTML = "<div style='height: 40px;''><label>"+question+"<label for='demo-name'></div>";
	test.innerHTML += "<div class='radio'><label><input type='radio' name='choices' value='A'>"+chA+"</label></div>";
	test.innerHTML += "<div class='radio'><label><input type='radio' name='choices' value='B'>"+chB+"</label></div>";
	test.innerHTML += "<div class='radio'><label><input type='radio' name='choices' value='C'>"+chC+"</label></div>";
	boton.innerHTML = "<button type='button' class='btn btn-default'onclick='checkAnswer()'>Siguiente</button>";
}
function checkAnswer(){
	choices = document.getElementsByName("choices");
	for(var i=0; i<choices.length; i++){
		if(choices[i].checked){
			choice = choices[i].value;
		}
	}
	if(choice == questions[pos][4]){
		correct++;
	}
	pos++;
	renderQuestion();
}
function validarentrada(){
	test = _("test");
	if (dato == 0){

		_("test_status").innerHTML = "<div class='alert alert-info'>Ingrese el Codigo para participación..!!</div>";
	}else{
		_("test_status").innerHTML = "<div class='alert alert-danger'>Ingrese el Codigo para participación..!!</div>";

	}
	test.innerHTML = "<div style='height: 50px;''></div>";
	test.innerHTML += "<input  class='form-control' type='text' name='valida' size='20'>";
	boton.innerHTML = "<button type='button' class='btn btn-default'onclick='valida()'>Siguiente</button>";
		
}

function valida(){
 var valida = document.getElementsByName("valida");
 		valida = valida[0].value;
	 if (valida == 'ggf12yt5'){
		 renderQuestion();
	 }else{
	 	dato ++;
	 	validarentrada();

	 }
}

window.addEventListener("load", validarentrada, false);

</script>
		<!-- end:fh5co-header -->
		<aside>
			<img src="../images/sorteo.jpg"  alt="innovatrainingcenter" width="100%" ">
		</aside>
			<br>
			<div  class="container">
				<div class="row about">
					<div class="col-md-12">
						<div class="col-md-4">
							<h3>Procedimiento de Inscripción</h3>	
								<small><li>Solo participaran en el sorteo para una de las tres becas, los alumnos que hayan asistido a la charla: Introducción a la Metodología BIM</li></small>
								<small><li>Cada alumno deberá registrarse en nuestra página web:</li></small>
								<small><li>En la charla los alumnos recibieron un código genérico, que deberán ingresar en nuestra página web.</li></small>
								<small><li>Recibirá un correo de Confirmación de Participación, y su código de participación.</li></small>
								<small><li>El sorteo se realizará el día <b>Miércoles 28 de Septiembre de 2016, a horas 6:00pm.</b></li></small>
								<small><li>El sorteo iniciará con todos los códigos registrados en nuestra página web hasta el día miércoles 28 de septiembre a horas 3:00pm.</li></small>
								<small><li>Si los participantes ingresan su código después de la fecha y hora establecidas en el párrafo anterior,no participaran del sorteo sin lugar a reclamos posteriores.</li></small>
								<small><li>El proceso para elegir a los 3 ganadores.</li></small>
								<small><li>La transmisión del sorteo será en vivo por nuestra página de Facebook.</li></small>	
								<spam>Innova Training Center desea muchísima suerte a cada uno de los participantes.</spam>
							
								
						
						</div>
						<div class="col-md-8">
							<h3 id="cuestionario" >Cuestionario</h3>
							<p>*Responde todas las preguntas correctamente para acceder al Formulario de inscripción</p>
									<h4 id="test_status"></h4>
									<div style="height:180px;" id="test"> </div>
									<form name="formularioconcurso" method='post' onsubmit='return check();' action='enviar_concurso.php'>
										<input type='hidden' name='tipo' value='valido'>
										<input type='hidden' name='checklist' id='checklist' >
										<div id="boton"></div>
									</form>
									<div id="solucion"></div>
									<div id="dato"></div>
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