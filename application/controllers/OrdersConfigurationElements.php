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

class OrdersConfigurationElements extends CI_Controller
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
        $mainPage = "OrdersConfigurationElements/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "OrdersConfigurationElements/board";
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
            $data['listaLista'] = $this->OrdersModel->selectElements();
            
            // Pinto plantilla principal
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('orders/configuration/boardElements', $data);
            
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
        $mainPage = "OrdersConfigurationElements/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la p�gina principal
            $mainPage = "OrdersConfigurationElements/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['validador'] = 'newRegister';
            $data['mainPage'] = $mainPage;
            $data['id'] = null;
            $data['nombre'] = null;
            // Lista de aplica
            $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
            
            // Listado de proveedores
            $data['listaProveedores'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_PROVEEDOR", 'ASC');
            $data['providers'] = null;
            // Lista de grupos
            $data['listaGrupo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_GRUELEM", 'ASC');
            $data['grupo'] = null;
            
            // Comodin
            $data['valorSINO'] = null;
            $data['comodinValidation'] = null;
            $data['comodinValidationSi'] = null;
            $data['comodinValidationDisplaySi'] = null;
            $data['codigoValidation'] = null;
            $data['codigo'] = null;
            
            //Costo
            $data['valorDolares'] = null;
            $data['costoDolares'] = null;
            // Caracteristicas
            $data['caractValidationSi'] = 'disabled="disabled"';
            $data['caractValidationDisplaySi'] = 'style= "display:none"';
            // Listo las caracteristicas de los elemtnos seg�n el grupo
            // Cuento la cantidad de caracteristica que mas se tienen para los egrupos de elementos
            $data['maxCaracteristicas'] = $this->FunctionsGeneral->countMax("VIEW_ORD_CANTCARGRUPO", "CANTIDAD", 0);
            
            // Cargo vista
            $this->load->view('orders/configuration/formElements', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/orders/configuration/ordersConfigurationElementsValidation', $data);
            
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
        $mainPage = "OrdersConfigurationElements/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
                $mainPage = "OrdersConfigurationElements/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['validador'] = 'edit';
                $data['id'] = $id;
                
                // Inicializo variables de los campos del formulario
                $data['title'] = "Modificar clasificaci&oacute;n de elementos previamente creada";
                $data['mainField'] = "Clasificaci&oacute;n";
                $data['placeHolder'] = "Ej. Elementos especiales ";
                $data['pagina'] = "OrdersConfigurationElements/saveRegister";
                $data['mainPage'] = $mainPage;
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['mainPage'] = $mainPage;
                $data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "CODIGO", $id);
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "NOMBRE", $id);
                // Lista de aplica
                $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
                // Listado de proveedores
                $data['listaProveedores'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_PROVEEDOR", 'DESC');
                $data['providers'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "ID_PROVEEDOR", $id);
				//echo "<script>console.log('ConsoleO: " .$data['providers'] . "' );</script>";
                // Lista de grupos
                $data['listaGrupo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_GRUELEM", 'DESC');
                $data['grupo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "ID_GRUELEM", $id);
                
                // Comodin
                $data['valorSINO'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "COMODIN", $id);
                $data['comodinValidation'] = 'disabled="disabled"';
                $data['codigoValidation'] = 'readOnly="readOnly"';
                if ($this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "COMODIN", $id) == CTE_VALOR_SI) {
                    $data['comodinValidationSi'] = 'disabled="disabled"';
                    $data['comodinValidationDisplaySi'] = 'style= "display:none"';
                } else {
                    $data['comodinValidationSi'] = null;
                    $data['comodinValidationDisplaySi'] = null;
                }
                
                
                //Costo
                $data['valorDolares'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMCOSTO", "ID_VALIDA","ID_ELEMENTO", $id);
                $data['costoDolares'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMCOSTO",  "VALOR",    "ID_ELEMENTO", $id);
                
                
                // Pinto informaci�n de las caracteristicas
                $data['caracteristicas'] = $this->OrdersModel->selectListCharacteristicsElementGroup($this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "ID_GRUELEM", $id));
                
                // Cuento la cantidad de caracteristica que mas se tienen para los egrupos de elementos
                $data['maxCaracteristicas'] = $this->FunctionsGeneral->countMax("VIEW_ORD_CANTCARGRUPO", "CANTIDAD", 0);
                
                // Cargo vista
                $this->load->view('orders/configuration/formElements', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/orders/configuration/ordersConfigurationElementsValidation', $data);
                
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
                redirect(base_url() . "OrdersConfigurationElements/board");
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
        $mainPage = "OrdersConfigurationElements/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "OrdersConfigurationElements/board";
            $nombre = $this->security->xss_clean($this->input->post('nombre'));
            
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                // Defino rutinas teniendo en cuenta si es o no comodin
                if ($this->security->xss_clean($this->input->post('comodin')) == CTE_VALOR_SI) {
                    // El valor es un comodin
                    // Valido que no existan m�s comodines para el grupo
                    
                    // Genero el c�digo y nombre del comodin
                    
                    $grupo = $this->security->xss_clean($this->input->post('grupo'));
                    $numberRowsComodines = $this->FunctionsGeneral->numRowsAll('ORD_ELEMENTO', 1,'ID_GRUELEM', $grupo);
                    $codigo = "C-" . $this->security->xss_clean($this->input->post('grupo'))."-".$numberRowsComodines;
                    
                    /*$nombre = "Elemento - grupo " . $this->FunctionsGeneral->getFieldFromTable("ORD_GRUELEM", "NOMBRE", $this->security->xss_clean($this->input->post('grupo')));*/
                    // No hay comodines para el grupo, realizo el insert del elemento
                    $idElemento = $this->OrdersModel->insertElements(
                        $codigo, 
                        $this->security->xss_clean($this->input->post('grupo')), 
                        $this->security->xss_clean($this->input->post('proveedor')), 
                        $nombre, 
                        $this->security->xss_clean($this->input->post('comodin')), 
                        $this->session->userdata('usuario'));
                    //Inserto el costo del comodin
                    $this->OrdersModel->insertElementCost($idElemento, 
                        $this->security->xss_clean($this->input->post('aplica')), 
                        $this->security->xss_clean($this->input->post('costo')), 
                        $this->session->userdata('usuario'));

                    $caracteristicas = $this->OrdersModel->selectListCharacteristicsElementGroup($this->security->xss_clean($this->input->post('grupo')));
                        if ($caracteristicas!=null) {
                            for ($i = 1; $i <= count($caracteristicas); $i ++) {
                                $tempo = "caracteristica" . $i;
                                $valor = $this->security->xss_clean($this->input->post($tempo));
                                $this->OrdersModel->insertElementInformation($idElemento, $valor, $this->session->userdata('usuario'));
                            }
                        }
                    
                    // Mensaje con el cual se retornar� a la aplicaci�n
                    $message = 'configUpdate';
                    
                } else {
                    // Es un elemento normal, valido que no exista dentro de los registros de la base de datos
                    if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ELEMENTO", "CODIGO", $this->security->xss_clean($this->input->post('id'))) == 0) {
                        // Realizo el insert
                        $idElemento = $this->OrdersModel->insertElements(
                            $this->security->xss_clean($this->input->post('id')), 
                            $this->security->xss_clean($this->input->post('grupo')), 
                            $this->security->xss_clean($this->input->post('proveedor')), 
                            $nombre, 
                            $this->security->xss_clean($this->input->post('comodin')), 
                            $this->session->userdata('usuario'));
                        //Inserto el costo del elemento
                        $this->OrdersModel->insertElementCost($idElemento, 
                            $this->security->xss_clean($this->input->post('aplica')), 
                            $this->security->xss_clean($this->input->post('costo')), 
                            $this->session->userdata('usuario'));
                        
                        // Verifico si el elemento tiene caracteristicas propias
                        $caracteristicas = $this->OrdersModel->selectListCharacteristicsElementGroup($this->security->xss_clean($this->input->post('grupo')));
                        /*if ($caracteristicas!=null) {
                            for ($i = 1; $i <= count($caracteristicas); $i ++) {
                                $tempo = "caracteristica" . $i;
                                $valor = $this->security->xss_clean($this->input->post($tempo));
                                $this->OrdersModel->insertElementInformation($idElemento, $valor, $this->session->userdata('usuario'));
                            }
                        }*/
                        $message = 'configUpdate';
                    } else {
                        // El elemento ya existe
                        //$message = 'elementCodeExists';
                        //$nombre = $this->security->xss_clean($this->input->post('id'));
                    }
                }
            } else {
                // Modificaci�n del elemento creado
                // Defino rutinas teniendo en cuenta si es o no comodin
                if ($this->security->xss_clean($this->input->post('comodin')) == CTE_VALOR_SI) {
                    
                    // El valor es un comodin
                    // Identifico el ID
                    $id = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "ID", "CODIGO", $this->security->xss_clean($this->input->post('codigo')));
                    $idElemcosto = $this->FunctionsGeneral->getFieldFromTableNotId('ORD_ELEMCOSTO', "ID", "ID_ELEMENTO", $id);
                    // Se puede hacer la actualizaci�n
                    $this->OrdersModel->updateElements($id, 
                        $this->security->xss_clean($this->input->post('grupo')), 
                        $this->security->xss_clean($this->input->post('proveedor')),
                        $this->security->xss_clean($this->input->post('nombre')),
                        $this->session->userdata('usuario'));
                    
                    //validamos si existe o no el costo para el comodin
                    if($idElemcosto == '' || $idElemcosto == null) {
                        $this->OrdersModel->insertElementCost($id, 
                        $this->security->xss_clean($this->input->post('aplica')), 
                        $this->security->xss_clean($this->input->post('costo')), 
                        $this->session->userdata('usuario'));
                    } else {
                        $this->OrdersModel->updateElemCosto($id,
                        $this->security->xss_clean($this->input->post('aplica')), 
                        $this->security->xss_clean($this->input->post('costo')), 
                        $this->session->userdata('usuario'));
                    }
                    $message = 'configUpdate';
                    
                } else {
                    // El elemento no es comodin
                    // Identifico el ID
                    $id = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "ID", "CODIGO", $this->security->xss_clean($this->input->post('id')));
                    // Actualizo los valores respectivos
                    $this->OrdersModel->updateElements($id, 
                        $this->security->xss_clean($this->input->post('grupo')), 
                        $this->security->xss_clean($this->input->post('proveedor')),
                        $this->security->xss_clean($this->input->post('nombre')),
                        $this->session->userdata('usuario'));

                    $this->OrdersModel->updateElemCosto($id,
                        $this->security->xss_clean($this->input->post('aplica')), 
                        $this->security->xss_clean($this->input->post('costo')), 
                        $this->session->userdata('usuario'));

                    $message = 'configUpdate';

                    // Inactivo caracteristicas definidas para el elemento
                    $this->FunctionsGeneral->updateByField("ORD_ELEPARELEM", "ESTADO", INACTIVO_ESTADO, "ID_ELEMENTO", $id, $this->session->userdata('usuario'));
                    
                    // Verifico si el elemento tiene caracteristicas propias
                    $caracteristicas = $this->OrdersModel->selectListCharacteristicsElementGroup($this->security->xss_clean($this->input->post('grupo')));
                    if (count($caracteristicas) > 0) {
                        for ($i = 1; $i <= count($caracteristicas); $i ++) {
                            $tempo = "caracteristica" . $i;
                            $valor = $this->security->xss_clean($this->input->post($tempo));
                            // Verifico si el elemento existe con dicha caracteristica
                            $tempoId = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ELEPARELEM", "ID", "ID_ELEMENTO", $id, "ID_VALPARGRUELEM", $valor);
                            if ($tempoId == '') {
                                // Creo registro
                                $this->OrdersModel->insertElementInformation($id, $valor, $this->session->userdata('usuario'));
                            } else {
                                // Actualizo estado
                                $this->FunctionsGeneral->updateByID("ORD_ELEPARELEM", "ESTADO", ACTIVO_ESTADO, $tempoId, $this->session->userdata('usuario'));
                            }
                        }
                    }
                }
            }
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', $message);
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
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
        $mainPage = "OrdersConfigurationElements/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "OrdersConfigurationElements/board";
            
            // Cargo informaci�n de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneral';
                $this->FunctionsGeneral->updateByID("ORD_ELEMENTO", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
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
