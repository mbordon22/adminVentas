<?php
include_once("includes/funciones/sesiones.php");
include("includes/funciones/funciones.php");
include("includes/templates/header.php");

$productos = obtenerProductos();

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
        <h1 class="h3 mb-1 text-gray-800">Listado de Productos</h1>
        <div class="alert " role="alert" id="notificacion"></div>

        <div class="row">
          <div class="col-10 col-sm-4 mb-3">
            <a href="nuevo-producto.php" class="btn btn-primary">Nuevo</a>
          </div>
        </div>
        <div class="row">
          <div class="col-12 py-2">
            <table class="table tablaP table-hover border">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Cantidad</th>
                  <th>Precio</th>
                  <th>Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if($productos->num_rows > 0): ?>
                  <?php foreach($productos as $producto): ?>
                    <tr>
                      <td><?php echo $producto["nombre_producto"] ?></td>
                      <td><?php echo $producto["cantidad_productos"] ?></td>
                      <td><?php echo "$" . number_format($producto["precio"], 2, ",", ".") ?></td>
                      <td class="px-3 d-flex justify-content-start align-items-center">
                          <a href="nuevo-producto.php?id=<?php echo $producto['idproducto'] ?>">
                            <i class="fas fa-edit" id="editar"></i>
                          </a>

                          <button type="button" class="btn btn-borrar" data-id="<?php echo $producto["idproducto"]; ?>">
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

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php include("includes/templates/footer.php"); ?>