@props(['title'=>$title])

@push('head')
    <link rel="stylesheet" href="{{ asset('../resources/css/header.css') }}">
@endpush

<div class="header">
    <div class="header-content-wrapper">
        <p id="header-title">{{ $title }}</p>
        <button class="standard-button" style="padding: 20px;width: fit-content;z-index: 3;margin-left:40px;height: 52px;">
            <a style="padding: 0%;" href="#tag-list">Encuentra nuestros productos</a>
        </button>
    </div>
</div>