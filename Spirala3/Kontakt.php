<?php
session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
  <META http-equiv="Content-Type" content="text/html; charset=utf-8">

  <link rel="stylesheet" type="text/css" href="style.css">
  <TITLE>PIK-S, Dobrodošli</TITLE>
  <SCRIPT src="Skripte/validacija.js"></SCRIPT>
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
				<a href="#" class="glavni-meni-stavka">Registracija</a>
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
		<div class="kontakt-wraper">
			<div class="kontakt">
				<article>
	  				<p>Molimo popunite formu za kontakt</p>
				</article>

				<table>
					<tr>
						<td>
							<label>Ime*</label>
						</td>
						<td class="kontakt-unos">
							<input id="txtIme" type="text" class="puna-sirina" placeholder="Ime">
						</td>
					</tr>
					<tr id="trImeVal" class="sakriveno">
						<td></td>
						<td style="width:208px;">
							<p id="lblImeVal" class="kontakt-validacija-poruka"></p>
						</td>
					</tr>
					<tr>
						<td>
							<label>Prezime*</label>
						</td>
						<td>
							<input id="txtPrezime" type="text" class="puna-sirina" placeholder="Prezime">
						</td>
					</tr>
					<tr id="trPrezimeVal" class="sakriveno">
						<td></td>
						<td style="width:208px;">
							<p id="lblPrezimeVal" class="kontakt-validacija-poruka"></p>
						</td>
					</tr>
					<tr>
						<td>
							<label>Email adresa**</label>
						</td>
						<td>
							<input id="txtEmail" type="email" class="puna-sirina" placeholder="name@example.com">
						</td>
					</tr>
					<tr id="trEmailVal" class="sakriveno">
						<td></td>
						<td style="width:208px;">
							<p id="lblEmailVal" class="kontakt-validacija-poruka"></p>
						</td>
					</tr>
					<tr>
						<td>
							<label>Adresa**</label>
						</td>
						<td>
							<input id="txtAdresa" type="text" class="puna-sirina" placeholder="Sydney 24">
						</td>
					</tr>
					<tr id="trAdresaVal" class="sakriveno">
						<td></td>
						<td style="width:208px;">
							<p id="lblAdresaVal" class="kontakt-validacija-poruka"></p>
						</td>
					</tr>
					<tr>
						<td>
							<label>Datum rodjenja*</label>
						</td>
						<td>
							<input id="txtDatumRodjenja" type="date" min="1979-12-31"><br>
						</td>
					</tr>
					<!-- <tr>
						<td>
							<label>Vrijeme rodjenja</label>
						</td>
						<td>
							<input id="txtVrijemeRodjenja" type="time"><br>
						</td>
					</tr> -->
					<tr>
						<td>
							<label>Najdraža boja</label>
						</td>
						<td>
							<input type="color" value="#ff0000">
						</td>
					</tr>
					<tr>
						<td>
							<label>Komentar</label>
						</td>
						<td>
							<textarea rows="4" cols="26"></textarea>
						</td>
					</tr>

					<tr>
						<td>
						</td>
						<td>
							<button id="btnPosalji">Pošalji zahtjev</button>
						</td>
					</tr>
					
				</table>

				<article>
	  				<i class="kontakt-unos-napomena">NAPOMENA: Polja sa oznakom (*) su obavezna, dok za polja označena sa (**) potrebno je unjeti barem jedno polje.</i>
				</article>
			</div>
		</div>
	</div>
</BODY>
</HTML>