<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador en el cual esta definida la tarifa asociada a una empresa
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
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
         * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "StokePriceConfigurationRatesForCompany/board";
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
            $data['listaLista'] = $this->StokePriceModel->selectListDefineRelationCompanyRates();
            
            // Pinto plantilla principal
            // Pinto la lista genérica de parametros que se debe tener en cuenta dentro del sistema de parámetros
            $this->load->view('stokePrice/configuration/boardCompanyRates', $data);
            
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
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la página principal
            $mainPage = "StokePriceConfigurationRatesForCompany/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
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
            // Cargo validación de formulario
            $this->load->view('validation/stokePrice/configuration/stokePriceConfigurationRatesForCompanyValidation');
            
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
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID", $this->encryption->decrypt($id));
            
            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $data = null;
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Información relacionada con la plantilla principal Pinto la pantalla *
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
                // Cargo validación de formulario
                $this->load->view('validation/stokePrice/configuration/stokePriceConfigurationRatesForCompanyValidation');
                
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
                redirect(base_url() . "StokePriceConfigurationRatesForCompany/board");
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }
    
    public function loadInformation()
    {
        /**
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la página principal
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Cargo vista
            $this->load->view('stokePrice/configuration/formLoadInformationRatesForCompany', $data);
            // Cargo validación de formulario
            $this->load->view('validation/stokePrice/configuration/stokePriceLoadInformationValidation');
            
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
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
            $mainPage = "StokePriceConfigurationRatesForCompany/board";
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                $empresa = $this->security->xss_clean($this->input->post('empresa'));
                $nombre = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresa);
                
                $tarifa = $this->security->xss_clean($this->input->post('tarifa'));
                
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa) == 0) {
                    // Creo el registro general
                    $this->StokePriceModel->insertRateForCompany($empresa, $tarifa, $this->session->userdata('usuario'));
                    
                    // Creo los valores asociados a la relación
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $nombre);
                    $this->session->set_userdata('auxiliar', 'relationCompanyRate');
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
                $tarifa = $this->security->xss_clean($this->input->post('tarifa'));
                $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
                $this->FunctionsGeneral->updateByID("COT_TARIFAEMPRESA", "ID_TARIFA", $tarifa, $id, $this->session->userdata('usuario'));
                
                // Pinto mensaje para retornar a la aplicación
                $this->session->set_userdata('id', $nombre);
                $this->session->set_userdata('auxiliar', 'relationCompanyRate');
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function saveLoad()
    {
        /**
         * Guardo la información del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
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
                //Redirecciono la página
                redirect(base_url().$mainPage);
            }else{
                $data['uploadSuccess'] = $this->upload->data();
                //Realizo el cargue del archivo a la ruta respectiva.
                $lineas = file($config['upload_path'].$config['file_name'].".csv");
                //inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
                $i=0;
                //Recorremos el bucle para leer línea por línea
                
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
                        //Como no se generó errores ahora valido si inserto o actualizo datos
                        
                        //Inserto o actualizo información
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
                //Pinto información
                $this->session->set_userdata('auxiliar', $message);
                
                // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
                $mainPage = "StokePriceConfigurationRatesForCompany/board";
                $data = null;
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage,  'myTable', null);
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
                $data['listaCodigos'] =$codigos;
                $data['listaErrores'] =$errores;
                // Pinto plantilla principal
                // Pinto la lista genérica de parametros que se debe tener en cuenta dentro del sistema de parámetros
                $this->load->view('stokePrice/configuration/boardDetailsLoad', $data);
                
                /**
                 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                 */
                
                // Pinto el final de la página (páginas internas)
                showCommonEnds($this, null, null);
                
            }
            
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
        $mainPage = "StokePriceConfigurationRatesForCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar
             
            // Cargo información de la lista teniendo en cuenta el id dado
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