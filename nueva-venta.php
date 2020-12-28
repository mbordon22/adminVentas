<?php
include_once("includes/funciones/sesiones.php");
include("includes/funciones/funciones.php");
include("includes/templates/header.php");


date_default_timezone_set('America/Argentina/Tucuman');

$clientes = obtenerClientes();
$productos = obtenerProductos();

$id = isset($_GET["id"]) ? $_GET["id"] : "";
if ($id > 0) {
  $venta = obtenerVenta($id)->fetch_assoc();
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
      <div class="container-fluid" id="contenedor-principal">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800"><?php echo isset($_GET['id']) ? 'Editar Venta' : 'Nueva Venta'; ?></h1>
        <div class="alert " role="alert" id="notificacion"></div>

        <!--Botones-->
        <div class="row my-1">
          <div class="col-12 col-sm-8">
            <form action="" method="POST">
              <a href="listado-ventas.php" class="btn btn-primary mr-1">Listado</a>
              <a href="nueva-venta.php" class="btn btn-primary mx-1">Nuevo</a>
              <input type="hidden" id="id-venta" value="<?php echo isset($venta['idventas']) ? $venta['idventas'] : ''; ?>">
              <button type="submit" class="btn btn-success mx-1" name="btnGuardar" id="<?php echo isset($_GET['id']) ? 'btnActualizar' : 'btnGuardar'; ?>">Guardar</button>
            </form>
          </div>
        </div>

        <!--Formulario-->
        <div class="row">
          <div class="col-12">
            <form action="" method="POST" class="form" name="form_venta">
              <div class="row">
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="fecha">Fecha:</label>
                  <input type="date" name="txtFecha" id="txtFecha" class="form-control" value="<?php echo isset($venta['fecha']) ? $venta['fecha']  : date("Y-m-d"); ?>">
                </div>
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="hora">Hora</label>
                  <input type="time" name="txtHora" id="txtHora" class="form-control" value="<?php echo isset($venta['hora']) ? $venta['hora'] : date("H:i"); ?>">
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="lstCliente">Cliente:</label>
                  <input type="hidden" name="cliente_seleccionado" id="cliente_seleccionado" value="<?php echo isset($venta["idcliente"]) ? $venta["idcliente"] : "" ;?>">
                  <select name="lstCliente" id="lstCliente" class="form-control" required>
                    <option value="0" selected disabled>Seleccionar</option>
                    <?php if ($clientes->num_rows > 0) : ?>
                      <?php foreach ($clientes as $cliente) : ?>
                        <option value="<?php echo $cliente["idcliente"];?>"><?php echo $cliente["nombre"]; ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>

                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="lstProducto">Producto:</label>
                  <input type="hidden" name="producto_seleccionado" id="producto_seleccionado" value="<?php echo isset($venta["idproducto"]) ? $venta["idproducto"] : "" ;?>">
                  <select name="lstProducto" id="lstProducto" class="form-control" required>
                    <option value="0" selected disabled>Seleccionar</option>
                    <?php if ($productos->num_rows > 0) : ?>
                      <?php foreach ($productos as $producto) : ?>
                        <option id="<?php echo $producto['precio'] ?>" value="<?php echo $producto["idproducto"]; ?>" stock="<?php echo $producto["cantidad_productos"] ?>"><?php echo $producto["nombre_producto"]; ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="precioU">Precio Unitario:</label>
                  <input type="text" name="txtPrecioU" id="txtPrecioU" class="form-control" disabled value="<?php echo isset($venta['precio']) ? "$" . $venta['precio'] : "" ;?>">
                </div>
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="cantidad">Cantidad:</label>
                  <input type="hidden" id="stock" value="<?php echo isset($venta['cantidad_producto']) ? $venta['cantidad_productos'] : ''; ?>">
                  <input type="number" name="txtCantidad" id="txtCantidad" class="form-control" required value="<?php echo isset($venta['cantidad']) ? $venta['cantidad'] : '' ?>">
                </div>
              </div>
              <div class="row">
                <div class="col-12 col-sm-6 p-2 form-group">
                  <label for="total">Total:</label>
                  <input type="text" name="txtTotal" id="txtTotal" class="form-control" disabled value="<?php echo isset($venta['total']) ? "$" . $venta['total'] : "" ;?>">
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