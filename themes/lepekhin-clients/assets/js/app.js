(function () {
    const clientsFiltersForm = document.getElementById('clientsFiltersForm');

    if (clientsFiltersForm) {
        clientsFiltersForm.querySelector("select[name='sort']").addEventListener('change', () => clientsFiltersForm.submit())
        clientsFiltersForm.querySelector("input[name='search']").addEventListener('change', () => clientsFiltersForm.submit())
        clientsFiltersForm.querySelector("input[name='inverse']").addEventListener('change', () => clientsFiltersForm.submit())
    }
})();
