<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


	<div class="container">
		<br>

			<!-- Cliente -->

			<div class="panel panel-primary">
				<p style="font-size: 14px;"><b >Datos del Cliente</b></p>
				<div class="panel-body">
					<div class="col-md-6">
						<ul class="list-group">
							<li class="list-group-item">							
								<span>Orden de Servicio: <?php echo  $cliente->orden;?></span>
							</li>
							<li class="list-group-item">							
								<span>Nombre: <?php echo  $cliente->nombre;?></span>
							</li>
							<li class="list-group-item">							
								<span>Fecha: <?php echo  $cliente->fecha_entrada;?></span>
							</li>
							<li class="list-group-item">							
								<span>Domicilio: <?php echo  $cliente->domicilio;?></span>
							</li>
	
							<li class="list-group-item">							
								<span>Referencia: <?php echo  $cliente->referencia;?></span>
							</li>

							<li class="list-group-item">							
								<span>Equipo: <?php echo  $cliente->equipo;?></span>
							</li>

							<li class="list-group-item">							
								<span>marca: <?php echo  $cliente->marca;?></span>
							</li>

							<li class="list-group-item">							
								<span>Falla: <?php echo  $cliente->falla;?></span>
							</li>
							


						</ul>
					</div>

									

				</div>


				<div class="panel-body">

					<?php if ( $orden != FALSE ) { ?>
						<p style="font-size: 14px;"><b >Datos de la Orden</b></p>
						<div class="col-md-6">
							<ul class="list-group">
								<li class="list-group-item">							
									<span>Técnico: <?php echo  $orden->tecnico;?></span>
								</li>
								<li class="list-group-item">							
									<span>Fecha: <?php echo  $orden->fecha_entrega;?></span>
								</li>

								<li class="list-group-item">							
									<span>Falla: <?php echo  $orden->falla;?></span>
								</li>
								<li class="list-group-item">							
									<span>Reporte: <?php echo  $orden->reporte;?></span>
								</li>


								<li class="list-group-item">							
									<span>SubTotal: <?php echo  number_format($orden->subtotal, 3, '.', ',');?></span>
								</li>
								<li class="list-group-item">							
									<span>Total: <?php echo  number_format($orden->total, 3, '.', ',');?></span>
								</li>
								<li class="list-group-item">							
									<span>estatus: <?php echo  $orden->estatus;?></span>
								</li>								

							</ul>
						</div>

										


					<?php } ?>	

				</div>



			</div>

		<!-- -->


		</div>

