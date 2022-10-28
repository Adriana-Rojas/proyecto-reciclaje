<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para visualizar el tablero de control que se defina dentro de la aplicaci�n.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class OrdersConfigurationStatistics extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		// Cargo modelos, librerias y helpers
		$this->load->model ( 'OrdersModel' ); // Libreria principal de las funciones referentes a ordenes
		$this->load->model('SystemModel');
		
	}
	public function board() {
		/**
		 * Panel principal para la gesti�n de ubicaciones
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "OrdersConfigurationStatistics/board";
		if ($this->FunctionsAdmin->validateSession($mainPage)) {
		    // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
		    $data = null;
		    // Pinto la cabecera principal de las p�ginas internas
		    showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
		    // Pinto la informaci�n de los parametros de la aplicaci�n
		    // Pinto la pantalla
		    $data['mainPage'] = $mainPage;
		    // Cargo los parametros
		    $data['listaTipo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_TIPOORDEN", 'DESC');
		    $data['tipo1'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOUSUARIOESTAD","ID_TIPO1","ID_USUARIO",$this->session->userdata('usuario'));
		    $data['tipo2'] =  $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOUSUARIOESTAD","ID_TIPO2","ID_USUARIO",$this->session->userdata('usuario'));
		    $data['tipo3'] =  $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOUSUARIOESTAD","ID_TIPO3","ID_USUARIO",$this->session->userdata('usuario'));
		    $data['tipo4'] =  $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOUSUARIOESTAD","ID_TIPO4","ID_USUARIO",$this->session->userdata('usuario'));
		    $data['tipo5'] =  $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOUSUARIOESTAD","ID_TIPO5","ID_USUARIO",$this->session->userdata('usuario'));
		    // Pinto plantilla principal
		    $this->load->view('orders/configuration/formStatistics', $data);
		    // FIn de las plantillas
		    $this->load->view('validation/orders/configuration/OrdersConfigurationStatisticsValidation');
		    // Pinto el final de la p�gina (p�ginas internas
		    showCommonEnds($this, null, null);
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	
	
	public function saveRegister() {
	    /**
	     * Panel principal para la gesti�n de ubicaciones
	     */
	    // Valido si la sessi�n existe en caso contrario saco al usuario
	    $mainPage = "OrdersConfigurationStatistics/board";
	    if ($this->FunctionsAdmin->validateSession($mainPage)) {
	        //Elimino registros que puedan llegar a existir
	        $this->OrdersModel->deleteStatisticsRelation($this->session->userdata('usuario'));
	        ;
	        $tipo1= $this->security->xss_clean($this->input->post('tipo1'));
	        $tipo2= $this->security->xss_clean($this->input->post('tipo2'));
	        $tipo3= $this->security->xss_clean($this->input->post('tipo3'));
	        if($tipo3==''){
	            $tipo3=null;
	        }
	        $tipo4= $this->security->xss_clean($this->input->post('tipo4'));
	        if($tipo4==''){
	            $tipo4=null;
	        }
	        $tipo5= $this->security->xss_clean($this->input->post('tipo5'));
	        if($tipo5==''){
	            $tipo5=null;
	        }
	        //Inserto nuevos registros
	        $this->OrdersModel->insertOrderStatistics(
	            $tipo1, 
	            $tipo2,
	            $tipo3,
	            $tipo4,
	            $tipo5, 
	            $this->session->userdata('usuario'));
    	    // Pinto mensaje para retornar a la aplicaci�n
	        $this->session->set_userdata('id',  $this->session->userdata('usuario'));
    	    $this->session->set_userdata('auxiliar', 'saveStatistics');
    	    // Redirecciono la p�gina
    	    redirect(base_url() . $mainPage);
	    } else {
	        // Retorno a la p�gina principal
	        header ( "Location: " . base_url () );
	    }
	}
	
}
?>