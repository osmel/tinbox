<meta charset="UTF-8">
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>
<?php 

 	if (!isset($retorno)) {
      	$retorno ="usuarios";
    }

 $attr = array('class' => 'form-horizontal', 'id'=>'form_usuarios','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('validar_nuevo_usuario', $attr);
?>		

<input value="0" type="hidden" name="id_usuario" id="id_usuario">

<div class="container" style="background-color:transparent">	
	<div class="row">
		<div class="col-md-12"><h1 class="text-center">Registro de nuevo Usuario</h1></div>
	</div>
	<br>
	<div class="container row">
		<div class="panel panel-primary">
			<div class="panel-heading">Datos del Usuario</div>
			
			<div class="panel-body">
				<div class="col-sm-6 col-md-6">
					<div class="form-group">
						<label for="nombre" class="col-sm-3 col-md-2 control-label">Nombre</label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
						</div>
					</div>
					<div class="form-group">
						<label for="apellidos" class="col-sm-3 col-md-2 control-label">Apellido(s)</label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellido (s)">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 col-md-2 control-label">Email</label>
						<div class="col-sm-9 col-md-10">
							<input type="email" class="form-control" id="email" name="email" placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="telefono" class="col-sm-3 col-md-2 control-label">Número Teléfono </label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Número Teléfono">
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-6">
					<div class="form-group">
						<label for="pass_1" class="col-sm-3 col-md-2 control-label">Contraseña</label>
						<div class="col-sm-9 col-md-10">
							<input type="password" class="form-control" id="pass_1" name="pass_1" placeholder="Contraseña">
						</div>
					</div>
					<div class="form-group">
						<label for="pass_2" class="col-sm-3 col-md-2 control-label">Confirmar Contraseña</label>
						<div class="col-sm-9 col-md-10">
							<input type="password" class="form-control" id="pass_2" name="pass_2" placeholder="Confirmar Contraseña">
						</div>
					</div>

					<div class="form-group">
						<label for="id_perfil" class="col-sm-3 col-md-2 control-label">Rol de usuario</label>
						<div class="col-sm-9 col-md-10">
							<?php  if ( $this->session->userdata( 'id_perfil' ) == 2 ){ ?>											
								<fieldset disabled>
									<select name="id_perfil" id="id_perfil" class="form-control">
										<!--<option value="0">Selecciona una opción</option>-->
											<?php foreach ( $perfiles as $perfil ){ ?>
												<?php if ( $this->session->userdata( 'id_perfil' ) == $perfil->id_perfil ){ ?>
													<option value="<?php echo $perfil->id_perfil; ?>"><?php echo $perfil->perfil; ?></option>
												<?php } ?>	
											<?php } ?>
											<!--rol de usuario -->
									</select>
								</fieldset>		
						    <?php } elseif ( $this->session->userdata( 'id_perfil' ) == 1 ){ ?>											
									<select name="id_perfil" id="id_perfil" class="form-control" dependencia="coleccion_id_operaciones" nombre="coleccion_id_operaciones">
										<!--<option value="0">Selecciona una opción</option>-->
											<?php foreach ( $perfiles as $perfil ){ ?>
													<option value="<?php echo $perfil->id_perfil; ?>"><?php echo $perfil->perfil; ?></option>
											<?php } ?>
											<!--rol de usuario -->
									</select>
						    <?php } ?>									    
						</div>
					</div>


	
				</div>
						
			</div>
		</div>
				
		<div class="col-sm-12 col-md-12" style="padding-bottom: 20px;">	
			
			<div class="col-md-4 col-md-offset-4 col-sm-12 col-xs-12">
				<a href="<?php echo base_url().$retorno; ?>" type="button" class="btn btn-danger btn-block btn-lg">Cancelar</a>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<input type="submit" class="btn btn-success btn-block btn-lg" value="Guardar"/>
			</div>
		</div>

	</div>	
</div>
<?php echo form_close(); ?>
<?php $this->load->view('footer'); ?>