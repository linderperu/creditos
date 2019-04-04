@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<!--<h3>Listado de cobranza<a href="/procesos/cobro/create"><button class="btn btn-success">Nuevo</button></a></h3> -->
	<center>	<h2>Listado de cobranza para hoy: <?php
			setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
			$d = now();
			$fecha = strftime("%d de %B del %Y", strtotime($d));
			echo $fecha; ?></h2></center>
		
		<input class="btn btn-danger" type="button" onclick="printDiv('areaImprimir')" value="Imprimir listado" />
		<br></br>
		@include('procesos.cobro.search')
	</div>
</div>

<div class="row" id="imprimeme">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>CodCredito </th>
					<th>DNI/RUC</th>
					<th>Nombres Cliente</th>
					<th>Analista</th>
					<th>Monto</th>
                    <th>FechaPago</th>
                    <th>FechaDeposito</th>
                    <th>MontoApagar</th>
                    <th>MontoCobrado</th>
                    <th>Saldo</th>
					<th>Nro Cuota</th>
					<th>Estadocuota</th>
					<th>Observaciones</th>
				</thead>
				<?php setlocale(LC_ALL,"es_ES@euro","es_ES","esp");?>
               @foreach ($cobro as $cob)
				<tr>
					<td>{{ $cob->idcredito}}</td>
					<td>{{ $cob->dniruc}}</td>
					<td>{{ $cob->nombres}}</td>
					<td>{{ $cob->name}}</td>
					<td>{{ $cob->monto}}</td>
                    <td>{{ strftime("%d de %B del %Y",strtotime($cob->fechapago))}}</td>
                    <td>{{ $cob->fechadeposito}}</td>
                    <td>{{ $cob->montoapagar}}</td>
                    <td>{{ $cob->montocobrado}}</td>
                    <td>{{ $cob->saldo}}</td>
                    <td>{{ $cob->cuota}}</td>
					<td>{{ $cob->estadocuota}}</td>
					<td>{{ $cob->observaciones}}</td>
					<td>
						@if($cob->estadocuota=='Cancelada')
						<a href="{{URL::action('CobroController@edit',$cob->idcobro)}}"><button class="btn btn-danger">Imprimir</button>
						@else
						<a href="{{URL::action('CobroController@edit',$cob->idcobro)}}"><button class="btn btn-info">Pagar cuota</button></a>
						@endif
					</td>
				</tr>
				
				@endforeach
			</table>


			<div class="table-responsive"  hidden id="areaImprimir">
				<center><h3>Listado de cobranza 	<?php 	echo $fecha; ?></h3></center><br>
			<table class="table table-striped table-bordered table-condensed table-hover" >
					<thead>	
						<th>Nro </th>				
						<th>Cliente </th>
						<th>DNI/RUC</th>
						<th>Credito</th>
						<th>Fecha de pago</th>
		<center><th>Nro. Cuota</th></center>
						<th>Cuota</th>					
						<th>Estado</th>
						<th>Analista</th>	
					</thead>
					<?php setlocale(LC_ALL,"es_ES@euro","es_ES","esp"); $i=0;?>
					@foreach ($cobro as $cob)
					<tr>
						<td>{{$i=$i+1}}</td>
						<td>{{ $cob->nombres}}</td>
						<td>{{ $cob->dniruc}}</td>
						<td>{{ $cob->monto}}</td>						
						<td>{{ strftime("%d de %B del %Y",strtotime($cob->fechapago))}}</td>	
						<td>{{ $cob->cuota}}</td>	
						<td>{{ $cob->montoapagar}}</td>
						<td>{{ $cob->estadocuota}}</td>
						<td>{{ $cob->name}}</td>
								
					</tr>	
					@endforeach
				
				</table>
			</div>



		</div>
		{{$cobro->render()}}
	</div>
</div>
<script language="JavaScript" type="text/JavaScript">

	function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;
     document.body.innerHTML = contenido;
     window.print();		 
		 document.body.innerHTML = contenidoOriginal;	
		
		 window.close();	
		

		}
</script>
@endsection