<?php
  /* Llamamos al archivo de conexion.php */
  require_once("../../config/conexion.php");
  if(isset($_SESSION["usu_id"])){
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php require_once("../html/MainHead.php"); ?>
    <title>Empresa::Evento</title>
  </head>

  <body>

    <?php require_once("../html/MainMenu.php"); ?>
    <?php require_once("../html/MainHeader.php"); ?>

    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Mis Eventos</a>
        </nav>
      </div>
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Mis Eventos</h4>
        <p class="mg-b-0">Listado de Eventos</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Listado de mis Eventos</h6>
          <p class="mg-b-25 mg-lg-b-50">Desde aquí podrá buscar sus eventos por certificado.</p>

          <div class="table-wrapper">
            <table id="eventos_data" class="table display responsive nowrap">
              <thead>
                <tr>
                  <th class="wd-15p">Evento</th>
                  <th class="wd-15p">Fecha Inicio</th>
                  <th class="wd-20p">Fecha Fin</th>
                  <th class="wd-15p">Instructor</th>
                  <th class="wd-10p">Certificado</th>
                  <th class="wd-10p">Asistencia</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
    <?php require_once("../html/MainJs.php");?>
    <script type="text/javascript" src="usuevento.js"></script>
  </body>
</html>
<?php
  }else{
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
    header("Location:".Conectar::ruta()."view/404/");
  }
?>