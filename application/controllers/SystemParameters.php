<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Controlador para visualizar los parametros generales de la aplicación.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class SystemParameters extends CI_Controller
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
        $mainPage = "SystemParameters/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la información de los parametros de la aplicación
            // Pinto la pantalla
            $data['mainPage'] = $mainPage;
            // Cargo los parametros
            // Cargo la lista de paises
            $data['listaPais'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PAIS");
            // Cargo la lista de departamentos
            $data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
            // Cargo la lista de ciudades
            $data['listaCiudad'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_MUNICIPIO");
            // Tipos de documentos
            $data['listaTipoDocumento'] = $this->FunctionsAdmin->selectValoresListaAdministracion('TIPO_DOCEMPRESA', '1');
            // Si no
            $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
            // Agrupa por
            // $data['listaAgrupa']=$this->FunctionsAdmin->selectValoresListaAdministracion('LISTA_AGRUPA','1');
            
            $listParameters = $this->SystemModel->getParameters(1);
            foreach ($listParameters as $value) {
                $data['tipoDocumento'] = $value->ID_TIPODOCUMENTO;
                $data['documento'] = $value->DOCUMENTO;
                $data['nombre'] = $value->NOMBRE;
                $data['direccion'] = $value->DIRECCION;
                $data['telefono'] = $value->TELEFONO;
                $data['correo'] = $value->CORREO;
                $data['pais'] = $value->ID_PAIS;
                if ($value->ID_PAIS != CTE_PAIS_DEFECTO) {
                    $data['display'] = "style=\"display: none;\"";
                    $data['disabled'] = "disabled=\"disabled\"";
                    $data['ciudad'] = null;
                    $data['departamento'] = null;
                } else {
                    $data['display'] = "";
                    $data['disabled'] = "";
                    $data['ciudad'] = $value->ID_CIUDAD;
                    $data['departamento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "ID_DEPARTAMENTO", $value->ID_CIUDAD);
                }
                $data['longitud'] = $value->LONGITUD;
                $data['mayusculas'] = $value->MAYUSCULAS;
                $data['numeros'] = $value->NUMEROS;
                $data['especiales'] = $value->ESPECIALES;
                $data['duracion'] = $value->DURACION;
                $data['historico'] = $value->HISTORICO;

                //Formatos
                $data['cotizaciones'] = $value->COD_COTI;
                $data['ordenes'] = $value->COD_ORDENES;
            }
            // Pinto plantilla principal
            $this->load->view('system/parameters/parameters', $data);
            // FIn de las plantillas
            $this->load->view('validation/system/parametersValidation');
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
        $mainPage = "SystemParameters/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = 1;
            // ----------------------- Parámetros generales -------------------------- //
            // Actualizo nombre
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "NOMBRE", $this->security->xss_clean($this->input->post('nombre')), $id, $this->session->userdata('usuario'));
            // Actualizo documento
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "DOCUMENTO", $this->security->xss_clean($this->input->post('documento')), $id, $this->session->userdata('usuario'));
            // Actualizo dirección
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "DIRECCION", $this->security->xss_clean($this->input->post('direccion')), $id, $this->session->userdata('usuario'));
            // Actualizo telefono
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "TELEFONO", $this->security->xss_clean($this->input->post('telefono')), $id, $this->session->userdata('usuario'));
            // Actualizo dirección
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "CORREO", $this->security->xss_clean($this->input->post('correo')), $id, $this->session->userdata('usuario'));
            // Actualizo CIUDAD
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "ID_CIUDAD", $this->security->xss_clean($this->input->post('ciudad')), $id, $this->session->userdata('usuario'));
            // Actualizo PAIS
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "ID_PAIS", $this->security->xss_clean($this->input->post('pais')), $id, $this->session->userdata('usuario'));
            
            // ----------------------- Parámetros contraseña -------------------------- //
            // Actualizo LONGITUD
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "LONGITUD", $this->security->xss_clean($this->input->post('longitud')), $id, $this->session->userdata('usuario'));
            // Actualizo MAYUSCULAS
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "MAYUSCULAS", $this->security->xss_clean($this->input->post('mayusculas')), $id, $this->session->userdata('usuario'));
            // Actualizo NUMEROS
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "NUMEROS", $this->security->xss_clean($this->input->post('numeros')), $id, $this->session->userdata('usuario'));
            // Actualizo ESPECIALES
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "ESPECIALES", $this->security->xss_clean($this->input->post('especiales')), $id, $this->session->userdata('usuario'));
            // Actualizo DURACION
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "DURACION", $this->security->xss_clean($this->input->post('duracion')), $id, $this->session->userdata('usuario'));
            // Actualizo HISTORICO
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "HISTORICO", $this->security->xss_clean($this->input->post('historico')), $id, $this->session->userdata('usuario'));
            

            // ----------------------- Parámetros formatos -------------------------- //
            // Actualizo LONGITUD
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "COD_ORDENES", $this->security->xss_clean($this->input->post('ordenes')), $id, $this->session->userdata('usuario'));
            $this->FunctionsGeneral->updateByID("ADM_PARAMETROS", "COD_COTI", $this->security->xss_clean($this->input->post('cotizaciones')), $id, $this->session->userdata('usuario'));

            // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
            $this->session->set_userdata('auxiliar', "parametersOk");
            
            // Redirecciono la página
            $mainPage = "SystemParameters/board";
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }
}
?>