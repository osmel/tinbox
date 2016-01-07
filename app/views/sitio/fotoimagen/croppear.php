<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'sitio/fotoimagen/header' ); ?>      

<input type="text" id="session" name="session" value="<?php echo $session; ?>" >
<input type="text" id="id_diseno" name="id_diseno" value="<?php echo $id_diseno; ?>" >
<input type="text" id="ano" name="ano" value="<?php echo $ano; ?>" >
<input type="text" id="mes" name="mes" value="<?php echo $mes; ?>" >

<input type="text" id="mesclick" name="mesclick" value="" >




  <!-- Content -->
   
  <div class="container">

   
              <div id="meses" class="row">  
                 <div class="col-md-2">  </div>
                 <div class="col-md-8">  
                  <button id="mes0" nmes="0" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Ene</button>
                  <button id="mes1" nmes="1" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Feb</button>
                  <button id="mes2" nmes="2" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Mar</button>
                  <button id="mes3" nmes="3" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Abr</button>
                  <button id="mes4" nmes="4" type="button" class="btn btn-success col-xs-2 col-md-1 mes">May</button>
                  <button id="mes5" nmes="5" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Jun</button>
                  <button id="mes6" nmes="6" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Jul</button>
                  <button id="mes7" nmes="7" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Ago</button>
                  <button id="mes8" nmes="8" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Sep</button>
                  <button id="mes9" nmes="9" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Oct</button>
                  <button id="mes10" nmes="10" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Nov</button>
                  <button id="mes11" nmes="11" type="button" class="btn btn-success col-xs-2 col-md-1 mes">Dic</button>
                </div>
              </div>


    <div class="col-md-3">
         <?php $this->load->view( 'sitio/fotoimagen/slider',$datos); ?>
   </div>

    <div class="row">
      
      
      <h3 class="page-header">Imagen:</h3> 
      

      <div class="col-md-6" id="drop-area" style="max-width:520px;min-height:520px; padding:10px;border: 2px solid blue;">         
         

        
      </div>
 

      <div class="col-md-3">
        <!-- <h3 class="page-header">Preview:</h3> -->
        <div class="docs-preview clearfix">
          <div class="img-preview preview-lg"></div>
          <div class="img-preview preview-md"></div>
          <div class="img-preview preview-sm"></div>
          <div class="img-preview preview-xs"></div>
        </div>

          <div class="row">
            <div class="col-md-9 docs-buttons">
             
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, 0.1)">
                    <span class="fa fa-search-plus"></span>
                  </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;zoom&quot;, -0.1)">
                    <span class="fa fa-search-minus"></span>
                  </span>
                </button>
              </div>

        
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, -45)">
                    <span class="fa fa-rotate-left"></span>
                  </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;rotate&quot;, 45)">
                    <span class="fa fa-rotate-right"></span>
                  </span>
                </button>
              </div>
       
              <div class="btn-group">
                <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;scaleX&quot;, -1)">
                    <span class="fa fa-arrows-h"></span>
                  </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
                  <span class="docs-tooltip" data-toggle="tooltip" title="$().cropper(&quot;scaleY&quot;-1)">
                    <span class="fa fa-arrows-v"></span>
                  </span>
                </button>
              </div>
       
                <label class="btn btn-primary btn-upload" for="inputImage" title="Upload image file">
                  <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                  <span class="docs-tooltip" data-toggle="tooltip" title="Import image with Blob URLs">
                    <span class="fa fa-upload"></span>
                  </span>
                </label>

                 <button id="guardar" type="button" class="btn btn-success">continuar</button>
             </div><!-- /.docs-buttons -->
         </div>

      </div>




    </div>


  </div>

<?php $this->load->view( 'sitio/fotoimagen/footer' ); ?>
