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
    bloqueaNumeros(document.getElementById('usu_apep'));
    bloqueaNumeros(document.getElementById('usu_apem'));
    bloqueaNumeros(document.getElementById('usu_nom'));
    bloqueaLetrascaracteres(document.getElementById('usu_ci'));
    bloqueaLetrascaracteres(document.getElementById('usu_telf'));

    combo_nacademico();
    combo_facultad();

    $.post("../../controller/usuario.php?op=mostrar", { usu_id: usu_id }, function (data) {
        data = JSON.parse(data);
        facultad_id = data.facultad_id;
        $('#usu_nom').val(data.usu_nom);
        $('#usu_apep').val(data.usu_apep);
        $('#usu_apem').val(data.usu_apem);
        $('#usu_ci').val(data.usu_ci);
        $('#usu_id').val(data.usu_id);
        $('#usu_correo').val(data.usu_correo);
        $('#usu_telf').val(data.usu_telf);
        $('#aclevel_id').val(data.aclevel_id).trigger("change");
        $('#usu_sex').val(data.usu_sex).trigger("change");
        console.log(data.usu_otracarrera + " " + data.facultad_id + " " + data.carrera_id);


        if (data.facultad_id != null) {
            $('#facultad_id').val(data.facultad_id).trigger("change");
            if (data.carrera_id != null) {
                combo_carrera(data.facultad_id);
                $('#carrera_id').val(data.carrera_id).trigger("change");
            }
            if (data.facultad_id == 7) {
                $('#usu_otracarrera').val(data.usu_otracarrera);
            }
        }

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
        usu_telf: $('#usu_telf').val(),
        usu_carrera: $('#carrera_id').val(),
        usu_facultad: $('#facultad_id').val(),
        usu_otracarrera: $('#usu_otracarrera').val()
    }, function (data) {
    });

    Swal.fire({
        title: 'Correcto!',
        text: 'Se actualizo Correctamente',
        icon: 'success',
        confirmButtonText: 'Aceptar'
    })
});
let facultad_id = '';
function combo_facultad() {
    $.post("../../controller/facultad.php?op=combo", function (data) {
        $('#facultad_id').html(data);

    });
}
function combo_nacademico() {
    $.post("../../controller/academic_level.php?op=combo", function (data) {
        $('#aclevel_id').html(data);

    });
}

function combo_carrera(facultad_id) {
    $.post("../../controller/carrera.php?op=combo", { facultad: facultad_id }, function (data) {
        $('#carrera_id').html(data);
    });
}
function mostrarOcultarCarrera() {
    let facultadSelect = document.getElementById("facultad_id");
    let carreraDiv = document.getElementById("divCarrera");
    let otraCarreraDiv = document.getElementById("divOtraCarrera");
    let selectedFacultad = facultadSelect.value;
    combo_carrera(selectedFacultad);
    if (selectedFacultad === "7") {
        carreraDiv.style.display = "none";
        otraCarreraDiv.style.display = "block";
    } else {
        carreraDiv.style.display = "block";
        otraCarreraDiv.style.display = "none";
    }

}
init();