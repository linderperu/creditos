@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Imprimir Ingreso : {{ $ing->iddetallecaja}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($ing,['method'=>'PATCH','route'=>['ingresos.update',$ing->iddetallecaja]])!!}
			{{Form::token()}}
			
            <div class="form-group">
            	<label for="nombre">Monto</label>
            	<input type="number" name="monto" step="0.01" id="mo" class="form-control input-lg" value="{{$ing->monto}}">
            </div>
			<div class=" col-lg-6 col-sm-6 col-md-6 col-xs-12">  
					<label for="nombres">Descripcion</label>
					<textarea placeholder="Ingrese descripcion" id="des" name="descripcion" class="form-control input-lg" rows="3" cols="5">{{$ing->descripcion}}</textarea>
			 </div>
			
 <div class="form-group" hidden  id="areaImprimir">
<center><h4>_____________________________________________</h4>
<h4>RECIBO DE INGRESO A CAJA - ****CREDICASH***</h4>
<h4>-----------------------------------------</h4></center>
<label>Usuario :&nbsp{{auth()->user()->name}} </label><br><label> Fecha (dia/mes/año) y hora :&nbsp<?php echo date('d-m-Y H:i');  ?>  </label> 
<br> <label for="numm">El monto es: (S/)&nbsp</label><label id="num"></label><br>
            <label for="nmm">Motivo del ingreso:&nbsp</label><label id="num2"></label>      
            
 </div> 
            <div class="form-group">

			<input class="btn btn-danger btn-lg" type="button" id="imp" onclick="printDiv('areaImprimir')" value="Imprimir Ingreso" />
            <a href="{{ url()->previous() }}" class="btn btn-default">Volver</a>

            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>


	<script language="JavaScript" type="text/JavaScript">
		function printDiv(nombreDiv) {
			 
			var p = parseFloat(document.getElementById("mo").value);
			 p=p.toFixed(2);
			 document.getElementById("num").innerHTML=p;
			 document.getElementById("num2").innerHTML=document.getElementById("des").value; 
			 pregunta = confirm('Imprimir recibo???'); 
	 if(pregunta) { 

		 //no ejecuta el submmit de un boton.
			 var contenido= document.getElementById(nombreDiv).innerHTML;
			 var contenidoOriginal= document.body.innerHTML;
	 
			 document.body.innerHTML = contenido;       
			  window.print();		 
			document.body.innerHTML = contenidoOriginal
			   window.close();  } 	 
			 }
	 </script> 

@endsection