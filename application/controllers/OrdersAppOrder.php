<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                    Juan Carlos Escobar Baquero
 Correo electronico:            jcescobarba@gmail.com
 Creacion:                      27/02/2018
 Modificacion:                  2019/11/06
 Proposito:                     Controlador para la gestion de ordenes en el proceso de ordenar.
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
		$this->load->model('StokePriceModel'); // Librerias del sistema
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
			// Pinto la cabecera principal de laspaginas internas
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
			// Pinto la lista generica de parametros que se debe tener en cuenta dentro del sistema de parometros
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
			// Pinto la cabecera principal de laspaginas internas
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

	public function orderFromRequest()
	{
		/**
		 * Ordenar desde cotizaci�n.
		 */

		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/orderFromRequest";
		$this->load->model('StokePriceModel');
		if ($this->session->userdata('login') == 'SI') {
			// Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
			$data = null;
			// Pinto la cabecera principal de las p�ginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", "date");
			// Pinto la informaci�n de los parametros de la aplicaci�n

			/**
			 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
			 */
			$data['mainPage'] = $mainPage;
			$data['board'] = "Valores parametrizados";
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);

			$periodo = $this->security->xss_clean($this->input->post('periodo'));
			if ($periodo != '') {
				$fechas = explode(' - ', $periodo);
				$fechaInicial = $fechas[0];
				$fechaFin = $fechas[1];
			} else {
				if ($this->session->userdata('variable1') == '') {
					// Lista de listas
					$meses = defineArrayMeses();
					$mes = date('n');
					/*
                     * $fechaInicial = "01/" . $meses[$mes][2] . "/" . date('Y');
                     * $fechaFin = $meses[$mes][3] . "/" . $meses[$mes][2] . "/" . date('Y');
                     */

					$fechaInicial = date('Y') . "/" . $meses[$mes][2] . "/01";
					$fechaFin = date('Y') . "/" . $meses[$mes][2] . "/" . $meses[$mes][3];
					$tempoFecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fechaFin) + 1;
					$fechaFin = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $tempoFecha);
				} else {
					$fechaInicial = $this->session->userdata('variable1');
					$fechaFin = $this->session->userdata('variable2');
					$tempoFecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fechaFin) + 1;
					$fechaFin = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $tempoFecha);
				}
			}
			$this->session->set_userdata('variable1', $fechaInicial);
			$this->session->set_userdata('variable2', $fechaFin);
			$data['fechaInicial'] = $this->session->userdata('variable1');
			$data['fechaFinal'] = $this->session->userdata('variable2');
			$condicion = "and VIEW_MAL.FECHA_SOLICITUD between '" . $this->session->userdata('variable1') . "' and '" . $this->session->userdata('variable2') . "'";

			$data['listaLista'] = $this->StokePriceModel->selectListStokePriceFromRequest($condicion, 5);
			$data['fecha'] = cambiaHoraServer(2);

			// Pinto plantilla principal
			$this->load->view('stokePrice/operation/boardOrdersAppOrderStokePrice', $data);
			$this->load->view('validation/stokePrice/process/boardStokePriceValidation', $data);

			/**
			 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la p�gina (p�ginas internas)
			showCommonEnds($this, null, null);
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

			// Pinto la cabecera principal de laspaginas internas
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

			// Pinto la cabecera principal de laspaginas internas
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

	public function createOrder($id, $opcion = null, $idEncorden = null)
	{
		/**
		 * Listo los diferentes pacientes que se han encontrado con los datos datos
		 */
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// echo "<center> Proceso: ".$this->session->userdata('proceso')." Brigada: ".$this->session->userdata('brigada')."</center>";

			$id = $this->encryption->decrypt($id);
			$idEncorden = $this->encryption->decrypt($idEncorden);
			if ($idEncorden != null) {
				$this->session->set_userdata('encOrden', $idEncorden);
				$this->session->set_userdata('action', "order");
				$this->session->set_userdata('pagina', "OrdersAppOrder/paintSearch");
			}
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);
			// echo " aqui ".$this->session->userdata('id');

			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;

			$data['mainPage'] = $mainPage;
			// Pinto la cabecera principal de laspaginas internas
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
			foreach ($data['paciente'] as $value) {
				$value->NUM_ID_PCTE;
				//echo "<script>console.log('ADMISION_STATE_ACTIVE1: " . $value->NUM_ID_PCTE . "' );</script>";
			}


			// Arbol para cambiar
			$route = "OrdersAppOrder/formNewOrder/" . $this->encryption->encrypt($id) . "/";
			echo "<script>console.log('OrdersAppOrder/formNewOrde: " . $id . "' );</script>";
			$data['route'] = $route;
			// Nombre del proceso
			$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->session->userdata('proceso'));

			// Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de parometros


			if ($opcion == null) {
				// Primera orden // aca es el arbol
				$data['arbol'] = $this->OrdersModel->selectTreeInformation($route, 0, 'nestable', $this->session->userdata('proceso'));
				$this->load->view('orders/process/boardCreateOrder', $data);
			} else {
				// Ordenes creadas hasta el momento
				echo "<script>console.log('ADMISION_STATE_ACTIVE1: " . $value->NUM_ID_PCTE . "' );</script>";
				$data['listaLista'] = $this->OrdersModel->selectListOrdersFromHead($this->session->userdata('encOrden'), $value->NUM_ID_PCTE);
				//$data['encOrden'] = $this->session->userdata('encOrden');
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
			// Pinto la cabecera principal de laspaginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion
			// Incluyo el Nestable
			$data['variable'] = 0;
			// $this->load->view ( 'common/nestableScripts', $data );

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
			echo "<script>console.log('ADMISION_STATE_ACTIVE2: " . $id . "' );</script>";

			// Pinto informacion del formulario
			// Listado de anteriores.
			$data['listadoAnteriores'] = $this->OrdersModel->selectOrdersPredecessor($id);
			$data['anterior'] = null;

			// Listado de DIAGNoSTICOS cie10
			$data['listaDiagnostico'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_DIAGNOSTICO", 'DESC');
			$data['cie10'] = null;

			//lista de procesos y convenios
			$data['listaAliada'] = $this->FunctionsAdmin->selectEmpresaAliada();
			$data['listaProcesos'] = $this->OrdersModel->selectQuantityOrderByProcess();

			//Lista de departamento y ciudades
			$data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
			$data['listaCiudad'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_MUNICIPIO");

			// Listado de DIAGNoSTICOS cie10
			$data['listaCausas'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_CAUSAENFERMEDAD", 'DESC');
			$data['causa'] = null;

			$data['claseTipo'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "ID_CLASETIPO", "ID", $tipoOrden);

			if ($data['claseTipo'] == 3) {
				$idMiembro = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOMIEM", "ID_MIEMBROS", "ID_TIPOORDEN", $tipoOrden);
				$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
				$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
				$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);

				// para saber que documento muestro superior o inferior
				$data['tipoMiembro'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOL_ZS", "MIEMBROSNOMBRE", "TIPOORDENID", $tipoOrden);
				echo "<script>console.log('tipoMiembro1: " . $data['tipoMiembro'] . "' );</script>";

				// Nombre del miembro seleccionado
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOL_ZS", "NIVELAMP", "TIPOORDENID", $tipoOrden);
				// Nombre del miembro seleccionado - DETALLE
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_GRUELEM", "NOMBRE", "ID", $idArbol);

				$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);

				// echo $idArbol;

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
			// Tipo de orden
			$data['tipoOrden'] = $this->encryption->encrypt($tipoOrden);;

			// Nombre del proceso
			$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->session->userdata('proceso'));
			$data['adjunto1'] = null;
			$data['adjunto2'] = null;

			//Valido si el estado ordenar tiene campos adicionales definidos

			$data['campo1'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC1", ORDER_STATE);
			$data['campo2'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC2", ORDER_STATE);
			$data['campo3'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC3", ORDER_STATE);
			$data['campo4'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC4", ORDER_STATE);
			$data['campo5'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC5", ORDER_STATE);

			//Id Cotización
			$data['idCotizacionPlano'] = null;
			$data['idCotizacion'] = null;
			$data['validador'] = 1;

			// Listado de empresas
			$condicion = "and COT_TARIFAEMPRESA.ESTADO='" . ACTIVO_ESTADO . "'";
			$data['listaEmpresa'] = $this->StokePriceModel->selectListDefineRelationCompanyRates($condicion);

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

	public function newOrderFromRequest($id, $idHC)
	{
		/**
		 * Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado
		 */

		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/orderFromRequest";
		$this->load->model('StokePriceModel');
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			$id = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID", $this->encryption->decrypt($id));
			if ($id != '') {
				// Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
				$data = null;
				// Pinto la cabecera principal de las p�ginas internas
				showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", "date");

				/**
				 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
				 */

				// Cargo la informaci�n de la cotizaci�n consecutivo
				$data['consecutivo'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id);
				$data['estado'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ESTADO", $id);
				$data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "FECHA", $id);
				$empresa = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_EMPRESA", $id);
				$empresaCoti = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);
				$data['empresaCoti'] = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresaCoti);

				// Datos del usuario
				$idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIOCOTI", "ID_USUARIO", "ID_COTIZACION", $id);
				$data['documento'] = $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "DOCUMENTO", $idUsuario);
				$data['paciente'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "NOMBRES", $idUsuario)) . " " . $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "APELLIDOS", $idUsuario));
				$data['tipoDocumento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TIPODOC", $idUsuario));


				// Detalle de la cotizaci�n
				$data['listaDetalle'] = $this->StokePriceModel->selectListStokePriceDetail($id);

				$data['id'] = $id;
				$data['hc'] = $this->encryption->decrypt($idHC);
				// echo $data['id'];

				// Cargo vista

				$this->load->view('stokePrice/operation/formStokePriceToOrder', $data);
				/**
				 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
				 */

				// Pinto el final de la p�gina (p�ginas internas)
				showCommonEnds($this, null, null);
			} else {
				// Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
				$this->session->set_userdata('id', $id);
				$this->session->set_userdata('auxiliar', "notInformationGeneral");
				// Redirecciono la p�gina
				redirect(base_url() . $mainPage);
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function selectedFromRequest($id, $idCotizacion, $idArbol, $tipoOrden = null, $codigo)
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
			// Pinto la cabecera principal de laspaginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion
			// Incluyo el Nestable
			$data['variable'] = 0;
			// $this->load->view ( 'common/nestableScripts', $data );

			// Obtengo valor del $id (historia clinica)
			$id = $this->encryption->decrypt($id);

			// Obtengo valor del $id (historia clinica)
			// ECHO $idCotizacion;
			$idCotizacion = $this->encryption->decrypt($idCotizacion);
			$data['idCotizacionPlano'] = $idCotizacion;
			// ECHO "<BR>".$idCotizacion."<BR>";
			// Defino proceso
			$idSolicitud = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_SOLICITUD", "ID", $idCotizacion);

			//Cargo informaci�n de la solicitud de cotizaci&oacute;n para los archivos adjuntos
			$data['adjunto1'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO1", "ID", $idSolicitud));
			$data['adjunto2'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO2", "ID", $idSolicitud));


			$idProceso = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_PROCESO", "ID", $idSolicitud);
			// Inicializo la variable de proceso
			$this->session->set_userdata('proceso', $idProceso);

			// Obtengo ide del valor del arbol
			$idArbol = $this->encryption->decrypt($idArbol);

			// Obtenogo ide del tipo de orden
			$tipoOrden = $this->encryption->decrypt($tipoOrden);

			// Obtenogo codigo ordenado
			$codigo = $this->encryption->decrypt($codigo);

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
			echo "<script>console.log('ADMISION_STATE_ACTIVE3: " . $id . "' );</script>";

			// Pinto informacion del formulario
			// Listado de anteriores.
			$data['listadoAnteriores'] = $this->OrdersModel->selectOrdersPredecessor($id);
			$data['anterior'] = null;

			//Lista de ciudad y departamento
			$data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
			$data['listaCiudad'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_MUNICIPIO");

			//lista de procesos y convenios
			$data['listaAliada'] = $this->FunctionsAdmin->selectEmpresaAliada();
			$data['listaProcesos'] = $this->OrdersModel->selectQuantityOrderByProcess();

			// Listado de DIAGNoSTICOS cie10
			$data['listaDiagnostico'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_DIAGNOSTICO", 'DESC');
			$data['cie10'] = null;
			// Listado de DIAGNoSTICOS cie10
			$data['listaCausas'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_CAUSAENFERMEDAD", 'DESC');
			$data['causa'] = null;
			// para saber que documento muestro superior o inferior
			$data['tipoMiembro'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOL_ZS", "MIEMBROSNOMBRE", "TIPOORDENID", $tipoOrden);
			echo "<script>console.log('tipoMiembro2: " . $data['tipoMiembro'] . "' );</script>";

			$data['claseTipo'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "ID_CLASETIPO", "ID", $tipoOrden);
			if ($data['claseTipo'] == 3) {
				$idMiembro = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOMIEM", "ID_MIEMBROS", "ID_TIPOORDEN", $tipoOrden);
				$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
				$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
				$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);


				// Nombre del miembro seleccionado
				$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOL_ZS", "NIVELAMP", "TIPOORDENID", $tipoOrden);
				// Nombre del miembro seleccionado - DETALLE
				$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_GRUELEM", "NOMBRE", "ID", $idArbol);

				$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);

				// echo $idArbol;

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
				$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $idArbol);;
				$data['elemento'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID", "CODIGO", $codigo);
				$tempo = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESCRIPCION", "ID", "AUXILIAR", $codigo);
				$data['cantidad'] = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DETALLECOTI", "CANTIDAD", "ID_DESCRIPCION", $tempo, "ID_COTIZACION", $idCotizacion);
				// ECHO $data ['elemento']." TEMPO: ".$tempo,"ID_COTIZACION ".$idCotizacion," CANTIDAD ".$data ['cantidad'];
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
				$condicion = " and ORD_ARBOLCODIGO.CODIGO='$codigo'";
				$data['listaElementosServicios'] = $this->OrdersModel->selectElementsOfTree($idArbol, $condicion);
			}

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

			// Historia clinica
			$data['id'] = $this->encryption->encrypt($id);
			$data['idArbol'] = $this->encryption->encrypt($idArbol);
			// Tipo de orden
			$data['tipoOrden'] = $this->encryption->encrypt($tipoOrden);;

			$data['idCotizacion'] = $this->encryption->encrypt($idCotizacion);
			// Nombre del proceso

			$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->session->userdata('proceso'));

			//Valido si el estado ordenar tiene campos adicionales definidos

			$data['campo1'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC1", ORDER_STATE);
			$data['campo2'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC2", ORDER_STATE);
			$data['campo3'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC3", ORDER_STATE);
			$data['campo4'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC4", ORDER_STATE);
			$data['campo5'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC5", ORDER_STATE);

			$data['claseTipo'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "ID_CLASETIPO", "ID", $tipoOrden);

			$data['validador'] = null;
			// Listado de empresas aliadas
			$data['listaAliada'] = $this->FunctionsAdmin->selectEmpresaAliada();

			// Listado de empresas
			$condicion = "and COT_TARIFAEMPRESA.ESTADO='" . ACTIVO_ESTADO . "'";
			$data['listaEmpresa'] = $this->StokePriceModel->selectListDefineRelationCompanyRates($condicion);


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
			// Pinto la cabecera principal de laspaginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion
			// Incluyo el Nestable
			$data['variable'] = 0;
			$this->load->view('common/nestableScripts', $data);

			// 1. Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);
			echo "<script>console.log('ADMISION_STATE_ACTIVE4: " . $id . "' );</script>";

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
			// Pinto la cabecera principal de laspaginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion

			// 1. Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);
			echo "<script>console.log('ADMISION_STATE_ACTIVE5: " . $id . "' );</script>";

			/**
			 * ************************** INICIO RUTA DEL PRODUCTO O SERVICIO *************************
			 */
			// Obtengo el idArbol asociado
			$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);
			$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $codigo);
			$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $codigo);
			$idArbol = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $codigo);
			$idCotizacion = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $idOrden);
			$data['valueTRM'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_TRM", "VALOR", "ID_COTIZACION", $idCotizacion);
			$data['idcotizacion'] = $idCotizacion;
			//procedimiento para obtener el valor costo despiece y validar con el costo neto de detalle cotizacion 
			//$codigo = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DETALLECOTI", "ID_DESCRIPCION", "ID_COTIZACION", $idCotizacion);
			//$data['valorCostoNetoDespiece'] = $this->StokePriceModel->selectListStokePriceDetail($idCotizacion);
			$valorCostoNetoDespiece = $this->StokePriceModel->selectListStokePriceDetail($idCotizacion);

			$count = count($valorCostoNetoDespiece);

			$data['costoMateriales'] = $valorCostoNetoDespiece[$count - 1]->VALOR;

			$data['idDetalleCoti'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DETALLECOTI", "ID", "ID_COTIZACION", $idCotizacion);

			$data['ValoresCalcCostoDespiece'] = $this->StokePriceModel->selectElementsDetailsFromStokePriceDetails($data['idDetalleCoti']);

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
			$elementsList = $this->OrdersModel->getListElementOfProductOrderValidation($idOrden);
			foreach ($elementsList as $valueElements) {
				$data['elementsDelete'] = $this->encryption->encrypt($valueElements->ID);
			}
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

			// Recibo los valores

			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);
			// Encabezado de la orden
			$idOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idOrden')));

			// Grupo seleccionado
			$grupo = $this->security->xss_clean($this->input->post('grupo'));

			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'elementsOfProduct', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'elementsOfProduct', $idModule, VIEW_BUTTON_PERMISSION);

			$data['mainPage'] = $mainPage;
			// Pinto la cabecera principal de laspaginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informacion de los parametros de la aplicacion

			// 1. Pinto la informacion del paciente
			$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);
			echo "<script>console.log('ADMISION_STATE_ACTIVE6: " . $id . "' );</script>";

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

			// $grupo = $this->FunctionsGeneral->getFieldFromTableNotId ( "ORD_ELEMENTO", "ID_GRUELEM", "ID", $comodin );
			$data['listaProveedores'] = $this->OrdersModel->selectListProvidersElementsFromGroups($grupo);
			// Pinto las caractertisticas
			// Pinto informacion de las caracteristicas
			$data['caracteristicas'] = $this->OrdersModel->selectListCharacteristicsElementGroup($grupo);

			// Pinto plantilla para configurar elemento
			// $data ['idDespiece'] = $this->encryption->encrypt ( $idDespiece );
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
		echo "<script>console.log('id: " . $this->encryption->decrypt($id) . "' );</script>";
		echo "<script>console.log('encOrden: " . $this->encryption->decrypt($encOrden) . "' );</script>";
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
			// Pinto la cabecera principal de laspaginas internas
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
	public function printOrder1($id, $encOrden)
	{
		echo "<script>console.log('id: " . $this->encryption->decrypt($id) . "' );</script>";
		echo "<script>console.log('encOrden: " . $this->encryption->decrypt($encOrden) . "' );</script>";
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

			echo "<script>console.log('encOrden2: " . $encOrden . "' );</script>";
			// Pinto la interfaz para imprimir las ordenes
			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;

			$data['mainPage'] = $mainPage;

			$data['returnPage'] = "OrdersAppOrder/board";
			// Pinto la cabecera principal de laspaginas internas
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
			//$data['listaLista'] = $this->OrdersModel->selectListOrdersFromHead($encOrden, $value->NUM_ID_PCTE);
			$data['listaLista'] = $this->OrdersModel->selectListOrdersFromHead1($encOrden, $value->NUM_ID_PCTE);
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
	public function printOrder2($id, $encOrden)
	{
		echo "<script>console.log('id: " . $this->encryption->decrypt($id) . "' );</script>";
		echo "<script>console.log('encOrden: " . $this->encryption->decrypt($encOrden) . "' );</script>";
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

			echo "<script>console.log('encOrden2: " . $encOrden . "' );</script>";
			// Pinto la interfaz para imprimir las ordenes
			// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
			$mainPage = $this->session->userdata('pagina');
			$data = null;

			$data['mainPage'] = $mainPage;

			$data['returnPage'] = "OrdersAppOrder/board";
			// Pinto la cabecera principal de laspaginas internas
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
			//$data['listaLista'] = $this->OrdersModel->selectListOrdersFromHead($encOrden, $value->NUM_ID_PCTE);
			$data['listaLista'] = $this->OrdersModel->selectListOrdersFromHead1($encOrden, $value->NUM_ID_PCTE);
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
			$this->load->view('orders/process/printOrderInformationPaciente', $data);

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
			// Pinto la cabecera principal de laspaginas internas
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
			echo "<script>console.log('ADMISION_STATE_ACTIVE8: " . $id . "' );</script>";

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
		$this->encryption->decrypt($id);
		echo "<script>console.log('idOrden: " . $this->encryption->decrypt($idOrden) . "' );</script>";
		echo "<script>console.log('id: " . $this->encryption->decrypt($id) . "' );</script>";

		/**
		 * Listo los diferentes pacientes que se han encontrado con los datos datos
		 */
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";
		//echo "<script>console.log('idOrden: " . $this->encryption->decrypt($idOrden) . "' );</script>";

		if ($this->session->userdata('login') == 'SI') {
			// echo "<center> Proceso: ".$this->session->userdata('proceso')." Brigada: ".$this->session->userdata('brigada')."</center>";

			$id = $this->encryption->decrypt($id);
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);

			$data['id'] =  $id;

			$valorValidacion = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_ADMISIONES", "ID_AMSION", "ID_AMSION", $id, "ACTIVO_ADM", 0);

			if ($valorValidacion == '') {

				// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
				$mainPage = $this->session->userdata('pagina');
				$data = null;
				$data['mainPage'] = $mainPage;
				// Pinto la cabecera principal de laspaginas internas
				showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

				/**
				 * Informacion relacionada con la plantilla principal Pinto la pantalla *
				 */

				// Pinto la informacion del paciente
				//$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);
				echo "<script>console.log('ADMISION_STATE_ACTIVE9: " . $id . "' );</script>";
				// Recibo el idOrden
				$idOrden = $this->encryption->decrypt($idOrden);

				$idTordPro = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ID_TORDPRO", "ID", $idOrden);
				$idArbol = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ACTIVIDAD", "ID", $idOrden);
				$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);

				
				$idProceso = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TORDPRO", "ID_PROCESO", "ID", $idTordPro);
				$tipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TORDPRO", "ID_TIPOORDEN", "ID", $idTordPro);
				echo "<script>console.log(tipoOrden: ORD_TORDPRO " . $tipoOrden . "' );</script>";
				// Nombre del proceso
				$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $idProceso);

				$data['ordenNumero'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "PREFIJO", $tipoOrden) . " - " . $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "CONS", $idOrden);
				echo "<script>console.log('data'ordenNumero': " . $data['ordenNumero'] . "' );</script>";
				//cotizacion
				$idCotizacion = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ID_COTIZACION", "ID", $idOrden);
				$idSolicitud = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_SOLICITUD", "ID", $idCotizacion);

				$idaliada = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_ALIADA", "ID", $idSolicitud);

				$data['numeroCotizacion'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "CONSECUTIVO", "ID", $idCotizacion);
				//echo "<script>console.log('idCotizacion': " . $idCotizacion. "' );</script>";
				$data['id_usuario'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIOCOTI", "ID_USUARIO", "ID_COTIZACION", $idCotizacion);
				$data['docpaciente'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "DOCUMENTO", "ID", $data['id_usuario']);
				$data['paciente'] = $this->EsaludModel->getPatientInformation($data['docpaciente'], 6, ADMISION_STATE_ACTIVE);
				$data['numeroAutorizacion'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SEGUIMIENTO", "AUTORIZACION", "ID_COTIZACION", $idCotizacion));
				$dateAutorizacion = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SEGUIMIENTO", "FCREA", "ID_COTIZACION", $idCotizacion);
				$dateCreate = date_create($dateAutorizacion);
				$data['fechaAutorizacion'] = date_format($dateCreate, "Y/m/d");

				if ($this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "ID_CLASETIPO", "ID", $tipoOrden) == 3) {
					$idMiembro = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOMIEM", "ID_MIEMBROS", "ID_TIPOORDEN", $tipoOrden);
					$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
					$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
					$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);

					// Nombre del miembro seleccionado
					$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOL_ZS", "NIVELAMP", "TIPOORDENID", $tipoOrden);
					// Nombre del miembro seleccionado - DETALLE
					$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_GRUELEM", "NOMBRE", "ID", $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "ID_GRUELEM", $codigo));

					$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);

					// echo $idArbol;
					$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "NOMBRE", $codigo);
					$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "CODIGO", $codigo);
					echo "<script>console.log('codigo3: " . $codigo . "' );</script>";
					echo "<script>console.log('codigo3: " . $data['codigo'] . "' );</script>";
				} else {

					/**
					 * ************************** INICIO RUTA DEL PRODUCTO O SERVICIO *************************
					 */
					// Obtengo el idArbol asociado
					$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);
					$data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $codigo);
					$data['codigo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "CODIGO", $codigo);

					$idArbol = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID_ARBOLVALORES", $codigo);
					//echo "<script>console.log('codigo2: " . $codigo . "' );</script>";
					//echo "<script>console.log('codigo2: " . $data['codigo'] . "' );</script>";

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
				// Historia clonica
				$data['id'] = $this->encryption->encrypt($id);
				$data['idOrden'] = $this->encryption->encrypt($idOrden);

				$data['idPinta'] = $idOrden;

				$data['pagina'] = "OrdersAppOrder/orderList";

				//Trae el responsable asociado a la cotizacion
				$idEmpresa = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_RELATION_ORDER_STOKEPRICE", "ID_EMPRESA", "ID_ORDEN",  $idOrden);
				$data['idEmpresaadriana'] = $idEmpresa;
				//echo 'idempresa'.$data['idEmpresaadriana'];
				$data['nombreEmpresaEsalud'] = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $idEmpresa);
				//	echo 'nombreempresa'.$data['nombreEmpresaEsalud'];



				// Pinto el despiece asociado a la orden
				$data['listaLista'] = $this->OrdersModel->getListElementOfProductOrder($idOrden);
				// Pinto avance
				$data['estadosDefinidos'] = $this->OrdersModel->selectOrderStateQuantity($idOrden, 1);
				$data['estadosEjecutados'] = $this->OrdersModel->selectOrderStateQuantity($idOrden, 2);
				// Pinto equipo
				$data['listadoPersonas'] = $this->OrdersModel->selectListPeopleFromOrder($idOrden);

				// Historico de la orden
				$data['listadoHistoria'] = $this->OrdersModel->selectHistoryOrderFull($idOrden);
				$data['autName'] = $this->FunctionsGeneral->getFieldFromTableNotId('ORD_ORDEN', 'NOMBRE_AUTORIZA', 'ID', $idOrden);
				// Pinto la lista genorica de parametros que se debe tener en cuenta dentro del sistema de parometros
				// Pinto los estados siguientes
				//echo "<script>console.log('ID_FINok: " . $idOrden . "' );</script>";
				$data['listadoEstados'] = $this->OrdersModel->selectActualStateFromOrden($idOrden, $this->session->userdata('usuario'));

				// MOdifica despiece
				$data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
				// Retornar de suspendido
				$data['listadoSuspender'] = $this->OrdersModel->selectActualStateFromOrdenFromSuspend($idOrden, $this->session->userdata('usuario'));
				$data['idSuspend'] = SUSPEND_OBSERVATION;
				$data['nombreSuspend'] = $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "NOMBRE", SUSPEND_OBSERVATION);;


				//obtengo el perfil del usuario
				$idRolPerfiL = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_USUROLPER", "ID_ROLPERFIL", "ID_USUARIO",  $this->session->userdata('usuario'));

				$data['perfil'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_ROLPERFIL", "ID_PERFIL", "ID",  $idRolPerfiL);


				$data['perfilDefinido'] = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_PERFILSEGUIMIENTO", "ID", "ID_PERFIL", $data['perfil'], 'ESTADO', ACTIVO_ESTADO);


				$data['listaPadre'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_TIPOBITACORA", 'DESC');

				///echo "<script>console.log('codigo1: " . $data['codigo'] . "' );</script>";
				// para saber que documento muestro nivel
				$data['nivel'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "PRIMERNIVEL", "CODIGO", $data['codigo']);
				///echo "<script>console.log('nivel: " . $data['nivel'] . "' );</script>";

				// Pinto pantalla de seguimiento
				$this->load->view('orders/process/boardTracerOrder', $data);
				// Pinto reglas de validacion
				$this->load->view('validation/orders/process/ordersAppOrderTracerProcessValidation', $data);
				$this->load->view('validation/orders/process/ordersAppOrderTracerProcessValidationBinnacle', $data);

				/**
				 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
				 */

				// Pinto el final de la pogina (poginas internas)
				showCommonEnds($this, null, null);
			} else {
				$mainPage = "MainApp/board/";
				// Redirecciono para cambio de clave
				$redirect = $mainPage;

				$this->session->set_userdata('auxiliar', 'patientInactive');
				redirect(base_url() . $redirect);
			}
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}

	public function updateUserInformation($id, $idOrden)
	{
		/**
		 * Actualizo información de usuario
		 */
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";

		if ($this->session->userdata('login') == 'SI') {
			// echo "<center> Proceso: ".$this->session->userdata('proceso')." Brigada: ".$this->session->userdata('brigada')."</center>";

			$id = $this->encryption->decrypt($id);
			// Asigno el valor a la cookie de historia clonica
			$this->session->set_userdata('id', $id);

			$data['id'] =  $id;

			$valorValidacion = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_ADMISIONES", "ID_AMSION", "ID_AMSION", $id, "ACTIVO_ADM", 0);

			if ($valorValidacion == '') {

				// Pinto las vistas adicionales a travos de la funcion pintaComun del helper hospitium
				$mainPage = $this->session->userdata('pagina');
				$data = null;
				$data['mainPage'] = $mainPage;
				// Pinto la cabecera principal de laspaginas internas
				showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

				/**
				 * Informacion relacionada con la plantilla principal Pinto la pantalla *
				 */

				// Pinto la informacion del paciente
				$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);
				echo "<script>console.log('ADMISION_STATE_ACTIVE10: " . $id . "' );</script>";
				// Recibo el idOrden
				$idOrden = $this->encryption->decrypt($idOrden);

				$idTordPro = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ID_TORDPRO", "ID", $idOrden);
				$idArbol = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ACTIVIDAD", "ID", $idOrden);
				$codigo = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ACTIVIDAD", $idOrden);
				// ECHO $codigo;
				$idProceso = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TORDPRO", "ID_PROCESO", "ID", $idTordPro);
				$tipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TORDPRO", "ID_TIPOORDEN", "ID", $idTordPro);
				// Nombre del proceso
				$data['tipoProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $idProceso);

				$data['ordenNumero'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "PREFIJO", $tipoOrden) . " - " . $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "CONS", $idOrden);
				//cotizacion
				$idCotizacion = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ORDEN", "ID_COTIZACION", "ID", $idOrden);
				$idSolicitud = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_SOLICITUD", "ID", $idCotizacion);

				$idaliada = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_ALIADA", "ID", $idSolicitud);

				$data['numeroCotizacion'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "CONSECUTIVO", "ID", $idCotizacion);
				$data['numeroAutorizacion'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SEGUIMIENTO", "AUTORIZACION", "ID_COTIZACION", $idCotizacion));
				$dateAutorizacion = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SEGUIMIENTO", "FCREA", "ID_COTIZACION", $idCotizacion);
				$dateCreate = date_create($dateAutorizacion);
				$data['fechaAutorizacion'] = date_format($dateCreate, "Y/m/d");
				if ($this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "ID_CLASETIPO", "ID", $tipoOrden) == 3) {
					$idMiembro = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOMIEM", "ID_MIEMBROS", "ID_TIPOORDEN", $tipoOrden);
					$data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NOMBRE", $tipoOrden);
					$data['niveles'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden);
					$data['idValida'] = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipoOrden);

					// para saber que documento muestro superior o inferior
					$data['tipoMiembro'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOL_ZS", "MIEMBROSNOMBRE", "TIPOORDENID", $tipoOrden);
					echo "<script>console.log('tipoMiembro4: " . $data['tipoMiembro'] . "' );</script>";

					// Nombre del miembro seleccionado
					$data['nombreMiembros'] = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOL_ZS", "NIVELAMP", "TIPOORDENID", $tipoOrden);
					// Nombre del miembro seleccionado - DETALLE
					$data['nomPrimerSubNiv'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_GRUELEM", "NOMBRE", "ID", $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "ID_GRUELEM", $codigo));

					$listaPerfilesOrdenes = $this->OrdersModel->selectListWorkGroup($tipoOrden, 2);

					// echo $idArbol;
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
				// Historia clonica
				$data['id'] = $this->encryption->encrypt($id);
				$data['idOrden'] = $this->encryption->encrypt($idOrden);

				$data['idPinta'] = $idOrden;

				$data['pagina'] = "OrdersAppOrder/orderList";

				//Trae el responsable asociado a la cotizacion
				$idEmpresa = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_RELATION_ORDER_STOKEPRICE", "ID_EMPRESA", "ID_ORDEN",  $idOrden);
				$data['nombreEmpresaEsalud'] = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $idEmpresa);
				//$data['idEmpresaadriana']=$idEmpresa;



				// Pinto el despiece asociado a la orden
				$data['listaLista'] = $this->OrdersModel->getListElementOfProductOrder($idOrden);
				// Pinto avance
				$data['estadosDefinidos'] = $this->OrdersModel->selectOrderStateQuantity($idOrden, 1);
				$data['estadosEjecutados'] = $this->OrdersModel->selectOrderStateQuantity($idOrden, 2);


				//obtengo el perfil del usuario
				$idRolPerfiL = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_USUROLPER", "ID_ROLPERFIL", "ID_USUARIO",  $this->session->userdata('usuario'));

				$data['perfil'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_ROLPERFIL", "ID_PERFIL", "ID",  $idRolPerfiL);


				$data['perfilDefinido'] = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_PERFILSEGUIMIENTO", "ID", "ID_PERFIL", $data['perfil'], 'ESTADO', ACTIVO_ESTADO);


				$data['listaPadre'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_TIPOBITACORA", 'DESC');


				//Lista de departamento y ciudades
				$data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
				$data['listaCiudad'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_MUNICIPIO");

				// Pinto pantalla de seguimiento
				$this->load->view('orders/process/boardupdateUser', $data);
				// Pinto reglas de validacion
				$this->load->view('validation/orders/process/OrdersAppOrderformNewOrderValidation', $data);
				$this->load->view('validation/orders/process/ordersAppOrderTracerProcessValidationBinnacle', $data);

				/**
				 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
				 */

				// Pinto el final de la pogina (poginas internas)
				showCommonEnds($this, null, null);
			} else {
				$mainPage = "MainApp/board/";
				// Redirecciono para cambio de clave
				$redirect = $mainPage;

				$this->session->set_userdata('auxiliar', 'patientInactive');
				redirect(base_url() . $redirect);
			}
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}



	public function modifyElementOfProductsTrace($id, $idOrden)
	{
		/**
		 * Realizo las modificaciones del despiece para la orden
		 */
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
		// Pinto la cabecera principal de laspaginas internas
		showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
		// Pinto la informacion de los parametros de la aplicacion

		// 1. Pinto la informacion del paciente
		$data['paciente'] = $this->EsaludModel->getPatientInformation($id, 5, ADMISION_STATE_ACTIVE);
		echo "<script>console.log('ADMISION_STATE_ACTIVE11: " . $id . "' );</script>";

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

	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA GUARDAR INFORMACIoN
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
			$observacion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion')));
			$adjunto1 = $this->input->post('adjunto1');
			echo $adjunto1;
			$adjunto2 = $this->input->post('adjunto2');
			echo $adjunto2;
			// Campos adicionales
			$campo1 = $this->security->xss_clean($this->input->post('campo1'));
			$campo2 = $this->security->xss_clean($this->input->post('campo2'));
			$campo3 = $this->security->xss_clean($this->input->post('campo3'));
			$campo4 = $this->security->xss_clean($this->input->post('campo4'));
			$campo5 = $this->security->xss_clean($this->input->post('campo5'));

			//obtengo el departamento y ciudad de atención
			$departamento = $this->security->xss_clean($this->input->post('departamento'));
			$ciudad = $this->security->xss_clean($this->input->post('ciudad'));


			//Datos de contacto
			$telefono = $this->encryption->encrypt($this->security->xss_clean($this->input->post('telefono')));
			$telefono2 = $this->encryption->encrypt($this->security->xss_clean($this->input->post('telefono2')));
			$direccion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('direccion')));
			$municipio = $this->security->xss_clean($this->input->post('ciudad'));
			$empresa = $this->security->xss_clean($this->input->post('empresa'));
			$idEmpresa = $this->security->xss_clean($this->input->post('idEmpresa'));
			$convenio2 = $this->security->xss_clean($this->input->post('convenio'));
			$proceso2 = $this->security->xss_clean($this->input->post('proceso'));
			echo "<script>console.log('proceso2: " . $proceso2 . "' );</script>";

			$adjunto1 = null;

			if (!empty($_FILES['adjunto1']['name'])) {
				// Archivo 1
				$mi_archivo = 'adjunto1';
				$config['upload_path'] = STOKEPRICE_FOLDER . "";
				if (!is_dir($config['upload_path'])) {
					mkdir($config['upload_path'], 777);
				}
				$config['file_name'] =  "1_HC_" . date('YmdHis');
				$config['allowed_types'] = "pdf";

				$this->load->library('upload', $config);
				$tempo = '';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload($mi_archivo)) {
					// *** ocurrio un error
					$data['uploadError'] = $this->upload->display_errors();
					$tempo = $this->upload->display_errors();
					$band = false;
				} else {
					$band = true;
				}
				if (!$band) {
					$adjunto1 = null;
				} else {
					$adjunto1 = $this->encryption->encrypt($config['file_name'] . ".pdf");
					//$adjunto1 = $this->$config['file_name'] . ".pdf";
				}
				$data['uploadSuccess'] = $this->upload->data();
			} else {
				$adjunto1 = null;
			}
			$adjunto2 = null;

			if (!empty($_FILES['adjunto2']['name'])) {
				// Archivo 2
				$mi_archivo = 'adjunto2';
				$config['upload_path'] = STOKEPRICE_FOLDER . "";
				if (!is_dir($config['upload_path'])) {
					mkdir($config['upload_path'], 777);
				}
				$config['file_name'] =  "2_HC_" . date('YmdHis');
				$config['allowed_types'] = "pdf";

				$this->load->library('upload', $config);
				$tempo = '';
				$this->upload->initialize($config);
				if (!$this->upload->do_upload($mi_archivo)) {
					// *** ocurrio un error
					$data['uploadError'] = $this->upload->display_errors();
					$tempo = $this->upload->display_errors();
					$band = false;
				} else {
					$band = true;
				}
				if (!$band) {
					$adjunto2 = null;
				} else {
					$adjunto2 = $this->encryption->encrypt($config['file_name'] . ".pdf");;
					//$adjunto2 = $this->$config['file_name'] . ".pdf";
				}
				$data['uploadSuccess'] = $this->upload->data();
			} else {
				$adjunto2 = null;
			}

			echo $this->session->userdata('proceso') . " " . $proceso2;
			if ($this->session->userdata('proceso') != $proceso2 && $proceso2 != null) {
				$proceso = $proceso2;
				$this->session->set_userdata('proceso', $proceso2);
			}

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
				// 1.1 Asigno el valor a la cookie de historia clinica
				$this->session->set_userdata('encOrden', $encabezado);

				if ($empresa == '') {
					$empresa = $idEmpresa;
				}

				if ($convenio != null) {
					$convenio2 = $convenio;
				}

				//ECHO $this->session->userdata('encOrden');
				if ($this->FunctionsGeneral->getFieldFromTableNotId("ORD_CONTACTOUSUARIO", "ID", "ID_ENCORDEN", $this->session->userdata('encOrden')) == '') {
					// INGRESO INFORMACIÓN DE CONTACTO
					$idCte = $this->OrdersModel->insertOrderContactUser($encabezado, null, $telefono, $telefono2, $direccion, $municipio, $empresa, $convenio2, $this->session->userdata('usuario'));
				}
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
				// Para los que no son desde elementos
				$tipoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOMIEM", "ID_TIPOORDEN", $idTipoMiem);
			}
			//Determino clase tipo
			$claseTipo = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "ID_CLASETIPO", "ID", $tipoOrden);

			$consecutivoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "CONS", $tipoOrden);
			$prefijoOrden = $this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "PREFIJO", $tipoOrden);

			// echo $tipoOrden;
			if ($this->security->xss_clean($this->input->post('predecesora')) == '') {
				$predecesora = null;
			} else {
				$predecesora = $this->security->xss_clean($this->input->post('predecesora'));
			}


			//Relaciono la cotizaci�n si existe
			if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('idCotizacion'))) != null) {
				$cotizacion = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idCotizacion')));
			} else {
				$cotizacion = null;
			}

			// Obtengo relacion entre proceso y tipo de orden
			$tordPro = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_TORDPRO", "ID", "ID_TIPOORDEN", $tipoOrden, "ID_PROCESO", $this->session->userdata('proceso'));
			// Realizo el insert de la orden
			echo "<script>console.log('tipoOrden: " . $tipoOrden . "' );</script>";
			echo "<script>console.log('proceso: " . $this->session->userdata('proceso') . "' );</script>";

			$idOrden = $this->OrdersModel->insertOrderBody($encabezado, $tordPro, $this->security->xss_clean($this->input->post('cie10')), $this->security->xss_clean($this->input->post('causa')), $this->encryption->encrypt($this->security->xss_clean($this->input->post('diagnostico'))), $consecutivoOrden, $predecesora, $this->security->xss_clean($this->input->post('codigo')), $this->security->xss_clean($this->input->post('cantidad')), $observacion, $cotizacion, $this->session->userdata('usuario'), $adjunto1, $adjunto2);


			// 3. Corro el consecutivo de la orden
			$this->FunctionsGeneral->updateByID("ORD_TIPOORDEN", "CONS", $consecutivoOrden + 1, $tipoOrden, $this->session->userdata('usuario'));

			// 4. Creo el estado inicial de la orden
			$idEstadoInicial = $this->OrdersModel->searchStateOrderType(1, $tordPro);
			$contador = 1;
			$idOrdenEstado = $this->OrdersModel->insertOrderState($idOrden, $idEstadoInicial, OPEN_STATE, $this->encryption->encrypt('saveRegister'), $contador, $this->session->userdata('usuario'));



			// 5. Verifico si aplica despiece y lo creó
			if ($claseTipo == 1) {
				if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_DESPIECE", "ID_ARBOLCODIGO", $this->security->xss_clean($this->input->post('codigo'))) > 0) {
					//Verifico si el elemento dentro de la cotizaci�n se le definio el despiece
					$idDescripcion = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DESCRIPCION", "ID", "CODIGO", $this->security->xss_clean($this->input->post('codigo')));
					$idDetalle = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DETALLECOTI", "ID", "ID_DESCRIPCION", $idDescripcion, "ID_COTIZACION", $cotizacion, "ESTADO", ACTIVO_ESTADO);

					if ($idDetalle != null) {
						$despiece = $this->StokePriceModel->selectElementsDetailsFromStokePrice($idDetalle);
					} else {
						// Se debe crear el despiece
						$despiece = $this->OrdersModel->selectElementProductoList($this->security->xss_clean($this->input->post('codigo')));
					}
					//Inserto el despiece respectivo
					foreach ($despiece as $value) {
						// Inserto cada uno de los elementos del despiece que se encuetran definidos
						$this->OrdersModel->insertOrderElementOfProduct($idOrden, $value->ID_ELEMENTO, $value->CANTIDAD, null, null, null, null, $this->session->userdata('usuario'));
					}
				}
			}
			// 6. CREANDO GRUPO INTERDISCIPLINARIO
			// Ordenador principal
			$this->OrdersModel->insertOrderTeamList($idEstadoInicial, $this->session->userdata('usuario'), $this->session->userdata('usuario'));
			// Apoyo en la generacion de la orden
			if ($this->security->xss_clean($this->input->post('apoyo')) != -1 && $this->security->xss_clean($this->input->post('apoyo')) != '') {

				$this->OrdersModel->insertOrderTeamList($idEstadoInicial, $this->security->xss_clean($this->input->post('apoyo')), $this->session->userdata('usuario'));
			}

			// 7. Observacion inicial
			$idObs = $this->OrdersModel->insertOrderStateObservation($idOrdenEstado, ORDER_OBSERVATION_1, $observacion, $this->session->userdata('usuario'));

			$this->session->set_userdata('action', "order");

			//8. Guardo informacion adicional (campos adicionales)
			$this->saveAditionalInformationFromObservation($idObs, $campo1, $campo1, $campo1, $campo1, $campo2, $campo2, $campo2, $campo2, $campo3, $campo3, $campo3, $campo3, $campo4, $campo4, $campo4, $campo4, $campo5, $campo5, $campo5, $campo5, $this->session->userdata('usuario'));



			$mainPage = "OrdersAppOrder/createOrder/";
			// Redirecciono para cambio de clave
			$redirect = $mainPage . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt('next') . "/" . $this->encryption->encrypt($encabezado);
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
				$idOrdenInterconsulta = $this->OrdersModel->insertOrderBody($this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ID_ENCORDEN", $idOrden), $tordPro, $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ID_DIAGNOSTICO", $idOrden), $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ID_CAUSAENFERMEDAD", $idOrden), $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "DIAGNOSTICO", $idOrden), $consecutivoOrden, $idOrden, $codigo, $cantidad, $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion'))), null, $this->session->userdata('usuario'));

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
					//echo "<script>console.log('Console: " . $value- . "' );</script>";
				}
				$ordenes = $this->OrdersModel->selectListOrdersFromHead($this->session->userdata('encOrden'), $value->NUM_ID_PCTE);

				//$ordenes = $this->OrdersModel->selectListOrdersFromHead($this->session->userdata('encOrden'));

				if ($ordenes != null) {
					foreach ($ordenes as $orden) {
						// Actualizo el valor OPCION, para la relacion del estado ordenar para cada orden
						$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "OPCION", $this->encryption->encrypt('orderConsolidation'), "ID_ORDEN", $orden->ID, $this->session->userdata('usuario'));
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

				echo $this->session->userdata('id');
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


		echo $idOrden . " " . $idTordProEst . " " . $idOrdActEst . " <br>";
		if ($this->session->userdata('login') == 'SI') {
			// Obtiene relacion de estados siguientes
			$relationState = $this->OrdersModel->selectNextStatesProcess($idTordProEst, NORMAL_FLOW);
			//print_r($relationState);
			//echo "<br>";
			foreach ($relationState as $value) {
				// echo "ORDEN: ".$idOrden." ORIGEN: ".$value->ID_INICIO." FIN: ".$value->ID_FIN."<br>";
				// Verificar si el estado ya ha sido creado en otra ocasion
				$cantidad = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, 'ID_TORDPROEST', $value->ID_FIN, "MOMENTO", OPEN_STATE);
				// Determinando el estado
				$tempo = $value->ID_FIN;
				$tempoEstado = $this->FunctionsGeneral->getFieldFromTableNotId('ORD_TORDPROEST', 'ID_ESTADO', "ID", $tempo);
				$tipoEstado = $this->FunctionsGeneral->getFieldFromTableNotId('ORD_ESTADOS', 'TIPOESTADO', "ID", $tempoEstado);

				echo "cantidad" . $cantidad . " " . $value->ID_FIN . "<br>";

				if ($cantidad == 0) {
					if ($tipoEstado != TYPE_STATE_END_ERROR) {
						if ($tempoEstado != STATE_SUSPEND) {
							// Obteniendo estados anteriores
							echo "Estado siguiente: " . $tempo . "<br>";
							$estadosAnteriores = $this->OrdersModel->selectLastStatesProcess($tempo, NORMAL_FLOW);
							print_r($estadosAnteriores);
							$cantidadEstadosAnteriores = count($estadosAnteriores);
							// Obteniendo cantidad de estados anteriores que ya se han cerrado
							$validador = $this->validaEstadosParalelos($idOrden, $estadosAnteriores);
							echo "----------------" . $validador . " " . $cantidadEstadosAnteriores . "----------------<br>";

							if ($cantidadEstadosAnteriores == $validador) {
								// Creo estado siguiente
								/*$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $tempo);*/

								$contador = $this->FunctionsGeneral->countMaxCondition("ORD_ORDACTEST", "CONTADOR", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $tempo);
								echo "contador:" . $contador . " ID_ORDEN ", $idOrden, "ID_TORDPROEST ", $tempo . "<br>";

								if (!empty($contador)) {
									$contador++;
								} else {
									echo "entro abajo";
									$contador = 1;
								}

								//$contador++;
								echo "contador:" . $contador . " ID_ORDEN ", $idOrden, "ID_TORDPROEST ", $tempo . "<br>";

								$this->OrdersModel->insertOrderState($idOrden, $tempo, OPEN_STATE, $this->encryption->encrypt(OPC_ABI), $contador, $this->session->userdata('usuario'));
								// Se envia correo electronico
								$this->sendTraceMail($idOrden, $idTordProEst, $tempo);
							} else if ($cantidadEstadosAnteriores < $validador) {
								//Valido si el estado esta relacionado a un reproceso
								$actual = $this->FunctionsGeneral->getFieldFromTableNotIdFields('ORD_REPROCESO', 'ACTUAL', "REPROCESO", $idOrdActEst, "ESTADO", ACTIVO_ESTADO);
								$idRelacion = $this->FunctionsGeneral->getFieldFromTableNotIdFields('ORD_REPROCESO', 'ID', "REPROCESO", $idOrdActEst, "ESTADO", ACTIVO_ESTADO);
								if (!isset($actual)) {
									//tOMO EL VALOR DADO EN  $tempo para ver si esta el estado relacionado al reproceso de $actual
									$contador = $this->FunctionsGeneral->getFieldFromTableNotIdFields('ORD_ORDACTEST', 'CONTADOR', "ID_TORDPROEST", $tempo, "ID", $actual);
									/*$contador=$this->FunctionsGeneral->countMaxCondition("ORD_ORDACTEST","CONTADOR","ID_ORDEN", $idOrden, "ID_TORDPROEST", $tempo)+1;*/

									//echo "actual: ".$actual." contador: ".$contador."<br>";
									$contador++;
									//Se debe habilitar el nuevo estado
									$this->OrdersModel->insertOrderState($idOrden, $tempo, OPEN_STATE, $this->encryption->encrypt(OPC_ABI), $contador, $this->session->userdata('usuario'));
									//Inactivo relaci�n
									$this->FunctionsGeneral->updateByID('ORD_REPROCESO', "ESTADO", INACTIVO_ESTADO, $idRelacion, $this->session->userdata('usuario'));
								} else {
									try {
										echo "entra abajo";
									} catch (Exception $e) {
									}
								}



								// Se envia alerta
								$this->sendTraceMail($idOrden, $idTordProEst, $tempo);
							}
						} else {
							// Inserto el estado suspender, este no genera alerta
							$contador = 1;
							$this->OrdersModel->insertOrderState($idOrden, $tempo, OPEN_STATE, $this->encryption->encrypt(OPC_ABI), $contador, $this->session->userdata('usuario'));
						}
					} else {
						// Inserto el estado cancelar, este no genera alerta
						$contador = 1;
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
			$validador = 0;


			if ($estadosAnteriores != null) {
				foreach ($estadosAnteriores as $value) {
					// Valido si es ordenar
					if ($this->FunctionsGeneral->getFieldFromTableNotId('ORD_TORDPROEST', 'ID_ESTADO', "ID", $value->ID_INICIO) == ORDER_STATE) {
						$validador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, 'ID_TORDPROEST', $value->ID_INICIO, "MOMENTO", OPEN_STATE) + $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, 'ID_TORDPROEST', $value->ID_INICIO, "MOMENTO", CLOSE_STATE);
					} else {
						//busco el contador mayor
						$contador = $this->FunctionsGeneral->countMaxCondition("ORD_ORDACTEST", "CONTADOR", "ID_ORDEN", $idOrden, 'ID_TORDPROEST', $value->ID_INICIO, "MOMENTO", CLOSE_STATE);
						$validador += $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, 'ID_TORDPROEST', $value->ID_INICIO, "MOMENTO", CLOSE_STATE, "CONTADOR", $contador);
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
			// Obtengo el id de la relacion actual del estado con la orden
			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
			$idOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idOrden')));
			$tipo = $this->security->xss_clean($this->input->post('tipo'));
			$estado = $this->security->xss_clean($this->input->post('estado'));
			$fecha = $this->security->xss_clean($this->input->post('fecha'));
			$cierra = $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "CIERRA", $tipo);
			$tipoObservacion = $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "TIPOOBSE", $tipo);

			// Campos adicionales
			$campo1 = $this->security->xss_clean($this->input->post('campo1'));
			$lista1 = $this->security->xss_clean($this->input->post('listaCampo1'));
			$fecha1 = $this->security->xss_clean($this->input->post('fecha1'));
			$numero1 = $this->security->xss_clean($this->input->post('numero1'));

			$campo2 = $this->security->xss_clean($this->input->post('campo2'));
			$lista2 = $this->security->xss_clean($this->input->post('listaCampo2'));
			$fecha2 = $this->security->xss_clean($this->input->post('fecha2'));
			$numero2 = $this->security->xss_clean($this->input->post('numero2'));

			$campo3 = $this->security->xss_clean($this->input->post('campo3'));
			$lista3 = $this->security->xss_clean($this->input->post('listaCampo3'));
			$fecha3 = $this->security->xss_clean($this->input->post('fecha3'));
			$numero3 = $this->security->xss_clean($this->input->post('numero3'));

			$campo4 = $this->security->xss_clean($this->input->post('campo4'));
			$lista4 = $this->security->xss_clean($this->input->post('listaCampo4'));
			$fecha4 = $this->security->xss_clean($this->input->post('fecha4'));
			$numero4 = $this->security->xss_clean($this->input->post('numero4'));

			$campo5 = $this->security->xss_clean($this->input->post('campo5'));
			$lista5 = $this->security->xss_clean($this->input->post('listaCampo5'));
			$fecha5 = $this->security->xss_clean($this->input->post('fecha5'));
			$numero5 = $this->security->xss_clean($this->input->post('numero5'));

			$information = $this->OrdersModel->getStateRelatationFromOrderState($idOrden, $estado);

			$tempo = '';
			$mensaje = '';

			// Guardo la observacion
			$idObs = $this->OrdersModel->insertOrderStateObservation($information->ID, $tipo, $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion'))), $this->session->userdata('usuario'));

			if ($cierra == CTE_VALOR_SI) {

				// Guardo la informaci�n correspondiente a los campos adicionales
				$this->saveAditionalInformationFromObservation($idObs, $campo1, $lista1, $fecha1, $numero1, $campo2, $lista2, $fecha2, $numero2, $campo3, $lista3, $fecha3, $numero3, $campo4, $lista4, $fecha4, $numero4, $campo5, $lista5, $fecha5, $numero5, $this->session->userdata('usuario'));
			}
			// Valido que no exista la relacion
			if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDENEQUIPO", "ID_TORDPROEST", $information->ID_TORDPROEST, "ID_USUARIO", $this->session->userdata('usuario')) == 0) {
				// Inserto equipo de trabajo
				$this->OrdersModel->insertOrderTeamList($information->ID_TORDPROEST, $this->session->userdata('usuario'), $this->session->userdata('usuario'));
			}

			// Guardo adjunto
			// TODO

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
				// *** ocurrio un error
				$data['uploadError'] = $this->upload->display_errors();
				$tempo = $this->upload->display_errors();
			}
			$data['uploadSuccess'] = $this->upload->data();

			// echo $tempo;
			if ($tempo == '') {
				// Indico que se ha cargado un archivo
				$this->FunctionsGeneral->updateByField("ORD_ORDACTESTOBS", "ADJUNTO", $this->encryption->encrypt($config['file_name']), "ID", $idObs, $this->session->userdata('usuario'));
			}
			$mensaje = "";

			// Valido si es proceso o reproceso
			if ($tipoObservacion == CTE_VALOR_PROCESO) {
				if ($estado == STATE_CORRECT) {
					// Cierro el estado de la orden
					$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", CLOSE_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "ID_TORDPROEST", $information->ID_TORDPROEST);
					// Cierro la orden
					$this->FunctionsGeneral->updateByID("ORD_ORDEN", "ESTADO", CLOSE_STATE, $idOrden, $this->session->userdata('usuario'));

					// Indico que retorno a la p�gina del listado de ordenes
					$mensaje = "orderEndCorrect";
				} else if ($estado == STATE_CANCEL) {
					// Cierro el estado de la orden
					$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", CLOSE_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "ID_TORDPROEST", $information->ID_TORDPROEST);
					// Cierro la orden
					$this->FunctionsGeneral->updateByID("ORD_ORDEN", "ESTADO", CANCEL_STATE, $idOrden, $this->session->userdata('usuario'));
					// Indico que retorno a la p�gina del listado de ordenes
					$mensaje = "orderEndCancel";
				} else if ($estado == STATE_SUSPEND) {
					if ($tipo != SUSPEND_OBSERVATION) {
						// Rutina para suspender la orden, por tal razon lo que se va hacer es suspender los estados que eston Abiertos
						$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", SUSPEND_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "MOMENTO", OPEN_STATE);
						$mensaje = "orderTraceSuspendState";
					} else {
						// Rutina para retornar la orden, por tal razon lo que se cambian los estados que estaban en S a A
						$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", OPEN_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "MOMENTO", SUSPEND_STATE);
						$mensaje = "orderTraceRetakeProcess";
					}
				} else {
					// Proceso normal. Valido si de acuerdo al tipo de observacion se cierra el estado
					if ($cierra == CTE_VALOR_SI) {
						//echo "entro aqui";
						// Cierro el estado de la orden
						$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", CLOSE_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "ID_TORDPROEST", $information->ID_TORDPROEST);

						// El estado se cierra, se debe abrir los siguientes
						$this->defineOrderNewStates($idOrden, $information->ID_TORDPROEST, $information->ID);


						// Mensaje indicando que se ha realizado el seguimiento de la orden y se ha cerrado el estado y creado unos nuevos
						$mensaje = "orderTraceChangeState";
					} else {

						// Mensaje indicando que se ha realizado el seguimiento de la orden y esto continoa abierta

						$mensaje = "orderTraceNotChangeState";
					}
				}
			} else {
				// Reproceso
				// Cierro el estado de la orden
				$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", CLOSE_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "ID_TORDPROEST", $information->ID_TORDPROEST);
				// cREO EL ESTADO EN REPROCESO
				$tempo = $this->security->xss_clean($this->input->post('reproceso'));
				$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $tempo) + 1;
				$idOrdenEstado = $this->OrdersModel->insertOrderState($idOrden, $tempo, OPEN_STATE, $this->encryption->encrypt(OPC_ABI), $contador, $this->session->userdata('usuario'));

				//Creo la relaci�n del reproceso
				$contador = $this->FunctionsGeneral->countMaxCondition("ORD_ORDACTEST", "CONTADOR", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $information->ID_TORDPROEST);
				$actual = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ORDACTEST", "ID", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $information->ID_TORDPROEST, "CONTADOR", $contador);

				$this->OrdersModel->insertBackOrder($idOrden,  $actual, $idOrdenEstado, $this->session->userdata('usuario'));
				$mensaje = "orderTraceBackOk";
			}

			// Se envia correo electronico

			// $this->sendTraceMail ( $idOrden, $information->ID_TORDPROEST, $tempo );
			$this->sendTraceMail($idOrden, 2, 3);
			if ($this->security->xss_clean($this->input->post('despiece')) == CTE_VALOR_SI) {
				// direcciono a la p�ginpa para modificar despiece
				$mainPage = "OrdersAppOrder/modifyElementOfProductsTrace/";
				// Redirecciono para cambio de clave
				$redirect = $mainPage . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt($idOrden);
			} else {
				// Retorno a la p�gina del listado de ordenes
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



	public function saveUserInformation()
	{
		/**
		 * Rutina para guardar el estado de la orden, de acuerdo al seguimiento realizado
		 */
		$mainPage = "OrdersAppOrder/board";
		if ($this->session->userdata('login') == 'SI') {
			// Obtengo el id de la relacion actual del estado con la orden
			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
			$idOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idOrden')));

			$idEncorden = $this->FunctionsGeneral->getFieldFromTable("ORD_ORDEN", "ID_ENCORDEN", $idOrden);

			//Datos de contacto
			$telefono = $this->encryption->encrypt($this->security->xss_clean($this->input->post('telefono')));
			$telefono2 = $this->encryption->encrypt($this->security->xss_clean($this->input->post('telefono2')));
			$direccion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('direccion')));
			$municipio = $this->security->xss_clean($this->input->post('ciudad'));


			//Actualizo información

			$this->FunctionsGeneral->updateByField("ORD_CONTACTOUSUARIO", "MOVIL", $telefono, "ID_ENCORDEN", $idEncorden, $this->session->userdata('usuario'));

			$this->FunctionsGeneral->updateByField("ORD_CONTACTOUSUARIO", "TELEFONO", $telefono2, "ID_ENCORDEN", $idEncorden, $this->session->userdata('usuario'));

			$this->FunctionsGeneral->updateByField("ORD_CONTACTOUSUARIO", "DIRECCION", $direccion, "ID_ENCORDEN", $idEncorden, $this->session->userdata('usuario'));

			$this->FunctionsGeneral->updateByField("ORD_CONTACTOUSUARIO", "ID_MUNICIPIO", $municipio, "ID_ENCORDEN", $idEncorden, $this->session->userdata('usuario'));

			// Retorno a la p�gina del listado de ordenes
			$mainPage = "OrdersAppOrder/orderList/";
			// Redirecciono para cambio de clave
			$redirect = $mainPage . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt('seguimiento');


			// Pinto mensaje para retornar a la aplicacion
			$this->session->set_userdata('id', null);
			$this->session->set_userdata('auxiliar', "editUserOrder");
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}



	private function saveAditionalInformationFromObservation($idObservacion, $campo1, $lista1, $fecha1, $numero1, $campo2, $lista2, $fecha2, $numero2, $campo3, $lista3, $fecha3, $numero3, $campo4, $lista4, $fecha4, $numero4, $campo5, $lista5, $fecha5, $numero5, $usuario)
	{
		/**
		 * *
		 * Guardo la informaci�n adicional correspondiente a la observaci�n del estado
		 */

		$adc1 = $adc2 = $adc3 = $adc4 = $adc5 = null;
		//Informaci�n para el primer campo
		if ($campo1 != null) {
			$adc1 = $campo1;
		} else if ($lista1 != null) {
			$adc1 = $lista1;
		} else if ($fecha1 != null) {
			$adc1 = $fecha1;
		} else if ($numero1 != null) {
			$adc1 = $numero1;
		}

		//Informaci�n para el segundo campo
		if ($campo2 != null) {
			$adc2 = $campo2;
		} else if ($lista2 != null) {
			$adc2 = $lista2;
		} else if ($fecha2 != null) {
			$adc2 = $fecha2;
		} else if ($numero2 != null) {
			$adc2 = $numero2;
		}

		//Informaci�n para el tercer campo
		if ($campo3 != null) {
			$adc3 = $campo3;
		} else if ($lista3 != null) {
			$adc3 = $lista3;
		} else if ($fecha3 != null) {
			$adc3 = $fecha3;
		} else if ($numero3 != null) {
			$adc3 = $numero3;
		}

		//Informaci�n para el cuarto campo
		if ($campo4 != null) {
			$adc4 = $campo4;
		} else if ($lista4 != null) {
			$adc4 = $lista4;
		} else if ($fecha4 != null) {
			$adc4 = $fecha4;
		} else if ($numero4 != null) {
			$adc4 = $numero4;
		}

		//Informaci�n para el quinto campo
		if ($campo5 != null) {
			$adc5 = $campo5;
		} else if ($lista5 != null) {
			$adc5 = $lista5;
		} else if ($fecha5 != null) {
			$adc5 = $fecha5;
		} else if ($numero5 != null) {
			$adc5 = $numero5;
		}

		//Cifro la informaci�n
		if ($adc1 != null) {
			$adc1 = $this->encryption->encrypt($adc1);
		}
		if ($adc2 != null) {
			$adc2 = $this->encryption->encrypt($adc2);
		}
		if ($adc3 != null) {
			$adc3 = $this->encryption->encrypt($adc3);
		}
		if ($adc4 != null) {
			$adc4 = $this->encryption->encrypt($adc4);
		}
		if ($adc5 != null) {
			$adc5 = $this->encryption->encrypt($adc5);
		}

		//Guardo la informaci�n
		$this->OrdersModel->insertOrderStateObservationAditionalInformation($idObservacion, $adc1, $adc2, $adc3, $adc4, $adc5, $usuario);
	}

	public function saveMassiveTrace()
	{
		/**
		 * Rutina para guardar la informaci�n de las ordenes a las cuales se les hace seguimiento en bloque
		 */
		$mainPage = "OrdersAppTraceOrder/board";
		if ($this->session->userdata('login') == 'SI') {

			// Obtengo las ordenes seleccionadas
			$data = $this->OrdersModel->selectOrdersFromState($this->security->xss_clean($this->input->post('estado')));
			if ($data != null) {
				foreach ($data as $value) {
					$tempo = $this->security->xss_clean($this->input->post('valor' . $value->ID));
					if ($tempo == 'on') {
						// Guardo y genero el estado siguiente
						// echo $value->ID."<br>";

						$tipo = $this->security->xss_clean($this->input->post('tipo'));
						$estado = $this->FunctionsGeneral->getFieldFromTable("ORD_TORDPROEST", "ID_ESTADO", $this->security->xss_clean($this->input->post('estado')));
						$cierra = $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "CIERRA", $tipo);
						$tipoObservacion = $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "TIPOOBSE", $tipo);

						$information = $this->OrdersModel->getStateRelatationFromOrderState($value->ID, $estado);
						print_r($information);
						// Guardo la observacion
						$idObs = $this->OrdersModel->insertOrderStateObservation($information->ID, $tipo, $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion'))), $this->session->userdata('usuario'));

						// Valido que no exista la relacion
						if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDENEQUIPO", "ID_TORDPROEST", $information->ID_TORDPROEST, "ID_USUARIO", $this->session->userdata('usuario')) == 0) {
							// Inserto equipo de trabajo
							$this->OrdersModel->insertOrderTeamList($information->ID_TORDPROEST, $this->session->userdata('usuario'), $this->session->userdata('usuario'));
						}

						$idOrden = $value->ID;
						// Valido si es proceso o reproceso
						if ($tipoObservacion == CTE_VALOR_PROCESO) {
							if ($estado == STATE_CORRECT) {
								// Cierro el estado de la orden
								$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", CLOSE_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "ID_TORDPROEST", $information->ID_TORDPROEST);
								// Cierro la orden
								$this->FunctionsGeneral->updateByID("ORD_ORDEN", "ESTADO", CLOSE_STATE, $idOrden, $this->session->userdata('usuario'));
							} else if ($estado == STATE_CANCEL) {
								// Cierro el estado de la orden
								$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", CLOSE_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "ID_TORDPROEST", $information->ID_TORDPROEST);
								// Cierro la orden
								$this->FunctionsGeneral->updateByID("ORD_ORDEN", "ESTADO", CANCEL_STATE, $idOrden, $this->session->userdata('usuario'));
							} else if ($estado == STATE_SUSPEND) {
								if ($tipo != SUSPEND_OBSERVATION) {
									// Rutina para suspender la orden, por tal razon lo que se va hacer es suspender los estados que eston Abiertos
									$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", SUSPEND_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "MOMENTO", OPEN_STATE);
								} else {
									// Rutina para retornar la orden, por tal razon lo que se cambian los estados que estaban en S a A
									$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", OPEN_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "MOMENTO", SUSPEND_STATE);
								}
							} else {
								// Proceso normal. Valido si de acuerdo al tipo de observacion se cierra el estado
								if ($cierra == CTE_VALOR_SI) {
									// El estado se cierra, se debe abrir los siguientes
									$this->defineOrderNewStates($idOrden, $information->ID_TORDPROEST, $information->ID);
									// Cierro el estado de la orden
									$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", CLOSE_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "ID_TORDPROEST", $information->ID_TORDPROEST);
								}
							}
						} else {
							// Reproceso
							// Cierro el estado de la orden
							$this->FunctionsGeneral->updateByField("ORD_ORDACTEST", "MOMENTO", CLOSE_STATE, "ID_ORDEN", $idOrden, $this->session->userdata('usuario'), "ID_TORDPROEST", $information->ID_TORDPROEST);
							// cREO EL ESTADO EN REPROCESO
							$temporal = $this->security->xss_clean($this->input->post('reproceso'));
							$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDACTEST", "ID_ORDEN", $idOrden, "ID_TORDPROEST", $temporal);
							$idOrdenEstado = $this->OrdersModel->insertOrderState($idOrden, $temporal, OPEN_STATE, $this->encryption->encrypt(OPC_ABI), $contador, $this->session->userdata('usuario'));
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
			// Obtengo el id de la relacion actual del estado con la orden
			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
			$idOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idOrden')));

			// Lista de elementos
			$despiece = $this->OrdersModel->getListElementOfProductOrder($idOrden);
			foreach ($despiece as $value) {
				// Recorro el despiece
				$traslado = $this->security->xss_clean($this->input->post('traslado' . $value->ID));
				// Actualizo el valor del traslado
				if ($traslado != '') {
					$this->FunctionsGeneral->updateByID("ORD_ORDACTDES", "TRASLADO", $this->encryption->encrypt($traslado), $value->ID, $this->session->userdata('usuario'));
				}
				$salida = $this->security->xss_clean($this->input->post('salida' . $value->ID));
				// Actualizo el valor de la salida
				if ($salida != '') {
					$this->FunctionsGeneral->updateByID("ORD_ORDACTDES", "SALIDA", $this->encryption->encrypt($salida), $value->ID, $this->session->userdata('usuario'));
				}
				$serial = $this->security->xss_clean($this->input->post('serial' . $value->ID));
				// Actualizo el valor del serial
				if ($serial != '') {
					$this->FunctionsGeneral->updateByID("ORD_ORDACTDES", "SERIAL", $this->encryption->encrypt($serial), $value->ID, $this->session->userdata('usuario'));
				}
				$lote = $this->security->xss_clean($this->input->post('lote' . $value->ID));
				// Actualizo el valor del lote
				if ($lote != '') {
					$this->FunctionsGeneral->updateByID("ORD_ORDACTDES", "LOTE", $this->encryption->encrypt($lote), $value->ID, $this->session->userdata('usuario'));
				}
			}

			// Retorno a la p�gina del listado de ordenes
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

		// echo "Orden".$idOrden," Estado actual: ", $estadoActual," Estado siguiente: ", $estadoSiguiente," Observaci&oacute;n", $observacion."<br>";
		// Verificar los perfiles a los cuales se les debe enviar alerta de correo electr�nico para el estado $estadoSiguiente
		$type = 'stateChangedOrders';
		$this->load->library('email');

		$perfiles = $this->OrdersModel->selectProfileListFromState($estadoSiguiente);
		// print_r($perfiles);
		if ($perfiles != null) {
			foreach ($perfiles as $value) {
				// Verificar usuarios que tienen dichos perfiles
				$usuario = $this->SystemModel->getListMailFromProfile($value->ID_PERFIL);
			}
			// Enviar alerta
			if ($usuario != null) {
				foreach ($usuario as $val) {
					// Enviar alerta
					if (CTE_CORREO_ELECTRONICO) {
						// 1. Envio informaci�n al correo respectivo
						$tituloCorreo = $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "NOMBRE", 1);
						// Obtengo los datos de acuerdo a la regla de tipo $type
						$emailFrom = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "REMITE", "NOMBRE", $type);
						$emailReplyTo = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "RESPUESTA", "NOMBRE", $type);
						$emailTo = $val->CORREO;
						// Obtengo Asunto y mensaje del correo electr�nico
						$subject = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "ASUNTO", "NOMBRE", $type);
						$messages = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "CUERPO", "NOMBRE", $type);

						// creo valores para la orden
						$orden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ORDENESACTUALES", "PREFIJO", "ID", $idOrden) . " - " . $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ORDENESACTUALES", "CONS", "ID", $idOrden);

						// Obtengo el estado al cual ira la orden
						$estado = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TORDPROEST", "ID_ESTADO", "ID", $estadoSiguiente);
						$estado = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ESTADOS", "NOMBRE", "ID", $estado);

						// Obbtengo datos del paciente
						$historia = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ORDENESACTUALES", "HISTORIA", "ID", $idOrden);
						$historia = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_ADMISIONES", "ID_PCTE_ADM", "ID_AMSION", $historia);
						$paciente = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_NOM_PCTE", "ID_PCTE", $historia) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_NOM_PCTE", "ID_PCTE", $historia) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_APELL_PCTE", "ID_PCTE", $historia) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_APELL_PCTE", "ID_PCTE", $historia);

						// Defino comidines y remplazos
						$comodines = array(
							CTE_JOCKER_ORDER,
							CTE_JOCKER_STATE,
							CTE_JOCKER_PATIENT
						);
						$remplazos = array(
							$orden,
							$estado,
							$paciente
						);
						// Reemplazo comodines para el mensaje
						$messages = str_replace($comodines, $remplazos, $messages);
						$subject = str_replace($comodines, $remplazos, $subject);

						$body = paintMessageMail($this, $tituloCorreo, $messages, null, $type);
						// echo $emailTo." ".$body."<br>";

						// Also, for getting full html you may use the following internal method:
						// $body = $this->email->full_html($subject, $message);
						$result = $this->email->from($emailFrom)
							->reply_to($emailReplyTo)
							->
							// Optional, an account where a human being reads.
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

	public function saveBinnacle()
	{
		/**
		 * Rutina para guardar la informaci�n de las ordenes a las cuales se les hace seguimiento en bloque
		 */
		$mainPage = "OrdersAppTraceOrder/board";
		if ($this->session->userdata('login') == 'SI') {

			$id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
			$idOrden = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idOrden')));
			$tipo = $this->security->xss_clean($this->input->post('tipo'));
			$observacion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion')));

			//Guardo el seguimiento
			$this->OrdersModel->insertOrderBinnacleInformation($idOrden, $tipo, $observacion, $this->session->userdata('usuario'));

			$mensaje = "binnacleOk";
			// Redirecciono para cambio de clave
			$mainPage = "OrdersAppOrder/tracerProcess";

			$redirect = $mainPage;
			// Pinto mensaje para retornar a la aplicacion


			$redirect = $mainPage . "/" . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt($idOrden);

			// Pinto mensaje para retornar a la aplicacion
			$this->session->set_userdata('id', $this->session->userdata('id'));
			$this->session->set_userdata('auxiliar', $mensaje);
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}


	public function stokePriceRelation($id, $idOrden, $idCotizacion)
	{
		/**
		 * Actualizo la orden relacionado la cotizaci�n
		 */
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppOrder/board";

		if ($this->session->userdata('login') == 'SI') {
			$id = $this->encryption->decrypt($id);
			$idOrden = $this->encryption->decrypt($idOrden);
			$idCotizacion = $this->encryption->decrypt($idCotizacion);

			//Hago el update a la orden
			$this->FunctionsGeneral->updateByID("ORD_ORDEN", "ID_COTIZACION", $idCotizacion, $idOrden, $this->session->userdata('usuario'));



			$redirect = "OrdersAppOrder/tracerProcess" . "/" . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt($idOrden);
			// Pinto mensaje para retornar a la aplicacion
			$this->session->set_userdata('id', null);
			$this->session->set_userdata('auxiliar', 'stokePriceOrderOk');
			redirect(base_url() . $redirect);
		} else {
			// Retorno a la pogina principal
			header("Location: " . base_url());
		}
	}
}
