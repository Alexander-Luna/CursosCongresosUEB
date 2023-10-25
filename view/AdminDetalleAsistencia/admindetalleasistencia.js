
var usu_id = $('#usu_idx').val();

function init() {

}

$(document).ready(function () {
    $('#even_id').select2();

    combo_curso();

    /* Obtener Id de combo curso */
    $('#even_id').change(function () {
        $("#even_id option:selected").each(function () {
            even_id = $(this).val();

            /* Listado de datatable */
            $('#detalle_data').DataTable({
                "aProcessing": true,
                "aServerSide": true,
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                ],
                "ajax": {
                    url: "../../controller/usuario.php?op=listar_cursos_usuario_asistencia",
                    type: "post",
                    data: { even_id: even_id },
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
    });

});

function eliminar(curd_id) {
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/curso.php?op=eliminar_curso_usuario", { curd_id: curd_id }, function (data) {
                $('#detalle_data').DataTable().ajax.reload();

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

function combo_curso() {
    $.post("../../controller/curso.php?op=combo", function (data) {
        $('#even_id').html(data);
    });
}

function certificado(curd_id) {
    console.log(curd_id);
    window.open('../Certificado/index.php?curd_id=' + curd_id + '', '_blank');
}

function nuevo() {
    if ($('#even_id').val() == '') {
        Swal.fire({
            title: 'Error!',
            text: 'Seleccionar Curso',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    } else {
        var even_id = $('#even_id').val();
        listar_usuario(even_id);
        $('#modalmantenimiento').modal('show');
    }
}

function listar_usuario(even_id) {
    $('#usuario_data').DataTable({
        "aProcessing": true,
        "aServerSide": true,
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
        ],
        "ajax": {
            url: "../../controller/usuario.php?op=listar_detalle_usuario",
            type: "post",
            data: { even_id: even_id }
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
}
function seleccionartodos() {
    // Obtener todas las casillas de verificación de usuarios en la tabla
    var checkboxes = document.querySelectorAll('#usuario_data tbody input[type="checkbox"]');

    // Iterar a través de las casillas de verificación y marcarlas
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = true;
    });
}

function registrardetalle() {
    table = $('#usuario_data').DataTable();
    var usu_id = [];

    table.rows().every(function (rowIdx, tableLoop, rowLoop) {
        cell1 = table.cell({ row: rowIdx, column: 0 }).node();
        if ($('input', cell1).prop("checked") == true) {
            id = $('input', cell1).val();
            usu_id.push([id]);
        }
    });

    if (usu_id == 0) {
        Swal.fire({
            title: 'Error!',
            text: 'Seleccionar Usuarios',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    } else {
        /* Creando formulario */
        const formData = new FormData($("#form_detalle")[0]);
        formData.append('even_id', even_id);
        formData.append('usu_id', usu_id);

        $.ajax({
            url: "../../controller/curso.php?op=insert_curso_usuario",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                data = JSON.parse(data);

                data.forEach(e => {
                    e.forEach(i => {
                        console.log(i['curd_id']);
                        $.ajax({
                            type: "POST",
                            url: "../../controller/curso.php?op=generar_qr",
                            data: { curd_id: i['curd_id'] },
                            dataType: "json"
                        });
                    });
                });
            }
        });

        /* Recargar datatable de los usuarios del curso */
        $('#detalle_data').DataTable().ajax.reload();

        $('#usuario_data').DataTable().ajax.reload();
        /* ocultar modal */
        $('#modalmantenimiento').modal('hide');

    }
}

function Aprueba(curd_id) {
    let checkbox = document.getElementById("C" + curd_id);
    console.log(checkbox);
    let asistencia = 0;
    if (checkbox.checked) {
        asistencia = 1;
    } else {
        asistencia = 0;
        console.log('Aprueba no registrada para el ID ' + curd_id);
    }
    $.ajax({
        type: 'POST',
        url: "../../controller/curso.php?op=apruebacurso", // Ruta al script PHP que contiene la función insert_asistencia
        data: { curd_id: curd_id, est_aprueba: asistencia }, // Aquí se pasan los valores de even_id y est_asistencia
        success: function (response) {
            // Procesa la respuesta del servidor (si es necesario)
            // alert('Asistencia registrada con éxito');
        },
        error: function (e) {
            alert('Error al registrar la asistencia ' + e);
        }
    });

}

init();
