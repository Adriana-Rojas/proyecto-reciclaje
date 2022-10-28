<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electrónico:           jcescobarba@gmail.com
 Creación:                     27/02/2018
 Modificación:                 2019/11/06
 Propósito: Controlador para visualizar los parametros del perfil de seguimiento de la aplicación.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
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
         * Formulario para definir los parametros generales de la aplicación
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "OrdersConfigurationProfile/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la información de los parametros de la aplicación
            //$data['botonesBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'parametersProfile',$idModule,VIEW_BUTTON_PERMISSION) ;
            $data['listaPerfil'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PERFIL");

            $data['perfil'] = $this->FunctionsGeneral->getFieldFromTable("ORD_PERFILSEGUIMIENTO", "ID_PERFIL", 0);

            // Pinto plantilla principal
            $this->load->view('orders/configuration/parametersProfile', $data);
            // FIn de las plantillas
            $this->load->view('validation/orders/configuration/ordersConfigurationProfile');
            // Pinto el final de la página (páginas internas
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    /**
     * RUTINAS PARA GUARDAR INFORMACIÒN*
     */
    public function saveParameters()
    {
        /**
         * Guardo la información de los parametros dentro del sistema
         */
        $mainPage = "OrdersConfigurationProfile/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = 1;
            // ----------------------- Parámetros generales -------------------------- //
            // Actualizo nombre
            $this->FunctionsGeneral->updateByID("ORD_PERFILSEGUIMIENTO", "ID_PERFIL", $this->security->xss_clean($this->input->post('perfil')), 0, $this->session->userdata('usuario'));
           
           
            // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
            $this->session->set_userdata('auxiliar', "profileTraceDefine");
           
            // Redirecciono la página
            $mainPage = "OrdersConfigurationProfile/board";
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }
}
?>