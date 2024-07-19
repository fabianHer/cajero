<?php
require 'conexion.php';

$array=[];

$sql="SELECT idBanco,nombreBanco,tipo FROM bancos WHERE tipo=2";

$resultado = mysqli_query($con,$sql);
$nunRows= mysqli_num_rows($resultado);

$i=0;
while ($linea= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
	   $array[$i]['idBanco'] = $linea['idBanco'];
       $array[$i]['nombreBanco'] = $linea['nombreBanco'];
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