<!-- Exportable Table -->
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    Registro de eventos
                </h2>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="example1">
                        <thead>
                            <tr>
                                <th>Ip</th>
                                <th>Url</th>
                                <th>Navegador</th>
                                <th>Usuario</th>
                                <th>Fecha-Hora</th>                              
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Ip</th>
                                <th>Url</th>
                                <th>Navegador</th>
                                <th>Usuario</th>
                                <th>Fecha-Hora</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php foreach ($eventos as $r) :?>
                                <tr>
                                    <td><?php echo $r->ip; ?></td>
                                    <td><?php echo $r->url; ?></td>
                                    <td><?php echo $r->navegador; ?></td>
                                    <td><?php echo $r->usuario; ?></td>
                                    <td><?php echo $r->fecha_hora; ?></td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #END# Exportable Table -->

<canvas id="myChart" width="400" height="400"></canvas>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
