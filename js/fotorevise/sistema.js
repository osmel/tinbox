jQuery(document).ready(function($) {


	//Activar los slider que ya se han llenado (es)
		
	var id_session = $('#id_session').val();
    var id_tamano  = $('#id_tamano').val();
    var elimina_diseno = 0;


	////////////////////////////////////////////////////////////////////////////////
	////////////////////////COMIENZO DE LA ELIMINACION DE UN TAMAÑO ESPECIFICO//////
	////////////////////////////////////////////////////////////////////////////////

	/*
  ---	OK Eliminar:
		 
		 Parcial:
			 1- Son 3 y elimina 3: "regresa personaliza" y deshabilita "Agrega fotos"
			 2- Son 3 y elimina 2 o 1 : se queda ahi mismo

		 Total:
			 3- Son 3 y elimina 3: "regresa a 1-ELIGE TU DISEÑO Y TAMAÑO" 
			  Son 3 y elimina 2 o 1 : se queda ahi mismo
	
  

  --- Pasar de "Visualizar a " -> revisa y compra			
  --- Pasar de "Agrega tus fotos" -> revisa y compra			

  
  





  ---Queda subir imagen por boton, sin arrastrar

  ---Queda que se guarde la imagen del formulario

	*/



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

		    var url = 'http://localhost/tinbox/eliminar_diseno_revise'; 
				$.ajax({
				    url: url,
				    method: "POST",
			        dataType: 'json',
			          data: {
			              id_session:id_session,
			               id_tamano:elimina_diseno,
			          },

					success: function(datos_eliminados){
							  $.each(datos_eliminados, function (i, valor) { 
								  	console.log(valor);
							  });



							 if (datos_eliminados['total_disenos'] == datos_eliminados['total'] ) {

							 } 







							//se eliminaron todos los diseños  
							if (datos_eliminados['total_disenos'] == 0 ) {

								if ( datos_eliminados['total'] == 0) {
									//regresa diseño 
									var catalogo= 'http://localhost/tinbox/fcalendario';
									window.location.href = catalogo;	
								} else {
									//regresa al formulario
									jQuery(".personaliza_menu").trigger('click');  //provocar el evento q envia a personaliza al 1ro
								}
									
							} else {
								//solo elimina pero no se mueve
								jQuery('#accordion'+elimina_diseno).css({"display":"none"});
							}


							
							 if (datos_eliminados['total_disenos'] == datos_eliminados['total']) {
							  		 jQuery('#guardar').text('Agregar a Carrito');	 
							  		 jQuery('#guardar').val('si');	 
							  		 jQuery("#chequeo_dato").prop('disabled', true);	 
							  } else {
							  		 jQuery('#guardar').text('Continuar');	 
							  		 jQuery('#guardar').val('no');	 
							  		 jQuery("#chequeo_dato").prop('disabled', false);	 
							  }



							//quitar el formulario modal
							jQuery("#modaleliminar_tamano").modal("hide"); 

					} 
				});
	    	
	    });	



/*

		var agrega_carrito=e.target.value;

        if (agrega_carrito == 'si') { //si ya esta en "revisa y compra"

        }

*/

////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////final de la eliminacion/////////////////////
////////////////////////////////////////////////////////////////////////////////////////

    


	////////////////////////////////////////////////////////////////////////////////
	////////////////////////editar//////
	////////////////////////////////////////////////////////////////////////////////

	//edita un slider de un id_tamaño especifico
	jQuery('body').on('click','.editar_slider', function (e) {   

		  var id_session = $('#id_session').val();
		  var id_tamano = e.target.value;

            var catalogo= 'http://localhost/tinbox/fotocalendario/'+$.base64.encode(id_session);

            hrefPost('POST', catalogo, {
                  id_tamano_edicion : id_tamano,

            }, ''); 


	 	
	});	


	////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////Menu////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////
	


	//para pasar a "personaliza"
	jQuery('body').on('click','.personaliza_menu', function (e) {   
 		    var id_session = $('#id_session').val();

	        var catalogo= 'http://localhost/tinbox/fotocalendario/'+$.base64.encode(id_session);

	        hrefPost('POST', catalogo, {
	              //id_tamano_edicion : id_tamano, //no para q comience por el 1ro
	        }, ''); 

	});	


	//para pasar a "agrega tus fotos"
	jQuery('body').on('click','.agrega_menu', function (e) {   

		var id_session = $('#id_session').val();
		var ano = $('#ano').val();
     	var id_tamano = e.target.value;

		var $catalogo = 'http://localhost/tinbox/fotoimagen/'+jQuery.base64.encode(id_session);
					
		hrefPost('POST', $catalogo, {
	  				   'ano': ano,
						'mes':'0', 


	    }, ''); 	


	});	


	


/*

	//cuando toca un tab para ocultar el contenido
	jQuery('.miacordion').on('hidden.bs.collapse', function (e) {
	   //alert(e);
	})

	//cuando toca un tab para mostrar el contenido
	jQuery('.miacordion').on('shown.bs.collapse', function (e) {
	   //alert(e);
	})
*/








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