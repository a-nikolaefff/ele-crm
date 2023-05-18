// Get links to table headers
const tableHeaders = document.querySelectorAll('#sortableTable th a');

// Add a click handler to each link
tableHeaders.forEach(header => {
    header.addEventListener('click', event => {
        event.preventDefault();

        // Get the current page URL
        const url = window.location.href;

        // Get the GET request parameters from the current URL
        const urlParams = new URLSearchParams(window.location.search);

        // Get the name of the column to sort by
        const columnName = header.getAttribute('href').split('sort=')[1].split('&')[0];

        // Check if the sort direction needs to be reversed
        let direction = 'asc';
        if (urlParams.get('sort') === columnName && urlParams.get('direction') === 'asc') {
            direction = 'desc';
        }

        // Update page URL with new sort options
        window.location.href = url.split('?')[0] + `?sort=${columnName}&direction=${direction}`;
    });
});
