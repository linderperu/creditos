@extends ('layouts.admin')
@section ('contenido')

                <h2>En caja: (S/) {{$query3}}</h2>
                <div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h3>Nuevo Credito</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
                </div>
        </div>                        
                        {!!Form::open(array('url'=>'procesos/credito','method'=>'POST','autocomplete'=>'off'))!!}
                        {{Form::token()}}
                        
<div class="row" >
        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-8">  
                        <input  type="button" name="clientenuevo" value="Cliente Nuevo" autofocus class="btn btn-warning btn" onclick="location.href='/mantenimiento/clientes/create'">
                        <div class="form-group">
                        <label for="clientes">Clientes</label>                                
                        <select id="persona" name="idpersona" class="form-control input-lg">
                        @foreach($personas as $per)
                        <option value="{{ $per->idpersona }}">{{$per->nombres}}</option>
                        @endforeach                
                        </select> 
                        <label for="empleado">Quien otorga el credito</label>                                
                        <select id="empleado" name="idempleado" class="form-control input-lg">
                        @foreach($empleado as $per)
                    @if($per->idrol!='2')                       
                        <option value="{{ $per->id }}">{{$per->name}}</option>
                        @endif
                        @endforeach                
                        </select> 
                        </div>

        </div>
       
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-8">
                <div class="form-group">
                <label for="cuotas">Cuotas de (S/)</label>
                <input type="number" id="cuotass" name="cuotas" class="form-control input-lg" readonly >             
                 </div>
        </div>
           
 </div>
<div class="row">
        <div class="col-lg-2 col-sm-2 col-md-2 col-xs-12">
                 <div class="form-group">
                 <label for="monto">Monto solicitado (S/)</label>
                 <input type="number" placeholder="0" step="0.10" id="monto" name="monto" min="1" value="" required class="form-control input-lg"> 
                
                <input type="hidden" name="idcajero" value={{auth()->user()->id}} class="form-control ">
               
                                                                                      
                 </div>
        </div>
       <!-- <div class="col-lg-2 col-sm-2 col-md-2 col-xs-8">
         <div class="form-group">
          <label for="mes">Meses(selecciona)</label>  
          <input type="number" placeholder="0" id="mes"  name="mes" min="0" value="" required class="form-control input-lg"> 
         </div>
        </div> -->
        <div class="col-lg-2 col-sm-3 col-md-3 col-xs-8">
          
                    <div class="form-group">
                        <label for="tipopago">Tipo de prestamo</label>                                
                     
                        <select id="tipopagos" name="tipopago" class="form-control input-lg">
                               
                                <option value="Diario">Diario</option>
                                <option value="Semanal">Semanal</option>
                                <option value="Mensual">Mensual</option>      
                                </select> 
                    </div>
            </div>


            <div class="col-lg-2 col-sm-3 col-md-3 col-xs-8">
              
                    <div class="form-group">
                        <label for="interes">Elija el Interes (%)</label>                                
                        <input type="number" placeholder="0" step="0.10" id="interess" name="interes" min="0" value="" required class="form-control input-lg"> 
                    </div>
            </div>
       
            <div class="col-lg-2 col-sm-2 col-md-2 col-xs-8">
                <div class="form-group">
                <label for="cuotas">Numero de Cuotas</label>
                <input type="number" id="numerocuotass" name="numerocuotas" class="form-control input-lg" min="0" required >
                
                </div>
        </div>          

</div>
<div class="form-group">

        <div class=" col-lg-4 col-sm-6 col-md-4 col-xs-8">  
                <input  type="button" name="prendario" value="Habilitar Credito Prendario" autofocus class="btn btn-warning btn-lg" onclick="pren()" >
                 <label for="nombres">Ingrese las prendas en garantia, separe por(;)</label>
                <textarea placeholder="Ingrese prendas" name="prenda" id="prendas" class="form-control input-lg" rows="3" cols="5" disabled></textarea>
        </div>

        <div class="col-lg-4 col-sm-4 col-md-4 col-xs-8">
                <input  type="button" name="calcular" onclick="cal(<?php echo auth()->user()->idrol;?>)" value="Calcular Cuotas" autofocus class="btn btn-warning btn-lg" >
                <button class="btn btn-primary btn-lg" id="btnn" type="submit" disabled >Guardar</button>
                <button class="btn btn-danger btn-lg"" type="reset">Cancelar</button>

                <div class="form-group"> 
                <label class="control-label" for="date">Fecha de la primera cuota</label>
                <input type="date" class="form-control btn-lg" name="fechapcuota" id="fechapcuota" placeholder="DD/MM/AA" required value=<?php echo date('Y-m-d'); ?> >   
         <!--   <input type="date" class="form-control btn-lg" name="fechapcuota" id="fechapcuota" placeholder="DD/MM/AA" required min=<?php $hoy=date("Y-m-d"); echo $hoy;?> value=<?php echo date('Y-m-d'); ?> >  !--> 

                </div>              
                <a href="{{ url()->previous() }}" class="btn btn-default btn-lg">Volver</a>
        </div>        
        
</div>

                        {!!Form::close()!!}	
                        
<script language="JavaScript" type="text/JavaScript">

 function cal(iii)
 {      
         //alert(iii);
       
         var M = parseFloat(document.getElementById("monto").value) ;
        //var Me = parseInt(document.getElementById("mes").value) ;        
        //var combo = document.getElementById("tipopago").value;
      
        var i=parseInt(document.getElementById("interess").value);
      
        var n=0;
        //alert(M);     
        
        n=parseInt(document.getElementById("numerocuotass").value);
 //alert(n);
         var cuota= M + M*i/100; 
             cuota=cuota/(n);
             cuota=cuota.toFixed(1); 
             //alert(cuota);
        document.getElementById("cuotass").value=cuota;
           //alert(auth()->user()->idrol);
           if (iii!='3'){
                document.getElementById('btnn').disabled = false;
           }
      
 }

 function pren(){ document.getElementById('prendas').disabled = false;}

function imprimir(){
	
  var objeto=document.getElementById('imprimeme');  //obtenemos el objeto a imprimir
  var ventana=window.open('','_blank',);  //abrimos una ventana vacía nueva
  ventana.document.write(objeto.innerHTML);  //imprimimos el HTML del objeto en la nueva ventana
  ventana.document.close();  //cerramos el documento
  ventana.focus();
  ventana.print();  //imprimimos la ventana
  ventana.close();  //cerramos la ventana
}


</script>
@endsection