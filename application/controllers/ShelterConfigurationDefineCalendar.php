<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para definir los diferentes procesos de órdenes
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class ShelterConfigurationDefineCalendar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // Cargo modelos, librerias y helpers
        $this->load->model('ShelterModel'); // Librerias del sistema
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
        $mainPage = "ShelterConfigurationDefineCalendar/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la página principal
            $mainPage = "ShelterConfigurationDefineCalendar/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // /Inicializo variables de los campos del formulario
            $data['pagina'] = "ShelterConfigurationDefineCalendar/saveRegister";
            $data['mainPage'] = $mainPage;
            $data['valida'] = $this->encryption->encrypt('newRegister');
            
            // Cargo vista
            $this->load->view('shelter/configuration/formDefineCalendar', $data);
            // Cargo validación de formulario
            $this->load->view('validation/shelter/configuration/formGenerateCalendarValidation');
            
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
    public function saveRegister()
    {
        /**
         * Genero la definición del calendario para el año actual
         */
        $mainPage = "ShelterConfigurationDefineCalendar/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
            $mainPage = "ShelterConfigurationDefineCalendar/board";
            $ano = $this->security->xss_clean($this->input->post('ano'));
            $valor = $ano . '/01/01';
            $idFecha=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO","ID","FECHA",$valor);
            if ($this->FunctionsGeneral->getQuantityFieldFromTable("HP_HOGARPASO", "FECHAINICIO", $idFecha) > 0) {
                // Indico que el proceso no ha generado correctamente
                $mensaje = "calendarError";
            } else {
                // Genero calendario para el año
                $return = generarCalendario($ano, $ano, 0);
                $condicion = "and HP_HABCAMA.ESTADO='" . ACTIVO_ESTADO . "'";
                $relacion = $this->ShelterModel->selectListDefineRelation($condicion);
                // Recorro los arrays
                foreach ($relacion as $value) {
                    for ($j = 0; $j < count($return); $j ++) {
                        
                        //Obtengo el ide respectivo
                        $idFecha=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO","ID","FECHA",$return[$j]);
                        // Inserto el respectivo valor
                        $this->ShelterModel->insertShelter($value->ID, $idFecha, $this->session->userdata('usuario'));
                    }
                }
                
                // Indico que el proceso se ha generado correctamente
                $mensaje = "calendarOk";
            }
            // Pinto mensaje para retornar a la aplicación
            $this->session->set_userdata('id', $ano);
            $this->session->set_userdata('auxiliar', $mensaje);
            // Redirecciono la página
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }
}

?>