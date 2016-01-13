<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

	<div class="container ">
		<br>
		<div class="row">
			
			
			<?php $perfil= $this->session->userdata('id_perfil');  ?>
			<?php if  ( $perfil == 1 )  { ?>

				<div class="col-md-3">
					<a href="<?php echo base_url(); ?>historicoaccesos" type="button" style="margin-bottom:15px;" class="btn btn-primary btn-block btn-lg"><span class="glyphicon glyphicon-th-list" aria-hidden="true" style="margin-right:7px"></span>Histórico de accesos</a>					
				</div>

			<?php } ?>		

			<?php if  ( $perfil != 1 )  { ?>
				<div class="col-md-3"></div>
			<?php } ?>		

			<div class="col-md-3">
				<a href="<?php echo base_url(); ?>nuevo_usuario" type="button" style="margin-bottom:15px;" class="btn btn-success btn-block btn-lg"><span class="glyphicon glyphicon-plus" aria-hidden="true" style="margin-right:7px"></span>Agregar Usuario</a>					
			</div>
		</div>

		<div class="container margenes">
			<div class="panel panel-primary">
			<div class="panel-heading">Listado de Usuarios</div>
			<div class="panel-body">

		

			<div class="table-responsive">
				<section>
					<table id="tabla_usuarios" class="display table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th class="text-center cursora" width="25%">Usuario </th>
								<th class="text-center cursora" width="20%">Perfil </th>
								<th class="text-center cursora" width="20%">E-mail </th>
								<th class="text-center" width="5%">Editar</th>
								<th class="text-center" width="5%">Eliminar</th>
							</tr>
						</thead>
					</table>
				</section>
			</div>









			</div>
		</div>
	</div>
</div>


<br>
<div class="row">
	<div class="col-md-4 col-md-offset-8">
		<a href="<?php echo base_url(); ?>" class="btn btn-danger btn-block btn-lg"><i class="glyphicon glyphicon-backward"></i> Regresar</a>
	</div>
</div>



<?php $this->load->view('footer'); ?>	

<div class="modal fade bs-example-modal-lg" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>	
	

<div class="modal fade bs-example-modal-lg" id="modalMessage36" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>	