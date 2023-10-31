const canvas = document.getElementById('canvas');
const ctx = canvas.getContext('2d');

/* Inicializamos la imagen */
const image = new Image();
const imageqr = new Image();
const imageLogo = new Image();
// Cargar la fuente personalizada
const customFont = new FontFace('Micky', 'url(../../../../assets/mickycaviar.ttf)');
const x = canvas.width / 2;
const y = canvas.height;

const maxWidth = x + 200; // Ancho máximo para el texto
const lineHeight = 30; // Espacio entre líneas

$(document).ready(function () {
    let ponen_id = getUrlParameter('ponen_id');

    $.post("../../controller/ponente.php?op=mostrar_ponencia_detalle", { ponen_id: ponen_id }, function (data) {
        data = JSON.parse(data);

        /* Ruta de la Imagen */
        image.src = data.cur_img;
        /* Dimensionamos y seleccionamos imagen */
        ctx.drawImage(image, 0, 0, canvas.width, canvas.height);

        /* Definimos tamaño de la fuente */
        ctx.font = '40px Arial';
        ctx.textAlign = "center";
        ctx.textBaseline = 'middle';
        // Hacer una solicitud para obtener el nombre de la tabla academic_level
        let academicLevelName = data.aclevel_id;


        $.post("../../controller/academic_level.php?op=mostrar", { aclevel_id: academicLevelName }, function (response) {
            response = JSON.parse(response);
            ctx.font = '30px Micky';
            academicLevelName = response.aclevel_abreviature;
            // Continúa con el código que necesita el nombre del nivel académico
            ctx.fillText(academicLevelName + ' ' + data.usu_nom + ' ' + data.usu_apep + ' ' + data.usu_apem, x, 300);
        });




        ctx.font = '20px Arial';
        let textToDraw = 'Por haber participado en calidad de ';
        ctx.font = 'bold 20px Arial';

        let tipoDePonencia;
        if (data.ponen_type === '1') {
            tipoDePonencia = "Ponencia";
        } else if (data.ponen_type === '2') {
            tipoDePonencia = "Ponencia Magistral";
        } else {
            tipoDePonencia = "No especificada";
        }
        textToDraw = textToDraw + ' ' + tipoDePonencia;
        ctx.font = '20px Arial';
        textToDraw = textToDraw + ' con la temática ' + data.ponen_titulo + ' en el marco del ' + data.cur_nom + ', organizado por la Universidad Estatal de Bolívar ' +
            'Desarrollado desde el ' + data.cur_fechini + ' al ' + data.cur_fechfin + ', modalidad ' + data.mname + ', con una duración de ' + data.nhours + ' horas. Dado en la ciudad de Guaranda.';
        drawWrappedText(textToDraw, x, y / 1.9, maxWidth, lineHeight);

        ctx.font = '15px Arial';



        // let modalidad = data.modality_id;

        // $.post("../../controller/evento.php?op=modalidad", { modality_id: modalidad }, function (response1) {
        //     response1 = JSON.parse(response1);
        //     modalidad = response1.name;
        //     ctx.font = '10px Arial';
        //     let textToDraw = 'Desarrollado desde el ' + data.cur_fechini + ' al ' + data.cur_fechfin + ', modalidad ' + modalidad + ', con una duración de ' + data.nhours + ' horas. Dado en la ciudad de Guaranda';

        //     drawWrappedText(textToDraw, x, 440, maxWidth, lineHeight);

        // });

        /* Ruta de la Imagen */
        imageLogo.src = "../../assets/logo_ueb.png";
        /* Dimensionamos y seleccionamos imagen */
        ctx.drawImage(imageLogo, 30, 30, 100, 80);


        /* Ruta de la Imagen */
        imageqr.src = "../../public/qr/" + ponen_id + ".png";
        /* Dimensionamos y seleccionamos imagen */
        ctx.drawImage(imageqr, 795, 545, 95, 95);

        $('#cur_descrip').html(data.cur_descrip);
    });

});

/* Recarga por defecto solo 1 vez */
window.onload = function () {
    if (!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}

$(document).on("click", "#btnpng", function () {
    let lblpng = document.createElement('a');
    lblpng.download = "Certificado.png";
    lblpng.href = canvas.toDataURL();
    lblpng.click();
});

$(document).on("click", "#btnpdf", function () {
    let imgData = canvas.toDataURL('image/png');
    let doc = new jsPDF('l', 'mm');
    doc.addImage(imgData, 'PNG', 30, 15);
    doc.save('Certificado.pdf');
});

let getUrlParameter = function getUrlParameter(sParam) {
    let sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
function drawWrappedText(text, x, y, maxWidth, lineHeight) {
    const words = text.split(' ');
    let line = '';

    for (let i = 0; i < words.length; i++) {
        const testLine = line + words[i] + ' ';
        const metrics = ctx.measureText(testLine);
        const testWidth = metrics.width;

        if (testWidth > maxWidth) {
            ctx.fillText(line, x, y);
            line = words[i] + ' ';
            y += lineHeight;
        } else {
            line = testLine;
        }
    }

    ctx.fillText(line, x, y);
}