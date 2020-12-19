<?php

//Guardamos todos los datos enviados de js
$accion = $_REQUEST["accion"];
$nombre = (isset($_REQUEST["nombre"])) ? $_REQUEST["nombre"] : "" ;
$cuit = (isset($_REQUEST["cuit"])) ? $_REQUEST["cuit"] : "" ;
$fecha_nac = (isset($_REQUEST["fechaNac"])) ? $_REQUEST["fechaNac"] : "" ;
$telefono = (isset($_REQUEST["telefono"])) ? $_REQUEST["telefono"] : "" ;
$correo = (isset($_REQUEST["correo"])) ? $_REQUEST["correo"] : "" ;
$edad = (isset($_REQUEST["edad"])) ? (int) $_REQUEST["edad"] : "" ;
$domicilio = (isset($_REQUEST["domicilio"])) ? $_REQUEST["domicilio"] : "" ;
$id = (isset($_REQUEST["id"])) ? (int) $_REQUEST["id"] : "" ;


if($accion == "crear"){
    //Iniciamos la conexion a la bd
    include("../funciones/conexion.php");

    try{
        //Insertamos los datos en la bd
        $stmt = $conn->prepare(" INSERT INTO clientes (nombre, cuit, telefono, correo, edad, fecha_nac, domicilio) VALUE (?, ?, ?, ?, ?, ?, ?) ");
        $stmt->bind_param("ssssiss", $nombre, $cuit, $telefono, $correo, $edad, $fecha_nac, $domicilio);

        //Ejecutamos la accion
        $stmt->execute();

        //Devolvemos a Javascript la respuesta
        if($stmt->affected_rows > 0){
            $respuesta = array(
                "respuesta" => "correcto",
                "id" => $stmt->insert_id
            );
        }

        //Cerramos la conexión
        $stmt->close();
        $conn->close();


    }catch(Exception $e){
        //Mostramos el error, en caso que haya alguno
        $respuesta = array(
            "error" => $e->getMessage()
        );
    }

    //Devolvemos los datos a javascript
    echo json_encode($respuesta);

}elseif($accion == "actualizar"){

    //Iniciamos la conexion a la bd
    include("../funciones/conexion.php");

    try{
        //Insertamos los datos en la bd
        $stmt = $conn->prepare(" UPDATE clientes SET nombre = ?, cuit = ?, telefono = ?, correo = ?, edad = ?, fecha_nac = ?, domicilio = ? WHERE idcliente = ? ");
        $stmt->bind_param("ssssissi", $nombre, $cuit, $telefono, $correo, $edad, $fecha_nac, $domicilio, $id);

        //Ejecutamos la accion
        $stmt->execute();

        //Devolvemos a Javascript la respuesta
        if($stmt->affected_rows > 0){
            $respuesta = array(
                "respuesta" => "actualizado",
                "id" => $stmt->insert_id
            );
        }

        //Cerramos la conexión
        $stmt->close();
        $conn->close();


    }catch(Exception $e){
        $respuesta = array(
            "error" => $e->getMessage()
        );
    }

    //DEVOLVEMOS LOS DATOS A JAVASCRIPT
    echo json_encode($respuesta);

}elseif($accion == "borrar") {
 
    include("../funciones/conexion.php"); //Conectamos a la bd.

    try{
        //Realizamos la accion en la base de datos
        $stmt = $conn->prepare(" DELETE FROM `clientes` WHERE `clientes`.`idcliente` = ? ");
        $stmt->bind_param("i", $id);
        
        //ejecutamos la accion
        $stmt->execute();

        //En caso que se ejecute correctamente guardamos una respuesta
        if($stmt->affected_rows > 0){
            $respuesta = array(
                "respuesta" => "correcto"
            );
        }

        //Cerramos la conexion.
        $stmt->close();
        $conn->close();

    }catch(Exception $e){
        //En caso de error mostramos el mensaje
        $respuesta = array(
            "error" => $e->getMessage()
        );
    }

    //Devolvemos una respuesta a js
    echo json_encode($respuesta);

}
