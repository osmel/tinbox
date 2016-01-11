$(document).ready(function() {

	//marcar el elemento activo
	jQuery('.editar_slider[value="'+($('#id_diseno').val())+'"]').parent().parent().css({"border-color": "red", 
	             								"border-weight":"8px", 	
	             								"border-style":"solid"});



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







