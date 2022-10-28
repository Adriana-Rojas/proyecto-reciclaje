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
class Information extends CI_Controller {
	public function __construct() {
		parent::__construct ();
		// Cargo modelos y librerias
		$this->load->model ( 'Users' );
	}
	public function index() {
		phpinfo();
	}
	
}
?>

