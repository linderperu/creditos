@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Apertura de Caja</h3>
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
        {!!Form::open(array('url'=>'procesos/caja','method'=>'POST','autocomplete'=>'off'))!!}
         {{Form::token()}}
        
         <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                         <div class="form-group">
                                <label for="montoapertura">Monto de apertura (S/)</label>
                                <input type="number" placeholder="0" step="0.01" name="montoapertura" min="0" value="" required class="form-control input-lg"> 

                                <input type="hidden" name="idempleado" value={{auth()->user()->id}} class="form-control ">
                                                        
                        </div>
                </div>
         </div>
         <div class="row">
                        <h3><label for="detalle">Cantidad de monedas</label></h3>
                <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                        <div class="form-group">
                        <center><i class="fa fa-hand-o-right" aria-hidden="true"></i> <label for="diezcentimos">(0.10)</label></center>
                        <input  id="d" type="number" name="diezcentimos" value="0" autofocus class="form-control input-md" >
                        </div>
                </div> 
               <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                         <div class="form-group">
                         <center><i class="fa fa-hand-o-right" aria-hidden="true"></i> <label for="veintecentimos">(0.20)</label></center>
                        <input id="v" type="number" name="veintecentimos" value="0" autofocus class="form-control input-sm" >
                        </div>
                </div>              
               <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                        <div class="form-group">
                        <center><i class="fa fa-hand-o-right" aria-hidden="true"></i> <label for="cincuentacentimos">(0.50)</label></center>
                        <input  id="c" type="number" name="cincuentacentimos" value="0" autofocus class="form-control input-sm" >
                        </div>
                </div> 
               <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                         <div class="form-group">
                        <center><i class="fa fa-hand-o-right" aria-hidden="true"></i> <label for="unsol">(1.00)</label></center>
                        <input id="s" type="number" name="unsol" value="0" autofocus class="form-control input-sm" >
                        </div>
                        </div> 
               <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                        <div class="form-group">
                        <center><i class="fa fa-hand-o-right" aria-hidden="true"></i> <label for="dossoles">(2.00)</label></center>
                        <input id="dd" type="number" name="dossoles" value="0" autofocus class="form-control input-sm" >
                        </div>
                        </div>              
               <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                         <div class="form-group">
                         <center><i class="fa fa-hand-o-right" aria-hidden="true"></i> <label for="cincosoles">(5.00)</label></center>
                        <input id="cc" type="number" name="cincosoles" value="0" autofocus class="form-control input-sm" >
                        </div>
                </div> 
         </div>
        <div class="row">
        <h3><label for="detalle">Cantidad de billetes</label></h3>
               <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                <div class="form-group">
                <center><i class="fa fa-money" aria-hidden="true"></i> <label for="diezsoles" >(S/10.00)</label></center>
                <input id="di" type="number" name="diezsoles" value="0" autofocus class="form-control input-sm" >
                 </div>
                </div> 
               <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                <div class="form-group">
                <center><i class="fa fa-money" aria-hidden="true"></i> <label for="diez" >(S/20.00)</label></center>
                <input id="ve" type="number" name="veintesoles" value="0" autofocus class="form-control input-sm" >
                 </div>
                </div> 
               <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                <div class="form-group">
                <center><i class="fa fa-money" aria-hidden="true"></i> <label for="diez" >(S/50.00)</label></center>
                <input id="ci" type="number" name="cincuentasoles" value="0" autofocus class="form-control input-sm" >
                 </div>
                </div> 
               <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                <div class="form-group">
                <center><i class="fa fa-money" aria-hidden="true"></i> <label for="diez" >(S/100.00)</label></center>
                <input id="cie" type="number" name="ciensoles" value="0" autofocus class="form-control input-sm" >
                 </div>
                </div> 
               <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                <div class="form-group">
                <center><i class="fa fa-money " aria-hidden="true"></i> <label for="diez" >(S/200.00)</label></center>
                <input id="do" type="number" name="doscientossoles" value="0" autofocus class="form-control input-sm" >
                 </div>
                </div> 
                <div class="col-lg-1 col-sm-2 col-md-3 col-xs-3">       
                <div class="form-group">
                <center><i class="fa fa-money " aria-hidden="true"></i> <label for="diez" >Total</label></center>
                <input  type="number" id="total" step="0.01" value="0" autofocus class="form-control input-sm" >
                </div>
                </div> 
        </div>
       
                <div class="col-lg-3 col-sm-4 col-md-6 col-xs-12">  
                        <label for="observaciones">Observaciones</label>
                        <textarea placeholder="Ingrese observaciones" name="observaciones" class="form-control input-sm" rows="3" cols="5"></textarea>
                 </div>
        
            <div class="form-group">
                    <button class="btn btn-primary btn-lg" type="submit">Aperturar</button>
                    <input  type="button" name="tota" value="Comprobar" autofocus class="btn btn-warning btn-lg" onclick="sum()" >
                   
                    <button class="btn btn-danger btn-lg" type="reset">Cancelar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default btn-lg">Volver</a>
            </div>

			{!!Form::close()!!}		
      
<script language="JavaScript" type="text/JavaScript">
	function sum(){

var d = parseInt(document.getElementById("d").value) * 0.1;
var v = parseInt(document.getElementById("v").value) * 0.2;
var c = parseInt(document.getElementById("c").value) * 0.5;
var s = parseInt(document.getElementById("s").value) * 1 ;     
var dd =parseInt(document.getElementById("dd").value) * 2;
var cc =parseInt(document.getElementById("cc").value) * 5;
var di =parseInt(document.getElementById("di").value) * 10;
var ve =parseInt(document.getElementById("ve").value) * 20;
var ci =parseInt(document.getElementById("ci").value) * 50;
var cie =parseInt(document.getElementById("cie").value) * 100;
var dos =parseInt(document.getElementById("do").value) * 200;
var total= d+v+c+s+dd+cc+di+ve+ci+cie+dos;

total=total.toFixed(2);//decimales con 2 digitos
        document.getElementById("total").value=total;
        }
</script>
                                
@endsection
