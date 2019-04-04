@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Clientes <a href="../mantenimiento/clientes/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('mantenimiento.clientes.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Tipo Cliente</th>
					<th>Nombres</th>
					<th>TipoDoc</th>					
                    <th>Nro</th>
                    <th>Celular</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Distrito</th>
                    <th>Provincia</th>
					<th>Departamento</th>
					<th>Condicion</th>
                   
				</thead>
               @foreach ($personas as $clie)
				<tr>
					<td>{{ $clie->idpersona}}</td>
					<td>{{ $clie->tipo_persona}}</td>
					<td>{{ $clie->nombres}}</td>
					<td>{{ $clie->tipo_documento}}</td>
                    <td>{{ $clie->dniruc}}</td>
                    <td>{{ $clie->celular}}</td>
                    <td>{{ $clie->correo}}</td>
                    <td>{{ $clie->direccion}}</td>
                    <td>{{ $clie->distrito}}</td>
                    <td>{{ $clie->provincia}}</td>
					<td>{{ $clie->departamento}}</td>
					<td>{{ $clie->condicion}}</td>
					
					<td>
						<a href="{{URL::action('ClienteController@edit',$clie->idpersona)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$clie->idpersona}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('mantenimiento.clientes.modal')
				@endforeach
			</table>
		</div>
		{{$personas->render()}}
	</div>
</div>

@endsection