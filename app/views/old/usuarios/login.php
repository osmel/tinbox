<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>

<?php
  if (!isset($retorno)) {
        $retorno ="";
    }
    

?> 

	<div class="container">
		<div class="row">
			<h1 class="text-center"><strong>Bienvenido a prueba</strong></h1>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
				<div class="formulario-fondos">
					<?php
 					 $attr = array( 'id' => 'form_usuarios','name'=>$retorno, 'class' => 'form-horizontal', 'method' => 'POST', 'autocomplete' => 'off', 'role' => 'form' );
					 echo form_open('validar_login', $attr);
					?>
						<div class="form-group">
							<div class="col-md-12">
								<input type="email" class="form-control" id="email" name="email" placeholder="Usuario">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-7">
								<a href="<?php echo base_url(); ?>forgot">¿Olvidaste tu contraseña?</a>
							</div>
							<div class="col-md-5">
								<button type="submit" class="btn btn-primary col-md-12 btn-block btn-lg">Ingresar <i class="glyphicon glyphicon-log-in"></i></button>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
<?php $this->load->view( 'footer' ); ?>