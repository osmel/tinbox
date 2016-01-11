<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fotoimagen extends CI_Controller {
	public function __construct(){ 
		parent::__construct();
		$this->load->model('modelo', 'modelo'); 
		$this->load->model('fotocalendarios/modelo_fotoimagen', 'modelo_fotoimagen'); 
		$this->load->library(array('email')); 
        $this->load->library('Jquery_pagination');//-->la estrella del equipo		
	}

	public function index($session) {

		$data['session'] = base64_decode($session);

		//$data['datos'] = $this->modelo_fotoimagen->listado_disenos($data);
		$data['datos'] = $this->modelo_fotoimagen->correo_logueo($data);



      	

		if (isset($_POST['id_tamano'])) {
				$data['id_diseno']   = $_POST['id_tamano']; // el diseño que se va activar
				$data['ano']  		 = $_POST['ano'];  //en que año
				$data['mes']  		 = $_POST['mes'];  //y en q mes
		} else { //para recoger el 1er diseño si refresca
	 		//$num_diseno          = $this->modelo_fotoimagen->num_diseno( $data );
	      	

			$data['datos'] = $this->modelo_fotoimagen->correo_logueo($data);

		
				 if ($data['datos']){
				 	   //$data['cantDiseno_original'] = count($data['datos']);
				 	   //$data['cantDiseno']   = count($data['datos']);
			      	  
			      	  $data['id_diseno']    = $data['datos'][0]->id_tamano; //1; //leer el 1er tamaño
    	        	  $data['ano'] = date("Y");
			  		  $data['mes'] = date("m")-1;

			     } 	  


		}


		/*
		$this->form_validation->set_rules( 'imagen', 'imagen', 'required|xss_clean');
		if ( $this->form_validation->run() == FALSE ){
			echo validation_errors('<span class="error">','</span>');
		}*/

		if  ($data['datos'] ) {
			$this->load->view( 'sitio/fotoimagen/croppear',$data );	
		} else {
			redirect('');

		}
		
	}


	
	public function revisar_imagenes(){

		$data['id_session']     = $_POST['id_session'];
		$data['id_diseno']      = $_POST['id_diseno'];
			  $data['ano']      = $_POST['ano'];

		$data['datos']          = $this->modelo_fotoimagen->revisar_imagenes( $data );			  
		echo json_decode($data['datos']);



	}


	//1- si hay imagenes mostrarla cropeada	
	public function buscarImagen(){
		

		$data['id_session']     = $_POST['id_session'];
		$data['id_diseno']      = $_POST['id_diseno'];
		$data['ano']     		= $_POST['ano'];
		$data['mes']     		= $_POST['mes'];

		$data['datos']          = $this->modelo_fotoimagen->buscar_imagen( $data );
		$img_canva = '
		        <div id="cont_img">
		            <img id="image" style="max-width: 100%;"/>
		        </div>
		';
	
		if ($data['datos']!=false) {


					$targetPath =   base_url().'uploads/'.$data['id_session'].'/'.$data['datos']->original;
					$nombre= $data['datos']->original;
					$tipo_archivo = $data['datos']->tipo_archivo;
					$id_diseno = $data['datos']->id_diseno;

					$tipo = $data['datos']->tipo;
					$ext = $data['datos']->ext;
					$tamano = $data['datos']->tamano;
					$ancho = $data['datos']->ancho;
					$alto = $data['datos']->alto;
					$cleft = $data['datos']->cleft;
					$ctop = $data['datos']->ctop;
					$cwidth = $data['datos']->cwidth;
					$cheight = $data['datos']->cheight;
					
					$naturalWidth = $data['datos']->cnaturalWidth;
					$naturalHeight = $data['datos']->cnaturalHeight;
					$rotate = $data['datos']->rotate;
					$scaleX = $data['datos']->scaleX;
					$scaleY = $data['datos']->scaleY;
					$ratio = $data['datos']->aspectRatio;


	                $dx      = $data['datos']->dx;
                    $dy      = $data['datos']->dy;
                    $dwidth  = $data['datos']->dwidth;
                    $dheight = $data['datos']->dheight;
                    $dscaleX = $data['datos']->dscaleX;
                    $dscaleY = $data['datos']->dscaleY;
                    $drotate = $data['datos']->drotate;

                    $bleft = $data['datos']->bleft;
                    $btop = $data['datos']->btop;
                    $bwidth = $data['datos']->bwidth;
                    $bheight = $data['datos']->bheight;

					$img_canva= '<div id="cont_img">';
							$img_canva .= '<img id_diseno="'.$id_diseno.'"
							 bleft="'.$bleft.'" btop="'.$btop.'" bwidth="'.$bwidth.'" bheight="'.$bheight.'"
							 dx="'.$dx.'" dy="'.$dy.'" dwidth="'.$dwidth.'" dheight="'.$dheight.'" dscaleX="'.$dscaleX.'" dscaleY="'.$dscaleY.'" drotate="'.$drotate.'"
							 naturalWidth="'.$naturalWidth.'" naturalHeight="'.$naturalHeight.'" ratio="'.$ratio.'" rotate="'.$rotate.'" scalex="'.$scaleX.'" scaley="'.$scaleY.'"
							cleft="'.$cleft.'" ctop="'.$ctop.'" cwidth="'.$cwidth.'" cheight="'.$cheight.'" alto="'.$alto.'" ancho="'.$ancho.'" tamano="'.$tamano.'" ext="'.$ext.'" tipo="'.$tipo.'" tipo_archivo="'.$tipo_archivo.'" nombre="'.$nombre.'" 
							id="image" src="'.$targetPath.'" style="max-width: 100%;" alt="Picture"/>';
					$img_canva .= '</div>'; 
		}
		
		$data['imagen'] = $img_canva.'<script src="'.base_url().'js/fotoimagen/main.js" type="text/javascript"></script>';	
		
		echo json_encode($data);
	}	



//2- cuando se arrastra la imagen,
//		1- crear carpeta
//		2- guardar la imagen original dentro de la carpeta
//		3- mostrar la imagen original con sus datos basicos(d la imagen original)

//y ademas activar el cropper
	public function upload(){
		//crear carpeta
		$data['session']  		 = ($_POST['session']);
		$data['uid_original']    = $_POST['uid_original'];
	
		$idp =$data['session'];
		$dir=set_realpath('./uploads/'.$idp."/");  
		if(!is_dir($dir)){  
		    mkdir($dir,0755,TRUE);  
		}  
 		 	  if (!empty($_FILES)) {
		          $config_adjunto['upload_path']    = './uploads/'.$data['session'].'/';
		          $config_adjunto['allowed_types']  = 'jpg|png|gif|jpeg';
		          $config_adjunto['max_size']     = '20480';
		          $config_adjunto['file_name']    = 'orig_'.$data['uid_original'];
		          $config_adjunto['overwrite']    = true;
		          $this->load->library('upload', $config_adjunto);
					
					foreach ($_FILES as $key => $value) {
					    if ($this->upload->do_upload($key)) {
								$data['logo'] = $this->upload->data();	

									$nombre   = ($data['logo']['file_name']);
							 	$tipo_archivo = ($data['logo']['file_type']);
								  	    $tipo = ($data['logo']['image_type']);
									     $ext = ($data['logo']['file_ext']);
									  $tamano = ($data['logo']['file_size']);
									   $ancho = ($data['logo']['image_width']);
									    $alto = ($data['logo']['image_height']);
						} 					  	
					} 	 

					$targetPath=   base_url().'uploads/'.$data['session'].'/'.$data['logo']['file_name'];      
					echo '<div id="cont_img">';
							echo '<img alto="'.$alto.'" ancho="'.$ancho.'" tamano="'.$tamano.'" ext="'.$ext.'" tipo="'.$tipo.'" tipo_archivo="'.$tipo_archivo.'" nombre="'.$nombre.'" id="image" src="'.$targetPath.'" style="max-width: 100%;" alt="Picture"/>';
					echo '</div>'; 
		          
		      } 
				   echo '<script src="'.base_url().'js/fotoimagen/main.js" type="text/javascript"></script>';
	}	


	public function num_diseno(){ 

      	$data['session']     = ($_POST['session']);
      	   $data['mes']      = ($_POST['mes']);

      	   $num_diseno          = $this->modelo_fotoimagen->num_diseno( $data );

      	   echo json_encode($num_diseno);


	}

//3- guardar imagen de recorte
//  -checar si ya la imagen recortada a guardar existe

	public function guardar_imagen(){
		
		//el true al final es para convertirlo a Array de lo contrario será objeto
      	//datos de la imagen cropeada
      	$data['datoimagen']     = json_decode($_POST['datoimagen'],true);
      	$data['datocanvas']     = json_decode($_POST['datocanvas'],true);
      		 $data['datos']     = json_decode($_POST['datos'],true);
       $data['datocropbox']     = json_decode($_POST['datocropbox'],true);

      		 

      	$data['id_session']     = ($_POST['session']);
      	$data['id_diseno']      = ($_POST['id_diseno']);

      	
      	
      		  $data['nombre']   = ($_POST['nombre']);
        $data['tipo_archivo']   = ($_POST['tipo_archivo']);
      		    $data['tipo']   = ($_POST['tipo']);
      		     $data['ext']   = ($_POST['ext']);
      		  $data['tamano']   = ($_POST['tamano']);
      		   $data['ancho']   = ($_POST['ancho']);
      		    $data['alto']   = ($_POST['alto']);
      		     $data['ano']   = ($_POST['ano']);
      		     $data['mes']   = ($_POST['mes']);
      		     

		$idp =$data['id_session'];
		$dir=set_realpath('./uploads/'.$idp."/");  
		if(!is_dir($dir)){  
		    mkdir($dir,0755,TRUE);  
		}  
		//http://www.re-cycledair.com/html-5-canvas-saving-to-a-file-with-php
		//guardar la imagen recortada 
		$dato = substr($_POST['croppedImage'], strpos($_POST['croppedImage'], ",") + 1);
		$nombre = $data['nombre'];
		  
		$decodedData = base64_decode($dato);
		$fp = fopen("uploads/".$idp."/"."rec_".substr($nombre, 5), 'wb');
		//$fp = fopen("uploads/".$idp."/"."rec_".$nombre, 'wb');
		fwrite($fp, $decodedData);
		fclose($fp);
   			  	/////////////////////////////*****************///////////////////////////////////////

	    	  $data['uid_imagen'] = 'uid_'.date('d').date('m').date('Y').'_'.random_string('alpha',4).random_string('numeric',3);                                
   			  $checar             = $this->modelo_fotoimagen->check_existente_imagen( $data );
				
			   //si existe ya registros borrarlos para crear nuevo		          
	          if ($checar!=false) {
	        	  $eliminar          = $this->modelo_fotoimagen->eliminar_imagenes( $checar );
		          $eliminar          = $this->modelo_fotoimagen->eliminar_imagenes_original( $checar );
		          $eliminar          = $this->modelo_fotoimagen->eliminar_imagenes_recorte( $checar );
	          }
	        	  $guardar          = $this->modelo_fotoimagen->anadir_imagenes( $data );
		          $guardar          = $this->modelo_fotoimagen->anadir_imagenes_original( $data );
		          $guardar          = $this->modelo_fotoimagen->anadir_imagenes_recorte( $data );

	}	



	public function imagen_encontrada(){
		//crear carpeta
		$data['session']  		 = ($_POST['session']);
		$data['uid_original']    = $_POST['uid_original'];
	
		$idp =$data['session'];
		$dir=set_realpath('./uploads/'.$idp."/");  
		if(!is_dir($dir)){  
		    mkdir($dir,0755,TRUE);  
		}  
 		 	  if (!empty($_FILES)) {
		          $config_adjunto['upload_path']    = './uploads/'.$data['session'].'/';
		          $config_adjunto['allowed_types']  = 'jpg|png|gif|jpeg';
		          $config_adjunto['max_size']     = '20480';
		          $config_adjunto['file_name']    = 'Orig_'.$data['uid_original'];
		          $config_adjunto['overwrite']    = true;
		          $this->load->library('upload', $config_adjunto);
					foreach ($_FILES as $key => $value) {
					    if ($this->upload->do_upload($key)) {
								$data['logo'] = $this->upload->data();		
								//print_r($_FILES);
								//print_r($data['logo']);
										$nombre= ($data['logo']['file_name']);
								 		$tipo_archivo = ($data['logo']['file_type']);
										$tipo = ($data['logo']['image_type']);
										$ext = ($data['logo']['file_ext']);
										$tamano = ($data['logo']['file_size']);
										$ancho = ($data['logo']['image_width']);
										$alto = ($data['logo']['image_height']);
						/*
							[file_name] => foco.jpg 
							[file_type] => image/jpeg 
							[image_type] => jpeg 
							[file_ext] => .jpg 
							[file_size] => 106.74 
							[image_width] => 2048
							[image_height] => 1365 
						*/
						} 					  	
					} 	 
					$targetPath=   base_url().'uploads/'.$data['session'].'/'.$data['logo']['file_name'];      
					echo '<div id="cont_img">';
							echo '<img alto="'.$alto.'" ancho="'.$ancho.'" tamano="'.$tamano.'" ext="'.$ext.'" tipo="'.$tipo.'" tipo_archivo="'.$tipo_archivo.'" nombre="'.$nombre.'" id="image" src="'.$targetPath.'" style="max-width: 100%;" alt="Picture"/>';
					echo '</div>'; 
		          
		      } 
				   echo '<script src="'.base_url().'js/fotoimagen/main.js" type="text/javascript"></script>';
	}	



	
	
	
/////////////////validaciones/////////////////////////////////////////	
	public function valid_cero($str) {
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
	public function valid_email($str) {
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