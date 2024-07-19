<?php
require 'conexion.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
$passw1    = mysqli_real_escape_string($con,$request->passw1);
$passw2 = mysqli_real_escape_string($con,$request->passw2);
$idUsuario = mysqli_real_escape_string($con,$request->idUsuario);
$clave = mysqli_real_escape_string($con,$request->clave);

$hoy = date("Y-m-d");

$sql= "SELECT clave FROM usuarios WHERE idUsuario='{$idUsuario}'";
$resultado = mysqli_query($con,$sql);

while ($linea= mysqli_fetch_array($resultado,MYSQLI_ASSOC)){
    $claveUser=$linea['clave'];
}
    $sql0= "INSERT INTO token (idUsuario,fechaToken) VALUES('$idUsuario','$hoy')";
    $resultado = mysqli_query($con,$sql0);

    /*if($claveUser != $clave){
        $sql2= "INSERT INTO token (idUsuario,fechaToken) VALUES('$idUsuario','$hoy')";
        $resultado = mysqli_query($con,$sql2);
    }  */   
      

/*$sql1="SELECT count(*) as conteo FROM token WHERE fechaToken ='$hoy' AND idUsuario='{$idUsuario}'";
      $resultado1 = mysqli_query($con,$sql1);
      while ($linea1= mysqli_fetch_array($resultado1,MYSQLI_ASSOC)){
            $conteo=$linea1['conteo'];
      }*/


if(mysqli_affected_rows($con) > 0){
    echo json_encode("hecho");
  } 
else
{
    echo json_encode($claveUser);
}

