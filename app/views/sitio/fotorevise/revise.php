<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'sitio/fotorevise/header' ); ?>




<input type="text" id="id_session" name="id_session" value="<?php echo $id_session; ?>" >
<input type="text" id="id_tamano" name="id_tamano" value="<?php echo $id_tamano; ?>" >
<input type="text" id="ano" name="ano" value="<?php echo $ano; ?>" >




  <!-- Content -->
   
  <div class="container">
      <?php $this->load->view( 'sitio/fotorevise/navbar' ); ?>
      <?php $this->load->view( 'sitio/fotorevise/acordion' ); ?>


      
  </div>



<?php $this->load->view( 'sitio/fotorevise/footer' ); ?>

