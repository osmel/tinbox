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

//https://es.wordpress.org/releases/
//Imagen genérica del producto

try {
/*
https://woocommerce.wordpress.com/tag/rest-api/

		$client = new WC_API_Client( 'http://localhost/sitio_tinbox', 'ck_9043d9430aae7a14ab02bca793437d1b66b8cfde', 'cs_43b95ef43ec2b176293a81afb90d059ca3e1a2ac', $options );
  
		print_r( $client->products->get());
*/
	
	$client = new WC_API_Client( 'http://localhost/sitio_tinbox', 'ck_4efdf1df9ebeac36f37d69d4b925ab7de669cead', 'cs_c1c2a3086ebab1ee35e1ffbcc3981ba91b66f0fb', $options );
  
    $categorias = ( ($client->products->get_categories()) );

               

    /*
    print_r( $categorias );

    echo '<br/><br/>';

    die;
    */

//print_r($categorias); 
//die;
           foreach ($categorias->product_categories as $llave => $valor) { 
               
               
               if ($valor->image) {  //se presentan los q tengan imagenes

                   echo '<img src="'.$valor->image.'" height="100" width="100">';
                   echo ($valor->name);    //nombre
                   echo ($valor->id);      //id      de la categoria
                                           //slug    de la categoria
                                           //parent  padre de la categoria
                   //print_r($valor->count); //->cantidad de productos

                   $cantidad_prod = $valor->count;
                   //display  ->default


               }


             
           }


           echo '<br/><br/>';
           echo '<br/><br/>';
           //print_r( $client->products->get(array('title'=>'seasson') ) );
           //print_r( $client->products->get(73)->product->categories[0] );




           $productos= ( $client->products->get() );

                  //print_r((($productos->products)) ); 
                      /*

                      para ver json a array
                      //http://json.parser.online.fr/ 
                       print_r(json_encode($productos->products)); 
                       echo '<br/><br/>';
                       */

//print_r(json_encode($productos->products));

//die;


                  foreach ($productos as $llave => $valor) { 
                    foreach ($valor as $llave2 => $valor2) { 
                        if (isset($valor2->categories)) {
                           
                           foreach ($valor2->images as $llave3 => $valor3) { 
                              echo '<img src="'.$valor3->src.'" height="100" width="100">';
                              //print_r($valor3->title);
                           }
                           echo '<br/><br/>';
                           
                           print_r($valor2->title);

                           foreach ($valor2->variations as $llave3 => $valor3) { 
                              echo '<br/><br/>';
                              print_r($valor3);
                                   echo '<br/><br/>';
                                   print_r($valor3->attributes);
                           }
                           

                        }
                          
                          //echo '<img src="'.$valor[$i]->images[0]->src.'" height="100" width="100">';
                    }
                 }   


    /*
                    for ($i=0; $i < count($valor); $i++) { 
                        if ( (isset($valor[$i]->categories[0])) and (($valor[$i]->categories[0])=='fotocalendario') ) {

                          echo '<img src="'.$valor[$i]->images[0]->src.'" height="100" width="100">';
                          print_r($valor[$i]->categories[0]);
                          print_r($valor[$i]->title);
                          print_r($valor[$i]->id);
                          print_r($valor[$i]->images[0]->src);

                          //print_r($valor[$i]->attributes);

                          echo '<br/><br/>';

                          //http://json.parser.online.fr/

                          
                          //print_r($valor[$i]->variations[0]);

                          //print_r((json_encode($valor[$i]->variations, true)) );

                            foreach ($valor[$i]->variations as $llave1 => $valor1) {  
                                
                                echo '<img src="'.$valor1->image[0]->src.'" height="100" width="100">';

                                print_r($valor1->id);
                                echo '<br/><br/>';
                                //print_r($valor1->image[0]->src);
                                print_r($valor1->attributes);
                                echo '<br/><br/>';


                                

                            }
                          
                          echo '<br/><br/>';
                         // print_r($valor[$i]);


                          echo '<br/><br/>';


                        }
                    } 

         }                    
*/
                    //print_r(count($valor));
                    //print_r($llave);
                    //print_r($valor[2]);
         
                  die;
                  print_r(json_decode(json_encode($productos->products)) ); 
                
                  echo '<br/><br/>';

                  //foreach (json_encode($productos->products) as $llave => $valor) {                   
                  foreach ( json_encode($productos->products) as $llave ) {                   

                  }  

                  die;

             foreach ($productos as $llave => $valor) { 
                //print_r($llave); 
                  echo '<br/><br/>';
                  for ($i=0; $i < $cantidad_prod; $i++) { 
                    print_r(json_encode($valor[$i])); 
                    //print_r(json_encode($valor[1])); 
                    echo '<br/><br/>';
                    echo '<br/><br/>';
                    echo '<br/><br/>';
                    
                  }
                  
                  
                  //die;

                //print_r($valor->products); 
             }
        


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





















           echo '<br/><br/>';
           echo '<br/><br/>';
           //print_r( $client->products->get(array('title'=>'seasson') ) );
           //print_r( $client->products->get(73)->product->categories[0] );




           $productos= ( $client->products->get() );

                  //print_r((($productos->products)) ); 
                      /*

                      para ver json a array
                      //http://json.parser.online.fr/ 
                       print_r(json_encode($productos->products)); 
                       echo '<br/><br/>';
                       */

                  foreach ($productos as $llave => $valor) { 
                    for ($i=0; $i < count($valor); $i++) { 
                        if ( (isset($valor[$i]->categories[0])) and (($valor[$i]->categories[0])=='Fotocalendario') ) {

                          echo '<img src="'.$valor[$i]->images[0]->src.'" height="100" width="100">';
                          print_r($valor[$i]->categories[0]);
                          print_r($valor[$i]->title);
                          print_r($valor[$i]->id);
                          print_r($valor[$i]->images[0]->src);

                          //print_r($valor[$i]->attributes);

                          echo '<br/><br/>';

                          //http://json.parser.online.fr/

                          
                          //print_r($valor[$i]->variations[0]);

                          //print_r((json_encode($valor[$i]->variations, true)) );

                            foreach ($valor[$i]->variations as $llave1 => $valor1) {  
                                
                                echo '<img src="'.$valor1->image[0]->src.'" height="100" width="100">';

                                print_r($valor1->id);
                                echo '<br/><br/>';
                                //print_r($valor1->image[0]->src);
                                $atributos= ($valor1->attributes);
                                
                                foreach ($atributos as $llave3 => $valor3) {  
                                    print_r($valor3->option);
                                    $data['option'] = $valor3->option;
                                    $data['imagen_attr']  =  $this->modelo_fcalendario->imagen_atributo( $data );
                                    
                                }
                                echo '<br/><br/>';


                                

                            }
                          
                          echo '<br/><br/>';
                         // print_r($valor[$i]);


                          echo '<br/><br/>';


                        }
                    } 

                    //print_r(count($valor));
                    //print_r($llave);
                    //print_r($valor[2]);
                  }
                  die;
                  print_r(json_decode(json_encode($productos->products)) ); 
                
                  echo '<br/><br/>';

                  //foreach (json_encode($productos->products) as $llave => $valor) {                   
                  foreach ( json_encode($productos->products) as $llave ) {                   

                  }  

                  die;

             foreach ($productos as $llave => $valor) { 
                //print_r($llave); 
                  echo '<br/><br/>';
                  for ($i=0; $i < $cantidad_prod; $i++) { 
                    print_r(json_encode($valor[$i])); 
                    //print_r(json_encode($valor[1])); 
                    echo '<br/><br/>';
                    echo '<br/><br/>';
                    echo '<br/><br/>';
                    
                  }
                  
                  
                  //die;

                //print_r($valor->products); 
             }































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

//https://es.wordpress.org/releases/
//Imagen genérica del producto

try {
/*
https://woocommerce.wordpress.com/tag/rest-api/

    $client = new WC_API_Client( 'http://localhost/sitio_tinbox', 'ck_9043d9430aae7a14ab02bca793437d1b66b8cfde', 'cs_43b95ef43ec2b176293a81afb90d059ca3e1a2ac', $options );
  
    print_r( $client->products->get());
*/
  
  $client = new WC_API_Client( 'http://localhost/sitio_tinbox', 'ck_2eeaf3865d96db5f8c5b31b2d61691a5b39e1e0c', 'cs_4d7f15f9abb2c0f802763891e056a2cb93dd5035', $options );
  
    $categorias = ( ($client->products->get_categories()) );


/*
SELECT post.guid, term.*, tmeta.* FROM tinbox_terms AS term  
INNER JOIN tinbox_woocommerce_termmeta AS tmeta ON tmeta.woocommerce_term_id = term.term_id
INNER JOIN tinbox_posts AS post ON post.ID = tmeta.meta_value
where (meta_key ="pa_tamanos_swatches_id_photo")  and    (term.slug="pequeno")
*/


    /*
    print_r( $categorias );

    echo '<br/><br/>';

    die;
    */

//print_r($categorias); 
//die;
           foreach ($categorias->product_categories as $llave => $valor) { 
               
               
               if ($valor->image) {  //se presentan los q tengan imagenes

                   echo '<img src="'.$valor->image.'" height="100" width="100">';
                   echo ($valor->name);    //nombre
                   echo ($valor->id);      //id      de la categoria
                                           //slug    de la categoria
                                           //parent  padre de la categoria
                   //print_r($valor->count); //->cantidad de productos

                   $cantidad_prod = $valor->count;
                   //display  ->default


               }


             
           }


                  $productos= ( $client->products->get() );

                  foreach ($productos as $llave => $valor) { 
                    foreach ($valor as $llave2 => $valor2) { 
                        if (isset($valor2->categories)) {
                           
                           foreach ($valor2->images as $llave3 => $valor3) { 
                              echo '<img src="'.$valor3->src.'" height="100" width="100">';
                              //print_r($valor3->title);
                           }
                           echo '<br/><br/>';
                           
                           print_r($valor2->title);

                           foreach ($valor2->variations as $llave3 => $valor3) { 
                              echo '<br/><br/>';
                              //print_r($valor3);
                                   echo '<br/><br/>';
                                   //print_r($valor3->attributes);
                                   foreach ($valor3->attributes as $llave4 => $valor4) { 
                                     
                                     $data['slug'] = $valor4->option;
                                     
                                     $data['imagen_attributo']  =  $this->modelo_fcalendario->imagen_atributo( $data );
                                     print_r($data['imagen_attributo'][0]->guid);

                                     echo '<img src="'.$data['imagen_attributo'][0]->guid.'" height="100" width="100">';

                                   }
                           }
                           

                        }
                          
                          //echo '<img src="'.$valor[$i]->images[0]->src.'" height="100" width="100">';
                    }
                 }   


        


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

