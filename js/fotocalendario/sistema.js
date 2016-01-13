jQuery(document).ready(function($) {


	//Activar los slider que ya se han llenado (es)
		
		var id_session = $('#id_session').val();
	    var id_tamano  = $('#movposicion').val();

	    
	    var cambio ='no';
	    var cambio_diseno =0;

	    var elimina_diseno =0;

	    var url = 'http://localhost/tinbox/calenda_activos'; 
		$.ajax({
		    url: url,
		    method: "POST",
	        dataType: 'json',
	          data: {
	              id_tamano:id_tamano,
	              id_session:id_session,
	              ano:ano
	          },

			success: function(datos_llenos){
				  $.each(datos_llenos, function (i, valor) { 
					  	//console.log(valor.id_tamano);
					  	jQuery('.editar_slider[value="'+valor.id_tamano+'"]').prop('disabled', false);	
				  });
			} 
		});
		 
		  


	//marcar el elemento activo
	jQuery('.editar_slider[value="'+$.miespacionombre.movposicion+'"]').parent().parent().css({"border-color": "red", 
	             								"border-weight":"8px", 	
	             								"border-style":"solid"});


	//editar un slider (editar un diseño). Cuando hay un cambio de diseño
	//var valor_slider=0;

	jQuery('body').on('click','.editar_slider', function (e) {   
		if (id_tamano!= e.target.value) {
			 	cambio ='si';
			 	cambio_diseno=e.target.value;
			 	jQuery("#form_validar_fotocalendario").trigger('submit');  //provocar el evento q valida todo

		}
	});	



	//Desactivar "Eliminar" del elemento activo
	jQuery('.eliminar_slider[value="'+id_tamano+'"]').prop('disabled', true);	



	////////////////////////////////////////////////////////////////////////////////
	////////////////////////COMIENZO DE LA ELIMINACION DE UN TAMAÑO ESPECIFICO//////
	////////////////////////////////////////////////////////////////////////////////

	//eliminar un id_tamaño especifico
	jQuery('body').on('click','.eliminar_slider', function (e) {   
		elimina_diseno = e.target.value;
		jQuery("#modaleliminar_tamano").modal("show"); 
	 	
	});	


       //Cuando cancela la "ELIMINACION DE UN TAMAÑO"
		jQuery('#modaleliminar_tamano').on('hide.bs.modal', function(e) {
			jQuery('#foo1').css('display','none');
			jQuery('#messages1').css('display','none');
		    jQuery(this).removeData('bs.modal');
		});	



	    jQuery('body').on('click','#eliminar_diseno', function (e) {
	    	

		    var url = 'http://localhost/tinbox/eliminar_diseno_completo'; 
				$.ajax({
				    url: url,
				    method: "POST",
			        dataType: 'json',
			          data: {
			              id_session:id_session,
			              id_tamano:elimina_diseno,
			              //ano:ano
			          },

					success: function(datos_eliminados){
							  $.each(datos_eliminados, function (i, valor) { 
								  	console.log(valor);
							  });

							jQuery('.editar_slider[value="'+elimina_diseno+'"]').parent().parent().css({	
			             								"display":"none"});
							jQuery("#modaleliminar_tamano").modal("hide"); 

					} 
				});



	    	
	    });	



////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////final de la eliminacion/////////////////////
////////////////////////////////////////////////////////////////////////////////////////


	  //Activar las visualizaciones que ya se han llenado (es decir q ya tienen las 12imagenes por diseños)
		

	    var url = 'http://localhost/tinbox/disenos_completos'; 
		$.ajax({
		    url: url,
		    method: "POST",
	        dataType: 'json',
	          data: {
	              //id_tamano:id_tamano,
	              id_session:id_session,
	              //ano:ano
	          },

			success: function(datos_completos){
				  
				  $.each(datos_completos['cale_activo'], function (i, valor) { 
					  	if (valor.cantidad >=1) {
						  	jQuery('.previo_slider[value="'+valor.id_tamano+'"]').prop('disabled', false);	
						}  	
				  });

				  if (datos_completos['cale_activo'].length == datos_completos['total']) {
				  		 
				  		 jQuery('.compra_menu').prop('disabled', false);	
				  } else {
				  		 
				  		 jQuery('.compra_menu').prop('disabled', true);	
				  }


			} 
		});
		 



	//visualizar "revisa y compra"	
	jQuery('body').on('click','.previo_slider', function (e) {   


	   var id_session = $('#id_session').val();
	   var id_tamano = e.target.value;
	   var ano = $("#almanaque").attr('anomostrado');

        var catalogo= 'http://localhost/tinbox/fotorevise/'+$.base64.encode(id_session);

        hrefPost('POST', catalogo, {
              id_tamano  : id_tamano,
                    ano  : ano,

        }, ''); 

        
	});	





	//Menú
	//para pasar a "agrega tus fotos"
	jQuery('body').on('click','.agrega_menu', function (e) {   
			 	cambio ='a_menu';
			 	cambio_diseno=id_tamano;
			 	jQuery("#form_validar_fotocalendario").trigger('submit');  //provocar el evento q valida todo
	});	



	//"revisa y compra"	 a travez de "menu_compra"
	jQuery('body').on('click','.compra_menu', function (e) {   

	   var id_session = $('#id_session').val();
	    var id_tamano = $("#movposicion").val(); 
	          var ano = $("#almanaque").attr('anomostrado');

        var catalogo= 'http://localhost/tinbox/fotorevise/'+$.base64.encode(id_session);

        hrefPost('POST', catalogo, {
              id_tamano  : id_tamano,
                    ano  : ano,

        }, ''); 

        
	});	





	$.miespacionombre.posicionDiseno
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

		jQuery(".navigacion").change(function()	{
		    document.location.href = jQuery(this).val();
		});


		var target = document.getElementById('foo');



		//actualizar los dias de cumpleano, en funcion del año actual señalado
		jQuery("#id_mes").on('change', function(e) {
			anoactual=$("#almanaque").attr('anomostrado');
			mesactual=$(this).val();
		    var cantDiasMesMostrado1 = 32 - new Date(anoactual, mesactual-1, 32).getDate();
		    jQuery("#id_dia").html(''); 
		    for (i = 1; i <= cantDiasMesMostrado1; i++) { 
	 			   jQuery("#id_dia").append('<option value="'+i+'" >'+i+'</option>');
			}
		});		

///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Boton continuar para validar el formulario///////////////////
///////////////////////////////////////////////Modales con Lista y sin Lista///////////////////
///////////////////////////////////////////////////////////////////////////////////////////////			

		function nombreMes() {
		
				llave =	$("#almanaque").attr('anomostrado')+'_'+$("#almanaque").attr('mesamostrarmenos1');
				ano= $("#almanaque").attr('anomostrado');
				mes= $("#almanaque").attr('mesamostrarmenos1');

				valor = $('#texto_mes').val();
				if ((valor.trim())!='') {
					$.miespacionombre.nombre_mes[llave] = { "valor" : valor, "ano" : ano, "mes":mes }; //valor;
				}	


	    }


	    //form_validar_fotocalendario

		jQuery('body').on('submit','#form_validar_fotocalendario', function (e) {

			//asignar el mes activo, para que entre en el array
			nombreMes();		

			jQuery('#foo').css('display','block');

			var spinner = new Spinner(opts).spin(target);
			jQuery(this).ajaxSubmit({

	      		data: {
	      			 listadias:$.miespacionombre.listaDias,
	      			 nombre_mes:$.miespacionombre.nombre_mes
	      		 },
	      		
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


	  						
	  							$catalogo = e.target.name;
								spinner.stop();
								jQuery('#foo').css('display','none');

	      			 			if ( (Object.keys($.miespacionombre.listaDias).length===0) && (Object.keys($.miespacionombre.nombre_mes).length===0) ) {
	      			 				//mostrar la ventana sinLista
	      			 				
	      			 				jQuery("#modalsinLista").modal("show"); //guardar sin lista

	      			 			} else {
	      			 				//mostrar la ventana conLista

	      			 				jQuery("#modalPregunta").modal("show",{valor:10});	 //guardar con lista
	      			 			}
	      			 			

	      			 			
								
					}
				} 
			});
			return false;
		});	
		
		//Cuando cancela en la modal que "Tiene lista"
		jQuery('#modalPregunta').on('hide.bs.modal', function(e) {
			jQuery('#foo1').css('display','none');
			jQuery('#messages1').css('display','none');
		    jQuery(this).removeData('bs.modal');
		});	


		
		//Cuando cancela en la modal que "NO Tiene lista"
		jQuery('#modalsinLista').on('hide.bs.modal', function(e) {
			jQuery('#foo1').css('display','none');
			jQuery('#messages1').css('display','none');
		    jQuery(this).removeData('bs.modal');
		});		



		/*
		por defecto dice que cuando comience el formulario se va a guardar la lista
		pero hay 3 estado 
			Guardar
			   1-guardar  :
			   2-noguardar: "No me interesa, deseo continuar"
			SinGuardar
			   3-noguardar: por defecto

		*/
		var guardar = 'guardar';
	    jQuery('body').on('click','#deleteUserSubmit', function (e) {
	    	guardar= e.target.name;
	    });	





		jQuery('body').on('submit','#form_guardar_lista', function (e) {

				//evitar q se ejecute el submit
		 	event.preventDefault();

			jQuery('#foo').css('display','block');

			var spinner = new Spinner(opts).spin(target);

			//asignar el mes activo, para que entre en el array
			nombreMes();		

			//para tomar la lista de checkBox
			var listCheck = [];
			jQuery("input[name='coleccion_id_logo[]']:checked").each(function() {
			     listCheck.push(jQuery(this).val());
			});		

					
				//este es el formulario de la session 3
				var datoFormulario = new FormData(document.getElementById("form_validar_fotocalendario"));

				//el arreglo de día y meses
				datoFormulario.append('listadias', JSON.stringify($.miespacionombre.listaDias));
				datoFormulario.append('nombre_mes', JSON.stringify($.miespacionombre.nombre_mes));

				//los datos "del formulario modal"
				datoFormulario.append('nombre_lista', jQuery('#nombre_lista').val());
				datoFormulario.append('correo_lista', jQuery('#correo_lista').val());

				//el valor de la session q esta en uso
				
				/*	
				if 	($.miespacionombre.id_session=='') {
					$.miespacionombre.id_session = randomString(20); 
				}
				datoFormulario.append('id_session', $.miespacionombre.id_session);
				*/

				datoFormulario.append('id_session', jQuery('#id_session').val());

	  			//datoFormulario.append('cantDiseno_original', $.miespacionombre.cantDiseno_original);
				//datoFormulario.append('cantDiseno', $.miespacionombre.cantDiseno);
				//datoFormulario.append('movposicion',$.miespacionombre.movposicion);

				datoFormulario.append('id_tamano',jQuery('#movposicion').val());
			

				//estatus para guardar o no guardar lista
				datoFormulario.append('guardar', guardar);
				

				datoFormulario.append('coleccion_id_logo', listCheck);

				//este es el email activo	
				//email_lista = $.miespacionombre.correo_activo;
				email_lista = jQuery('#correo_activo').val();

				if (guardar=="guardar") {
						url='http://localhost/tinbox/guardar_lista';
						//email_lista = jQuery('#correo_lista').val();
				} else {
						url='http://localhost/tinbox/noguardar_lista';
				} 

				 //alert(url);
				$.ajax({
				    url: url,
				    type: 'POST',
				    data:  datoFormulario,
				    		
				    async: false,
				    cache: false,
				    contentType: false,
				    processData: false,

					success: function(datos){
						if(datos != true){
							
							spinner.stop();
							jQuery('#foo1').css('display','none');
							jQuery('#messages1').css('display','block');
							jQuery('#messages1').addClass('alert-danger');
							jQuery('#messages1').html(datos);
							jQuery('html,body').animate({
								'scrollTop': jQuery('#messages1').offset().top
							}, 1000);
						
							
						}else{
							




							
		  							$catalogo = e.target.name;
									spinner.stop();
									jQuery('#foo1').css('display','none');

									if (cambio=='si') {		 //toca editar de un tamaño especifico
											  cambio='no';
											  var id_session = $('#id_session').val();
											  var id_tamano = cambio_diseno; //  e.target.value;

									            var catalogo= 'http://localhost/tinbox/fotocalendario/'+$.base64.encode(id_session);

									            hrefPost('POST', catalogo, {
									                  id_tamano_edicion : id_tamano,

									            }, ''); 

									} else if (cambio=='a_menu') {  //toca menu de agregar fotos
										cambio='no';

											var $catalogo = 'http://localhost/tinbox/fotoimagen/'+jQuery.base64.encode(jQuery('#id_session').val());
														
														hrefPost('POST', $catalogo, {
															      'id_tamano':jQuery('#movposicion').val(),
												      				   'ano': jQuery("#almanaque").attr('anomostrado'),
																		'mes':'0' //para q comience en el mes de enero


													    }, ''); 	



									} else {

											var $catalogo = 'http://localhost/tinbox/fotoimagen/'+jQuery.base64.encode(jQuery('#id_session').val());
														
														hrefPost('POST', $catalogo, {
															      'id_tamano':jQuery('#movposicion').val(),
												      				   'ano': jQuery("#almanaque").attr('anomostrado'),
																		'mes':'0' //para q comience en el mes de enero


													    }, ''); 	

									}

						}
					} 

				  });
				 
				  return false;
				});
						









///////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////Fin del Boton continuar para validar el formulario///////////////////
///////////////////////////////////////////////////////////////////////////////////////////////			


	


	    	    	



		function randomString(len, an){
		    an = an&&an.toLowerCase();
		    var str="", i=0, min=an=="a"?10:0, max=an=="n"?10:62;
		    for(;i++<len;){
		      var r = Math.random()*(max-min)+min <<0;
		      str += String.fromCharCode(r+=r>9?r<36?55:61:48);
		    }
		    return str;
		}



						

		hrefPost = function(verb, url, data, target) {
		  var form = document.createElement("form");
		  form.action = url;
		  form.method = verb;
		  form.target = target || "_self";
		  if (data) {
		    for (var key in data) {
		      var input = document.createElement("textarea");
		      input.name = key;
		      input.value = typeof data[key] === "object" ? JSON.stringify(data[key]) : data[key];
		      form.appendChild(input);
		    }
		  }
		  form.style.display = 'none';
		  document.body.appendChild(form);
		  form.submit();
		};


});