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

class SystemListDefine extends CI_Controller {

	
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
        $mainPage="SystemListDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
            //Pinto las vistas adicionales a través de la función pintaComun del helper
            $mainPage="SystemListDefine/board";
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
            $data['listaLista']=$this->FunctionsGeneral->selectValoresListaTabla("ADM_ENCLISTA");
            //Pinto plantilla principal
            $this->load->view('system/listDefine/board',$data);
            
            //Pinto el final de la página (páginas internas
            showCommonEnds($this,null,null);
            
        }else{
            //Retorno a la página principal
            header("Location: ". base_url());
        }
    }
    
    public function newList(){
    	/**Formulario para crear un nuevo registro del parametro*/
    	//Valido si la sessión existe en caso contrario saco al usuario
    	$mainPage="SystemListDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		//Verifico si la información del contrato existe
    		$mainPage="SystemListDefine/board";
    		showCommon(null,$this,$mainPage,null,null);
    		//Cargo la lista de asefuradoras
    		$data['valida']=$this->encryption->encrypt('newList');
    		$data['id']=null;
    		$data['nombre']=null;
    		$data['registros']=1;
    		$data['detLista']=null;
    		$data['readOnly']=null;
    		$data['disabled']='disabled="disabled"';
    		$data['mainPage']=$mainPage;
    		//Pinto plantilla principal de la aplicación en la posición actual
    		$this->load->view('system/listDefine/newList',$data);
    		//Validación de la página
    		$this->load->view('validation/system/newListValidation');
    		//Pinto el final de la página (páginas internas
    		showCommonEnds($this,null,null);
    	}else{
    		//Retorno a la página principal
    		header("Location: ". base_url());
    	}
    }
    
    public function editList($id){
    	/**Formulario para editar la información previamente creada para el parametro de la aplicación */
    	//Valido si la sessión existe en caso contrario saco al usuario
    	$mainPage="SystemListDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		//Nombre de la página principal (controlador)
    		$mainPage="SystemListDefine/board";
    		$id=$this->encryption->decrypt($id);
    		$id=$this->FunctionsGeneral->getFieldFromTable("ADM_ENCLISTA","ID",$id);
    		if ($id!=''){
    			//Verifico si la información del contrato existe
    			showCommon(null,$this,$mainPage,'ListDefine/newList');
    			//Cargo la lista de asefuradoras
    			$data['valida']=$this->encryption->encrypt('editList');
    			$data['id']=$this->encryption->encrypt($id);
    			$data['nombre']=$this->FunctionsGeneral->getFieldFromTable("ADM_ENCLISTA","NOMBRE",$id);
    			$data['detLista']=$this->SystemModel->getListDet($id);
    			$data['readOnly']='readOnly="readOnly"';
    			$data['disabled']=null;
    			$data['mainPage']=$mainPage;
    			$this->load->view('system/listDefine/newList',$data);
    			$this->load->view('validation/system/newListValidation');
    			showCommonEnds($this,$mainPage);
    		}else{
    			//Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
    			$this->session->set_userdata('id', $id);
    			$this->session->set_userdata('auxiliar', "notInformationGeneral");
    			//Redirecciono la página
    			redirect(base_url()."ListDefine/board");
    		}
    
    	}else{
    		//Retorno a la página principal
    		header("Location: ". base_url());
    	}
    }
    
     /** ***********************************************************************************************************
     												RUTINAS PARA GUARDAR INFORMACIÒN
     ******************************************************************************************************* **/
    
    public function saveList(){
    	/** Guardo la información del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida*/
    	$mainPage="SystemListDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		//Pagina a donde retornará la información
    		$mainPage="SystemListDefine/board";
    		if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida')))=='newList'){
    			$nombre=strtoupper($this->security->xss_clean($this->input->post('nombre')));
    			if ($this->FunctionsGeneral->getQuantityFieldFromTable("ADM_ENCLISTA","NOMBRE",$nombre)==0){
    				//Creo el encabezado de la lista
    				$idEncList=$this->SystemModel->insertEncList($nombre,
    						$this->session->userdata('usuario'));
    				//Creo el detalle de la lista
    				$registros= $this->security->xss_clean($this->input->post('registros'));
    				for ($i=1;$i<=$registros;$i++){
    					$id=$this->SystemModel->insertDetList(
    							$idEncList,
    							1,
    							$this->security->xss_clean($this->input->post('valor'.$i)),
    							$this->security->xss_clean($this->input->post('nombre'.$i)),
    							$this->session->userdata('usuario'));
    					//Actualizo el campo
    					$this->FunctionsGeneral->updateByID(
    							"ADM_DETLISTA", "ID_LISTAVALOR",
    							$id, $id,
    							$this->session->userdata('usuario'));
    
    				}
    				
    				//Pinto mensaje para retornar a la aplicación
    				$this->session->set_userdata('id', $nombre);
    				$this->session->set_userdata('auxiliar','listUpdate');
    				//Redirecciono la página
    				redirect(base_url().$mainPage);
    			}else{
    				//Creo mensaje de creaciòn de usuario
    				$mensaje="listExist";
    				//Pinto mensaje para retornar a la aplicación
    				$this->session->set_userdata('id', $nombre);
    				$this->session->set_userdata('auxiliar',$mensaje);
    				//Redirecciono la página
    				redirect(base_url().$mainPage);
    			}
    		}else{
    			//Actualizo el nombre del campo
    			$nombre=strtoupper($this->security->xss_clean($this->input->post('nombre')));
    			$id=$this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
    			$idEncList=$id;
    			$this->FunctionsGeneral->updateByID(
    					"ADM_ENCLISTA", "NOMBRE",
    					$nombre, $id,
    					$this->session->userdata('usuario'));
    			//Inactivo los registros que ya están creados
    			$this->FunctionsGeneral->updateByField("ADM_DETLISTA", "ESTADO", INACTIVO_ESTADO,"ID_ENCLISTA", $id, $this->session->userdata('usuario'));
    			 
    			//Actualizo los registros
    			$registros= $this->security->xss_clean($this->input->post('registros'));
    			for ($i=1;$i<=$registros;$i++){
    				if ($this->security->xss_clean($this->input->post('id'.$i))!=''){
    					//Actualizó valores
    					$this->SystemModel->updateDetList(
    							$this->security->xss_clean($this->input->post('id'.$i)),
    							$this->security->xss_clean($this->input->post('valor'.$i)),
    							$this->security->xss_clean($this->input->post('nombre'.$i)),
    							$this->session->userdata('usuario'));
    					
    				}else{
    					if($this->FunctionsGeneral->getQuantityFieldFromTable(
    							"ADM_DETLISTA",
    							"ID_ENCLISTA",
    							$id,
    							"VALOR",
    							$this->security->xss_clean($this->input->post('valor'.$i)))==0){
    						
							//Inserto nuevos valores
    						$id=$this->SystemModel->insertDetList(
    										$idEncList,
    										1,
    										$this->security->xss_clean($this->input->post('valor'.$i)),
    										$this->security->xss_clean($this->input->post('nombre'.$i)),
    										$this->session->userdata('usuario'));
    						//Actualizo el campo
    						$this->FunctionsGeneral->updateByID(
    										"ADM_DETLISTA", "ID_LISTAVALOR",
    										$id, $id,
    										$this->session->userdata('usuario'));
    					}else{
    						//Actualizo registro anterior
    						$idAnterior=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
    								"ADM_DETLISTA",
    								"ID",
    								"ID_ENCLISTA",
	    							$id,
	    							"VALOR",
	    							$this->security->xss_clean($this->input->post('valor'.$i)));
    						$this->SystemModel->updateDetList(
    							$idAnterior,
    							$this->security->xss_clean($this->input->post('valor'.$i)),
    							$this->security->xss_clean($this->input->post('nombre'.$i)),
    							$this->session->userdata('usuario'));
    					}
    					
    				}
    				
    			
    			}
    			
    			//Pinto mensaje para retornar a la aplicación
    			$this->session->set_userdata('id', $nombre);
    			$this->session->set_userdata('auxiliar','listUpdate');
    			//Redirecciono la página
    			redirect(base_url().$mainPage);
    		}
    	}else{
    		//Retorno a la página principal
    		header("Location: ". base_url());
    	}
    }
    
    public function inactiveList ($id){
    	/** Inactivo el registro para el cual se tiene asociado el valor $id*/
    	
    	//Valido si la sessión existe en caso contrario saco al usuario
    	$mainPage="SystemListDefine/board"; 
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    		//Pagina a donde retornará la información
    		$mainPage="SystemListDefine/board";
    		
    		//Cargo información de la lista teniendo en cuenta el id dado
    		//Obtengo el id del contacto
    		$id=$this->FunctionsGeneral->getFieldFromTable("ADM_ENCLISTA","ID",$this->encryption->decrypt($id));
    		if ($id!=''){
    			$estado=$this->FunctionsGeneral->getFieldFromTable("ADM_ENCLISTA","ESTADO",$id);
    			if($estado=='S'){
    				$estado='N';
    				 
    			}else if($estado=='N'){
    				$estado='S';
    			}
    			$message='changeStateGeneral';
    			$this->FunctionsGeneral->updateByID(
    					"ADM_ENCLISTA",
    					"ESTADO",
    					$estado,
    					$id,
    					$this->session->userdata('usuario'));
    			//Pinto mensaje para retornar a la aplicación
    			$this->session->set_userdata('id', $id);
    			$this->session->set_userdata('auxiliar',$message);
    			//Redirecciono la página
    			redirect(base_url()."SystemListDefine/board");
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