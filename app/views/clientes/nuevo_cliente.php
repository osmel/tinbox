<meta charset="UTF-8">
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php 
 	if (!isset($retorno)) {
      	$retorno ="clientes";
    }
 $attr = array('class' => 'form-horizontal', 'id'=>'form_catalogos','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('validar_nuevo_cliente', $attr);
?>		
<div class="container">
		<br>	
	<div class="row">
		<div class="col-sm-8 col-md-8"><h4>Nuevo cliente</h4></div>
	</div>
	<br>
	<div class="container row">
		<div class="panel panel-primary">
			<div class="panel-heading">Datos de cliente</div>
			<div class="panel-body">

				<!-- izquierda-->
				<div class="col-sm-6 col-md-6">

					<div class="form-group">
						<label for="orden" class="col-sm-3 col-md-2 control-label">orden<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control ttip" title="Este campo no admite decimales."  restriccion="entero" id="orden" name="orden" placeholder="orden">
							
						</div>
					</div>

					<div class="form-group">
						<label for="nombre" class="col-sm-3 col-md-2 control-label">Nombre<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
						</div>
					</div>

					<div class="form-group">
						<label for="fecha" class="col-sm-3 col-md-2 control-label">Fecha:<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="fecha  input-sm form-control" id="fecha_entrada" name="fecha_entrada" placeholder="DD-MM-YYYY">
								
						</div>
					</div>					


					<div class="form-group">
						<label for="domicilio" class="col-sm-3 col-md-2 control-label">Domicilio<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Domicilio">
						</div>
					</div>



				</div>

				<!-- Derecha-->
				<div class="col-sm-6 col-md-6">



					<div class="form-group">
						<label for="referencia" class="col-sm-3 col-md-2 control-label">Referencia</label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="referencia" name="referencia" placeholder="Referencia">
						</div>
					</div>


					<div class="form-group">
						<label for="id_equipos" class="col-sm-3 col-md-2 control-label">equipos<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
									<select name="id_equipo" id="id_equipo" class="form-control" >
											<?php foreach ( $equipos as $equipo ){ ?>
													<option value="<?php echo $equipo->id; ?>"><?php echo $equipo->equipo; ?></option>
											<?php } ?>
									</select>
						</div>
					</div>


					<div class="form-group">
						<label for="marca" class="col-sm-3 col-md-2 control-label">marca</label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="marca" name="marca" placeholder="marca">
						</div>
					</div>

					<div class="form-group">
						<label for="falla" class="col-sm-3 col-md-2 control-label">Falla<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="falla" name="falla" placeholder="Falla">
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