<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						P�gina en la cual se realiza el logueo al sistema de informaci�n, teniendo como base un usuario y una contrase�a.
 los datos ser�n enviados al logueo.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2018 *******************************
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

