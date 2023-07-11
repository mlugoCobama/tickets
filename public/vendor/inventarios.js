$(function() {

    let currentURL = window.location.href;
    $("#tableInventarios").DataTable({
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
        initComplete: function () {
            this.api()
                .columns([0,2,3])
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
     * Evento para generar reporte
     */
     $(document).on("click", "#generarReporte", function(e) {
        e.preventDefault();

        let idEmpresa =  $("#cat_empresa_id").val();
        let _token = $("input[name=_token]").val();

        if (idEmpresa != 0) {
            let urlReporte = currentURL+"/generar_reporte_filtros"

            let area = $("#cat_area_id").val();
            let puesto = $("#cat_puesto_id").val();
            let ucoip = $("#cat_ucoip_id").val();
            /*
            $.ajax({
                url: urlReporte,
                type: 'POST',
                data: {
                    _token: _token,
                    empresa_id: idEmpresa,
                    area: area,
                    puesto: puesto,
                    ucoip: ucoip
                },
                success: function(result) {
                    console.log(result);
                }
            });
            */
            //let url = currentURL+"/generar_reporte/"+idEmpresa

            //const urlObj = new URL(currentURL + "/generar_reporte_filtros/"+idEmpresa+"/'"+area+"'/'"+puesto+"'/'"+ucoip+"'")
            let url = currentURL + "/generar_reporte_filtros/"+idEmpresa+"/'"+area+"'/'"+puesto+"'/'"+ucoip+"'";
            var win = window.open( url.replace(/%20/g, " ") , '_blank');

            win.focus();

            $('#modalReporte').modal('hide');
            $('.modal-backdrop ').css('display', 'none');
        } else {
            alert("Debes seleccionar una empresa");
        }

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

    $(document).on('change', '#cat_empresa_id', function(event) {

        let idEmpresa =  $("#cat_empresa_id").val();

        if (idEmpresa != 0) {
            $(".otrosFiltros").slideDown();
            let url = currentURL+"/generar_filtros/"+idEmpresa;
            $.get(url, function(data, textStatus, jqXHR) {

                if (data.success) {
                    $("#cat_area_id").empty();
                    $("#cat_puesto_id").empty();
                    $("#cat_ucoip_id").empty();

                    let areas = data.data.areas;
                    let puestos = data.data.puestos;
                    let ucoips = data.data.ucoip;

                    $("#cat_area_id").append("<option value=' '>Selecciona una opción</option>");
                    areas.forEach(element => {
                        $("#cat_area_id").append("<option value='"+element.area+"'>"+element.area+"</option>");
                    });

                    $("#cat_puesto_id").append("<option value=' '>Selecciona una opción</option>");
                    puestos.forEach(element => {
                        $("#cat_puesto_id").append("<option value='"+element.puesto+"'>"+element.puesto+"</option>");
                    });

                    $("#cat_ucoip_id").append("<option value=' '>Selecciona una opción</option>");
                    ucoips.forEach(element => {
                        $("#cat_ucoip_id").append("<option value='"+element.ucoip+"'>"+element.ucoip+"</option>");
                    });
                }

            });
        } else {
            $(".otrosFiltros").slideUp();
        }

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
