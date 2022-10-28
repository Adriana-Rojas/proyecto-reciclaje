<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                    Juan Carlos Escobar Baquero
 Correo electrónico:            jcescobarba@gmail.com
 Creación:                      27/02/2018
 Modificación:                  2019/11/06
 Propósito:                     Controlador en el cuan se encuentra todo el manejo de cotizaciones
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class StokePriceAppStokePrice extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        // Cargo modelos, librerias y helpers
        $this->load->model('StokePriceModel');
        $this->load->model('OrdersModel');
        $this->load->model('EsaludModel');
        $this->load->model('SystemModel');
    }

    /**
     * ***********************************************************************************************************
     * RUTINAS PARA PINTAR FORMULARIOS
     * ****************************************************************************************************** *
     */
    public function board()
    {
        /**
         * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
         */

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "StokePriceAppStokePrice/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", "date");
            // Pinto la información de los parametros de la aplicación

            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            $data['board'] = "Valores parametrizados";
            // Pinto los permisos del tablero de control
            $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
            $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
            $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);

            $periodo = $this->security->xss_clean($this->input->post('periodo'));
            if ($periodo != '') {
                $fechas = explode(' - ', $periodo);
                $fechaInicial = $fechas[0];
                $fechaFin = $fechas[1];
            } else {
                if ($this->session->userdata('variable1') == '' && $this->session->userdata('variable2') == '') {
                    // Lista de listas
                    $meses = defineArrayMeses();
                    $mes = date('n');
                    /*
                     * $fechaInicial = "01/" . $meses[$mes][2] . "/" . date('Y');
                     * $fechaFin = $meses[$mes][3] . "/" . $meses[$mes][2] . "/" . date('Y');
                     */

                    $fechaInicial = date('Y') . "/" . $meses[$mes][2] . "/01";

                    $fechaFin = date('Y') . "/" . $meses[$mes][2] . "/" . $meses[$mes][3];
                    $tempoFecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fechaFin);
                    $fechaFin = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $tempoFecha);
                } else {
                    $fechaInicial = $this->session->userdata('variable1');
                    $fechaFin = $this->session->userdata('variable2');
                    $tempoFecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fechaFin);
                    $fechaFin = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $tempoFecha);
                }
            }
            $this->session->set_userdata('variable1', $fechaInicial);
            $this->session->set_userdata('variable2', $fechaFin);
            $data['fechaInicial'] = $this->session->userdata('variable1');
            $data['fechaFinal'] = $this->session->userdata('variable2');
            $condicion = "and COT_SOLICITUD.FCREA between '" . $this->session->userdata('variable1') . " 00:00:00' and '" . $this->session->userdata('variable2') . " 23:59:59'";

            $data['listaLista'] = $this->StokePriceModel->selectListStokePriceFromRequest($condicion, 1);
            $data['seguimientodos'] =  $this->StokePriceModel->selectListTraceListPriceStokeOne(65);
            $data['fecha'] = cambiaHoraServer(2);

            // Pinto plantilla principal
            $this->load->view('stokePrice/operation/boardStokePriceAppStokePrice', $data);
            $this->load->view('validation/stokePrice/process/boardStokePriceValidation', $data);

            /**
             * Fin: Información relacionada con la plantilla principal Pinto la pantalla
             */

            // Pinto el final de la página (páginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }


    public function newRequest()
    {
        /**
         * Formulario para la creación de solicitudes de cotizaci&oacute;n
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "StokePriceAppStokePrice/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la información de los parametros de la aplicación

            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */

            $data['disabledDelete'] = 'disabled="disabled"';
            // Lista de tipos de documento de identidad
            $data['listaTipoDocumento'] = $this->FunctionsAdmin->selectValoresListaAdministracion('TIPO_DOCPERSONA', '1');

            // Listado de vigencia cotizaci&oacute;n
            $data['listaVigencia'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_TIEMPO", 'DESC');
            $data['vigencia'] = 1;

            // Listado de pago
            $data['listaPago'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_PAGO", 'DESC');

            // Listado de empresas
            $condicion = "and COT_TARIFAEMPRESA.ESTADO='" . ACTIVO_ESTADO . "'";
            $data['listaEmpresa'] = $this->StokePriceModel->selectListDefineRelationCompanyRates($condicion);

            // Listado de empresas aliadas
            $data['listaAliada'] = $this->FunctionsAdmin->selectEmpresaAliada();

            // Listado de procesos
            $data['listaProcesos'] = $this->OrdersModel->selectQuantityOrderByProcess();

            // Cargo la lista de departamentos
            $data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");

            // Cargo la lista de ciudades
            $data['listaCiudad'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_MUNICIPIO");
            $data['listaCiudad'] = null;

            // Listado de incluye
            $data['listaIncluye'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_INCLUYE", 'DESC');
            $data['incluye'] = 1;

            //Listado de ejecutivos
            $data['listaUsuarios'] = $this->FunctionsAdmin->selectUsersFromProfile(PROFILE_DEFAULT_STOKEPRICE_REQUEST);




            // Cargo la vista del formulario para la creación del patrocinio
            $this->load->view('stokePrice/operation/newRequestDefinition', $data);
            // Cargo validación de formulario
            $this->load->view('validation/stokePrice/process/formNewRequestValidation');

            /**
             * Fin: Información relacionada con la plantilla principal Pinto la pantalla
             */

            // Pinto el final de la página (páginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }





    public function newRegister($idSolicitud = null)
    {
        /**
         * Formulario para crear cotizaciones
         */

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "StokePriceAppStokePrice/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la información de los parametros de la aplicación

            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['evento'] = "new";
            $idSolicitud = $this->encryption->decrypt($idSolicitud);
            // echo $idSolicitud;
            if ($idSolicitud != null) {
                // Verifico la información previamente creada si la variable $idSolicitud es diferente a vacio
                $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_USUARIO", "ID", $idSolicitud);

                $data['ejecutivo']  = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "EJECUTIVO", "ID", $idSolicitud);

                $data['tipo'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "TIPODOC", "ID", $idUsuario);
                $data['documento'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "DOCUMENTO", "ID", $idUsuario);

                $data['nombres'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "NOMBRES", "ID", $idUsuario));
                $data['apellidos'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "APELLIDOS", "ID", $idUsuario));

                $data['correo'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "CORREO", "ID", $idUsuario));
                $data['telefono'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "TELEFONO", "ID", $idUsuario));

                // Listado de empresas aliadas
                $data['listaAliada'] = $this->FunctionsAdmin->selectEmpresaAliada();

                // Listado de procesos
                $data['listaProcesos'] = $this->OrdersModel->selectQuantityOrderByProcess();

                // Cargo la lista departamentos y ciudades
                $data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
                $data['listaCiudad'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_MUNICIPIO");


                $data['empresaId'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_EMPRESA", "ID", $idSolicitud);
                $data['procesoId'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_PROCESO", "ID", $idSolicitud);
                $data['aliadaId'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_ALIADA", "ID", $idSolicitud);
                //visible element aliada
                $data['display'] = null;
                $data['listaIva'] = $this->FunctionsAdmin->selectValoresListaAdministracion('IVA', '1');

                $data['idSolicitud'] = $idSolicitud;

                //Cargo información de la solicitud de cotizaci&oacute;n para los archivos adjuntos
                $data['adjunto1'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO1", "ID", $idSolicitud));
                $data['adjunto2'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO2", "ID", $idSolicitud));
            } else {
                // Retorno valores nulos
                $data['tipo'] = null;
                $data['documento'] = null;
                $data['nombres'] = null;
                $data['apellidos'] = null;
                $data['correo'] = null;
                $data['telefono'] = null;
                $data['empresaId'] = NULL;
                $data['municipioId'] = null;
                $data['idSolicitud'] = NULL;
                $data['ejecutivo'] = null;
                $data['procesoId'] = null;
                $data['aliadaId'] = null;
                $data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
                // Cargo la lista de ciudades
                $data['listaCiudad'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_MUNICIPIO");
                $data['listaCiudad'] = null;

                $data['listaAliada'] = $this->FunctionsAdmin->selectEmpresaAliada();
                //$data['listaAliada'] = null;
                // Listado de procesos
                $data['listaProcesos'] = $this->OrdersModel->selectQuantityOrderByProcess();
                $data['listaIva'] = $this->FunctionsAdmin->selectValoresListaAdministracion('IVA', '1');
                //Cargo información de la solicitud de cotizaci&oacute;n para los archivos adjuntos
                $data['adjunto1'] = null;
                $data['adjunto2'] = null;
            }

            $data['vigencia'] = 1;
            $data['incluye'] = 1;
            $data['observacion'] = null;
            $data['conceptoCosAd'] = null;
            $data['tiempo'] = null;
            $data['descuento'] = null;
            $data['id'] = null;

            $data['costoAdc'] = 0;

            $data['disabledDelete'] = 'disabled="disabled"';
            // Lista de tipos de documento de identidad
            $data['listaTipoDocumento'] = $this->FunctionsAdmin->selectValoresListaAdministracion('TIPO_DOCPERSONA', '1');

            // Listado de vigencia cotizaci&oacute;n
            $data['listaVigencia'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_TIEMPO", 'DESC');



            // Listado de pago
            $data['listaPago'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_PAGO", 'DESC');

            // Listado de empresas
            $condicion = "and COT_TARIFAEMPRESA.ESTADO='" . ACTIVO_ESTADO . "'";
            $data['listaEmpresa'] = $this->StokePriceModel->selectListDefineRelationCompanyRates($condicion);

            // Listado de incluye
            $data['listaIncluye'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_INCLUYE", 'DESC');


            //Listado de ejecutivos
            $data['listaUsuarios'] = $this->FunctionsAdmin->selectUsersFromProfile(PROFILE_DEFAULT_STOKEPRICE);

            //Cantidad de registros
            $data['registros'] = 1;
            $data['listaDetalle'] = null;
            $data['display'] = null;

            // Cargo la vista del formulario para la creación del patrocinio
            $this->load->view('stokePrice/operation/newRegisterDefinition', $data);
            // Cargo validación de formulario
            $this->load->view('validation/stokePrice/process/formNewRegisterValidation');

            /**
             * Fin: Información relacionada con la plantilla principal Pinto la pantalla
             */

            // Pinto el final de la página (páginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function edit($id)
    {
        /**
         * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
         */

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID", $this->encryption->decrypt($id));

            // Pinto las vistas adicionales a través de la función showCommon del helper
            $data = null;
            //Obtengo consecutivo
            $data['consecutivo'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id);

            if ($id != '') {

                //Valido si la cotizaci&oacute;n tienen ordenes relacionadas y activas
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $id, "ESTADO", ACTIVO_ESTADO) == 0) {
                    // Pinto la cabecera principal de las páginas internas
                    showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

                    $data['evento'] = "edit";
                    $idSolicitud = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_SOLICITUD", "ID", $id);
                    $data['idSolicitud'] = $idSolicitud;
                    $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_USUARIO", "ID", $idSolicitud);

                    //Ejecutivo
                    $data['ejecutivo']  = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "VENDEDOR", "ID", $id);
                    //Datos del usuario
                    $data['tipo'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "TIPODOC", "ID", $idUsuario);
                    $data['documento'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "DOCUMENTO", "ID", $idUsuario);

                    $data['nombres'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "NOMBRES", "ID", $idUsuario));
                    $data['apellidos'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "APELLIDOS", "ID", $idUsuario));

                    $data['correo'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "CORREO", "ID", $idUsuario));
                    $data['telefono'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "TELEFONO", "ID", $idUsuario));

                    //Datos de la empresa
                    $data['empresaId'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_EMPRESA", "ID", $id);

                    $data['listaIva'] = $this->FunctionsAdmin->selectValoresListaAdministracion('IVA', '1');

                    //Datos de la cotizaci&oacute;n
                    $data['vigencia'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_PAGO", "ID", $id);
                    $data['incluye'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_INCLUYE", "ID", $id);
                    $data['observacion'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "OBSERVACION", "ID", $id));
                    $data['conceptoCosAd'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "CONCEPTO_ADICIONAL", "ID", $id);
                    $data['tiempo'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_TIEMPO", "ID", $id);
                    $data['descuento'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "DESCUENTO", "ID", $id);

                    //visible element aliada
                    $data['display'] = null;


                    $data['disabledDelete'] = '';
                    // Lista de tipos de documento de identidad
                    $data['listaTipoDocumento'] = $this->FunctionsAdmin->selectValoresListaAdministracion('TIPO_DOCPERSONA', '1');
                    // Listado de vigencia cotizaci&oacute;n
                    $data['listaVigencia'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_TIEMPO", 'DESC');

                    // Listado de pago
                    $data['listaPago'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_PAGO", 'DESC');

                    // Listado de empresas
                    $condicion = "and COT_TARIFAEMPRESA.ESTADO='" . ACTIVO_ESTADO . "'";
                    $data['listaEmpresa'] = $this->StokePriceModel->selectListDefineRelationCompanyRates($condicion);

                    // Listado de incluye
                    $data['listaIncluye'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_INCLUYE", 'DESC');

                    $data['listaAliada'] = $this->FunctionsAdmin->selectEmpresaAliada();

                    // Listado de procesos
                    $data['listaProcesos'] = $this->OrdersModel->selectQuantityOrderByProcess();

                    //Listado de ejecutivos
                    $data['listaUsuarios'] = $this->FunctionsAdmin->selectUsersFromProfile(PROFILE_DEFAULT_STOKEPRICE);

                    //Listo la cantidad de elementos de la cotizaci&oacute;n
                    $data['listaDetalle'] = $this->StokePriceModel->selectListStokePriceDetail($id);

                    //Costos adicionales
                    $data['costoAdc'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "COSTO_ADC", "ID", $id);

                    $data['registros'] = count($data['listaDetalle']);

                    //Cargo información de la solicitud de cotizaci&oacute;n para los archivos adjuntos
                    $data['adjunto1'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO1", "ID", $idSolicitud));
                    $data['adjunto2'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO2", "ID", $idSolicitud));

                    $data['id'] = $this->encryption->encrypt($id);
                    // Cargo la vista del formulario para la creación del patrocinio
                    $this->load->view('stokePrice/operation/newRegisterDefinition', $data);
                    // Cargo validación de formulario
                    $this->load->view('validation/stokePrice/process/formNewRegisterValidation');

                    // Pinto el final de la página (páginas internas)
                    showCommonEnds($this, null, null);
                } else {
                    $message = 'notEditCoti';
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $data['consecutivo']);
                    $this->session->set_userdata('auxiliar', $message);
                    // Redirecciono la página
                    $mainPage = "StokePriceAppStokePrice/board/";
                    redirect(base_url() . $mainPage);
                }
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }


    public function detailsDespiece($id, $idCotizacion)

    {

        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            if ($id != '') {
                $data = null;
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

                /**
                 * Información relacionada con la plantilla principal Pinto la pantalla *
                 */

                $data['listaDetalleElemento'] = $this->StokePriceModel->selectElementsDetailsFromStokePriceDetails($this->encryption->decrypt($id));

                $data['idCotizacion'] = $idCotizacion;

                // Cargo vista
                $this->load->view('stokePrice/operation/formTraceStokePriceDetails', $data);

                // Cargo validación de formulario
                $this->load->view('validation/stokePrice/process/traceRegisterValidation');
                /**
                 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                 */

                // Pinto el final de la página (páginas internas)
                showCommonEnds($this, null, null);
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }



    public function trace($id)
    {
        /**
         * Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado
         */

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $data = null;
                // Cargo la información de la cotizaci&oacute;n consecutivo
                $data['consecutivo'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id);

                //Valido si la cotizaci&oacute;n tienen ordenes relacionadas y activas
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $id, "ESTADO", ACTIVO_ESTADO) == 0) {

                    // Pinto la cabecera principal de las páginas internas
                    showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

                    /**
                     * Información relacionada con la plantilla principal Pinto la pantalla *
                     */

                    // Cargo la información de la cotizaci&oacute;n 
                    $data['estado'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ESTADO", $id);

                    $data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "FECHA", $id);
                    $data['costoAdicional'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "COSTO_ADC", $id);

                    $data['descripcionCostos'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONCEPTO_ADICIONAL", $id);
                    $empresa = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_EMPRESA", $id);
                    $empresaCoti = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);
                    $data['empresaCoti'] = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresaCoti);

                    $data['observacion'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "OBSERVACION", $id));

                    $pago = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_PAGO", $id);
                    $data['pago'] = $this->FunctionsGeneral->getFieldFromTable("COT_PAGO", "NOMBRE", $pago);
                    $vigencia = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_TIEMPO", $id);
                    $data['vigencia'] = $this->FunctionsGeneral->getFieldFromTable("COT_TIEMPO", "NOMBRE", $vigencia);
                    $incluye = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_INCLUYE", $id);
                    $data['incluye'] = $this->FunctionsGeneral->getFieldFromTable("COT_INCLUYE", "DESCRIPCION", $incluye);

                    $data['descuento'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "DESCUENTO", $id) / 100;
                    $data['vendedor'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "VENDEDOR", $id));

                    // Datos del usuario
                    $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIOCOTI", "ID_USUARIO", "ID_COTIZACION", $id);

                    $data['documento'] = $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "DOCUMENTO", $idUsuario);
                    $data['paciente'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "NOMBRES", $idUsuario)) . " " . $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "APELLIDOS", $idUsuario));
                    $data['tipoDocumento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TIPODOC", $idUsuario));
                    $data['correoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "CORREO", $idUsuario));
                    $data['telefonoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TELEFONO", $idUsuario));


                    $data['idDetalleCoti'] = $this->StokePriceModel->selectIdOfDetailsCot($id);



                    // Detalle de la cotizaci&oacute;n
                    $data['listaDetalle'] = $this->StokePriceModel->selectListStokePriceDetail($id);

                    if ($data['listaDetalle'] != null) {

                        $data['totalProducto'] = count($data['listaDetalle']);
                    }

                    // Informacion de la empresa
                    $listParameters = $this->SystemModel->getParameters(1);
                    foreach ($listParameters as $value) {
                        $data['direccion'] = $value->DIRECCION;
                        $data['telefono'] = $value->TELEFONO;
                        $data['correo'] = $value->CORREO;
                        $data['empresa'] = $value->NOMBRE;
                    }


                    // Cargo los datos del usaurio
                    $usuarioSession = $this->Users->getNombresUsuario($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "UCREA", $id));
                    $data['nombreUsuario'] = $usuarioSession->NOMBRES;
                    $data['apellidoUsuario'] = $usuarioSession->APELLIDOS;
                    $usuarioSession = $this->Users->getUsersProfile($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "UCREA", $id));
                    $data['especialidad'] = $usuarioSession->PERFIL;

                    // Pinto listado de tipificaciones
                    $data['listaSeguimiento'] = $this->StokePriceModel->selectListTraceList();
                    // Listo el histórico del seguimiento
                    $data['listadoHistoria'] = $this->StokePriceModel->selectListTraceListPriceStoke($id);

                    // Listo el histórico del seguimiento
                    $data['listadoBitacora'] = $this->StokePriceModel->selectListTraceHistoryStokePrice($id);

                    $idSolicitud = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_SOLICITUD", "ID", $id);

                    $costoAdicional = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "COSTO_ADC", "ID", $id);

                    $data['idCotizacion'] = $this->encryption->encrypt($id);

                    //Cargo información de la solicitud de cotizaci&oacute;n para los archivos adjuntos
                    $data['adjunto1'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO1", "ID", $idSolicitud));
                    $data['adjunto2'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO2", "ID", $idSolicitud));
                    $data['hide'] = null;

                    // Cargo vista aca
                    $this->load->view('stokePrice/operation/formTraceStokePrice', $data);

                    // Cargo validación de formulario
                    $this->load->view('validation/stokePrice/process/traceRegisterValidation');
                    /**
                     * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                     */

                    // Pinto el final de la página (páginas internas)
                    showCommonEnds($this, null, null);
                } else if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $id, "ESTADO", ACTIVO_ESTADO) != 0) {
                    // Pinto la cabecera principal de las páginas internas
                    showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

                    /**
                     * Información relacionada con la plantilla principal Pinto la pantalla *
                     */

                    // Cargo la información de la cotizaci&oacute;n 
                    $data['estado'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ESTADO", $id);

                    $data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "FECHA", $id);
                    $data['costoAdicional'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "COSTO_ADC", $id);
                    $data['descripcionCostos'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONCEPTO_ADICIONAL", $id);




                    $empresa = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_EMPRESA", $id);
                    $empresaCoti = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);
                    $data['empresaCoti'] = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresaCoti);

                    $data['observacion'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "OBSERVACION", $id));





                    $pago = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_PAGO", $id);
                    $data['pago'] = $this->FunctionsGeneral->getFieldFromTable("COT_PAGO", "NOMBRE", $pago);
                    $vigencia = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_TIEMPO", $id);
                    $data['vigencia'] = $this->FunctionsGeneral->getFieldFromTable("COT_TIEMPO", "NOMBRE", $vigencia);
                    $incluye = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_INCLUYE", $id);
                    $data['incluye'] = $this->FunctionsGeneral->getFieldFromTable("COT_INCLUYE", "DESCRIPCION", $incluye);

                    $data['descuento'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "DESCUENTO", $id) / 100;
                    $data['vendedor'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "VENDEDOR", $id));

                    // Datos del usuario
                    $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIOCOTI", "ID_USUARIO", "ID_COTIZACION", $id);

                    $data['documento'] = $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "DOCUMENTO", $idUsuario);
                    $data['paciente'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "NOMBRES", $idUsuario)) . " " . $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "APELLIDOS", $idUsuario));
                    $data['tipoDocumento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TIPODOC", $idUsuario));
                    $data['correoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "CORREO", $idUsuario));
                    $data['telefonoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TELEFONO", $idUsuario));
                    $data['idRouter'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DETALLECOTI", "ID", "ID_COTIZACION", $id);

                    // Detalle de la cotizaci&oacute;n
                    $data['listaDetalle'] = $this->StokePriceModel->selectListStokePriceDetail($id);
                    $data['totalProducto'] = count($data['listaDetalle']);
                    // Informacion de la empresa
                    $listParameters = $this->SystemModel->getParameters(1);
                    foreach ($listParameters as $value) {
                        $data['direccion'] = $value->DIRECCION;
                        $data['telefono'] = $value->TELEFONO;
                        $data['correo'] = $value->CORREO;
                        $data['empresa'] = $value->NOMBRE;
                    }
                    // Cargo los datos del usaurio
                    $usuarioSession = $this->Users->getNombresUsuario($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "UCREA", $id));
                    $data['nombreUsuario'] = $usuarioSession->NOMBRES;
                    $data['apellidoUsuario'] = $usuarioSession->APELLIDOS;
                    $usuarioSession = $this->Users->getUsersProfile($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "UCREA", $id));
                    $data['especialidad'] = $usuarioSession->PERFIL;

                    // Pinto listado de tipificaciones
                    $data['listaSeguimiento'] = $this->StokePriceModel->selectListTraceList();
                    // Listo el histórico del seguimiento
                    $data['listadoHistoria'] = $this->StokePriceModel->selectListTraceListPriceStoke($id);

                    // Listo el histórico del seguimiento
                    $data['listadoBitacora'] = $this->StokePriceModel->selectListTraceHistoryStokePrice($id);

                    $idSolicitud = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_SOLICITUD", "ID", $id);

                    $costoAdicional = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "COSTO_ADC", "ID", $id);

                    $data['idCotizacion'] = $this->encryption->encrypt($id);

                    //Cargo información de la solicitud de cotizaci&oacute;n para los archivos adjuntos
                    $data['adjunto1'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO1", "ID", $idSolicitud));
                    $data['adjunto2'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ADJUNTO2", "ID", $idSolicitud));
                    $data['hide'] = 'display: none';

                    // Cargo vista
                    $this->load->view('stokePrice/operation/formTraceStokePrice', $data);

                    // Cargo validación de formulario
                    $this->load->view('validation/stokePrice/process/traceRegisterValidation');
                    /**
                     * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                     */

                    // Pinto el final de la página (páginas internas)
                    showCommonEnds($this, null, null);
                } else {

                    $message = 'notTraceCoti';
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $data['consecutivo']);
                    $this->session->set_userdata('auxiliar', $message);
                    // Redirecciono la página
                    $mainPage = "StokePriceAppStokePrice/board/";
                    redirect(base_url() . $mainPage);
                }
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function inactive($id)
    {
        /**
         * Inactivo el registro para el cual se tiene asociado el valor $id
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {

            // Pinto las vistas adicionales a través de la función showCommon del helper
            $data = null;

            $id = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID", $this->encryption->decrypt($id));

            $data['consecutivo'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id);

            //Verifico si esta cotizaci&oacute;n no está relacionada con una orden que no se encuentre anulada
            if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $id, "ESTADO", ACTIVO_ESTADO) == 0) {


                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

                // Cargo la información de la cotizaci&oacute;n consecutivo

                $data['estado'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ESTADO", $id);
                $data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "FECHA", $id);
                $empresa = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_EMPRESA", $id);
                $empresaCoti = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);
                $data['empresaCoti'] = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresaCoti);

                // Datos del usuario
                $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIOCOTI", "ID_USUARIO", "ID_COTIZACION", $id);
                $data['documento'] = $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "DOCUMENTO", $idUsuario);
                $data['paciente'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "NOMBRES", $idUsuario)) . " " . $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "APELLIDOS", $idUsuario));
                $data['tipoDocumento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TIPODOC", $idUsuario));

                // Informacion de la empresa
                $listParameters = $this->SystemModel->getParameters(1);
                foreach ($listParameters as $value) {
                    $data['direccion'] = $value->DIRECCION;
                    $data['telefono'] = $value->TELEFONO;
                    $data['correo'] = $value->CORREO;
                    $data['empresa'] = $value->NOMBRE;
                }
                // Cargo los datos del usuario
                $usuarioSession = $this->Users->getNombresUsuario($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "UCREA", $id));
                $data['nombreUsuario'] = $usuarioSession->NOMBRES;
                $data['apellidoUsuario'] = $usuarioSession->APELLIDOS;
                $usuarioSession = $this->Users->getUsersProfile($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "UCREA", $id));
                $data['especialidad'] = $usuarioSession->PERFIL;
                // Lista de tipificaciones
                $data['listaTipificacion'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_ELIMINATITULO", 'DESC');

                $data['id'] = $this->encryption->encrypt($id);
                // Cargo vista
                $this->load->view('stokePrice/operation/inactiveRegisterDefinition', $data);
                // Cargo validación de formulario
                $this->load->view('validation/stokePrice/process/inactiveRegisterValidation');

                /**
                 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                 */

                // Pinto el final de la página (páginas internas)
                showCommonEnds($this, null, null);
            } else {

                $message = 'notDeleteCOti';
                // Pinto mensaje para retornar a la aplicación
                $this->session->set_userdata('id', $data['consecutivo']);
                $this->session->set_userdata('auxiliar', $message);
                // Redirecciono la página
                $mainPage = "StokePriceAppStokePrice/board/";
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }


    public function inactiveRequest($id)
    {
        /**
         * Inactivo el registro para el cual se tiene asociado el valor $id
         */

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {

            // Pinto las vistas adicionales a través de la función showCommon del helper
            $data = null;

            $id = $this->FunctionsGeneral->getFieldFromTable("COT_SOLICITUD", "ID", $this->encryption->decrypt($id));


            //Verifico si esta cotizaci&oacute;n no está relacionada con una orden que no se encuentre anulada
            if ($id != '') {


                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

                // Cargo la información de la cotizaci&oacute;n consecutivo
                /*
                $data['estado'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ESTADO", $id);
                $data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "FECHA", $id);
                */
                // Datos del usuario
                $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_USUARIO", "ID", $id);

                $empresa = $this->FunctionsGeneral->getFieldFromTable("COT_SOLICITUD", "ID_EMPRESA", $id);
                $empresaCoti = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);
                $data['empresaCoti'] = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresaCoti);


                $data['documento'] = $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "DOCUMENTO", $idUsuario);
                $data['paciente'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "NOMBRES", $idUsuario)) . " " . $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "APELLIDOS", $idUsuario));
                $data['tipoDocumento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TIPODOC", $idUsuario));

                // Informacion de la empresa
                $listParameters = $this->SystemModel->getParameters(1);
                foreach ($listParameters as $value) {
                    $data['direccion'] = $value->DIRECCION;
                    $data['telefono'] = $value->TELEFONO;
                    $data['correo'] = $value->CORREO;
                    $data['empresa'] = $value->NOMBRE;
                }

                $data['id'] = $this->encryption->encrypt($id);
                // Cargo vista
                $this->load->view('stokePrice/operation/inactiveRequestDefinition', $data);
                // Cargo validación de formulario
                $this->load->view('validation/stokePrice/process/inactiveRequestValidation');

                /**
                 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                 */

                // Pinto el final de la página (páginas internas)
                showCommonEnds($this, null, null);
            } else {

                $message = 'notDeleteCOti';
                // Pinto mensaje para retornar a la aplicación
                $this->session->set_userdata('id', $data['consecutivo']);
                $this->session->set_userdata('auxiliar', $message);
                // Redirecciono la página
                $mainPage = "StokePriceAppStokePrice/board/";
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function defineElementsListOfProducts($id)
    {
        /**  Listado de productos que requieren configuración de despiece para la cotizaci&oacute;n $id*/

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID", $this->encryption->decrypt($id));

            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $data = null;
                // Cargo la información de la cotizaci&oacute;n consecutivo
                $data['consecutivo'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id);

                //Valido si la cotizaci&oacute;n tienen ordenes relacionadas y activas
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $id, "ESTADO", ACTIVO_ESTADO) == 0) {

                    // Pinto la cabecera principal de las páginas internas
                    showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);


                    /**
                     * Información relacionada con la plantilla principal Pinto la pantalla *
                     */
                    // Pinto los permisos del tablero de control
                    $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
                    $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'boardElementList', $idModule, VIEW_LIST_PERMISSION);
                    // Cargo la información de la cotizaci&oacute;n 
                    $data['estado'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ESTADO", $id);
                    $data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "FECHA", $id);
                    $empresa = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_EMPRESA", $id);
                    $empresaCoti = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);
                    $data['empresaCoti'] = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresaCoti);
                    $data['descuento'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "DESCUENTO", $id) / 100;
                    $data['costosAdicionales'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "COSTO_ADC", $id);

                    // Datos del usuario
                    $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIOCOTI", "ID_USUARIO", "ID_COTIZACION", $id);
                    $data['documento'] = $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "DOCUMENTO", $idUsuario);
                    $data['paciente'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "NOMBRES", $idUsuario)) . " " . $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "APELLIDOS", $idUsuario));
                    $data['tipoDocumento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TIPODOC", $idUsuario));
                    $data['correoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "CORREO", $idUsuario));
                    $data['telefonoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TELEFONO", $idUsuario));

                    // Detalle de la cotizaci&oacute;n
                    $data['listaDetalle'] = $this->StokePriceModel->selectListStokePriceDetail($id);
                    //Total de Productos
                    $data['totalProductos'] = count($data['listaDetalle']);
                    $data['id'] = $this->encryption->encrypt($id);



                    // Cargo vista
                    $this->load->view('stokePrice/operation/boardStokePriceElementList', $data);
                    // Cargo validación de formulario
                    $this->load->view('validation/stokePrice/process/traceRegisterValidation');
                    /**
                     * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                     */

                    // Pinto el final de la página (páginas internas)
                    showCommonEnds($this, null, null);
                } else {
                    $message = 'notTraceCoti';
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $data['consecutivo']);
                    $this->session->set_userdata('auxiliar', $message);
                    // Redirecciono la página
                    $mainPage = "StokePriceAppStokePrice/board/";
                    redirect(base_url() . $mainPage);
                }
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function editUser()
    {
        $mainPage = "StokePriceAppStokePrice/editUser";
        // Valido si la sessión existe en caso contrario saco al usuario
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "StokePriceAppStokePrice/editUser";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la información de los parametros de la aplicación

            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */

            $data['disabledDelete'] = 'disabled="disabled"';
            // Lista de tipos de documento de identidad
            $data['listaTipoDocumento'] = $this->FunctionsAdmin->selectValoresListaAdministracion('TIPO_DOCPERSONA', '1');

            // Listado de vigencia cotizaci&oacute;n
            $data['listaVigencia'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_TIEMPO", 'DESC');
            $data['vigencia'] = 1;

            // Listado de pago
            $data['listaPago'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_PAGO", 'DESC');

            // Listado de empresas
            $condicion = "and COT_TARIFAEMPRESA.ESTADO='" . ACTIVO_ESTADO . "'";
            $data['listaEmpresa'] = $this->StokePriceModel->selectListDefineRelationCompanyRates($condicion);
            // Listado de empresas aliadas
            $data['listaAliada'] = $this->FunctionsAdmin->selectEmpresaAliada();
            // Listado de procesos
            $data['listaProcesos'] = $this->OrdersModel->selectQuantityOrderByProcess();
            // Cargo la lista de departamentos
            $data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
            // Cargo la lista de ciudades
            $data['listaCiudad'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_MUNICIPIO");
            $data['listaCiudad'] = null;
            // Listado de incluye
            $data['listaIncluye'] = $this->FunctionsGeneral->selectValoresListaTabla("COT_INCLUYE", 'DESC');
            $data['incluye'] = 1;
            //Listado de ejecutivos
            $data['listaUsuarios'] = $this->FunctionsAdmin->selectUsersFromProfile(PROFILE_DEFAULT_STOKEPRICE_REQUEST);

            $documento = $this->security->xss_clean($this->input->post('documento'));
            if (!empty($documento)) {
                $data['document'] = $this->FunctionsGeneral->getDocumentUser('COT_USUARIO', 'DOCUMENTO', $documento);
            }


            // Cargo la vista del formulario para la actualizacion
            $this->load->view('stokePrice/operation/moduleUpdate', $data);
            // Cargo validación de formulario
            $this->load->view('validation/stokePrice/process/formNewRequestValidation');

            /**
             * Fin: Información relacionada con la plantilla principal Pinto la pantalla
             */

            // Pinto el final de la página (páginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }


    public function viewRegister($id)
    {
        /**
         * Genera la impresión de la cotizaci&oacute;n
         */


        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        echo "<script>console.log('id: " . $this->encryption->decrypt($id) . "' );</script>";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $data = null;
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);

                /**
                 * Información relacionada con la plantilla principal Pinto la pantalla *
                 */

                // Cargo la información de la cotizaci&oacute;n consecutivo
                $data['consecutivo'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id);
                $data['solicitud'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_SOLICITUD", $id);
                $data['estado'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ESTADO", $id);
                $data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "FECHA", $id);
                $empresa = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_EMPRESA", $id);
                $data['empresaCoti'] = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);
                $data['empresaId'] = $empresa;
                $data['observacion'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "OBSERVACION", $id));
                $data['conceptoCosAd'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "CONCEPTO_ADICIONAL", "ID", $id);
                $pago = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_PAGO", $id);
                $data['pago'] = $this->FunctionsGeneral->getFieldFromTable("COT_PAGO", "NOMBRE", $pago);
                $vigencia = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_TIEMPO", $id);
                $data['vigencia'] = $this->FunctionsGeneral->getFieldFromTable("COT_TIEMPO", "NOMBRE", $vigencia);
                $incluye = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_INCLUYE", $id);
                $data['incluye'] = $this->FunctionsGeneral->getFieldFromTable("COT_INCLUYE", "DESCRIPCION", $incluye);

                $data['descuento'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "DESCUENTO", $id) / 100;

                $vendedor = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "VENDEDOR", $id);
                $vendedor = $this->Users->getNombresUsuario($vendedor);
                if ($vendedor != null) {
                    $data['vendedor'] = $vendedor->NOMBRES . " " . $vendedor->APELLIDOS;
                } else {
                    $data['vendedor'] = null;
                }
                $data['trm'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_TRM", "VALOR", "ID_COTIZACION", $id);

                // Datos del usuario
                $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIOCOTI", "ID_USUARIO", "ID_COTIZACION", $id);
                $data['documento'] = $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "DOCUMENTO", $idUsuario);
                $data['paciente'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "NOMBRES", $idUsuario)) . " " . $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "APELLIDOS", $idUsuario));
                $data['tipoDocumento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TIPODOC", $idUsuario));
                $data['correoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "CORREO", $idUsuario));
                $data['telefonoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TELEFONO", $idUsuario));

                // Detalle de la cotizaci&oacute;n
                $data['listaDetalle'] = $this->StokePriceModel->selectListStokePriceDetail($id);
                $data['costosAdicionales'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "COSTO_ADC", $id);
                //Total de Productos
                $data['totalProductos'] = count($data['listaDetalle']);

                // Informacion de la empresa
                $listParameters = $this->SystemModel->getParameters(1);
                foreach ($listParameters as $value) {
                    $data['direccion'] = $value->DIRECCION;
                    $data['telefono'] = $value->TELEFONO;
                    $data['correo'] = $value->CORREO;
                    $data['empresa'] = $value->NOMBRE;
                    $data['codigoCalidad'] = $value->COD_COTI;
                }
                // Cargo los datos del usaurio
                $usuarioSession = $this->Users->getNombresUsuario($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "UCREA", $id));
                $data['nombreUsuario'] = $usuarioSession->NOMBRES;
                $data['apellidoUsuario'] = $usuarioSession->APELLIDOS;
                $usuarioSession = $this->Users->getUsersProfile($this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "UCREA", $id));
                $data['especialidad'] = $usuarioSession->PERFIL;
                $data['id'] = $this->encryption->encrypt($id);



                // Cargo vista
                $this->load->view('stokePrice/operation/printStokePriceInformation', $data);
                /**
                 * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                 */

                // Pinto el final de la página (páginas internas)
                showCommonEnds($this, null, null);
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }






    public function elementListConfigure($id, $codigo)
    {
        /**  Listado de elementos que componen el despiece del código $codigo para la cotizacion con identificador $id*/

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {

            $id = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID", $this->encryption->decrypt($id));
            $codigo = $this->encryption->decrypt($codigo);

            /*echo "Codigo ".$codigo."<BR>";
            echo "Cotizacion ".$id."<BR>";*/
            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $data = null;
                // Cargo la información de la cotizaci&oacute;n consecutivo
                $data['consecutivo'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id);

                //Valido si la cotizaci&oacute;n tienen ordenes relacionadas y activas
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $id, "ESTADO", ACTIVO_ESTADO) == 0) {

                    // Pinto la cabecera principal de las páginas internas
                    showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);

                    /**
                     * Información relacionada con la plantilla principal Pinto la pantalla *
                     */
                    // Pinto los permisos del tablero de control
                    $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);

                    $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'boardElementListDetails', $idModule, VIEW_LIST_PERMISSION);

                    $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'boardElementListDetails', $idModule, VIEW_BUTTON_PERMISSION);
                    // Cargo la información de la cotizaci&oacute;n 
                    $data['estado'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ESTADO", $id);
                    $data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "FECHA", $id);
                    $empresa = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_EMPRESA", $id);
                    $empresaCoti = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);
                    $data['empresaCoti'] = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresaCoti);
                    $data['descuento'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "DESCUENTO", $id) / 100;

                    // Datos del usuario
                    $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIOCOTI", "ID_USUARIO", "ID_COTIZACION", $id);
                    $data['documento'] = $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "DOCUMENTO", $idUsuario);
                    $data['paciente'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "NOMBRES", $idUsuario)) . " " . $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "APELLIDOS", $idUsuario));
                    $data['tipoDocumento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TIPODOC", $idUsuario));
                    $data['correoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "CORREO", $idUsuario));
                    $data['telefonoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TELEFONO", $idUsuario));

                    // Detalle de la cotizaci&oacute;n
                    //Obtengo el id relacionado al elemento cotizado dentro de la relación de cotizaciones

                    $data['listaDetalle'] = $this->StokePriceModel->selectElementsDetailsFromStokePriceDetails(
                        $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DETALLECOTI", "ID", "ID_COTIZACION", $id, "ID_DESCRIPCION", $codigo)
                    );

                    $data['id'] = $this->encryption->encrypt($id);
                    $data['codigo'] = $this->encryption->encrypt($codigo);

                    // Lista de grupos
                    $data['listaGrupo'] = $this->FunctionsGeneral->selectValoresListaTablaOrder("ORD_GRUELEM",  "NOMBRE", "ASC", ACTIVO_ESTADO);


                    // Cargo vista
                    $this->load->view('stokePrice/operation/boardStokePriceElementListDetails', $data);
                    // Cargo validación de formulario
                    $this->load->view('validation/stokePrice/process/traceRegisterValidation');
                    /**
                     * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                     */

                    // Pinto el final de la página (páginas internas)
                    showCommonEnds($this, null, null);
                } else {
                    $message = 'notTraceCoti';
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $data['consecutivo']);
                    $this->session->set_userdata('auxiliar', $message);
                    // Redirecciono la página
                    $mainPage = "StokePriceAppStokePrice/board/";
                    redirect(base_url() . $mainPage);
                }
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function modifyElementOfList($id = null, $codigo = null, $idElemento = null)
    {
        /** Rutina para pintar la información del formulario para la definición de elementos nuevos*/

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función showCommon del helper
            $data = null;


            //Valido si la información llego por el Get o por Post
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID", $this->encryption->decrypt($id));
            if ($id == '') {
                $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
                $grupo = $this->security->xss_clean($this->input->post('grupo'));
                $data['validador'] = 'add';
                $data['nombreElemento'] = '';
                $data['nombreGrupo'] = $this->FunctionsGeneral->getFieldFromTable("ORD_GRUELEM", "NOMBRE", $grupo);;
            } else {
                $grupo = '';
                $data['validador'] = 'edit';
                $data['nombreGrupo'] = '';
            }



            $codigo = $this->encryption->decrypt($codigo);
            if ($codigo == '') {
                $codigo = $this->encryption->decrypt($this->security->xss_clean($this->input->post('codigo')));
            }

            $idDespiece = $this->encryption->decrypt($idElemento);
            if ($idDespiece == '') {
                $idDespiece =  $this->encryption->decrypt($this->security->xss_clean($this->input->post('idElemento')));
            }
            //echo $idDespiece."<br> aaaa";

            if ($id != '') {

                // Cargo la información de la cotizaci&oacute;n consecutivo
                $data['consecutivo'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id);

                //Valido si la cotizaci&oacute;n tienen ordenes relacionadas y activas
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $id, "ESTADO", ACTIVO_ESTADO) == 0) {

                    // Pinto la cabecera principal de las páginas internas
                    showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);


                    // Cargo la información de la cotizaci&oacute;n 
                    $data['estado'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ESTADO", $id);
                    $data['fecha'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "FECHA", $id);
                    $empresa = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_EMPRESA", $id);
                    $empresaCoti = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);
                    $data['empresaCoti'] = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresaCoti);
                    $data['descuento'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "DESCUENTO", $id) / 100;

                    // Datos del usuario
                    $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIOCOTI", "ID_USUARIO", "ID_COTIZACION", $id);
                    $data['documento'] = $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "DOCUMENTO", $idUsuario);
                    $data['paciente'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "NOMBRES", $idUsuario)) . " " . $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "APELLIDOS", $idUsuario));
                    $data['tipoDocumento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA", "VALOR", $this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TIPODOC", $idUsuario));
                    $data['correoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "CORREO", $idUsuario));
                    $data['telefonoUsu'] = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTable("COT_USUARIO", "TELEFONO", $idUsuario));

                    // Detalle de la cotizaci&oacute;n
                    $data['listaDetalle'] = $this->StokePriceModel->selectElementsDetailsFromStokePriceDetails($codigo);

                    //Cifro información del formulario
                    $data['id'] = $this->encryption->encrypt($id);
                    $data['codigo'] = $this->encryption->encrypt($codigo);
                    $data['idDespiece'] = $this->encryption->encrypt($idDespiece);

                    //$idDespiece = $this->encryption->decrypt($idDespiece);
                    // Obtengo el elemento
                    if ($idDespiece != 'NA') {
                        $comodin = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESPIECE", "ID_ELEMENTO", "ID", $idDespiece);
                        $data['nombreElemento'] = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "NOMBRE", "ID", $comodin);
                        $data['cantidad'] = $this->FunctionsGeneral->getFieldFromTableNotId("COT_DESPIECE", "CANTIDAD", "ID", $idDespiece);
                        // Obtengo el grupo del elemento
                        if ($grupo == '') {
                            $grupo = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "ID_GRUELEM", "ID", $comodin);
                        }
                    } else {
                        $data['cantidad'] = 1;
                    }



                    $data['listaProveedores'] = $this->OrdersModel->selectListProvidersElementsFromGroups($grupo);

                    // Pinto las caractertisticas

                    // Pinto informacion de las caracteristicas
                    $data['caracteristicas'] = $this->OrdersModel->selectListCharacteristicsElementGroup($grupo);

                    // Pinto plantilla para configurar elemento
                    $data['idDespiece'] = $this->encryption->encrypt($idDespiece);
                    $data['grupo'] = $grupo;

                    // Cargo vista
                    $this->load->view('stokePrice/operation/formDefineStokePriceElementListDetails', $data);

                    // Cargo validación de formulario
                    $this->load->view('validation/orders/process/OrdersAppOrderElementsValidation', $data);

                    /**
                     * Fin: Información relacionada con la plantilla principal Pinto la pantalla
                     */

                    // Pinto el final de la página (páginas internas)
                    showCommonEnds($this, null, null);
                } else {
                    $message = 'notTraceCoti';
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $data['consecutivo']);
                    $this->session->set_userdata('auxiliar', $message);
                    // Redirecciono la página
                    $mainPage = "StokePriceAppStokePrice/board/";
                    redirect(base_url() . $mainPage);
                }
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }





    /**
     * ***********************************************************************************************************
     * RUTINAS PARA GUARDAR INFORMACIÒN
     * ****************************************************************************************************** *
     */
    public function saveRegister()
    {
        /**
         * Rutina para guardar los cotizaciones dentro del sistema.
         */

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $tipoDoc = $this->security->xss_clean($this->input->post('tipoDoc'));
            $documento = $this->security->xss_clean($this->input->post('documento'));
            $nombres = $this->encryption->encrypt($this->security->xss_clean($this->input->post('nombres')));
            $apellidos = $this->encryption->encrypt($this->security->xss_clean($this->input->post('apellidos')));
            $correo = $this->encryption->encrypt($this->security->xss_clean($this->input->post('correo')));
            $telefono = $this->encryption->encrypt($this->security->xss_clean($this->input->post('telefono')));
            $empresa = $this->security->xss_clean($this->input->post('empresa'));
            $proceso = $this->security->xss_clean($this->input->post('proceso'));
            $convenio = $this->security->xss_clean($this->input->post('convenio'));
            //$departamento = $this->security->xss_clean($this->input->post('departamento'));
            //$municipio = $this->security->xss_clean($this->input->post('ciudad')); 
            $pago = $this->security->xss_clean($this->input->post('pago'));
            $vigencia = $this->security->xss_clean($this->input->post('vigencia'));
            $observacion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion')));
            $registros = $this->security->xss_clean($this->input->post('registros'));
            $incluye = $this->security->xss_clean($this->input->post('incluye'));
            $descuento = $this->security->xss_clean($this->input->post('descuento'));
            $idSolicitud = $this->security->xss_clean($this->input->post('idSolicitud'));
            $vendedor = $this->security->xss_clean($this->input->post('ejecutivo'));
            $margenProductos = $this->security->xss_clean($this->input->post('margenProductos'));
            $margenElementos = $this->security->xss_clean($this->input->post('margenElementos'));
            $margenServicios = $this->security->xss_clean($this->input->post('margenServicios'));
            $costoAdc = $this->security->xss_clean($this->input->post('costoAdc'));
            $formula = intval($costoAdc);
            $fechaCotizacion = $this->security->xss_clean($this->input->post('fechaCotizacion'));
            //$dateCurrent = date("Y/m/d H:i");
            $dateCurrent = cambiaHoraServer();
            $conceptoAdicional = $this->security->xss_clean($this->input->post('conceptoAdicional'));
            //$valueIvaCotizacion = $this->security->xss_clean($this->input->post('valueIva' . $i));
            if ($fechaCotizacion == $dateCurrent) {
                $fechaCotizacionFormateada = date("Y/m/d H:i", strtotime($fechaCotizacion));
            } else {
                $fechaCotizacionFormateada = $dateCurrent;
            }


            if ($convenio == '') {
                $convenio = null;
            } else {
                $convenio = $convenio;
            }

            //Valores por defecto
            $idTipo = 42;

            $medico = null;
            $especialidad = null;
            $fecha = cambiaHoraServer(2);

            //Tipo de acción
            $evento = $this->encryption->decrypt($this->security->xss_clean($this->input->post('evento')));
            //ECHO $evento;
            //ID cotizaci&oacute;n
            $idCotizacion = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));

            //Valido vendedor
            if ($vendedor == '') {
                $vendedor = null;
            }

            if ($evento == 'new') {

                // Valido si los datos del usuario ya se encuentran creados dentro de la gestión de cotizaciones
                $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_USUARIO", "ID", "TIPODOC", $tipoDoc, "DOCUMENTO", $documento);
                if ($idUsuario == '') {
                    // Se debe insertar
                    $idUsuario = $this->StokePriceModel->insertUserInformation($tipoDoc, $documento, $nombres, $apellidos, $telefono, $correo, NULL, NULL, NULL, $this->session->userdata('usuario'));
                } else {
                    // Se actualiza valor
                    $this->FunctionsGeneral->updateByID("COT_USUARIO", "TIPODOC", $tipoDoc, $idUsuario, $this->session->userdata('usuario'));
                    $this->FunctionsGeneral->updateByID("COT_USUARIO", "NOMBRES", $nombres, $idUsuario, $this->session->userdata('usuario'));
                    $this->FunctionsGeneral->updateByID("COT_USUARIO", "APELLIDOS", $apellidos, $idUsuario, $this->session->userdata('usuario'));
                    $this->FunctionsGeneral->updateByID("COT_USUARIO", "CORREO", $correo, $idUsuario, $this->session->userdata('usuario'));
                    $this->FunctionsGeneral->updateByID("COT_USUARIO", "DOCUMENTO", $documento, $idUsuario, $this->session->userdata('usuario'));
                    $this->FunctionsGeneral->updateByID("COT_USUARIO", "TELEFONO", $telefono, $idUsuario, $this->session->userdata('usuario'));
                }
                if ($idSolicitud == null) {
                    // Creo solicitud
                    $idSolicitud = $this->StokePriceModel->insertRequestInformation($empresa, $proceso, $convenio, null, $this->session->userdata('usuario'), $idUsuario, NULL, NULL, $this->session->userdata('usuario'), $fechaCotizacionFormateada, $municipio, $departamento);
                } else {
                    // Actualizo solicitud
                    $this->FunctionsGeneral->updateByID("COT_SOLICITUD", "ID_USUARIO", $idUsuario, $idSolicitud, $this->session->userdata('usuario'));
                }
                // Creo encabezado de la cotizaci&oacute;n
                $idCoti = $this->FunctionsGeneral->countMax('COT_CONSECUTIVO', 'ID', 1);

                $idCotizacion = $this->StokePriceModel->insertStokePriceHead($idSolicitud, $idCoti, $fecha, $idTipo, $empresa, $formula, $observacion, $medico, $especialidad, $pago, $vigencia, $incluye, $descuento, $vendedor, $this->session->userdata('usuario'), $conceptoAdicional, $proceso, $convenio);

                //Guardo histórico de bitacora
                $observacionBitacora = "Se crea una nueva cotizaci&oacute;n dentro del sistema de informaci&oacute;n";
                $this->StokePriceModel->insertStokePriceLog($idCotizacion, $observacionBitacora, $this->session->userdata('usuario'));

                //Guardo historico de la cotizaci&oacute;n
                $idHistoricoCotizacion = $this->StokePriceModel->insertStokePriceHeadHistory(
                    $idCotizacion,
                    $fecha,
                    $descuento,
                    $idTipo,
                    $pago,
                    $vigencia,
                    $empresa,
                    $incluye,
                    $formula,
                    $observacion,
                    $medico,
                    $especialidad,
                    $vendedor,
                    $this->session->userdata('usuario')
                );

                // Relaciono cotizaci&oacute;n con usuario
                $this->StokePriceModel->insertStokePriceUser($idCotizacion, $idUsuario, $this->session->userdata('usuario'));
                //Guardo historico de relación de usuario y cotizaci&oacute;n
                $this->StokePriceModel->insertStokePriceUserHistory($idHistoricoCotizacion, $idUsuario, $this->session->userdata('usuario'));

                // Relaciono cotizaci&oacute;n con productos servicios o elementos
                for ($i = 1; $i <= $registros; $i++) {
                    $codigo = $this->security->xss_clean($this->input->post('codigo' . $i));
                    $cantidad = $this->security->xss_clean($this->input->post('cantidad' . $i));
                    $valueIvaCotizacion = $this->security->xss_clean($this->input->post('valueIva' . $i));
                    $unitario = $this->security->xss_clean($this->input->post('unitario' . $i));
                    $total = $this->security->xss_clean($this->input->post('total' . $i));
                    $codigo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID", "CODIGO", $codigo);

                    //Debo obtener la información relacionada al costo del producto
                    $materiales = $this->security->xss_clean($this->input->post('materiales' . $i));
                    $manoobra = $this->security->xss_clean($this->input->post('manoobra' . $i));
                    $asociados = $this->security->xss_clean($this->input->post('adicionales' . $i));

                    //obtengo el margen relacionado al producto
                    //$margen=defineProfitStokePriceProduct($this,$codigo,$empresa,$margenProductos,$margenElementos,$margenServicios);
                    $margen = $this->security->xss_clean($this->input->post('margen' . $i));
                    // echo $codigo." ".$cantidad." ".$unitario." ".$total."<br> ";

                    // Recorro elementos e inserto
                    $arreglo = CTE_VALOR_NO;
                    $observacion = null;
                    $idDetalleCoti = $this->StokePriceModel->insertStokePriceDetail($idCotizacion, $codigo, $arreglo, $cantidad, $unitario, $materiales, $manoobra, $asociados, $observacion, $margen, $this->session->userdata('usuario'), $valueIvaCotizacion);

                    //Guardo historicos
                    $this->StokePriceModel->insertStokePriceDetailHistory($idHistoricoCotizacion, $codigo, $cantidad, $unitario, $materiales, $manoobra, $asociados,   $margen, $this->session->userdata('usuario'));

                    //valido condición de despiece de elementos
                    $this->elementsOfProductsStokePrice($idDetalleCoti, $codigo, $cantidad, $this->session->userdata('usuario'));
                }

                // Actualizo consecutivo
                // $idCoti ++;
                $this->FunctionsGeneral->updateByField('COT_CONSECUTIVO', "ID", $idCoti, "ESTADO", ACTIVO_ESTADO, $this->session->userdata('usuario'));
                //Genero mensaje que se ha creado la cotizaci&oacute;n
                $message = 'stokePriceDone';
            } else {



                //Obtengo información de la cotizaci&oacute;n
                $idCoti = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "CONSECUTIVO", "ID", $idCotizacion);
                $empresa = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_EMPRESA", "ID", $idCotizacion);
                $descuentoAnterior = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "DESCUENTO", "ID", $idCotizacion);
                $vigenciaAnterior = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_TIEMPO", "ID", $idCotizacion);
                $pagoAnterior = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_PAGO", "ID", $idCotizacion);
                $incluyeAnterior = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "ID_INCLUYE", "ID", $idCotizacion);
                $observacionTempo = $this->security->xss_clean($this->input->post('observacion'));
                $observacionAnterior = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "OBSERVACION", "ID", $idCotizacion));
                $vendedorAnterior = $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "VENDEDOR", "ID", $idCotizacion);
                $bandera = false;
                $justificacion = $this->security->xss_clean($this->input->post('justificacion'));

                //Actualizo valores 
                $actualizo = "";

                /* echo "descuento ".$descuentoAnterior." ".$descuento."<br>";
                echo "vigencia ".$vigenciaAnterior." ".$vigencia."<br>";
                echo "pago ".$pagoAnterior." ".$pago."<br>";
                echo "incluye ".$incluyeAnterior." ".$incluye."<br>";
                echo "observacion ".$observacionAnterior." ".$observacionTempo."<br>";
                echo "vendedor ".$vendedorAnterior." ".$vendedor."<br>"; */

                if ($descuentoAnterior != $descuento) {
                    $this->FunctionsGeneral->updateByID("COT_COTIZACION", "DESCUENTO", $descuento, $idCotizacion, $this->session->userdata('usuario'));
                    $bandera = true;
                    $actualizo .= "* Se realiz&oacute; cambio del descuento asociado a los productos de la cotizaci&oacute;n.<br>";
                }

                if ($vigenciaAnterior != $vigencia) {
                    $this->FunctionsGeneral->updateByID("COT_COTIZACION", "ID_TIEMPO", $vigencia, $idCotizacion, $this->session->userdata('usuario'));
                    $bandera = true;
                    //echo "dos<br>";
                    $actualizo .= "* Se realiz&oacute; cambio de la vigencia asociada a la cotizaci&oacute;n.<br>";
                }

                if ($pagoAnterior != $pago) {
                    $this->FunctionsGeneral->updateByID("COT_COTIZACION", "ID_PAGO", $pago, $idCotizacion, $this->session->userdata('usuario'));
                    $bandera = true;
                    //echo "tres<br>";
                    $actualizo .= "*Se realiz&oacute; cambio del pago asociado a la cotizaci&oacute;n.<br>";
                }

                if ($incluyeAnterior != $incluye) {
                    $this->FunctionsGeneral->updateByID("COT_COTIZACION", "ID_INCLUYE", $incluye, $idCotizacion, $this->session->userdata('usuario'));
                    $bandera = true;
                    //echo "cuatro<br>";
                    $actualizo .= "* Se realiz&oacute; cambio de las caracter&iacute;sticas que incluye a la cotizaci&oacute;n.<br>";
                }

                if ($observacionAnterior != $observacionTempo) {
                    $this->FunctionsGeneral->updateByID("COT_COTIZACION", "OBSERVACION", $observacion, $idCotizacion, $this->session->userdata('usuario'));
                    $bandera = true;
                    //echo $observacionAnterior."<br>" . $observacionTempo."<br>";
                    $actualizo .= "* Se realiz&oacute; cambio de la observaci&oacute;n asociada a la cotizaci&oacute;n.<br>";
                    //echo "cinco<br>";
                }

                if ($vendedorAnterior != $vendedor) {
                    $this->FunctionsGeneral->updateByID("COT_COTIZACION", "VENDEDOR", $vendedor, $idCotizacion, $this->session->userdata('usuario'));
                    $bandera = true;
                    $actualizo .= "* Se realiz&oacute; cambio del ejecutivo de cuenta asociado a la cotizaci&oacute;n.<br>";
                    //echo "seis<br>";
                }



                // si se actualizó un valor en particular se crea el registro
                if ($bandera) {
                    //Guardo historico de la cotizaci&oacute;n
                    $idHistoricoCotizacion = $this->StokePriceModel->insertStokePriceHeadHistory(
                        $idCotizacion,
                        $fecha,
                        $descuento,
                        $idTipo,
                        $pago,
                        $vigencia,
                        $empresa,
                        $incluye,
                        $formula,
                        $observacion,
                        $medico,
                        $especialidad,
                        $vendedor,
                        $this->session->userdata('usuario')
                    );
                    $justificacion .= "<br> Cambios realizados a nivel del encabezado de la cotizaci&oacute;n<br>" . $actualizo;
                } else {
                    //Obtengo último histórico
                    $idHistoricoCotizacion = null;
                    $condicion = "ID_COTIZACION='$idCotizacion'";
                    $idHistoricoCotizacionConsult = $this->FunctionsGeneral->selectMaxCondicion("COT_HISTCOTIZACION", "ID", $condicion);
                    foreach ($idHistoricoCotizacionConsult as $value) {
                        $idHistoricoCotizacion = $value->MAXIMO;
                    }
                }

                //Guardo histórico de bitacora

                $this->StokePriceModel->insertStokePriceLog($idCotizacion, $justificacion, $this->session->userdata('usuario'));


                $banderaDos = false;
                //Inactivo los valores repesctivos de la cotizaci&oacute;n
                $this->FunctionsGeneral->updateByField("COT_DETALLECOTI", "ESTADO", INACTIVO_ESTADO, "ID_COTIZACION", $idCotizacion, $this->session->userdata('usuario'));

                // Relaciono cotizaci&oacute;n con productos servicios o elementos
                for ($i = 1; $i <= $registros; $i++) {
                    $codigo = $this->security->xss_clean($this->input->post('codigo' . $i));
                    $cantidad = $this->security->xss_clean($this->input->post('cantidad' . $i));
                    $unitario = $this->security->xss_clean($this->input->post('unitario' . $i));
                    $total = $this->security->xss_clean($this->input->post('total' . $i));
                    $codigo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID", "CODIGO", $codigo);

                    // echo $codigo." ".$cantidad." ".$unitario." ".$total."<br> ";
                    // Recorro elementos e inserto
                    $arreglo = CTE_VALOR_NO;
                    $observacion = null;
                    //Verifico si el registro ya existe dentro de la BD
                    $cantidadBD = $this->FunctionsGeneral->getQuantityFieldFromTable("COT_DETALLECOTI", "ID_DESCRIPCION", $codigo, "ID_COTIZACION", $idCotizacion, "CANTIDAD", $cantidad);

                    //obtengo el margen relacionado al producto
                    $margen = $this->security->xss_clean($this->input->post('margen' . $i));
                    //Debo obtener la información relacionada al costo del producto
                    $materiales = $this->security->xss_clean($this->input->post('materiales' . $i));
                    $manoobra = $this->security->xss_clean($this->input->post('manoobra' . $i));
                    $asociados = $this->security->xss_clean($this->input->post('adicionales' . $i));
                    $valueIvaCotizacion = $this->security->xss_clean($this->input->post('valueIva' . $i));

                    if ($cantidadBD == 0) {

                        //Debo obtener la información relacionada al costo del producto
                        /*$materiales= $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "MATERIALES", "ID", $codigo);
                        $manoobra= $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "MANOOBRA", "ID", $codigo);
                        $asociados= $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ASOCIADOS", "ID", $codigo);
                    */

                        $idDetalleCoti = $this->StokePriceModel->insertStokePriceDetail($idCotizacion, $codigo, $arreglo, $cantidad, $unitario, $materiales, $manoobra, $asociados, $observacion, $margen, $this->session->userdata('usuario'), $valueIvaCotizacion);
                        //Guardo historicos
                        $this->StokePriceModel->insertStokePriceDetailHistory($idHistoricoCotizacion, $codigo, $cantidad, $unitario, $materiales, $manoobra, $asociados,  $margen, $this->session->userdata('usuario'));
                        $banderaDos = true;
                    } else {
                        //Actualizo registro 
                        $this->FunctionsGeneral->updateByField("COT_DETALLECOTI", "ESTADO", ACTIVO_ESTADO, "ID_COTIZACION", $idCotizacion, $this->session->userdata('usuario'), "ID_DESCRIPCION", $codigo);
                        $this->FunctionsGeneral->updateByField("COT_DETALLECOTI", "CANTIDAD", $cantidad, "ID_COTIZACION", $idCotizacion, $this->session->userdata('usuario'), "ID_DESCRIPCION", $codigo);
                        $this->FunctionsGeneral->updateByField("COT_DETALLECOTI", "MARGEN", $margen, "ID_COTIZACION", $idCotizacion, $this->session->userdata('usuario'), "ID_DESCRIPCION", $codigo);
                        $this->FunctionsGeneral->updateByField("COT_DETALLECOTI", "VALOR", $unitario, "ID_COTIZACION", $idCotizacion, $this->session->userdata('usuario'), "ID_DESCRIPCION", $codigo);
                        $this->FunctionsGeneral->updateByField("COT_DETALLECOTI", "IVA", $valueIvaCotizacion, "ID_COTIZACION", $idCotizacion, $this->session->userdata('usuario'), "ID_DESCRIPCION", $codigo);
                        $this->FunctionsGeneral->updateByField("COT_COTIZACION", "COSTO_ADC", $costoAdc, "ID", $idCotizacion, $this->session->userdata('usuario'));
                        $this->FunctionsGeneral->updateByField("COT_COTIZACION", "CONCEPTO_ADICIONAL", $conceptoAdicional, "ID", $idCotizacion, $this->session->userdata('usuario'));
                        $idDetalleCoti = $this->FunctionsGeneral->getFieldFromTableNotIdFields(
                            "COT_DETALLECOTI",
                            "ID",
                            "ID_DESCRIPCION",
                            $codigo,
                            "ID_COTIZACION",
                            $idCotizacion
                        );
                        //Guardo historicos
                        $this->StokePriceModel->insertStokePriceDetailHistory($idHistoricoCotizacion, $codigo, $cantidad, $unitario, $materiales, $manoobra, $asociados,  $margen, $this->session->userdata('usuario'));
                    }

                    //valido condición de despiece de elementos
                    $this->elementsOfProductsStokePrice($idDetalleCoti, $codigo, $cantidad, $this->session->userdata('usuario'));
                }

                //Genero mensaje que se ha actualizado la cotizaci&oacute;n
                if ($banderaDos && $bandera) {
                    $message = 'stokePriceUpdate';
                } else if ($banderaDos && !$bandera) {
                    $message = 'stokePriceUpdateTwo';
                } else if ($bandera && !$banderaDos) {
                    $message = 'stokePriceUpdateThree';
                } else {
                    $message = 'stokePriceNotUpdate';
                }
            }


            //Guardo valor de la TRM
            $trm = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_TRM", "VALOR", "ID", 1);
            $idTrm = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TRM", "ID", "ID_COTIZACION", $idCotizacion);
            if ($idTrm == '') {
                //Inserto registro
                $this->StokePriceModel->insertStokePriceTRM($idCotizacion, $trm,  $this->session->userdata('usuario'));
            } else {
                //Actualizo registro
                $this->FunctionsGeneral->updateByField("COT_TRM", "VALOR", $trm, "ID", $idTrm, $this->session->userdata('usuario'));
            }

            // Pinto mensaje para retornar a la aplicación
            $this->session->set_userdata('id', $idCoti);
            $this->session->set_userdata('auxiliar', $message);

            //Verifico si los códigos que se ingresaron tienen comodín asignado dentro del despiece para continuar con el cierre del despiece
            $cantidad = $this->FunctionsGeneral->getQuantityFieldFromTable("COT_VIEW_DESPIECE_VALIDA_COMODIN", "ID", $idCotizacion);
            if ($cantidad > 0) {
                $this->session->set_userdata('auxiliar', "stokePriceElements");
                $mainPage = "StokePriceAppStokePrice/defineElementsListOfProducts/" . $this->encryption->encrypt($idCotizacion);
            } else {
                $mainPage = "StokePriceAppStokePrice/viewRegister/" . $this->encryption->encrypt($idCotizacion);
            }

            // Redirecciono la página
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    private function elementsOfProductsStokePrice($idDetalle, $codigo, $cantidad, $usuario)
    {
        /**Rutina para guardar el despiece de un elemento*/


        //Obtengo el ID asociado
        $codigo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "CODIGO", "ID", $codigo);
        //Obtengo ubicación dentro del árbol de productos 
        $idArbol = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ARBOLCODIGO", "ID", "CODIGO", $codigo);

        //Elimino despieces asociados a la cotizaci&oacute;n
        $this->StokePriceModel->deleteElementListOfStokePrice($idDetalle, $idArbol);


        $lista = $this->StokePriceModel->selectValueFromElementListOfProduct($idArbol);
        if ($lista != null) {
            //echo "entro aqui ".$idArbol."<BR>";
            foreach ($lista as $value) {

                //Inserto registros
                $this->insertLineElementOfProducts($value->ID_DESC, $value->COSTO_MATERIALES, $idDetalle, $value->ID_ELEMENTO, $cantidad, $value->CANTIDAD, $usuario);
            }
        }
    }

    public function saveRequest()
    {
        /**
         * Rutina para guardar las solicitudes de cotizaci&oacute;n dentro del sistema.
         */

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $tipoDoc = $this->security->xss_clean($this->input->post('tipoDoc'));
            $documento = $this->security->xss_clean($this->input->post('documento'));
            $nombres = $this->encryption->encrypt($this->security->xss_clean($this->input->post('nombres')));
            $apellidos = $this->encryption->encrypt($this->security->xss_clean($this->input->post('apellidos')));
            $correo = $this->encryption->encrypt($this->security->xss_clean($this->input->post('correo')));
            $telefono = $this->encryption->encrypt($this->security->xss_clean($this->input->post('telefono')));
            $empresa = $this->security->xss_clean($this->input->post('empresa'));
            $fijo = $this->encryption->encrypt($this->security->xss_clean($this->input->post('fijo')));
            $direccion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('direccion')));
            $ciudad = $this->security->xss_clean($this->input->post('ciudad'));
            $departamento = $this->security->xss_clean($this->input->post('departamento'));
            $convenio = $this->security->xss_clean($this->input->post('convenio'));
            $proceso = $this->security->xss_clean($this->input->post('proceso'));
            $ejecutivo = $this->security->xss_clean($this->input->post('ejecutivo'));
            $adjunto1 = $this->input->post('adjunto1');
            echo $adjunto1;
            $fechaCotizacion = $this->security->xss_clean($this->input->post('fechaCotizacion'));
            $fechaCotizacionFormateada = date("Y/m/d H:i", strtotime($fechaCotizacion));

            // Valido si los datos del usuario ya se encuentran creados dentro de la gestión de cotizaciones
            $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_USUARIO", "ID", "TIPODOC", $tipoDoc, "DOCUMENTO", $documento);
            if ($idUsuario == '') {
                // Se debe insertar
                $idUsuario = $this->StokePriceModel->insertUserInformation($tipoDoc, $documento, $nombres, $apellidos, $telefono, $correo, $direccion, $ciudad, $fijo, $this->session->userdata('usuario'));
            } else {
                // Se actualiza valor
                $this->StokePriceModel->updatetUserInformation($idUsuario, $tipoDoc, $documento, $nombres, $apellidos, $telefono, $correo, $direccion, $ciudad, $fijo, $this->session->userdata('usuario'));
            }
            if ($proceso == NORMAL_PROCESS) {
                $aliada = null;
                $brigada = null;
            } else if ($proceso == BRIGADE_PROCESS) {
                $aliada = null;
                $brigada = null;
            } else if ($proceso == PARTNER_PROCESS) {
                $aliada = $convenio;
                $brigada = null;
            }

            $adjunto1 = null;

            if (!empty($_FILES['adjunto1']['name'])) {
                // Archivo 1
                $mi_archivo = 'adjunto1';
                $config['upload_path'] = STOKEPRICE_FOLDER . "";
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 777);
                }
                $config['file_name'] = $idUsuario . "_HC_" . date('YmdHis');
                $config['allowed_types'] = "pdf";
                $config['max_size'] = "99999";

                $config['max_width'] = "2000";
                $config['max_height'] = "2000";
                $this->load->library('upload', $config);
                $tempo = '';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($mi_archivo)) {
                    // *** ocurrio un error
                    $data['uploadError'] = $this->upload->display_errors();
                    $tempo = $this->upload->display_errors();
                    $band = false;
                } else {
                    $band = true;
                }
                if (!$band) {
                    $adjunto1 = null;
                } else {
                    $adjunto1 = $this->encryption->encrypt($config['file_name'] . ".pdf");;
                }
                $data['uploadSuccess'] = $this->upload->data();
            } else {
                $adjunto1 = null;
            }

            if (!empty($_FILES['adjunto2']['name'])) {
                // Archivo 1
                $mi_archivo = 'adjunto2';
                $config['upload_path'] = STOKEPRICE_FOLDER . "";
                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 777);
                }
                $config['file_name'] = $idUsuario . "_OM_" . date('YmdHis');
                $config['allowed_types'] = "pdf";
                $config['max_size'] = "99999";

                $config['max_width'] = "2000";
                $config['max_height'] = "2000";
                $this->load->library('upload', $config);
                $tempo = '';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload($mi_archivo)) {
                    // *** ocurrio un error
                    $data['uploadError'] = $this->upload->display_errors();
                    $tempo = $this->upload->display_errors();
                    $band = false;
                } else {
                    $band = true;
                }
                if (!$band) {
                    $adjunto2 = null;
                } else {
                    $adjunto2 = $this->encryption->encrypt($config['file_name'] . ".pdf");;
                }
                $data['uploadSuccess'] = $this->upload->data();
            } else {
                $adjunto2 = null;
            }

            if ($ejecutivo == '') {
                $ejecutivo = null;
            }

            $id = $this->StokePriceModel->insertRequestInformation($empresa, $proceso, $aliada, $brigada, $ejecutivo, $idUsuario, $adjunto1, $adjunto2, $this->session->userdata('usuario'), $fechaCotizacionFormateada, $ciudad, $departamento);

            // $id=0;
            $message = 'requestStokeDone';
            // Pinto mensaje para retornar a la aplicación
            $this->session->set_userdata('id', $id);
            $this->session->set_userdata('auxiliar', $message);
            // Redirecciono la página
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function saveInactive()
    {
        /**
         * Inactivo el registro para el cual se tiene asociado el valor $id
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar

            // Cargo información de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
            $tipificacion = $this->security->xss_clean($this->input->post('tipificacion'));
            $observacion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion')));

            if ($id != '') {

                $message = 'stokePriceDead';

                // Actualizo campos de inactivación
                $this->FunctionsGeneral->updateByID("COT_COTIZACION", "ESTADO", INACTIVO_ESTADO, $id, $this->session->userdata('usuario'));
                $this->FunctionsGeneral->updateByID("COT_COTIZACION", "ID_INACTIVO", $tipificacion, $id, $this->session->userdata('usuario'));
                $this->FunctionsGeneral->updateByID("COT_COTIZACION", "OBS_INACTIVO", $observacion, $id, $this->session->userdata('usuario'));

                // Creo seguimiento de que la cotizacion ha sido inactivada
                $this->StokePriceModel->insertStokePriceTrace($id, -1, $observacion, null, null, $this->session->userdata('usuario'));

                // Pinto mensaje para retornar a la aplicación
                $this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id));
                $this->session->set_userdata('auxiliar', $message);
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }


    public function saveInactiveRequest()
    {
        /**
         * Inactivo el registro para el cual se tiene asociado el valor $id
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar

            // Cargo información de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
            $observacion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion')));

            if ($id != '') {

                $message = 'stokePriceRequestDead';

                // Actualizo campos de inactivación
                $this->FunctionsGeneral->updateByID("COT_SOLICITUD", "ESTADO", INACTIVO_ESTADO, $id, $this->session->userdata('usuario'));
                $this->FunctionsGeneral->updateByID("COT_SOLICITUD", "OBS_INACTIVA", $observacion, $id, $this->session->userdata('usuario'));


                // Pinto mensaje para retornar a la aplicación
                $this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id));
                $this->session->set_userdata('auxiliar', $message);
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }



    public function saveTrace()
    {
        /**
         * Inactivo el registro para el cual se tiene asociado el valor $id
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Página principal a donde debo retornar

            // Cargo información de la lista teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
            $tipo = $this->security->xss_clean($this->input->post('tipo'));
            $observacion = $this->encryption->encrypt($this->security->xss_clean($this->input->post('observacion')));
            $numero = $this->encryption->encrypt($this->security->xss_clean($this->input->post('numero')));

            if ($id != '') {

                if (!empty($_FILES['adjunto']['name'])) {
                    // Archivo 1
                    $mi_archivo = 'adjunto';
                    $config['upload_path'] = STOKEPRICE_FOLDER . "";
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 777);
                    }
                    $config['file_name'] = $id . "_AUT_" . date('Ymd');
                    $config['allowed_types'] = "pdf";
                    $config['max_size'] = "99999";

                    $config['max_width'] = "2000";
                    $config['max_height'] = "2000";
                    $this->load->library('upload', $config);
                    $tempo = '';
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload($mi_archivo)) {
                        // *** ocurrio un error
                        $data['uploadError'] = $this->upload->display_errors();
                        $tempo = $this->upload->display_errors();
                        $band = false;
                    } else {
                        $band = true;
                    }
                    if (!$band) {
                        $adjunto = null;
                    } else {

                        $adjunto = $this->encryption->encrypt($config['file_name'] . "pdf");;
                    }
                    $data['uploadSuccess'] = $this->upload->data();
                } else {
                    $adjunto1 = null;
                }

                // Creo seguimiento de acuerdo al tipo
                $this->StokePriceModel->insertStokePriceTrace($id, $tipo, $observacion, $numero, $adjunto, $this->session->userdata('usuario'));
                // Obtengo tipo de seguimiento
                $idSeguimiento = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TIPOSEG", "CIERRA", "ID", $tipo);

                // Actualizo el estado del seguimiento en la cotizaci&oacute;n
                $this->FunctionsGeneral->updateByID("COT_COTIZACION", "ID_SEGUIMIENTO", $idSeguimiento, $id, $this->session->userdata('usuario'));

                // Pinto mensaje para retornar a la aplicación
                $this->session->set_userdata('id', $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id));
                $this->session->set_userdata('auxiliar', 'saveTracePriceStoke');
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }


    public function deleteElementOfList($id, $codigo, $idElemento)
    {
        /**  Listado de elementos que componen el despiece del código $codigo para la cotizacion con identificador $id*/

        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {

            //desencripta los parametros
            $id = $this->encryption->decrypt($id);
            $codigo = $this->encryption->decrypt($codigo);
            $idElemento = $this->encryption->decrypt($idElemento);


            echo "Codigo " . $codigo . "<br>";
            echo "Cotizacion " . $id . "<br>";
            echo "elemento " . $idElemento . "<br>";


            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $data = null;
                // Cargo la información de la cotizaci&oacute;n consecutivo
                $data['consecutivo'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id);

                //Valido si la cotizaci&oacute;n tienen ordenes relacionadas y activas
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $id, "ESTADO", ACTIVO_ESTADO) == 0) {
                    //Inactivo valor elemento relacionado al despiece
                    $this->FunctionsGeneral->updateByID("COT_DESPIECE", "ESTADO", INACTIVO_ESTADO, $idElemento, $this->session->userdata('usuario'));

                    // Realizo operación sobre el nuevo despiece y actualizó información
                    $this->updateStokePriceElement($id, $codigo, $this->session->userdata('usuario'));
                    $message = 'stokePriceElementsUpdate';
                    $this->session->set_userdata('id', null);
                    $this->session->set_userdata('auxiliar', $message);
                    // Redirecciono la página
                    $mainPage = "StokePriceAppStokePrice/elementListConfigure/" . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt($codigo);
                    redirect(base_url() . $mainPage);
                } else {
                    $message = 'notTraceCoti';
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $data['consecutivo']);
                    $this->session->set_userdata('auxiliar', $message);
                    // Redirecciono la página
                    $mainPage = "StokePriceAppStokePrice/board/";
                    redirect(base_url() . $mainPage);
                }
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function saveElementOfProduct()
    {

        //Actualizo valores de los elementos que han sido ingresados


        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "StokePriceAppStokePrice/board";


        $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
        $idDespiece = $this->encryption->decrypt($this->security->xss_clean($this->input->post('idDespiece')));
        $codigo = $this->encryption->decrypt($this->security->xss_clean($this->input->post('codigo')));
        $cantidad = $this->security->xss_clean($this->input->post('cantidad'));
        $elemento = $this->security->xss_clean($this->input->post('elemento'));

        //echo "Cotizacion: ".$id." linea del comodin: ". $idDespiece." Detalle Coti: ".$codigo." Cantidad: ".$cantidad." Nuevo elemento: ".$elemento."<br>";

        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID", $id);

            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $data = null;
                // Cargo la información de la cotizaci&oacute;n consecutivo
                $data['consecutivo'] = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "CONSECUTIVO", $id);

                //Valido si la cotizaci&oacute;n tienen ordenes relacionadas y activas
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ORDEN", "ID_COTIZACION", $id, "ESTADO", ACTIVO_ESTADO) == 0) {

                    if ($idDespiece != 'NA') {
                        //Inactivo valor elemento relacionado al despiece
                        $this->FunctionsGeneral->updateByID("COT_DESPIECE", "ESTADO", INACTIVO_ESTADO, $idDespiece, $this->session->userdata('usuario'));
                    }

                    //Id descripcion y costos
                    $idDescripcion = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DESCRIPCION", "ID", "CODIGO", $elemento, "ID_TIPO", 39);
                    if ($idDescripcion == '') {
                        //Creo la descripcion desde ordenes
                        $idDescripcion = $this->insertDetailElementOnStokePrice($elemento, $this->session->userdata('usuario'));
                    }

                    $costoMateriales = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DESCRIPCION", "MATERIALES", "CODIGO", $elemento, "ID_TIPO", 39);

                    //Obtengo línea del despiece para el código y el elemento 
                    $linea = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DETALLECOTI", "ID", "ID_DESCRIPCION", $codigo, "ID_COTIZACION", $id);

                    //Inserto nuevo elemento al despiece del producto 
                    $this->insertLineElementOfProducts($idDescripcion, $costoMateriales, $linea, $elemento, $cantidad, 1, $this->session->userdata('usuario'));
                    //echo "Descripcion: ".$idDescripcion," Costo materiales ",$costoMateriales," Linea ",$linea," Elemento ",$elemento," Cantidad ",$cantidad,"<br> ";



                    // Realizo operación sobre el nuevo despiece y actualizó información
                    $this->updateStokePriceElement($id, $codigo, $this->session->userdata('usuario'));



                    $message = 'stokePriceElementsUpdate';
                    $this->session->set_userdata('id', null);
                    $this->session->set_userdata('auxiliar', $message);
                    // Redirecciono la página
                    $mainPage = "StokePriceAppStokePrice/elementListConfigure/" . $this->encryption->encrypt($id) . "/" . $this->encryption->encrypt($codigo);
                    redirect(base_url() . $mainPage);
                } else {
                    $message = 'notTraceCoti';
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $data['consecutivo']);
                    $this->session->set_userdata('auxiliar', $message);
                    // Redirecciono la página
                    $mainPage = "StokePriceAppStokePrice/board/";
                    redirect(base_url() . $mainPage);
                }
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationGeneral");
                // Redirecciono la página
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }


    private  function insertDetailElementOnStokePrice($codigo, $usuario)
    {

        /* Inserto el detalle del elemento*/

        if ($this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ELEMCOSTO ", "ID_VALIDA", "ID_ELEMENTO", $codigo) == CTE_VALOR_SI) {
            $origen = CTE_PAIS_DEFECTO_2;
        } else {
            $origen = CTE_PAIS_DEFECTO;
        }


        $id = $this->StokePriceModel->insertDetailsInformation(
            $codigo,
            $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ELEMENTO", "CODIGO", "ID", $codigo),
            39,
            $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ELEMENTO", "ID_PROVEEDOR", "ID", $codigo),
            $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ELEMENTO", "NOMBRE", "ID", $codigo),
            $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ELEMCOSTO ", "VALOR", "ID_ELEMENTO", $codigo),
            0,
            0,
            30,
            12,
            $origen,
            null,
            $usuario
        );
        return $id;
    }

    private function updateStokePriceElement($id, $codigo, $usuario)
    {
        /** Valida y actualiza los costos asociados al producto que se está cotizando teniendo en cuenta el despiece, mano de obra y costos*/



        //Obtengo línea del despiece para el código y el elemento 
        $linea = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DETALLECOTI", "ID", "ID_DESCRIPCION", $codigo, "ID_COTIZACION", $id);
        //Obtengo lista de elementos del despiece
        $lista = $this->StokePriceModel->selectValueFromElementListOfProductfromStokePrice($linea);
        $total = 0;
        foreach ($lista as $value) {
            //Calculo el valor de la TRM asociada

            $trm = trmTranslate($this, $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DESCRIPCION", "ID", "CODIGO", $value->ID_ELEMENTO));

            //obtengo el valor total
            if ($value->VALOR == '') {
                //Le sumo cero
                $total += 0;
            } else {
                // Se calcula con base a la cantidad, el costo de materiales y la TRM
                $temporal = $value->CANTIDAD * $value->VALOR * $trm;
                $total += $temporal;
            }
            //echo $value->ID." ".$value->ID_ELEMENTO." ".$value->VALOR." ".$temporal." ".$total."<br>";

        }
        //Actualizo costo de materiales para el producto
        $this->FunctionsGeneral->updateByID("COT_DETALLECOTI", "MATERIALES", $total, $linea, $usuario);

        //obtengo detalle de costos asociados
        $materiales = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DETALLECOTI", "MATERIALES", "ID", $linea);
        $manoObra =  $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DETALLECOTI", "MANOOBRA", "ID", $linea);
        $asociados = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DETALLECOTI", "ASOCIADOS", "ID", $linea);
        $margen = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DETALLECOTI", "MARGEN", "ID", $linea);


        //obtengo informaciom del margen
        $empresa = $this->FunctionsGeneral->getFieldFromTable("COT_COTIZACION", "ID_EMPRESA", $id);
        $tarifa = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_TARIFA", $empresa);
        $idEmpresa = $this->FunctionsGeneral->getFieldFromTable("COT_TARIFAEMPRESA", "ID_EMPRESA", $empresa);

        //Calculo precio
        $precio = defineValueFormule($margen, $materiales, $manoObra, $asociados);

        //Valido datos de empresa compuesta
        $datosEmpresa = companyListValidation($this, $empresa);
        if ($datosEmpresa[0] == 'NA') {
            //echo "arriba";
            //Actualizo el precio del producto
            $this->FunctionsGeneral->updateByID("COT_DETALLECOTI", "VALOR", $precio, $linea, $usuario);
        } else {
            if ($datosEmpresa[1] == CTE_VALOR_NO) {

                if ($idEmpresa == 2689) {
                    //identifico el valor interno
                    $idInterno = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_EMPRESALISTA", "ID", "ID_EMPRESA", $idEmpresa);
                    $auxiliar = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_LISTAELEMENTOS", "AUXILIAR", "ID_EMPRESA", $idInterno, "ID_CODIGO", $linea);
                    //Obtengo el valor tope definido
                    $tope = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_CODIGONEPS", "MONTO", "CODIGO", $auxiliar);
                    if ($precio > $tope) {
                        $precio = $tope;
                    }
                }
                //Actualizo el precio del producto
                $this->FunctionsGeneral->updateByID("COT_DETALLECOTI", "VALOR", $precio, $linea, $usuario);
            }
        }
    }

    private function insertLineElementOfProducts($idDescripcion, $costoMateriales, $idDetalle, $idElemento, $cantidad, $cantidadElemento, $usuario)
    {
        /** Rutina para insertar una línea de despiece*/

        $trm = trmTranslate($this, $idDescripcion);

        //obtengo el valor total
        if ($costoMateriales == '') {
            //Le sumo cero
            $temporal = 0;
        } else {
            // Se calcula con base a la cantidad, el costo de materiales y la TRM
            $temporal = $costoMateriales;
        }
        //Inserto despiece
        $this->StokePriceModel->insertStokePriceElementList($idDetalle, $idElemento, ($cantidadElemento * $cantidad), $temporal, $usuario);
    }
}
