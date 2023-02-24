var csrf_token = document.getElementById('token').content;
const tableFiltersForm = document.getElementById('table-filters-form');
const tableDestroyForm = document.getElementById('table-destroy-form');
const productForm = document.getElementById('product-form');

reiniciar.addEventListener("click", () => {
    var form = document.getElementById('frm');
    form.reset();
})


listar()


function listar() {

    var resultado = document.getElementById("resultado");

    var formdata = new FormData();

    formdata.append('_token', csrf_token);

    const ajax = new XMLHttpRequest();
    ajax.open('POST', tableFiltersForm.action);
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
                    
                   
                    <td> <img style="width: 100px;height:100px" class='img-restaurantes' src="../storage/images/products/prod_${element.id}.png?x=${Math.random()}"> </td>
                  
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

            ajax.open("Post", tableDestroyForm.action);
            ajax.onload = function() {
                if (ajax.status === 200) {
                    console.log(ajax.response);
                    let respuesta = JSON.parse(ajax.response);
                    // Revisa si lo ha hecho en la base de datos
                    if (respuesta == "OK") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Product deleted',
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

    var formdata = new FormData(productForm);

    var ajax = new XMLHttpRequest();

    ajax.open('POST', productForm.action);
    ajax.onload = function() {
        if (ajax.status == 200) {
            AJAXResponse = JSON.parse(ajax.responseText);

            console.log(AJAXResponse);

            Swal.fire({
                icon: AJAXResponse.icon,
                title: AJAXResponse.message,
                background: 'white',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 3500
            });

            if (AJAXResponse.status == 'OK') {
                document.getElementById('registrar').value = "Registrar";
                productForm.reset();
            }

            listar()

            // if (respuesta == "OK") {
            //     Swal.fire({
            //         icon: 'success',
            //         title: 'Producto creado correctamente',
            //         background: 'black',
            //         color: 'white',
            //         showConfirmButton: false,
            //         timerProgressBar: true,
            //         timer: 3500
            //     });
            //     document.getElementById('registrar').value = "Registrar";

            //     listar('')
            //     form.reset();

            // } else if (respuesta == "Repetido") {

            //     listar('')
            //     form.reset();
            //     document.getElementById('registrar').value = "Registrar";
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Producto no creado, ya existe',
            //         showConfirmButton: false,
            //         background: 'black',
            //         color: 'white',
            //         timerProgressBar: true,

            //         timer: 3500
            //     });
            // } else if (respuesta == "vacio") {

            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Campos no rellenados',
            //         showConfirmButton: false,
            //         background: 'black',
            //         color: 'white',
            //         timerProgressBar: true,
            //         /*  */
            //         timer: 3500
            //     });
            //     document.getElementById('registrar').value = "Registrar";
            //     form.reset();

            //     listar('')
            // } else if (respuesta == "mal_formato") {
            //     Swal.fire({
            //         icon: 'error',
            //         title: 'Producto no insertado error en el formato',
            //         showConfirmButton: false,
            //         background: 'black',
            //         color: 'white',
            //         timerProgressBar: true,

            //         timer: 3500
            //     });
            //     document.getElementById('registrar').value = "Registrar";
            //     form.reset();
            //     listar('')
            // } else if (respuesta == "actualizar") {
            //     // alert(respuesta);
            //     Swal.fire({
            //         icon: 'success',
            //         title: 'Producto modificado',
            //         background: 'black',
            //         showConfirmButton: false,
            //         timer: 1500
            //     });
            //     registrar.value = "Registrar";
            //     id.value = "";
            //     listar('')
            //     form.reset();
            // } else if (respuesta == "igual") {
            //     // alert(respuesta);
            //     Swal.fire({
            //         icon: 'success',
            //         background: 'black',
            //         title: 'No ha habido ningún cambio',
            //         showConfirmButton: false,
            //         timer: 1500
            //     });
            //     registrar.value = "Registrar";
            //     id.value = "";

            //     listar('')
            //     form.reset();
            // }
        } else {
            console.error(ajax.status + ': ' + ajax.statusText);
            /* alert(ajax.responseText); */
        }
    }
    ajax.send(formdata);
});