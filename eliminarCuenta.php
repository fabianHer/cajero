<?php
require 'conexion.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$idCuenta = $request->{'idcuenta'};


$sql="DELETE FROM cuentas WHERE idcuenta ='{$idCuenta}'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $nunRows = $stmt->rowCount();
if($nunRows> 0){      
    echo json_encode("HECHO");
  } 
else
{
    echo json_encode("ERROR");
}
?>