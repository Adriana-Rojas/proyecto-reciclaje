<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para crear las preguntas del calificador.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class PollConfigurationDefinePolls extends CI_Controller
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
        $mainPage = "PollConfigurationDefinePolls/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "PollConfigurationDefinePolls/board";
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
            $data['listaLista'] = $this->FunctionsGeneral->selectValoresListaTabla("CAL_ENCUESTA");
            
            // Pinto plantilla principal
            // Pinto la lista genérica de parametros que se debe tener en cuenta dentro del sistema de parámetros
            $this->load->view('common/boards/board', $data);
            
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
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "PollConfigurationDefinePolls/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la página principal
            $mainPage = "OrdersConfigurationGroupCharacteristics/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['id'] = null;
            $data['detLista'] = null;
            $data['nombre'] = null;
            $data['mainPage'] = $mainPage;
            $data['descripcion'] = null;
            $data['datos'] = null;
            $data['observacion'] = null;
            $data['disabledDelete'] = 'disabled="disabled"';
            //vERIFICO SI YA SE HAN HECHO ENCUESTAS
            $data['cantidad'] = 0;
            // Si no
            $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
            $data['listaPreguntas'] = $this->PollsModel->getListValueQuestions() ;
            // Cargo vista
            $this->load->view('poll/configuration/formNewPoll', $data);
            // Cargo validación de formulario
            $this->load->view('validation/polls/configuration/pollDefinePollValidation');
            
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
    
    

    public function edit($id)
    {
        /**
         * Formulario para editar la información previamente creada para el parametro de la aplicación
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "PollConfigurationDefinePolls/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $mainPage = "PollConfigurationDefinePolls/board";
                $data = null;
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Información relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['id'] = $this->encryption->encrypt($id);
                $data['descripcion'] = $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA", "DESCRIPCION", $id);
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA", "NOMBRE", $id);
                // Inicializo variables de los campos del formulario
                $data['detLista'] =  $this->PollsModel-> getListValueQuestionsPoll($id);
                $data['disabledDelete'] = null;
                $data['mainPage'] = $mainPage;
                $data['datos'] = $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA", "DATOPERSONAL", $id);
                $data['observacion'] = $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA", "OBSERVACION", $id);
                
                // Si no
                $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
                $data['listaPreguntas'] = $this->PollsModel->getListValueQuestions() ;
                //vERIFICO SI YA SE HAN HECHO ENCUESTAS
                $data['cantidad'] =$this->FunctionsGeneral->getQuantityFieldFromTable("CAL_CALIFICADOR","ID_ENCUESTA",$id);
                
                // Cargo vista
                $this->load->view('poll/configuration/formNewPoll', $data);
                // Cargo validación de formulario
                $this->load->view('validation/polls/configuration/pollDefinePollValidation');
                
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
                redirect(base_url() . "PollConfigurationDefinePolls/board");
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    
    public function definePoll()
    {
        /**
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "PollConfigurationDefinePolls/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la página principal
            $mainPage = "OrdersConfigurationGroupCharacteristics/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['id'] = null;
            $data['detLista'] = null;
            $data['mainPage'] = $mainPage;
            $data['descripcion'] = null;
            $data['datos'] = null;
            $data['observacion'] = null;
            $data['disabledDelete'] = 'disabled="disabled"';
            //vERIFICO SI YA SE HAN HECHO ENCUESTAS
            $data['cantidad'] = 0;
            // Si no
            $data['listaEncuesta'] =  $this->PollsModel-> getListPolls() ;
            // Cargo vista
            $this->load->view('poll/configuration/formDefinePoll', $data);
            // Cargo validación de formulario
            $this->load->view('validation/polls/configuration/pollDefineActualPollValidation');
            
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
         * Guardo la información del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
         */
        $mainPage = "PollConfigurationDefinePolls/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
            $nombre = $this->security->xss_clean($this->input->post('nombre'));
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("CAL_ENCUESTA", "NOMBRE", $nombre) == 0) {
                    
                    // Creo el registro
                    $id =$this->PollsModel->insertPoll($nombre,
                                                        $this->security->xss_clean($this->input->post('descripcion')),
                                                        $this->security->xss_clean($this->input->post('datos')),
                                                        $this->security->xss_clean($this->input->post('observacion'))
                                                        ,$this->session->userdata('usuario'));
                    
                    // Creo el detalle de la lista asociada a la relación
                    $registros = $this->security->xss_clean($this->input->post('registros'));
                    for ($i = 1; $i <= $registros; $i ++) {
                        // Realizó el insert
                        $this->PollsModel-> insertPollQuestions($id,$this->security->xss_clean($this->input->post('valor' . $i)), $this->session->userdata('usuario'));
                        
                    }
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $nombre);
                    $this->session->set_userdata('auxiliar', 'configUpdate');
                    // Redirecciono la página
                    redirect(base_url() . $mainPage);
                } else {
                    // Creo mensaje de creaciòn de usuario
                    $mensaje = "ConfigExist";
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $nombre);
                    $this->session->set_userdata('auxiliar', $mensaje);
                    // Redirecciono la página
                    redirect(base_url() . $mainPage);
                }
            } else {
                $id=$this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
                // Actualizo los valores para el parametro respectivo en la tabla dada
                $this->FunctionsGeneral->updateByID("CAL_ENCUESTA", "NOMBRE", $nombre, $id, $this->session->userdata('usuario'));
                $this->FunctionsGeneral->updateByID("CAL_ENCUESTA", "DESCRIPCION", $this->security->xss_clean($this->input->post('descripcion')), $id, $this->session->userdata('usuario'));
                $this->FunctionsGeneral->updateByID("CAL_ENCUESTA", "DATOPERSONAL", $this->security->xss_clean($this->input->post('datos')), $id, $this->session->userdata('usuario'));
                $this->FunctionsGeneral->updateByID("CAL_ENCUESTA", "OBSERVACION", $this->security->xss_clean($this->input->post('observacion')), $id, $this->session->userdata('usuario'));
                //eLIMINO RELACIONES ANTERIORES
                $this->PollsModel-> deleteQuestionsPoll($id);
                // Creo el detalle de la lista asociada a la relación
                $registros = $this->security->xss_clean($this->input->post('registros'));
                for ($i = 1; $i <= $registros; $i ++) {
                    // Realizó el insert
                    $this->PollsModel-> insertPollQuestions($id,$this->security->xss_clean($this->input->post('valor' . $i)), $this->session->userdata('usuario'));
                }
                // Pinto mensaje para retornar a la aplicación
                $this->session->set_userdata('id', $nombre);
                $this->session->set_userdata('auxiliar', 'configUpdate');
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }
    
    
    public function saveRegisterPoll()
    {
        /**
         * Guardo la información del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
         */
        $mainPage = "PollConfigurationDefinePolls/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            //Verifico si existe alguna encuesta creada
            if ($this->FunctionsGeneral->getQuantityFieldFromTable("CAL_EJECUTA", "ESTADO", ACTIVO_ESTADO) == 0) {
                //Se debe crear el registro
                $this->PollsModel-> insertPollActual($this->security->xss_clean($this->input->post('datos')),$this->session->userdata('usuario'));
            }else{
                //Se actualiza el registro
                $this->FunctionsGeneral->updateByID("CAL_EJECUTA", "ID_ENCUESTA", $this->security->xss_clean($this->input->post('datos')), 1, $this->session->userdata('usuario'));
            }
            // Pinto mensaje para retornar a la aplicación
            $this->session->set_userdata('id',  $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA","NOMBRE",$this->security->xss_clean($this->input->post('datos'))));
            $this->session->set_userdata('auxiliar', 'saveInformationPoll');
            // Redirecciono la página
            redirect(base_url() . $mainPage);
            
            
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function inactive($id)
    {
        /**
         * Inactivo el registro para el cual se tiene asociado el valor $id
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "PollConfigurationDefinePolls/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
            $mainPage = "PollConfigurationDefinePolls/board";
            
            // Cargo información de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("CAL_ENCUESTA", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneral';
                $this->FunctionsGeneral->updateByID("CAL_ENCUESTA", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
                // Pinto mensaje para retornar a la aplicación
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', $message);
                // Redirecciono la página
                redirect(base_url() . $mainPage);
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
}

?>