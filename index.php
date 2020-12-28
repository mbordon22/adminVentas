<?php
  include_once("includes/funciones/sesiones.php");
  include("includes/funciones/funciones.php");
  include("includes/templates/header.php");

  $productos = obtenerProductos();


?>

<!-- Page Wrapper -->
<div id="wrapper">

  <!--Sidebar-->
  <?php include("includes/templates/sidebar.php"); ?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

      <!-- nav-->
      <?php include("includes/templates/nav.php"); ?>

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">Inicio</h1>
          <a href="documentos/excel.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generar Reporte</a>
        </div>

        <!-- Content Row -->
        <div class="row">

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Facturación (Mensual)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo "$" . number_format(ventaMensual(12), 2, ",", ".") ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Earnings (Monthly) Card Example -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Facturación (Anual)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800" id="gasto_anual"><?php echo "$" . number_format(ventaAnual(2020), 2, ",", ".") ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Content Row -->
        <?php //include("includes/templates/graficos.php"); ?>
        
      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

    <!--footer-->
    <?php include("includes/templates/footer.php"); ?>