<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	06/02/2017
 Modificación:                	2019/11/06
 Propósito:						Página principal de la administración de la aplicación.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class SystemUserDefine extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        
        // Cargo modelos, librerias y helpers
        $this->load->model('Users');
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
        $mainPage = "SystemUserDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "SystemUserDefine/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, "myTable", null);
            // Pinto la información de los parametros de la aplicación
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            $data['mainPage'] = $mainPage;
            // Pinto los permisos del tablero de control
            $idModule = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
            $data['listaBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_LIST_PERMISSION);
            $data['botonesBoard'] = $this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'), 'board', $idModule, VIEW_BUTTON_PERMISSION);
            
            $usuRolper = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_USUROLPER", "ID_ROLPERFIL", "ID_USUARIO", $this->session->userdata('usuario'));
            $data['idPerfil'] = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_ROLPERFIL", "ID_PERFIL", "ID", $usuRolper);
            
            // Lista de listas
            $data['listaLista'] = $this->Users->getListUsers();
            
            // Pinto plantilla principal
            $this->load->view('system/userDefine/board', $data);
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

    public function newRegister()
    {
        /**
         * Formulario para crear un nuevo registro del parametro
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SystemUserDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage = "SystemUserDefine/board";
            $data = null;
            // Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
            
            /**
             * Información relacionada con la plantilla principal Pinto la pantalla *
             */
            
            // Inicializo variables de la vista
            $data['valida'] = $this->encryption->encrypt('newRegister');
            $data['id'] = null;
            $data['nombre'] = null;
            $data['apellido'] = null;
            $data['correo'] = null;
            $data['pagina'] = DEFAULT_PAGE;
            $data['tipo'] = null;
            $data['readOnly'] = null;
            $data['listaPadre'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PERFIL", 'DESC');
            // Cargo vista
            $this->load->view('system/userDefine/newUser', $data);
            // Cargo validación de formulario
            $this->load->view('validation/system/systemUserValidation');
            
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
         * Formulario para editar la información previamente creada para el parametro de la aplicación
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SystemUserDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            $id = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Pinto las vistas adicionales a través de la función showCommon del helper
                $mainPage = "SystemUserDefine/board";
                $data = null;
                // Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, null, null);
                
                /**
                 * Información relacionada con la plantilla principal Pinto la pantalla *
                 */
                
                // Inicializo variables de la vista
                $data['valida'] = $this->encryption->encrypt('edit');
                $data['id'] = $id;
                $data['readOnly'] = "readOnly='readOnly'";
                $data['correo'] = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "CORREO", $id);
                $data['pagina'] = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "PAGINA", $id);
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "NOMBRES", $id);
                $data['apellido'] = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "APELLIDOS", $id);
                $data['listaPadre'] = $this->FunctionsGeneral->selectValoresListaTabla("ADM_PERFIL", 'DESC');
                $tempo = $this->Users->getUsersProfile($id);
                $data['tipo'] = $tempo->ID_PERFIL;
                
                // Cargo vista
                $this->load->view('system/userDefine/newUser', $data);
                // Cargo validación de formulario
                $this->load->view('validation/system/systemUserValidation');
                
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
                redirect(base_url() . "ProfileDefine/board");
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function profile()
    {
        /**
         * Rutina para pintar el formulario del envio de correspondencia
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SystemUserDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Usuario logueado dentro del sistema
            $id = $this->session->userdata('usuario');
            if ($id != '') {
                $mainPage = "SystemUserDefine/board";
                // Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
                showCommon($this->session->userdata('auxiliar'), $this, $mainPage, 'profileUser');
                // Pinto la pantalla
                $data['mainPage'] = $mainPage;
                $data['id'] = $id;
                $data['nombre'] = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "NOMBRES", $id);
                $data['apellido'] = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "APELLIDOS", $id);
                $data['correo'] = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "CORREO", $id);
                // Cargo la lista de acciones
                $data['listaSiNo'] = $this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO', '1');
                $data['valorSINO'] = null;
                
                // Pinto plantilla
                $this->load->view('system/userDefine/userProfile', $data);
                
                // FIn de las plantillas
                $data['longitud'] = $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "LONGITUD", 1);
                $data['mayusculasId'] = $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "MAYUSCULAS", 1);
                $data['numerosId'] = $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "NUMEROS", 1);
                $data['especialesId'] = $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "ESPECIALES", 1);
                
                $this->load->view('validation/system/systemUserProfileValidation', $data);
                showCommonEnds($this, $mainPage, null);
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationUser");
                // Redirecciono la página
                redirect(base_url() . "SystemUsers/board");
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
         * Guardo la información del nuevo usuario creado dentro del sistema
         */
        $mainPage = "SystemUserDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida'))) == 'newRegister') {
                $id = $this->security->xss_clean($this->input->post('codigo'));
                if ($this->FunctionsGeneral->getQuantityFieldFromTable("ADM_USUARIO", "ID", $id) == 0) {
                    // Creo un nuevo usuario
                    // Guardo el contacto y retorno el respectivo ID
                    $this->session->set_userdata('temporal', cadenaAleatoria(1));
                    $hash = password_hash($this->session->userdata('temporal'), PASSWORD_BCRYPT);
                    $clave = $this->encryption->encrypt($hash);
                    $this->Users->insertUser($id, $this->security->xss_clean($this->input->post('nombre')), $this->security->xss_clean($this->input->post('apellido')), $this->security->xss_clean($this->input->post('correo')), $clave, $this->security->xss_clean($this->input->post('pagina')), $this->session->userdata('usuario'));
                    
                    // Creo los permisos respectivos
                    $idRolPer = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_ROLPERFIL", "ID", "ID_ROL", 1, "ID_PERFIL", $this->security->xss_clean($this->input->post('perfil')));
                    
                    $this->Users->insertUsuRolPer($id, $idRolPer, $this->session->userdata('usuario'));
                    
                    // Envio mensaje de creaciòn de usuario
                    $this->sendInformation($id, "sendInformationUser");
                } else {
                    // Creo mensaje de creaciòn de usuario
                    $mensaje = "existUser";
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $id);
                    $this->session->set_userdata('auxiliar', $mensaje);
                    // Redirecciono la página
                    redirect(base_url() . "SystemUserDefine/board");
                }
            } else {
                $id = $this->security->xss_clean($this->input->post('codigo'));
                // Actualizo la informaciòn del usuario
                $this->Users->updateUser($id, $this->security->xss_clean($this->input->post('nombre')), $this->security->xss_clean($this->input->post('apellido')), $this->security->xss_clean($this->input->post('correo')), $this->security->xss_clean($this->input->post('pagina')), $this->session->userdata('usuario'));
                // Actualizo el rol perfil
                $idRolPer = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_ROLPERFIL", "ID", "ID_ROL", 1, "ID_PERFIL", $this->security->xss_clean($this->input->post('perfil')));
                $this->Users->updateUsuRolPer($id, $idRolPer, $this->session->userdata('usuario'));
                // Pagina a donde retornará la información
                $mainPage = "SystemUserDefine/board";
                // Pinto mensaje para retornar a la aplicación
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', 'updateUser');
                // echo $message;
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
         * Rutina para pintar el formulario del envio de correspondencia
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SystemUserDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo información del Contacto teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                if ($id != $this->session->userdata('usuario')) {
                    $estado = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "ESTADO", $id);
                    if ($estado == 'S') {
                        $estado = 'N';
                        $message = 'changeStateUser';
                    } else if ($estado == 'N') {
                        $estado = 'S';
                        $message = 'changeStateUser';
                    } else {
                        $estado = 'I';
                        $message = 'changeStateUser2';
                    }
                    $this->FunctionsGeneral->updateByID("ADM_USUARIO", "ESTADO", $estado, $id, $this->session->userdata('usuario'));
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $id);
                    $this->session->set_userdata('auxiliar', $message);
                    // Redirecciono la página
                    redirect(base_url() . "SystemUserDefine/board");
                } else {
                    // Pinto mensaje para retornar a la aplicación
                    $this->session->set_userdata('id', $id);
                    $this->session->set_userdata('auxiliar', 'changeStateUser3');
                    // Redirecciono la página
                    redirect(base_url() . "SystemUserDefine/board");
                }
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationUser");
                // Redirecciono la página
                redirect(base_url() . "SystemUserDefine/board");
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function changePassword($id)
    {
        /**
         * Rutina para pintar el formulario del envio de correspondencia
         */
        // Valido si la sessión existe en caso contrario saco al usuario
        $mainPage = "SystemUserDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Cargo información del Contacto teniendo en cuenta el id dado
            // Obtengo el id del contacto
            $id = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "ID", $this->encryption->decrypt($id));
            if ($id != '') {
                // Cargo en sesión la clave
                $this->session->set_userdata('temporal', cadenaAleatoria(1));
                $hash = password_hash($this->session->userdata('temporal'), PASSWORD_BCRYPT);
                $clave = $this->encryption->encrypt($hash);
                $this->FunctionsGeneral->updateByID("ADM_USUARIO", "CLAVE", $clave, $id, $this->session->userdata('usuario'));
                $this->FunctionsGeneral->updateByID("ADM_USUARIO", "ESTADO", 'I', $id, $this->session->userdata('usuario'));
                // Envio mensaje de creaciòn de usuario
                $this->sendInformation($id, "sendInformationUser2");
            } else {
                // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                $this->session->set_userdata('id', $id);
                $this->session->set_userdata('auxiliar', "notInformationUser");
                // Redirecciono la página
                redirect(base_url() . "SystemUserDefine/board");
            }
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }

    public function rememberPassword()
    {
        /**
         * El propósito de esta funciòn es realizar el cambio de contraseña cuando el usuario lo ha olvidado
         */
        $email = $this->security->xss_clean($this->input->post('email'));
        // Obtengo usuario con el correo electrónico ingresado
        $usuario = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_USUARIO", "ID", "CORREO", $email);
        if ($usuario != '') {
            // Si existe un correo electrónico
            $this->session->set_userdata('temporal', cadenaAleatoria(1));
            $hash = password_hash($this->session->userdata('temporal'), PASSWORD_BCRYPT);
            $clave = $this->encryption->encrypt($hash);
            $this->FunctionsGeneral->updateByID("ADM_USUARIO", "CLAVE", $clave, $usuario, $usuario);
            $this->FunctionsGeneral->updateByID("ADM_USUARIO", "ESTADO", 'I', $usuario, $usuario);
            // Envio mensaje de creaciòn de usuario
            $this->sendInformation($usuario, "sendInformationUser3");
        } else {
            // Redirecciono la página
            $redirect = "Home/emailNotExist";
            redirect(base_url() . $redirect);
        }
    }

    public function sendInformation($id, $type, $message = null, $validate = null)
    {
        /**
         * Envio la información correspondiente a los correos respectivos
         */
        // Envio correo electrónico si esta activa la costante
        if ($type == 'sendInformationUser') {
            $message = 'saveUser';
            // Pagina a donde retornará la información
            $mainPage = "SystemUserDefine/board";
        } else if ($type == 'sendInformationUser2') {
            $message = 'passwordChange';
            // Pagina a donde retornará la información
            $mainPage = "SystemUserDefine/board";
        } else if ($type == 'sendInformationUser3') {
            $message = 'passwordChange';
            // Pagina a donde retornará la información
            $mainPage = "Home/passwordChange";
        }
        
        if ($validate != 2) {
            if (CTE_CORREO_ELECTRONICO) {
                // 1. Envio información al correo respectivo
                if ($validate == null) {
                    $type = $type;
                    $redirect = "Mailer/sendEmail/" . $type . "/" . $id . "/2";
                    redirect(base_url() . $redirect);
                }
            }
        }
        // Pinto mensaje para retornar a la aplicación
        $this->session->set_userdata('id', $id);
        $this->session->set_userdata('auxiliar', $message);
       //  echo $message;
        // Redirecciono la página
        redirect(base_url() . $mainPage);
    }

    public function saveProfile()
    {
        /**
         * Guardo la información de los cambios realizados del usuario
         */
        $mainPage = "SystemUserDefine/board";
        if ($this->FunctionsAdmin->validateSession($mainPage)) {
            // Actualizo el valor
            $id = $this->session->userdata('usuario');
            // Actualizo la informaciòn del usuario
            $this->Users->updateUser($id, $this->security->xss_clean($this->input->post('nombre')), $this->security->xss_clean($this->input->post('apellido')), $this->security->xss_clean($this->input->post('correo')), null, $this->session->userdata('usuario'));
            
            if ($this->security->xss_clean($this->input->post('valida')) == 1) {
                // Se debe hacer el cambio de contraseña
                $fila = $this->Users->getUsersCondition($id);
                // Obtengo el hash
                $fila->CLAVE = $this->encryption->decrypt($fila->CLAVE);
                $clave = $this->security->xss_clean($this->input->post('password'));
                // echo $fila->CLAVE." ".$clave;
                $nuevaVerifica = $this->security->xss_clean($this->input->post('nueva'));
                
                if (password_verify($clave, $fila->CLAVE)) {
                    $historico = $this->Users->getClaveUsuarioHistorico($id);
                    if (verificaHistorioClave($clave, $fila->CLAVE, $nuevaVerifica, $id, $this, 1)) {
                        // No existe en el histórico
                        // Actualizo la contraseña
                        $ciphertext = password_hash($nuevaVerifica, PASSWORD_BCRYPT);
                        // Cifro la nueva clave
                        $nueva = $this->encryption->encrypt($ciphertext);
                        $this->FunctionsGeneral->updateByID("ADM_USUARIO", "CLAVE", $nueva, $id, $id);
                        // Actualizo la fecha de cambio
                        $this->FunctionsGeneral->updateByID("ADM_USUARIO", "FCCON", cambiaHoraServer(2), $id, $id);
                        // Verifico cantidad en el historico
                        if (count($historico) == $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "HISTORICO", 1)) {
                            // Debo eliminar el registro más viejo
                            $this->Users->deletePswHistory(SERVER_NUMBER);
                        }
                        // Guardo el historico de la nueva contraseña
                        $this->Users->insertUserHistoryPsw($id, $this->encryption->encrypt($nuevaVerifica));
                        // Se informa del cambio correcto
                        $mensaje = 'updatePsswUser';
                        $redirect = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "PAGINA", $id);
                    } else {
                        // Existe en el historico no se realiza el cambio
                        $mensaje = 'pswHistory';
                        $redirect = 'SystemUserDefine/profile';
                    }
                } else {
                    // Se informa que la contraseña anterior contiene errores
                    $mensaje = 'errorPassword';
                    $redirect = 'SystemUserDefine/profile';
                }
            } else {
                // Se informa del cambio correcto
                $mensaje = 'updateUser';
                $redirect = $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "PAGINA", $id);
            }
            // Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
            $this->session->set_userdata('id', $id);
            $this->session->set_userdata('auxiliar', $mensaje);
            // Redirecciono la página
            redirect(base_url() . $redirect);
        } else {
            // Retorno a la página principal
            header("Location: " . base_url());
        }
    }
}
?>