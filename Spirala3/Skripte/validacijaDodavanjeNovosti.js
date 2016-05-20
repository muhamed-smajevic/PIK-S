window.onload = function() {
	document.getElementById("telefonPozivni").onblur = telefonValidacija;
	document.getElementById("kodDrzave").onchange = telefonValidacija;
	document.getElementById("telefonOstatak").onblur = telefonOstatakValidacija;

	document.getElementById("slika").onchange = odabranaSlikaValidacija;
	document.getElementById("cijena").onblur = cijenaValidacija;
	document.getElementById("kratakOpis").onblur = kratakOpisValidacija;
}


function telefonValidacija(){
	loadKodDrzave();
}

function loadKodDrzave() {
	var kodDrzave = document.getElementById("kodDrzave").value;
  	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	    	var rez = JSON.parse(xhttp.responseText);
	    	var broj =  rez[0].callingCodes;
	    	//console.log("ajax: " +broj);

	    	var kodDrzave = document.getElementById("kodDrzave").value;

			var telefonPozivni = document.getElementById("telefonPozivni").value;
			broj = "+"+broj;

			//console.log("broj: "+broj+" tel: "+telefonPozivni);
	    	if(broj != telefonPozivni){
				document.getElementById("telefonPozivni").setAttribute("style","border:1px solid red;");
				document.getElementById("lblTelefonPozivni").innerHTML = "Molimo unesite ispravno pozivni za izabranu državu.";
				document.getElementById("trTelefonPozivniVal").classList.remove("sakriveno");
				return false;
			}else{
				document.getElementById("telefonPozivni").setAttribute("style","");
				document.getElementById("trTelefonPozivniVal").classList.add("sakriveno");
				return true;
			}
	    }
  	};
  	xhttp.open("GET", "https://restcountries.eu/rest/v1/alpha?codes="+kodDrzave, true);
  	xhttp.send();
}

function kratakOpisValidacija() {
	var kratakOpis = document.getElementById("kratakOpis").value;
	document.getElementById("kratakOpis").value = kratakOpis.replace("."," ");
	kratakOpis = document.getElementById("kratakOpis").value;

	console.log("KR opois: "+kratakOpis);

	if(kratakOpis.length < 5){
		document.getElementById("kratakOpis").setAttribute("style","border:1px solid red;");
		document.getElementById("lblKratakOpis").innerHTML = "Kratak opis mora sadrzavati barem 5 znakova.";
		document.getElementById("trKratakOpisVal").classList.remove("sakriveno");
		return false;
	}else{
		document.getElementById("kratakOpis").setAttribute("style","");
		document.getElementById("trKratakOpisVal").classList.add("sakriveno");
		return true;
	}
}


function telefonOstatakValidacija() {
	var telefonOstatak = document.getElementById("telefonOstatak").value;
	console.log("KR opois: "+kratakOpis.length);

	if(telefonOstatak.length < 6){
		document.getElementById("telefonOstatak").setAttribute("style","border:1px solid red;");
		document.getElementById("lblTelefonPozivni").innerHTML = "Ostatak telefona mora sadrzavati barem 6 znakova.";
		document.getElementById("trTelefonPozivniVal").classList.remove("sakriveno");
		return false;
	}else{
		document.getElementById("telefonOstatak").setAttribute("style","");
		document.getElementById("trTelefonPozivniVal").classList.add("sakriveno");
		return true;
	}
}

function odabranaSlikaValidacija() {
	var slika = document.getElementById("slika").value;
	console.log(slika.split('.').pop());

	if(slika.split('.').pop() != "jpg" 
		&& slika.split('.').pop() != "bmp"
		&& slika.split('.').pop() != "png"){
		document.getElementById("slika").setAttribute("style","border:1px solid red;");
		document.getElementById("lblSlika").innerHTML = "Molimo odaberite sliku. Podržani formati su: .jpg, .bmp, .png.";
		document.getElementById("trSlika").classList.remove("sakriveno");
		return false;
	}else{
		document.getElementById("slika").setAttribute("style","");
		document.getElementById("trSlika").classList.add("sakriveno");
		return true;
	}
}

function cijenaValidacija() {
	var cijena = document.getElementById("cijena").value;
	if(cijena =="")
		document.getElementById("cijena").value = 0;

	console.log(cijena);

	if(parseInt(cijena) == 0){
		console.log("postavljam!!");
		document.getElementById("poDogovoru").checked = true;
	}else{
		//document.getElementById("slika").setAttribute("style","");
		//document.getElementById("trSlika").classList.add("sakriveno");
		//return true;
	}
}


function validirajFormu(){
	cijenaValidacija();
	var slikaVal = odabranaSlikaValidacija();
	var kodVal = loadKodDrzave();
	var krOpisVal = kratakOpisValidacija();
	var telOstatakVal =  telefonOstatakValidacija();
	return slikaVal && kodVal && krOpisVal && telOstatakVal;
}