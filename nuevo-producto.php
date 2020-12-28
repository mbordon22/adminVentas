<?php
include_once("includes/funciones/sesiones.php");
include("includes/funciones/funciones.php");
include("includes/templates/header.php");

$tiposProductos = obtenerTiposProductos();

$id = isset($_GET["id"]) ? (int) $_GET["id"]: "";

if($id > 0){
  $producto = obtenerProducto($id)->fetch_assoc(); 
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
        <h1 class="h3 mb-1 text-gray-800"><?php echo isset($_GET['id']) ? 'Editar Producto' :'Nuevo Producto';?></h1>
        <div class="alert " role="alert" id="notificacion"></div>

        <div class="row">
          <div class="col-12 col-sm-10 pb-4">
            <a href="listado-productos.php" class="btn btn-primary mr-1">Listado</a>
            <a href="nuevo-producto.php" class="btn btn-primary mx-1" id="btnLimpiar">Nuevo</a>
            <input type="hidden" id="id-producto" value="<?php echo isset($producto['idproducto']) ? $producto['idproducto'] : ''; ?>">
            <button type="submit" class="btn btn-success mx-1" name="<?php echo isset($_GET['id']) ? 'btnActualizarP' :'btnGuardarP';?>" id="<?php echo isset($_GET['id']) ? 'btnActualizarP' :'btnGuardarP';?>">Guardar</button>
          </div>
        </div>


        <!-- Formulario -->

        <div class="row">
          <div class="form-group col-6">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" name="txtNombre" id="txtNombre" value="<?php echo isset($producto['nombre_producto']) ? $producto['nombre_producto'] : ''; ?>">
          </div>

          <div class="form-group col-6">
            <label for="nombre">Tipo de producto</label>
            <select class="form-control" name="txtTipoProducto" id="txtTipoProducto">
              <option disabled <?php isset($producto['fk_idtipoproducto']) ? '' : 'selected' ; ?>>Seleccionar:</option>
              <?php if($tiposProductos->num_rows > 0): ?>
                <?php foreach($tiposProductos as $tipoProducto): ?>
                  <option value="<?php echo $tipoProducto["idtipoproducto"];?>" <?php isset($producto['fk_idtipoproducto']) ? 'selected' : '' ; ?> ><?php echo $tipoProducto["nombre"]; ?></option>
                  <?php endforeach; ?>
                  <?php endif; ?>
            </select>
          </div>
        </div>


        <div class="row">
          <div class="form-group col-6">
            <label for="cantidad">Cantidad</label>
            <input type="number" class="form-control" name="txtCantidad" id="txtCantidad" value="<?php echo isset($producto['cantidad_productos']) ? $producto['cantidad_productos'] : ''; ?>">
          </div>

          <div class="form-group col-6">
            <label for="Precio">Precio</label>
            <input type="number" class="form-control" name="txtPrecio" id="txtPrecio" value="<?php echo isset($producto['precio']) ? $producto['precio'] : ''; ?>">
          </div>
        </div>


        <div class="row">
          <div class="form-group col-12">
            <label for="Correo">Descripción:</label>
            <textarea class="form-control" name="txtDescripcion" id="txtDescripcion" cols="30" rows="10"><?php echo isset($producto['descripcion']) ? $producto['descripcion'] : ''; ?></textarea>
          </div>
        </div>


      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!-- Footer -->
    <?php include("includes/templates/footer.php"); ?>