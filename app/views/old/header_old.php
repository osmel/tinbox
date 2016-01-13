<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es_MX">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Prueba</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    



</head>
<body>
	 <div id="cabecera">
       <div id="barranegra">  
            <div id="caja_texto_negro"> 
                Llevamos 50 anos prestando el mejor servicio desde estrategas. Satisfaciendo las espectativas de los clientes.
            </div>   
       </div>   
   

                <nav id="barraroja" class="navbar navbar-default">
                  <div id="caja_menu" class="container-fluid">

                        <!-- contenedor de movil ENCABEZADO("grafico o titulo") -->                        
                        <div class="navbar-header">
                           <!-- grafico que va a tener el boton -->                                               
                          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                          </button>

                            <!-- grafico o titulo del menu-->                        
                            <!-- <a class="navbar-brand" href="#">Titulo de movil</a> -->
                            <div id="todo_logo_menu"> 
                                    <img style="display: block;" id="logo1" src="img/logo1.png">
                                    <img style="display: none;" id="logo2" src="img/logo2.png">
                            </div>

                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="todo_texto_menu collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                          <ul class="nav navbar-nav">
                                <li class="active">
                                    <a href="#" class="elem_menu">
                                        SOPORTE <br>TECNICO <span class="sr-only">(current)</span> 
                                    </a> 
                                </li>
                                <li>    
                                    <a href="#" class="elem_menu">
                                        PREGUNTAS <br>FRECUENTES
                                    </a>                     
                                 </li>
                                 <li>   
                                    <a href="#" class="elem_menu">
                                        ACERCA DE <br>NOSOTROS
                                    </a> 
                                 </li>   
                                 <li>
                                    <a href="#" class="elem_menu">
                                        CONTACTANOS <br>
                                    </a>  
                                 </li>   

                            <li class="dropdown">
                              <a href="#" class="elem_menu dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PREGUNTAS<span class="caret"></span></a>
                              <ul class="menu-lista dropdown-menu">
                                <li>
                                    <a href="#" class="elem_menu">
                                        pregunta1
                                    </a> 
                                </li>
                                <li>    
                                    <a href="#" class="elem_menu">
                                        pregunta2
                                    </a>                     
                                 </li>

                              </ul>
                            </li>
                          </ul>
                        </div><!-- /.navbar-collapse -->

                  </div><!-- /.container-fluid -->


                </nav>

 



    </div>


	<?php $this->load->view( 'carrusel' ); ?>
