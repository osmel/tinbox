<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){ 
		parent::__construct();
		
		$this->load->model('modelo', 'modelo'); 
		$this->load->model('modelo_fotocalendario', 'modelo_fotocalendario'); 

		$this->load->library(array('email')); 
        $this->load->library('Jquery_pagination');//-->la estrella del equipo		
	}





	public function index(){

		if ( $this->session->userdata( 'session' ) !== TRUE ){
			$this->sitio();
		} else {
			//$this->dashboard();
		}
	}



	public function fotoimagen($session){
		//$this->load->view( 'sitio/home' );
		//$this->load->view( 'sitio/home' );
		
		$session = base64_decode($session);
		$this->load->view( 'sitio/croppear' );
		
	}


	public function fotocalendario(){


			//ir a la seccion de imagen	   

		if (isset($_POST['finalizar'])) {
				$data['finalizar']   = $_POST['finalizar'];

				if ($data['finalizar']=='Continuar') {
					redirect('http://localhost/tinbox/fotoimagen/'.base64_encode($_POST['id_session']));
				}
		}		
		
		$data['festividades'] = $this->modelo_fotocalendario->listado_festividades();
		$data['logos'] = $this->modelo_fotocalendario->listado_logos();
		

						$data['correo_activo']   = 'osmel@gmail.com';
			   	   
	      $data['cantDiseno_original']   = 1; //5;
			   	   $data['cantDiseno']   = 1; //5;
			   $data['posicionDiseno']   = 1;
			      $data['movposicion']   = 1;
			   
			       $data['id_session']   = '';

			   //$data['array_eliminar'] = '4,5,6';
			   $data['array_eliminar'] = '';
			   
			   


		if (isset($_POST['posicionDiseno'])) {

				$data['correo_activo']   = $_POST['correo_activo'];//$this->input->post('nombre_mes');
		  $data['cantDiseno_original']   = $_POST['cantDiseno_original']; //$this->input->post('cantDiseno');
			   	   $data['cantDiseno']   = $_POST['cantDiseno']; //$this->input->post('cantDiseno');
			   $data['posicionDiseno']   = $_POST['posicionDiseno']; //$this->input->post('posicionDiseno');
			      $data['movposicion']   = $_POST['movposicion']; //$this->input->post('posicionDiseno');

			   $data['id_session']   	 = $_POST['id_session']; //$this->input->post('posicionDiseno');
			   $data['array_eliminar']   = $_POST['array_eliminar']; //$this->input->post('posicionDiseno');
			    







		} 
		


		$data['calendario']          = $this->modelo_fotocalendario->fotocalendario_edicion( $data );
		//si hay un correo regristrado q busque listado existentes
		$data['listas'] = $this->modelo_fotocalendario->listado_listas($data);


		if ($data['cantDiseno']!=0) {
			$this->load->view( 'sitio/fotocalendario/seccion3', $data );	
		} else { //si eliminan todo retornar a elegir diseño
			redirect('http://localhost/tinbox');
		}
		
	}



	public function diseno_lista(){
		
         	  $data['uid_fotocalendario']   = $this->input->post('uid_fotocalendario');	

     	      $dato['listas_dia'] = $this->modelo_fotocalendario->listadias_fcalendario($data);
      		  $dato['list_mes'] = $this->modelo_fotocalendario->listames_fcalendario($data);

		      	   
		      	   
		      	   

				    $list_dia = array();
				    if ($dato['listas_dia'] != false)  {     
				         foreach( (json_decode(json_encode($dato['listas_dia']))) as $clave =>$valor ) {
				              array_push($list_dia,array('ano' => $valor->ano, 'mes' => $valor->mes, 'dia' => $valor->dia,'valor' => $valor->valor));  
				       }
				    } 

				    //127JGsB469
				    $list_mes = array();
				    if ($dato['list_mes'] != false)  {     
				         foreach( (json_decode(json_encode($dato['list_mes']))) as $clave =>$valor ) {
				              array_push($list_mes,array('ano' => $valor->ano, 'mes' => $valor->mes,'valor' => $valor->valor));  
				       }
				    } 




              $todo = array (
                "list_dia" => $list_dia,
                "list_mes"  => $list_mes
	          );              
             
             echo json_encode($todo);    

		    // d.ano, d.mes, d.dia, d.valor
		     //echo json_encode($list_dia);
      	   //echo true;

	}



	public function leer_lista(){
		
         	  $data['correo_activo']   = $this->input->post('correo_activo');

		      	   $data['id_lista']   = $this->input->post('id_lista');
		      	   
		      	   $dato['listas_dia'] = $this->modelo_fotocalendario->listadias_cambiar($data);
		      	   $dato['list_mes'] = $this->modelo_fotocalendario->listames_cambiar($data);

				    $list_dia = array();
				    if ($dato['listas_dia'] != false)  {     
				         foreach( (json_decode(json_encode($dato['listas_dia']))) as $clave =>$valor ) {
				              array_push($list_dia,array('ano' => $valor->ano, 'mes' => $valor->mes, 'dia' => $valor->dia,'valor' => $valor->valor));  
				       }
				    } 

				    //127JGsB469
				    $list_mes = array();
				    if ($dato['list_mes'] != false)  {     
				         foreach( (json_decode(json_encode($dato['list_mes']))) as $clave =>$valor ) {
				              array_push($list_mes,array('ano' => $valor->ano, 'mes' => $valor->mes,'valor' => $valor->valor));  
				       }
				    } 




              $todo = array (
                "list_dia" => $list_dia,
                "list_mes"  => $list_mes
	          );              
             
             echo json_encode($todo);    

		    // d.ano, d.mes, d.dia, d.valor
		     //echo json_encode($list_dia);
      	   //echo true;

	}


	

	public function validar_nuevo_fotocalendario(){
	
	      $this->form_validation->set_rules('titulo', 'Título', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');
/*
	      $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');
	      $this->form_validation->set_rules('apellidos', 'Apellidos', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');
*/
	      //*$this->form_validation->set_rules('coleccion_id_logo', 'coleccion_id_logo', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');
/*
	      $this->form_validation->set_rules('id_dia', 'Día', 'trim|required|xss_clean');
	      $this->form_validation->set_rules('id_mes', 'Mes', 'trim|required|xss_clean');
	      $this->form_validation->set_rules('id_festividad', 'Festividades', 'trim|required|xss_clean');
*/

	      if ($this->form_validation->run() === TRUE){
	            echo true;
	      } else {      
	        echo validation_errors('<span class="error">','</span>');

	      }
	
	}

	function noguardar_lista() {

	          //generar uid

 		 	  $data['uid_fotocalendario']   = 'FCAL'.date('Y').date('m').date('d').random_string('alpha',3).random_string('numeric',4);                		
 		 	  $data['uid_lista']  			= 'LFCAL'.date('Y').date('m').date('d').random_string('alpha',3).random_string('numeric',4);                		

	          
 		 	  
 		 	  if (!empty($_FILES)) {

		          $config_adjunto['upload_path']    = './uploads/fotocalendario/';
		          $config_adjunto['allowed_types']  = 'jpg|png|gif|jpeg';
		          $config_adjunto['max_size']     = '20480';
		          $config_adjunto['file_name']    = 'img_'.$data['uid_fotocalendario'];
		          $config_adjunto['overwrite']    = true;

		          $this->load->library('upload', $config_adjunto);

		          //$this->upload->do_upload(); 

					foreach ($_FILES as $key => $value) {
					    if ($this->upload->do_upload($key)) {
								$data['logo'] = $this->upload->data();		
						} else {
							$data['logo']['file_name'] =$this->input->post('ca_logo');
						}					  	
					} 	          

					
					

		          
		      }   



	          //el true al final es para convertirlo a Array de lo contrario será objeto
        	  $data['listadias']   = json_decode($this->input->post('listadias'),true);
		      $data['nombre_mes']   = json_decode($this->input->post('nombre_mes'),true);

		      //este es en caso de que se necesite guardar la lista
		      $data['nombre_lista']   = $this->input->post('nombre_lista');
		      $data['correo_lista']   = $this->input->post('correo_lista');


		      //id_session activa
		      $data['id_session']   = $this->input->post('id_session');
		      if ($data['id_session']=='') {
   		 		 	  $data['id_session']   = 'SCAL'.date('Y').date('m').date('d').random_string('alpha',3).random_string('numeric',4);                		
		      }

		      $data['cantDiseno']   = $this->input->post('cantDiseno');
		      $data['movposicion']   = $this->input->post('movposicion');


		      $data['id_diseno']   =  1; //$this->input->post('id_diseno');
		      $data['id_tamano']   =  1; // $this->input->post('id_tamano');

		      //datos personales
		      $data['titulo']   = $this->input->post('titulo');
		      $data['nombre']   = $this->input->post('nombre');
		      $data['apellidos']   = $this->input->post('apellidos');
		      //$data['logo']   =  'prueba.jpg'; // $this->input->post('logo');
		      $data['coleccion_id_logo']   =  json_encode($this->input->post('coleccion_id_logo'));
		      $data['id_dia']   = $this->input->post('id_dia');
		      $data['id_mes']   = $this->input->post('id_mes');
		      $data['id_festividad']   = $this->input->post('id_festividad');


	          $data             =   $this->security->xss_clean($data);  

	          $checar          = $this->modelo_fotocalendario->check_existente_fotocalendario( $data );
				
			   //si existe ya registros borrarlos para crear nuevo		          
	          if ($checar!=false) {
	        	  $eliminar          = $this->modelo_fotocalendario->eliminar_nombre_mes( $checar );
		          $eliminar          = $this->modelo_fotocalendario->eliminar_listadias( $checar );
		          $eliminar          = $this->modelo_fotocalendario->eliminar_fotocalendario( $checar );
	          }

	          $guardar          = $this->modelo_fotocalendario->anadir_nombre_mes( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_listadias( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_fotocalendario( $data );

	          if ( $guardar !== FALSE ){
	            echo true;
	          } else {
	            echo '<span class="error"><b>E01</b> - El nuevo fotocalendario no pudo ser agregado</span>';
	          }
	



	  	  //echo true;


	}    


	function guardar_lista() {
		

		  //este es en caso de que se necesite guardar la lista	
		  $this->form_validation->set_rules('nombre_lista', 'Nombre', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');
		  $this->form_validation->set_rules( 'correo_lista', 'Correo', 'trim|required|valid_email|xss_clean');

		  //print_r($_FILES);

 		 if ($this->form_validation->run() === TRUE){

	          //generar uid

 		 	  $data['uid_fotocalendario']   = 'FCAL'.date('Y').date('m').date('d').random_string('alpha',3).random_string('numeric',4);                		
 		 	  $data['uid_lista']  			= 'LFCAL'.date('Y').date('m').date('d').random_string('alpha',3).random_string('numeric',4);                		

	          
 		 	  if (!empty($_FILES)) {
		          $config_adjunto['upload_path']    = './uploads/fotocalendario/';
		          $config_adjunto['allowed_types']  = 'jpg|png|gif|jpeg';
		          $config_adjunto['max_size']     = '20480';
		          $config_adjunto['file_name']    = 'img_'.$data['uid_fotocalendario'];
		          $config_adjunto['overwrite']    = true;

		          $this->load->library('upload', $config_adjunto);


					foreach ($_FILES as $key => $value) {
					    if ($this->upload->do_upload($key)) {
								$data['logo'] = $this->upload->data();		
						} else {
							$data['logo']['file_name'] =$this->input->post('ca_logo');
						}					  	
					} 	          



		       }    



	          //el true al final es para convertirlo a Array de lo contrario será objeto
        	  $data['listadias']   = json_decode($this->input->post('listadias'),true);
		      $data['nombre_mes']   = json_decode($this->input->post('nombre_mes'),true);

		      //este es en caso de que se necesite guardar la lista
		      $data['nombre_lista']   = $this->input->post('nombre_lista');
		      $data['correo_lista']   = $this->input->post('correo_lista');


		      //id_session activa
		      $data['id_session']   = $this->input->post('id_session');
		      if ($data['id_session']=='') {
   		 		 	  $data['id_session']   = 'SCAL'.date('Y').date('m').date('d').random_string('alpha',3).random_string('numeric',4);                		
		      }

		      $data['cantDiseno']   = $this->input->post('cantDiseno');
		      $data['movposicion']   = $this->input->post('movposicion');


		      $data['id_diseno']   =  1; //$this->input->post('id_diseno');
		      $data['id_tamano']   =  1; // $this->input->post('id_tamano');

		      //datos personales
		      $data['titulo']   = $this->input->post('titulo');
		      $data['nombre']   = $this->input->post('nombre');
		      $data['apellidos']   = $this->input->post('apellidos');
		      //$data['logo']   =  'prueba.jpg'; // $this->input->post('logo');
		      $data['coleccion_id_logo']   =  json_encode($this->input->post('coleccion_id_logo'));
		      $data['id_dia']   = $this->input->post('id_dia');
		      $data['id_mes']   = $this->input->post('id_mes');
		      $data['id_festividad']   = $this->input->post('id_festividad');


	          $data             =   $this->security->xss_clean($data);  

	          //lista
	          $guardar          = $this->modelo_fotocalendario->anadir_lista( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_lista_listadias( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_lista_nombre_mes( $data );




	          $checar          = $this->modelo_fotocalendario->check_existente_fotocalendario( $data );
				
			   //si existe ya registros borrarlos para crear nuevo		          
	          if ($checar!=false) {
	        	  $eliminar          = $this->modelo_fotocalendario->eliminar_nombre_mes( $checar );
		          $eliminar          = $this->modelo_fotocalendario->eliminar_listadias( $checar );
		          $eliminar          = $this->modelo_fotocalendario->eliminar_fotocalendario( $checar );
	          }


	          //fotocalendario
	          $guardar          = $this->modelo_fotocalendario->anadir_nombre_mes( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_listadias( $data );
	          $guardar          = $this->modelo_fotocalendario->anadir_fotocalendario( $data );



	          if ( $guardar !== FALSE ){
	            echo true;
	          } else {
	            echo '<span class="error"><b>E01</b> - El nuevo fotocalendario no pudo ser agregado</span>';
	          }
	      } else {      
	        echo validation_errors('<span class="error">','</span>');
	      }




	  	  //echo true;


	}    




	function validacion_comprimir(){
				
				if (!empty($_FILES)) {
            		$file_name = strtolower(str_replace(" ", "", $_FILES['file']['name']));
            		//$file_name = $_FILES['file']['name'];
            		
            	}

					$config_adjunto['upload_path']		=	'./uploads/';
					$config_adjunto['allowed_types']	=	'jpg|png|gif|jpeg';
					$config_adjunto['max_size']			=	'20480';
					$config_adjunto['file_name']		=	$file_name;
					$config_adjunto['overwrite']		=	true;


					 $this->load->library('upload', $config_adjunto);

					 $this->upload->do_upload('file'); 
					 $errors = $this->upload->display_errors();


					if (!(($errors=='') || ($errors=='<p>No ha seleccionado ningún archivo para subir</p>'))) {
						echo $this->upload->display_errors('<span class="error">', '</span>');
					} else {

						if ($errors=='') {
							$data['file'] = $this->upload->data();

							
							if (($data["file"]["file_type"] == "image/gif") || ($data["file"]["file_type"] == "image/jpeg") || ($data["file"]["file_type"] == "image/png") || ($data["file"]["file_type"] == "image/pjpeg"))  { 
					            	$url = $config_adjunto['upload_path'].'comprimido/'.$config_adjunto['file_name']; 
					            	$filename = $this->compress_image('./uploads/'.$data["file"]["file_name"], $url, 80); 

					            	//$buffer = file_get_contents($url); /* Force download dialog... */ 
					            	//header("Content-Type: application/force-download"); 
					            	//header("Content-Type: application/octet-stream"); 
					            	//header("Content-Type: application/download"); /* Don't allow caching... */ 
					            	//header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); /* Set data type, size and filename */ 
					            	//header("Content-Type: application/octet-stream"); 

					            	//header("Content-Transfer-Encoding: binary"); 
					            	//header("Content-Length: " . strlen($buffer)); 
					            	//header("Content-Disposition: attachment; filename=$url"); /* Send our file... */ 
					            	//echo $buffer; 
					         }

					         echo '<div id="draggable" class="ui-widget-content">';

						         echo '<img src="uploads/comprimido/'.$file_name.'" style="width:300px"> ';

						     echo '</div>';    



						}						



						/**/

						$data 				= 	$this->security->xss_clean($data);  
						//$guardar 			=   $this->unidad->editar_circulacion( $data );
						/*
						if ( $guardar !== FALSE ){
							echo true;

						} else {
							echo '<span class="error"><b>E01</b> - La nueva imagen no pudo subir</span>';
						}*/
					}	

	}
	


	

	function compress_image($source_url, $destination_url, $calidad) { 
		
	  //obtiene tamaño de imagen
	  //retorna dimensiones, tipo de fichero, 
	  //cadena de texto con el alto/ancho para utilizarla con etiq IMG
	  //y el tipo de contenido HTTP correspondiente [mime].

	 /*
	  resp: 
	  Array ( [0] => 5616 
	          [1] => 3744
	          [2] => 2 
	          [3] => width="5616" height="3744"
	            [bits] => 8    // No todos los tipos de imagen 
	          [channels] => 3 //incluirán los elementos channels y bits.
	          [mime] => image/jpeg 
	        )
	  //print_r($info);
	  */
		
	  //*utilizamos esta función solo para recoger el tipo de fichero q tratamos
	
           	    
	  $info = getimagesize($source_url);
		 
	  /*
	   Crea una nueva imagen a partir de un fichero o de una URL
	   - éxito, devuelve un "identificador" de recurso de imagen,representa la imagen obtenida
	   desde el nombre de fichero dado.
	   - error, devuelve "FALSE". 

	    print_r($image);
	   resp: Resource id #3
	  */
	  
		if ($info['mime'] == 'image/jpeg')
	     $image = imagecreatefromjpeg($source_url); 
		elseif ($info['mime'] == 'image/gif')
	     $image = imagecreatefromgif($source_url); 
		elseif ($info['mime'] == 'image/png') 
	     $image = imagecreatefrompng($source_url); 
		

	  /*
	      Exportar la imagen al navegador o a un fichero
	    -$imagen: identificador
	    -$destination_url: ubicacion de destinop. Null para mostrará directamente en la salida 
	    - Su valor es desde 0 (peor calidad, archivo más pequeño)
	      100 (mejor calidad, archivo más grande). 
	      El valor por defecto es el valor de calidad predeterminada de IJG (sobre 75).     
	  */
	  imagejpeg($image, $destination_url, $calidad); 
		

	  return $destination_url; 
	}	




	public function comprimir(){
	   if ($_POST) { 
	      	 if ($data["file"]["error"] > 0) { 
	              $error = $data["file"]["error"];
	         }  else if (($data["file"]["type"] == "image/gif") || ($data["file"]["type"] == "image/jpeg") || ($data["file"]["type"] == "image/png") || ($data["file"]["type"] == "image/pjpeg"))  { 
	            	$url = 'destination1.jpg'; 
	            	$filename = compress_image($data["file"]["tmp_name"], $url, 80); 
	            	$buffer = file_get_contents($url); /* Force download dialog... */ 
	            	header("Content-Type: application/force-download"); 
	            	header("Content-Type: application/octet-stream"); 
	            	header("Content-Type: application/download"); /* Don't allow caching... */ 
	            	header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); /* Set data type, size and filename */ 
	            	header("Content-Type: application/octet-stream"); 
	            	header("Content-Transfer-Encoding: binary"); 
	            	header("Content-Length: " . strlen($buffer)); 
	            	header("Content-Disposition: attachment; filename=$url"); /* Send our file... */ 
	            	echo $buffer; 



	         } else { 
	            	$error = "Uploaded image should be jpg or gif or png"; 
	         } 
	  } 
	}

	

/////////////////validaciones/////////////////////////////////////////	


	public function valid_cero($str)
	{
		return (  preg_match("/^(0)$/ix", $str)) ? FALSE : TRUE;
	}

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
			$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD/MM/YYYY.');
			return FALSE;
		}
	}

	public function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

////////////////////////////////////////////////////////////////
	//salida del sistema
	public function logout(){
		$this->session->sess_destroy();
		redirect('');
	}	

}

/* End of file main.php */
/* Location: ./app/controllers/main.php */