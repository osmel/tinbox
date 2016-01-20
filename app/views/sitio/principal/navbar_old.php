   <nav class="menu">
         
        <ul>
         
         <?php 


                       foreach ($las_categorias_productos as $llave => $valor) { 
                           
                           
                           if ($valor->image) {  //se presentan los q tengan imagenes

                               $echo '<img src="'.$valor->image.'" height="100" width="100">';
                               echo ($valor->name);    //nombre
                               echo ($valor->id);      //id      de la categoria
                                                       //slug    de la categoria
                                                       //parent  padre de la categoria
                               //print_r($valor->count); //->cantidad de productos

                               $cantidad_prod = $valor->count;
                               //display  ->default
                           }
                       }


         //print_r($categorias);
             //if ($categorias) {
              //foreach ($categorias as $categorias) { 
          ?>
                
                  <li>


                       <!-- 
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

                      -->
                  </li>


          <?php //} }?>



        </ul>
    </nav>