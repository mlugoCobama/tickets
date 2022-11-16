$(function() {

    let currentURL = window.location.href;
    $("#tableInventarios").DataTable();
    /**
     * Evento ver el detalle del ticket/correo
     */
     $(document).on("click", "#newInventario", function(e) {

        e.preventDefault();

        $('#tituloModal').html('Nueva Asignación');
        $('#action').addClass('saveAsignacion');
        $('#action').removeClass('updateAsignacion');

        let url = currentURL+"/create"

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal #modal-body").html(data);
        });

    });
    /**
     * Evento ver el detalle del ticket/correo
     */
     $(document).on("click", ".saveAsignacion", function(e) {
        e.preventDefault();

        let url = currentURL;
        /**
         * Formulario datos usuario
         */
        let formUsuario = $("#formUsuario").serialize();
        /**
         * Formularios Hardware
         */
        let formCPU = $("#formCPU").serialize();
        let formMonitor = $("#formMonitor").serialize();
        let formTeclado = $("#formTeclado").serialize();
        let formMouse = $("#formMouse").serialize();
        let formDiadema = $("#formDiadema").serialize();
        let formRegulador = $("#formRegulador").serialize();
        let formTelefonoFijo = $("#formTelefonoFijo").serialize();
        let formTelefonoMovil = $("#formTelefonoMovil").serialize();
        let formMultifuncional = $("#formMultifuncional").serialize();
        let formTableta = $("#formTableta").serialize();
        let formOtro = $("#formOtro").serialize();
        /**
         * Formulario Software
         */
        let formSistemaOperativo = $("#formSistemaOperativo").serialize();
        let formOffice = $("#formOffice").serialize();
        /**
         * Formulario Recursos Compartidos
         */
        let formRecursosCompartidos = $("#formRecursosCompartidos").serialize();
        let _token = $("input[name=_token]").val();


        $.post(url, {
            formUsuario: formUsuario,
            formCPU: formCPU,
            formMonitor: formMonitor,
            formTeclado: formTeclado,
            formMouse: formMouse,
            formDiadema: formDiadema,
            formRegulador: formRegulador,
            formTelefonoFijo: formTelefonoFijo,
            formTelefonoMovil: formTelefonoMovil,
            formMultifuncional: formMultifuncional,
            formTableta: formTableta,
            formOtro: formOtro,
            formSistemaOperativo: formSistemaOperativo,
            formOffice: formOffice,
            formRecursosCompartidos: formRecursosCompartidos,
            _token: _token
        }, function(data, textStatus, xhr) {
            $('#modal').modal('hide');
            $('.modal-backdrop ').css('display', 'none');
        }).done(function(data) {

            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            );
            //$(".viewInventarios").html(data);

            window.location.reload();

        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });
    /**
     * Evento ver el detalle
     */
     $(document).on("click", ".showInventario", function(e) {
        e.preventDefault();

        let id =  $("#idSeleccionado").val();
        let url = currentURL+"/"+id


        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewInventarios").html(data);
        });
    });
    /**
     * Evento para regresar
     */
     $(document).on("click", ".regresar", function(e) {
        window.location.reload();
     });
     /**
     * Evento para mostrar el formulario editar modulo
     */
      $(document).on('click', '#tableInventarios tbody tr', function(event) {
        event.preventDefault();

        let id = $(this).data("id");

        $(".deleteInventario").slideDown();
        $(".editInventario").slideDown();
        $(".showInventario").slideDown();

        $("#idSeleccionado").val(id);

        $("#tableInventarios tbody tr").removeClass('table-primary');
        $(this).addClass('table-primary');
    });
    /**
     * Evento editar
     */
     $(document).on("click", ".editInventario", function(e) {
        e.preventDefault();

        $('#tituloModal').html('Editar Asignación');
        $('#action').addClass('updateAsignacion');
        $('#action').removeClass('saveAsignacion');
        let id =  $("#idSeleccionado").val();

        let url = currentURL + "/" + id +"/edit";

        $.get(url, function(data, textStatus, jqXHR) {
            $('#modal').modal('show');
            $("#modal #modal-body").html(data);
        });
    });
    /**
     * Evento ver el detalle del ticket/correo
     */
     $(document).on("click", ".updateAsignacion", function(e) {
        e.preventDefault();

        let url = currentURL;
        let id =  $("#id_usuario").val();
        /**
         * Formulario datos usuario
         */
        let formUsuario = $("#formUsuario").serialize();
        /**
         * Formularios Hardware
         */
        let formCPU = $("#formCPU").serialize();
        let formMonitor = $("#formMonitor").serialize();
        let formTeclado = $("#formTeclado").serialize();
        let formMouse = $("#formMouse").serialize();
        let formDiadema = $("#formDiadema").serialize();
        let formRegulador = $("#formRegulador").serialize();
        let formTelefonoFijo = $("#formTelefonoFijo").serialize();
        let formTelefonoMovil = $("#formTelefonoMovil").serialize();
        let formMultifuncional = $("#formMultifuncional").serialize();
        let formTableta = $("#formTableta").serialize();
        let formOtro = $("#formOtro").serialize();
        /**
         * Formulario Software
         */
        let formSistemaOperativo = $("#formSistemaOperativo").serialize();
        let formOffice = $("#formOffice").serialize();
        /**
         * Formulario Recursos Compartidos
         */
        let formRecursosCompartidos = $("#formRecursosCompartidos").serialize();
        let _token = $("input[name=_token]").val();
        let _method = 'PUT';

        $.post(url + "/" + id, {
            formUsuario: formUsuario,
            formCPU: formCPU,
            formMonitor: formMonitor,
            formTeclado: formTeclado,
            formMouse: formMouse,
            formDiadema: formDiadema,
            formRegulador: formRegulador,
            formTelefonoFijo: formTelefonoFijo,
            formTelefonoMovil: formTelefonoMovil,
            formMultifuncional: formMultifuncional,
            formTableta: formTableta,
            formOtro: formOtro,
            formSistemaOperativo: formSistemaOperativo,
            formOffice: formOffice,
            formRecursosCompartidos: formRecursosCompartidos,
            _token: _token,
            _method:_method
        }, function(data, textStatus, xhr) {
            $('#modal').modal('hide');
            $('.modal-backdrop ').css('display', 'none');
        }).done(function(data) {

            Swal.fire(
                'Correcto!',
                'El registro ha sido guardado.',
                'success'
            );
            //$(".viewInventarios").html(data);

            window.location.reload();

        }).fail(function(data) {
            printErrorMsg(data.responseJSON.errors);
        });

    });
    /**
     * Evento para eliminar el modulo
     */
     $(document).on('click', '.deleteInventario', function(event) {
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

    $(document).on('click', '.generarResguardo', function(event) {

        let id =  $("#idSeleccionado").val();
        let url = currentURL + "/resguardo/" + id ;

        window.open(url, '_blank');

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
