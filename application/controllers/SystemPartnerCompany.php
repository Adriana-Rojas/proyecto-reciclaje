<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para definir los diferentes procesos de �rdenes
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class SystemPartnerCompany extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();

		//Cargo modelos, librerias y helpers
		$this->load->model('EsaludModel'); // Libreria principal de las funciones referentes a la lectura de informaci�n del sistema ESALUD
	}

	/** *********************************************************************************************************** 
    										RUTINAS PARA PINTAR FORMULARIOS
	 ******************************************************************************************************* **/
	public function board()
	{
		/** Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado*/


		//Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "SystemPartnerCompany/board";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			//Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
			$mainPage = "SystemPartnerCompany/board";
			$data = null;
			//Pinto la cabecera principal de las p�ginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			//Pinto la informaci�n de los parametros de la aplicaci�n

			/** Informaci�n relacionada con la plantilla principal Pinto la pantalla    **/
			$data['mainPage'] = $mainPage;
			$data['pagina'] = "SystemPartnerCompany/newRegister";
			$data['board'] = "Valores parametrizados";
			//Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
			$data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
			$data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);

			//Lista de listas
			$data['listaLista'] = $this->FunctionsAdmin->selectEmpresaAliada();


			//Pinto plantilla principal
			//Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
			$this->load->view('system/partnerDefine/board', $data);

			/** Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla*/

			//Pinto el final de la p�gina (p�ginas internas)
			showCommonEnds($this, null, null);
		} else {
			//Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function newRegister()
	{
		/**Formulario para crear un nuevo registro del parametro*/
		//Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "SystemPartnerCompany/board";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			//Cargo la p�gina principal
			$mainPage = "SystemPartnerCompany/board";
			$data = null;
			//Pinto la cabecera principal de las p�ginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

			/** Informaci�n relacionada con la plantilla principal Pinto la pantalla    **/

			///Inicializo variables de los campos del formulario
			$data['pagina'] = "SystemPartnerCompany/saveRegister";
			$data['mainPage'] = $mainPage;
			$data['valida'] = $this->encryption->encrypt('newRegister');
			$data['id'] = null;
			//Cargo la lista de departamentos
			$data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
			$data['departamento'] = NULL;
			//Cargo la lista de ciudades
			$data['listaCiudad'] = NULL;
			$data['ciudad'] = NULL;
			//cARGO LISTADO DE EMPRESAS
			$data['listaEmpresas'] = $this->EsaludModel->getCompaniesInformation();
			$data['empresa'] = NULL;
			$data['correo'] = null;
			$data['telefono'] = null;
			$data['direccion'] = null;

			//Cargo vista
			$this->load->view('system/partnerDefine/newRegister', $data);
			// Cargo validaci�n de formulario
			$this->load->view('validation/system/SystemPartnerCompanyValidation');

			/** Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla*/

			//Pinto el final de la p�gina (p�ginas internas)
			showCommonEnds($this, null, null);
		} else {
			//Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function edit($id)
	{
		/**Formulario para editar la informaci�n previamente creada para el parametro de la aplicaci�n */
		//Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "SystemPartnerCompany/board";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			$id = $this->FunctionsGeneral->getFieldFromTable("ADM_ALIADA", "ID", $this->encryption->decrypt($id));
			if ($id != '') {
				//Pinto las vistas adicionales a trav�s de la funci�n showCommon del helper
				$mainPage = "SystemPartnerCompany/board";
				$data = null;
				//Pinto la cabecera principal de las p�ginas internas
				showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

				/** Informaci�n relacionada con la plantilla principal Pinto la pantalla    **/

				//Inicializo variables de la vista
				$data['pagina'] = "SystemPartnerCompany/saveRegister";
				$data['valida'] = $this->encryption->encrypt('edit');
				$data['mainPage'] = $mainPage;

				$data['id'] = $this->encryption->encrypt($id);
				//Cargo la lista de departamentos
				$data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
				$municipio = $this->FunctionsGeneral->getFieldFromTable("ADM_ALIADA", "ID_MUNICIPIO", $id);
				$data['departamento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "ID_DEPARTAMENTO", $municipio);;
				//Cargo la lista de ciudades

				$data['listaCiudad'] = $this->FunctionsAdmin->selectMunicipiosFromDepartamento($this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "ID_DEPARTAMENTO", $municipio));
				$data['ciudad'] = $municipio;
				//echo "<script> console.log('Consolekmunicipioo: " . $municipio . "');	</script>";
				$data['correo'] = $this->FunctionsGeneral->getFieldFromTable("ADM_ALIADA", "CORREO", $id);
				$data['telefono'] = $this->FunctionsGeneral->getFieldFromTable("ADM_ALIADA", "TELEFONO", $id);
				$data['direccion'] = $this->FunctionsGeneral->getFieldFromTable("ADM_ALIADA", "DIRECCION", $id);

				//cARGO LISTADO DE EMPRESAS
				$data['listaEmpresas'] = $this->EsaludModel->getCompaniesInformation();
				$data['empresa'] = $this->FunctionsGeneral->getFieldFromTable(
					"ADM_ALIADA",
					"EMPRESA",
					$id
				);

				//Cargo vista
				$this->load->view('system/partnerDefine/newRegister', $data);
				// Cargo validaci�n de formulario
				$this->load->view('validation/system/SystemPartnerCompanyValidation');

				/** Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla*/

				//Pinto el final de la p�gina (p�ginas internas)
				showCommonEnds($this, null, null);
			} else {
				//Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
				$this->session->set_userdata('id', $id);
				$this->session->set_userdata('auxiliar', "notInformationGeneral");
				//Redirecciono la p�gina
				redirect(base_url() . "SystemPartnerCompany/board");
			}
		} else {
			//Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	/** ***********************************************************************************************************
     										RUTINAS PARA GUARDAR INFORMACI�N
	 ******************************************************************************************************* **/

	public function saveRegister()
	{
		/** Guardo la informaci�n del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida*/
		$mainPage = "SystemPartnerCompany/board";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			// P�gina principal a donde debo retornar
			$mainPage = "SystemPartnerCompany/board";
			$empresa = $this->security->xss_clean($this->input->post('empresa'));
			$municipio = strtoupper($this->security->xss_clean($this->input->post('ciudad')));
			$correo = strtoupper($this->security->xss_clean($this->input->post('correo')));
			$telefono = strtoupper($this->security->xss_clean($this->input->post('telefono')));
			$direccion = strtoupper($this->security->xss_clean($this->input->post('direccion')));
			if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
				if ($this->FunctionsGeneral->getQuantityFieldFromTable("ADM_ALIADA", "EMPRESA", $empresa, 'ID_MUNICIPIO', $municipio, 'CORREO', $correo, 'TELEFONO', $telefono,'DIRECCION', $direccion) == 0) {
					//Creo el registro
					$id = $this->FunctionsGeneral->insertcincoParameter(
						"ADM_ALIADA",
						$this->session->userdata('usuario'),
						"EMPRESA",
						$empresa,
						"ID_MUNICIPIO",
						$municipio,
						"CORREO",
						$correo,
						"TELEFONO",
						$telefono,
						"DIRECCION",
						$direccion
					);

					//Pinto mensaje para retornar a la aplicaci�n
					$this->session->set_userdata('id', $nombre);
					$this->session->set_userdata('auxiliar', 'configUpdate');
					//Redirecciono la p�gina
					redirect(base_url() . $mainPage);
				} else {
					//Creo mensaje de creaci�n de usuario
					$mensaje = "ConfigExist";
					//Pinto mensaje para retornar a la aplicaci�n
					$this->session->set_userdata('id', $id);
					$this->session->set_userdata('auxiliar', $mensaje);
					//Redirecciono la p�gina
					redirect(base_url() . $mainPage);
				}
			} else {
				//Actualizo los valores para el parametro respectivo en la tabla dada
				$this->FunctionsGeneral->updateByID(
					"ADM_ALIADA",
					"EMPRESA",
					$empresa,
					$this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))),
					$this->session->userdata('usuario')
				);
				$this->FunctionsGeneral->updateByID(
					"ADM_ALIADA",
					"ID_MUNICIPIO",
					$municipio,
					$this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))),
					$this->session->userdata('usuario')
				);
				$this->FunctionsGeneral->updateByID(
					"ADM_ALIADA",
					"CORREO",
					$correo,
					$this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))),
					$this->session->userdata('usuario')
				);

				$this->FunctionsGeneral->updateByID(
					"ADM_ALIADA",
					"TELEFONO",
					$telefono,
					$this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))),
					$this->session->userdata('usuario')
				);
				
				$this->FunctionsGeneral->updateByID(
					"ADM_ALIADA",
					"DIRECCION",
					$direccion,
					$this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))),
					$this->session->userdata('usuario')
				);

				//Pinto mensaje para retornar a la aplicaci�n
				$this->session->set_userdata('id', $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))));
				$this->session->set_userdata('auxiliar', 'configUpdate');
				//Redirecciono la p�gina
				redirect(base_url() . $mainPage);
			}
		} else {
			//Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function inactive($id)
	{
		/** Inactivo el registro para el cual se tiene asociado el valor $id*/
		//Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "SystemPartnerCompany/board";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			// P�gina principal a donde debo retornar
			$mainPage = "SystemPartnerCompany/board";

			//Cargo informaci�n de la lista teniendo en cuenta el id dado
			//Obtengo el id del contacto
			$id = $this->FunctionsGeneral->getFieldFromTable("ADM_ALIADA", "ID", $this->encryption->decrypt($id));
			if ($id != '') {
				$estado = $this->FunctionsGeneral->getFieldFromTable("ADM_ALIADA", "ESTADO", $id);
				if ($estado == 'S') {
					$estado = 'N';
				} else if ($estado == 'N') {
					$estado = 'S';
				}
				$message = 'changeStateGeneral';
				$this->FunctionsGeneral->updateByID(
					"ADM_ALIADA",
					"ESTADO",
					$estado,
					$id,
					$this->session->userdata('usuario')
				);
				//Pinto mensaje para retornar a la aplicaci�n
				$this->session->set_userdata('id', $id);
				$this->session->set_userdata('auxiliar', $message);
				//Redirecciono la p�gina
				redirect(base_url() . $mainPage);
			} else {
				//Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
				$this->session->set_userdata('id', $id);
				$this->session->set_userdata('auxiliar', "notInformationGeneral");
				//Redirecciono la p�gina
				redirect(base_url() . $mainPage);
			}
		} else {
			//Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}
}
