<?php
require 'conexion.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
/*$monto    = mysqli_real_escape_string($con,$request->monto);
$idCuenta = mysqli_real_escape_string($con,$request->idCuenta);
$idCuentaDonacion = mysqli_real_escape_string($con,$request->cuentaDonacion);*/

$monto = $request->{'monto'};
$idcuenta = $request->{'idcuenta'};
$idcuentadonacion = $request->{'cuentadonacion'};


$sql="UPDATE cuentas set monto = monto + {$monto} WHERE idcuenta ='{$idcuenta}'";
  $stmt = $con->prepare($sql);
  $stmt->execute();
  $nunRows = $stmt->rowCount();
//$resultado = mysqli_query($con,$sql);
if($nunRows > 0){
    $sql1="UPDATE cuentas set monto = monto - {$monto} WHERE idcuenta ='{$idcuentadonacion}'";
    $stmt = $con->prepare($sql1);
    $stmt->execute();
    $nunRows1 = $stmt->rowCount();
    if($nunRows1 > 0){
    echo json_encode("HECHO");
    }
  } 
else
{
    echo json_encode("ERROR");
}
?>