<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para definir los diferentes tipos de estados
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class OrdersConfigurationStateObservation extends CI_Controller {
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
		$mainPage = "OrdersConfigurationStateObservation/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
			$mainPage = "OrdersConfigurationStateObservation/board";
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
			$data ['listaLista'] = $this->OrdersModel->selectListadoObservacionesEstados ();
			//print_r($data ['listaLista']);
			// Pinto plantilla principal
			// Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
			$this->load->view ( 'orders/configuration/boardObservationState', $data );
			
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
		$mainPage = "OrdersConfigurationStateObservation/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Cargo la p�gina principal
			$mainPage = "OrdersConfigurationStateObservation/board";
			$data = null;
			// Pinto la cabecera principal de las p�ginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
			
			/**
			 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
			 */
			
			// Inicializo variables de la vista
			$data ['valida'] = $this->encryption->encrypt ( 'newRegister' );
			$data ['nombre'] = null;
			$data ['id'] = null;
			$data ['estado'] = null;
			$data ['cierra'] = null;
			$data ['tipo'] = null;
			$data ['motivo'] = null;
			$data ['despiece'] = null;
			// Lista de listas
			$data ['listaEstado'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_ESTADOS" );
			$data ['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'SI_NO', '1' );
			$data ['listaProceso'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'TIPO_OBSERVACION', '1' );
			$data ['listaMotivo'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'MOTIVO_OBSERVACION', '1' );
			$data ['listaNivel'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_NIVELESTADO" );
			$data ['listaGrupo'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_GRUPOESTADO" );
			$data ['listaGrupo'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_GRUPOESTADO" );
			
			// Inicializo variables de los campos del formulario
			$data ['pagina'] = "OrdersConfigurationStateObservation/saveRegister";
			$data ['mainPage'] = $mainPage;
			
			// Cargo vista
			$this->load->view ( 'orders/configuration/formOrdersConfigurationStateObservation', $data );
			// Cargo validaci�n de formulario
			$this->load->view ( 'validation/orders/configuration/ordersConfigurationStateObservationValidation' );
			
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
		$mainPage = "OrdersConfigurationStateObservation/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_OBSESTADO", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				// Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
				$mainPage = "OrdersConfigurationStateObservation/board";
				$data = null;
				// Pinto la cabecera principal de las p�ginas internas
				showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
				
				/**
				 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
				 */
				
				// Inicializo variables de la vista
				$data ['valida'] = $this->encryption->encrypt ( 'edit' );
				$data ['nombre'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_OBSESTADO", "NOMBRE", $id );
				$data ['id'] = $this->encryption->encrypt ( $id );
				$data ['estado'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_OBSESTADO", "ID_ESTADO", $id );
				$data ['cierra'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_OBSESTADO", "CIERRA", $id );
				$data ['tipo'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_OBSESTADO", "TIPOOBSE", $id );
				$data ['motivo'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_OBSESTADO", "MOTIVO", $id );
				$data ['despiece'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_OBSESTADO", "DESPIECE", $id );
				// Lista de listas
				$data ['listaEstado'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_ESTADOS" );
				$data ['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'SI_NO', '1' );
				$data ['listaProceso'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'TIPO_OBSERVACION', '1' );
				$data ['listaMotivo'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'MOTIVO_OBSERVACION', '1' );
				$data ['listaNivel'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_NIVELESTADO" );
				$data ['listaGrupo'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_GRUPOESTADO" );
				$data ['listaGrupo'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_GRUPOESTADO" );
				// Inicializo variables de los campos del formulario
				$data ['pagina'] = "OrdersConfigurationStateObservation/saveRegister";
				$data ['mainPage'] = $mainPage;
				
				// Cargo vista
				$this->load->view ( 'orders/configuration/formOrdersConfigurationStateObservation', $data );
				// Cargo validaci�n de formulario
				$this->load->view ( 'validation/orders/configuration/ordersConfigurationStateObservationValidation' );
				
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
				redirect ( base_url () . "OrdersConfigurationStateObservation/board" );
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
		$mainPage = "OrdersConfigurationStateObservation/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// P�gina principal a donde debo retornar
			$mainPage = "OrdersConfigurationStateObservation/board";
			$nombre = $this->security->xss_clean ( $this->input->post ( 'nombre' ) );
			if ($this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'valida' ) ) ) == 'newRegister') {
				if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ORD_OBSESTADO", "NOMBRE", $nombre ) == 0) {
					// Creo el registro
					$id = $this->OrdersModel->insertStateObservation ( $nombre, $this->security->xss_clean ( $this->input->post ( 'estado' ) ), $this->security->xss_clean ( $this->input->post ( 'tipo' ) ), $this->security->xss_clean ( $this->input->post ( 'motivo' ) ), $this->security->xss_clean ( $this->input->post ( 'cierra' ) ), $this->security->xss_clean ( $this->input->post ( 'despiece' ) ), $this->session->userdata ( 'usuario' ) );
					
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
				// Actualizo los valores para el parametro respectivo en la tabla dada
				$this->OrdersModel->updateStateObservation ( $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'id' ) ) ), $nombre, $this->security->xss_clean ( $this->input->post ( 'estado' ) ), $this->security->xss_clean ( $this->input->post ( 'tipo' ) ), $this->security->xss_clean ( $this->input->post ( 'motivo' ) ), $this->security->xss_clean ( $this->input->post ( 'cierra' ) ), $this->security->xss_clean ( $this->input->post ( 'despiece' ) ), $this->session->userdata ( 'usuario' ) );
				
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
		$mainPage = "OrdersConfigurationStateObservation/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// P�gina principal a donde debo retornar
			$mainPage = "OrdersConfigurationStateObservation/board";
			
			// Cargo informaci�n de la lista teniendo en cuenta el id dado
			// Obtengo el id del contacto
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_OBSESTADO", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				$estado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_OBSESTADO", "ESTADO", $id );
				if ($estado == 'S') {
					$estado = 'N';
				} else if ($estado == 'N') {
					$estado = 'S';
				}
				$message = 'changeStateGeneral';
				$this->FunctionsGeneral->updateByID ( "ORD_OBSESTADO", "ESTADO", $estado, $id, $this->session->userdata ( 'usuario' ) );
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