<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php
 	if (!isset($retorno)) {
      	$retorno ="tinbox/fotocalendario";
    }
 $hidden = array('lista'=>''); 
?>
<?php echo form_open_multipart('guardar_lista', array('class' => 'form-horizontal','id'=>'form_guardar_lista','name'=>$retorno, 'method' => 'POST', 'role' => 'form', 'autocomplete' => 'off' ) ,   $hidden ); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
    	<div id="foo1"></div>
    	<div class="alert" id="messages1"></div>


		
		
	</div>
	<div class="modal-body">

 			<div class="form-group">

 					<h5 class="text-center">No hemos detectado fechas en tu calendario.</h5>
            </div>      

		<div class="alert" id="messagesModal"></div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-danger" name="noguardar" id="deleteUserSubmit">Continuar</button>
		<button class="btn btn-default" data-dismiss="modal">Regresar</button> 
	</div>
<?php echo form_close(); ?>