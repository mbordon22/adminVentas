<?php

//Obtener la pagina actual
function obtenerPaginaActual() {

    $archivo = basename($_SERVER["PHP_SELF"]);

    $pagina = str_replace(".php", "", $archivo);

    return $pagina;
}

//Funciones para obtener datos de la bd
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

function obtenerVentas(){
    //Incluimos la base de datos
    include("conexion.php");

    try{
        $consulta = " SELECT * ";
        $consulta .= " FROM ventas ";
        $consulta .= " INNER JOIN clientes ";
        $consulta .= " ON ventas.fk_idcliente = clientes.idcliente ";
        $consulta .= " INNER JOIN productos ";
        $consulta .= " ON ventas.fk_idproducto = productos.idproducto ";
        return $conn->query($consulta);

    }catch(Exception $e){
        echo "Error! " . $e->getMessage();
        return false;
    }
}

function obtenerVenta($id){
    //Incluimos la base de datos
    include("conexion.php");

    try{
        $consulta = " SELECT * ";
        $consulta .= " FROM ventas ";
        $consulta .= " INNER JOIN clientes ";
        $consulta .= " ON ventas.fk_idcliente = clientes.idcliente ";
        $consulta .= " INNER JOIN productos ";
        $consulta .= " ON ventas.fk_idproducto = productos.idproducto ";
        $consulta .= " WHERE idventas = {$id} ";
        return $conn->query($consulta);

    }catch(Exception $e){
        echo "Error! " . $e->getMessage();
        return false;
    }
}


//Funcion para mostrar el gasto mensual y anual

function ventaMensual($mesIngresado){
    $ventas = obtenerVentas();
    $totalMensual = 0;

    foreach($ventas as $venta){
        $fecha = strtotime($venta['fecha']);
        $mes = date('m', $fecha);
    
        if($mes == $mesIngresado){
            $totalMensual = $totalMensual + $venta["total"];
        }
    }

    return $totalMensual;
}

function ventaAnual($anoIngresado){
    $ventas = obtenerVentas();
    $totalAnual = 0;

    foreach($ventas as $venta){
        $fecha = strtotime($venta['fecha']);
        $ano = date('Y', $fecha);
    
        if($ano == $anoIngresado){
            $totalAnual = $totalAnual + $venta["total"];
        }
    }

    return $totalAnual;
}

