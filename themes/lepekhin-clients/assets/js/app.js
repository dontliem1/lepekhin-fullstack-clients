(function () {
    const clientsFiltersForm = document.getElementById('clientsFiltersForm');

    if (clientsFiltersForm) {
        /* Optional TODO: change list without refresh */

        let searchInput = document.querySelector("[name='search']");
        searchInput.addEventListener('input', function () {
            getClients('search', searchInput.value)
        });

        let sortSelect = document.querySelector("[name='sort']");
        sortSelect.addEventListener('change', function () {
            getClients('sort', sortSelect.value)
        });

        let inverseCheckbox = document.querySelector("[name='inverse']");
        inverseCheckbox.addEventListener('change', function () {
            getClients('inverse', inverseCheckbox.checked ? 'on' : '')
        });
    }

    function getClients(key, value) {
        let url = new URL(window.location.href);
        if (value === '') {
            url.searchParams.delete(key)
        } else {
            url.searchParams.set(key, value)
        }

        history.pushState({}, '', url);

        const xhr = new XMLHttpRequest();
        xhr.open('GET', url.href)
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
        xhr.send();

        xhr.onload = function() {
            if (xhr.status !== 200) {
                console.error(`${xhr.status}: ${xhr.statusText}`);
            } else {
                const clientsList = document.getElementById('clientsList');
                if (clientsList) {
                    clientsList.innerHTML = JSON.parse(xhr.response);
                }
            }
        };

        xhr.onerror = function() {
            console.error(`Error`);
        };
    }
})();
