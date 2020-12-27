<?php
include("includes/funciones/funciones.php");
include("includes/templates/header.php");


$ventas = obtenerVentas();


?>
<!-- Page Wrapper -->
<div id="wrapper">

  <!-- Sidebar -->
  <?php include("includes/templates/sidebar.php"); ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- Topbar -->
      <?php include("includes/templates/nav.php"); ?>

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Cuerpo de la pagina -->
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <!-- Titulo -->
              <h3>Listado de ventas</h3>
              <div class="alert " role="alert" id="notificacion"></div>
            </div>

            <!--Boton-->
            <div class="col-12 pb-3">
              <a href="nueva-venta.php" class="btn btn-primary">Nuevo</a>
            </div>
          </div>

          <!-- Tabla -->
          <div class="row" style="height: 70vh;">
            <div class="col-12 mx-2">
              <table class="table table-hover border">
                <thead>
                  <tr>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($ventas->num_rows) : ?>
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
                        <td><?php echo "$" . $venta["total"]; ?></td>
                        <td class="px-3 d-flex align-items-center">
                          <a href="nueva-venta.php?id=<?php echo $venta['idventas'] ?>">
                            <i class="fas fa-edit" id="editar"></i>
                          </a>

                          <button type="button" class="btn btn-borrar" data-id="<?php echo $venta["idventas"]; ?>">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include("includes/templates/footer.php"); ?>