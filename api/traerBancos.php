<?php
require 'conexion.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$idCuenta = mysqli_real_escape_string($con,$request->idCuenta);

$array=[];

//$sql="SELECT idBanco,nombreBanco,tipo FROM bancos WHERE tipo=1";
$sql="SELECT bancos.idBanco,bancos.nombreBanco,cuentas.idCuenta,cuentas.tipo FROM cuentas 
INNER JOIN bancos
on cuentas.idBanco = bancos.idBanco
WHERE cuentas.tipo=1 AND cuentas.idCuenta !='{$idCuenta}'";

$resultado = mysqli_query($con,$sql);
$nunRows= mysqli_num_rows($resultado);

$i=0;
while ($linea= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
	   $array[$i]['idBanco'] = $linea['idBanco'];
       $array[$i]['nombreBanco'] = $linea['nombreBanco'];
       $array[$i]['idCuenta'] = $linea['idCuenta'];
       $array[$i]['tipo'] = $linea['tipo'];

    $i++;
}

  if($nunRows > 0){
	  echo json_encode($array);
	} 
else
{
//echo json_encode("SIN DATOS");
}