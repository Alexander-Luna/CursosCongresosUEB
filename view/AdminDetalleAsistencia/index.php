<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/MainHead.php"); ?>

    <title>Control de Asistencia</title>
  </head>

  <body>

    <?php require_once("../html/MainMenu.php"); ?>

    <?php require_once("../html/MainHeader.php"); ?>

    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Control de Asistencia</a>
        </nav>
      </div>
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Control de Asistencia</h4>
        <p class="mg-b-0">Mantenimiento</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Control de Asistencia</h6>
          <p class="mg-b-30 tx-gray-600">Listado de Control de Asistencia</p>

          <div class="form-layout">
            <div class="row">

              <div class="col-lg-4">
                <label class="form-control-label">Eventos: <span class="tx-danger">*</span></label>
                <div class="form-floating">
                  <select class="form-control" style="width:100%" name="even_id" id="even_id">
                    <option selected>Seleccione</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-4">
                <label class="form-control-label">&nbsp;</label>
                <button class="btn btn-outline-primary form-control" id="add_button" onclick="nuevo()"><i
                    class="fa fa-plus-square mg-r-10"></i> Agregar Usuarios</button>
              </div>
            </div>
          </div>

          <p></p>

          <div class="table-wrapper"></div>
          <table id="detalle_data" class="table display responsive nowrap" width="100%">
            <thead>
              <tr>
                <th class="wd-15p">Evento</th>
                <th class="wd-15p">Usuario</th>
                <th class="wd-20p">Fecha Fin</th>
                <th class="wd-10p">Asistencia</th>
                <th class="wd-10p">Aprueba</th>
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

    <?php require_once("../html/MainJs.php"); ?>
    <script type="text/javascript" src="admindetalleasistencia.js"></script>
  </body>

  </html>
  <?php
} else {
  /* Si no a iniciado sesion se redireccionada a la ventana principal */
  header("Location:" . Conectar::ruta() . "view/404/");
}
?>