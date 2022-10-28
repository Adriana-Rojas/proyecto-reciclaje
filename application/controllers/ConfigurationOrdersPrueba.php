<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						P�gina principal de la administraci�n de la aplicaci�n.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class ConfigurationOrdersPrueba extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		// Cargo modelos, librerias y helpers
		$this->load->model ( 'SystemModel' ); // Libreria principal de las funciones referentes a sistema
	}
	
	/**
	 * RUTINAS PARA PINTAR FORMULARIOS*
	 */
	public function board() {
		/**
		 * Panel principal para la gesti�n de ubicaciones
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "ConfigurationOrdersPrueba/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper
			$mainPage = "ConfigurationOrders/board";
			$data = null;
			// Pinto la cabecera principal de las p�ginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
			// Pinto la informaci�n de los parametros de la aplicaci�n
			// Pinto la pantalla
			$data ['mainPage'] = $mainPage;
			// Pinto los permisos del tablero de control
			$data ['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard ( $this->session->userdata ( 'usuario' ), 'board', 201, '10' );
			$data ['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard ( $this->session->userdata ( 'usuario' ), 'board', 201, '11' );
			$usuRolper = $this->FunctionsGeneral->getFieldFromTableNotId ( "ADM_USUROLPER", "ID_ROLPERFIL", "ID_USUARIO", $this->session->userdata ( 'usuario' ) );
			$data ['idPerfil'] = $this->FunctionsGeneral->getFieldFromTableNotId ( "ADM_ROLPERFIL", "ID_PERFIL", "ID", $usuRolper );
			// Lista de listas
			$data ['listaLista'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ADM_ENCLISTA" );
			// Pinto plantilla principal
			$this->load->view ( 'system/listDefine/board', $data );
			// FIn de las plantillas
			$this->load->view ( 'validation/system/parametersValidation' );
			// Pinto el final de la p�gina (p�ginas internas
			showCommonEnds ( $this, null, null );
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	public function newList() {
		/**
		 * Formulario para pintar la inscripci�n de polizas del soat
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "ConfigurationOrdersPrueba/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Verifico si la informaci�n del contrato existe
			$mainPage = "ListDefine/board";
			showCommon ( null, $this, $mainPage, null, null );
			// Cargo la lista de asefuradoras
			$data ['valida'] = $this->encryption->encrypt ( 'newList' );
			$data ['id'] = null;
			$data ['nombre'] = null;
			$data ['registros'] = 1;
			$data ['detLista'] = null;
			// Pinto plantilla principal de la aplicaci�n en la posici�n actual
			$this->load->view ( 'system/listDefine/newList', $data );
			// Validaci�n de la p�gina
			$this->load->view ( 'validation/system/newListValidation' );
			// Pinto el final de la p�gina (p�ginas internas
			showCommonEnds ( $this, null, null );
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	public function editList($id) {
		/**
		 * Formulario para pintar la inscripci�n de polizas del soat
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "ConfigurationOrdersPrueba/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			$id = $this->encryption->decrypt ( $id );
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ADM_ENCLISTA", "ID", $id );
			if ($id != '') {
				// Verifico si la informaci�n del contrato existe
				$mainPage = "ListDefine/board";
				showCommon ( null, $this, $mainPage, 'ListDefine/newList' );
				// Cargo la lista de asefuradoras
				$data ['valida'] = $this->encryption->encrypt ( 'editList' );
				$data ['id'] = $this->encryption->encrypt ( $id );
				$data ['nombre'] = $this->FunctionsGeneral->getFieldFromTable ( "ADM_ENCLISTA", "NOMBRE", $id );
				$data ['detLista'] = $this->SystemModel->getListDet ( $id );
				$this->load->view ( 'system/listDefine/newList', $data );
				$this->load->view ( 'validation/system/newListValidation' );
				showCommonEnds ( $this, $mainPage );
			} else {
				// Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la p�gina
				redirect ( base_url () . "ListDefine/board" );
			}
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	
	/**
	 * RUTINAS PARA GUARDAR INFORMACI�N*
	 */
	public function saveList() {
		/**
		 * Guardo la informaci�n del nuevo usuario creado dentro del sistema
		 */
		$mainPage = "ConfigurationOrdersPrueba/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			if ($this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'valida' ) ) ) == 'newList') {
				$nombre = strtoupper ( $this->security->xss_clean ( $this->input->post ( 'nombre' ) ) );
				if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ADM_ENCLISTA", "NOMBRE", $nombre ) == 0) {
					// Creo el encabezado de la lista
					$idEncList = $this->SystemModel->insertEncList ( $nombre, $this->session->userdata ( 'usuario' ) );
					// Creo el detalle de la lista
					$registros = $this->security->xss_clean ( $this->input->post ( 'registros' ) );
					for($i = 1; $i <= $registros; $i ++) {
						$id = $this->SystemModel->insertDetList ( $idEncList, 1, $this->security->xss_clean ( $this->input->post ( 'valor' . $i ) ), $this->security->xss_clean ( $this->input->post ( 'nombre' . $i ) ), $this->session->userdata ( 'usuario' ) );
						// Actualizo el campo
						$this->FunctionsGeneral->updateByID ( "ADM_DETLISTA", "ID_LISTAVALOR", $id, $id, $this->session->userdata ( 'usuario' ) );
					}
					// Pagina a donde retornar� la informaci�n
					$mainPage = "ListDefine/board";
					// Pinto mensaje para retornar a la aplicaci�n
					$this->session->set_userdata ( 'id', $nombre );
					$this->session->set_userdata ( 'auxiliar', 'listUpdate' );
					// Redirecciono la p�gina
					redirect ( base_url () . $mainPage );
				} else {
					// Creo mensaje de creaci�n de usuario
					$mensaje = "listExist";
					// Pinto mensaje para retornar a la aplicaci�n
					$this->session->set_userdata ( 'id', $nombre );
					$this->session->set_userdata ( 'auxiliar', $mensaje );
					// Redirecciono la p�gina
					redirect ( base_url () . "ListDefine/board" );
				}
			} else {
				// Actualizo el nombre del campo
				$nombre = strtoupper ( $this->security->xss_clean ( $this->input->post ( 'nombre' ) ) );
				$id = $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'id' ) ) );
				// $id=$this->FunctionsGeneral->getFieldFromTable("ADM_ENCLISTA","ID",$id);
				
				$this->FunctionsGeneral->updateByID ( "ADM_ENCLISTA", "NOMBRE", $nombre, $id, $this->session->userdata ( 'usuario' ) );
				// Actualizo los valores
				$registros = $this->security->xss_clean ( $this->input->post ( 'registros' ) );
				for($i = 1; $i <= $registros; $i ++) {
					$id = $this->SystemModel->updateDetList ( $this->security->xss_clean ( $this->input->post ( 'id' . $i ) ), $this->security->xss_clean ( $this->input->post ( 'valor' . $i ) ), $this->security->xss_clean ( $this->input->post ( 'nombre' . $i ) ), $this->session->userdata ( 'usuario' ) );
				}
				// Pagina a donde retornar� la informaci�n
				$mainPage = "ListDefine/board";
				// Pinto mensaje para retornar a la aplicaci�n
				$this->session->set_userdata ( 'id', $nombre );
				$this->session->set_userdata ( 'auxiliar', 'listUpdate' );
				// Redirecciono la p�gina
				redirect ( base_url () . $mainPage );
			}
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	public function inactiveList($id) {
		/**
		 * Guardo la informaci�n de cambio de estado del registro dentro del sistema
		 */
		
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "ConfigurationOrdersPrueba/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Cargo informaci�n de la lista teniendo en cuenta el id dado
			// Obtengo el id del contacto
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ADM_ENCLISTA", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				$estado = $this->FunctionsGeneral->getFieldFromTable ( "ADM_ENCLISTA", "ESTADO", $id );
				if ($estado == 'S') {
					$estado = 'N';
				} else if ($estado == 'N') {
					$estado = 'S';
				}
				$message = 'changeStateGeneral';
				$this->FunctionsGeneral->updateByID ( "ADM_ENCLISTA", "ESTADO", $estado, $id, $this->session->userdata ( 'usuario' ) );
				// Pinto mensaje para retornar a la aplicaci�n
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', $message );
				// Redirecciono la p�gina
				redirect ( base_url () . "ListDefine/board" );
			} else {
				// Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la p�gina
				redirect ( base_url () . "ListDefine/board" );
			}
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
}
?>