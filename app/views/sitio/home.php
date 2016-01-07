<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'header' ); ?>
     
<?php
                   echo '<div id="draggable" class="ui-widget-content">';

                     echo '<img id="draggable5" src="uploads/comprimido/prueba.jpg" style="width:130px; height:130px;"> ';
                     //echo '<p id="draggable5" class="ui-widget-header">Im contained within my parent</p>';
                 echo '</div>'; 
?>     


      <section class="container" style="text-align:left;">

          <?php
           $attr = array('class' => 'form-horizontal', 'id'=>'myform','name'=>'myform','method'=>'POST','autocomplete'=>'off','role'=>'form');
           echo form_open_multipart('validacion_comprimir');
          ?>  

           
            
            <label style="text-align:left;">subir:</label> 
            
            
            <input type="file" name="file" id="file" accept="image/*"/> 

            <br/>
            
            <div class="row">
              <div class="col-sm-4 col-md-4"></div>
              <div class="col-sm-4 col-md-4">
                <input style="padding:8px;" type="submit" class="btn btn-success btn-block" value="Guardar"/>
              </div>
            </div>



         <?php echo form_close(); ?>

      </section>


<?php $this->load->view( 'footer' ); ?>