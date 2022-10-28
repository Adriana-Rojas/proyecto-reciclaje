<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						COntrolador de las integraciones de las consultas de los datos de la aplicaci�n. 
 Por lo general la integraci�n de las funcionalidades del presente controlador se encuentran
 dadas a trav�s de la solicitud de informaci�n v�a JQuery
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Mailer extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function sendEmail($type, $id, $validate,$detail=null)
    {
        /**
         * Funci�n para el envio de correos electr�nicos a trav�s del sistema de informaci�n
         */
        // Cargo la libreria para envio de correos electr�nicos
        $this->load->library('email');
        $tituloCorreo = $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "NOMBRE", 1);
        
        // Obtengo los datos de acuerdo a la regla de tipo $type
        $emailFrom = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "REMITE", "NOMBRE", $type);
        $emailReplyTo = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "RESPUESTA", "NOMBRE", $type);
        $emailTo = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "DESTINO", "NOMBRE", $type);
        if ($emailTo == '') {
            // Se obtiene el destino a trav�s del $id enviado
            $tabla = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "TABLA", "NOMBRE", $type);
            $campo = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "CAMPO", "NOMBRE", $type);
            if ($type == 'sendInformationUser' || $type == 'sendInformationUser2' || $type == 'sendInformationUser3') {
                $emailTo = $this->FunctionsGeneral->getFieldFromTable($tabla, $campo, $id);
                $instrucciones = "
                <p> P&aacute;gina: " . base_url() . "</p>
                <p> Usuario: " . $id . "</p>
                <p> Clave: " . $this->session->userdata('temporal') . "</p>
                ";
                $this->session->set_userdata('temporal', '');
            } else {
                $emailTo = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable($tabla, $campo, $id));
                $instrucciones = "";
            }
        }
        $subject = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "ASUNTO", "NOMBRE", $type);
        $messages = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "CUERPO", "NOMBRE", $type);
        
        $page = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "PAGINA", "NOMBRE", $type);
        $message = $this->FunctionsGeneral->getFieldFromTableNotId("ITE_REGLASMAIL", "MENSAJE", "NOMBRE", $type);
        
        /*
          echo $emailFrom." <br>";
          echo $emailTo." <br>";
          echo $subject." <br>";
          echo $messages." <br>";
          echo $page." <br>";
          echo $message." <br>";
         
        */
        $body = paintMessageMail($this, $tituloCorreo, $messages, $instrucciones, $type);
        
        // Also, for getting full html you may use the following internal method:
        // $body = $this->email->full_html($subject, $message);
        $result = $this->email->from($emailFrom)
            ->reply_to($emailReplyTo)
            -> // Optional, an account where a human being reads.
        to($emailTo)
            ->subject($subject)
            ->message($body)
            ->send();
       // print_r($result);
        // echo $page."<br>";
        
        if ($page == 'SystemUserDefine/sendInformation' || $page == 'SystemUserDefine/sendInformation2') {
            $redirect = $page . "/" . $id . "/" . $type . "/" . $message . "/" . $validate;
        }
        //echo $redirect . "<br>";
       redirect(base_url() . $redirect);
    }
    
    
}