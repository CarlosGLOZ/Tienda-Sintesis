@extends('layouts.app')

@push('head')
    <link rel="stylesheet" href="{{ asset('../resources/css/cart.css') }}">
@endpush

@section('content')
    <div id="cart-main">
        <div id="cart-items" class="cart-wrapper-column">
            @foreach ($items as $item)
                <div class="cart-item">
                    <div class="cart-image-wrapper">
                        <img src="{{ asset('../resources/images/products/prod_'.$item->product->id.'.png') }}" class="cart-product-image">
                    </div>
                    <div class="cart-info-wrapper">
                        <div class="cart-header-wrapper">
                            <div class="cart-item-title-section">
                                <p class="cart-item-title">{{ $item->product->name }}</p>
                                <p class="cart-item-price">{{ $item->product->price }}€</p>
                            </div>
                            <div class="cart-item-button-section">
                                <button class="standard-button">Purchase</button>
                                <form action="{{ route('cart.destroy', $item->product) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="standard-button-dark">Remove</button>
                                </form>
                            </div>
                        </div>
                        <div class="cart-description-wrapper">
                            <p class="cart-item-description">{{ $item->product->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div id="cart-menu">
            <div>
                <p id="total-price-title">Total: </p>
                <p id="total-price">{{ number_format($items->sum('product.price'),2) }}€</p>
            </div>
            <div>
                <button class="standard-button">Purchase</button>
            </div>
        </div>
    </div>
@endsection