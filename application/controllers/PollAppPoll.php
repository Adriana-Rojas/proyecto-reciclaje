<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para visualizar el manejo de los convenios de las brigadas
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class PollAppPoll extends CI_Controller
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
    public function index()
    {
        // Pinto mensaje para retornar a la aplicación
        $mainPage = "PollAppPoll/board/";
        // Redirecciono la página
        redirect(base_url() . $mainPage);
    }

    public function board($id = null)
    {
        // Pinto la plantilla de la encuesta
        $this->session->sess_destroy();
        $data['clase'] = null;
        $data['validador'] = null;
        $data['fecha'] = cambiaHoraServer(2);
        if ($id != '') {
            //Descifro mensaje
            $id = $this->encryption->decrypt($id);
            
            $data['validador'] = true;
        } else {
            $data['validador'] = false;
        }
        //Listo las encuestas activas
        
        
        
        // Preguntas
        $data['encuestas'] = $this->PollsModel->getListPolls();
        $data['id'] = $id;
        $this->load->view('poll/board', $data);
    }
    
    public function poll ($id = null)
    {
        // Pinto la plantilla de la encuesta
        $this->session->sess_destroy();
        $data['clase'] = null;
        $data['validador'] = null;
        $data['fecha'] = cambiaHoraServer(2);
        if ($id != '') {
            //Descifro mensaje
            $id = $this->encryption->decrypt($id);
            
            $data['validador'] = true;
        } else {
            $id=$this->security->xss_clean($this->input->post('encuesta'));
            $data['validador'] = false;
        }
        
        // Verifico si aplica datos personales
        $data['datos'] = $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA", "DATOPERSONAL", $id);
        // Verifico si aplica observación
        $data['observacion'] = $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA", "OBSERVACION", $id);
        // Descripción de la encuesta
        $data['descripcion'] = $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA", "DESCRIPCION", $id);
        
        // Preguntas
        $data['preguntas'] = $this->PollsModel->getListValueQuestionsPollDetail($id);
        $data['id'] = $id;
        $this->load->view('poll/home', $data);
    }

    /**
     * ***********************************************************************************************************
     * RUTINAS PARA GUARDAR INFORMACIÒN
     * ****************************************************************************************************** *
     */
    public function saveRegister()
    {
        /**
         * Guardo la información de la encuesta (Calificador)
         */
        // Encuesta actual
        $idEncuesta = $this->security->xss_clean($this->input->post('id'));
        
        
        $fecha= $this->security->xss_clean($this->input->post('fecha'));
        $fecha= $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fecha);
        // Guardo la cabecera de la encuesta
        $id = $this->PollsModel->insertPollEvaluation(
            $fecha,
            $this->security->xss_clean($this->input->post('hora')), 
            $idEncuesta, 
            null, 
            null, 
            $this->encryption->encrypt($this->security->xss_clean($this->input->post('nombres'))), 
            $this->encryption->encrypt($this->security->xss_clean($this->input->post('apellidos'))),
            $this->encryption->encrypt($this->security->xss_clean($this->input->post('correo'))), 
            $this->encryption->encrypt($this->security->xss_clean($this->input->post('telefono'))),
            null, 
            $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion'))), 
            'web');
       
         //Preguntas
            $preguntas = $this->PollsModel->   getListValueQuestionsPoll($idEncuesta);
        // Inserto respuesta
        foreach ($preguntas as $pregunta){
               
            $this->PollsModel->insertPollEvaluationDetail($id, $this->security->xss_clean($this->input->post('pregunta' .$pregunta->ID_PREGUNTA)), 'web');
        }
       
        // Pinto mensaje para retornar a la aplicación
        $mainPage = "PollAppPoll/poll/" . $this->encryption->encrypt($idEncuesta);
        // Redirecciono la página
        redirect(base_url() . $mainPage);
    }
}

?>