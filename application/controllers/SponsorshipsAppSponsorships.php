<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para visualizar el manejo de los tipos de elementos dentro de la aplicación de órdenes.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class SponsorshipsAppSponsorships extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // Cargo modelos, librerias y helpers
        $this->load->model('SponsorshipModel');
        $this->load->model('EsaludModel');
        $this->load->model ( 'SystemModel' ); // Librerias del sistema
    }

    /**
     * ***********************************************************************************************************
     * RUTINAS PARA PINTAR FORMULARIOS
     * ****************************************************************************************************** *
     */
    public function board()
    {
        /**
         * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SponsorshipsAppSponsorships/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "SponsorshipsAppSponsorships/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la información de los parametros de la aplicación
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            $data['board'] = "Valores parametrizados";
            // Pinto los permisos del tablero de control
            $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
            $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
            $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);
            
            // Lista de listas
            $condicion = "PAT_PATROCINIOS.ANO='" . date('Y') . "' and PAT_PATROCINIOS.MES='" . date('m') . "'";
            $data['listaLista'] = $this->SponsorshipModel->selectSponsorShipDetailForCondition($condicion);
            
            // Pinto plantilla principal
            $this->load->view('sponsorship/operation/boardSponsorshipsAppSponsorships', $data);
            
            /**
             * Fin: Información relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la página (páginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function newRegister()
    {
        /**
         * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SponsorshipsAppSponsorships/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "SponsorshipsAppSponsorships/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la información de los parametros de la aplicación
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            $data['board'] = "Valores parametrizados";
            // Pinto los permisos del tablero de control
            $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
            $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
            $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);
            
            // Lista de tipos de documento de identidad
            $data['listaTipoDocumento'] = $this->FunctionsAdmin->selectValoresListaAdministracion('TIPO_DOCPERSONA', '1');
            // Lista de tipos de patrocinios
            $data['listaTipo'] = $this->FunctionsGeneral->selectValoresListaTabla("PAT_TIPO");
            // Listo los fondos
            $data['listaFondos'] = $this->SponsorshipModel->selectBalanceFromFund(date('m'), date('Y'));
            
            // Cargo la vista del formulario para la creación del patrocinio
            $this->load->view('sponsorship/operation/newRegisterDefinition', $data);
            // Cargo validación de formulario
            $this->load->view('validation/sponsorships/process/formNewRegisterValidation');
            
            /**
             * Fin: Información relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la página (páginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function inactive($id)
    {
        /**
         * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SponsorshipsAppSponsorships/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $data = null;
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Información relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                
                $data['idPatrocinio'] = $this->encryption->encrypt($id);
                $data['patrocinio'] = $id;
                $data['estado'] = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "ESTADO", $id);
                ;
                $data['tipo'] = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "ID_TIPO", $id);
                ;
                $data['idTipo'] = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "TIPO_DOC", $id);
                ;
                $data['documento'] = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "DOCUMENTO", $id);
                $tempo=$this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "FECHA", $id);
                $data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("ADM_CALENDARIO", "FECHA", $tempo);                
                // Cargo vista
                $this->load->view('sponsorship/operation/inactiveDefinition', $data);
                // Cargo validación de formulario
                $this->load->view('validation/sponsorships/process/formInactiveValidation');
                
                /**
                 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                 */
                
                // Pinto el final de la página (páginas internas)
                showCommonEnds($this, null, null);
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . "OrdersConfigurationDiagnosis/board");
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }
    
    
    public function viewRegister($id)
    {
        /**
         * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SponsorshipsAppSponsorships/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $data = null;
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Información relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                
                $data['idPatrocinio'] = $this->encryption->encrypt($id);
                $data['patrocinio'] = $id;
                $data['estado'] = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "ESTADO", $id);
                ;
                $data['tipo'] = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "ID_TIPO", $id);
                ;
                $data['idTipo'] = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "TIPO_DOC", $id);
                ;
                $data['documento'] = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "DOCUMENTO", $id);
                ;
                $data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "FECHA", $id);
                ;
                $cotizacion=$this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "IDCOTI", $id);
                $data['cotizacion'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $cotizacion);
                $data['observacion'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "OBSERVACIONES", $id)).
                                       " <br><b>Observaci&oacute;n de anulaci&oacute;n: ".
                                       $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "ANULACION", $id)).
                                       "</b>";
                // Informacion de la empresa
                $listParameters = $this->SystemModel->getParameters ( 1 );
                foreach ( $listParameters as $value ) {
                    $data ['direccion'] = $value->DIRECCION;
                    $data ['telefono'] = $value->TELEFONO;
                    $data ['correo'] = $value->CORREO;
                    $data ['empresa'] = $value->NOMBRE;
                }
                
                if($data['tipo']!='1'){
                    $data['descripcion'] =  $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("PAT_PATESP","PATROCINIO","ID_PATROCINIO",$id));
                    $data['valor'] =  $this->FunctionsGeneral->getFieldFromTableNotId("PAT_PATESP","VALOR","ID_PATROCINIO",$id);
                }else{
                    $data['valor'] =  $this->FunctionsGeneral->getFieldFromTableNotId("PAT_PATART","VALOR","ID_PATROCINIO",$id);
                }
                //lISTADO DE FONDOS
                $data['listaFondos'] = $this->SponsorshipModel->selectSponsorShipDetailForFunds($id) ;
                
                
                
                $usuarioSession = $this->Users->getNombresUsuario ( $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "UCREA", $id));
                $data ['nombreUsuario'] = $usuarioSession->NOMBRES;
                $data ['apellidoUsuario'] = $usuarioSession->APELLIDOS;
                $usuarioSession = $this->Users->getUsersProfile ( $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "UCREA", $id) );
                $data ['especialidad'] = $usuarioSession->PERFIL;
                // Cargo vista
                $this->load->view('sponsorship/operation/printSponsorshipInformation', $data);
                // Cargo validación de formulario
                $this->load->view('validation/sponsorships/process/formInactiveValidation');
                
                /**
                 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                 */
                
                // Pinto el final de la página (páginas internas)
                showCommonEnds($this, null, null);
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    /**
     * ***********************************************************************************************************
     * RUTINAS PARA GUARDAR INFORMACIÒN
     * ****************************************************************************************************** *
     */
    public function saveRegister()
    {
        /**
         * Rutina para guardar los patrocinios teniendo en cuenta el tipo de cada uno de ellos.
         */
        
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SponsorshipsAppSponsorships/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $tipoDoc = $this->security->xss_clean($this->input->post('tipoDoc'));
            $documento = $this->security->xss_clean($this->input->post('documento'));
            $tipo = $this->security->xss_clean($this->input->post('tipo'));
            $cotizacion = $this->security->xss_clean($this->input->post('cotizacion'));
            $descripcion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('descripcion')));
            $total = $this->security->xss_clean($this->input->post('total'));
            $patrocinado = $this->security->xss_clean($this->input->post('patrocinado'));
            $pagar = $this->security->xss_clean($this->input->post('pagar'));
            $observacion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion')));
            
            // obtengo VALOR ACTUAL DE LOS PATROCINIOS
            $id = $this->FunctionsGeneral->getFieldFromTableNotId("PAT_CONSECUTIVO", "ID", "ESTADO", ACTIVO_ESTADO);
            // echo $id."<BR>";
            // Defino estado
            if ($tipo == 1) {
                $estado = SPONSOR_WAIT_STATE;
            } else {
                $estado = SPONSOR_OK_STATE;
            }
            
            // Inserto el patrocinio
            $this->SponsorshipModel->insertSponsorShipHead($id, $tipo, $tipoDoc, $documento, $cotizacion, date('m'), date('Y'), $observacion, $this->session->userdata('usuario'), $estado, $this->session->userdata('usuario'));
            
            // Debo actualizar el id del patrocinio
            $tempo = $id + 1;
            $this->FunctionsGeneral->updateByField("PAT_CONSECUTIVO", "ID", $tempo, "ESTADO", ACTIVO_ESTADO, $this->session->userdata('usuario'));
            if ($tipo == 1) {
                // Patrocinio de servicios
                $this->SponsorshipModel->insertSponsorShipDetailFromStokePrice($id,$total, $this->session->userdata('usuario'));
                $message = "sponsorshipOk";
            } else {
                // Otros patrocinios
                $this->SponsorshipModel->insertSponsorShipDetailSpecial($id, $descripcion, $total, $this->session->userdata('usuario'));
                $message = "sponsorshipOk";
            }
            // Traigo los fondos
            $fondos = $this->SponsorshipModel->selectBalanceFromFund(date('m'), date('Y'));
            
            // Inserto el valor de los fondos
            foreach ($fondos as $value) {
                $tempo = $this->security->xss_clean($this->input->post('valor' . $value->ID));
                if($tempo>0){
                    $this->SponsorshipModel->insertSponsorShipFund($id, $value->ID_FONDOS, $tempo, $this->session->userdata('usuario'));
                    if ($tipo != 1) {
                        // Actualizo el valor del fondo
                        $saldo = $this->FunctionsGeneral->getFieldFromTableNotId("PAT_FONSAL", "VALOR", "ID", $value->ID) - $tempo;
                        $this->FunctionsGeneral->updateByField("PAT_FONSAL", "VALOR", $saldo, "ID", $value->ID, $this->session->userdata('usuario'));
                        //Actualizo el histórico del fondo
                        $this->SponsorshipModel->insertOperationBalanceFund(
                            $value->ID,
                            2,
                            date('m'),
                            date('Y'),
                            abs($tempo),
                            $this->session->userdata ( 'usuario' ));
                    }
                }
                
            }
            // Pinto mensaje para retornar a la aplicación
            $this->session->set_userdata('id', $id);
            $this->session->set_userdata('auxiliar', $message);
            // Redirecciono la página
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function saveInactive()
    {
        /**
         * Rutina para guardar los patrocinios teniendo en cuenta el tipo de cada uno de ellos.
         */
        
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SponsorshipsAppSponsorships/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
           $observacion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion')));
           //Obtengo estado del patrocinio
           $estado = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "ESTADO", $id);
          
            // Actualizo información del patrocinio
            $this->FunctionsGeneral->updateByField("PAT_PATROCINIOS", "ANULACION", $observacion, "ID", $id, $this->session->userdata('usuario'));
            // Verifico si esta legalizado
            if($estado==ACTIVO_ESTADO){
               $fondos= $this->SponsorshipModel->selectSponsorShipDetailForFunds($id);
               foreach ($fondos as $value){
                   //Recorro los fondos y actualizo los valores
                   //echo $value->ID_FONDOS." ".$value->ID." ".$value->PORCENTAJE."<br>";
                   //Obtengo saldo actual
                   $saldo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("PAT_FONSAL", "VALOR", "ID_FONDOS", $value->ID_FONDOS, "MES", date('m'), "ANO", date('Y')) + $value->PORCENTAJE;
                   // Si es legalizado actualizo los fondos relacionados al patrocinio
                   $this->FunctionsGeneral->updateByField("PAT_FONSAL","VALOR",$saldo,"ID_FONDOS", $value->ID_FONDOS, $this->session->userdata('usuario'), "MES", date('m'), "ANO", date('Y'));
                   //Debo obtener el id
                   $idFonsal= $this->FunctionsGeneral->getFieldFromTableNotIdFields("PAT_FONSAL", "ID", "ID_FONDOS", $value->ID_FONDOS, "MES", date('m'), "ANO", date('Y'));
                   //Actualizo el histórico del fondo
                   $this->SponsorshipModel->insertOperationBalanceFund(
                       $idFonsal,
                       1,
                       date('m'),
                       date('Y'),
                       abs($value->PORCENTAJE),
                       $this->session->userdata ( 'usuario' ));
               }
            }
            
            
            //Anulo el patrocinio
            $this->FunctionsGeneral->updateByField("PAT_PATROCINIOS", "ESTADO", INACTIVO_ESTADO, "ID", $id, $this->session->userdata('usuario'));
            
            // Pinto mensaje para retornar a la aplicación
            $this->session->set_userdata('id', $id);
            $this->session->set_userdata('auxiliar', 'sponsorshipInactive');
            // Redirecciono la página
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }
    
    public function approve($id)
    {
        /**
         * Rutina para guardar los patrocinios teniendo en cuenta el tipo de cada uno de ellos.
         */
        
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SponsorshipsAppSponsorships/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $id = $this->encryption->decrypt($id);
            //Obtengo estado del patrocinio
            $estado = $this->FunctionsGeneral->getFieldFromTable("PAT_PATROCINIOS", "ESTADO", $id);
            
            
            // Verifico si esta legalizado
            if($estado=='P'){
                $fondos= $this->SponsorshipModel->selectSponsorShipDetailForFunds($id);
                foreach ($fondos as $value){
                    //Recorro los fondos y actualizo los valores
                    //echo $value->ID_FONDOS." ".$value->ID." ".$value->PORCENTAJE."<br>";
                    //Obtengo saldo actual
                    $saldo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("PAT_FONSAL", "VALOR", "ID_FONDOS", $value->ID_FONDOS, "MES", date('m'), "ANO", date('Y')) - $value->PORCENTAJE;
                    // Si es legalizado actualizo los fondos relacionados al patrocinio
                    $this->FunctionsGeneral->updateByField("PAT_FONSAL","VALOR",$saldo,"ID_FONDOS", $value->ID_FONDOS, $this->session->userdata('usuario'), "MES", date('m'), "ANO", date('Y'));
                    //Actualizo el histórico del fondo
                    $this->SponsorshipModel->insertOperationBalanceFund(
                        $value->ID_FONDOS,
                        2,
                        date('m'),
                        date('Y'),
                        abs($value->PORCENTAJE),
                        $this->session->userdata ( 'usuario' ));
                }
            }
            
            
            //Anulo el patrocinio
            $this->FunctionsGeneral->updateByField("PAT_PATROCINIOS", "ESTADO", ACTIVO_ESTADO, "ID", $id, $this->session->userdata('usuario'));
            $page = "SponsorshipsAppSponsorships/viewRegister/". $this->encryption->encrypt($id);
            // Pinto mensaje para retornar a la aplicación
            $this->session->set_userdata('id', $id);
            $this->session->set_userdata('auxiliar', 'sponsorshipApprove');
            // Redirecciono la página
            redirect(base_url() . $page);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }
}

?>