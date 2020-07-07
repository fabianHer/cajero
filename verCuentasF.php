<?php
require 'conexion.php';

$array=[];

$sql="SELECT cuentas.idcuenta, cuentas.monto, usuarios.nombre, bancos.nombrebanco from cuentas 
inner join usuarios
on usuarios.idusuario =cuentas.idusuario
inner join bancos
on cuentas.idbanco= bancos.idbanco AND cuentas.tipo = '2' ORDER BY cuentas.idcuenta DESC";

    $stmt = $con->prepare($sql);
    $stmt->execute();
    $nunRows = $stmt->rowCount();

/*$resultado = mysqli_query($con,$sql);
$nunRows= mysqli_num_rows($resultado);*/

$i=0;
while ($linea= $stmt->fetch()){
	     $array[$i]['idcuenta'] = $linea['idcuenta'];
       $array[$i]['monto'] = $linea['monto'];
       $array[$i]['nombre'] = $linea['nombre'];
       $array[$i]['nombrebanco'] = $linea['nombrebanco'];

    $i++;
}

  if($nunRows > 0){
	  echo json_encode($array);
	} 
else
{
echo json_encode("SIN DATOS");
}
?>