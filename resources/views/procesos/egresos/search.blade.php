{!! Form::open(array('url'=>'procesos/egresos','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
    
      
        <div class="form-group col-lg-3 col-sm-3 col-md-3 col-xs-6">
            <label for="nombre">Elija su vista de ...</label>
            <select name="elecText" class="form-control"> 
              <option value="E" >Egresos</option>
              <option value="I" >Ingresos</option>
            </select>
        </div>

 
		<div class="col-lg-3 col-sm-2 col-md-2 col-xs-12">
      <div class="form-group"> 
      <label class="control-label" for="date">Fecha Inicial</label>
      <input type="date" class="form-control" id="fechaInicial" name="fechaInicial" max=<?php echo date('Y-m-d'); ?> />
      </div>
    </div>
    <div class="col-lg-3 col-sm-2 col-md-3 col-xs-12">
      <div class="form-group"> 
        <label class="control-label" for="date">Fecha Final</label>
        <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" value=<?php echo date('Y-m-d'); ?> max= <?php echo date('Y-m-d'); ?> />
	  	</div>		
	   </div>
     <div class="col-lg-2 col-sm-2 col-md-2 col-xs-4">
      <div class="form-group"> 
       <label class="control-label" for="hidden">Buscar</label>
       <span class="input-group-btn"><button type="submit" class="btn btn-primary">Buscar</button></span>
      </div>		
     </div>
	</div>
</div>
 
{{Form::close()}}