var csrf_token = document.getElementById('token').content;


destinatario.addEventListener("keyup", () => {

    var buscar = destinatario.value;





    var listarbuscador = document.getElementById("listarbuscador");
    var formdata = new FormData();
    formdata.append('_token', csrf_token);

    if (buscar.includes(",")) {
        let arrayValores = buscar.split(",");
        let ultimoValor = arrayValores[arrayValores.length - 1];
        formdata.append('buscar', ultimoValor);
    } else {
        formdata.append('buscar', buscar);
    }


    const ajax = new XMLHttpRequest();
    ajax.open('POST', 'listarCorreos');


    ajax.onload = function() {
        if (ajax.status == 200) {
            /* alert(ajax.responseText); */
            // console.log(ajax.responseText);
            let productos = JSON.parse(ajax.responseText);
            // console.log(productos.length);
            let box = '';




            if (productos.length == 0) {
                box += `
                <div class="element-busc">
                    <p>No se ha encontrado ningun correo</p>
                </div>`;
            } else {

                productos.forEach(element => {
                    /* console.log(element.id) */

                    box += `
                        <div class="element-busc">
                        <br>
                            <p name='p-buscador' class='p-buscador'>${element.email}, </p>
                            
                        </div>`;
                });
            }
            if (buscar == '') {
                listarbuscador.style.display = 'none';
            } else {
                listarbuscador.style.display = 'flex';
            }

            listarbuscador.innerHTML = box;
            var arraybuscador = document.getElementsByName('p-buscador');

            for (let i = 0; i < arraybuscador.length; i++) {
                arraybuscador[i].addEventListener('click', ponerValueEnBuscador);

            }

        } else {
            /* listarbuscador.innerText = 'Error'; */
        }
    }
    ajax.send(formdata);


})




function ponerValueEnBuscador(evt) {
    /* console.log(evt.target.textContent); */

    destinatario.value += evt.target.textContent;
    listarbuscador.style.display = 'none';
}



todos.addEventListener("click", () => {


    destinatario.value = "Todos los usuarios"

})