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
                                <h4 class="card-title">Estad&iacute;sticas por fondos. Per&iacute;odo <?= date('m');?> - <?= date('Y');?></h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                                        <thead>
            								<tr>
            									<th>Fondo</th>
            									<th class="text-right" >Saldo inicial</th>
            									<th class="text-right" >Valor Autorizado</th>
            									<th class="text-right" >Saldo Actual</th>
            								</tr>
            							</thead>
            							<tbody>
            									<?php 
            									if(count($listaFondos)>0){
            									    $inicial=0;
            									    $autorizado=0;
            									    $actual=0;
            									    foreach ($listaFondos as $value){
            									
            									?>
            								<tr>
            									<td><?= $value->NOMBRE;?></td>
            									<td class="text-right" ><?php 
            									
            									$condicion= "and PAT_FONSAL.ID_FONDOS='".$value->ID_FONDOS."'";
            									$a=monthYearBefore($mes, $ano);
            									$array= $this->SponsorshipModel->selectBalanceFromFund($a[0],$a[1],$condicion);
            									if(count($array)>0){
                									foreach ($array as $val){
                									    $temporal= $val->VALOR;
                									}
            									}else{
            									    $temporal=0;
            									    $inicial=$inicial+$temporal;
            									    
            									}$inicial=$inicial+$temporal;
            									echo numberFormatEvolution($temporal);
            									?></td>
            									
            									<td class="text-right" >
            									<?php 
            									$array= $this->SponsorshipModel->selectSponsorShipInformationFunds($value->ID_FONDOS,$mes,$ano);
            									if(count($array)>0){
                									foreach ($array as $val){
                									    $temporal= $val->PORCENTAJE;
                									}
                									$autorizado=$autorizado+$temporal;
                									
            									}else{
            									    $temporal=0;
            									    $autorizado=$autorizado+$temporal;
            									    
            									}
            									echo numberFormatEvolution($temporal);?>
            									</td>
            									
            									
            									<td class="text-right" >
            									<?php
            									$actual=$actual+$value->VALOR;
            									echo numberFormatEvolution($value->VALOR);?>
            									</td>
            								</tr>	
            									
            									<?php 
            									    }
            									}
            									?>
            								
            							</tbody>
            							<tfoot>
            								<tr style="background-color: silver;">
            									<th>Totales</th>
            									<th class="text-right" ><?= numberFormatEvolution($inicial);?></th>
            									<th class="text-right" ><?= numberFormatEvolution($autorizado);?></th>
            									<th class="text-right" ><?= numberFormatEvolution($actual);?></th>
            								</tr>
            							</tfoot>
                                    </table>
                                </div>
                                <div class="row">
        				        	<div class="col-sm-12">
        				            	<a href="<?= base_url()?>/SponsorshipsReportStatistics/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
        		                        	<i class="fa fa-arrow-left"></i>
        		                            <span class="hidden-xs"> Retornar</span>
        				                </a>
        				            </div>   
        				            <div class="col-sm-12">
        				            	<br>
        				            </div> 
        				       </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
