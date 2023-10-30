<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
  $even_id = $_GET["even_id"];
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/MainHead.php"); ?>

    <title>Ponentes</title>
  </head>

  <body>

    <?php require_once("../html/MainMenu.php"); ?>

    <?php require_once("../html/MainHeader.php"); ?>
    <script type="text/javascript">
      let evenId = <?php echo $even_id; ?>;
    </script>
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Ponente</a>
        </nav>
      </div>
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Ponente</h4>
        <p class="mg-b-0">Mantenimiento</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 id="cur_nom" name="cur_nom" class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">

          </h6>
          <p class="mg-b-30 tx-gray-600">Listado de Ponentes</p>

          <button class="btn btn-outline-primary" id="add_button" onclick="nuevo(<?php echo $even_id; ?>)"><i
              class="fa fa-plus-square mg-r-10"></i> Nuevo Registro</button>

          <p></p>

          <div class="table-wrapper"></div>
          <table id="ponente_data" class="table display responsive nowrap">
            <thead>
              <tr>
                <th class="wd-15p">Nombres</th>
                <th class="wd-15p">Titulo</th>
                <th class="wd-15p">Descripción</th>
                <th class="wd-15p">Teléfono</th>
                <th class="wd-15p">Fecha Expo</th>
                <th class="wd-10p">Imagen</th>
                <th class="wd-10p">Editar</th>
                <th class="wd-10p">Eliminar</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>

      </div>
    </div>
    </div>

    <?php require_once("modalmantenimiento.php"); ?>
    <?php require_once("modalfile.php"); ?>
    <?php require_once("../html/MainJs.php"); ?>
    <script type="text/javascript" src="adminmntponente.js"></script>
  </body>

  </html>
  <?php
} else {
  /* Si no a iniciado sesion se redireccionada a la ventana principal */
  header("Location:" . Conectar::ruta() . "view/404/");
}
?>