<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
  class modelo_fotoimagen extends CI_Model{
    
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

///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////Tratamiento de imagen////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////
///////////////////checar si existe el dato de IMAGEN q voy agregar//////////////////////////
    public function check_existente_imagen($data){
            $this->db->select("uid_imagen", FALSE);         
            $this->db->from($this->fotocalendario_imagenes);

            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_diseno =  '.$data['id_diseno'].' ) AND
                          ( ano =  "'.$data['ano'].'" ) AND
                          ( mes =  "'.$data['mes'].'" ) AND
                          ( original =  "'.$data['nombre'].'" )                           
                          
                          
                         )
              )';   
  
            $this->db->where($where);
            
            $info = $this->db->get();
            if ($info->num_rows() > 0) {
                $fila = $info->row(); 
                return $fila->uid_imagen;
            }    
            else
                return false;
            $info->free_result();
    } 
    /////////////////////////////////////////////    
    /////////////////////////////////////////////
////////////////////////////eliminar/////////////////////////////
    public function eliminar_imagenes( $data ){
        $this->db->delete( $this->fotocalendario_imagenes, array( 'uid_imagen' => $data ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }
    public function eliminar_imagenes_original( $data ){
        $this->db->delete( $this->fotocalendario_imagenes_original, array( 'uid_imagen' => $data ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }
    public function eliminar_imagenes_recorte( $data ){
        $this->db->delete( $this->fotocalendario_imagenes_recorte, array( 'uid_imagen' => $data ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }
/////////////////////////////////////////////    
    /////////////////////////////////////////////
////////////////////////////Agregar/////////////////////////////
     public function anadir_imagenes($data){
          $this->db->set('id_session', $data['id_session']);  
          $this->db->set('uid_imagen', $data['uid_imagen']);  
          $this->db->set('id_diseno', $data['id_diseno']);  

          $this->db->set('ano', $data['ano']);  
          $this->db->set('mes', $data['mes']);  
          
          $this->db->set('original', $data['nombre']);  
          $this->db->set('recorte', 'rec_'.substr($data['nombre'], 5));  
          
          $this->db->insert($this->fotocalendario_imagenes);
          
          if ($this->db->affected_rows() > 0){
                    return TRUE;
          } else {
              return FALSE;
          }
          $result->free_result();
     }
     
      public function anadir_imagenes_original($data){
             $this->db->set('id_session', $data['id_session']);  
             $this->db->set('id_tamano', $data['id_diseno']);  

             $this->db->set('uid_imagen', $data['uid_imagen']);  
                 $this->db->set('nombre', $data['nombre']);
           $this->db->set('tipo_archivo', $data['tipo_archivo']);  
                   $this->db->set('tipo', $data['tipo']);  
                    $this->db->set('ext', $data['ext']);   
                 $this->db->set('tamano', $data['tamano']);  
                  $this->db->set('ancho', $data['ancho']);   
                   $this->db->set('alto', $data['alto']);  
                 $this->db->insert($this->fotocalendario_imagenes_original);
           
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
            }
            $result->free_result();
      }       
     
        
     public function anadir_imagenes_recorte($data){
         
             $this->db->set('id_session', $data['id_session']);  
             $this->db->set('id_tamano', $data['id_diseno']);  

             $this->db->set('uid_imagen', $data['uid_imagen']);  
             //$this->db->set('nombre', 'recorte_'.$data['nombre']);  
             $this->db->set('nombre', 'rec_'.substr($data['nombre'], 5));  

         
          foreach ($data['datoimagen'] as $llave => $valor) {
                 $this->db->set( $llave, $valor );  
          } 
          foreach ($data['datocanvas'] as $llave => $valor) {
                 $this->db->set( 'c'.$llave, $valor );  
          } 

          foreach ($data['datos'] as $llave => $valor) {
                 $this->db->set( 'd'.$llave, $valor );  
          } 

          foreach ($data['datocropbox'] as $llave => $valor) {
                 $this->db->set( 'b'.$llave, $valor );  
          } 



          $this->db->insert($this->fotocalendario_imagenes_recorte);
            
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
      } 
     //fin de la lista
    public function buscar_imagen($data){
            $this->db->select("i.id, i.id_session, i.id_diseno, i.uid_imagen, i.ano, i.mes");         
            $this->db->select("o.nombre original, o.tipo_archivo, o.tipo, o.ext, o.tamano, o.ancho, o.alto");         
            $this->db->select("r.nombre recorte, r.aspectRatio, r.height, r.left, r.naturalHeight, r.naturalWidth, r.rotate, r.scaleX, r.scaleY, r.top, r.width");         
            $this->db->select("r.cwidth, r.cheight, r.cnaturalWidth, r.cnaturalHeight,  r.cleft, r.ctop");         
            $this->db->select("r.dx, r.dy, r.dwidth, r.dheight, r.drotate, r.dscaleX, r.dscaleY");         
            $this->db->select("r.bleft, r.btop, r.bwidth, r.bheight");         
            


            $this->db->from($this->fotocalendario_imagenes.' As i');
            $this->db->join($this->fotocalendario_imagenes_original.' As o', 'i.uid_imagen = o.uid_imagen','LEFT');
            $this->db->join($this->fotocalendario_imagenes_recorte.' As r', 'i.uid_imagen = r.uid_imagen','LEFT');

            $where = '(
                        (
                          ( i.id_session =  "'.$data['id_session'].'" ) AND
                          ( i.id_diseno =  '.$data['id_diseno'].' ) AND
                          ( i.ano =  "'.$data['ano'].'" ) AND
                          ( i.mes =  "'.$data['mes'].'" ) 
                         )
              )';   
  

  
            $this->db->where($where);
            
            $info = $this->db->get();
            if ($info->num_rows() > 0) {
                return $info->row(); 
            }    
            else
                return false;
            $info->free_result();
    } 


/////////////////////////////cantidad y listado de diseños/////////
  public function listado_disenos($data){
        //return false;
            
            $this->db->select("d.id, d.uid_fotocalendario, d.id_session, d.cantDiseno, d.movposicion");         
            $this->db->select("d.id_diseno, d.id_tamano, d.titulo");         
            $this->db->from($this->fotocalendario_temporal.' as d');
            $where = '(
                        (
                          ( d.id_session =  "'.$data['session'].'" )                           
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


///////////////cual es el num_diseño

    public function num_diseno($data){

            $this->db->select("i.id_diseno");         
            $this->db->from($this->fotocalendario_imagenes.' As i');

            $where = '(
                        (
                          ( i.id_session =  "'.$data['session'].'" )  AND                          
                          ( i.mes =  "'.$data['mes'].'" )  
                         )
            )';   
  
            $this->db->where($where);

            $this->db->order_by('i.id_diseno', 'ASC'); 
            
            $info = $this->db->get();

            if ($info->num_rows() > 0) {
                $id_diseno = $info->last_row()->id_diseno;
                return $id_diseno;
            }    
            else
                return 1;
            //$info->free_result();
            
    } 



    //correo logueo
 public function correo_logueo($data){
            $this->db->select("id, id_session, correo, id_diseno, id_tamano, fecha_mac");         
            $this->db->from($this->logueo_identificador);
            $where = '(
                        (
                          ( id_session =  "'.$data['session'].'" )                           
                         )
            )';   
              
            $this->db->where($where);

            $this->db->order_by('fecha_mac','ASC'); //por el orden en que se agreguen los tamaños
            //$this->db->order_by('id_tamano','ASC');
            
            $info = $this->db->get();
            if ($info->num_rows() > 0) {
                return $info->result();
            }    
            else
                return false;
            $info->free_result();
    } 

  public function revisar_imagenes( $data ){

            $this->db->select("id", FALSE);         
            $this->db->from($this->fotocalendario_imagenes);
    
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_diseno =  '.$data['id_diseno'].' ) AND
                          ( ano =  "'.$data['ano'].'" ) 
                         )
              )';   
  
            $this->db->where($where);
            
            $info = $this->db->get();
            return $info->num_rows();

    }     
      




} 


?>    