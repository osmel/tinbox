<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<script type="text/javascript" src="<?php echo base_url(); ?>js/sistema.js"></script>
<?php $this->load->view( 'header' ); ?>
	<!-- Aseguradoras-->
<?php 
	  $perfil= $this->session->userdata('id_perfil'); 
	  $coleccion_id_operaciones= json_decode($this->session->userdata('coleccion_id_operaciones')); 
	  
	  if ( (count($coleccion_id_operaciones)==0) || (!($coleccion_id_operaciones)) )  {
	  			$coleccion_id_operaciones = array();
	  } 	

?>	

<div class="container margenes">
			<div class="panel panel-primary">
			<div class="panel-heading">Catálogos</div>
			<div class="panel-body">	

				<?php if  ( $perfil == 1 )  { ?>
					<div class="row">
							<div class="col-md-3"></div>
								<div class="col-md-6">
									<a href="<?php echo base_url(); ?>equipos" type="button" class="btn btn-primary btn-lg btn-block">Equipos</a>
								</div>
							<div class="col-md-3"></div>
					</div>	

					<div class="row">
							<div class="col-md-3"></div>
								<div class="col-md-6">
									<a href="<?php echo base_url(); ?>tecnicos" type="button" class="btn btn-primary btn-lg btn-block">Técnicos</a>
								</div>
							<div class="col-md-3"></div>
							
					</div>	


					<div class="row">
							<div class="col-md-3"></div>
								<div class="col-md-6">
									<a href="<?php echo base_url(); ?>estatus" type="button" class="btn btn-primary btn-lg btn-block">Estatus</a>
								</div>
							<div class="col-md-3"></div>
							
					</div>	

							

				<?php } ?>	

				
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<a href="<?php echo base_url(); ?>" type="button" class="btn btn-danger btn-lg btn-block"><i class="glyphicon glyphicon-backward"></i> Regresar 

						</a>
					</div>
					<div class="col-md-3"></div>
				</div>	
			</div>
		</div>
	</div>

<?php $this->load->view( 'footer' ); ?>