<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'sitio/principal/header' ); ?>


<?php $this->load->view( 'sitio/principal/lib/woocommerce-api' ); ?>

<?php 

		//require_once( 'lib/woocommerce-api.php' );

$options = array(
    
	'debug'           => true,
	'return_as_array' => false,
	'validate_url'    => false,
	'timeout'         => 30,
	'ssl_verify'      => false,


);



try {
/*
https://woocommerce.wordpress.com/tag/rest-api/

		$client = new WC_API_Client( 'http://localhost/sitio_tinbox', 'ck_9043d9430aae7a14ab02bca793437d1b66b8cfde', 'cs_43b95ef43ec2b176293a81afb90d059ca3e1a2ac', $options );
  
		print_r( $client->products->get());
*/
	
	$cliente = new WC_API_Client( 'http://localhost/sitio_tinbox', 'ck_59e6b51d2952676657460a64ad85c22d712e4cc2', 'cs_1deb7d777da4ea5c6c6c3500863b77d5ca6ba16b', $options );
  
  //$client = new WC_API_Client( 'http://your-store-url.com', 'ck_enter_your_consumer_key', 'cs_enter_your_consumer_secret', $options );

		//print_r( $client->products);

    print_r( $cliente->products->get());
     //echo $string_to_sign ;
   //  die;
  
/*
  //$client = new WC_API_Client( 'http://your-store-url.com', $consumer_key, $consumer_secret, $options );
  $client = new WC_API_Client( 'http://localhost/sitio_tinbox', 'ck_cdd3f80a52a57a67e7891a4cb319baefbde9310b', 'cs_cd90e72f11012279d9a9280f0ce676541c4276e9', $options );

  print_r($client->products);
  //print_r( $client->products );
  print_r('<br/>');
  print_r('<br/>');
  print_r('<br/>');

print_r( $client->products->get() );
*/

  //print_r( $client->products->get( 73, $options ) );

} catch ( WC_API_Client_Exception $e ) {

    echo $e->getMessage() . PHP_EOL;
    echo $e->getCode() . PHP_EOL;

    if ( $e instanceof WC_API_Client_HTTP_Exception ) {

        print_r( $e->get_request() );
        print_r( $e->get_response() );
    }
}





?>



      
 <div class="container">

        <?php //$this->load->view( 'sitio/principal/tabulador' ); ?>
        <hr/>
        
        <?php $this->load->view( 'sitio/principal/navbar' ); ?>

</div>     
     
     
<?php $this->load->view( 'sitio/principal/footer' ); ?>

