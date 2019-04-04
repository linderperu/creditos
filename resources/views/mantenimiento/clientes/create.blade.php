@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo cliente (*  campos obligatorios)</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'mantenimiento/clientes','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombres">Nombres *</label>
            	<input type="text" name="nombres" class="form-control" placeholder="Nombres..." maxlength="100">
            </div>
            <div class="form-group">
                <label for="nombres">Documento *</label>
               <select name="tipo_documento" class="form-control">
                       <option value="DNI">DNI</option>
                       <option value="RUC">RUC</option>
               </select>
            </div>
            <div class="form-group">
                <label for="dniruc">DNI/RUC *</label>
                <input type="text" name="dniruc" class="form-control" maxlength="11" placeholder="DNI o RUC..." required pattern="[0-9]+" title="No juegue ingrese DNI/RUC valido">
            </div>
            <div class="form-group">
            	<label for="celular">Celular</label>
            	<input type="tel" name="celular" class="form-control" pattern="[0-9]{9}" placeholder="Celular..." title="No juegue ingrese Nro Cel. valido">
            </div>
            <div class="form-group">
                    <label for="correo">Correo</label>
                    <input type="email" name="correo" class="form-control" placeholder="email...">
            </div>
            <div class="form-group">
                    <label for="direccion">Dirección *</label>
                    <input type="text" name="direccion" class="form-control" placeholder="Direccion...">
            </div>
            <div class="form-group">
                    <label for="distrito">Distrito *</label>
                    <input type="text" name="distrito" class="form-control" placeholder="Distrito...">
            </div>
            <div class="form-group">
                    <label for="provincia">Provincia *</label>
                    <input type="text" name="provincia" class="form-control" placeholder="Provincia...">
             </div>
             <div class="form-group">
                    <label for="departamento">Departamento *</label>
                    <input type="text" name="departamento" class="form-control" placeholder="Departamento...">
             </div>

            <div class="form-group">
            	<button class="btn btn-primary btn-lg" type="submit">Guardar</button>
                    <button class="btn btn-danger btn-lg" type="reset">Cancelar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default btn-lg">Volver</a>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection