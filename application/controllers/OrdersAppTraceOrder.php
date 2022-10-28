<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electronico:          	jcescobarba@gmail.com
 Creacion:                    	27/02/2018
 Modificacion:                	2019/11/06
 Proposito:						Controlador para la gestion de ordenes en el proceso de ordenar.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTo COLOMBIA 2017 *******************************
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class OrdersAppTraceOrder extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		// Cargo modelos, librerias y helpers
		$this->load->model ( 'OrdersModel' ); // Libreria principal de las funciones referentes a ordenes
		$this->load->model ( 'EsaludModel' ); // Libreria principal de las funciones referentes a la lectura de informacion del sistema ESALUD
		$this->load->model ( 'SystemModel' ); // Librerias del sistema
	}
	
	/**
	 * ***********************************************************************************************************
	 * RUTINAS PARA PINTAR FORMULARIOS
	 * ****************************************************************************************************** *
	 */
	
	
	public function board() {
		/**
		 * Presento el formulario para la busqueda de informaci�n de acuerdo al proceso y tipo de orden para filtar as� el estado
		 */
		
		// Valido si la session existe en caso contrario saco al usuario
		$mainPage = "OrdersAppTraceOrder/board";
		if ($this->session->userdata('login')=='SI') {
			
			
			// Pinto la cabecera principal de las poginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
			
			// echo "<center>".$this->session->userdata('proceso')." ".$this->session->userdata('brigada')."</center>";
			/**
			 * Informacion relacionada con la plantilla principal Pinto la pantalla *
			 */
			$data ['mainPage'] = $mainPage;
			$data ['board'] = "Valores parametrizados";
			// Pinto los permisos del tablero de control
			$idModule = $this->FunctionsGeneral->getFieldFromTableNotId ( "ADM_MODULO", "ID", "PAGINA", $mainPage );
			$data ['pagina'] = "OrdersAppTraceOrder/massiveTrace";
			
			// Listado de tipos de proceso
			$data['listaProceso'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_PROCESO", 'DESC');
			// Listado de tipos de proceso
			$data['listaTipo'] = $this->FunctionsGeneral->selectValoresListaTabla("ORD_TIPOORDEN", 'DESC');
			
			// Pinto plantilla principal
			$this->load->view ( 'common/forms/formSearchFilter', $data );
			$this->load->view ( 'validation/orders/process/ordersFormFilterSearchMassiveTrace' );
			
			/**
			 * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
			 */
			// Pinto el final de la pogina (poginas internas)
			showCommonEnds ( $this, null, null );
		} else {
			// Retorno a la pogina principal
			header ( "Location: " . base_url () );
		}
	}
	
	public function massiveTrace() {
	    /**
	     * Cargo las ordenes que cumplen los parametros de busqueda
	     */
	    
	    // Valido si la session existe en caso contrario saco al usuario
	    $mainPage = "OrdersAppTraceOrder/board";
	    if ($this->session->userdata('login')=='SI') {
	        
	        
	        // Pinto la cabecera principal de las poginas internas
	        showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
	        
	        // echo "<center>".$this->session->userdata('proceso')." ".$this->session->userdata('brigada')."</center>";
	        /**
	         * Informacion relacionada con la plantilla principal Pinto la pantalla *
	         */
	        $data ['mainPage'] = $mainPage;
	        $data ['board'] = "Valores parametrizados";
	        // Pinto los permisos del tablero de control
	        $idModule = $this->FunctionsGeneral->getFieldFromTableNotId ( "ADM_MODULO", "ID", "PAGINA", $mainPage );
	        $data ['pagina'] = "OrdersAppTraceOrder/massiveTrace";
                
                // Listado de tipos de proceso
            $data['nombreProceso'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_PROCESO", "NOMBRE", "ID", $this->security->xss_clean($this->input->post('proceso')));
            $data['proceso'] =$this->security->xss_clean($this->input->post('proceso'));
            // Listado de tipos de proceso
            $data['nombreTipo'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "NOMBRE", "ID", $this->security->xss_clean($this->input->post('tipo')));
            $data['tipo'] =$this->security->xss_clean($this->input->post('tipo'));
            
            //Listado de estados
            $estado=$this->FunctionsGeneral->getFieldFromTableNotId("ORD_TORDPROEST", "ID_ESTADO", "ID", $this->security->xss_clean($this->input->post('estado')));
            $data['nombreEstado'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ESTADOS", "NOMBRE", "ID", $estado);
            $data['estado'] =$this->security->xss_clean($this->input->post('estado'));
	        
            //Listo las observaciones para el estado
            $data['listaObservacion'] =$this->OrdersModel->selectObservationListFromState ($estado );
	        //Listo las ordenes que se encuentren en el estado seleccionado
	        $data['listaLista'] =$this->OrdersModel->selectOrdersFromState($this->security->xss_clean($this->input->post('estado')));
	        
	        // Pinto plantilla principal
	        $this->load->view ( 'orders/process/formMassiveProcess', $data );
	        $this->load->view ( 'validation/orders/process/ordersFormMassiveTrace' );
	        
	        /**
	         * Fin: Informacion relacionada con la plantilla principal Pinto la pantalla
	         */
	        // Pinto el final de la pogina (poginas internas)
	        showCommonEnds ( $this, null, null );
	    } else {
	        // Retorno a la pogina principal
	        header ( "Location: " . base_url () );
	    }
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
	
	
	
	
}

?>