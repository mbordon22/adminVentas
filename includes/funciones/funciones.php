<?php

//Obtenere la pagina actual
function obtenerPaginaActual() {

    $archivo = basename($_SERVER["PHP_SELF"]);

    $pagina = str_replace(".php", "", $archivo);

    return $pagina;
}

function obtenerClientes(){
    //Incluimos la base de datos
    include("conexion.php");

    try{
        return $conn->query("SELECT * FROM clientes");

    }catch(Exception $e){
        echo "Error! " . $e->getMessage();
        return false;
    }
}

function obtenerCliente($id){
    //Incluimos la base de datos
    include("conexion.php");

    try{
        return $conn->query("SELECT * FROM clientes WHERE idCliente = {$id}");

    }catch(Exception $e){
        echo "Error! " . $e->getMessage();
        return false;
    }
}

function obtenerTiposProductos(){
    //Incluimos la base de datos
    include("conexion.php");

    try{
        return $conn->query("SELECT * FROM tipo_productos");

    }catch(Exception $e){
        echo "Error! " . $e->getMessage();
        return false;
    }
}

function obtenerTipoProducto($id){
    //Incluimos la base de datos
    include("conexion.php");

    try{
        return $conn->query("SELECT * FROM tipo_productos WHERE idtipoproducto = {$id}");

    }catch(Exception $e){
        echo "Error! " . $e->getMessage();
        return false;
    }
}

function obtenerProductos(){
    //Incluimos la base de datos
    include("conexion.php");

    try{
        return $conn->query("SELECT * FROM productos");

    }catch(Exception $e){
        echo "Error! " . $e->getMessage();
        return false;
    }
}

function obtenerProducto($id){
    //Incluimos la base de datos
    include("conexion.php");

    try{
        return $conn->query("SELECT * FROM productos WHERE idproducto = {$id}");

    }catch(Exception $e){
        echo "Error! " . $e->getMessage();
        return false;
    }
}