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


		<h2 class="text-center">¿DESEAS GUARDAR TU LISTA DE FECHAS ESPECIALES?</h2>
		<h5 class="text-center">!Podrás utilizarla en otro calendario sin reescribir toda la información!</h5>
	</div>
	<div class="modal-body">

 			<div class="form-group">

                <label style="padding-top: 7px;" class="col-xs-1 col-md-1 control-label">Título</label>
                <div class="col-xs-12 col-md-12">
                  <input type="text" class="form-control" id="nombre_lista" name="nombre_lista" placeholder="Nombre de la lista">
                </div>
                <div class="col-xs-12 col-md-12">
                
                  <?php if ($correo_activo!='') { ?>	
                  	<input disabled value="<?php echo $correo_activo; ?>" type="text" class="form-control" id="correo_lista" name="correo_lista" placeholder="Correo electrónico">
                  <?php } else { ?>	
					<input value="<?php echo $correo_activo; ?>" type="text" class="form-control" id="correo_lista" name="correo_lista" placeholder="Correo electrónico">	                  
                  <?php } ?>	
                </div>
            </div>      

		<div class="alert" id="messagesModal"></div>
	</div>
	<div class="modal-footer">
		<button class="btn btn-danger" name="guardar" id="deleteUserSubmit">GUARDAR LISTA</button>
		<button class="btn btn-default" name="noguardar" id="deleteUserSubmit">No me interesa, deseo continuar</button>

		<!-- <button class="btn btn-default" data-dismiss="modal">No me interesa, deseo continuar</button> -->
	</div>
<?php echo form_close(); ?>