@extends('layouts.app')

@section('content')
    <x-header :title="'Shop'" />
    <x-search_filters />
    <x-product_showcase />
@endsection