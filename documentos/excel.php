<?php
header("Content-Type: application/xls");
header("Content-Disposition: attachment; filename=ventas.xls");

?>

<table class="table table-hover border">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Cliente</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        include("../includes/funciones/funciones.php");
        $ventas = obtenerVentas();
        
        if ($ventas->num_rows) : ?>
            <?php foreach ($ventas as $venta) : ?>
                <tr>
                    <td><?php $dia = date_create($venta['fecha']);

                        echo date_format($dia, "d-m-Y");

                        ?></td>
                    <td><?php $hora = date_create($venta['hora']);

                        echo date_format($hora, "H:i");

                        ?></td>
                    <td><?php echo $venta["nombre_producto"]; ?></td>
                    <td><?php echo $venta["cantidad"]; ?></td>
                    <td><?php echo $venta["nombre"]; ?></td>
                    <td><?php echo "$" . number_format($venta["total"], 2, ",", "."); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>