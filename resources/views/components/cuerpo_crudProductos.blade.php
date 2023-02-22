




<form action="" method="post" id="frm" enctype="multipart/form-data">

    <input type="hidden" name="id" id="id" value="">
    Nombre
<input type="text" name="nombre" id="nombre">
Descripcion
<textarea type="text" id="descripcion" name="descripcion"></textarea>
Precio
<input type="text" id="precio" name="precio">
<br>
Imagen 
<input type="file" name="img" id="img">
<br>
<input type="button" value="Registrar" id="registrar" class="">
<input type="button" value="Reiniciar" id="reiniciar" class="">

</form>


<div >

<table >

    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th>Editar</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody id="resultado">

    </tbody>
</table>


</div>



<script src="{{asset('crud_productos.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>