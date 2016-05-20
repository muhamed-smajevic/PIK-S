<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
  <META http-equiv="Content-Type" content="text/html; charset=utf-8">

  <link rel="stylesheet" type="text/css" href="style.css">
  <TITLE>PIK-S, Dobrodošli</TITLE>
</HEAD>
<BODY>
	<div class="gornji-meni">
		<div class="sadrzaj-kontejner">
			<ul class="lista-gornji-meni">
			<li class="glavni-meni-stavka-li">
				<a href="Index.php" class="glavni-meni-stavka">Početna</a>
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
		<table class="tabela">
			<tr class="tabela-header">
				<th>Ime</th>
				<th>Prezime</th>
				<th>Datum rodjenja</th>
				<th>Najdraža boja</th>
				<th>Komentar</th>
			</tr>
			<tr>
				<td>Muhamed</td>
				<td>Smajevic</td>
				<td>24.05.1994</td>
				<td>Neka</td>
				<td>Danas nam je divan dan, divan dan.</td>
			</tr>
			<tr class="parni-red">
				<td>Arslan</td>
				<td>Smajevic</td>
				<td>21.06.2002</td>
				<td>Crvena</td>
				<td>Samo igram igrica.</td>
			</tr>
			<tr>
				<td>Solomon</td>
				<td>Bicakcic</td>
				<td>10.01.1985</td>
				<td>Žuta</td>
				<td>Prvo tvrdo drugo meko.</td>
			</tr>
		</table>
	</div>
</BODY>
</HTML>