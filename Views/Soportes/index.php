<div class="row clearfix">    
    <div class="col-md-6">
        <div class="card">
            <div class="header align-center">
                Documentos Soporte
            </div>
            <div class="body">
                <form id="frm-Usuario" name="frm-Usuario" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id1" value="<?= $alm->id; ?>" />
                    <input name="usuario" value="<?= $alm->usuario; ?>" type="hidden" class="form-control" placeholder="" />
                    <input name="user" value="<?= $_REQUEST['id']; ?>" type="hidden" class="form-control" placeholder="" />
                    <input name="cedula" value="<?= $alm->cedula; ?>" type="hidden" class="form-control" placeholder="" />
                    <input name="usuario_tipo" value="<?= $alm->usuario_tipo; ?>" type="hidden" class="form-control" placeholder="" />
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Documento Identificación</label>
                                    <input name="file_cedula" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--cedula-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Seguridad Social</label>
                                    <input name="file_eps_afp" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--eps-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Certificado Policia Nacional</label>
                                    <input name="file_policia" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--policia-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Certificado Procuradoria</label>
                                    <input name="file_procuraduria" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--procura-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Certificado Contraloria</label>
                                    <input name="file_contraloria" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--contralo-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Experiencia laboral</label>
                                    <input name="file_ref_laboral" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--laboral-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Educación(Universidad)</label>
                                    <input name="file_diploma" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--diploma-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Educación(Bachiller)</label>
                                    <input name="file_acta" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--acta-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Libreta Militar</label>
                                    <input name="file_militar" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--formacion academica-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Formación Academica</label>
                                    <input name="file_facademico" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--libreta-->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="form-line">
                                    <label>Examen Medico</label>
                                    <input name="file_servicios" type="file" value="" class="form-control" placeholder="" readonly />
                                </div>
                            </div>
                        </div>
                        <!--recibo-->
                        <div class="col-md-12">
                            <input type="button" name="registro" class="btn btn-primary btn-block upload" value="Registrar" />
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col-md-6">
        <div class="card">
            <div class="header align-center">
                Soportes Agregados
            </div>
            <div class="body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-4">
                            <div class="form-group">
                                <?
                                $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_cedula.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_cedula.pdf" title="Cedula" data-toggle="popover" data-trigger="hover" data-content="Ver cedula" target="_blank">Documento Identficación</a>

                                <? } ?>
                            </div>
                        </div>
                        <!--cedula-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <? $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_eps_afp.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_eps_afp.pdf" title="Certificado EPS/Fondo de Pensiones" data-toggle="popover" data-trigger="hover" data-content="Certificado EPS/Fondo de Pensiones" target="_blank">Seguridad Social</a>
                                <?  }  ?>
                            </div>
                        </div>
                        <!--eps-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <? $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_policia.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_policia.pdf" title="Archivo de antecedentes" data-toggle="popover" data-trigger="hover" data-content="Archivo de antecedentes" target="_blank">Certificado Policia Nacional</a>
                                <? } ?>
                            </div>
                        </div>
                        <!--policia-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <?
                                $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_contraloria.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_contraloria.pdf" title="Archivo de antecedentes" data-toggle="popover" data-trigger="hover" data-content="Archivo de antecedentes" target="_blank">Certificado Contraloria</a>
                                <? } ?>

                            </div>
                        </div>
                        <!--contralo-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <?
                                $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_procuraduria.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_procuraduria.pdf" title="Archivo de antecedentes" data-toggle="popover" data-trigger="hover" data-content="Archivo de antecedentes" target="_blank">Certificado Procuradoria</a>
                                <? } ?>
                            </div>
                        </div>
                        <!--procura-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <? $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_ref_laboral.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_ref_laboral.pdf" title="Referencia laboral" data-toggle="popover" data-trigger="hover" data-content="Referencia laboral" target="_blank">Experiencia laboral</a>
                                <?  } ?>
                            </div>
                        </div>
                        <!--laboral-->
                        <div class="col-md-4">
                            <div class="form-group">

                                <?
                                $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_acta.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_acta.pdf" title="Diploma bachiller" data-toggle="popover" data-trigger="hover" data-content="Diploma bachiller" target="_blank">Educación(Bachiller)</a>
                                <? } ?>

                            </div>
                        </div>
                        <!--acta-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <?
                                $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_diploma.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_diploma.pdf" title="Diploma bachiller" data-toggle="popover" data-trigger="hover" data-content="Diploma bachiller" target="_blank">Educación(Universidad)</a>
                                <? } ?>

                            </div>
                        </div>
                        <!--diploma-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <?
                                $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_facademico.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_facademico.pdf" title="formacion Academica" data-toggle="popover" data-trigger="hover" data-content="Formacion Academica" target="_blank">Formación Academica</a>
                                <? } ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">

                                <? $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_militar.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_militar.pdf" title="Libreta Militar" data-toggle="popover" data-trigger="hover" data-content="Libreta Militar" target="_blank">Libreta Militar</a>
                                <? } ?>
                            </div>
                        </div>
                        <!--libreta-->
                        <div class="col-md-4">
                            <div class="form-group">
                                <? $nombre_fichero = 'Assets/soportes/' . $alm->cedula . '/file_servicios.pdf';
                                if (file_exists($nombre_fichero)) { ?>
                                    <a href="Assets/soportes/<?= $alm->cedula; ?>/file_servicios.pdf" title="Libreta Militar" data-toggle="popover" data-trigger="hover" data-content="Libreta Militar" target="_blank">Examen Medico</a>
                                <? } ?>
                            </div>
                        </div>
                        <!--recibo-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Textarea -->
<script>
    $(document).ready(function() {
        $(".upload").on('click', function() {
            var formData = new FormData($("#frm-Usuario")[0]);
            $.ajax({
                url: '?c=soportes&a=Subir',
                type: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        $(".card-img-top").attr("src", response);
                        Swal.fire({
                            icon: 'success',
                            title: 'los Documentos subieron con éxito',
                            timer: 1500
                        }, )
                        setTimeout(function() {
                            window.location.reload();
                        }, 1500)
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'El formato de la imagen es incorrecto, usa jpg o jpeg',
                            timer: 1500
                        }, )
                    }
                }
            });
            return false;
        });
    });


    $('#nuevo').on('click', function() {
        $.ajax({
            type: "POST",
            url: '?c=soportes&a=indexnew',
            data: 'id=' + <?= $_REQUEST['id'] ?>,
            beforeSend: function() {
                $('#respuesta').html("<div class='text-center'> <div class='preloader'><div class='spinner-layer pl-red'><div class='circle-clipper left'><div class='circle'></div></div><div class='circle-clipper right'><div class='circle'></div></div></div></div><p>Cargando Información</p> </div>");
            },
            success: function(resp) {
                $('#respuesta').html(resp);
                // $('#respuesta0').hide(resp);
            }
        });
    });
</script>