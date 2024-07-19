<?php
require 'conexion.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$clave    = mysqli_real_escape_string($con,$request->clave);
$cedula = mysqli_real_escape_string($con,$request->cedula);
$array = [];
$sql = "SELECT nombre,cedula,clave, idUsuario FROM usuarios WHERE cedula='{$cedula}' AND clave='{$clave}'";
$resultado = mysqli_query($con,$sql);
$nunRows= mysqli_num_rows($resultado);
$i=0;
while ($linea= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
	  $array[$i]['nombre'] = $linea['nombre'];
    $array[$i]['cedula'] = $linea['cedula'];
    $array[$i]['clave'] = $linea['clave'];
    $array[$i]['idUsuario'] = $linea['idUsuario'];

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
