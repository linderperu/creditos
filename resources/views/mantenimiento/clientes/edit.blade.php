@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Cliente: {{ $persona->nombres}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($persona,['method'=>'PATCH','route'=>['clientes.update',$persona->idpersona]])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombres</label>
            	<input type="text" name="nombres" class="form-control" value="{{$persona->nombres}}" placeholder="Nombres...">
			</div>
			<div class="form-group">
					<label for="nombre">Documento</label>
					<select name="tipo_documento" class="form-control">
						@if($persona->tipo_documento=='DNI')
						<option value="DNI" selected>DNI</option>
						<option value="RUC">RUC</option>
						@else
						<option value="DNI" >DNI</option>
						<option value="RUC" selected>RUC</option>
						@endif
					</select>
			</div>
			<div class="form-group">
            	<label for="dniruc">Número Documento</label>
            	<input type="text" name="dniruc" class="form-control" maxlength="11" value="{{$persona->dniruc}}" placeholder="DNI/RUC...">
            </div>
            <div class="form-group">
            	<label for="celular">Celular</label>
            	<input type="text" name="celular" class="form-control" maxlength="9" value="{{$persona->celular}}" placeholder="Celular...">
            </div>
            <div class="form-group">
            	<label for="correo">Correo</label>
            	<input type="text" name="correo" class="form-control" value="{{$persona->correo}}" placeholder="Email...">
            </div>
            <div class="form-group">
            	<label for="direccion">Dirección</label>
            	<input type="text" name="direccion" class="form-control" value="{{$persona->direccion}}" placeholder="Dirección...">
            </div>
            <div class="form-group">
            	<label for="distrito">Distrito</label>
            	<input type="text" name="distrito" class="form-control" value="{{$persona->distrito}}" placeholder="Distrito...">
            </div>
            <div class="form-group">
            	<label for="provincia">Provincia</label>
            	<input type="text" name="provincia" class="form-control" value="{{$persona->provincia}}" placeholder="Provincia...">
            </div>
            <div class="form-group">
            	<label for="departamento">Departamento</label>
            <input type="text" name="departamento" class="form-control" value="{{$persona->departamento}}" placeholder="Departamento...">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection