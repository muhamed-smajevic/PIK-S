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
  <?php
		if (isset($_SESSION["username"]) ) {
			print "<SCRIPT src='Skripte/notifikacije.js'></SCRIPT>";
		}
	?>
</HEAD>
<BODY>
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
				       		print "<p><a id='brojKomentara' class='komentar-notifikacije sakriveno' href='Korisnik.php?korisnikID=".$_SESSION["korisnikID"]."'>&nbsp;0&nbsp;</a> Dobrodošao/la <i><a style='color:#D7E2E7' href='IzmjenaLozinke.php'>".$_SESSION["username"]."</a></i></p>";
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
		<?php 

			//onemogucavanje komentara
			if(isset($_POST["onemogucavanjeKomenaraArtiklaId"]) && isset($_SESSION["korisnikTipID"])){
				if($_SESSION["korisnikTipID"] == 1){
					$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      				$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      				$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");

					$veza->exec("set names utf8");
					$upit = $veza->prepare("update artikal set OtvorenZaKomentare = 0 where artikalid=:artikalid");

					$upit->bindValue(":artikalid", $_POST["onemogucavanjeKomenaraArtiklaId"], PDO::PARAM_INT);
					$upit->execute();
					print("<p class='uspjesno-spaseno'>Uspješno spapšeno.</p>");
				}
			}

			//onemogucavanje komentara
			if(isset($_POST["omogucavanjeKomenaraArtiklaId"]) && isset($_SESSION["korisnikTipID"])){
				if($_SESSION["korisnikTipID"] == 1){
					$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      				$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      				$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");

					$veza->exec("set names utf8");
					$upit = $veza->prepare("update artikal set OtvorenZaKomentare = 1 where artikalid=:artikalid");

					$upit->bindValue(":artikalid", $_POST["omogucavanjeKomenaraArtiklaId"], PDO::PARAM_INT);
					$upit->execute();
					print("<p class='uspjesno-spaseno'>Uspješno spapšeno.</p>");
				}
			}

			//brisanje artikla
			if(isset($_POST["brisanjeArtiklaId"]) && isset($_SESSION["korisnikTipID"])){
				if($_SESSION["korisnikTipID"] == 1){
					$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      				$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      				$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");

					$veza->exec("set names utf8");
					$upit = $veza->prepare("update artikal set aktivan = 0 where artikalid=:artikalid");

					$upit->bindValue(":artikalid", $_POST["brisanjeArtiklaId"], PDO::PARAM_INT);
					$upit->execute();
					print("<p class='uspjesno-spaseno'>Uspješno obrisan artikal.</p>");
				}
			}

			//brisanje komentara
			if(isset($_POST["brisanjeKomentaraId"]) && isset($_SESSION["korisnikTipID"])){
				if($_SESSION["korisnikTipID"] == 1){
					$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      				$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      				$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");

					$veza->exec("set names utf8");
					$upit = $veza->prepare("update komentar set aktivan = 0 where komentarid=:komentarid");

					$upit->bindValue(":komentarid", $_POST["brisanjeKomentaraId"], PDO::PARAM_INT);
					$upit->execute();
					print("<p class='uspjesno-spaseno'>Uspješno obrisan komentar.</p>");
				}
			}
		?>
		<div class="artikal-detaljno">
			<?php
				
				//dodavnaje komentara
				if(isset($_POST["odgovor"]) && isset($_POST["KomentarID"])){
					
					$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      				$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      				$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");	

						$veza->exec("set names utf8");
						$upit = $veza->prepare("INSERT INTO odgovor (KomentarID, DatumPostavljanja, Odgovor, Aktivan)".
										" VALUES ( :komentarID, :datumPostavljanja, :odgovor, b'1')");

						$upit->bindValue(":komentarID", $_POST["KomentarID"], PDO::PARAM_INT);
						$upit->bindValue(":datumPostavljanja", date("Y-m-d H:i:s"), PDO::PARAM_INT);
						$upit->bindValue(":odgovor", $_POST["odgovor"], PDO::PARAM_INT);

						$upit->execute();
				}

			//dodavnaje komentara
				if(isset($_POST["komentar"])){
					$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      				$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      				$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");

						$veza->exec("set names utf8");
						$upit = $veza->prepare("INSERT INTO komentar (KorisnikPostavioID, Komentar, DatumPostavljanja, ArtikalID, KomentarOdgovorID, Aktivan)".
										" VALUES ( :KorisnikPostavioID, :komentar, :datumPostavljanja, :artikalId, NULL, b'1')");
						if(isset($_SESSION["korisnikID"])){
							$upit->bindValue(":KorisnikPostavioID", $_SESSION["korisnikID"], PDO::PARAM_INT);
						}
						else{
							$upit->bindValue(":KorisnikPostavioID", 2, PDO::PARAM_INT);
						}
						
						$upit->bindValue(":komentar", $_POST["komentar"], PDO::PARAM_STR);
						$upit->bindValue(":datumPostavljanja", date("Y-m-d H:i:s"), PDO::PARAM_INT);
						$upit->bindValue(":artikalId", $_GET["id"], PDO::PARAM_INT);

						$upit->execute();
				}

				//ucitavanje artikla
				if(isset($_GET["id"])){
					try {
						$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      					$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      					$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");

						$veza->exec("set names utf8");

						$KorisnikPostavioID=-1;

						$upikKorsnik = $veza->prepare("select KorisnikPostavioID".
											" from artikal where artikalid=:artikalid and aktivan=1");
						$upikKorsnik->bindValue(":artikalid", $_GET["id"], PDO::PARAM_INT);
						$upikKorsnik->execute();
							foreach ($upikKorsnik->fetchAll() as $korId){
								$KorisnikPostavioID = $korId['KorisnikPostavioID'];
						}

						//svi komentari pogledani na datom artiklu
						if(isset($_SESSION["korisnikID"])){
							if($_SESSION["korisnikID"] == $KorisnikPostavioID){
								$upitPogledaniKomentari = $veza->prepare("update komentar set pogledan = 1 where artikalid=:artikalid");
							$upitPogledaniKomentari->bindValue(":artikalid", $_GET["id"], PDO::PARAM_INT);

							$upitPogledaniKomentari->execute();
							}
						}
						

						$upit = $veza->prepare("select ar.ArtikalID,".
											" ar.KratakOpis,".
											" ar.Cijena,".
											" UNIX_TIMESTAMP(ar.DatumPostavljanja) DatumPostavljanja,".
											" ar.KorisnikPostavioID,".
											" ar.EkstenzijaSlike,".
											" ar.OtvorenZaKomentare,".
											" ar.PoDogovoru, ".
											" CONCAT(kor.Ime, ' ',kor.Prezime) korisnik ".
											" from artikal ar".
											" join korisnik kor on ar.KorisnikPostavioID = kor.korisnikID".
											" where ar.artikalid=:artikalid and ar.aktivan=1");
						$upit->bindValue(":artikalid", $_GET["id"], PDO::PARAM_INT);

						$upit->execute();

						$upitKomentari = $veza->prepare("select kom.KomentarID,".
											" kom.KorisnikPostavioID,".
											" kom.Komentar,".
											" UNIX_TIMESTAMP(kom.DatumPostavljanja) DatumPostavljanja,".
											" kom.ArtikalID,".
											" kom.KomentarOdgovorID,".
											" CONCAT(kor.Ime, ' ',kor.Prezime) korisnik ".
											" from komentar kom".
											" join korisnik kor on kom.KorisnikPostavioID = kor.korisnikID".
											" where kom.artikalid=:artikalid and kom.aktivan=1");
						$upitKomentari->bindValue(":artikalid", $_GET["id"], PDO::PARAM_INT);

						$upitKomentari->execute();
						$komentariHtml ="</br><i style='font-size:18px;'>Komentari</i>";

						foreach ($upitKomentari->fetchAll() as $komentar){


							$brisanjeKomentaraHtml = "";
						    if(isset($_SESSION["korisnikTipID"])){
								if($_SESSION["korisnikTipID"] == 1){
									$brisanjeKomentaraHtml = $brisanjeKomentaraHtml.
											"<form action'Artikal.php?id=".$_GET["id"]."' method='post'>".
												"<div class='puna-sirina'>".
													"<input type='text' name='brisanjeKomentaraId' value='".$komentar['KomentarID']."' hidden>".
													"<input type='submit' value='Obriši komentar'>".
												"</div>".
											"</form>";
								}
							}

							$komentariHtml =$komentariHtml.
								  "<div class='komentar'>".
								    $brisanjeKomentaraHtml.
									"<b style='font-size:14px;'>".$komentar['korisnik'].":</b><span style=''text-decoration:none> ".$komentar['Komentar']."</span>".
									"<i style='float:right;font-size:14px;'>".date("d.m.Y. (h:i)", $komentar['DatumPostavljanja'])."</i>";

							$odgovor = $veza->query("SELECT OdgovorId, KomentarID, UNIX_TIMESTAMP(DatumPostavljanja) DatumPostavljanja, Odgovor, Aktivan FROM odgovor where KomentarId=".$komentar['KomentarID']);

							$odgovorenKomentar = false;
							foreach ($odgovor as $odg) {
								$komentariHtml =$komentariHtml.
									"</br></br>".
									"<b style='font-size:14px; margin-left:20px'> ODGOVOR:</b><span style=''text-decoration:none> ".$odg['Odgovor']."</span>".
									"<i style='float:right;font-size:14px;'>".date("d.m.Y. (h:i)", $odg['DatumPostavljanja'])."</i>";
								$odgovorenKomentar = true;
							}
							if(!$odgovorenKomentar){
								if(isset($_SESSION["korisnikID"])) {

									if($_SESSION["korisnikID"] == $KorisnikPostavioID){
										

										$komentariHtml =$komentariHtml.
											"</br>".
											"</br>".
											"<form action'Artikal.php?id=".$_GET["id"]."' method='post' style='height:40px;'>".
												"<div style='float:left; width:20%'>".
													"<i>Odgovor na komentar</i>".
												"</div>".
												"<div style='float:right; width:80%'>".
													"<textarea class='puna-sirina' name='odgovor'></textarea>".
													"<input type='submit' style='float:right' value='Odgovori'>".
													"<input type='text' hidden name='KomentarID' value='".$komentar['KomentarID']."'>".
												"</div>".
											"</form>";	
									}
								}
							}
							
							$komentariHtml =$komentariHtml."</div>";
						}

						$komentariHtml =$komentariHtml.
							"</br>".
							"<form action'Artikal.php?id=".$_GET["id"]."' method='post'>".
								"<div style='float:left; width:20%'>".
									"Dodavanje komentara".
								"</div>".
								"<div style='float:right; width:80%'>".
									"<textarea class='puna-sirina' name='komentar'></textarea>".
									"<input type='submit' style='float:right' value='Dodaj komentar'>".
								"</div>".
							"</form>";


				       	foreach ($upit->fetchAll() as $artikal) {

				       		$cijena ="";
						    if($artikal['PoDogovoru'] == "1")
						        $cijena ="PO DOGOVORU";
						    else
						        $cijena = number_format($artikal['Cijena'], 2).' KM';

						    if($artikal['OtvorenZaKomentare'] ==0){
						    	$komentariHtml = "";
						    }

						    $brisanjeArtiklaHtml = "";
						    if(isset($_SESSION["korisnikTipID"])){
								if($_SESSION["korisnikTipID"] == 1){
									$brisanjeArtiklaHtml = $brisanjeArtiklaHtml.
											"<form action'Artikal.php?id=".$_GET["id"]."' method='post'>".
												"<div class='puna-sirina'>".
													"<input type='text' name='brisanjeArtiklaId' value='".$artikal['ArtikalID']."' hidden>".
													"<input type='submit' value='Obriši artikal'>".
												"</div>".
											"</form>";
								}
							}

							$omogucavanjeKomentara = "";
						    if(isset($_SESSION["korisnikTipID"])){
								if($_SESSION["korisnikTipID"] == 1){
									$omogucavanjeKomentara = $omogucavanjeKomentara.
											"<form action'Artikal.php?id=".$_GET["id"]."' method='post'>".
												"<div class='puna-sirina'>".
													"<input type='text' name='omogucavanjeKomenaraArtiklaId' value='".$artikal['ArtikalID']."' hidden>".
													"<input type='submit' value='Aktiviraj komentare'>".
												"</div>".
											"</form>";
								}
							}
							$onemogucavanjeKomentara = "";
						    if(isset($_SESSION["korisnikTipID"])){
								if($_SESSION["korisnikTipID"] == 1){
									$onemogucavanjeKomentara = $onemogucavanjeKomentara.
											"<form action'Artikal.php?id=".$_GET["id"]."' method='post'>".
												"<div class='puna-sirina'>".
													"<input type='text' name='onemogucavanjeKomenaraArtiklaId' value='".$artikal['ArtikalID']."' hidden>".
													"<input type='submit' value='Deaktiviraj komentare'>".
												"</div>".
											"</form>";
								}
							}

				       		print "<div class='puna-sirina'>".
				       					"<div style='width:70%;float:left;'>".
				       						$brisanjeArtiklaHtml.
				       						$omogucavanjeKomentara.
				       						$onemogucavanjeKomentara.
				       						"<h3 style='text-decoration:none'>Naziv artikla: <b>".$artikal['KratakOpis']."</b><small style='float:right; font-size:12px; margin-right:10px;'>".date("d.m.Y. (h:i)", $artikal['DatumPostavljanja'])."</small></h3>".
				       						"<p>Cijena artikla: ".$cijena."</p>".
				       						"<b style='float:right; font-size:14px'>Postavio korisnik: <a href='Korisnik.php?korisnikID=".$artikal['KorisnikPostavioID']."'>".$artikal['korisnik']." test</a></b>".
											$komentariHtml.				       						
				       			    	"</div>".
				       			 		"<div style='width:30%; float:left' >".
				       			 			"<img style='width:400px' src='Content/SlikeArtikala/".$artikal['ArtikalID'].$artikal['EkstenzijaSlike']."'>".
				       			 		"</div>".
				       			 	"</div>";
				  		}
					} 
					catch( PDOExecption $e ) { 
						print "Greska!: " . $e->getMessage() . "</br>";
					} 
				}
				else{
					header("Location: index.php"); 
					exit();
				}
				
			?>
		</div>
		<p>Muhamed Smajevic WT,2016</p>
	</div>
</BODY>
</HTML>