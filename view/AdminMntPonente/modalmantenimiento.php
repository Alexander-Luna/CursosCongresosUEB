<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>
            </div>
            <!-- Formulario Mantenimiento -->
            <form method="post" id="ponente_form">
                <div class="modal-body">
                    <input type="hidden" name="ponen_id" id="ponen_id" value="<?php echo $even_id; ?>"/>
                    <input type="hidden" name="even_id" id="even_id"/>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nombres y Apellidos: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="ponen_names" type="text" name="ponen_names" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Titulo: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="ponen_titulo" type="text" name="ponen_titulo" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Descripción: <span class="tx-danger">*</span></label>
                            <textarea class="form-control tx-uppercase" id="ponen_description" type="text" name="ponen_description" required></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Correo: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="ponen_correo" type="email" name="ponen_correo" required/>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Sexo: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="ponen_sex" id="ponen_sex" data-placeholder="Seleccione">
                                <option label="Seleccione"></option>
                                <option value="M">Masculino</option>
                                <option value="F">Femenino</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Teléfono: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="ponen_telf" type="text" name="ponen_telf" required/>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Fecha Exposición: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="ponen_fechaexpo" type="date" name="ponen_fechaexpo" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Hora: <span class="tx-danger">*</span></label>
                            <input class="form-control tx-uppercase" id="ponen_time" type="time" name="ponen_time" required />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="action" value="add" class="btn btn-outline-primary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium"><i class="fa fa-check"></i> Guardar</button>
                    <button type="reset" class="btn btn-outline-secondary tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" aria-label="Close" aria-hidden="true" data-dismiss="modal"><i class="fa fa-close"></i> Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>