window.onload = function () {
	postaviVrijednostiZaTestiranje();
	postaviPorukeObjaveNovosti();
	//sakrijSveNovosti();
	document.getElementById("izborPrikazaNovosti").onchange = prikazIzabranihNovosti;
}

function sakrijSveNovosti(){
	var objekti = document.querySelectorAll(".izdvojeni-artikal");
	for (var i = 0; i < objekti.length; i++) {
		objekti[i].setAttribute("style","display:none;"); 
	};
}
function prikazIzabranihNovosti(){
	sakrijSveNovosti();

	var izabrano = document.getElementById("izborPrikazaNovosti").value;
	//alert(izabrano);
	var objekti = document.querySelectorAll(".objavljeno-prije");

	
	for (var i = 0; i < objekti.length; i++) {
		var trenutnoVrijeme = new Date();	
		var datumVrijemeObjave = new Date(objekti[i].getAttribute("data-datumObjave"));
		var timeOffsetZone = datumVrijemeObjave.getTimezoneOffset();

		//ovo je potrebno zato sto se datum izmijeni zbog vremenkse zone, timeOffsetZone je u minutama
		datumVrijemeObjave.setHours(datumVrijemeObjave.getHours() - Math.abs(timeOffsetZone)/60);

		if(izabrano=="danasnjeNovosti"){
			if(trenutnoVrijeme.getDate() == datumVrijemeObjave.getDate() 
				&& trenutnoVrijeme.getMonth() == datumVrijemeObjave.getMonth()
				&& trenutnoVrijeme.getFullYear() == datumVrijemeObjave.getFullYear()) //danasnji dan
					objekti[i].parentElement.setAttribute("style",""); 
		}else if (izabrano=="novostiOveSedmice"){
			var datumPonedjeljak = trenutnoVrijeme;
  			var ponedjeljak = datumPonedjeljak.getDay(), diff = d.getDate() - day + (day == 0 ? -6:1); 
  			datumPonedjeljak.setDate(diff);

			/*var razlikaSekunde = Math.round((trenutnoVrijeme.getTime() - datumVrijemeObjave.getTime())/1000);
			var razlikaMinute = Math.round(razlikaSekunde/60);
			var razlikaSati = Math.round(razlikaMinute/60);
			var razlikaDani = Math.round(razlikaSati/24);
*/
			//if(razlikaDani<7) //trenutna sedmica
			if(datumVrijemeObjave>=datumPonedjeljak) //trenutna sedmica
				objekti[i].parentElement.setAttribute("style",""); 
		}else if(izabrano=="novostiOvogMjeseca"){
			if(trenutnoVrijeme.getMonth() == datumVrijemeObjave.getMonth()
				&& trenutnoVrijeme.getFullYear() == datumVrijemeObjave.getFullYear()) //trenutni mjesec
					objekti[i].parentElement.setAttribute("style",""); 
		}else{ //sve novosti
			objekti[i].parentElement.setAttribute("style",""); 
		}
	};
}
function postaviPorukeObjaveNovosti(){
	var objekti = document.querySelectorAll(".objavljeno-prije");

	for (var i = 0; i < objekti.length; i++) {
		var trenutnoVrijeme = new Date();
		var datumVrijemeObjave = new Date(objekti[i].getAttribute("data-datumObjave"));
		var timeOffsetZone = datumVrijemeObjave.getTimezoneOffset();

		//ovo je potrebno zato sto se datum izmijeni zbog vremenkse zone, timeOffsetZone je u minutama
		datumVrijemeObjave.setHours(datumVrijemeObjave.getHours() - Math.abs(timeOffsetZone)/60);

		var razlikaSekunde = Math.round((trenutnoVrijeme.getTime() - datumVrijemeObjave.getTime())/1000);
		var razlikaMinute = Math.round(razlikaSekunde/60);
		var razlikaSati = Math.round(razlikaMinute/60);
		var razlikaDani = Math.round(razlikaSati/24);
		var razlikaSedmice = Math.round(razlikaDani/7); 
		

		// console.log("trenutnoVrijeme: "+trenutnoVrijeme);
		// console.log("datumVrijemeObjave: "+datumVrijemeObjave);

		// console.log("razlikaSekunde: "+razlikaSekunde);
		// console.log("razlikaMinute: "+razlikaMinute);
		// console.log("razlikaSati: "+razlikaSati);
		// console.log("razlikaSedmice: "+razlikaSedmice);
		// console.log("---------------------------------");

		var novostPoruka = "Novost objavljena prije ";
		if(razlikaSekunde < 60){
			objekti[i].innerHTML = novostPoruka + "par sekundi";
		} 
		else if (razlikaMinute < 60) {
			objekti[i].innerHTML = novostPoruka + razlikaMinute + ((razlikaMinute == 1) ? " minute" :" minuta");
		}
		else if (razlikaSati <24) {
			objekti[i].innerHTML = novostPoruka + razlikaSati + ((razlikaSati == 1) ? " sat" : ((razlikaSati == 2) ? " sata" :" sati"));
		}
		else if (razlikaDani <7) {
			objekti[i].innerHTML = novostPoruka + razlikaDani + ((razlikaDani == 1) ? " dan" :" dana");
		}
		else if (razlikaSedmice <= 4) {
			objekti[i].innerHTML = novostPoruka + razlikaSedmice + ((razlikaSedmice == 1) ? " sedmicu" :" sedmice");
		}
		else{
			objekti[i].innerHTML = "Datum objave: "+ datumVrijemeObjave.getDay() +"."+
													 datumVrijemeObjave.getMonth() +"."+
													 datumVrijemeObjave.getFullYear() +". "+
													 datumVrijemeObjave.getHours() +":"+
													 datumVrijemeObjave.getMinutes() +":"+
													 datumVrijemeObjave.getSeconds();
		}
	};
}

function postaviVrijednostiZaTestiranje(){
	var objekti = document.querySelectorAll(".objavljeno-prije");

	for (var i = 0; i < objekti.length; i++) {
		var trenutnoVrijeme = new Date();
		// console.log(trenutnoVrijeme);
		// console.log(trenutnoVrijeme.getFullYear() +"-"+
		// 										   pad(trenutnoVrijeme.getMonth()+1,2) +"-"+
		// 										   pad(trenutnoVrijeme.getDate(),2) +"T"+
		// 										   pad(trenutnoVrijeme.getHours(),2) +":"+
		// 										   pad(trenutnoVrijeme.getMinutes(),2) +":"+
		// 										   pad(trenutnoVrijeme.getSeconds(),2));
		if(i == 0){
			trenutnoVrijeme.setSeconds(trenutnoVrijeme.getSeconds() - 5); //manje od minute
		}else if (i == 1) {
			trenutnoVrijeme.setMinutes(trenutnoVrijeme.getMinutes() - 1); //1 minuta
		}else if (i == 2) {
			trenutnoVrijeme.setMinutes(trenutnoVrijeme.getMinutes() - 12);//12 minuta
		}else if (i == 3) {
			trenutnoVrijeme.setHours(trenutnoVrijeme.getHours() - 1);//1 sat
		}else if (i == 4) {
			trenutnoVrijeme.setHours(trenutnoVrijeme.getHours() - 2);//2 sata
		}else if (i == 5) {
			trenutnoVrijeme.setHours(trenutnoVrijeme.getHours() - 5);//2 sati
		}else if (i == 6) {
			trenutnoVrijeme.setDate(trenutnoVrijeme.getDate() - 1);//1 dan
		}else if (i == 7) {
			trenutnoVrijeme.setDate(trenutnoVrijeme.getDate() - 4);// 4 dana
		}else if (i == 8) {
			trenutnoVrijeme.setDate(trenutnoVrijeme.getDate() - 7); //1 sedmica
		}else if (i == 9) {
			trenutnoVrijeme.setDate(trenutnoVrijeme.getDate() - 19);//2 sedmice
		}else if (i == 10) {
			trenutnoVrijeme.setMonth(trenutnoVrijeme.getMonth() - 5);//5 mjeseci
		}else {
			trenutnoVrijeme.setFullYear(trenutnoVrijeme.getFullYear() - 5);
		}

		// console.log(trenutnoVrijeme.getFullYear() +"-"+
		// 										   pad(trenutnoVrijeme.getMonth()+1,2) +"-"+
		// 										   pad(trenutnoVrijeme.getDate(),2) +"T"+
		// 										   pad(trenutnoVrijeme.getHours(),2) +":"+
		// 										   pad(trenutnoVrijeme.getMinutes(),2) +":"+
		// 										   pad(trenutnoVrijeme.getSeconds(),2));
		objekti[i].setAttribute("data-datumObjave",trenutnoVrijeme.getFullYear() +"-"+
												   pad(trenutnoVrijeme.getMonth()+1,2) +"-"+
												   pad(trenutnoVrijeme.getDate(),2) +"T"+
												   pad(trenutnoVrijeme.getHours(),2) +":"+
												   pad(trenutnoVrijeme.getMinutes(),2) +":"+
												   pad(trenutnoVrijeme.getSeconds(),2)); 
	};
}
function pad (str, max) {
  str = str.toString();
  return str.length < max ? pad("0" + str, max) : str;
}