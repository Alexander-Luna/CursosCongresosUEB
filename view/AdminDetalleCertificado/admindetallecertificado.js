
var usu_id = $('#usu_idx').val();

function init() {

}

$(document).ready(function () {
    $('#even_id').select2();

    combo_evento();

    /* Obtener Id de combo evento */
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
                    url: "../../controller/usuario.php?op=listar_eventos_usuario",
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
            $.post("../../controller/evento.php?op=eliminar_evento_usuario", { curd_id: curd_id }, function (data) {
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

function combo_evento() {
    $.post("../../controller/evento.php?op=combo", function (data) {
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
            text: 'Seleccionar Evento',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    } else {
        let even_id = $('#even_id').val();
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
    let checkboxes = document.querySelectorAll('#usuario_data tbody input[type="checkbox"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = true;
    });
}

function registrardetalle() {
    table = $('#usuario_data').DataTable();
    let usu_id = [];

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
            url: "../../controller/evento.php?op=insert_evento_usuario",
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
                            url: "../../controller/evento.php?op=generar_qr",
                            data: { curd_id: i['curd_id'] },
                            dataType: "json"
                        });
                    });
                });
            }
        });

        /* Recargar datatable de los usuarios del evento */
        $('#detalle_data').DataTable().ajax.reload();

        $('#usuario_data').DataTable().ajax.reload();
        /* ocultar modal */
        $('#modalmantenimiento').modal('hide');

    }
}

function nuevoExcel() {
    if ($('#even_id').val() == '') {
        Swal.fire({
            title: 'Error!',
            text: 'Seleccionar Evento',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    } else {
        let even_id = $('#even_id').val();
        listar_usuario(even_id);


        $('#modalplantilla').modal('show');
    }
}

let ExcelToJSON = function () {
    this.parseExcel = function (file) {
        let reader = new FileReader();

        reader.onload = function (e) {
            let data = e.target.result;
            let workbook = XLSX.read(data, {
                type: 'binary'
            });
            //TODO: Recorrido a todas las pestañas
            workbook.SheetNames.forEach(function (sheetName) {
                // Here is your object
                let XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                let json_object = JSON.stringify(XL_row_object);
                UserList = JSON.parse(json_object);

                console.log(UserList)
                for (i = 0; i < UserList.length; i++) {

                    let columns = Object.values(UserList[i])

                    $.post("../../controller/usuario.php?op=guardar_desde_excel", {
                        usu_nom: columns[0],
                        usu_apep: columns[1],
                        usu_apem: columns[2],
                        usu_correo: columns[3],
                        usu_pass: columns[4],
                        usu_ci: columns[4],
                        usu_sex: columns[5],
                        usu_telf: columns[6],
                        rol_id: '1',
                        aclevel_id: assignAclevelId(columns[7])

                    }, function (data) {
                        console.log(data);
                    });
                    $.post("../../controller/evento.php?op=guardar_desde_excel", {
                        usu_ci: columns[4],
                        even_id: even_id
                    }, function (data) {

                        console.log(data);
                    });
                }
                Swal.fire({
                    title: 'Correcto!',
                    text: 'Usuarios Agregados Correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                })

                /* TODO:Despues de subir la informacion limpiar inputfile */
                document.getElementById("upload").value = null;

                /* TODO: Actualizar Datatable JS */
                $('#detalle_data').DataTable().ajax.reload();
                $('#modalplantilla').modal('hide');
            })
        };
        reader.onerror = function (ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
    };
};
function assignAclevelId(aclevel) {
    if (aclevel === "Estudiante") {
        return 1;
    } else if (aclevel === "Maestria") {
        return 2;
    } else if (aclevel === "Doctorado") {
        return 3;
    } else {
        // Puedes manejar otros casos si es necesario
        return null; // Otra acción por defecto o un valor específico
    }
}
function handleFileSelect(evt) {
    let files = evt.target.files; // FileList object
    let xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
}

document.getElementById('upload').addEventListener('change', handleFileSelect, false);






init();
