@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Créditos Credicash 
			<a href="../procesos/credito/create"><button class="btn btn-success">Nuevo crédito</button></a>			
		</h3>	
	</div>	
</div>		
			@include('procesos.credito.search')
			<br>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>IdCredito</th>
					<th>Cliente</th>
					<th>DNI/RUC</th>
					<th>Analista</th>
                    <th>idCaj</th>
					<th>tipopago</th>
					<th>Monto</th>
                    <th>Interes</th>
                    <th>FechaCred</th>
                    <th>NroCuotas</th>
                    <th>cuotas</th>
					<th>tipocredito</th>
					<th>prenda</th>	
				</thead>
               @foreach ($credito as $credi)
				<tr>
					<td>{{ $credi->idcredito}}</td>
					<td>{{ $credi->nombres}}</td>
					<td>{{ $credi->dniruc}}</td>
                    <td>{{ $credi->name}}</td>
                    <td>{{ $credi->idcajero}}</td>
					<td>{{ $credi->tipopago}}</td>
					<td>{{ $credi->monto}}</td>
                    <td>{{ $credi->interes}}</td>
                    <td>{{ date("d/m/Y",strtotime($credi->fechacredito))}}</td>
                    <td>{{ $credi->numerocuotas}}</td>
                    <td>{{ $credi->cuotas}}</td>
                    <td>{{ $credi->tipocredito}}</td>
					<td>{{ $credi->prenda}}</td>					

					<td>
						<a href="{{URL::action('CreditoController@edit',$credi->idcredito)}}"><button class="btn btn-info" disabled>Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$credi->idcredito}}" data-toggle="modal"><button class="btn btn-danger" <?php if(auth()->user()->idrol=='3'||auth()->user()->id!=$credi->idcajero){echo 'disabled';}?>>Eliminar</button></a>
					</td>
				</tr>
				@include('procesos.credito.modal')
				@endforeach
			</table>
		</div>
		{{$credito->render()}}
	</div>
</div>

@endsection