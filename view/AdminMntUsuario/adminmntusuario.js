
let usu_id = $('#usu_idx').val();

function init() {
    $("#usuario_form").on("submit", function (e) {
        guardaryeditar(e);
    });
}

function guardaryeditar(e) {
    e.preventDefault();
    let formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {

            $('#usuario_data').DataTable().ajax.reload();
            $('#modalmantenimiento').modal('hide');

            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}

$(document).ready(function () {
    bloqueaNumeros(document.getElementById('usu_apellidos'));
    bloqueaNumeros(document.getElementById('usu_nom'));
    bloqueaLetrascaracteres(document.getElementById('usu_ci'));
    bloqueaLetrascaracteres(document.getElementById('usu_telf'));

    $('#usu_sex').select2({
        dropdownParent: $('#modalmantenimiento')
    });

    $('#rol_id').select2({
        dropdownParent: $('#modalmantenimiento')
    });

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
            url: "../../controller/usuario.php?op=listar",
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

function editar(usu_id) {
    $.post("../../controller/usuario.php?op=mostrar", { usu_id: usu_id }, function (data) {
        console.log(data);
        data = JSON.parse(data);
        $('#usu_id').val(data.usu_id);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_apellidos').val(data.usu_apellidos);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_sex').val(data.usu_sex).trigger('change');
        $('#rol_id').val(data.rol_id).trigger('change');
        $('#usu_telf').val(data.usu_telf);
        $('#usu_ci').val(data.usu_ci);
        $('#aclevel_id').val(data.aclevel_id);
    });
    $('#lbltitulo').html('Editar Registro');
    $('#modalmantenimiento').modal('show');
}

function eliminar(usu_id) {
    swal.fire({
        title: "Eliminar!",
        text: "Desea Eliminar el Registro?",
        icon: "error",
        confirmButtonText: "Si",
        showCancelButton: true,
        cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            $.post("../../controller/usuario.php?op=eliminar", { usu_id: usu_id }, function (data) {
                $('#usuario_data').DataTable().ajax.reload();

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

function nuevo() {
    $('#usu_id').val('');
    $('#usu_sex').val('').trigger('change');
    $('#rol_id').val('').trigger('change');
    $('#aclevel_id').val('').trigger('change');
    $('#lbltitulo').html('Nuevo Registro');
    $('#usuario_form')[0].reset();
    $('#modalmantenimiento').modal('show');
}
function nuevaplantilla() {
    $('#modalplantilla').modal('show');
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
                        usu_apellidos: columns[1],
                        usu_correo: columns[2],
                        usu_ci: columns[3],
                        usu_sex: columns[4],
                        usu_telf: columns[5],
                        rol_id: '1',
                        aclevel_id: assignAclevelId(columns[6])

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
                $('#usuario_data').DataTable().ajax.reload();
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
