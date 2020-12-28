<?php
$accion = $_POST["accion"];
$password = $_POST["password"];
$correo = isset($_REQUEST["email"]) ? $_REQUEST["email"] : "";
$nombre = isset($_REQUEST["nombre"]) ? $_REQUEST["nombre"] : "";
$usuario = isset($_REQUEST["usuario"]) ? $_REQUEST["usuario"] : "";

if ($accion == "crear") {

    ///Hashear  password

    $opcion = array(
        "cost" => 12
    );

    $hash_password = password_hash($password, PASSWORD_BCRYPT, $opcion);

    //Incluimos la conexion a la bd
    include("../funciones/conexion.php");

    try {

        //Insertamos los datos en la base de datos
        $stmt = $conn->prepare(" INSERT INTO usuarios (nombre, usuario, correo, clave) VALUES (?, ?, ?, ?) ");
        $stmt->bind_param("ssss", $nombre, $usuario, $correo, $hash_password);

        //Ejecutamos
        $stmt->execute();

        //Mandamos nuestra respuesta en caso que se inserte correctamente

        if ($stmt->affected_rows > 0) {

            $respuesta = array(
                "respuesta" => "correcto",
                "id_insertado" => $stmt->insert_id,
                "tipo" => $accion
            );
        }

        //Cerramos la conexión
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array("respuesta" => $e->getMessage());
    }

    echo json_encode($respuesta);
} elseif ($accion == "login") {
    //Si el admin se loguea.
    //Importo la conexion a la base de datos
    include("../funciones/conexion.php");

    try {

        //Seleccionar el administrador de la base de datos.
        $stmt = $conn->query(" SELECT * FROM usuarios WHERE usuario = '{$usuario}' ")->fetch_assoc();

        //Obtenemos los valores de la bd
        
        
        $id_usuario = isset($stmt["idusuario"]) ? $stmt["idusuario"] : "";
        $nombre = isset($stmt["nombre"]) ? $stmt["nombre"] : "";
        $usuario = isset($stmt["usuario"]) ? $stmt["usuario"] : "";
        $correo = isset($stmt["correo"]) ? $stmt["correo"] : "";
        $clave_usuario = isset($stmt["clave"]) ? $stmt["clave"] : "";
        

        if ($usuario != "") {
            //Si el usuario existe

            if (password_verify($password, $clave_usuario)) {
                //Password correcto

                session_start();
                $_SESSION["nombre"] = $nombre;
                $_SESSION["id"] = $id_usuario;
                $_SESSION["login"] = true;

                $respuesta = array(
                    "respuesta" => "correcto",
                    "usuario" => $nombre,
                    "tipo" => $accion
                );
            } else {
                //Password incorrecto
                $respuesta = array(
                    "resultado" => "Usuario o Password Incorrecto"
                );
            }
        } else {
            //Si el usuario no existe
            $respuesta = array(
                "error" => "Usuario no encontrado"
            );
        }


        //Cerramos la conexion.
        $conn->close();
    } catch (Exception $e) {

        //En caso de un error, tomar la exepcion.
        $respuesta = array(
            "pass" => $e->getMessage()
        );
    }

    echo json_encode($respuesta);
}
