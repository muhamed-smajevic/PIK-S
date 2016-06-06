<?php
session_start();

if(isset($_SESSION['korisnikTipID']) && isset($_GET['id'])){
  if($_SESSION['korisnikTipID'] == 1){
      $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      $veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");

      $veza->exec("set names utf8");
       
      $upit = $veza->prepare("update korisnik set aktivan = 0 where korisnikid=:id");
      $upit->bindValue(":id", $_GET["id"], PDO::PARAM_INT);

      $upit->execute();
      header("Location: Korisnici.php"); 
      exit();
  }
}
?>