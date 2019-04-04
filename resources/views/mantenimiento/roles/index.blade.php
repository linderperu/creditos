@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de roles <a href="../mantenimiento/roles/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('mantenimiento.roles.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>IdRol</th>
					<th>Nombre</th>
					<th>Descripción</th>
                    <th>Condición</th>                  
                   
				</thead>
               @foreach ($roles as $rol)
				<tr>
					<td>{{ $rol->idrol}}</td>
                    <td>{{ $rol->nombre}}</td>
                    <td  bgcolor="F1F1F1">{{ $rol->descripcion}}</td>
                    <td>{{ $rol->condicion}}</td>                    					
					<td>
						<a href="{{URL::action('RolController@edit',$rol->idrol)}}"><button class="btn btn-info" disabled>Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$rol->idrol}}" data-toggle="modal"><button class="btn btn-danger" disabled>Eliminar</button></a>
					</td>
				</tr>
				@include('mantenimiento.roles.modal')
				@endforeach
			</table>
		</div>
		{{$roles->render()}}
	</div>
</div>

@endsection