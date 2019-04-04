@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
			<a href="../procesos/caja/create"><button class="btn btn-success btn-lg" <?php if(auth()->user()->idrol=='3'){echo 'disabled';}  ?>  >Aperturar Caja</button></a>
			<button class="btn btn-danger btn-lg" onclick="printDiv();">Imprimir vista de caja</button>
		</div>
	</div>
	<div class="row">
			<br>
			@include('procesos.caja.search')
			@if(auth()->user()->idrol!='3')
		<center><label for="montoapertura">{{auth()->user()->name}}   <?php
			setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
			$d = now();
			$fecha = strftime("%d de %B del %Y", strtotime($d));
			echo $fecha; ?> <h2> Total en caja: (S/) : {{$query3}}</h2></label></center>
   			@endif
	</div>
	<div class="form-control">	
	
	</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
					<thead class="thead-light">
					<th>IdCaja</th>					
					<th>Nombres</th>
					<th>Rol</th>				
                    <th>Monto Apertura</th>
                    <th>Monto Cierre</th>
                    <th>F. Apertura</th>
                    <th>F. Cierre</th>
					<th>Estado</th>
					<th>observaciones</th>                   
				</thead>
				
			   @foreach ($caja as $ca)
			   @if ($ca->estado=='Abierto')
				<tr class = "success">
			   	@else<tr class = "info">@endif
					<td>{{ $ca->idcaja}}</td> 
					<td>{{ $ca->name}}</td>                    
                    <td>{{ $ca->nombre}}</td>					
					<td>{{ $ca->montoapertura}}</td>
					<td>{{ $ca->montocierre}}</td>
					<td>{{ $ca->fechaapertura}}</td>   
					<td>{{ $ca->fechacierre}}</td>   
					<td>{{ $ca->estado}}</td> 
					<td>{{ $ca->observaciones}}</td>             	
					<td>
						@if (auth()->user()->idrol !='3')
						<a href="{{URL::action('CajaController@edit',$ca->idcaja)}}"><button class="btn btn-info" <?php if(($ca->estado=='Cerrado')&&(auth()->user()->idrol=='1')){echo 'disabled';}  ?>>Cerrar caja</button></a>
						<a href="" data-target="#modal-delete-{{$ca->idcaja}}" data-toggle="modal"><button class="btn btn-danger" <?php if((auth()->user()->idrol=='3')||($ca->estado=='Cerrado')){echo 'disabled';}  ?>>Eliminar</button></a>
						 @endif 
					</td>
				</tr>
				@include('procesos.caja.modal')
				@endforeach
			</table>
		</div>


		<div class="table-responsive" id="areaImprimir" hidden>
			<h3>Lista de historial de caja</h3>
			<div class="row">
					<br>
				
					@if(auth()->user()->idrol!='3')
				<center><label for="montoapertura">{{auth()->user()->name}}   <?php
					setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
					$d = now();
					$fecha = strftime("%d de %B del %Y", strtotime($d));
					echo $fecha; ?> <h2> Total en caja: (S/) : {{$query3}}</h2></label></center>
					   @endif
			</div>


			<table style="text-align:center;border-right-color:#6c6c6c;" class="table table-striped table-bordered table-condensed table-hover">
				<thead class="text-center">
					<th>IdCaja</th>					
					<th>Nombres</th>
					<th>Rol</th>				
                    <th>Monto Apertura</th>
                    <th>Monto Cierre</th>
                    <th>F. Apertura</th>
                    <th>F. Cierre</th>
					<th>Estado</th>
					<th>observaciones</th>                   
				</thead>
				     @foreach ($caja as $ca)
				<tr class="text-center">
					<td>{{ $ca->idcaja}}</td> 
					<td>{{ $ca->name}}</td>                    
                    <td>{{ $ca->nombre}}</td>					
					<td>{{ $ca->montoapertura}}</td>
					<td>{{ $ca->montocierre}}</td>
					<td>{{ $ca->fechaapertura}}</td>   
					<td>{{ $ca->fechacierre}}</td>   
					<td>{{ $ca->estado}}</td> 
					<td>{{ $ca->observaciones}}</td> 
				</tr>				
				@endforeach
			
			</table>
		</div>




		{{$caja->render()}}
	</div>
</div>

<script language="JavaScript" type="text/JavaScript">
	function printDiv()
			 {
		pregunta = confirm('Imprimir lista de caja???'); 
			if(pregunta)    { 
							   
			var objeto=document.getElementById('areaImprimir');  //obtenemos el objeto a imprimir
			var ventana= window.open("", "_blank", "width=750, height=550, left=50%, top=50%, resizable=yes, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, copyhistory=no");  //abrimos una ventana vacía nueva
			if (ventana == null || typeof(ventana)=='undefined') { 	
		alert('Desactive el bloqueador de ventanas emergentes, este ingreso ya se grabo, buscar atras para imprimir...'); 
			} 
			else { 	
			ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
			ventana.document.close();  //cerramos el documento
			ventana.focus();
			ventana.print();  //imprimimos la ventana
			ventana.close();  //cerramos la ventana
							}
	
			}
			 }
	</script> 

@endsection