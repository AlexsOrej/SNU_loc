<div class="col-md-12">
    <div class="card">
        <div class="body">
            <div class="row text-center">
                <div class="col-md-4">
                    Inicios de sesión desde: <u><? echo $totalvisitas->desde = date('Y-m-d', strtotime($totalvisitas->desde)) ?></u><br>
                    <span class="badge bg-orange "><? echo number_format($totalvisitas->cantidad) ?></span>
                </div>
                <div class="col-md-4">
                    Inicios de sesión ultimos <strong>7 dias</strong>: <u><? echo $totalvisitas7dias->desde = date('Y-m-d', strtotime($totalvisitas7dias->desde));                                                                            ?></u><br>
                    <span class="badge bg-orange "><? echo number_format($totalvisitas7dias->cantidad) ?></span>
                </div>
                <div class="col-md-4">
                    Inicios de sesión <strong>hoy</strong><br>
                    <span class="badge bg-orange "><? echo number_format($totalvisitasdiaActual->cantidad) ?></span>
                </div>
            </div>
        </div>
    </div>
</div>