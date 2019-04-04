@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<h3>Cerrar Caja con codigo : {{$caja->idcaja}}</h3>
				<center><h2> <label for="montoapertura">Monto de Caja: (S/) {{$query3}}</label></h2></center>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($caja,['method'=>'PATCH','route'=>['caja.update',$caja->idcaja]])!!}
			{{Form::token()}}
			
            <div class="form-group">
            	<label for="nombre">Monto de Cierre</label>
            	<input type="number" name="montocierre" step="0.01" class="form-control input-lg" value="{{$caja->montocierre}}">
            </div>
			<div class=" col-lg-6 col-sm-6 col-md-6 col-xs-12">  
					<label for="observaciones">Observaciones</label>
					<textarea placeholder="Ingrese observaciones" name="observaciones" class="form-control input-lg" rows="3" cols="5">{{$caja->observaciones}}</textarea>
			 </div>

            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Aceptar Cierre de Caja</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>				
				<a href="{{ url()->previous() }}" class="btn btn-default">Volver</a>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@endsection