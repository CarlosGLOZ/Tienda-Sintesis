@props([])

{{-- SIDE - NAVBAR --}}
<div id="side-navbar" class="sidenav">
    <a href="javascript:void(0)" id="closebtn" class="closebtn">&times;</a>
    @guest
        <a href="{{ route('auth.signin') }}">Sign In</a>
        <a href="{{ route('auth.signup') }}">Sign Up</a>
    @endguest
    @auth
        <a href="" class="nav-icon-link" id="nav-icon-user-link"><i class="fa-regular fa-user nav-icon" id="nav-icon-user"></i>{{ auth()->user()->name }}</a>
        <a href="{{ route('cart') }}" class="nav-icon-link" id="nav-icon-user-link"><i id="nav-icon-user" class="fa-solid fa-cart-shopping nav-icon"></i>Shopping cart</a>
        <a href="{{ route('auth.signout') }}" class="nav-icon-link" id="nav-icon-user-link"><i id="nav-icon-user" class="fa-solid fa-right-from-bracket"></i>Sign Out</a>
    @endauth
</div>
{{-- ///////////// --}}

<div id="navbar">
    <div id="navbar-left">
        <div class="nav-container">
            <a href="{{ route('home') }}" class="logo-text"><img src="{{ asset('../resources/images/logos/logo-1.png') }}" alt=""></a>
        </div>
    </div>
    <div id="navbar-right">
        @guest
            <button class="nav-button" id="nav-sign-in-button"><a href="{{ route('auth.signin') }}">Sign In</a></button>
            <button class="nav-button" id="nav-sign-up-button"><a href="{{ route('auth.signup') }}">Sign Up</a></button>
        @endguest
        @auth
            <a href="" class="nav-icon-link" id="nav-icon-user-link"><i class="fa-regular fa-user nav-icon" id="nav-icon-user"></i>{{ auth()->user()->name }}</a>
            <a href="{{ route('cart') }}" class="nav-icon-link" id="nav-icon-cart-link"><i class="fa-solid fa-cart-shopping nav-icon"></i></a>
            <button class="nav-button" id="nav-sign-up-button"><a href="{{ route('auth.signout') }}">Sign Out</a></button>
        @endauth
    </div>
    <div id="navbar-side">
        <i id="openbtn" class="fa-solid fa-bars"></i>
    </div>
</div>  

<script src="{{ asset('../resources/js/navbar.js') }}"></script>
