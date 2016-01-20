<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');
  class modelo_fcalendario extends CI_Model{
    
    private $key_hash;
    private $timezone;
    function __construct(){
      parent::__construct();
      $this->load->database("default");
      $this->key_hash    = $_SERVER['HASH_ENCRYPT'];
      $this->timezone    = 'UM1';
      date_default_timezone_set('America/Mexico_City');   
      
        $this->termmeta =$this->db->dbprefix('woocommerce_termmeta');
           $this->posts =$this->db->dbprefix('posts');
        $this->terminos =$this->db->dbprefix('terms');

      

    }


       //correo logueo
       public function imagen_atributo($data){
  
  /*
SELECT post.guid, term.*, tmeta.* FROM tinbox_terms AS term  
INNER JOIN tinbox_woocommerce_termmeta AS tmeta ON tmeta.woocommerce_term_id = term.term_id
INNER JOIN tinbox_posts AS post ON post.ID = tmeta.meta_value
where (meta_key ="pa_tamanos_swatches_id_photo")  and    (term.slug="pequeno")
 
  */


//SELECT * FROM `tinbox_postmeta` WHERE  meta_key="_wp_attached_file"

          $result = $this->db->query(
          'select post.guid 
            from '.$this->terminos.' AS termino
            INNER JOIN '.$this->termmeta.' AS tmeta ON tmeta.woocommerce_term_id = termino.term_id
            INNER JOIN '.$this->posts.' AS post ON post.id = tmeta.meta_value
            where ( (tmeta.meta_key ="pa_tamanos_swatches_id_photo")  AND    (termino.slug="'.$data['slug'].'" ) )
          ');



              if ( $result->num_rows() > 0 )  {
                         return $result->result();
              }   else {
                      return "false";
                      $result->free_result();
              }

       }

    
  } 


?>