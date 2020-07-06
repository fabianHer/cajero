<?php
require 'conexion.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$monto    = mysqli_real_escape_string($con,$request->monto);
$idCuenta = mysqli_real_escape_string($con,$request->idCuenta);

$sql="UPDATE cuentas set monto = monto - {$monto} WHERE idCuenta ='{$idCuenta}' AND monto > 30";
$resultado = mysqli_query($con,$sql);
//$nunRows= mysqli_num_rows($resultado);
if(mysqli_affected_rows($con) > 0){
    echo json_encode("HECHO");
  } 
else
{
    echo json_encode("ERROR");
}