@extends ('layouts.admin')
@section ('contenido')
@if (auth()->user()->idrol=='2')
@include('procesos.reportes.search')
@else  <button class="btn btn-danger" type="button" onclick="printDiv('areaImprimir')" data-toggle="tooltip" title="Imprime el resultado que se muestra debajo">Imprimir Reporte</button>
@endif
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive" id="areaImprimir">
				<b><center><h4>REPORTE DE INGRESO/EGRESO A CAJA POR USUARIOS</h4></b><?php
					setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
					$d = now();
					$fecha = strftime("%d de %B del %Y", strtotime($d));
					echo $fecha; ?></center>
			<table class="table table-striped table-bordered table-condensed table-hover">
					
				<thead>
					<?php /*<th>Iddetalle</th>	
					<th>Idcaja</th>	*/ ?>
					<th>Descripcion</th>				
					<th>Monto</th>
					<th>Tipo(I/E)</th>
					<th>Fecha Registrada</th>					
				<!--	<th>usuario</th>  -->                                      
				</thead>
				<?php
				foreach($empleado as $us)
				{		$id=$us->id;
						$sumai=0;
						$sumae=0;	
					//echo $id;
					foreach ($detallecaja as $ing)
					{
						$id2=$ing->iduser;
						if($id==$id2)
						{ $tipo=$ing->tipo;
							if($tipo=='I'){
								$sumai=(float)$sumai + (float)$ing->monto;
								
							?>
								<tr class = "success">
									<td>{{ $ing->descripcion}}</td> 
									<td>{{ $ing->monto}}</td>                    
									<td>{{ $ing->tipo}}</td>
									<td>{{strftime("%d de %B del %Y", strtotime($ing->fechaapertura)) }}</td>									
								</tr><?php
							}else {
								$sumae=(float)$sumae+(float)$ing->monto; ?>
								<tr class = "info">
										<td>{{ $ing->descripcion}}</td> 
										<td>{{ $ing->monto}}</td>                    
										<td>{{ $ing->tipo}}</td>
										<td>{{strftime("%d de %B del %Y", strtotime($ing->fechaapertura)) }}</td>
								</tr>
							<?php
							}
						}
					}
					if ($sumai+$sumae>'0'){				
					?>				
					<tr class = "warning"><td>{{$id=$us->name}}</td><td colspan="7" align="right" >Total Ingreso:&nbsp&nbspS/&nbsp{{$sumai}}&nbsp<br>Total Egreso:&nbsp&nbspS/&nbsp{{$sumae}}&nbsp<br><b>Total :&nbsp&nbspS/&nbsp{{$sumai-$sumae}}</td>
					</tr>
					<?php
						}
				}
				
			?>
				
			</table>
		</div>
		{{$detallecaja->render()}}
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