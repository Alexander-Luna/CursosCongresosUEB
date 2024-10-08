<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>
            </div>
            <!-- Formulario Mantenimiento -->
            <form method="post" id="usuario_form">
                <div class="modal-body">
                    <input type="hidden" name="usu_id" id="usu_id" />

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="usu_nom" type="text" name="usu_nom" required />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Apellidos: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="usu_apellidos" type="text" name="usu_apellidos" required />
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nivel Académico: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="aclevel_id" id="aclevel_id">
                                <option label="Seleccione"></option>
                                <option value="1">Estudiante</option>
                                <option value="2">Maestría</option>
                                <option value="3">Doctorado</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Correo: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="usu_correo" type="email" name="usu_correo" required />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
                            <select class="form-control" name="usu_sex" id="usu_sex">
                                <option label="Seleccione"></option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Teléfono: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="usu_telf" type="text" name="usu_telf" required />
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Rol: <span class="tx-danger">*</span></label>
                            <select class="form-control" name="rol_id" id="rol_id">
                                <option label="Seleccione"></option>
                                <option value="1">Usuario</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Cédula: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="usu_ci" type="text" name="usu_ci" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="add"
                        class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i
                            class="fa fa-check"></i> Guardar</button>
                    <button type="reset"
                        class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"
                        aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i>
                        Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>