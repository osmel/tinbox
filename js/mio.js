jQuery(document).ready(function(jQuery) {
	
	//jQuery( "#draggable" ).draggable();
	jQuery( "#draggable5" ).draggable({ containment: "#containment-wrapper", scroll: true });

	//que comience todo en el estado de grande
	jQuery('.todo_texto_menu').data('size','big');

	//jQuery('#espacio').css('padding-top',jQuery('#cabecera').height()+'px');

	//min-height: 70px;

	jQuery('.elem_menu').css('min-height',jQuery('#caja_menu').height()+'px');

	//http://www.jqueryrain.com/?qqmrgkC8


	//padding-top
	//alert(jQuery('#cabecera').height());
	
	/* 
		Instalar GIMP
		http://elblogdeliher.com/que-es-y-como-instalar-gimp-en-ubuntu-mediante-ppa/
	*/

	jQuery(window).scroll(function(){
		    
		    //si realiza scroll y es > 0
		    if(jQuery(document).scrollTop() > 0) {
		        
		        if(jQuery('.todo_texto_menu').data('size') == 'big')   {


		            jQuery('#barraroja').stop().animate({
		                height:'50%'
		            },600);

		            jQuery('#cabecera').stop().animate({
		                height:'100px'
		            },600);



		        	/*caja que contiene a todo el menu*/
		            jQuery('#caja_menu').stop().animate({
		                height:'70%'
		            },600);

		            jQuery('.todo_texto_menu').data('size','small');
		            jQuery('.todo_texto_menu').stop().animate({
		                height:'70%',
		                minheight: '70%', //jQuery('#caja_menu').height()+'px',
		            },600);

		             
		             jQuery('#logo1').stop().animate({
		             	height:'40px',
		                width:'200px'
		            },600);
		            
/*
		            jQuery('.elem_menu').stop().animate({
		                'min-height': jQuery('#barraroja').height(), //'70%',
		                padding: '0px 10px'
		            },600);			 
*/
				/*
		             jQuery('.elem_menu').stop().animate({
		               
		                height:jQuery('#barraroja').height(), //+'px', //'70%',
		               'min-height': jQuery('#barraroja').height(), //+'px', //'70%',
		               
		               
		                
		               'min-height': '50%', //'70%',
		               


		               padding: '0px 10px'
		            },600);		
					*/

		             jQuery('.elem_menu').stop().animate({
		                height:'70%',
		                padding: '12px 20px'
		            },600);			            		                       

		            jQuery('a.elem_menu').css('font-size','11px');

		            
		        }

		    } else  {
		        if(jQuery('.todo_texto_menu').data('size') == 'small')  {

		            jQuery('#cabecera').stop().animate({
		                height:'100px'
		            },600);

		            jQuery('#barraroja').stop().animate({
		                height:'70%'
		            },600);


		            jQuery('#caja_menu').stop().animate({
		                height:'auto'
		            },600);

		            jQuery('.todo_texto_menu').data('size','big');
		            jQuery('.todo_texto_menu').stop().animate({
		                height:'auto',
		            },600);

		             jQuery('#logo1').stop().animate({
		             	height:'60px',
		                width:'180px'
		            },600);


		             jQuery('.elem_menu').stop().animate({
		                height:'auto',
		                padding: '12px 20px'
		            },600);			             
		             jQuery('a.elem_menu').css('font-size','14px');

		        }  

		    } //fin del else


	}); //fin del  jQuery(window).scroll(function(){



	//////////////////////////////////////////////////////////////////////////////	
	////////////////////////////////////CARRUSEL//////////////////////////////////	
	//////////////////////////////////////////////////////////////////////////////	

	
	  $('.slider1').bxSlider({
	    slideWidth: 1920,
	    minSlides: 1,
	    maxSlides: 1,
	    slideMargin: 10,
	    auto: true
	  });
	






});	

    
		
