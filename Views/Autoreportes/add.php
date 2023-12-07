<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">REGISTRO DEL EVENTO</h3>
	</div>
	<div class="panel-body">
		<form action="" name="formautoreporte" id="formautoreporte" method="post">
			<div class="row clearfix">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="col-sm-4">
						<div class="form-group">
							<div class="form-line">
								<label>Proceso Vinculado</label>
								<select name="proceso" id="proceso" class="form-control" required>
									<option value="">Seleccionar</option>
									<?php foreach ($procesos as $proceso) : ?>
										<option value="<?= $proceso->id ?>"><?= $proceso->Iniciales . '-' .$proceso->NombreProceso  ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group" id="responsable"></div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<div class="form-line">
								<label>Clasificación del evento</label>
								<select name="evento" id="evento" class="form-control" required>
									<option value="">Seleccionar</option>
									<?php foreach ($cat_eventos as $cat_evento) : ?>
										<option value="<?= $cat_evento->sigla ?>"><?= $cat_evento->sigla . '-' . utf8_encode($cat_evento->nombreevento)  ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-4" id="cat_evento">
						<!-- <div class="form-group" id="cat_evento">
							
						</div> -->
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<div class="form-line" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="bottom" title="" data-content="¿En que sede fue?¿En que lugar sucedio?">
								<label>Sede y área del evento</label>
								<input name="lugarEvento" id="lugarEvento" placeholder="Describir lugar" cols="0" rows="0" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group" data-trigger="focus" data-container="body" data-toggle="popover" data-placement="bottom" title="" data-content="Describir detalladamente el evento indicando claramente las circunstancias que le dieron lugar. Al escribir la descripcion del evento por favor trate de responder las preguntas ¿Como, cuando, donde? de la manera mas precisa. Tiene un limite de 2000 caracteres" data-original-title="Descripcion">
							<div class="form-line">
								<label>Descripción del evento</label>
								<textarea name="descEvento" id="descEvento" placeholder="Descripcion puntual del evento" cols="0" rows="0" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<input type="hidden" name="estado" id="estado" class="form-control" value="En Tramite">
					<input type="hidden" name="fechaRegistro" id="fechaRegistro" class="form-control" value="<?= date('Y-m-d') ?>">
					<input type="hidden" name="usuario" id="usuario" class="form-control" value="<?= $_SESSION['user']->FullName ?>">
					<input type="button" id="guardar" class="btn btn-success" value="Guardar">
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$('#proceso').on('change', function() {
		var proc = document.getElementById("proceso").value
		$.ajax({
			type: "POST",
			url: '?c=autoreportes&a=proceso_reponsable',
			data: {
				proceso: proc,
			},
			beforeSend: function() {
				$('#responsable').html("<h5 class='text-center'>  Cargando Información</h5>");
			},
			success: function(resp) {
				$('#responsable').html(resp);
				$('#respuesta').html("");
			}
		});
	});


	$('#evento').on('change', function() {
		var sigla = document.getElementById("evento").value
		$.ajax({
			type: "POST",
			url: '?c=autoreportes&a=evento',
			data: {
				sigla: sigla,
			},
			beforeSend: function() {
				$('#cat_evento').html("<h5 class='text-center'>  Cargando Información</h5>");
			},
			success: function(resp) {
				$('#cat_evento').html(resp);
				$('#').html("");
			}
		});
	});

	$(document).on('click', '#guardar', function(e) {
		if(($('#proceso').val() !="")  && ($('#evento').val() !="") && ($('#lugarEvento').val() !="")&& ($('#descEvento').val() !="")){
		var formData = new FormData($("#formautoreporte")[0]);
		$.ajax({
			url: "?c=autoreportes&a=Registrar",
			type: "POST",
			data: formData,
			contentType: false,
			cache: false,
			processData: false,
			success: function(data) {
				Swal.fire({
					icon: 'success',
					title: 'BIEN HECHO!!',
					timer: 1200,
					showConfirmButton: false,
				}, )
				setTimeout(function() {
					window.location = '?c=autoreportes&a=buscarIndex';
				}, 1501)

			}
		});
	}else{
		Swal.fire({
					icon: 'error',
					title: 'Recuerda que todos los campos son obligatorios',
					timer: 1200
				}, )
	}
	});
</script>

