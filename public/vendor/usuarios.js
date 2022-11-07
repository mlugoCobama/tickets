$(function() {

    let currentURL = window.location.href;
    $("#tableUsuarios").DataTable();

    /**
     * Evento ver el detalle del ticket/correo
     */
     $(document).on("click", "#newUser", function(e) {

        e.preventDefault();

        $('#tituloModal').html('Nuevo Usuario');
        $('#action').addClass('saveUsuario');
        $('#action').removeClass('updateUsuario');

        let url = currentURL+"/0"

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal #modal-body").html(data);
        });

    });
    /**
     * Evento ver el detalle del ticket/correo
     */
     $(document).on("click", ".editUsuario", function(e) {

        e.preventDefault();

        $('#tituloModal').html('Editar Usuario');
        $('#action').removeClass('saveUsuario');
        $('#action').addClass('updateUsuario');

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/" + id;

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal #modal-body").html(data);
        });

    });
    /**
     * Evento ver el detalle del ticket/correo
     */
     $(document).on("click", ".saveUsuario", function(e) {
        e.preventDefault();

        let url = currentURL;

        let tipo = $("#tipo").val();
        let nombre = $("#nombre").val();
        let correo = $("#correo").val();
        let password1 = $("#password1").val();
        let password2 = $("#password2").val();
        let _token = $("input[name=_token]").val();

        $.post(url, {
            tipo: tipo,
            nombre: nombre,
            correo: correo,
            password: password1,
            password_confirmation: password2,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('#modal').modal('hide');
            $('.modal-backdrop ').css('display', 'none');
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
     * Evento ver el detalle del ticket/correo
     */
     $(document).on("click", ".updateUsuario", function(e) {
        e.preventDefault();

        let id = $("#idSeleccionado").val();

        let url = currentURL + "/" + id;

        let tipo = $("#tipo").val();
        let nombre = $("#nombre").val();
        let correo = $("#correo").val();
        let password1 = $("#password1").val();
        let password2 = $("#password2").val();
        let _token = $("input[name=_token]").val();
        let _method = 'PUT';

        $.post(url, {
            tipo: tipo,
            nombre: nombre,
            correo: correo,
            password: password1,
            password_confirmation: password2,
            _token: _token,
            _method: _method,
        }, function(data, textStatus, xhr) {
            $('#modal').modal('hide');
            $('.modal-backdrop ').css('display', 'none');
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
     * Evento para mostrar el formulario editar modulo
     */
     $(document).on('click', '#tableUsuarios tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");
        $(".editUsuario").slideDown();
        $(".deleteUsuario").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableUsuarios tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento para eliminar el modulo
     */
     $(document).on('click', '.deleteUsuario', function(event) {
        event.preventDefault();
        Swal.fire({
            title: '¿Estas seguro?',
            text: "Deseas eliminar el registro seleccionado!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                let id = $("#idSeleccionado").val();
                let _token = $("input[name=_token]").val();
                let _method = "DELETE";
                let url = currentURL + "/" + id;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        _token: _token,
                        _method: _method
                    },
                    success: function(result) {

                        Swal.fire(
                            'Eliminado!',
                            'El registro ha sido eliminado.',
                            'success'
                        );

                        window.location.reload();
                    }
                });
            }
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

});
