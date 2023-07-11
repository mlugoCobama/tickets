$

    let currentURL = window.location.href;
    $("table.display").DataTable({
        columnDefs: [
            { type: 'date-euro', targets: 4 },
        ],
        responsive: true,
        scrollX: true,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/es-MX.json',
        },
        initComplete: function () {
            this.api()
                .columns([6,7])
                .every(function () {
                    var column = this;
                    var select = $('<select><option value="">Selecciona una opción</option></select>')
                        .appendTo($(column.header()).empty())
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                });
        },
    });
    /**
     * Evento ver el detalle del ticket/correo
     */
    $(document).on("click", ".verDetalle", function(e) {
        e.preventDefault();

        let id = $(this).data("id");
        let url = currentURL+"/"+id


        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewDetail").html(data);
            $(".viewTickets").slideUp();
            $(".viewDetail").slideDown();
        });
    });
    /**
     * Evento para regresar
     */
     $(document).on("click", "#return", function(e) {
         $(".viewTickets").slideDown();
         $(".viewDetail").slideUp();
         $(".viewDetail").html('');
     });
     /**
      * Evento para guardar el seguimiento
      */
      $(document).on("click", "#save", function(e) {

        let url = currentURL;

        let cat_empresa_id = $("#cat_empresa_id").val();
        let asignadoA = $("#asignadoA").val();
        let asignadoPor = $("#asignadoPor").val();
        let area = $("#area").val();
        let estatus = $("#estatus").val();
        let comentario = $("#comentario").val();
        let correoId = $("#correoId").val();
        let _token = $("input[name=_token]").val();

        $.post(url, {
            cat_empresa_id: cat_empresa_id,
            asignadoA: asignadoA,
            asignadoPor: asignadoPor,
            area: area,
            estatus: estatus,
            comentario: comentario,
            correoId:correoId,
            _token: _token
        }, function(data, textStatus, xhr) {
            //$('.viewTickets').html(data);
            $(".viewTickets").slideDown();
            $(".viewDetail").slideUp();
            $(".viewDetail").html('');


        }).done(function() {

            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            );

            window.location.reload();

        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });
    /**
      * Evento para actualizar el seguimiento
      */
     $(document).on("click", "#update", function(e) {

        let url = currentURL;

        let reasignar = false;

        if( $('#reasingar').prop('checked') ) {
            reasignar = true;
        } else {
            reasignar = false;
        }

        let cat_empresa_id = $("#cat_empresa_id").val();
        let estatus = $("#estatus").val();
        let comentario = $("#comentario").val();
        let ticket_id = $("#ticket_id").val();
        let _token = $("input[name=_token]").val();
        let area = $("#area").val();
        let asignadoA = $("#asignadoA").val();
        let _method = 'PUT';

        $.post(url+'/'+ticket_id, {
            cat_empresa_id: cat_empresa_id,
            estatus: estatus,
            comentario: comentario,
            ticket_id:ticket_id,
            reasignar:reasignar,
            area: area,
            asignadoA:asignadoA,
            _token: _token,
            _method:_method
        }, function(data, textStatus, xhr) {
            $('.viewTickets').html(data);
            $(".viewTickets").slideDown();
            $(".viewDetail").slideUp();
            $(".viewDetail").html('');
        }).done(function() {
            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            )
            window.location.reload();
        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });
    /**
     * Funcion para mostrar los errores de los formularios
     */
     function printErrorMsg(msg) {
        $(".print-error-msg").find("ul").html('');
        $(".print-error-msg").css('display', 'block');
        $(".form-control").removeClass('is-invalid');
        for (var clave in msg) {
            $("#" + clave).addClass('is-invalid');
            if (msg.hasOwnProperty(clave)) {
                $(".print-error-msg").find("ul").append('<li>' + msg[clave][0] + '</li>');
            }
        }
    }
    /**
     * Evento para habilitar inputs al reasignar ticket
     */
    $(document).on("click", "#reasingar", function(e) {
        if( $('#reasingar').prop('checked') ) {
            $("#area").attr('disabled', false);
            $("#area").attr('readonly', false);
            $("#asignadoA").attr('disabled', false);
            $("#asignadoA").attr('readonly', false);
        } else {
            $("#area").attr('disabled', true);
            $("#area").attr('readonly', true);
            $("#asignadoA").attr('disabled', true);
            $("#asignadoA").attr('readonly', true);
        }
    });

});
