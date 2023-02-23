@props(['title'=>$title])

@push('head')
    <link rel="stylesheet" href="{{ asset('../resources/css/header.css') }}">
@endpush

<div class="header">
    <div class="header-content-wrapper">
        <p id="header-title">{{ $title }}</p>
        <a href="#tag-list"><button>Encuentra nuestros productos</button></a>
    </div>
</div>