<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'header' ); ?>
      
     
      <hr class="linea_divisoras_largas" style="float:left;"> 
      <section class="container">
              
            <!--Slider -->
               <div class="row">
                  <div id="contenido" class="col-xs-12 col-md-9">

                        <?php $this->load->view( 'sitio/detalle/acerca' ); ?>                  

                  </div>

                  <div id="lateral" class="col-xs-12 col-md-3">
                        <div class="liston_lateral"></div> 
                        <div class="sobre_liston">
                              <a class="titular_menu_reglamentario">Nuestras Marcas</a> 
                              <div id="cssmenu">
                                 <div class="btn_ver_menu">MENÚ</div> 
                                 <ul> 
                                    
                                    <li>
                                          <a class="linksActivo">
                                                <div class="btn_activo"></div>
                                                <span>Primera preg</span>
                                          </a>
                                    </li>

                                    <li>
                                          <a class="linksActivo">
                                                <div class="btn_activo"></div>
                                                <span>Segunda preg</span>
                                          </a>
                                    </li>
                                    <li>
                                          <a class="linksActivo">
                                                <div class="btn_activo"></div>
                                                <span>Tercera preg</span>
                                          </a>
                                    </li>

                                 </ul> 
                              </div> 
                        </div>
                  </div>
               </div>   
            <div class="row"></div>      

            <h3 style="text-align:left; color:#000;">Visitanos en nuestra tienda</h3>
            <hr class="c75-linea-titulo-super">
            <br/>

            <div class="row">

              <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail">
                  <img src="http://placehold.it/260x160" alt="">
                </a>
                <p>1ra imagen</p>
              </div>

              <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail">
                  <img src="http://placehold.it/260x160" alt="">
                </a>
                <p>2da imagen</p>
              </div>


              <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail">
                  <img src="http://placehold.it/260x160" alt="">
                </a>
                <p>3ra imagen</p>
              </div>


              <div class="col-xs-6 col-md-3">
                <a href="#" class="thumbnail">
                  <img src="http://placehold.it/260x160" alt="">
                </a>
                <p>4ta imagen</p>
              </div>


            </div>


      </section>


<?php $this->load->view( 'footer' ); ?>