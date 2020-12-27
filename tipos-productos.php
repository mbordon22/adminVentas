<?php
include("includes/funciones/funciones.php");
include("includes/templates/header.php");

$tipos_productos = obtenerTiposProductos();
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

        <!-- Page Heading -->
        <h1 class="h3 mb-1 text-gray-800">Listado de tipos de Productos</h1>
        <div class="alert " role="alert" id="notificacion"></div>

        <div class="row">
          <div class="col-10 col-sm-4 mb-3">
            <a href="nuevo-tipo-producto.php" class="btn btn-primary">Nuevo</a>
          </div>
        </div>
        <div class="row">
          <div class="col-12 py-2">
            <table class="table tablaTP table-hover border">
              <thead>
                <tr class="d-flex justify-content-between tipo-prod px-2">
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($tipos_productos->num_rows > 0) : ?>
                  <?php foreach ($tipos_productos as $tipo_producto) : ?>
                    <tr class="d-flex justify-content-between tipo-prod px-2">
                      <td><?php echo $tipo_producto["nombre"]; ?></td>
                      <td class="px-3 d-flex justify-content-around align-items-center">
                        <a href="nuevo-tipo-producto.php?id=<?php echo $tipo_producto['idtipoproducto'] ?>">
                          <i class="fas fa-edit" id="editarTP"></i>
                        </a>

                        <button type="button" class="btn btn-borrar" data-id="<?php echo $tipo_producto["idtipoproducto"]; ?>">
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