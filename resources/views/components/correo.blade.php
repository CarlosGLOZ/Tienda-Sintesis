




<div class="caja">
    <div class="formmail">
       
        <form action="{{ url('/FuncionMail') }}" method="post">
            <ion-icon name="mail-outline"></ion-icon>
            <h1>ENVIAR MAIL</h1>
            <input type="button" class="nav-button" id="todos" value="Todos">
            
            @csrf
            <input type="text" id="destinatario" name="Destinatario" placeholder="Destinatario">

            <input type="text" id="asunto" name="Asunto" placeholder="Asunto">

            <textarea name="" id="mensaje" name="Mensaje" placeholder="Mensaje"></textarea>

            <input type="submit" value="ENVIAR CORREO" id="enviar" class="enviar">
            <input type="reset" value="Borrar">
        </form>

        <div id="listarbuscador" name="listarbuscador" >

        </div>
    </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


<script src="{{asset('correo.js')}}"></script>