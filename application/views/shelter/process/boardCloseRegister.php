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
                                <h4 class="card-title">Listado de reservas activas</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive">
                                    <table id="myTable"  class="table m-t-30 table-hover " data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                
                                                <th >Documento</th>
                                                <th >Hu&eacute;sped</th>
                                                <th >Tipo</th>
                                                <th >Habitaci&oacute;n</th>
                                                <th >Cama</th>
                                                <th>Fecha Reserva</th>
                                                <th>Acci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        	<?php 
                                                        if($listaLista != null){
                                                            $i=1;
                                                            foreach ($listaLista as $value) {
                                                            	//Obtengo el id del hogar de paso
                                                            	
                                                            	$id=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
                                                            			"HP_HOGARPASO",
                                                            			"ID",
                                                            			"ID_HABCAMA",
                                                            			$value->ID, 
                                                            			"FECHAINICIO",
                                                            			defineFormatoFecha($value->INICIO, FORMAT_DATE));
                                                            	if($value->ID_TIPOUSUARIO!=1){
                                                            		//Todos menos pacientes
                                                            		$nombre=$this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("HP_USUARIO","NOMBRES","ID_ENCUSUARIO",$value->ID_USUARIO))." ".
                                                            				$this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("HP_USUARIO","APELLIDOS","ID_ENCUSUARIO",$value->ID_USUARIO));
                                                            	}else{
                                                            		//Pacientes
                                                            		$nombre=$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
                                                            				"T_PACIENTES",
                                                            				"PRI_NOM_PCTE",
                                                            				"TP_ID_PCTE",
                                                            				$this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA","VALOR",$value->TIPODOC), 
                                                            				"NUM_ID_PCTE",
                                                            				$value->DOCUMENTO)." ".
                                                            				$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
                                                            				"T_PACIENTES",
                                                            				"SEG_NOM_PCTE",
                                                            				"TP_ID_PCTE",
                                                            				$this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA","VALOR",$value->TIPODOC), 
                                                            				"NUM_ID_PCTE",
                                                            				$value->DOCUMENTO)." ".
                                                            				$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
                                                            				"T_PACIENTES",
                                                            				"PRI_APELL_PCTE",
                                                            				"TP_ID_PCTE",
                                                            				$this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA","VALOR",$value->TIPODOC), 
                                                            				"NUM_ID_PCTE",
                                                            				$value->DOCUMENTO)." ".
                                                            				$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
                                                            				"T_PACIENTES",
                                                            				"SEG_APELL_PCTE",
                                                            				"TP_ID_PCTE",
                                                            				$this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA","VALOR",$value->TIPODOC), 
                                                            				"NUM_ID_PCTE",
                                                            				$value->DOCUMENTO);
                                                            	}
                                                    ?>
                                            <tr>
                                                <td><?= $i;?></td>
                                                 
                                               <td>
                                                    <?= $this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA","VALOR",$value->TIPODOC)." ".$value->DOCUMENTO;?>
                                                </td>
                                                <td>
                                                    <?= $nombre;?>
                                                </td>
                                                <td>
                                                    <?= $value->TIPOUSUARIO;?>
                                                </td>
                                                <td>
                                                    <?= $value->HABITACION;?>
                                                </td>
                                                <td>
                                                    <?= $value->CAMA;?>
                                                </td>
                                                <td> <?= $this->FunctionsGeneral->getFieldFromTable("ADM_CALENDARIO","FECHA",$value->INICIO)." - ".$this->FunctionsGeneral->getFieldFromTable("ADM_CALENDARIO","FECHA",$value->FIN);?>
                                                </td>
                                                <td>
                                                    <!--  
                                                    <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                                    -->
                                                    <div class="btn-group">
                                                    	<button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown" 
                                                        		aria-haspopup="true" aria-expanded="false">
								                                       <i class="fa fa-bars"></i> 
                                                    	</button>
                                                        	<div class="dropdown-menu animated lightSpeedIn">
                                                            	<?php
                                                                	if($listaBoard!=null){
                                                                    	foreach ($listaBoard as $valueBoard) {
                                                                                
																?>
                                                                <a class="dropdown-item" 
                                                                	href="<?= base_url().$valueBoard->PAGINA.$this->encryption->encrypt($id); ?>" >
                                                                    <i class="<?= $valueBoard->ICONO ?>"></i> 
                                                                    <?= $valueBoard->NOMBRE ?> 
                                                                </a>
                                                                <?php 
                                                                    	}
                                                                	} ?>
                                                           </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php 
                                                            $i++;
                                                             
                                                            }//end foreach
                                                    }//end if
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
				        	<div class="col-sm-12">
				            	<a href="<?= base_url()?>ShelterAppShelter/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
		                        	<i class="fa fa-arrow-left"></i>
		                            <span class="hidden-xs"> Retornar</span>
				                </a>
				                     <?php
                                                if ($botonesBoard!=null){
		                                                foreach ($botonesBoard as $value) {
		                                            ?>
		                                            <a href="<?= base_url().$value->PAGINA; ?>" class="btn btn-info btn-rounded"> 
		                                                <i  class="<?= $value->ICONO ?>"></i>
		                                                <span class="hidden-xs"> <?= $value->NOMBRE ?></span>
		                                            </a>
		                                            <?php 
		                                                }
                                                } ?>
				            </div>   
				            <div class="col-sm-12">
				            	<br>
				            </div> 
				       </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                
            
