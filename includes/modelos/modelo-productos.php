<?php 

$accion = isset($_REQUEST["accion"]) ? $_REQUEST["accion"] : "";

//Variables para la tabla tipo de productos.
$nombreTipoProducto = isset($_REQUEST["nombre_tp"]) ? $_REQUEST["nombre_tp"] : "";
$idTipoProducto = isset($_REQUEST["id_tp"]) ? (int) $_REQUEST["id_tp"] : "";

//Variables para la tabla productos
$nombreProducto = isset($_REQUEST["nombreProducto"]) ? $_REQUEST["nombreProducto"] : "";
$tipoProducto = isset($_REQUEST["tipo_producto"]) ? (int) $_REQUEST["tipo_producto"] : "";
$cantidad = isset($_REQUEST["cantidad"]) ? (int) $_REQUEST["cantidad"] : "";
$precio = isset($_REQUEST["precio"]) ? $_REQUEST["precio"] : "";
$descripcion = isset($_REQUEST["descripcion"]) ? $_REQUEST["descripcion"] : "";
$idProducto = isset($_REQUEST["id_producto"]) ? (int) $_REQUEST["id_producto"] : "";

 
//Aciones a ejecutar
if($accion == "crearTP"){
    include("../funciones/conexion.php");

    try{

        $stmt = $conn->prepare(" INSERT INTO tipo_productos (nombre) VALUE (?) ");
        $stmt->bind_param("s", $nombreTipoProducto);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $respuesta = array(
                "respuesta" => "correcto"
            );
        }

        $stmt->close();
        $conn->close();

    }catch(Exception $e){
        $respuesta = array(
            "error" => $e->getMessage()
        );
    }

    echo json_encode($respuesta);


}
elseif($accion == "actualizarTP"){
    include("../funciones/conexion.php");

    try{

        $stmt = $conn->prepare(" UPDATE tipo_productos SET nombre = ? WHERE idtipoproducto = ? ");
        $stmt->bind_param("si", $nombreTipoProducto, $idTipoProducto);
        $stmt->execute();


        if($stmt->affected_rows > 0){
            $respuesta = array(
                "respuesta" => "correcto"
            );
        }

        $stmt->close();
        $conn->close();

    }catch(Exception $e){
        $respuesta = array(
            "error" => $e->getMessage()
        );
    }

    echo json_encode($respuesta);
}
elseif($accion == "borrarTP"){
    include("../funciones/conexion.php"); //Conectamos a la bd.

    try{
        //Realizamos la accion en la base de datos
        $stmt = $conn->prepare(" DELETE FROM `tipo_productos` WHERE `tipo_productos`.`idtipoproducto` = ? ");
        $stmt->bind_param("i", $idTipoProducto);
        
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
elseif($accion == "crearP"){
    include("../funciones/conexion.php");

    try{

        $stmt = $conn->prepare(" INSERT INTO productos (nombre_producto, cantidad_productos, precio, descripcion, fk_idtipoprod) VALUE (?, ?, ?, ?, ?) ");
        $stmt->bind_param("sidsi", $nombreProducto, $cantidad, $precio, $descripcion, $tipoProducto);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $respuesta = array(
                "respuesta" => "correcto"
            );
        }

        $stmt->close();
        $conn->close();

    }catch(Exception $e){
        $respuesta = array(
            "error" => $e->getMessage()
        );
    }

    echo json_encode($respuesta);

}
elseif($accion == "actualizarP"){
    include("../funciones/conexion.php");

    try{

        $stmt = $conn->prepare(" UPDATE `productos` SET `nombre_producto` = ?, `fk_idtipoprod` = ?, `cantidad_productos` = ?, `descripcion` = ?, `precio` = ? WHERE `productos`.`idproducto` = ? ");
        $stmt->bind_param("siisdi", $nombreProducto, $tipoProducto, $cantidad, $descripcion, $precio, $idProducto);
        $stmt->execute();


        if($stmt->affected_rows > 0){
            $respuesta = array(
                "respuesta" => "correcto"
            );
        }

        $stmt->close();
        $conn->close();

    }catch(Exception $e){
        $respuesta = array(
            "error" => $e->getMessage()
        );
    }

    
    echo json_encode($respuesta);
}
elseif($accion == "borrarP"){
    include("../funciones/conexion.php"); //Conectamos a la bd.

    try{
        //Realizamos la accion en la base de datos
        $stmt = $conn->prepare(" DELETE FROM `productos` WHERE `productos`.`idproducto` = ? ");
        $stmt->bind_param("i", $idProducto);
        
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

?>