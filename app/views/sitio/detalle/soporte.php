<meta charset="UTF-8">
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
 	if (!isset($retorno)) {
      	$retorno ="clientes";
    }
 $attr = array('class' => 'form-horizontal', 'id'=>'form_catalogos','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open('validar_nuevo_cliente', $attr);
?>		

	<div>
		<div class="col-sm-12 col-md-12">
				<h4>
					soporte
				 </h4>
		</div>
		
		
	</div>

<?php echo form_close(); ?>
