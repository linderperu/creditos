<?php echo Form::open(array('url'=>'procesos/cobro','method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

<div class="form-group">
	<div class="input-group">
    <div class="row">
    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-8">
      <div class="form-group">
          <span>cliente</span>
          <input type="text" class="form-control" name="searchText" placeholder="Buscar por nombres o DNI cliente" value="<?php echo e($searchText); ?>">
      </div> 
      <div class="form-group"> 
      <span>Analista</span>
      <input type="text" class="form-control" name="searchText2" placeholder="Buscar x Analista" value="<?php echo e($searchText2); ?>">
      </div>
      <span class="input-group-btn"><button type="submit" class="btn btn-primary">Buscar por cliente o analista</button></span>
      
      
  </div>

    	 <div class="col-lg-6 col-sm-6 col-md-6 col-xs-8">
          <div class="form-group">
            <label> </label>

  
  <input type="date" class="form-control btn-lg" name="fechahoy" id="fechahoy" placeholder="DD/MM/AA" required value=<?php echo date('Y-m-d'); ?> >          
   <span class="input-group-btn"><button type="submit" class="btn btn-succeed" >Buscar por fecha</button></span>
   
         <input type="radio" name="estadop" id="estadop" value='1' > Pendiente
         <input type="radio" name="estadop" id="estadop" value='2'> Cancelada
         <input type="radio" name="estadop" id="estadop" value='3'> Faltante
        
    
      </div>  
      
    </div>
    
	    
     
    </div>

</div>
</div>
<?php echo e(Form::close()); ?>