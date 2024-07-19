<?php
require 'conexion.php';

$array=[];

$sql="SELECT cuentas.idCuenta, cuentas.monto, usuarios.nombre, bancos.nombreBanco,cuentas.idBanco from cuentas 
inner join usuarios
on usuarios.idUsuario =cuentas.idUsuario
inner join bancos
on cuentas.idBanco= bancos.idBanco AND cuentas.tipo = 1";

$resultado = mysqli_query($con,$sql);
$nunRows= mysqli_num_rows($resultado);

$i=0;
while ($linea= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
	   $array[$i]['idCuenta'] = $linea['idCuenta'];
       $array[$i]['monto'] = $linea['monto'];
       $array[$i]['nombre'] = $linea['nombre'];
       $array[$i]['nombreBanco'] = $linea['nombreBanco'];
       $array[$i]['idBanco'] = $linea['idBanco'];

    $i++;
}

  if($nunRows > 0){
	  echo json_encode($array);
	} 
else
{
//echo json_encode("SIN DATOS");
}
?>