<?php
/* Llamamos al archivo de conexion.php */
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
  ?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <?php require_once("../html/MainHead.php"); ?>

    <title>Mi Perfil</title>
  </head>

  <body>

    <?php require_once("../html/MainMenu.php"); ?>

    <?php require_once("../html/MainHeader.php"); ?>

    <div class="br-mainpanel">
      <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
          <a class="breadcrumb-item" href="#">Perfil</a>
        </nav>
      </div>
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Perfil</h4>
        <p class="mg-b-0">Pantalla Perfil</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Perfil</h6>
          <p class="mg-b-30 tx-gray-600">Actualize sus datos</p>

          <div class="form-layout form-layout-1">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="usu_nom" id="usu_nom" placeholder="Nombre" required>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Apellido Paterno: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="usu_apep" id="usu_apep" placeholder="Apellido Paterno">
                </div>
              </div>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Apellido Materno: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="usu_apem" id="usu_apem" placeholder="Apellido Materno">
                </div>
              </div>

              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Correo Electrónico: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="usu_correo" id="usu_correo" readonly>
                </div>
              </div>

              <?php
              if ($_SESSION["rol_id"] == '2') {
                ?>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Cédula: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="number" name="usu_ci" id="usu_ci">
                  </div>
                </div>

                <?php
              } else {
                ?>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label">Cédula: <span class="tx-danger">*</span></label>
                    <input class="form-control" type="number" name="usu_ci" id="usu_ci" readonly>
                  </div>
                </div>
                <?php
              }
              ?>
              <div class="col-lg-4">
                <div class="form-group">
                  <label class="form-control-label">Teléfono: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="number" name="usu_telf" id="usu_telf" placeholder="Ingrese Telefono">
                </div>
              </div>
              <div class="col-lg-4">
                <label class="form-control-label">Nivel Académico: <span class="tx-danger">*</span></label>
                <div class="form-floating">
                  <select class="form-control" aria-label="Floating label select example" name="aclevel_id"
                    id="aclevel_id">
                    <option selected>Seleccione</option>
                    <option value="1">Estudiante</option>
                    <option value="2">Maestría</option>
                    <option value="3">Doctorado</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-4">
                <label class="form-control-label">Facultad: </label>
                <div class="form-floating">
                  <select class="form-control" name="facultad_id" id="facultad_id"
                    aria-label="Floating label select example" onchange="mostrarOcultarCarrera()">
                    <option selected>Seleccione</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-4" id="divCarrera" style="display: none;">
                <label class="form-control-label">Carrera: </label>
                <div class="form-floating">
                  <select class="form-control" name="carrera_id" id="carrera_id"
                    aria-label="Floating label select example">
                    <option value="0" selected>Seleccione</option>
                  </select>
                </div>
              </div>

              <div class="col-lg-4" id="divOtraCarrera" style="display: none;">
                <div class="form-group">
                  <label class="form-control-label">Escriba su Organización: <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="usu_otracarrera" id="usu_otracarrera">

                </div>
              </div>

              <div class="col-lg-4">
                <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
                <div class="form-floating">
                  <select class="form-control" name="usu_sex" id="usu_sex" aria-label="Floating label select example">
                    <option selected>Seleccione</option>
                    <option value="F">Femenino</option>
                    <option value="M">Masculino</option>
                  </select>
                </div>
              </div>

            </div>

            <div class="form-layout-footer">
              <button class="btn btn-info" id="btnactualizar">Actualizar</button>
              </br></br>
              <div class="form-group">
                <button id="btnresetp" name="btnresetp"
                  class="btn btn-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" onclick="resetpass()">
                  <i class="fa fa-key"></i> Cambiar Contraseña</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <?php require_once("reset_password.php"); ?>
    <?php require_once("../html/MainJs.php"); ?>
    <script type="text/javascript" src="usuperfil.js"></script>
  </body>

  </html>
  <?php
} else {
  /* Si no a iniciado sesion se redireccionada a la ventana principal */
  header("Location:" . Conectar::ruta() . "view/404/");
}
?>

