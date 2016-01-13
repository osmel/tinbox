<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<div class="container">
	<div>
		<div>
			<table style="width: 100%; border: 2px solid #222222;">
				<tbody>
					<tr>
						<td>
							<p style="font-size: 15px; line-height: 20px; padding: 0px; margin-bottom: 0px;">
								<span><b>Fecha y hora: </b> <?php echo date( 'd-m-Y h:i:s A');  ?></span><br>
							</p>
							<p style="font-size: 14px;"><b >Listado de Clientes</b></p>

						</td>

					</tr>
				</tbody>
			</table>
			<table style="width: 100%; border: 2px solid #222222; font-size: 12px;">
				<thead>
					<tr><th> </th></tr>
						<tr>
							<th class="text-center cursora" style="width:10%">Orden Servicio</th>
							<th class="text-center cursora" style="width:15%">Fecha</th>
							<th class="text-center cursora" style="width:25%">Nombre</th>
							<th class="text-center cursora" style="width:25%">Equipo</th>
							<th class="text-center cursora" style="width:10%">Falla</th>
							<th class="text-center cursora" style="width:15%">Estatus</th>
						</tr>
				</thead>
				<tbody>
				<?php if ( isset($movimientos) && !empty($movimientos) ): ?>
					<?php foreach( $movimientos as $movimiento ): ?>
						<tr>
							<td width="10%" style="border-top: 1px solid #222222;"><?php echo $movimiento->orden; ?></td>								
							<td width="15%" style="border-top: 1px solid #222222;"><?php echo $movimiento->fecha_entrada; ?></td>
							
							<td width="25%" style="border-top: 1px solid #222222;"><?php echo $movimiento->nombre; ?></td>
							<td width="25%" style="border-top: 1px solid #222222;"><?php echo $movimiento->equipo; ?></td>
							<td width="10%" style="border-top: 1px solid #222222;"><?php echo $movimiento->falla; ?></td>
							<td width="15%" style="border-top: 1px solid #222222;"><?php echo $movimiento->estatus; ?></td>
							


						</tr>
					<?php endforeach; ?>
				<?php else : ?>
						<tr class="noproducto">
							<td colspan="9">No existen clientes</td>
						</tr>
				<?php endif; ?>	
				</tbody>	
	
					
			</table>
		</div>
	</div>
</div>