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

class StokePriceReportFromTree extends CI_Controller
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
        $mainPage = "StokePriceReportFromTree/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            
            //Valo ID que no sea fecha
            $validador=$this->session->userdata('variable1');
            $tempo= explode("/", $validador);
            if(count($tempo)>1){
                $this->session->set_userdata('variable1', null);
            }

           
            
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "StokePriceReportFromTree/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, 'myTable', null);
            // Pinto la informaci�n de los parametros de la aplicaci�n
            // Incluyo el Nestable
            $data['variable'] = 0;
            $this->load->view('common/nestableScripts', $data);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            $data['pagina'] = "StokePriceReportFromTree/newRegister";
            $data['filtro'] = "StokePriceReportFromTree/filter";
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
            $this->load->view('stokePrice\reports\boardProducts', $data);
            
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

        public function elementsOfProduct($id)
    {
        // echo " ------------------------------------------------- variable 1: ".$this->session->userdata('variable1')." variable 2: ".$this->session->userdata('variable2')." ".$this->session->userdata('usuario');
        
        /**
         * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "StokePriceReportFromTree/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Cargo la p�gina principal
                $mainPage = "StokePriceReportFromTree/board";
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
                redirect(base_url() . "StokePriceReportFromTree/board");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    
}

?>