<?php
require 'conexion.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

//$idCuenta = mysqli_real_escape_string($con,$request->idCuenta);
$idcuenta = $request->{'idcuenta'};
$array=[];

//$sql="SELECT idBanco,nombreBanco,tipo FROM bancos WHERE tipo=1";
$sql="SELECT bancos.idbanco,bancos.nombrebanco,cuentas.idcuenta,cuentas.tipo FROM cuentas 
INNER JOIN bancos
on cuentas.idbanco = bancos.idbanco
WHERE cuentas.tipo='1' AND cuentas.idcuenta !='{$idcuenta}'";

$stmt = $con->prepare($sql);
$stmt->execute();
$nunRows = $stmt->rowCount();
/*$resultado = mysqli_query($con,$sql);
$nunRows= mysqli_num_rows($resultado);*/

$i=0;
while ($linea= $stmt->fetch()){
	     $array[$i]['idbanco'] = $linea['idbanco'];
       $array[$i]['nombrebanco'] = $linea['nombrebanco'];
       $array[$i]['idcuenta'] = $linea['idcuenta'];
       $array[$i]['tipo'] = $linea['tipo'];

    $i++;
}

  if($nunRows > 0){
	  echo json_encode($array);
	} 
else
{
echo json_encode("SIN DATOS");
}