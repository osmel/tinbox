
		
	      <!-- Factura-->

			<div class="panel panel-primary">
				<div class="panel-heading col-md-12">
					<div class="col-md-9"><h4>Información de la Factura</h4></div>
					<div class="col-md-3">

						<?php  if ($id_perfil!=3) { ?>
							<a href="<?php echo base_url(); ?>factura/<?php echo $unidad->id; ?>/<?php echo base64_encode($unidad->uid);?>" class="btn btn-info btn-block">Agregar/Editar</a>
						<?php  } else { ?>
								<a href="#" disabled  class="btn btn-info btn-block">Agregar/Editar</a>
						<?php  } ?>


					</div>
				</div>

				<div class="panel-body">
					<?php if ( $factura != FALSE ) { ?>
							<div class="col-md-6">
								<ul class="list-group">
									<li class="list-group-item">							
										<span>Número de Factura: <?php echo $factura->numero; ?>	</span>
									</li>
									<li class="list-group-item">							
										<span>Fecha: <?php echo $factura->fecha; ?></span>
									</li>
									<li class="list-group-item">							
										<span>Emisor: <?php echo $factura->emisor; ?></span>
									</li>
								</ul>
							</div>
							<div class="col-md-6">
								<ul class="list-group">	
									<li class="list-group-item">							
										<span>Importe: <?php echo "$ ".number_format($factura->importe, 2, '.', ','); ?></span>
									</li>
									<!-- <li class="list-group-item">							
										<span>Original: <?php echo $factura->original; ?></span>
									</li> -->
									<?php if ($total_archivos->archivo<>""){ ?>
									<li class="list-group-item">							
										<span>Archivo adjunto: 
											<a target="_blank" target="_blank" href="<?php echo base_url(); ?>uploads/facturas/<?php echo $total_archivos->archivo; ?>" type="button"><?php echo $total_archivos->archivo; ?></a>
										</span>
									</li>										
									<?php } ?>
									<li class="list-group-item">							
										<span>Comentarios: </span>
											<span><?php echo $factura->comentario; ?>
										</span>
									</li>
																		
								</ul>
							</div>								

					<?php } ?>												

				</div>
				
		
		</div>




		<!-- tabla de historico-->

	
			<div>

				<div class="panel panel-danger">
					<div class="panel-heading">Historico de Trámites</div>
					<table class="table table-striped table-bordered table-responsive table-scrollable">
						<tr>
							<th class="text-left" width="70%">Evento</th>							
							<th class="text-center" width="15%">Fecha</th>
							<th class="text-center" width="10%">Usuarios</th>
							<th class="text-center" width="5%">Detalles</th>
						</tr>


						<?php if ( isset($eventos_tramites) && !empty($eventos_tramites) ): ?>
						   		<?php foreach( $eventos_tramites as $evento ): ?>
									<tr>
										<td class="text-left"><?php echo $evento->evento; ?></td>
										<td class="text-center"><?php echo $evento->fecha_mac; ?></td>
										<td class="text-center"><?php echo $evento->usuario; ?></td>
										
										
										<td class="text-center">
											<?php  if ($id_perfil!=3) { ?>
												<a href="<?php echo base_url(); ?>
													detalle_historico/<?php echo base64_encode($evento->id_evento); ?>/<?php echo base64_encode($evento->uid_unidad); ?>/<?php echo base64_encode($evento->id_tramite); ?>/<?php echo base64_encode($evento->id); ?>"
													 type="button" class="btn btn-default btn-sm">Ver</a>
											<?php  } else { ?>
													<a href="#" disabled  type="button" class="btn btn-default btn-sm">Ver</a>
											<?php  } ?>
										</td>
									</tr>

								<?php endforeach; ?>
						<?php else : ?>
									<tr>
										<td colspan="4">No hay eventos</td>
									</tr>
						<?php endif; ?>	

					</table>
				</div>
			</div>


