<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para definir los diferentes procesos de �rdenes
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class OrdersConfigurationDiagnosis extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // Cargo modelos, librerias y helpers
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
        $mainPage = "OrdersConfigurationDiagnosis/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "OrdersConfigurationDiagnosis/board";
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
            $data['listaLista'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_DIAGNOSTICO");
            
            // Pinto plantilla principal
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('common/boards/board', $data);
            
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

    public function newRegister()
    {
        /**
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationDiagnosis/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la p�gina principal
            $mainPage = "OrdersConfigurationDiagnosis/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['id'] = null;
            $data['mascara'] = true;
            $data['nombre'] = null;
            $data['apoyo'] = null;
            // Inicializo variables de los campos del formulario
            $data['title'] = "Crear diagn&oacute;sticos m&eacute;dicos ";
            $data['mainField'] = "Nombre del diagn&oacute;stico";
            $data['apoyoField'] = "C&oacute;digo del diagn&oacute;stico";
            $data['placeHolder'] = "Ej.  Amputaci&oacute;n de miembros ";
            $data['placeHolderApoyo'] = "Ej.  Y835 ";
            $data['pagina'] = "OrdersConfigurationDiagnosis/saveRegister";
            $data['mainPage'] = $mainPage;
            
            // Cargo vista
            $this->load->view('common/forms/formTwoValues', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/orders/configuration/OrdersConfigurationDiagnosisValidation');
            
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

    public function edit($id)
    {
        /**
         * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationDiagnosis/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_DIAGNOSTICO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
                $mainPage = "OrdersConfigurationDiagnosis/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['id'] = $this->encryption->encrypt($id);
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_DIAGNOSTICO", "NOMBRE", $id);
                $data['mascara'] = true;
                
                $data['apoyo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_DIAGNOSTICO", "DIACOD", $id);
                // Inicializo variables de los campos del formulario
                $data['title'] = "Crear diagn&oacute;sticos m&eacute;dicos ";
                $data['mainField'] = "Nombre del diagn&oacute;stico";
                $data['apoyoField'] = "C&oacute;digo del diagn&oacute;stico";
                $data['placeHolder'] = "Ej.  Amputaci&oacute;n de miembros ";
                $data['placeHolderApoyo'] = "Ej.  Y835 ";
                $data['pagina'] = "OrdersConfigurationDiagnosis/saveRegister";
                $data['mainPage'] = $mainPage;
                
                $data['id'] = $this->encryption->encrypt($id);
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_DIAGNOSTICO", "NOMBRE", $id);
                
                // Cargo vista
                $this->load->view('common/forms/formTwoValues', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/orders/configuration/OrdersConfigurationDiagnosisValidation');
                
                /**
                 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
                 */
                
                // Pinto el final de la p�gina (p�ginas internas)
                showCommonEnds($this, null, null);
            } else {
                // Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la p�gina
                redirect(base_url() . "OrdersConfigurationDiagnosis/board");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    /**
     * ***********************************************************************************************************
     * RUTINAS PARA GUARDAR INFORMACI�N
     * ****************************************************************************************************** *
     */
    public function saveRegister()
    {
        /**
         * Guardo la informaci�n del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
         */
        $mainPage = "OrdersConfigurationDiagnosis/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "OrdersConfigurationDiagnosis/board";
            $nombre = $this->security->xss_clean($this->input->post('nombre'));
            $apoyo = strtoupper($this->security->xss_clean($this->input->post('apoyo')));
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_DIAGNOSTICO", "NOMBRE", $nombre) == 0) {
                    // Creo el registro
                    $id = $this->FunctionsGeneral->insertTwoParameter("ORD_DIAGNOSTICO", "NOMBRE", $nombre, "DIACOD", $apoyo, $this->session->userdata('usuario'));
                    
                    // Pinto mensaje para retornar a la aplicaci�n
                    $this->session->set_userdata('id', $nombre);
                    $this->session->set_userdata('auxiliar', 'configUpdate');
                    // Redirecciono la p�gina
                    redirect(base_url() . $mainPage);
                } else {
                    // Creo mensaje de creaci�n de usuario
                    $mensaje = "ConfigExist";
                    // Pinto mensaje para retornar a la aplicaci�n
                    $this->session->set_userdata('id', $nombre);
                    $this->session->set_userdata('auxiliar', $mensaje);
                    // Redirecciono la p�gina
                    redirect(base_url() . $mainPage);
                }
            } else {
                // Actualizo los valores para el parametro respectivo en la tabla dada
                $this->FunctionsGeneral->updateByID("ORD_DIAGNOSTICO", "NOMBRE", $nombre, $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $this->session->userdata('usuario'));
                $this->FunctionsGeneral->updateByID("ORD_DIAGNOSTICO", "DIACOD", $apoyo, $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $this->session->userdata('usuario'));
                
                // Pinto mensaje para retornar a la aplicaci�n
                $this->session->set_userdata('id', $nombre);
                $this->session->set_userdata('auxiliar', 'configUpdate');
                // Redirecciono la p�gina
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function inactive($id)
    {
        /**
         * Inactivo el registro para el cual se tiene asociado el valor $id
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationDiagnosis/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "OrdersConfigurationDiagnosis/board";
            
            // Cargo informaci�n de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_DIAGNOSTICO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("ORD_DIAGNOSTICO", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneral';
                $this->FunctionsGeneral->updateByID("ORD_DIAGNOSTICO", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
                // Pinto mensaje para retornar a la aplicaci�n
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', $message);
                // Redirecciono la p�gina
                redirect(base_url() . $mainPage);
            } else {
                // Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la p�gina
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }
}

?>