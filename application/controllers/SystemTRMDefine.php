<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para visualizar los parametros generales de la aplicaci�n.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class SystemTRMDefine extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		// Cargo modelos, librerias y helpers
		$this->load->model('SystemModel');
		// $this->load->model('MailingOsc');
	}

	public function board()
	{
		/**
		 * Formulario para definir los parametros generales de la aplicaci�n
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "SystemTRMDefine/board";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			// Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
			$data = null;
			// Pinto la cabecera principal de las p�ginas internas
			showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
			// Pinto la informaci�n de los parametros de la aplicaci�n
			// Pinto la pantalla
			$data['mainPage'] = $mainPage;

			$date = isset($_GET['date']) ? $_GET['date'] : date("Y-m-d");
			//$date = isset($_GET['date']) ? $_GET['date'] : date("2022-05-04");
			error_reporting(0);
			try {
				//Se incluye de forma obligatoria la libreria nusoap
				require_once('application/lib/nusoap.php');

				//Se realiza la conexion con el webservice de SuperFinanciera a través de SOAP
				$soap = new soapclient("https://www.superfinanciera.gov.co/SuperfinancieraWebServiceTRM/TCRMServicesWebService/TCRMServicesWebService?WSDL", array(
					'soap_version'   => SOAP_1_1,
					'trace' => 1,
					"location" => "http://www.superfinanciera.gov.co/SuperfinancieraWebServiceTRM/TCRMServicesWebService/TCRMServicesWebService",
				));
				//Se llama el metodo queryTCRM identificada en el WDSL
				$response = $soap->queryTCRM(array('tcrmQueryAssociatedDate' => $date));
				$response = $response->return;
				//Se verifica si la respuesta del WebService es correcta
				if ($response->success) {

					//	echo "Fechaa:  $date<br/>";					
					$tms = (int)$response->value;
					//	echo "Tipo de cambio:  $tms<br/>";
				} else {
				}
			} catch (Exception $e) {
				header("Location: URL");
			}


			// Cargo los parametros
			// Cargo la lista de paises
			$data['valoranterior'] = $this->FunctionsGeneral->getFieldFromTable("ADM_TRM", "VALOR", 1);
			$data['valor'] = $tms;
			//$data['valor'] = $this->FunctionsGeneral->getFieldFromTable("ADM_TRM", "VALOR", 1);
			//echo "<script>console.log('ConsoleI trm: " . $data['valor'] . "' );</script>";
			// Pinto plantilla principal
			$this->load->view('system/trmDefine/board', $data);

			// FIn de las plantillas
			$this->load->view('validation/system/trmDefineValidation');
			// Pinto el final de la p�gina (p�ginas internas
			showCommonEnds($this, null, null);
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	/**
	 * RUTINAS PARA GUARDAR INFORMACI�N*
	 */
	public function saveParameters()
	{
		/**
		 * Guardo la informaci�n de los parametros dentro del sistema
		 */
		$mainPage = "SystemTRMDefine/board";
		//echo "<script>console.log('ConsoleU guardo : " . "' );</script>";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			$id = 1;
			// ----------------------- Par�metros generales -------------------------- //
			// Actualizo nombre
			$this->FunctionsGeneral->updateByID("ADM_TRM", "VALOR", $this->security->xss_clean($this->input->post('valor'), $this->input->post('valoranterior')), $id, $this->session->userdata('usuario'));

			// Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
			$this->session->set_userdata('auxiliar', "parametersOk");

			// Redirecciono la p�gina
			$mainPage = "SystemTRMDefine/board";
			redirect(base_url() . $mainPage);
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function consultatrm()
	{
		/**
		 * Guardo la informaci�n de los parametros dentro del sistema
		 */
		$mainPage = "SystemTRMDefine/board";
		//echo "<script>console.log('ConsoleY entro a consulta: "  . "' );</script>";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
			// ----------------------- Par�metros generales -------------------------- //
			$date = isset($_GET['date']) ? $_GET['date'] : date("2022-05-04");
			error_reporting(0);
			try {
				//Se incluye de forma obligatoria la libreria nusoap
				require_once('application/lib/nusoap.php');

				//Se realiza la conexion con el webservice de SuperFinanciera a través de SOAP
				$soap = new soapclient("https://www.superfinanciera.gov.co/SuperfinancieraWebServiceTRM/TCRMServicesWebService/TCRMServicesWebService?WSDL", array(
					'soap_version'   => SOAP_1_1,
					'trace' => 1,
					"location" => "http://www.superfinanciera.gov.co/SuperfinancieraWebServiceTRM/TCRMServicesWebService/TCRMServicesWebService",
				));
				//Se llama el metodo queryTCRM identificada en el WDSL
				$response = $soap->queryTCRM(array('tcrmQueryAssociatedDate' => $date));
				$response = $response->return;
				//Se verifica si la respuesta del WebService es correcta
				if ($response->success) {

					echo "Fechaa:  $date<br/>";
					$tms = (int)$response->value;
					echo "Tipo de cambio:  $tms<br/>";
				} else {
				}
			} catch (Exception $e) {
			}

			//echo "<script>console.log('ConsoleT: " .  $tms . "' );</script>";

			// Cargo los parametros
			// Cargo la lista de paises
			//$data['valor'] = $this->FunctionsGeneral->getFieldFromTable("ADM_TRM", "VALOR", 1);
			$data['valor'] = $tms;

			// Redirecciono la p�gina
			$mainPage = "SystemTRMDefine/board";
			redirect(base_url() . $mainPage);
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
			//echo "<script>console.log('ConsoleR eror : " .  $tms . "' );</script>";
		}
	}
}
