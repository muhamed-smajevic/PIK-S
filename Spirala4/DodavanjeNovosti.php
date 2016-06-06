<?php
	session_start();
	date_default_timezone_set('UTC');
	//ako nije logiran korisnik
	if (!isset($_SESSION["username"]) ) {
		header("Location: index.php"); 
		exit();
	}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
  <META http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <TITLE>PIK-S, Dobrodošli</TITLE>
  <SCRIPT src="Skripte/validacijaDodavanjeNovosti.js"></SCRIPT>
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
		<div class="kontakt-wraper">
			<div class="kontakt">
				<article>
	  				<p>Molimo unesite podatke za novost</p>
				</article>

				<form name="dodavanjeNovostiForm" action"dodavanjenovosti.php" method="post" onsubmit="return validirajFormu()" enctype="multipart/form-data">
					<table>
						<tr>
							<td>
								<label>Kratak opis*</label>
							</td>
							<td class="kontakt-unos">
								<input type="text" name="kratakOpis" id="kratakOpis" class="puna-sirina" placeholder="Golf 5 V plus">
							</td>
						</tr>
						<tr id="trKratakOpisVal" class="sakriveno">
							<td></td>
							<td style="width:208px;">
								<p id="lblKratakOpis" class="kontakt-validacija-poruka"></p>
							</td>
						</tr>

						<tr>
							<td>
								<label>Cijena*</label>
							</td>
							<td>
								<input type="number" name="cijena" id="cijena" min="0" value="0" style="width:80px"> KM
								 
								 <input type="checkbox" name="poDogovoru" id="poDogovoru" min="0" placeholder="Prezime">
								 po dogovoru
							</td>
						</tr>

						<tr>
							<td>
								<label>Kod države*</label>
							</td>
							<td class="kontakt-unos">
								<select id="kodDrzave">
									  <option value="ba">ba</option>
									  <option value="us">us</option>
								</select>
							</td>
						</tr>

						<tr>
							<td>
								<label>Telefon*</label>
							</td>
							<td class="kontakt-unos">
								<input name="telefonPozivni" id="telefonPozivni" type="text" class="pozivni-telefon" placeholder="+387">
								<input name="telefonOstatak" id="telefonOstatak" type="text" >
							</td>
						</tr>


						<tr id="trTelefonPozivniVal" class="sakriveno">
							<td></td>
							<td style="width:208px;">
								<p id="lblTelefonPozivni" class="kontakt-validacija-poruka"></p>
							</td>
						</tr>


						<tr>
							<td>
								<label>Slika*</label>
							</td>
							<td>
	    						<input type="file" name="slika" id="slika" defaultValue="Odaberi fajl">
							</td>
						</tr>
						<tr id="trSlika" class="sakriveno">
							<td></td>
							<td style="width:208px;">
								<p id="lblSlika" class="kontakt-validacija-poruka"></p>
							</td>
						</tr>
						
						<tr>
							<td>
								<label>Komentari</label>
							</td>
							<td>
								 <input type="checkbox" name="komentari" id="komentari">
							</td>
						</tr>


						<tr>
							<td>
							</td>
							<td>
								<button id="btnPosalji">Dodaj novost</button>
							</td>
						</tr>
						
						<tr>
							<td></td>
							<td>
								<?php 
									$file_ext="";

									//ako je nesto postano
									if (!empty($_POST) ) {
										//print("NACI POSTANO");	
										if(!isset($_REQUEST["poDogovoru"]))
											$poDogovoru = 0;
										else
											$poDogovoru =1;

										if(!isset($_REQUEST["komentari"]))
											$komentari = 0;
										else
											$komentari =1;

										//ima se ovdje jos svasta provjeriti al zasad je dosta
										$xss = str_replace("<","&lt;",$_REQUEST["kratakOpis"]);
										$xss = str_replace(">","&gt;",$xss);

										/*file_put_contents("Data/novosti.csv", $t.".".
											$file_ext.".".
											$xss.".".
											$_REQUEST["cijena"].".".
											$poDogovoru.PHP_EOL, FILE_APPEND | LOCK_EX);
*/										
										try { 
										    $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      										$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      										$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");

											$veza->exec("set names utf8");

										    try {
										        if(isset($_FILES['slika'])){
													$file_name = $_FILES['slika']['name'];
											      	$explode = explode('.',$file_name);
											      	$end = end($explode);
											      	$file_ext=strtolower($end);

											      	$upit = $veza->prepare("INSERT INTO artikal (KratakOpis, Cijena, DatumPostavljanja, KorisnikPostavioID, PoDogovoru, EkstenzijaSlike, OtvorenZaKomentare, Aktivan)".
													" VALUES (:kratakOpis, :cijena, :datumPostavljanja, :korisnikPostavioID, :poDogovoru, :ekstenzijaSlike, :otvorenZaKomentare, b'1')");


			    									$upit->bindValue(":kratakOpis", $xss, PDO::PARAM_STR);
			    									$upit->bindValue(":cijena", $_REQUEST["cijena"], PDO::PARAM_INT);
			    									$upit->bindValue(":datumPostavljanja", date("Y-m-d H:i:s"), PDO::PARAM_INT);
			    									$upit->bindValue(":korisnikPostavioID", $_SESSION['korisnikID'], PDO::PARAM_INT);
			    									$upit->bindValue(":poDogovoru", $poDogovoru, PDO::PARAM_INT);
			    									$upit->bindValue(":ekstenzijaSlike", ".".$file_ext, PDO::PARAM_STR);
			    									$upit->bindValue(":otvorenZaKomentare", $komentari, PDO::PARAM_INT);

			    									$upit->execute();

													move_uploaded_file($_FILES['slika']['tmp_name'], 'Content/SlikeArtikala/'.$veza->lastInsertId().".".$file_ext);
													print("<p class='uspjesno-spaseno'>Uspješno spašeno.</p>");
												}

										    } catch(PDOExecption $e) { 
										        $dbh->rollback(); 
										        print "Greska!: " . $e->getMessage() . "</br>"; 
										    } 
										} catch( PDOExecption $e ) { 
										    print "Greska!: " . $e->getMessage() . "</br>"; 
										} 
									}	
								?>
							</td>
						</tr>
					</table>
				</form>
				

				<article>
	  				<i class="kontakt-unos-napomena">NAPOMENA: Polja sa oznakom (*) su obavezna.</i>
				</article>
			</div>
		</div>
	</div>
</BODY>
</HTML>