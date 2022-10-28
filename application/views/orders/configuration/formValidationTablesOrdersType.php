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
                action="<?= base_url()?>OrdersConfigurationValidationTablesOrdersType/saveRegister" 
                id="form_sample_3" 
                method="post"       
                autocomplete="off">
	                <div class="row">
	                    <div class="col-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h4 class="card-title">Configuraci&oacute;n de tablas auxiliares para la gesti&oacute;n de la aplicaci&oacute;n</h4>
	                                <h6 class="card-subtitle"></h6>
	                                
	                            </div>
	                            <div class="form-group">
                               		<label class="col-md-12" for="nombre">Nombre *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombre" name="nombre" 
	                                    	value="<?= $nombre ?>"
	                                        placeholder="Ej. Elementos">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
	                           		<label class="col-md-12" for="despiece">Aplica despiece * </label>
	                                <div class="col-md-12">
	                                	<select class="form-control" id="despiece" name="despiece">
                                        	<option value="">--- Seleccione una opci&oacute;n ---</option>
                                            <?php foreach ($listaDespiece as $value) { 
                                                                        if($value->ID==$despiece){
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
	                           
                               <div class="form-group">
                               		<label class="col-md-12" for="tabla">Tabla principal *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="tabla" name="tabla" 
	                                    	value="<?= $nombreTabla ?>"
	                                        placeholder="Ej. esalud.ELEMENTOS">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="codigo">C&oacute;digo principal *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="codigo" name="codigo" 
	                                    	value="<?= $codigo ?>"
	                                        placeholder="Ej. ELEMEN_COD">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="nombreCampo">Nombre campo tabla principal *</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombreCampo" name="nombreCampo" 
	                                    	value="<?= $nombreCampo ?>"
	                                        placeholder="Ej. ELEMEN_NOM">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="grupo">Campo adicional </label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="grupo" name="grupo" 
	                                    	value="<?= $grupo ?>"
	                                        placeholder="Ej. ELEMEN_GRUPO">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               
                               <div class="form-group">
                               		<label class="col-md-12" for="tablaAuxiliar">Tabla auxiliar</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="tablaAuxiliar" name="tablaAuxiliar" 
	                                    	value="<?= $nombreTablaAuxiliar ?>"
	                                        placeholder="Ej. esalud.ELEMENTOS">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="codigoAuxiliar">C&oacute;digo auxiliar</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="codigoAuxiliar" name="codigoAuxiliar" 
	                                    	value="<?= $codigoAuxiliar ?>"
	                                        placeholder="Ej. ELEMEN_COD">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="nombreCampoAuxiliar">Nombre campo tabla auxiliar</label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="nombreCampoAuxiliar" name="nombreCampoAuxiliar" 
	                                    	value="<?= $nombreCampoAuxiliar ?>"
	                                        placeholder="Ej. ELEMEN_NOM">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
                               <div class="form-group">
                               		<label class="col-md-12" for="grupoAuxiliar">Campo adicional tabla auxiliar </label>
                                    <div class="col-md-12">
	                                    <input type="text" class="form-control" id="grupoAuxiliar" name="grupoAuxiliar" 
	                                    	value="<?= $grupoAuxiliar ?>"
	                                        placeholder="Ej. ELEMEN_GRUPO">
	                                    <div class="form-control-feedback" > </div>
                                    </div>
                               </div>
	                        </div> <!-- End Card -->   
	                    </div> <!-- End Col -->
	                </div> <!-- End Row -->
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
              
                
            
