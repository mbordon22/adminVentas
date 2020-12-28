<?php 
$accion = $_REQUEST["accion"];
$fecha = (isset($_REQUEST["fecha"])) ? $_REQUEST["fecha"] : "" ;
$hora = (isset($_REQUEST["hora"])) ? $_REQUEST["hora"] : "" ;
$cliente = (isset($_REQUEST["cliente"])) ? $_REQUEST["cliente"] : "" ;
$producto = (isset($_REQUEST["producto"])) ? (int) $_REQUEST["producto"] : "" ;
$total = (isset($_REQUEST["total"])) ? $_REQUEST["total"] : "" ;
$cantidad = (isset($_REQUEST["cantidad"])) ? (int) $_REQUEST["cantidad"] : "" ;
$id = (isset($_REQUEST["id"])) ? (int) $_REQUEST["id"] : "" ;


if($accion == "crear"){
    //Iniciamos la conexion a la bd
    include("../funciones/conexion.php");

    try{
        //Insertamos los datos en la bd
        $stmt = $conn->prepare(" INSERT INTO ventas (fecha, hora, cantidad, fk_idproducto, fk_idcliente, total) VALUE (?, ?, ?, ?, ?, ?) ");
        $stmt->bind_param("ssiiid", $fecha, $hora, $cantidad, $producto, $cliente, $total);

        //Ejecutamos la accion
        $stmt->execute();

        //Devolvemos a Javascript la respuesta
        if($stmt->affected_rows > 0){
            $respuesta = array(
                "respuesta" => "correcto",
                "id" => $stmt->insert_id,
                "hora" => $hora
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

    //Actualizar Stock;

    include("../funciones/conexion.php");

    try{
        $consulta = $conn->query(" SELECT cantidad_productos FROM productos WHERE idproducto = {$producto} ");
        $array = $consulta->fetch_assoc();
        $cantidad_productos = $array["cantidad_productos"];

        $cantidad_restante = $cantidad_productos - $cantidad;

        $stmt = $conn->prepare(" UPDATE productos SET cantidad_productos = ? WHERE idproducto = ? ");
        $stmt->bind_param("ii", $cantidad_restante, $producto);
        $stmt->execute();

        $stmt->close();
        $conn->close();

    }catch(Exception $e){
        //Mostramos el error, en caso que haya alguno
        echo "error" . $e->getMessage();
    }

}elseif($accion == "actualizar"){
    //Iniciamos la conexion a la bd
    include("../funciones/conexion.php");

    try{
        //Insertamos los nuevos datos en la bd
        $stmt = $conn->prepare(" UPDATE ventas SET fecha = ?, hora = ?, cantidad = ?, fk_idproducto = ?, fk_idcliente = ?, total = ?  WHERE idventas = ? ");
        $stmt->bind_param("ssiiidi", $fecha, $hora, $cantidad, $producto, $cliente, $total, $id);

        //Ejecutamos la accion
        $stmt->execute();

        //Devolvemos a Javascript la respuesta
        if($stmt->affected_rows > 0){
            $respuesta = array(
                "respuesta" => "correcto"
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

    //Actualizar Stock;

    include("../funciones/conexion.php");

    try{
        $consulta = $conn->query(" SELECT cantidad_productos FROM productos WHERE idproducto = {$producto} ");
        $array = $consulta->fetch_assoc();
        $cantidad_productos = $array["cantidad_productos"];

        $cantidad_restante = $cantidad_productos - $cantidad;

        $stmt = $conn->prepare(" UPDATE productos SET cantidad_productos = ? WHERE idproducto = ? ");
        $stmt->bind_param("ii", $cantidad_restante, $producto);
        $stmt->execute();

        $stmt->close();
        $conn->close();

    }catch(Exception $e){
        //Mostramos el error, en caso que haya alguno
        echo "error" . $e->getMessage();
    }

}elseif($accion == "borrar") {
 
    include("../funciones/conexion.php"); //Conectamos a la bd.

    try{
        //Realizamos la accion en la base de datos
        $stmt = $conn->prepare(" DELETE FROM ventas WHERE idventas = ? ");
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

        echo json_encode($respuesta);

    }catch(Exception $e){
        //En caso de error mostramos el mensaje
        $respuesta = array(
            "error" => $e->getMessage()
        );

        echo json_encode($respuesta);
    }


    

}

?>