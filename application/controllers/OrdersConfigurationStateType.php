<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para definir los diferentes tipos de estados
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdersConfigurationStateType extends CI_Controller {

	
 public function __construct()
    {
        parent::__construct();

        //Cargo modelos, librerias y helpers
    }
    
    /** *********************************************************************************************************** 
    										RUTINAS PARA PINTAR FORMULARIOS
        ******************************************************************************************************* **/
	public function board(){
        /** Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado*/
		
		
        //Valido si la sessión existe en caso contrario saco al usuario
        $mainPage="OrdersConfigurationStateType/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
            //Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage="OrdersConfigurationStateType/board";
            $data=null;
            //Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
            //Pinto la información de los parametros de la aplicación
            
            /** Información relacionada con la plantilla principal Pinto la pantalla    **/
            $data['mainPage']=$mainPage;
            $data['board']="Valores parametrizados";
            //Pinto los permisos del tablero de control
            $idModule=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO","ID","PAGINA",$mainPage);
            $data['listaBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'board',$idModule,VIEW_LIST_PERMISSION) ;
            $data['botonesBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'board',$idModule,VIEW_BUTTON_PERMISSION) ;
            
            //Lista de listas
            $data['listaLista']=$this->FunctionsGeneral->selectValoresListaTabla("ORD_TIPOESTADO");
            
            
            //Pinto plantilla principal
            //Pinto la lista genérica de parametros que se debe tener en cuenta dentro del sistema de parámetros
            $this->load->view('common/boards/board',$data); 
            
            /** Fin: Información relacionada con la plantilla principal Pinto la pantalla*/
            
            //Pinto el final de la página (páginas internas)
            showCommonEnds($this,null,null);
        }else{
            //Retorno a la página principal
            header("Location: ". base_url());
        }
    }
    
    public function newRegister(){
    	/**Formulario para crear un nuevo registro del parametro*/
    	//Valido si la sessión existe en caso contrario saco al usuario
    	$mainPage="OrdersConfigurationStateType/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		//Cargo la página principal
    		$mainPage="OrdersConfigurationStateType/board";
    		$data=null;
    		//Pinto la cabecera principal de las páginas internas
    		showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
    
    		/** Información relacionada con la plantilla principal Pinto la pantalla    **/
    
    		//Inicializo variables de la vista
    		$data['valida']=$this->encryption->encrypt('newRegister');
    		$data['id']=null;
    		$data['nombre']=null;
    		//Inicializo variables de los campos del formulario
    		$data['title']="Crear tipo de estados ";
    		$data['mainField']="Tipo";
    		$data['placeHolder']="Ej.  Inicial ";
    		$data['pagina']="OrdersConfigurationStateType/saveRegister";
    		$data['mainPage']=$mainPage;
    		
    		//Cargo vista
    		$this->load->view('common/forms/formOneValue',$data);
    		// Cargo validación de formulario
    		$this->load->view('validation/orders/configuration/ordersConfigurationStateTypeValidation');
    
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
    	$mainPage="OrdersConfigurationStateType/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		$id=$this->FunctionsGeneral->getFieldFromTable("ORD_TIPOESTADO","ID",$this->encryption->decrypt($id));
    		if ($id!=''){
    			//Pinto las vistas adicionales a través de la función showCommon del helper
    			$mainPage="OrdersConfigurationStateType/board";
    			$data=null;
    			//Pinto la cabecera principal de las páginas internas
    			showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
    			 
    			/** Información relacionada con la plantilla principal Pinto la pantalla    **/
    			 
    			//Inicializo variables de la vista
    			$data['valida']=$this->encryption->encrypt('edit');
    			$data['id']=$this->encryption->encrypt($id);
    			$data['nombre']=$this->FunctionsGeneral->getFieldFromTable("ORD_TIPOESTADO","NOMBRE",$id);
    			//Inicializo variables de los campos del formulario
    			$data['title']="Modificar tipo de estados ";
    			$data['mainField']="Tipo";
	    		$data['placeHolder']="Ej.  Inicial ";
    			$data['pagina']="OrdersConfigurationStateType/saveRegister";
    			$data['mainPage']=$mainPage;
    			
    			//Cargo vista
    			$this->load->view('common/forms/formOneValue',$data);
    			// Cargo validación de formulario
    			$this->load->view('validation/orders/configuration/ordersConfigurationStateTypeValidation');
    			 
    			/** Fin: Información relacionada con la plantilla principal Pinto la pantalla*/
    			 
    			//Pinto el final de la página (páginas internas)
    			showCommonEnds($this,null,null);
    			 
    		}else{
    			//Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
    			$this->session->set_userdata('id', $id);
    			$this->session->set_userdata('auxiliar', "notInformationGeneral");
    			//Redirecciono la página
    			redirect(base_url()."OrdersConfigurationStateType/board");
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
    	$mainPage="OrdersConfigurationStateType/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		// Página principal a donde debo retornar
    		$mainPage="OrdersConfigurationStateType/board";
    		$nombre=$this->security->xss_clean($this->input->post('nombre'));
    		if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida')))=='newRegister'){
    			if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_TIPOESTADO","NOMBRE",$nombre)==0){
    				//Creo el registro
    				$id=$this->FunctionsGeneral->insertOneParameter("ORD_TIPOESTADO","NOMBRE",$nombre, $this->session->userdata('usuario'));
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
    			$this->FunctionsGeneral->updateByID("ORD_TIPOESTADO","NOMBRE", 
    					$nombre, $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $this->session->userdata('usuario'));
    			
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
    	$mainPage="OrdersConfigurationStateType/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		// Página principal a donde debo retornar
    		$mainPage="OrdersConfigurationStateType/board";
    
    		//Cargo información de la lista teniendo en cuenta el id dado
    		//Obtengo el id del contacto
    		$id=$this->FunctionsGeneral->getFieldFromTable("ORD_TIPOESTADO","ID",$this->encryption->decrypt($id));
    		if ($id!=''){
    			$estado=$this->FunctionsGeneral->getFieldFromTable("ORD_TIPOESTADO","ESTADO",$id);
    			if($estado=='S'){
    				$estado='N';
    					
    			}else if($estado=='N'){
    				$estado='S';
    			}
    			$message='changeStateGeneral';
    			$this->FunctionsGeneral->updateByID(
    					"ORD_TIPOESTADO",
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