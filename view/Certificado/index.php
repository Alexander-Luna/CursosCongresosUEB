<?php
require_once('../../public/lib/tcpdf/tcpdf.php');

function certificate_print_text($pdf, $x, $y, $align, $font = 'freeserif', $style, $size = 10, $text, $width = 0)
{
    $pdf->setFont($font, $style, $size);
    $pdf->SetXY($x, $y);
    $pdf->writeHTMLCell($width, 0, '', '', $text, 0, 0, 0, true, $align);
}

$pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle("My Awesome Certificate");
$pdf->SetProtection(array('modify'));
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetAutoPageBreak(false, 0);
$pdf->AddPage();
$pdf->SetMargins(0, 0, 0, true); // Set margins to 0

$backgroundImage = realpath("../../public/5.png");

// Si la imagen existe, redimensionarla para que quepa en la página
if (file_exists($backgroundImage)) {
    $image = imagecreatefrompng($backgroundImage);
    $width = imagesx($image);
    $height = imagesy($image);

    // Si el ancho de la imagen es menor que el ancho de la página, redimensionarla
    if ($width < 210) {
        $ratio = 210 / $width;
        $resizedImage = imagecreatetruecolor(210, round($height * $ratio));
        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, 210, round($height * $ratio), imagesx($image), imagesy($image));
        imagedestroy($image);
        $image = $resizedImage;
    }

    // Agregar la imagen redimensionada al PDF
    $pdf->Image($image, 0, 0, '', '', '', true);
    imagedestroy($image);
}

$x = 10;
$y = 40;

$sealx = 150;
$sealy = 220;
$seal = realpath("../../public/5.png");

$sigx = 30;
$sigy = 230;
$sig = realpath("../../public/img/logo.png");

$custx = 30;
$custy = 230;

$wmarkx = 26;
$wmarky = 58;
$wmarkw = 158;
$wmarkh = 170;
$sig = realpath("../../public/img/screen.png");

$brdrx = 0;
$brdry = 0;
$brdrw = 210;
$brdrh = 297;
$codey = 250;


$fontsans = 'helvetica';
$fontserif = 'times';

// Add text
$pdf->SetTextColor(0, 0, 120);
certificate_print_text($pdf, $x, $y, 'C', $fontsans, '', 30, "Certificate of Awesomeness");
$pdf->SetTextColor(0, 0, 0);
certificate_print_text($pdf, $x, $y + 20, 'C', $fontserif, '', 20, "This is to certify that");
certificate_print_text($pdf, $x, $y + 36, 'C', $fontsans, '', 30, "JOHN CENA");
certificate_print_text($pdf, $x, $y + 55, 'C', $fontsans, '', 20, "has successfully been declared awesome in");
certificate_print_text($pdf, $x, $y + 72, 'C', $fontsans, '', 20, "the Butt of Many Jokes");
certificate_print_text($pdf, $x, $y + 92, 'C', $fontsans, '', 14,  "13th June 1992");
certificate_print_text($pdf, $x, $y + 102, 'C', $fontserif, '', 10, "With a grade of 12%");
certificate_print_text($pdf, $x, $y + 112, 'C', $fontserif, '', 10, "Earning him a E- :(");
certificate_print_text($pdf, $x, $y + 122, 'C', $fontserif, '', 10, "In only 206 hours. Yep. 206.");

header("Content-Type: application/pdf");
echo $pdf->Output('', 'S');
