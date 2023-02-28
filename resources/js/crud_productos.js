var csrf_token = document.getElementById('token').content;
const tableFiltersForm = document.getElementById('table-filters-form');
const tableDestroyForm = document.getElementById('table-destroy-form');
const productForm = document.getElementById('product-form');
const submitFormButton = document.getElementById('submit-form-button');
const resetFormButton = document.getElementById('reset-form-button');
const editRedirectForm = document.getElementById('edit-redirect-form');

function listar() {

    var resultado = document.getElementById("resultado");

    var formdata = new FormData();

    formdata.append('_token', csrf_token);

    const ajax = new XMLHttpRequest();
    ajax.open('POST', tableFiltersForm.action);
    ajax.onload = function() {
        if (ajax.status == 200) {
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
                    
                   
                    <td> <img style="width: 100px;height:100px" class='product-img' onclick=redirectToEdit(${element.id}) src="../storage/images/products/prod_${element.id}.png?x=${Math.random()}"> </td>
                  
                    <td>
                        <button type='button' class='standard-button' onclick=redirectToEdit(${element.id})>Editar</button>
                    </td>
                    <td>
                        <button type='button' class='standard-button-dark' onclick=destroyProduct('${element.id}')>Eliminar</button>
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

function destroyProduct(id) {
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

function submitProductForm() {

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

            listar()
        } else {
            console.error(ajax.status + ': ' + ajax.statusText);
        }
    }

    ajax.send(formdata);
}

function resetForm(form) {
    let inputs = form.getElementsByTagName('input');
    let textareas = form.getElementsByTagName('textarea');

    for (let i = 0; i < textareas.length; i++) {
        if (textareas[i].type != 'hidden') {
            textareas[i].value = '';
        }
    }

    for (let i = 0; i < inputs.length; i++) {
        if (inputs[i].type != 'hidden') {
            inputs[i].value = '';
        }
    }
}

function redirectToEdit(id) {
    let IDinput = document.createElement('input');
    IDinput.type = 'hidden';
    IDinput.name = 'id';
    IDinput.value = id;

    editRedirectForm.appendChild(IDinput);

    editRedirectForm.submit();
}

submitFormButton.addEventListener("click", (e) => {
    e.preventDefault();
    submitProductForm();
});

resetFormButton.addEventListener("click", (e) => {
    e.preventDefault();

    resetForm(productForm);
})

// Try to show table, will fail if on editing page
try {
    listar();
} catch (error) {

}