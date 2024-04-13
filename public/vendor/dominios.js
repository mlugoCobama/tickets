$(function() {

    let currentURL = window.location.href;
    $("#tableDominios").DataTable({
        columnDefs: [
            {
                orderable: false,
                targets: [4],
            },
            {
                orderable: false,
                targets: [4],
            }

        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json',
        },
    });
});
