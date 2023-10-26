function init() {

}

$(document).ready(function () {
    $("#divpanel").hide();
});
$(document).on("click", "#btnconsultar", function () {
    var usu_ci = $("#usu_ci").val();
    if (usu_ci.length == 0) {
        Swal.fire({
            title: 'Error!',
            text: 'ci Vacio',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        })
    } else {

        $.post("../../controller/usuario.php?op=consulta_ci", { usu_ci: usu_ci }, function (data) {
            if (data.length > 0) {
                data = JSON.parse(data);

                $("#lbldatos").html("Listado de Eventos : " + data.usu_apep + " " + data.usu_apem + " " + data.usu_nom);

                $('#eventos_data').DataTable({
                    "aProcessing": true,
                    "aServerSide": true,
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                    ],
                    "ajax": {
                        url: "../../controller/usuario.php?op=listar_eventos",
                        type: "post",
                        data: { usu_id: data.usu_id },
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

                $("#divpanel").show();
            } else {
                Swal.fire({
                    title: 'Error!',
                    text: 'No Existe Usuario',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                })
            }
        });

    }

});

function certificado(curd_id) {
    console.log(curd_id);
    window.open('../Certificado/index.php?curd_id=' + curd_id + '', '_blank');
}
// Variable global para rastrear si la función se ha ejecutado
let asistenciaRegistrada = false;

function FuncionAsistencia(curd_id) {
    // Verificar si la asistencia ya se ha registrado
    if (asistenciaRegistrada) {
        Swal.fire({
            title: 'Correcto!',
            text: 'La asistencia ya ha sido registrada.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        })
        return;
    }

    // Realiza una solicitud AJAX para registrar la asistencia
    $.ajax({
        type: 'POST',
        url: "../../controller/evento.php?op=asistencia",
        data: { curd_id: curd_id },
        success: function (response) {
            // Procesa la respuesta del servidor (si es necesario)
            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
            // Desactiva la función para futuras llamadas
            asistenciaRegistrada = true;
        },
        error: function (e) {
            Swal.fire({
                title: 'Correcto!',
                text: 'Error al registrar asistencia',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });
}