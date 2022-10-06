$(document).ready(function () {
    $('#guardar-registro').on('submit', function (e) {
        e.preventDefault();

        var datos = $(this).serialize();

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            dataType: 'html',
            success: function (data) {
                var obj = JSON.parse(data);
                console.log(obj);
                var respuesta = obj['respuesta'];
                if (respuesta === 'correcto') {
                        swal({type: "success",
                            title: "Guardado",
                            text: "Registro Guardado Correctamente!"
                        }).then(function() {
                            href = "lista-"+obj['tipo']+".php"
                            window.location.href = href ;
                        });
                } else {
                    swal(
                        'Error...',
                        'Hubo un error al enviar su información!',
                        'error'
                    )
                }
            }
        });
    });

    $('#guardar-registro-archivo').on('submit', function (e) {
        e.preventDefault();

        // para enviar el multipart/form-data
        var datos = new FormData(this);

        $.ajax({
            type: $(this).attr('method'),
            data: datos,
            url: $(this).attr('action'),
            // tipo de datos jsn
            dataType: 'html',
            /* When Ajax*/
            contentType: false,
            //para enviar imagenes processdata debe ser false
            processData: false,
            async: true,
            // no cachear la página al request
            cache: false,
            success: function (data) {
                var obj = JSON.parse(data);
                var respuesta = obj['respuesta'];
                if (respuesta === 'correcto') {
                    swal({type: "success",
                        title: "Guardado",
                        text: "Registro Guardado Correctamente!"
                    }).then(function() {
                        href = "lista-"+obj['tipo']+".php"
                        console.log(href)
                        window.location.href = href ;
                    });
                } else {
                    swal(
                        'Error...',
                        'Hubo un error al enviar su información!',
                        'error'
                    )
                }
            }
        });
    });

    $('.borrar_registro').on('click', function (e) {
        e.preventDefault();
        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');
        swal({
            title: 'Estas seguro?',
            text: "Esta acción no se puede revertir!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si! Eliminar',
            cancelButtonText: 'Cancelar'
        }).then(function () {
            $.ajax({
                type: 'post',
                data: {
                    'id': id,
                    'registro': 'eliminar'
                },
                url: 'modelo-' + tipo + '.php',
                success: function (data) {
                    var obj = JSON.parse(data);
                    var respuesta = obj['respuesta'];
                    if (respuesta === "correcto") {
                        swal(
                            'Eliminado!',
                            'Registro Eliminado Correctamente.',
                            'success'
                        ).then(function() {
                            href = "lista-"+obj['tipo']+".php"
                            console.log(href)
                            window.location.href = href ;
                        });
                        jQuery("[data-id='" + resultado.id_eliminado + "'").parents('tr').remove();
                    } else {
                        swal(
                            'Error!',
                            'No se pudo eliminar, intente de nuevo.',
                            'error'
                        )
                    }
                }
            });

        });
    });
});
