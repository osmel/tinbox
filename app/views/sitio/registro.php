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
					Llena el formulario y solicita la visita de un técnico o haznos saber tus inquietudes ,
				 	por este medio damos respuesta a las preguntas más frecuentes de nuestros usuarios .
				 </h4>
			 </div>
		
		<br/>
	
		<div class="panel1 panel-primary col-sm-12 col-md-12">
			
			<div class="panel-body">

				<!-- izquierda-->
				<div class="col-sm-12 col-md-12">

					<div class="form-group">
						<label for="nombre" class="col-sm-3 col-md-2 control-label">Nombre y apellidos<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control ttip" title="Escriba su nombre y apellido." id="nombre" name="nombre" placeholder="Nombre">
							
						</div>
					</div>

					<div class="form-group">
						<label for="email" class="col-sm-3 col-md-2 control-label">Correo<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="email" class="form-control ttip" title="Escriba su correo Electronico." id="email" name="email" placeholder="email">
							
						</div>
					</div>

					<div class="form-group">
						
						<label for="celular" class="col-sm-3 col-md-2 control-label">Celular<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control ttip" title="Escriba su celular." id="celular" name="celular" placeholder="celular">
						</div>	
					</div>					

					<div class="form-group">
						<label for="telefono" class="col-sm-3 col-md-2 control-label">Teléfono</label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="telefono" name="telefono" placeholder="telefono">
						</div>
					</div>


					<div class="form-group">
						<label for="domicilio" class="col-sm-3 col-md-2 control-label">Domicilio<span class="obligatorio"> *</span></label>
						<div class="col-sm-9 col-md-10">
							<input type="text" class="form-control" id="domicilio" name="domicilio" placeholder="Domicilio">
						</div>
					</div>



					<div class="form-group">
						<label for="informe" class="col-sm-3 col-md-2 control-label">Información</label>
						<div class="col-sm-9 col-md-10">
							<textarea class="form-control" name="informe" id="informe" rows="4" placeholder="Reporte Técnico"></textarea>
						</div>
					</div>

					


				</div>

				
					<div class="col-sm-4 col-md-8"></div>
						<div class="col-sm-4 col-md-4">
							<input style="padding:8px;" type="submit" class="btn btn-danger btn-block" value="Enviar"/>
						</div>
					</div>



			</div>
		
		
		
	</div>

<?php echo form_close(); ?>
