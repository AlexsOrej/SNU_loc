<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Soporte</h3>
    </div>
    <div class="panel-body">
        <form id="form_soporte" name="form-soporte" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">                        
                            <label for="">Nombre Soporte</label>
                            <input type="text" id="soporte_nom" name="soporte_nom" class="form-control">
                            <input type="hidden" id="id" name="id" value="<?=$_REQUEST['id']?>">
                        </div>
                    
                    <div class="col-md-6">                        
                            <label for="">Soporte</label>
                            <input type="file" id="soporte" name="soporte" class="form-control">                       
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>