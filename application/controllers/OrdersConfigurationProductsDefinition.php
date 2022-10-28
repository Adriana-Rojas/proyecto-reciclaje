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

class OrdersConfigurationProductsDefinition extends CI_Controller
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
    public function board($id = null, $tipoOrden = null)
    {
        /**
         * Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationProductsDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            
            //Valo ID que no sea fecha
            $validador=$this->session->userdata('variable1');
            $tempo= explode("/", $validador);
            if(count($tempo)>1){
                $this->session->set_userdata('variable1', null);
            }

           
            
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "OrdersConfigurationProductsDefinition/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la informaci�n de los parametros de la aplicaci�n
            // Incluyo el Nestable
            $data['variable'] = 0;
            $this->load->view('common/nestableScripts', $data);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            $data['pagina'] = "OrdersConfigurationProductsDefinition/newRegister";
            $data['filtro'] = "OrdersConfigurationProductsDefinition/filter";
            $data['board'] = "Valores parametrizados";
            // Pinto los permisos del tablero de control
            $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
            $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
            $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);
            // Recibo el valor de $id
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLVALORES", "ID", $this->encryption->decrypt($id));
            $tipoOrden = $this->encryption->decrypt($tipoOrden);
            
            // echo " ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2')." Usuario: ".$this->session->userdata('usuario');
            
            // Lista de listas
            if ($id != '' && $tipoOrden != '') {
                // echo "<br> ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2')." ".$this->session->userdata('usuario');
                
                $this->session->set_userdata('variable1', $id);
                $this->session->set_userdata('variable2', $tipoOrden);
                // echo "<br> ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2')." ".$this->session->userdata('usuario');
                
                // Pinto los valores de acuerdo al parametro dado
                $data['listaLista'] = $this->OrdersModel->selectProductListDefinition($id);
                // Ruta de �rbol de �rdenes
                $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
                $data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
                $data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);
                $data['nombreMiembros'] = null;
                if ($data['niveles'] == 1) {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $id);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $id);
                    ;
                } else if ($data['niveles'] == 2) {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $id);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $id);
                    ;
                    $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $id);
                } else {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $id);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $id);
                    ;
                    $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $id);
                    ;
                    $data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $id);
                }
            } else {
                // echo " ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2');
                
                if ($this->session->userdata('variable1') != '') {
                    // Pinto los valores de acuerdo al parametro dado
                    $id = $this->session->userdata('variable1');
                    $tipoOrden = $this->session->userdata('variable2');
                    // echo "abajosssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss".$tipoOrden." ".$id;
                    
                    $data['listaLista'] = $this->OrdersModel->selectProductListDefinition($id);
                    if ($data['listaLista']!=null) {
                        // Ruta de �rbol de �rdenes
                        $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
                        $data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
                        $data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);
                        $data['nombreMiembros'] = null;
                        if ($data['niveles'] == 1) {
                            $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $id);
                            $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $id);
                            ;
                        } else if ($data['niveles'] == 2) {
                            $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $id);
                            $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $id);
                            ;
                            $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $id);
                        } else {
                            $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $id);
                            $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $id);
                            ;
                            $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $id);
                            ;
                            $data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $id);
                        }
                    } else {
                        // No pinto ning�n valor
                        $data['listaLista'] = null;
                        // Ruta de �rbol de �rdenes
                        $data['nombreTipo'] = null;
                        $data['niveles'] = null;
                        $data['idValida'] = null;
                        $data['nombreMiembros'] = null;
                        if ($data['niveles'] == 1) {
                            $data['nombreMiembros'] = null;
                            $data['nomPrimerSubNiv'] = null;
                        } else if ($data['niveles'] == 2) {
                            $data['nombreMiembros'] = null;
                            $data['nomPrimerSubNiv'] = null;
                            $data['nomSegundoSubNiv'] = null;
                        } else {
                            $data['nombreMiembros'] = null;
                            $data['nomPrimerSubNiv'] = null;
                            $data['nomSegundoSubNiv'] = null;
                            $data['nomTerceroSubNiv'] = null;
                        }
                        $this->session->set_userdata('variable1', '');
                        $this->session->set_userdata('variable2', '');
                    }
                } else {
                    // echo "aqui";
                    // No pinto ning�n valor
                    $data['listaLista'] = null;
                    // Ruta de �rbol de �rdenes
                    $data['nombreTipo'] = null;
                    $data['niveles'] = null;
                    $data['idValida'] = null;
                    $data['nombreMiembros'] = null;
                    if ($data['niveles'] == 1) {
                        $data['nombreMiembros'] = null;
                        $data['nomPrimerSubNiv'] = null;
                    } else if ($data['niveles'] == 2) {
                        $data['nombreMiembros'] = null;
                        $data['nomPrimerSubNiv'] = null;
                        $data['nomSegundoSubNiv'] = null;
                    } else {
                        $data['nombreMiembros'] = null;
                        $data['nomPrimerSubNiv'] = null;
                        $data['nomSegundoSubNiv'] = null;
                        $data['nomTerceroSubNiv'] = null;
                    }
                    
                    $this->session->set_userdata('variable1', '');
                    $this->session->set_userdata('variable2', '');
                }
            }
            // echo "<br> ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2')." ".$this->session->userdata('usuario');
            
            // Lista del arbol
            
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('orders/configuration/boardProducts', $data);
            
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

    public function newRegister($id = null, $tipoOrden = null)
    {
        /**
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        // echo "<br> ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2')." ".$this->session->userdata('usuario');
        $mainPage = "OrdersConfigurationProductsDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLVALORES", "ID", $this->encryption->decrypt($id));
            $tipoOrden = $this->encryption->decrypt($tipoOrden);
            
            if ($id != '') {
                $this->session->set_userdata('variable1', $id);
                $this->session->set_userdata('variable2', $tipoOrden);
                // echo "<br> ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2')." ".$this->session->userdata('usuario');
                
                // Cargo la p�gina principal
                $mainPage = "OrdersConfigurationProductsDefinition/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('newRegister');
                $data['mainPage'] = $mainPage;
                $data['idArbol'] = $this->encryption->encrypt($id);
                $data['id'] = null;
                $data['tipoOrden'] = $tipoOrden;
                $data['nombre'] = null;
                $data['codigo'] = null;
                $data['descripcion'] = null;
                $data['listaTiempo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_TIEMPO", 'DESC');
                $data['tiempo'] = null;
                $data['paquete'] = null; // Paquete de interconsultas
                $data['cantidad'] = null; // Paquete de interconsultas
                $data['displayPaquete'] = 'style="display: none;"'; // Paquete de interconsultas
                $data['disabledPaquete'] = 'disabled="disabled"'; // Paquete de interconsultas
                                                                
                // Ruta de �rbol de �rdenes
                $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
                $data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
                $data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);
                $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
                
                $data['nombreMiembros'] = null;
                if ($data['niveles'] == 1) {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $id);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $id);
                    ;
                } else if ($data['niveles'] == 2) {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $id);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $id);
                    ;
                    $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $id);
                } else {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $id);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $id);
                    ;
                    $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $id);
                    ;
                    $data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $id);
                }
                // Fin Ruta de �rbol de �rdenes
                // Cargo vista
                $this->load->view('orders/configuration/formProductsDefinition', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/orders/configuration/ordersConfigurationProductsDefinitionValidation');
                
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
                redirect(base_url() . "OrdersConfigurationProductsDefinition/board");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function edit($id)
    {
        // echo " ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2')." ".$this->session->userdata('usuario');
        
        /**
         * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationProductsDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Cargo la p�gina principal
                $mainPage = "OrdersConfigurationProductsDefinition/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                // Incluyo el Nestable
                $data['variable'] = 0;
                $this->load->view('common/nestableScripts', $data);
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['mainPage'] = $mainPage;
                $data['id'] = $this->encryption->encrypt($id);
                // Obtengo el id del tipo de orden
                $valores = retornaTipoOrdenFromArbolCodigo($id);
                
                $data['tipoOrden'] = $valores[0];
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $id);
                $data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $id);
                $data['descripcion'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "DESCRIPCION", $id);
                $data['listaTiempo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_TIEMPO", 'DESC');
                $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
                $data['tiempo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_TIEMPO", $id);
                ;
                
                if ($this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_PAQUETEVALORA", "CANTIDAD", "ID_ARBOLCODIGO", $id, "ESTADO", ACTIVO_ESTADO) != '') {
                    $data['paquete'] = CTE_VALOR_SI; // Paquete de interconsultas
                    $data['displayPaquete'] = ''; // Paquete de interconsultas
                    $data['disabledPaquete'] = ''; // Paquete de interconsultas
                } else {
                    $data['paquete'] = CTE_VALOR_NO; // Paquete de interconsultas
                    $data['displayPaquete'] = 'style="display: none;"'; // Paquete de interconsultas
                    $data['disabledPaquete'] = 'disabled="disabled"'; // Paquete de interconsultas
                }
                
                $data['cantidad'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PAQUETEVALORA", "CANTIDAD", "ID_ARBOLCODIGO", $id); // Paquete de interconsultas
                $data['idArbol'] = $this->encryption->encrypt($id);
                // Ruta de �rbol de �rdenes
                $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $valores[0]);
                $data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $valores[0]);
                $data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $valores[0]);
                $data['nombreMiembros'] = null;
                
                if ($data['niveles'] == 1) {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $valores[1]);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $valores[1]);
                    ;
                } else if ($data['niveles'] == 2) {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $valores[1]);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $valores[1]);
                    ;
                    $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $valores[1]);
                } else {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $valores[1]);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $valores[1]);
                    ;
                    $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $valores[1]);
                    ;
                    $data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $valores[1]);
                }
                
                // Fin Ruta arbol de ordenes
                // Cargo vista
                $this->load->view('orders/configuration/formProductsDefinition', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/orders/configuration/ordersConfigurationProductsDefinitionValidation');
                
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
                redirect(base_url() . "OrdersConfigurationProductsDefinition/board");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function editTree($id)
    {
        // echo " ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2')." ".$this->session->userdata('usuario');
        
        /**
         * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationProductsDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Cargo la p�gina principal
                $mainPage = "OrdersConfigurationProductsDefinition/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                // Incluyo el Nestable
                $data['variable'] = 0;
                $this->load->view('common/nestableScripts', $data);
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('editTree');
                $data['mainPage'] = $mainPage;
                $data['id'] = $this->encryption->encrypt($id);
                
                // Obtengo el id del tipo de orden
                $valores = retornaTipoOrdenFromArbolCodigo($id);
                
                $data['tipoOrden'] = $valores[0];
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $id);
                $data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $id);
                
                // Ruta de �rbol de �rdenes
                $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $valores[0]);
                $data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $valores[0]);
                $data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $valores[0]);
                $data['nombreMiembros'] = null;
                
                if ($data['niveles'] == 1) {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $valores[1]);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $valores[1]);
                    ;
                } else if ($data['niveles'] == 2) {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $valores[1]);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $valores[1]);
                    ;
                    $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $valores[1]);
                } else {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $valores[1]);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $valores[1]);
                    ;
                    $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $valores[1]);
                    ;
                    $data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $valores[1]);
                }
                // Arbol para cambiar
                $route = "OrdersConfigurationProductsDefinition/saveNewRoute/" . $this->encryption->encrypt($id) . "/";
                $data['arbol'] = $this->OrdersModel->selectTreeInformation($route, 0, 'nestable');
                
                // Fin Ruta arbol de ordenes
                // Cargo vista
                $this->load->view('orders/configuration/formProductsEditTree', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/orders/configuration/ordersConfigurationProductsDefinitionValidation');
                
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
                redirect(base_url() . "OrdersConfigurationProductsDefinition/board");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function elementsOfProduct($id)
    {
        // echo " ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2')." ".$this->session->userdata('usuario');
        
        /**
         * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationProductsDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Cargo la p�gina principal
                $mainPage = "OrdersConfigurationProductsDefinition/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['mainPage'] = $mainPage;
                $data['id'] = $this->encryption->encrypt($id);
                echo "<script>console.log('Id: " . $id . "' );</script>";
                // Obtengo el id del tipo de orden
                $valores = retornaTipoOrdenFromArbolCodigo($id);
                
                $data['tipoOrden'] = $valores[0];
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $id);
                $data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $id);
               // $data['descripcion'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "DESCRIPCION", $id);
                $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
                //$data['listaTiempo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_TIEMPO", 'DESC');
               // $data['tiempo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_TIEMPO", $id);
                // Ruta de �rbol de �rdenes
                $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $valores[0]);
                $data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $valores[0]);
                $data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $valores[0]);
                $data['nombreMiembros'] = null;
                if ($data['niveles'] == 1) {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $valores[1]);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $valores[1]);
                    ;
                } else if ($data['niveles'] == 2) {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $valores[1]);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $valores[1]);
                    ;
                    $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $valores[1]);
                } else {
                    $data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $valores[1]);
                    $data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $valores[1]);
                    ;
                    $data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $valores[1]);
                    ;
                    $data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $valores[1]);
                }
                $data['idArbol'] = $this->encryption->encrypt($valores[1]);
                
                // Fin Ruta arbol de ordenes
                // Cargo valores de los grupos de elementos
                // Lista de grupos
                $data['listaGrupo'] = $this->OrdersModel->selectGroupElementListByBodyPart($valores[2]);
                // Listo los elementos que est�n asociados al despiece del producto
                $data['listaDespiece'] = $this->OrdersModel->selectElementProductoList($id);
                //Listo los codigos asociados al mismo arbol
                $condicion="and ID!='$id'";
                $data['listaArbol'] = $this->OrdersModel->selectElementsOfTree($valores[1],$condicion);
                // Cargo vista
                $this->load->view('orders/configuration/formProductsEditTreeElementsOfProduct', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/orders/configuration/ordersConfigurationProductsElementsDefinitionValidation');
                
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
                redirect(base_url() . "OrdersConfigurationProductsDefinition/board");
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
         * Salvo la informaci�n del elemento que ha sido creado o modificado, se debe tener en cuenta que este puede ser comodin o no
         * y sobre ese valor se tendr�n en cuenta los parametros del formulario que se diligencio anteriormente.
         * Tener en cuenta que cuando es comod�n solo se podr� tener un c�digo de este tipo por grupo de elemento
         */
        $mainPage = "OrdersConfigurationProductsDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "OrdersConfigurationProductsDefinition/board";
            $nombre = $this->security->xss_clean($this->input->post('nombre'));
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                // Inserto registro
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $this->security->xss_clean($this->input->post('codigo'))) == 0) {
                    // Inserto el producto o servicio
                    $tempo = $this->OrdersModel->insertTreeCodes($this->encryption->decrypt($this->security->xss_clean($this->input->post('idArbol'))), $this->security->xss_clean($this->input->post('codigo')), $nombre, $this->security->xss_clean($this->input->post('descripcion')), $this->security->xss_clean($this->input->post('tiempo')), $this->session->userdata('usuario'));
                    $this->session->set_userdata('variable1', $this->encryption->decrypt($this->security->xss_clean($this->input->post('idArbol'))));
                    $valores = retornaTipoOrdenFromArbolCodigo($tempo);
                    $this->session->set_userdata('variable2', $valores[0]);
                    $message = 'codeProductOk';
                    $id = $tempo;
                } else {
                    $message = 'codeProductError';
                }
            } else {
                // Se actualiza registro
                $id = $this->encryption->decrypt($this->input->post('id'));
                $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID", $id);
                $this->OrdersModel->updateTreeCodes($id, $this->security->xss_clean($this->input->post('codigo')), $nombre, $this->security->xss_clean($this->input->post('descripcion')), $this->security->xss_clean($this->input->post('tiempo')), $this->session->userdata('usuario'));
                $message = 'codeProductOk';
            }
            
            // Valido si es interconsulta
            if ($this->security->xss_clean($this->input->post('tipoOrden')) == INTERCONSULTAS) {
                // Es interconsultas valido si aplico paquete
                if ($this->security->xss_clean($this->input->post('paquete')) == CTE_VALOR_SI) {
                    // Es interconsultas valido si aplico paquete
                    if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_PAQUETEVALORA", "ID_ARBOLCODIGO", $id) == 0) {
                        // Inserto el producto o servicio
                        $this->OrdersModel->insertServicePackage($id, $this->security->xss_clean($this->input->post('cantidad')), $this->session->userdata('usuario'));
                    } else {
                        // Activo el registro y la cantidad
                        $this->FunctionsGeneral->updateByField("ORD_PAQUETEVALORA", "ESTADO", ACTIVO_ESTADO, "ID_ARBOLCODIGO", $id, $this->session->userdata('usuario'));
                        $this->FunctionsGeneral->updateByField("ORD_PAQUETEVALORA", "CANTIDAD", $this->security->xss_clean($this->input->post('cantidad')), "ID_ARBOLCODIGO", $id, $this->session->userdata('usuario'));
                    }
                } else {
                    // Inactivo el estado
                    $this->FunctionsGeneral->updateByField("ORD_PAQUETEVALORA", "ESTADO", INACTIVO_ESTADO, "ID_ARBOLCODIGO", $id, $this->session->userdata('usuario'));
                }
            }
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', $message);
            
            // echo " ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2');
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function saveNewRoute($id, $idTree)
    {
        /**
         * Salvo la nueva ruta del c�digo del elemento con id $id
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationProductsDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "OrdersConfigurationProductsDefinition/board";
            
            // Cargo informaci�n de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'codeProductOk';
                $this->FunctionsGeneral->updateByID("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $this->encryption->decrypt($idTree), $id, $this->session->userdata('usuario'));
                // Pinto mensaje para retornar a la aplicaci�n
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', $message);
                $this->session->set_userdata('variable1', $this->encryption->decrypt($idTree));
                $valores = retornaTipoOrdenFromArbolCodigo($id);
                $this->session->set_userdata('variable2', $valores[0]);
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

    public function saveElementsOfProducts($id = null, $idDespiece = null)
    {
        /**
         * Salvo la nueva ruta del c�digo del elemento con id $id
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationProductsDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            
            if($this->security->xss_clean($this->input->post('clona'))==CTE_VALOR_SI){
                //Se clonar� el despiece
                
                // Id Elemento
                $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
                // Id despiece
                $idDespiece = $this->security->xss_clean($this->input->post('despiece'));
                
                //Elimino el despiece para  el id $id
                $this->OrdersModel->deleteElementProductFromProduct($id);
                
                //Obtengo el despiece desde $idDespiece
                foreach ($this->OrdersModel->selectElementProductoList($idDespiece) as $value){
                    //Realizo el insert de los elementos del despiece
                    $this->OrdersModel->insertTreeElementProduct($id, 
                        $value->ID_ELEMENTO, 
                        $value->CANTIDAD, 
                        $this->session->userdata('usuario'));
                }
                
                // Obtengo valores para retornar
                $valores = retornaTipoOrdenFromArbolCodigo($id);
                // Pinto mensaje para retornar a la aplicaci�n
                $message = 'cloneOk';
                $this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $id));
                $this->session->set_userdata('auxiliar', $message);
                $this->session->set_userdata('variable1', $valores[1]);
                $this->session->set_userdata('variable2', $valores[0]);
                // Redirecciono la p�gina
                $mainPage = "OrdersConfigurationProductsDefinition/elementsOfProduct/" . $this->encryption->encrypt($id);
                redirect(base_url() . $mainPage);
            }else{
                //Rutina del despiece normal
                if ($id == null) {
                    // P�gina principal a donde debo retornar
                    $mainPage = "OrdersConfigurationProductsDefinition/elementsOfProduct/" . $this->security->xss_clean($this->input->post('id'));
                    // Decifo el id del elemento
                    $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
                    if ($id != '') {
                        // echo $id;
                        // Verifico si ya existe el encabezado del despiece
                        if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_DESPIECE", "ID_ARBOLCODIGO", $id, "ID_ELEMENTO", $this->security->xss_clean($this->input->post('elemento'))) == 0) {
                            $this->OrdersModel->insertTreeElementProduct($id, $this->security->xss_clean($this->input->post('elemento')), str_replace(',', '.', $this->security->xss_clean($this->input->post('cantidad'))), $this->session->userdata('usuario'));
                        } else {
                            // Busco id respectivo y actualizo el registro
                            $idDespiece = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_DESPIECE", "ID_ARBOLCODIGO", $id, "ID_ELEMENTO", $this->security->xss_clean($this->input->post('elemento')));
                            // ECHO $idDespiece." PRODUCTO: ".$id." ELEMENTO: ".$this->security->xss_clean($this->input->post('elemento'));
                            // Estado
                            $this->FunctionsGeneral->updateByField("ORD_DESPIECE", "ESTADO", ACTIVO_ESTADO, "ID_ARBOLCODIGO", $id, $this->session->userdata('usuario'), "ID_ELEMENTO", $this->security->xss_clean($this->input->post('elemento')));
                            
                            // Cantidad
                            $this->FunctionsGeneral->updateByField("ORD_DESPIECE", "CANTIDAD", str_replace(',', '.', $this->security->xss_clean($this->input->post('cantidad'))), "ID_ARBOLCODIGO", $id, $this->session->userdata('usuario'), "ID_ELEMENTO", $this->security->xss_clean($this->input->post('elemento')));
                        }
                        
                        // Pinto mensaje para retornar a la aplicaci�n
                        $message = 'codeProductOk';
                        $this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $id));
                        $this->session->set_userdata('auxiliar', $message);
                        $this->session->set_userdata('variable1', $this->encryption->decrypt($this->input->post('idArbol')));
                        $valores = retornaTipoOrdenFromArbolCodigo($id);
                        $this->session->set_userdata('variable2', $this->input->post('tipoOrden'));
                        // Redirecciono la p�gina
                        redirect(base_url() . $mainPage);
                    } else {
                        // Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
                        $this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $id));
                        $this->session->set_userdata('auxiliar', "notInformationGeneral");
                        // Redirecciono la p�gina
                        redirect(base_url() . $mainPage);
                    }
                } else {
                    // Id Elemento
                    $id = $this->encryption->decrypt($id);
                    // Id despiece
                    $idDespiece = $this->encryption->decrypt($idDespiece);
                    // Inactivo el registro
                    $this->FunctionsGeneral->updateByID("ORD_DESPIECE", "ESTADO", INACTIVO_ESTADO, $idDespiece, $this->session->userdata('usuario'));
                    // Obtengo valores para retornar
                    $valores = retornaTipoOrdenFromArbolCodigo($id);
                    // Pinto mensaje para retornar a la aplicaci�n
                    $message = 'codeProductOk';
                    $this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $id));
                    $this->session->set_userdata('auxiliar', $message);
                    $this->session->set_userdata('variable1', $valores[1]);
                    $this->session->set_userdata('variable2', $valores[0]);
                    // Redirecciono la p�gina
                    $mainPage = "OrdersConfigurationProductsDefinition/elementsOfProduct/" . $this->encryption->encrypt($id);
                    redirect(base_url() . $mainPage);
                }
            
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
        $mainPage = "OrdersConfigurationProductsDefinition/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "OrdersConfigurationProductsDefinition/board";
            
            // Cargo informaci�n de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneral';
                $this->FunctionsGeneral->updateByID("ORD_ARBOLCODIGO", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
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
