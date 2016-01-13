$(function () {

  'use strict';

  var console     = window.console || { log: function () {} };
  var $image      = $('#image');
  var $download   = $('#download');
  var $dataX      = $('#dataX');
  var $dataY      = $('#dataY');
  var $dataHeight = $('#dataHeight');
  var $dataWidth  = $('#dataWidth');
  var $dataRotate = $('#dataRotate');
  var $dataScaleX = $('#dataScaleX');
  var $dataScaleY = $('#dataScaleY');
  
  var options = {
 

        //Estableciendo la relación de aspecto
        aspectRatio: 1 / 1,
        //viewMode: 3,

        //deshabilita para recortar la imagen de forma automática cuando initialize.
        autoCropArea: 1,
        //restore: false,
        
        //Mostrar el modal negro sobre la imagen y en el cuadro de recorte.
        modal: false,
        //Mostrar las líneas de puntos(dashed ) por encima del cuadro de recorte.
        guides: false,

        //Mostrar el modal blanco sobre el cuadro de recorte (resaltando el cuadro de recorte).
        highlight: false,



        preview: '.img-preview',
        dragCrop: false,
        mouseWheelZoom: true,
        resizable: true,

        //comenzar con el estado de mover (manito)
        dragMode: 'move',
        //Deshabilitar el cambio entre el modo "crop" y "move"  al hacer dobleClick
        toggleDragModeOnDblclick:false,

        //Desabilitar las acciones de mover y cambiar tamaño en cuadro de recorte.
        cropBoxMovable:false,
        cropBoxResizable:false,


        //minimo en que se puede poner el contenedor        
        minContainerHeight:500,
        minContainerWidth:500,

        //minimo en que se puede poner el cropper
        minCropBoxWidth: 500,
        minCropBoxHeight: 500,

        //minimo en que puede achicar la imagen(Canvas)
        minCanvasHeight:100, //minimo Alto de la imagen 
        minCanvasWidth:100,  //minimo Ancho de la imagen



      crop: function (e) {
          $dataX.val(Math.round(e.x));
          $dataY.val(Math.round(e.y));
          $dataHeight.val(Math.round(e.height));
          $dataWidth.val(Math.round(e.width));
          $dataRotate.val(e.rotate);
          $dataScaleX.val(e.scaleX);
          $dataScaleY.val(e.scaleY);
      },

      built:function(){

            //var naturalWidth = NaN;
            //var naturalWidth = ($('#image').attr('naturalWidth'));
            //if (naturalWidth !== undefined) {

            var naturalWidth = parseFloat($('#image').attr('naturalWidth'));
            if (naturalWidth !== NaN) {

               //alert(naturalWidth);
                
                  var naturalWidth = parseFloat($('#image').attr('naturalWidth'));               

                 var naturalHeight = parseFloat($('#image').attr('naturalHeight'));
                        //alert('aa');
                        var rotate = ($('#image').attr('rotate'));

                        console.log(rotate);

                        var scaleX = parseInt($('#image').attr('scalex'));
                        var scaleY = parseInt($('#image').attr('scaley'));
                         var ratio = parseInt($('#image').attr('ratio'));

                     var   dx      = parseFloat($('#image').attr('dx'));
                     var   dy      = parseFloat($('#image').attr('dy'));
                     var   dwidth  = parseFloat($('#image').attr('dwidth'));
                     var   dheight = parseFloat($('#image').attr('dheight'));
                     var   dscaleX = parseFloat($('#image').attr('dscaleX'));
                     var   dscaleY = parseFloat($('#image').attr('dscaleY'));
                     var   drotate = parseFloat($('#image').attr('drotate'));

                     var     bleft = parseFloat($('#image').attr('bleft'));
                     var      btop = parseFloat($('#image').attr('btop'));
                     var    bwidth = parseFloat($('#image').attr('bwidth'));
                     var   bheight = parseFloat($('#image').attr('bheight'));


                        var cwidth = parseFloat($('#image').attr('cwidth'));
                       var cheight = parseFloat($('#image').attr('cheight'));
                         var cleft = parseFloat($('#image').attr('cleft'));
                          var ctop = parseFloat($('#image').attr('ctop'));


                    
                      $('#image').cropper('setCanvasData',{
                                   width: cwidth,
                                  height: cheight,
                                    left: cleft,
                                     top: ctop,
                            naturalWidth: naturalWidth,
                           naturalHeight: naturalHeight
                      });

                      $('#image').cropper('rotate',rotate);
                      
                      $('#image').cropper('scaleX', scaleX);
                      $('#image').cropper('scaleY', scaleY);
                      
                     //$('#image').cropper('scale', scaleX,scaleY);
                     $('#image').cropper('setAspectRatio', ratio);

                

            }
     /*               
               $('#image').cropper('setCanvasData',{
                           width: cwidth,
                          height: cheight,
                            left: cleft,
                             top: ctop,
                    //naturalWidth: naturalWidth,
                   //naturalHeight: naturalHeight
                });
 
               $('#image').cropper('setCropBoxData',{
                               left: bleft,
                                top: btop,
                              width: bwidth,
                             height: bheight,
               });

                $('#image').cropper('setData',{
                       x  : dx,
                       y  : dy,
                     width: dwidth,
                    height: dheight,
                    scaleX: dscaleX,
                    scaleY: dscaleY,
                    rotate: drotate,
                });

                //$('#image').cropper('rotate',rotate);
                
                //$('#image').cropper('scale', scaleX,scaleY);

                
                $('#image').cropper('setAspectRatio', ratio);               
                $('#image').cropper('scaleX', scaleX);
                $('#image').cropper('scaleY', scaleY);
*/
            }        
      };


function guardar3() {
  var result;
   

          var session = $('#session').val();
        var id_diseno = $('#id_diseno').val();
              var ano = $('#ano').val();
              var mes = $('#mes').val();

              //alert('id_diseno: '+id_diseno);
              //alert('mes: '+ mes);
              
    var tipo_archivo  = ($('#image').attr('tipo_archivo'));
           var nombre = ($('#image').attr('nombre'));
          
             var tipo = ($('#image').attr('tipo'));
              var ext = ($('#image').attr('ext'));
           var tamano = ($('#image').attr('tamano'));
            var ancho = ($('#image').attr('ancho'));
             var alto = ($('#image').attr('alto'));
        
    if ($image.data('cropper')) {


          //alert('asdas');

              var datoimagen = $image.cropper('getImageData');
              var datocanvas = $image.cropper('getCanvasData');
              
                  var result =  $image.cropper('getCroppedCanvas'); //
                   var datos =  $image.cropper('getData');

             var datocropbox =  $image.cropper('getCropBoxData');

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
            //formData.append('dia', dia);

            formData.append('id_diseno', id_diseno);

            //guardar imagen      
            $.ajax('http://localhost/tinbox/guardar_imagen', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function(data) {  
               

                      
                    $('#cont_img').remove();

                    var mes = $('#mesclick').val();

            
                    $('#id_diseno').val(id_diseno); //dat_diseno //val(dat_diseno); //dat_diseno

                    //cargar nuevamente fotoimagen/index
                    var catalogo = 'http://localhost/tinbox/fotoimagen/'+$.base64.encode(session);



                    hrefPost('POST', catalogo, {
                          id_tamano : $('#id_diseno').val(),
                          ano : ano,
                          mes : mes,
                          imagen:'si',

                    }, '');                             

                           


              },
              error: function () {
                console.log('Upload error');
              }
            }); 
     } 


}




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

  $(".navigacion").change(function() {
      document.location.href = $(this).val();
  });



  var target = document.getElementById('foo');


function guardar2() {
  var result;


  var session = $('#session').val();
  var id_diseno = $('#id_diseno').val();
  var ano = $('#ano').val();
  var mes = $('#mes').val();

  
  var tipo_archivo= ($('#image').attr('tipo_archivo'));
  var nombre = ($('#image').attr('nombre'));
  
  var tipo = ($('#image').attr('tipo'));
  var ext = ($('#image').attr('ext'));
  var tamano = ($('#image').attr('tamano'));
  var ancho = ($('#image').attr('ancho'));
  var alto = ($('#image').attr('alto'));

  
     if ($image.data('cropper')) {

          //alert('asdas');
            

            var datoimagen = $image.cropper('getImageData');
            var datocanvas = $image.cropper('getCanvasData');
            
            var result =  $image.cropper('getCroppedCanvas'); //
            var datos =  $image.cropper('getData');

            var datocropbox =  $image.cropper('getCropBoxData');

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
            //formData.append('dia', dia);

            formData.append('id_diseno', id_diseno);

            //console.log(formData);  

            $.ajax('http://localhost/tinbox/guardar_imagen', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function(data) {  

                   $('#foo').css('display','block');
                    var spinner = new Spinner(opts).spin(target);

                    $.ajax({
                          url: 'http://localhost/tinbox/revisar_imagenes',
                          method: "POST",
                          dataType: 'json',
                          data: {
                              id_diseno:id_diseno,
                              id_session:session,
                              ano:ano

                          },
                          success: function(cant_imagen) { 
                            if (cant_imagen <=1) {

                              spinner.stop();
                              $('#foo').css('display','none');
                              $('#messages').css('display','block');
                              $('#messages').addClass('alert-danger');
                              $('#messages').html(cant_imagen);
                              $('html,body').animate({
                                'scrollTop': $('#messages').offset().top
                              }, 1000);
                            

                            }else{


                                var catalogo= 'http://localhost/tinbox/fotocalendario/'+$.base64.encode(session);
                                spinner.stop();
                                $('#foo').css('display','none');

                                hrefPost('POST', catalogo, {
                                      id_tamano : id_diseno,

                                }, ''); 



                            }







                          },
                      error: function () {
                          console.log('Upload error');
                        }
                    }); 


              },
              error: function () {
                console.log('Upload error');
              }
            }); 
         
     }   

}


$('body').on('click', '#guardar', function (e) {
     
     

      var session = $('#session').val();
      var id_diseno  = $('#id_diseno').val();

      var ano = $('#ano').val();
      var mes = $('#mes').val();

      //console.log(ano);
      //console.log(mes);

      var existe = ($('#image').attr('nombre'));  



    //si fue una presion real de boton 
    if (!(e.isTrigger)) { 

        
        var revisa_compra=e.target.value;

        if (revisa_compra == 'si') { //si ya esta en "revisa y compra"
           
            
              var id_session = $('#session').val();
              var id_tamano = $("#id_diseno").val(); 
                    var ano = $("#ano").val();

                var catalogo= 'http://localhost/tinbox/fotorevise/'+$.base64.encode(id_session);

                hrefPost('POST', catalogo, {
                      id_tamano  : id_tamano,
                            ano  : ano,

                }, ''); 


                       ;
        } else {  ////si todavia esta en "continuar" 

            if ( existe != undefined) { //si hay imagen para guardar donde estoy posicionado
                guardar2();
            }  else { //sino hay imagenes para guardar donde estoy posicionado

                        $('#foo').css('display','block');
                        var spinner = new Spinner(opts).spin(target);

                        $.ajax({
                              url: 'http://localhost/tinbox/revisar_imagenes',
                              method: "POST",
                              dataType: 'json',
                              data: {
                                  id_diseno:id_diseno,
                                  id_session:session,
                                  ano:ano

                              },
                              success: function(cant_imagen) { 
                                if (cant_imagen <=1) {

                                  spinner.stop();
                                  $('#foo').css('display','none');
                                  $('#messages').css('display','block');
                                  $('#messages').addClass('alert-danger');
                                  $('#messages').html(cant_imagen);
                                  $('html,body').animate({
                                    'scrollTop': $('#messages').offset().top
                                  }, 1000);
                                

                                }else{

                                    var catalogo= 'http://localhost/tinbox/fotocalendario/'+$.base64.encode(session);
                                    spinner.stop();
                                    $('#foo').css('display','none');

                                    hrefPost('POST', catalogo, {
                                          id_tamano : id_diseno,

                                    }, ''); 



                                }







                              },
                          error: function () {
                              console.log('Upload error');
                            }
                        }); 


            }  


       }      













    } else {  //si fue invocado a la fuerza el trigger "para cambiar de mes"
      
        if ( existe != undefined) { //si hay imagen para guardar
                  guardar3();

        } else { //no hay imagen para guardar
                     
                    $('#cont_img').remove();

                    var mes = $('#mesclick').val();
            
                    $('#id_diseno').val(id_diseno); //dat_diseno //val(dat_diseno); //dat_diseno

                    //cargar nuevamente fotoimagen/index
                    var catalogo = 'http://localhost/tinbox/fotoimagen/'+$.base64.encode(session);


                    hrefPost('POST', catalogo, {
                          id_tamano : $('#id_diseno').val(),
                          ano : ano,
                          mes : mes,
                          imagen:'si',

                    }, '');                             

        }


    }


});









 //para guardar la imagen cuando se regresa a una "edicion de diseño"
function guardar4(id_tamano) {
  var result;

  var session = $('#session').val();
  var id_diseno = $('#id_diseno').val();
  var ano = $('#ano').val();
  var mes = $('#mes').val();

  
  var tipo_archivo= ($('#image').attr('tipo_archivo'));
  var nombre = ($('#image').attr('nombre'));
  
  var tipo = ($('#image').attr('tipo'));
  var ext = ($('#image').attr('ext'));
  var tamano = ($('#image').attr('tamano'));
  var ancho = ($('#image').attr('ancho'));
  var alto = ($('#image').attr('alto'));

  
     if ($image.data('cropper')) {

          //alert('asdas');
            

            var datoimagen = $image.cropper('getImageData');
            var datocanvas = $image.cropper('getCanvasData');
            
            var result =  $image.cropper('getCroppedCanvas'); //
            var datos =  $image.cropper('getData');

            var datocropbox =  $image.cropper('getCropBoxData');

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
            //formData.append('dia', dia);

            formData.append('id_diseno', id_diseno);

            $.ajax('http://localhost/tinbox/guardar_imagen', {
              method: "POST",
              data: formData,
              processData: false,
              contentType: false,
              success: function(data) {  

                    $('#foo').css('display','block');
                    var spinner = new Spinner(opts).spin(target);

                    var catalogo = 'http://localhost/tinbox/fotocalendario/'+$.base64.encode(session);
                               spinner.stop();
                               $('#foo').css('display','none');


                                hrefPost('POST', catalogo, {
                                      id_tamano_edicion : id_tamano,

                    }, ''); 


              },
              error: function () {
                console.log('Upload error');
              }
            }); 
         
     }   

}



//cuando editamos un diseño en las fotoImagen. Hay q evaluar si existe imagen
//Este boton realmente no existe

jQuery('body').on('click','.editar_slider', function (e) {   

    //Este trigger fue invocado a la fuerza "para cambiar de mes"
        
        var session = $('#session').val();
        var existe = ($('#image').attr('nombre'));  

        if ( existe != undefined) { //si hay imagen para guardar
                  guardar4(e.target.value);

        } else { //no hay imagen para guardar

                    var catalogo= 'http://localhost/tinbox/fotocalendario/'+$.base64.encode(session);
                    hrefPost('POST', catalogo, {
                          id_tamano_edicion : e.target.value,

                    }, ''); 


        }


});


//Menú
    //para pasar a "personaliza"
  jQuery('body').on('click','.personaliza_menu', function (e) {   

        var session = $('#session').val();
        var existe = ($('#image').attr('nombre'));  
        var id_tamano = $('#id_diseno').val();

        if ( existe != undefined) { //si hay imagen para guardar
                  guardar4(id_tamano);

        } else { //no hay imagen para guardar

                    var catalogo= 'http://localhost/tinbox/fotocalendario/'+$.base64.encode(session);
                    hrefPost('POST', catalogo, {
                          id_tamano_edicion : id_tamano,

                    }, ''); 


        }



  }); 



   var  hrefPost = function(verb, url, data, target) {
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



function buscarImagen1() {
    
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



       




  // Tooltip
  $('[data-toggle="tooltip"]').tooltip();


  // Cropper

  $image.on({
    
    //"build" Es llamada cuando una instancia cropper comienza a cargar una imagen.
    'build.cropper': function (e) {
      console.log(e.type);
    },

    //"built" Es llamada cuando una instancia cropper se ha construido completamente.
    'built.cropper': function (e) {
      console.log(e.type);
    },
    
    
    //"cropstart" Es llamada cuando el "canvas" o el "cuadro de recorte" comienza(start) a cambiar.
    'cropstart.cropper': function (e) {
      console.log(e.type, e.action);
    },

    
    
    //"cropmove" Es llamada cuando el "canvas" o el "cuadro de recorte" esta cambiando
    'cropmove.cropper': function (e) {
      console.log(e.type, e.action);
    },

    //"cropend" Es llamada cuando el "canvas" o el "cuadro de recorte" deja(stop) de cambiar.
    'cropend.cropper': function (e) {
      console.log(e.type, e.action);
    },

    //"crop". Se llama cuando el "canvas" o el "cuadro de recorte" cambiaron.
    'crop.cropper': function (e) { //constantemente mientras se mueva
      console.log(e.type, e.x, e.y, e.width, e.height, e.rotate, e.scaleX, e.scaleY);
    },

    //"zoom" Se llama cuando una instancia cropper comienza a acercar o alejar(zoom) la imagen de su canvas
    'zoom.cropper': function (e) { //zoom + o -
      console.log(e.type, e.ratio);
    }
    
  }).cropper(options);




  // Buttons
  
  if (!$.isFunction(document.createElement('canvas').getContext)) {
    $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
  }

  if (typeof document.createElement('cropper').style.transition === 'undefined') {
    $('button[data-method="rotate"]').prop('disabled', true);
    $('button[data-method="scale"]').prop('disabled', true);
  }
  


  // Download
  /*
  if (typeof $download[0].download === 'undefined') {
    //alert('1');
    $download.addClass('disabled');
  }
  */


  // Options  // todos los botones que estan al lado derecho "desde 16:9 - toggle options"
  /*
  $('.docs-toggles').on('change', 'input', function () {
    var $this = $(this);
    var name = $this.attr('name');
    var type = $this.prop('type');
    var cropBoxData;
    var canvasData;

    if (!$image.data('cropper')) {
      return;
    }

    if (type === 'checkbox') {
      options[name] = $this.prop('checked');
      cropBoxData = $image.cropper('getCropBoxData');
      canvasData = $image.cropper('getCanvasData');

      options.built = function () {
        $image.cropper('setCropBoxData', cropBoxData);
        $image.cropper('setCanvasData', canvasData);
      };
    } else if (type === 'radio') {
      options[name] = $this.val();
    }

    $image.cropper('destroy').cropper(options);
  });
*/

//http://www.scriptscoop.net/t/60e754985ac3/javascript-canvas-toblob-fails-when-a-patterned-fill-is-used.html
/*
if( !HTMLCanvasElement.prototype.toBlob ) {
    Object.defineProperty( HTMLCanvasElement.prototype, 'toBlob', { 
        value: function( callback, type, quality ) {
            const bin = atob( this.toDataURL( type, quality ).split(',')[1] ),
                  len = bin.length,
                  len32 = len >> 2,
                  a8 = new Uint8Array( len ),
                  a32 = new Uint32Array( a8.buffer, 0, len32 );

            for( var i=0, j=0; i < len32; i++ ) {
                a32[i] = bin.charCodeAt(j++)  |
                    bin.charCodeAt(j++) << 8  |
                    bin.charCodeAt(j++) << 16 |
                    bin.charCodeAt(j++) << 24;
            }

            let tailLength = len & 3;

            while( tailLength-- ) {
                a8[ j ] = bin.charCodeAt(j++);
            }

            callback( new Blob( [a8], {'type': type || 'image/png'} ) );
        }
    });
}
*/

//https://developer.mozilla.org/es/docs/Web/API/HTMLCanvasElement/toBlob (PolyfillEDIT)
if (!HTMLCanvasElement.prototype.toBlob) {
 Object.defineProperty(HTMLCanvasElement.prototype, 'toBlob', {
  value: function (callback, type, quality) {

    var binStr = atob( this.toDataURL(type, quality).split(',')[1] ),
        len = binStr.length,
        arr = new Uint8Array(len);

    for (var i=0; i<len; i++ ) {
     arr[i] = binStr.charCodeAt(i);
    }

    callback( new Blob( [arr], {type: type || 'image/png'} ) );
  }
 });
}







  // Methods //click encima de cualquier boton que esta debajo de la imagen
  $('.docs-buttons').on('click', '[data-method]', function () {
    var $this = $(this);
    var data = $this.data();
    var $target;
    var result;


    if ($this.prop('disabled') || $this.hasClass('disabled')) {
      return;
    }

    if ($image.data('cropper') && data.method) {
      data = $.extend({}, data); // Clone a new one

      if (typeof data.target !== 'undefined') {
        $target = $(data.target);

        if (typeof data.option === 'undefined') {
          try {
            data.option = JSON.parse($target.val());
          } catch (e) {
            console.log(e.message);
          }
        }
      }

      result = $image.cropper(data.method, data.option, data.secondOption);



      switch (data.method) {
     
        
        case 'scaleX':
        case 'scaleY':
          $(this).data('option', -data.option);
          break;
        
        case 'getCroppedCanvas':
          if (result) {

            // Bootstrap's Modal
            //$('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

            //console.log($image.cropper("getCanvasData"));

            $image.attr('href', result.toDataURL() );

            if (!$download.hasClass('disabled')) {
              //alert(result.toDataURL());
              //http://www.$script.net/demo/$-In-Place-Image-Cropping-Plugin-cropbox/
              //console.log($image.getImageData());
              //var canvasData;
              //canvasData = $image.cropper('getCanvasData');
              //console.log(canvasData);

              //https://fengyuanchen.github.io/cropper/v0.7.9/
              
              //$download.attr('href', result.toDataURL());

              //http://jsfiddle.net/PAEz/XfDUS/
            }
          }

          break;
      }

      if ($.isPlainObject(result) && $target) {
        try {
          $target.val(JSON.stringify(result));
        } catch (e) {
          console.log(e.message);
        }
      }

    }
  });



  // Keyboard   //cuando muevo con las teclas 
  $(document.body).on('keydown', function (e) {
    
    //console.log($image.cropper("getImageData"));
    //console.log($('#image').cropper("getImageData"));

    //console.log($image.cropper("getCanvasData"));
    


//$image.cropper('getCroppedCanvas')

/*
$image.cropper('getCroppedCanvas');

$image.cropper('getCroppedCanvas', {
  width: 160,
  height: 90
});
*/



    
    return;

    if (!$image.data('cropper') || this.scrollTop > 300) {
      return;
    }

    switch (e.which) {
      case 37:
        e.preventDefault();
        $image.cropper('move', -1, 0);
        break;

      case 38:
        e.preventDefault();
        $image.cropper('move', 0, -1);
        break;



      case 39:
        e.preventDefault();
        $image.cropper('move', 1, 0);
        break;

      case 40:
        e.preventDefault();
        $image.cropper('move', 0, 1);
        break;
    }

  });


  // Import image
  var $inputImage = $('#inputImage');
  var URL = window.URL || window.webkitURL;
  var blobURL;

  if (URL) {
    $inputImage.change(function () {
      var files = this.files;
      var file;

      if (!$image.data('cropper')) {
        return;
      }

      if (files && files.length) {
        file = files[0];

        if (/^image\/\w+$/.test(file.type)) {
          blobURL = URL.createObjectURL(file);
          $image.one('built.cropper', function () {

            // Revoke when load complete
            URL.revokeObjectURL(blobURL);
          }).cropper('reset').cropper('replace', blobURL);
          $inputImage.val('');
        } else {
          window.alert('Please choose an image file.');
        }
      }
    });
  } else {
    $inputImage.prop('disabled', true).parent().addClass('disabled');
  }

});
