@extends ('layouts.admin')
@section ('contenido')
	<div class="row" id="imprimeme">
			<div class="col-lg-6 col-md-7 col-sm-9 col-xs-12">
					<h3>Cobro:cuota <b>{{$cobro->cuota}}</b> al cliente:<br><b> {{$cobro->nombres}}</b></h3>
					<h3>Monto a pagar:<b>S/ {{$cobro->montoapagar}}</b></h3>
			@if (count($errors)>0)

			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			</div>
			@endif

			{!!Form::model($cobro,['method'=>'PATCH','route'=>['cobro.update',$cobro->idcobro]])!!}
			{{Form::token()}}
			
			
			
			<div class="row" >
					<div class="col-lg-6 col-md-7 col-sm-9 col-xs-12">
            <div class="form-group">
            	<label for="nombre">Cuota a Pagar</label>
            	<input type="text" name="montoapagar" class="form-control" value="{{$cobro->montoapagar}}" placeholder="monto a pagar...">
            </div>
            <div class="form-group">
				<label for="apellidos">Monto a cobrar </label>
				@if($cobro->estadocuota=="Faltante")
				
				<input type="number" name="montocobrado" id="montocobrado" class="form-control" step="0.10" placeholder="Monto a cobrar..." selected autofocus>				
				@else
				<input type="number" name="montocobrado" id="montocobrado"  class="form-control" step="0.10" value="{{$cobro->montoapagar}}" placeholder="Monto a cobrar..." selected autofocus>
				@endif
			</div>
			<div class="form-group">
				<label for="fechacobro">Fecha de cobro</label>
				@if($cobro->estadocuota=="Cancelada")
				<input type="text" name="fechadeposito" id="fechadeposito" class="form-control" value="{{$cobro->fechadeposito}}">
			
				@else
				<input type="text" name="fechadeposito" id="fechadeposito" class="form-control" value=<?php echo date("d-m-Y"); ?>
				@endif 
    		 </div>
            <div class="form-group">
					<label for="cuotanum">Cuota Numero</label>
					<input type="number" name="cuota" class="form-control"value="{{$cobro->cuota}}">
				</div>

			<div class="form-group">
				<label for="cuotanum">Observación del pago</label>
				<textarea placeholder="Ingrese observaciones" name="observaciones" class="form-control" rows="2" cols="4" >{{$cobro->observaciones}}</textarea>
			</div>
			</div>

			<div class="form-group" hidden  id="areaImprimir">
					<CENTER><h2>CREDICASH</h2><span>Dinero al instante</span>
						<h4>MYJHON</h4>
					<h3>COMPROBANTE DE CUOTA</h3>
					<h3>Fecha de emision:&nbsp		
							<label for="fecha pago:" id="emision">  <?php
								setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
								$d = now();
								$fecha = strftime("%d de %B del %Y", strtotime($d));
								echo $fecha; ?> </label>
					<h4>Fecha de cobro: {{$cobro->fechadeposito}} </h4>			
					<h4>Cajero: {{auth()->user()->name}} / {{auth()->user()->idrol}} </h4>
					<h4>Analista:{{$cobro->name}}
					<h4>Cuota numero: {{$cobro->cuota}}</h4>
					<h6> ===============================================</h6>
					<h6> Monto a pagar: {{$cobro->montoapagar}} </h6>
					<h3> Importe pagado: S/ &nbsp<b> <label id="importe"></label></h3>
					<h6> ==============================================</h6>
					<h4>******Gracias por su confianza ********</h4></center>
						</div>
			<div class="form-group">

					@if($cobro->estadocuota=="Cancelada")
					<input class="btn btn-danger btn-lg" type="button" id="imp" onclick="printDiv();" value="Imprimir Ingreso" />
					@else
					<button class="btn btn-danger btn-lg" onClick="printDiv()">Imprimir</button>
					@endif 			
				
				<a href="{{ url()->previous() }}" class="btn btn-default">Volver</a>
            </div
		   </div>

			{!!Form::close()!!}		
            
		</div>
	</div>

	<script language="JavaScript" type="text/JavaScript">
		function printDiv()
				 {
				var p = parseFloat(document.getElementById('montocobrado').value);
						p=p.toFixed(2);					
						document.getElementById("importe").innerHTML=p;
						//document.getElementById("fechapago").innerHTML = document.getElementById("des").value; 
						pregunta = confirm('Imprimir recibo de cuota de credito???'); 

				if(pregunta)    { 
								   
				var objeto=document.getElementById("areaImprimir");  //obtenemos el objeto a imprimir
				var ventana= window.open("", "_blank", "width=750, height=550, left=50%, top=50%, resizable=yes, toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, copyhistory=no");  //abrimos una ventana vacía nueva
				if (ventana == null || typeof(ventana)=='undefined') { 	
			alert('Desactive el bloqueador de ventanas emergentes, este cobro ya se grabo, buscar atras para imprimir...'); 
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