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
class OrdersConfigurationStatesOrdersType extends CI_Controller {
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
		$mainPage = "OrdersConfigurationStatesOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
			$mainPage = "OrdersConfigurationStatesOrdersType/board";
			
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
			$data ['listaProceso'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_PROCESO" );
			$data ['listaTipo'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_TIPOORDEN" );
			// Valores de las variables respectivas
			if ($this->security->xss_clean ( $this->input->post ( 'proceso' ) ) != '') {
				$proceso = $this->security->xss_clean ( $this->input->post ( 'proceso' ) );
			} else {
				$proceso = $this->session->userdata ( 'variable1' );
			}
			
			if ($proceso != '') {
				$this->session->set_userdata ( 'variable1', $proceso );
			} else {
				$this->session->set_userdata ( 'variable1', '' );
			}
			
			if ($this->security->xss_clean ( $this->input->post ( 'tipo' ) ) != '') {
				$tipo = $this->security->xss_clean ( $this->input->post ( 'tipo' ) );
			} else {
				$tipo = $this->session->userdata ( 'variable2' );
			}
			if ($tipo != '') {
				$this->session->set_userdata ( 'variable2', $tipo );
			} else {
				$this->session->set_userdata ( 'variable2', '' );
			}
			if(is_numeric($this->session->userdata ( 'variable1' ))){
			    $variable1=$this->session->userdata ( 'variable1' );
			}else{
			    $variable1='';
			}
			if(is_numeric($this->session->userdata ( 'variable2' ))){
			    $variable2=$this->session->userdata ( 'variable2' );
			}else{
			    $variable2='';
			}
			$data ['proceso'] = $variable1;
			$data ['tipo'] = $variable2;
			$data ['pagina'] = $mainPage;
			if ($data ['proceso'] == '' || $data ['tipo'] == '') {
				$data ['listaLista'] = null;
			} else {
				$data ['listaLista'] = $this->OrdersModel->selectStatesOrdersTypeProcess ( $data ['proceso'], $data ['tipo'] );
			}
			
			$data ['procesoId'] = $this->encryption->encrypt ( $this->session->userdata ( 'variable1' ) );
			$data ['tipoId'] = $this->encryption->encrypt ( $this->session->userdata ( 'variable2' ) );
			
			// Pinto plantilla principal
			// Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
			$this->load->view ( 'orders/configuration/boardStatesOrdersTypeProcess', $data );
			// Cargo validaci�n de formulario
			$this->load->view ( 'validation/orders/configuration/ordersConfigurationStatesOrdersTypeValidationInBoard' );
			
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
	public function newRegister($proceso = null, $tipo = null) {
		/**
		 * Formulario para crear un nuevo registro del parametro
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationStatesOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Cargo la p�gina principal
			$mainPage = "OrdersConfigurationStatesOrdersType/board";
			$data = null;
			// Pinto la cabecera principal de las p�ginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
			
			/**
			 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
			 */
			
			// Inicializo variables de la vista
			$data ['valida'] = $this->encryption->encrypt ( 'newRegister' );
			$data ['tempo'] = 'newRegister';
			$data ['id'] = null;
			$data ['proceso'] = $this->encryption->decrypt ( $proceso );
			$data ['procesoNombre'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_PROCESO", "NOMBRE", $data ['proceso'] );
			$data ['tipo'] = $this->encryption->decrypt ( $tipo );
			$data ['tipoNombre'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "NOMBRE", $data ['tipo'] );
			$data ['tipoOrden'] = $this->FunctionsGeneral->getFieldFromTableNotIdFields ( "ORD_TORDPRO", "ID", "ID_TIPOORDEN", $data ['tipo'], "ID_PROCESO", $data ['proceso'] );
			$data ['bajoMin'] = null;
			$data ['estado'] = null;
			$data ['bajoMax'] = null;
			$data ['medioMin'] = null;
			$data ['medioMax'] = null;
			$data ['altoMin'] = null;
			$data ['altoMax'] = null;
			$data ['bColor'] = null;
			$data ['mColor'] = null;
			$data ['aColor'] = null;
			// Lista de listas
			$data ['listaProceso'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_PROCESO" );
			$data ['listaTipo'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_TIPOORDEN" );
			$data ['listaEstado'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ORD_ESTADOS" );
			
			// Inicializo variables de los campos del formulario
			$data ['pagina'] = "OrdersConfigurationStatesOrdersType/saveRegister";
			$data ['mainPage'] = $mainPage;
			
			// Cargo vista
			$this->load->view ( 'orders/configuration/formOrdersConfigurationStatesOrdersType', $data );
			
			// Cargo validaci�n de formulario
			$this->load->view ( 'validation/orders/configuration/ordersConfigurationStatesOrdersTypeValidation' );
			
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
		$mainPage = "OrdersConfigurationStatesOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				// Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
				$mainPage = "OrdersConfigurationStatesOrdersType/board";
				$data = null;
				// Pinto la cabecera principal de las p�ginas internas
				showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
				
				/**
				 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
				 */
				
				// Inicializo variables de la vista
				$data ['valida'] = $this->encryption->encrypt ( 'edit' );
				$data ['tempo'] = 'edit';
				$data ['id'] = $this->encryption->encrypt ( $id );
				//echo "<script>console.log('id: " . $data ['id'] . "' );</script>";
				// Obtengo el ide de la relaci�n de proceso y tipo de orden
				$idTordPro = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_TORDPRO", $id );
				//echo "<script>console.log('idTordPro: " . $idTordPro . "' );</script>";
				// Obtengo el proceso
				$proceso = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPRO", "ID_PROCESO", $idTordPro );
				//echo "<script>console.log('proceso: " . $proceso . "' );</script>";
				$data ['proceso'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_PROCESO", "NOMBRE", $proceso );
				//echo "<script>console.log('proceso: " . $data ['proceso'] . "' );</script>";
				// obtengo el tipo de orden
				$tipo = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPRO", "ID_TIPOORDEN", $idTordPro );
				//echo "<script>console.log('idEstado: " . $tipo . "' );</script>";
				$data ['tipo'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "NOMBRE", $tipo );
				//echo "<script>console.log('estado: " . $data ['tipo'] . "' );</script>";
				// Obtengo la informaci�n del estado
				$idEstado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_ESTADO", $id );
				//echo "<script>console.log('idEstado: " . $idEstado . "' );</script>";
				$data ['estado'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_ESTADOS", "NOMBRE", $idEstado );
				//echo "<script>console.log('estado: " . $data ['estado'] . "' );</script>";

				// Pinto los valores de los diferentes tiempos
				$data ['bajoMin'] = $this->FunctionsGeneral->getFieldFromTable ("ORD_TORDPROEST", "BMIN", $id );
				$data ['bajoMax'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "BMAX", $id );
				$data ['medioMin'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "MMIN", $id );
				$data ['medioMax'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "MMAX", $id );
				$data ['altoMin'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "AMIN", $id );
				$data ['altoMax'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "AMAX", $id );
				$data ['aColor'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ACOLOR", $id );
				$data ['mColor'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "MCOLOR", $id );
				$data ['bColor'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "BCOLOR", $id );
			
				// Inicializo variables de los campos del formulario
				$data ['pagina'] = "OrdersConfigurationStatesOrdersType/saveRegister";
				$data ['mainPage'] = $mainPage;
				// Cargo vista
				$this->load->view ( 'orders/configuration/formOrdersConfigurationStatesOrdersType', $data );
				// Cargo validaci�n de formulario
				$this->load->view ( 'validation/orders/configuration/ordersConfigurationStatesOrdersTypeValidation' );
				
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
				redirect ( base_url () . "OrdersConfigurationStatesOrdersType/board" );
			}
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	public function statesRelation($id) {
		/**
		 * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationStatesOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				// Verifico el estado del estado dentro de la relaci�n
				
				if ($this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ESTADO", $id ) != INACTIVO_ESTADO) {
					// Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
					$mainPage = "OrdersConfigurationStatesOrdersType/board";
					$data = null;
					// Pinto la cabecera principal de las p�ginas internas
					showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
					
					//echo $id;
					/**
					 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
					 */
					
					// Inicializo variables de la vista
					$data ['valida'] = $this->encryption->encrypt ( 'edit' );
					$data ['tempo'] = 'edit';
					$data ['id'] = $this->encryption->encrypt ( $id );
					$data ['idTordProEst'] = $id;
					// Obtengo el ide de la relaci�n de proceso y tipo de orden
					$idTordPro = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_TORDPRO", $id );
					// Obtengo el proceso
					$proceso = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPRO", "ID_PROCESO", $idTordPro );
					$data ['proceso'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_PROCESO", "NOMBRE", $proceso );
					// obtengo el tipo de orden
					$tipo = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPRO", "ID_TIPOORDEN", $idTordPro );
					$data ['tipo'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "NOMBRE", $tipo );
					// Obtengo la informaci�n del estado
					$idEstado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_ESTADO", $id );
					$data ['estado'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_ESTADOS", "NOMBRE", $idEstado );
					
					// Pinto lista de estados relacionados
					$data ['listEstado'] = $this->OrdersModel->selectStatesOrdersTypeProcessWithFilter ( $idEstado, $tipo, $proceso );
					
					// Inicializo variables de los campos del formulario
					$data ['pagina'] = "OrdersConfigurationStatesOrdersType/saveStateRelation";
					$data ['mainPage'] = $mainPage;
					// Cargo vista
					$this->load->view ( 'orders/configuration/formOrdersConfigurationStatesOrdersTypeRelationStates', $data );
					
					/**
					 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
					 */
					
					// Pinto el final de la p�gina (p�ginas internas)
					showCommonEnds ( $this, null, null );
				} else {
					// Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
					$idEstado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_ESTADO", $id );
					$this->session->set_userdata ( 'id', $this->FunctionsGeneral->getFieldFromTable ( "ORD_ESTADOS", "NOMBRE", $idEstado ) );
					$this->session->set_userdata ( 'auxiliar', "inactiveState" );
					// Redirecciono la p�gina
					redirect ( base_url () . "OrdersConfigurationStatesOrdersType/board" );
				}
			} else {
				// Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la p�gina
				redirect ( base_url () . "OrdersConfigurationStatesOrdersType/board" );
			}
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	public function statesPass($id) {
		/**
		 * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationStatesOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				// Verifico el estado del estado dentro de la relaci�n
				
				if ($this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ESTADO", $id ) != INACTIVO_ESTADO) {
					// Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
					$mainPage = "OrdersConfigurationStatesOrdersType/board";
					$data = null;
					// Pinto la cabecera principal de las p�ginas internas
					showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
					
					/**
					 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
					 */
					
					// Inicializo variables de la vista
					$data ['valida'] = $this->encryption->encrypt ( 'edit' );
					$data ['tempo'] = 'edit';
					$data ['id'] = $this->encryption->encrypt ( $id );
					$data ['idTordProEst'] = $id;
					// Obtengo el ide de la relaci�n de proceso y tipo de orden
					$idTordPro = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_TORDPRO", $id );
					// Obtengo el proceso
					$proceso = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPRO", "ID_PROCESO", $idTordPro );
					$data ['proceso'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_PROCESO", "NOMBRE", $proceso );
					// obtengo el tipo de orden
					$tipo = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPRO", "ID_TIPOORDEN", $idTordPro );
					$data ['tipo'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TIPOORDEN", "NOMBRE", $tipo );
					// Obtengo la informaci�n del estado
					$idEstado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_ESTADO", $id );
					$data ['estado'] = $this->FunctionsGeneral->getFieldFromTable ( "ORD_ESTADOS", "NOMBRE", $idEstado );
					
					// Pinto lista de los roles seleccionados
					$data ['listaPerfil'] = $this->FunctionsGeneral->selectValoresListaTabla ( "ADM_PERFIL", 'ASC', ACTIVO_ESTADO );
					$data ['listaOpcion'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'OPCION_ROLES_ESTADO', '1' );
					$data ['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion ( 'SI_NO', '1' );
					
					// Inicializo variables de los campos del formulario
					$data ['pagina'] = "OrdersConfigurationStatesOrdersType/saveStateRelationPass";
					$data ['mainPage'] = $mainPage;
					// Cargo vista
					$this->load->view ( 'orders/configuration/formOrdersConfigurationStatesOrdersTypeRelationPass', $data );
					
					/**
					 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
					 */
					
					// Pinto el final de la p�gina (p�ginas internas)
					showCommonEnds ( $this, null, null );
				} else {
					// Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
					$idEstado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_ESTADO", $id );
					$this->session->set_userdata ( 'id', $this->FunctionsGeneral->getFieldFromTable ( "ORD_ESTADOS", "NOMBRE", $idEstado ) );
					$this->session->set_userdata ( 'auxiliar', "inactiveState" );
					// Redirecciono la p�gina
					redirect ( base_url () . "OrdersConfigurationStatesOrdersType/board" );
				}
			} else {
				// Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
				$this->session->set_userdata ( 'id', $id );
				$this->session->set_userdata ( 'auxiliar', "notInformationGeneral" );
				// Redirecciono la p�gina
				redirect ( base_url () . "OrdersConfigurationStatesOrdersType/board" );
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
		$mainPage = "OrdersConfigurationStatesOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// P�gina principal a donde debo retornar
			$mainPage = "OrdersConfigurationStatesOrdersType/board";
			if ($this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'valida' ) ) ) == 'newRegister') {
				// Valido si el la relaci�n de proceso y tipo de orden existe
				$proceso = $this->security->xss_clean ( $this->input->post ( 'proceso' ) );
				$tipo = $this->security->xss_clean ( $this->input->post ( 'tipo' ) );
				$estado = $this->security->xss_clean ( $this->input->post ( 'estado' ) );
				// Busco la relaci�n entre el tipo de orden y el proceso
				$tordPro = $this->FunctionsGeneral->getFieldFromTableNotIdFields ( "ORD_TORDPRO", "ID", "ID_PROCESO", $proceso, "ID_TIPOORDEN", $tipo );
				if ($tordPro == '') {
					// Debo crear una nueva relaci�n de tipo de orden vs proceso
					$tordPro = $this->OrdersModel->insertProcessOrderTypeRelation ( $proceso, $tipo, $this->session->userdata ( 'usuario' ) );
				}
				// Valido que la relaci�n definida en $tordPro no exista en con el estado
				if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ORD_TORDPROEST", "ID_TORDPRO", $tordPro, "ID_ESTADO", $estado ) == 0) {
					// Realizo el insert
					if($estado!=STATE_CANCEL ||$estado!=STATE_CORRECT ||$estado!=STATE_SUSPEND ){
						$altoMin=$this->security->xss_clean ( $this->input->post ( 'altoMin' ) );
						$altoMax=$this->security->xss_clean ( $this->input->post ( 'altoMax' ) );
						$altoMin=$this->security->xss_clean ( $this->input->post ( 'medioMin' ) ); 
						$medioMin=$this->security->xss_clean ( $this->input->post ( 'medioMax' ) );
						$bajoMin=$this->security->xss_clean ( $this->input->post ( 'bajoMin' ) );
						$bajoMax=$this->security->xss_clean ( $this->input->post ( 'bajoMax' ) );
						$aColor=$this->security->xss_clean ( $this->input->post ( 'aColor' ) );
						$mColor=$this->security->xss_clean ( $this->input->post ( 'mColor' ) );
						$bColor=$this->security->xss_clean ( $this->input->post ( 'bColor' ) );
						
					}else{
						$altoMin=$altoMax=$altoMin=$medioMin=$bajoMin=$bajoMax=1;
						//$aColor=$mColor=$bColor='#000000';
					}
					
					$this->OrdersModel->insertProcessOrderTypeStateRelation( 
						$tordPro, 
						$estado, 
						$this->security->xss_clean ( $this->input->post ( 'altoMin' ) ), 
						$this->security->xss_clean ( $this->input->post ( 'altoMax' ) ), 
						$this->security->xss_clean ( $this->input->post ( 'medioMin' ) ), 
						$this->security->xss_clean ( $this->input->post ( 'medioMax' ) ), 
						$this->security->xss_clean ( $this->input->post ( 'bajoMin' ) ), 
						$this->security->xss_clean ( $this->input->post ( 'bajoMax' ) ), 
						$this->security->xss_clean ( $this->input->post ( 'aColor' ) ), 
						$this->security->xss_clean ( $this->input->post ( 'mColor' ) ), 
						$this->security->xss_clean ( $this->input->post ( 'bColor' ) ), 
						$this->session->userdata ( 'usuario' ) );
					// Relaciono que la relaci�n ya existe dentro del sistema
					$mensaje = "NewRelation";
				} else {
					// Relaciono que la relaci�n ya existe dentro del sistema
					$mensaje = "RelationExist";
				}
				// Pinto mensaje para retornar a la aplicaci�n
				$this->session->set_userdata ( 'id', null );
				$this->session->set_userdata ( 'auxiliar', $mensaje );
				// Redirecciono la p�gina
				redirect ( base_url () . $mainPage );
			} else {
				// Actualizo los valores para el parametro respectivo en la tabla dada
				$this->OrdersModel->updateProcessOrderTypeStateRelation ( 
					$this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'id' ) ) ), 
					 
					$this->security->xss_clean ( $this->input->post ( 'altoMin' ) ), 
					$this->security->xss_clean ( $this->input->post ( 'altoMax' ) ),
					$this->security->xss_clean ( $this->input->post ( 'medioMin' ) ), 
					$this->security->xss_clean ( $this->input->post ( 'medioMax' ) ), 
					$this->security->xss_clean ( $this->input->post ( 'bajoMin' ) ), 
					$this->security->xss_clean ( $this->input->post ( 'bajoMax' ) ),
					$this->session->userdata ( 'usuario' ), 
					$this->security->xss_clean ( $this->input->post ( 'aColor' ) ), 
					$this->security->xss_clean ( $this->input->post ( 'mColor' ) ),
					$this->security->xss_clean ( $this->input->post ( 'bColor' ) ));
					//$this->session->userdata ( 'usuario' ));
				
				// Pinto mensaje para retornar a la aplicaci�n
				$this->session->set_userdata ( 'id', null );
				$this->session->set_userdata ( 'auxiliar', 'UpdateRelation' );
				// Redirecciono la p�gina
				redirect ( base_url () . $mainPage );
			}
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	public function saveStateRelation() {
		/**
		 * Rutina para guardar la informaci�n relacionada a los estados para el tipo de proceso y tipo de orden
		 */
		$mainPage = "OrdersConfigurationStatesOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// P�gina principal a donde debo retornar
			$mainPage = "OrdersConfigurationStatesOrdersType/board";
			$id = $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'id' ) ) );
			echo $id;
			// Obtengo el ide de la relaci�n de proceso y tipo de orden
			$idTordPro = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_TORDPRO", $id );
			// Obtengo el proceso
			$proceso = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPRO", "ID_PROCESO", $idTordPro );
			// obtengo el tipo de orden
			$tipo = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPRO", "ID_TIPOORDEN", $idTordPro );
			// Obtengo la informaci�n del estado
			$idEstado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_ESTADO", $id );
			// Inactivo relaciones existentes
			$this->FunctionsGeneral->updateByField ( "ORD_RELESTADO", "ESTADO", INACTIVO_ESTADO, "ID_INICIO", $id, $this->session->userdata ( 'usuario' ) );
			
			// Pinto lista de estados relacionados
			$listEstado = $this->OrdersModel->selectStatesOrdersTypeProcessWithFilter ( $idEstado, $tipo, $proceso );
			foreach ( $listEstado as $value ) {
				$tempo = $this->security->xss_clean ( $this->input->post ( 'estado' . $value->ID ) );
				if ($tempo != 0) {
					if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ORD_RELESTADO", "ID_INICIO", $id, "ID_FIN", $value->ID, "ORDEN", $tempo ) == 0) {
						// Inserto registro
						$this->OrdersModel->insertStatesRelation ( $id, $value->ID, $tempo, $this->session->userdata ( 'usuario' ) );
					} else {
						// Actualizo registro
						$this->FunctionsGeneral->updateByField ( "ORD_RELESTADO", "ESTADO", ACTIVO_ESTADO, "ID_INICIO", $id, $this->session->userdata ( 'usuario' ), "ID_FIN", $value->ID );
						$this->FunctionsGeneral->updateByField ( "ORD_RELESTADO", "ORDEN", $tempo, "ID_INICIO", $id, $this->session->userdata ( 'usuario' ), "ID_FIN", $value->ID );
					}
				}
			}
			// Pinto mensaje para retornar a la aplicaci�n
			$this->session->set_userdata ( 'id', null );
			$this->session->set_userdata ( 'auxiliar', 'newStatesRelation' );
			// Redirecciono la p�gina
			redirect ( base_url () . $mainPage );
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	public function saveStateRelationPass() {
		/**
		 * Rutina para guardar la informaci�n relacionada a los permisos por estado para el tipo de proceso y tipo de orden
		 */
		$mainPage = "OrdersConfigurationStatesOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// P�gina principal a donde debo retornar
			$mainPage = "OrdersConfigurationStatesOrdersType/board";
			$id = $this->encryption->decrypt ( $this->security->xss_clean ( $this->input->post ( 'id' ) ) );
			
			// Obtengo el ide de la relaci�n de proceso y tipo de orden
			$idTordPro = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_TORDPRO", $id );
			// Obtengo el proceso
			$proceso = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPRO", "ID_PROCESO", $idTordPro );
			// obtengo el tipo de orden
			$tipo = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPRO", "ID_TIPOORDEN", $idTordPro );
			// Obtengo la informaci�n del estado
			$idEstado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID_ESTADO", $id );
			// Inactivo relaciones existentes
			$this->FunctionsGeneral->updateByField ( "ORD_TORDPROESTPER", "ESTADO", INACTIVO_ESTADO, "ID_TORDPROEST", $id, $this->session->userdata ( 'usuario' ) );
			
			// Pinto lista de estados relacionados
			$listaPerfil = $this->FunctionsGeneral->selectValoresListaTabla ( "ADM_PERFIL", 'ASC', ACTIVO_ESTADO );
			foreach ( $listaPerfil->result () as $value ) {
				$perfil = $this->security->xss_clean ( $this->input->post ( 'perfil' . $value->ID ) );
				$tempo = $this->security->xss_clean ( $this->input->post ( 'opcion' . $value->ID ) );
				$correo = $this->security->xss_clean ( $this->input->post ( 'correo' . $value->ID ) );
				// identifico el id previamente creado
				$idPermiso = $this->FunctionsGeneral->getFieldFromTableNotIdFields ( "ORD_TORDPROESTPER", "ID", "ID_TORDPROEST", $id, "ID_PERFIL", $perfil );
				if ($tempo != CTE_NOSEGUIMIENTO) {
					// Verifico cantidades de registros
					if ($this->FunctionsGeneral->getQuantityFieldFromTable ( "ORD_TORDPROESTPER", "ID_TORDPROEST", $id, "ID_PERFIL", $perfil ) == 0) {
						// Realizo el insert
						$this->OrdersModel->insertStatesRelationPass ( $id, $perfil, $tempo, $correo, $this->session->userdata ( 'usuario' ) );
					} else {
						
						// Actualiz� estado
						$this->FunctionsGeneral->updateByID ( "ORD_TORDPROESTPER", "ESTADO", ACTIVO_ESTADO, $idPermiso, $this->session->userdata ( 'usuario' ) );
						// Actualiz� permiso
						$this->FunctionsGeneral->updateByID ( "ORD_TORDPROESTPER", "PERMISO", $tempo, $idPermiso, $this->session->userdata ( 'usuario' ) );
						// Actualiz� correo
						$this->FunctionsGeneral->updateByID ( "ORD_TORDPROESTPER", "CORREO", $correo, $idPermiso, $this->session->userdata ( 'usuario' ) );
					}
				}else{
					// Actualiz� estado
					$this->FunctionsGeneral->updateByID ( "ORD_TORDPROESTPER", "ESTADO", INACTIVO_ESTADO, $idPermiso, $this->session->userdata ( 'usuario' ) );
					// Actualiz� permiso
					$this->FunctionsGeneral->updateByID ( "ORD_TORDPROESTPER", "PERMISO", $tempo, $idPermiso, $this->session->userdata ( 'usuario' ) );
						
				}
			}
			// Pinto mensaje para retornar a la aplicaci�n
			$this->session->set_userdata ( 'id', null );
			$this->session->set_userdata ( 'auxiliar', 'newPassStatesRelation' );
			// Redirecciono la p�gina
			redirect ( base_url () . $mainPage );
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
		$mainPage = "OrdersConfigurationStatesOrdersType/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// P�gina principal a donde debo retornar
			$mainPage = "OrdersConfigurationStatesOrdersType/board";
			
			// Cargo informaci�n de la lista teniendo en cuenta el id dado
			// Obtengo el id del contacto
			$id = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				$estado = $this->FunctionsGeneral->getFieldFromTable ( "ORD_TORDPROEST", "ESTADO", $id );
				if ($estado == 'S') {
					$estado = 'N';
					//Elimino relaciones creadas con anterioridad
					$this->OrdersModel->deleteOrdersRelation($id);
				} else if ($estado == 'N') {
					$estado = 'S';
				}
				



				$message = 'changeStateGeneral';
				$this->FunctionsGeneral->updateByID ( "ORD_TORDPROEST", "ESTADO", $estado, $id, $this->session->userdata ( 'usuario' ) );
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
