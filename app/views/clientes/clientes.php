<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php
 	if (!isset($retorno)) {
      	$retorno ="catalogos";
    }
?>    

	<div class="container">
		
		<div class="container row">
		<div class="panel panel-primary">
			<div class="panel-heading">Listado de Clientes</div>
			<div class="panel-body">

				<div class="col-md-3"></div>	
				<div class="col-md-3">
					<a href="<?php echo base_url(); ?>" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
				</div>

				
					
				<div class="col-sm-3 col-md-3">
					<fieldset id="disa_reportes"> 	
					     <a style="padding:8px;" id="impresion_reporte" type="button" class="btn btn-success btn-block">Imprimir</a>
					</fieldset>		
				</div>
					
				
				<div class="col-md-3">
					<a href="<?php echo base_url(); ?>nuevo_cliente" type="button" class="btn btn-success btn-block">Nuevo Cliente</a>
				</div>
			
			<div class="col-md-12">				
				<div class="table-responsive">
				<br/>
					<section>
						<table id="tabla_clientes" class="display table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th class="text-center cursora" style="width:10%">Orden Servicio</th>
									<th class="text-center cursora" style="width:10%">Fecha</th>
									<th class="text-center cursora" style="width:20%">Nombre</th>
									<th class="text-center cursora" style="width:10%">Equipo</th>
									<th class="text-center cursora" style="width:20%">Falla</th>
									<th class="text-center cursora" style="width:10%">Estatus</th>
									<th class="text-center" style="width:5%"><strong>Detalles</strong></th>
									<th class="text-center" style="width:5%"><strong>Baja Temporal</strong></th>
								</tr>
							</thead>
						</table>
					</section>


			</div>

			</div>
		</div>
		</div>
		<br>
		<div class="row">

			<div class="col-md-9"></div>
			<div class="col-md-3">
				<a href="<?php echo base_url(); ?>" class="btn btn-danger btn-block"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
			</div>
		</div>
	</div>

<?php $this->load->view('footer'); ?>	

<div class="modal fade bs-example-modal-lg" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>	

