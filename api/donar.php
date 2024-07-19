<?php
require 'conexion.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$monto    = mysqli_real_escape_string($con,$request->monto);
$idCuenta = mysqli_real_escape_string($con,$request->idCuenta);
$idCuentaDonacion = mysqli_real_escape_string($con,$request->idCuentaDonacion);

$sql="UPDATE cuentas set monto = monto + {$monto} WHERE idCuenta ='{$idCuenta}'";
$resultado = mysqli_query($con,$sql);
if(mysqli_affected_rows($con) > 0){
    $sql1="UPDATE cuentas set monto = monto - {$monto} WHERE idCuenta ='{$idCuentaDonacion}'";
    $resultado = mysqli_query($con,$sql1);
    echo json_encode("HECHO");
  } 
else
{
    echo json_encode("ERROR");
}
?>