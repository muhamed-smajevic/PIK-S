<?php
	session_start();
	if (isset($_SESSION["korisnikTipID"]) ) {
		if($_SESSION["korisnikTipID"] != 1){
			header("Location: index.php"); 
			exit();
		}
	}
	else{
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
		<div class='komentar'>
			<b>Dodavanje novog korisnika</b>
			<form action='Korisnici.php' method='post'>
				<input type="text" name='ime' placeholder="Ime.." required>
				<input type="text" name='prezime' placeholder="Prezime.." required>
				<input type="text" name='username' placeholder="Username.." required>
				<input type="password" id="password" name='password' placeholder="Password.." required>
				<input type="submit" value="Dodaj korisnika">
			</form>
		</div>
		

		<?php

			//izmjena korisnika
			if(isset($_SESSION['korisnikTipID']) && isset($_GET['korisnikIzmjenaId']) ) {
				$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      			$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      			$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");
			    
			    $veza->exec("set names utf8");
			       
			    $upit = $veza->prepare("select korisnikID, username,ime,prezime from korisnik where korisnikid=:korisnikID and aktivan = 1");
			    $upit->bindValue(":korisnikID", $_GET['korisnikIzmjenaId'], PDO::PARAM_INT);

			    $upit->execute();

			    foreach ($upit->fetchAll() as $korisnik) {
			    	print "<div class='komentar'>". 
				    		"<b>Izmjena korisnika <i>".$korisnik['username']."</i> - ako je polje lozinka prazno lozinka ostaje ista</b>".
							"<form action='Korisnici.php' method='post'>".
								"<input type='text' name='korisnikID' value='".$korisnik['korisnikID']."' hidden required>".
								"<input type='text' name='ime_izmjena' value='".$korisnik['ime']."' placeholder='Ime..' required>".
								"<input type='text' name='prezime_izmjena' value='".$korisnik['prezime']."' placeholder='Prezime..' required>".
								"<input type='password' name='password_izmjena' placeholder='Nova lozinka..'>".
								"<input type='submit' value='Spasi promjene'>".
							"</form>".
						"</div>";	
			  	}
			}

			//izmjena korisnika
			if(isset($_SESSION['korisnikTipID']) && isset($_POST['korisnikID']) && isset($_POST['ime_izmjena']) && isset($_POST['prezime_izmjena']) ) {
				$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      			$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      			$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");

			    $veza->exec("set names utf8");
			       
			    $upit = $veza->prepare("update korisnik set ime=:ime, prezime=:prezime where korisnikID=:korisnikID");
			    $upit->bindValue(":korisnikID", $_POST['korisnikID'], PDO::PARAM_INT);
			    $upit->bindValue(":ime", $_POST['ime_izmjena'], PDO::PARAM_INT);
			    $upit->bindValue(":prezime", $_POST['prezime_izmjena'], PDO::PARAM_INT);

			    $upit->execute();

			    if(isset($_POST['password_izmjena'])){
			    	if($_POST['password_izmjena'] != ""){
			    		$upit = $veza->prepare("update korisnik set password=:password where korisnikID=:korisnikID");
				    	$upit->bindValue(":korisnikID", $_POST['korisnikID'], PDO::PARAM_INT);
				    	$upit->bindValue(":password", $_POST['password_izmjena'], PDO::PARAM_INT);

				    	$upit->execute();
			    	}
			    }
			    print("<p class='uspjesno-spaseno'>Uspješno promjenjeno.</p>");
			}

			//dodavanje korisnika
			if(isset($_SESSION['korisnikTipID']) && isset($_POST['ime']) && isset($_POST['prezime']) && isset($_POST['username']) && isset($_POST['password']) ){
			  	if($_SESSION['korisnikTipID'] == 1){

			  		$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      				$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      				$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");
			      	
			      	$veza->exec("set names utf8");
			       
			      	$upit = $veza->prepare("select korisnikID from korisnik where username=:username and aktivan = 1");
			      	$upit->bindValue(":username", $_POST["username"], PDO::PARAM_STR);

			      	$upit->execute();

			      	$korisnikProndjen = false;
			      	foreach ($upit->fetchAll() as $korisnik) {
			    		$korisnikProndjen = true;
			  		}
			        
			        if(!$korisnikProndjen){
			        	$upit = $veza->prepare("INSERT INTO korisnik (Ime, Prezime, Username, Password, KorisnikTipID, Aktivan)".
			      			" VALUES (:ime, :prezime, :username, :password, 2, b'1')");

			      		$upit->bindValue(":ime", $_POST["ime"], PDO::PARAM_STR);
			      		$upit->bindValue(":prezime", $_POST["prezime"], PDO::PARAM_STR);
			      		$upit->bindValue(":username", $_POST["username"], PDO::PARAM_STR);
			      		$upit->bindValue(":password", $_POST["password"], PDO::PARAM_STR);

			      		$upit->execute();
			      		echo "Korisnik uspješno unesen."; 
			        }
			        else{
			        	echo "Korisnik postoji sa unesenim username-om, molimo izaberite drugi username.";
			        }   	
			  }
			} 
		?>
		<table class="tabela">
			<tr class="tabela-header">
				<th>Ime</th>
				<th>Prezime</th>
				<th>Username</th>
				<th></th>
				<th></th>
			</tr>
			<?php

			  	$host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      			$port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      			$veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");
      			
				$veza->exec("set names utf8");
				$rezultat = $veza->query("select korisnikID, ime, prezime, username from korisnik where aktivan = 1");


				if (!$rezultat) {
				    $greska = $veza->errorInfo();
				    exit();
				}
				  
				foreach ($rezultat as $korisnik) {
				    print "<tr>".
				    		"<td>".$korisnik['ime']."</td>".
				    		"<td>".$korisnik['prezime']."</td>".
				    		"<td>".$korisnik['username']."</td>".
				    		"<td><a href='Korisnici.php?korisnikIzmjenaId=".$korisnik['korisnikID']."'>Izmjena</a></td>".
				    		"<td><a href='BrisanjeKorisnika.php?id=".$korisnik['korisnikID']."'>Obriši</a></td>".
				    	"</tr>";
				} 
			?>
		</table>
	</div>
</BODY>
</HTML>