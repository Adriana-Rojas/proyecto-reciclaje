<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para visualizar las partes del cuerpo (amputaci�n) que se tendr�n en 
 cuenta para la parametrizaci�n de elementos y productos.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class OrdersConfigurationBodyPartsSection extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		// Cargo modelos, librerias y helpers
		$this->load->model ( 'OrdersModel' ); // Libreria principal de las funciones referentes a �rdenes
	}
	
	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA PINTAR FORMULARIOS
	 * ****************************************************************************************************** *
	 */
	public function board() {
		/**
		 * Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationBodyPartsSection/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
			$mainPage = "OrdersConfigurationBodyPartsSection/board";
			$data = null;
			// Pinto la cabecera principal de las p�ginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
			// Pinto la informaci�n de los parametros de la aplicaci�n
			
			/**
			 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
			 */
			$data ['mainPage'] = $mainPage;
			$data ['board'] = "Valores parametrizados";
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId ( "ADM_MODULO", "ID", "PAGINA", $mainPage );
			$data ['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard ( $this->session->userdata ( 'usuario' ), 'board', $idModule, VIEW_LIST_PERMISSION );
			$data ['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard ( $this->session->userdata ( 'usuario' ), 'board', $idModule, VIEW_BUTTON_PERMISSION );
			
			// Lista de listas
			$data ['listaLista'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_NIVELAMP" );
			
			// Pinto plantilla principal
			// Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
			$this->load->view ( 'common/boards/board', $data );
			
			/**
			 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
			 */
			
			// Pinto el final de la p�gina (p�ginas internas)
			showCommonEnds ( $this, null, null );
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	public function newRegister() {
		/**
		 * Formulario para crear un nuevo registro del parametro
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationBodyPartsSection/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
			$mainPage = "OrdersConfigurationBodyPartsSection/board";
			$data = null;
			// Pinto la cabecera principal de las p�ginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
			
			/**
			 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
			 */
			
			// Inicializo variables de la vista
			$data ['valida'] = $this->encryption->encrypt ( 'newRegister' );
			$data ['id'] = null;
			$data ['nombre'] = null;
			$data ['tipo'] = null;
			$data ['tipoMadre'] = null;
			$data ['listaPadre'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_TIEMPO", 'DESC' );
			$data ['listaMadre'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_MIEMBROS", 'DESC' );
			
			// Inicializo variables de los campos del formulario
			$data ['title'] = "Crear nueva parte del cuerpo <small>Nivel de amputaci&oacute;n</small>";
			$data ['mainField'] = "Nombre";
			$data ['placeHolder'] = "Ej. Transtibial ";
			$data ['father'] = "Tiempo de complejidad";
			$data ['mother'] = "Ubicaci&oacute;n general";
			$data ['pagina'] = "OrdersConfigurationBodyPartsSection/saveRegister";
			$data ['mainPage'] = $mainPage;
			
			// Cargo vista
			$this->load->view ( 'common/forms/formOneValueWithFathers', $data );
			// Cargo validaci�n de formulario
			$this->load->view ( 'validation/orders/configuration/ordersConfigurationBodyPartsSectionValidation' );
			
			/**
			 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
			 */
			
			// Pinto el final de la p�gina (p�ginas internas)
			showCommonEnds ( $this, null, null );
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	public function edit($id) {
		/**
		 * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationBodyPartsSection/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_NIVELAMP", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				// Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
				$mainPage = "OrdersConfigurationProviderType/board";
				$data = null;
				// Pinto la cabecera principal de las p�ginas internas
				showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
				
				/**
				 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
				 */
				
				// Inicializo variables de la vista
				$data ['valida'] = $this->encryption->encrypt ( 'edit' );
				$data ['id'] = $this->encryption->encrypt ( $id );
				$data ['nombre'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_NIVELAMP", "NOMBRE", $id );
				$data ['tipo'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_NIVELAMP", "ID_TIEMPO", $id );
				$data ['tipoMadre'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_NIVELAMP", "ID_MIEMBROS", $id );
				$data ['listaPadre'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_TIEMPO", 'DESC' );
				$data ['listaMadre'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_MIEMBROS", 'DESC' );
				
				// Inicializo variables de los campos del formulario
				$data ['title'] = "Modificar parte del cuerpo <small>Nivel de amputaci&oacute;n</small>";
				$data ['mainField'] = "Nombre";
				$data ['placeHolder'] = "Ej. Transtibial ";
				$data ['father'] = "Tiempo de complejidad";
				$data ['mother'] = "Ubicaci&oacute;n general";
				$data ['pagina'] = "OrdersConfigurationBodyPartsSection/saveRegister";
				$data ['mainPage'] = $mainPage;
				
				// Cargo vista
				$this->load->view ( 'common/forms/formOneValueWithFathers', $data );
				// Cargo validaci�n de formulario
				$this->load->view ( 'validation/orders/configuration/ordersConfigurationBodyPartsSectionValidation' );
				
				/**
				 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
				 */
				
				// Pinto el final de la p�gina (p�ginas internas)
				showCommonEnds ( $this, null, null );
			} else {
				// Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la p�gina
				redirect ( base_url () . "OrdersConfigurationProviderType/board" );
			}
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	
	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA GUARDAR INFORMACI�N
	 * ****************************************************************************************************** *
	 */
	public function saveRegister() {
		/**
		 * Guardo la informaci�n del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
		 */
		$mainPage = "OrdersConfigurationBodyPartsSection/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// P�gina principal a donde debo retornar
			$mainPage = "OrdersConfigurationBodyPartsSection/board";
			$nombre = $this->security->xss_clean ( $this->input->post ( 'nombre' ) );
			if ($this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'valida' ) ) ) == 'newRegister') {
				if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ORD_NIVELAMP", "NOMBRE", $nombre ) == 0) {
					// Creo el registro
					$id = $this->OrdersModel->insertBodyPartsSection ( $nombre, $this->security->xss_clean ( $this->input->post ( 'padre' ) ), $this->security->xss_clean ( $this->input->post ( 'madre' ) ), $this->session->userdata ( 'usuario' ) );
					
					// Pinto mensaje para retornar a la aplicaci�n
					$this->session->set_userdata ( 'id', $nombre );
					$this->session->set_userdata ( 'auxiliar', 'configUpdate' );
					// Redirecciono la p�gina
					redirect ( base_url () . $mainPage );
				} else {
					// Creo mensaje de creaci�n de usuario
					$mensaje = "ConfigExist";
					// Pinto mensaje para retornar a la aplicaci�n
					$this->session->set_userdata ( 'id', $nombre );
					$this->session->set_userdata ( 'auxiliar', $mensaje );
					// Redirecciono la p�gina
					redirect ( base_url () . $mainPage );
				}
			} else {
				echo $this->security->xss_clean ( $this->input->post ( 'madre' ) );
				// Actualizo los valores para el parametro respectivo en la tabla dada
				$this->FunctionsGeneral->updateByID ( "ORD_NIVELAMP", "NOMBRE", $nombre, $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'id' ) ) ), $this->session->userdata ( 'usuario' ) );
				$this->FunctionsGeneral->updateByID ( "ORD_NIVELAMP", "ID_MIEMBROS", $this->security->xss_clean ( $this->input->post ( 'madre' ) ), $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'id' ) ) ), $this->session->userdata ( 'usuario' ) );
				$this->FunctionsGeneral->updateByID ( "ORD_NIVELAMP", "ID_TIEMPO", $this->security->xss_clean ( $this->input->post ( 'padre' ) ), $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'id' ) ) ), $this->session->userdata ( 'usuario' ) );
				
				// Pinto mensaje para retornar a la aplicaci�n
				$this->session->set_userdata ( 'id', $nombre );
				$this->session->set_userdata ( 'auxiliar', 'configUpdate' );
				// Redirecciono la p�gina
				redirect ( base_url () . $mainPage );
			}
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	public function inactive($id) {
		/**
		 * Inactivo el registro para el cual se tiene asociado el valor $id
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationBodyPartsSection/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// P�gina principal a donde debo retornar
			$mainPage = "OrdersConfigurationBodyPartsSection/board";
			
			// Cargo informaci�n de la lista teniendo en cuenta el id dado
			// Obtengo el id del contacto
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_NIVELAMP", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				$estado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_NIVELAMP", "ESTADO", $id );
				if ($estado == 'S') {
					$estado = 'N';
				} else if ($estado == 'N') {
					$estado = 'S';
				}
				$message = 'changeStateGeneral';
				$this->FunctionsGeneral->updateByID ( "ORD_NIVELAMP", "ESTADO", $estado, $id, $this->session->userdata ( 'usuario' ) );
				// Pinto mensaje para retornar a la aplicaci�n
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', $message );
				// Redirecciono la p�gina
				redirect ( base_url () . $mainPage );
			} else {
				// Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la p�gina
				redirect ( base_url () . $mainPage );
			}
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
}
?>