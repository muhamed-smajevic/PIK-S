<?php
session_start();
date_default_timezone_set('Europe/Sarajevo');
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
  <META http-equiv="Content-Type" content="text/html; charset=utf-8">

  <link rel="stylesheet" type="text/css" href="style.css">
  <TITLE>PIK-S, Dobrodošli</TITLE>
  <SCRIPT src="Skripte/novosti.js"></SCRIPT>
</HEAD>
<BODY>

	<?php
		if (isset($_REQUEST["prijava"]) ) {
			if($_REQUEST["prijava"] == "prijava"){
				header("Location: Login.php"); 
				exit();
			}
			if($_REQUEST["prijava"] == "odjava"){
				session_unset();
				header("Location: index.php"); 
				exit();
			}
		}
	?>

	<div class="gornji-meni">
		<div class="sadrzaj-kontejner">
			<ul class="lista-gornji-meni">
				<li class="glavni-meni-stavka-li">
					<a href="index.php" class="glavni-meni-stavka">Početna</a>
				</li>
				<li class="glavni-meni-stavka-li">
					<a href="#" class="glavni-meni-stavka">Vozila</a>
				</li>
				<li class="glavni-meni-stavka-li">
					<a href="#" class="glavni-meni-stavka">Nekretnine</a>
				</li>
				<li class="glavni-meni-stavka-li">
					<a href="TabelarniPodaci.php" class="glavni-meni-stavka">Tabelarni podaci</a>
				</li>
				<li class="glavni-meni-stavka-li">
					<a href="Kontakt.php" class="glavni-meni-stavka">Kontakt</a>
				</li>
				<li class="glavni-meni-stavka-li">
					<a href="ListaLinkova.php" class="glavni-meni-stavka">Eksterni linkovi</a>
				</li>

				<li class="glavni-meni-stavka-li">
					<?php
						if (isset($_SESSION["username"]) ) {
				       		print "<a href='DodavanjeNovosti.php' class='glavni-meni-stavka'>Dodavanje novosti</a>";
				   		}
				    ?>
				</li>
				<li class="profil-dobrodoslica">
					<?php
						if (isset($_SESSION["username"]) ) {
				       		print "<p>Dobrodošao/la <i>".$_SESSION["username"]."</i></p>";
				   		}
				    ?>
				</li>
			</ul>
		</div>
	</div>
	<div class="glavna-pretraga">
		<div class="sadrzaj-kontejner">
			<div class="logo">
				<p>PIK-S</p>
			</div>
			<div class="pretraga">
				<div class="centrirana-pretraga">
					<input type="text" placeholder="Probajte: Automobili novo...">
					<button>Pretraži</button>
				</div>
			</div>
			<div class="prijava">
				<?php
					if (isset($_SESSION["username"]) ) {
						print "<form action='index.php' method='post'>
									<button type='submit' name='prijava' value='odjava'>Odjava</button>
								</form>";
      				}
      				else{
      					print "<form action='index.php' method='post'>
									<button type='submit' name='prijava' value='prijava'>Prijava</button>
							   </form>";
      				}
      			?>
				
			</div>
		</div>
	</div>
	<div class="sadrzaj-kontejner">
		<div class="sadrzaj-prvi-dio-naslovna">
			<div class="sporedni-meni">
				<ul class="lista-sporedni-meni">
					<li>
						<a href="#" class="sporedni-meni-stavka">Početna</a>
					</li>
					<li>
						<a href="#" class="sporedni-meni-stavka">Vozila</a>
					</li>
					<li>
						<a href="#" class="sporedni-meni-stavka">Nekretnine</a>
					</li>
					<li>
						<a href="#" class="sporedni-meni-stavka">Mobilni uređaji</a>
					</li>

					<li>
						<a href="#" class="sporedni-meni-stavka">Kompjuteri</a>
					</li>
					<li>
						<a href="#" class="sporedni-meni-stavka">Tehnika</a>
					</li>
					<li>
						<a href="#" class="sporedni-meni-stavka">Nakit i satovi</a>
					</li>
					<li>
						<a href="#" class="sporedni-meni-stavka">Moj dom</a>
					</li>
					<li>
						<a href="#" class="sporedni-meni-stavka">Biznis i industrija</a>
					</li>
					<li>
						<a href="#" class="sporedni-meni-stavka">Životinje</a>
					</li>
					<li>
						<a href="#" class="sporedni-meni-stavka">Sve ostalo</a>
					</li>
				</ul>

			</div>
			<div class="naslovna-reklame">
				<div class="velika-reklama">
					<img src="Content/SlikeReklama/velika_reklama.png"/>
					<p>Velika reklama</p>
				</div>
				<div class="srednja-reklama">
					<img src="Content/SlikeReklama/srednja_reklama.png">
					<p>Srednja reklama</p>
				</div>
				<div class="srednja-reklama">
					<img src="Content/SlikeReklama/srednja_reklama.png">
					<p>Srednja reklama</p>
				</div>
				<div class="mala-reklama">
					<img src="Content/SlikeReklama/mala_reklama.jpg">
					<p>m.r</p>
				</div>
				<div class="mala-reklama">
					<img src="Content/SlikeReklama/mala_reklama.jpg">
					<p>m.r</p>
				</div>
				<div class="mala-reklama">
					<img src="Content/SlikeReklama/mala_reklama.jpg">
					<p>m.r</p>
				</div>
				<div class="mala-reklama">
					<img src="Content/SlikeReklama/mala_reklama.jpg">
					<p>m.r</p>
				</div>
				<div class="srednja-reklama">
					<img src="Content/SlikeReklama/srednja_reklama.png">
					<p>Srednja reklama</p>
				</div>
			</div>
		</div>
		
		<div class="filtriranje-novosti">
			<h2>Izdvojeni artikli</h2>
			<div class="filtriranje-novosti-odabir">
				<label>Prikaži: </label>
				<select id="izborPrikazaNovosti">
				  <option value="danasnjeNovosti">Današnje novosti</option>
				  <option value="novostiOveSedmice">Novosti ove sedmice</option>
				  <option value="novostiOvogMjeseca">Novosti ovog mjeseca</option>
				  <option value="sveNovosti" selected>Sve novosti</option>
				</select>
			</div>
		</div>
		<div class="izdvojeni-artikli">

			<?php
		
			if (file_exists("Data/novosti.csv")){
				$row = 1;
				if (($handle = fopen("Data/novosti.csv", "r")) !== FALSE) {
					$novosti = array();
				        
				    while (($data = fgetcsv($handle, 1000, ".")) !== FALSE) {
				        //$num = count($data);
				        //echo "<p> $num fields in line $row: <br /></p>\n";
				      	
				        $cijena ="";
				        if($data[4] == "on")
				        	$cijena ="PO DOGOVORU";
				        else
				        	$cijena = number_format($data[3], 2).' KM';
				        $row++;

				        $data[4] = $cijena;

				        array_push($novosti, $data);

				        
				    }
				    fclose($handle);

				    //sortiranje
				    asort($novosti);

				    if(count($novosti) != 0){
				    	//ispisivanje novosti
					    for ($x = count($novosti)-1; $x >= 0; $x--) {
						    echo "<div class='izdvojeni-artikal'>
									<div class='izdovjeni-artikal-slika'>
										<img src='Content/SlikeArtikala/".$novosti[$x][0].".".$novosti[$x][1]."'>
									</div>
									<p>".$novosti[$x][2]."</p>
									<div class='cijena'>".$novosti[$x][4]."</div>
									<span class='objavljeno-prije' data-datumObjave='".gmdate("Y-m-d\TH:i:s\Z", $novosti[$x][0] + 0)."'>Novost objavljena prije par sekundi</span>
								</div>";
						} 
				    }
				}
			}	
			?>

			<!--div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/1.jpg">
				</div>
				<p>Povolnje gume - Najpovoljnjije u BiH</p>
				<div class="cijena">PO DOGOVORU</div>
				<span class="objavljeno-prije" data-datumObjave="2016-04-02T14:35:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/2.jpg">
				</div>
				<p>CUBOT NOTE S - 2GB RAM / 5.5inča / Kamera 8MP</p>
				<div class="cijena">220,00 KM</div>
				<span class="objavljeno-prije" data-datumObjave="2016-03-26T12:00:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/3.jpg">
				</div>
				<p>CRNI Alfa Romeo znak 147 156 159 166 GT GTV Brera</p>
				<div class="cijena">25,00 KM</div>
				<span class="objavljeno-prije" data-datumObjave="2016-02-10T16:01:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/4.jpg">
				</div>
				<p>Tapeta 3D kamen</p>
				<div class="cijena">10,00 KM</div>
				<span class="objavljeno-prije" data-datumObjave="2016-04-02T13:35:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/5.jpg">
				</div>
				<p>Felge Opel 18</p>
				<div class="cijena">650,00 KM</div>
				<span class="objavljeno-prije" data-datumObjave="2015-05-24T12:53:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/6.jpg">
				</div>
				<p>Golf 5 V plus</p>
				<div class="cijena">10.499,00 KM</div>
				<span class="objavljeno-prije" data-datumObjave="2016-03-27T12:53:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/7.jpg">
				</div>
				<p>Auto caddy PUTNICKI</p>
				<div class="cijena">12.599,00 KM</div>	
				<span class="objavljeno-prije" data-datumObjave="2016-03-27T12:53:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/1.jpg">
				</div>
				<p>Povolnje gume - Najpovoljnjije u BiH</p>
				<div class="cijena">PO DOGOVORU</div>
				<span class="objavljeno-prije" data-datumObjave="2016-04-02T14:35:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/2.jpg">
				</div>
				<p>CUBOT NOTE S - 2GB RAM / 5.5inča / Kamera 8MP</p>
				<div class="cijena">220,00 KM</div>
				<span class="objavljeno-prije" data-datumObjave="2016-03-26T12:00:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/3.jpg">
				</div>
				<p>CRNI Alfa Romeo znak 147 156 159 166 GT GTV Brera</p>
				<div class="cijena">25,00 KM</div>
				<span class="objavljeno-prije" data-datumObjave="2016-02-10T16:01:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/4.jpg">
				</div>
				<p>Tapeta 3D kamen</p>
				<div class="cijena">10,00 KM</div>
				<span class="objavljeno-prije" data-datumObjave="2016-01-19T23:08:58">Novost objavljena prije par sekundi</span>
			</div>
			<div class="izdvojeni-artikal">
				<div class="izdovjeni-artikal-slika">
					<img src="Content/SlikeArtikala/5.jpg">
				</div>
				<p>Felge Opel 18</p>
				<div class="cijena">650,00 KM</div>
				<span class="objavljeno-prije" data-datumObjave="2015-05-24T12:53:58">Novost objavljena prije par sekundi</span>
			</div-->
		</div>
		<p>Muhamed Smajevic WT,2016</p>
	</div>
</BODY>
</HTML>