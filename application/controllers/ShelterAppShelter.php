<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador para visualizar el manejo de los convenios de las brigadas
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class ShelterAppShelter extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Cargo modelos, librerias y helpers
        $this->load->model('ShelterModel');
        $this->load->model('EsaludModel');
    }

    /**
     * ***********************************************************************************************************
     * RUTINAS PARA PINTAR FORMULARIOS
     * ****************************************************************************************************** *
     */
    public function board()
    {
        /**
         * Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "ShelterAppShelter/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            // Pinto la informaci�n de los parametros de la aplicaci�n
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            // Pinto los permisos del tablero de control
            $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
            $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
            $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);
            
            // Pinto el listado actual de las habitaciones
            $idFecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", cambiaHoraServer(2));
            $data['shelterList'] = $this->ShelterModel->selectListOcupationShelter($idFecha);
            
            // Obtengo ocupaci�n actual del hogar de paso
            $condicion = "AND HP_HOGARPASO.ESTADO IN ('" . SHELTER_FULL . "')";
            if($this->ShelterModel->selectListOcupationShelter($idFecha, $idFecha, $condicion)!=null){
                $data['cantidadOcupacion'] = count($this->ShelterModel->selectListOcupationShelter($idFecha, $idFecha, $condicion));
            }else{
                $data['cantidadOcupacion'] = null;
            }
            
            
            // Obtengo ocupaci�n actual del hogar de paso
            $condicion = "AND HP_HOGARPASO.ESTADO IN ('" . SHELTER_RESERVE . "')";
            if($this->ShelterModel->selectListOcupationShelter($idFecha, $idFecha, $condicion)!=null){
                $data['cantidadReservas'] = count($this->ShelterModel->selectListOcupationShelter($idFecha, $idFecha, $condicion));
            }else{
                $data['cantidadReservas'] =null;
            }
            //$data['cantidadReservas'] = count($this->ShelterModel->selectListOcupationShelter($idFecha, $idFecha, $condicion));
            
            // Pinto plantilla principal
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('shelter/process/board', $data);
            
            /**
             * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la p�gina (p�ginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function newRegister($reserva = null)
    {
        /**
         * Formulario para registrar un nuevo usuario dentro del hogar de paso
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");
            // Pinto la informaci�n de los parametros de la aplicaci�n
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            
            // Pinto el listado actual de las habitaciones
            $idFecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", cambiaHoraServer(2));
            $data['shelterList'] = $this->ShelterModel->selectListOcupationShelter($idFecha);
            // Recibo el valor de la variable
            $id = null; // $this->encryption->decrypt ( $id );
            $data['id'] = $id;
            
            // Pinto informaci�n
            $data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
            
            // $data['listaMunicipio']=$this->FunctionsGeneral->selectValoresListaTabla("ADM_MUNICIPIO");
            $data['departamento'] = NULL;
            $data['listaTipoUsuario'] = $this->FunctionsGeneral->selectValoresListaTabla("HP_TIPOUSUARIO");
            $data['listaTipoDocumento'] = $this->FunctionsAdmin->selectValoresListaAdministracion('TIPO_DOCPERSONA', '1');
            $data['listaAcompanante'] = $this->FunctionsAdmin->selectValoresListaAdministracion("ACOMPA", '1');
            $data['listaEmpresas'] = $this->EsaludModel->getCompaniesInformation();
            $condition = "and ADM_PERFIL.ID='3'";
            $data['listaTsocial'] = $this->Users->selectUsersFromProfile($condition);
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            // Recibo el valor de la variable
            $reserva = $this->encryption->decrypt($reserva);
            if ($reserva == null) {
                $this->load->view('shelter/process/newRegisterDefinition', $data);
            } else {
                // Obtengo periodo de la reserva
                $finicio = str_replace("-", "/", $this->FunctionsGeneral->getFieldFromTableNotId("HP_USUARIOOCUPA", "INICIO", "ID_USUARIOHP", $reserva));
                $ffin = str_replace("-", "/", $this->FunctionsGeneral->getFieldFromTableNotId("HP_USUARIOOCUPA", "FIN", "ID_USUARIOHP", $reserva));
                $data['fecha'] = $finicio . " - " . $ffin;
                $data['fechaInicial'] = $finicio;
                $data['fechaFinal'] = $ffin;
                
                $data['fecha'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $finicio) . " - " . $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $ffin);
                $data['fechaInicial'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $finicio) ;
                $data['fechaFinal'] =  $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $ffin);
                
                
                $data['reservaVisual'] = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOHP", "RESERVA", $reserva);
                $data['reserva'] = $reserva;
                $condicionApoyo = "and HP_HOGARPASO.ESTADO ='" . SHELTER_FREE . "'";
                $data['listaHabitacion'] = $this->ShelterModel->selectListOcupationShelterByRoomBed(defineFormatoFecha($finicio, FORMAT_DATE), defineFormatoFecha($ffin, FORMAT_DATE), $condicionApoyo);
                
                $this->load->view('shelter/process/newRegisterPlusDefinition', $data);
            }
            
            // Cargo validaci�n de formulario
            $this->load->view('validation/shelter/process/formNewRegisterValidation');
            /**
             * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la p�gina (p�ginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function checkIn($id = null)
    {
        /**
         * Formulario para ingresar al hu�sped del hogar de paso
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "ShelterAppShelter/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");
            // Pinto la informaci�n de los parametros de la aplicaci�n
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            // Pinto los permisos del tablero de control
            $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
            $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'checkIn', $idModule, VIEW_LIST_PERMISSION);
            $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'checkIn', $idModule, VIEW_BUTTON_PERMISSION);
            
            // Recibo el valor de la variable
            $id = $this->encryption->decrypt($id);
            // Obtengo el id Habcama
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $data['habitacion'] = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $data['cama'] = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            // Obtengo la fecha de inicio
            $fecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", cambiaHoraServer(2));
            
            $datos = $this->ShelterModel->selectBooking($idHabCama, $fecha);
            foreach ($datos as $value) {
                $data['fecha'] = $value->INICIO;
                // Traigo informaci�n del hu�sped
                $huesped = retornaInformacionHuesped($value->ID_USUARIOHP, $this);
                $data['nombre'] = $huesped['nombre'];
                $data['idTipo'] = $huesped['idTipo'];
                $data['documento'] = $huesped['documento'];
                
                $data['tipoDoc'] = $huesped['tipoDoc'];
                $id = $this->encryption->encrypt($value->ID);
                $data['id'] = $id;
            }
            
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('shelter/process/checkInDefinition', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/shelter/process/formCheckInValidation');
            /**
             * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la p�gina (p�ginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function checkOut($id = null)
    {
        /**
         * Formulario para egresar al hu�sped del hogar de paso.
         * Para el egreso tendr� en cuenta la fecha actual y la fecha de cierre
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "ShelterAppShelter/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");
            // Pinto la informaci�n de los parametros de la aplicaci�n
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            
            // Recibo el valor de la variable
            $id = $this->encryption->decrypt($id);
            // Obtengo el id Habcama
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $data['habitacion'] = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $data['cama'] = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            
            // Pinto informaci�n del hu�sped
            
            $fecha = cambiaHoraServer(2);
            $fecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fecha);
            $datos = $this->ShelterModel->selectBooking($idHabCama, $fecha);
            foreach ($datos as $value) {
                $data['fecha'] =  $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $value->INICIO);
                if (intervaloTiempo(cambiaHoraServer(1), $value->FIN, 86400) < 0) {
                    $data['fechaFin'] = cambiaHoraServer(1);
                } else {
                    $data['fechaFin'] = $value->FIN;
                }
                // Traigo informaci�n del hu�sped
                $huesped = retornaInformacionHuesped($value->ID_USUARIOHP, $this);
                $data['nombre'] = $huesped['nombre'];
                $data['idTipo'] = $huesped['idTipo'];
                $data['documento'] = $huesped['documento'];
                
                $data['tipoDoc'] = $huesped['tipoDoc'];
                $id = $this->encryption->encrypt($value->ID);
                $data['id'] = $id;
            }
            
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('shelter/process/checkOutDefinition', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/shelter/process/formCheckOutValidation');
            /**
             * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la p�gina (p�ginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function moreTime($id = null)
    {
        /**
         * Formulario para prorrogar la estaancia al hu�sped del hogar de paso.
         * Para el egreso tendr� en cuenta la fecha definida de egreso y desde all� podr� prorrogar a la fecha requerida
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "ShelterAppShelter/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");
            // Pinto la informaci�n de los parametros de la aplicaci�n
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            
            // Recibo el valor de la variable
            $id = $this->encryption->decrypt($id);
            // Obtengo el id Habcama
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $data['habitacion'] = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $data['cama'] = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            $data['idHabCama'] = $idHabCama;
            
            // Pinto informaci�n del hu�sped
            
            // Obtengo la fecha de inicio
            $fecha = cambiaHoraServer(2);
            $fecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fecha);
            
            $datos = $this->ShelterModel->selectBooking($idHabCama, $fecha);
            foreach ($datos as $value) {
                $data['fecha'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $value->INICIO);
                $data['fechaFin'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $value->FIN);
                $data['prorroga'] = sumaTiempo($data['fechaFin'], 1);
                // Traigo informaci�n del hu�sped
                $huesped = retornaInformacionHuesped($value->ID_USUARIOHP, $this);
                $data['nombre'] = $huesped['nombre'];
                $data['idTipo'] = $huesped['idTipo'];
                $data['documento'] = $huesped['documento'];
                
                $data['tipoDoc'] = $huesped['tipoDoc'];
                
                $id = $this->encryption->encrypt($value->ID);
                $data['id'] = $id;
            }
            
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('shelter/process/moreTimeDefinition', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/shelter/process/formMoreTimeValidation');
            /**
             * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la p�gina (p�ginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function traslateRoom($id = null)
    {
        /**
         * Formulario para hacer el traslado de habitaci�n teniendo en cuenta la informaci�n dada dentro del sistema
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "ShelterAppShelter/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");
            // Pinto la informaci�n de los parametros de la aplicaci�n
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            
            // Recibo el valor de la variable
            $id = $this->encryption->decrypt($id);
            // Obtengo el id Habcama
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $data['habitacion'] = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $data['cama'] = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            $data['idHabCama'] = $idHabCama;
            
            // Pinto informaci�n del hu�sped
            
            // Obtengo la fecha de inicio
            $fecha = cambiaHoraServer(2);
            $fecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fecha);
            
            $datos = $this->ShelterModel->selectBooking($idHabCama, $fecha);
            foreach ($datos as $value) {
                $data['fecha'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $value->INICIO);
                $data['fechaFin'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $value->FIN);
                $data['prorroga'] = sumaTiempo($data['fechaFin'], 1);
                // Traigo informaci�n del hu�sped
                $huesped = retornaInformacionHuesped($value->ID_USUARIOHP, $this);
                $data['nombre'] = $huesped['nombre'];
                $data['idTipo'] = $huesped['idTipo'];
                $data['documento'] = $huesped['documento'];
                $data['tipoDoc'] = $huesped['tipoDoc'];
                
                $id = $this->encryption->encrypt($value->ID);
                $data['id'] = $id;
            }
            // Listo las ubicaciones actuales con disponibilidad
            $condicionApoyo = "and HP_HOGARPASO.ESTADO ='" . SHELTER_FREE . "'";
            $data['listaHabitacion'] = $this->ShelterModel->selectListOcupationShelterByRoomBed($value->INICIO, $value->FIN, $condicionApoyo);
            
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('shelter/process/traslateRoomDefinition', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/shelter/process/formTraslateRoomValidation');
            /**
             * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la p�gina (p�ginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function maintenance($id)
    {
        /**
         * Formulario para capturar la fecha en la cual se llevar� a acabo el mantenimiento del hogar de paso para la habitaci�n - cama seleccionada
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "ShelterAppShelter/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");
            // Pinto la informaci�n de los parametros de la aplicaci�n
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            // Pinto los permisos del tablero de control
            $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
            $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
            $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);
            
            // Pinto el listado actual de las habitaciones
            $idFecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", cambiaHoraServer(2));
            
            $data['shelterList'] = $this->ShelterModel->selectListOcupationShelter($idFecha);
            // Recibo el valor de la variable
            $id = $this->encryption->decrypt($id);
            $data['id'] = $id;
            // Obtengo el id Habcama
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $data['habitacion'] = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $data['cama'] = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('shelter/process/maintenanceDefinition', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/shelter/process/formMaintenanceValidation');
            /**
             * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la p�gina (p�ginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function closeRegister($id = null)
    {
        /**
         * Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            if ($id == null) {
                // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
                $mainPage = "ShelterAppShelter/board";
                $data = null;
                // Pinto la cabecera principal de las p�ginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);
                // Pinto la informaci�n de los parametros de la aplicaci�n
                
                /**
                 * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
                 */
                $data['mainPage'] = $mainPage;
                // Pinto los permisos del tablero de control
                $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
                $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'closeRegister', $idModule, VIEW_LIST_PERMISSION);
                $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'closeRegister', $idModule, VIEW_BUTTON_PERMISSION);
                
                // Pinto el listado actual de las habitaciones
                $idFecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", cambiaHoraServer(2));
                $data['listaLista'] = $this->ShelterModel->selectBookingShelter($idFecha); // $this->ShelterModel->selectListOcupationShelter(cambiaHoraServer(2));
                                                                                           // Pinto plantilla principal
                                                                                           // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
                $this->load->view('shelter/process/boardCloseRegister', $data);
                
                /**
                 * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
                 */
                
                // Pinto el final de la p�gina (p�ginas internas)
                showCommonEnds($this, null, null);
            } else {
                // Redirecciono porque puedo eliminar la reserva, ya que conozco el ID
                // Pinto mensaje para retornar a la aplicaci�n
                $page = "ShelterAppShelter/endBooking/" . $id;
                // Redirecciono la p�gina
                redirect(base_url() . $page);
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function modifyInformation($id = null)
    {
        /**
         * Formulario para modificar la informaci�n del hu�sped
         */
        
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a trav�s de la funci�n pintaComun del helper hospitium
            $mainPage = "ShelterAppShelter/board";
            $data = null;
            // Pinto la cabecera principal de las p�ginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, "date");
            // Pinto la informaci�n de los parametros de la aplicaci�n
            
            /**
             * Informaci�n relacionada con la plantilla principal Pinto la pantalla *
             */
            $data['mainPage'] = $mainPage;
            
            // Recibo el valor de la variable
            $id = $this->encryption->decrypt($id);
            // Obtengo el id Habcama
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $data['habitacion'] = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $data['cama'] = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            
            // Pinto informaci�n del hu�sped
            
            // Obtengo la fecha de inicio
            
            $fecha = cambiaHoraServer(2);
            $fecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fecha);
            
            $datos = $this->ShelterModel->selectBooking($idHabCama, $fecha);
            foreach ($datos as $value) {
                $data['fecha'] = $value->INICIO;
                if (intervaloTiempo(cambiaHoraServer(1), $value->FIN, 86400) < 0) {
                    $data['fechaFin'] = cambiaHoraServer(1);
                } else {
                    $data['fechaFin'] = $value->FIN;
                }
                // Traigo informaci�n del hu�sped
                $huesped = retornaInformacionHuesped($value->ID_USUARIOHP, $this);
                $data['nombre'] = $huesped['nombre'];
                $data['idUsuarioHp'] = $value->ID_USUARIOHP;
                $data['soloNombres'] = $huesped['soloNombres'];
                $data['apellidos'] = $huesped['apellidos'];
                $data['tipoDoc'] = $huesped['tipoDocId'];
                $data['documento'] = $huesped['documento'];
                $data['entidad'] = $huesped['entidad'];
                
                $data['procedencia'] = $huesped['procedencia'];
                
                $data['idTipo'] = $huesped['idTipo'];
                if ($data['idTipo'] == '1') {
                    $data['disabled'] = "disabled='disabled'";
                } else {
                    $data['disabled'] = null;
                }
                
                $data['nacimiento'] = $huesped['nacimiento'];
                
                $id = $this->encryption->encrypt($value->ID);
                $data['id'] = $id;
            }
            
            // Pinto informaci�n de las listas
            // Pinto informaci�n
            $data['listaDepartamento'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_DEPARTAMENTO");
            $data['listaCiudad'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_MUNICIPIO");
            $data['departamento'] = $this->FunctionsGeneral->getFieldFromTable("ADM_MUNICIPIO", "ID_DEPARTAMENTO", $data['procedencia']);
            $data['listaTipoUsuario'] = $this->FunctionsGeneral->selectValoresListaTabla("HP_TIPOUSUARIO");
            $data['listaTipoDocumento'] = $this->FunctionsAdmin->selectValoresListaAdministracion('TIPO_DOCPERSONA', '1');
            $data['listaAcompanante'] = $this->FunctionsAdmin->selectValoresListaAdministracion("ACOMPA", '1');
            $data['listaEmpresas'] = $this->EsaludModel->getCompaniesInformation();
            
            // Pinto la lista gen�rica de parametros que se debe tener en cuenta dentro del sistema de par�metros
            $this->load->view('shelter/process/modifyDefinition', $data);
            // Cargo validaci�n de formulario
            $this->load->view('validation/shelter/process/formNewRegisterValidation');
            /**
             * Fin: Informaci�n relacionada con la plantilla principal Pinto la pantalla
             */
            
            // Pinto el final de la p�gina (p�ginas internas)
            showCommonEnds($this, null, null);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    /**
     * ***********************************************************************************************************
     * RUTINAS PARA GUARDAR INFORMACI�N
     * ****************************************************************************************************** *
     */
    public function saveBooking()
    {
        /**
         * Guardo la informaci�n de la habitaci�n para enviarla a mantenimiento
         */
        $mainPage = "ShelterAppShelter/board";
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            list ($fechaInicial, $fechaFinal) = explode(" - ", $this->security->xss_clean($this->input->post('periodo')));
            // echo $fechaFinal - $fechaInicial;
            
            // Datos de reserva asociada (principal)
            $idReserva = $this->security->xss_clean($this->input->post('reserva'));
            if ($idReserva == null) {
                if ($this->security->xss_clean($this->input->post('acompanante')) == '') {
                    $cantidadAcompanantes = 37;
                } else {
                    $cantidadAcompanantes = $this->security->xss_clean($this->input->post('acompanante'));
                }
                $procedencia = $this->security->xss_clean($this->input->post('ciudad'));
                $entidad = $this->security->xss_clean($this->input->post('entidad'));
                $tsocial = $this->security->xss_clean($this->input->post('tsocial'));
            } else {
                $cantidadAcompanantes = 37;
                // Tomo la procedencia de la reserva principal
                $idEncUsuario = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOHP", "ID_ENCUSUARIO", $idReserva);
                $procedencia = $this->FunctionsGeneral->getFieldFromTable("HP_ENCUSUARIO", "PROCEDENCIA", $idEncUsuario);
                $entidad = $this->FunctionsGeneral->getFieldFromTable("HP_ENCUSUARIO", "ENTIDAD", $idEncUsuario);
                $tsocial = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOHP", "TSOCIAL", $idReserva);
            }
            
            // Actualiz� fechas
            $idHabCama = $this->security->xss_clean($this->input->post('relacion'));
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $habitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $cama = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            
            // Obtengo los id de las fechas
            $idFechaInicial = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", defineFormatoFecha($fechaInicial, FORMAT_DATE));
            $idFechaFinal = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", defineFormatoFecha($fechaFinal, FORMAT_DATE));
            
            // Verifico cantidad de espacios suficientes dentro de la reserva dada
            $cantidad = $this->ShelterModel->selectQuantityFromShelter($idHabCama, $idFechaInicial, $idFechaFinal, "AND HP_HOGARPASO.ESTADO NOT IN ('" . SHELTER_FREE . "')");
            
            if ($cantidad == 0) {
                
                // Verifico informaci�n y creo la relaci�n del usuario dentro del hogar de paso (como usuario de este)
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("HP_ENCUSUARIO", "TIPODOC", $this->security->xss_clean($this->input->post('tipoDoc')), "DOCUMENTO", $this->security->xss_clean($this->input->post('documento'))) == 0) {
                    // Inserto registro
                    $idEncUsuario = $this->ShelterModel->insertShelterEncUser($this->security->xss_clean($this->input->post('tipo')), $entidad, $this->security->xss_clean($this->input->post('tipoDoc')), $this->security->xss_clean($this->input->post('documento')), $this->security->xss_clean($this->input->post('historia')), $procedencia, $this->session->userdata('usuario'));
                    if ($this->security->xss_clean($this->input->post('tipo')) != 1) {
                        // Creo el detalle del usuario
                        $this->ShelterModel->insertShelterUser($idEncUsuario, $this->encryption->encrypt($this->security->xss_clean($this->input->post('nombres'))), $this->encryption->encrypt($this->security->xss_clean($this->input->post('apellidos'))), $this->security->xss_clean($this->input->post('nacimiento')), $this->session->userdata('usuario'));
                    }
                } else {
                    // Obtengo el id
                    $idEncUsuario = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_ENCUSUARIO", "ID", "TIPODOC", $this->security->xss_clean($this->input->post('tipoDoc')), "DOCUMENTO", $this->security->xss_clean($this->input->post('documento')));
                    // Actualizo informaci�n
                    $this->ShelterModel->updateShelterEncUser($idEncUsuario, $entidad, $this->security->xss_clean($this->input->post('historia')), $procedencia, $this->session->userdata('usuario'));
                    $this->ShelterModel->updateShelterUser($idEncUsuario, $this->encryption->encrypt($this->security->xss_clean($this->input->post('nombres'))), $this->encryption->encrypt($this->security->xss_clean($this->input->post('apellidos'))), $this->security->xss_clean($this->input->post('nacimiento')), $this->session->userdata('usuario'));
                }
                
                // Obtengo los limites de la reserva / ocupacion
                $inicio = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_HOGARPASO", "ID", "ID_HABCAMA", $idHabCama, "FECHAINICIO", $idFechaInicial);
                
                $fin = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_HOGARPASO", "ID", "ID_HABCAMA", $idHabCama, "FECHAINICIO", $idFechaFinal);
                
                // Creo la relaci�n de la reserva con el usuario
                $reserva = $this->ShelterModel->insertShelterRelationWithUser($idEncUsuario, $tsocial, true, false, $cantidadAcompanantes, $this->session->userdata('usuario'));
                
                // Creo el detalle de la reserva
                $this->ShelterModel->insertShelterRelationWithUserDefinition($reserva, $idHabCama, $idFechaInicial, $idFechaFinal, NULL, NULL, NULL, NULL, $this->session->userdata('usuario'));
                
                // Actualizo informaci�n
                $this->ShelterModel->updateShelterStateByDates($idHabCama, $idFechaInicial, $idFechaFinal, SHELTER_RESERVE, $this->session->userdata('usuario'));
                
                // Si tiene acompa�ante
                if ($idReserva != null) {
                    // Creo la relaci�n entre el paciente y el acompa�ante
                    $this->ShelterModel->insertShelterRelationWithUsers($idReserva, $reserva, $this->session->userdata('usuario'));
                }
                
                // Creo mensaje
                $mensaje = "bookingDone";
                $nombre = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOHP", "RESERVA", $reserva);
            } else {
                // Creo mensaje
                $mensaje = "bookingError";
                $nombre = $habitacion . " - " . $cama;
            }
            if ($this->security->xss_clean($this->input->post('acompanante')) == '' || $this->security->xss_clean($this->input->post('acompanante')) == '37') {
                // Pinto mensaje para retornar a la aplicaci�n
                $this->session->set_userdata('id', $nombre);
                $this->session->set_userdata('auxiliar', $mensaje);
                // Redirecciono la p�gina
                redirect(base_url() . $mainPage);
            } else {
                $mainPage = "ShelterAppShelter/newRegister/" . $this->encryption->encrypt($reserva);
                // Pinto mensaje para retornar a la aplicaci�n para ingresar acompa�antes
                $this->session->set_userdata('id', $nombre);
                $this->session->set_userdata('auxiliar', $mensaje);
                // Redirecciono la p�gina
                redirect(base_url() . $mainPage);
            }
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function saveModifyInformation()
    {
        /**
         * Guardo la informaci�n de la habitaci�n para enviarla a mantenimiento
         */
        $mainPage = "ShelterAppShelter/board";
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $id = $this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
            $procedencia = $this->security->xss_clean($this->input->post('ciudad'));
            $entidad = $this->security->xss_clean($this->input->post('entidad'));
            // Verifico informaci�n y creo la relaci�n del usuario dentro del hogar de paso (como usuario de este)
            if ($this->FunctionsGeneral->getQuantityFieldFromTable("HP_ENCUSUARIO", "TIPODOC", $this->security->xss_clean($this->input->post('tipoDoc')), "DOCUMENTO", $this->security->xss_clean($this->input->post('documento'))) == 0) {
                // Inserto registro
                $idEncUsuario = $this->ShelterModel->insertShelterEncUser($this->security->xss_clean($this->input->post('tipo')), $entidad, $this->security->xss_clean($this->input->post('tipoDoc')), $this->security->xss_clean($this->input->post('documento')), $this->security->xss_clean($this->input->post('historia')), $procedencia, $this->session->userdata('usuario'));
                if ($this->security->xss_clean($this->input->post('tipo')) != 1) {
                    // Creo el detalle del usuario
                    $this->ShelterModel->insertShelterUser($idEncUsuario, $this->encryption->encrypt($this->security->xss_clean($this->input->post('nombres'))), $this->encryption->encrypt($this->security->xss_clean($this->input->post('apellidos'))), $this->security->xss_clean($this->input->post('nacimiento')), $this->session->userdata('usuario'));
                }
            } else {
                // Obtengo el id
                $idEncUsuario = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_ENCUSUARIO", "ID", "TIPODOC", $this->security->xss_clean($this->input->post('tipoDoc')), "DOCUMENTO", $this->security->xss_clean($this->input->post('documento')));
                // Actualizo informaci�n
                $this->ShelterModel->updateShelterEncUser($idEncUsuario, $entidad, $this->security->xss_clean($this->input->post('historia')), $procedencia, $this->session->userdata('usuario'));
                $this->ShelterModel->updateShelterUser($idEncUsuario, $this->encryption->encrypt($this->security->xss_clean($this->input->post('nombres'))), $this->encryption->encrypt($this->security->xss_clean($this->input->post('apellidos'))), $this->security->xss_clean($this->input->post('nacimiento')), $this->session->userdata('usuario'));
            }
            // Cambio la relaci�n del usuario con el hogar de paso para la relaci�n dada
            $this->FunctionsGeneral->updateByID("HP_USUARIOHP", "ID_ENCUSUARIO", $idEncUsuario, $this->security->xss_clean($this->input->post('idUsuarioHp')), $this->session->userdata('usuario'));
            
            // Creo mensaje
            $mensaje = "bookingDoneChangeInformation";
            // Obtengo el id Habcama
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $habitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $cama = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            $nombre = $habitacion . " - " . $cama;
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', $mensaje);
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function endBooking($id)
    {
        /**
         * Panel principal en donde se listar�n los diferentes registros creados para el parametro al cual se ha ingresado
         */
        $mainPage = "ShelterAppShelter/board";
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo el valor de la variable
            $id = $this->encryption->decrypt($id);
            // echo $id;
            $data['id'] = $id;
            // Obtengo el id Habcama
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $habitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $cama = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            
            $fecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", cambiaHoraServer(2));
            
            $datos = $this->ShelterModel->selectBooking($idHabCama, $fecha);
            // Ejecuto sentencia para validar la reserva
            $acompanante = $this->validateBookingForClosing($datos, $idHabCama, 1);
            
            // Debo ejecutar nuevamente la rutina para cancelar la reserva del acompa�ante
            if ($acompanante != '') {
                // Tiene acompa�ante
                $datos = $this->ShelterModel->selectBookingFromUser($acompanante, $fecha);
                $this->validateBookingForClosing($datos, null, 2);
                $mensaje = 'endBookingDoneTwo';
            } else {
                $mensaje = 'endBookingDone';
            }
            $nombre = $habitacion . " - " . $cama;
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', $mensaje);
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    private function validateBookingForClosing($datos, $idHabCama, $validador)
    {
        /**
         * Rutina para validar el cierre de una reserva previamente elaborada
         */
        $acompanante = '';
        if ($datos!=null) {
            foreach ($datos as $value) {
                // echo $value->ID;
                if ($validador == 1) {
                    $idHabCama = $idHabCama;
                } else {
                    $idHabCama = $value->ID_HABCAMA;
                }
                // Actualizo los valores en HP_HOGARPASO
                
                $condicion = "and HP_HOGARPASO.ESTADO='" . SHELTER_RESERVE . "'";
                
                $this->ShelterModel->updateShelterStateByDates($idHabCama, $value->INICIO, $value->FIN, SHELTER_FREE, $this->session->userdata('usuario'), $condicion);
                // Verifico si tiene acompa�ante
                $acompanante = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_PACACOMP", "ID_ACOMP", "ID_USUARIOHP", $value->ID_USUARIOHP, "ESTADO", ACTIVO_ESTADO);
                
                // Inactivo el resumen de RESERVA
                $this->FunctionsGeneral->updateByID("HP_USUARIOOCUPA", "ESTADO", INACTIVO_ESTADO, $value->ID, $this->session->userdata('usuario'));
            }
        }
        // Retorno informaci�n de acompa�ante
        return $acompanante;
    }

    public function saveMaintenance()
    {
        /**
         * Guardo la informaci�n de la habitaci�n para enviarla a mantenimiento
         */
        $mainPage = "ShelterAppShelter/board";
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $id = $this->security->xss_clean($this->input->post('id'));
            
            list ($fechaInicial, $fechaFinal) = explode(" - ", $this->security->xss_clean($this->input->post('periodo')));
            // Actualiz� fechas
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $habitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $cama = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            
            // Obtengo los id de las fechas
            $idFechaInicial = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", defineFormatoFecha($fechaInicial, FORMAT_DATE));
            $idFechaFinal = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", defineFormatoFecha($fechaFinal, FORMAT_DATE));
            
            $cantidad = $this->ShelterModel->selectQuantityFromShelter($idHabCama, $idFechaInicial, $idFechaFinal, "AND HP_HOGARPASO.ESTADO NOT IN ('" . SHELTER_FREE . "','" . SHELTER_MANT . "')");
            
            if ($cantidad == 0) {
                // Actualizo informaci�n
                $this->ShelterModel->updateShelterStateByDates($idHabCama, $idFechaInicial, $idFechaFinal, SHELTER_MANT, $this->session->userdata('usuario'));
                // Creo el resumen del mantenimiento
                $this->ShelterModel->insertShelterMaintenance($idHabCama, $idFechaInicial, $idFechaFinal, $this->session->userdata('usuario'));
                
                // Creo mensaje
                $mensaje = "maintenanceSuccess";
            } else {
                // Creo mensaje
                $mensaje = "maintenanceError";
            }
            
            $nombre = $habitacion . " - " . $cama;
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', $mensaje);
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function endMaintenance($id)
    {
        /**
         * Rutina para indicar la finalizaci�n del mantenimiento de una habitaci�n cama, dentro del hogar de paso.
         */
        $mainPage = "ShelterAppShelter/board";
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo el valor de la variable
            $id = $this->encryption->decrypt($id);
            $data['id'] = $id;
            // Obtengo el id Habcama
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $habitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $cama = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            $fecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", cambiaHoraServer(2));
            
            $datos = $this->ShelterModel->selectMaintenance($idHabCama, $fecha);
            foreach ($datos as $value) {
                // echo $value->ID;
                // Actualizo los valores en HP_HOGARPASO
                $fechaFin = $value->FECHAFIN;
                $condicion = "and HP_HOGARPASO.ESTADO='" . SHELTER_MANT . "'";
                $this->ShelterModel->updateShelterStateByDates($idHabCama, $fecha, $fechaFin, SHELTER_FREE, $this->session->userdata('usuario'), $condicion);
                
                // Inactivo el resumen de mantenimiento
                $this->FunctionsGeneral->updateByID("HP_MANTENIMIENTO", "ESTADO", INACTIVO_ESTADO, $value->ID, $this->session->userdata('usuario'));
            }
            
            $nombre = $habitacion . " - " . $cama;
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', 'endMaintenanceSuccess');
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function saveCheckIn()
    {
        /**
         * Rutina para guardar el ingreso del hu�sped al hogar de paso
         */
        $mainPage = "ShelterAppShelter/board";
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $id = $this->security->xss_clean($this->input->post('id'));
            $id = $this->encryption->decrypt($id);
            
            $dingreso = $this->security->xss_clean($this->input->post('dingreso'));
            $hingreso = $this->security->xss_clean($this->input->post('hingreso'));
            
            // Obtengo la informaci�n de la habitaci�n
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "ID_HABCAMA", $id);
            $idUsuario = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "ID_USUARIOHP", $id);
            // Obtengo fecha Final
            $fechaFinal = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "FIN", $id);
            
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $habitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $cama = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            // Actualizo informaci�n de la ocupaci�n del hogar de paso
            $dingreso = defineFormatoFecha($dingreso, FORMAT_DATE);
            $dingreso = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $dingreso);
            
            $this->ShelterModel->updateShelterStateByDates($idHabCama, $dingreso, $fechaFinal, SHELTER_FULL, $this->session->userdata('usuario'));
            // Actualizo la fecha y hora de llegada del hu�sped
            $this->ShelterModel->updateShelterCheckIn($id, $dingreso, $hingreso, $this->session->userdata('usuario'));
            
            // Actualizo el n�mero de la ocupaci�n
            $valor = $this->FunctionsGeneral->countMax('HP_USUARIOHP', 'OCUPACION', 1);
            $this->FunctionsGeneral->updateByID("HP_USUARIOHP", "OCUPACION", $valor, $idUsuario, $this->session->userdata('usuario'));
            
            $mensaje = "checkInOk";
            $nombre = $habitacion . " - " . $cama;
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', $mensaje);
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function saveCheckOut()
    {
        /**
         * Rutina para hacer el egreso del hu�sped del hogar de paso
         */
        $mainPage = "ShelterAppShelter/board";
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $id = $this->security->xss_clean($this->input->post('id'));
            $id = $this->encryption->decrypt($id);
            
            $degreso = $this->security->xss_clean($this->input->post('degreso'));
            $degreso = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $degreso);
            $hegreso = $this->security->xss_clean($this->input->post('hegreso'));
            
            // Obtengo la informaci�n de la habitaci�n
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "ID_HABCAMA", $id);
            $idUsuario = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "ID_USUARIOHP", $id);
            $fechaFinal = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "FIN", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $habitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $cama = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            
            // Actualizo la fecha y hora de llegada del hu�sped
            $this->ShelterModel->updateShelterCheckOut($id, $degreso, $hegreso, $this->session->userdata('usuario'));
            $this->FunctionsGeneral->updateByID("HP_USUARIOOCUPA", "ESTADO", CERRADO_ESTADO, $id, $this->session->userdata('usuario'));
            // Actualizo informaci�n de la ocupaci�n del hogar de paso
            $this->ShelterModel->updateShelterStateByDates($idHabCama, $degreso, $fechaFinal, SHELTER_FREE, $this->session->userdata('usuario'));
            
            $mensaje = "checkOutOk";
            $nombre = $habitacion . " - " . $cama;
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', $mensaje);
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function saveMoreTime()
    {
        /**
         * Rutina para guardar la prorroga de hospedaje de la habitaci�n
         */
        $mainPage = "ShelterAppShelter/board";
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $id = $this->security->xss_clean($this->input->post('id'));
            $id = $this->encryption->decrypt($id);
            
            // Datos de la nueva fecha
            $degreso = $this->security->xss_clean($this->input->post('degreso'));
            $degreso = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $degreso);
            
            $prorroga = $this->security->xss_clean($this->input->post('prorroga'));
            $prorroga = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $prorroga);
            
            $idHabCamaNueva = $this->security->xss_clean($this->input->post('relacion'));
            
            // Obtengo la informaci�n de la habitaci�n
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "ID_HABCAMA", $id);
            $ocupacion = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "ID_HABCAMA", $id);
            $idUsuario = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "ID_USUARIOHP", $id);
            $fechaFinal = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "FIN", $id);
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
            $habitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $cama = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            
            // Actualizo informaci�n de la ocupaci�n del hogar de paso
            $this->ShelterModel->updateShelterStateByDates($idHabCamaNueva, $prorroga, $degreso, SHELTER_FULL, $this->session->userdata('usuario'));
            // echo $idHabCamaNueva." ".$idHabCama;
            if ($idHabCamaNueva == $idHabCama) {
                // Se prorroga sobre la misma habitaci�n, y sobre la misma ocupaci�n
                $this->FunctionsGeneral->updateByID("HP_USUARIOOCUPA", "FIN", $degreso, $id, $this->session->userdata('usuario'));
            } else {
                // Se prorroga en una nueva habitaci�n
                $this->ShelterModel->insertShelterRelationWithUserDefinition($idUsuario, $idHabCamaNueva, $prorroga, $degreso, null, null, null, null, $this->session->userdata('usuario'));
            }
            
            $mensaje = "moreTimeShelterOk";
            $nombre = $habitacion . " - " . $cama;
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', $mensaje);
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }

    public function saveTraslateRoom()
    {
        /**
         * Rutina para guardar el traslado de la habitaci�n
         */
        $mainPage = "ShelterAppShelter/board";
        // Valido si la sessi�n existe en caso contrario saco al usuario
        $mainPage = "ShelterAppShelter/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Recibo los valores
            $id = $this->security->xss_clean($this->input->post('id'));
            $id = $this->encryption->decrypt($id);
            // Datos de la nueva fecha
            $egreso = $this->security->xss_clean($this->input->post('egreso'));
            $idHabCamaNueva = $this->security->xss_clean($this->input->post('relacion'));
            
            // Obtengo la informaci�n de la habitaci�n
            $idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "ID_HABCAMA", $id);
            $ocupacion = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "ID_HABCAMA", $id);
            $idUsuario = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "ID_USUARIOHP", $id);
            $fechaFinal = $this->FunctionsGeneral->getFieldFromTable("HP_USUARIOOCUPA", "FIN", $id);
            
            $fecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", cambiaHoraServer(2));
            $egreso = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $egreso);
            
            // Cierro ocupaci�n actual
            // Actualizo la fecha y hora de llegada del hu�sped
            $this->ShelterModel->updateShelterCheckOut($id, $fecha, date("H:i"), $this->session->userdata('usuario'));
            $this->FunctionsGeneral->updateByID("HP_USUARIOOCUPA", "ESTADO", CERRADO_ESTADO, $id, $this->session->userdata('usuario'));
            
            // Actualizo informaci�n de la ocupaci�n del hogar de paso para la nueva habitaci�n - cama
            $this->ShelterModel->updateShelterStateByDates($idHabCamaNueva, $fecha, $egreso, SHELTER_FULL, $this->session->userdata('usuario'));
            // Actualizo informaci�n de la ocupaci�n del hogar de paso para la antigua habitaci�n - cama
            $this->ShelterModel->updateShelterStateByDates($idHabCama, $fecha, $egreso, SHELTER_FREE, $this->session->userdata('usuario'));
            
            // Se debe hacer el nuevo registro dentro del nuevo cuarto - cama
            // Se prorroga en una nueva habitaci�n
            $this->ShelterModel->insertShelterRelationWithUserDefinition($idUsuario, $idHabCamaNueva, $fecha, $egreso, date("H:i"), $fecha, null, null, $this->session->userdata('usuario'));
            
            $idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCamaNueva);
            $idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCamaNueva);
            $habitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
            $cama = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);
            
            $mensaje = "traslateRoomOk";
            $nombre = $habitacion . " - " . $cama;
            // Pinto mensaje para retornar a la aplicaci�n
            $this->session->set_userdata('id', $nombre);
            $this->session->set_userdata('auxiliar', $mensaje);
            // Redirecciono la p�gina
            redirect(base_url() . $mainPage);
        } else {
            // Retorno a la p�gina principal
            header("Location: " . base_url());
        }
    }
}

?>