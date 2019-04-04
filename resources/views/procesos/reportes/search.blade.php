{!! Form::open(array('url'=>'procesos/reportes','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="row">     
     <div class="col-lg-3">
        <div class="input-group">
          <span class="input-group-btn">
            <button class="btn btn-danger" type="button" onclick="printDiv('areaImprimir')" data-toggle="tooltip" title="Imprime el resultado que se muestra debajo">Imprimir Reporte</button>            
          </span>
          <input type="date" class="form-control" id="fechaInicial" name="fechaInicial" data-toggle="tooltip" title="Fecha inicial" max=<?php echo date('Y-m-d'); ?> value=<?php echo date('Y-m-d'); ?> />
        </div>
      </div>
    
      <div class="col-lg-3">
        <div class="input-group">
            <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" data-toggle="tooltip" title="Fecha final" max=<?php echo date('Y-m-d'); ?> value=<?php echo date('Y-m-d'); ?> />
          <span class="input-group-btn">
            <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Busca desde la fecha inicial hasta la fecha final">Buscar por fechas</button>
          </span>
        </div>
      </div>
</div>
 
{{Form::close()}}