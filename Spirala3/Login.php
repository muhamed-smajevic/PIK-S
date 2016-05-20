<?php
session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
  <META http-equiv="Content-Type" content="text/html; charset=utf-8">

  <link rel="stylesheet" type="text/css" href="style.css">
  <TITLE>PIK-S, Prijava</TITLE>

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
				<button>PRIJAVA</button>
			</div>
		</div>
	</div>
	<div>
		<div class="kontakt-wraper">
			<div class="kontakt">
				<h2 class="puna-sirina tekst-centar">Prijava u sistem</h2>
				<form action="Login.php" method="post">
					<table>
						<tr>
							<td class="kontakt-unos">
								<input name="username" type="text" class="puna-sirina tekst-centar" placeholder="Username">
							</td>
						</tr>
						<tr>
							<td>
								<input name="password" type="password" class="puna-sirina tekst-centar" placeholder="Password">
							</td>
						</tr>
						<tr id="trPrezimeVal">
							<td style="width:208px;">
								<?php
									if (isset($_REQUEST['username']) && isset($_REQUEST['password']) ) {

										$autenticiran = false;

										if (($handle = fopen("Data/korisnici.csv", "r")) !== FALSE) {
											$novosti = array();
										        
										    while (($data = fgetcsv($handle, 1000, ".")) !== FALSE) {
										        if($_REQUEST['username'] == $data[0] && sha1($_REQUEST['password']) == $data[1]){

										        	$autenticiran = true;
										        	break;
												}
										    }
										    fclose($handle); 
										}

										//provjera korisnika
										if($autenticiran){

											$_SESSION["username"] = $_REQUEST['username'];

											header("Location: index.php"); 
											exit();
										}
										else
        									print "<p id='lblPrezimeVal' class='kontakt-validacija-poruka tekst-centar'>Molimo provjerite vaš username i password.</p>";
      								}
      							?>
								
							</td>
						</tr>
						<tr>
							<td>
								<input type="submit" class="puna-sirina tekst-centar" value="Prijava"></input>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
</BODY>
</HTML>