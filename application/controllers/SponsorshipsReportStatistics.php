<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para visualizar el manejo de los tipos de elementos dentro de la aplicaci�n de �rdenes.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class SponsorshipsReportStatistics extends CI_Controller
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
         * Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "SponsorshipsReportStatistics/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "SponsorshipsReportStatistics/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la informaci�n de los parametros de la aplicaci�n
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
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
            $this->load->view('sponsorship/report/boardSponsorshipsReportStatistics', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/sponsorships/report/boardSponsorshipsReportStatisticsValidation');
            
            /**
             * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la p�gina (p�ginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }
    
    public function report()
    {
        /**
         * Ejecuto el reporte tomando en cuenta los parametros a�o mes seleccionados
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "SponsorshipsReportStatistics/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            //Traigo informaci�n para el reporte
            $data = null;
            $mes = $this->security->xss_clean($this->input->post('mes'));
            $ano = $this->security->xss_clean($this->input->post('ano'));
            $data ['mes']=$mes;
            $data ['ano']= $ano;
            //Ejecuto la verificaci�n de informaci�n
            $data['listaFondos'] = $this->SponsorshipModel->selectBalanceFromFund($mes, $ano);
            if($data['listaFondos']!=null){
                // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);
                // Informacion de la empresa
                $listParameters = $this->SystemModel->getParameters ( 1 );
                foreach ( $listParameters as $value ) {
                    $data ['direccion'] = $value->DIRECCION;
                    $data ['telefono'] = $value->TELEFONO;
                    $data ['correo'] = $value->CORREO;
                    $data ['empresa'] = $value->NOMBRE;
                }
                $usuarioSession = $this->Users->getNombresUsuario ( $this->session->userdata ( 'usuario' ) );
                $data ['nombreUsuario'] = $usuarioSession->NOMBRES;
                $data ['apellidoUsuario'] = $usuarioSession->APELLIDOS;
                $usuarioSession = $this->Users->getUsersProfile ( $this->session->userdata ( 'usuario' ) );
                $data ['especialidad'] = $usuarioSession->PERFIL;
                
                if ($this->security->xss_clean($this->input->post('tipo'))==1){
                    // Pinto plantilla principal
                    $this->load->view('sponsorship/report/printSponsorshipsReportStatistics', $data);
                    
                }else{
                    
                    // Pinto plantilla principal
                    $this->load->view('sponsorship/report/boardSponsorshipsReportStatisticsEnd', $data);
                    
                }
                
                
                /**
                 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
                 */
                
                // Pinto el final de la p�gina (p�ginas internas)
                showCommonEnds($this, null, null);
            }else{
                //NO hay informaci�n para el reporte
                // Pinto mensaje para retornar a la aplicaci�n
                $this->session->set_userdata ( 'id', $ano." - ".$mes );
                $this->session->set_userdata ( 'auxiliar', "reportNotInformation" );
                // Redirecciono la p�gina
                redirect ( base_url () . $mainPage );
            }
            
            
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

}

?>