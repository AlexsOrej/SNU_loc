<div class="card">
    <div class="body">
        <form method="post" name="formNorma" id="formNorma">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="version">Versión</label>
                            <input id="version" class="form-control" type="text" name="version" value="<?= $normas->version ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="descripcion">Descripción</label>
                            <input id="descripcion" class="form-control" type="text" name="descripcion" value="<?= $normas->descripcion ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="publicacion">Publicación</label>
                            <input id="publicacion" class="form-control" type="date" name="publicacion" value="<?= $normas->fecha_publicacion ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <div class="form-line">
                            <label for="actualizacion">Actualización</label>
                            <input id="actualizacion" class="form-control" type="date" name="actualizacion" value="<?= $normas->ultima_actualizacion ?>" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success">Registrar</button>
                    <input id="id" class="form-control" type="hidden" name="id" value="<?= $normas->id ?>">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).on('submit', '#formNorma', function(e) {
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            data: data,
            type: "post",
            url: "?c=normas&a=Registrar",
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: response,
                    timer: 1500,
                    showConfirmButton: false,
                });
                setTimeout(function() {
                    window.location.reload();
                }, 1500)
            }
        });
    });
</script>