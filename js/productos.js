document.addEventListener("DOMContentLoaded", function () {

    //Retornar el option guardado cuando se quiere editar la venta
    if (document.querySelector("#tipoproducto_seleccionado") && document.querySelector("#tipoproducto_seleccionado").value != ""){
        var i = 0;
        while(i < document.querySelector("#txtTipoProducto").length){

            var valor_option =  document.querySelector("#txtTipoProducto").options[i].value,
                valor_retornadoBD = document.querySelector("#tipoproducto_seleccionado").value;
            
            if(valor_option === valor_retornadoBD){
                document.querySelector("#txtTipoProducto").children[0].removeAttribute("selected");
                document.querySelector("#txtTipoProducto").children[i].setAttribute("selected", "");
            }
            
            i++;
        }
    }

    eventListener();

    function eventListener() {

        //Llamado a funciones tipo producto
        if (document.querySelector("#btnGuardarTP")) {
            document.querySelector("#btnGuardarTP").addEventListener("click", guardarTipoProducto);
        }

        if (document.querySelector("#btnActualizarTP")) {
            document.querySelector("#btnActualizarTP").addEventListener("click", editarTipoProducto);
        }

        if (document.querySelector(".tablaTP tbody")) {
            document.querySelector(".tablaTP tbody").addEventListener("click", eliminarTipoProducto);
        }

        //Llamado a funciones productos

        if (document.querySelector("#btnGuardarP")) {
            document.querySelector("#btnGuardarP").addEventListener("click", guardarProducto);
        }

        if (document.querySelector("#btnActualizarP")) {
            document.querySelector("#btnActualizarP").addEventListener("click", editarProducto);
        }

        if (document.querySelector(".tablaP tbody")) {
            document.querySelector(".tablaP tbody").addEventListener("click", eliminarProducto);
        }


    }

    //Tipos de productos

    function guardarTipoProducto(e) {
        e.preventDefault();

        var nombre = document.querySelector("#txtNombre").value;

        if (nombre === "") {
            //Mostrar error en caso que venga vacio
            console.log("error");
        } else {
            //En caso de que todos los campos esten validados.
            //Iniciamos AJAX
            var xhr = new XMLHttpRequest();

            //FormDate
            var datos = new FormData();
            datos.append("nombre_tp", nombre);
            datos.append("accion", "crearTP");

            //Abrimos la conexion ajax
            xhr.open("POST", "includes/modelos/modelo-productos.php", true);

            //Onload
            xhr.onload = function () {
                if (this.status === 200) {
                    var respuesta = JSON.parse(xhr.responseText);

                    if (respuesta.respuesta === "correcto") {

                        var alerta = document.querySelector("#notificacion");
                        var texto = document.createTextNode("Creado Correctamente.");
                        alerta.classList.add("alert-success");
                        alerta.appendChild(texto);

                        setTimeout(function () {

                            alerta.classList.remove("alert-success");
                            alerta.removeChild(texto);
                            window.location.href = "tipos-productos.php";
                        }, 2000);
                    }
                }
            }
            //Envio de datos
            xhr.send(datos);
        }
    }

    function editarTipoProducto(e) {
        e.preventDefault();

        var nombre = document.querySelector("#txtNombre").value,
            id = document.querySelector("input#id-tipo-producto").value;


        if (nombre === "") {
            //Mostrar error en caso que venga vacio
            console.log("error");
        } else {
            //En caso de que todos los campos esten validados.
            //Iniciamos AJAX
            var xhr = new XMLHttpRequest();

            //FormDate
            var datos = new FormData();
            datos.append("nombre_tp", nombre);
            datos.append("accion", "actualizarTP");
            datos.append("id_tp", id);

            //Abrimos la conexion ajax
            xhr.open("POST", "includes/modelos/modelo-productos.php", true);

            //Onload
            xhr.onload = function () {
                if (this.status === 200) {
                    var respuesta = JSON.parse(xhr.responseText);

                    if (respuesta.respuesta === "correcto") {
                        var alerta = document.querySelector("#notificacion");
                        var texto = document.createTextNode("Editado Correctamente.");
                        alerta.classList.add("alert-success");
                        alerta.appendChild(texto);

                        setTimeout(function () {

                            alerta.classList.remove("alert-success");
                            alerta.removeChild(texto);
                            window.location.href = "tipos-productos.php";
                        }, 2000);

                    }
                }
            }

            //Envio de datos
            xhr.send(datos);
        }
    }

    function eliminarTipoProducto(e) {
        if (e.target.parentElement.classList.contains('btn-borrar')) {


            //tomar el id
            var id = e.target.parentElement.getAttribute('data-id');


            //preguntar al usuario
            const respuesta = confirm('¿Estas seguro?');

            if (respuesta) {
                //llamado a ajax
                //crear el objeto
                const xhr = new XMLHttpRequest();

                var datos = new FormData();
                datos.append("id_tp", id);
                datos.append("accion", "borrarTP");

                //abrir la conexion 
                xhr.open('POST', "includes/modelos/modelo-productos.php", true);

                //leer la respuesta
                xhr.onload = function () {

                    if (this.status === 200) {

                        var resultado = JSON.parse(xhr.responseText);

                        if (resultado.respuesta == "correcto") {

                            e.target.parentElement.parentElement.parentElement.remove();
                            var alerta = document.querySelector("#notificacion");
                            var texto = document.createTextNode("Eliminado Correctamente.");
                            alerta.classList.add("alert-success");
                            alerta.appendChild(texto);

                            setTimeout(function () {

                                alerta.classList.remove("alert-success");
                                alerta.removeChild(texto);
                            }, 2000);
                        }
                    }

                }
                //enviar la peticion
                xhr.send(datos);
            }
        }
    }

    //Productos

    function guardarProducto(e) {
        e.preventDefault();

        var nombre = document.querySelector("#txtNombre").value,
            tipo_producto = document.querySelector("#txtTipoProducto").value,
            cantidad = document.querySelector("#txtCantidad").value,
            precio = document.querySelector("#txtPrecio").value,
            descripcion = document.querySelector("#txtDescripcion").value;

        if (nombre === "" || cantidad === "" || descripcion === "" || precio === "" || tipo_producto === "") {
            //Mostrar error en caso que venga vacio
            console.log("error");
        } else {
            //En caso de que todos los campos esten validados.
            //Iniciamos AJAX
            var xhr = new XMLHttpRequest();

            //FormDate
            var datos = new FormData();
            datos.append("nombreProducto", nombre);
            datos.append("tipo_producto", tipo_producto);
            datos.append("cantidad", cantidad);
            datos.append("precio", precio);
            datos.append("descripcion", descripcion);
            datos.append("accion", "crearP");

            //Abrimos la conexion ajax
            xhr.open("POST", "includes/modelos/modelo-productos.php", true);

            //Onload
            xhr.onload = function () {
                if (this.status === 200) {
                    var respuesta = JSON.parse(xhr.responseText);
                    if (respuesta.respuesta === "correcto") {

                        var alerta = document.querySelector("#notificacion");
                        var texto = document.createTextNode("Producto creado Correctamente.");
                        alerta.classList.add("alert-success");
                        alerta.appendChild(texto);

                        setTimeout(function () {

                            alerta.classList.remove("alert-success");
                            alerta.removeChild(texto);
                            window.location.href = "listado-productos.php";
                        }, 2000);
                    }

                }
            }

            //Envio de datos
            xhr.send(datos);
        }
    }

    function editarProducto(e) {
        e.preventDefault();

        var nombre = document.querySelector("#txtNombre").value,
            tipo_producto = document.querySelector("#txtTipoProducto").value,
            cantidad = document.querySelector("#txtCantidad").value,
            precio = document.querySelector("#txtPrecio").value,
            descripcion = document.querySelector("#txtDescripcion").value,
            id = document.querySelector("input#id-producto").value;

        if (nombre === "" || cantidad === "" || descripcion === "" || precio === "" || tipo_producto === "") {
            //Mostrar error en caso que venga vacio
            console.log("error");
        } else {
            //En caso de que todos los campos esten validados.
            //Iniciamos AJAX
            var xhr = new XMLHttpRequest();

            //FormDate
            var datos = new FormData();
            datos.append("nombreProducto", nombre);
            datos.append("tipo_producto", tipo_producto);
            datos.append("cantidad", cantidad);
            datos.append("precio", precio);
            datos.append("descripcion", descripcion);
            datos.append("accion", "actualizarP");
            datos.append("id_producto", id);

            //Abrimos la conexion ajax
            xhr.open("POST", "includes/modelos/modelo-productos.php", true);

            //Onload
            xhr.onload = function () {
                if (this.status === 200) {
                    var respuesta = JSON.parse(xhr.responseText);
                    //console.log(respuesta);
                    if (respuesta.respuesta === "correcto") {

                        var alerta = document.querySelector("#notificacion");
                        var texto = document.createTextNode("Producto editado Correctamente.");
                        alerta.classList.add("alert-success");
                        alerta.appendChild(texto);

                        setTimeout(function () {

                            alerta.classList.remove("alert-success");
                            alerta.removeChild(texto);
                            window.location.href = "listado-productos.php";
                        }, 2000);

                    }

                }
            }

            //Envio de datos
            xhr.send(datos);
        }
    }

    function eliminarProducto(e) {
        if (e.target.parentElement.classList.contains('btn-borrar')) {


            //tomar el id
            var id = e.target.parentElement.getAttribute('data-id');


            //preguntar al usuario
            const respuesta = confirm('¿Estas seguro?');

            if (respuesta) {
                //llamado a ajax
                //crear el objeto
                const xhr = new XMLHttpRequest();

                var datos = new FormData();
                datos.append("id_producto", id);
                datos.append("accion", "borrarP");

                //abrir la conexion 
                xhr.open('POST', "includes/modelos/modelo-productos.php", true);

                //leer la respuesta
                xhr.onload = function () {

                    if (this.status === 200) {

                        var resultado = JSON.parse(xhr.responseText);

                        if (resultado.respuesta == "correcto") {

                            e.target.parentElement.parentElement.parentElement.remove();
                            var alerta = document.querySelector("#notificacion");
                            var texto = document.createTextNode("Eliminado Correctamente.");
                            alerta.classList.add("alert-success");
                            alerta.appendChild(texto);

                            setTimeout(function () {

                                alerta.classList.remove("alert-success");
                                alerta.removeChild(texto);
                            }, 2000);
                        }
                    }

                }
                //enviar la peticion
                xhr.send(datos);
            }
        }


    }

});