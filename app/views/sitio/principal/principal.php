<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php 
      $this->load->view( 'sitio/principal/header' ); 
      //$this->load->view( 'sitio/principal/navbar' );
      $dato['las_categorias_productos'] = $las_categorias_productos;
      //print_r($las_categorias_productos);
      $this->load->view( 'sitio/principal/navbar' );
?>






 
 <div class="container">
    
 <?php
    foreach ($productos as $llave => $valor) { 
          

                          foreach ($valor as $llave2 => $valor2) {


                              if (isset($valor2->categories)) {
                                
                                //print_r((json_encode($valor2))); die;
                                //http://torquemag.io/working-meta-data-using-json-rest-api/

                                if ($valor2->categories[0]==$categoria_activa) {

                                     //productos       
/*

campos ACF
http://www.ernestojimenez.net/art/advanced-custom-fields-desarrollo-temas-wordpress/

https://github.com/airesvsg/acf-to-rest-api


  SELECT meta_key, meta_value, meta_id, post_id
  FROM tinbox_postmeta
  WHERE meta_key = '_product_attributes'
  

SELECT meta_key, meta_value, meta_id, post_id
  FROM tinbox_postmeta
  
  WHERE meta_key = '_custom_field_type'
  WHERE post_id = %d and meta_key LIKE %'' 

  */
?>
                      <div class="col-md-4">

                      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modalMessage<?php print_r($valor2->id); ?>">

                              
                                

                              <!-- Imagen del producto -->  
                              <img src="<?php echo $valor2->featured_src; ?>" height="100" width="100">
                              <?php print_r($valor2->title); ?>

   
                               

                      </button>
                            <!--
                              <a href="<?php //echo base_url(); ?>eliminar_actividad_comercial ?>"  
                                class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modalMessage">
                                                                 
                                     <?php //   foreach ($valor2->images as $llave3 => $valor3) {  ?>
                                            <img src="<?php echo $valor3->src; ?>" height="100" width="100">
                                    
                                     <?php  //} ?>
                                         
                                     <?php //print_r($valor2->title); ?>

                                
                              </a> -->
                      </div>









<div class="modal fade bs-example-modal-lg" id="modalMessage<?php print_r($valor2->id); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
        <div class="modal-content">
          

  <div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3 class="text-left">Elegir su tamaño</h3>
  </div>
  <div class="modal-body">

                              <!-- galeria -->
                              <div class="row">


                                  
                                  <img src="<?php echo $valor2->featured_src; ?>" height="100" width="100">
                                  <?php echo ($valor2->title);  ?>

                                  <hr style="padding: 0px; margin: 15px;"/> 


                                    Galería
                                  <?php    foreach ($valor2->images as $llave3 => $valor3) {  ?>

                                           <?php if ($valor2->featured_src!= $valor3->src) { ?>
                                           
                                           <img src="<?php echo $valor3->src; ?>" height="100" width="100">  
                                   <?php  } } ?>

                               </div>
                                <hr style="padding: 0px; margin: 15px;"/> 

                  <?php 
                       //Tamaños del producto
                       foreach ($valor2->variations as $llave3 => $valor3) { 
                               foreach ($valor3->attributes as $llave4 => $valor4) { 
                                 
                                 $data['slug'] = $valor4->option;
                                 
                                 $data['imagen_attributo']  =  $this->modelo_fcalendario->imagen_atributo( $data );
                                 echo '<img src="'.$data['imagen_attributo'][0]->guid.'" height="100" width="100">';

                               }
                       }
                      ?> 

    <div class="alert" id="messagesModal"></div>
  </div>
  <div class="modal-footer">
    <button class="btn btn-danger" id="deleteUserSubmit">Aceptar</button>
    <button class="btn btn-default" data-dismiss="modal">Cancelar</button>
  </div>



        </div>
    </div>
</div>  
                                    

                                   

<?php 

                                     
                                 } //   fin de la "categoria activa" if ($valor2->categories[0]==$categoria_activa) {
                              } // fin del if (isset($valor2->categories)) {
                          }
   }   

?>                       

</div>     
     
     
<?php $this->load->view( 'sitio/principal/footer' ); ?>


