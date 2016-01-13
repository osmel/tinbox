<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


  <?php 
             if ($datos) {
              foreach ($datos as $dato) { 
  ?>
                   
       <div class="panel-group" class="" id="accordion<?php echo $dato->id_tamano; ?>" role="tablist" aria-multiselectable="true">
          
          <div class="panel panel-default miacordion">

            <!--titulo  -->
            <div class="panel-heading" role="tab" id="<?php echo $dato->id_tamano; ?>">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion<?php echo $dato->id_tamano; ?>" href="#colapsa<?php echo $dato->id_tamano; ?>" aria-expanded="true" aria-controls="colapsa<?php echo $dato->id_tamano; ?>">
                     
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <?php echo $dato->id_tamano; ?>
                            </div>                              

                            <div class="col-sm-12 col-md-2">
                               <button value="<?php echo $dato->id_tamano; ?>" type="button" class="editar_slider btn btn-success btn-block ttip" title="este es el tooltip.">editar</button>
                            </div>                              

                            <div class="col-sm-12 col-md-2">
                               <button value="<?php echo $dato->id_tamano; ?>" type="button" class="eliminar_slider btn btn-danger btn-block ttip" title="este es el tooltip.">Eliminar</button>
                            </div>      

                            <div class="col-sm-12 col-md-2">
                               <button value="<?php echo $dato->id_tamano; ?>" type="button" class="previo_slider btn btn-info btn-block ttip" title="este es el tooltip.">Previsualizar</button>
                            </div>      
                        </div>    

                </a>
              </h4>
            </div>


            <!--contenido -->

            <?php if ($dato->id_tamano==$id_tamano) { ?>            
                  <div id="colapsa<?php echo $dato->id_tamano; ?>" class="panel-collapse collapse-in" role="tabpanel" aria-labelledby="<?php echo $dato->id_tamano; ?>">
            <?php } else { ?>    
                  <div id="colapsa<?php echo $dato->id_tamano; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="<?php echo $dato->id_tamano; ?>">
            <?php } ?>    

              <div class="panel-body">
                        este es el contenido completo de  <?php echo $dato->id_tamano; ?>               
              </div>
            </div>

          </div>




       </div>

  <?php } }?>   
          


          <div class="row">
            <div class="col-md-5"></div>

              <div class="checkbox">
                <label for="coleccion_id_operaciones" class="ttip" title="He revisado mis datos e información">
                          <input disabled type="checkbox"  value="" name="chequeo_dato" id="chequeo_dato" >
                          He revisado mis datos e información
                </label>
              </div>
          </div>    

          <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2">
                  <button id="guardar" type="button" class="btn btn-success">continuar</button>
            </div>
              
          </div>  
          <br/>
             

<!-- Modal eliminar tamaño-->

<div class="modal fade" id="modaleliminar_tamano" role="dialog" >  
  <div class="modal-dialog">
        <div class="modal-content">
            <?php $this->load->view( 'sitio/fotorevise/modaleliminar_tamano' ); ?>
        </div>
    </div>
</div>  
