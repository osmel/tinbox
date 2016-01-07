$(function(){

  window.MY_Socket = {

    
  // Instanciar al "cliente Socket.IO" y conectar con el servidor
    //socket : io.connect('http://localhost:8080'),
    socket : io.connect('http://104.236.91.215:8080'),
    
  // Configurar los controladores de eventos iniciales para el cliente Socket.IO

  // estos son los que inicializan los controladores para cada evento que ocurra,
  //en este caso esta escuchando constantemente si sucede
  // una  this.socket.on('conexion' : para disparar el mensaje de "estoy trabajando"
  bindEvents : function() {
      this.socket.on('conexion',MY_Socket.conexionMessage);   //llama a la funcion  conexionMessage
      //cuando le transmiten el nuevo mensaje, al equipo del que envia el mensaje
     

     //para saber la cantidad de sessiones que hay en sala3 (ventanilla3)
     this.socket.on('turnos_sala3',MY_Socket.turno_sala3);     
     this.socket.on('turnos_sala2',MY_Socket.turno_sala2);     

    this.socket.on('turnos_sala4',MY_Socket.turno_sala4);     
    this.socket.on('turnos_sala5',MY_Socket.turno_sala5);     
    this.socket.on('turnos_sala6',MY_Socket.turno_sala6);     

    this.socket.on('turnos_sala8',MY_Socket.turno_sala8);     

  },

  // Esto sólo indica que una conexión Socket.IO ha comenzado.
    conexionMessage : function(data) {
      console.log(data.message);   
    },


  fun_sala3 : function(msg,tipo) {  
          MY_Socket.socket.emit('ventanilla_sala3',msg,tipo);
  },


  turno_sala3 : function(data) { 

        var sessionId = readCookie('utm_session'); //session activa
        var arreglo_usuarios=[];   
            
        $.each(data, function (i, valor) {
           if (sessionId != valor.id_session) {
              arreglo_usuarios.push(valor.id_usuarios); 
           }
        });

                $.ajax({
                          url : 'proximo_turno_v3',
                          data : { 
                            destino: 3,
                            arreglo_usuarios: arreglo_usuarios,
                            cant_usuarios : arreglo_usuarios.length,
                          },
                          type : 'POST',
                          dataType : 'json',
                          success : function(datos) { 
             
                           if ((datos.numero)) {

                               $('#num_turno').val(datos.numero);  
                               $('#num_registro').val(datos.num_registro);   
                               $('#num_peticion').val(datos.num_peticion);   

                               $('#numero').text(datos.numero);
                               $('#etiq_registro').val(datos.num_registro);
                               $('#etiq_peticion').val(datos.num_peticion);

                             
                               $('#total_v3').text(datos.total);
                               //$('#numero_v3').text(datos.numero);
                               $('#origen_v3').text(datos.origen);

                               $("#disabled_sig_v3").attr('disabled', false);   
                               $("#v3_pausa").attr('disabled', datos.pausa);   


                               if (datos.origen_actividad==1) { //viene desde turno
                                  $("#disabled_ret_v3").attr('disabled', true);  
                               } else { //viene desde v12
                                   $("#disabled_ret_v3").attr('disabled', false);  
                               }
                               
                             } else { //se queda vacio 
                                  $('#num_turno').val('');
                                  $('#num_registro').val('');
                                  $('#num_peticion').val('');

                                  $('#numero').text('');
                                  $('#etiq_registro').val('');
                                  $('#etiq_peticion').val('');


                                  $('#total_v3').text(0);
                                 // $('#numero_v3').text('');
                                  $('#origen_v3').text('');
                                  $("#disabled_sig_v3").attr('disabled', true);  
                                  $("#v3_pausa").attr('disabled', true);   
                                  $("#disabled_ret_v3").attr('disabled', true);  

                               }


                      }
                }); 
           



              if( ( !userIsAnAdmin() && data.team != 'admin') ||
                  ( userIsAnAdmin() && data.team === 'admin') ){
              }

   MY_Socket.fun_sala8('datos','todas');

  },




  fun_sala2 : function(msg,tipo) {  
          MY_Socket.socket.emit('ventanilla_sala2',msg,tipo);
  },


  turno_sala2 : function(data) { 

        var sessionId = readCookie('utm_session'); //session activa
        var arreglo_usuarios=[];   
            
        $.each(data, function (i, valor) {
           if (sessionId != valor.id_session) {
              arreglo_usuarios.push(valor.id_usuarios); 
           }
        });



                     $.ajax({
                                url : 'proximo_turno_v2',
                                data : { 
                                           destino: 2,
                                  arreglo_usuarios: arreglo_usuarios,
                                    cant_usuarios : arreglo_usuarios.length,                                              
                                },
                                type : 'POST',
                                dataType : 'json',
                                success : function(datos) { 

                                               if ((datos.numero)) {
                                             
                                                 $('#num_turno').val(datos.numero);
                                                 $('#total_v2').text(datos.total);
                                                 $('#numero_v2').text(datos.numero);
                                                 $('#origen_v2').text(datos.origen);
                                                 $('#num_registro').val(datos.num_registro);
                                                 $('#num_peticion').val(datos.num_peticion);

                                                 $("#disabled_sig_v2").attr('disabled', false);  
                                                 $("#pausa_v2").attr('disabled', datos.pausa);   
                                                 $("#disabled_ven3_v2").attr('disabled', false);  
                                                 
                                                 
                                               } else { //vacio el formulario
                                                 $('#num_turno').val('');
                                                 $('#total_v2').text(0);
                                                 $('#numero_v2').text('');
                                                 $('#origen_v2').text('');
                                                 $('#num_registro').val('');
                                                 $('#num_peticion').val('');

                                                 $("#disabled_sig_v2").attr('disabled', true);  
                                                 $("#pausa_v2").attr('disabled', true);   
                                                 $("#disabled_ven3_v2").attr('disabled', true);  
                                                 

                                               }





                            }
                      }); 


                           



              if( ( !userIsAnAdmin() && data.team != 'admin') ||
                  ( userIsAnAdmin() && data.team === 'admin') ){
              }

MY_Socket.fun_sala8('datos','todas');

  },


  ///////////////////////////////////////////////////

  fun_sala4 : function(msg,tipo) {  
       
          MY_Socket.socket.emit('ventanilla_sala4',msg,tipo);
  },

  turno_sala4 : function(data) { 

        var sessionId = readCookie('utm_session'); //session activa
        var arreglo_usuarios=[];   
            
        $.each(data, function (i, valor) {
           if (sessionId != valor.id_session) {
              arreglo_usuarios.push(valor.id_usuarios); 
           }
        });






                                 $.ajax({
                                            url : 'proximo_turno_orina',
                                            data : { 
                                              destino: 4,
                                              arreglo_usuarios: arreglo_usuarios,
                                                cant_usuarios : arreglo_usuarios.length,                                              
                                            },
                                            type : 'POST',
                                            dataType : 'json',
                                            success : function(datos) { 
                                               
                                                if ((datos.numero)) {

                                                  $('#num_turno').val(datos.numero);  
                                                  $('#num_registro').val(datos.num_registro);   
                                                  $('#num_peticion').val(datos.num_peticion);   

                                                  $('#numero').text(datos.numero);
                                                  $('#etiq_registro').text(datos.num_registro);
                                                  $('#etiq_peticion').text(datos.num_peticion);



                                                  $('#total').text(datos.total);
                                                  $('#origen').text(datos.origen);

                                                  $("#disabled_sig_orina").attr('disabled', false);  
                                                  $("#pausa_orina").attr('disabled', datos.pausa);  

                                                  $("#disabled_canc_orina").attr('disabled', false);  







                                                
                                               } else { //vacio el formulario


                                                    $('#num_turno').val('');
                                                    $('#num_registro').val('');
                                                    $('#num_peticion').val('');

                                                    $('#numero').text('');
                                                    $('#etiq_registro').text('');
                                                    $('#etiq_peticion').text('');

                                                    $('#total').text(0);
                                                    $('#origen').text('');

                                                    $("#disabled_sig_orina").attr('disabled', true);  
                                                    $("#pausa_orina").attr('disabled', true);  
                                                    $("#disabled_canc_orina").attr('disabled', true);  




                                               }



                                        }
                                  }); 



        
   MY_Socket.fun_sala8('datos','todas');     

  },
///////////////////////////////////////////////////

  fun_sala5 : function(msg,tipo) {  
          MY_Socket.socket.emit('ventanilla_sala5',msg,tipo);
  },
  
  turno_sala5 : function(data) { 

        var sessionId = readCookie('utm_session'); //session activa
        var arreglo_usuarios=[];   
            
        $.each(data, function (i, valor) {
           if (sessionId != valor.id_session) {
              arreglo_usuarios.push(valor.id_usuarios); 
           }
        });





                                 $.ajax({
                                            url : 'proximo_turno_cultivo',
                                            data : { 
                                              destino: 5,
                                              arreglo_usuarios: arreglo_usuarios,
                                                cant_usuarios : arreglo_usuarios.length,                                               
                                            },
                                            type : 'POST',
                                            dataType : 'json',
                                            success : function(datos) { 
                                               
                                                if ((datos.numero)) {

                                                          $('#num_turno').val(datos.numero);   
                                                          $('#num_registro').val(datos.num_registro);   
                                                          $('#num_peticion').val(datos.num_peticion);   

                                                          $('#numero').text(datos.numero);
                                                          $('#etiq_registro').text(datos.num_registro);
                                                          $('#etiq_peticion').text(datos.num_peticion);


                                                          $('#total').text(datos.total);
                                                          $('#origen').text(datos.origen);

                                                          $("#disabled_sig_cultivo").attr('disabled', false);  

                                                          $("#pausa_cultivo").attr('disabled', datos.pausa);  

                                                          $("#disabled_canc_cultivo").attr('disabled', false);  

                                                 
                                               } else { //vacio el formulario

                                                    $('#num_turno').val('');
                                                    $('#num_registro').val(datos.num_registro);   
                                                    $('#num_peticion').val(datos.num_peticion);   


                                                    $('#etiq_registro').text('');
                                                    $('#etiq_peticion').text('');
                                                    $('#numero').text('');

                                                    $('#total').text(0);

                                                    $('#origen').text('');


                                                    $("#disabled_sig_cultivo").attr('disabled', true);  

                                                    $("#pausa_cultivo").attr('disabled', true);  

                                                    $("#disabled_canc_cultivo").attr('disabled', true);  

                                                 
                                                 

                                               }



                                        }
                                  }); 






MY_Socket.fun_sala8('datos','todas');

  },

///////////////////////////////////////////////////
  fun_sala6 : function(msg,tipo) {  
          MY_Socket.socket.emit('ventanilla_sala6',msg,tipo);
  },
  
  turno_sala6 : function(data) { 
     
        var sessionId = readCookie('utm_session'); //session activa
        var arreglo_usuarios=[];   
            
        $.each(data, function (i, valor) {
           if (sessionId != valor.id_session) {
              arreglo_usuarios.push(valor.id_usuarios); 
           }
        });





         $.ajax({
                    url : 'proximo_turno_sangre',
                    data : { 
                        destino: 6,
                        arreglo_usuarios: arreglo_usuarios,
                          cant_usuarios : arreglo_usuarios.length,                         
                    },
                    type : 'POST',
                    dataType : 'json',
                    success : function(datos) { 

                
                                  for (i=0; i <=10 ; i++) { 
                                      $('#c'+i).text('?');
                                      $('#c'+i).attr('valor', '?');  
                                      $('#cc'+i).attr('valor', '?');  

                                      $('#cp'+i).attr('valor', '?');  
                                      $('#cp'+i).attr('disabled', true);  
                                  }

                                  $.each(datos, function (i, valor) {
                                      $('#c'+valor.casilla).text(valor.numero);
                                      $('#c'+valor.casilla).attr('valor', valor.numero);  
                                      $('#cc'+valor.casilla).attr('valor', valor.numero);  
      
                                      $('#cp'+valor.casilla).attr('valor', valor.numero);  
                                      $('#cp'+valor.casilla).attr('disabled', valor.pausa=="1");  

                                  });


                   }
          }); 


MY_Socket.fun_sala8('datos','todas');
 
  },

    




///////////////////////Pantalla de NOTIFICACIONES////////////////////////////
  fun_sala8 : function(msg,tipo) {  
          MY_Socket.socket.emit('ventanilla_sala8',msg,tipo);
  },
  
  turno_sala8 : function(data) { 
     
        //alert('Si');
        var sessionId = readCookie('utm_session'); //session activa
        
        var arreglo_usuarios_v21 = [];  
        var arreglo_usuarios_v22 = [];  
        var arreglo_usuarios_v23 = [];  
        

        var arreglo_usuarios_v31 = [];  
        var arreglo_usuarios_v32 = [];  
        var arreglo_usuarios_v33 = [];  

            
        $.each(data, function (i, valor) {

  
           //array de v2 y que estan ubicados en c1
           if ( (valor.sala==2) && (valor.casilla_notificacion==1) ) {
              arreglo_usuarios_v21.push(valor.id_usuarios); 
              //console.log(arreglo_usuarios_v21);
           }

           //array de v2 y que estan ubicados en c2
           if ( (valor.sala==2) && (valor.casilla_notificacion==2) ) {
             
              arreglo_usuarios_v22.push(valor.id_usuarios); 

           }



          //array de v2 y que estan ubicados en c3
           if ( (valor.sala==2) && (valor.casilla_notificacion==3) ) {
              arreglo_usuarios_v23.push(valor.id_usuarios); 
           }



           //array de v3 y que estan ubicados en c1
           if ( (valor.sala==3) && (valor.casilla_notificacion==1) ) {
              arreglo_usuarios_v31.push(valor.id_usuarios); 
           }

           //array de v3 y que estan ubicados en c2
           if ( (valor.sala==3) && (valor.casilla_notificacion==2) ) {
             arreglo_usuarios_v32.push(valor.id_usuarios); 
           }

          //array de v3 y que estan ubicados en c3
           if ( (valor.sala==3) && (valor.casilla_notificacion==3) ) {
             arreglo_usuarios_v33.push(valor.id_usuarios); 
           }

        });






         $.ajax({
                    url : 'todas_las_notificaciones',
                    data : { 
                        destino: 6,
                        arreglo_usuarios_v21:arreglo_usuarios_v21, 
                        arreglo_usuarios_v22:arreglo_usuarios_v22, 
                        arreglo_usuarios_v23:arreglo_usuarios_v23, 
                        arreglo_usuarios_v31:arreglo_usuarios_v31, 
                        arreglo_usuarios_v32:arreglo_usuarios_v32, 
                        arreglo_usuarios_v33:arreglo_usuarios_v33, 

                        //cant_usuarios : arreglo_usuarios.length,                         

                        cant_usuarios_v21:arreglo_usuarios_v21.length,                         
                        cant_usuarios_v22:arreglo_usuarios_v22.length,                         
                        cant_usuarios_v23:arreglo_usuarios_v23.length,                         
                        cant_usuarios_v31:arreglo_usuarios_v31.length,                         
                        cant_usuarios_v32:arreglo_usuarios_v32.length,                         
                        cant_usuarios_v33:arreglo_usuarios_v33.length,                         



                    },
                    type : 'POST',
                    dataType : 'json',
                    success : function(datos) { 

                                  //sangre
                                  for (i=0; i <=10 ; i++) { 
                                      $('#current-c'+i).text('X');
                                  }

                                  $.each(datos.sangre, function (i, valor) {
                                      $('#current-c'+valor.casilla).text(valor.numero);
                                  });

                                  //alert('Llego');
                                  //cultivo
                                  $('#current-cu').text(datos.cultivo);                                  

                                   //orina 
                                   $('#current-or').text(datos.orina);

                                   //v3
                                   $('#current-v3').text(datos.v3);

                                   //v2
                                   $('#current-v2').text(datos.v2);

                                   //v1
                                   $('#current-v1').text(datos.v1);


                   }
          }); 



 //window.location.reload();
  },







  // Únase(Join) a un socket.io 'room' basado en el equipo del usuario
    joinRoom : function(){
    // Obtener la sessionID de CodeIgniter de la cookie
      var sessionId = readCookie('utm_session');
      
      if(sessionId) {
    // Envía el "sessionID" al servidor Node en un esfuerzo para unirse a un "room"
        
                  MY_Socket.socket.emit('joinRoom',sessionId);
       
      } else {
    // Si no existe sessionID, no trata de unirse a un room.
        console.log('No session id found. Broadcast disabled.');
    // esperamos cerrar la sesión url? (//forward to logout url?)
      }
    }

  } // end window.MY_Socket
  

  // Comenzando !! Start it up!
  
  MY_Socket.bindEvents();

  //Provoco el evento joinRoom para obtener la "sessionID"
  MY_Socket.joinRoom();

  //MY_Socket.sendNewPost( "mi primer mensaje", "3");
  //MY_Socket.sendNewPost( "mi primer mensaje");

  // Read a cookie. http://www.quirksmode.org/js/cookies.html#script
  //https://norfipc.com/inf/javascript-lista-variables-funciones-usar-paginas-web.html
  function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  }
   
/* Este buscará la insignia(badge) 'Admin' en la ventana actual.
   Este es un método super-hacky "para determinar si el usuario es un administrador"
   Para que los mensajes desde el usuario del mismo equipo que el administrador no se
   dupliquen en el flujo de mensajes(message stream). */
   
  function userIsAnAdmin(){
    var val = false;
    $('.userTeamBadge').children().each(function(i,el){
       if ($(el).text() == 'Admin'){
         val = true;
       }
    });
    return val;
    
  }
});
