<!DOCTYPE html>
<html lang="es" class="pos-relative">

<head>
  <?php require_once("../html/MainHead.php");

  $id = $_GET['qr'];
  $c1 = $_GET['481516'];
  ?>
  <title>Certificado</title>
</head>

<body class="pos-relative">



  <div class="br-pagebody">
    <div class="br-section-wrapper">
      <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Verificar Certificado</h6>
      <p class="mg-b-30 tx-gray-600">Recuerde que cada certificado es Único</p>
      <iframe id='miIframe' name='miIframe' src="../Certificado/index.php?qr=<?php echo $id; ?>&c1=<?php echo $c1; ?>" width="100%" height="1000px" frameborder="0"></iframe>

    </div>

  </div>

  <?php require_once("../html/MainJs.php"); ?>
</body>

</html>