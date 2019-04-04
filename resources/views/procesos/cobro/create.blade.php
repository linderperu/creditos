@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nueva Cobranza</h3>
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
                        {!!Form::open(array('url'=>'mantenimiento/empleado','method'=>'POST','autocomplete'=>'off'))!!}
                        {{Form::token()}}
        <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                         <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" name="nombres" required value"{{old('nombres')}}" class="form-control" placeholder="Nombres...">
                        </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" name="apellidos" required value"{{old('apellidos')}}"  class="form-control" placeholder="Apellidos...">
                        </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="dniruc">DNI/RUC</label>
                                <input type="text" name="dniruc" required value"{{old('dniruc')}}" class="form-control" placeholder="DNI o RUC...">
                        </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="celular">Celular</label>
                                <input type="text" name="celular" required value"{{old('celular')}}" class="form-control" placeholder="Celular...">
                        </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="text" name="correo" required value"{{old('correo')}}"  class="form-control" placeholder="email...">
                        </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input type="text" name="direccion" required value"{{old('direccion')}}"  class="form-control" placeholder="Direccion...">
                        </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="distrito">Distrito</label>
                                <input type="text" name="distrito" required value"{{old('distrito')}}"  class="form-control" placeholder="Distrito...">
                        </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <input type="text" name="provincia" required value"{{old('provincia')}}"  class="form-control" placeholder="Provincia...">
                         </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="departamento">Departamento</label>
                                <input type="text" name="departamento" required value"{{old('departamento')}}"  class="form-control" placeholder="Departamento...">
                         </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="usuario">Usuario</label>
                                <input type="text" name="usuario" required value"{{old('usuario')}}"  class="form-control" placeholder="Usuario...">
                        </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="clave">Clave</label>
                                <input type="text" name="clave" required value"{{old('clave')}}"  class="form-control" placeholder="Password...">
                        </div>
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <div class="form-group">
                                <label for="cargo">Cargo</label>                                
                                <select name="idrol" class="form-control">
                                        @foreach($roles as $rol)
                                        <option value="{{ $rol->idrol }}">{{$rol->nombre}}</option>
                                       @endforeach                
                                </select> 
                        </div>
                </div>
        </div>
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Guardar</button>
                    <button class="btn btn-danger" type="reset">Cancelar</button>
                    <a href="{{ url()->previous() }}" class="btn btn-default">Volver</a>
            </div>

			{!!Form::close()!!}
@endsection