var result;


  var session = $('#session').val();
  var id_diseno = $('#id_diseno').val();
  var ano = $('#ano').val();
  var mes = $('#mes').val();
  var dia = $('#dia').val();

  
  var tipo_archivo= ($('#image').attr('tipo_archivo'));
  var nombre = ($('#image').attr('nombre'));
  
  var tipo = ($('#image').attr('tipo'));
  var ext = ($('#image').attr('ext'));
  var tamano = ($('#image').attr('tamano'));
  var ancho = ($('#image').attr('ancho'));
  var alto = ($('#image').attr('alto'));

  console.log($('#image').data('cropper'));
  alert('asdas');
     if ($('#image').data('cropper')) {

          alert('asdas');
            

            var datoimagen = $('#image').cropper('getImageData');
            var datocanvas = $('#image').cropper('getCanvasData');
            
            var result =  $('#image').cropper('getCroppedCanvas'); //
            var datos =  $('#image').cropper('getData');

            var datocropbox =  $('#image').cropper('getCropBoxData');

            var croppedImageDataURL = result.toDataURL(tipo_archivo); 
            var formData = new FormData();

            formData.append('datoimagen', JSON.stringify(datoimagen));
            formData.append('datocanvas', JSON.stringify(datocanvas));

            formData.append('croppedImage', croppedImageDataURL);//
            
            formData.append('datos', JSON.stringify(datos));
            formData.append('datocropbox', JSON.stringify(datocropbox));

            formData.append('session', session);

            formData.append('tipo_archivo', tipo_archivo);
            formData.append('nombre', nombre);
            formData.append('tipo', tipo);
            formData.append('ext', ext);
            formData.append('tamano', tamano);
            formData.append('ancho', ancho);
            formData.append('alto', alto);

            formData.append('ano', ano);
            formData.append('mes', mes);
            formData.append('dia', dia);

            formData.append('id_diseno', id_diseno);

            

            $.ajax('http://localhost/tinbox/guardar_imagen', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function(data){  
                console.log('Upload success');
              },
              error: function () {
                console.log('Upload error');
              }
            }); 
         
     }   