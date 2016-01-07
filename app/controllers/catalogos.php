<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Catalogos extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('modelo_catalogo', 'catalogo');  
  }

  public function listado_catalogos(){

    if ( $this->session->userdata('session') !== TRUE ) {
      redirect('');
    } else {
      $id_perfil=$this->session->userdata('id_perfil');

      switch ($id_perfil) {    
        case 1:
              $this->load->view( 'catalogos/catalogos' );
          break;

        default:  
          redirect('');
          break;
      }
   }   

     
  }


  ///////////////////////////////////////////////////////////////////////////
  //////////////////////////////EQUIPOS/////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  
  public function listado_equipos(){
  
   if ( $this->session->userdata('session') !== TRUE ) {
        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');

      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'catalogos/equipos');
          break;

        default:  
          redirect('');
          break;
      }



    }    
    
  }


   public function procesando_cat_equipos(){

    $data=$_POST;
    $busqueda = $this->catalogo->buscador_cat_equipos($data);
    echo $busqueda;
  } 


    // crear
  function nuevo_equipo(){
if($this->session->userdata('session') === TRUE ){
      $id_perfil=$this->session->userdata('id_perfil');

      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'catalogos/equipos/nuevo_equipo');
          break;
        default:  
          redirect('');
          break;
      }
    }
    else{ 
      redirect('index');
    }
  }

  function validar_nuevo_equipo(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {
      $this->form_validation->set_rules('equipo', 'equipo', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');
      if ($this->form_validation->run() === TRUE){
          $data['equipo']   = $this->input->post('equipo');
          $data         =   $this->security->xss_clean($data);  
          $guardar            = $this->catalogo->anadir_equipo( $data );
          if ( $guardar !== FALSE ){
            echo true;
          } else {
            echo '<span class="error"><b>E01</b> - La nueva  equipo no pudo ser agregada</span>';
          }
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
    }
  }


  // editar
  function editar_equipo( $id = '' ){
     
      if($this->session->userdata('session') === TRUE ){
            $id_perfil=$this->session->userdata('id_perfil');

              $data['id']  = $id;
            switch ($id_perfil) {    
              case 1:
                    $data['equipo'] = $this->catalogo->coger_equipo($data);
                    if ( $data['equipo'] !== FALSE ){
                        $this->load->view( 'catalogos/equipos/editar_equipo', $data );
                    } else {
                          redirect('');
                    }               
                break;
              default:  
                redirect('');
                break;
            }
          }
          else{ 
            redirect('');
          }      
 
  }


function validacion_edicion_equipo(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {
      $this->form_validation->set_rules( 'equipo', 'equipo', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');

      if ($this->form_validation->run() === TRUE){
            $data['id']           = $this->input->post('id');
          $data['equipo']         = $this->input->post('equipo');
          $data               = $this->security->xss_clean($data);  
          $guardar            = $this->catalogo->editar_equipo( $data );

          if ( $guardar !== FALSE ){
            echo true;

          } else {
            echo '<span class="error"><b>E01</b> - La nueva  equipo no pudo ser agregada</span>';
          }
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
    }
  }
  

  // eliminar


  function eliminar_equipo($id = '', $nombrecompleto=''){
      if($this->session->userdata('session') === TRUE ){
      $id_perfil=$this->session->userdata('id_perfil');

        $data['nombrecompleto']   = base64_decode($nombrecompleto);

      switch ($id_perfil) {    
        case 1:
            $data['id']         = $id;
            $this->load->view( 'catalogos/equipos/eliminar_equipo', $data );

          break;

        default:  
          redirect('');
          break;
      }
    }
    else{ 
      redirect('');
    }
  }


  function validar_eliminar_equipo(){
    if (!empty($_POST['id'])){ 
      $data['id'] = $_POST['id'];
    }
    $eliminado = $this->catalogo->eliminar_equipo(  $data );
    if ( $eliminado !== FALSE ){
      echo TRUE;
    } else {
      echo '<span class="error">No se ha podido eliminar la equipo</span>';
    }
  }   




  ///////////////////////////////////////////////////////////////////////////
  //////////////////////////////tecnicos/////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  
  public function listado_tecnicos(){
  
   if ( $this->session->userdata('session') !== TRUE ) {
        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');

      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'catalogos/tecnicos');
          break;

        default:  
          redirect('');
          break;
      }



    }    
    
  }


   public function procesando_cat_tecnicos(){

    $data=$_POST;
    $busqueda = $this->catalogo->buscador_cat_tecnicos($data);
    echo $busqueda;
  } 


    // crear
  function nuevo_tecnico(){
if($this->session->userdata('session') === TRUE ){
      $id_perfil=$this->session->userdata('id_perfil');

      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'catalogos/tecnicos/nuevo_tecnico');
          break;
        default:  
          redirect('');
          break;
      }
    }
    else{ 
      redirect('index');
    }
  }

  function validar_nuevo_tecnico(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {
      $this->form_validation->set_rules('tecnico', 'tecnico', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');
      if ($this->form_validation->run() === TRUE){
          $data['tecnico']   = $this->input->post('tecnico');
          $data         =   $this->security->xss_clean($data);  
          $guardar            = $this->catalogo->anadir_tecnico( $data );
          if ( $guardar !== FALSE ){
            echo true;
          } else {
            echo '<span class="error"><b>E01</b> - La nueva  tecnico no pudo ser agregada</span>';
          }
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
    }
  }


  // editar
  function editar_tecnico( $id = '' ){
     
      if($this->session->userdata('session') === TRUE ){
            $id_perfil=$this->session->userdata('id_perfil');

              $data['id']  = $id;
            switch ($id_perfil) {    
              case 1:
                    $data['tecnico'] = $this->catalogo->coger_tecnico($data);
                    if ( $data['tecnico'] !== FALSE ){
                        $this->load->view( 'catalogos/tecnicos/editar_tecnico', $data );
                    } else {
                          redirect('');
                    }               
                break;
              default:  
                redirect('');
                break;
            }
          }
          else{ 
            redirect('');
          }      
 
  }


function validacion_edicion_tecnico(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {
      $this->form_validation->set_rules( 'tecnico', 'tecnico', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');

      if ($this->form_validation->run() === TRUE){
            $data['id']           = $this->input->post('id');
          $data['tecnico']         = $this->input->post('tecnico');
          $data               = $this->security->xss_clean($data);  
          $guardar            = $this->catalogo->editar_tecnico( $data );

          if ( $guardar !== FALSE ){
            echo true;

          } else {
            echo '<span class="error"><b>E01</b> - La nueva  tecnico no pudo ser agregada</span>';
          }
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
    }
  }
  

  // eliminar


  function eliminar_tecnico($id = '', $nombrecompleto=''){
      if($this->session->userdata('session') === TRUE ){
      $id_perfil=$this->session->userdata('id_perfil');

        $data['nombrecompleto']   = base64_decode($nombrecompleto);

      switch ($id_perfil) {    
        case 1:
            $data['id']         = $id;
            $this->load->view( 'catalogos/tecnicos/eliminar_tecnico', $data );

          break;

        default:  
          redirect('');
          break;
      }
    }
    else{ 
      redirect('');
    }
  }


  function validar_eliminar_tecnico(){
    if (!empty($_POST['id'])){ 
      $data['id'] = $_POST['id'];
    }
    $eliminado = $this->catalogo->eliminar_tecnico(  $data );
    if ( $eliminado !== FALSE ){
      echo TRUE;
    } else {
      echo '<span class="error">No se ha podido eliminar la tecnico</span>';
    }
  }   



  ///////////////////////////////////////////////////////////////////////////
  //////////////////////////////estatus/////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  
  public function listado_estatus(){
  
   if ( $this->session->userdata('session') !== TRUE ) {
        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');

      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'catalogos/estatus');
          break;

        default:  
          redirect('');
          break;
      }



    }    
    
  }


   public function procesando_cat_estatus(){

    $data=$_POST;
    $busqueda = $this->catalogo->buscador_cat_estatus($data);
    echo $busqueda;
  } 


    // crear
  function nuevo_estatu(){
if($this->session->userdata('session') === TRUE ){
      $id_perfil=$this->session->userdata('id_perfil');

      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'catalogos/estatus/nuevo_estatu');
          break;
        default:  
          redirect('');
          break;
      }
    }
    else{ 
      redirect('index');
    }
  }

  function validar_nuevo_estatu(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {
      $this->form_validation->set_rules('estatu', 'estatu', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');
      if ($this->form_validation->run() === TRUE){
          $data['estatu']   = $this->input->post('estatu');
          $data         =   $this->security->xss_clean($data);  
          $guardar            = $this->catalogo->anadir_estatu( $data );
          if ( $guardar !== FALSE ){
            echo true;
          } else {
            echo '<span class="error"><b>E01</b> - La nueva  estatu no pudo ser agregada</span>';
          }
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
    }
  }


  // editar
  function editar_estatu( $id = '' ){
     
      if($this->session->userdata('session') === TRUE ){
            $id_perfil=$this->session->userdata('id_perfil');

              $data['id']  = $id;
            switch ($id_perfil) {    
              case 1:
                    $data['estatu'] = $this->catalogo->coger_estatu($data);
                    if ( $data['estatu'] !== FALSE ){
                        $this->load->view( 'catalogos/estatus/editar_estatu', $data );
                    } else {
                          redirect('');
                    }               
                break;
              default:  
                redirect('');
                break;
            }
          }
          else{ 
            redirect('');
          }      
 
  }


function validacion_edicion_estatu(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {
      $this->form_validation->set_rules( 'estatu', 'estatu', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');

      if ($this->form_validation->run() === TRUE){
            $data['id']           = $this->input->post('id');
          $data['estatu']         = $this->input->post('estatu');
          $data               = $this->security->xss_clean($data);  
          $guardar            = $this->catalogo->editar_estatu( $data );

          if ( $guardar !== FALSE ){
            echo true;

          } else {
            echo '<span class="error"><b>E01</b> - La nueva  estatu no pudo ser agregada</span>';
          }
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
    }
  }
  

  // eliminar


  function eliminar_estatu($id = '', $nombrecompleto=''){
      if($this->session->userdata('session') === TRUE ){
      $id_perfil=$this->session->userdata('id_perfil');

        $data['nombrecompleto']   = base64_decode($nombrecompleto);

      switch ($id_perfil) {    
        case 1:
            $data['id']         = $id;
            $this->load->view( 'catalogos/estatus/eliminar_estatu', $data );

          break;

        default:  
          redirect('');
          break;
      }
    }
    else{ 
      redirect('');
    }
  }


  function validar_eliminar_estatu(){
    if (!empty($_POST['id'])){ 
      $data['id'] = $_POST['id'];
    }
    $eliminado = $this->catalogo->eliminar_estatu(  $data );
    if ( $eliminado !== FALSE ){
      echo TRUE;
    } else {
      echo '<span class="error">No se ha podido eliminar la estatu</span>';
    }
  }   
    
  
/////////////////validaciones/////////////////////////////////////////  


  function nombre_valido( $str ){
     $regex = "/^([A-Za-z ñáéíóúÑÁÉÍÓÚ]{2,60})$/i";
    //if ( ! preg_match( '/^[A-Za-zÁÉÍÓÚáéíóúÑñ \s]/', $str ) ){
    if ( ! preg_match( $regex, $str ) ){      
      $this->form_validation->set_message( 'nombre_valido','<b class="requerido">*</b> La información introducida en <b>%s</b> no es válida.' );
      return FALSE;
    } else {
      return TRUE;
    }
  }

  function valid_phone( $str ){
    if ( $str ) {
      if ( ! preg_match( '/\([0-9]\)| |[0-9]/', $str ) ){
        $this->form_validation->set_message( 'valid_phone', '<b class="requerido">*</b> El <b>%s</b> no tiene un formato válido.' );
        return FALSE;
      } else {
        return TRUE;
      }
    }
  }

  function valid_option( $str ){
    if ($str == 0) {
      $this->form_validation->set_message('valid_option', '<b class="requerido">*</b> Es necesario que selecciones una <b>%s</b>.');
      return FALSE;
    } else {
      return TRUE;
    }
  }

  function valid_date( $str ){

    $arr = explode('-', $str);
    if ( count($arr) == 3 ){
      $d = $arr[0];
      $m = $arr[1];
      $y = $arr[2];
      if ( is_numeric( $m ) && is_numeric( $d ) && is_numeric( $y ) ){
        return checkdate($m, $d, $y);
      } else {
        $this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD-MM-YYYY.');
        return FALSE;
      }
    } else {
      $this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD-MM-YYYY.');
      return FALSE;
    }
  }

  public function valid_email($str)
  {
    return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
  } 


}

/* End of file nucleo.php */
/* Location: ./app/controllers/nucleo.php */