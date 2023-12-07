<div class="panel panel-default">
	<div class="panel-heading text-center">RESUMEN DEL EVENTO # <?php echo $autorepo->id1 ?></div>
	<div class="panel-body">
		<?php $fvalidacion = date('Y-m-d');	?>
		<div class="col-md-12">
			
			<table class="table table-bordered">
				<tr>
					<!-- <th>Dirigido a</th>-->
					<th>Responsable del evento</th>
					<th>Clasificación</th>
					<th>Descripción del evento</th>
					<th>Correción</th>
					<th>Fecha de evento</th>
					<th>Estado</th>
				</tr>
				<tr>
					<!-- <td><?php echo $autorepo->proceso   ?></td>-->
					<td><?php echo $autorepo->user   ?></td>
					<td><?php echo $autorepo->clasificacionIncidente   ?></td>
					<td><?php echo utf8_encode($autorepo->descEvento)   ?></td>
					<td><?php echo $autorepo->correcionIncidente     ?></td>
					<td><?php echo $autorepo->registro   ?></td>
					<td><?php echo $autorepo->estado   ?></td>
				</tr>
				</th>
				</tr>
				<?php if ($autorepo->estado   == 'Revisión') : ?>
					<tr>
						<th colspan="6" class="text-center active">CARACTERISTICAS DEL INCIDENTE</th>
					</tr>
					<tr>
						<td colspan="2"><?php echo $autorepo->respuesta   ?></td>
						<td colspan="1"><?php echo $autorepo->fechaRespuesta   ?></td>
						<td colspan="1">Conciliación: <?php echo $autorepo->conciliacion   ?></td>
						<td colspan="2">Tipo Acción: <?php echo $autorepo->taccion   ?></td>
					</tr>
				<?php endif; ?>

				<?php if ($autorepo->estado   == 'Rechazado' or $autorepo->estado   == 'Aprobacion') : ?>
					<tr>
						<th colspan="6" class="text-center active">Caracteristicas para la solución del evento</th>
					</tr>
					<tr>
						<td colspan="2">Respuesta: <?php echo  utf8_encode( $autorepo->respuesta)  ?></td>
						<td colspan="1">Fecha: <?php echo $autorepo->fechaRespuesta   ?></td>
						<td colspan="1">Conciliación: <?php echo $autorepo->conciliacion   ?></td>
						<td colspan="2">Tipo Acción: <?php echo utf8_encode($autorepo->taccion)  ?></td>
					</tr>
					<tr>
						<th colspan="6" class="text-center active">Descripción de verificación</th>
					</tr>
					<tr>
						<td colspan="5"><?php echo utf8_encode($autorepo->observacion)  ?></td>
						<td colspan="5"><?php echo $autorepo->fechaValidacion   ?></td>
					</tr>
				<?php endif; ?>
				<?php if (($autorepo->estado   == 'Aprobacion') and (!empty($autorepo->fechaValidacion))) : ?>
					<tr>
					<!-- <tr>
						<th colspan="7" class="text-center active">DESCRIPCION DE LA VALIDACION ANTERIOR</th>
					</tr>
					<td colspan="5"><?php echo utf8_encode($autorepo->observacion)   ?></td>
					<td colspan="5"><?php echo $autorepo->fechaValidacion   ?></td>
					</tr> -->
				<?php endif; ?>
			</table>
			<form action="" name="formRespuesta" id="formRespuesta" method="post">
				<input type="hidden" name="id" id="id" class="form-control" value="<?= $autorepo->id1 ?>">
				<input type="hidden" name="usuario" id="usuario" class="form-control" value="<?= $autorepo->user ?>">
				<?php if ($autorepo->estado   == 'En Tramite' or $autorepo->estado   == 'Rechazado') : ?>
					<div class="col-md-12">
						<input type="hidden" name="estado" id="estado" value="Revisión">
						<input type="hidden" name="fechaRespuesta" id="fechaRespuesta" value="<?= $fvalidacion==''? date("Y-m-d"): $fvalidacion ?>">
						<div class="col-md-3 text-center">
							<fieldset><label>CONCILIACIÓN</label></fieldset>
							<select name="conciliacion" id="conciliacion" class="form-control" required="required">
								<option value="no">NO</option>
								<option value="si">Si</option>
							</select>
						</div>
						<div class="col-md-3 text-center">
							<fieldset><label>TIPO DE ACCIÓN</label></fieldset>
							<select name="taccion" id="taccion" class="form-control" required="required">
								<option value="Corrección">Corrección</option>
								<option value="Acción correctiva">Acción correctiva</option>
							</select>
						</div>
						<div class="col-md-6 text-center">
							<br>
							<label for="">
								Descripción las acciones a tomar</label>
							<textarea name="respuesta" id="respuesta" class="form-control" value="" placeholder="Lo que necesitamos que responda: “por qué paso, que hacer para que no vuelva a pasar y cuando se realiza"></textarea>
						</div>
						<?php
						//debug($recurrente);
						if ($recurrente >= 2) : ?>
							<div class="col-md-4 col-md-offset-4 text-center">
								<p class="text-warning">Advertencia!!<br> el proceso al que hace referencia ya tiene 2 o mas incidentes registrados
									por favor solicite una acción correctiva para continuar</p>
								<button href="" class='btn btn-success'>SOLICITAR ACCION</button>
								<br>
								<label for="">No de la acción correctiva</label>
								<input type="number" name="num_accion_corr" id="num_accion_corr" class="form-control" min="1" value="">
							</div>
						<?php
						else : ?>
							<input type="hidden" name="num_accion_corr" id="num_accion_corr" class="form-control" min="1" value="">
						<?php
						endif;
						?>
					</div>
				<?php endif; ?>
				<?php if ($autorepo->estado == 'Revisión') : ?>
					<div class="col-md-12">

						<div class="col-md-4 col-md-offset-4 text-center">
							<label>Validación de la acción</label>
							<select name="estado" id="estado" class="form-control" required="required">
								<option value="Aprobacion">Aprobacion</option>
								<option value="Rechazado">Rechazado</option>
							</select>
						</div>
						<input type="hidden" name="fechaValidacion" id="fechaValidacion" class="form-control" value="<?= $fvalidacion ?>">
						<?php if ($autorepo->estado   == 'Revisión') : ?>
							<div class="col-md-4 col-md-offset-4 text-center">
								<br>
								<span class="label">Descripción de la validación</span>
								<textarea name="observacion" id="observacion" class="form-control" value=""></textarea>
								<input type="hidden" name="observacion_1" id="observacion_1" class="form-control" value="------">
								<input type="hidden" name="fechaRespuesta" id="fechaRespuesta" class="form-control" value="<?=date('Y-m-d')?>">
							</div>
						<?php endif; ?>
						<?php if ($autorepo->estado   == 'Rechazado') : ?>
							<div class="col-md-4 col-md-offset-4 text-center">
								<br>
								<span class="label">Observación</span>
								<textarea name="observacion_1" id="observacion_1" class="form-control" value=""></textarea>
							</div>
						<?php endif; ?>
						<div class='col-md-4'>
							<input type="hidden" name="usuario" id="usuario" class="form-control" value="<?= $autorepo->user ?>">
						</div>
					<?php endif; ?>
					</div>

					<?php if ($autorepo->estado   == 'Rechazado' or $autorepo->estado   == 'Aprobacion') : ?>


					<?php else : ?>
						<div class="col-md-12 text-center"><br>

							<input type="button" id="guardar" class="btn btn-success" value="Guardar">

						</div>
					<?php endif; ?>
		</div>
		</form>

	</div>


	<script>
		$(document).on('click', '#guardar', function(e) {
			var data = $("#formRespuesta").serialize();
			//var formData = new FormData($("#formRespuesta")[0]);

			$.ajax({
				url: "?c=autoreportes&a=Gestion",
				type: "POST",
				data: data,				
				success: function(data) {
					Swal.fire({
						icon: 'success',
						title: 'BIEN HECHO!!',
						timer: 1500
					}, )
					setTimeout(function() {
						window.location = '?c=autoreportes&a=buscarIndex';
					window.location.reload(1);
					}, 2000)

				}
			});
		});
	</script>