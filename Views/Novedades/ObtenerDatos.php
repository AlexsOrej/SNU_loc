<?php
      $novedad= $this->model->Ver($_REQUEST['my_modal']);
      foreach($novedad as $stms ){
          $_SESSION['print']=$stms->otro_si;
          $_SESSION['id_novedad']=$stms->id;
	    echo "  
	     <div class='col-lg-12 col-md-12col-sm-12 col-xs-12'>
                    <div class='card'>
                        <div class='header'>
                            <h2>
                                Otro Si 
                            </h2>
                        </div>
                        
                        <div class='body'>
                        <p class='text-justify'>". $stms->otro_si ."<br>
                        <a href='?c=novedades&a=otroSi' class='btn btn-success' target='_blank'><i class='glyphicon  glyphicon-print'></i></a>
                        </p>
                        
                        </div>
                    </div>
            </div>
            
            <div class='col-lg-12 col-md-12col-sm-12 col-xs-12'>
                    <div class='card'>
                        <div class='header'>
                            <h2>
                                Descripción
                            </h2>
                        </div>
                        
                        <div class='body'>
                        
                           <p class='text-justify'>Descripción:". $stms->descripcion. "</p>
                          
                           
                        </div>
                    </div>
            </div>
            <div class='col-lg-12 col-md-12col-sm-12 col-xs-12'>
                    <div class='card'>
                        <div class='body'>
                           <a href='https://sgvalle.com/usuarios/archivos/".$stms->usuario_id ."/doc_renuncia.pdf' class='btn btn-success' target='_blank'>Documento Soporte</a>
                         </div>
                    </div>
            </div>
	       ";
	       }