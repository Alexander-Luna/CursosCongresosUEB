<div id="reset_password" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Cambiar Contraseña</h6>
            </div>
            <!-- Formulario Mantenimiento -->
            <form method="post" id="usuario_form">
                <div class="modal-body">
                    <input type="hidden" name="usu_id" id="usu_id" />
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nueva Contraseña: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="usu_pass1" type="password" name="usu_pass1"
                                required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Confirmar Contraseña: <span
                                    class="tx-danger">*</span></label>
                            <input class="form-control" id="usu_pass" type="password" name="usu_pass"
                                required />
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
        </div>

        </form>
    </div>
</div>
</div>