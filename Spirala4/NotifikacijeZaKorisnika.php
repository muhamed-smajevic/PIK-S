<?php
session_start();

if(isset($_SESSION['korisnikID'])){
  $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
  $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
  $veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");
  
  $veza->exec("set names utf8");
  $rezultat = $veza->query("select count(*) ukupno from komentar kom join artikal ar on kom.artikalid = ar.artikalid where ar.korisnikpostavioid = ".$_SESSION['korisnikID']." and kom.pogledan=0 and ar.aktivan = 1");


  if (!$rezultat) {
      $greska = $veza->errorInfo();
      exit();
  }
  
  $ukupnoZaPogledat = 0;
  foreach ($rezultat as $ukupno) {
    $ukupnoZaPogledat = $ukupno['ukupno'];
  }
  echo json_encode(array(
      'ukupno' => $ukupnoZaPogledat
  ));
}else{
  echo json_encode(array(
      'ukupno' => 0
  ));
}
?>