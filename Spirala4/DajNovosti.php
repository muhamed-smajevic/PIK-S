<?php

function zag() {
    header("{$_SERVER['SERVER_PROTOCOL']} 200 OK");
    header('Content-Type: text/html');
    header('Access-Control-Allow-Origin: *');
}

function rest_get($request, $data) {
  if(isset($data["x"]) && $data["autor"]){
    try { 
      $host = getenv('OPENSHIFT_MYSQL_DB_HOST');
      $port = getenv('OPENSHIFT_MYSQL_DB_PORT');
      $veza = new PDO("mysql:dbname=wt_spirala4;host=".$host.":".$port, "adminPn9Ccyf", "ikWvCFMyqqMy");

      $veza->exec("set names utf8");
      $upit = $veza->prepare("select * from(".          
                            " select  a.ArtikalID, a.KratakOpis, a.Cijena, UNIX_TIMESTAMP(a.DatumPostavljanja) DatumPostavljanja, a.KorisnikPostavioID, a.EkstenzijaSlike, a.PoDogovoru,".
                            " @rownum := @rownum + 1 AS row".
                            " from artikal a, (SELECT @rownum := 0) r where aktivan = 1 and KorisnikPostavioID= :korisnikID) d where row<=:x");
            
      $upit->bindValue(":x", $data["x"], PDO::PARAM_INT);
      $upit->bindValue(":korisnikID", $data["autor"], PDO::PARAM_INT);
      $upit->execute();

      echo json_encode(array(
          'novosti' => $upit->fetchAll()
      ));
    } 
    catch( PDOExecption $e ) { 
      print "Greska!: " . $e->getMessage() . "</br>"; 
    }
  }
}

function rest_post($request, $data) { }
function rest_delete($request) { }
function rest_put($request, $data) { }
function rest_error($request) { }

$method  = $_SERVER['REQUEST_METHOD'];
$request = $_SERVER['REQUEST_URI'];

switch($method) {
    case 'PUT':
        parse_str(file_get_contents('php://input'), $put_vars);
        zag(); $data = $put_vars; rest_put($request, $data); break;
    case 'POST':
        zag(); $data = $_POST; rest_post($request, $data); break;
    case 'GET':
        zag(); $data = $_GET; rest_get($request, $data); break;
    case 'DELETE':
        zag(); rest_delete($request); break;
    default:
        header("{$_SERVER['SERVER_PROTOCOL']} 404 Not Found");
        rest_error($request); break;
}
?>