<!DOCTYPE html>
<html lang="es" class="pos-relative">

<head>
    <?php require_once("../html/MainHead.php");

    $even_id = $_GET["even_id"];
    ?>

    <title>Certificado</title>
</head>

<body class="pos-relative">
    <script>
        let even_id = <?php echo $even_id; ?>;
    </script>
    <input class="form-control" type="hidden" name="even_id" id="even_id" value='<?php echo $even_id; ?>'>

    <div class="form-layout form-layout-1">
        <div class="row mg-b-25">

            <div class="col-lg-2" id="divPDF" style="background-color: #ffffff;">
                <div class="form-group row">
                    <h6 class="col-lg-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-4">QR</h6>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">X: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="xqr" id="xqr" placeholder="0" value="0" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Y: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="yqr" id="yqr" placeholder="0" value="0" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <h6 class="col-lg-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Nombres</h6>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">X: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="xnombres" id="xnombres" placeholder="0" value="0" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Y: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="ynombres" id="ynombres" placeholder="0" value="0" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <h6 class="col-lg-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Cédula</h6>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">X: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="xci" id="xci" placeholder="0" value="0" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Y: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="yci" id="yci" placeholder="0" value="0" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <h6 class="col-lg-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Evento</h6>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">X: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="xevento" id="xevento" placeholder="0" value="0" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Y: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="yevento" id="yevento" placeholder="0" value="0" required>
                        </div>
                    </div>
                    <div class="form-group row  mg-5">
                        <h6 class="col-lg-12 tx-gray-800 tx-uppercase tx-bold tx-10 mg-b-10">Margenes</h6>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Izquierdo: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="mieven" id="mieven" placeholder="0" value="0" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Derecho: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="mdeven" id="mdeven" placeholder="0" value="0" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <h6 class="col-lg-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Descripción</h6>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">X: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="xdescripcion" id="xdescripcion" placeholder="0" value="0" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Y: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="ydescripcion" id="ydescripcion" placeholder="0" value="0" required>
                        </div>
                    </div>
                    <div class="form-group row  mg-5">
                        <h6 class="col-lg-12 tx-gray-800 tx-uppercase tx-bold tx-10 mg-b-10">Margenes</h6>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Izquierdo: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="midesc" id="midesc" placeholder="0" value="0" required>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Derecho: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="mddesc" id="mddesc" placeholder="0" value="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <h6 class="col-lg-12 tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Dependencia</h6>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">X: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="xfacultad" id="xfacultad" placeholder="0" value="0" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-control-label">Y: <span class="tx-danger">*</span></label>
                            <input class="form-control" type="text" name="yfacultad" id="yfacultad" placeholder="0" value="0" required>
                        </div>
                    </div>
                </div>
                <div class="col-lg-10">
                    <label class="form-control-label">&nbsp;</label>
                    <button class="btn btn-outline-success form-control" id="add_button1" onclick="guardarCoordenadas(true)"><i class="icon ion-android-upload"></i> Guardar Cambios</button>
                </div>
            </div>

            <div class="col-lg-10" id="divPDF">
                <div class="form-group">
                    <iframe id='miIframe' name='miIframe' src="../Certificado/index.php?even_id=<?php echo $even_id; ?>" width="100%" height="1000px" frameborder="0"></iframe>
                </div>
            </div>



        </div>
    </div>

    <?php require_once("../html/MainJs.php"); ?>
    <script type="text/javascript" src="admineditcertificado.js"></script>
</body>

</html>