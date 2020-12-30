<?php 
require "funciones.php";
require "../modelos/modelo-grafico.php";

$mg = new Modelo_Grafico();

$consulta = $mg->TraerDatosGrafico();
$array = array();

//echo json_encode($consulta);

for($i = 0; $i < count($consulta); $i++){
    $fecha = strtotime($consulta[$i]['fecha']);
    $mes = date('m', $fecha);
    $total = $consulta[$i]["total"];
    
    $array = array(ventaMensual(1),ventaMensual(2), ventaMensual(3), ventaMensual(4), ventaMensual(5), ventaMensual(6), ventaMensual(7), ventaMensual(8), ventaMensual(9), ventaMensual(10), ventaMensual(11), ventaMensual(12));
    
}

echo json_encode($array);
    