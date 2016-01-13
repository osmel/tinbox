<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

	class modelo_catalogo extends CI_Model {
		
		private $key_hash;
		private $timezone;

		function __construct(){

			parent::__construct();
			$this->load->database("default");
			$this->key_hash    = $_SERVER['HASH_ENCRYPT'];
      $this->timezone    = 'UM1';
      date_default_timezone_set('America/Mexico_City');   

        $this->equipos             = $this->db->dbprefix('catalogo_equipo');
        $this->tecnicos    = $this->db->dbprefix('catalogo_tecnico');
        $this->estatus    = $this->db->dbprefix('catalogo_estatus');
        $this->clientes    = $this->db->dbprefix('clientes');
        $this->ordenes    = $this->db->dbprefix('orden');


    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////TECNICOS//////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////



        public function total_cat_tecnicos(){
              $id_session = $this->session->userdata('id');
              $this->db->from($this->tecnicos.' as c');
              $cant = $this->db->count_all_results();          
              if ( $cant > 0 )
                 return $cant;
              else
                 return 0;         
       }     


      public function buscador_cat_tecnicos($data){

          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];

          switch ($columa_order) {
                   case '0':
                        $columna = 'c.tecnico';
                     break;
                   
                   default:
                        $columna = 'c.tecnico';
                     break;
                 }                 

                                      

          $id_session = $this->db->escape($this->session->userdata('id'));

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          
          $this->db->select('c.id, c.tecnico');

          $this->db->from($this->tecnicos.' as c');
          
          //filtro de busqueda
       
          $where = '(

                      (
                        ( c.id LIKE  "%'.$cadena.'%" ) OR (c.tecnico LIKE  "%'.$cadena.'%")
                        
                       )
            )';   



  
          $this->db->where($where);
    
          //ordenacion
          $this->db->order_by($columna, $order); 

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                      0=>$row->id,
                                      1=>$row->tecnico,
                                      2=>self::tecnicos_en_uso($row->id),
                                    );
                      }




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => intval( self::total_cat_tecnicos() ), 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  //cuando este vacio la tabla que envie este
                //http://www.datatables.net/forums/discussion/21311/empty-ajax-response-wont-render-in-datatables-1-10
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      } 



public function tecnicos_en_uso($id_tecnico) {

          $result = $this->db->query("
            select distinct r.id_tecnico from (

            (select distinct id_tecnico from ".$this->ordenes.")
              ) r 
           where r.id_tecnico='".$id_tecnico."'                                

          "
          );  

           if ( $result->num_rows() > 0 ) {
                  return 1;
              } else 
                  return 0;
            $result->free_result();                 

      }    

 //checar si el tecnico ya existe
    public function check_existente_tecnico($data){
            $this->db->select("id", FALSE);         
            $this->db->from($this->tecnicos);
            $this->db->where('tecnico',$data['tecnico']);  
            $this->db->where('estatus',"0");
            $login = $this->db->get();
            if ($login->num_rows() > 0)
                return true;
            else
                return false;
            $login->free_result();
    } 



     public function coger_tecnico( $data ){
              
            $this->db->select("c.id, c.tecnico");         
            $this->db->from($this->tecnicos.' As c');
            $this->db->where('c.id',$data['id']);
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->row();
                else 
                    return FALSE;
                $result->free_result();
     }  

      //crear
        public function anadir_tecnico( $data ){
          $id_session = $this->session->userdata('id');
          $this->db->set( 'id_usuario',  $id_session );
          $this->db->set( 'tecnico', $data['tecnico'] );  

            $this->db->insert($this->tecnicos );
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }          


        //editar
        public function editar_tecnico( $data ){

          $id_session = $this->session->userdata('id');
          $this->db->set( 'id_usuario',  $id_session );

          $this->db->set( 'tecnico', $data['tecnico'] );  
          $this->db->where('id', $data['id'] );
          $this->db->update($this->tecnicos );
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            }  else
                 return FALSE;
                $result->free_result();
        }   


        //eliminar tecnico
        public function eliminar_tecnico( $data ){
            $this->db->delete( $this->tecnicos, array( 'id' => $data['id'] ) );
            if ( $this->db->affected_rows() > 0 ) return TRUE;
            else return FALSE;
        }     




    ////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////EQUIPOS//////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////



        public function total_cat_equipos(){
              $id_session = $this->session->userdata('id');
              $this->db->from($this->equipos.' as c');
              $cant = $this->db->count_all_results();          
              if ( $cant > 0 )
                 return $cant;
              else
                 return 0;         
       }     


      public function buscador_cat_equipos($data){

          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];

          switch ($columa_order) {
                   case '0':
                        $columna = 'c.equipo';
                     break;
                   
                   default:
                        $columna = 'c.equipo';
                     break;
                 }                 

                                      

          $id_session = $this->db->escape($this->session->userdata('id'));

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          
          $this->db->select('c.id, c.equipo');

          $this->db->from($this->equipos.' as c');
          
          //filtro de busqueda
       
          $where = '(

                      (
                        (c.equipo LIKE  "%'.$cadena.'%")
                        
                       )
            )';   



  
          $this->db->where($where);
    
          //ordenacion
          $this->db->order_by($columna, $order); 

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                      0=>$row->id,
                                      1=>$row->equipo,
                                      2=>self::equipos_en_uso($row->id),
                                    );
                      }




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => intval( self::total_cat_equipos() ), 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  //cuando este vacio la tabla que envie este
                //http://www.datatables.net/forums/discussion/21311/empty-ajax-response-wont-render-in-datatables-1-10
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      } 



public function equipos_en_uso($id_equipo) {

          $result = $this->db->query("
            select distinct r.id_equipo from (
                  (select distinct id_equipo from ".$this->clientes.")
              ) r 
           where r.id_equipo='".$id_equipo."'                                

          "
          );  

           if ( $result->num_rows() > 0 ) {
                  return 1;
              } else 
                  return 0;
            $result->free_result();                 

      }    

 //checar si el equipo ya existe
    public function check_existente_equipo($data){
            $this->db->select("id", FALSE);         
            $this->db->from($this->equipos);
            $this->db->where('equipo',$data['equipo']);  
            $this->db->where('estatus',"0");
            $login = $this->db->get();
            if ($login->num_rows() > 0)
                return true;
            else
                return false;
            $login->free_result();
    } 



     public function coger_equipo( $data ){
              
            $this->db->select("c.id, c.equipo");         
            $this->db->from($this->equipos.' As c');
            $this->db->where('c.id',$data['id']);
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->row();
                else 
                    return FALSE;
                $result->free_result();
     }  

      //crear
        public function anadir_equipo( $data ){
          $id_session = $this->session->userdata('id');
          $this->db->set( 'id_usuario',  $id_session );
          $this->db->set( 'equipo', $data['equipo'] );  

            $this->db->insert($this->equipos );
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }          


        //editar
        public function editar_equipo( $data ){

          $id_session = $this->session->userdata('id');
          $this->db->set( 'id_usuario',  $id_session );

          $this->db->set( 'equipo', $data['equipo'] );  
          $this->db->where('id', $data['id'] );
          $this->db->update($this->equipos );
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            }  else
                 return FALSE;
                $result->free_result();
        }   


        //eliminar equipo
        public function eliminar_equipo( $data ){
            $this->db->delete( $this->equipos, array( 'id' => $data['id'] ) );
            if ( $this->db->affected_rows() > 0 ) return TRUE;
            else return FALSE;
        }     






  ////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////estatus//////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////



        public function total_cat_estatus(){
              $id_session = $this->session->userdata('id');
              $this->db->from($this->estatus.' as c');
              $cant = $this->db->count_all_results();          
              if ( $cant > 0 )
                 return $cant;
              else
                 return 0;         
       }     


      public function buscador_cat_estatus($data){

          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          

          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];

          switch ($columa_order) {
                   case '0':
                        $columna = 'c.estatu';
                     break;
                   
                   default:
                        $columna = 'c.estatu';
                     break;
                 }                 

                                      

          $id_session = $this->db->escape($this->session->userdata('id'));

          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          
          $this->db->select('c.id, c.estatu');

          $this->db->from($this->estatus.' as c');
          
          //filtro de busqueda
       
          $where = '(

                      (
                        (c.estatu LIKE  "%'.$cadena.'%")
                        
                       )
            )';   



  
          $this->db->where($where);
    
          //ordenacion
          $this->db->order_by($columna, $order); 

          //paginacion
          $this->db->limit($largo,$inicio); 


          $result = $this->db->get();

              if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                  $retorno= " ";  
                  foreach ($result->result() as $row) {
                               $dato[]= array(
                                      0=>$row->id,
                                      1=>$row->estatu,
                                      2=>self::estatus_en_uso($row->id),
                                    );
                      }




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    => intval( self::total_cat_estatus() ), 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
                  //cuando este vacio la tabla que envie este
                //http://www.datatables.net/forums/discussion/21311/empty-ajax-response-wont-render-in-datatables-1-10
                  $output = array(
                  "draw" =>  intval( $data['draw'] ),
                  "recordsTotal" => 0,
                  "recordsFiltered" =>0,
                  "aaData" => array()
                  );
                  $array[]="";
                  return json_encode($output);
                  

              }

              $result->free_result();           

      } 



public function estatus_en_uso($id_estatus) {


          $result = $this->db->query("
            select distinct r.id_estatus from (

            (select distinct id_estatus from ".$this->clientes.")
              union   

            (select distinct id_estatus from ".$this->ordenes.")
              ) r 
           where r.id_estatus='".$id_estatus."'                                

          "
          );  

           if ( $result->num_rows() > 0 ) {
                  return 1;
              } else 
                  return 0;
            $result->free_result();                 

      }    

 //checar si el estatu ya existe
    public function check_existente_estatu($data){
            $this->db->select("id", FALSE);         
            $this->db->from($this->estatus);
            $this->db->where('estatu',$data['estatu']);  
            $this->db->where('estatus',"0");
            $login = $this->db->get();
            if ($login->num_rows() > 0)
                return true;
            else
                return false;
            $login->free_result();
    } 



     public function coger_estatu( $data ){
              
            $this->db->select("c.id, c.estatu");         
            $this->db->from($this->estatus.' As c');
            $this->db->where('c.id',$data['id']);
            $result = $this->db->get(  );
                if ($result->num_rows() > 0)
                    return $result->row();
                else 
                    return FALSE;
                $result->free_result();
     }  

      //crear
        public function anadir_estatu( $data ){
          $id_session = $this->session->userdata('id');
          $this->db->set( 'id_usuario',  $id_session );
          $this->db->set( 'estatu', $data['estatu'] );  

            $this->db->insert($this->estatus );
            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }          


        //editar
        public function editar_estatu( $data ){

          $id_session = $this->session->userdata('id');
          $this->db->set( 'id_usuario',  $id_session );

          $this->db->set( 'estatu', $data['estatu'] );  
          $this->db->where('id', $data['id'] );
          $this->db->update($this->estatus );
            if ($this->db->affected_rows() > 0) {
                return TRUE;
            }  else
                 return FALSE;
                $result->free_result();
        }   


        //eliminar estatu
        public function eliminar_estatu( $data ){
            $this->db->delete( $this->estatus, array( 'id' => $data['id'] ) );
            if ( $this->db->affected_rows() > 0 ) return TRUE;
            else return FALSE;
        }     


        public function todos_equipos(){
            $this->db->select( 'id, equipo' );
            $perfiles = $this->db->get($this->equipos );
            if ($perfiles->num_rows() > 0 )
                 return $perfiles->result();
            else
                 return FALSE;
            $perfiles->free_result();
        }         

        public function todos_estatus(){
            $this->db->select( 'id, estatu' );
            $perfiles = $this->db->get($this->estatus );
            if ($perfiles->num_rows() > 0 )
                 return $perfiles->result();
            else
                 return FALSE;
            $perfiles->free_result();
        }         

        public function todos_tecnicos(){
            $this->db->select( 'id, tecnico' );
            $perfiles = $this->db->get($this->tecnicos );
            if ($perfiles->num_rows() > 0 )
                 return $perfiles->result();
            else
                 return FALSE;
            $perfiles->free_result();
        }         



	} 


?>
