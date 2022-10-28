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
class MainApp extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		// Cargo modelos, librerias y helpers
		$this->load->model ( 'OrdersModel' ); // Libreria principal de las funciones referentes a ordenes
	}
	public function board() {
		/**
		 * Panel principal para la gesti�n de ubicaciones
		 */
		// Valido si la sessi�n existe en caso contrario saco al usuario
		$mainPage = "MainApp/board";
		if ($this->FunctionsAdmin->validateSession ( $this->encryption->encrypt ( CTE_SAVE_INFORMATION_PROGRAM ) )) {
			// Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
			$data = null;
			
			// Pinto la cabecera principal de las p�ginas internas
			showCommon ( $this->session->userdata ( 'auxiliar' ), $this, $mainPage, "myTable", null );
			//Pinto estadisticas generales totales por proceso 
			$data['procesos']=$this->OrdersModel->selectQuantityOrderByProcess();
			
			
			
			//Verifico si se tiene definido estadisticas para el usuario
			if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_TIPOUSUARIOESTAD", "ID_USUARIO", $this->session->userdata('usuario')) > 0) {
			    //Defino que se presentar�n gr�ficas 
			    $data['graficas']=true;
			    
			    //Obtengo los valores de los tipos de ordenes que se presentar�n
			    $tipo1=$this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOUSUARIOESTAD","ID_TIPO1","ID_USUARIO", $this->session->userdata('usuario'));
			    $tipo[1]=$tipo1;
				$data['tipo1']=$this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN","PREFIJO",$tipo1);
				$tipo2=$this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOUSUARIOESTAD","ID_TIPO2","ID_USUARIO", $this->session->userdata('usuario'));
			    $tipo[2]=$tipo2;
			    $data['tipo2']=$this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN","PREFIJO",$tipo2);
			    $tipo3=$this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOUSUARIOESTAD","ID_TIPO3","ID_USUARIO", $this->session->userdata('usuario'));
			    $tipo[3]=$tipo3;
			    $data['tipo3']=$this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN","PREFIJO",$tipo3);
			    $tipo4=$this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOUSUARIOESTAD","ID_TIPO4","ID_USUARIO", $this->session->userdata('usuario'));
			    $tipo[4]=$tipo4;
			    $data['tipo4']=$this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN","PREFIJO",$tipo4);
			    $tipo5=$this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOUSUARIOESTAD","ID_TIPO5","ID_USUARIO", $this->session->userdata('usuario'));
			    $tipo[5]=$tipo5;
			    $data['tipo5']=$this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN","PREFIJO",$tipo5);
			    //Pinto informaci�n sobre el estado actual de los tipos de �rdenes
			    $data['valor1']=$this->OrdersModel->selectQuantityOrderByTipo($tipo1) ;
			    $data['valor2']=$this->OrdersModel->selectQuantityOrderByTipo($tipo2) ;
			    $data['valor3']=$this->OrdersModel->selectQuantityOrderByTipo($tipo3) ;
			    $data['valor4']=$this->OrdersModel->selectQuantityOrderByTipo($tipo4) ;
			    $data['valor5']=$this->OrdersModel->selectQuantityOrderByTipo($tipo5) ;
			    
			    //Pinto informaci�n sobre el hist�rico de los tipos de �rdenes
			    $mes=defineArrayMeses();
			    $mesActual= date('m') ;
			    $mesInicio=$mesActual-(PERIODO-1);
			    
			    $j = 0;
                $return = null;
                $returnLetra = null;
                for ($i = $mesInicio; $i <= $mesActual; $i ++) {
                    $k = $i;
                    if ($k < 1) {
                        $k = $i + 11;
                        $ano = date('Y') - 1;
                    } else {
                        $ano = date('Y');
                    }
                    if ($j < PERIODO) {
                        $fechaInicial = $ano . "/" . $mes[$k][2] . "/01";
                        
                       // echo "<br>" . $k . " " . $var . "<br>";
                        $fechaFin = $ano . "/" . $mes[$k][2] . "/". $mes[$k][3];
                        $sumar= strtotime($fechaFin)+86400;
                        $fechaFin = date("Y/m/d", $sumar );
                       // echo "<br>" . $fechaFin . "<br>";
                        
                        $periodo = $ano . "-" . $mes[$k][2];
                        
                        // Creo arreglo de datos
                        $return .= "{ month: '$periodo',";
                        // Recorro tipos de ordenes
                        $letras = arrayLetras();
                        for ($m = 1; $m < count($tipo); $m ++) {
                            if ($tipo[$m] != null) {
                                $tempo = $this->OrdersModel->selectQuantityOrderByTipoFullDateCondition(
                                    $tipo[$m], 
                                    defineFormatoFechaInverso($fechaInicial, false), 
                                    defineFormatoFechaInverso($fechaFin, false));
                                if ($tempo == '') {
                                    $tempo = 0;
                                }
                                $return .= $letras[$m] . ":" . $tempo . ", ";
                            }
                        }
                        
                        $return .= "},";
                        // echo $fechaInicial." ".$fechaFin."<br>";
                        $j ++;
                    }
                }
                // Defino array de las letras
                for ($m = 1; $m < count($tipo); $m ++) {
                    if ($tipo[$m] != null) {
                        $returnLetra .= "'" . $letras[$m] . "',";
                    }
                }
                $data['historico'] = $return;
                $data['historicoLetras'] = $returnLetra;
            } else {
                $data['graficas'] = false;
            }
			
			
           	$data['ordenes'] =retornaOrdenesActualesParaNotificacion( $this->session->userdata ( 'usuario' ));
		
			   //echo "<script>console.log('Console: " . $data['ordenes'] . "' );</script>";
			
			
			// print_r($this->session->userdata());
			$this->load->view ( 'main/board', $data );
			// Pinto el final de la p�gina (p�ginas internas
			
			showCommonEnds ( $this, null, null );
		} else {
			// Retorno a la p�gina principal
			header ( "Location: " . base_url () );
		}
	}
	
}
?>
