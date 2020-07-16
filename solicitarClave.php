<?php
    require 'conexion.php';

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $passw1 = $request->{'passw1'};
    $passw2 = $request->{'passw2'};
    $idUsuario = $request->{'idusuario'};
    $clave = $request->{'clave'};

    $hoy = date("Y-m-d");

    $sql= "SELECT clave FROM usuarios WHERE idUsuario='{$idUsuario}'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $nunRows = $stmt->rowCount();

    while ($linea= $stmt->fetch()){
        $claveUser=$linea['clave'];
    }    

    if($claveUser != $clave){
        $sql0= "INSERT INTO token (idusuario,fechatoken) VALUES('$idUsuario','$hoy')";
        $stmt = $con->prepare($sql0);
        $stmt->execute();
        $nunRows3 = $stmt->rowCount();

        $sql1="SELECT count(*) as conteo FROM token WHERE fechatoken ='$hoy' AND idusuario='{$idUsuario}'";
        $stmt = $con->prepare($sql1);
        $stmt->execute();
        $nunRows = $stmt->rowCount();

            while ($linea = $stmt->fetch()){
            $conteo=$linea['conteo'];
            }

            if($conteo > 2){
                echo json_encode("MAS DE DOS INTENTOS");
            }elseif($nunRows3 > 0){
                echo json_encode("CLAVE ERRADA");
            }

    }  else {

        $sql1="SELECT count(*) as conteo FROM token WHERE fechatoken ='$hoy' AND idusuario='{$idUsuario}'";
        $stmt = $con->prepare($sql1);
        $stmt->execute();
        $nunRows = $stmt->rowCount();

         while ($linea = $stmt->fetch()){
            $conteo=$linea['conteo'];
            }

            if($conteo > 2){
                echo json_encode("MAS DE DOS INTENTOS PASO");
            }else{
                $sql="UPDATE usuarios SET clave ='{$passw2}' WHERE idusuario='{$idUsuario}'";
                $stmt = $con->prepare($sql);
                $stmt->execute();
                $nunRows5 = $stmt->rowCount();

                if($nunRows5 > 0){
                    echo json_encode("OK");
                } 
                else
                {
                    echo json_encode("NO ACTUALIZADA");
                }
            }  
        }
        

        

