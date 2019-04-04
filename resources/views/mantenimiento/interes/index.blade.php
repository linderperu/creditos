@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de intereses <a href="../mantenimiento/interes/create"><button class="btn btn-success">Nuevo</button></a></h3>
		@include('mantenimiento.interes.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Idinteres</th>
					<th>Tipo Pago</th>
					<th>Interes (%)</th> 
				</thead>
               @foreach ($interes as $inte)
				<tr>
					<td>{{ $inte->idinteres}}</td>
                    <td>{{ $inte->tipopago}}</td>
                    <td >{{ $inte->interes}}</td> 
					<td>
						<a href="{{URL::action('InteresController@edit',$inte->idinteres)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$inte->idinteres}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('mantenimiento.interes.modal')
				@endforeach
			</table>
		</div>
		{{$interes->render()}}
	</div>
</div>

@endsection