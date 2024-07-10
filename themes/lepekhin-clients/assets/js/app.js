(function () {
    const clientsFiltersForm = document.getElementById('clientsFiltersForm');

    if (clientsFiltersForm) {
        const sortSelect = document.getElementById('sortSelect');
        const submitFormBtn = document.querySelector('.submit-form-btn');

        const urlString = window.location.href;
        const url = new URL(urlString);
        const searchValue = url.searchParams.get('search');
        const sortValue = url.searchParams.get('sort');
        const SearchInput = document.querySelector('.search input')

        SearchInput.value = searchValue
        sortSelect.value = sortValue

        sortSelect.addEventListener('change', function () {
            clientLists(clientsFiltersForm)
        });

        submitFormBtn.addEventListener('click', function () {
            clientLists(clientsFiltersForm)
        });
    }

    function clientLists(form) {
        const xhr = new XMLHttpRequest();
        const formData = new FormData(form);

        if (formData.get('search') === '') {
            formData.delete('search');
        }

        const queryString = new URLSearchParams(formData).toString();
        const url = form.action + '?' + queryString;

        history.pushState({}, '', url);

        xhr.open('GET', url, true);
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 400) {
                const response = JSON.parse(xhr.response);
                const clientListsContent = document.getElementById('clientLists');
                clientListsContent.innerHTML = response;
            } else {
                console.error('Server returned an error:', xhr.statusText);
            }
        };

        xhr.onerror = function () {
            console.error('Request failed');
        };

        xhr.send();
    }
})();
