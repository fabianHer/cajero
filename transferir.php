<?php
require 'conexion.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

/*$monto    = mysqli_real_escape_string($con,$request->monto);
$idCuentaTransferir = mysqli_real_escape_string($con,$request->idCuentaTransferir);
$cuentaDonacion = mysqli_real_escape_string($con,$request->cuentaDonacion);
$idBanco = mysqli_real_escape_string($con,$request->idBanco);*/

$monto = $request->{'monto'};
$idcuentatransferir = $request->{'idcuentatransferir'};
$cuentadonacion = $request->{'cuentadonacion'};
$idbanco = $request->{'idbanco'};

$sql="UPDATE cuentas set monto = monto + {$monto} WHERE idcuenta ='{$idcuentatransferir}'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $nunRows = $stmt->rowCount();

$sql="UPDATE cuentas set monto = monto - {$monto} WHERE idcuenta ='{$cuentadonacion}'";
      $stmt = $con->prepare($sql);
      $stmt->execute();
      $nunRows = $stmt->rowCount();

if($nunRows > 0){
 
    $sql1="SELECT idbanco FROM cuentas WHERE idcuenta ='{$idcuentatransferir}'";
      $stmt = $con->prepare($sql1);
      $stmt->execute();
      $nunRows = $stmt->rowCount();

      while ($linea= $stmt->fetch()){
       $idBancoLinea=$linea['idbanco'];

    if($idBancoLinea != $idbanco){
        $sql="UPDATE cuentas SET monto = monto - 50 WHERE idcuenta ='{$cuentadonacion}'";
            $stmt = $con->prepare($sql);
            $stmt->execute();
            $nunRows = $stmt->rowCount();
        if($nunRows > 0){
        $data = [
            "1" => "ok",
            "2" => "descuento",
            "3" => 50
        ];
        echo json_encode($data);
       }
    }else{
     $data = [
        "1" => "ok",
        "2" => "nodescuento"
        ];
       echo json_encode($data);
    }
 }
}
?>