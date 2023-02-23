




<div class="caja">
    <div class="formmail">
        <form action="{{url('/FuncionMail')}}" method="post">
            @csrf
            <input type="text" id="destinatario" name="Destinatario" placeholder="Destinatario" multiple>

            <input type="text" id="asunto" name="Asunto" placeholder="Asunto">

            <textarea name="" id="mensaje" name="Mensaje" placeholder="Mensaje"></textarea>
            
            <input type="submit" value="ENVIAR CORREO" id="enviar">
        </form>

        <div id="listarUsuarios" name="listarUsuarios" >

        </div>
    </div>
</div>



