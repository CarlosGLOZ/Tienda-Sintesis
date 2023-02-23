<div class="cajaproductos">

    <form action="" method="post" id="frm" enctype="multipart/form-data" class="formularioproductos">

        <input type="hidden" name="id" id="id" value="">
        Nombre
        <input type="text" name="nombre" id="nombre" placeholder="Inserta un nombre">
        Descripción
        <textarea type="text" id="descripcion" name="descripcion" placeholder="Inserta una descripción"></textarea>
        Precio
        <input type="text" id="precio" name="precio" placeholder="€">
        <br>
        Imagen
        <input type="file" name="img" id="img">
        <br>
        <input type="button" value="Registrar" id="registrar" class="">
        <input type="button" value="Reiniciar" id="reiniciar" class="">

    </form>



    <table>

        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>DESCRIPCIÓN</th>
                <th>PRECIO</th>
                <th>IMAGEN</th>
                <th>EDITAR</th>
                <th>ELIMINAR</th>
            </tr>
        </thead>
        <tbody id="resultado">

        </tbody>
    </table>

</div>


<script src="{{asset('crud_productos.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>