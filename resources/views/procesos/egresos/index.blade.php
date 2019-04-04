@extends ('layouts.admin')
@section ('contenido')

	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
			<a href="../procesos/egresos/create"><button class="btn btn-success btn-lg">egresos a Caja</button></a>
		
		</div>
		
	</div>
	<div class="row">
		<br> </br>
			@include('procesos.egresos.search')
	</div>


<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Iddetalle</th>	
					<th>Idcaja</th>					
					<th>monto</th>
					<th>tipo</th>
					<th>fecha egresos</th>
					<th>descripcion</th>
					<th>usuario</th>
                                      
				</thead>
               @foreach ($detallecaja as $ing)
				<tr>
					<td>{{ $ing->iddetallecaja}}</td> 
					<td>{{ $ing->idcaja}}</td>                    
                    <td>{{ $ing->monto}}</td>
					<td>{{ $ing->tipo}}</td>
					<td>{{ $ing->fechaapertura}}</td>
					<td>{{ $ing->descripcion}}</td> 
					<td>{{ $ing->iduser}}</td>   
					              	
					<td>
							@if (auth()->user()->idrol=='2')
							<a href="{{URL::action('EgresoController@edit',$ing->iddetallecaja)}}"><button class="btn btn-primary">Imprimir Recibo</button></a>
												   
							<a href="" data-target="#modal-delete-{{$ing->iddetallecaja}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
	
							
							@endif
					</td>
				</tr>
				@include('procesos.egresos.modal')
				@endforeach
			</table>
		</div>
		{{$detallecaja->render()}}
	</div>
</div>

@endsection