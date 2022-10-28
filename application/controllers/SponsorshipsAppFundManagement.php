<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para visualizar el manejo de los tipos de elementos dentro de la aplicaci�n de �rdenes.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class SponsorshipsAppFundManagement extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		
		// Cargo modelos, librerias y helpers
		$this->load->model ( 'SponsorshipModel' );
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
		$mainPage = "SponsorshipsAppFundManagement/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			// Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
			$mainPage = "SponsorshipsAppFundManagement/board";
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
			$data ['listaLista'] = $this->SponsorshipModel->selectBalanceFromFund(date('m'),date('Y')) ;
			
			// Pinto plantilla principal
			$this->load->view ( 'sponsorship/operation/boardBalanceFund', $data );
			
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
	
	public function modifyBalance($id) {
		/**
		 * MOdifico los saldos del fondo seleccionado
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "SponsorshipsAppFundManagement/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			
			$id = $this->FunctionsGeneral->getFieldFromTable ( "PAT_FONSAL", "ID", $this->encryption->decrypt ( $id ) );
			if ($id != '') {
				$data = null;
				// Pinto la cabecera principal de las p�ginas internas
				showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
					
				
				//Obtengo el id del saldo del fondo
				$data ['id'] =$id;
				//Obtengo el valor actual del fondo
				$fondo=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
						"PAT_FONSAL",
						"ID_FONDOS",
						"ID",
						$id);
				//Obtengo el nombre del fondo
				$data ['nombre'] = $this->FunctionsGeneral->getFieldFromTableNotIdFields(
						"PAT_FONDOS",
						"NOMBRE",
						"ID",
						$fondo);
					
					
				// Cargo vista
				$this->load->view ( 'sponsorship/operation/formModifyBalance', $data );
				// Cargo validaci�n de formulario
				$this->load->view ( 'validation/sponsorships/process/sponsorshipsModifyBalanceValidation' );
				
					
					
				/**
				 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
				 */
					
				// Pinto el final de la p�gina (p�ginas internas)
				showCommonEnds ( $this, null, null );
			} else {
				// Retorno a la p�gina principal
				header ( "Location: " . base_url () );
			}	
			
			
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	
	public function reclassifyFunds($id) {
		/**
		 * Formulario para reclasificar fondos
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "SponsorshipsAppFundManagement/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
		$id = $this->FunctionsGeneral->getFieldFromTable ( "PAT_FONSAL", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, null, null );
					
				// Pinto el fondo
                $fondo=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
                    "PAT_FONSAL",
                    "ID_FONDOS",
                    "ID",
                    $id);
                $condicion="and PAT_FONDOS.ID!='$fondo'";
				$data ['listaLista'] = $this->SponsorshipModel->selectBalanceFromFund(date('m'),date('Y'),$condicion) ;
				
				//Obtengo el id del saldo del fondo
				$data ['id'] =$id;
				
				$data ['valor']=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
						"PAT_FONSAL",
						"VALOR",
						"ID",
						$id);
				//Obtengo el nombre del fondo
				$data ['nombre'] = $this->FunctionsGeneral->getFieldFromTableNotIdFields(
						"PAT_FONDOS",
						"NOMBRE",
						"ID",
						$fondo);
					
					
				// Cargo vista
				$this->load->view ( 'sponsorship/operation/formReclassifyFunds', $data );
				// Cargo validaci�n de formulario
				$this->load->view ( 'validation/sponsorships/process/sponsorshipsReclassifyFundsValidation', $data );
				
					
					
				/**
				 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
				 */
					
				// Pinto el final de la p�gina (p�ginas internas)
				showCommonEnds ( $this, null, null );
			} else {
				// Retorno a la p�gina principal
				header ( "Location: " . base_url () );
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
	public function saveBalance() {
		/**
		 * Genero el proceso de saldos de patrocinios
		 */
		$mainPage = "SponsorshipsAppFundManagement/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			//Obtengo el id del saldo del fondo
		    $id=$this->security->xss_clean ( $this->input->post ( 'fondo' ) );
			//Obtengo el valor actual
			$valor=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
					"PAT_FONSAL",
					"VALOR",
					"ID",
					$id);
			$fondo=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
			    "PAT_FONSAL",
			    "ID_FONDOS",
			    "ID",
			    $id);
			
		$nombre=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
					"PAT_FONDOS",
					"NOMBRE",
					"ID",
			         $fondo);
			//Actualizo valor dependiendo la acci�n dada
			if($this->security->xss_clean ( $this->input->post ( 'accion' ) )==1){
				//Adiciono el valor
				$valor=$valor+$this->security->xss_clean ( $this->input->post ( 'valor' ) );
				
			}else{
				//Resto el valor
				$valor=$valor-$this->security->xss_clean ( $this->input->post ( 'valor' ) );
			}
			//Guardo el hist�rico
			$this->SponsorshipModel->insertOperationBalanceFund(
					$id,
					$this->security->xss_clean ( $this->input->post ( 'accion' ) ), 
					date('m'),
					date('Y'),
					abs($this->security->xss_clean ( $this->input->post ( 'valor' ) )),
					$this->session->userdata ( 'usuario' ));
			//Ejecuto la actualizaci�n del saldo
			$this->FunctionsGeneral->updateByID ( "PAT_FONSAL", "VALOR", $valor, $id, $this->session->userdata ( 'usuario' ) );
			
			// Pinto mensaje para retornar a la aplicaci�n
			$this->session->set_userdata ( 'id', $nombre );
			$this->session->set_userdata ( 'auxiliar', "saveBalance" );
			// Redirecciono la p�gina
			redirect ( base_url () . $mainPage );
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	
	public function saveReclassifyFunds() {
		/**
		 * Genero el proceso de saldos de patrocinios
		 */
		$mainPage = "SponsorshipsAppFundManagement/board";
		if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
			//Obtengo el id del saldo del fondo origen
		    $id=$this->security->xss_clean ( $this->input->post ( 'fondo' ) );
			//Obtengo el valor actual
			$valor=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
					"PAT_FONSAL",
					"VALOR",
					"ID",
					$id);
			$nombreOrigen=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
					"PAT_FONDOS",
					"NOMBRE",
					"ID",
					$this->security->xss_clean ( $this->input->post ( 'fondo' ) ));
			//Resto el valor
			$valor=$valor-$this->security->xss_clean ( $this->input->post ( 'valor' ) );
			//Guardo el hist�rico
			$this->SponsorshipModel->insertOperationBalanceFund(
					$id,
					1,
					date('m'),
					date('Y'),
					abs($this->security->xss_clean ( $this->input->post ( 'valor' ) )),
					$this->session->userdata ( 'usuario' ));
			//Ejecuto la actualizaci�n del saldo
			$this->FunctionsGeneral->updateByID ( "PAT_FONSAL", "VALOR", $valor, $id, $this->session->userdata ( 'usuario' ) );
				
			//Obtengo el id del saldo del fondo destino
			$id=$this->security->xss_clean ( $this->input->post ( 'destino' ) );
			//Obtengo el valor actual
			$valor=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
					"PAT_FONSAL",
					"VALOR",
					"ID",
					$id);
			$nombreDestino=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
					"PAT_FONDOS",
					"NOMBRE",
					"ID",
					$this->security->xss_clean ( $this->input->post ( 'destino' ) ));
			//Resto el valor
			$valor=$valor+$this->security->xss_clean ( $this->input->post ( 'valor' ) );
			//Guardo el hist�rico
			$this->SponsorshipModel->insertOperationBalanceFund(
					$id,
					2,
					date('m'),
					date('Y'),
					abs($this->security->xss_clean ( $this->input->post ( 'valor' ) )),
					$this->session->userdata ( 'usuario' ));
			//Ejecuto la actualizaci�n del saldo
			$this->FunctionsGeneral->updateByID ( "PAT_FONSAL", "VALOR", $valor, $id, $this->session->userdata ( 'usuario' ) );
			// Pinto mensaje para retornar a la aplicaci�n
			$this->session->set_userdata ( 'id', $nombreOrigen." - ".$nombreDestino );
			$this->session->set_userdata ( 'auxiliar', "saveBalanceRec" );
			// Redirecciono la p�gina
			redirect ( base_url () . $mainPage );
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	
	public function generateBalances() {
	    /**
	     * Genera balance para la vigencia actual. Solo se podr� correr una vez al mes
	     */
	    // Valido si la sessi�n existe en caso contrario saco al usuario
	    $mainPage = "SponsorshipsAppFundManagement/board";
	    if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
	       //Verifico el mes actual
	       $mes=date('m');
	       $ano=date('Y');
	       $saldos=$this->SponsorshipModel->selectBalanceFromFund($mes,$ano);
	       if (count($saldos)==0){
	           //NO se han generado saldos para el periodo
	           //Identifico a�o mes anterior
	           $periodo=monthYearBefore($mes,$ano);
	           //Encuentro los fondos del mes anterior
	           $saldosAnteriores=$this->SponsorshipModel->selectBalanceFromFund($periodo[0],$periodo[1]);
	           foreach ($saldosAnteriores as $value){
	               //Genero nuevos saldos
	               ECHO $value->ID_FONDOS." ".$value->VALOR."<BR>";
	               $this->SponsorshipModel->insertBalanceFund( $value->ID_FONDOS,$mes,$ano,$value->VALOR, $this->session->userdata ( 'usuario' ) ) ;
	           }
	           
	           // Pinto mensaje para retornar a la aplicaci�n
	           $this->session->set_userdata ( 'id', $ano." - ".$mes );
	           $this->session->set_userdata ( 'auxiliar', "balanceGenerate" );
	           // Redirecciono la p�gina
	           redirect ( base_url () . $mainPage );
	           
	       }else{
	           //Ya se han generado saldos para el periodo no se generar� el proceso
	           // Pinto mensaje para retornar a la aplicaci�n
	           $this->session->set_userdata ( 'id', $ano." - ".$mes );
	           $this->session->set_userdata ( 'auxiliar', "balanceNoGenerate" );
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