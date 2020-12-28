<?php
include_once("includes/funciones/sesiones.php");
include("includes/funciones/funciones.php");
include("includes/templates/header.php");

$idTipoProducto = (isset($_GET["id"])) ? (int) $_GET["id"] : "";

if($idTipoProducto > 0){
  $tipo_producto = obtenerTipoProducto($idTipoProducto)->fetch_assoc();
}

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
        <h1 class="h3 mb-1 text-gray-800"><?php echo isset($_GET['id']) ? 'Editar tipo producto' :'Nuevo tipo de producto';?></h1>
        <div class="alert " role="alert" id="notificacion"></div>

        <!--Botones-->
        <div class="row mb-4">
          <div class="col-12 col-sm-8">
            <form action="" method="POST">
              <a href="tipos-productos.php" class="btn btn-primary mr-1">Listado</a>
              <a href="nuevo-tipo-producto.php" class="btn btn-primary mx-1">Nuevo</a>
              <input type="hidden" id="id-tipo-producto" value="<?php echo isset($_GET['id']) ? $_GET['id'] : ''; ?>">
              <button type="submit" class="btn btn-success mx-1" name="<?php echo isset($_GET['id']) ? 'btnActualizarTP' : 'btnGuardarTP'; ?>" id="<?php echo isset($_GET['id']) ? 'btnActualizarTP' : 'btnGuardarTP'; ?>">Guardar</button>
            </form>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <form action="" method="POST" class="form" id="form-tipo-producto">
              <div class="row">
                <div class="col-12 p-2 form-group">
                  <label for="txtNombre">Nombre:</label>
                  <input type="text" name="txtNombre" class="form-control" id="txtNombre" value="<?php echo isset($tipo_producto['nombre']) ? $tipo_producto['nombre'] : ''; ?>">
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>


      <!-- Content Row -->


      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php include("includes/templates/footer.php") ?>