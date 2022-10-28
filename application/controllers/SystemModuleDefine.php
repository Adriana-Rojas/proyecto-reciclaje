<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para visualizar el manejo de los m�dulos entro de la aplicaci�n Administraci�n (sistema).
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemModuleDefine extends CI_Controller {

	
 public function __construct()
    {
        parent::__construct();

        //Cargo modelos, librerias y helpers
		$this->load->model('SystemModel');
    }
    
    
    /** *********************************************************************************************************** 
    										RUTINAS PARA PINTAR FORMULARIOS
        ******************************************************************************************************* **/
	public function board(){
         /** Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado*/
        //Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage="SystemModuleDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
            //Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage="SystemModuleDefine/board";
            $data=null;
            //Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
            //Pinto la informaci�n de los parametros de la aplicaci�n
            
            /** Informaci�n relacionada con la plantilla principal Pinto la pantalla    **/
            
            $data['mainPage']=$mainPage;
            //Pinto los permisos del tablero de control
            $idModule=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO","ID","PAGINA",$mainPage);
            $data['listaBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'board',$idModule,VIEW_LIST_PERMISSION) ;
            $data['botonesBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'board',$idModule,VIEW_BUTTON_PERMISSION) ;
            
            $usuRolper=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_USUROLPER","ID_ROLPERFIL","ID_USUARIO",$this->session->userdata('usuario'));
            $data['idPerfil']=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_ROLPERFIL","ID_PERFIL","ID",$usuRolper);
            
            //Lista de listas
            $data['listaLista']=$this->SystemModel->getListModulos();
            
            
            //Pinto plantilla principal
            $this->load->view('system/moduleDefine/board',$data);
            
            /** Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla*/
            
            //Pinto el final de la p�gina (p�ginas internas)
            showCommonEnds($this,null,null);
        }else{
            //Retorno a la p�gina principal
            header("Location: ". base_url());
        }
    }
    
    public function newModule(){
    	/**Formulario para crear un nuevo registro del parametro*/
    	//Valido si la sessi�n existe en caso contrario saco al usuario
    	$mainPage="SystemModuleDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		//Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper 
    		$mainPage="SystemModuleDefine/board";
    		$data=null;
    		//Pinto la cabecera principal de las p�ginas internas
    		showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
    		//Pinto la informaci�n de los parametros de la aplicaci�n
    
    		/** Informaci�n relacionada con la plantilla principal Pinto la pantalla    **/
    
    		//Cargo la lista de tipos de modulos
    		$data['listaTipoModulo']=$this->FunctionsGeneral->selectValoresListaTabla("ADM_TIPOMOD",'DESC');
    		$data['listaTipo']=$this->FunctionsAdmin->selectValoresListaAdministracion('TIPO_LISTA','1','DESC');
    		$data['listaModulo']=$this->SystemModel->getListModulosPrincipales();
    		//Defino variables
    		$data['valida']=$this->encryption->encrypt('newModule');
    		
    		$data['id']=null;
    		$data['displayPagina']="style=\"display: none;\"";
    		$data['displayClase']="style=\"display: none;\"";
    		$data['displayModulo']="style=\"display: none;\"";
    		$data['displayTipoModulo']="style=\"display: none;\"";
    		$data['disabledPagina']="disabled=\"disabled\"";
    		$data['disabledClase']="disabled=\"disabled\"";
    		$data['disabledModulo']="disabled=\"disabled\"";
    		$data['disabledTipoModulo']="disabled=\"disabled\"";
    		$data['tipo']=null;
    		$data['modulo']=null;
    		$data['nombre']=null;
    		$data['pagina']=null;
    		$data['clase']=null;
    		$data['tipoMod']=null;
    
    
    		//Pinto plantilla principal
    		$this->load->view('system/moduleDefine/newModule',$data);
			//Validaci�n del archivo
    		$this->load->view('validation/system/newModuleValidation');
    
    		/** Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla*/
    
    		//Pinto el final de la p�gina (p�ginas internas)
    		showCommonEnds($this,null,null);
    	}else{
    		//Retorno a la p�gina principal
    		header("Location: ". base_url());
    	}
    }
    
    public function editModule($id){
    	/**Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n */
    	//Valido si la sessi�n existe en caso contrario saco al usuario
    	$mainPage="SystemModuleDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		$mainPage="ListDefine/board";
    		//Obtengo el id
    		$id=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID",$this->encryption->decrypt($id));
    		if ($id!=''){
    			//Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper 
	    		$mainPage="SystemModuleDefine/board";
	    		$data=null;
	    		//Pinto la cabecera principal de las p�ginas internas
	    		showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
	    		//Pinto la informaci�n de los parametros de la aplicaci�n
	    
	    		/** Informaci�n relacionada con la plantilla principal Pinto la pantalla    **/
    			
    			//Cargo la lista de tipos de modulos
    			$data['listaTipoModulo']=$this->FunctionsGeneral->selectValoresListaTabla("ADM_TIPOMOD");
    			$data['listaTipo']=$this->FunctionsAdmin->selectValoresListaAdministracion('TIPO_LISTA','1');
    			$data['listaModulo']=$this->SystemModel->getListModulosPrincipales();
    			//Defino variables
    			$data['valida']=$this->encryption->encrypt('editModule');
    			$data['id']=$this->encryption->encrypt($id);
    			$data['tipo']=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID_TIPO",$id);
    			$data['tipoMod']=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID_TIPOMOD",$id);
    			$data['modulo']=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID_MODULO",$id);
    			$data['nombre']=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODNOMBRE","NOMBRE","ID_MODULO",$id);
    			$data['pagina']=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","PAGINA",$id);
    			$data['clase']=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","CLASE",$id);
    			if ($data['tipo']==MAIN_MODULE){
    				$data['disabledClase']="";
    				$data['displayClase']="";
    				$data['displayTipoModulo']="";
    				$data['disabledTipoModulo']="";
    				$data['displayModulo']="style=\"display: none;\"";
    				$data['disabledModulo']="disabled=\"disabled\"";
    				if ($data['tipoMod']==1){
    					$data['displayPagina']="";
    					$data['disabledPagina']="";
    				}else{
    					$data['displayPagina']="style=\"display: none;\"";
    					$data['disabledPagina']="disabled=\"disabled\"";
    				}
    			}else{
    				$data['displayPagina']="";
    				$data['disabledPagina']="";
    				$data['displayClase']="style=\"display: none;\"";
    				$data['disabledClase']="disabled=\"disabled\"";
    				$data['displayTipoModulo']="style=\"display: none;\"";
    				$data['disabledTipoModulo']="disabled=\"disabled\"";
    				$data['displayModulo']="";
    				$data['disabledModulo']="";
    			}
    
    
    			//Pinto plantilla principal
	    		$this->load->view('system/moduleDefine/newModule',$data);
				//Validaci�n del archivo
	    		$this->load->view('validation/system/newModuleValidation');
	    
	    		/** Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla*/
	    
	    		//Pinto el final de la p�gina (p�ginas internas)
	    		showCommonEnds($this,null,null);
    		}else{
    			//Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
    			$this->session->set_userdata('id', $id);
    			$this->session->set_userdata('auxiliar', "notInformationGeneral");
    			//Redirecciono la p�gina
    			redirect(base_url()."ModuleDefine/board");
    		}
    
    	}else{
    		//Retorno a la p�gina principal
    		header("Location: ". base_url());
    	}
    }
    
    /** ***********************************************************************************************************
     												RUTINAS PARA GUARDAR INFORMACI�N
     ******************************************************************************************************* **/
    											
    
    public function saveModule(){
    	/** Guardo la informaci�n del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida*/
    	$mainPage="SystemModuleDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		//Pagina a donde retornar� la informaci�n
    		$mainPage="SystemModuleDefine/board";
    		
    		$nombre=$this->security->xss_clean($this->input->post('nombre'));
    		if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida')))=='newModule'){
    			//Creo la cabeza del m�dulo
    			if($this->security->xss_clean($this->input->post('tipo'))==MAIN_MODULE){
    				//Principal
    				
    				$clase=$this->security->xss_clean($this->input->post('clase'));
    				$tipoModulo=$this->security->xss_clean($this->input->post('tipoModulo'));
    				if($this->security->xss_clean($this->input->post('tipoModulo'))!=1){
    					$pagina='---';
    				}else{
    					$pagina=$this->security->xss_clean($this->input->post('pagina'));
    				}
    				$idModule=null;
    			}else{
    				//Secundario
    				$clase=null;
    				$tipoModulo=2;
    				$idModule=$this->security->xss_clean($this->input->post('modulo'));
    				$pagina=$this->security->xss_clean($this->input->post('pagina'));
    				
    
    			}
    			$consecutivo=$this->SystemModel->insertModule(
    					$idModule,
    					$tipoModulo,
    					$this->security->xss_clean($this->input->post('tipo')),
    					$pagina,
    					$clase,
    					$this->session->userdata('usuario'));
    			//Creo el nombre del m�dulo
    			$this->SystemModel->insertModuleName($consecutivo,
    					$nombre,
    					1,
    					$this->session->userdata('usuario'));
    			//Informo de la creaci�n
    			 
    		}else{
    			//Recibo el valor respectivo
    			$id=$this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
    			//Actualizo los valores
    			if ($this->security->xss_clean($this->input->post('tipo'))==MAIN_MODULE){
    				$clase=$this->security->xss_clean($this->input->post('clase'));
    				$tipoModulo=$this->security->xss_clean($this->input->post('tipoModulo'));
    				if ($tipoModulo==1){
    					$pagina=$this->security->xss_clean($this->input->post('pagina'));
    				}else{
    					$pagina='---';
    				}
    				$modulo=null;
    			}else{
    				$pagina=$this->security->xss_clean($this->input->post('pagina'));
    				$clase=null;
    				$tipoModulo=2;
    				$modulo=$this->security->xss_clean($this->input->post('modulo'));;
    			}
    			//Actualizo la cabeza del modulo
    			$this->FunctionsGeneral->updateByField("ADM_MODNOMBRE",
    					"NOMBRE",
    					$nombre,
    					"ID_MODULO",
    					$id,
    					$this->session->userdata('usuario'));
    			//aCTUALIZO EL DETALLE DEL MODULO
    			$this->SystemModel->updateModulo(
    					$id,
    					$pagina,
    					$clase,
    					$this->security->xss_clean($this->input->post('tipo')),
    					$tipoModulo,
    					$modulo,
    					$this->session->userdata('usuario'));
    			 
    		}
    		//Pinto mensaje para retornar a la aplicaci�n
    		$this->session->set_userdata('id', $nombre);
    		$this->session->set_userdata('auxiliar','moduleOk');
    		//Redirecciono la p�gina
    		redirect(base_url().$mainPage);
    	}else{
    		//Retorno a la p�gina principal
    		header("Location: ". base_url());
    	}
    }
    
    public function inactiveModule ($id){
    	/** Inactivo el registro para el cual se tiene asociado el valor $id*/
    	
    	//Valido si la sessi�n existe en caso contrario saco al usuario
    	$mainPage="SystemModuleDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		
    		$mainPage="SystemModuleDefine/board";
    		//Cargo informaci�n de la lista teniendo en cuenta el id dado
    		//Obtengo el id del contacto
    		$id=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID",$this->encryption->decrypt($id));
    		if ($id!=''){
    			$estado=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ESTADO",$id);
    			if($estado=='S'){
    				$estado='N';
    				 
    			}else if($estado=='N'){
    				$estado='S';
    			}
    			$message='changeStateGeneral';
    			$this->FunctionsGeneral->updateByID(
    					"ADM_MODULO",
    					"ESTADO",
    					$estado,
    					$id,
    					$this->session->userdata('usuario'));
    			//Pinto mensaje para retornar a la aplicaci�n
    			$this->session->set_userdata('id', $id);
    			$this->session->set_userdata('auxiliar',$message);
    			//Redirecciono la p�gina
    			redirect(base_url().$mainPage);
    		}else{
    			//Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
    			$this->session->set_userdata('id', $id);
    			$this->session->set_userdata('auxiliar', "notInformationGeneral");
    			//Redirecciono la p�gina
    			redirect(base_url().$mainPage);
    		}
    	}else{
    		//Retorno a la p�gina principal
    		header("Location: ". base_url());
    	}
    }
    
    
}
?>