<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Página en la cual se realiza el logueo al sistema de información, teniendo como base un usuario y una contraseña.
 los datos serán enviados al logueo.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2018 *******************************
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Home extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		// Cargo modelos y librerias
		$this->load->model ( 'Users' );
	}
	public function index() {
		// Redirecciono a la página respectiva
		$redirect = "Home/paintLogin/";
		redirect ( base_url () . $redirect );
	}
	public function paintLogin($mensaje = null) {
		// Pinto el formulario de ingreso de sesión, se verifica si hay algun valor en el mensaje para pintar el valor, en caso contrario no se pinta mensaje
		$data = array ();
		
		$data ['error'] = $this->session->flashdata ( 'error' );
		echo $data ['error'];
		// Borro sesiones anteriores
		
		/*
		 $plain_text = 'Qwerty';
		 $ciphertext = password_hash($plain_text, PASSWORD_BCRYPT);
		 echo "Hash: ".$ciphertext."<br> ";
		$ciphertext = $this->encryption->encrypt($ciphertext);
		 echo "Texto cifrado: ".$ciphertext."<br> ";
		
		 // Outputs: This is a plain-text message!
		 $ciphertext= $this->encryption->decrypt($ciphertext);
		 echo "Texto descifrado: ".$ciphertext." <br> validaci&oacute;n: ".password_verify($plain_text, $ciphertext)."<br>";
		
		*/
		// $this->Prueba->insertContact(rand(5,80),"pedro");
		$this->session->sess_destroy ();
		$data ['clase'] = null;
		$data ['validador'] = null;
		$mensaje = $this->encryption->decrypt ( $mensaje );
		if ($mensaje != '') {
			$datos = $this->FunctionsAdmin->selectValoresMensajeAplicacion ( $mensaje, 1 );
			if ($datos!= null  && (($mensaje == 'errorPassword') || ($mensaje == 'errorUser') || ($mensaje == 'inactiveUser') || ($mensaje == 'pswHistory') || ($mensaje == 'emailNotExist') || ($mensaje == 'passwordChange2'))

			) {
				// Pinto el mensaje solo para este tipo de mensajes
				$mensaje = $datos [0]->MENSAJE;
				if ($datos [0]->CLASE == 'success') {
					$mensaje .= " " . $this->session->userdata ( 'id' );
				}
				$data ['titulo'] = $datos [0]->TITULO;
				$data ['mensaje'] = $mensaje;
				$data ['clase'] = $datos [0]->CLASE;
				$data ['validador'] = 1;
			} else {
				// Como el mensaje no esta definido dentro de los que se deben pintar, no envio ningún valor para ser pintado
				$data ['mensaje'] = null;
			}
		} else {
			// NO se definio ningún valor dentro de la variable $mensaje, no se enviará ningún valor a pintar.
			$data ['mensaje'] = $mensaje;
		}
		
		// Cuerpo del Home
		$this->load->view ( 'home/home', $data );
	}
	
	public function changePassword($id, $valida = null) {
		// Verifico si los datos de ingreso son los incorrectos
		// Header del archivo html donde se incluyen las librerias js, css de la aplicación
		// De Codifico el valor de id recibido
		$id = $this->encryption->decrypt ( $id );
		$data ['validador'] = 1;
		$fila = $this->Users->getUsersCondition ( $id );
		if ($fila !=null) {
			// Obtengo el mensaje de la aplicación de acuerdo al valor de $valida
			if ($valida != '') {
				// Decodifico la variable $valida
				$valida = $this->encryption->decrypt ( $valida );
				if ($valida == 1) {
					$datos = $this->FunctionsAdmin->selectValoresMensajeAplicacion ( 'changePasswordDate', 1 );
				} else {
					$datos = $this->FunctionsAdmin->selectValoresMensajeAplicacion ( 'changePassword', 1 );
				}
			} else {
				$datos = $this->FunctionsAdmin->selectValoresMensajeAplicacion ( 'changePassword', 1 );
			}
			// Pinto el mensaje
			if ($datos!= null ) {
				// Pinto el mensaje solo para este tipo de mensajes
				$mensaje = $datos [0]->MENSAJE;
				if ($datos [0]->CLASE == 'success') {
					$mensaje .= " " . $page->session->userdata ( 'id' );
				}
				$data ['titulo'] = $datos [0]->TITULO;
				$data ['mensaje'] = $mensaje;
				$data ['clase'] = $datos [0]->CLASE;
			}
			// Pinto la información que debe validar la clave de usuario
			$data ['clave'] = $this->encryption->decrypt ( $fila->CLAVE );
			$data ['longitud'] = $this->FunctionsGeneral->getFieldFromTable ( "ADM_PARAMETROS", "LONGITUD", 1 );
			$data ['mayusculasId'] = $this->FunctionsGeneral->getFieldFromTable ( "ADM_PARAMETROS", "MAYUSCULAS", 1 );
			$data ['numerosId'] = $this->FunctionsGeneral->getFieldFromTable ( "ADM_PARAMETROS", "NUMEROS", 1 );
			$data ['especialesId'] = $this->FunctionsGeneral->getFieldFromTable ( "ADM_PARAMETROS", "ESPECIALES", 1 );
			// Asigno el valor del usuario ya descifrado
			$data ['id'] = $id;
			// Cuerpo del Home
			$this->load->view ( 'home/changePassword', $data );
		} else {
			// Pinto el mensaje indicando que hay un error de usuario y retorno al index
			$redirect = "Home/errorPassword/";
			redirect ( base_url () . $redirect );
		}
	}
	public function passwordError() {
		// Redirecciono a la página respectiva
		$mensaje = $this->encryption->encrypt ( 'errorPassword' );
		$redirect = "Home/paintLogin/" . $mensaje;
		redirect ( base_url () . $redirect );
	}
	public function inactiveUser() {
		// Redirecciono a la página respectiva
		$mensaje = $this->encryption->encrypt ( 'inactiveUser' );
		$redirect = "Home/paintLogin/" . $mensaje;
		redirect ( base_url () . $redirect );
	}
	public function errorUser() {
		// Redirecciono a la página respectiva
		$mensaje = $this->encryption->encrypt ( 'errorUser' );
		$redirect = "Home/paintLogin/" . $mensaje;
		redirect ( base_url () . $redirect );
	}
	public function emailNotExist() {
		// Redirecciono a la página respectiva
		$mensaje = $this->encryption->encrypt ( 'errorUser' );
		$redirect = "Home/paintLogin/" . $mensaje;
		redirect ( base_url () . $redirect );
	}
	public function pswHistory() {
		// Redirecciono a la página respectiva
		$mensaje = $this->encryption->encrypt ( 'pswHistory' );
		$redirect = "Home/paintLogin/" . $mensaje;
		redirect ( base_url () . $redirect );
	}
	public function passwordChange() {
		// Redirecciono a la página respectiva
		$mensaje = $this->encryption->encrypt ( 'passwordChange2' );
		$redirect = "Home/paintLogin/" . $mensaje;
		redirect ( base_url () . $redirect );
	}
}
?>

