$(function() {

    let currentURL = window.location.href;
    $("#tableProveedores").DataTable({
        columnDefs: [
            {
                orderable: true,
                targets: [1,4],
            },
            {
                orderable: false,
                targets: [0,2,3],
            }

        ],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json',
        },
    });
});
