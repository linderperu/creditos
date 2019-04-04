{!! Form::open(array('url'=>'procesos/caja','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">

<div class="row">
    <div class="col-lg-5 col-sm-6 col-md-8 col-xs-8">
      <input type="text" class="form-control" name="searchText" placeholder="Buscar" value="{{$searchText}}">
    </div >
      <div class="col-lg-5 col-sm-6 col-md-8 col-xs-12">
        <div class="form-group"> 
           <span class="input-group-btn"><button type="submit" class="btn btn-primary">Buscar</button></span>
        </div>		
      </div>
</div>

      <div class="row" >
		 <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
        <div class="form-group"> 
       	<label class="control-label" for="date">Fecha Inicial</label>
        <input type="date" class="form-control" id="fechaInicial" name="fechaInicial"/>
     	 	</div>
    </div>
      <div class="col-lg-5 col-sm-5 col-md-5 col-xs-12">
      <div class="form-group"> 
        <label class="control-label" for="date">Fecha Final</label>
        <input type="date" class="form-control" id="fechaFinal" name="fechaFinal"/>
		  </div>		
	   </div>
    </div>

    
	</div>
</div>

@push ('scripts') <!-- Trabajar con el script definido en el layout-->
<script>
$(document).ready(function(){
    var date_input=$('input[name="fechaInicial"]');
    var date_inputt=$('input[name="fechaFinal"]');  //our date input has the name "date"
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var options={
      format: 'yyyy/mm/dd',
      container: container,
      todayHighlight: true,
      autoclose: true,
    };
    date_input.datepicker(options);
      date_inputt.datepicker(options);
  })

  </script>
@endpush

{{Form::close()}}