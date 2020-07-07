<?php
require 'conexion.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
/*$monto    = mysqli_real_escape_string($con,$request->monto);
$idCuenta = mysqli_real_escape_string($con,$request->idCuenta);*/

$monto = $request->{'monto'};
$idcuenta = $request->{'idcuenta'};

$sql="UPDATE cuentas set monto = monto - {$monto} WHERE idcuenta ='{$idcuenta}' AND monto > 30";
  $stmt = $con->prepare($sql);
  $stmt->execute();
  $nunRows = $stmt->rowCount();
//$resultado = mysqli_query($con,$sql);
//$nunRows= mysqli_num_rows($resultado);
if($nunRows > 0){
    echo json_encode("HECHO");
  } 
else
{
    echo json_encode("ERROR");
}