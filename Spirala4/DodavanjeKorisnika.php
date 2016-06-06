<?php
session_start();

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
      			" VALUES (:ime, :prezime, :username, :password, 1, b'1')");

      		$upit->bindValue(":ime", $_POST["ime"], PDO::PARAM_STR);
      		$upit->bindValue(":prezime", $_POST["prezime"], PDO::PARAM_STR);
      		$upit->bindValue(":username", $_POST["username"], PDO::PARAM_STR);
      		$upit->bindValue(":password", $_POST["password"], PDO::PARAM_STR);

      		$upit->execute();
      		header("Location: Korisnici.php"); 
      		exit();
        }
        else{
        	echo "Korisnik postoji sa unesenim username-om, molimo izaberite drugi username.";
        }   	
  }
}
?>