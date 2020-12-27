<?php
include("includes/funciones/funciones.php");
include("includes/templates/header.php");

$idcliente = (isset($_GET["id"])) ? (int) $_GET["id"] : "";

if($idcliente > 0){
  $cliente = obtenerCliente($idcliente)->fetch_assoc();
}

?>
<!-- Page Wrapper -->
<div id="wrapper">

  <!--sidebar-->
  <?php include("includes/templates/sidebar.php"); ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- nav -->
      <?php include("includes/templates/nav.php"); ?>

      <!-- Begin Page Content -->
      <div class="container-fluid">


        <div id="content">

          <!-- Begin Page Content -->
          <div class="container-fluid" style="height: 81vh" ;>

            <!-- Page Heading -->
            <h1 class="h3 mb-1 text-gray-800"><?php echo isset($_GET['id']) ? 'Editar Cliente' :'Nuevo Cliente';?></h1>
            <div class="alert " role="alert" id="notificacion"></div>

            <!--Botones-->
            <div class="row mb-4">
              <div class="col-12 col-sm-8">
                <form action="" method="POST">
                  <a href="listado-clientes.php" class="btn btn-primary mr-1">Listado</a>
                  <a href="nuevo-cliente.php" class="btn btn-primary mx-1" >Nuevo</a>
                  <input type="hidden" id="id-cliente" value="<?php echo isset($cliente['idcliente']) ? $cliente['idcliente'] : ''; ?>">
                  <button type="submit" class="btn btn-success mx-1" name="btnGuardar" id="<?php echo isset($_GET['id']) ? 'btnActualizar' :'btnGuardar';?>">Guardar</button>
                </form>
              </div>
            </div>


            <!--Formulario-->
            <div class="row">
              <div class="col-12">
                <form action="" method="POST" class="form" id="form-cliente">
                  <div class="row">
                    <div class="col-12 col-sm-6 p-2 form-group">
                      <label for="txtNombre">Nombre:</label>
                      <input type="text" name="txtNombre" class="form-control" id="txtNombre" value="<?php echo isset($cliente['nombre']) ? $cliente['nombre'] : ''; ?>">
                    </div>
                    <div class="col-12 col-sm-6 p-2 form-group">
                      <label for="txtCuit">CUIT:</label>
                      <input type="number" name="txtCuit" id="txtCuit" class="form-control" value="<?php echo isset($cliente['cuit']) ? $cliente['cuit'] : ''; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-6 p-2 form-group">
                      <label for="fechaNac">Fecha de Nacimiento:</label>
                      <input type="date" name="txtFechaNac" id="txtFechaNac" class="form-control" value="<?php echo isset($cliente['fecha_nac']) ? $cliente['fecha_nac'] : ''; ?>">
                    </div>
                    <div class="col-12 col-sm-6 p-2 form-group">
                      <label for="txtTelefono">Telefono:</label>
                      <input type="number" name="txtTelefono" id="txtTelefono" class="form-control" value="<?php echo isset($cliente['telefono']) ? $cliente['telefono'] : ''; ?>">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-12 col-sm-6 p-2 form-group">
                      <label for="txtCorreo">Correo:</label>
                      <input type="email" name="txtCorreo" id="txtCorreo" class="form-control" value="<?php echo isset($cliente['correo']) ? $cliente['correo'] : ''; ?>">
                    </div>
                    <div class="col-12 col-sm-6 p-2 form-group">
                      <label for="txtDomicilio">Domicilio:</label>
                      <input type="text" name="txtDomicilio" id="txtDomicilio" class="form-control" value="<?php echo isset($cliente['domicilio']) ? $cliente['domicilio'] : ''; ?>">
                    </div>
                  </div>
                </form>
              </div>
            </div>



            <!-- /.container-fluid -->

          </div>
          <!-- End of Main Content -->

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include("includes/templates/footer.php"); ?>