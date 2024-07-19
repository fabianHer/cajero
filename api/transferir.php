  <?php
require 'conexion.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$monto    = mysqli_real_escape_string($con,$request->monto);
$idCuentaTransferir = mysqli_real_escape_string($con,$request->idCuentaTransferir);
                                                               
$cuentaDonacion = mysqli_real_escape_string($con,$request->cuentaDonacion);
$idBanco = mysqli_real_escape_string($con,$request->idBanco);

$sql="UPDATE cuentas set monto = monto + {$monto} WHERE idCuenta ='{$idCuentaTransferir}'";
$resultado = mysqli_query($con,$sql);

$sql="UPDATE cuentas set monto = monto - {$monto} WHERE idCuenta ='{$cuentaDonacion}'";
$resultado = mysqli_query($con,$sql);

if(mysqli_affected_rows($con) > 0){
 
$sql1="SELECT idBanco FROM cuentas WHERE idCuenta ='{$idCuentaTransferir}'";
    $resultado1 = mysqli_query($con,$sql1);

    while ($linea= mysqli_fetch_array($resultado1,MYSQLI_ASSOC)){
       $idBancoLinea=$linea['idBanco'];

    if($idBancoLinea != $idBanco){
        $sql="UPDATE cuentas SET monto = monto - 50 WHERE idCuenta ='{$cuentaDonacion}'";
        $resultado = mysqli_query($con,$sql);
        if(mysqli_affected_rows($con) > 0){
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