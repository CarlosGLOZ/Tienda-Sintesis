@extends('layouts.app')

@push('head')
    <script src="{{asset('../resources/js/crud_productos.js')}}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10" defer></script>
    <link rel="stylesheet" href="{{asset('../resources/css/crud.css')}}">
@endpush

@section('content')

    {{-- If a product is passed, show the edit form, else, show the create form --}}
    @if (isset($product))
        <button class="standard-button"><a href="{{ route('product.find', $product->id) }}">Product page</a></button>
        <form action="{{ route('product.update') }}" method="post" id="product-form" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" id="id" value="{{ $product->id }}">
            Nombre
            <input type="text" name="name" id="name" value="{{ $product->name }}">
            Descripcion
            <textarea type="text" id="descripcion" name="description">{{ $product->description }}</textarea>
            Precio
            <input type="text" id="precio" name="price" value="{{ $product->price }}">
            <br>
            Imagen 
            <input type="file" name="img" id="img">
            <br>
            <button type="submit" id="submit-form-button" class="standard-button">Save</button>
            <button type="reset" id="reset-form-button" class="standard-button-dark">Reset</button>
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
            <button type="submit" id="submit-form-button" class="standard-button">Create</button>
            <button type="reset" id="reset-form-button" class="standard-button-dark">Reset</button>
        </form>
    

        <div>
            <form action="{{ route('product.table') }}" method="post" id="table-filters-form"></form>
            <form action="{{ route('product.destroy') }}" method="post" id="table-destroy-form"></form>
            <form action="{{ route('product.edit') }}" method="post" id="edit-redirect-form">@csrf</form>

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

    @endif

@endsection