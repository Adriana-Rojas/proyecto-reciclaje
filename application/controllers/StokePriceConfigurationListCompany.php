<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para definir el listado empresas especiales
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class StokePriceConfigurationListCompany extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // Cargo modelos, librerias y helpers
        $this->load->model('StokePriceModel'); // Libreria principal de las funciones referentes a cotizaciones
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
        $mainPage = "StokePriceConfigurationListCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "StokePriceConfigurationListCompany/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);
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
            $data['listaLista'] = $this->StokePriceModel->selectListDefineRelationCompanyListCompany();
            
            // Pinto plantilla principal
            // Pinto la lista genérica de parametros que se debe tener en cuenta dentro del sistema de parámetros
            $this->load->view('stokePrice/configuration/boardCompanyList', $data);
            
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

    public function boardElements($id)
    {
        // Redirecciono la página
                redirect(base_url() . "StokePriceConfigurationListCompanyElements/board/".$id);
    }
    public function newRegister()
    {
        /**
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationListCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la página principal
            $mainPage = "StokePriceConfigurationListCompany/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['id'] = null;
            $data['mainPage'] = $mainPage;
            
            // información adicional
            $data['codigo'] = null;
            $data['cerrada'] = null;
            $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
            
            
            // Listado de empresas
            $data['listaGrupos'] = $this->EsaludModel->getCompaniesInformation();
            $data['empresa'] = null;

            $data['disabled'] = null;
            // Cargo vista
            $this->load->view('stokePrice/configuration/formCompanyList', $data);
            // Cargo validación de formulario
            $this->load->view('validation/stokePrice/configuration/stokePriceConfigurationListCompanyValidation');
            
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
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationListCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la página principal
            $mainPage = "StokePriceConfigurationListCompany/board";
            $data = null;
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_TIEMPO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Información relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['id'] = $this->encryption->encrypt($id);
                $data['mainPage'] = $mainPage;
                
                // información adicional
                $data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_CODIGO", $id);;
                $data['cerrada'] = $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_CERRADA", $id);;
                $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
                
                
                // Listado de empresas
                $data['listaGrupos'] = $this->EsaludModel->getCompaniesInformation();
                $data['empresa'] = $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_EMPRESA", $id);;

                $data['disabled'] = "disabled='disabled'";
                // Cargo vista
                $this->load->view('stokePrice/configuration/formCompanyList', $data);
                // Cargo validación de formulario
                $this->load->view('validation/stokePrice/configuration/stokePriceConfigurationListCompanyValidation');
                
                /**
                 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                 */
                
                // Pinto el final de la página (páginas internas)
                showCommonEnds($this, null, null);

            }else{
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . "StokePriceConfigurationListCompany/board");

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
        $mainPage = "StokePriceConfigurationListCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
            $mainPage = "StokePriceConfigurationListCompany/board";

            $empresa = $this->security->xss_clean($this->input->post('empresa'));
            $codigo = $this->security->xss_clean($this->input->post('codigo'));
            $cerrada = $this->security->xss_clean($this->input->post('cerrada'));

            if ($codigo==CTE_VALOR_NO && $cerrada==CTE_VALOR_NO){
                $mensaje = "relationListNotPossible";
            }else{
                if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                    
                    if ($this->FunctionsGeneral->getQuantityFieldFromTable("COT_EMPRESALISTA", "ID_EMPRESA", $empresa) == 0) {
                        // Creo el registro general
                        $this->StokePriceModel->insertListForCompany($empresa,$cerrada,$codigo, $this->session->userdata('usuario'));
                        
                        // Pinto mensaje para retornar a la aplicación
                        $mensaje = "relationCompanyList";
                    } else {
                        // Creo mensaje de creaciòn de usuario
                        $mensaje = "ConfigExistList";
                    }
                }else{
                    //Actualizo valores
                    
                    $this->FunctionsGeneral->updateByID("COT_EMPRESALISTA", "ID_CERRADA", $cerrada,  $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $this->session->userdata('usuario'));
                    $this->FunctionsGeneral->updateByID("COT_EMPRESALISTA", "ID_CODIGO", $codigo,  $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $this->session->userdata('usuario'));
                    // Pinto mensaje para retornar a la aplicación
                    $mensaje = "relationCompanyList";
                }
                
            }
            //echo $mensaje;
            // Pinto mensaje para retornar a la aplicación
            $this->session->set_userdata('id', null);
            $this->session->set_userdata('auxiliar', $mensaje);
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
        $mainPage = "StokePriceConfigurationListCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
             
            // Cargo información de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneral';
                $this->FunctionsGeneral->updateByID("COT_EMPRESALISTA", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
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