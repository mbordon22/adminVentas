<?php
  session_start();
  include("includes/funciones/funciones.php");
  include("includes/templates/header.php");

  //Si viene en la url la peticion de cerrar sesion, eliminamos los datos de la variable SESSION
  if (isset($_GET["cerrar_sesion"])) {
    $_SESSION = array();
  }
?>

<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Bienvenido!</h1>
                </div>
                <form class="user">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="txtUsuario" placeholder="Enter Email Address..." value="invitado">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="txtClave" placeholder="Password" value="pass123">
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input" id="customCheck">
                      <label class="custom-control-label" for="customCheck">Recordarme</label>
                    </div>
                  </div>
                  <a href="" class="btn btn-primary btn-user btn-block" id="btnLogin">
                    Iniciar Sesión
                  </a>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="forgot-password.html">Olvidaste tu Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="registro.php">Crear una cuenta!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<script src="js/usuarios.js"></script>

</body>

</html>