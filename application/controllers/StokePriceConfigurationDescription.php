<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para definir la descripci�n de productos, servicios y elementos que van a ser cotizados dentro de la aplicaci�n.
 
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class StokePriceConfigurationDescription extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // Cargo modelos, librerias y helpers
        $this->load->model('StokePriceModel');
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
        $mainPage = "StokePriceConfigurationDescription/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "StokePriceConfigurationDescription/board";
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
            $data['listaLista'] = $this->StokePriceModel->selectListDefineRelation();
            // Pinto plantilla principal
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('stokePrice/configuration/boardDetails', $data);
            
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
        $mainPage = "StokePriceConfigurationDescription/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la p�gina principal
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Lista de aplica
            $data['listaProveedores'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_PROVEEDOR", 'DESC');
            $data['readOnly'] = null;
            
            $data['mainPage'] = $mainPage;
            $data['codigo'] = null;
            $data['auxiliar'] =null;
            $data['nombre'] = null;
            $data['tipoOrden'] = null;
            $data['disabled'] = null;
            $data['display'] = null;
            $data['tipo'] = null;
            $data['id'] = null;
            $data['descripcion'] = null;
            
            $data['materiales'] = null;
            $data['mano'] = null;
            $data['adicionales'] = null;
            $data['valida']=0;
            
            $data['tentrega'] = null;
            $data['garantia'] = null;
            $data['proveedor'] =null;
            $data['leyenda'] ="Costos de materiales Dado en pesos (COP) *";
           
            //Lista del pais
            $data['listaPais'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PAIS");
            $data['pais'] =CTE_PAIS_DEFECTO;
            // Cargo vista
            $this->load->view('stokePrice/configuration/formDescriptionnewRegister', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/stokePrice/configuration/stokePriceConfigurationDescriptionValidation');
            
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
    
    
    public function loadInformation()
    {
        /**
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationDescription/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo la p�gina principal
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Lista de aplica
            $data['listaProveedores'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_PROVEEDOR", 'DESC');
            $data['readOnly'] = null;
            
            $data['mainPage'] = $mainPage;
            $data['codigo'] = null;
            $data['auxiliar'] =null;
            $data['nombre'] = null;
            $data['tipoOrden'] = null;
            $data['disabled'] = null;
            $data['display'] = null;
            $data['tipo'] = null;
            $data['id'] = null;
            $data['descripcion'] = null;
            
            $data['materiales'] = null;
            $data['mano'] = null;
            $data['adicionales'] = null;
            
            $data['valida']=0;

            $data['tentrega'] = null;
            $data['garantia'] = null;
            $data['proveedor'] =null;
            
            //Lista del pais
            $data['listaPais'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PAIS");
            $data['pais'] =CTE_PAIS_DEFECTO;
            // Cargo vista
            $this->load->view('stokePrice/configuration/formLoadInformation', $data);
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

    public function edit($id)
    {
        /**
         * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
         */
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "StokePriceConfigurationDescription/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_DESCRIPCION", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
                $mainPage = "StokePriceConfigurationDescription/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Lista de aplica
                $data['readOnly'] = "readonly='readonly'";
                echo "<script>console.log('Id: " . $id . "' );</script>";
                $codigo = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "CODIGO", "ID", $id);
                echo "<script>console.log('codigo: " . $codigo . "' );</script>";
                $tipo = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "ID_TIPO", "ID", $id);
                echo "<script>console.log('tipo: " . $tipo . "' );</script>";
                if ($tipo != '39') {
                    // Esta en el arbol, busco si es producto o interconsulta
                    $codigo = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "CODIGO", "ID", $codigo);
                    echo "<script>console.log('codigo*: " . $codigo . "' );</script>";
                    $nombre = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "NOMBRE", "CODIGO", $codigo);
                    echo "<script>console.log('nombre*: " . $nombre . "' );</script>";
                    $idTipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID_TIPOORDEN", "CODIGO", $codigo);
                    echo "<script>console.log('idTipoOrden: " . $idTipoOrden . "' );</script>";
                    $tipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "TIPOORDEN", "CODIGO", $codigo);
                    echo "<script>console.log('tipo*: " . $tipoOrden . "' );</script>";
                    $data['valida'] = 1;
                } else {
                    // Valido si es elemento
                    $codigo = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "CODIGO", "ID", $codigo);
                    // Esta en el arbol, busco si es producto o interconsulta
                    $nombre = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "NOMBRE", "CODIGO", $codigo);
                    $idTipoOrden = '0';
                    $tipoOrden = 'Elementos';
                    $data['valida']=0;
                }
                
                $data['mainPage'] = $mainPage;
                $data['codigo'] = $codigo;
                $data['auxiliar'] =$this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "AUXILIAR", "ID", $id);;
                $data['nombre'] = $nombre;
                $data['tipoOrden'] = $tipoOrden;
                $data['tipo'] = $idTipoOrden;
                $data['id'] = $this->encryption->encrypt($id);
                $data['descripcion'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "DESCRIPCION", "ID", $id);
                
                $data['materiales'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "MATERIALES", "ID", $id);
                $data['mano'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "MANOOBRA", "ID", $id);
                $data['adicionales'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "ASOCIADOS", "ID", $id);
                
                
                $data['tentrega'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "TENTREGA", "ID", $id);
                $data['garantia'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "GARANTIA", "ID", $id);
                $data['proveedor'] =$this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "ID_PROVEEDOR", "ID", $id);
                $data['listaProveedores'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_PROVEEDOR", 'DESC');
                if($idTipoOrden=='-1'){
                    $data['disabled'] = "disabled='disabled'";
                    $data['display'] = "style=\"display: none;\"";
                    
                }else{
                    $data['disabled'] = null;
                    $data['display'] = null;
                    
                }
                //Lista del pais
                $data['listaPais'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PAIS");
                $data['pais'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "ID_PAIS", "ID", $id);
                if ($data['pais'] ==CTE_PAIS_DEFECTO){
                    $data['leyenda'] ="Costos de materiales Dado en pesos (COP) *";
                }else{
                    $data['leyenda'] ="Costos de materiales Dado en d&oacute;lares (USD) *";
                }
                
                
                // Inicializo variables de la vista
                $data['id'] = $this->encryption->encrypt($id);
                
                // Cargo vista
                $this->load->view('stokePrice/configuration/formDescriptionnewRegister', $data);
                // Cargo validaci�n de formulario
                $this->load->view('validation/stokePrice/configuration/stokePriceConfigurationDescriptionValidation');
                
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
                redirect(base_url() . "StokePriceConfigurationDescription/board");
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
        $mainPage = "StokePriceConfigurationDescription/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "StokePriceConfigurationDescription/board";
            $codigo = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
            
            // Defino tipo
            $tipo = $this->security->xss_clean($this->input->post('tipo'));
            if ($tipo == - 1) {
                $tipo = 41;
            } else if ($tipo == 0) {
                $tipo = 39;
            } else {
                $tipo = 40;
            }
            
            //Guardo adjunto
            //TODO
            $mi_archivo = 'imagen';
            $config['upload_path'] = STOKEPRICE_FOLDER;
            if(!is_dir($config['upload_path'])){
                mkdir($config['upload_path'],777);
            }
            $config['file_name'] = $codigo;
            $config['allowed_types'] = "png";
            $config['max_size'] = "50000";
            $config['max_width'] = "2000";
            $config['max_height'] = "2000";
            $this->load->library('upload', $config);
            $tempo='';
            if (!$this->upload->do_upload($mi_archivo)) {
                //*** ocurrio un error
                $data['uploadError'] = $this->upload->display_errors();
                $tempo= $this->upload->display_errors();
                $band= false;
                
            }else{
                $band= true;
            }
            if(!$band){
                $imagen=null;
            }else{
                $imagen=$config['file_name'];
            }
            
            $data['uploadSuccess'] = $this->upload->data();
            
            //Identifico dato del proveedor
            if($this->security->xss_clean($this->input->post('proveedor'))==''){
                $proveedor=null;
            }else{
                $proveedor=$this->security->xss_clean($this->input->post('proveedor'));
            }
            
            
            //Inserto o actualizo informaci�n
            if ($this->FunctionsGeneral->getQuantityFieldFromTable("COT_DESCRIPCION", "ID", $codigo) == 0) {
                
                // Creo el registro
                $this->StokePriceModel->insertDetailsInformation(
                    $this->security->xss_clean($this->input->post('id')),
                    $this->security->xss_clean($this->input->post('auxiliar')),
                    $tipo, 
                    $proveedor, 
                    $this->security->xss_clean($this->input->post('descripcion')),
                    $this->security->xss_clean($this->input->post('materiales')),
                    $this->security->xss_clean($this->input->post('mano')),
                    $this->security->xss_clean($this->input->post('adicionales')),
                    $this->security->xss_clean($this->input->post('tiempo')), 
                    $this->security->xss_clean($this->input->post('garantia')), 
                    $this->security->xss_clean($this->input->post('origen')), 
                    $imagen,
                    $this->session->userdata('usuario'));
                
                // Pinto mensaje para retornar a la aplicaci�n
                $this->session->set_userdata('id', $nombre);
                $this->session->set_userdata('auxiliar', 'configUpdate');
                // Redirecciono la p�gina
                redirect(base_url() . $mainPage);
            } else {
                //Actualizo informaci�n
                $id = $codigo;
                $this->StokePriceModel->updateDetailsInformation(
                    $id,
                    $this->security->xss_clean($this->input->post('auxiliar')), 
                    $proveedor, 
                    $this->security->xss_clean($this->input->post('descripcion')), 
                    $this->security->xss_clean($this->input->post('materiales')),
                    $this->security->xss_clean($this->input->post('mano')),
                    $this->security->xss_clean($this->input->post('adicionales')),
                    $this->security->xss_clean($this->input->post('tiempo')),
                    $this->security->xss_clean($this->input->post('garantia')), 
                    $this->security->xss_clean($this->input->post('origen')), 
                    $imagen, 
                    $this->session->userdata('usuario'));
                
                
                $this->session->set_userdata('auxiliar', 'configUpdate');
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
        $mainPage = "StokePriceConfigurationDescription/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            
            $mi_archivo = 'adjunto';
            $config['upload_path'] = STOKEPRICE_FOLDER;
            $config['file_name'] = $this->session->userdata('usuario').date('ymdHis');
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
                    
                    list($codigo,$tipo,$proveedor,$descripcion,$materiales,$mano,$adicionales,$origen,$entrega,$garantia) = explode(";",$linea);
                    //Acondiciono valores
                    $descripcion=utf8_encode($descripcion);
                    $codigo=trim($codigo);
                    $tipo=trim($tipo);
                    $proveedor=trim($proveedor);
                    $materiales=trim($materiales);
                    $mano=trim($mano);
                    $adicionales=trim($adicionales);
                    $entrega=trim($entrega);
                    $garantia=trim($garantia);
                    $origen=trim($origen);
                    $error='';
                    if($tipo==41){
                        //Valido informaci�n para servicios
                        $id = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS","ID","CODIGO",$codigo);
                        if($id==''){
                            $error .='No se ha definido el c�digo como servicio <br>';
                        }
                        $proveedor=null;
                        $materiales=null;
                        if (!is_numeric($mano)){
                            $error .='El valor para costos de mano de obra es incorrecto <br>';
                        }
                        if (!is_numeric($adicionales)){
                            $error .='El valor para costos adicionales es incorrecto <br>';
                        }
                        $entrega=null;
                        $garantia=null;
                        $origen=null;
                        
                    }else if($tipo==39){
                        
                        $id = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO","ID","CODIGO",$codigo);
                        if($id==''){
                            $error .='No se ha definido el c�digo como elemento <br>';
                        }
                        if($this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROVEEDOR","ID","ID",$proveedor)==''){
                            $error .='El C&oacute;digo del proveedor no est&aacute; definido <br>';
                        }
                        if (!is_numeric($materiales)){
                            $error .='El valor para costos de materiales es incorrecto <br>';
                        }
                        if (!is_numeric($mano)){
                            $error .='El valor para costos de mano de obra es incorrecto <br>';
                        }
                        if (!is_numeric($adicionales)){
                            $error .='El valor para costos adicionales es incorrecto <br>';
                        }
                        if (!is_numeric($entrega)){
                            $error .='El valor para tiempo de entrega es incorrecto <br>';
                        }
                        if (!is_numeric($garantia)){
                            $error .='El valor para garantia es incorrecto <br>';
                        }
                        if($this->FunctionsGeneral->getFieldFromTableNotId("ADM_PAIS","ID","ID",$origen)==''){
                            $error .='El C&oacute;digo del Pa&iacute;s no est&aacute; definido <br>';
                        }
                    }else if($tipo==40){
                        
                        $id = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS","ID","CODIGO",$codigo);
                        if($id==''){
                            $error .='No se ha definido el c�digo como producto <br>';
                        }
                        $proveedor=null;
                         if (!is_numeric($materiales)){
                            $error .='El valor para costos de materiales es incorrecto <br>';
                        }
                        if (!is_numeric($mano)){
                            $error .='El valor para costos de mano de obra es incorrecto <br>';
                        }
                        if (!is_numeric($adicionales)){
                            $error .='El valor para costos adicionales es incorrecto <br>';
                        }
                        if (!is_numeric($entrega)){
                            $error .='El valor para tiempo de entrega es incorrecto <br>';
                        }
                        if (!is_numeric($garantia)){
                            $error .='El valor para garantia es incorrecto <br>';
                        }
                        $origen=CTE_PAIS_DEFECTO;
                    }
                    if ($error==''){
                        //Como no se gener� errores ahora valido si inserto o actualizo datos
                        
                        //Inserto o actualizo informaci�n
                        if ($this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION","ID","CODIGO",$id) == 0) {
                            // Creo el registro
                            $this->StokePriceModel->insertDetailsInformation(
                                $id,
                                $codigo,
                                $tipo,
                                $proveedor,
                                $descripcion,
                                $materiales,
                                $mano,
                                $adicionales,
                                $entrega,
                                $garantia,
                                $origen,
                                NULL,
                                $this->session->userdata('usuario'));
                        } else {
                            //Actualizo informaci�n
                           // $id = $codigo;
                           //Encuentro id del elemento
                            $id=$this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DESCRIPCION","ID","CODIGO",$id, "ID_TIPO",$tipo);
                            $this->StokePriceModel->updateDetailsInformation(
                                $id,
                                $codigo,
                                $proveedor,
                                $descripcion,
                                $materiales,
                                $mano,
                                $adicionales,
                                $entrega,
                                $garantia,
                                $origen,
                                NULL,
                                $this->session->userdata('usuario'));
                            $id=$this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DESCRIPCION","CODIGO","ID",$id, "ID_TIPO",$tipo);
                        }
                        $codigos[$i]=$codigo;
                        $errores[$i]="Ingresado correctamente";
                       // echo $id." ".$codigo," ",$tipo," ",$proveedor," ",$descripcion," ",$materiales," ",$mano," ",$adicionales," ",$entrega," ",$garantia," ",$origen."<br>";
                    }else{
                        //Identifico que hay un error
                        $codigos[$i]=$codigo;
                        $errores[$i]=$error;
                        
                        //echo $id." ".$codigo," ",$error."";
                    }
                    $i++;
                    
               }
                
               //var_dump($codigos);
               
               //var_dump($errores);
                
                //Retorno
               $message='FileOk';
               $page="StokePriceConfigurationDescription/paintLoad";
               //Pinto informaci�n
               $this->session->set_userdata('auxiliar', $message);
               
               // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
               $mainPage = "StokePriceConfigurationDescription/board";
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
        $mainPage = "StokePriceConfigurationDescription/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // P�gina principal a donde debo retornar
            $mainPage = "StokePriceConfigurationDescription/board";
            
            // Cargo informaci�n de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_DESCRIPCION", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $estado = $this->FunctionsGeneral->getFieldFromTable("COT_DESCRIPCION", "ESTADO", $id);
                if ($estado == 'S') {
                    $estado = 'N';
                } else if ($estado == 'N') {
                    $estado = 'S';
                }
                $message = 'changeStateGeneral';
                $this->FunctionsGeneral->updateByID("COT_DESCRIPCION", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
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