<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Clientes extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('modelo_cliente', 'clientes');  
    $this->load->model('modelo_catalogo', 'catalogo');  
  }

 
  ///////////////////////////////////////////////////////////////////////////
  //////////////////////////////EQUIPOS/////////////////////////////////////////////
  ///////////////////////////////////////////////////////////////////////////
  
  public function listado_clientes(){
  
   if ( $this->session->userdata('session') !== TRUE ) {
        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');

      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'clientes/clientes');
          break;

        default:  
          redirect('');
          break;
      }



    }    
    
  }


   public function procesando_clientes(){

    $data=$_POST;
    $busqueda = $this->clientes->buscador_clientes($data);
    echo $busqueda;
  } 



 // crear
  function nuevo_cliente(){
      if($this->session->userdata('session') === TRUE ){
            $id_perfil=$this->session->userdata('id_perfil');

            $data['equipos']   = $this->catalogo->todos_equipos();
            $data['estatus']   = $this->catalogo->todos_estatus();
            
            switch ($id_perfil) {    
              case 1:
                  $this->load->view( 'clientes/nuevo_cliente', $data);
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

  function validar_nuevo_cliente(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {

      $this->form_validation->set_rules('orden', 'Orden', 'trim|required|numeric|xss_clean');
      $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');
      $this->form_validation->set_rules('fecha_entrada', 'Fecha', 'trim|required|xss_clean');
      $this->form_validation->set_rules('domicilio', 'Domicilio', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');
      $this->form_validation->set_rules('falla', 'Falla', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');

      if ($this->form_validation->run() === TRUE){

          $data['uid'] = 'Lprueba-'.date('Y').date('m').date('d').'-'.random_string('alpha',4).random_string('numeric',3);                


          $data['orden']           = $this->input->post('orden');
          $data['nombre']           = $this->input->post('nombre');
          $data['fecha_entrada']    = $this->input->post('fecha_entrada');
          $data['domicilio']        = $this->input->post('domicilio');
          $data['referencia']       = $this->input->post('referencia');
          $data['id_equipo']   = $this->input->post('id_equipo');
          $data['marca']   = $this->input->post('marca');
          $data['falla']   = $this->input->post('falla');


          $data         =   $this->security->xss_clean($data);  
          $check = $this->clientes->check_existente_orden($data);
          if ( $check != FALSE ){
              $guardar            = $this->clientes->anadir_cliente( $data );
              if ( $guardar !== FALSE ){
                echo true;
              } else {
                echo '<span class="error"><b>E01</b> - La nueva  cliente no pudo ser agregada</span>';
              }
          } else {
              echo '<span class="error">La <b>Orden</b> ya se encuentra dada de alta.</span>';
          }    
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
    }
  }
    

  public function cliente($id){
  
   if ( $this->session->userdata('session') !== TRUE ) {
        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');

      $data['retorno']   = 'detalles_cliente/'.$id;  
      $data['id'] = base64_decode($id);
      $data['cliente']   = $this->clientes->buscar_cliente_detalle($data);

      $data['tecnicos']   = $this->catalogo->todos_tecnicos();
      $data['estatus']   = $this->catalogo->todos_estatus();
      $data['equipos']   = $this->catalogo->todos_equipos();



      switch ($id_perfil) {    
        case 1:
              $this->load->view( 'clientes/editar_cliente',$data);
          break;
            
        case 2:
              $this->load->view( 'clientes/editar_cliente',$data);
          break;

        default:  
          redirect('');
          break;
      }



    }    
    
  }

  function validar_editar_cliente(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {

      $this->form_validation->set_rules('orden', 'Orden', 'trim|required|numeric|xss_clean');
      $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');
      $this->form_validation->set_rules('fecha_entrada', 'Fecha', 'trim|required|xss_clean');
      $this->form_validation->set_rules('domicilio', 'Domicilio', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');
      $this->form_validation->set_rules('falla', 'Falla', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');

      if ($this->form_validation->run() === TRUE){


          $data['id']           = $this->input->post('id');

          $data['orden']           = $this->input->post('orden');
          $data['nombre']           = $this->input->post('nombre');
          $data['fecha_entrada']    = $this->input->post('fecha_entrada');
          $data['domicilio']        = $this->input->post('domicilio');
          $data['referencia']       = $this->input->post('referencia');
          $data['id_equipo']   = $this->input->post('id_equipo');
          $data['marca']   = $this->input->post('marca');

          $data['falla']   = $this->input->post('falla');
          $data['reporte']   = $this->input->post('reporte');
          $data['subtotal']   = $this->input->post('subtotal');
          $data['total']   = $this->input->post('total');
          $data['id_estatus']   = $this->input->post('id_estatus');


          $data         =   $this->security->xss_clean($data);  
          $check = $this->clientes->check_existente_editar_orden($data);
          if ( $check != FALSE ){
              $guardar            = $this->clientes->editar_cliente( $data );
              if ( $guardar !== FALSE ){
                echo true;
              } else {
                echo '<span class="error"><b>E01</b> - El nuevo cliente no pudo ser agregada</span>';
              }
          } else {
              echo '<span class="error">La <b>Orden</b> ya se encuentra dada de alta.</span>';
          }                
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
    }
  }    
  
  public function detalles_cliente($id){
  
   if ( $this->session->userdata('session') !== TRUE ) {
        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');

        $data['id'] = base64_decode($id);

        $data['cliente']   = $this->clientes->buscar_cliente_detalle($data);
        $data['orden']   = $this->clientes->buscar_orden_detalle($data);

        
 
      switch ($id_perfil) {    
        case 1:
            $this->load->view( 'orden/detalle_cliente',$data);

          break;
        case 2:
            $this->load->view( 'orden/detalle_cliente',$data);
          break;

        default:  
          redirect('');
          break;
      }



    }    


    
  }

  
  public function orden($id){
  
   if ( $this->session->userdata('session') !== TRUE ) {
        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');

      $data['retorno']   = 'detalles_cliente/'.$id;  
      $data['id']        = base64_decode($id);
      $data['orden']   = $this->clientes->buscar_orden_detalle($data);

      $data['tecnicos']   = $this->catalogo->todos_tecnicos();
      $data['estatus']   = $this->catalogo->todos_estatus();



      switch ($id_perfil) {    
        case 1:
            if ( $data['orden'] == FALSE ) { 
              $this->load->view( 'orden/nueva_orden',$data);
            } else {
              $this->load->view( 'orden/editar_orden',$data);
            }
          break;
            
        case 2:
            if ( $data['orden'] == FALSE ) { 
              $this->load->view( 'orden/nueva_orden',$data);
            } else {
              $this->load->view( 'orden/editar_orden',$data);
            }
            
          break;

        default:  
          redirect('');
          break;
      }



    }    
    
  }



  function validar_nuevo_orden(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {

      $this->form_validation->set_rules('fecha_entrega', 'Fecha', 'trim|required|xss_clean');
      $this->form_validation->set_rules('falla', 'Falla', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');
      $this->form_validation->set_rules('reporte', 'Reporte', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');

      $this->form_validation->set_rules('subtotal', 'SubTotal', 'trim|required|numeric|xss_clean');
      $this->form_validation->set_rules('total', 'Total', 'trim|required|numeric|xss_clean');

      if ($this->form_validation->run() === TRUE){

          $data['id_cliente']           = $this->input->post('id_cliente');
          $data['id_tecnico']           = $this->input->post('id_tecnico');
          $data['fecha_entrega']    = $this->input->post('fecha_entrega');  

          $data['falla']   = $this->input->post('falla');
          $data['reporte']   = $this->input->post('reporte');
          $data['subtotal']   = $this->input->post('subtotal');
          $data['total']   = $this->input->post('total');
          $data['id_estatus']   = $this->input->post('id_estatus');


          $data         =   $this->security->xss_clean($data);  
          $guardar            = $this->clientes->anadir_orden( $data );
          if ( $guardar !== FALSE ){
            echo true;
          } else {
            echo '<span class="error"><b>E01</b> - La nueva  cliente no pudo ser agregada</span>';
          }
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
    }
  }


  function validar_editar_orden(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {
  
      $this->form_validation->set_rules('fecha_entrega', 'Fecha', 'trim|required|xss_clean');
      $this->form_validation->set_rules('falla', 'Falla', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');
      $this->form_validation->set_rules('reporte', 'Reporte', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');

      $this->form_validation->set_rules('subtotal', 'SubTotal', 'trim|required|numeric|xss_clean');
      $this->form_validation->set_rules('total', 'Total', 'trim|required|numeric|xss_clean');

      if ($this->form_validation->run() === TRUE){

          $data['id']                   = $this->input->post('id');
          $data['id_cliente']           = $this->input->post('id_cliente');
          $data['id_tecnico']           = $this->input->post('id_tecnico');
          $data['fecha_entrega']    = $this->input->post('fecha_entrega');  

          $data['falla']   = $this->input->post('falla');
          $data['reporte']   = $this->input->post('reporte');
          $data['subtotal']   = $this->input->post('subtotal');
          $data['total']   = $this->input->post('total');
          $data['id_estatus']   = $this->input->post('id_estatus');


          $data         =   $this->security->xss_clean($data);  
          $guardar            = $this->clientes->editar_orden( $data );
          if ( $guardar !== FALSE ){
            echo true;
          } else {
            echo '<span class="error"><b>E01</b> - La nueva orden no pudo ser agregada</span>';
          }
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
    }
  }


///////////////////////////////////////////////////////////////////////



  function eliminar_cliente($id = '', $nombrecompleto='', $baja=''){
        $id_perfil=$this->session->userdata('id_perfil');
           
           $data['id']         = base64_decode($id);
        $data['nombrecompleto']   = base64_decode($nombrecompleto);
        $data['baja']   = base64_decode($baja);
        
        

          switch ($id_perfil) {    
                case 1:
                      if ($data['baja']==0) {
                              $data['activo']       = "desactivar";
                      } else
                      {
                              $data['activo']       = "activar";
                      }
                      $this->load->view( 'clientes/eliminar_cliente', $data );
                break;
                default:
                    redirect('');
                 break;

        }
  }      


  function validar_eliminar_cliente(){

    $data['id']           = $this->input->post('id');
    $data['baja']           = $this->input->post('baja');

  
    $data         =   $this->security->xss_clean($data);  
    $estatus = $this->clientes->eliminar_cliente(  $data );
    
    if ( $estatus != FALSE ){
      echo TRUE;
    } else {
      echo '<span class="error">No se ha podido cambiar el estatus de la Unidad</span>';
    }
  } 



//////////////////////Historico de orden///////////////////////////////
  public function procesando_historico_orden(){

    $data=$_POST;
    $busqueda = $this->clientes->buscador_historico_orden($data);

    echo $busqueda;
  } 





 
  public function reingreso($id){
  
   if ( $this->session->userdata('session') !== TRUE ) {
        redirect('login');
    } else {
        $id_perfil=$this->session->userdata('id_perfil');

      $data['retorno']   = 'detalles_cliente/'.$id;  
      $data['id'] = base64_decode($id);
      
      /*
      para si quiere mantener los datos anteriores para solo modificar,
      remplazar vista reingreso por editar_orden
      en estos momentos solo fue remplazada por nueva_orden

      */
      $data['orden']   = $this->clientes->buscar_orden_detalle($data);

      $data['tecnicos']   = $this->catalogo->todos_tecnicos();
      $data['estatus']   = $this->catalogo->todos_estatus();



      switch ($id_perfil) {    
        case 1:
              $this->load->view( 'orden/reingreso',$data);
          break;
            
        case 2:
              $this->load->view( 'orden/reingreso',$data);
          break;
        default:  
          redirect('');
          break;
      }



    }    
    
  }



  function validar_reingreso(){
    if ($this->session->userdata('session') !== TRUE) {
      redirect('');
    } else {

      $this->form_validation->set_rules('fecha_entrega', 'Fecha', 'trim|required|xss_clean');
      $this->form_validation->set_rules('falla', 'Falla', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');
      $this->form_validation->set_rules('reporte', 'Reporte', 'trim|required|min_length[3]|max_lenght[60]|xss_clean');

      $this->form_validation->set_rules('subtotal', 'SubTotal', 'trim|required|numeric|xss_clean');
      $this->form_validation->set_rules('total', 'Total', 'trim|required|numeric|xss_clean');

      if ($this->form_validation->run() === TRUE){

          $data['id']                   = $this->input->post('id');
          $data['id_cliente']           = $this->input->post('id_cliente');
          $data['id_tecnico']           = $this->input->post('id_tecnico');
          $data['fecha_entrega']    = $this->input->post('fecha_entrega');  

          $data['falla']   = $this->input->post('falla');
          $data['reporte']   = $this->input->post('reporte');
          $data['subtotal']   = $this->input->post('subtotal');
          $data['total']   = $this->input->post('total');
          $data['id_estatus']   = $this->input->post('id_estatus');


          $data         =   $this->security->xss_clean($data);  
          
           $this->clientes->reingresar_orden( $data );
          $guardar            = $this->clientes->editar_orden( $data );
          if ( $guardar !== FALSE ){
            echo true;
          } else {
            echo '<span class="error"><b>E01</b> - El nuevo reingreso no pudo ser agregado</span>';
          }
      } else {      
        echo validation_errors('<span class="error">','</span>');
      }
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