<?php
$directorioTemporal = '/ruta/del/directorio/temporal';  // Reemplaza con tu ruta real
$nombreZip = 'archivos_pdf.zip';

// Crear el objeto ZipArchive
$zip = new ZipArchive();

// Crear el archivo ZIP
if ($zip->open($directorioTemporal . '/' . $nombreZip, ZipArchive::CREATE) === TRUE) {
    // Obtener la lista de archivos PDF en el directorio temporal
    $archivosPDF = glob($directorioTemporal . '/*.pdf');

    // Agregar cada archivo PDF al ZIP
    foreach ($archivosPDF as $archivoPDF) {
        $nombreArchivo = basename($archivoPDF);
        $zip->addFile($archivoPDF, $nombreArchivo);
    }

    // Cerrar el ZIP
    $zip->close();

    // Descargar el archivo ZIP
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=' . $nombreZip);
    header('Content-Length: ' . filesize($directorioTemporal . '/' . $nombreZip));
    readfile($directorioTemporal . '/' . $nombreZip);

    // Eliminar los archivos PDF temporales
    foreach ($archivosPDF as $archivoPDF) {
        unlink($archivoPDF);
    }

    // Eliminar el archivo ZIP temporal
    unlink($directorioTemporal . '/' . $nombreZip);
} else {
    echo 'Error al crear el archivo ZIP';
}
