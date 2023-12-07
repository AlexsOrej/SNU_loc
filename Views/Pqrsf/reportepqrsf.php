<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h2>Exportar a Excel</h2>
                </div>
                <div class="body">
                    <form action="?c=pqrsf&a=export" method="post">
                        <button class="btn btn-guardar" type="submit" name="export">Exportar a Excel</button>
                    </form>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="card">
                <div class="header">
                    <h2>Carga de archivo Excel</h2>
                </div>
                <div class="body">
                    <form method="POST" enctype="multipart/form-data">
                        <input type="file" name="excel_file" required>
                        <br>
                        <input class="btn btn-guardar" type="submit" value="Cargar">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

