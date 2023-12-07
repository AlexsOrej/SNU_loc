
    <div class="card">
        <div class="header"></div>
        <div class="body">
            <form class="form-inline">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="desde">Desde</label>
                            <input type="date" name="desde" id="desde" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="hasta">Hasta</label>
                            <input type="date" name="hasta" id="hasta" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 text-center">
                    <button type="button" title="Botón para buscar informes" name="buscar" id="buscar" value="Buscar" class="btn bg-green"><i class="glyphicon glyphicon-search"> </i> Buscar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="contenido"></div>

<script type="text/javascript">
    $('#buscar').on('click', function(e) {
        var desde = $('#desde').val();
        var hasta = $('#hasta').val();
        // var rango = $('#rango').val();
        // Haz algo con los valores desde, hasta y rango
        console.log('Desde:', desde);
        console.log('Hasta:', hasta);
        // console.log('Rango:', rango);
        // Validate the inputs
        if (!desde || !hasta) {
            alert('Por favor, complete todos los campos.');
            return;
        }
        // Convert the dates to milliseconds
        // desde = new Date(desde).getTime();
        // hasta = new Date(hasta).getTime();

        // Check if the 'hasta' date is later than the 'desde' date
        if (hasta < desde) {
            alert('La fecha "Hasta" no puede ser anterior a la fecha "Desde".');
            return;
        }

        // Evita que el formulario se envíe si es un botón dentro de un formulario
        e.preventDefault();
        $.ajax({
            url: "?c=informes&a=InformeResultado",
            type: "GET",
            data: {
                desde: desde,
                hasta: hasta,
            },
            success: function(data) {

                $('#contenido').html(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle the error
            }
        });

        // $.ajax({
        //     url: "?c=informes&a=InformeResultado01",
        //     type: "GET",
        //     data: {
        //         desde: desde,
        //         hasta: hasta,
        //     },
        //     success: function(data) {
        //         $('#contenido0').html(data);

        //     },
        //     error: function(jqXHR, textStatus, errorThrown) {
        //         // Handle the error
        //     }
        // });

    });
</script>