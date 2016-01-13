<meta charset="UTF-8">
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php 
 	if (!isset($retorno)) {
      	$retorno ="ordenes";
    }
 $attr = array('class' => 'form-horizontal', 'id'=>'form_catalogos','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('validar_reingreso', $attr);
?>		


<input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $id; ?>">
<input type="hidden" id="id" name="id" value="<?php echo $orden->id; ?>">



<div class="container">
		<br>	
	<div class="row">
		<div class="col-sm-8 col-md-8"><h4>Nuevo Reingreso</h4></div>
	</div>
	<br>
	<div class="container row">
		<div class="panel panel-primary">
			<div class="panel-heading">Datos de Reingreso</div>
			<div class="panel-body">

				<!-- izquierda-->
				<div class="col-sm-6 col-md-6">

					<div class="form-group">
						<label for="id_tecnico" class="col-sm-3 col-md-2 control-label">Técnicos<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
									<select name="id_tecnico" id="id_tecnico" class="form-control" >
											<?php foreach ( $tecnicos as $tecnico ){ ?>
													<option value="<?php echo $tecnico->id; ?>"><?php echo $tecnico->tecnico; ?></option>
											<?php } ?>
									</select>
						</div>
					</div>				

					<div class="form-group">
						<label for="fecha_entrega" class="col-sm-3 col-md-2 control-label">Fecha:<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="fecha  input-sm form-control" id="fecha_entrega" name="fecha_entrega" placeholder="DD-MM-YYYY">
								
						</div>
					</div>					

					<div class="form-group">
						<label for="falla" class="col-sm-3 col-md-2 control-label">Falla<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="falla" name="falla" placeholder="Falla">
						</div>
					</div>

					<!-- comentarios-->	
					<div class="form-group">
						<label for="reporte" class="col-sm-3 col-md-2 control-label">Reporte Técnico<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<textarea class="form-control" name="reporte" id="reporte" rows="7" placeholder="Reporte Técnico"></textarea>
						</div>
					</div>	




				</div>

				<!-- Derecha-->
				<div class="col-sm-6 col-md-6">



					<div class="form-group">
						<label for="subtotal" class="col-sm-3 col-md-2 control-label">SubTotal<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" restriccion="decimal" id="subtotal" name="subtotal" placeholder="Subtotal">
						</div>
					</div>

					<div class="form-group">
						<label for="total" class="col-sm-3 col-md-2 control-label">Total<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" restriccion="decimal" id="total" name="total" placeholder="Total">
						</div>
					</div>



					<div class="form-group">
						<label for="id_estatus" class="col-sm-3 col-md-2 control-label">Estatus<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
									<select name="id_estatus" id="id_estatus" class="form-control" >
											<?php foreach ( $estatus as $estatu ){ ?>
													<option value="<?php echo $estatu->id; ?>"><?php echo $estatu->estatu; ?></option>
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