<meta charset="UTF-8">
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php 
 	if (!isset($retorno)) {
      	$retorno ="ordenes";
    }
 $attr = array('class' => 'form-horizontal', 'id'=>'form_catalogos','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('validar_editar_orden', $attr);
?>		

<input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $id; ?>">
<input type="hidden" id="id" name="id" value="<?php echo $orden->id; ?>">


<div class="container">
		<br>	
	<div class="row">
		<div class="col-sm-8 col-md-8"><h4>Editar orden</h4></div>
	</div>
	<br>
	<div class="container row">
		<div class="panel panel-primary">
			<div class="panel-heading">Datos de orden</div>
			<div class="panel-body">

				<!-- izquierda-->
				<div class="col-sm-6 col-md-6">

					<div class="form-group">
						<label for="id_tecnico" class="col-sm-3 col-md-2 control-label">Técnicos<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
									<select name="id_tecnico" id="id_tecnico" class="form-control" >
											<?php foreach ( $tecnicos as $tecnico ){ ?>
													<?php 
													if  ($tecnico->id==$orden->id_tecnico)
														{$seleccionado='selected';} else {$seleccionado='';}
													?>											
													<option value="<?php echo $tecnico->id; ?>" <?php echo $seleccionado; ?> ><?php echo $tecnico->tecnico; ?></option>
											<?php } ?>
									</select>
						</div>
					</div>				

					<div class="form-group">
						<label for="fecha_entrega" class="col-sm-3 col-md-2 control-label">Fecha:<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">

							<?php 
								$nomb_nom='';
								if (isset($orden->fecha_entrega)) 
								 {	$nomb_nom = $orden->fecha_entrega;}
							?>						
							<input value="<?php echo  set_value('fecha_entrega',$nomb_nom); ?>" type="text" class="fecha  input-sm form-control" id="fecha_entrega" name="fecha_entrega" placeholder="DD-MM-YYYY">
								
						</div>
					</div>					

					<div class="form-group">
						<label for="falla" class="col-sm-3 col-md-2 control-label">Falla<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($orden->falla)) 
								 {	$nomb_nom = $orden->falla;}
							?>	
							<input value="<?php echo  set_value('falla',$nomb_nom); ?>" type="text" class="form-control" id="falla" name="falla" placeholder="Falla">
						</div>
					</div>

					<!-- comentarios-->	
					<div class="form-group">
						<label for="reporte" class="col-sm-3 col-md-2 control-label">Reporte Técnico<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($orden->reporte)) 
								 {	$nomb_nom = $orden->reporte;}
							?>	
												
							<textarea class="form-control" name="reporte" id="reporte" rows="7" placeholder="Reporte Técnico"><?php echo  set_value('reporte',$nomb_nom); ?></textarea>
						</div>
					</div>	




				</div>

				<!-- Derecha-->
				<div class="col-sm-6 col-md-6">



					<div class="form-group">
						<label for="subtotal" class="col-sm-3 col-md-2 control-label">SubTotal<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($orden->subtotal)) 
								 {	$nomb_nom = $orden->subtotal;}
							?>	
							<input value="<?php echo  set_value('subtotal',$nomb_nom); ?>" restriccion="decimal" type="text" class="form-control" id="subtotal" name="subtotal" placeholder="Subtotal">
						</div>
					</div>

					<div class="form-group">
						<label for="total" class="col-sm-3 col-md-2 control-label">Total<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($orden->total)) 
								 {	$nomb_nom = $orden->total;}
							?>	
							<input value="<?php echo  set_value('total',$nomb_nom); ?>" restriccion="decimal" type="text" class="form-control" id="total" name="total" placeholder="Total">
						</div>
					</div>



					<div class="form-group">
						<label for="id_estatus" class="col-sm-3 col-md-2 control-label">Estatus<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
									<select name="id_estatus" id="id_estatus" class="form-control" >
											<?php foreach ( $estatus as $estatu ){ ?>
													<?php 
													if  ($estatu->id==$orden->id_estatus)
														{$seleccionado='selected';} else {$seleccionado='';}
													?>											
													<option value="<?php echo $estatu->id; ?>" <?php echo $seleccionado; ?> ><?php echo $estatu->estatu; ?>											
											<?php } ?>
									</select>
						</div>
					</div>



				
				</div>



			</div>
		</div>
		<br>
		<div class="row">
			<div class="col-sm-4 col-md-4"></div>
			<div class="col-sm-4 col-md-4">
				<a href="<?php echo base_url(); ?><?php echo $retorno; ?>" type="button" class="btn btn-danger btn-block">Cancelar</a>
			</div>
			<div class="col-sm-4 col-md-4">
				<input style="padding:8px;" type="submit" class="btn btn-success btn-block" value="Guardar"/>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>
<?php $this->load->view('footer'); ?>