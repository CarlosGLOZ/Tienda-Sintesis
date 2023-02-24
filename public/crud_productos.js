var csrf_token = document.getElementById('token').content;



reiniciar.addEventListener("click", () => {
    var form = document.getElementById('frm');
    form.reset();
})


listar('')





function listar() {

    var resultado = document.getElementById("resultado");

    var formdata = new FormData();

    formdata.append('_token', csrf_token);

    const ajax = new XMLHttpRequest();
    ajax.open('POST', 'listar_crud_pro');
    ajax.onload = function() {
        if (ajax.status == 200) {
            console.log('Todo ha ido bien')
            let productos = JSON.parse(ajax.responseText);
            let box = '';
            if (productos == "") {
                resultado.innerHTML = "<p style='margin-top:10px;'>No se han encontrado productos</p> "
            } else {
                productos.forEach(element => {

                        box += `<tr >
                    <td>${element.id} </td>
                    <td>${element.name} </td>
                    <td>${element.description} </td>
                    <td>${element.price} €</td>
                    
                   
                    <td> <img style="width: 100px;height:100px" class='img-restaurantes' src="storage/productos/${element.id}.jpg?x=${Math.random()}"> </td>
                  
                    <td>
                        <button type='button' class='btn btn-success' onclick=Editar('${element.id}')>Editar</button>
                    </td>
                    <td>
                        <button type='button' class='btn btn-danger' onclick=Eliminar('${element.id}')>Eliminar</button>
                    </td>
                </tr>`;



                    }


                );
                resultado.innerHTML = box;
            }


        } else {
            resultado.innerText = 'Error';
        }
    }
    ajax.send(formdata);
}








function Eliminar(id) {
    Swal.fire({
        title: '¿Quiere eliminar este producto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3894a3',
        cancelButtonColor: '#2f414F',
        confirmButtonText: 'Si',
        background: 'black',
        color: 'white',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            var formdata = new FormData();

            // Lo ponemos por que lo enviamos por el metodo POST
            formdata.append('_token', csrf_token);
            formdata.append('_method', 'delete');

            // Este es el ID que enviamos el controller 
            formdata.append('id', id);

            var ajax = new XMLHttpRequest();
            // Lo envia al metodo eliminar

            ajax.open("Post", "eliminarProducto");
            ajax.onload = function() {
                if (ajax.status === 200) {
                    let respuesta = JSON.parse(ajax.responseText);
                    // Revisa si lo ha hecho en la base de datos
                    if (respuesta == "OK") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Eliminado',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        listar('')
                    } else {
                        alert(respuesta.Resultado);
                    }
                }
            };
            ajax.send(formdata);
        }
    })
}





function Editar(id) {

    var formdata = new FormData();
    formdata.append('_token', csrf_token);
    formdata.append('id', id);

    var ajax = new XMLHttpRequest();
    ajax.open('POST', 'editarProducto');
    ajax.onload = function() {
        if (ajax.status == 200)
        // ajax.responseText = Son los valores del producto que hemos clicado y se muestra en el indice.blade.php
        {
            var json = JSON.parse(ajax.responseText);
            // Metemos en los campos del formulario los valores del producto
            // document.getElementById('titulo-reg').innerText = 'Actualizar Productos';
            document.getElementById('id').value = json.id;
            document.getElementById('nombre').value = json.name;
            document.getElementById('descripcion').value = json.description;
            document.getElementById('precio').value = json.price;

            document.getElementById('registrar').value = "Actualizar"
        }
    }
    ajax.send(formdata);
}




registrar.addEventListener("click", () => {




    var form = document.getElementById('frm');

    var formdata = new FormData(form);
    formdata.append('_token', csrf_token);


    var ajax = new XMLHttpRequest();

    ajax.open('POST', 'crearProducto');
    ajax.onload = function() {


        if (ajax.status == 200) {

            respuesta = JSON.parse(ajax.responseText);
            /* alert(respuesta); */

            if (respuesta == "OK") {
                Swal.fire({
                    icon: 'success',
                    title: 'Producto creado correctamente',
                    background: 'black',
                    color: 'white',
                    showConfirmButton: false,
                    timerProgressBar: true,
                    timer: 3500
                });
                document.getElementById('registrar').value = "Registrar";

                listar('')
                form.reset();

            } else if (respuesta == "Repetido") {

                listar('')
                form.reset();
                document.getElementById('registrar').value = "Registrar";
                Swal.fire({
                    icon: 'error',
                    title: 'Producto no creado, ya existe',
                    showConfirmButton: false,
                    background: 'black',
                    color: 'white',
                    timerProgressBar: true,

                    timer: 3500
                });
            } else if (respuesta == "vacio") {

                Swal.fire({
                    icon: 'error',
                    title: 'Campos no rellenados',
                    showConfirmButton: false,
                    background: 'black',
                    color: 'white',
                    timerProgressBar: true,
                    /*  */
                    timer: 3500
                });
                document.getElementById('registrar').value = "Registrar";
                form.reset();

                listar('')
            } else if (respuesta == "mal_formato") {
                Swal.fire({
                    icon: 'error',
                    title: 'Producto no insertado error en el formato',
                    showConfirmButton: false,
                    background: 'black',
                    color: 'white',
                    timerProgressBar: true,

                    timer: 3500
                });
                document.getElementById('registrar').value = "Registrar";
                form.reset();
                listar('')
            } else if (respuesta == "actualizar") {
                // alert(respuesta);
                Swal.fire({
                    icon: 'success',
                    title: 'Producto modificado',
                    background: 'black',
                    showConfirmButton: false,
                    timer: 1500
                });
                registrar.value = "Registrar";
                id.value = "";
                listar('')
                form.reset();
            } else if (respuesta == "igual") {
                // alert(respuesta);
                Swal.fire({
                    icon: 'success',
                    background: 'black',
                    title: 'No ha habido ningún cambio',
                    showConfirmButton: false,
                    timer: 1500
                });
                registrar.value = "Registrar";
                id.value = "";

                listar('')
                form.reset();
            }
        } else {
            console.error(ajax.status + ': ' + ajax.statusText);
            /* alert(ajax.responseText); */
        }
    }
    ajax.send(formdata);


});