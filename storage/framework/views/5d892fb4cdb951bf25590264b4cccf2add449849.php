<?php $__env->startSection('contenido'); ?>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Créditos Credicash 
			<a href="../procesos/credito/create"><button class="btn btn-success">Nuevo crédito</button></a>			
		</h3>	
	</div>	
</div>		
			<?php echo $__env->make('procesos.credito.search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<br>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>IdCredito</th>
					<th>Cliente</th>
					<th>DNI/RUC</th>
					<th>Analista</th>
                    <th>idCaj</th>
					<th>tipopago</th>
					<th>Monto</th>
                    <th>Interes</th>
                    <th>FechaCred</th>
                    <th>NroCuotas</th>
                    <th>cuotas</th>
					<th>tipocredito</th>
					<th>prenda</th>	
				</thead>
               <?php $__currentLoopData = $credito; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $credi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($credi->idcredito); ?></td>
					<td><?php echo e($credi->nombres); ?></td>
					<td><?php echo e($credi->dniruc); ?></td>
                    <td><?php echo e($credi->name); ?></td>
                    <td><?php echo e($credi->idcajero); ?></td>
					<td><?php echo e($credi->tipopago); ?></td>
					<td><?php echo e($credi->monto); ?></td>
                    <td><?php echo e($credi->interes); ?></td>
                    <td><?php echo e(date("d/m/Y",strtotime($credi->fechacredito))); ?></td>
                    <td><?php echo e($credi->numerocuotas); ?></td>
                    <td><?php echo e($credi->cuotas); ?></td>
                    <td><?php echo e($credi->tipocredito); ?></td>
					<td><?php echo e($credi->prenda); ?></td>					

					<td>
						<a href="<?php echo e(URL::action('CreditoController@edit',$credi->idcredito)); ?>"><button class="btn btn-info" disabled>Editar</button></a>
                         <a href="" data-target="#modal-delete-<?php echo e($credi->idcredito); ?>" data-toggle="modal"><button class="btn btn-danger" <?php if(auth()->user()->idrol=='3'||auth()->user()->id!=$credi->idcajero){echo 'disabled';}?>>Eliminar</button></a>
					</td>
				</tr>
				<?php echo $__env->make('procesos.credito.modal', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>
		</div>
		<?php echo e($credito->render()); ?>

	</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>