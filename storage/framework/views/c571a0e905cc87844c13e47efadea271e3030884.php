<?php $__env->startSection('contenido'); ?>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Clientes <a href="../mantenimiento/clientes/create"><button class="btn btn-success">Nuevo</button></a></h3>
		<?php echo $__env->make('mantenimiento.clientes.search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Tipo Cliente</th>
					<th>Nombres</th>
					<th>TipoDoc</th>					
                    <th>Nro</th>
                    <th>Celular</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Distrito</th>
                    <th>Provincia</th>
					<th>Departamento</th>
					<th>Condicion</th>
                   
				</thead>
               <?php $__currentLoopData = $personas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($clie->idpersona); ?></td>
					<td><?php echo e($clie->tipo_persona); ?></td>
					<td><?php echo e($clie->nombres); ?></td>
					<td><?php echo e($clie->tipo_documento); ?></td>
                    <td><?php echo e($clie->dniruc); ?></td>
                    <td><?php echo e($clie->celular); ?></td>
                    <td><?php echo e($clie->correo); ?></td>
                    <td><?php echo e($clie->direccion); ?></td>
                    <td><?php echo e($clie->distrito); ?></td>
                    <td><?php echo e($clie->provincia); ?></td>
					<td><?php echo e($clie->departamento); ?></td>
					<td><?php echo e($clie->condicion); ?></td>
					
					<td>
						<a href="<?php echo e(URL::action('ClienteController@edit',$clie->idpersona)); ?>"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-<?php echo e($clie->idpersona); ?>" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				<?php echo $__env->make('mantenimiento.clientes.modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
		<?php echo e($personas->render()); ?>

	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>