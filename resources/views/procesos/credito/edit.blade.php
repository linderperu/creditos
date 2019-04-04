@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Empleado: {{ $empleado->nombres}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($credito,['method'=>'PATCH','route'=>['empleado.update',$credito->idcredito]])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombres</label>
            	<input type="text" name="nombres" class="form-control" value="{{$cliente->nombres}}" placeholder="Nombres...">
            </div>
            <div class="form-group">
            	<label for="apellidos">Apellidos</label>
            	<input type="text" name="apellidos" class="form-control" value="{{$cliente->apellidos}}" placeholder="Apellidos...">
			</div>
			<div class="form-group">
            	<label for="dniruc">DNI/RUC</label>
            	<input type="text" name="dniruc" class="form-control" value="{{$cliente->dniruc}}" placeholder="DNI/RUC...">
            </div>
            <div class="form-group">
            	<label for="celular">Celular</label>
            	<input type="text" name="celular" class="form-control" value="{{$cliente->celular}}" placeholder="Celular...">
            </div>
            <div class="form-group">
            	<label for="correo">Correo</label>
            	<input type="text" name="correo" class="form-control" value="{{$cliente->correo}}" placeholder="Email...">
            </div>
            <div class="form-group">
            	<label for="direccion">Dirección</label>
            	<input type="text" name="direccion" class="form-control" value="{{$cliente->direccion}}" placeholder="Dirección...">
            </div>
            <div class="form-group">
            	<label for="distrito">Distrito</label>
            	<input type="text" name="distrito" class="form-control" value="{{$cliente->distrito}}" placeholder="Distrito...">
            </div>
            <div class="form-group">
            	<label for="provincia">Provincia</label>
            	<input type="text" name="provincia" class="form-control" value="{{$cliente->provincia}}" placeholder="Provincia...">
            </div>
            <div class="form-group">
            	<label for="departamento">Departamento</label>
            <input type="text" name="departamento" class="form-control" value="{{$cliente->departamento}}" placeholder="Departamento...">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
				<a href="{{ url()->previous() }}" class="btn btn-default">Volver</a>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection