document.addEventListener("DOMContentLoaded", function () {

    eventListener();

    function eventListener() {

        //Llamados a las funciones para calcular precios del formulario.
        if (document.querySelector("#lstProducto")) {
            document.querySelector("#lstProducto").addEventListener("change", mostrarPrecioUnitario);
            document.querySelector("#lstProducto").addEventListener("change", calcularPrecioTotal);
            document.querySelector("#lstProducto").addEventListener("change", calcularStock);
        }

        if (document.querySelector("#txtCantidad")) {
            document.querySelector("#txtCantidad").addEventListener("change", calcularPrecioTotal);
        }


        //Funciones crud
        if (document.querySelector("#btnGuardar")) {
            document.querySelector("#btnGuardar").addEventListener("click", guardarVenta);
        }

        if (document.querySelector("#btnActualizar")) {
            document.querySelector("#btnActualizar").addEventListener("click", editarVenta);
        }

        if (document.querySelector(".table tbody")) {
            document.querySelector(".table tbody").addEventListener("click", eliminarVenta);
        }
    }


    //Funciones para calcular precios del formulario.

    function mostrarPrecioUnitario() {

        var indice = document.querySelector("#lstProducto").selectedIndex,
            idproducto = document.querySelector("#lstProducto").options[indice].value,
            precio = document.querySelector("#lstProducto").children[indice].getAttribute("id");

        document.querySelector("#txtPrecioU").value = "$" + precio;

    }

    function calcularPrecioTotal() {
        var precio = parseInt(document.querySelector("#txtPrecioU").value.replace("$", "")),
            cantidad = document.querySelector("#txtCantidad").value,
            preciototal = precio * cantidad;

        document.querySelector("#txtTotal").value = "$" + preciototal;

    }

    function calcularStock(e) {
        indice = e.target.selectedIndex;
        stock = e.target.children[indice].getAttribute("stock");
    }

    //Funciones crud

    function guardarVenta(e) {
        e.preventDefault();

        var fecha = document.querySelector("#txtFecha").value,
            hora = document.querySelector("#txtHora").value,
            cliente = document.querySelector("#lstCliente").value,
            producto = document.querySelector("#lstProducto").value,
            cantidad = document.querySelector("#txtCantidad").value,
            total = parseInt(document.querySelector("#txtTotal").value.replace("$", ""));


        if (fecha === "" || hora === "" || cliente === "" || producto === "" || cantidad === "") {
            //Mostrar error en caso que venga vacio
            console.log("error");
        } else if (parseInt(cantidad) > parseInt(stock)) {
            //Control de stock
            var alerta = document.querySelector("#notificacion");
            var texto = document.createTextNode("No Hay suficiente Stock");
            alerta.classList.add("alert-danger");
            alerta.appendChild(texto);

            setTimeout(function () {
                alerta.classList.remove("alert-danger");
                alerta.removeChild(texto);
            }, 3000);

        } else {
            //En caso de que todos los campos esten validados.
            //Iniciamos AJAX
            var xhr = new XMLHttpRequest();

            //FormDate
            var datos = new FormData();
            datos.append("fecha", fecha);
            datos.append("hora", hora);
            datos.append("cliente", cliente);
            datos.append("producto", producto);
            datos.append("cantidad", cantidad);
            datos.append("accion", "crear");
            datos.append("total", total);

            //Abrimos la conexion ajax
            xhr.open("POST", "includes/modelos/modelo-ventas.php", true);

            //Onload
            xhr.onload = function () {
                if (this.status === 200) {
                    var respuesta = JSON.parse(xhr.responseText);
                    console.log(respuesta);
                    if (respuesta.respuesta === "correcto") {

                        var alerta = document.querySelector("#notificacion");
                        var texto = document.createTextNode("Se registro la venta.");
                        alerta.classList.add("alert-success");
                        alerta.appendChild(texto);

                        setTimeout(function () {

                            alerta.classList.remove("alert-success");
                            alerta.removeChild(texto);
                            window.location.href = "listado-ventas.php";
                        }, 3000);

                    }

                }
            }

            //Envio de datos
            xhr.send(datos);
        }
    }

    function editarVenta(e) {
        e.preventDefault();

        var fecha = document.querySelector("#txtFecha").value,
            hora = document.querySelector("#txtHora").value,
            cliente = document.querySelector("#lstCliente").value,
            producto = document.querySelector("#lstProducto").value,
            cantidad = document.querySelector("#txtCantidad").value,
            total = parseInt(document.querySelector("#txtTotal").value.replace("$", "")),
            id = document.querySelector("input#id-venta").value;


        if (fecha === "" || hora === "" || cliente === "0" || producto === "0" || cantidad === "") {
            //Mostrar error en caso que venga vacio
            console.log("error");
        } else if (parseInt(cantidad) > parseInt(stock)) {
            //Control de stock
            var alerta = document.querySelector("#notificacion");
            var texto = document.createTextNode("No Hay suficiente Stock");
            alerta.classList.add("alert-danger");
            alerta.appendChild(texto);

            setTimeout(function () {
                alerta.classList.remove("alert-danger");
                alerta.removeChild(texto);
            }, 3000);
        } else {
            //En caso de que todos los campos esten validados.
            //Iniciamos AJAX
            var xhr = new XMLHttpRequest();

            //FormDate
            var datos = new FormData();
            datos.append("fecha", fecha);
            datos.append("hora", hora);
            datos.append("cliente", cliente);
            datos.append("producto", producto);
            datos.append("cantidad", cantidad);
            datos.append("accion", "actualizar");
            datos.append("total", total);
            datos.append("id", id);

            //Abrimos la conexion ajax
            xhr.open("POST", "includes/modelos/modelo-ventas.php", true);

            //Onload
            xhr.onload = function () {
                if (this.status === 200) {
                    var respuesta = JSON.parse(xhr.responseText);
                    console.log(respuesta);
                    if (respuesta.respuesta === "correcto") {

                        var alerta = document.querySelector("#notificacion");
                        var texto = document.createTextNode("Se editó la venta.");
                        alerta.classList.add("alert-success");
                        alerta.appendChild(texto);

                        setTimeout(function () {

                            alerta.classList.remove("alert-success");
                            alerta.removeChild(texto);
                            window.location.href = "listado-ventas.php";
                        }, 3000);

                    }
                }
            }

            //Envio de datos
            xhr.send(datos);
        }

    }

    function eliminarVenta(e) {
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
                datos.append("id", id);
                datos.append("accion", "borrar");

                //abrir la conexion 
                xhr.open('POST', "includes/modelos/modelo-ventas.php", true);

                //leer la respuesta
                xhr.onload = function () {

                    if (this.status === 200) {

                        var resultado = JSON.parse(xhr.responseText);
                        console.log(xhr.responseText);

                        if (resultado.respuesta == "correcto") {

                            e.target.parentElement.parentElement.parentElement.remove();
                            var alerta = document.querySelector("#notificacion");
                            var texto = document.createTextNode("Eliminado Correctamente.");
                            alerta.classList.add("alert-success");
                            alerta.appendChild(texto);

                            setTimeout(function () {

                                alerta.classList.remove("alert-success");
                                alerta.removeChild(texto);
                            }, 3000);
                        }
                    }

                }
                //enviar la peticion
                xhr.send(datos);
            }
        }
    }


});