@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Interes</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'mantenimiento/interes','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="tipopago">Tipo de Interes</label>
            	<input type="text" name="tipopago" class="form-control" placeholder="Tipo pago...">
            </div>
            <div class="form-group">
                <label for="interes">Interes (%)</label>
            	<input type="number" name="interes" class="form-control" value="1" max="100" min="1" size="10">
            </div>
            
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Limpiar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection