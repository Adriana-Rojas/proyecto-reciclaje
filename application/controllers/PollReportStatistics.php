<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para el reporte de estadísticas.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class PollReportStatistics extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Cargo modelos, librerias y helpers
        $this->load->model('PollsModel');
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
        $mainPage = "PollReportStatistics/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
             $data = null;
            // Pinto la cabecera principal de las páginas internas
             showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");
            // Pinto la información de los parametros de la aplicación
            
             
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            $data['fecha'] =cambiaHoraServer(2);
            
            $data['encuestas'] = $this->PollsModel->getListPolls();
            
            
            // Pinto plantilla principal
            $this->load->view('poll/report/boardPollReportStatistics', $data);
            // Cargo validación de formulario
            $this->load->view('validation/polls/report/boardPollsReportStatisticsValidation');
            
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
    
    
    public function report()
    {
        /**
         * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "PollReportStatistics/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");
            // Pinto la información de los parametros de la aplicación
            
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Verifo encuesta actual
            $id = $this->security->xss_clean($this->input->post('encuesta'));
            $periodo=$this->security->xss_clean($this->input->post('periodo'));
            $data['periodo'] =$periodo;
            $fechas =explode(' - ', $periodo);
            $fecha = 
            
            $data['fechaInicial'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fechas[0]);
            $data['fechaFinal'] =  $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fechas[1]);
            // Preguntas
            $data['preguntas'] = $this->PollsModel->getListValueQuestionsPollDetail($id);
            $data['informe'] =1;
            
            
            
            // Pinto plantilla principal
            $this->load->view('poll/report/statisticsPollReportStatistics', $data);
            
            
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

    

    /**
     * ***********************************************************************************************************
     * RUTINAS PARA GUARDAR INFORMACIÒN
     * ****************************************************************************************************** *
     */
    
}

?>