jQuery(document).ready(function($) {


	var opts = {
		lines: 13, 
		length: 20, 
		width: 10, 
		radius: 30, 
		corners: 1, 
		rotate: 0, 
		direction: 1, 
		color: '#E8192C',
		speed: 1, 
		trail: 60,
		shadow: false,
		hwaccel: false,
		className: 'spinner',
		zIndex: 2e9, 
		top: '50%', // Top position relative to parent
		left: '50%' // Left position relative to parent		
	};

	jQuery(".navigacion").change(function()
	{
	    document.location.href = jQuery(this).val();
	});

   

	var target = document.getElementById('foo');

	//tratamiento de fechas
	var fecha_actual = new Date();
	
	var fecha_anterior = new Date( fecha_actual.getTime() - (30 * 24 * 3600 * 1000));

	var dd = fecha_actual.getDate();
	var dd_anterior = fecha_anterior.getDate();

	var mm = fecha_actual.getMonth()+1;
	var mm_anterior = fecha_anterior.getMonth()+1;
	if(dd<10) {
    	dd='0'+dd;
	} 
	if(dd_anterior<10) {
    	dd_anterior='0'+dd_anterior;
	} 

	if(mm<10) {
	    mm='0'+mm;
	} 

	if(mm_anterior<10) {
	    mm_anterior='0'+mm_anterior;
	} 


	//var fecha_actual = new Date('December 25, 2005 23:15:00');
	var yyyy = fecha_actual.getFullYear();
	var yyyy_anterior = fecha_anterior.getFullYear();
	
	var fecha_formateada = dd+mm+yyyy;		

	var fecha_ayer = yyyy_anterior+'/'+mm_anterior+'/'+dd_anterior;
	var fecha_hoy = dd+'/'+mm+'/'+yyyy;	

	var fecha_hoy_uno = dd+'/'+mm+'/'+yyyy;	


 	jQuery('.fecha').datepicker({ format: 'dd-mm-yyyy'});


  	jQuery( "#cont_tab" ).animate({height: 'toggle'},1);

jQuery('body').on('click','#otroacomp', function (e) {
  jQuery( "#cont_tab" ).animate({height: 'toggle'});
});



//gestion de usuarios (crear, editar y eliminar )
	jQuery("#form_usuarios").submit(function(e){
		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);
		jQuery(this).ajaxSubmit({
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);
				

				}else{

						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/usuarios';						
				}
			} 
		});
		return false;
	});	




//gestion de usuarios (crear, editar y eliminar )
	jQuery("#form_formulario").submit(function(e){
		var spinner = new Spinner(opts).spin(target);
		jQuery(this).ajaxSubmit({
			dataType : 'json',
			success: function(data){
				if(data != true){
					
					spinner.stop();
	

							jQuery('#nombreAlert').html(data.nombre);

							jQuery('#apellidopAlert').html(data.apellidop);
							jQuery('#apellidomAlert').html(data.apellidom);
							jQuery('#nacimientoAlert').html(data.dia);
							jQuery('#emailAlert').html(data.email);
							jQuery('#licenciaAlert').html(data.licencia);
							jQuery('#vigenciaAlert').html(data.dia_lic);

							jQuery('#calleAlert').html(data.calle);
							jQuery('#coloniaAlert').html(data.colonia);
							jQuery('#delegacionAlert').html(data.delegacion);
							jQuery('#ciudadAlert').html(data.ciudad);
							jQuery('#cpostalAlert').html(data.cpostal);
							jQuery('#referenciaAlert').html(data.referencia);

							jQuery('#oficinaAlert').html(data.oficina);
							jQuery('#telefonoAlert').html(data.telefono);
							jQuery('#celularAlert').html(data.celular);
							jQuery('#telefono2Alert').html(data.telefono2);

							jQuery('#modeloAlert').html(data.modelo);
							jQuery('#placaAlert').html(data.placa);
							jQuery('#serieAlert').html(data.serie);

							jQuery('#nombA1Alert').html(data.nombA1);
							jQuery('#edadA1Alert').html(data.edadA1);
							//jQuery('#nombA2Alert').html(data.nombA2);
							jQuery('#comentarioAlert').html(data.comentario);



					jQuery('#alerta').html(data.coleccion_id_aviso);

				

				}else{

					    $catalogo = e.target.name;
						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = $catalogo;



				}
			} 
		});
		return false;
	});



	//gestion de usuarios (crear, editar y eliminar )
	jQuery("#form_respaldo").submit(function(e){
		jQuery('#foo').css('display','block');
		var spinner = new Spinner(opts).spin(target);
		jQuery(this).ajaxSubmit({
			success: function(data){
				if(data != true){
					
					spinner.stop();
					jQuery('#foo').css('display','none');
					jQuery('#messages').css('display','block');
					jQuery('#messages').addClass('alert-danger');
					jQuery('#messages').html(data);
					jQuery('html,body').animate({
						'scrollTop': jQuery('#messages').offset().top
					}, 1000);
				

				}else{

						spinner.stop();
						jQuery('#foo').css('display','none');
						window.location.href = '/usuarios';						
				}
			} 
		});
		return false;
	});


});
