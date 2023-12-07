<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">::Soportes::</h3>
    </div>
    <div class="panel-body">
        <form id="form_soporte" name="form-soporte" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <? foreach ($vsoporte as $value) :
                        $ruta = $_REQUEST['url'] . '/' . $value; ?>
                        <div class="col-md-4">
                            <ul>
                                <li>
                                    <a href="<?= $ruta ?>" target="_blank"><?= ucwords($value) ?></a>
                                </li>
                            </ul>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        </form>
    </div>
</div>