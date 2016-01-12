<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

      <aside>
      
          <h4 class="form-control-static">TUS CALENDARIOS</h4>
                       
          <?php 
             if ($datos) {
              foreach ($datos as $dato) { 
          ?>
                
                  <div class="row cuadro_slider" value="<?php echo $dato->id_tamano; ?>">

                        <div class="col-sm-12 col-md-12">
                           <button disabled  value="<?php echo $dato->id_tamano; ?>" type="button" class="editar_slider btn btn-success btn-block ttip" title="este es el tooltip.">editar</button>
                        </div>                              

                        <div class="col-sm-12 col-md-12">
                           <button value="<?php echo $dato->id_tamano; ?>" type="button" class="eliminar_slider btn btn-danger btn-block ttip" title="este es el tooltip.">Eliminar</button>
                        </div>      

                        <div class="col-sm-12 col-md-12">
                           <button disabled value="<?php echo $dato->id_tamano; ?>" type="button" class="previo_slider btn btn-info btn-block ttip" title="este es el tooltip.">Previsualizar</button>
                        </div>      

                        <?php echo $dato->id_tamano; ?>                        

                      <img src="http://placehold.it/150x150" style="border:1px solid;">
                  </div>


          <?php } }?>
                             
       </aside>   



      <!-- Modal no lista-->

      <div class="modal fade" id="modaleliminar_tamano" role="dialog" >  
        <div class="modal-dialog">
              <div class="modal-content">

                  <?php $this->load->view( 'sitio/fotocalendario/modaleliminar_tamano' ); ?>
              </div>
          </div>
      </div>  




