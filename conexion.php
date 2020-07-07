<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

/*define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'banco');*/


$host = "ec2-18-214-119-135.compute-1.amazonaws.com";
$puerto = "5432";
$username ="hwhedieonvrxon";
$password ="1a6514fcf57e13f0934c4557f018ce59208552f5572b37da6965d735a3a4f7f7";
$base = "d7c8srb9b040ee";

try{
  $con = new PDO("pgsql:host=$host;port=$puerto;dbname=$base",$username,$password);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e){
  echo "no conexion".$e->$getMessage();
}
/*
function connect()
{
  $connect = mysqli_connect(DB_HOST ,DB_USER ,DB_PASS ,DB_NAME);

  if (mysqli_connect_errno($connect)) {
    die("Failed to connect:" . mysqli_connect_error());
  }

  mysqli_set_charset($connect, "utf8");

  return $connect;
}

$con = connect();*/


?>