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

class OrdersConfigurationTreeDefinition extends CI_Controller
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
        $mainPage = "OrdersConfigurationTreeDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "OrdersConfigurationTreeDefinition/board";
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
            $data['listaLista'] = $this->OrdersModel->selectOrdersTypeBodyPartsConfiguration();
            
            // Pinto plantilla principal
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('orders/configuration/boardTreeDefinition', $data);
            
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
        $mainPage = "OrdersConfigurationTreeDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la p�gina principal
            $mainPage = "OrdersConfigurationTreeDefinition/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['id'] = null;
            $data['mainPage'] = $mainPage;
            
            // Lista Tipo de ordenes
            $data['listaTipo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_TIPOORDEN");
            $data['valorTipo'] = null;
            // Listado de miembros
            $data['listaMiembros'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_MIEMBROS", 'DESC');
            $data['valorMiembros'] = null;
            
            // Lista nivel
            $data['listaNivel'] = null;
            $data['valorNivel'] = null;
            
            // Cargo vista
            $this->load->view('orders/configuration/formTreeDefinition', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/orders/configuration/ordersConfigurationTreeDefinitionValidation');
            
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

    public function firstLevel($id)
    {
        /**
         * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationTreeDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $idEncryption = $id;
            
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
                $mainPage = "OrdersConfigurationTreeDefinition/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['id'] = $idEncryption;
                $data['mainPage'] = $mainPage;
                
                // Lista Tipo de ordenes
                $data['valorTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $id);
                $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $data['valorTipo']);
                // Listado de miembros
                $data['valorMiembros'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_MIEMBROS", $id);
                $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("ORD_MIEMBROS", "NOMBRE", $data['valorTipo']);
                
                // Identifico en donde debo buscar de acuerdo al tipo de orden
                if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $data['valorTipo']) == 1) {
                    // Productos
                    $tabla = "ORD_NAMPTMIEM";
                    $campo = "ID_NIVELAMP";
                    /* Busco la relaci�n entre el tipo de orden y el proceso */
                    $data['listaNivel'] = $this->OrdersModel->selectBodyPartsSection($data['valorMiembros']);
                } else {
                    // Servicios
                    $tabla = "ORD_NIVSERTIPORD";
                    $campo = "ID_NIVSERVICIO";
                    /* Busco la relaci�n entre el tipo de orden y el proceso */
                    $data['listaNivel'] = $this->OrdersModel->selectLevelServices($data['valorMiembros']);
                }
                
                // Lista nivel
                $data['tabla'] = $tabla;
                $data['campo'] = $campo;
                $data['idTipoMiem'] = $id;
                $data['valorNivel'] = null;
                
                // Cargo vista
                $this->load->view('orders/configuration/formTreeDefinitionEdit', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/orders/configuration/ordersConfigurationTreeDefinitionValidation');
                
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
                redirect(base_url() . "OrdersConfigurationTreeDefinition/board");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function secondLevel($id = null)
    {
        /**
         * Formulario para editar la informaci�n de los niveles secundarios del arbol que se esta configurando
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationTreeDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $secuencia = $this->encryption->decrypt($this->security->xss_clean($this->input->post('secuencia')));
            // Id de la relaci�n cifrado
            $idEncryption = $id;
            // Id de la relaci�n sin cifrado
            if ($id == null) {
                // Estoy recibiendo por el post
                $id = $this->security->xss_clean($this->input->post('id'));
            }
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
                $mainPage = "OrdersConfigurationTreeDefinition/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                
                $data['id'] = $this->encryption->encrypt($id);
                $data['mainPage'] = $mainPage;
                // Lista Tipo de ordenes
                $data['valorTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $id);
                $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $data['valorTipo']);
                // Cantidad de niveles a configurar
                $data['cantidadNiveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $data['valorTipo']);
                
                // Listado de miembros
                $data['valorMiembros'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_MIEMBROS", $id);
                $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("ORD_MIEMBROS", "NOMBRE", $data['valorMiembros']);
                
                // Identifico en donde debo buscar de acuerdo al tipo de orden
                if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $data['valorTipo']) == 1) {
                    // Productos
                    /* Busco la relaci�n entre el tipo de orden y el proceso */
                    $data['listaNivel'] = $this->OrdersModel->selectBodyPartsSectionInTipoMiem($id);
                } else {
                    // Servicios
                    /* Busco la relaci�n entre el tipo de orden y el proceso */
                    $data['listaNivel'] = $this->OrdersModel->selectLevelServices($data['valorMiembros']);
                }
                
                if ($secuencia == null) {
                    // Listo el primer subnivel
                    $nivel = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_DETLISTA", "ID", "VALOR", 1, "ID_ENCLISTA", 13);
                    $data['listaSubnivel'] = $this->OrdersModel->selectSubNivelWithFilters($nivel, $data['valorMiembros']);
                    $data['valorSubnivel'] = null;
                    $data['enlace'] = "secondLevel";
                    $data['secuencia'] = $this->encryption->encrypt('1erNivel');
                    ;
                    // Cargo vista
                    $this->load->view('orders/configuration/formTreeDefinitionSecondLevel', $data);
                    // Cargo validaci�n de formulario
                    $this->load->view('validation/orders/configuration/ordersConfigurationTreeSecondLevelDefinitionValidation');
                } else if ($secuencia == "1erNivel") {
                    $data['enlace'] = "saveSecondLevel";
                    $data['secuencia'] = $this->encryption->encrypt('2');
                    $idSubNivel = $this->security->xss_clean($this->input->post('subnivel'));
                    $data['subnivel'] = $this->FunctionsGeneral->getFieldFromTable("ORD_DATOSNIV", "NOMBRE", $idSubNivel);
                    $data['idSubNivel'] = $idSubNivel;
                    $data['listaDatosNivVal'] = $this->OrdersModel->selectValuesLevelDefinition($idSubNivel);
                    // Cargo vista
                    $this->load->view('orders/configuration/formTreeDefinitionSecondLevelInformation', $data);
                    // Cargo validaci�n de formulario
                    $this->load->view('validation/orders/configuration/ordersConfigurationTreeSecondLevelDescriptionValidation', $data);
                }
                
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
                redirect(base_url() . "OrdersConfigurationTreeDefinition/board");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function thirdLevel($id = null)
    {
        /**
         * Formulario para editar la informaci�n de los niveles secundarios del arbol que se esta configurando
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationTreeDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $secuencia = $this->encryption->decrypt($this->security->xss_clean($this->input->post('secuencia')));
            // Id de la relaci�n cifrado
            $idEncryption = $id;
            // Id de la relaci�n sin cifrado
            if ($id == null) {
                // Estoy recibiendo por el post
                $id = $this->security->xss_clean($this->input->post('id'));
            }
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
                $mainPage = "OrdersConfigurationTreeDefinition/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                
                $data['id'] = $this->encryption->encrypt($id);
                $data['mainPage'] = $mainPage;
                
                // Lista Tipo de ordenes
                $data['valorTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $id);
                $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $data['valorTipo']);
                // Cantidad de niveles a configurar
                $data['cantidadNiveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $data['valorTipo']);
                
                // Listado de miembros
                $data['valorMiembros'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_MIEMBROS", $id);
                $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("ORD_MIEMBROS", "NOMBRE", $data['valorTipo']);
                
                // Listado de primer nivel
                $tempo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_NAMPTMIEM", "ID", "ID_TIPOMIEM", $id);
                $tablas = retornaArrayTablas($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $data['valorTipo']));
                $tempo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ARBOL", "ID_ACTUAL", "ID_ANT", $tempo, "TABLA_ANT", $tablas[5]);
                $tempoTabla = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ARBOL", "TABLA_ACTUAL", "ID_ANT", $tempo, "TABLA_ANT", $tablas[5]);
                // ECHO $tempo." ".$tempoTabla;
                $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable($tempoTabla, "NOMBRE", $tempo);
                if ($secuencia == null) {
                    // Listo el segundo subnivel
                    $nivel = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_DETLISTA", "ID", "VALOR", 2, "ID_ENCLISTA", 13);
                    $data['listaSubnivel'] = $this->OrdersModel->selectSubNivelWithFilters($nivel, $data['valorMiembros']);
                    $data['valorSubnivel'] = null;
                    $data['enlace'] = "thirdLevel";
                    $data['secuencia'] = $this->encryption->encrypt('2doNivel');
                    // Identifico en donde debo buscar de acuerdo al tipo de orden
                    if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $data['valorTipo']) == 1) {
                        // Productos
                        /* Busco la relaci�n entre el tipo de orden y el proceso */
                        $data['listaNivel'] = $this->OrdersModel->selectBodyPartsSectionInTipoMiem($id);
                    } else {
                        // Servicios
                        /* Busco la relaci�n entre el tipo de orden y el proceso */
                        $data['listaNivel'] = $this->OrdersModel->selectLevelServices($data['valorMiembros']);
                    }
                    // Cargo vista
                    $this->load->view('orders/configuration/formTreeDefinitionSecondLevel', $data);
                    // Cargo validaci�n de formulario
                    $this->load->view('validation/orders/configuration/ordersConfigurationTreeSecondLevelDefinitionValidation');
                } else if ($secuencia == "2doNivel") {
                    $data['enlace'] = "saveThirdLevel";
                    $data['secuencia'] = $this->encryption->encrypt('2');
                    $idSubNivel = $this->security->xss_clean($this->input->post('subnivel'));
                    $data['subnivel'] = $this->FunctionsGeneral->getFieldFromTable("ORD_DATOSNIV", "NOMBRE", $idSubNivel);
                    $data['idSubNivel'] = $idSubNivel;
                    $data['listaDatosNivVal'] = $this->OrdersModel->selectValuesLevelDefinition($idSubNivel);
                    // Identifico en donde debo buscar de acuerdo al tipo de orden
                    if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $data['valorTipo']) == 1) {
                        // Productos
                        /* Busco la relaci�n entre el tipo de orden y el proceso */
                        $data['listaNivel'] = $this->OrdersModel->selectValuesFirstSubLevelDefinition($id, 2, 'ORD_NAMPTMIEM');
                    } else {
                        // Servicios
                        /* Busco la relaci�n entre el tipo de orden y el proceso */
                        $data['listaNivel'] = $this->OrdersModel->selectValuesFirstSubLevelDefinition($id, 2, 'ORD_NIVSERTIPORD');
                    }
                    // Cargo vista
                    $this->load->view('orders/configuration/formTreeDefinitionThirdLevelInformation', $data);
                    // Cargo validaci�n de formulario
                    $this->load->view('validation/orders/configuration/ordersConfigurationTreeSecondLevelDescriptionValidation', $data);
                }
                
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
                redirect(base_url() . "OrdersConfigurationTreeDefinition/board");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function fourthLevel($id = null)
    {
        /**
         * Formulario para editar la informaci�n de los niveles secundarios del arbol que se esta configurando
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationTreeDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $secuencia = $this->encryption->decrypt($this->security->xss_clean($this->input->post('secuencia')));
            // Id de la relaci�n cifrado
            $idEncryption = $id;
            // Id de la relaci�n sin cifrado
            if ($id == null) {
                // Estoy recibiendo por el post
                $id = $this->security->xss_clean($this->input->post('id'));
            }
            // ECHO "AAAA";
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
                $mainPage = "OrdersConfigurationTreeDefinition/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                
                $data['id'] = $this->encryption->encrypt($id);
                $data['mainPage'] = $mainPage;
                
                // Lista Tipo de ordenes
                $data['valorTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $id);
                $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $data['valorTipo']);
                // Cantidad de niveles a configurar
                $data['cantidadNiveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $data['valorTipo']);
                
                // Listado de miembros
                $data['valorMiembros'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_MIEMBROS", $id);
                $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("ORD_MIEMBROS", "NOMBRE", $data['valorTipo']);
                
                // Listado de primer nivel
                $tempo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_NAMPTMIEM", "ID", "ID_TIPOMIEM", $id);
                $tablas = retornaArrayTablas($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $data['valorTipo']));
                $tempo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ARBOL", "ID_ACTUAL", "ID_ANT", $tempo, "TABLA_ANT", $tablas[5]);
                $tempoArbolOrg = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ARBOL", "ID", "ID_ANT", $tempo, "TABLA_ANT", $tablas[5]);
                $tempoTabla = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ARBOL", "TABLA_ACTUAL", "ID_ANT", $tempo, "TABLA_ANT", $tablas[5]);
                // ECHO $tempo." ".$tempoTabla;
                $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable($tempoTabla, "NOMBRE", $tempo);
                // Listo para el segundo nivel
                $tempoArbol = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ARBOLVALORES", "ID", "ID_ARBOL", $tempoArbolOrg);
                $tempo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ARBOL", "ID_ACTUAL", "ID_ANT", $tempoArbol, "TABLA_ANT", $tablas[6]);
                // ECHO $tempo." ID_ANT: ".$tempoArbol." TABLA_ANT: ".$tablas[6]."<BR>";
                
                $tempoTabla = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ARBOL", "TABLA_ACTUAL", "ID_ANT", $tempo, "TABLA_ANT", $tablas[6]);
                $tempoTabla = 'ORD_DATOSNIV';
                // ECHO $tempo." ".$tempoTabla;
                $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable($tempoTabla, "NOMBRE", $tempo);
                
                // ECHO $tempo." ".$tempoTabla;
                if ($secuencia == null) {
                    // Listo el tercer subnivel
                    $nivel = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_DETLISTA", "ID", "VALOR", 3, "ID_ENCLISTA", 13);
                    $data['listaSubnivel'] = $this->OrdersModel->selectSubNivelWithFilters($nivel, $data['valorMiembros']);
                    $data['valorSubnivel'] = null;
                    $data['enlace'] = "fourthLevel";
                    $data['secuencia'] = $this->encryption->encrypt('2doNivel');
                    
                    // Cargo vista
                    $this->load->view('orders/configuration/formTreeDefinitionSecondLevel', $data);
                    // Cargo validaci�n de formulario
                    $this->load->view('validation/orders/configuration/ordersConfigurationTreeSecondLevelDefinitionValidation');
                } else if ($secuencia == "2doNivel") {
                    $data['enlace'] = "saveFourthLevel";
                    $data['secuencia'] = $this->encryption->encrypt('3');
                    $idSubNivel = $this->security->xss_clean($this->input->post('subnivel'));
                    $data['subnivel'] = $this->FunctionsGeneral->getFieldFromTable("ORD_DATOSNIV", "NOMBRE", $idSubNivel);
                    $data['idSubNivel'] = $idSubNivel;
                    $data['listaDatosNivVal'] = $this->OrdersModel->selectValuesLevelDefinition($idSubNivel);
                    // Identifico en donde debo buscar de acuerdo al tipo de orden
                    if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $data['valorTipo']) == 1) {
                        // Productos
                        /* Busco la relaci�n entre el tipo de orden y el proceso */
                        $data['listaNivel'] = $this->OrdersModel->selectValuesFirstSubLevelDefinition($id, 3, 'ORD_NAMPTMIEM');
                    } else {
                        // Servicios
                        /* Busco la relaci�n entre el tipo de orden y el proceso */
                        $data['listaNivel'] = $this->OrdersModel->selectValuesFirstSubLevelDefinition($id, 3, 'ORD_NIVSERTIPORD');
                    }
                    // Cargo vista
                    $this->load->view('orders/configuration/formTreeDefinitionFourthLevelInformation', $data);
                    // Cargo validaci�n de formulario
                    $this->load->view('validation/orders/configuration/ordersConfigurationTreeSecondLevelDescriptionValidation', $data);
                }
                
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
                redirect(base_url() . "OrdersConfigurationTreeDefinition/board");
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
        $mainPage = "OrdersConfigurationTreeDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "OrdersConfigurationTreeDefinition/board";
            // Recibo las variables principales
            $tipo = $this->security->xss_clean($this->input->post('tipo'));
            $miembros = $this->security->xss_clean($this->input->post('miembros'));
            // Obtengo id de la relaci�n entre miembros y tipo en la tabla ORD_TIPOMIEM
            $idTipoMiem = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_TIPOMIEM", "ID", "ID_TIPOORDEN", $tipo, "ID_MIEMBROS", $miembros);
            if ($idTipoMiem == '') {
                // Debo crear la relaci�n
                $idTipoMiem = $this->OrdersModel->insertBodyPartOrderType($tipo, $miembros, $this->session->userdata('usuario'));
            }
            // Identifico en donde debo buscar de acuerdo al tipo de orden
            if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipo) == 1) {
                // Productos
                $tabla = "ORD_NAMPTMIEM";
                $campo = "ID_NIVELAMP";
            } else {
                // Servicios
                $tabla = "ORD_NIVSERTIPORD";
                $campo = "ID_NIVSERVICIO";
            }
            // Inactivo relaciones que existan para el $idTipoMiem en la tabla $tabla
            $this->FunctionsGeneral->updateByField($tabla, "ESTADO", INACTIVO_ESTADO, "ID_TIPOMIEM", $idTipoMiem, $this->session->userdata('usuario'));
            //
            $registros = $this->security->xss_clean($this->input->post('nivel'));
            foreach ($registros as $registro) {
                $cantidad = $this->FunctionsGeneral->getQuantityFieldFromTable($tabla, "ID_TIPOMIEM", $idTipoMiem, $campo, $registro);
                if ($cantidad == 0) {
                    // Inserto el registro respectivo
                    $this->FunctionsGeneral->insertTwoParameter($tabla, "ID_TIPOMIEM", $idTipoMiem, $campo, $registro, $this->session->userdata('usuario'));
                } else {
                    // Actualizo registro a estado activo
                    $this->FunctionsGeneral->updateByField($tabla, "ESTADO", ACTIVO_ESTADO, "ID_TIPOMIEM", $idTipoMiem, $this->session->userdata('usuario'), $campo, $registro);
                }
                // echo $tipo," ",$miembros," ",$registro."<br>";
            }
            
            $nombre = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipo) . " - " . $this->FunctionsGeneral->getFieldFromTable("ORD_MIEMBROS", "NOMBRE", $miembros);
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', 'relationTOMbOk');
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function saveSecondLevel()
    {
        /**
         * Guarda informaci�n para segundo Nivel del �rbol de ordenes
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationTreeDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Estoy recibiendo por el post
            $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
            $tipo = $this->security->xss_clean($this->input->post('tipo'));
            $miembros = $this->security->xss_clean($this->input->post('miembros'));
            $idSubNivel = $this->security->xss_clean($this->input->post('idSubNivel'));
            $listaDatosNivVal = $this->OrdersModel->selectValuesLevelDefinition($idSubNivel);
            $nivel = 1;
            // Identifico las tablas que se deben tener en cuenta
            $tablas = retornaArrayTablas($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipo));
            if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipo) == 1) {
                // Productos
                /* Busco la relaci�n entre el tipo de orden y el proceso */
                $lista = $this->OrdersModel->selectBodyPartsSectionInTipoMiem($id);
            } else {
                // Servicios
                /* Busco la relaci�n entre el tipo de orden y el proceso */
                $lista = $this->OrdersModel->selectServiceSectionInTipoMiem($id);
            }
            foreach ($lista as $value) {
                // Recorro el primer nivel y lo inactivo dentro del �rbol
                $this->FunctionsGeneral->updateByField($tablas[1], "ESTADO", INACTIVO_ESTADO, "ID_ANT", $value->ID_NIVELAMP, $this->session->userdata('usuario'), "TABLA_ANT", $tablas[5]);
            }
            // Verifico relaciones a crear o modificar
            foreach ($lista as $value) {
                if ($this->FunctionsGeneral->getQuantityFieldFromTable($tablas[1], "ID_ANT", $value->ID_NIVELAMP, "TABLA_ANT", $tablas[5], "ID_ACTUAL", $idSubNivel, "TABLA_ACTUAL", $tablas[3], "NIVEL", $nivel) == 0) {
                    // Creo el registro del primer nivel
                    $treeHead = $this->OrdersModel->insertTreeHead($nivel, $value->ID_NIVELAMP, $tablas[5], $idSubNivel, $tablas[3], $this->session->userdata('usuario'));
                } else {
                    // Obtengo el id actual del arbol
                    $treeHead = $this->FunctionsGeneral->getFieldFromTableNotIdFields($tablas[1], "ID", "ID_ANT", $value->ID_NIVELAMP, "TABLA_ANT", $tablas[5], "ID_ACTUAL", $idSubNivel, "TABLA_ACTUAL", $tablas[3], "NIVEL", $nivel);
                    // Actualizo a activo el registro
                    $this->FunctionsGeneral->updateByID($tablas[1], "ESTADO", ACTIVO_ESTADO, $treeHead, $this->session->userdata('usuario'));
                }
                // Con el registro ahora debo validar el detalle del arbol para este nivel
                foreach ($listaDatosNivVal as $v) {
                    // Inactivo relaciones pasadas
                    $this->FunctionsGeneral->updateByField($tablas[6], "ESTADO", INACTIVO_ESTADO, "ID_ARBOL", $treeHead, $this->session->userdata('usuario'), "VALOR", $v->ID);
                    // Valido si debo crear nuevas relaciones o actualizar los valores
                    $tempo = 'check_' . $value->ID . "_" . $v->ID;
                    $tempo = $this->security->xss_clean($this->input->post($tempo));
                    // Valido que el valor se encuentre seleccionado
                    if ($tempo == 'on') {
                        if ($this->FunctionsGeneral->getQuantityFieldFromTable($tablas[6], "ID_ARBOL", $treeHead, "VALOR", $v->ID) == 0) {
                            // inserto el registro
                            $this->OrdersModel->insertTreeValues($treeHead, $v->ID, $this->session->userdata('usuario'));
                        } else {
                            // Actualizo el registro
                            $idArbolValores = $this->FunctionsGeneral->getFieldFromTableNotIdFields($tablas[6], "ID", "ID_ARBOL", $treeHead, "VALOR", $v->ID);
                            // Actualizo a activo el registro
                            $this->FunctionsGeneral->updateByID($tablas[6], "ESTADO", ACTIVO_ESTADO, $idArbolValores, $this->session->userdata('usuario'));
                        }
                    }
                }
            }
            // Verifico la cantidad de niveles definidos para el tipo de orden
            $niveles = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipo);
            // Continuo con el siguiente nivel
            $this->session->set_userdata('id', '.');
            
            // Redirecciono la p�gina
            if ($niveles > $nivel) {
                // Defino el siguiente nivel
                $this->session->set_userdata('auxiliar', "secondLevelOk");
                redirect(base_url() . "OrdersConfigurationTreeDefinition/thirdLevel/" . $this->security->xss_clean($this->input->post('id')));
            } else {
                // Retorno al panel central
                $this->session->set_userdata('auxiliar', "sndLevelOkNoLevel");
                redirect(base_url() . "OrdersConfigurationTreeDefinition/board/");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function saveThirdLevel()
    {
        /**
         * Guarda informaci�n para segundo Nivel del �rbol de ordenes 2do nivel
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationTreeDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Estoy recibiendo por el post
            $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
            $tipo = $this->security->xss_clean($this->input->post('tipo'));
            $miembros = $this->security->xss_clean($this->input->post('miembros'));
            $idSubNivel = $this->security->xss_clean($this->input->post('idSubNivel'));
            // Obtengo los id anteriores que est�n definidos en el arbol
            if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipo) == 1) {
                // Elementos
                $lista = $this->OrdersModel->selectValuesFirstSubLevelDefinition($id, 2, 'ORD_NAMPTMIEM');
            } else {
                // Servicios
                $lista = $this->OrdersModel->selectValuesFirstSubLevelDefinition($id, 2, 'ORD_NIVSERTIPORD');
            }
            // Valores encontrados para el nivel seleccionado
            $listaDatosNivVal = $this->OrdersModel->selectValuesLevelDefinition($idSubNivel);
            
            $nivel = 2;
            // Identifico las tablas que se deben tener en cuenta
            $tablas = retornaArrayTablas($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipo));
            foreach ($lista as $value) {
                // Recorro el segundo nivel y lo inactivo dentro del �rbol
                
                $this->FunctionsGeneral->updateByField($tablas[1], "ESTADO", INACTIVO_ESTADO, "ID_ANT", $value->ID, $this->session->userdata('usuario'), "TABLA_ANT", $tablas[6]);
            }
            // Verifico relaciones a crear o modificar
            foreach ($lista as $value) {
                if ($this->FunctionsGeneral->getQuantityFieldFromTable($tablas[1], "ID_ANT", $value->ID, "TABLA_ANT", $tablas[6], "ID_ACTUAL", $idSubNivel, "TABLA_ACTUAL", $tablas[3], "NIVEL", $nivel) == 0) {
                    // Creo el registro del primer nivel
                    $treeHead = $this->OrdersModel->insertTreeHead($nivel, $value->ID, $tablas[6], $idSubNivel, $tablas[3], $this->session->userdata('usuario'));
                } else {
                    // Obtengo el id actual del arbol
                    $treeHead = $this->FunctionsGeneral->getFieldFromTableNotIdFields($tablas[1], "ID", "ID_ANT", $value->ID, "TABLA_ANT", $tablas[6], "ID_ACTUAL", $idSubNivel, "TABLA_ACTUAL", $tablas[3], "NIVEL", $nivel);
                    // Actualizo a activo el registro
                    $this->FunctionsGeneral->updateByID($tablas[1], "ESTADO", ACTIVO_ESTADO, $treeHead, $this->session->userdata('usuario'));
                }
                // Con el registro ahora debo validar el detalle del arbol para este nivel
                foreach ($listaDatosNivVal as $v) {
                    // Inactivo relaciones pasadas
                    $this->FunctionsGeneral->updateByField($tablas[6], "ESTADO", INACTIVO_ESTADO, "ID_ARBOL", $treeHead, $this->session->userdata('usuario'), "VALOR", $v->ID);
                    // Valido si debo crear nuevas relaciones o actualizar los valores
                    $tempo = 'check_' . $value->ID . "_" . $v->ID;
                    $tempo = $this->security->xss_clean($this->input->post($tempo));
                    // Valido que el valor se encuentre seleccionado
                    if ($tempo == 'on') {
                        if ($this->FunctionsGeneral->getQuantityFieldFromTable($tablas[6], "ID_ARBOL", $treeHead, "VALOR", $v->ID) == 0) {
                            // inserto el registro
                            $this->OrdersModel->insertTreeValues($treeHead, $v->ID, $this->session->userdata('usuario'));
                        } else {
                            // Actualizo el registro
                            $idArbolValores = $this->FunctionsGeneral->getFieldFromTableNotIdFields($tablas[6], "ID", "ID_ARBOL", $treeHead, "VALOR", $v->ID);
                            // Actualizo a activo el registro
                            $this->FunctionsGeneral->updateByID($tablas[6], "ESTADO", ACTIVO_ESTADO, $idArbolValores, $this->session->userdata('usuario'));
                        }
                    }
                }
            }
            // Verifico la cantidad de niveles definidos para el tipo de orden
            $niveles = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipo);
            // Continuo con el siguiente nivel
            $this->session->set_userdata('id', '.');
            
            // Redirecciono la p�gina
            if ($niveles > $nivel) {
                // Defino el siguiente nivel
                $this->session->set_userdata('auxiliar', "secondLevelOk2");
                redirect(base_url() . "OrdersConfigurationTreeDefinition/fourthLevel/" . $this->security->xss_clean($this->input->post('id')));
            } else {
                // Retorno al panel central
                $this->session->set_userdata('auxiliar', "sndLevelOkNoLevel2");
                redirect(base_url() . "OrdersConfigurationTreeDefinition/board/");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function saveFourthLevel()
    {
        /**
         * Guarda informaci�n para segundo Nivel del �rbol de ordenes 2do nivel
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationTreeDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Estoy recibiendo por el post
            $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
            $tipo = $this->security->xss_clean($this->input->post('tipo'));
            $miembros = $this->security->xss_clean($this->input->post('miembros'));
            $idSubNivel = $this->security->xss_clean($this->input->post('idSubNivel'));
            // Obtengo los id anteriores que est�n definidos en el arbol
            if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipo) == 1) {
                // Elementos
                $lista = $this->OrdersModel->selectValuesFirstSubLevelDefinition($id, 3, 'ORD_NAMPTMIEM');
            } else {
                // Servicios
                $lista = $this->OrdersModel->selectValuesFirstSubLevelDefinition($id, 3, 'ORD_NIVSERTIPORD');
            }
            
            // Valores encontrados para el nivel seleccionado
            $listaDatosNivVal = $this->OrdersModel->selectValuesLevelDefinition($idSubNivel);
            
            $nivel = 3;
            // Identifico las tablas que se deben tener en cuenta
            $tablas = retornaArrayTablas($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipo));
            foreach ($lista as $value) {
                // Recorro el segundo nivel y lo inactivo dentro del �rbol
                
                $this->FunctionsGeneral->updateByField($tablas[1], "ESTADO", INACTIVO_ESTADO, "ID_ANT", $value->ID, $this->session->userdata('usuario'), "TABLA_ANT", $tablas[6]);
            }
            // Verifico relaciones a crear o modificar
            foreach ($lista as $value) {
                if ($this->FunctionsGeneral->getQuantityFieldFromTable($tablas[1], "ID_ANT", $value->ID, "TABLA_ANT", $tablas[6], "ID_ACTUAL", $idSubNivel, "TABLA_ACTUAL", $tablas[3], "NIVEL", $nivel) == 0) {
                    // Creo el registro del primer nivel
                    $treeHead = $this->OrdersModel->insertTreeHead($nivel, $value->ID, $tablas[6], $idSubNivel, $tablas[3], $this->session->userdata('usuario'));
                } else {
                    // Obtengo el id actual del arbol
                    $treeHead = $this->FunctionsGeneral->getFieldFromTableNotIdFields($tablas[1], "ID", "ID_ANT", $value->ID, "TABLA_ANT", $tablas[6], "ID_ACTUAL", $idSubNivel, "TABLA_ACTUAL", $tablas[3], "NIVEL", $nivel);
                    // Actualizo a activo el registro
                    $this->FunctionsGeneral->updateByID($tablas[1], "ESTADO", ACTIVO_ESTADO, $treeHead, $this->session->userdata('usuario'));
                }
                // Con el registro ahora debo validar el detalle del arbol para este nivel
                foreach ($listaDatosNivVal as $v) {
                    // Inactivo relaciones pasadas
                    $this->FunctionsGeneral->updateByField($tablas[6], "ESTADO", INACTIVO_ESTADO, "ID_ARBOL", $treeHead, $this->session->userdata('usuario'), "VALOR", $v->ID);
                    // Valido si debo crear nuevas relaciones o actualizar los valores
                    $tempo = 'check_' . $value->ID . "_" . $v->ID;
                    $tempo = $this->security->xss_clean($this->input->post($tempo));
                    // Valido que el valor se encuentre seleccionado
                    if ($tempo == 'on') {
                        if ($this->FunctionsGeneral->getQuantityFieldFromTable($tablas[6], "ID_ARBOL", $treeHead, "VALOR", $v->ID) == 0) {
                            // inserto el registro
                            $this->OrdersModel->insertTreeValues($treeHead, $v->ID, $this->session->userdata('usuario'));
                        } else {
                            // Actualizo el registro
                            $idArbolValores = $this->FunctionsGeneral->getFieldFromTableNotIdFields($tablas[6], "ID", "ID_ARBOL", $treeHead, "VALOR", $v->ID);
                            // Actualizo a activo el registro
                            $this->FunctionsGeneral->updateByID($tablas[6], "ESTADO", ACTIVO_ESTADO, $idArbolValores, $this->session->userdata('usuario'));
                        }
                    }
                }
            }
            
            // Continuo con el siguiente nivel
            $this->session->set_userdata('id', ".");
            // Retorno al panel central
            $this->session->set_userdata('auxiliar', "trdLevelOkNoLevel3");
            redirect(base_url() . "OrdersConfigurationTreeDefinition/board");
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }
}

?>