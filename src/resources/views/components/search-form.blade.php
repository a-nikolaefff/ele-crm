<form id="searchForm" method="GET" role="search" autocomplete="off">

    <div class="search-form input-group">
        <input id="searchInput" name="search" class="form-control" type="search"
               placeholder="{{ $placeholder }}"
               aria-label="Search" @if(isset($value)) value="{{ $value }}" @endif>

        <button id="resetButton" class="search-form__reset-button btn btn-outline-danger" type="button">
            <i class='bx bx-x-circle bx-sm'></i>
        </button>

        <button class="search-form__search-button btn btn-outline-success" type="submit">
            <i class='bx bx-search bx-sm'></i>
        </button>
    </div>
</form>
