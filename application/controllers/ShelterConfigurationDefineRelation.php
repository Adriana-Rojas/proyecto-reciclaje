<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para definir los diferentes procesos de órdenes
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class ShelterConfigurationDefineRelation extends CI_Controller {

	
 public function __construct()
    {
        parent::__construct();

        //Cargo modelos, librerias y helpers
        $this->load->model ( 'ShelterModel' ); // Librerias del sistema
    }
    
    /** *********************************************************************************************************** 
    										RUTINAS PARA PINTAR FORMULARIOS
        ******************************************************************************************************* **/
	public function board(){
        /** Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado*/
		
		
        //Valido si la sessión existe en caso contrario saco al usuario
        $mainPage="ShelterConfigurationDefineRelation/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
            //Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage="ShelterConfigurationDefineRelation/board";
            $data=null;
            //Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
            //Pinto la información de los parametros de la aplicación
            
            /** Información relacionada con la plantilla principal Pinto la pantalla    **/
            $data['mainPage']=$mainPage;
            $data['pagina']="ShelterConfigurationDefineRelation/newRegister";
            $data['board']="Valores parametrizados";
            //Pinto los permisos del tablero de control
            $idModule=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO","ID","PAGINA",$mainPage);
            $data['listaBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'board',$idModule,VIEW_LIST_PERMISSION) ;
            $data['botonesBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'board',$idModule,VIEW_BUTTON_PERMISSION) ;
            
            //Lista de listas
            $data['listaLista']=$this->ShelterModel->selectListDefineRelation();
            
            
            //Pinto plantilla principal
            //Pinto la lista genérica de parametros que se debe tener en cuenta dentro del sistema de parámetros
            $this->load->view('shelter/configuration/boardDefineRelation',$data); 
            
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
    	$mainPage="ShelterConfigurationDefineRelation/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		//Cargo la página principal
    		$mainPage="ShelterConfigurationDefineRelation/board";
    		$data=null;
    		//Pinto la cabecera principal de las páginas internas
    		showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
    
    		/** Información relacionada con la plantilla principal Pinto la pantalla    **/
    
    		///Inicializo variables de los campos del formulario
    		$data['pagina']="ShelterConfigurationDefineRelation/saveRegister";
    		$data['mainPage']=$mainPage;
    		$data['valida']=$this->encryption->encrypt('newRegister');
    		$data['id']=null;
    		//Cargo la lista de Habitaciones
    		$data['listaHabitacion']=$this->FunctionsGeneral->selectValoresListaTabla("HP_HABITACIONES");
    		$data['habitacion']=NULL;
    		//Cargo la lista de camas
    		$data['listaCama']=$this->FunctionsGeneral->selectValoresListaTabla("HP_CAMAS");;
    		$data['cama']=NULL;
    		
    		
    		//Cargo vista
    		$this->load->view('shelter/configuration/formRelationRoomBed',$data);
    		// Cargo validación de formulario
    		$this->load->view('validation/shelter/configuration/formRelationRoomBedValidation');
    
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
    	$mainPage="ShelterConfigurationDefineRelation/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		$id=$this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA","ID",$this->encryption->decrypt($id));
    		if ($id!=''){
    			//Pinto las vistas adicionales a través de la función showCommon del helper
    			$mainPage="ShelterConfigurationDefineRelation/board";
    			$data=null;
    			//Pinto la cabecera principal de las páginas internas
    			showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
    			 
    			/** Información relacionada con la plantilla principal Pinto la pantalla    **/
    			 
    			//Inicializo variables de la vista
    			$data['pagina']="ShelterConfigurationDefineRelation/saveRegister";
    			$data['valida']=$this->encryption->encrypt('edit');
	    		$data['mainPage']=$mainPage;
	    		
	    		$data['id']=$this->encryption->encrypt($id);
	    		
	    		//Cargo la lista de Habitaciones
	    		$data['listaHabitacion']=$this->FunctionsGeneral->selectValoresListaTabla("HP_HABITACIONES");
	    		$data['habitacion']=$this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA","ID_HABITACION",$id);;
	    		//Cargo la lista de camas
	    		$data['listaCama']=$this->FunctionsGeneral->selectValoresListaTabla("HP_CAMAS");;
	    		$data['cama']=$this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA","ID_CAMA",$id);
	    		
	    		
	    		
	    		//Cargo vista
	    		$this->load->view('shelter/configuration/formRelationRoomBed',$data);
	    		// Cargo validación de formulario
	    		$this->load->view('validation/shelter/configuration/formRelationRoomBedValidation');
    			 
    			/** Fin: Información relacionada con la plantilla principal Pinto la pantalla*/
    			 
    			//Pinto el final de la página (páginas internas)
    			showCommonEnds($this,null,null);
    			 
    		}else{
    			//Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
    			$this->session->set_userdata('id', $id);
    			$this->session->set_userdata('auxiliar', "notInformationGeneral");
    			//Redirecciono la página
    			redirect(base_url()."ShelterConfigurationDefineRelation/board");
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
    	$mainPage="ShelterConfigurationDefineRelation/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		// Página principal a donde debo retornar
    		$mainPage="ShelterConfigurationDefineRelation/board";
    		$habitacion=$this->security->xss_clean($this->input->post('habitacion'));
    		$cama=strtoupper($this->security->xss_clean($this->input->post('cama')));
    		if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida')))=='newRegister'){
    			if ($this->FunctionsGeneral->getQuantityFieldFromTable("HP_HABCAMA","ID_HABITACION",$habitacion,'ID_CAMA',$cama)==0){
    				//Creo el registro
    				$id=$this->FunctionsGeneral->insertTwoParameter(
    						"HP_HABCAMA",
    						"ID_HABITACION",$habitacion,
    						"ID_CAMA",$cama, 
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
    				$this->session->set_userdata('id', $id);
    				$this->session->set_userdata('auxiliar',$mensaje);
    				//Redirecciono la página
    				redirect(base_url().$mainPage);
    			}
    		}else{
    			//Actualizo los valores para el parametro respectivo en la tabla dada
    			$this->FunctionsGeneral->updateByID("HP_HABCAMA","ID_HABITACION", 
    					$habitacion, $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $this->session->userdata('usuario'));
    			$this->FunctionsGeneral->updateByID("HP_HABCAMA","ID_CAMA",
    					$cama, $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))), $this->session->userdata('usuario'));
    			
    			//Pinto mensaje para retornar a la aplicación
    			$this->session->set_userdata('id', $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))));
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
    	$mainPage="ShelterConfigurationDefineRelation/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		// Página principal a donde debo retornar
    		$mainPage="ShelterConfigurationDefineRelation/board";
    
    		//Cargo información de la lista teniendo en cuenta el id dado
    		//Obtengo el id del contacto
    		$id=$this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA","ID",$this->encryption->decrypt($id));
    		if ($id!=''){
    			$estado=$this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA","ESTADO",$id);
    			if($estado=='S'){
    				$estado='N';
    					
    			}else if($estado=='N'){
    				$estado='S';
    			}
    			$message='changeStateGeneral';
    			$this->FunctionsGeneral->updateByID(
    					"HP_HABCAMA",
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