<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador en el cual esta definida la tarifa asociada a una empresa
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class StokePriceConfigurationRatesForCompany extends CI_Controller
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
         * Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "StokePriceConfigurationRatesForCompany/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);
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
            $data['listaLista'] = $this->StokePriceModel->selectListDefineRelationCompanyRates();
            
            // Pinto plantilla principal
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('stokePrice/configuration/boardCompanyRates', $data);
            
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
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la p�gina principal
            $mainPage = "StokePriceConfigurationRatesForCompany/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['id'] = null;
            $data['disabled'] = null;
            $data['mainPage'] = $mainPage;
            
            // Lista de aplica
            $data['valorSINO'] = null;
            
            // Listado de tarias
            $data['listaTarifa'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_TARIFA", 'DESC');
            $data['tarifa'] = null;
            // Listado de empresas
            $data['listaGrupos'] = $this->EsaludModel->getCompaniesInformation();
            $data['empresa'] = null;
            // Cargo vista
            $this->load->view('stokePrice/configuration/formCompanyRates.php', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/stokePrice/configuration/stokePriceConfigurationRatesForCompanyValidation');
            
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
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID", $this->encryption->decrypt($id));
            
            if ($id != '') {
                // Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['id'] = $this->encryption->encrypt($id);
                ;
                $data['disabled'] = "disabled='disabled'";
                $data['mainPage'] = $mainPage;
                // Listado de tarias
                $data['listaTarifa'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_TARIFA", 'DESC');
                $data['tarifa'] = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_TARIFA", $id);
                
                // Listado de empresas
                $data['listaGrupos'] = $this->EsaludModel->getCompaniesInformation();
                $data['empresa'] = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $id);
                
                // Cargo vista
                $this->load->view('stokePrice/configuration/formCompanyRates.php', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/stokePrice/configuration/stokePriceConfigurationRatesForCompanyValidation');
                
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
                redirect(base_url() . "StokePriceConfigurationRatesForCompany/board");
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }
    
    public function loadInformation()
    {
        /**
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la p�gina principal
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Cargo vista
            $this->load->view('stokePrice/configuration/formLoadInformationRatesForCompany', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/stokePrice/configuration/stokePriceLoadInformationValidation');
            
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
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "StokePriceConfigurationRatesForCompany/board";
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                $empresa = $this->security->xss_clean($this->input->post('empresa'));
                $nombre = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresa);
                
                $tarifa = $this->security->xss_clean($this->input->post('tarifa'));
                
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa) == 0) {
                    // Creo el registro general
                    $this->StokePriceModel->insertRateForCompany($empresa, $tarifa, $this->session->userdata('usuario'));
                    
                    // Creo los valores asociados a la relaci�n
                    // Pinto mensaje para retornar a la aplicaci�n
                    $this->session->set_userdata('id', $nombre);
                    $this->session->set_userdata('auxiliar', 'relationCompanyRate');
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
                $tarifa = $this->security->xss_clean($this->input->post('tarifa'));
                $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
                $this->FunctionsGeneral->updateByID("COT_TARIFAEMPRESA", "ID_TARIFA", $tarifa, $id, $this->session->userdata('usuario'));
                
                // Pinto mensaje para retornar a la aplicaci�n
                $this->session->set_userdata('id', $nombre);
                $this->session->set_userdata('auxiliar', 'relationCompanyRate');
                // Redirecciono la p�gina
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function saveLoad()
    {
        /**
         * Guardo la informaci�n del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
         */
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            
            $mi_archivo = 'adjunto';
            $config['upload_path'] = STOKEPRICE_FOLDER;
            $config['file_name'] = "relEmpMar".$this->session->userdata('usuario').date('ymdHis');
            $config['allowed_types'] = "csv";
            $config['max_size'] = "50000";
            $config['max_width'] = "2000";
            $config['max_height'] = "2000";
            //Cargo el archivo
            $this->load->library('upload', $config);
            //Valido si es el correcto
            if (!$this->upload->do_upload($mi_archivo)) {
                //*** ocurrio un error
                //Retorno
                $message='ErrorFile';
                $this->session->set_userdata('auxiliar', $message);
                //Redirecciono la p�gina
                redirect(base_url().$mainPage);
            }else{
                $data['uploadSuccess'] = $this->upload->data();
                //Realizo el cargue del archivo a la ruta respectiva.
                $lineas = file($config['upload_path'].$config['file_name'].".csv");
                //inicializamos variable a 0, esto nos ayudar� a indicarle que no lea la primera l�nea
                $i=0;
                //Recorremos el bucle para leer l�nea por l�nea
                
                foreach ($lineas as $linea_num => $linea){
                    
                    list($empresa,$tarifa) = explode(";",$linea);
                    $empresa=trim($empresa);
                    $tarifa=trim($tarifa);
                    $error='';
                    $tarifa = $this->FunctionsGeneral->getFieldFromTableNotId("COT_TARIFA","ID","ID",$tarifa);
                    if($tarifa==''){
                        $error .='Tarifa no existe<br>';
                    }
                    if (!is_numeric($tarifa)){
                        $error .='El valor para la tarifa es incorrecto es incorrecto <br>';
                    }
                    
                    $tempo=$empresa;
                    $empresa = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB","ID_APB","ID_APB",$empresa);
                    
                    if($empresa==''){
                        $error .='Empresa no existe<br>';
                    }
                    if (!is_numeric($empresa)){
                        $error .='El valor para la empresa es incorrecto es incorrecto <br>';
                    }
                    
                    
                    if ($error==''){
                        //Como no se gener� errores ahora valido si inserto o actualizo datos
                        
                        //Inserto o actualizo informaci�n
                        if ($this->FunctionsGeneral->getQuantityFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa) == 0) {
                            // Creo el registro general
                            $this->StokePriceModel->insertRateForCompany($empresa, $tarifa, $this->session->userdata('usuario'));
                            
                        } else {
                            
                            $this->FunctionsGeneral->updateByField("COT_TARIFAEMPRESA", "ID_TARIFA", $tarifa,"ID_EMPRESA", $empresa, $this->session->userdata('usuario'));
                        }
                        $codigos[$i]=$empresa;
                        $errores[$i]="Ingresado correctamente";
                        // echo $id." ".$codigo," ",$tipo," ",$proveedor," ",$descripcion," ",$materiales," ",$mano," ",$adicionales," ",$entrega," ",$garantia," ",$origen."<br>";
                    }else{
                        //Identifico que hay un error
                        $codigos[$i]=$tempo;
                        $errores[$i]=$error;
                        
                        //echo $id." ".$codigo," ",$error."";
                    }
                    $i++;
                    
                }
                
                //var_dump($codigos);
                
                //var_dump($errores);
                
                //Retorno
                $message='FileOk';
                $page="StokePriceConfigurationRatesForCompany/paintLoad";
                //Pinto informaci�n
                $this->session->set_userdata('auxiliar', $message);
                
                // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
                $mainPage = "StokePriceConfigurationRatesForCompany/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage,  'myTable', null);
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
                $data['listaCodigos'] =$codigos;
                $data['listaErrores'] =$errores;
                // Pinto plantilla principal
                // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
                $this->load->view('stokePrice/configuration/boardDetailsLoad', $data);
                
                /**
                 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
                 */
                
                // Pinto el final de la p�gina (p�ginas internas)
                showCommonEnds($this, null, null);
                
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
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
             
            // Cargo informaci�n de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneral';
                $this->FunctionsGeneral->updateByID("COT_TARIFAEMPRESA", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
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