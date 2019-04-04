@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Rol: {{ $roles->nombre}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($roles,['method'=>'PATCH','route'=>['roles.update',$roles->idrol]])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="nombre">Nombre del Rol</label>
            	<input type="text" name="nombre" class="form-control" value="{{$roles->nombre}}" placeholder="Nombre...">
            </div>
            <div class="form-group">
            	<label for="descripcion">Descripcion</label>	
                <textarea name="descripcion" class="form-control"  placeholder="Descripción..." rows="5" cols="10">{{$roles->descripcion}}</textarea>

			</div>
			
            <div class="form-group">
            	<label for="condicion">Condicion del rol</label>
            <input type="text" name="condicion" class="form-control" value="{{$roles->condicion}}" placeholder="Condición  [0]inactivo  [1] activo...">
            </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection