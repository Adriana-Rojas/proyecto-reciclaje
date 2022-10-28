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
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Resultado del cargue</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>C&oacute;digo</th>
                                                <th >Resultado</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                        	for ($i=0;$i<count($listaCodigos);$i++){
                                        	    
                                                    ?>
                                            <tr>
                                                <td><?= $listaCodigos[$i];?></td>
                                                 <td>
                                                    <?= $listaErrores[$i];?>
                                                </td>
                                                
                                                
                                            </tr>
                                            <?php 
                                            }//end for
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                    
                                </div>
                                
                            </div>
                        </div>
                        <a href="<?= base_url()."/".$mainPage?>" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
                                                <i class="fa fa-arrow-left"></i>
                                                <span class="hidden-xs"> Retornar</span>
                                            </a>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
