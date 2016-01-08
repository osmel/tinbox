<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'sitio/fotocalendario/header_fotocalendario' ); ?>
      
 <div class="container">

        <?php $this->load->view( 'sitio/fotocalendario/tabulador_fotocalendario' ); ?>
        <hr/>
        
        <?php $this->load->view( 'sitio/fotocalendario/navbar_fotocalendario' ); ?>

     
        <?php $this->load->view( 'sitio/fotocalendario/slider' ); ?>
     

<?php 


  if (!isset($retorno)) {
        $retorno ="tinbox/fotocalendario";
    }

   if (isset($calendario->uid_fotocalendario))   {
      $uid_fotocalendario =$calendario->uid_fotocalendario;
   } else {
      $uid_fotocalendario ='';
   }

 //http://www.sanwebe.com/2012/06/ajax-file-upload-with-php-and-jquery    

 $attr = array('class' => 'form-horizontal', 'id'=>'form_validar_fotocalendario','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
 echo form_open_multipart('validar_nuevo_fotocalendario', $attr);
?>    


      <section>
<!-- variables ocultas q se arrastran entre secciones -->
<input type="text" id="correo_activo" name="correo_activo" value="<?php echo $correo_activo; ?>" >


<input type="text" id="cantDiseno_original" name="cantDiseno_original" value="<?php echo $cantDiseno_original; ?>" >
<input type="text" id="cantDiseno" name="cantDiseno" value="<?php echo $cantDiseno; ?>" >
<input type="text" id="posicionDiseno" name="posicionDiseno" value="<?php echo $posicionDiseno; ?>" >
<input type="text" id="movposicion" name="movposicion" value="<?php echo $movposicion; ?>" >
<input type="text" id="id_session" name="id_session" value="<?php echo $id_session; ?>" >

  
<input type="text" id="uid_fotocalendario" name="uid_fotocalendario" value="<?php echo $uid_fotocalendario; ?>" >

<input type="text" id="array_eliminar" name="array_eliminar" value="<?php echo $array_eliminar; ?>" >




            <div id="datos">

              <div class="row">  
                <div class="col-xs-12 col-md-12">
                      <h3 class="form-control-static">DATOS</h3>
                  </div>  
                </div>  



                <div class="form-group">
                  <label for="titulo" class="col-sm-1 col-md-1 control-label">Título</label>
                  <div class="col-xs-11 col-md-11">
                    <?php 
                      $nomb_nom='';
                      if (isset($calendario->titulo)) 
                       {  $nomb_nom = $calendario->titulo;}
                    ?>
                    <input value="<?php echo  set_value('titulo',$nomb_nom); ?>" type="text" class="form-control" name="titulo" placeholder="Título">
                  </div>

                  <div class="col-xs-12 col-md-12">
                    <span class="help-block">*Sólo aparecerá en la portadas antes del nombre, ejemplo(Licenciada, Estimada, Sr. ...)</span>
                  </div>

                </div>



                <div class="form-group">
                  <div class="col-xs-12 col-md-12">
                      <?php 
                        $nomb_nom='';
                        if (isset($calendario->nombre)) 
                         {  $nomb_nom = $calendario->nombre;}
                      ?>
                      <input value="<?php echo  set_value('nombre',$nomb_nom); ?>" type="text" class="form-control" name="nombre" placeholder="Nombre">
                      <span class="help-block">Lo más importante, pues lo que escribas personalizará la imagen de cada mes...</span>
                   </div> 
                </div>                      

                <div class="form-group">
                  <div class="col-xs-12 col-md-12">
                      <?php 
                        $nomb_nom='';
                        if (isset($calendario->apellidos)) 
                         {  $nomb_nom = $calendario->apellidos;}
                      ?>
                      <input value="<?php echo  set_value('apellidos',$nomb_nom); ?>" type="text" class="form-control" name="apellidos" placeholder="Apellidos">
                      <span class="help-block">Sólo aparecerá en la portada junto al nombre...</span>
                   </div> 
                </div>                      



            

              <div id="interior" class="row">  
                  
                    <div class="col-xs-12 col-md-12">
                        <h3 class="form-control-static">¿Quiéres incluir un logo?</h3>
                    </div>  

                    <!-- Imagen-->  
                    <div class="col-xs-4 col-md-4">






                  
                  <?php

                    if  (isset($calendario->logo)) { ?>
                          <input type="hidden" id="ca_logo" name="ca_logo" value="<?php echo $calendario->logo; ?>" >  
                  <?php          
                      if  ($calendario->logo=='') {
                        print "Usted no tiene imagen adjunta. Desea agregarla?";
                      } else  { ?>  
                         Su imagen adjunta actual es: 
                           <?php  
                                            $nombre_fichero ='uploads/fotocalendario/'.$calendario->logo;

                                            if (file_exists($nombre_fichero)) {
                                              echo '<a target="_blank" href="'.base_url().$nombre_fichero.'" type="button">';
                                                    echo '<img src="'.base_url().$nombre_fichero.'" border="0" width="50" height="50">';
                                              echo '</a>';  
                                            } else {
                                                
                                              echo '<a target="_blank" href="'.base_url().'img/sinimagen.jpg'.'" type="button">';
                                                    echo '<img src="'.base_url().'img/sinimagen.jpg'.'" border="0" width="50" height="50">';
                                                echo '</a>';    
                                            }
                                        ?>



                           <br/>Desea reemplazarlo por un archivo diferente?
                      <?php     
                      }   
                      print '<br/>';
                       
                    }  
                       ?> 









                        <input type="file" name="logo" id="logo" size="20">
                    </div>

















                    <?php              
                      if  (isset($calendario->coleccion_id_logo)) {
                         $col_id_logo = explode(",",  substr($calendario->coleccion_id_logo,1,strlen($calendario->coleccion_id_logo)-2 ) );
                      } else {
                        $col_id_logo =array();
                      }   
                     ?>                

                      <?php foreach ($logos as $logo) { ?>
                            <div class="checkbox-inline">
                                <label for="coleccion_id_logo" class="ttip" title="<?php echo $logo->tooltip; ?>">

                                    <?php   
                                          if (in_array($logo->id, $col_id_logo)) {$marca='checked';} else {$marca='';}
                                    ?>

                                  <input <?php echo $marca; ?> type="checkbox" value="<?php echo $logo->id; ?>" name="coleccion_id_logo[]" id="coleccion_id_logo[]"><?php echo $logo->nombre; ?> 

                                </label>
                            </div>
                      <?php } ?>

              </div>

              <br/>

              <div id="cumpleano" class="row">   
                
                  <label style="padding-top: 7px;" class="col-xs-1 col-md-1 control-label">Cumpleaños</label>
                  
                  <div class="col-xs-2 col-md-2">
                    
                  <?php 
                    
                    echo '<select name="id_mes" id="id_mes" class="form-control">';
                      for ($i = 1; $i <= 12; $i++) {
                        if($calendario->id_mes==$i){
                          echo '<option selected value="'.$i.'">'.$i.'</option>';
                        }  else {
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }
                      } 
                    echo '</select>';





                  ?>
                    <span class="help-block">Mes</span>
                  </div>

                  <div class="col-xs-2 col-md-2" id="mesano">
                    
                  <?php 
                    $dia = 31; //es correcto es para enero siempre tiene 31 días

                    echo '<select name="id_dia" id="id_dia" class="form-control">';
                      for ($i = 1; $i <= $dia; $i++) {

                        if($calendario->id_dia==$i){
                          echo '<option selected value="'.$i.'">'.$i.'</option>';
                        }  else {
                          echo '<option value="'.$i.'">'.$i.'</option>';
                        }                        
                        
                      } 
                    echo '</select>';

                  ?>
                    <span class="help-block">Dia</span>
                  </div>

                
              </div>
              


              <div id="festividades" class="row">  
                <div class="col-xs-12 col-md-12">
                      <p class="form-control-static">
                        Selecciona la combinación de festividades religiosas de tu preferencia.
                      </p>
                  </div>          
                
                  <label style="padding-top: 7px;" class="col-xs-1 col-md-1 control-label">Festividades</label>
                  <div class="col-xs-2 col-md-2">
                    
                      <select name="id_festividad" id="id_festividad" class="form-control">
                          <option value="-1">Ninguno</option>
                          <?php foreach ( $festividades as $festividad ){ ?>
                             <?php if($calendario->id_festividad==$festividad->id){ ?>
                                <option selected value="<?php echo $festividad->id; ?>"><?php echo $festividad->nombre; ?></option>
                             <?php } else { ?>   
                                <option value="<?php echo $festividad->id; ?>"><?php echo $festividad->nombre; ?></option>
                             <?php } ?>   
                          <?php } ?>
                      </select>

                  </div>
                
              </div>






            </div>

            <div id="fechas_especiales">
              <div class="row">  
                <div class="col-xs-12 col-md-12">
                      <h3 class="form-control-static">FECHAS ESPECIALES</h3>
                  </div>  
                </div>  


              <div class="row">  
                <div class="col-xs-12 col-md-12">
                      <p class="form-control-static">
                        Agrega las fechas que harán tu año especial y único.
                      </p>
                  </div>  
                </div>  

              <div id="anos" class="row">  
                
                  <label style="padding-top: 7px;" class="col-xs-1 col-md-1 control-label">Año</label>
                  <div class="col-xs-2 col-md-2">
                    
                  <?php 
                    $ano = date('Y');
                    echo '<select name="id_ano" id="id_ano" class="form-control">';
                      for ($i = $ano; $i <= $ano+3; $i++) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                      } 
                    echo '</select>';
                  ?>

                  </div>
                
              </div>


              <div id="mes" class="row">   
                <div class="col-xs-4 col-md-2">
                      <p id="mes_mostrar" class="form-control-static">ENERO</p>
                  </div>  

                <div class="col-xs-5 col-xs-offset-3 col-md-3 col-md-offset-7">

                      <select name="id_lista" id="id_lista" class="form-control">
                          <option value="-1">Ninguno</option>
                          <?php foreach ( $listas as $lista ){ ?>
                              <option value="<?php echo $lista->id; ?>"><?php echo $lista->nombre; ?></option>
                          <?php } ?>
                      </select>

                      
                  </div>  

                </div>  



              <div id="meses" class="row">  
                <div class="col-xs-2 col-md-1"><a id="mes1" nmes="0" class="calendarioEventos-flecha1 botonMes" >Ene</a></div>
                
                <div class="col-xs-2 col-md-1"><a id="mes2" nmes="1" class="calendarioEventos-flecha1 botonMes" >Feb</a></div>
                
                <div class="col-xs-2 col-md-1"><a id="mes3" nmes="2" class="calendarioEventos-flecha1 botonMes" >Mar</a></div>
                <div class="col-xs-2 col-md-1"><a id="mes4" nmes="3" class="calendarioEventos-flecha1 botonMes" >Abr</a></div>
                <div class="col-xs-2 col-md-1"><a id="mes5" nmes="4" class="calendarioEventos-flecha1 botonMes" >May</a></div>
                <div class="col-xs-2 col-md-1"><a id="mes6" nmes="5" class="calendarioEventos-flecha1 botonMes" >Jun</a></div>
                <div class="col-xs-2 col-md-1"><a id="mes7" nmes="6" class="calendarioEventos-flecha1 botonMes" >Jul</a></div>
                <div class="col-xs-2 col-md-1"><a id="mes8" nmes="7" class="calendarioEventos-flecha1 botonMes" >Ago</a></div>
                <div class="col-xs-2 col-md-1"><a id="mes9" nmes="8" class="calendarioEventos-flecha1 botonMes" >Sep</a></div>
                <div class="col-xs-2 col-md-1"><a id="mes10" nmes="9" class="calendarioEventos-flecha1 botonMes" >Oct</a></div>
                <div class="col-xs-2 col-md-1"><a id="mes11" nmes="10" class="calendarioEventos-flecha1 botonMes" >Nov</a></div>
                <div class="col-xs-2 col-md-1"><a id="mes12" nmes="11" class="calendarioEventos-flecha1 botonMes" >Dic</a></div>
                
            
              </div>

              <hr/> 


              

              <div class="row">
                <div class="col-md-12"> <!-- g6 first-->
                  <div id="almanaque" diaseleccionado="">

                  </div>


                  <div class="row clearfix">
                    <div class="form-group">
                          <label for="texto_mes">Mensaje del mes (máximo 40 caracteres) </label>
                          <input type="text" class="form-control" id="texto_mes" placeholder="Mensaje de texto">
                      </div>
                      Escribe un pequeño mensaje para el mes... Qué te inspira?
                  </div>

                </div>
            
              </div>


              <div class="col-sm-12 col-md-12"> 
                
                <div class="col-sm-4 col-md-4">
                  <a href="#" type="button" class="btn btn-danger btn-block">Guardar Lista</a>
                </div>

                <div class="col-sm-4 col-md-4"></div>

                <div class="col-sm-4 col-md-4">
                  <input type="submit" id="cont_session3" class="btn btn-success btn-block" value="Continuar"/> 

                  <!--
                    <a href="guardar_lista" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalPregunta">
                  -->  
                    
                    
                  </a>




                </div>

              </div>


          </div>

    </section>  <!-- fin de section-->

<?php echo form_close(); ?>

</div>  <!-- fin del container-->



<?php $this->load->view( 'sitio/fotocalendario/footer_fotocalendario' ); ?>


<!-- Modal pregunta

<div class="modal fade bs-example-modal-lg" id="modalPregunta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
-->
<div class="modal fade" id="modalPregunta" role="dialog" >  
  <div class="modal-dialog">
        <div class="modal-content">
            
            <?php $dato['correo_activo'] = $correo_activo; ?>
            <?php $this->load->view( 'sitio/fotocalendario/guardar_lista', $dato ); ?>

        </div>
    </div>
</div>  


<!-- Modal no lista-->

<div class="modal fade" id="modalsinLista" role="dialog" >  
  <div class="modal-dialog">
        <div class="modal-content">
            <?php $this->load->view( 'sitio/fotocalendario/singuardar_lista' ); ?>
        </div>
    </div>
</div>  




<!-- Modal -->
        
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog" >
          
            <!-- Modal content-->
            <div class="modal-content">
              
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title infoTitulo">Sólo 18 caracteres</h4>
              </div>
              
              <div class="modal-body">
                <textarea class="contenido" rows="4" style="width:100%;"></textarea>
              </div>
              <!--
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div> 
              -->
            </div>
            
          </div>
        </div>
