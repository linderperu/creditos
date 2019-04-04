<?php $__env->startSection('contenido'); ?>
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<!--<h3>Listado de cobranza<a href="/procesos/cobro/create"><button class="btn btn-success">Nuevo</button></a></h3> -->
	<center>	<h2>Listado de cobranza para hoy: <?php
			setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
			$d = now();
			$fecha = strftime("%d de %B del %Y", strtotime($d));
			echo $fecha; ?></h2></center>
		
		<input class="btn btn-danger" type="button" onclick="printDiv('areaImprimir')" value="Imprimir listado" />
		<br></br>
		<?php echo $__env->make('procesos.cobro.search', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	</div>
</div>

<div class="row" id="imprimeme">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>CodCredito </th>
					<th>DNI/RUC</th>
					<th>Nombres Cliente</th>
					<th>Analista</th>
					<th>Monto</th>
                    <th>FechaPago</th>
                    <th>FechaDeposito</th>
                    <th>MontoApagar</th>
                    <th>MontoCobrado</th>
                    <th>Saldo</th>
					<th>Nro Cuota</th>
					<th>Estadocuota</th>
					<th>Observaciones</th>
				</thead>
				<?php setlocale(LC_ALL,"es_ES@euro","es_ES","esp");?>
               <?php $__currentLoopData = $cobro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td><?php echo e($cob->idcredito); ?></td>
					<td><?php echo e($cob->dniruc); ?></td>
					<td><?php echo e($cob->nombres); ?></td>
					<td><?php echo e($cob->name); ?></td>
					<td><?php echo e($cob->monto); ?></td>
                    <td><?php echo e(strftime("%d de %B del %Y",strtotime($cob->fechapago))); ?></td>
                    <td><?php echo e($cob->fechadeposito); ?></td>
                    <td><?php echo e($cob->montoapagar); ?></td>
                    <td><?php echo e($cob->montocobrado); ?></td>
                    <td><?php echo e($cob->saldo); ?></td>
                    <td><?php echo e($cob->cuota); ?></td>
					<td><?php echo e($cob->estadocuota); ?></td>
					<td><?php echo e($cob->observaciones); ?></td>
					<td>
						<?php if($cob->estadocuota=='Cancelada'): ?>
						<a href="<?php echo e(URL::action('CobroController@edit',$cob->idcobro)); ?>"><button class="btn btn-danger">Imprimir</button>
						<?php else: ?>
						<a href="<?php echo e(URL::action('CobroController@edit',$cob->idcobro)); ?>"><button class="btn btn-info">Pagar cuota</button></a>
						<?php endif; ?>
					</td>
				</tr>
				
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</table>


			<div class="table-responsive"  hidden id="areaImprimir">
				<center><h3>Listado de cobranza 	<?php 	echo $fecha; ?></h3></center><br>
			<table class="table table-striped table-bordered table-condensed table-hover" >
					<thead>	
						<th>Nro </th>				
						<th>Cliente </th>
						<th>DNI/RUC</th>
						<th>Credito</th>
						<th>Fecha de pago</th>
		<center><th>Nro. Cuota</th></center>
						<th>Cuota</th>					
						<th>Estado</th>
						<th>Analista</th>	
					</thead>
					<?php setlocale(LC_ALL,"es_ES@euro","es_ES","esp"); $i=0;?>
					<?php $__currentLoopData = $cobro; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cob): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td><?php echo e($i=$i+1); ?></td>
						<td><?php echo e($cob->nombres); ?></td>
						<td><?php echo e($cob->dniruc); ?></td>
						<td><?php echo e($cob->monto); ?></td>						
						<td><?php echo e(strftime("%d de %B del %Y",strtotime($cob->fechapago))); ?></td>	
						<td><?php echo e($cob->cuota); ?></td>	
						<td><?php echo e($cob->montoapagar); ?></td>
						<td><?php echo e($cob->estadocuota); ?></td>
						<td><?php echo e($cob->name); ?></td>
								
					</tr>	
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				
				</table>
			</div>



		</div>
		<?php echo e($cobro->render()); ?>

	</div>
</div>
<script language="JavaScript" type="text/JavaScript">

	function printDiv(nombreDiv) {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;
     document.body.innerHTML = contenido;
     window.print();		 
		 document.body.innerHTML = contenidoOriginal;	
		
		 window.close();	
		

		}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>