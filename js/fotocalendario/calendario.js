$(document).ready(function() {

				array_eliminar = $('#array_eliminar').val();

				$.miespacionombre = { 
				     listaDias:{}, //[]
				     nombre_mes:{},

				      correo_activo:$('#correo_activo').val(),
				cantDiseno_original:$('#cantDiseno_original').val(), 
				     	 cantDiseno:$('#cantDiseno').val(), 
				     posicionDiseno:$('#posicionDiseno').val(),
				     	movposicion:$('#movposicion').val(),
				     	id_session:$('#id_session').val(),


				     	array_eliminar : array_eliminar.split(",")


				     	//str.split(",");
				     	//http://stackoverflow.com/questions/2858121/convert-comma-separated-string-to-array


				}; 



				//console.log( $.miespacionombre.array_eliminar );
				//console.log( $.miespacionombre.array_eliminar.toString() );


				//if ($.miespacionombre.posicionDiseno<=) {	



				//cuando llegue al ultima session
				if (($.miespacionombre.cantDiseno==$.miespacionombre.posicionDiseno) && ($.miespacionombre.cantDiseno==$.miespacionombre.movposicion)) {
					$('#cont_session3').val('Continuar');
				} else {
					$('#cont_session3').val('Siguiente Calendario');
				}




				
				$("body").on('show.bs.modal','#myModal',function(e){			
					
					$(".infoTitulo").text('Día: '+$("#almanaque").attr('diaseleccionado')+' (Sólo 18 caracteres)');	

					llave =	$("#almanaque").attr('anomostrado')
						+'_'+$("#almanaque").attr('mesamostrarmenos1')+'_'+$("#almanaque").attr('diaseleccionado');

					//console.log(llave);
					//console.log($.miespacionombre.listaDias)	;

						if ($.miespacionombre.listaDias[llave]) {
										obj =	$.miespacionombre.listaDias[llave].valor;
										$("textarea.contenido").val(obj);	
						}
				});





				//$('#myModal').on('hide.bs.modal', function(e) {
				$("body").on('hide.bs.modal','#myModal',function(e){			

					valor = $('.contenido').val();
					diaseleccionado = $("#almanaque").attr('diaseleccionado');

					if (valor!='') 	{
						$('li#listaDia_'+diaseleccionado+' > a').addClass('lleno');
					} else {
						$('li#listaDia_'+diaseleccionado+' > a').removeClass('lleno');
					} 

					
					
					llave =	$("#almanaque").attr('anomostrado')
					+'_'+$("#almanaque").attr('mesamostrarmenos1')+'_'+$("#almanaque").attr('diaseleccionado');

					ano= $("#almanaque").attr('anomostrado');
					mes= $("#almanaque").attr('mesamostrarmenos1');
					dia= $("#almanaque").attr('diaseleccionado');

					$.miespacionombre.listaDias[llave] = { "valor" : valor, "ano" : ano, "mes":mes, "dia":dia }; //valor;

					$('.contenido').val("");
				    $(this).removeData('bs.modal');
				});	


				$("body #almanaque").on('click','.claseDia a',function(e){
					
					atrib_padre= $(this).parent().attr("rel") ;
					$("#almanaque").attr('diaseleccionado',atrib_padre);
					
				});

				$("#almanaque").calendarioEventos({
					mostrarDiaSemana:true,
					mostrarNombreDiaCalendario:true,
					semanaComienzaLunes:true, //false: comienza Domingo
					eventsjson: 'json/events.json.php',
					  showDescription: false, 
					  dateFormat: 'dddd MM-D-YYYY',
					  eventsLimit: 0,
					  //showDayAsWeeks: false

					    //jsonDateFormat: 'human'

					 //cacheJson: false,
					
					  //moveSpeed: 1, //velocidad
					 // openEventInNewWindow: true,

					 	//editor: 'show',

					  
					 
					
					locales: {
						locale: "es",
						monthNamonth: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
							"Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
						dayNamonth: [ 'Domingo','Lunes','Martes','Miércoles',
							'Jueves','Viernes','Sabado' ],
						dayNamonthShort: [ 'Dom','Lun','Mar','Mie', 'Jue','Vie','Sab' ],
						txt_noEvents: "No hay eventos para este periodo",
						txt_SpecificEvents_prev: "",
						txt_SpecificEvents_after: "eventos:",
						txt_next: "siguiente",
						txt_prev: "anterior",
						txt_NextEvents: "Próximos eventos:",
						txt_GoToEventUrl: "Ir al evento",
						"moment": {
					        "months" : [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
					                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
					        "monthsShort" : [ "Ene", "Feb", "Mar", "Abr", "May", "Jun",
					                "Julio", "Ago", "Sep", "Oct", "Nov", "Dic" ],
					        "weekdays" : [ "Domingo","Lunes","Martes","Miércoles",
					                "Jueves","Viernes","Sabado" ],
					        "weekdaysShort" : [ "Dom","Lun","Mar","Mie",
					                "Jue","Vie","Sab" ],
					        "weekdaysMin" : [ "Do","Lu","Ma","Mi","Ju","Vi","Sa" ],
					        "longDateFormat" : {
					            "LT" : "H:mm",
					            "LTS" : "LT:ss",
					            "L" : "DD/MM/YYYY",
					            "LL" : "D [de] MMMM [de] YYYY",
					            "LLL" : "D [de] MMMM [de] YYYY LT",
					            "LLLL" : "dddd, D [de] MMMM [de] YYYY LT"
					        },
					        "week" : {
					            "dow" : 1,
					            "doy" : 4
					        }
					    }
					}
					
				});
});