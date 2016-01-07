<meta charset="UTF-8">
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view('header'); ?>

<?php 

 	if (!isset($retorno)) {
      	$retorno ="usuarios";
    }

  $hidden = array('id_p'=>$id);
  

 $hidden = array('id_p'=>$id);
 $attr = array( 'id' => 'form_usuarios','name'=>$retorno, 'class' => 'form-horizontal', 'method' => 'POST', 'autocomplete' => 'off', 'role' => 'form' );
 echo form_open('validacion_edicion_usuario', $attr,$hidden);


?>

<input value="<?php echo $id; ?>" type="hidden" name="id_usuario" id="id_usuario">

<div class="container" style="background-color:transparent">
	<div class="row">
		<div class="col-md-12"><h1 class="text-center">Edición de Usuario</h1></div>
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
							<?php 
								$nomb_nom='';
								if (isset($usuario->nombre)) 
								 {	$nomb_nom = $usuario->nombre;}
							?>
							<input value="<?php echo  set_value('nombre',$nomb_nom); ?>" type="text" class="form-control" name="nombre" placeholder="Nombre">
						</div>
					</div>
					<div class="form-group">
						<label for="apellidos" class="col-sm-3 col-md-2 control-label">Apellido(s)</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($usuario->apellidos)) 
								 {	$nomb_nom = $usuario->apellidos;}
							?>
							<input value="<?php echo  set_value('apellidos',$nomb_nom); ?>" type="text" class="form-control" name="apellidos" placeholder="Apellido (s)">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 col-md-2 control-label">Email</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($usuario->email)) 
								 {	$nomb_nom = $usuario->email;}
							?>
							<input value="<?php echo  set_value('email',$nomb_nom); ?>" type="text" class="form-control" name="email" placeholder="Email">
						</div>
					</div>
					<div class="form-group">
						<label for="telefono" class="col-sm-3 col-md-2 control-label">Número Teléfono</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($usuario->telefono)) 
								 {	$nomb_nom = $usuario->telefono;}
							?>
							<input value="<?php echo  set_value('telefono',$nomb_nom); ?>" type="text" class="form-control" name="telefono" placeholder="Número Teléfono">
						</div>
					</div>
				</div>
				<div class="col-sm-6 col-md-6">
					<div class="form-group">
						<label for="pass_1" class="col-sm-3 col-md-2 control-label">Contraseña</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($usuario->contrasena)) 
								 {	$nomb_nom = $usuario->contrasena;}
							?>
							<input value="<?php echo  set_value('pass_1',$nomb_nom); ?>" type="password" class="form-control" name="pass_1" placeholder="Contraseña">
						</div>
					</div>
					<div class="form-group">
						<label for="pass_2" class="col-sm-3 col-md-2 control-label">Confirmar Contraseña</label>
						<div class="col-sm-9 col-md-10">
							<?php 
								$nomb_nom='';
								if (isset($usuario->contrasena)) 
								 {	$nomb_nom = $usuario->contrasena;}
							?>
							<input value="<?php echo  set_value('pass_2',$nomb_nom); ?>" type="password" class="form-control" name="pass_2" placeholder="Contraseña">
							
						</div>
					</div>

					<div class="form-group">
						<label for="id_perfil" class="col-sm-3 col-md-2 control-label">Rol de usuario</label>
						<div class="col-sm-9 col-md-10">
						<?php  if ( $this->session->userdata( 'id_perfil' ) != 1 ){ ?>											
							<fieldset disabled>
								<select name="id_perfil" id="id_perfil" class="form-control">
									<?php foreach ( $perfiles as $perfil ){ ?>
										<?php 
										   if  ($perfil->id_perfil==$usuario->id_perfil)
											 {$seleccionado='selected';} else {$seleccionado='';}
										?>
										<option value="<?php echo $perfil->id_perfil; ?>" <?php echo $seleccionado; ?> ><?php echo $perfil->perfil; ?></option>
									<?php } ?>
								</select>
							</fieldset>		
					    <?php } elseif ( $this->session->userdata( 'id_perfil' ) == 1 ){ ?>											
								<select name="id_perfil" id="id_perfil" class="form-control">
									<?php foreach ( $perfiles as $perfil ){ ?>
										<?php 
										   if  ($perfil->id_perfil==$usuario->id_perfil)
											 {$seleccionado='selected';} else {$seleccionado='';}
										?>
										<option value="<?php echo $perfil->id_perfil; ?>" <?php echo $seleccionado; ?> ><?php echo $perfil->perfil; ?></option>
									<?php } ?>
								</select>
					    <?php } ?>									    
						</div>
					</div>



				</div>
			</div>
		</div>

		<div class="row">
			
			<div class="col-md-4 col-md-offset-4 col-sm-12 col-xs-12">
				<a href="<?php echo base_url().$retorno; ?>" type="button" class="btn btn-danger btn-block btn-lg">Cancelar</a>
			</div>
			<div class="col-md-4 col-sm-12 col-xs-12">
				<input style="padding:8px;" type="submit" class="btn btn-success btn-block btn-lg" value="Guardar"/>
			</div>
		</div>
		
	</div>
</div>
  <?php echo form_close(); ?>
<?php $this->load->view('footer'); ?>