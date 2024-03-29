<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						P�gina Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2018 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

?>


				<!-- ============================================================== -->
                <!-- JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                <?php if($mascara){?>
    			<script src="<?= base_url()?>assets/dist/js/pages/mask.js"></script>
    			<?php }?>
    			<!-- ============================================================== -->
                <!-- JavaScript para pintar campos adicionales -->
                <!-- ============================================================== -->
                
        
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <form class=" form-horizontal" role="form" 
                action="<?= base_url()?><?= $pagina ?>" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title"><?= $title;?></h4>
	                                <h6 class="card-subtitle"></h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="nombre"><?= $mainField;?> *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="<?= $placeHolder;?>">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="apoyo"><?= $apoyoField;?> *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="apoyo" name="apoyo" <?php if($mascara){?> data-mask="a999" <?php }?>
	                                    	value="<?= $apoyo ?>"
	                                        placeholder="<?= $placeHolderApoyo;?>">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                        </div>   
	                    </div>
	                </div>
	                <!-- Bot�n de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                		<a href="<?= base_url()?><?= $mainPage ?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
                            <input type="hidden" name="valida" id="valida" value="<?= $valida;?>">
	                	</div>   
	                	<div class="col-sm-12">
	                	<br>
	                	</div> 
	                </div>
	                <!-- FIN Bot�n de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
