<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para definir los diferentes tipos de estados
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class OrdersConfigurationStates extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // Cargo modelos, librerias y helpers
        $this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a órdenes
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
        $mainPage = "OrdersConfigurationStates/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "OrdersConfigurationStates/board";
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
            $data['listaLista'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_ESTADOS");
            
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
        $mainPage = "OrdersConfigurationStates/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la página principal
            $mainPage = "OrdersConfigurationStates/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['nombre'] = null;
            $data['id'] = null;
            $data['tipo'] = null;
            $data['nivel'] = null;
            $data['grupo'] = null;
            $data['adjunto'] = null;
            $data['reproceso'] = null;
            $data['bloque'] = null;
            $data['icono'] = null;
            
            // Ingreso valores adicionales de los campos para los estados
            $data['campoAdc1'] = VALUE_STATE_NOT;
            $data['campoAdc2'] = VALUE_STATE_NOT;
            $data['campoAdc3'] = VALUE_STATE_NOT;
            $data['campoAdc4'] = VALUE_STATE_NOT;
            $data['campoAdc5'] = VALUE_STATE_NOT;
            
            $data['nombreAdc1'] = null;
            $data['nombreAdc2'] = null;
            $data['nombreAdc3'] = null;
            $data['nombreAdc4'] = null;
            $data['nombreAdc5'] = null;
            
            $data['listaAdc1'] = null;
            $data['listaAdc2'] = null;
            $data['listaAdc3'] = null;
            $data['listaAdc4'] = null;
            $data['listaAdc5'] = null;
            
            $data['disabledNombreAdc1'] = "disabled=\"disabled\"";
            $data['disabledNombreAdc2'] = "disabled=\"disabled\"";
            $data['disabledNombreAdc3'] = "disabled=\"disabled\"";
            $data['disabledNombreAdc4'] = "disabled=\"disabled\"";
            $data['disabledNombreAdc5'] = "disabled=\"disabled\"";
            
            $data['displayNombreAdc1'] = "style=\"display: none;\"";
            $data['displayNombreAdc2'] = "style=\"display: none;\"";
            $data['displayNombreAdc3'] = "style=\"display: none;\"";
            $data['displayNombreAdc4'] = "style=\"display: none;\"";
            $data['displayNombreAdc5'] = "style=\"display: none;\"";
            
            
            $data['disabledListaAdc1'] = "disabled=\"disabled\"";
            $data['disabledListaAdc2'] = "disabled=\"disabled\"";
            $data['disabledListaAdc3'] = "disabled=\"disabled\"";
            $data['disabledListaAdc4'] = "disabled=\"disabled\"";
            $data['disabledListaAdc5'] = "disabled=\"disabled\"";
            
            $data['displayListaAdc1'] = "style=\"display: none;\"";
            $data['displayListaAdc2'] = "style=\"display: none;\"";
            $data['displayListaAdc3'] = "style=\"display: none;\"";
            $data['displayListaAdc4'] = "style=\"display: none;\"";
            $data['displayListaAdc5'] = "style=\"display: none;\"";
            
            // Lista de listas
            $data['listaTipo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_TIPOESTADO");
            $data['listaNivel'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_NIVELESTADO");
            $data['listaGrupo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_GRUPOESTADO");
            $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
            
            // Lista valores adicionales
            $data['listaAdicional'] = $this->FunctionsAdmin->selectValoresListaAdministracion('VALIDA_ADICIONAL', '1');
            
            // Lista valores adicionales
            $data['listaComplemento'] = $this->FunctionsAdmin->selectValoresListaAdministracion('VALIDA_COMPLEMENTO', '1');
            
            
            // Inicializo variables de los campos del formulario
            $data['pagina'] = "OrdersConfigurationStates/saveRegister";
            $data['mainPage'] = $mainPage;
            
            // Cargo vista
            $this->load->view('orders/configuration/formOrdersConfigurationStates', $data);
            // Cargo validación de formulario
            $this->load->view('validation/orders/configuration/ordersConfigurationStatesValidation');
            
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
        $mainPage = "OrdersConfigurationStates/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $mainPage = "OrdersConfigurationStates/board";
                $data = null;
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Información relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMBRE", $id);
                $data['id'] = $this->encryption->encrypt($id);
                $data['tipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "TIPOESTADO", $id);
                ;
                $data['nivel'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NIVEL", $id);
                ;
                $data['grupo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "ID_GRUPOESTADO", $id);
                ;
                $data['adjunto'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "ADJUNTO", $id);
                ;
                $data['reproceso'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "REPROCESO", $id);
                ;
                $data['bloque'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "BLOQUE", $id);
                ;
                $data['icono'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "ICONO", $id);
                
                // Ingreso valores adicionales de los campos para los estados
                $data['campoAdc1'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC1", $id);
                $data['campoAdc2'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC2", $id);
                $data['campoAdc3'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC3", $id);
                $data['campoAdc4'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC4", $id);
                $data['campoAdc5'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC5", $id);
                
                $data['nombreAdc1'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC1", $id);
                $data['nombreAdc2'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC2", $id);
                $data['nombreAdc3'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC3", $id);
                $data['nombreAdc4'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC4", $id);
                $data['nombreAdc5'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC5", $id);
                
                $data['listaAdc1'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC1", $id);
                $data['listaAdc2'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC2", $id);
                $data['listaAdc3'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC3", $id);
                $data['listaAdc4'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC4", $id);
                $data['listaAdc5'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC5", $id);
                
                if ($data['campoAdc1'] == VALUE_STATE_NOT) {
                    $data['disabledNombreAdc1'] = "disabled=\"disabled\"";
                    $data['displayNombreAdc1'] = "style=\"display: none;\"";
                } else {
                    $data['disabledNombreAdc1'] = "";
                    $data['displayNombreAdc1'] = "";
                }
                if ($data['campoAdc2'] == VALUE_STATE_NOT) {
                    $data['disabledNombreAdc2'] = "disabled=\"disabled\"";
                    $data['displayNombreAdc2'] = "style=\"display: none;\"";
                } else {
                    $data['disabledNombreAdc2'] = "";
                    $data['displayNombreAdc2'] = "";
                }
                if ($data['campoAdc3'] == VALUE_STATE_NOT) {
                    $data['disabledNombreAdc3'] = "disabled=\"disabled\"";
                    $data['displayNombreAdc3'] = "style=\"display: none;\"";
                } else {
                    $data['disabledNombreAdc3'] = "";
                    $data['displayNombreAdc3'] = "";
                }
                if ($data['campoAdc4'] == VALUE_STATE_NOT) {
                    $data['disabledNombreAdc4'] = "disabled=\"disabled\"";
                    $data['displayNombreAdc4'] = "style=\"display: none;\"";
                } else {
                    $data['disabledNombreAdc4'] = "";
                    $data['displayNombreAdc4'] = "";
                }
                if ($data['campoAdc5'] == VALUE_STATE_NOT) {
                    $data['disabledNombreAdc5'] = "disabled=\"disabled\"";
                    $data['displayNombreAdc5'] = "style=\"display: none;\"";
                } else {
                    $data['disabledNombreAdc5'] = "";
                    $data['displayNombreAdc5'] = "";
                }
                
                if ($data['campoAdc1'] != 52 && $data['campoAdc1'] != 54) {
                    $data['disabledListaAdc1'] = "disabled=\"disabled\"";
                    $data['displayListaAdc1'] = "style=\"display: none;\"";
                } else {
                    $data['disabledListaAdc1'] = "";
                    $data['displayListaAdc1'] = "";
                }
                
                if ($data['campoAdc2'] != 52 && $data['campoAdc2'] != 54) {
                    $data['disabledListaAdc2'] = "disabled=\"disabled\"";
                    $data['displayListaAdc2'] = "style=\"display: none;\"";
                } else {
                    $data['disabledListaAdc2'] = "";
                    $data['displayListaAdc2'] = "";
                }
                
                if ($data['campoAdc3'] != 52 && $data['campoAdc3'] != 54) {
                    $data['disabledListaAdc3'] = "disabled=\"disabled\"";
                    $data['displayListaAdc3'] = "style=\"display: none;\"";
                } else {
                    $data['disabledListaAdc3'] = "";
                    $data['displayListaAdc3'] = "";
                }
                if ($data['campoAdc4'] != 52 && $data['campoAdc4'] != 54) {
                    $data['disabledListaAdc4'] = "disabled=\"disabled\"";
                    $data['displayListaAdc4'] = "style=\"display: none;\"";
                } else {
                    $data['disabledListaAdc4'] = "";
                    $data['displayListaAdc4'] = "";
                }
                if ($data['campoAdc5'] != 52 && $data['campoAdc5'] != 54) {
                    $data['disabledListaAdc5'] = "disabled=\"disabled\"";
                    $data['displayListaAdc5'] = "style=\"display: none;\"";
                } else {
                    $data['disabledListaAdc5'] = "";
                    $data['displayListaAdc5'] = "";
                }
                
                // Lista de listas
                $data['listaTipo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_TIPOESTADO");
                $data['listaNivel'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_NIVELESTADO");
                $data['listaGrupo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_GRUPOESTADO");
                $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
                
                // Lista valores adicionales
                $data['listaAdicional'] = $this->FunctionsAdmin->selectValoresListaAdministracion('VALIDA_ADICIONAL', '1');
                
                // Lista valores adicionales
                $data['listaComplemento'] = $this->FunctionsAdmin->selectValoresListaAdministracion('VALIDA_COMPLEMENTO', '1');
                
                // Inicializo variables de los campos del formulario
                $data['pagina'] = "OrdersConfigurationStates/saveRegister";
                $data['mainPage'] = $mainPage;
                
                // Cargo vista
                $this->load->view('orders/configuration/formOrdersConfigurationStates', $data);
                // Cargo validación de formulario
                $this->load->view('validation/orders/configuration/ordersConfigurationStatesValidation');
                
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
                redirect(base_url() . "OrdersConfigurationStates/board");
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
         * Guardo la información del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
         */
        $mainPage = "OrdersConfigurationStates/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
            $mainPage = "OrdersConfigurationStates/board";
            $nombre = $this->security->xss_clean($this->input->post('nombre'));
            
            // Recibo información de campos adicionales
            $field1 = $this->security->xss_clean($this->input->post('campoAdc1'));
            $field2 = $this->security->xss_clean($this->input->post('campoAdc2'));
            $field3 = $this->security->xss_clean($this->input->post('campoAdc3'));
            $field4 = $this->security->xss_clean($this->input->post('campoAdc4'));
            $field5 = $this->security->xss_clean($this->input->post('campoAdc5'));
            
            $name1 = $this->security->xss_clean($this->input->post('nombreAdc1'));
            $name2 = $this->security->xss_clean($this->input->post('nombreAdc2'));
            $name3 = $this->security->xss_clean($this->input->post('nombreAdc3'));
            $name4 = $this->security->xss_clean($this->input->post('nombreAdc4'));
            $name5 = $this->security->xss_clean($this->input->post('nombreAdc5'));
            
            $list1 = $this->security->xss_clean($this->input->post('listaAdc1'));
            $list2 = $this->security->xss_clean($this->input->post('listaAdc2'));
            $list3 = $this->security->xss_clean($this->input->post('listaAdc3'));
            $list4 = $this->security->xss_clean($this->input->post('listaAdc4'));
            $list5 = $this->security->xss_clean($this->input->post('listaAdc5'));
            
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ESTADOS", "NOMBRE", $nombre) == 0) {
                    // Creo el registro
                    $id = $this->OrdersModel->insertStates($nombre, $this->security->xss_clean($this->input->post('tipo')), 1, $this->security->xss_clean($this->input->post('grupo')), $this->security->xss_clean($this->input->post('reproceso')), $this->security->xss_clean($this->input->post('adjunto')), $this->security->xss_clean($this->input->post('bloque')), $this->security->xss_clean($this->input->post('icono')), $this->session->userdata('usuario'));
                    
                    // Actualizo datos adicionales
                    $this->updateAditionalFields($id, $field1, $name1, $list1, $field2, $name2, $list2, $field3, $name3, $list3, $field4, $name4, $list4, $field5, $name5, $list5, $this->session->userdata('usuario'));
                    
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
                // Actualizo los valores para el parametro respectivo en la tabla dada
                $this->OrdersModel->updateStates($this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $nombre, $this->security->xss_clean($this->input->post('tipo')), 1, $this->security->xss_clean($this->input->post('grupo')), $this->security->xss_clean($this->input->post('reproceso')), $this->security->xss_clean($this->input->post('adjunto')), $this->security->xss_clean($this->input->post('bloque')), $this->security->xss_clean($this->input->post('icono')), $this->session->userdata('usuario'));
                
                // Actualizo datos adicionales
                $this->updateAditionalFields($this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $field1, $name1, $list1, $field2, $name2, $list2, $field3, $name3, $list3, $field4, $name4, $list4, $field5, $name5, $list5, $this->session->userdata('usuario'));
                
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

    private function updateAditionalFields($id, $field1, $name1, $list1, $field2, $name2, $list2, $field3, $name3, $list3, $field4, $name4, $list4, $field5, $name5, $list5, $usuario)
    {
        /**
         * Rutina para actualizar los campos adicionales de la tabla de estados
         */
        
        // Actualizo valores de los campos
        $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "CAMPO_ADC1", $field1, $id, $usuario);
        $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "CAMPO_ADC2", $field2, $id, $usuario);
        $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "CAMPO_ADC3", $field3, $id, $usuario);
        $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "CAMPO_ADC4", $field4, $id, $usuario);
        $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "CAMPO_ADC5", $field5, $id, $usuario);
        
        // Actualizo nombre de los campos
        if ($field1 == VALUE_STATE_NOT) {
            $name1 = null;
        }
        $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "NOMCAMPO_ADC1", $name1, $id, $usuario);
        
        if ($field2 == VALUE_STATE_NOT) {
            $name2 = null;
        }
        $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "NOMCAMPO_ADC2", $name2, $id, $usuario);
        
        if ($field3 == VALUE_STATE_NOT) {
            $name3 = null;
        }
        $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "NOMCAMPO_ADC3", $name3, $id, $usuario);
        
        if ($field4 == VALUE_STATE_NOT) {
            $name4 = null;
        }
        $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "NOMCAMPO_ADC4", $name4, $id, $usuario);
        
        if ($field5 == VALUE_STATE_NOT) {
            $name5 = null;
        }
        $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "NOMCAMPO_ADC5", $name5, $id, $usuario);
        
        // Actualizo listas para los estados
        if ($list1 != null) {
            $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "LISTA_ADC1", $list1, $id, $usuario);
        }
        
        if ($list2 != null) {
            $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "LISTA_ADC2", $list2, $id, $usuario);
        }
        
        if ($list3 != null) {
            $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "LISTA_ADC3", $list3, $id, $usuario);
        }
        
        if ($list4 != null) {
            $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "LISTA_ADC4", $list4, $id, $usuario);
        }
        
        if ($list5 != null) {
            $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "LISTA_ADC5", $list5, $id, $usuario);
        }
    }

    public function inactive($id)
    {
        /**
         * Inactivo el registro para el cual se tiene asociado el valor $id
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationStates/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
            $mainPage = "OrdersConfigurationStates/board";
            
            // Cargo información de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneral';
                $this->FunctionsGeneral->updateByID("ORD_ESTADOS", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
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