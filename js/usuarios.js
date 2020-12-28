document.addEventListener("DOMContentLoaded", function(){


    eventListener();

    function eventListener(){
        
        if(document.querySelector("#btnRegistro")){
            document.querySelector("#btnRegistro").addEventListener("click", registrarUsuario);
        }

        if(document.querySelector("#btnLogin")){
            document.querySelector("#btnLogin").addEventListener("click", iniciarSesion);
        }
    }


    function registrarUsuario(e){

        e.preventDefault();

        var nombre = document.querySelector("#txtNombre").value,
            usuario = document.querySelector("#txtUsuario").value,
            email = document.querySelector("#txtEmail").value,
            password = document.querySelector("#txtPassword").value,
            confirmarPass = document.querySelector("#txtPasswordRep").value;


            if(nombre === "" || usuario === "" || email === "email" || password === "" || confirmarPass === "" || password != confirmarPass){
                console.log("error");
            }
            else{
                //Creamos el llamado a ajax
                var xhr = new XMLHttpRequest();

                //Creamos el formData

                var datos = new FormData();
                datos.append("nombre", nombre);
                datos.append("usuario", usuario);
                datos.append("email", email);
                datos.append("password", password);
                datos.append("accion", "crear");
                
                //Abrimos la conexion
                xhr.open("POST", "includes/modelos/modelo-usuarios.php", true);

                //Onload
                xhr.onload = function(){
                    if(this.status === 200){

                        var respuesta = JSON.parse(xhr.responseText);
                        if(respuesta.respuesta === "correcto"){
                            window.location.href = "login.php";
                        }
                    }
                }

                xhr.send(datos);
            }



    }

    function iniciarSesion(e){

        e.preventDefault();

        var usuario = document.querySelector("#txtUsuario").value,
            contraseña = document.querySelector("#txtClave").value;

        if(usuario === "" || contraseña === ""){
            console.log("Error");
        }else{

            //Inicio ajax
            var xhr = new XMLHttpRequest();

            //FormData
            var datos = new FormData();
            datos.append("usuario", usuario);
            datos.append("password", contraseña);
            datos.append("accion", "login");

            //Abro la conexion
            xhr.open("POST", "includes/modelos/modelo-usuarios.php", true);

            //Onload
            xhr.onload = function(){
                if(this.status === 200){

                    var respuesta = JSON.parse(xhr.responseText);
                    

                    if(respuesta.respuesta === "correcto"){
                        window.location.href = "index.php";
                    }
                }
            }

            //Enviamos datos
            xhr.send(datos);
        }
    }
});