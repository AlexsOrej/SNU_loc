<?php //print_r($unidades); ?>
<script>
	$(document).ready(function() {
		$('.selector').select2();
	});
</script>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Crear Ficha de Insumo</h3>
	</div>
	<div class="panel-body">
		<form action="" name="formdata" id="formdata" method="POST">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-3">
						<label for="unidad">Tipo de Insumo:</label>
						<select class="form-control" id="tipo_insumo" name="tipo_insumo" required>
							<option value="">Seleccionar</option>
							<? foreach ($tipoinsumo as $tipo) : ?>
								<option value="<?= $tipo->id ?>"><?= $tipo->tipo_insumo?></option>
							<? endforeach; ?>
						</select>
					</div>

					<div class="col-md-3">
						<div class=" "><input type="hidden" class="form-control" id="id" name="id">
							<label for="nombre">Nombre/Referencia:</label>
							<input type="text" class="form-control" id="nombre" name="nombre" required>
						</div>
					</div>

					<div class="col-md-3">
						<label for="unidad">Unidad:</label>
						<select class="selector form-control" id="unidad" name="unidad" required>
							<option value="">Seleccionar</option>
							<? foreach ($unidades as $unidad) : ?>
								<option value="<?php echo $unidad->id ?>"><?php echo $unidad->abreviatura . '-' . $unidad->nombre ?></option>
							<? endforeach; ?>
						</select>
					</div>
					<div class="col-md-3">
						<div id="presenta">
							<label for="ref_presentacion">Presentación:</label>
							<select name="" id="" class="selector form-control" required="required">
								<option value="">Seleccionar</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="col-md-3">
						<div class=" ">
							<label for="fecha_ingreso">Fecha Ingreso:</label>
							<input type="date" onblur="validarFecha()" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
						</div>
					</div>

					<div class="col-md-3">
						<div class=" ">
							<label for="stock_minimo">Stock Mínimo:</label>
							<input type="number" class="form-control" id="stock_minimo" name="stock_minimo" required>
						</div>
					</div>

					<div class="col-md-3">
						<div class=" ">
							<label for="stock_maximo">Stock Máximo:</label>
							<input type="number" class="form-control" id="stock_maximo" name="stock_maximo" required>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<br>
					<button type="submit" style="width:100%;" class="btn btn-guardar btn-block">Registrar</button>
				</div>

			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
		$("#formdata").submit(function(event) {
			event.preventDefault();
			if (validarFormulario()) {
				enviarFormulario();
			}
		});
	});

	function validarFormulario() {
		var valido = true;
		$("#formdata input[required]").each(function() {
			if ($.trim($(this).val()) == '') {
				$(this).addClass("is-invalid");
				valido = false;
			} else {
				$(this).removeClass("is-invalid");
			}
		});
		return valido;
	}

	function enviarFormulario() {
		var datos = $("#formdata").serialize();
		$.ajax({
			url: "?c=rotativos&a=registrar",
			type: "post",
			data: datos,
			success: function(data) {
				if (data === " existe") {
					Swal.fire({
						icon: 'error',
						title: 'Error',
						text: 'Ya existe un insumo con el mismo nombre.',
					});
					var nombre = document.getElementById('nombre');
					nombre.focus();
					var label = document.querySelector("label[for='nombre']");
					label.style.color = "red";

				} else {
					Swal.fire({
						icon: 'success',
						title: 'El item se registro con éxito',
						timer: 1500,
						showConfirmButton: false,
					})
					setTimeout(function() {
					window.location = '?c=rotativos&a=index';
					}, 1500)
				}
			},
			error: function() {
				alert("Error al procesar el formulario.");
			}
		});
	}
	const form = document.querySelector('form');
	const stockMinInput = document.querySelector('#stock_minimo');
	const stockMaxInput = document.querySelector('#stock_maximo');
	const tipoinsumo = document.querySelector('#tipo_insumo');
	const presentacion = document.querySelector('#ref_presentacion');

	stockMaxInput.addEventListener('blur', () => {
		const stockMin = parseInt(stockMinInput.value);
		const stockMax = parseInt(stockMaxInput.value);
		if (isNaN(stockMin) || isNaN(stockMax)) {
			alert('Por favor ingrese números válidos');
		} else if (stockMax < stockMin) {
			alert('El stock máximo no puede ser menor que el stock mínimo');
			stockMaxInput.value = '';
		}
	});

	tipoinsumo.addEventListener('change', () => {
		const tipo = tipoinsumo.value;
		tipo != ''
		$.ajax({
			url: '?c=rotativos&a=presentaciones',
			data: {
				tipo: tipo
			},
			success: function(r) {
				$('#presenta').html(r);
			}
		})
	})

	function validarFecha() {
		var fechaIngresada = document.getElementById("fecha_ingreso").value;
		var fechaActual = new Date();
		var yearActual = fechaActual.getFullYear();

		// Obtener el año de la fecha ingresada
		var yearIngresado = parseInt(fechaIngresada.substring(0, 4));

		if (yearIngresado < yearActual) {
			// La fecha ingresada es anterior al año actual
			alert("La fecha no puede ser anterior al año actual.");
			document.getElementById("fecha_ingreso").value = "";
			return false;
		}

		return true;
	}
</script>
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																														