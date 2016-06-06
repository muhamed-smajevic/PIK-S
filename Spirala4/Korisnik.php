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
  <?php
		if (isset($_SESSION["username"]) ) {
			print "<SCRIPT src='Skripte/notifikacije.js'></SCRIPT>";
		}
	?>
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
					<?php
						if (isset($_SESSION["korisnikTipID"]) ) {
							if($_SESSION["korisnikTipID"] == 1){
								print "<a href='Korisnici.php' class='glavni-meni-stavka' style='color:red''>Korisnici</a>";
							}
							else{
								print "<a href='#' class='glavni-meni-stavka'>Nekretnine</a>";
							}
				   		}else{
				   			print "<a href='#' class='glavni-meni-stavka'>Nekretnine</a>";
				   		}
				    ?>
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
				<li class="glavni-meni-stavka-li">
					<?php
						if (isset($_SESSION["username"]) ) {
					       	print "<a href='Korisnik.php?korisnikID=".$_SESSION["korisnikID"]."' class='glavni-meni-stavka'>Moji artikli</a>";
					   	}
					?>
				</li>

				<li class="profil-dobrodoslica">
					<?php
						if (isset($_SESSION["username"]) ) {
				   			print "<p><a id='brojKomentara' class='komentar-notifikacije sakriveno' href='Korisnik.php?korisnikID=".$_SESSION["korisnikID"]."'>&nbsp;0&nbsp;</a> Dobrodošao/la <i>".$_SESSION["username"]."</i></p>";
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
			<?php
				if(isset($_GET["korisnikID"])){
					$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      				$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      				$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");
					
					$veza->exec("set names utf8");
					$upit = $veza->prepare("select Ime, Prezime from korisnik where korisnikID = :korisnikID");
					$upit->bindValue(":korisnikID", $_GET["korisnikID"], PDO::PARAM_INT);
					$upit->execute();

					foreach ($upit->fetchAll() as $korisnik) {
						print "<h3 style='color:#5B5B5B;margin:5px;'>Artikli korisnika: <i>".$korisnik['Ime']." ".$korisnik['Prezime']."</i></h3>";
					}
				} else{
					header("Location: index.php"); 
					exit();
				}
			?>
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
				$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      			$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      			$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");
      			
				$veza->exec("set names utf8");
				$upit = $veza->prepare("select ArtikalID, KratakOpis, Cijena, UNIX_TIMESTAMP(DatumPostavljanja) DatumPostavljanja, KorisnikPostavioID, EkstenzijaSlike, PoDogovoru from artikal where aktivan = 1 and KorisnikPostavioID=:korisnikID");
				
				$upit->bindValue(":korisnikID", $_GET["korisnikID"], PDO::PARAM_INT);
				$upit->execute();

			    $novosti = array();
			    foreach ($upit->fetchAll() as $data) {
			       	$cijena ="";
				    if($data['PoDogovoru'] == "1")
				        $cijena ="PO DOGOVORU";
				    else
				        $cijena = number_format($data['Cijena'], 2).' KM';

				    $data['Cijena'] = $cijena;

				    array_push($novosti, $data);
			    }
			       if(count($novosti) != 0){
				    	//ispisivanje novosti
					    for ($x = count($novosti)-1; $x >= 0; $x--) {
					    	$naslov = "";
					    	if(isset($_SESSION['korisnikID'])){
					    		$noviKomentari = $veza->query("select count(*) ukupno from komentar kom join artikal ar on kom.artikalid = ar.artikalid where ar.korisnikpostavioid = ".$_SESSION['korisnikID']." and kom.pogledan=0 and ar.aktivan = 1 and ar.artikalid=".$novosti[$x]['ArtikalID']);

						    	$ukupnoZaPogledat = 0;
								  foreach ($noviKomentari as $ukupno) {
								    $ukupnoZaPogledat = $ukupno['ukupno'];
								  }
								  
								  if($ukupnoZaPogledat > 0 ){
								  	$naslov = $naslov."<p>".$novosti[$x]['KratakOpis']." <i class='komentar-notifikacije'>&nbsp;".$ukupnoZaPogledat."&nbsp;</i></p>";
								  }else{
								  	$naslov = $naslov."<p>".$novosti[$x]['KratakOpis']."</p>";
								  }
						    	}else{
						    		$naslov = $naslov."<p>".$novosti[$x]['KratakOpis']."</p>";
						    	}
					    	
						    echo "<a href='Artikal.php?id=".$novosti[$x]['ArtikalID']."'><div class='izdvojeni-artikal'>
									<div class='izdovjeni-artikal-slika'>
										<img src='Content/SlikeArtikala/".$novosti[$x]['ArtikalID'].$novosti[$x]['EkstenzijaSlike']."'>
									</div>".
									$naslov.
									"<div class='cijena'>".$novosti[$x]['Cijena']."</div>
									<span class='objavljeno-prije' data-datumObjave='".gmdate("Y-m-d\TH:i:s\Z", $novosti[$x]['DatumPostavljanja'] + 0)."'>Novost objavljena prije par sekundi</span>
								</div></a>	";
						} 
				    }

			  
			?>
		</div>
		<p>Muhamed Smajevic WT,2016</p>
	</div>
</BODY>
</HTML>