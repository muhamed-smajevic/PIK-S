var imeRegex = /(^[A-Z])[a-z]{2,30}$/;
var emailRegex = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
var datumRegex = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/;
var adresaRegex = /(^[A-Z])[a-zA-Z0-9. ]{2,40}$/;

window.onload = function() {
	document.getElementById("txtIme").onblur = imeValidacija;
	document.getElementById("txtPrezime").onblur = prezimeValidacija;

	document.getElementById("txtEmail").onblur = emailValidacija;
	document.getElementById("txtAdresa").onblur = adresaValidacija;
	document.getElementById("txtDatumRodjenja").onblur = datumRodjenjaValidacija;

	document.getElementById("btnPosalji").onclick = slanjeForme;
}

function imeValidacija(){
	//console.log("ime validacija");
	var ime = document.getElementById("txtIme").value;
	if(!imeRegex.test(ime)){
		document.getElementById("txtIme").setAttribute("style","border:1px solid red;");
		document.getElementById("lblImeVal").innerHTML = "Ime mora počinjati velikim slovom i sadržavati barem 3 slova.";
		document.getElementById("trImeVal").classList.remove("sakriveno");
		return false;
	}else{
		document.getElementById("txtIme").setAttribute("style","");
		document.getElementById("trImeVal").classList.add("sakriveno");
		return true;
	}
}
function prezimeValidacija(){
	//console.log("prezime validacija");
	var prezime = document.getElementById("txtPrezime").value;
	if(!imeRegex.test(prezime)){
		document.getElementById("txtPrezime").setAttribute("style","border:1px solid red;");
		document.getElementById("lblPrezimeVal").innerHTML = "Prezime mora počinjati velikim slovom i sadržavati barem 3 slova.";
		document.getElementById("trPrezimeVal").classList.remove("sakriveno");
		return false;
	}else{
		document.getElementById("txtPrezime").setAttribute("style","");
		document.getElementById("trPrezimeVal").classList.add("sakriveno"); 
		return true;
	}
}
function emailValidacija(){
	//console.log("email validacija");
	var email = document.getElementById("txtEmail").value;
	var adresa = document.getElementById("txtAdresa").value;
	if(email =="" && adresa==""){
		document.getElementById("txtAdresa").setAttribute("style","border:1px solid red;");
	}
	else if(email == ""){
		document.getElementById("txtEmail").setAttribute("style","");
		document.getElementById("trEmailVal").classList.add("sakriveno"); 
		return true;
	}else{
		if(!emailRegex.test(email)){
			document.getElementById("txtEmail").setAttribute("style","border:1px solid red;");
			document.getElementById("lblEmailVal").innerHTML = "Email mora biti u formatu name@example.com";
			document.getElementById("trEmailVal").classList.remove("sakriveno");
			return false;
		}else{
			document.getElementById("txtEmail").setAttribute("style","");
			document.getElementById("txtAdresa").setAttribute("style","");

			document.getElementById("trEmailVal").classList.add("sakriveno"); 
			//document.getElementById("trAdresaVal").classList.add("sakriveno"); 
			//adresaValidacija();
			return true;
		}
	}
	
}
function adresaValidacija(){
	//console.log("adresa validacija");
	var email = document.getElementById("txtEmail").value;
	var adresa = document.getElementById("txtAdresa").value;
	if(email =="" && adresa==""){
		document.getElementById("txtEmail").setAttribute("style","border:1px solid red;");
	}
	else if(adresa ==""){
		document.getElementById("txtAdresa").setAttribute("style","");
		document.getElementById("trAdresaVal").classList.add("sakriveno"); 
		return true;
	}else{
		//alert("adresa: "+adresa);
		//alert();
		if(!adresaRegex.test(adresa)){
			document.getElementById("txtAdresa").setAttribute("style","border:1px solid red;");
			document.getElementById("lblAdresaVal").innerHTML = "Adresa mora počinjati velikim slovom i sadržavati barem 3 slova.";
			document.getElementById("trAdresaVal").classList.remove("sakriveno");
			return false;
		}else{
			document.getElementById("txtAdresa").setAttribute("style","");
			document.getElementById("txtEmail").setAttribute("style","");

			//document.getElementById("trEmailVal").classList.add("sakriveno"); 
			document.getElementById("trAdresaVal").classList.add("sakriveno"); 
			//emailValidacija();
			return true;
		}
	}
	
}
function adresa_email_validacija(){
	//console.log("adresa_email validacija");
	var email = document.getElementById("txtEmail").value;
	var adresa = document.getElementById("txtAdresa").value;
	if(email =="" && adresa==""){
		document.getElementById("txtEmail").setAttribute("style","border:1px solid red;");
		document.getElementById("txtAdresa").setAttribute("style","border:1px solid red;");
		return false;
	}
	return adresaValidacija() && emailValidacija();
}
function datumRodjenjaValidacija(){
	//console.log("datumRodjenaj validacija");
	var datum = document.getElementById("txtDatumRodjenja").value;
	if(!datumRegex.test(datum)){
		document.getElementById("txtDatumRodjenja").setAttribute("style","border:1px solid red;");
		return false;
	}else{
		document.getElementById("txtDatumRodjenja").setAttribute("style","");
		return true;
	}
	//alert(document.getElementById("txtDatumRodjenja").value);
}
function slanjeForme(){
	//console.log("DUGMEEEEEEEEEEEEEEEEEEEEEEEEEEEE");
	///alert("pozivam!!");
	imeValidacija();
	prezimeValidacija();
	adresa_email_validacija();
	datumRodjenjaValidacija();
	if(imeValidacija() && prezimeValidacija() && adresa_email_validacija() && datumRodjenjaValidacija()){
		alert("Uspjesno uneseno!");
	}else{
		alert("nije uspjesno");
	}
}