@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Interes: {{ $interes->tipopago}}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($interes,['method'=>'PATCH','route'=>['interes.update',$interes->idinteres]])!!}
            {{Form::token()}}
            <div class="form-group">
            	<label for="tipopago">Nombre del Interes</label>
            	<input type="text" name="tipopago" class="form-control" value="{{$interes->tipopago}}" placeholder="Tipo pago...">
            </div>
            <div class="form-group">
            	<label for="interes">Interes (%)</label>				
				<input type="number" name="interes" class="form-control"  max="100" min="1" value="{{$interes->interes}}">
			</div>
			
           
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
            	<button class="btn btn-danger" type="reset">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection