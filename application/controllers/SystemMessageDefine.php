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
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemMessageDefine extends CI_Controller {

	
 public function __construct()
    {
        parent::__construct();

        //Cargo modelos, librerias y helpers
        $this->load->model('SystemModel'); // Libreria principal de las funciones referentes a sistema
       
    }
    
    /** *********************************************************************************************************** 
    										RUTINAS PARA PINTAR FORMULARIOS
        ******************************************************************************************************* **/
	public function board(){
         /** Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado*/
        //Valido si la sessión existe en caso contrario saco al usuario
        $mainPage="SystemMessageDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
            //Pinto las vistas adicionales a través de la función pintaComun del helper
            $mainPage="SystemMessageDefine/board";
            $data=null;
            //Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
            //Pinto la información de los parametros de la aplicación
            //Pinto la pantalla
            $data['mainPage']=$mainPage;
            //Pinto los permisos del tablero de control
            $idModule=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO","ID","PAGINA",$mainPage);
            $data['listaBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'board',$idModule,VIEW_LIST_PERMISSION) ;
            $data['botonesBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'board',$idModule,VIEW_BUTTON_PERMISSION) ;
            
            
            $usuRolper=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_USUROLPER","ID_ROLPERFIL","ID_USUARIO",$this->session->userdata('usuario'));
            $data['idPerfil']=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_ROLPERFIL","ID_PERFIL","ID",$usuRolper);
            //Lista de listas
            $data['listaLista']=$this->FunctionsGeneral->selectValoresListaTabla("ADM_ENCMENSAJE");
            //Pinto plantilla principal
            $data['board']="Valores parametrizados";
            $this->load->view('common/boards/board',$data); 
            
            //Pinto el final de la página (páginas internas
            showCommonEnds($this,null,null);
            
        }else{
            //Retorno a la página principal
            header("Location: ". base_url());
        }
    }
    
    public function newRegister(){
    	/**Formulario para crear un nuevo registro del parametro*/
    	//Valido si la sessión existe en caso contrario saco al usuario
    	$mainPage="SystemMessageDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		//Cargo la página principal
    		$mainPage="SystemMessageDefine/board";
    		$data=null;
    		//Pinto la cabecera principal de las páginas internas
    		showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
    
    		/** Información relacionada con la plantilla principal Pinto la pantalla    **/
    
    		//Inicializo variables de la vista
    		$data['valida']=$this->encryption->encrypt('newRegister');
    		$data['mainPage']=$mainPage;
    		$data['id']=null;
    		$data['nombre']=null;
    		$data['titulo']=null;
    		$data['mensaje']=null;
    		$data['readOnly']=null;
    		//Lista de aplica
    		$data['listaTipo']=$this->FunctionsAdmin->selectValoresListaAdministracion('LISTA_TIPO_MENSAJE','1');
    		$data['tipo']=null;
    		$data['pagina']="SystemMessageDefine/saveRegister";
    		//Cargo vista
    		$this->load->view('system/messageDefine/newMessage',$data);
    		// Cargo validación de formulario
    		$this->load->view('validation/system/newMessageValidation');
    
    		/** Fin: Información relacionada con la plantilla principal Pinto la pantalla*/
    
    		//Pinto el final de la página (páginas internas)
    		showCommonEnds($this,null,null);
    	}else{
    		//Retorno a la página principal
    		header("Location: ". base_url());
    	}
    }
    
    public function edit($id){
    	/**Formulario para editar la información previamente creada para el parametro de la aplicación */
    	//Valido si la sessión existe en caso contrario saco al usuario
    	$mainPage="SystemMessageDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		$id=$this->FunctionsGeneral->getFieldFromTable("ADM_ENCMENSAJE","ID",$this->encryption->decrypt($id));
    		if ($id!=''){
    			//Pinto las vistas adicionales a través de la función showCommon del helper
    			$mainPage="SystemMessageDefine/board";
    			$data=null;
    			//Pinto la cabecera principal de las páginas internas
    			showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
    
    			/** Información relacionada con la plantilla principal Pinto la pantalla    **/
    
    			//Inicializo variables de la vista
	    		$data['valida']=$this->encryption->encrypt('edit');
	    		$data['mainPage']=$mainPage;
	    		$data['id']=$this->encryption->encrypt($id);
	    		$data['nombre']=$this->FunctionsGeneral->getFieldFromTable("ADM_ENCMENSAJE","NOMBRE",$id);
	    		$clase=$this->FunctionsGeneral->getFieldFromTable("ADM_ENCMENSAJE","CLASE",$id);
	    		$data['titulo']= $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_DETMENSAJE","TITULO","ID_ENCMENSAJE",$id,'ID_IDIOMA',IDIOMA_DEFECTO);
	    		$data['mensaje']=$this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_DETMENSAJE","MENSAJE","ID_ENCMENSAJE",$id,'ID_IDIOMA',IDIOMA_DEFECTO);
	    		//Lista de aplica
	    		$data['listaTipo']=$this->FunctionsAdmin->selectValoresListaAdministracion('LISTA_TIPO_MENSAJE','1');
	    		$data['tipo']=$this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_DETLISTA","ID","VALOR",$clase,'ID_ENCLISTA','11');;
	    		$data['pagina']="SystemMessageDefine/saveRegister";
	    		$data['readOnly']="readonly='readonly'";
	    		//Cargo vista
	    		$this->load->view('system/messageDefine/newMessage',$data);
	    		// Cargo validación de formulario
	    		$this->load->view('validation/system/newMessageValidation');
    	   		
    	   		/** Fin: Información relacionada con la plantilla principal Pinto la pantalla*/
    
    			//Pinto el final de la página (páginas internas)
    			showCommonEnds($this,null,null);
    
    		}else{
    			//Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
    			$this->session->set_userdata('id', $id);
    			$this->session->set_userdata('auxiliar', "notInformationGeneral");
    			//Redirecciono la página
    			redirect(base_url()."SystemMessageDefine/board");
    		}
    
    	}else{
    		//Retorno a la página principal
    		header("Location: ". base_url());
    	}
    }
    
    /** ***********************************************************************************************************
    										 RUTINAS PARA GUARDAR INFORMACIÒN
     ******************************************************************************************************* **/
    
    public function saveRegister(){
    	/** Guardo la información del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida*/
    	$mainPage="SystemMessageDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		// Página principal a donde debo retornar
    		$mainPage="SystemMessageDefine/board";
    		$nombre=$this->security->xss_clean($this->input->post('nombre')); //
    		$clase=$this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA","VALOR",$this->security->xss_clean($this->input->post('tipo')));
    		if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida')))=='newRegister'){
    			if ($this->FunctionsGeneral->getQuantityFieldFromTable("ADM_ENCMENSAJE","NOMBRE",$nombre)==0){
    				//Creo el encabezado del registro
    				$id=$this->SystemModel->insertEncMessage(
    							$nombre, 
    						$clase,
    						$this->session->userdata('usuario'));
    				//Creo el detalle del registro del mensaje
    				$this->SystemModel->insertDetMessage(
    							$id,
    							$this->security->xss_clean($this->input->post('titulo')), 
    							$this->security->xss_clean($this->input->post('mensaje')),
    							IDIOMA_DEFECTO,
    							$this->session->userdata('usuario'));
    				
    				//Pinto mensaje para retornar a la aplicación
    				$this->session->set_userdata('id', $nombre);
    				$this->session->set_userdata('auxiliar','configUpdate');
    				//Redirecciono la página
    				redirect(base_url().$mainPage);
    			}else{
    				//Creo mensaje de creaciòn de usuario
    				$mensaje="ConfigExist";
    				//Pinto mensaje para retornar a la aplicación
    				$this->session->set_userdata('id', $nombre);
    				$this->session->set_userdata('auxiliar',$mensaje);
    				//Redirecciono la página
    				redirect(base_url().$mainPage);
    			}
    		}else{
    			//Actualizo los valores para el parametro respectivo en la tabla dada
    			$this->FunctionsGeneral->updateByID(
    					"ADM_ENCMENSAJE",
    					"CLASE", 
    					$clase, 
    					$this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), 
    					$this->session->userdata('usuario'));
    			// obtengo el id del detalle del mensaje
    			$idDetMensaje=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
    					"ADM_DETMENSAJE",
    					"ID",
    					"ID_ENCMENSAJE",
    					$this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), 
    					'ID_IDIOMA',
    					IDIOMA_DEFECTO);
    			//Actualizo mensaje
    			$this->FunctionsGeneral->updateByID(
    					"ADM_DETMENSAJE",
    					"TITULO",
    					$this->security->xss_clean($this->input->post('titulo')),
    					$idDetMensaje,
    					$this->session->userdata('usuario'));
    			$this->FunctionsGeneral->updateByID(
    					"ADM_DETMENSAJE",
    					"MENSAJE",
    					$this->security->xss_clean($this->input->post('mensaje')),
    					$idDetMensaje,
    					$this->session->userdata('usuario'));
    			//Pinto mensaje para retornar a la aplicación
    			$this->session->set_userdata('id', $nombre);
    			$this->session->set_userdata('auxiliar','configUpdate');
    			//Redirecciono la página
    			redirect(base_url().$mainPage);
    		}
    	}else{
    		//Retorno a la página principal
    		header("Location: ". base_url());
    	}
    }
    
    public function inactive ($id){
    	/** Inactivo el registro para el cual se tiene asociado el valor $id*/
    	//Valido si la sessión existe en caso contrario saco al usuario
    	$mainPage="SystemMessageDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		// Página principal a donde debo retornar
    		$mainPage="SystemMessageDefine/board";
    
    		//Cargo información de la lista teniendo en cuenta el id dado
    		//Obtengo el id del contacto
    		$id=$this->FunctionsGeneral->getFieldFromTable("ADM_ENCMENSAJE","ID",$this->encryption->decrypt($id));
    		if ($id!=''){
    			$estado=$this->FunctionsGeneral->getFieldFromTable("ADM_ENCMENSAJE","ESTADO",$id);
    			if($estado=='S'){
    				$estado='N';
    					
    			}else if($estado=='N'){
    				$estado='S';
    			}
    			$message='changeStateGeneral';
    			$this->FunctionsGeneral->updateByID(
    					"ADM_ENCMENSAJE",
    					"ESTADO",
    					$estado,
    					$id,
    					$this->session->userdata('usuario'));
    			//Pinto mensaje para retornar a la aplicación
    			$this->session->set_userdata('id', $id);
    			$this->session->set_userdata('auxiliar',$message);
    			//Redirecciono la página
    			redirect(base_url().$mainPage);
    		}else{
    			//Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
    			$this->session->set_userdata('id', $id);
    			$this->session->set_userdata('auxiliar', "notInformationGeneral");
    			//Redirecciono la página
    			redirect(base_url().$mainPage);
    		}
    	}else{
    		//Retorno a la página principal
    		header("Location: ". base_url());
    	}
    }
}
?>