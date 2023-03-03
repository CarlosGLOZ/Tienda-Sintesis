




<div class="caja">
    <div class="formmail">
       
        <form action="{{ url('/FuncionMail') }}" method="post">
            <ion-icon name="mail-outline"></ion-icon>
            <h1>ENVIAR MAIL</h1>
            <input type="button" class="nav-button" id="todos" value="Todos">
            
            @csrf
            {{-- <input type="text" id="destinatario" name="Destinatario" placeholder="Destinatario"> --}}

            <textarea class="correos" id="destinatario" name="Destinatario" placeholder="Destinatario"></textarea>

            <input type="text" id="asunto" name="Asunto" placeholder="Asunto" >

            <textarea  id="mensaje" name="mensaje" placeholder="Mensaje"></textarea>

            <input type="submit" value="ENVIAR CORREO" id="enviar" class="enviar">
            <input type="reset" id="reiniciar" value="Borrar">
        </form>

        <div id="listarbuscador" name="listarbuscador" >

        </div>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



{{-- SWETALERTS --}}



{{-- TODO CORRECTO --}}
<?php
if (isset($_GET['email'])) {
if ($_GET['email']=='si') {
    ?>
    <script>
 Swal.fire({
                            icon: 'success',
                            title: 'EMAIL SENT SUCCESSFULLY',
                            showConfirmButton: false,
                            color: 'white',
                            timerProgressBar: true,

                            timer: 2000
                        })

    </script>
    <?php
}
}

?>



{{-- CAMPOS VACIOS --}}


<?php
if (isset($_GET['mal'])) {
if ($_GET['mal']=='va') {
    ?>
    <script>
 Swal.fire({
                            icon: 'error',
                            title: 'Something is empty',
                            showConfirmButton: false,
                            color: 'white',
                            timerProgressBar: true,

                            timer: 2000
                        })

    </script>
    <?php
}
}

?>


{{-- ALGÚN MAIL INCORRECTO --}}


<?php
if (isset($_GET['email'])) {
if ($_GET['email']=='no') {
    ?>
    <script>
 Swal.fire({
                            icon: 'error',
                            title: 'UPS',
                            text:'Something is wrong',
                            showConfirmButton: false,
                            color: 'white',
                            timerProgressBar: true,

                            timer: 2000
                        })

    </script>
    <?php
}
}

?>


<script src="{{asset('correo.js')}}"></script>