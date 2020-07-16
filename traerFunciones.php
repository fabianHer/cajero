<?php
require 'conexion.php';

$array=[];
$sql="SELECT bancos.idbanco,bancos.nombrebanco,cuentas.idcuenta,cuentas.tipo FROM cuentas 
INNER JOIN bancos
on cuentas.idbanco = bancos.idbanco
WHERE cuentas.tipo='2'";
//$sql="SELECT idbanco,nombrebanco,tipo FROM bancos WHERE tipo='2'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $nunRows = $stmt->rowCount();

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