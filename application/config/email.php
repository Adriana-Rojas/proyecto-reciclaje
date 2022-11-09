<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/07/31
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

?><?php 
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	25/08/2018
 Propósito:						Controlador para visualizar el tablero de control que se defina dentro de la aplicación.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed.');

$config['useragent']        = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
$config['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
$config['mailpath']         = '/usr/sbin/sendmail';
$config['smtp_host']        = 'smtp.office365.com';
$config['smtp_user']        = 'info.cicirec@cirec.org';
$config['smtp_pass']        = '7D?tGrrWoCLY.';
$config['smtp_port']        = 587;
$config['smtp_timeout']     = 30;                       // (in seconds)
$config['smtp_crypto']      = 'tls';                       // '' or 'tls' or 'ssl'
$config['smtp_debug']       = 0;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.
$config['smtp_auto_tls']    = false;                     // Whether to enable TLS encryption automatically if a server supports it, even if `smtp_crypto` is not set to 'tls'.
$config['smtp_conn_options'] = array();                 // SMTP connection options, an array passed to the function stream_context_create() when connecting via SMTP.
$config['wordwrap']         = true;
$config['wrapchars']        = 76;
$config['mailtype']         = 'html';                   // 'text' or 'html'
$config['charset']          = null;                     // 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
$config['validate']         = true;
$config['priority']         = 3;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at all, see https://github.com/PHPMailer/PHPMailer/issues/449
$config['crlf']             = "\n";                     // "\r\n" or "\n" or "\r"
$config['newline']          = "\n";                     // "\r\n" or "\n" or "\r"
$config['bcc_batch_mode']   = false;
$config['bcc_batch_size']   = 200;
$config['encoding']         = '8bit';                   // The body encoding. For CodeIgniter: '8bit' or '7bit'. For PHPMailer: '8bit', '7bit', 'binary', 'base64', or 'quoted-printable'.

// DKIM Signing
// See https://yomotherboard.com/how-to-setup-email-server-dkim-keys/
// See http://stackoverflow.com/questions/24463425/send-mail-in-phpmailer-using-dkim-keys
// See https://github.com/PHPMailer/PHPMailer/blob/v5.2.14/test/phpmailerTest.php#L1708
$config['dkim_domain']      = '';                       // DKIM signing domain name, for exmple 'example.com'.
$config['dkim_private']     = '';                       // DKIM private key, set as a file path.
$config['dkim_private_string'] = '';                    // DKIM private key, set directly from a string.
$config['dkim_selector']    = '';                       // DKIM selector.
$config['dkim_passphrase']  = '';                       // DKIM passphrase, used if your key is encrypted.
$config['dkim_identity']    = '';                       // DKIM Identity, usually the email address used as the source of the email.
