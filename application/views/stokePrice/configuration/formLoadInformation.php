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
                action="<?= base_url()?>StokePriceConfigurationDescription/saveLoad" id="form_sample_3" method="post" autocomplete="off" enctype="multipart/form-data">
	                <div class="row">
	                    <div class="col-sm-12">
	                        <div class="card">
	                            <div class="card-body">
	                                <h5 class="card-title"> Cargue de descripciones
                                	<small class="font-gray">Cargue el archivo con la informaci&oacute;n requerida. A continuaci&oacute;n, se lista la estructura que debe cargar.</small></h5>
                                	
                                	<div class="table-responsive">
                                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Campo</th>
                                                <th > Descripci&oacute;n</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	
                                            <tr>
                                                <td>C&oacute;digo</td>
                                                <td>Identificador del elemento, producto o servicio el cual se encuentra en la informaci&oacute;n de la aplicaci&oacute;n de &oacute;rdenes.</td>
                                            </tr>
                                            <tr>
                                                <td>Tipo</td>
                                                <td>Identifique si es Elemento, Producto o servicio. Para esto deber&aacute; ingresar 39,40 o 41 seg&uacute;n corresponda.</td>
                                            </tr>
                                            <tr>
                                                <td>Proveedor</td>
                                                <td>Identifique el proveedor para el elemento. Este campo no aplica para productos o servicios.</td>
                                            </tr>
                                            <tr>
                                                <td>Descripci&oacute;n</td>
                                                <td>Detalle del elemento, producto o servicio en donde se describe las caracter&iacute;sticas de este. </td>
                                            </tr>
                                            
                                            <tr>
                                                <td> Costo de Materiales</td>
                                                <td>Costos relacionados a los materiales, no aplica para Servicios, por tal raz&oacute;n se debe dejar vacio. </td>
                                            </tr>
                                            <tr>
                                                <td> Costo de  Mano de obra</td>
                                                <td>Costos relacionados a la mano de obra de los elementos, productos o servicios. </td>
                                            </tr>
                                            
                                            <tr>
                                                <td> Costo adicionales</td>
                                                <td>Costos adicionales en los que se puede incurrir para los elementos, productos o servicios. </td>
                                            </tr>
                                            
                                            <tr>
                                                <td> Origen</td>
                                                <td>Identifique el c&oacute;digo del pa&iacute;s de origen del elemento o producto. En el caso de servicio no aplica</td>
                                            </tr>
                                            <tr>
                                                <td> Tiempo de entrega</td>
                                                <td>Identifique el tiempo de entrega en d&iacute;as para el elemento o producto. En el caso de servicio no aplica</td>
                                            </tr>
                                            
                                            <tr>
                                                <td> Garantia</td>
                                                <td>Identifique el tiempo de garantia en meses para el elemento o producto. En el caso de servicio no aplica</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
    	                         	
    	                         	<div class="form-group " >
                                        <label class="col-md-12">
Ejemplo de cargue <br>
                                        <code>
                                            160106;40;1;PR&Oacute;TESIS  MOD DEBAJO DE RODILLA CON PIE K1/K2;100000;100000;10000;170;30;120 <br>
                                            160045;40;1;PR&Oacute;TESIS EN POLIPROPILENO DEBAJO DE RODILLA CON PIE SACH CON DEDOS;100000;100000;10000;170;30;120 <br>
                                            160133;40;1;PR&Oacute;TESIS TRANSTIBIAL PIE QUILLA CARBONO K3/4;100000;100000;10000;170;30;120 <br>

                                        </code>

                                        </label>
                                        
                                    </div>
    	                         	
    	                         	<div class="form-group " >
                                    	<label class="col-md-12" for="adjunto">Archivo que cargar <small class="font-gray">Tenga en cuenta que los campos antes descritos deben ser definidos a manera de columna dentro del archivo que se cargar&aacute; dentro de la aplicaci&oacute;n.</small> *</label>
                                        <div class="col-md-12">
            	                        	<input type="file" class="form-control" id="adjunto" name="adjunto">
            	                            <div class="form-control-feedback" > </div>
                                        </div>
                                    </div>
                                    
                                    
                                    
                					
                					
	                        	</div>
	                    	</div>
	                	</div>
	                </div>
	                
	                <!-- Botón de envio de formulario -->
	                <div class="row">
	                	<div class="col-sm-12">
	                	<a href="<?= base_url()?>StokePriceConfigurationDescription/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
	                		<button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
	                		<input type="hidden" name="tipo" id="tipo" value="<?= $tipo;?>">
	                		<input type="hidden" name="id" id="id" value="<?= $id;?>">
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
                
            <!-- ============================================================== -->
        		<!-- BEGIN PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        		
        		
				<!-- ============================================================== -->
				<!-- END PAGE JQUERY ROUTINES -->
        		<!-- ============================================================== -->
        
