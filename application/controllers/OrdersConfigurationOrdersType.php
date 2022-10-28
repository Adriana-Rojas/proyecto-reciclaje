<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para definir los diferentes tipos de árboles (clases de ordenes).
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class OrdersConfigurationOrdersType extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		// Cargo modelos, librerias y helpers
		$this->load->model ( 'OrdersModel' ); // Libreria principal de las funciones referentes a órdenes
	}
	
	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA PINTAR FORMULARIOS
	 * ****************************************************************************************************** *
	 */
	public function board() {
		/**
		 * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
		 */
		
		// Valido si la sessión existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
			$mainPage = "OrdersConfigurationOrdersType/board";
			$data = null;
			// Pinto la cabecera principal de las páginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
			// Pinto la información de los parametros de la aplicación
			
			/**
			 * Información relacionada con la plantilla principal Pinto la pantalla *
			 */
			$data ['mainPage'] = $mainPage;
			$data ['board'] = "Valores parametrizados";
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId ( "ADM_MODULO", "ID", "PAGINA", $mainPage );
			$data ['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard ( $this->session->userdata ( 'usuario' ), 'board', $idModule, VIEW_LIST_PERMISSION );
			$data ['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard ( $this->session->userdata ( 'usuario' ), 'board', $idModule, VIEW_BUTTON_PERMISSION );
			
			// Lista de listas
			$data ['listaLista'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_TIPOORDEN" );
			
			// Pinto plantilla principal
			// Pinto la lista genérica de parametros que se debe tener en cuenta dentro del sistema de parámetros
			$this->load->view ( 'common/boards/board', $data );
			
			/**
			 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
			 */
			
			// Pinto el final de la página (páginas internas)
			showCommonEnds ( $this, null, null );
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	public function newRegister() {
		/**
		 * Formulario para crear un nuevo registro del parametro
		 */
		// Valido si la sessión existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Cargo la página principal
			$mainPage = "OrdersConfigurationOrdersType/board";
			$data = null;
			// Pinto la cabecera principal de las páginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
			
			/**
			 * Información relacionada con la plantilla principal Pinto la pantalla *
			 */
			
			// Inicializo variables de la vista
			$data ['valida'] = $this->encryption->encrypt ( 'newRegister' );
			$data ['id'] = null;
			$data ['nombre'] = null;
			$data ['prioridad'] = null;
			$data ['clase'] = null;
			$data ['impresion'] = null;
			$data ['validado'] = null;
			$data ['clasificacion'] = null;
			$data ['maximo'] = null;
			
			
			$data ['prefijo'] = null;
			$data ['niveles'] = null;
			$data ['listaprioridad'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_PRIORTIPO", 'DESC' );
			$data ['listaclase'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_CLASETIPO", 'DESC' );
			$data ['listaimpresion'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_IMPTIPO", 'DESC' );
			$data ['listavalida'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_VALIDA", 'DESC' );
			$data ['listaclasificacion'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'CLAS_POS', '1' );
			$data ['iva'] =  null;
			$data['listaIva'] = $this->FunctionsAdmin->selectValoresListaAdministracion('IVA', '1');
			$data ['readOnly'] = "";
			$data ['mainPage'] = $mainPage;
			
			// Cargo vista
			$this->load->view ( 'orders/configuration/formOrdersType', $data );
			// Cargo validación de formulario
			$this->load->view ( 'validation/orders/configuration/ordersConfigurationOrdersTypeValidation' );
			
			/**
			 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
			 */
			
			// Pinto el final de la página (páginas internas)
			showCommonEnds ( $this, null, null );
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	
	public function edit($id) {
		/**
		 * Formulario para editar la información previamente creada para el parametro de la aplicación
		 */
		// Valido si la sessión existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				// Pinto las vistas adicionales a través de la función showCommon del helper
				$mainPage = "OrdersConfigurationOrdersType/board";
				$data = null;
				// Pinto la cabecera principal de las páginas internas
				showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
				
				/**
				 * Información relacionada con la plantilla principal Pinto la pantalla *
				 */
				
				// Inicializo variables de la vista
				$data ['valida'] = $this->encryption->encrypt ( 'edit' );
				$data ['id'] = $this->encryption->encrypt ( $id );
				$data ['nombre'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "NOMBRE", $id );
				$data ['prioridad'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "ID_PRIORTIPO", $id );
				$data ['clase'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "ID_CLASETIPO", $id );
				$data ['impresion'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "ID_IMPTIPO", $id );
				$data ['validado'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "ID_VALIDA", $id );
				$data ['clasificacion'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "POS", $id );
				$data ['prefijo'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "PREFIJO", $id );
				$data ['niveles'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "NIVELES", $id );
				$data ['listaprioridad'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_PRIORTIPO", 'DESC' );
				$data ['listaclase'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_CLASETIPO", 'DESC' );
				$data ['listaimpresion'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_IMPTIPO", 'DESC' );
				$data ['listavalida'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_VALIDA", 'DESC' );
				$data ['listaclasificacion'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'CLAS_POS', '1' );
				$data ['iva'] =  $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "IVA", $id );
				$data['listaIva'] = $this->FunctionsAdmin->selectValoresListaAdministracion('IVA', '1');
				
				$data ['maximo'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "MAXIMO", $id );
				;
				$data ['readOnly'] = "readOnly=\"readOnly\"";
				
				$data ['mainPage'] = $mainPage;
				
				// Cargo vista
				$this->load->view ( 'orders/configuration/formOrdersType', $data );
				// Cargo validación de formulario
				$this->load->view ( 'validation/orders/configuration/ordersConfigurationOrdersTypeValidation' );
				
				/**
				 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
				 */
				
				// Pinto el final de la página (páginas internas)
				showCommonEnds ( $this, null, null );
			} else {
				// Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la página
				redirect ( base_url () . "OrdersConfigurationOrdersType/board" );
			}
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	
	public function workGroup($id) {
		/**
		 * Formulario para editar la información previamente creada para el parametro de la aplicación
		 */
		// Valido si la sessión existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			$mainPage = "OrdersConfigurationOrdersType/board";
			
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				// Pinto las vistas adicionales a través de la función showCommon del helper
				$data = null;
				// Pinto la cabecera principal de las páginas internas
				showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
				
				/**
				 * Información relacionada con la plantilla principal Pinto la pantalla *
				 */
				
				// Inicializo variables de la vista
				$data ['valida'] = $this->encryption->encrypt ( 'edit' );
				$data ['idTipoOrden'] = $this->encryption->encrypt ( $id );
				$data ['id'] = $id;
				$data ['pagina'] = "OrdersConfigurationOrdersType/saveWorkGroup";
				$data ['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "NOMBRE", $id );
				$data ['listaPerfil'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ADM_PERFIL", 'ASC', ACTIVO_ESTADO );
				$data ['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'LISTA_GRUPO_TRABAJO', '1' );
				
				$data ['mainPage'] = $mainPage;
				
				// Cargo vista
				$this->load->view ( 'orders/configuration/formOrdersConfigurationWorkGroups', $data );
				// Cargo validación de formulario
				// $this->load->view('validation/orders/configuration/OrdersConfigurationWorkGroupsValidation');
				
				/**
				 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
				 */
				
				// Pinto el final de la página (páginas internas)
				showCommonEnds ( $this, null, null );
			} else {
				// Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la página
				redirect ( base_url () . $mainPage );
			}
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	
	public function helpTeam($id) {
		/**
		 * Formulario para editar la información previamente creada para el parametro de la aplicación
		 */
		// Valido si la sessión existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			$mainPage = "OrdersConfigurationOrdersType/board";
			
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				// Pinto las vistas adicionales a través de la función showCommon del helper
				$data = null;
				// Pinto la cabecera principal de las páginas internas
				showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
				
				/**
				 * Información relacionada con la plantilla principal Pinto la pantalla *
				 */
				
				// Inicializo variables de la vista
				$data ['valida'] = $this->encryption->encrypt ( 'edit' );
				$data ['idTipoOrden'] = $this->encryption->encrypt ( $id );
				$data ['id'] = $id;
				$data ['pagina'] = "OrdersConfigurationOrdersType/saveHelpTeam";
				$data ['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "NOMBRE", $id );
				$data ['listaPerfil'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ADM_PERFIL", 'ASC', ACTIVO_ESTADO );
				$data ['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'SI_NO', '1' );
				
				$data ['mainPage'] = $mainPage;
				
				// Cargo vista
				$this->load->view ( 'orders/configuration/formOrdersConfigurationHelpTeam', $data );
				// Cargo validación de formulario
				// $this->load->view('validation/orders/configuration/OrdersConfigurationWorkGroupsValidation');
				
				/**
				 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
				 */
				
				// Pinto el final de la página (páginas internas)
				showCommonEnds ( $this, null, null );
			} else {
				// Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la página
				redirect ( base_url () . $mainPage );
			}
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	
	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA GUARDAR INFORMACIÒN
	 * ****************************************************************************************************** *
	 */
	public function saveRegister() {
		/**
		 * Guardo la información del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
		 */
		$mainPage = "OrdersConfigurationOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Página principal a donde debo retornar
			$mainPage = "OrdersConfigurationOrdersType/board";
			$nombre = $this->security->xss_clean ( $this->input->post ( 'nombre' ) );
			if($this->security->xss_clean ( $this->input->post ( 'clase' ) )==3){
			    $niveles=0;
			}else{
			    $niveles=$this->security->xss_clean ( $this->input->post ( 'niveles' ) );
			}
			if ($this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'valida' ) ) ) == 'newRegister') {
				if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ORD_TIPOORDEN", "NOMBRE", $nombre ) == 0) {
					// Creo el registro
				    $id = $this->OrdersModel->insertOrdersType ( 
				        $nombre,
				        $this->security->xss_clean ( $this->input->post ( 'prioridad' ) ), 
				        $this->security->xss_clean ( $this->input->post ( 'clase' ) ), 
				        $this->security->xss_clean ( $this->input->post ( 'impresion' ) ), 
				        $this->security->xss_clean ( $this->input->post ( 'validado' ) ), 
				        $this->security->xss_clean ( $this->input->post ( 'clasificacion' ) ), 
				        $niveles, 
				        strtoupper ( $this->security->xss_clean ( $this->input->post ( 'prefijo' ) ) ), 
				        $this->security->xss_clean ( $this->input->post ( 'maximo' ) ), 
				        $this->security->xss_clean ( $this->input->post ( 'iva' ) ), 
				        $this->session->userdata ( 'usuario' ) );
					// Pinto mensaje para retornar a la aplicación
					$this->session->set_userdata ( 'id', $nombre );
					$this->session->set_userdata ( 'auxiliar', 'configUpdate' );
					// Redirecciono la página
					redirect ( base_url () . $mainPage );
				} else {
					// Creo mensaje de creaciòn de usuario
					$mensaje = "ConfigExist";
					// Pinto mensaje para retornar a la aplicación
					$this->session->set_userdata ( 'id', $nombre );
					$this->session->set_userdata ( 'auxiliar', $mensaje );
					// Redirecciono la página
					redirect ( base_url () . $mainPage );
				}
			} else {
				// Actualizo los valores para el parametro respectivo en la tabla dada
			    $this->OrdersModel->updateOrdersType ( 
			        $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'id' ) ) ), 
			        $nombre, 
			        $this->security->xss_clean ( $this->input->post ( 'prioridad' ) ), 
			        $this->security->xss_clean ( $this->input->post ( 'clase' ) ), 
			        $this->security->xss_clean ( $this->input->post ( 'impresion' ) ), 
			        $this->security->xss_clean ( $this->input->post ( 'validado' ) ), 
			        $this->security->xss_clean ( $this->input->post ( 'clasificacion' ) ), 
			        $niveles, 
			        strtoupper ( $this->security->xss_clean ( $this->input->post ( 'prefijo' ) ) ), 
			        $this->security->xss_clean ( $this->input->post ( 'maximo' ) ), 
			        $this->security->xss_clean ( $this->input->post ( 'iva' ) ), 
			        $this->session->userdata ( 'usuario' ) );
				
				// Pinto mensaje para retornar a la aplicación
				$this->session->set_userdata ( 'id', $nombre );
				$this->session->set_userdata ( 'auxiliar', 'configUpdate' );
				// Redirecciono la página
				redirect ( base_url () . $mainPage );
			}
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	public function inactive($id) {
		/**
		 * Inactivo el registro para el cual se tiene asociado el valor $id
		 */
		// Valido si la sessión existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Página principal a donde debo retornar
			$mainPage = "OrdersConfigurationOrdersType/board";
			
			// Cargo información de la lista teniendo en cuenta el id dado
			// Obtengo el id del contacto
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				$estado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "ESTADO", $id );
				if ($estado == 'S') {
					$estado = 'N';
				} else if ($estado == 'N') {
					$estado = 'S';
				}
				$message = 'changeStateGeneral';
				$this->FunctionsGeneral->updateByID ( "ORD_TIPOORDEN", "ESTADO", $estado, $id, $this->session->userdata ( 'usuario' ) );
				// Pinto mensaje para retornar a la aplicación
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', $message );
				// Redirecciono la página
				redirect ( base_url () . $mainPage );
			} else {
				// Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la página
				redirect ( base_url () . $mainPage );
			}
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	public function saveWorkGroup() {
		/**
		 * Guardo la información del equipo que puede estar dentro del proceso de la orden
		 */
		$mainPage = "OrdersConfigurationOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Página principal a donde debo retornar
			$mainPage = "OrdersConfigurationOrdersType/board";
			$idTipoOrden = $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'idTipoOrden' ) ) );
			if ($this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'valida' ) ) ) == 'edit') {
				// Verifico si la relación del tipo de orden existe
				if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ORD_DEFEQUIPO", "ID_TIPOORDEN", $idTipoOrden ) == 0) {
					// Debo crear el registro
					$id = $this->OrdersModel->insertWorkGroups ( $idTipoOrden, $this->session->userdata ( 'usuario' ) );
				} else {
					// Obtengo el id
					$id = $this->FunctionsGeneral->getFieldFromTableNotId ( "ORD_DEFEQUIPO", "ID", "ID_TIPOORDEN", $idTipoOrden );
				}
				// Elimino relaciones del grupo de trabajo
				$this->OrdersModel->deleteWorkGruops ( $id );
				// Inserto relaciones del grupo de trabajo
				$perfiles = $this->FunctionsGeneral->selectValoresListaTabla ( "ADM_PERFIL", 'ASC', ACTIVO_ESTADO );
				
				foreach ( $perfiles->result () as $valuePerfil ) {
					$tempo = 'perfil' . $valuePerfil->ID;
					$select = $this->security->xss_clean ( $this->input->post ( $tempo ) );
					if ($select != GRUPO_NO_REQUERIDO) {
						// Obtengo el rol perfil
						$rolPerfil = $this->FunctionsGeneral->getFieldFromTableNotIdFields ( "ADM_ROLPERFIL", "ID", "ID_PERFIL", $valuePerfil->ID, "ID_ROL", 1 );
						
						if ($select == GRUPO_OBLIGATORIO) {
							$obligatorio = CTE_VALOR_SI;
						} else {
							$obligatorio = CTE_VALOR_NO;
						}
						// Inserto el registro hijo
						$this->OrdersModel->insertWorkGroupsRol ( $id, $rolPerfil, $obligatorio, $this->session->userdata ( 'usuario' ) );
					}
				}
				
				// Pinto mensaje para retornar a la aplicación
				$this->session->set_userdata ( 'id', null );
				$this->session->set_userdata ( 'auxiliar', 'workGroupOk' );
				// Redirecciono la página
				redirect ( base_url () . $mainPage );
			} else {
				// Retorno a la página principal
				header ( "Location: " . base_url () );
			}
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
	public function saveHelpTeam() {
		/**
		 * Guardo la información del equipo que apoya en el proceso de formulación
		 */
		$mainPage = "OrdersConfigurationOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Página principal a donde debo retornar
			$mainPage = "OrdersConfigurationOrdersType/board";
			$idTipoOrden = $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'idTipoOrden' ) ) );
			if ($this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'valida' ) ) ) == 'edit') {
				// Verifico si la relación del tipo de orden existe
				if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ORD_DEFEQUIPOORDEN", "ID_TIPOORDEN", $idTipoOrden ) == 0) {
					// Debo crear el registro
					$id = $this->OrdersModel->insertWorkGroupsOrder ( $idTipoOrden, $this->session->userdata ( 'usuario' ) );
				} else {
					// Obtengo el id
					$id = $this->FunctionsGeneral->getFieldFromTableNotId ( "ORD_DEFEQUIPOORDEN", "ID", "ID_TIPOORDEN", $idTipoOrden );
				}
				// Elimino relaciones del grupo de trabajo
				$this->OrdersModel->deleteWorkGruopsOrder ( $id );
				// Inserto relaciones del grupo de trabajo
				$perfiles = $this->FunctionsGeneral->selectValoresListaTabla ( "ADM_PERFIL", 'ASC', ACTIVO_ESTADO );
				
				foreach ( $perfiles->result () as $valuePerfil ) {
					$tempo = 'perfil' . $valuePerfil->ID;
					$select = $this->security->xss_clean ( $this->input->post ( $tempo ) );
					if ($select != CTE_VALOR_NO) {
						// Obtengo el rol perfil
						$rolPerfil = $this->FunctionsGeneral->getFieldFromTableNotIdFields ( "ADM_ROLPERFIL", "ID", "ID_PERFIL", $valuePerfil->ID, "ID_ROL", 1 );
						// Inserto el registro hijo
						$this->OrdersModel->insertWorkGroupsRolOrder ( $id, $rolPerfil, $select, $this->session->userdata ( 'usuario' ) );
					}
				}
				
				// Pinto mensaje para retornar a la aplicación
				$this->session->set_userdata ( 'id', null );
				$this->session->set_userdata ( 'auxiliar', 'workGroupOk' );
				// Redirecciono la página
				redirect ( base_url () . $mainPage );
			} else {
				// Retorno a la página principal
				header ( "Location: " . base_url () );
			}
		} else {
			// Retorno a la página principal
			header ( "Location: " . base_url () );
		}
	}
}

?>