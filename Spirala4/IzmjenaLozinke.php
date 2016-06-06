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
			<div class="kontakt" style='width:390px;'>

				<form name="izmjenaLozinke" action"IzmjenaLozinke.php" method="post">
					<table>
						<tr>
							<td>
								<label>Stara lozinka</label>
							</td>
							<td class="kontakt-unos">
								<input type="password" name="staraLozinka" class="puna-sirina" required>
							</td>
						</tr>

						<tr>
							<td>
								<label>Nova lozinka</label>
							</td>
							<td class="kontakt-unos">
								<input type="password" name="novaLozinka" class="puna-sirina" required>
							</td>
						</tr>

						<tr>
							<td>
								<label>Ponovljena lozinka</label>
							</td>
							<td class="kontakt-unos">
								<input type="password" name="ponovljenaLozinka" class="puna-sirina" required>
							</td>
						</tr>
						<tr>
							<td></td>
							<td >
								<input type="submit" value='Promijeni lozinku'>
							</td>
						</tr>
						
						<tr>
							<td></td>
							<td>
								<?php 
									if (!empty($_POST) ) {

										if(isset($_REQUEST["staraLozinka"]) && isset($_REQUEST["novaLozinka"]) && isset($_REQUEST["ponovljenaLozinka"])){
											

											try { 
											    $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      											$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      											$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");
												
												$veza->exec("set names utf8");

												$staraLozinkaOK = false;
												try {
													$upitKorisnik = $veza->prepare("select korisnikID from korisnik where username=:username and password =:password and aktivan = 1");

				    								$upitKorisnik->bindValue(":username", $_SESSION['username'], PDO::PARAM_STR);
				    								$upitKorisnik->bindValue(":password", $_REQUEST["staraLozinka"], PDO::PARAM_STR);
				    								$upitKorisnik->execute();
				    								foreach ($upitKorisnik->fetchAll() as $kor) {
				    									$staraLozinkaOK = true;
				    								}
				    								if(!$staraLozinkaOK){
				    									print("<p class='kontakt-validacija-poruka'>Niste unijeli ispravno staru lozinku.</p>");
				    								}
											    } catch(PDOExecption $e) { 
											        print "Greska!: " . $e->getMessage() . "</br>"; 
											    } 

											    $lozinkeSePoklapaju = false;
											    if($_REQUEST["novaLozinka"] == $_REQUEST["ponovljenaLozinka"]){
				    								$lozinkeSePoklapaju = true; 
											    }
											    if(!$lozinkeSePoklapaju){
											    	print("<p class='kontakt-validacija-poruka'>Nova lozinka i ponovljena se ne poklapaju.</p>");
											    }

											    if($staraLozinkaOK && $lozinkeSePoklapaju){
											    	try {
														$upit = $veza->prepare("update korisnik set password =:password where korisnikID=:korisnikID");


					    									$upit->bindValue(":password", $_REQUEST["novaLozinka"], PDO::PARAM_STR);
															$upit->bindValue(":korisnikID", $_SESSION["korisnikID"], PDO::PARAM_INT);				    									
					    									$upit->execute();

					    									print("<p class='uspjesno-spaseno'>Uspješno ste promijenili lozinku.</p>");

												    } catch(PDOExecption $e) { 
												        print "Greska!: " . $e->getMessage() . "</br>"; 
												    } 
											    }
											} catch( PDOExecption $e ) { 
											    print "Greska!: " . $e->getMessage() . "</br>"; 
											} 
										}

										
									}	
								?>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</BODY>
</HTML>