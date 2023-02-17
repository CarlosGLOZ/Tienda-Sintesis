@push('head')
    <link rel="stylesheet" href="{{ asset('../resources/css/filters.css') }}">
    <script src="{{ asset('../resources/js/ajax/filters.js') }}" defer></script>
@endpush

<div class="search-filters" id="main-search-filters">
    <div class="filters-left">
        <div class="filter-container">
            <i class="fa-solid fa-sliders"></i>
            <p class="filter-text">Filter</p>
        </div>
        <div class="filter-container">
            <!-- Filter -->
            <p class="filter-text">Name</p>
            <input type="text" class="text-filter-input filter-name" placeholder="Search...">
        </div>
    </div>
    <div class="filters-middle"></div>
    <div class="filters-right" class="filters-button-container">
        <div class="filter-container">
            <!-- Filter -->
            <p class="filter-text">Order</p>
            <select type="text" class="select-filter-input filter-order-column" placeholder="Search...">
                <option value="name" selected>Name</option>
                <option value="price">Price</option>
            </select>
            <!-- Filter -->
            <button value="ASC" class="toggle-filter-input filter-order-direction"><i class="fa-solid fa-chevron-up"></i></button>
        </div>
    </div>
</div>

{{-- Define path for ajax to send request --}}
<script>const filtersPath = "{{ route('product.show') }}";</script>