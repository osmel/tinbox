;(function( $ ) {
	
//***Definir la "funcion calendarioEventos"***
	$.fn.calendarioEventos = function(opciones){
		
		var elCalendario = this;

		if ( opciones.locales && typeof(opciones.locales) == 'string' ) {
			$.getJSON(opciones.locales, function(data) {
				opciones.locales = $.extend({}, $.fn.calendarioEventos.defaults.locales, data);
				moment.locale(data.locale, opciones.locales.moment);
				moment.locale(data.locale);

				inicializandoEventoCalendario(elCalendario, opciones);
			}).error(function() {
				showError("error getting locale json", $(this));
			});
		} else {
			if ( opciones.locales && opciones.locales.locale ) {
				opciones.locales = $.extend({}, $.fn.calendarioEventos.defaults.locales, opciones.locales);
				moment.locale(opciones.locales.locale, opciones.locales.moment);
				moment.locale(opciones.locales.locale);
			}
			inicializandoEventoCalendario(elCalendario, opciones);
		}
	};

	
//****Define los parametros con los valores por defecto para la funcion "calendarioEventos"***
	$.fn.calendarioEventos.defaults = {
	    eventsjson: 'js/events.json',
		eventsLimit: 4,
		locales: {
			locale: "en",
			txt_noEvents: "There are no events in this period",
			txt_SpecificEvents_prev: "",
			txt_SpecificEvents_after: "events:",
			txt_next: "next",
			txt_prev: "prev",
			txt_NextEvents: "Next events:",
			txt_GoToEventUrl: "See the event",
			txt_loading: "loading..."
		},
		mostrarDiaSemana: true,
		semanaComienzaLunes: true,
		mostrarNombreDiaCalendario: true,
		showDescription: false,
		onlyOneDescription: true,
		openEventInNewWindow: false,
		eventsScrollable: false,
		dateFormat: "D/MM/YYYY",
		jsonDateFormat: 'timestamp', // you can use also "human" 'YYYY-MM-DD HH:MM:SS'
		moveSpeed: 500,	// speed of month move when you clic on a new date
		moveOpacity: 0.15, // month and events fadeOut to this opacity
		jsonData: "", 	// to load and inline json (not ajax calls)
		cacheJson: true	// if true plugin get a json only first time and after plugin filter events
						// if false plugin get a new json on each date change
	};


//***Inicializar la funcion. Construye la funcion***
	function inicializandoEventoCalendario(elCalendario, opciones) {
		
		var OpcionesEventos = $.extend( {}, $.fn.calendarioEventos.defaults, opciones );

		// Definir variables globales
		var miCalendario = {
			envolvente: "",
			eventsJson: {}
		};

		// each calendarioEventos will execute this function
		elCalendario.each(function(){

			miCalendario.envolvente = $(this);
			
			miCalendario.envolvente.addClass('almanaqueEnvolvente');


			// Dibujar el mes actual cuando entra *****
			dibujarMes(13,"actual", miCalendario, OpcionesEventos);

			//EVENTO CAMBIO DEL MES CON "botones"
			$("body").on('click','.botonMes',function(e){	
				movimiento = ($(this).attr('nmes') - miCalendario.envolvente.attr('mesAmostrarMenos1'));
				dibujarMes(movimiento,"next", miCalendario, OpcionesEventos);
				//borrar el viejo mes
				miCalendario.envolvente.find('.envolventeDetalleMes.viejoMes').remove();
			});


			//EVENTO CAMBIO DEL AÑO CON "selector"
			$("body").on('change','#id_ano',function(e){	
				movimiento = ($(this).val());
				//console.log(movimiento);
				dibujarMes(movimiento,"next", miCalendario, OpcionesEventos);
				//borrar el viejo mes
				miCalendario.envolvente.find('.envolventeDetalleMes.viejoMes').remove();
			});







			//evento cambio de mes con las "flechitas"
			cambiarMes(miCalendario, OpcionesEventos);



	//cada comienzo de diseño en particular

				
			   uid_fotocalendario = $("#uid_fotocalendario").val();
	
			 	url ="diseno_lista";

					$.ajax({
					    url: url,
					    type: 'POST',
					    dataType: "json",
					    data:  {
					    	
					    	uid_fotocalendario:uid_fotocalendario

					    },
					    		
						success: function(data){
							if(data != true){
							
								 $.miespacionombre.nombre_mes ={};
		                       	 $.miespacionombre.listaDias  ={};


		                        $.each(data, function (i, valor) {
		                        	   //console.log(i);
		                        	  

		                        	   $.each(valor, function (j, valo) {	

		                        	   	  if (i=="list_dia") {
												//console.log(valo.mes);
												if ((valo.valor)!='') {
													llave =	valo.ano+'_'+valo.mes+'_'+valo.dia;
													 $.miespacionombre.listaDias[llave] = { "valor" : valo.valor, "ano" : valo.ano, "mes":valo.mes, "dia":valo.dia }; //valor;
										

												}
		                        	   	  }

		                        	   	  if (i=="list_mes") {
												llave =	valo.ano+'_'+valo.mes;
												if ((valo.valor)!='') {
													$.miespacionombre.nombre_mes[llave] = { "valor" : valo.valor, "ano" : valo.ano, "mes":valo.mes }; //valor;	
												}
		                        	   	  }

				                        	
				                        });


		                        	   	//$.fn.prueba();
										
										//$.fn.dibujarMes(0,"next", $.fn.miCalendario, $.fn.OpcionesEventos);
										//miCalendario.envolvente.find('.envolventeDetalleMes.viejoMes').remove();


		                        });  //fin del each
				
										dibujarMes(0,"next", miCalendario, OpcionesEventos);
										//borrar el viejo mes
										miCalendario.envolvente.find('.envolventeDetalleMes.viejoMes').remove();

										//console.log(JSON.stringify($.miespacionombre.listaDias));
										
										console.log(JSON.stringify($.miespacionombre.listaDias));			
										console.log(JSON.stringify($.miespacionombre.nombre_mes));	


							}
						} 

					  });












	




	//leer la lista elegida y actualizar valores
	//$("#id_lista").on('change', function(e) {

	$("body").on('change','#id_lista',function(e){		

					//$('#foo').css('display','block');
					//var spinner = new Spinner(opts).spin(target);


					correo_activo = JSON.stringify($.miespacionombre.correo_activo);
					id_lista = $(this).val();

				 	url ="leer_lista";
					$.ajax({
					    url: url,
					    type: 'POST',
					    dataType: "json",
					    data:  {
					    	correo_activo: correo_activo,
					    	id_lista:id_lista

					    },
					    		
						success: function(data){
							if(data != true){
							
								 $.miespacionombre.nombre_mes ={};
		                       	 $.miespacionombre.listaDias  ={};


		                        $.each(data, function (i, valor) {
		                        	   //console.log(i);
		                        	  

		                        	   $.each(valor, function (j, valo) {	

		                        	   	  if (i=="list_dia") {
												//console.log(valo.mes);
												if ((valo.valor)!='') {
													llave =	valo.ano+'_'+valo.mes+'_'+valo.dia;
													 $.miespacionombre.listaDias[llave] = { "valor" : valo.valor, "ano" : valo.ano, "mes":valo.mes, "dia":valo.dia }; //valor;
										

												}
		                        	   	  }

		                        	   	  if (i=="list_mes") {
												llave =	valo.ano+'_'+valo.mes;
												if ((valo.valor)!='') {
													$.miespacionombre.nombre_mes[llave] = { "valor" : valo.valor, "ano" : valo.ano, "mes":valo.mes }; //valor;	
												}
		                        	   	  }

				                        	
				                        });


		                        	   	//$.fn.prueba();
										
										//$.fn.dibujarMes(0,"next", $.fn.miCalendario, $.fn.OpcionesEventos);
										//miCalendario.envolvente.find('.envolventeDetalleMes.viejoMes').remove();


		                        });  //fin del each
				
										dibujarMes(0,"next", miCalendario, OpcionesEventos);
										//borrar el viejo mes
										miCalendario.envolvente.find('.envolventeDetalleMes.viejoMes').remove();

										//console.log(JSON.stringify($.miespacionombre.listaDias));
										
										console.log(JSON.stringify($.miespacionombre.listaDias));			
										console.log(JSON.stringify($.miespacionombre.nombre_mes));	


							}
						} 

					  });
					 
					  return false;
			});

		});

	}


	function dibujarMes(movimiento, show, miCalendario, OpcionesEventos) {


										console.log(JSON.stringify($.miespacionombre.listaDias));
											
										console.log(JSON.stringify($.miespacionombre.nombre_mes));	


			
			
			//actualizando el dia de cada mes
			llave =	$("#almanaque").attr('anomostrado')+'_'+$("#almanaque").attr('mesamostrarmenos1');
			ano= $("#almanaque").attr('anomostrado');
			mes= $("#almanaque").attr('mesamostrarmenos1');

			valor = $('#texto_mes').val();
			if ((valor.trim())!='') {
				$.miespacionombre.nombre_mes[llave] = { "valor" : valor, "ano" : ano, "mes":mes }; //valor;	
			}
			

			$('#texto_mes').val('');

			//Fin de actualizando el dia de cada mes








		var $EnvMes = $("<div class='envolventeDelMes'></div>"),
			$EnvDetalleMes = $("<div class='envolventeDetalleMes'></div>"),
			$EnvTitulo = $("<div class='envolventeTitulo'><a href='#' class='tituloCalendario'></a></div>"),
			$EnlacesFlechas = $("<a href='#' class='EnlacesFlechas flecha-Anterior'><span></span></a><a href='#' class='EnlacesFlechas flecha-Proximo'><span></span></a>");
			$EnvDias = $("<ul class='envolventeDias'></ul>"),
			
//fecha actual
			fechaPosicionada = new Date();


			if ( !miCalendario.envolvente.find('.envolventeDelMes').length ) {
				miCalendario.envolvente.prepend($EnvMes);
				$EnvMes.append($EnvDetalleMes);
			} else {
				miCalendario.envolvente.find('.envolventeDelMes').append($EnvDetalleMes);
			}


/*esta es una marca para viejo mes y nuevo mes*/									
		miCalendario.envolvente.find('.envolventeDetalleMes.nuevoMes').removeClass('nuevoMes').addClass('viejoMes');
		$EnvDetalleMes.addClass('nuevoMes').append($EnvDias);  //.append($EnvTitulo, $EnvDias);



		
		if (show === "actual") {
			diaPosicionado = fechaPosicionada.getDate(); //tomar el día actual
			$EnvMes.append($EnlacesFlechas);

		} else {

			if (movimiento > 100) {
					fechaPosicionada = new Date(movimiento,0,1,0,0,0); // actual visible month
					diaPosicionado = 0;
					moverElMes =0;
			} else {



					fechaPosicionada = new Date(miCalendario.envolvente.attr('anoMostrado'),miCalendario.envolvente.attr('mesAmostrarMenos1'),1,0,0,0); // actual visible month
					 diaPosicionado = 0; // no mostrar el actual dia en la lista de día( not show actual day in days list)

					 if (movimiento==13) {
					 		moverElMes = 1;
							if (show === "prev") {
								moverElMes = -1;
							}
					 } else {
					 	moverElMes = movimiento;
					 }
			}		 

		/* establecer la fecha al mes correcto*/
					fechaPosicionada.setMonth( fechaPosicionada.getMonth() + moverElMes );

					var tmpDate = new Date();

					//si los meses son desiguales pues q el día tome el q le corresponde del mes
					//esto esta dando 0
					if (fechaPosicionada.getMonth() === tmpDate.getMonth()) {
						diaPosicionado = tmpDate.getDate();
					}

			

		}


/*Para mostrar:
	 - datos de fecha en el calendario
	 - para usar el idioma correspondiente
	 - Imprimir titulo del calendario (fecha con el siguiente formato "Enero 2015")
*/		

		var anoMostrado = fechaPosicionada.getFullYear(), // Año a q paso el calendario (year of the events)
			anoActual = new Date().getFullYear(), // año actual
			mesAmostrarMenos1 = fechaPosicionada.getMonth(), // 0-11
			mesAmostrar = mesAmostrarMenos1 + 1;
			//datos de fecha en el calendario
			miCalendario.envolvente.attr('mesAmostrarMenos1',mesAmostrarMenos1).attr('anoMostrado',anoMostrado);
			//idioma
			moment.locale(OpcionesEventos.locales.locale);
		    //Imprimir titulo del calendario (fecha con el siguiente formato "Enero 2015")
			var formatoFecha = moment(anoMostrado+" "+mesAmostrar, "YYYY MM").format("MMMM YYYY");
			$EnvTitulo.find('.tituloCalendario').html(formatoFecha);



		// Imprimir todos los días del mes
		var cantDiasMesMostrado = 32 - new Date(anoMostrado, mesAmostrarMenos1, 32).getDate();

		var listaDias = [],	i;
		
		if (OpcionesEventos.mostrarDiaSemana) { 
			$EnvDias.addClass('mostrarComoSemana');



//Imprimir "encabezado de los días" nombre de los días
			if (OpcionesEventos.mostrarNombreDiaCalendario) {
				$EnvDias.addClass('mostrarNombreDia');

				i = 0;
				// Si la semana Comienza lunes el contado comienza en 1
				//sino comienza en 0(domingo)
				if (OpcionesEventos.semanaComienzaLunes) {
					i = 1;
				}

				for (var i; i < 7; i++) {
					listaDias.push('<li class="encabezadoDias">'+moment()._locale._weekdaysShort[i]+'</li>');

					if (i === 6 && OpcionesEventos.semanaComienzaLunes) {
						// si comienza en lunes el ultimo imprimir el Dom (domingo)
						listaDias.push('<li class="encabezadoDias">'+moment()._locale._weekdaysShort[0]+'</li>');
					}

				}
			} //fin de Mostrar Encabezados de días




			fechaPrimerDiaMesMostrado=new Date(anoMostrado, mesAmostrarMenos1, 01);

			//dias de la semana: comienza en 0=Domingo
			var diaSemana = fechaPrimerDiaMesMostrado.getDay(); // Dia de la semana q comienza el mes

			if (OpcionesEventos.semanaComienzaLunes) {
				diaSemana = fechaPrimerDiaMesMostrado.getDay() - 1;
			}

			//esto es para el caso en que comience en Lunes y coincidio conque el 1er día d la semana
			//era Domingo. Lo convertimos a Sexto día d la semana
			if (diaSemana < 0) { diaSemana = 6; } // if -1 is because day starts on sunday(0) and week starts on monday

//Para imprimir los "dias Vacios"
			for (i = diaSemana; i > 0; i--) {
				listaDias.push('<li class="claseDia diaVacio"></li>');
			}




		}  //fin de imprimir todos los días del mes







//Para imprimir los "días llenos"
		for (dayI = 1; dayI <= cantDiasMesMostrado; dayI++) {
			var dayClass = "";

			if (diaPosicionado > 0 && dayI === diaPosicionado && anoMostrado === anoActual) {
				dayClass = "today";
			}

			

			listaDias.push('<li id="listaDia_' + dayI + '" rel="'+dayI+'" class="claseDia '+dayClass+'"><a href="#"  type="button" data-toggle="modal" data-target="#myModal"  >' + dayI + '</a></li>');
		}


		
// Final se Agrega toda la lista de "Encabezados", "Dias Vacios" y "dias llenos" 
		$EnvDias.append(listaDias.join(''));
		$EnvMes.css('height',$EnvDetalleMes.height()+'px');



//****************************************************************
//****************************************************************
//marcar los días q se encuentran lleno de informacion

         lista= $.miespacionombre.listaDias;
         
         $.each(lista, function(idx, val) {

         	if ((anoMostrado == val.ano) && (mesAmostrarMenos1==val.mes)) {
         		//console.log(val);
         		//
         		miCalendario.envolvente.find('li#listaDia_'+val.dia+' > a').addClass('lleno');
         		//alert(val);
         	}
         });


//actualizando el dia de cada mes

   llave =	$("#almanaque").attr('anomostrado')+'_'+$("#almanaque").attr('mesamostrarmenos1');
   if ($.miespacionombre.nombre_mes[llave])	{
   	 	$('#texto_mes').val($.miespacionombre.nombre_mes[llave].valor);	
   }

//Fin de actualizando el dia de cada mes

//****************************************************************
//****************************************************************

//mes_mostrar
			var formFecha = moment(anoMostrado+" "+mesAmostrar, "YYYY MM").format("MMMM YYYY");
			$('#mes_mostrar').html(formFecha);
}









	function cambiarMes(miCalendario, OpcionesEventos) {
		
		miCalendario.envolvente.find('.EnlacesFlechas').click(function(e){
			e.preventDefault();
			
			if ($(this).hasClass('flecha-Proximo')) {
				dibujarMes(13,"next", miCalendario, OpcionesEventos);
			} else
				if ($(this).hasClass('flecha-Anterior')) {
					dibujarMes(13,"prev", miCalendario, OpcionesEventos);
				} 
			//borrar el viejo mes	
			miCalendario.envolvente.find('.envolventeDetalleMes.viejoMes').remove();
		});

	}

})( jQuery );

