let usu_id = $('#usu_idx').val();
function init() {


}

$(document).ready(function () {

    bloqueaLetrascaracteres(document.getElementById('midesc'));
    bloqueaLetrascaracteres(document.getElementById('mddesc'));
    bloqueaLetrascaracteres(document.getElementById('mieven'));
    bloqueaLetrascaracteres(document.getElementById('mdeven'));
    bloqueaLetrascaracteres(document.getElementById('xqr'));
    bloqueaLetrascaracteres(document.getElementById('yqr'));
    bloqueaLetrascaracteres(document.getElementById('xci'));
    bloqueaLetrascaracteres(document.getElementById('yci'));
    bloqueaLetrascaracteres(document.getElementById('xnombres'));
    bloqueaLetrascaracteres(document.getElementById('ynombres'));
    bloqueaLetrascaracteres(document.getElementById('xfacultad'));
    bloqueaLetrascaracteres(document.getElementById('yfacultad'));
    bloqueaLetrascaracteres(document.getElementById('xdescripcion'));
    bloqueaLetrascaracteres(document.getElementById('ydescripcion'));
    bloqueaLetrascaracteres(document.getElementById('xevento'));
    bloqueaLetrascaracteres(document.getElementById('yevento'));
    // Manejar el evento de cambio en los inputs
    $('input[name="midesc"], input[name="mddesc"], input[name="mieven"], input[name="mdeven"], input[name="xqr"], input[name="yqr"], input[name="xnombres"], input[name="ynombres"], input[name="xevento"], input[name="yevento"], input[name="xdescripcion"], input[name="ydescripcion"], input[name="xfacultad"], input[name="yfacultad"], input[name="xci"], input[name="yci"]').on('keyup', function (event) {

        if (event.which === 13) {
            guardarCoordenadas(false);
        }
    });
    $.post("../../controller/evento.php?op=mostrar_coordenadas", { even_id: even_id }, function (data) {
        data = JSON.parse(data);
        //   console.log(data);
        $('#mdeven').val(data.mdeven);
        $('#mieven').val(data.mieven);
        $('#midesc').val(data.midesc);
        $('#mddesc').val(data.mddesc);
        $('#xqr').val(data.xqr);
        $('#yqr').val(data.yqr);
        $('#xnombres').val(data.xnombres);
        $('#ynombres').val(data.ynombres);
        $('#xevento').val(data.xcurso);
        $('#yevento').val(data.ycurso);
        $('#xdescripcion').val(data.xdescripcion);
        $('#ydescripcion').val(data.ydescripcion);
        $('#xfacultad').val(data.xfacultad);
        $('#yfacultad').val(data.yfacultad);
        $('#xci').val(data.xcedula);
        $('#yci').val(data.ycedula);

    });
});









function guardarCoordenadas(click) {
    $.post("../../controller/evento.php?op=update_coordenadas", {
        even_id: $('#even_id').val(),
        midesc: $('#midesc').val(),
        mddesc: $('#mddesc').val(),
        mieven: $('#mieven').val(),
        mdeven: $('#mdeven').val(),
        xqr: $('#xqr').val(),
        yqr: $('#yqr').val(),
        xci: $('#xci').val(),
        yci: $('#yci').val(),
        xnombres: $('#xnombres').val(),
        ynombres: $('#ynombres').val(),
        xcurso: $('#xevento').val(),
        ycurso: $('#yevento').val(),
        xfacultad: $('#xfacultad').val(),
        yfacultad: $('#yfacultad').val(),
        xdescripcion: $('#xdescripcion').val(),
        ydescripcion: $('#ydescripcion').val()
    }, function (data) {
        actualizarIframe();
        if (click == true) {
            Swal.fire({
                title: 'Correcto!',
                text: 'Coordenadas Agregadas Correctamente',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            })
        }
    });


}
function actualizarIframe() {
    var iframe = $('#miIframe');
    iframe.attr('src', iframe.attr('src'));
}
init();