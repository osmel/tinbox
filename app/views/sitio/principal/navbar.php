<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="row">    
    <ul>
   <?php 

                       foreach ($las_categorias_productos as $llave => $valor) { 
                           if ($valor->image) {  //se presentan los q tengan imagenes
                         ?>   
                            <li class="col-md-4">
                                  <a href="<?php echo base_url().$valor->slug; ?>" type="button" class="btn btn-success btn-block">
                                        <img src="<?php echo $valor->image; ?>" height="100">
                                        <?php echo $valor->name; ?>    
                                  </a>
                            </li>
                         <?php   
                           }
                       }

          ?>

   </ul>

<br/><br/>
</div>    
 
      
      


