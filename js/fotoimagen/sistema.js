$(document).ready(function() {

	

	    //Activar los slider que ya se han llenado (es)
		 var id_session = $('#session').val();
	     var id_tamano  = $('#id_diseno').val();
   		 var ano = $('#ano').val();
   		 var elimina_diseno =0;

	    
	    //var cambio ='no';
	    //var cambio_diseno =0;

	    var url = 'http://localhost/tinbox/calenda_activos';  //EN ESTE CASO APROVECHO EL CONTROLLER DE FOTOCALENDARIO
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
					  	jQuery('.editar_slider[value="'+valor.id_tamano+'"]').prop('disabled', false);	
				  });
			} 
		});



	//marcar el elemento activo
	jQuery('.editar_slider[value="'+($('#id_diseno').val())+'"]').parent().parent().css({"border-color": "red", 
	             								"border-weight":"8px", 	
	             								"border-style":"solid"});


	//editar un slider se encuentra en "Main.js"
	//jQuery('body').on('click','.editar_slider', function (e) {   


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
	              id_session:id_session,
	          },

			success: function(datos_completos){
				  
				  
				  $.each(datos_completos['cale_activo'], function (i, valor) { 

					  	if (valor.cantidad >=1) {
						  	
						  	jQuery('.previo_slider[value="'+valor.id_tamano+'"]').prop('disabled', false);	
						}  	

					  	
				  });

				  if (datos_completos['cale_activo'].length == datos_completos['total']) {
				  		 jQuery('#guardar').text('Revise y compre');	 
				  		 jQuery('#guardar').val('si');	 
				  		 jQuery('.compra_menu').prop('disabled', false);	
				  } else {
				  		 jQuery('#guardar').text('Continuar');	 
				  		 jQuery('#guardar').val('no');	 
				  		 jQuery('.compra_menu').prop('disabled', true);	
				  }

			} 
		});
		 




	//visualizar "revisa y compra"	
	jQuery('body').on('click','.previo_slider', function (e) {   

	   var id_session = $('#session').val();
	    var id_tamano = e.target.value;
	          var ano = $("#ano").val();

        var catalogo= 'http://localhost/tinbox/fotorevise/'+$.base64.encode(id_session);

        hrefPost('POST', catalogo, {
              id_tamano  : id_tamano,
                    ano  : ano,

        }, ''); 

        
	});	




	//"revisa y compra"	 a travez de "menu_compra"
	jQuery('body').on('click','.compra_menu', function (e) {   

	   var id_session = $('#session').val();
	    var id_tamano = $("#id_diseno").val(); 
	          var ano = $("#ano").val();

        var catalogo= 'http://localhost/tinbox/fotorevise/'+$.base64.encode(id_session);

        hrefPost('POST', catalogo, {
              id_tamano  : id_tamano,
                    ano  : ano,

        }, ''); 

        
	});	







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



	$("#drop-area").on('dragenter', function (e){
		e.preventDefault();
		$(this).css('background', '#BBD5B8');
	});

	$("#drop-area").on('dragover', function (e){
		e.preventDefault();
	});

	$("#drop-area").on('drop', function (e){
		$(this).css('background', '#D8F9D3');
		e.preventDefault();
		var image = e.originalEvent.dataTransfer.files;
		createFormData(image);
	});

	//1- cuando carga la pagina checar si hay imagenes
	
	buscarImagen();

});



function createFormData(image) {

	/*
	var anoActual = new Date();
	var dia = anoActual.getDay().toString();
	var mes = anoActual.getMonth().toString();
	var ano = anoActual.getFullYear().toString();

	var session = $('#session').val();
	*/

  var session = $('#session').val();
  var id_diseno = $('#id_diseno').val();
  var ano = $('#ano').val();
  var mes = $('#mes').val();


	var uid_original = id_diseno+'_'+ano+'_'+mes;
	


	var formImage = new FormData();

	//LIMPIAR PRIMERO EL COMPONENTE
	$('#cont_img').remove();
	formImage.append('userImage', image[0]);
	formImage.append('session', session);
	formImage.append('uid_original', uid_original);
	uploadFormData(formImage);
}

//2 ARRASTRA IMAGEN
function uploadFormData(formData) {
	$.ajax({
		url: "http://localhost/tinbox/upload",
		type: "POST",
		data: formData,
		contentType:false,
		cache: false,
		processData: false,
		success: function(data){
			//var daa = '<div id="cont_img"><img id_diseno="1" id="image" src="http://localhost/tinbox/uploads/BjDzaRqO5QnKIuSdmv/Orig_3_11_2015.png" style="max-width: 100%;" alt="Picture" class="cropper-hidden"></div>'+'<script src="http://localhost/tinbox/js/fotoimagen/main.js" type="text/javascript"></script>';
			//$('#drop-area').append(daa);
			$('#drop-area').append(data);
		}
	});
}


$('body').on('click','.mes', function (e) {

	
	//que no vuelva a cargar el mismo
    if ( ($('#mes').val())!=($(this).attr('nmes')) ) {
		   

    		var mes = $(this).attr('nmes');
					
				$('#mesclick').val(mes);	    			
    			

		   		$('#guardar').trigger('click');

    }
});	


//1
function buscarImagen() {
	  
	  var id_session = $('#session').val();
	  var id_diseno = $('#id_diseno').val();
	  		var ano = $('#ano').val();
	  		var mes = $('#mes').val();
	$.ajax({
		url: "http://localhost/tinbox/buscarimagen",
		type: "POST",
		data: {
			id_session: id_session,
			 id_diseno: id_diseno,
			 	   ano: ano,
			 	   mes: mes
		},
		dataType: 'json',
		success: function(data){
			//mostrar la imagen
			    //console.log(data);
				if (data.datos != []) {
					$.each((data.datos), function (i, valor) { //$.parseJSON
						//console.log(i+':'+valor);
						//$('#drop-area').append(i+':'+valor);
					});
					
				}
			//$('#drop-area').append(data.datos.recorte);	

			$('#drop-area').append(data.imagen);
			
		}
	});
}







