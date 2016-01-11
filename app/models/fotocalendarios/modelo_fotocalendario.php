<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
  class modelo_fotocalendario extends CI_Model{
    
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
 public function correo_logueo($data){
            $this->db->select("id, id_session, correo, id_diseno, id_tamano, fecha_mac");         
            $this->db->from($this->logueo_identificador);
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" )                           
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




 //correo logueo
 public function calenda_activos($data){
            $this->db->select("id_tamano");         
            $this->db->from($this->fotocalendario_temporal);
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" )                           
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






 
    /////////////////////////////////////////////    
    /////////////////////////////////////////////
    public function listado_listas($data){
            $this->db->select("l.id, l.id_session, l.correo, l.nombre");         
            $this->db->from($this->fotocalendario_lista.' As l');
            $this->db->where('l.correo',$data['correo_activo']);
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
     }  
     
  public function listadias_cambiar($data){
            $this->db->select("l.id, l.id_session, l.correo, l.nombre");         
            $this->db->select("d.ano, d.mes, d.dia, d.valor");         
            $this->db->from($this->fotocalendario_lista.' As l');
            $this->db->join($this->lista_fechas_especiales.' As d', 'l.id = d.id_lista','LEFT');
      $where = '(
                      (
                        ( l.correo =  '.$data['correo_activo'].' ) AND ( l.id =  '.$data['id_lista'].' )  
                       )
            )';   


      $this->db->where($where);
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
    }            
 public function listames_cambiar($data){
            $this->db->select("l.id, l.id_session, l.correo, l.nombre");         
            $this->db->select("m.ano, m.mes,  m.valor");         
            $this->db->from($this->fotocalendario_lista.' As l');
            $this->db->join($this->lista_nombre_meses.' As m', 'l.id = m.id_lista','LEFT');
            $where = '(
                            (
                              ( l.correo =  '.$data['correo_activo'].' ) AND ( l.id =  '.$data['id_lista'].' ) 
                             )
                  )';   
            $this->db->where($where);
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
    }             
    ///////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////
     public function listado_logos( ){
              
            $this->db->select("l.id, l.nombre,l.tooltip ");         
            $this->db->from($this->catalogo_logo.' As l');
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
     }  
     public function listado_festividades( ){
              
            $this->db->select("f.id, f.nombre");         
            $this->db->from($this->catalogo_festividad.' As f');
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
     }   




///////////////////Leer los datos sobre el calendario activo//////////////////////////
    public function fotocalendario_edicion($data){
            $this->db->select("id, id_session,cantDiseno, movposicion, id_diseno, id_tamano");         
            $this->db->select("titulo, nombre, apellidos");         
            $this->db->select("id_mes, id_dia, id_festividad, id_ano, id_lista, logo, coleccion_id_logo, fecha");         
            //, id_mes, id_dia, id_festividad, id_ano, id_lista, logo, coleccion_id_logo, fecha
            $this->db->from($this->fotocalendario_temporal);
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_tamano =  '.$data['id_tamano'].' ) 
                          
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

///////////////////checar si existe el dato q voy agregar//////////////////////////
    public function check_existente_fotocalendario($data){
            $this->db->select("id_session, id_tamano", FALSE);         
            $this->db->from($this->fotocalendario_temporal);
            $where = '(
                        (
                          ( id_session =  "'.$data['id_session'].'" ) AND
                          ( id_tamano =  '.$data['id_tamano'].' ) 
                          
                         )
              )';   
  
            $this->db->where($where);
            
            $info = $this->db->get();
            if ($info->num_rows() > 0) {
                $fila = $info->row(); 
                return $fila->id_session;
            }    
            else
                return false;
            $info->free_result();
    } 


////////////////////////////eliminar/////////////////////////////
    public function eliminar_fotocalendario( $data ){
        $this->db->delete( $this->fotocalendario_temporal, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }
    public function eliminar_listadias( $data ){
        $this->db->delete( $this->fechas_especiales, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }
    public function eliminar_nombre_mes( $data ){
        $this->db->delete( $this->nombre_meses, array( 'id_session' => $data['id_session'],  'id_tamano' => $data['id_tamano'] ) );
        if ( $this->db->affected_rows() > 0 ) return TRUE;
        else return FALSE;
    }


     //fin de catalogos
    //Fotocalendario
     public function anadir_fotocalendario($data){
          
         //id, uid_fotocalendario,
         //** id_diseno, id_tamano,
         // titulo, nombre, apellidos, id_mes, id_dia, id_festividad, 
         //"id_ano", id_lista, 
         //logo, coleccion_id_logo 
         //, fecha
          
          //$this->db->set( 'id_diseno', $data['id_diseno'] );  //
          //$this->db->set( 'cantDiseno', $data['cantDiseno'] );  //
          //$this->db->set( 'movposicion', $data['movposicion'] );  //
                

          $this->db->set( 'id_session', $data['id_session'] );  //
          $this->db->set( 'id_tamano', $data['id_tamano'] );  //
          
          $this->db->set( 'titulo', $data['titulo'] );  
          $this->db->set( 'nombre', $data['nombre'] );  
          $this->db->set( 'apellidos', $data['apellidos'] );  

          $this->db->set( 'id_dia', $data['id_dia'] );  
          $this->db->set( 'id_mes', $data['id_mes'] );  
          $this->db->set( 'id_festividad', $data['id_festividad'] );  

          if (isset($data['id_lista'])) {
              $this->db->set( 'id_lista', $data['id_lista'] );  
          }    
          //$this->db->set( 'logo', $data['logo'] );  //
          if  (isset($data['logo'])) {
                $this->db->set( 'logo', $data['logo']['file_name']);          
           }  
          $this->db->set( 'coleccion_id_logo', $data['coleccion_id_logo'] );  
            $this->db->insert($this->fotocalendario_temporal);
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
     }

     public function anadir_nombre_mes($data){
         
          foreach ($data['nombre_mes'] as $llave => $valor) {
            if (isset($valor['ano'])) {
                 $this->db->set( 'id_session', $data['id_session'] );  
                 $this->db->set( 'id_tamano', $data['id_tamano'] );  //

                 $this->db->set( 'ano', $valor['ano'] );  
                 $this->db->set( 'mes', $valor['mes'] );  //+1
                 $this->db->set( 'valor', $valor['valor'] );  
                 $this->db->insert($this->nombre_meses);
             }    
            } 
            
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
     } 

      public function anadir_listadias($data){
          foreach ($data['listadias'] as $llave => $valor) {
               $this->db->set( 'id_session', $data['id_session'] );  
               $this->db->set( 'id_tamano', $data['id_tamano'] );  //

               $this->db->set( 'ano', $valor['ano'] );  
               $this->db->set( 'mes', $valor['mes'] );   //+1
               $this->db->set( 'dia', $valor['dia'] );  
               $this->db->set( 'valor', $valor['valor'] );  
               $this->db->insert($this->fechas_especiales);
            } 
            
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
      }       
     
     //fin del fotocalendario
/////////////////////////ver lista de un diseño particular////////////////////////////////////
  public function listadias_fcalendario($data){
            $this->db->select("d.ano, d.mes, d.dia, d.valor");         
            //$this->db->from($this->fotocalendario_temporal.' As l');
            //$this->db->join($this->fechas_especiales.' As d', 'd.id_session = l.id_session','LEFT');
            $this->db->from($this->fechas_especiales.' As d');
            $where = '(
                      (
                        ( d.id_session =  "'.$data['id_session'].'" ) AND
                          ( d.id_tamano =  '.$data['id_tamano'].' )  

                       )
            )';   
          


           $this->db->where($where);
            $result = $this->db->get( );
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
    }            
 public function listames_fcalendario($data){
            
            $this->db->select("m.ano, m.mes,  m.valor");         
            //$this->db->from($this->fotocalendario_temporal.' As l');
            //$this->db->join($this->nombre_meses.' As m', 'm.id_session = l.id_session','LEFT');

            $this->db->from($this->nombre_meses.' As m');

            $where = '(
                            (
                              ( m.id_session =  "'.$data['id_session'].'" ) AND
                              ( m.id_tamano =  '.$data['id_tamano'].' ) 
                             )
                  )';   
            $this->db->where($where);
            $result = $this->db->get();
                if ($result->num_rows() > 0)
                    return $result->result();
                else 
                    return FALSE;
                $result->free_result();
    }                 

///////////////////////fin de eliminar ///////////////////////////      
     //listas
     public function anadir_lista($data){
           $this->db->set( 'id_session', $data['id_session'] );  
           $this->db->set( 'nombre', $data['nombre_lista'] );  
           $this->db->set( 'correo', $data['correo_lista'] );   //+1
           $this->db->insert($this->fotocalendario_lista);
          
          if ($this->db->affected_rows() > 0){
                    //return TRUE;
                    return $this->db->insert_id();
                } else {
                    return FALSE;
                }
                $result->free_result();
     }
      public function anadir_lista_listadias($data){
          foreach ($data['listadias'] as $llave => $valor) {
               $this->db->set( 'id_session', $data['id_session'] );  
               $this->db->set( 'ano', $valor['ano'] );  
               $this->db->set( 'mes', $valor['mes'] );   //+1
               $this->db->set( 'dia', $valor['dia'] );  
               $this->db->set( 'valor', $valor['valor'] );  

               $this->db->set( 'id_lista', $data['id_lista'] );  

               


               $this->db->insert($this->lista_fechas_especiales);
            } 
            
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
      }       
     
     public function anadir_lista_nombre_mes($data){
         
          foreach ($data['nombre_mes'] as $llave => $valor) {
            if (isset($valor['ano'])) {
                 $this->db->set( 'id_session', $data['id_session'] );  
                 $this->db->set( 'ano', $valor['ano'] );  
                 $this->db->set( 'mes', $valor['mes'] );  //+1
                 $this->db->set( 'valor', $valor['valor'] );  
                 
                 $this->db->set( 'id_lista', $data['id_lista'] );  

                 $this->db->insert($this->lista_nombre_meses);
             }    
            } 
            
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
      } 
     //fin de la lista


    
  } 


?>