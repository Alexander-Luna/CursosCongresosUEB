<div class="br-logo"><a href="../UsuHome/"><span>[</span>Empresa<span>]</span></a></div>

<div class="br-sideleft overflow-y-auto">
  <label class="sidebar-label pd-x-15 mg-t-20">Menu</label>
  <div class="br-sideleft-menu">

    <a href="../UsuHome/" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
        <span class="menu-item-label">Inicio</span>
      </div>
    </a>

    <?php
    if ($_SESSION["rol_id"] == 1) {
      ?>
      <a href="../UsuCurso/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
          <span class="menu-item-label">Mis Eventos</span>
        </div>
      </a>
      <?php
    } else {
      ?>
      <a href="../AdminMntUsuario/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
          <span class="menu-item-label">Usuarios</span>
        </div>
      </a>

      <a href="../AdminMntCurso/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
          <span class="menu-item-label">Eventos</span>
        </div>
      </a>
<!--
      <a href="../AdminMntInstructor/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
          <span class="menu-item-label">Instructores</span>
        </div>
      </a>
    -->
      <a href="../AdminMntDependencia/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
          <span class="menu-item-label">Dependencias</span>
        </div>
      </a>

      <a href="../AdminDetalleCertificado/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
          <span class="menu-item-label">Detalle Certificado</span>
        </div>
      </a>
      <a href="../AdminDetalleAsistencia/" class="br-menu-link">
        <div class="br-menu-item">
          <i class="menu-item-icon icon ion-ios-bookmarks-outline tx-24"></i>
          <span class="menu-item-label">Control Asistencia</span>
        </div>
      </a>
      <?php
    }
    ?>


    <a href="../UsuPerfil/" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-ios-gear-outline tx-20"></i>
        <span class="menu-item-label">Perfil</span>
      </div>
    </a>

    <a href="../html/Logout.php" class="br-menu-link">
      <div class="br-menu-item">
        <i class="menu-item-icon icon ion-power tx-20"></i>
        <span class="menu-item-label">Cerrar Sesión</span>
      </div>
    </a>

  </div>
</div>