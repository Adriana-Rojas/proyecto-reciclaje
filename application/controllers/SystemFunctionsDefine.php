<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para visualizar el manejo de las listas que se tienen definidas dentro de la aplicación administración (sistema)
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class SystemFunctionsDefine extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // Cargo modelos, librerias y helpers
        $this->load->model('SystemModel'); // Libreria principal de las funciones referentes a sistema
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
        $mainPage = "SystemFunctionsDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper
            $mainPage = "SystemFunctionsDefine/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la información de los parametros de la aplicación
            // Pinto la pantalla
            $data['mainPage'] = $mainPage;
            $data['pagina'] = $mainPage;
            // Pinto los permisos del tablero de control
            $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
            $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
            $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);
            $usuRolper = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_USUROLPER", "ID_ROLPERFIL", "ID_USUARIO", $this->session->userdata('usuario'));
            $data['idPerfil'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_ROLPERFIL", "ID_PERFIL", "ID", $usuRolper);
            
            // Lista de listas
            $data['listaProceso'] = $this->SystemModel->getListModulos();
            // Valores de las variables respectivas
            if ($this->security->xss_clean($this->input->post('modulo')) != '') {
                $moduloId = $this->security->xss_clean($this->input->post('modulo'));
            } else {
                $moduloId = $this->session->userdata('variable1');
            }
            if ($moduloId != '') {
                $this->session->set_userdata('variable1', $moduloId);
            } else {
                $this->session->set_userdata('variable1', '');
            }
            
            $data['modulo'] = $this->session->userdata('variable1');
            if ($data['modulo'] == '') {
                $data['listaLista'] = null;
                $condicion ="";
            } else {
                $condicion = "and ADM_MODULO.ID ='$moduloId'";
                $data['listaLista'] = $this->SystemModel->getListFunciones($condicion);
            }
            // pinto variable
            $data['moduloId'] = $this->encryption->encrypt($this->session->userdata('variable1'));
            
            // Lista de listas
            
            // Pinto plantilla principal
            $data['board'] = "Valores parametrizados";
            $this->load->view('system/functionsDefine/board', $data);
            // Cargo validación de formulario
            $this->load->view('validation/system/systemFunctionDefineValidationInBoard');
            
            // Pinto el final de la página (páginas internas
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function newRegister($modulo = null)
    {
        /**
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SystemFunctionsDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la página principal
            $mainPage = "SystemFunctionsDefine/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['mainPage'] = $mainPage;
            $data['id'] = null;
            $data['idModulo'] = $modulo;
            $data['modulo'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODNOMBRE", "NOMBRE", "ID_MODULO", $this->encryption->decrypt($modulo));
            $data['nombre'] = null;
            $data['ubicacion'] = null;
            $data['paginaSig'] = null;
            $data['tipo'] = null;
            $data['icono'] = null;
            // Pinto lista de los roles seleccionados
            $data['listaPerfil'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PERFIL", 'ASC', ACTIVO_ESTADO);
            $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
            // Lista de aplica
            $data['listaTipo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('LISTA_MODULOS', '1');
            
            $data['pagina'] = "SystemFunctionsDefine/saveRegister";
            // Cargo vista
            $this->load->view('system/functionsDefine/formFunctionsDefine', $data);
            // Cargo validación de formulario
            $this->load->view('validation/system/systemFunctionDefineValidationInForm');
            
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
        $mainPage = "SystemFunctionsDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("ADM_MODFUNCIONES", "ID", $this->encryption->decrypt($id));
            $modulo = $this->FunctionsGeneral->getFieldFromTable("ADM_MODFUNCIONES", "ID_MODULO", $id);
            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $mainPage = "SystemFunctionsDefine/board";
                $data = null;
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Información relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['mainPage'] = $mainPage;
                $data['id'] = $id;
                $data['idModulo'] = $modulo;
                $data['modulo'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODNOMBRE", "NOMBRE", "ID_MODULO", $modulo);
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ADM_MODFUNCIONES", "NOMBRE", $id);
                $data['ubicacion'] = $this->FunctionsGeneral->getFieldFromTable("ADM_MODFUNCIONES", "FUNCION", $id);
                ;
                $data['paginaSig'] = $this->FunctionsGeneral->getFieldFromTable("ADM_MODFUNCIONES", "PAGINA", $id);
                ;
                $data['tipo'] = $this->FunctionsGeneral->getFieldFromTable("ADM_MODFUNCIONES", "ID_TIPO", $id);
                ;
                $data['icono'] = $this->FunctionsGeneral->getFieldFromTable("ADM_MODFUNCIONES", "ICONO", $id);
                ;
                // Pinto lista de los roles seleccionados
                $data['listaPerfil'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PERFIL", 'ASC', ACTIVO_ESTADO);
                $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
                // Lista de aplica
                $data['listaTipo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('LISTA_MODULOS', '1');
                
                $data['pagina'] = "SystemFunctionsDefine/saveRegister";
                
                // Cargo vista
                $this->load->view('system/functionsDefine/formFunctionsDefine', $data);
                // Cargo validación de formulario
                $this->load->view('validation/system/systemFunctionDefineValidationInForm');
                
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
                redirect(base_url() . "SystemFunctionsDefine/board");
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
        $mainPage = "SystemFunctionsDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
            $mainPage = "SystemFunctionsDefine/board";
            $nombre = $this->security->xss_clean($this->input->post('nombre')); //
            
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                // Identificador del módulo
                $idModulo = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idModulo')));
                // Valido que no exista una función con el mismo nombre para el módulo $id
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ADM_MODFUNCIONES", "NOMBRE", $nombre, "ID_MODULO", $idModulo) == 0) {
                    // Puedo hacer el insert del encabezado de la función
                    $idEnc = $this->SystemModel->insertEncFunction($idModulo, $nombre, $this->security->xss_clean($this->input->post('tipo')), $this->security->xss_clean($this->input->post('pagina')), $this->security->xss_clean($this->input->post('ubicacion')), $this->security->xss_clean($this->input->post('icono')), $this->session->userdata('usuario'));
                    // RETORNO MENSAJE
                    $mensaje = "configUpdate";
                } else {
                    // Creo mensaje de creaciòn de usuario
                    $mensaje = "ConfigExist";
                }
            } else {
                // Actualizo los valores para el parametro respectivo en la tabla dada
                // Actualizar registro
                $idEnc = $this->security->xss_clean($this->input->post('id'));
                
                $this->SystemModel->updateFunction($idEnc, $this->security->xss_clean($this->input->post('nombre')), $this->security->xss_clean($this->input->post('idModulo')), $this->security->xss_clean($this->input->post('tipo')), $this->security->xss_clean($this->input->post('pagina')), $this->security->xss_clean($this->input->post('icono')), $this->security->xss_clean($this->input->post('ubicacion')), null, $this->session->userdata('usuario'));
                // RETORNO MENSAJE
                $mensaje = "configUpdate";
            }
            if ($idEnc != '') {
                // Elimino relaciones definidas con anticipación
                $this->SystemModel->deletePermissionsFunction($idEnc);
                // Actualizo los permisos
                $perfiles = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PERFIL", 'ASC', ACTIVO_ESTADO);
                
                foreach ($perfiles->result() as $valuePerfil) {
                    $tempo = 'perfil' . $valuePerfil->ID;
                    if ($this->security->xss_clean($this->input->post($tempo)) == CTE_VALOR_SI) {
                        // Obtengo el rol perfil
                        $rolPerfil = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_ROLPERFIL", "ID", "ID_PERFIL", $valuePerfil->ID, "ID_ROL", 1);
                        
                        // Inserto el registro hijo
                        $this->SystemModel->insertDetFunction($idEnc, $rolPerfil, $this->session->userdata('usuario'));
                    }
                }
            }
            // Pinto mensaje para retornar a la aplicación
            $this->session->set_userdata('id', $nombre);
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
        $mainPage = "SystemFunctionsDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
            $mainPage = "SystemFunctionsDefine/board";
            
            // Cargo información de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("ADM_MODFUNCIONES", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("ADM_MODFUNCIONES", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneral';
                $this->FunctionsGeneral->updateByID("ADM_MODFUNCIONES", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
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