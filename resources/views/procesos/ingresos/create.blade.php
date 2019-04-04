@extends ('layouts.admin')
<?php 
/*<style type="text/css" media="print">
        .nover {display:none}
        </style>*/
        ?>
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h3><label for="detalleingreso">Ingreso a caja</label></h3>
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
        {!!Form::open(array('url'=>'procesos/ingresos','method'=>'POST','autocomplete'=>'off'))!!}
         {{Form::token()}}

<div class="row">
            
  <div class="col-lg-4 col-sm-4 col-md-6 col-xs-10">
        <div class="form-group">
         <h2> <label for="nombres">Monto  (S/)</label></h2>
        <input type="number" placeholder="0" step="0.01" id="mo" name="monto" min="0" value="" required class="form-control input-lg"> 
         </div>
  </div>
        
        <div class=" col-lg-4 col-sm-4 col-md-6 col-xs-10">  

         <div class="form-group">
         <h2><label for="detalle">Motivo del ingreso de S/</label></h2> 
         <textarea placeholder="Ingrese observaciones" name="descripcion" id="des" class="form-control input-lg" rows="3" cols="5"></textarea>
         </div>
        </div>        
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
                    
                 <!--   <button class="btn btn-primary btn-lg" id="btningreso" type="submit">Registrar ingreso</button> 
                   
                    <button class="btn btn-danger btn-lg" type="reset">Cancelar</button>-->
                    <button class="btn btn-danger btn-lg" onclick="printDiv();">Registrar ingreso</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default btn-lg">Cancelar</a>
            </div>

                        {!!Form::close()!!}
   
<script language="JavaScript" type="text/JavaScript">
function printDiv()
         {
                
        var p = parseFloat(document.getElementById("mo").value);
                p=p.toFixed(2);
                document.getElementById("num").innerHTML=p;
                document.getElementById("num2").innerHTML=document.getElementById("des").value; 
               pregunta = confirm('Imprimir recibo???'); 
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
