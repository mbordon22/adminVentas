document.addEventListener("DOMContentLoaded", function(){

    eventListener();

    function eventListener(){
        if(document.querySelector("#btnGuardar")){
            document.querySelector("#btnGuardar").addEventListener("click", guardarCliente);
        }
        
        if(document.querySelector("#btnActualizar")){
            document.querySelector("#btnActualizar").addEventListener("click", editarCliente);
        }
        
        if(document.querySelector(".table tbody")){
            document.querySelector(".table tbody").addEventListener("click", eliminarCliente);
        }
    }


    function guardarCliente(e){
        e.preventDefault();

        var nombre = document.querySelector("#txtNombre").value,
            cuit = document.querySelector("#txtCuit").value,
            fechaNac = document.querySelector("#txtFechaNac").value,
            telefono = document.querySelector("#txtTelefono").value,
            correo = document.querySelector("#txtCorreo").value,
            domicilio = document.querySelector("#txtDomicilio").value,
            edad = calcularEdad(fechaNac);


        if(nombre === "" || cuit === "" || fechaNac === "" || telefono === "" || correo === "" || domicilio === ""){
            //Mostrar error en caso que venga vacio
            console.log("error");
        }else{
            //En caso de que todos los campos esten validados.
            //Iniciamos AJAX
            var xhr = new XMLHttpRequest();

            //FormDate
            var datos = new FormData();
            datos.append("nombre", nombre);
            datos.append("cuit", cuit);
            datos.append("fechaNac", fechaNac);
            datos.append("telefono", telefono);
            datos.append("correo", correo);
            datos.append("accion", "crear");
            datos.append("edad", edad);
            datos.append("domicilio", domicilio);

            //Abrimos la conexion ajax
            xhr.open("POST", "includes/modelos/modelo-clientes.php", true);

            //Onload
            xhr.onload = function(){
                if(this.status === 200){
                    var respuesta = JSON.parse(xhr.responseText);
                        console.log(respuesta);
                        if(respuesta.respuesta === "correcto"){
                            
                            limpiarFormulario(e);
                            window.location.href = "listado-clientes.php";
                        }

                }
            }

            //Envio de datos
            xhr.send(datos);
        }
    }

    function calcularEdad(fecha) {
        var hoy = new Date();
        var cumpleanos = new Date(fecha);
        var edad = hoy.getFullYear() - cumpleanos.getFullYear();
        var m = hoy.getMonth() - cumpleanos.getMonth();
    
        if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
            edad--;
        }
    
        return edad;
    }

    function editarCliente(e){
        e.preventDefault();

        var nombre = document.querySelector("#txtNombre").value,
            cuit = document.querySelector("#txtCuit").value,
            fechaNac = document.querySelector("#txtFechaNac").value,
            telefono = document.querySelector("#txtTelefono").value,
            correo = document.querySelector("#txtCorreo").value,
            domicilio = document.querySelector("#txtDomicilio").value,
            edad = calcularEdad(fechaNac),
            id = document.querySelector("input#id-cliente").value;


            if(nombre === "" || cuit === "" || fechaNac === "" || telefono === "" || correo === "" || domicilio === ""){
                //Mostrar error en caso que venga vacio
                console.log("error");
            }else{
                //En caso de que todos los campos esten validados.
                //Iniciamos AJAX
                var xhr = new XMLHttpRequest();
    
                //FormDate
                var datos = new FormData();
                datos.append("nombre", nombre);
                datos.append("cuit", cuit);
                datos.append("fechaNac", fechaNac);
                datos.append("telefono", telefono);
                datos.append("correo", correo);
                datos.append("accion", "actualizar");
                datos.append("edad", edad);
                datos.append("domicilio", domicilio);
                datos.append("id", id);
    
                //Abrimos la conexion ajax
                xhr.open("POST", "includes/modelos/modelo-clientes.php", true);
    
                //Onload
                xhr.onload = function(){
                    if(this.status === 200){
                        var respuesta = JSON.parse(xhr.responseText);
                        console.log(respuesta);
                        if(respuesta.respuesta === "actualizado"){
                            
                            limpiarFormulario(e);
                            window.location.href = "listado-clientes.php";
                        }

                        
                    }
                }
    
                //Envio de datos
                xhr.send(datos);
            }
        
    }

    function eliminarCliente(e){
        if(e.target.parentElement.classList.contains('btn-borrar')){
            
            
            //tomar el id
            var id = e.target.parentElement.getAttribute('data-id');

    
            //preguntar al usuario
            const respuesta = confirm('¿Estas seguro?');
    
            if(respuesta){
                //llamado a ajax
                //crear el objeto
                const xhr = new XMLHttpRequest();

                var datos = new FormData();
                datos.append("id", id);
                datos.append("accion", "borrar");
    
                //abrir la conexion 
                xhr.open('POST', "includes/modelos/modelo-clientes.php", true);
    
                //leer la respuesta
                xhr.onload = function() {
    
                    if (this.status === 200) {
                    
                        var resultado = JSON.parse(xhr.responseText);
                    
                        if(resultado.respuesta == "correcto"){
                            
                            e.target.parentElement.parentElement.parentElement.remove();
                            
                            
                            
                        }else{
                            
                        }
                    }
                    
                }
                //enviar la peticion
                xhr.send(datos);
            }   
        }
    }

});
