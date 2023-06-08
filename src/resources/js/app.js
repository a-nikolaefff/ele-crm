import './bootstrap';

import './ui/sidebar';

if (document.getElementById('sortableTable')) {
    import ('./ui/sortable-table');
}

if (document.getElementById('optionSelector')) {
    import ('./ui/option-selector');
}

if (document.getElementById('searchForm')) {
    import ('./ui/search-form');
}

if (document.querySelectorAll('.accordion-arrow')) {
    import ('./ui/accordion-arrow');
}

if (document.getElementById('customerAutocomplete')) {
    import ('./pages/requests/customer-autocomplete');
}

if (document.getElementById('projectOrganizationAutocomplete')) {
    import ('./pages/requests/project-organization-autocomplete');
}

if (document.getElementById('hasProjectDepartment')) {
    import ('./pages/requests/has_project_department');
}

if (document.getElementById('receivedAtDatePicker')) {
    import ('./pages/requests/received-at-date-picker');
}

if (document.getElementById('answeredAtDatePicker')) {
    import ('./pages/requests/answered-at-date-picker');
}

if (document.getElementById('expectedOrderDatePicker')) {
    import ('./pages/requests/expected-order-date-picker');
}



