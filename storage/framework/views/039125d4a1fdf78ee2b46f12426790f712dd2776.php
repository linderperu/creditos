<?php echo Form::open(array('url'=>'procesos/credito','method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

<div class="row"> 
      <div class="col-lg-3 col-sm-4 col-md-6 col-xs-12">
   
          <select name="elecText" class="form-control" data-toggle="tooltip" title="Tipo de Credito"> 
            <option value="Efectivo" >Efectivo</option>
            <option value="Prendario" >Prendario</option>
          </select>
      </div>
      <div class="col-lg-3 col-sm-6 col-md-8 col-xs-12">
          <div class="input-group">
             <input type="text" class="form-control" name="searchText" placeholder="Buscar DNI/RUC " value="<?php echo e($searchText); ?>">             
            <span class="input-group-btn">
              <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Busca por DNI, y tipo de credito">Buscar por DNI</button>
            </span>
          </div>
        </div>
</div>    
<div class="row"> 
  <div class="col-lg-3 col-sm-6 col-md-8 col-xs-12">
     <div class="input-group">
        <input type="date" class="form-control" id="fechaInicial" name="fechaInicial" data-toggle="tooltip" title="Fecha inicial" max=<?php echo date('Y-m-d'); ?> value=<?php echo e(old('fechaInicial')); ?> />
       <span class="input-group-btn">
          <input type="text" class="form-control" name="">         
       </span>
      
     </div>
   </div> 
   <div class="col-lg-3 col-sm-6 col-md-8 col-xs-12">
     <div class="input-group">
         <input type="date" class="form-control" id="fechaFinal" name="fechaFinal" data-toggle="tooltip" title="Fecha final" max=<?php echo date('Y-m-d'); ?> value=<?php echo e(old('fechaFinal')); ?>/>
       <span class="input-group-btn">
         <button class="btn btn-primary" type="submit" data-toggle="tooltip" title="Busca desde la fecha inicial hasta la fecha final">Buscar por fechas</button>
       </span>
     </div>
   </div>
</div>


<?php echo e(Form::close()); ?>