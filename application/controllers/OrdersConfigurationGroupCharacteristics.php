<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para definir los diferentes tipos de �rboles (clases de ordenes).
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class OrdersConfigurationGroupCharacteristics extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // Cargo modelos, librerias y helpers
        $this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a �rdenes
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
        $mainPage = "OrdersConfigurationGroupCharacteristics/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "OrdersConfigurationGroupCharacteristics/board";
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
            $data['listaLista'] = $this->OrdersModel->selectGroupsCharacteristics();
            
            // Pinto plantilla principal
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('orders/configuration/boardGroupCharacteristics', $data);
            
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
        $mainPage = "OrdersConfigurationGroupCharacteristics/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la p�gina principal
            $mainPage = "OrdersConfigurationGroupCharacteristics/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['id'] = null;
            $data['detLista'] = null;
            $data['mainPage'] = $mainPage;
            
            // Lista de aplica
            $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
            $data['valorSINO'] = null;
            $data['disabledDelete'] = 'disabled="disabled"';
            // Listado de proveedores
            $data['listaProveedores'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_PROVEEDOR", 'DESC');
            $data['providers'] = null;
            // Listado de grupos
            $data['listaGrupos'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_GRUELEM", 'DESC');
            // Cargo vista
            $this->load->view('orders/configuration/formGroupCharacteristics', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/orders/configuration/ordersConfigurationGroupCharacteristicsValidation');
            
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
        $mainPage = "OrdersConfigurationGroupCharacteristics/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $idEncryption = $id;
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_PARGRUELEM", "ID", $this->encryption->decrypt($id));
            $grupo = $this->FunctionsGeneral->getFieldFromTable("ORD_PARGRUELEM", "ID_GRUELEM", $id);
            $caracteristica = $this->FunctionsGeneral->getFieldFromTable("ORD_PARGRUELEM", "ID_PARELEM", $id);
            $grupo = $this->FunctionsGeneral->getFieldFromTable("ORD_GRUELEM", "NOMBRE", $grupo);
            $caracteristica = $this->FunctionsGeneral->getFieldFromTable("ORD_PARELEM", "NOMBRE", $caracteristica);
            
            if ($id != '') {
                // Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
                $mainPage = "OrdersConfigurationGroupCharacteristics/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('editRegister');
                $data['id'] = $idEncryption;
                // Verifico la cantidad de registros que fueron creados anteriormente
                $data['detLista'] = $this->OrdersModel->getListValueGroupCharacteristics($id);
                $data['grupo'] = $grupo;
                $data['caracteristica'] = $caracteristica;
                $data['mainPage'] = $mainPage;
                $data['disabledDelete'] = null;
                // Lista de aplica
                $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
                // Verifico si tiene proveedores asociados
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_PROGRUPAR", "ID_PARGRUELEM", $id) > 0) {
                    $data['valorSINO'] = CTE_VALOR_SI;
                    $data['display'] = "";
                    $data['disabled'] = "";
                } else {
                    $data['valorSINO'] = CTE_VALOR_NO;
                    $data['display'] = "style=\"display: none;\"";
                    $data['disabled'] = "disabled";
                }
                // Listado de proveedores
                $data['listaProveedores'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_PROVEEDOR", 'DESC');
                $data['providers'] = $this->OrdersModel->getListProvidersGroupCharacteristics($id);
                // Listado de grupos
                $data['listaGrupos'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_GRUELEM", 'DESC');
                
                $data['mainPage'] = $mainPage;
                
                // Cargo vista
                $this->load->view('orders/configuration/formEditGroupCharacteristics', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/orders/configuration/ordersConfigurationGroupCharacteristicsValidation');
                
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
                redirect(base_url() . "OrdersConfigurationGroupCharacteristics/board");
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
        $mainPage = "OrdersConfigurationGroupCharacteristics/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "OrdersConfigurationGroupCharacteristics/board";
            $proveedor = $this->security->xss_clean($this->input->post('proveedor[]'));
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                $grupo = $this->security->xss_clean($this->input->post('grupo'));
                
                $caracteristica = $this->security->xss_clean($this->input->post('caracteristica'));
                $nombre = $this->FunctionsGeneral->getFieldFromTable("ORD_GRUELEM", "NOMBRE", $grupo) . " - " . $this->FunctionsGeneral->getFieldFromTable("ORD_PARELEM", "NOMBRE", $caracteristica);
                
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_PARGRUELEM", "ID_GRUELEM", $grupo, "ID_PARELEM", $caracteristica) == 0) {
                    // Creo el registro general
                    $idParGruelem = $this->OrdersModel->insertGroupCharacteristicsElements($grupo, $caracteristica, $this->session->userdata('usuario'));
                    // Elimino relaciones si existen
                    $this->OrdersModel->deleteValuesGroupCharacteristicsElements($idParGruelem);
                    // Creo el detalle de la lista asociada a la relaci�n
                    $registros = $this->security->xss_clean($this->input->post('registros'));
                    for ($i = 1; $i <= $registros; $i ++) {
                        // Realiz� el insert
                        $id = $this->OrdersModel->insertValuesGroupCharacteristicsElements($idParGruelem, $this->security->xss_clean($this->input->post('valor' . $i)), $this->session->userdata('usuario'));
                    }
                    // Verifico si aplica proveedores
                    if ($this->security->xss_clean($this->input->post('aplica')) == CTE_VALOR_SI) {
                        // Se realiz� el insert respectivo de la relaci�n del grupo con el proveedor $p
                        // Elimino relaciones si existen
                        $this->OrdersModel->deleteProvidersGroupCharacteristicsElements($idParGruelem);
                        
                        foreach ($proveedor as $p) {
                            $id = $this->OrdersModel->insertValuesProviderGroupCharacteristicsElements($idParGruelem, $p, $this->session->userdata('usuario'));
                        }
                    }
                    // Creo los valores asociados a la relaci�n
                    // Pinto mensaje para retornar a la aplicaci�n
                    $this->session->set_userdata('id', $nombre);
                    $this->session->set_userdata('auxiliar', 'configUpdateRelationGVSC');
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
                $id = $this->FunctionsGeneral->getFieldFromTable("ORD_PARGRUELEM", "ID", $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))));
                $grupo = $this->FunctionsGeneral->getFieldFromTable("ORD_PARGRUELEM", "ID_GRUELEM", $id);
                $caracteristica = $this->FunctionsGeneral->getFieldFromTable("ORD_PARGRUELEM", "ID_PARELEM", $id);
                $nombre = $this->FunctionsGeneral->getFieldFromTable("ORD_GRUELEM", "NOMBRE", $grupo) . " - " . $this->FunctionsGeneral->getFieldFromTable("ORD_PARELEM", "NOMBRE", $caracteristica);
                $idParGruelem = $id;
                
                //Inactivo relaci�n
                $this->FunctionsGeneral->updateByField("ORD_VALPARGRUELEM", "ESTADO", INACTIVO_ESTADO,"ID_PARGRUELEM", $idParGruelem,$this->session->userdata('usuario'));

                // Creo el detalle de la lista asociada a la relaci�n
                $registros = $this->security->xss_clean($this->input->post('registros'));
                for ($i = 1; $i <= $registros; $i ++) {
                    if($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_VALPARGRUELEM","ID_PARGRUELEM", $idParGruelem, "VALOR",$this->security->xss_clean($this->input->post('valor' . $i)))==0){
                        // Realiz� el insert
                        $id = $this->OrdersModel->insertValuesGroupCharacteristicsElements($idParGruelem, $this->security->xss_clean($this->input->post('valor' . $i)), $this->session->userdata('usuario'));
                    }else{
                        //Actualizo la relaci�n
                        $this->FunctionsGeneral->updateByField("ORD_VALPARGRUELEM", "ESTADO", ACTIVO_ESTADO,"ID_PARGRUELEM", $idParGruelem,$this->session->userdata('usuario'),"VALOR",$this->security->xss_clean($this->input->post('valor' . $i)));
                    }
                    
                }
                // Verifico si aplica proveedores
                if ($this->security->xss_clean($this->input->post('aplica')) == CTE_VALOR_SI) {
                    // Se realiz� el insert respectivo de la relaci�n del grupo con el proveedor $p
                    // Elimino relaciones si existen
                    $this->OrdersModel->deleteProvidersGroupCharacteristicsElements($idParGruelem);
                    
                    foreach ($proveedor as $p) {
                        $id = $this->OrdersModel->insertValuesProviderGroupCharacteristicsElements($idParGruelem, $p, $this->session->userdata('usuario'));
                    }
                } else {
                    // Elimino relaciones si existen
                    $this->OrdersModel->deleteProvidersGroupCharacteristicsElements($idParGruelem);
                }
                // Pinto mensaje para retornar a la aplicaci�n
                $this->session->set_userdata('id', $nombre);
                $this->session->set_userdata('auxiliar', 'configUpdateRelationGVSC');
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
        $mainPage = "OrdersConfigurationGroupCharacteristics/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "OrdersConfigurationGroupCharacteristics/board";
            
            // Cargo informaci�n de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_PARGRUELEM", "ID", $this->encryption->decrypt($id));
            $grupo = $this->FunctionsGeneral->getFieldFromTable("ORD_PARGRUELEM", "ID_GRUELEM", $id);
            $caracteristica = $this->FunctionsGeneral->getFieldFromTable("ORD_PARGRUELEM", "ID_PARELEM", $id);
            $nombre = $this->FunctionsGeneral->getFieldFromTable("ORD_GRUELEM", "NOMBRE", $grupo) . " - " . $this->FunctionsGeneral->getFieldFromTable("ORD_PARELEM", "NOMBRE", $caracteristica);
            
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("ORD_PARGRUELEM", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneralGVSC';
                $this->FunctionsGeneral->updateByID("ORD_PARGRUELEM", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
                // Pinto mensaje para retornar a la aplicaci�n
                $this->session->set_userdata('id', $nombre);
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