<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Fcalendario extends CI_Controller {
	public function __construct(){ 
		parent::__construct();
		$this->load->model('fotocalendarios/modelo_fcalendario', 'modelo_fcalendario'); 
		$this->load->library(array('email')); 
        $this->load->library('Jquery_pagination');//-->la estrella del equipo		
	}


//comienza aqui a mostrar el formulario
	public function index(){

		 $this->load->view( 'sitio/principal/lib/woocommerce-api' ); 
		 
		 $options = array(
			'debug'           => true,
			'return_as_array' => false,
			'validate_url'    => false,
			'timeout'         => 30,
			'ssl_verify'      => false,
		);


			try {
			  	$client = new WC_API_Client( 'http://localhost/sitio_tinbox', 'ck_2eeaf3865d96db5f8c5b31b2d61691a5b39e1e0c', 'cs_4d7f15f9abb2c0f802763891e056a2cb93dd5035', $options );

			    $categorias = ( ($client->products->get_categories()) );

			    $datos['las_categorias_productos'] = $categorias->product_categories;

			                  $datos['productos']= ( $client->products->get() );

			                  $datos['categoria_activa']='fotocalendario';
			                  //$datos['categoria_activa']='agendas';

/*
    			foreach ($productos as $llave => $valor) { 
                          foreach ($valor as $llave2 => $valor2) { 
                              if (isset($valor2->categories)) {
                                 
                                 //productos
                                 foreach ($valor2->images as $llave3 => $valor3) { 
                                    echo '<img src="'.$valor3->src.'" height="100" width="100">';
                                 }
                                 print_r($valor2->title);


                                 foreach ($valor2->variations as $llave3 => $valor3) { 
                                    echo '<br/><br/>';
                                         echo '<br/><br/>';
                                         foreach ($valor3->attributes as $llave4 => $valor4) { 
                                           
                                           $data['slug'] = $valor4->option;
                                           
                                           $data['imagen_attributo']  =  $this->modelo_fcalendario->imagen_atributo( $data );
                                           print_r($data['imagen_attributo'][0]->guid);

                                           echo '<img src="'.$data['imagen_attributo'][0]->guid.'" height="100" width="100">';

                                         }
                                 }
                                 

                              }
                          }
                       }   

*/
			                  


			        


			} catch ( WC_API_Client_Exception $e ) {

			    echo $e->getMessage() . PHP_EOL;
			    echo $e->getCode() . PHP_EOL;

			    if ( $e instanceof WC_API_Client_HTTP_Exception ) {

			        print_r( $e->get_request() );
			        print_r( $e->get_response() );
			    }
			}


			$this->load->view( 'sitio/principal/principal',$datos ); 
		

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