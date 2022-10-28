<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para definir los elementos aplicables a empresas especiales
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class StokePriceConfigurationListCompanyElements extends CI_Controller
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
    public function board($id=null)
    {
        /**
         * Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationListCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            //$mainPage = "StokePriceConfigurationListCompanyElements/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);
            // Pinto la informaci�n de los parametros de la aplicaci�n
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $id=$this->encryption->decrypt($id);
            $empresa= $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_EMPRESA", $id);
            $data['codigoEmpresa']= $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_CODIGO", $id);
            $data['cerrada']= $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_CERRADA", $id);

            $data['empresa'] =$this->EsaludModel->getFieldFromTableNotId("T_APB","NOM_APB","ID_APB",$empresa);
            //Envio datos
            $data['id'] = $id;
            $data['mainPage'] = $mainPage;
            

            // Pinto los permisos del tablero de control
            $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
            $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'boardElements', $idModule, VIEW_LIST_PERMISSION);
            $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'boardElements', $idModule, VIEW_BUTTON_PERMISSION);
            
            // Lista de listas
          
           
            $data['listaLista'] = $this->StokePriceModel->selectListDefineRelationListElements($id);
            
            // Pinto plantilla principal
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('stokePrice/configuration/boardCompanyListElements', $data);
            
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

    public function newRegister($empresa=null)
    {
        /**
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationListCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {

            // Cargo la p�gina principal
            $data = null;
            
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            //Envio variable de la empresa
            $data['idEmpresa'] = $empresa;
            
            //Descifro informaci�n para obtener datos pertinentes
            $empresa=$this->encryption->decrypt($empresa);

            $data['valida']=$this->encryption->encrypt('newRegister');

            $data['codigoEmpresa']= $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_CODIGO", $empresa);
            $data['cerrada']= $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_CERRADA", $empresa);

            $data['listaCodigos'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_CODIGONEPS", 'DESC');
            
            
            $empresa= $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_EMPRESA", $empresa);
            $data['empresa'] =$this->EsaludModel->getFieldFromTableNotId("T_APB","NOM_APB","ID_APB",$empresa);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Lista de aplica
            $data['readOnly'] = null;
            $data['mainPage'] = $mainPage;
            $data['codigo'] = null;
            $data['auxiliar'] =null;
            $data['nombre'] = null;
            $data['tipoOrden'] = null;
            $data['disabled'] = null;
            $data['display'] = null;
            $data['precio'] = null;
            $data['tipo'] = null;
            $data['id'] = null;
            
            
            // Cargo vista
            $this->load->view('stokePrice/configuration/formNewRegisterElementsList', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/stokePrice/configuration/stokePriceConfigurationCompanyElementListValidation');
            
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
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationListCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la p�gina principal
            $data = null;

            //Valido dato
            $id = $this->encryption->decrypt($id);

            if ($id != '') {
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['mainPage'] = $mainPage;
                $data['valida'] = $this->encryption->encrypt('edit');

                $data['id'] = $this->encryption->encrypt($id);
                $empresa=$this->FunctionsGeneral->getFieldFromTable("COT_LISTAELEMENTOS", "ID_EMPRESA", $id);
                $data['idEmpresa'] =$this->encryption->encrypt($empresa);

                //Datos de la empresa
                $data['codigoEmpresa']= $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_CODIGO", $empresa);
                $data['cerrada']= $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_CERRADA", $empresa);
                
                //echo $empresa." ".$data['codigoEmpresa']." ".$data['cerrada'];  
                
                $data['listaCodigos'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_CODIGONEPS", 'DESC');

                $empresa= $this->FunctionsGeneral->getFieldFromTable("COT_EMPRESALISTA", "ID_EMPRESA", $empresa);
                $data['empresa'] =$this->EsaludModel->getFieldFromTableNotId("T_APB","NOM_APB","ID_APB",$empresa);


                //Datos del codigo ingresado 
                $idCodigo=$this->FunctionsGeneral->getFieldFromTable("COT_LISTAELEMENTOS", "ID_CODIGO", $id);
				echo "<script>console.log('idCodigo: " . $idCodigo . "' );</script>";
                $auxiliar=$this->FunctionsGeneral->getFieldFromTable("COT_LISTAELEMENTOS", "AUXILIAR", $id);
                $precio=$this->FunctionsGeneral->getFieldFromTable("COT_LISTAELEMENTOS", "PRECIO", $id);
                ;
                $codigo = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "CODIGO", "ID",$idCodigo);

                

                
                $tipo = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "ID_TIPO", "ID", $idCodigo);
                
                if ($tipo != '39') {
                    // Esta en el arbol, busco si es producto o interconsulta
                    $codigo = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "CODIGO", "ID", $codigo);
                    $nombre = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "NOMBRE", "CODIGO", $codigo);
                    $idTipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID_TIPOORDEN", "CODIGO", $codigo);
                    $tipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "TIPOORDEN", "CODIGO", $codigo);
                   // $data['valida'] = 1;
                } else {
                    // Valido si es elemento
                    $codigo = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "CODIGO", "ID", $codigo);
                    // Esta en el arbol, busco si es producto o interconsulta
                    $nombre = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "NOMBRE", "CODIGO", $codigo);
                    $idTipoOrden = '0';
                    $tipoOrden = 'Elementos';
                    //$data['valida']=0;
                }
                

                
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Lista de aplica
                $data['readOnly'] = "readOnly";
                $data['mainPage'] = $mainPage;


                $data['codigo'] = $codigo;
                $data['nombre'] = $nombre;
                $data['tipoOrden'] = $tipoOrden;
                $data['tipo'] = $idTipoOrden;
                $data['id'] = $this->encryption->encrypt($id);
                
                //Valores propios de la lista
                $data['auxiliar'] =$auxiliar;
                $data['precio'] = $precio;
                
            
                // Cargo vista
                $this->load->view('stokePrice/configuration/formNewRegisterElementsList', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/stokePrice/configuration/stokePriceConfigurationCompanyElementListValidation');

                // Pinto el final de la p�gina (p�ginas internas)
                showCommonEnds($this, null, null);
                

            }else{
                // Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la p�gina
                redirect(base_url() . "StokePriceConfigurationListCompanyElements/board");

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
        $mainPage = "StokePriceConfigurationListCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "StokePriceConfigurationListCompanyElements/board";

            $idEmpresa = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idEmpresa')));
            $codigo = $this->security->xss_clean($this->input->post('id'));
            $codigo =$this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "ID","CODIGO", $codigo);
            //Valido informaci�n del c�digo auxiliar
            $auxiliar = $this->security->xss_clean($this->input->post('auxiliar'));
            if ($auxiliar==''){
                $auxiliar=null;
            }
            //Valido informaci�n del precio de lista cerrada
            $precio = $this->security->xss_clean($this->input->post('precio'));
            if ($precio==''){
                $precio=null;
            }
            
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("COT_LISTAELEMENTOS", "ID_EMPRESA", $idEmpresa,"ID_CODIGO",$codigo) == 0) {
                    // Creo el registro general
                    $this->StokePriceModel->insertListForCompanyElements($idEmpresa,$codigo,$auxiliar,$precio, $this->session->userdata('usuario'));
                    
                    // Pinto mensaje para retornar a la aplicaci�n
                    $mensaje = "relationCompanyListElem";
                } else {
                    // Creo mensaje de creaci�n de usuario
                    $mensaje = "ConfigExist";
                }
            }else{
                //Actualizo valores
               $this->FunctionsGeneral->updateByID("COT_LISTAELEMENTOS", "AUXILIAR", $auxiliar,  $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $this->session->userdata('usuario'));

                $this->FunctionsGeneral->updateByID("COT_LISTAELEMENTOS", "PRECIO", $precio,  $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $this->session->userdata('usuario'));// Pinto mensaje para retornar a la aplicaci�n
                
                $mensaje = "relationCompanyListElem";
            }
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', null);
            $this->session->set_userdata('auxiliar', $mensaje);
            // Redirecciono la p�gina
            $pagina="StokePriceConfigurationListCompanyElements/board/".$this->encryption->encrypt($idEmpresa);
            redirect(base_url() . $pagina);
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
        $mainPage = "StokePriceConfigurationListCompany/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
             
            // Cargo informaci�n de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_LISTAELEMENTOS", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("COT_LISTAELEMENTOS", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneral';
                $this->FunctionsGeneral->updateByID("COT_LISTAELEMENTOS", "ESTADO", $estado, $id, $this->session->userdata('usuario'));

                //Obtengo ID de la empresa
                $idEmpresa= $this->FunctionsGeneral->getFieldFromTable("COT_LISTAELEMENTOS", "ID_EMPRESA",$id);
                // Pinto mensaje para retornar a la aplicaci�n
                $this->session->set_userdata('id', $idEmpresa);
                $this->session->set_userdata('auxiliar', $message);
                // Redirecciono la p�gina
                $pagina="StokePriceConfigurationListCompanyElements/board/".$this->encryption->encrypt($idEmpresa);
                redirect(base_url() .$pagina);
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
