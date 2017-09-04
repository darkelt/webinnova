function formhash(form, password) {
    // Crea una entrada de elemento nuevo, esta será nuestro campo de contraseña con hash. 
    var p = document.createElement("input");
 
    // Agrega el elemento nuevo a nuestro formulario. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Asegúrate de que la contraseña en texto simple no se envíe. 
    password.value = "";
 
    // Finalmente envía el formulario. 
    form.submit();
}
 
function regformhash(form, uid, email, password, conf, telephone1, opera, direc, country, state,date) {
     // Verifica que cada campo tenga un valor
    if (uid.value == ''         || 
          email.value == ''     || 
          password.value == ''  || 
          conf.value == '') {
 
        alert('Deberá brindar toda la información solicitada. Por favor, intente de nuevo');
        return false;
    }
 	if (form.username.value == "") {
        alert("Su usuario no puede estar en blanco!!");
        form.username.focus();
        return false;
    }
		if (form.country.value == "") {
        alert("Debe ingresar su País");
        form.username.focus();
        return false;
    }
	if (form.state.value == "") {
        alert("Debe ingresar su Ciudad");
        form.username.focus();
        return false;
    }
	if (form.direc.value == "") {
        alert("Debe ingresar su dirección");
        form.username.focus();
        return false;
    }
		if (form.date.value == "") {
        alert("Debe ingresar su Fecha de nacimiento");
        form.username.focus();
        return false;
    }
	
	if (form.telephone1.value == "") {
        alert("Debe ingresar por lo menos un numero telefonico");
        form.username.focus();
        return false;
    }
	    if (form.opera.value == "") {
        alert("Debe ingresar el operador telefonico");
        form.username.focus();
        return false;
    }
    // Verifica que la contraseña tenga la extensión correcta (mín. 6 caracteres)
    // La verificación se duplica a continuación, pero se incluye para que el
    // usuario tenga una guía más específica.
    if (password.value.length < 6) {
        alert('La contraseña deberá tener al menos 6 caracteres. Por favor, inténtelo de nuevo');
        form.password.focus();
        return false;
    }
 
    // Por lo menos un número, una letra minúscula y una mayúscula 
    // Al menos 6 caracteres
 
    
    // Verifica que la contraseña y la confirmación sean iguales
    if (password.value != conf.value) {
        alert('La contraseña y la confirmación no coinciden. Por favor, inténtelo de nuevo');
        form.password.focus();
        return false;
    }
 
    // Crea una entrada de elemento nuevo, esta será nuestro campo de contraseña con hash. 
    var p = document.createElement("input");
 
    // Agrega el elemento nuevo a nuestro formulario. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Asegúrate de que la contraseña en texto simple no se envíe. 
    password.value = "";
    conf.value = "";
 
    // Finalmente envía el formulario. 
    form.submit();
    return true;
}


function pwdhash(form,password) {

 // Verifica que la contraseña tenga la extensión correcta (mín. 6 caracteres)
    // La verificación se duplica a continuación, pero se incluye para que el
    // usuario tenga una guía más específica.
    if (password.value.length < 6) {
        alert('La contraseña deberá tener al menos 6 caracteres. Por favor, inténtelo de nuevo');
        form.password.focus();
        return false;
    }
 
    // Por lo menos un número, una letra minúscula y una mayúscula 
    // Al menos 6 caracteres
 
  
 
    // Verifica que la contraseña y la confirmación sean iguales
    if (password.value != conf.value) {
        alert('La contraseña y la confirmación no coinciden. Por favor, inténtelo de nuevo');
        form.password.focus();
        return false;
    }
 
    // Crea una entrada de elemento nuevo, esta será nuestro campo de contraseña con hash. 
    var p = document.createElement("input");
 
    // Agrega el elemento nuevo a nuestro formulario. 
    form.appendChild(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
 
    // Asegúrate de que la contraseña en texto simple no se envíe. 
    password.value = "";
    conf.value = "";
 
    // Finalmente envía el formulario. 
    form.submit();
    return true;
}