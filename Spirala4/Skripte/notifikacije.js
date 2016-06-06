/*window.onload = function() {
	window.setInterval(osvjeziNotifikacije, 2000);
}*/
osvjeziNotifikacije();

window.setInterval(osvjeziNotifikacije, 2000);
function osvjeziNotifikacije(){
	var xhttp = new XMLHttpRequest();
  	xhttp.onreadystatechange = function() {
	    if (xhttp.readyState == 4 && xhttp.status == 200) {
	    	var rez = JSON.parse(xhttp.responseText);
	    	console.log(rez.ukupno);
	    	if(  parseInt(rez.ukupno)>0 ){
	    		document.getElementById("brojKomentara").classList.remove("sakriveno"); 
	    		document.getElementById("brojKomentara").innerHTML  = "&nbsp;"+rez.ukupno+"&nbsp;";
	    	}else{
	    		document.getElementById("brojKomentara").classList.add("sakriveno"); 
	    		document.getElementById("brojKomentara").innerHTML  = 0;
	    	}
	    }
  	};
  	xhttp.open("GET", "NotifikacijeZaKorisnika.php", true);
  	xhttp.send();
}
