<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electronico:          	jcescobarba@gmail.com
 Creacion:                    	27/02/2018
 Modificacion:                	21/01/2019
 Proposito:						Controlador para la gestion de ordenes en el proceso de ordenar.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTo COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');
class OrdersAppOrder extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Cargo modelos, librerias y helpers
		$this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a ordenes
		$this->load->model('EsaludModel'); // Libreria principal de las funciones referentes a la lectura de informacion del sistema ESALUD
		$this->load->model('SystemModel'); // Librerias del sistema
	}

	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA PINTAR FORMULARIOS
	 * ****************************************************************************************************** *
	 */

	public function selectBrigade()
	{ // TODO
		/**
		 * Presenta la seleccion de las brigadas para que se pueda realizar la formulacion de estas.
		 */
		$this->load->model('BrigadesModel');
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = "OrdersAppOrder/selectBrigade";
			$data = null;
			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion

			/**
			 * Informacion relacionada con la plantilla principal Pinto la pantalla *
			 */
			$data['mainPage'] = $mainPage;
			$data['board'] = "Valores parametrizados";
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'selectBrigade', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'selectBrigade', $idModule, VIEW_BUTTON_PERMISSION);

			// Lista de listas
			$condicion = "AND BRI_BRIGADA.ID_FASEBRIG='1'";
			$data['listaLista'] = $this->BrigadesModel->selectListBrigades($condicion);
			// Defino el valor siguiente
			$this->session->set_userdata('action', 'order');

			// Pinto plantilla principal
			// Pinto la lista genorica de parametros que se debe tener en cuenta dentro del sistema de parometros
			$this->load->view('brigades/boardToOrder', $data);

			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function selectPartner()
	{
		/**
		 * Presenta la seleccion de las brigadas para que se pueda realizar la formulacion de estas.
		 */

		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = "OrdersAppOrder/selectPartner";
			$data = null;
			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion

			/**
			 * Informacion relacionada con la plantilla principal Pinto la pantalla *
			 */
			$data['mainPage'] = $mainPage;

			$data['pagina'] = "OrdersAppOrder/board";
			$data['board'] = "Valores parametrizados";
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'selectPartner', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'selectPartner', $idModule, VIEW_BUTTON_PERMISSION);

			// Lista de listas
			$data['listaLista'] = $this->FunctionsAdmin->selectEmpresaAliada();
			// Defino el valor siguiente
			$this->session->set_userdata('action', 'order');

			// Pinto plantilla principal
			// Pinto la lista genorica de parametros que se debe tener en cuenta dentro del sistema de parometros
			$this->load->view('system/partnerDefine/boardToOrder', $data);

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function paintSearch()
	{
		/**
		 * Direcciona la busqueda para los procesos normales en ordenar.
		 */

		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Redirecciono a la pogina principal, indicando que es una busqueda para ordenar
			$mainPage = "OrdersAppOrder/board/";
			// Defino el valor siguiente
			$this->session->set_userdata('action', 'order');
			// Redirecciono
			$redirect = $mainPage . $this->encryption->encrypt(NORMAL_PROCESS . "|" . $value->ID);
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function traceOrder()
	{
		/**
		 * Direcciona la busqueda para los procesos normales en ordenar.
		 */

		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Redirecciono a la pogina principal, indicando que es una busqueda para ordenar
			$mainPage = "OrdersAppOrder/board/";
			// Defino el valor siguiente
			$this->session->set_userdata('action', 'trace');
			$passPage = "OrdersAppOrder/traceOrder";
			$this->session->set_userdata('pagina', $passPage);
			// Redirecciono
			$redirect = $mainPage;
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function board($proceso = null)
	{
		/**
		 * Presenta el formulario para la busqueda inicial de los pacientes a travos del nomero de historia, documento de identificacion o nombres
		 */

		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			$data = null;
			// Tomo los valores del arreglo de proceso para definir la accion a continuar
			if ($proceso != null) {
				$array = explode("|", $this->encryption->decrypt($proceso));
			} else {
				$array[0] = '';
			}

			// Defino valores de ingreso
			if ($array[0] != '') {
				$proceso = $array[0];
				if ($array[0] == BRIGADE_PROCESS) {
					// PRoceso de brigada
					$this->session->set_userdata('brigada', $array[1]);
					$this->session->set_userdata('convenio', '');
					$mainPage = "OrdersAppOrder/selectBrigade";
				} else if ($array[0] == PARTNER_PROCESS) {
					// Proceso de convenio
					$this->session->set_userdata('brigada', null);
					$this->session->set_userdata('convenio', $array[1]);
					$mainPage = "OrdersAppOrder/selectPartner";
				} else if ($array[0] == NORMAL_PROCESS) {
					// Proceso normal
					$this->session->set_userdata('brigada', null);
					$this->session->set_userdata('convenio', null);
					$mainPage = "OrdersAppOrder/paintSearch";
				}
				$this->session->set_userdata('pagina', $mainPage);
				// Inicializo la variable de proceso
				$this->session->set_userdata('proceso', $proceso);
			} else {

				// Retorno a la pagina en la que estaba el proceso
				$mainPage = $this->session->userdata('pagina');
			}
			// Libero variables de sesion
			freeCookies($this);

			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

			// echo "<center>".$this->session->userdata('proceso')." ".$this->session->userdata('brigada')."</center>";
			/**
			 * Informacion relacionada con la plantilla principal Pinto la pantalla *
			 */
			$data['mainPage'] = $mainPage;
			$data['board'] = "Valores parametrizados";
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['pagina'] = "OrdersAppOrder/selectPatient";

			// Pinto plantilla principal
			$this->load->view('common/forms/formFindPatient', $data);
			$this->load->view('validation/orders/process/ordersFormSeachValidation');

			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */
			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function selectPatient()
	{
		/**
		 * Listo los diferentes pacientes que se han encontrado con los datos datos
		 */
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Asigno el valor principal de la variable de acuerdo a los valores de sesion
			$mainPage = $this->session->userdata('pagina');
			$data = null;
			// echo $mainPage;
			$data['mainPage'] = $mainPage;
			$data['returnPage'] = "OrdersAppOrder/board";
			if ($this->session->userdata('action') == 'order') {
				// Para ordenar
				$passPage = "OrdersAppOrder/paintSearch";
			} else {
				// Para seguimiento
				$passPage = "OrdersAppOrder/traceOrder";
			}

			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);
			// Pinto la informacion de los parametros de la aplicacion

			/**
			 * Informacion relacionada con la plantilla principal Pinto la pantalla *
			 */

			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $passPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'selectPatient', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'selectPatient', $idModule, VIEW_BUTTON_PERMISSION);

			// Busco la informacion de acuerdo al campo seleccionado
			$data['listaLista'] = searchPatient($this->security->xss_clean($this->input->post('historia')), $this->security->xss_clean($this->input->post('documento')), $this->security->xss_clean($this->input->post('nombre')), $this->security->xss_clean($this->input->post('apellido')), $this, ADMISION_STATE_ACTIVE);
			// Pinto plantilla principal
			$this->load->view('common/boards/boardFindPatient', $data);

			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function createOrder($id, $opcion = null)
	{
		/**
		 * Listo los diferentes pacientes que se han encontrado con los datos datos
		 */
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// echo "<center> Proceso: ".$this->session->userdata('proceso')." Brigada: ".$this->session->userdata('brigada')."</center>";

			$id = $this->encryption->decrypt($id);
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);
			// echo " aqui ".$this->session->userdata('id');

			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;

			$data['mainPage'] = $mainPage;
			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);
			// Pinto la informacion de los parametros de la aplicacion
			// Incluyo el Nestable
			$data['variable'] = 0;
			$this->load->view('common/nestableScripts', $data);

			/**
			 * Informacion relacionada con la plantilla principal Pinto la pantalla *
			 */
			$data['mainPage'] = $mainPage;
			$data['board'] = "Valores parametrizados";
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'createOrder', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'createOrder', $idModule, VIEW_BUTTON_PERMISSION);

			// Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);

			// Arbol para cambiar
			$route = "OrdersAppOrder/formNewOrder/" . $this->encryption->encrypt($id) . "/";
			$data['route'] = $route;
			// Nombre del proceso
			$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->session->userdata('proceso'));
			// Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de parometros
			if ($opcion == null) {
				// Primera orden
				$data['arbol'] = $this->OrdersModel->selectTreeInformation($route, 0, 'nestable', $this->session->userdata('proceso'));
				$this->load->view('orders/process/boardCreateOrder', $data);
			} else {
				//Ordenes creadas hasta el momento
				// Pinto la informacion del paciente
				$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);
				foreach ($data['paciente'] as $value) {
					$value->NUM_ID_PCTE;
				}
				$data['listaLista'] = $this->OrdersModel->selectListOrdersFromHead($this->session->userdata('encOrden'), $value->NUM_ID_PCTE);

				//$data ['listaLista'] = $this->OrdersModel->selectListOrdersFromHead ( $this->session->userdata ( 'encOrden' ) );

				$data['id'] = $this->encryption->encrypt($id);
				$this->load->view('orders/process/boardCreateOrderPlusInformation', $data);
			}

			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function formNewOrder($id, $idArbol, $tipoOrden = null)
	{
		/**
		 * Listo los elementos de acuerdo al orbol seleccionado
		 */
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {


			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;

			$data['mainPage'] = $mainPage;
			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion
			// Incluyo el Nestable
			$data['variable'] = 0;
			//$this->load->view ( 'common/nestableScripts', $data );



			// Obtengo valor del $id (historia clinica)
			$id = $this->encryption->decrypt($id);

			// Obtenogo ide del valor del arbol
			$idArbol = $this->encryption->decrypt($idArbol);

			// Obtenogo ide del tipo de orden
			$tipoOrden = $this->encryption->decrypt($tipoOrden);

			/**
			 * Informacion relacionada con la plantilla principal Pinto la pantalla *
			 */
			$data['mainPage'] = $mainPage;
			$data['board'] = "Valores parametrizados";
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);

			// 1. Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);

			// Pinto informacion del formulario
			// Listado de anteriores.
			$data['listadoAnteriores'] = $this->OrdersModel->selectOrdersPredecessor($id);
			$data['anterior'] = null;

			// Listado de DIAGNoSTICOS cie10
			$data['listaDiagnostico'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_DIAGNOSTICO", 'DESC');
			$data['cie10'] = null;
			// Listado de DIAGNoSTICOS cie10
			$data['listaCausas'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_CAUSAENFERMEDAD", 'DESC');
			$data['causa'] = null;



			if ($this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "ID_CLASETIPO", "ID", $tipoOrden) == 3) {
				$idMiembro = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOMIEM", "ID_MIEMBROS", "ID_TIPOORDEN", $tipoOrden);
				$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
				$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
				$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);


				//Nombre del miembro seleccionado
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOL_ZS", "NIVELAMP", "TIPOORDENID", $tipoOrden);
				//Nombre del miembro seleccionado - DETALLE
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_GRUELEM", "NOMBRE", "ID", $idArbol);

				$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);

				//echo $idArbol;

				// Listado de Elementos o servicios
				$data['listaElementosServicios'] = $this->OrdersModel->selectElementsFromGroupToOrder($idArbol);
			} else {
				/**
				 * ************************** INICIO RUTA DEL PRODUCTO O SERVICIO *************************
				 */
				// Obtengo el id del tipo de orden
				// Obtengo el id del ID_TIPOMIEM;

				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "ID_TIPOMIEM", $idArbol);
				if ($idTipoMiem == '') {
					$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "ID_TIPOMIEM", $idArbol);
				}
				if ($idTipoMiem == '') {
					$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "ID_TIPOMIEM", $idArbol);
				}
				$tipoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
				$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);
				$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $idArbol);
				$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $idArbol);

				// Ruta de orbol de ordenes
				$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
				$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
				$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);
				$data['nombreMiembros'] = null;
				// echo $data['tipoOrden'];
				if ($data['niveles'] == 1) {
					$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $idArbol);
					$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $idArbol);;
				} else if ($data['niveles'] == 2) {
					$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $idArbol);
					$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $idArbol);;
					$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $idArbol);
				} else {
					$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $idArbol);
					$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $idArbol);;
					$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $idArbol);;
					$data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $idArbol);
				}
				/**
				 * ************************** FIN RUTA DEL PRODUCTO O SERVICIO *************************
				 */

				// Listado de Elementos o servicios
				$data['listaElementosServicios'] = $this->OrdersModel->selectElementsOfTree($idArbol);
			}






			$data['elemento'] = null;
			// Defino el listado de usuarios que cumplan las caracteristicas seleccionadas de acuerdo al perfil definido en la configuracion
			$datos = '';
			if ($listaPerfilesOrdenes != null) {
				foreach ($listaPerfilesOrdenes as $perfiles) {
					$datos .= $perfiles->ID . ", ";
				}
			}

			$datos .= '-999';
			$data['listaApoyo'] = $this->Users->getListUsersForList($datos);
			$data['apoyo'] = null;

			// Defino el nomero de maximo de elementos o servicios que podro ordenar
			$data['maximo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "MAXIMO", $tipoOrden);

			// Historia clonica
			$data['id'] = $this->encryption->encrypt($id);
			$data['idArbol'] = $this->encryption->encrypt($idArbol);
			//Tipo de orden
			$data['tipoOrden'] = $this->encryption->encrypt($tipoOrden);;

			// Nombre del proceso
			$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->session->userdata('proceso'));

			// Pinto plantilla principal
			$this->load->view('orders/process/formCreateOrderElementList', $data);

			// Cargo validacion de formulario
			$this->load->view('validation/orders/process/OrdersAppOrderformNewOrderValidation');


			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function orderMedicalServices($id, $idOrden)
	{
		/**
		 * Incluye las valoraciones modicas para el paciente de acuerdo a la orden
		 */
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			$id = $this->encryption->decrypt($id);
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);
			// Encabezado de la orden
			$idOrden = $this->encryption->decrypt($idOrden);

			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;

			$data['mainPage'] = $mainPage;
			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion
			// Incluyo el Nestable
			$data['variable'] = 0;
			$this->load->view('common/nestableScripts', $data);

			// 1. Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);

			/**
			 * ************************** INICIO RUTA DEL PRODUCTO O SERVICIO *************************
			 */
			// Obtengo el idArbol asociado
			$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);
			$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $codigo);
			$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $codigo);
			$idArbol = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $codigo);

			$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "ID_TIPOMIEM", $idArbol);
			if ($idTipoMiem == '') {
				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "ID_TIPOMIEM", $idArbol);
			}
			if ($idTipoMiem == '') {
				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "ID_TIPOMIEM", $idArbol);
			}
			$tipoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
			$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);
			$data['tipoOrden'] = $tipoOrden;

			// Ruta de orbol de ordenes
			$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
			$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
			$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);
			$data['nombreMiembros'] = null;
			// echo $data['tipoOrden'];
			if ($data['niveles'] == 1) {
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $idArbol);
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $idArbol);;
			} else if ($data['niveles'] == 2) {
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $idArbol);
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $idArbol);;
				$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $idArbol);
			} else {
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $idArbol);
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $idArbol);;
				$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $idArbol);;
				$data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $idArbol);
			}
			/**
			 * ************************** FIN RUTA DEL PRODUCTO O SERVICIO *************************
			 */

			// Pinto informacion del formulario
			// Listado de Elementos o servicios
			$data['listaServicios'] = $this->OrdersModel->selectMedicalServiceOfTree();
			$data['elemento'] = null;

			// Historia clonica
			$data['id'] = $this->encryption->encrypt($id);;
			$data['idOrden'] = $this->encryption->encrypt($idOrden);
			// Nombre del proceso
			$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->session->userdata('proceso'));

			// Pinto plantilla principal
			$this->load->view('orders/process/formCreateOrderMedicalServiceList', $data);
			// Cargo validacion de formulario
			$this->load->view('validation/orders/process/OrdersAppOrderformMedicalServiceValidation');
			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function paintProductServiceRoute($idOrden)
	{
		/**
		 * Pinta la informacion de la ruta del producto o servicio de acuerdo a la informacion de la $idOrden
		 */

		/**
		 * ************************** INICIO RUTA DEL PRODUCTO O SERVICIO *************************
		 */
		// Obtengo el idArbol asociado
		$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);
		$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $codigo);
		$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $codigo);
		$idArbol = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $codigo);

		$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "ID_TIPOMIEM", $idArbol);
		if ($idTipoMiem == '') {
			$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "ID_TIPOMIEM", $idArbol);
		}
		if ($idTipoMiem == '') {
			$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "ID_TIPOMIEM", $idArbol);
		}
		$tipoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
		$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);
		$data['tipoOrden'] = $tipoOrden;

		// Ruta de orbol de ordenes
		$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
		$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
		$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);
		$data['nombreMiembros'] = null;
		// echo $data['tipoOrden'];
		if ($data['niveles'] == 1) {
			$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $idArbol);
			$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $idArbol);;
		} else if ($data['niveles'] == 2) {
			$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $idArbol);
			$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $idArbol);;
			$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $idArbol);
		} else {
			$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $idArbol);
			$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $idArbol);;
			$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $idArbol);;
			$data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $idArbol);
		}
		/**
		 * ************************** FIN RUTA DEL PRODUCTO O SERVICIO *************************
		 */
	}

	public function elementsOfProduct($id, $idOrden, $idDespiece = null)
	{
		/**
		 * Incluye las valoraciones modicas para el paciente de acuerdo a la orden
		 */
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {

			$id = $this->encryption->decrypt($id);
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);
			// Encabezado de la orden
			$idOrden = $this->encryption->decrypt($idOrden);

			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'elementsOfProduct', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'elementsOfProduct', $idModule, VIEW_BUTTON_PERMISSION);
			$data['mainPage'] = $mainPage;
			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion

			// 1. Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);

			/**
			 * ************************** INICIO RUTA DEL PRODUCTO O SERVICIO *************************
			 */
			// Obtengo el idArbol asociado
			$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);
			$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $codigo);
			$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $codigo);
			$idArbol = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $codigo);

			$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "ID_TIPOMIEM", $idArbol);
			if ($idTipoMiem == '') {
				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "ID_TIPOMIEM", $idArbol);
			}
			if ($idTipoMiem == '') {
				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "ID_TIPOMIEM", $idArbol);
			}
			$tipoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
			$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);
			$data['tipoOrden'] = $tipoOrden;

			// Ruta de orbol de ordenes
			$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
			$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
			$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);
			$data['nombreMiembros'] = null;
			// echo $data['tipoOrden'];
			if ($data['niveles'] == 1) {
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $idArbol);
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $idArbol);;
			} else if ($data['niveles'] == 2) {
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $idArbol);
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $idArbol);;
				$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $idArbol);
			} else {
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $idArbol);
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $idArbol);;
				$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $idArbol);;
				$data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $idArbol);
			}
			/**
			 * ************************** FIN RUTA DEL PRODUCTO O SERVICIO *************************
			 */

			// Pinto informacion del formulario
			// Listado de Elementos definidos dentro del despiece
			$data['listaLista'] = $this->OrdersModel->getListElementOfProductOrder($idOrden);
			$data['elemento'] = null;

			// Cifro campos para continuarHistoria clonica
			$data['id'] = $this->encryption->encrypt($id);;
			$data['idOrden'] = $this->encryption->encrypt($idOrden);
			// Nombre del proceso
			$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->session->userdata('proceso'));

			// Lista de grupos
			$data['listaGrupo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_GRUELEM", 'DESC');



			if ($idDespiece == null) {

				// Pinto plantilla principal
				$this->load->view('orders/process/boardCreateOrderElementoOfProductList', $data);

				$this->load->view('validation/orders/process/OrdersAppOrderElementsGroupValidation', $data);
			} else {
				$idDespieceBk = $idDespiece;
				$idDespiece = $this->encryption->decrypt($idDespiece);
				// Obtengo el elemento
				$comodin = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTDES", "ID_ELEMENTO", "ID", $idDespiece);
				$data['cantidad'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTDES", "CANTIDAD", "ID", $idDespiece);
				// Obtengo el grupo del elemento
				$grupo = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "ID_GRUELEM", "ID", $comodin);
				$data['listaProveedores'] = $this->OrdersModel->selectListProvidersElementsFromGroups($grupo);
				// Pinto las caractertisticas
				// Pinto informacion de las caracteristicas
				$data['caracteristicas'] = $this->OrdersModel->selectListCharacteristicsElementGroup($grupo);

				// Pinto plantilla para configurar elemento
				$data['idDespiece'] = $this->encryption->encrypt($idDespiece);
				$data['grupo'] = $grupo;
				$this->load->view('orders/process/formCreateOrderElementoOfProductList', $data);
				$this->load->view('validation/orders/process/OrdersAppOrderElementsValidation', $data);
			}

			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function moreElementsOfProduct()
	{
		/**
		 * Incluye las valoraciones modicas para el paciente de acuerdo a la orden
		 */
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {

			//Recibo los valores

			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);
			// Encabezado de la orden
			$idOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idOrden')));

			//Grupo seleccionado
			$grupo = $this->security->xss_clean($this->input->post('grupo'));


			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'elementsOfProduct', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'elementsOfProduct', $idModule, VIEW_BUTTON_PERMISSION);

			$data['mainPage'] = $mainPage;
			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion

			// 1. Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);

			/**
			 * ************************** INICIO RUTA DEL PRODUCTO O SERVICIO *************************
			 */
			// Obtengo el idArbol asociado
			$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);
			$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $codigo);
			$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $codigo);
			$idArbol = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $codigo);

			$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "ID_TIPOMIEM", $idArbol);
			if ($idTipoMiem == '') {
				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "ID_TIPOMIEM", $idArbol);
			}
			if ($idTipoMiem == '') {
				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "ID_TIPOMIEM", $idArbol);
			}
			$tipoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
			$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);
			$data['tipoOrden'] = $tipoOrden;

			// Ruta de orbol de ordenes
			$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
			$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
			$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);
			$data['nombreMiembros'] = null;
			// echo $data['tipoOrden'];
			if ($data['niveles'] == 1) {
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $idArbol);
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $idArbol);;
			} else if ($data['niveles'] == 2) {
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $idArbol);
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $idArbol);;
				$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $idArbol);
			} else {
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $idArbol);
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $idArbol);;
				$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $idArbol);;
				$data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $idArbol);
			}
			/**
			 * ************************** FIN RUTA DEL PRODUCTO O SERVICIO *************************
			 */

			// Pinto informacion del formulario
			// Listado de Elementos definidos dentro del despiece
			$data['listaLista'] = $this->OrdersModel->getListElementOfProductOrder($idOrden);
			$data['elemento'] = null;

			// Cifro campos para continuarHistoria clonica
			$data['id'] = $this->encryption->encrypt($id);;
			$data['idOrden'] = $this->encryption->encrypt($idOrden);
			// Nombre del proceso
			$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->session->userdata('proceso'));

			//$grupo = $this->FunctionsGeneral->getFieldFromTableNotId ( "ORD_ELEMENTO", "ID_GRUELEM", "ID", $comodin );
			$data['listaProveedores'] = $this->OrdersModel->selectListProvidersElementsFromGroups($grupo);
			// Pinto las caractertisticas
			// Pinto informacion de las caracteristicas
			$data['caracteristicas'] = $this->OrdersModel->selectListCharacteristicsElementGroup($grupo);

			// Pinto plantilla para configurar elemento
			//$data ['idDespiece'] = $this->encryption->encrypt ( $idDespiece );
			$data['grupo'] = $grupo;

			// Pinto plantilla para configurar elemento
			$this->load->view('orders/process/formCreateMoreOrderElementoOfProductList', $data);
			$this->load->view('validation/orders/process/OrdersAppOrderElementsValidation', $data);

			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function printOrder($id, $encOrden = null)
	{
		/**
		 * Pinto el impreso de la orden *
		 */
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {

			$id = $this->encryption->decrypt($id);
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);
			// Encabezado de la orden
			$encOrden = $this->encryption->decrypt($encOrden);

			// Pinto la interfaz para imprimir las ordenes
			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;

			$data['mainPage'] = $mainPage;

			$data['returnPage'] = "OrdersAppOrder/board";
			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion
			// Incluyo el Nestable
			$data['variable'] = 0;

			/**
			 * Informacion relacionada con la plantilla principal Pinto la pantalla *
			 */

			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			// Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);
			foreach ($data['paciente'] as $value) {
				$value->NUM_ID_PCTE;
			}
			// 2. Pinto el listado de ordenes
			$data['listaLista'] = $this->OrdersModel->selectListOrdersFromHead($this->session->userdata('encOrden'), $value->NUM_ID_PCTE);

			// 3. Informacion de la empresa
			$listParameters = $this->SystemModel->getParameters(1);
			foreach ($listParameters as $value) {
				$data['direccion'] = $value->DIRECCION;
				$data['telefono'] = $value->TELEFONO;
				$data['correo'] = $value->CORREO;
				$data['empresa'] = $value->NOMBRE;
			}
			// 4. Fecha Orden
			$data['fechaOrden'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ENCORDEN", "FCREA", "ID", $encOrden);
			// 5. Generador de la orden
			$usuarioSession = $this->Users->getNombresUsuario($this->session->userdata('usuario'));
			$data['nombreUsuario'] = $usuarioSession->NOMBRES;
			$data['apellidoUsuario'] = $usuarioSession->APELLIDOS;
			$usuarioSession = $this->Users->getUsersProfile($this->session->userdata('usuario'));
			$data['especialidad'] = $usuarioSession->PERFIL;

			// Pinto plantilla principal
			$this->load->view('orders/process/printOrderInformation', $data);

			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function orderList($id, $opcion = null)
	{
		/**
		 * Listo los diferentes pacientes que se han encontrado con los datos datos
		 */
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// echo "<center> Proceso: ".$this->session->userdata('proceso')." Brigada: ".$this->session->userdata('brigada')."</center>";

			$id = $this->encryption->decrypt($id);
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);
			// echo " aqui ".$this->session->userdata('id');

			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;
			$data['mainPage'] = $mainPage;
			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);
			// Pinto la informacion de los parametros de la aplicacion

			/**
			 * Informacion relacionada con la plantilla principal Pinto la pantalla *
			 */

			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'orderList', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'orderList', $idModule, VIEW_BUTTON_PERMISSION);

			// Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);

			// Arbol para cambiar
			$route = "OrdersAppOrder/formNewOrder/" . $this->encryption->encrypt($id) . "/";
			$data['route'] = $route;

			$data['listaLista'] = $this->OrdersModel->selectListOrdersFromHistory($id);

			// Nombre del proceso
			$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->session->userdata('proceso'));
			// Pinto la lista genorica de parametros que se debe tener en cuenta dentro del sistema de parometros
			$data['id'] = $this->encryption->encrypt($id);
			$this->load->view('orders/process/boardCreateOrderPlusInformation', $data);

			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function tracerProcess($id, $idOrden)
	{
		/**
		 * Listo los diferentes pacientes que se han encontrado con los datos datos
		 */
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// echo "<center> Proceso: ".$this->session->userdata('proceso')." Brigada: ".$this->session->userdata('brigada')."</center>";

			$id = $this->encryption->decrypt($id);
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);

			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;
			$data['mainPage'] = $mainPage;
			// Pinto la cabecera principal de las poginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

			/**
			 * Informacion relacionada con la plantilla principal Pinto la pantalla *
			 */
			// Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);

			// Recibo el idOrden
			$idOrden = $this->encryption->decrypt($idOrden);

			$idTordPro = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ID_TORDPRO", "ID", $idOrden);
			$idArbol = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ACTIVIDAD", "ID", $idOrden);
			$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);
			//ECHO $codigo;
			$idProceso = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TORDPRO", "ID_PROCESO", "ID", $idTordPro);
			$tipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TORDPRO", "ID_TIPOORDEN", "ID", $idTordPro);
			// Nombre del proceso
			$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $idProceso);

			$data['ordenNumero'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "PREFIJO", $tipoOrden) . " - " .
				$this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "CONS", $idOrden);

			if ($this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "ID_CLASETIPO", "ID", $tipoOrden) == 3) {
				$this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOMIEM", "ID_MIEMBROS", "ID_TIPOORDEN", $tipoOrden);
				$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
				$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
				$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);


				//Nombre del miembro seleccionado
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOL_ZS", "NIVELAMP", "TIPOORDENID", $tipoOrden);
				//Nombre del miembro seleccionado - DETALLE
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_GRUELEM", "NOMBRE", "ID", $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "ID_GRUELEM", $codigo));

				$this->OrdersModel->selectListWorkGroup($tipoOrden, 2);

				//echo $idArbol;
				$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "NOMBRE", $codigo);
				$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "CODIGO", $codigo);
			} else {

				/**
				 * ************************** INICIO RUTA DEL PRODUCTO O SERVICIO *************************
				 */
				// Obtengo el idArbol asociado
				$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);
				$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $codigo);
				$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $codigo);

				$idArbol = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $codigo);

				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "ID_TIPOMIEM", $idArbol);
				if ($idTipoMiem == '') {
					$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "ID_TIPOMIEM", $idArbol);
				}
				if ($idTipoMiem == '') {
					$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "ID_TIPOMIEM", $idArbol);
				}
				$tipoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
				$this->OrdersModel->selectListWorkGroup($tipoOrden, 2);
				$data['tipoOrden'] = $tipoOrden;

				// Ruta de orbol de ordenes
				$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
				$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
				$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);
				$data['nombreMiembros'] = null;
				// echo $data['tipoOrden'];
				if ($data['niveles'] == 1) {
					$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $idArbol);
					$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $idArbol);;
				} else if ($data['niveles'] == 2) {
					$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $idArbol);
					$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $idArbol);;
					$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $idArbol);
				} else {
					$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $idArbol);
					$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $idArbol);;
					$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $idArbol);;
					$data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $idArbol);
				}
				/**
				 * ************************** FIN RUTA DEL PRODUCTO O SERVICIO *************************
				 */
			}
			// Historia clonica
			$data['id'] = $this->encryption->encrypt($id);
			$data['idOrden'] = $this->encryption->encrypt($idOrden);

			$data['idPinta'] = $idOrden;

			$data['pagina'] = "OrdersAppOrder/orderList";

			//Pinto el despiece asociado a la orden
			$data['listaLista'] = $this->OrdersModel->getListElementOfProductOrder($idOrden);
			//Pinto avance
			$data['estadosDefinidos'] = $this->OrdersModel->selectOrderStateQuantity($idOrden, 1);
			$data['estadosEjecutados'] = $this->OrdersModel->selectOrderStateQuantity($idOrden, 2);
			//Pinto equipo
			$data['listadoPersonas'] = $this->OrdersModel->selectListPeopleFromOrder($idOrden);
			//Historico de la orden
			$data['listadoHistoria'] = $this->OrdersModel->selectHistoryOrder($idOrden);
			// Pinto la lista genorica de parametros que se debe tener en cuenta dentro del sistema de parometros
			//Pinto los estados siguientes
			$data['listadoEstados'] = $this->OrdersModel->selectActualStateFromOrden($idOrden, $this->session->userdata('usuario'));

			//MOdifica despiece
			$data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
			//Retornar de suspendido
			$data['listadoSuspender'] = $this->OrdersModel->selectActualStateFromOrdenFromSuspend($idOrden, $this->session->userdata('usuario'));
			$data['idSuspend'] = SUSPEND_OBSERVATION;
			$data['nombreSuspend'] = $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "NOMBRE", SUSPEND_OBSERVATION);;

			//Pinto pantalla de seguimiento
			$this->load->view('orders/process/boardTracerOrder', $data);
			//Pinto reglas de validacion
			$this->load->view('validation/orders/process/ordersAppOrderTracerProcessValidation', $data);

			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la pogina (poginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function modifyElementOfProductsTrace($id, $idOrden)
	{
		/**Realizo las modificaciones del despiece para la orden*/
		$id = $this->encryption->decrypt($id);
		// Asigno el valor a la cookie de historia clonica
		$this->session->set_userdata('id', $id);
		// Encabezado de la orden
		$idOrden = $this->encryption->decrypt($idOrden);

		// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
		$mainPage = $this->session->userdata('pagina');
		$data = null;
		// Pinto los permisos del tablero de control
		$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
		$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'elementsOfProduct', $idModule, VIEW_LIST_PERMISSION);
		$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'elementsOfProduct', $idModule, VIEW_BUTTON_PERMISSION);
		$data['mainPage'] = $mainPage;
		// Pinto la cabecera principal de las poginas internas
		showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
		// Pinto la informacion de los parametros de la aplicacion

		// 1. Pinto la informacion del paciente
		$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);

		/**
		 * ************************** INICIO RUTA DEL PRODUCTO O SERVICIO *************************
		 */
		// Obtengo el idArbol asociado
		$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);
		$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $codigo);
		$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $codigo);
		$idArbol = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $codigo);

		$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "ID_TIPOMIEM", $idArbol);
		if ($idTipoMiem == '') {
			$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "ID_TIPOMIEM", $idArbol);
		}
		if ($idTipoMiem == '') {
			$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "ID_TIPOMIEM", $idArbol);
		}
		$tipoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
		$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);
		$data['tipoOrden'] = $tipoOrden;

		// Ruta de orbol de ordenes
		$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
		$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
		$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);
		$data['nombreMiembros'] = null;
		// echo $data['tipoOrden'];
		if ($data['niveles'] == 1) {
			$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "NOMBRE", $idArbol);
			$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "SUBNIVEL", $idArbol);;
		} else if ($data['niveles'] == 2) {
			$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "NOMBRE", $idArbol);
			$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL", $idArbol);;
			$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "SUBNIVEL2", $idArbol);
		} else {
			$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "NOMBRE", $idArbol);
			$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL", $idArbol);;
			$data['nomSegundoSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL2", $idArbol);;
			$data['nomTerceroSubNiv'] = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "SUBNIVEL3", $idArbol);
		}
		/**
		 * ************************** FIN RUTA DEL PRODUCTO O SERVICIO *************************
		 */
		// Pinto informacion del formulario
		// Listado de Elementos definidos dentro del despiece
		$data['listaLista'] = $this->OrdersModel->getListElementOfProductOrder($idOrden);
		$data['elemento'] = null;

		// Cifro campos para continuarHistoria clonica
		$data['id'] = $this->encryption->encrypt($id);;
		$data['idOrden'] = $this->encryption->encrypt($idOrden);
		// Nombre del proceso
		$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->session->userdata('proceso'));

		// Pinto plantilla principal
		$this->load->view('orders/process/boardModifyOrderElementOfProductList', $data);

		/**
		 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
		 */

		// Pinto el final de la pogina (poginas internas)
		showCommonEnds($this, null, null);
	}

	// ----------------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------------

	/*************************************************************************************************************
	 * 												RUTINAS PARA GUARDAR INFORMACIoN
	 * ****************************************************************************************************** *
	 */

	// ----------------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------------
	// ----------------------------------------------------------------------------------------------------------------------------------------

	public function saveRegister()
	{
		/**
		 * Guardo la informacion del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
		 */
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Obtengo valor del $id (historia clinica)
			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
			// Obtengo ide del valor del arbol
			$idArbol = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idArbol')));
			// Obtengo ide del valor del Tipo de Orden
			$tipoOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('tipoOrden')));

			// 1. INSERTANDO ENCABEZADO DE ORDEN

			if ($this->session->userdata('encOrden') == '') {
				if ($this->session->userdata('convenio') != '') {
					$convenio = $this->session->userdata('convenio');
				} else {
					$convenio = null;
				}
				if ($this->session->userdata('brigada') != '') {
					$brigada = $this->session->userdata('brigada');
				} else {
					$brigada = null;
				}

				$encabezado = $this->OrdersModel->insertOrderHead($convenio, $brigada, $id, 0, $this->session->userdata('usuario'));
				// 1.1 Asigno el valor a la cookie de historia clonica
				$this->session->set_userdata('encOrden', $encabezado);
			} else {
				// 1.1 Asigno el valor respectivo al encabezado
				$encabezado = $this->session->userdata('encOrden');
			}

			// 2. INGRESANDO ELEMENTOS Y/O SERVICIOS ORDENADOS
			$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "ID_TIPOMIEM", $idArbol);
			if ($idTipoMiem == '') {
				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "ID_TIPOMIEM", $idArbol);
			}
			if ($idTipoMiem == '') {
				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "ID_TIPOMIEM", $idArbol);
			}

			if ($this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "ID_CLASETIPO", "ID", $tipoOrden) != 3) {
				//Para los que no son desde elementos
				$tipoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
			}
			$consecutivoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "CONS", $tipoOrden);
			$prefijoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "PREFIJO", $tipoOrden);

			// echo $tipoOrden;
			if ($this->security->xss_clean($this->input->post('predecesora')) == '') {
				$predecesora = null;
			} else {
				$predecesora = $this->security->xss_clean($this->input->post('predecesora'));
			}

			// Obtengo relacion entre proceso y tipo de orden
			$tordPro = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_TORDPRO", "ID", "ID_TIPOORDEN", $tipoOrden, "ID_PROCESO", $this->session->userdata('proceso'));
			// Realizo el insert de la orden
			$idOrden = $this->OrdersModel->insertOrderBody($encabezado, $tordPro, $this->security->xss_clean($this->input->post('cie10')), $this->security->xss_clean($this->input->post('causa')), $this->encryption->encrypt($this->security->xss_clean($this->input->post('diagnostico'))), $consecutivoOrden, $predecesora, $this->security->xss_clean($this->input->post('codigo')), $this->security->xss_clean($this->input->post('cantidad')), $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion'))), $this->session->userdata('usuario'));
			// 3. Corro el consecutivo de la orden
			$this->FunctionsGeneral->updateByID("ORD_TIPOORDEN", "CONS", $consecutivoOrden + 1, $tipoOrden, $this->session->userdata('usuario'));
			// 4. Creo el estado inicial de la orden
			$idEstadoInicial = $this->OrdersModel->searchStateOrderType(1, $tordPro);
			$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $idEstadoInicial);
			$idOrdenEstado = $this->OrdersModel->insertOrderState($idOrden, $idEstadoInicial, OPEN_STATE, $this->encryption->encrypt('saveRegister'), $contador, $this->session->userdata('usuario'));

			// Observacion inicial

			// 5. Verifico si aplica despiece y lo creo
			if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_DESPIECE", "ID_ARBOLCODIGO", $this->security->xss_clean($this->input->post('codigo'))) > 0) {
				// Se debe crear el despiece
				$despiece = $this->OrdersModel->selectElementProductoList($this->security->xss_clean($this->input->post('codigo')));
				foreach ($despiece as $value) {
					// Inserto cada uno de los elementos del despiece que se encuetran definidos
					$this->OrdersModel->insertOrderElementOfProduct($idOrden, $value->ID_ELEMENTO, $value->CANTIDAD, null, null, null, null, $this->session->userdata('usuario'));
				}
			}
			// 6. CREANDO GRUPO INTERDISCIPLINARIO
			// Ordenador principal
			$this->OrdersModel->insertOrderTeamList($idEstadoInicial, $this->session->userdata('usuario'), $this->session->userdata('usuario'));
			// Apoyo en la generacion de la orden
			if ($this->security->xss_clean($this->input->post('apoyo')) != -1 && $this->security->xss_clean($this->input->post('apoyo')) != '') {

				$this->OrdersModel->insertOrderTeamList($idEstadoInicial, $this->security->xss_clean($this->input->post('apoyo')), $this->session->userdata('usuario'));
			}

			$mainPage = "OrdersAppOrder/createOrder/";
			// Redirecciono para cambio de clave
			$redirect = $mainPage . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt('next');
			// Pinto mensaje para retornar a la aplicacion
			$this->session->set_userdata('id', $id);
			$this->session->set_userdata('auxiliar', 'orderCretated');
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function deleteOrder($id, $idOrden)
	{
		/**
		 * Elimino la orden que se ha creado y la cual corresponden a $idOrden
		 */
		$id = $this->encryption->decrypt($id);
		// Asigno el valor a la cookie de historia clonica
		$this->session->set_userdata('id', $id);

		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Obtengo valor de la orden
			$idOrden = $this->encryption->decrypt($idOrden);
			// 1. Se elimina los datos de las ordenes donde $orden es Orden anterior.
			$ordenes = $this->OrdersModel->selectListOrdersBeforeOrder($idOrden);
			if ($ordenes != null) {
				foreach ($ordenes as $orden) {
					deleteOrderInformation($this, $orden->ID);
				}
			}
			// 2. Se eliminan los datos para la orden $orden.
			deleteOrderInformation($this, $idOrden);

			$mainPage = "OrdersAppOrder/createOrder/";
			// Redirecciono para cambio de clave
			$redirect = $mainPage . $this->encryption->encrypt($this->session->userdata('id')) . "/" . $this->encryption->encrypt('next');
			// Pinto mensaje para retornar a la aplicacion
			$this->session->set_userdata('id', $this->session->userdata('id'));
			$this->session->set_userdata('auxiliar', 'orderDeleted');
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function deleteElementsOfProduct($id, $idOrden, $idDespiece, $opcion = null)
	{
		/**
		 * Elimino los elementos que no haran parte del despiece para la orden $idOrden
		 */
		$id = $this->encryption->decrypt($id);
		// Asigno el valor a la cookie de historia clonica
		$this->session->set_userdata('id', $id);

		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Obtengo valor de la orden
			$idOrden = $this->encryption->decrypt($idOrden);
			// Obtengo valor del elemento del despice
			$idDespiece = $this->encryption->decrypt($idDespiece);

			// Elimino elemento del despiece
			$this->OrdersModel->deleteElementOfProductOrder($idDespiece);

			// Redirecciono para cambio de clave
			if ($this->encryption->decrypt($opcion) == 'trace') {
				$mainPage = "OrdersAppOrder/modifyElementOfProductsTrace/";
			} else {
				$mainPage = "OrdersAppOrder/elementsOfProduct/";
			}
			$redirect = $mainPage . $this->encryption->encrypt($this->session->userdata('id')) . "/" . $this->encryption->encrypt($idOrden);
			// Pinto mensaje para retornar a la aplicacion
			$this->session->set_userdata('id', $this->session->userdata('id'));
			$this->session->set_userdata('auxiliar', 'orderElementOfProdDeleted');
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function saveMedicalService()
	{
		/**
		 * Guarda la informacion de las ordenes de interconsulta que estaron adjuntas a la orden principal
		 */
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Obtengo valor del $id (historia clinica)
			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));

			// Obtengo ide del valor del arbol
			$idOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idOrden')));

			// Obtengo informacion del listado de interconsultas seleccionadas
			$listCodigo = $this->security->xss_clean($this->input->post('codigo'));

			// Recorro el listado de interconsultas seleccionadas
			foreach ($listCodigo as $codigo) {

				// INGRESANDO LOS SERVICIOS DE INTERCONSULTA ADICIONALES
				$idArbol = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $codigo);
				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_TS", "ID_TIPOMIEM", $idArbol);
				if ($idTipoMiem == '') {
					$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_SS", "ID_TIPOMIEM", $idArbol);
				}
				if ($idTipoMiem == '') {
					$idTipoMiem = $this->FunctionsGeneral->getFieldFromTable("VIEW_ORD_ARBOL_PS", "ID_TIPOMIEM", $idArbol);
				}
				$tipoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
				$consecutivoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "CONS", $tipoOrden);
				$prefijoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "PREFIJO", $tipoOrden);

				// Obtengo relacion entre proceso y tipo de orden
				$tordPro = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_TORDPRO", "ID", "ID_TIPOORDEN", $tipoOrden, "ID_PROCESO", $this->session->userdata('proceso'));

				// Obtengo la cantidad de cada interconsulta de acuerdo a lo definido dentro del paquete
				$cantidad = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PAQUETEVALORA", "CANTIDAD", "ID_ARBOLCODIGO", $codigo);

				// Realizo el insert de la orden
				$idOrdenInterconsulta = $this->OrdersModel->insertOrderBody($this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ID_ENCORDEN", $idOrden), $tordPro, $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ID_DIAGNOSTICO", $idOrden), $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ID_CAUSAENFERMEDAD", $idOrden), $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "DIAGNOSTICO", $idOrden), $consecutivoOrden, $idOrden, $codigo, $cantidad, $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion'))), $this->session->userdata('usuario'));

				// Corro el consecutivo de la orden
				$this->FunctionsGeneral->updateByID("ORD_TIPOORDEN", "CONS", $consecutivoOrden + 1, $tipoOrden, $this->session->userdata('usuario'));

				// Creo el estado inicial de la orden
				$idEstadoInicial = $this->OrdersModel->searchStateOrderType(1, $tordPro);
				$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrdenInterconsulta, "ID_TORDPROEST", $idEstadoInicial);
				$idOrdenEstado = $this->OrdersModel->insertOrderState($idOrdenInterconsulta, $idEstadoInicial, OPEN_STATE, $this->encryption->encrypt('saveRegister'), $contador, $this->session->userdata('usuario'));

				// CREANDO GRUPO INTERDISCIPLINARIO
				// Ordenador principal
				$this->OrdersModel->insertOrderTeamList($idOrdenEstado, $this->session->userdata('usuario'), $this->session->userdata('usuario'));

				// CREANDO RELACION DE EMPRESA ALIADA Y ORDEN
				if ($this->session->userdata('proceso') == PROCESO_CONVENIO) {
					$this->OrdersModel->insertOrderPartnerCompany($idOrdenInterconsulta, $this->session->userdata('convenio'), $this->session->userdata('ciudad'), $this->session->userdata('usuario'));
				}
			}

			$mainPage = "OrdersAppOrder/createOrder/";
			// Redirecciono para cambio de clave
			$redirect = $mainPage . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt('next');
			// Pinto mensaje para retornar a la aplicacion
			$this->session->set_userdata('id', $id);
			$this->session->set_userdata('auxiliar', 'medicalServiceOk');
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function saveElementOfProduct()
	{
		/**
		 * Guarda la informacion de las ordenes de interconsulta que estaron adjuntas a la orden principal
		 */
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Obtengo valor del $id (historia clinica)
			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
			// Obtengo el id de la orden
			$idOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idOrden')));
			// Obtengo id del despiece
			$idDespice = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idDespiece')));
			if ($this->security->xss_clean($this->input->post('idDespiece')) != '') {
				// echo "Despiece: ".$idDespice. "<br> Orden: ".$idOrden."<br> Admision:".$id;
				// Verifico la cantidad de los elementos que se encontraban ordenados para el comodin
				$cantidad = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDACTDES", "CANTIDAD", $idDespice);
				if ($cantidad == 1) {
					// Puedo cambiar el elemento por el nuevo encontrado
					$this->FunctionsGeneral->updateByID("ORD_ORDACTDES", "ID_ELEMENTO", $this->security->xss_clean($this->input->post('elemento')), $idDespice, $this->session->userdata('usuario'));
				} else {
					// CREO UNO NUEVO
					$this->OrdersModel->insertOrderElementOfProduct($idOrden, $this->security->xss_clean($this->input->post('elemento')), $this->security->xss_clean($this->input->post('cantidad')), '', '', '', '', $this->session->userdata('usuario'));

					// Resto la cantidad del elemento comodin
					$cantidad--;
					$this->FunctionsGeneral->updateByID("ORD_ORDACTDES", "CANTIDAD", $cantidad, $idDespice, $this->session->userdata('usuario'));
				}
			} else {
				// Inserto nuevo elemento
				$this->OrdersModel->insertOrderElementOfProduct($idOrden, $this->security->xss_clean($this->input->post('elemento')), $this->security->xss_clean($this->input->post('cantidad')), '', '', '', '', $this->session->userdata('usuario'));
			}

			if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('opcion'))) == 'trace') {
				$mainPage = "OrdersAppOrder/modifyElementOfProductsTrace/";
			} else {
				$mainPage = "OrdersAppOrder/elementsOfProduct/";
			}



			// Redirecciono para cambio de clave
			$redirect = $mainPage . $this->security->xss_clean($this->input->post('id')) . "/" . $this->encryption->encrypt($idOrden);
			// Pinto mensaje para retornar a la aplicacion
			// $this->session->set_userdata('id', $id);
			// echo $this->session->userdata('id');
			$this->session->set_userdata('auxiliar', 'orderElementElementChanged');
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function orderConsolidation($id, $idOrden = null)
	{
		/**
		 * Consolido la orden, con lo cual no se podro anexar mos elementos
		 */
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			$id = $this->encryption->decrypt($id);
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);
			if ($idOrden == null) {
				// Proceso de ordenes
				// Obtengo el listado de ordenes
				// Pinto la informacion del paciente
				$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);
				foreach ($data['paciente'] as $value) {
					$value->NUM_ID_PCTE;
				}
				// 2. Pinto el listado de ordenes
				$ordenes = $this->OrdersModel->selectListOrdersFromHead($this->session->userdata('encOrden'), $value->NUM_ID_PCTE);

				//$ordenes = $this->OrdersModel->selectListOrdersFromHead($this->session->userdata('encOrden'));
				if ($ordenes != null) {
					foreach ($ordenes as $orden) {
						// Actualizo el valor OPCION, para la relacion del estado ordenar para cada orden
						$this->FunctionsGeneral->updateByField(
							"ORD_ORDACTEST",
							"OPCION",
							$this->encryption->encrypt('orderConsolidation'),
							"ID_ORDEN",
							$orden->ID,
							$this->session->userdata('usuario')
						);
						// Verifico si se tienen ordenes a las cuales se les debe configurar el despiece de elementos
						$idOrdActEst = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTEST", "ID", "ID_ORDEN", $orden->ID);
						$idTordProEst = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTEST", "ID_TORDPROEST", "ID_ORDEN", $orden->ID);
						if ($this->OrdersModel->getQuantityElementsOrder($orden->ID) > 0) {
							// Solo creo el mensaje para los que tienen despiece
							$this->OrdersModel->insertOrderStateObservation($idOrdActEst, ORDER_OBSERVATION_2, $this->encryption->encrypt(ORDER_OBSERVATION_TEXT_2), $this->session->userdata('usuario'));
						} else {
							// Para los que no tienen despiece
							$this->OrdersModel->insertOrderStateObservation($idOrdActEst, ORDER_OBSERVATION_1, $this->encryption->encrypt(ORDER_OBSERVATION_TEXT_1), $this->session->userdata('usuario'));
							// Se cierra el estado actual de la Orden
							$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", CLOSE_STATE, "ID", $idOrdActEst, $this->session->userdata('usuario'));
							// Se crean los nuevos estados para esto tomo la orden y el estado actual, y el estado de relacion
							$this->defineOrderNewStates($orden->ID, $idTordProEst, $idOrdActEst);
						}
					}
					// Pinto formulario siguiente, el cual es para la impresion de la orden
					$mainPage = "OrdersAppOrder/printOrder/";
					// Redirecciono para cambio de clave
					$redirect = $mainPage . $this->encryption->encrypt($this->session->userdata('id')) . "/" . $this->encryption->encrypt($this->session->userdata('encOrden'));
					// Pinto mensaje para retornar a la aplicacion
					$this->session->set_userdata('id', $this->session->userdata('id'));
					$this->session->set_userdata('auxiliar', 'orderConsolidated');
					redirect(base_url() . $redirect);
				} else {
					// Retorno a la pogina principal
					header("Location: " . base_url());
				}
			} else {
				//echo $this->session->userdata ( 'id' );
				// Desde seguimiento
				$idOrden = $this->encryption->decrypt($idOrden);
				// Cierro la orden en el primer estado y continuo
				$this->validateStateProcess($idOrden);
				// Pinto formulario siguiente, el cual es para la impresion de la orden
				$mainPage = "OrdersAppOrder/orderList/";
				// Redirecciono para cambio de clave
				$redirect = $mainPage . $this->encryption->encrypt($this->session->userdata('id'));
				// Pinto mensaje para retornar a la aplicacion
				$this->session->set_userdata('id', $this->session->userdata('id'));
				$this->session->set_userdata('auxiliar', 'orderConsolidatedTwo');
				redirect(base_url() . $redirect);
			}
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function validateStateProcess($idOrden)
	{
		/**
		 * Valido el estado para continuar con el proceso y cerrar los estados
		 */

		// Actualizo el valor OPCION, para la relacion del estado ordenar para cada orden
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "OPCION", $this->encryption->encrypt('orderConsolidation'), "ID_ORDEN", $idOrden, $this->session->userdata('usuario'));
			// Verifico si se tienen ordenes a las cuales se les debe configurar el despiece de elementos
			$idOrdActEst = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTEST", "ID", "ID_ORDEN", $idOrden);
			$idTordProEst = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDACTEST", "ID_TORDPROEST", "ID_ORDEN", $idOrden);
			if ($this->OrdersModel->getQuantityElementsOrder($idOrden) > 0) {
				// Solo creo el mensaje para los que tienen despiece
				$this->OrdersModel->insertOrderStateObservation($idOrdActEst, ORDER_OBSERVATION_2, $this->encryption->encrypt(ORDER_OBSERVATION_TEXT_2), $this->session->userdata('usuario'));
			} else {
				// Para los que no tienen despiece
				$this->OrdersModel->insertOrderStateObservation($idOrdActEst, ORDER_OBSERVATION_1, $this->encryption->encrypt(ORDER_OBSERVATION_TEXT_1), $this->session->userdata('usuario'));
				// Se cierra el estado actual de la Orden
				$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", CLOSE_STATE, "ID", $idOrdActEst, $this->session->userdata('usuario'));
				// Se crean los nuevos estados para esto tomo la orden y el estado actual, y el estado de relacion
				$this->defineOrderNewStates($idOrden, $idTordProEst, $idOrdActEst);
			}
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function defineOrderNewStates($idOrden, $idTordProEst, $idOrdActEst)
	{
		/**
		 * Creo los nuevos estados para la orden $idOrden
		 */

		if ($this->session->userdata('login') == 'SI') {
			// Obtiene relacion de estados siguientes
			$relationState = $this->OrdersModel->selectNextStatesProcess($idTordProEst, NORMAL_FLOW);
			foreach ($relationState as $value) {
				echo "ORDEN: " . $idOrden . " ORIGEN: " . $value->ID_INICIO . " FIN: " . $value->ID_FIN . "<br>";
				// Verificar si el estado ya ha sido creado en otra ocasion
				$cantidad = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, 'ID_TORDPROEST', $value->ID_FIN, "MOMENTO", OPEN_STATE);
				// Determinando el estado
				$tempo = $value->ID_FIN;
				$tempoEstado = $this->FunctionsGeneral->getFieldFromTableNotId('ORD_TORDPROEST', 'ID_ESTADO', "ID", $tempo);
				$tipoEstado = $this->FunctionsGeneral->getFieldFromTableNotId('ORD_ESTADOS', 'TIPOESTADO', "ID", $tempoEstado);
				echo $cantidad . " " . $value->ID_FIN . "<br>";
				if ($cantidad == 0) {
					if ($tipoEstado != TYPE_STATE_END_ERROR) {
						if ($tempoEstado != STATE_SUSPEND) {
							// Obteniendo estados anteriores
							$estadosAnteriores = $this->OrdersModel->selectLastStatesProcess($tempo, NORMAL_FLOW);
							//print_r($estadosAnteriores);
							if ($estadosAnteriores != null) {
								if (count($estadosAnteriores) > 1) {
									$cantidadEstadosAnteriores = count($estadosAnteriores) - 1;
								} else {
									$cantidadEstadosAnteriores = count($estadosAnteriores);
								}
							} else {
								$cantidadEstadosAnteriores = 0;
							}

							// Obteniendo cantidad de estados anteriores que ya se han cerrado
							$validador = $this->validaEstadosParalelos($idOrden, $estadosAnteriores);
							echo "----------------" . $validador . " " . $cantidadEstadosAnteriores . "----------------<br>";
							if ($cantidadEstadosAnteriores == $validador) {
								// Creo estado siguiente
								$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $tempo);
								$this->OrdersModel->insertOrderState(
									$idOrden,
									$tempo,
									OPEN_STATE,
									$this->encryption->encrypt(OPC_ABI),
									$contador,
									$this->session->userdata('usuario')
								);
								// Se envia correo electronico
								$this->sendTraceMail($idOrden, $idTordProEst, $tempo);
							} else {
								// Se envia alerta
								$this->sendTraceMail($idOrden, $idTordProEst, $tempo);
							}
						} else {
							// Inserto el estado suspender, este no genera alerta
							$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $tempo);
							$this->OrdersModel->insertOrderState($idOrden, $tempo, OPEN_STATE, $this->encryption->encrypt(OPC_ABI), $contador, $this->session->userdata('usuario'));
						}
					} else {
						// Inserto el estado cancelar, este no genera alerta
						$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $tempo);
						$this->OrdersModel->insertOrderState($idOrden, $tempo, OPEN_STATE, $this->encryption->encrypt(OPC_ABI), $contador, $this->session->userdata('usuario'));
					}
				}
			}
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function validaEstadosParalelos($idOrden, $estadosAnteriores)
	{
		/**
		 * Valida para los estados Anteriores que se encuentran en el arreglo
		 * $estadosAnteriores cuantos de estos se encuentran cerrados
		 */
		if ($this->session->userdata('login') == 'SI') {


			if ($estadosAnteriores != null) {
				$validador = 0;
				foreach ($estadosAnteriores as $value) {
					//Valido si es ordenar
					if ($this->FunctionsGeneral->getFieldFromTableNotId('ORD_TORDPROEST', 'ID_ESTADO', "ID", $value->ID_INICIO) == ORDER_STATE) {
						$validador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, 'ID_TORDPROEST', $value->ID_INICIO, "MOMENTO", OPEN_STATE) +
							$this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, 'ID_TORDPROEST', $value->ID_INICIO, "MOMENTO", CLOSE_STATE);
					} else {
						$validador = $validador + $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, 'ID_TORDPROEST', $value->ID_INICIO, "MOMENTO", OPEN_STATE);
					}
				}
			}

			return $validador;
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function saveTraceOrder()
	{
		/**
		 * Rutina para guardar el estado de la orden, de acuerdo al seguimiento realizado
		 */
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			//Obtengo el id de la relacion actual del estado con la orden
			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
			$idOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idOrden')));
			$tipo = $this->security->xss_clean($this->input->post('tipo'));
			$estado = $this->security->xss_clean($this->input->post('estado'));
			$cierra = $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "CIERRA", $tipo);
			$tipoObservacion = $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "TIPOOBSE", $tipo);

			$information = $this->OrdersModel->getStateRelatationFromOrderState(
				$idOrden,
				$estado
			);

			$tempo = '';
			$mensaje = '';


			//Guardo la observacion
			$idObs = $this->OrdersModel->insertOrderStateObservation(
				$information->ID,
				$tipo,
				$this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion'))),
				$this->session->userdata('usuario')
			);

			//Valido que no exista la relacion 
			if ($this->FunctionsGeneral->getQuantityFieldFromTable(
				"ORD_ORDENEQUIPO",
				"ID_TORDPROEST",
				$information->ID_TORDPROEST,
				"ID_USUARIO",
				$this->session->userdata('usuario')
			) == 0) {
				//Inserto equipo de trabajo
				$this->OrdersModel->insertOrderTeamList($information->ID_TORDPROEST, $this->session->userdata('usuario'), $this->session->userdata('usuario'));
			}

			//Guardo adjunto
			//TODO
			$mi_archivo = 'adjunto';
			$config['upload_path'] = ORDERS_FOLDER;
			if (!is_dir($config['upload_path'])) {
				mkdir($config['upload_path'], 777);
			}
			$config['file_name'] = $idOrden . "_" . $estado . "_" . $idObs;
			$config['allowed_types'] = "pdf";
			$config['max_size'] = "50000";
			$config['max_width'] = "2000";
			$config['max_height'] = "2000";
			$this->load->library('upload', $config);
			$tempo = '';
			if (!$this->upload->do_upload($mi_archivo)) {
				//*** ocurrio un error
				$data['uploadError'] = $this->upload->display_errors();
				$tempo = $this->upload->display_errors();
			}
			$data['uploadSuccess'] = $this->upload->data();
			//echo $tempo;
			if ($tempo == '') {
				//Indico que se ha cargado un archivo
				$this->FunctionsGeneral->updateByField(
					"ORD_ORDACTESTOBS",
					"ADJUNTO",
					$this->encryption->encrypt($config['file_name']),
					"ID",
					$idObs,
					$this->session->userdata('usuario')
				);
			}
			$mensaje = "";

			//Valido si es proceso o reproceso
			if ($tipoObservacion == CTE_VALOR_PROCESO) {
				if ($estado == STATE_CORRECT) {
					//Cierro el estado de la orden
					$this->FunctionsGeneral->updateByField(
						"ORD_ORDACTEST",
						"MOMENTO",
						CLOSE_STATE,
						"ID_ORDEN",
						$idOrden,
						$this->session->userdata('usuario'),
						"ID_TORDPROEST",
						$information->ID_TORDPROEST
					);
					//Cierro la orden
					$this->FunctionsGeneral->updateByID("ORD_ORDEN", "ESTADO", CLOSE_STATE, $idOrden, $this->session->userdata('usuario'));

					//Indico que retorno a la pogina del listado de ordenes
					$mensaje = "orderEndCorrect";
				} else if ($estado == STATE_CANCEL) {
					//Cierro el estado de la orden
					$this->FunctionsGeneral->updateByField(
						"ORD_ORDACTEST",
						"MOMENTO",
						CLOSE_STATE,
						"ID_ORDEN",
						$idOrden,
						$this->session->userdata('usuario'),
						"ID_TORDPROEST",
						$information->ID_TORDPROEST
					);
					//Cierro la orden
					$this->FunctionsGeneral->updateByID("ORD_ORDEN", "ESTADO", CANCEL_STATE, $idOrden, $this->session->userdata('usuario'));
					//Indico que retorno a la pogina del listado de ordenes
					$mensaje = "orderEndCancel";
				} else if ($estado == STATE_SUSPEND) {
					if ($tipo != SUSPEND_OBSERVATION) {
						//Rutina para suspender la orden, por tal razon lo que se va hacer es suspender los estados que eston Abiertos
						$this->FunctionsGeneral->updateByField(
							"ORD_ORDACTEST",
							"MOMENTO",
							SUSPEND_STATE,
							"ID_ORDEN",
							$idOrden,
							$this->session->userdata('usuario'),
							"MOMENTO",
							OPEN_STATE
						);
						$mensaje = "orderTraceSuspendState";
					} else {
						//Rutina para retornar la orden, por tal razon lo que se cambian los estados que estaban en S a A
						$this->FunctionsGeneral->updateByField(
							"ORD_ORDACTEST",
							"MOMENTO",
							OPEN_STATE,
							"ID_ORDEN",
							$idOrden,
							$this->session->userdata('usuario'),
							"MOMENTO",
							SUSPEND_STATE
						);
						$mensaje = "orderTraceRetakeProcess";
					}
				} else {
					//Proceso normal. Valido si de acuerdo al tipo de observacion se cierra el estado
					if ($cierra == CTE_VALOR_SI) {
						//El estado se cierra, se debe abrir los siguientes
						$this->defineOrderNewStates($idOrden, $information->ID_TORDPROEST, $information->ID);
						//Cierro el estado de la orden
						$this->FunctionsGeneral->updateByField(
							"ORD_ORDACTEST",
							"MOMENTO",
							CLOSE_STATE,
							"ID_ORDEN",
							$idOrden,
							$this->session->userdata('usuario'),
							"ID_TORDPROEST",
							$information->ID_TORDPROEST
						);
						//Mensaje indicando que se ha realizado el seguimiento de la orden y se ha cerrado el estado y creado unos nuevos
						$mensaje = "orderTraceChangeState";
					} else {
						//Mensaje indicando que se ha realizado el seguimiento de la orden y esto continoa abierta

						$mensaje = "orderTraceNotChangeState";
					}
				}
			} else {
				//Reproceso
				//Cierro el estado de la orden
				$this->FunctionsGeneral->updateByField(
					"ORD_ORDACTEST",
					"MOMENTO",
					CLOSE_STATE,
					"ID_ORDEN",
					$idOrden,
					$this->session->userdata('usuario'),
					"ID_TORDPROEST",
					$information->ID_TORDPROEST
				);
				//cREO EL ESTADO EN REPROCESO
				$tempo = $this->security->xss_clean($this->input->post('reproceso'));
				$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $tempo);
				$this->OrdersModel->insertOrderState(
					$idOrden,
					$tempo,
					OPEN_STATE,
					$this->encryption->encrypt(OPC_ABI),
					$contador,
					$this->session->userdata('usuario')
				);
				$mensaje = "orderTraceBackOk";
			}

			// Se envia correo electronico

			//$this->sendTraceMail ( $idOrden, $information->ID_TORDPROEST, $tempo );

			if ($this->security->xss_clean($this->input->post('despiece')) == CTE_VALOR_SI) {
				//direcciono a la p�ginpa para modificar despiece
				$mainPage = "OrdersAppOrder/modifyElementOfProductsTrace/";
				// Redirecciono para cambio de clave
				$redirect = $mainPage . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt($idOrden);
			} else {
				//Retorno a la p�gina del listado de ordenes
				$mainPage = "OrdersAppOrder/orderList/";
				// Redirecciono para cambio de clave
				$redirect = $mainPage . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt('seguimiento');
			}
			// Pinto mensaje para retornar a la aplicacion
			$this->session->set_userdata('id', $this->session->userdata('id'));
			$this->session->set_userdata('auxiliar', $mensaje);
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function saveMassiveTrace()
	{
		/** Rutina para guardar la informaci�n de las ordenes a las cuales se les hace seguimiento en bloque*/
		$mainPage = "OrdersAppTraceOrder/board";
		if ($this->session->userdata('login') == 'SI') {

			//Obtengo las ordenes seleccionadas
			$data = $this->OrdersModel->selectOrdersFromState($this->security->xss_clean($this->input->post('estado')));
			if ($data != null) {
				foreach ($data as $value) {
					$tempo = $this->security->xss_clean($this->input->post('valor' . $value->ID));
					if ($tempo == 'on') {
						//Guardo y genero el estado siguiente
						// echo $value->ID."<br>";


						$tipo = $this->security->xss_clean($this->input->post('tipo'));
						$estado = $this->FunctionsGeneral->getFieldFromTable("ORD_TORDPROEST", "ID_ESTADO", $this->security->xss_clean($this->input->post('estado')));
						$cierra = $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "CIERRA", $tipo);
						$tipoObservacion = $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "TIPOOBSE", $tipo);

						$information = $this->OrdersModel->getStateRelatationFromOrderState(
							$value->ID,
							$estado
						);
						print_r($information);
						//Guardo la observacion
						$idObs = $this->OrdersModel->insertOrderStateObservation(
							$information->ID,
							$tipo,
							$this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion'))),
							$this->session->userdata('usuario')
						);

						//Valido que no exista la relacion
						if ($this->FunctionsGeneral->getQuantityFieldFromTable(
							"ORD_ORDENEQUIPO",
							"ID_TORDPROEST",
							$information->ID_TORDPROEST,
							"ID_USUARIO",
							$this->session->userdata('usuario')
						) == 0) {
							//Inserto equipo de trabajo
							$this->OrdersModel->insertOrderTeamList($information->ID_TORDPROEST, $this->session->userdata('usuario'), $this->session->userdata('usuario'));
						}

						$idOrden = $value->ID;
						//Valido si es proceso o reproceso
						if ($tipoObservacion == CTE_VALOR_PROCESO) {
							if ($estado == STATE_CORRECT) {
								//Cierro el estado de la orden
								$this->FunctionsGeneral->updateByField(
									"ORD_ORDACTEST",
									"MOMENTO",
									CLOSE_STATE,
									"ID_ORDEN",
									$idOrden,
									$this->session->userdata('usuario'),
									"ID_TORDPROEST",
									$information->ID_TORDPROEST
								);
								//Cierro la orden
								$this->FunctionsGeneral->updateByID("ORD_ORDEN", "ESTADO", CLOSE_STATE, $idOrden, $this->session->userdata('usuario'));
							} else if ($estado == STATE_CANCEL) {
								//Cierro el estado de la orden
								$this->FunctionsGeneral->updateByField(
									"ORD_ORDACTEST",
									"MOMENTO",
									CLOSE_STATE,
									"ID_ORDEN",
									$idOrden,
									$this->session->userdata('usuario'),
									"ID_TORDPROEST",
									$information->ID_TORDPROEST
								);
								//Cierro la orden
								$this->FunctionsGeneral->updateByID("ORD_ORDEN", "ESTADO", CANCEL_STATE, $idOrden, $this->session->userdata('usuario'));
							} else if ($estado == STATE_SUSPEND) {
								if ($tipo != SUSPEND_OBSERVATION) {
									//Rutina para suspender la orden, por tal razon lo que se va hacer es suspender los estados que eston Abiertos
									$this->FunctionsGeneral->updateByField(
										"ORD_ORDACTEST",
										"MOMENTO",
										SUSPEND_STATE,
										"ID_ORDEN",
										$idOrden,
										$this->session->userdata('usuario'),
										"MOMENTO",
										OPEN_STATE
									);
								} else {
									//Rutina para retornar la orden, por tal razon lo que se cambian los estados que estaban en S a A
									$this->FunctionsGeneral->updateByField(
										"ORD_ORDACTEST",
										"MOMENTO",
										OPEN_STATE,
										"ID_ORDEN",
										$idOrden,
										$this->session->userdata('usuario'),
										"MOMENTO",
										SUSPEND_STATE
									);
								}
							} else {
								//Proceso normal. Valido si de acuerdo al tipo de observacion se cierra el estado
								if ($cierra == CTE_VALOR_SI) {
									//El estado se cierra, se debe abrir los siguientes
									$this->defineOrderNewStates($idOrden, $information->ID_TORDPROEST, $information->ID);
									//Cierro el estado de la orden
									$this->FunctionsGeneral->updateByField(
										"ORD_ORDACTEST",
										"MOMENTO",
										CLOSE_STATE,
										"ID_ORDEN",
										$idOrden,
										$this->session->userdata('usuario'),
										"ID_TORDPROEST",
										$information->ID_TORDPROEST
									);
								}
							}
						} else {
							//Reproceso
							//Cierro el estado de la orden
							$this->FunctionsGeneral->updateByField(
								"ORD_ORDACTEST",
								"MOMENTO",
								CLOSE_STATE,
								"ID_ORDEN",
								$idOrden,
								$this->session->userdata('usuario'),
								"ID_TORDPROEST",
								$information->ID_TORDPROEST
							);
							//cREO EL ESTADO EN REPROCESO
							$temporal = $this->security->xss_clean($this->input->post('reproceso'));
							$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $temporal);
							$idOrdenEstado = $this->OrdersModel->insertOrderState(
								$idOrden,
								$temporal,
								OPEN_STATE,
								$this->encryption->encrypt(OPC_ABI),
								$contador,
								$this->session->userdata('usuario')
							);
						}

						// Se envia correo electronico
						$this->sendTraceMail($idOrden, $information->ID_TORDPROEST, $temporal);
					}
				}
			}
			$mensaje = "saveMassiveTrace";
			// Redirecciono para cambio de clave
			$mainPage = "OrdersAppTraceOrder/board";
			$redirect = $mainPage;
			$estado = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TORDPROEST", "ID_ESTADO", "ID", $this->security->xss_clean($this->input->post('estado')));
			$nombreEstado = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ESTADOS", "NOMBRE", "ID", $estado);
			// Pinto mensaje para retornar a la aplicacion
			$this->session->set_userdata('id', $nombreEstado);
			$this->session->set_userdata('auxiliar', $mensaje);
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function saveUpdateElementsOfProduct()
	{
		/**
		 * Rutina para actualizar la informaci�n del despiece
		 */

		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			//Obtengo el id de la relacion actual del estado con la orden
			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
			$idOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idOrden')));

			//Lista de elementos
			$despiece = $this->OrdersModel->getListElementOfProductOrder($idOrden);
			foreach ($despiece as $value) {
				//Recorro el despiece
				$traslado = $this->security->xss_clean($this->input->post('traslado' . $value->ID));
				//Actualizo el valor del traslado
				if ($traslado != '') {
					$this->FunctionsGeneral->updateByID("ORD_ORDACTDES", "TRASLADO",  $this->encryption->encrypt($traslado), $value->ID,  $this->session->userdata('usuario'));
				}
				$salida = $this->security->xss_clean($this->input->post('salida' . $value->ID));
				//Actualizo el valor de la salida
				if ($salida != '') {
					$this->FunctionsGeneral->updateByID("ORD_ORDACTDES", "SALIDA",  $this->encryption->encrypt($salida), $value->ID,  $this->session->userdata('usuario'));
				}
				$serial = $this->security->xss_clean($this->input->post('serial' . $value->ID));
				//Actualizo el valor del serial
				if ($serial != '') {
					$this->FunctionsGeneral->updateByID("ORD_ORDACTDES", "SERIAL",  $this->encryption->encrypt($serial), $value->ID,  $this->session->userdata('usuario'));
				}
				$lote = $this->security->xss_clean($this->input->post('lote' . $value->ID));
				//Actualizo el valor del lote
				if ($lote != '') {
					$this->FunctionsGeneral->updateByID("ORD_ORDACTDES", "LOTE",  $this->encryption->encrypt($lote), $value->ID,  $this->session->userdata('usuario'));
				}
			}




			//Retorno a la p�gina del listado de ordenes
			$mainPage = "OrdersAppOrder/modifyElementOfProductsTrace/";
			// Redirecciono para cambio de clave
			$redirect = $mainPage . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt($idOrden);
			// Pinto mensaje para retornar a la aplicacion
			$this->session->set_userdata('id', $this->session->userdata('id'));
			$this->session->set_userdata('auxiliar', "saveUpdateElementsOfProduct");
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function sendTraceMail($idOrden, $estadoActual, $estadoSiguiente, $observacion = null)
	{
		/**
		 * TODO Rutina para enviar correo electronico de acuerdo a la alerta generada
		 */

		//echo "Orden".$idOrden," Estado actual: ", $estadoActual," Estado siguiente: ", $estadoSiguiente," Observaci&oacute;n", $observacion."<br>";
		//Verificar los perfiles a los cuales se les debe enviar alerta de correo electr�nico  para el estado $estadoSiguiente

		$type = 'stateChangedOrders';
		$this->load->library('email');


		$perfiles = $this->OrdersModel->selectProfileListFromState($estadoSiguiente);
		//print_r($perfiles);
		if ($perfiles != null) {
			foreach ($perfiles as $value) {
				//Verificar usuarios que tienen dichos perfiles
				$usuario = $this->SystemModel->getListMailFromProfile($value->ID_PERFIL);
			}
			//Enviar alerta
			if ($usuario != null) {
				foreach ($usuario as $val) {
					//Enviar alerta
					if (CTE_CORREO_ELECTRONICO) {
						// 1. Envio informaci�n al correo respectivo
						$tituloCorreo = $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "NOMBRE", 1);
						// Obtengo los datos de acuerdo a la regla de tipo $type
						$emailFrom = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "REMITE", "NOMBRE", $type);
						$emailReplyTo = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "RESPUESTA", "NOMBRE", $type);
						$emailTo = $val->CORREO;
						//Obtengo Asunto y mensaje del correo electr�nico
						$subject = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "ASUNTO", "NOMBRE", $type);
						$messages = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "CUERPO", "NOMBRE", $type);

						//creo valores para la orden
						$orden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ORDENESACTUALES", "PREFIJO", "ID", $idOrden) . " - " . $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ORDENESACTUALES", "CONS", "ID", $idOrden);

						//Obtengo el estado al cual ira la orden
						$estado = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TORDPROEST", "ID_ESTADO", "ID", $estadoSiguiente);
						$estado = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ESTADOS", "NOMBRE", "ID", $estado);

						//Obbtengo datos del paciente
						$historia = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ORDENESACTUALES", "HISTORIA", "ID", $idOrden);
						$historia = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
							"T_ADMISIONES",
							"ID_PCTE_ADM",
							"ID_AMSION",
							$historia
						);
						$paciente = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
							"T_PACIENTES",
							"PRI_NOM_PCTE",
							"ID_PCTE",
							$historia
						) . " " .
							$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
								"T_PACIENTES",
								"SEG_NOM_PCTE",
								"ID_PCTE",
								$historia
							) . " " .
							$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
								"T_PACIENTES",
								"PRI_APELL_PCTE",
								"ID_PCTE",
								$historia
							) . " " .
							$this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud(
								"T_PACIENTES",
								"SEG_APELL_PCTE",
								"ID_PCTE",
								$historia
							);

						//Defino comidines y remplazos
						$comodines = array(CTE_JOCKER_ORDER, CTE_JOCKER_STATE, CTE_JOCKER_PATIENT);
						$remplazos = array($orden, $estado, $paciente);
						//Reemplazo comodines para el mensaje
						$messages = str_replace($comodines, $remplazos, $messages);
						$subject = str_replace($comodines, $remplazos, $subject);

						$body = paintMessageMail($this, $tituloCorreo, $messages, null, $type);
						//echo $emailTo." ".$body."<br>";

						// Also, for getting full html you may use the following internal method:
						// $body = $this->email->full_html($subject, $message);
						$result = $this->email->from($emailFrom)->reply_to($emailReplyTo)
							-> // Optional, an account where a human being reads.
							to($emailTo)
							->subject($subject)
							->message($body)
							->send();
						print_r($result);
						// echo $page."<br>";
					}
				}
			}
		}
	}
}
