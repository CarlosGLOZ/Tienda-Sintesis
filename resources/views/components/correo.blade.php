






<form action="{{url('/FuncionMail')}}" method="post">


    @csrf

    <input type="text" id="Destinatario" name="Destinatario" placeholder="Destinatario">

    <input type="text" id="Asunto" name="Asunto" placeholder="Asunto">

    <input type="text" id="Mensaje" name="Mensaje" placeholder="Mensaje">

    <input type="submit" value="ENVIAR CORREO">


</form>


