<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para visualizar el manejo de los convenios de las brigadas
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');
class BrigadesAppBrigade extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		// Cargo modelos, librerias y helpers
		$this->load->model('BrigadesModel'); // Libreria principal de las funciones referentes a �rdenes
	}

	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA PINTAR FORMULARIOS
	 * ****************************************************************************************************** *
	 */
	public function board()
	{
		/**
		 * Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado
		 */
		$mainPage = "BrigadesAppBrigade/board";

		// Valido si la sessi�n existe en caso contrario saco al usuario
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			// Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
			$data = null;
			// Pinto la cabecera principal de las p�ginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
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

			// Lista de listas
			$condicion = "AND BRI_BRIGADA.ID_FASEBRIG='1'";
			$data['listaLista'] = $this->BrigadesModel->selectListBrigades($condicion);

			// Pinto plantilla principal
			// Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
			$this->load->view('brigades/board', $data);

			/**
			 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la p�gina (p�ginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function newRegister()
	{
		/**
		 * Formulario para crear un nuevo registro del parametro
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "BrigadesAppBrigade/board";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			// Cargo la p�gina principal
			$data = null;
			// Pinto la cabecera principal de las p�ginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");

			/**
			 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
			 */

			// Inicializo variables de la vista
			$data['valida'] = $this->encryption->encrypt('newRegister');
			$data['id'] = null;
			$data['idEncBrig'] = null;

			// Cargo la lista de departamentos
			$data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
			$data['departamento'] = NULL;
			// Cargo la lista de ciudades
			$data['listaCiudad'] = NULL;
			$data['ciudad'] = NULL;
			//monto
			$data['monto'] = NULL;
			// Cargo nombre de las fases
			$data['fases'] = $this->FunctionsGeneral->selectValoresListaTablaOrder("BRI_FASEBRIG", "ID", 'ASC');
			// Listo convenios
			$data['listaConvenio'] = $this->FunctionsGeneral->selectValoresListaTabla("BRI_CONVENIOBRIG");
			// Lista de participantes
			$data['listaTsocial'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 1, ACTIVO_ESTADO);
			$data['listaProtesista'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 2, ACTIVO_ESTADO);
			$data['listaMedico'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 3, ACTIVO_ESTADO);
			$data['listaFisio'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 4, ACTIVO_ESTADO);
			$data['listaOcupacional'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 4, ACTIVO_ESTADO);
			$data['listaOcupacional'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 5, ACTIVO_ESTADO);
			$data['listaOrtesista'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 6, ACTIVO_ESTADO);
			$data['listaFacilitador'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 7, ACTIVO_ESTADO);
			$data['listaInvitado'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 8, ACTIVO_ESTADO);
			// Cargo vista
			$this->load->view('brigades/newRegister', $data);
			// Cargo validaci�n de formulario
			$this->load->view('validation/brigades/process/BrigadesAppBrigadeValidation', $data);

			/**
			 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
			 */

			// Pinto el final de la p�gina (p�ginas internas)
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}
	public function edit($id)
	{
		/**
		 * Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n
		 */
		// Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
		$mainPage = "BrigadesAppBrigade/board";

		// Valido si la sessi�n existe en caso contrario saco al usuario
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			$id = $this->encryption->decrypt($id);
			$municipio = $this->FunctionsGeneral->getFieldFromTable("BRI_ENCBRIG", "ID_MUNICIPIO", $id);
			$this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "NOMBRE", $municipio));
			if ($municipio != '') {

				$data = null;
				// Pinto la cabecera principal de las p�ginas internas
				showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");

				/**
				 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
				 */

				// Inicializo variables de la vista
				$data['valida'] = $this->encryption->encrypt('edit');
				$data['id'] = $this->encryption->encrypt($id);
				$data['idEncBrig'] = $id;

				//Monto
				$data['monto'] = $this->FunctionsGeneral->getFieldFromTable("BRI_ENCBRIG", "MONTO", $id);

				// Cargo la lista de departamentos
				$data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
				$data['departamento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "ID_DEPARTAMENTO", $municipio);;
				// Cargo la lista de ciudades
				$data['listaCiudad'] = $this->FunctionsAdmin->selectMunicipiosFromDepartamento($this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "ID_DEPARTAMENTO", $municipio));
				$data['ciudad'] = $municipio;
				//echo "<script> console.log('Consolekmunicipio: " . $municipio . "');	</script>";
				// Cargo nombre de las fases
				$data['fases'] = $this->FunctionsGeneral->selectValoresListaTablaOrder("BRI_FASEBRIG", "ID", 'ASC');
				// Listo convenios
				$data['listaConvenio'] = $this->FunctionsGeneral->selectValoresListaTabla("BRI_CONVENIOBRIG");
				// Lista de participantes
				$data['listaTsocial'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 1, ACTIVO_ESTADO);
				$data['listaProtesista'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 2, ACTIVO_ESTADO);
				$data['listaMedico'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 3, ACTIVO_ESTADO);
				$data['listaFisio'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 4, ACTIVO_ESTADO);
				$data['listaOcupacional'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 4, ACTIVO_ESTADO);
				$data['listaOcupacional'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 5, ACTIVO_ESTADO);
				$data['listaOrtesista'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 6, ACTIVO_ESTADO);
				$data['listaFacilitador'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 7, ACTIVO_ESTADO);
				$data['listaInvitado'] = $this->FunctionsGeneral->selectValoresListaTablaConPadreCondicion("BRI_FUNBRIG", "ID_ROLFUNBRIG", "BRI_ROLFUNBRIG", 8, ACTIVO_ESTADO);
				// Cargo vista
				$this->load->view('brigades/newRegister', $data);
				// Cargo validaci�n de formulario
				$this->load->view('validation/brigades/process/BrigadesAppBrigadeValidation', $data);

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
				redirect(base_url() . "BrigadesAppBrigade/board");
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA GUARDAR INFORMACI�N
	 * ****************************************************************************************************** *
	 */
	public function saveRegister()
	{
		/**
		 * Guardo la informaci�n del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida
		 */
		$mainPage = "BrigadesAppBrigade/board";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			// P�gina principal a donde debo retornar
			$mainPage = "BrigadesAppBrigade/board";
			$municipio = $this->security->xss_clean($this->input->post('ciudad'));
			$monto = $this->security->xss_clean($this->input->post('monto'));

			if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
				// Creo el registro de una nueva brigada
				// CUento e incremento el valor de las brigadas realizadas en el municipio $municipio
				$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("BRI_ENCBRIG", "ID_MUNICIPIO", $municipio) + 1;
				$encBrigade = $this->BrigadesModel->insertHeadBrigade($contador, $municipio, $monto, $this->session->userdata('usuario'));
				$fases = $this->FunctionsGeneral->selectValoresListaTablaOrder("BRI_FASEBRIG", "ID", 'ASC');
				foreach ($fases->result() as $fase) {
					// Inserto el detalle de cada fase
					$tempo = $fase->ID;
					list($fechaInicial, $fechaFinal) = explode(" - ", $this->security->xss_clean($this->input->post('fase_' . $tempo)));
					$fechaInicial = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fechaInicial);
					$fechaFinal = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fechaFinal);


					$this->BrigadesModel->insertBodyBrigade($fase->ID, $encBrigade, $this->security->xss_clean($this->input->post('convenio_' . $tempo)), $fechaInicial, $fechaFinal, $this->security->xss_clean($this->input->post('tsocial_' . $tempo)), $this->security->xss_clean($this->input->post('protesista_' . $tempo)), $this->security->xss_clean($this->input->post('medico_' . $tempo)), $this->security->xss_clean($this->input->post('fisio_' . $tempo)), $this->security->xss_clean($this->input->post('tocu_' . $tempo)), $this->security->xss_clean($this->input->post('facilitador_' . $tempo)), $this->security->xss_clean($this->input->post('invitado_' . $tempo)), $this->security->xss_clean($this->input->post('ortesista_' . $tempo)), $this->session->userdata('usuario'));
				}
			} else {
				// Actualizo el registro de una nueva brigada
				$encBrigade = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
				$monto = $this->security->xss_clean($this->input->post('monto'));

				if ($this->FunctionsGeneral->getFieldFromTable("BRI_ENCBRIG", "ID_MUNICIPIO", $encBrigade) != $municipio) {
					// Actualizo el municipio si este ha cambiado
					$this->FunctionsGeneral->updateByID("BRI_ENCBRIG", "ID_MUNICIPIO", $municipio, $encBrigade, $this->session->userdata('usuario'));
					// Actualiz� contador de la brigada
					$contador = $this->FunctionsGeneral->getQuantityFieldFromTable("BRI_ENCBRIG", "ID_MUNICIPIO", $municipio) + 1;
					$this->FunctionsGeneral->updateByID("BRI_ENCBRIG", "CONTADOR", $contador, $encBrigade, $this->session->userdata('usuario'));
				}
				//Actualizo monto
				$this->FunctionsGeneral->updateByID("BRI_ENCBRIG", "MONTO", $monto, $encBrigade, $this->session->userdata('usuario'));
				$fases = $this->FunctionsGeneral->selectValoresListaTablaOrder("BRI_FASEBRIG", "ID", 'ASC');
				foreach ($fases->result() as $fase) {
					// Inserto el detalle de cada fase
					$tempo = $fase->ID;
					list($fechaInicial, $fechaFinal) = explode(" - ", $this->security->xss_clean($this->input->post('fase_' . $tempo)));
					$fechaInicial = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fechaInicial);
					$fechaFinal = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fechaFinal);

					$this->BrigadesModel->updateBodyBrigade($this->FunctionsGeneral->getFieldFromTableNotIdFields("BRI_BRIGADA", "ID", "ID_ENCBRIG", $encBrigade, "ID_FASEBRIG", $tempo), $fase->ID, $encBrigade, $this->security->xss_clean($this->input->post('convenio_' . $tempo)), $fechaInicial, $fechaFinal, $this->security->xss_clean($this->input->post('tsocial_' . $tempo)), $this->security->xss_clean($this->input->post('protesista_' . $tempo)), $this->security->xss_clean($this->input->post('medico_' . $tempo)), $this->security->xss_clean($this->input->post('fisio_' . $tempo)), $this->security->xss_clean($this->input->post('tocu_' . $tempo)), $this->security->xss_clean($this->input->post('facilitador_' . $tempo)), $this->security->xss_clean($this->input->post('invitado_' . $tempo)), $this->security->xss_clean($this->input->post('ortesista_' . $tempo)), $this->session->userdata('usuario'));
				}
			}

			// Pinto mensaje para retornar a la aplicaci�n
			$this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "NOMBRE", $municipio));
			$this->session->set_userdata('auxiliar', 'brigadeInformation');
			// Redirecciono la p�gina
			redirect(base_url() . $mainPage);
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}
	public function inactive($id)
	{
		/**
		 * Inactivo el registro para el cual se tiene asociado el valor $id
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "BrigadesAppBrigade/board";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {

			// Cargo informaci�n de la lista teniendo en cuenta el id dado
			$id = $this->encryption->decrypt($id);
			if ($id != '') {
				$municipio = $this->FunctionsGeneral->getFieldFromTable("BRI_ENCBRIG", "ID_MUNICIPIO", $id);
				$this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "NOMBRE", $municipio));
				// Veirifico que no tenga ordenes generadas
				if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ENCORDEN", "ID_ENCBRIG", $id)) {
					// Pinto mensaje para retornar a la aplicaci�n
					$this->session->set_userdata('auxiliar', "brigadeNotChangeState");
				} else {
					$estado = $this->FunctionsGeneral->getFieldFromTable("BRI_ENCBRIG", "ESTADO", $id);
					if ($estado == 'S') {
						$estado = 'N';
					} else if ($estado == 'N') {
						$estado = 'S';
					}

					$this->FunctionsGeneral->updateByID("BRI_ENCBRIG", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
					// Pinto mensaje para retornar a la aplicaci�n
					$this->session->set_userdata('auxiliar', "brigadechangeState");
				}
				// Redirecciono la p�gina
				redirect(base_url() . $mainPage);
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
}
