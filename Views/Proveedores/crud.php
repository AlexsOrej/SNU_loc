<form id="form_proveedor" name="form_proveedor">
    <div class="row">
        <div class="col-md-12 align-center"><h3>Registrar Proveedor</h3><br></div>
        <div class="col-md-12">
            <div class="col-md-4">
                <label for="">Nit/identificación</label>                
                <input type="text" id="nit" name="nit" class="form-control"  value="<?=$proveedor->nit?>"  required  >
            </div>
            <div class="col-md-4">
                <label for="">Tipo Servicio</label>
                <input type="hidden" id="id" name="id" class="form-control" value="<?=$proveedor->id?>">
                <input type="text" id="tiposervicio" name="tiposervicio" class="form-control"  value="<?=$proveedor->tipo_servicio?>"  required  >
            </div>
            <div class="col-md-4">
                <label for="">Nombre del Proveedor</label>
                <input type="text" id="nombre" name="nombre" class="form-control" value="<?=$proveedor->nombre?>"  required  >
            </div>
            <div class="col-md-4">
                <label for="">Dirección</label>
                <input type="text" id="direccion" name="direccion" class="form-control" value="<?=$proveedor->direccion?>"  required  >
            </div>
            <div class="col-md-4">
                <label for="">Ciudad</label>
                <input type="text" id="ciudad" name="ciudad" class="form-control" value="<?=$proveedor->ciudad?>"  required  >
            </div>
            <div class="col-md-4">
                <label for="">Estado </label>
                <input type="text" id="estado" name="estado" class="form-control" value="<?=$proveedor->estado?>"  required  >
            </div>
            <div class="col-md-4">
                <label for="">Pais </label>
                <input type="text" id="pais" name="pais" class="form-control" value="<?=$proveedor->pais?>"  required  >
            </div>
            <div class="col-md-4">
                <label for="">Telefono</label>
                <input type="number" id="telefono" name="telefono" class="form-control" value="<?=$proveedor->telefono?>"  required  >
            </div>
            <div class="col-md-4">
                <label for="">Correo</label>
                <input type="email" id="correo" name="correo" class="form-control" value="<?=$proveedor->email?>"  required  >
            </div>
            <div class="col-md-4">
                <label for="">Persona Contacto</label>
                <input type="text" id="contacto" name="contacto" class="form-control" value="<?=$proveedor->contacto?>"  required  >
            </div>
        </div>
    </div>
</form>
