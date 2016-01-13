<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
  class modelo_revise extends CI_Model{
    
    private $key_hash;
    private $timezone;
    function __construct(){
      parent::__construct();
      $this->load->database("default");
      $this->key_hash    = $_SERVER['HASH_ENCRYPT'];
      $this->timezone    = 'UM1';
      date_default_timezone_set('America/Mexico_City');   
      $this->catalogo_logo           = $this->db->dbprefix('catalogo_logo');
      $this->catalogo_festividad     = $this->db->dbprefix('catalogo_festividad');
      
      //uid_fotocalendario
      $this->fotocalendario_temporal    = $this->db->dbprefix('fotocalendario_temporal');
      $this->fechas_especiales    = $this->db->dbprefix('fechas_especiales');
      $this->nombre_meses    = $this->db->dbprefix('nombre_meses');
      //uid_lista
      $this->fotocalendario_lista    = $this->db->dbprefix('fotocalendario_lista');
      $this->lista_nombre_meses    = $this->db->dbprefix('lista_nombre_meses');
      $this->lista_fechas_especiales    = $this->db->dbprefix('lista_fechas_especiales');
      $this->fotocalendario_imagenes    = $this->db->dbprefix('fotocalendario_imagenes');
      $this->fotocalendario_imagenes_original    = $this->db->dbprefix('fotocalendario_imagenes_original');
      $this->fotocalendario_imagenes_recorte    = $this->db->dbprefix('fotocalendario_imagenes_recorte');

      $this->logueo_identificador    = $this->db->dbprefix('logueo_identificador');

    }


       //correo logueo
       public function revisa_activos($data){
                  
                  $this->db->select("t.id_tamano");         
                  $this->db->select("t.titulo, t.nombre, t.apellidos");         
                  $this->db->select("t.id_mes, t.id_dia, t.id_festividad, t.id_ano, t.id_lista, t.logo, t.coleccion_id_logo, t.fecha");         

                  $this->db->from($this->fotocalendario_temporal.' As t');
                  $where = '(
                              (
                                ( t.id_session =  "'.$data['id_session'].'" )                           
                               )
                    )';   
        
                  $this->db->where($where);
                  
                  $info = $this->db->get();
                  if ($info->num_rows() > 0) {
                      return $info->result();
                  }    
                  else
                      return false;
                  $info->free_result();
       }


          //cuando se elimina un diseño
        public function eliminar_diseno_revise( $data ){
            
            $this->db->delete( $this->fotocalendario_temporal, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ) );
            $this->db->delete( $this->fechas_especiales, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ) );
            $this->db->delete( $this->nombre_meses, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ) );
            $this->db->delete( $this->logueo_identificador, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ) );
            
            $this->db->delete( $this->fotocalendario_imagenes, array( 'id_session' => $data['id_session'],  'id_diseno' => $data['id_tamano'] ) );
            $this->db->delete( $this->fotocalendario_imagenes_original, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ) );
            $this->db->delete( $this->fotocalendario_imagenes_recorte, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ) );
            return TRUE;

        }


       public function total_disenos($data){
                  $this->db->from($this->logueo_identificador);
                  $where = '(
                              (
                                ( id_session =  "'.$data['id_session'].'" )                           
                               )
                    )';   
                  $this->db->where($where);

                  
                  $info = $this->db->get();
                  if ($info->num_rows() > 0) {
                      return $info->num_rows();
                  }    
                  else
                      return false;
                  $info->free_result();
       } 


       public function total_disenos_completos($data){

                  $this->db->select("id_session,id_diseno");                           
                  $this->db->from($this->fotocalendario_imagenes);
                  
                  $where = '(
                              (
                                ( id_session =  "'.$data['id_session'].'" )                           
                               )
                  )';   

                  $this->db->where($where);
                  $this->db->group_by("id_session,id_diseno");
                  
                  $info = $this->db->get();
                  if ($info->num_rows() > 0) {
                      return $info->num_rows();
                  }    
                  else
                      return false;
                  $info->free_result();
       } 





    
  } 


?>