<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Página Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2018 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

?>
        
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
	                                        <label class="col-md-12" for="padre"><?= $father; ?> </label>
	                                        <div class="col-md-12">
	                                            <select class="form-control" id="padre" name="padre">
                                                            <option value="">--- Seleccione una opci&oacute;n ---</option>
                                                            <?php foreach ($listaPadre->result() as $value) { 
                                                                        if($value->ID==$tipo){
                                                                            $selected="selected='selected'";
                                                                        }else{
                                                                            $selected="";
                                                                        }
                                                            ?>
                                                            <option value="<?= $value->ID;?>" <?=$selected ?>><?= $value->NOMBRE;?></option>
                                                            <?php
                                                            }?>
                                                        </select>
	                                        </div>
	                                    </div>
	                        </div>   
	                    </div>
	                </div>
	                <!-- Botón de envio de formulario -->
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
	                <!-- FIN Botón de envio de formulario -->
	            </form>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
