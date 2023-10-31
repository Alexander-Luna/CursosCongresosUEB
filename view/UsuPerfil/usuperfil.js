function resetpass() {

    $('#reset_password').modal('show');
}

let usu_id = $('#usu_idx').val();
function init() {
    $("#usuario_form").on("submit", function (e) {
        cambiarpass(e);
    });

}
function cambiarpass(e) {
    e.preventDefault();
    let formData = new FormData($("#usuario_form")[0]);
    $.ajax({
        url: "../../controller/usuario.php?op=resetpass",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log("OK en la solicitud AJAX: " + data);
            $('#reset_password').modal('hide');
            Swal.fire({
                title: 'Correcto!',
                text: 'Se Registro Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        },
        error: function (xhr, status, error) {
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
    // $('#usu_sex').select2({
    //     placeholder: 'Seleccione',
    //     allowClear: true, // Permite borrar la selección
    //     width: '100%',
    //     minimumResultsForSearch: -1, // Puedes ajustar el ancho
    // });
    // $('#aclevel_id').select2({
    //     placeholder: 'Seleccione',
    //     allowClear: true, // Permite borrar la selección
    //     width: '100%',
    //     minimumResultsForSearch: -1, // Puedes ajustar el ancho
    // });

    $.post("../../controller/usuario.php?op=mostrar", { usu_id: usu_id }, function (data) {
        data = JSON.parse(data);
        $('#usu_nom').val(data.usu_nom);
        $('#usu_apep').val(data.usu_apep);
        $('#usu_apem').val(data.usu_apem);
        $('#usu_ci').val(data.usu_ci);
        $('#usu_id').val(data.usu_id);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_telf').val(data.usu_telf);
        $('#aclevel_id').val(data.aclevel_id).trigger("change");
        $('#usu_sex').val(data.usu_sex).trigger("change");
    });
});


$(document).on("click", "#btnactualizar", function () {

    $.post("../../controller/usuario.php?op=update_perfil", {
        usu_id: usu_id,
        usu_nom: $('#usu_nom').val(),
        usu_apep: $('#usu_apep').val(),
        usu_apem: $('#usu_apem').val(),
        aclevel_id: $('#aclevel_id').val(),
        usu_ci: $('#usu_ci').val(),
        usu_sex: $('#usu_sex').val(),
        usu_telf: $('#usu_telf').val()
    }, function (data) {
    });

    Swal.fire({
        title: 'Correcto!',
        text: 'Se actualizo Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })
});
init();