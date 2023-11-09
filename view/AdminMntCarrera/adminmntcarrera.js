
var usu_id = $('#usu_idx').val();

function init() {
    $("#carrera_form").on("submit", function (e) {
        guardaryeditar(e);
    });
}

async function guardaryeditar(e) {
    e.preventDefault();

    try {
        // Create an instance of FormData from the formulario element
        let formData = new FormData(document.getElementById('carrera_form'));

        // Make an asynchronous POST request to the 'carrera.php?op=guardaryeditar' endpoint
        fetch('../../controller/carrera.php?op=guardaryeditar', {
            method: 'POST',
            body: formData
        }).then(response => response.json())
            .then(data => {
                // Reload the data table to reflect the updated information
                $('#carrera_data').DataTable().ajax.reload();

                // Hide the maintenance modal
                $('#modalmantenimiento').modal('hide');

                // Display a success message using SweetAlert
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Se Registro Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            });
    } catch (error) {
        console.error('Error:', error);
    }
}

$(document).ready(function () {
    $('#facultad_id').select2();
    combo_facultad();
    $.ajax({
        url: "../../controller/facultad.php?op=mostrar",
        type: "POST",
        data: {
            facultad_id: facultadId,
        },
        success: function (datos) {
            let data = JSON.parse(datos);
            if (data.hasOwnProperty("name")) {
                $("#name").text(data.name);
            }
        },
        error: function (xhr, status, error) {
            console.log("Error en la solicitud AJAX: " + status + " - " + error);
        }
    });


    $('#carrera_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/carrera.php?op=listar&facultad=" + facultadId,
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

function editar(carrera_id) {
    $.post("../../controller/carrera.php?op=mostrar", { carrera_id: carrera_id }, function (data) {
        data = JSON.parse(data);
        $('#carrera_id').val(data.carrera_id);
        $('#name').val(data.name);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(carrera_id) {
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/carrera.php?op=eliminar", { carrera_id: carrera_id }, function (data) {
                $('#carrera_data').DataTable().ajax.reload();

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

function nuevo(facultad_id) {

    if (facultad_id == '') {
        Swal.fire({
            title: 'Error!',
            text: 'No Existe la Facultad Evento',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    } else {
        combo_facultad();
        $('#carrera_id').val('');
        console.log(facultad_id + " Entraaa ");
        $('#facultad_id').val(facultad_id).trigger('change');
        $('#lbltitulo').html('Nueva Carrera');
        $('#carrera_form')[0].reset();
        $('#modalmantenimiento').modal('show');
    }


}

function combo_facultad() {
    $.post("../../controller/facultad.php?op=combo", function (data) {
        $('#facultad_id').html(data);
    });
}
init();
