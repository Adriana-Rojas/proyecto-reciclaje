<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electr�nico:           jcescobarba@gmail.com
 Creaci�n:                     27/02/2018
 Modificaci�n:                 2019/11/06
 Prop�sito: Controlador para visualizar los parametros del perfil de seguimiento de la aplicaci�n.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class OrdersConfigurationProfile extends CI_Controller
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
        $mainPage = "OrdersConfigurationProfile/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la informaci�n de los parametros de la aplicaci�n
            //$data['botonesBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'parametersProfile',$idModule,VIEW_BUTTON_PERMISSION) ;
            $data['listaPerfil'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PERFIL");

            $data['perfil'] = $this->FunctionsGeneral->getFieldFromTable("ORD_PERFILSEGUIMIENTO", "ID_PERFIL", 0);

            // Pinto plantilla principal
            $this->load->view('orders/configuration/parametersProfile', $data);
            // FIn de las plantillas
            $this->load->view('validation/orders/configuration/ordersConfigurationProfile');
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
        $mainPage = "OrdersConfigurationProfile/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = 1;
            // ----------------------- Par�metros generales -------------------------- //
            // Actualizo nombre
            $this->FunctionsGeneral->updateByID("ORD_PERFILSEGUIMIENTO", "ID_PERFIL", $this->security->xss_clean($this->input->post('perfil')), 0, $this->session->userdata('usuario'));
           
           
            // Pinto mensaje para retornar a la aplicaci�n informando que no hay informaci�n para la consulta realizada
            $this->session->set_userdata('auxiliar', "profileTraceDefine");
           
            // Redirecciono la p�gina
            $mainPage = "OrdersConfigurationProfile/board";
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }
}
?>