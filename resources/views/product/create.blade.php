@extends('layouts.app')

@push('head')
    <script src="{{asset('crud_productos.js')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
@endpush

@section('content')

    {{-- If a product is passed, show the edit form, else, show the create form --}}
    @if (isset($product))
        <form action="{{ route('product.update') }}" method="post" id="product-form" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" value="{{ $product->id }}">
            Nombre
            <input type="text" name="name" id="nombre" value="{{ $product->name }}">
            Descripcion
            <textarea type="text" id="descripcion" name="descripcion">{{ $product->description }}</textarea>
            Precio
            <input type="text" id="precio" name="precio" value="{{ $product->price }}">
            <br>
            Imagen 
            <input type="file" name="img" id="img">
            <br>
            <input type="button" value="Registrar" id="registrar" class="standard-button">
            <input type="button" value="Reiniciar" id="reiniciar" class="standard-button-dark">
        </form>
    @else
        <form action="{{ route('product.store') }}" method="post" id="product-form" enctype="multipart/form-data">
            @csrf
            Nombre
            <input type="text" name="name" id="nombre">
            Descripcion
            <textarea type="text" id="descripcion" name="description"></textarea>
            Precio
            <input type="text" id="precio" name="price">
            <br>
            Imagen 
            <input type="file" name="img" id="img">
            <br>
            <input type="button" value="Registrar" id="registrar" class="standard-button">
            <input type="button" value="Reiniciar" id="reiniciar" class="standard-button-dark">
        </form>
    @endif
    

    <div>
        <form action="{{ route('product.table') }}" method="post" id="table-filters-form"></form>
        <form action="{{ route('product.destroy') }}" method="post" id="table-destroy-form"></form>

        <table>
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
            <tbody id="resultado" class="animate__animated animate__fadeIn">

            </tbody>
        </table>
    </div>

@endsection