<?php 
  include("includes/funciones/funciones.php");
  include("includes/templates/header.php"); 
?>


  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Crea una Cuenta!</h1>
              </div>
              <form class="user">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="txtNombre" placeholder="Nombre">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="txtUsuario" placeholder="Usuario">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="txtEmail" placeholder="Email">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control form-control-user" id="txtPassword" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control form-control-user" id="txtPasswordRep" placeholder="Repetir Password">
                  </div>
                </div>
                <a href="#" class="btn btn-primary btn-user btn-block" id="btnRegistro">
                  Registrar Cuenta
                </a>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="login.php">Ya tienes una cuenta? Inicia Sesión!</a>
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
