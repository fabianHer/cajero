<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

define('DB_HOST', 'mysql-3ed6f5e3-fabian-4543.e.aivencloud.com');
define('DB_USER', 'avnadmin');
define('DB_PORT', 10403);
define('DB_NAME', 'defaultdb');


function connect()
{
  $connect = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

  if (!$connect) {
    die("Failed to connect:" . mysqli_connect_error());
  }

  mysqli_set_charset($connect, "utf8");
  return $connect;
}

$con = connect();

?>