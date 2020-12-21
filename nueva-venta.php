<?php
include("includes/funciones/funciones.php");
include("includes/templates/header.php");


date_default_timezone_set('America/Argentina/Tucuman');

$clientes = obtenerClientes();
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
        <h1 class="h3 mb-2 text-gray-800">Nueva Venta</h1>

        <!--Botones-->
        <div class="row my-4">
          <div class="col-12 col-sm-8">
            <form action="" method="POST">
              <a href="listado-ventas.php" class="btn btn-primary mr-1">Listado</a>
              <a href="nueva-venta.php" class="btn btn-primary mx-1">Nuevo</a>
              <input type="hidden" id="id-cliente" value="<?php echo isset($venta['idventa']) ? $venta['idventa'] : ''; ?>">
              <button type="submit" class="btn btn-success mx-1" name="btnGuardar" id="<?php echo isset($_GET['id']) ? 'btnActualizar' : 'btnGuardar'; ?>">Guardar</button>
            </form>
          </div>
        </div>

        <!--Formulario-->
        <div class="row">
          <div class="col-12">
            <form action="" method="POST" class="form">
              <div class="row">
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="fecha">Fecha:</label>
                  <input type="date" name="txtFecha" id="txtFecha" class="form-control" value="<?php echo date("Y-m-d"); ?>">
                </div>
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="hora">Hora</label>
                  <input type="time" name="txtHora" id="txtHora" class="form-control" value="<?php echo date("H:i"); ?>">
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="lstCliente">Cliente:</label>
                  <select name="lstCliente" id="lstCliente" class="form-control" required>
                    <option value="" disabled selected>Seleccionar</option>
                    <?php if ($clientes->num_rows > 0) : ?>
                      <?php foreach ($clientes as $cliente) : ?>
                        <option value="<?php echo $cliente["idcliente"]; ?>" <?php isset($venta['fk_idcliente']) ? 'selected' : ''; ?>><?php echo $cliente["nombre"]; ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>

                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="lstProducto">Producto:</label>
                  <select name="lstProducto" id="lstProducto" class="form-control" required>
                    <option value="" disabled selected>Seleccionar</option>
                    <?php if ($productos->num_rows > 0) : ?>
                      <?php foreach ($productos as $producto) : ?>
                        <option value="<?php echo $producto["idproducto"]; ?>" <?php isset($venta['fk_idproducto']) ? 'selected' : ''; ?>><?php echo $producto["nombre"]; ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="precioU">Precio Unitario:</label>
                  <input type="number" name="txtPrecioU" id="txtPrecioU" class="form-control" disabled value="$0">
                </div>
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="cantidad">Cantidad:</label>
                  <input type="number" name="txtCantidad" id="txtCantidad" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="total">Total:</label>
                  <input type="number" name="txtTotal" id="txtTotal" class="form-control">
                </div>
              </div>
            </form>
          </div>
        </div>


      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php include("includes/templates/footer.php"); ?>