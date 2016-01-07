<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php 
 	if (!isset($retorno)) {
      	$retorno ="clientes";
    }

$hidden = array('id'=>$id,'baja'=>$baja); ?>
<?php echo form_open('validar_eliminar_cliente', array('class' => 'form-horizontal','id'=>'form_catalogos','name'=>$retorno, 'method' => 'POST', 'role' => 'form', 'autocomplete' => 'off' ) ,   $hidden ); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3 class="text-left">Cambiar Estatus de Cliente</h3>
	</div>
	<div class="modal-body">
		<p>¿Estás seguro de que deseas <b><?php echo  $activo ; ?></b> el cliente <b><?php echo  $nombrecompleto ; ?></b>?</p>
		<p>Recuerde, este proceso es reversible.</p>
		<div class="alert" id="messagesModal"></div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-danger" id="deleteUserSubmit">Aceptar</button>
		<button class="btn btn-default" data-dismiss="modal">Cancelar</button>
	</div>
	<input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
	<input type="hidden" id="baja" name="baja" value="<?php echo $baja; ?>">
<?php echo form_close(); ?>