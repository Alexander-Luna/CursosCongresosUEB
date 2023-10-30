
let usu_id = $('#usu_idx').val();
let URLimg = "";
function init() {
    $("#ponente_form").on("submit", function (e) {
        guardaryeditar(e);
    });
    $("#detalle_form").on("submit", function (e) {
        e.preventDefault();
        URLimg = "../../controller/ponente.php?op=update_imagen_evento";
        guardaryeditarimg(e);
    });

}



function guardaryeditar(e) {
    e.preventDefault();
    let formData = new FormData($("#ponente_form")[0]);
    $.ajax({
        url: "../../controller/ponente.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log("OK en la solicitud AJAX: " + data);
            $('#ponente_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');
            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        },
        error: function (xhr, status, error) {
            // Manejo de errores
            console.log("Error en la solicitud AJAX: " + status + " - " + error);
            Swal.fire({
                title: 'Error!',
                text: 'No se pudo guardar los datos. Detalles del error: ' + xhr.responseText,
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}


$(document).ready(function () {
    $('#ponen_type').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#usu_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });
    combo_usuario();
    ////////////////////////////////////////////
    $.ajax({
        url: "../../controller/evento.php?op=mostrar",
        type: "POST",
        data: {
            even_id: evenId,
        },
        success: function (datos) {
            let data = JSON.parse(datos);
            if (data.hasOwnProperty("cur_nom")) {
                $("#cur_nom").text(data.cur_nom);
            }
        },
        error: function (xhr, status, error) {
            console.log("Error en la solicitud AJAX: " + status + " - " + error);
        }
    });
    ///////////////////////////////////////////


    $('#ponente_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/ponente.php?op=listar&even_id=" + evenId,
            type: "post"
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,
        "order": [[0, "desc"]],
        "language": {
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ningún dato disponible en esta tabla",
            "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        },
    });

});

function editar(ponen_id) {
    $.post("../../controller/ponente.php?op=mostrar", { ponen_id: ponen_id }, function (data) {
        data = JSON.parse(data);
        $('#ponen_id').val(data.ponen_id);
        $('#even_id').val(data.even_id);
        $('#ponen_titulo').val(data.ponen_titulo);
        $('#ponen_description').val(data.ponen_description);
        $('#ponen_type').val(data.ponen_type).trigger('change');
        $('#usu_id').val(data.usu_id).trigger('change');
        $('#ponen_fechaexpo').val(data.ponen_fechaexpo);
        $('#ponen_time').val(data.ponen_time);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(ponen_id) {
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/ponente.php?op=eliminar", { ponen_id: ponen_id }, function (data) {
                $('#ponente_data').DataTable().ajax.reload();

                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Elimino Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })
            });
        }
    });
}

function nuevo(even_id) {
    $('#ponen_id').val('');
    $('#ponen_type').val('').trigger('change');
    $('#usu_id').val('').trigger('change');
    $('#lbltitulo').html('Nuevo Ponente ');
    $('#even_id').html(even_id);
    $('#ponente_form')[0].reset();
    combo_usuario();
    $('#modalmantenimiento').modal('show');
}
function imagenG(ponen_id) {
    $('#curx_idx').val(ponen_id);
    $('#modalfile').modal('show');
}
function guardaryeditarimg(e) {
    e.preventDefault();
    let formData = new FormData($("#detalle_form")[0]);
    $.ajax({
        url: URLimg,
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (datos) {
            $('#ponente_data').DataTable().ajax.reload();
            Swal.fire({
                title: 'Correcto!',
                text: 'Se Actualizo Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
            $("#modalfile").modal('hide');

        }
    });
}
function combo_usuario() {
    $.post("../../controller/usuario.php?op=combo", function (data) {
        $('#usu_id').html(data);
    });
}
init();
