<div id="modalmantenimiento" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content bd-0">
            <div class="modal-header pd-y-20 pd-x-25">
                <h6 id="lbltitulo" class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold"></h6>
            </div>
            <!-- Formulario Mantenimiento -->
            <form method="post" id="eventos_form">
                <div class="modal-body">
                    <input type="hidden" name="even_id" id="even_id" />
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Dependencia: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="cat_id" id="cat_id">
                                <option label="Seleccione"></option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Tipo de Evento: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="eventype_id" id="eventype_id">
                                <option label="Seleccione"></option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Modalidad: <span class="tx-danger">*</span></label>
                            <select class="form-control select2" style="width:100%" name="modality_id" id="modality_id">
                                <option label="Seleccione"></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Nombre: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="cur_nom" type="text" name="cur_nom" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Descripción: <span class="tx-danger">*</span></label>
                            <textarea class="form-control tx-uppercase" id="cur_descrip" type="text" name="cur_descrip"
                                required></textarea>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Número de horas: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="nhours" type="number" name="nhours" required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Fecha Inicio: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="cur_fechini" type="date" name="cur_fechini"
                                required />
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Fecha Fin: <span class="tx-danger">*</span></label>
                            <input class="form-control" id="cur_fechfin" type="date" name="cur_fechfin"
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
            </form>
        </div>
    </div>
</div>