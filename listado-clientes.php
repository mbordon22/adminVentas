<?php
include_once("includes/funciones/sesiones.php");
include("includes/funciones/funciones.php");
include("includes/templates/header.php");


$clientes = obtenerClientes();

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
              <h3>Listado de clientes</h3>
              <div class="alert " role="alert" id="notificacion"></div>
            </div>

            <!--Boton-->
            <div class="col-12 pb-3">
              <a href="nuevo-cliente.php" class="btn btn-primary">Nuevo</a>
            </div>
          </div>

          <!-- Tabla -->
          <div class="row" style="height: 70vh;">
            <div class="col-12 mx-2">
              <table class="table table-hover border">
                <thead>
                  <tr>
                    <th>CUIT</th>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Telefono</th>
                    <th>Correo</th>
                    <th>Domicilio</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if ($clientes->num_rows > 0) : ?>
                    <?php foreach ($clientes as $cliente) : ?>
                      <tr>
                        <td><?php echo $cliente["cuit"]; ?></td>
                        <td><?php echo $cliente["nombre"]; ?></td>
                        <td><?php echo $cliente["edad"]; ?></td>
                        <td><?php echo $cliente["telefono"]; ?></td>
                        <td><?php echo $cliente["correo"]; ?></td>
                        <td><?php echo $cliente["domicilio"]; ?></td>
                        <td class="px-3 d-flex justify-content-around align-items-center">
                          <a href="nuevo-cliente.php?id=<?php echo $cliente['idcliente'] ?>">
                            <i class="fas fa-edit" id="editar"></i>
                          </a>

                          <button type="button" class="btn btn-borrar" data-id="<?php echo $cliente["idcliente"]; ?>">
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