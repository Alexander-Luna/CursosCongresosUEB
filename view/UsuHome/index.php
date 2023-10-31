<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/MainHead.php"); ?>
    <title>Home</title>
  </head>

  <body>
    <?php require_once("../html/MainMenu.php"); ?>
    <?php require_once("../html/MainHeader.php"); ?>
    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Inicio</a>
        </nav>
      </div>
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Inicio</h4>
        <p class="mg-b-0">Dashboard</p>
      </div>
      <!-- Contenido del proyecto -->
      <div class="br-pagebody mg-t-5 pd-x-30">

        <!-- Resumen de total de eventos -->
        <div class="row row-sm">
          <div class="col-sm-6 col-xl-3">
            <a href="../UsuEvento/" class="br-menu-link">
              <div class="bg-teal rounded overflow-hidden">
                <div class="pd-25 d-flex align-items-center">
                  <i class="ion ion-earth tx-60 lh-0 tx-white op-7"></i>
                  <div class="mg-l-20">
                    <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Mis Eventos</p>
                    <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="lbltotal"></p>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-xl-3">
            <a href="../UsuPonencia/" class="br-menu-link">
              <div class="bg-info rounded overflow-hidden"> <!-- Usa la clase de Bootstrap para el color de fondo -->
                <div class="pd-25 d-flex align-items-center">
                  <i class="icon ion-university tx-60 lh-0 tx-white op-7"></i>
                  <div class="mg-l-20">
                    <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Mis Ponencias</p>
                    <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="lbltotalponencia"></p>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <?php
          if ($_SESSION["rol_id"] == 2) {
            ?>
            <div class="col-sm-6 col-xl-3">
              <a href="../AdminMntUsuario/" class="br-menu-link">
                <div class="bg-success bg-gradient rounded overflow-hidden">

                  <div class="pd-25 d-flex align-items-center">
                    <i class="icon ion-person-stalker tx-60 lh-0 tx-white op-7"></i>
                    <div class="mg-l-20">
                      <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Total de Usuarios</p>
                      <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="lbltotaluser"></p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-sm-6 col-xl-3">
              <a href="../AdminMntEvento/" class="br-menu-link">
                <div class="bg-warning bg-gradient rounded overflow-hidden">
                  <!-- Usa la clase de Bootstrap para el color de fondo -->
                  <div class="pd-25 d-flex align-items-center">
                    <i class="icon ion-ios-book tx-60 lh-0 tx-white op-7"></i>
                    <div class="mg-l-20">
                      <p class="tx-10 tx-spacing-1 tx-mont tx-medium tx-uppercase tx-white-8 mg-b-10">Asistencia a Eventos
                      </p>
                      <p class="tx-24 tx-white tx-lato tx-bold mg-b-2 lh-1" id="lbltotalasistencia"></p>
                    </div>
                  </div>
                </div>
              </a>
            </div>


            <?php
          } ?>




        </div>

        <!-- Resumen top 10 eventos -->
        <div class="row row-sm mg-t-20">
          <div class="col-12">
            <div class="card pd-0 bd-0 shadow-base">
              <div class="pd-x-30 pd-t-30 pd-b-15">
                <div class="d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="tx-13 tx-uppercase tx-inverse tx-semibold tx-spacing-1">Top Últimos Eventos</h6>
                    <p class="mg-b-0">Aquí podrá visualizar los últimos 10 Certificados</p>
                  </div>
                </div>
              </div>
              <div class="pd-x-15 pd-b-15">
                <div class="table-wrapper">
                  <table id="eventos_data" class="table display responsive nowrap">
                    <thead>
                      <tr>
                        <th class="wd-30p">Evento</th>
                        <th class="wd-5p">Fecha Inicio</th>
                        <th class="wd-5p">Fecha Fin</th>
                        <th class="wd-5p">Certificado</th>
                        <th class="wd-5p">Asistencia</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
    <?php require_once("../html/MainJs.php"); ?>
    <script type="text/javascript" src="usuhome.js"></script>
  </body>

  </html>
  <?php
} else {
  /* Si no a iniciado sesion se redireccionada a la ventana principal */
  header("Location:" . Conectar::ruta() . "view/404/");
}
?>