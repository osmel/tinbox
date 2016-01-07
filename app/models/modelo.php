<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

	class modelo extends CI_Model{
		
		private $key_hash;
		private $timezone;

		function __construct(){
			parent::__construct();
			$this->load->database("default");
			$this->key_hash    = $_SERVER['HASH_ENCRYPT'];
      $this->timezone    = 'UM1';
      date_default_timezone_set('America/Mexico_City');   

				//usuarios
      			$this->usuarios    = $this->db->dbprefix('usuarios');
            $this->perfiles    = $this->db->dbprefix('perfiles');
            $this->historico_acceso = $this->db->dbprefix('historico_acceso');

            $this->equipos             = $this->db->dbprefix('catalogo_equipo');
            $this->tecnicos    = $this->db->dbprefix('catalogo_tecnico');
            $this->estatus    = $this->db->dbprefix('catalogo_estatus');
            $this->clientes    = $this->db->dbprefix('clientes');
            $this->ordenes    = $this->db->dbprefix('orden');

/*
    Rojo: terminado 
    Verde: “Garantia O Reingreso”,
    Azul claro:  Presupuesto Aceptado, 
    Azul Fuerte: Pendiente, 
    Naranja: Cancelado.
    blanco: "servicios nuevos o reprogramados"
*/

    
		}

		//login
		public function check_login($data){
			$this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);			
			$this->db->select("AES_DECRYPT(contrasena,'{$this->key_hash}') AS contrasena", FALSE);			
			$this->db->select($this->usuarios.'.nombre,'.$this->usuarios.'.apellidos');			
			$this->db->select($this->usuarios.'.id,'.$this->perfiles.'.id_perfil,'.$this->perfiles.'.perfil,'.$this->perfiles.'.operacion');
            
			$this->db->from($this->usuarios);
			$this->db->join($this->perfiles, $this->usuarios.'.id_perfil = '.$this->perfiles.'.id_perfil');
			$this->db->where('contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
			$this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);


			$login = $this->db->get();

			if ($login->num_rows() > 0)
				return $login->result();
			else 
				return FALSE;
			$login->free_result();
		}

        //anadir al historico de acceso
        public function anadir_historico_acceso($data){

            $timestamp = time();
            $ip_address = $this->input->ip_address();
            $user_agent= $this->input->user_agent();

            $this->db->set( 'email', "AES_ENCRYPT('{$data->email}','{$this->key_hash}')", FALSE );
            $this->db->set( 'id_perfil', $data->id_perfil);
            

            $this->db->set( 'id_usuario', $data->id);
            $this->db->set( 'fecha',  gmt_to_local( $timestamp, 'UM1', TRUE) );
            $this->db->set( 'ip_address',  $ip_address, TRUE );
            $this->db->set( 'user_agent',  $user_agent, TRUE );
            

            $this->db->insert($this->historico_acceso );

            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }

       public function total_acceso($limit=-1, $offset=-1){

            $fecha = date_create(date('Y-m-j'));
            date_add($fecha, date_interval_create_from_date_string('-1 month'));
            $data['fecha_inicial'] = date_format($fecha, 'm');
            $data['fecha_final'] = $data['fecha_final'] = (date('m'));


            $this->db->from($this->historico_acceso.' As h');
            $this->db->join($this->usuarios.' As u' , 'u.id = h.id_usuario','LEFT');
            $this->db->join($this->perfiles.' As p', 'u.id_perfil = p.id_perfil','LEFT');

            if  (($data['fecha_inicial']) and ($data['fecha_final'])) {
                $this->db->where( "( CASE WHEN h.fecha = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(h.fecha),'%m') END ) = ", $data['fecha_inicial'] );
                $this->db->or_where( "( CASE WHEN h.fecha = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(h.fecha),'%m') END ) = ", $data['fecha_final'] );
            } 

              

           $unidades = $this->db->get();            
           return $unidades->num_rows();
        }

        //anadir al historico de acceso
        public function historico_acceso($data,$limit=-1, $offset=-1){

            $fecha = date_create(date('Y-m-j'));
            date_add($fecha, date_interval_create_from_date_string('-1 month'));
            $data['fecha_inicial'] = date_format($fecha, 'm');
            $data['fecha_final'] = $data['fecha_final'] = (date('m'));

            $this->db->select("AES_DECRYPT(h.email,'{$this->key_hash}') AS email", FALSE);            
            $this->db->select('p.id_perfil, p.perfil, p.operacion');
            $this->db->select('u.nombre,u.apellidos');         
            $this->db->select('h.ip_address, h.user_agent, h.id_usuario');
            $this->db->select("( CASE WHEN h.fecha = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(h.fecha),'%d-%m-%Y %H:%i:%s') END ) AS fecha", FALSE);   

            $this->db->from($this->historico_acceso.' As h');
            $this->db->join($this->usuarios.' As u' , 'u.id = h.id_usuario','LEFT');
            $this->db->join($this->perfiles.' As p', 'u.id_perfil = p.id_perfil','LEFT');
            

            //gmt_to_local( $timestamp, 'UM1', TRUE) )
            
            if  (($data['fecha_inicial']) and ($data['fecha_final'])) {
                $this->db->where( "( CASE WHEN h.fecha = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(h.fecha),'%m') END ) = ", $data['fecha_inicial'] );
                $this->db->or_where( "( CASE WHEN h.fecha = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(h.fecha),'%m') END ) = ", $data['fecha_final'] );
                
            }     
            

            if ($limit!=-1) {
                $this->db->limit($limit, $offset); 
            } 
              

            $this->db->order_by('h.fecha', 'desc'); 




            $login = $this->db->get();
            if ($login->num_rows() > 0)
                return $login->result();
            else 
                return FALSE;
            $login->free_result();
        }


		
		//Recuperar contraseña		
	    public function recuperar_contrasena($data){
			$this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);						
			$this->db->select('nombre,apellidos');
			$this->db->select("AES_DECRYPT(telefono,'{$this->key_hash}') AS telefono", FALSE);			
			$this->db->select("AES_DECRYPT(contrasena,'{$this->key_hash}') AS contrasena", FALSE);
			$this->db->from($this->usuarios);
			$this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
			$login = $this->db->get();
			if ($login->num_rows() > 0)
				return $login->result();
			else 
				return FALSE;
			$login->free_result();		
	    }	

	
		//Lista de todos los usuarios 

        public function listado_usuarios(  ){

            $this->db->select($this->usuarios.'.id, nombre,  apellidos');

            $this->db->select( "AES_DECRYPT( email,'{$this->key_hash}') AS email", FALSE );
            $this->db->select( "AES_DECRYPT( telefono,'{$this->key_hash}') AS telefono", FALSE );
            $this->db->select($this->perfiles.'.id_perfil,'.$this->perfiles.'.perfil,'.$this->perfiles.'.operacion');
            
            $this->db->from($this->usuarios);
            $this->db->join($this->perfiles, $this->usuarios.'.id_perfil = '.$this->perfiles.'.id_perfil');

            $result = $this->db->get();
            
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();
        }     



 


        public function total_usuarios($uid){

            $this->db->from($this->usuarios);
            $this->db->join($this->perfiles, $this->usuarios.'.id_perfil = '.$this->perfiles.'.id_perfil');
            $this->db->where( $this->usuarios.'.id !=', $uid );
            
           $unidades = $this->db->get();            
           return $unidades->num_rows();
            
        }
   
        public function coger_usuarios($limit=-1, $offset=-1, $uid ){

		    $this->db->select($this->usuarios.'.id, nombre,  apellidos');
            

            $this->db->select( "AES_DECRYPT( email,'{$this->key_hash}') AS email", FALSE );
            $this->db->select( "AES_DECRYPT( telefono,'{$this->key_hash}') AS telefono", FALSE );
			$this->db->select($this->perfiles.'.id_perfil,'.$this->perfiles.'.perfil,'.$this->perfiles.'.operacion');
            
			$this->db->from($this->usuarios);
			$this->db->join($this->perfiles, $this->usuarios.'.id_perfil = '.$this->perfiles.'.id_perfil');
			$this->db->where( $this->usuarios.'.id !=', $uid );
            if ($limit!=-1) {
                $this->db->limit($limit, $offset); 
            } 
             

			$result = $this->db->get();
			
            if ( $result->num_rows() > 0 )
               return $result->result();
            else
               return False;
            $result->free_result();
        }      




      public function total_usua(){
            $id_session = $this->db->escape($this->session->userdata('id'));
            $this->db->from($this->usuarios.' u');
            $this->db->where('u.id <> '.$id_session);
            $cant = $this->db->count_all_results();          
            if ( $cant > 0 )
               return $cant;
            else
               return 0;         
     }     


    public function buscador_usuarios($data){

          $id_session = $this->db->escape($this->session->userdata('id'));
         
          $cadena = addslashes($data['search']['value']);
          $inicio = $data['start'];
          $largo = $data['length'];
          
          $columa_order = $data['order'][0]['column'];
                 $order = $data['order'][0]['dir'];

          switch ($columa_order) {
                   case '0':
                        $columna = 'nombre';
                     break;
                   case '1':
                        $columna = 'p.perfil';
                     break;
                   case '2':
                        $columna = "email";
                     break;
              
                   
                   default:
                        $columna = 'nombre';
                     break;
          }                 


          $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE); //
          
          
            $this->db->select('u.id, nombre,  apellidos');
            $this->db->select('CONCAT(nombre," ", apellidos) nombre_completo', false);
            

            $this->db->select( "AES_DECRYPT( email,'{$this->key_hash}') AS email", FALSE );
            $this->db->select( "AES_DECRYPT( telefono,'{$this->key_hash}') AS telefono", FALSE );
            $this->db->select('p.id_perfil, p.perfil, p.operacion');

            $this->db->from($this->usuarios.' u');
            $this->db->join($this->perfiles.' p', 'u.id_perfil = p.id_perfil');

          //filtro de busqueda
           
          $where = '(
                      ( u.id <> '.$id_session.' ) AND
                      (
                        ( CONCAT(nombre," ", apellidos) LIKE  "%'.$cadena.'%" ) OR (p.perfil LIKE  "%'.$cadena.'%") OR
                        ( AES_DECRYPT( email,"'.$this->key_hash.'") LIKE  "%'.$cadena.'%" ) 
                        
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

              
                  foreach ($result->result() as $row) {

                            $dato[]= array(
                                      
                                      0=>$row->nombre_completo,
                                      1=>$row->perfil,
                                      2=>$row->email,
                                      3=>$row->telefono,
                                      4=>$row->id,
                                      5=>self::usuarios_en_uso($row->id),
                                    );
                      }




                      return json_encode ( array(
                        "draw"            => intval( $data['draw'] ),
                        "recordsTotal"    =>   intval( self::total_usua() ), 
                        "recordsFiltered" =>   $registros_filtrados, 
                        "data"            =>  $dato 
                      ));
                    
              }   
              else {
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




      public function usuarios_en_uso($id_usuario) {

          $result = $this->db->query("
            select distinct r.id_usuario from (
                  (select distinct id_usuario from ".$this->equipos.")
                    union
                  (select distinct id_usuario from ".$this->tecnicos.")
                    union
                  (select distinct id_usuario from ".$this->estatus.")
                    union
                  (select distinct id_usuario from ".$this->clientes.")
                    union
                  (select distinct id_usuario from ".$this->ordenes.")
              ) r 
           where r.id_usuario='".$id_usuario."'                                

          "
          );  

           if ( $result->num_rows() > 0 ) {
                  return 1;
              } else 
                  return 0;
            $result->free_result();                 

      }    





        //eliminar usuarios
        public function borrar_usuario( $uid ){
            $this->db->delete( $this->usuarios, array( 'id' => $uid ) );
            if ( $this->db->affected_rows() > 0 ) return TRUE;
            else return FALSE;
        }



        //editar	
        public function coger_catalogo_usuario( $uid ){
            $this->db->select('id, nombre, apellidos, id_perfil');
            $this->db->select( "AES_DECRYPT( email,'{$this->key_hash}') AS email", FALSE );
            $this->db->select( "AES_DECRYPT( telefono,'{$this->key_hash}') AS telefono", FALSE );
            $this->db->select( "AES_DECRYPT( contrasena,'{$this->key_hash}') AS contrasena", FALSE );
            $this->db->where('id', $uid);
            $result = $this->db->get($this->usuarios );
            if ($result->num_rows() > 0)
            	return $result->row();
            else 
            	return FALSE;
            $result->free_result();
        }  


		public function check_correo_existente($data){
			$this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);			
			$this->db->from($this->usuarios);
			$this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
			$login = $this->db->get();
			if ($login->num_rows() > 0)
				return FALSE;
			else
				return TRUE;
			$login->free_result();
		}

		public function anadir_usuario( $data ){
            $timestamp = time();

            $id_session = $this->session->userdata('id');
            //$fecha_hoy = date('Y-m-d H:i:s');  
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'id_usuario',  $id_session );

            $this->db->set( 'id', "UUID()", FALSE);
			$this->db->set( 'nombre', $data['nombre'] );
            $this->db->set( 'apellidos', $data['apellidos'] );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'id_perfil', $data['id_perfil']);
            
            

            $this->db->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'creacion',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->insert($this->usuarios );

            if ($this->db->affected_rows() > 0){
            		return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
            
        }

		public function check_usuario_existente($data){
			
			$this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);			
			$this->db->from($this->usuarios);
			$this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
			$this->db->where('id !=',$data['id']);
			$login = $this->db->get();
			if ($login->num_rows() > 0)
				return FALSE;
			else
				return TRUE;
			$login->free_result();
		}        



        



        public function edicion_usuario( $data ){

            $timestamp = time();

            $id_session = $this->session->userdata('id');
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'id_usuario',  $id_session );

			$this->db->set( 'nombre', $data['nombre'] );
            $this->db->set( 'apellidos', $data['apellidos'] );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'id_perfil', $data['id_perfil']);
            
            

            
            $this->db->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );
            $this->db->where('id', $data['id'] );
            $this->db->update($this->usuarios );
            if ($this->db->affected_rows() > 0) {
				return TRUE;
			}  else
				 return FALSE;
        }		


//----------------**************catalogos-------------------************------------------
        public function coger_catalogo_perfiles(){
            $this->db->select( 'id_perfil, perfil, operacion' );
            $perfiles = $this->db->get($this->perfiles );
            if ($perfiles->num_rows() > 0 )
                 return $perfiles->result();
            else
                 return FALSE;
            $perfiles->free_result();
        }           

	} 
?>