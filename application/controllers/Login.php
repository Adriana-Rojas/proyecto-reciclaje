<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						Controlador en elcual se valida el logueo de la aplicaci�n y todas las funciones
 respectivas al manejo de la sesi�n dentro de la aplicaci�n.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2018 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Cargo modelos y librerias
        // $this->load->model('Users');
        // Cargo una cookie para verificar que si esta logueado
        $this->load->helper('cookie');
    }

    public function index()
    {
        /**
         * El prop�sito de esta funci�n es obtener los datos ingresados por parte del formulario,
         * se valida la informaci�n con el helper de security y se validan estos datos si existe el usuario dentro del sistema.
         * Cuando la informaci�n es correcta se crea una sesi�n para el usuario y se redirecciona a la pantalla Principal del sistema.
         * En caso contrario se redirecciona al home de la aplicaci�n (logueo nuevamente)
         */
        $usuario = $this->security->xss_clean($this->input->post('username'));
        $clave = $this->security->xss_clean($this->input->post('password'));
        
        // Verifico la cantidad de registros creados para el usuario $usuario
        
        $cantidad = $this->FunctionsGeneral->getQuantityFieldFromTable("ADM_USUARIO", "ID", $usuario);
        
        if ($cantidad > 0) {
            // Existe un usuario se validar� la contrase�a
            // Tomo los datos del usuario
            $fila = $this->Users->getUsersCondition($usuario);
            if ($fila!=null) {
                // Descifro la contrase�a y obtengo el hash
                $fila->CLAVE = $this->encryption->decrypt($fila->CLAVE);
                // Verifico la clave respectiva
                if (password_verify($clave, $fila->CLAVE)) {
                    if ($fila->ESTADO == 'S') {
                        // Verifico la fecha del sistema Vs la �ltima fecha de cambio de la contrase�a
                        
                        /*
                         * echo $fila->FCCON." ".cambiaHoraServerInverso(1)." ".intervaloTiempo($fila->FCCON,cambiaHoraServerInverso(1),86400)." ".
                         * $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS","DURACION",1);
                         */
                        
                        if (intervaloTiempo($fila->FCCON, cambiaHoraServer(2), 86400) < $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "DURACION", 1)) {
                            // TODO Creo el arreglo de la cookie para continuar: Definir variables que correspondan
                            $data = array(
                                'usuario' => $usuario,
                                'login' => 'SI',
                                'id' => 0,
                                'pagina' => '',
                                'action' => '',
                                'proceso' => '',
                                'tipoOrden' => '',
                                'encOrden' => '',
                                'convenio' => '',
                                'brigada' => '',
                                'auxiliar' => '',
                                'variable1' => '',
                                'variable2' => '',
                                'variable3' => '',
                                'temporal' => ''
                            );
                            // Actualizo la fecha del ultimo ingreso
                            $this->FunctionsGeneral->updateByID("ADM_USUARIO", "FUING", cambiaHoraServer(), $usuario, $usuario);
                            // Realizo el insert del hist�rico de ingreso
                            $this->Users->insertUserHistory($usuario, getOriginIP());
                            $this->session->set_userdata($data);
                            // Cargo el nombre del usuario actual --> en este controlador estar� dentro de la funcion index,
                            // en los otros estar� dentro del constructor.
                            $usuarioSession = $this->Users->getNombresUsuario($this->session->userdata('usuario'));
                            // Cargo la p�gina a la cual se redireccionar� el usuario
                            header("Location: " . base_url() . $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "PAGINA", $this->session->userdata('usuario')));
                        } else {
                            // Redirecciono para cambio de clave
                            $redirect = "Home/changePassword/" . $this->encryption->encrypt($usuario) . "/" . $this->encryption->encrypt('1');
                            redirect(base_url().$redirect);
                        }
                    } else if ($fila->ESTADO == 'I') {
                        // Redirecciono para cambio de clave
                        $redirect = "Home/changePassword/" . $this->encryption->encrypt($usuario);
                        // echo ;
                        redirect(base_url() . $redirect);
                    }
                } else {
                    // La contrase�a es incorrecta
                    $redirect = "Home/passwordError/";
                    redirect(base_url() . $redirect);
                }
            } else {
                // Usuario inactivo
                $redirect = "Home/inactiveUser/";
                redirect(base_url() . $redirect);
            }
        } else {
            // El usuario no existe
            $redirect = "Home/errorUser/";
            redirect(base_url() . $redirect);
        }
    }

    public function changePassword()
    {
        /**
         * El prop�sito de esta funci�n es realizar el cambio de contrase�a y a su vez activar el usaurio para el ingreso al sistema
         */
        $usuario = $this->security->xss_clean($this->input->post('username'));
        // Tengo el hash de la clave anterior
        $clave = $this->security->xss_clean($this->input->post('password'));
        // Obtengo el Hash para la nueva clave
        $nuevaVerifica = $this->security->xss_clean($this->input->post('nueva'));
        $ciphertext = password_hash($nuevaVerifica, PASSWORD_BCRYPT);
        // Cifro la nueva clave
        $nueva = $this->encryption->encrypt($ciphertext);
        
        $fila = $this->Users->getUsersCondition($usuario);
        // Descifro la contrase�a y obtengo el hash
        $fila->CLAVE = $this->encryption->decrypt($fila->CLAVE);
        // echo $clave." ".$fila->CLAVE;
        if ($fila != null) {
            // Verifico hashes
            if ($clave == $fila->CLAVE) {
                $historico = $this->Users->getClaveUsuarioHistorico($usuario);
                
                if (verificaHistorioClave($clave, $fila->CLAVE, $nuevaVerifica, $usuario, $this, 2)) {
                    // Realizo el cambio de la contrase�a
                    $this->FunctionsGeneral->updateByID("ADM_USUARIO", "CLAVE", $nueva, $usuario, $usuario);
                    $this->FunctionsGeneral->updateByID("ADM_USUARIO", "ESTADO", 'S', $usuario, $usuario);
                    // Actualizo la fecha de cambio
                    $this->FunctionsGeneral->updateByID("ADM_USUARIO", "FCCON", cambiaHoraServer(2), $usuario, $usuario);
                    // Verifico cantidad en el historico
                    if (count($historico) == $this->FunctionsGeneral->getFieldFromTable("ADM_PARAMETROS", "HISTORICO", 1)) {
                        // Debo eliminar el registro m�s viejo
                        $this->Users->deletePswHistory(SERVER_NUMBER);
                    }
                    // Guardo el historico de la nueva contrase�a, no el Hash
                    $this->Users->insertUserHistoryPsw($usuario, $this->encryption->encrypt($nuevaVerifica));
                    // Realizo el ingreso al sistema
                    // Creo el arreglo de la cookie para continuar
                    $data = array(
                        'usuario' => $usuario,
                        'login' => 'SI',
                        'id' => 0,
                        'pagina' => '',
                        'action' => '',
                        'proceso' => '',
                        'tipoOrden' => '',
                        'encOrden' => '',
                        'convenio' => '',
                        'brigada' => '',
                        'auxiliar' => '',
                        'variable1' => '',
                        'variable2' => '',
                        'variable3' => '',
                        'temporal' => ''
                    );
                    // Actualizo la fecha del ultimo ingreso
                    $this->FunctionsGeneral->updateByID("ADM_USUARIO", "FUING", cambiaHoraServer(), $usuario, $usuario);
                    // Realizo el insert del hist�rico de ingreso
                    $this->Users->insertUserHistory($usuario, getOriginIP());
                    $this->session->set_userdata($data);
                    // Cargo el nombre del usuario actual --> en este controlador estar� dentro de la funcion index,
                    // en los otros estar� dentro del constructor.
                    $usuarioSession = $this->Users->getNombresUsuario($this->session->userdata('usuario'));
                    $mainPage = "MainApp/board";
                    // Pinto mensaje para retornar a la aplicaci�n
                    $this->session->set_userdata('id', $this->session->userdata('usuario'));
                    $this->session->set_userdata('auxiliar', 'passwordChange');
                    // Redirecciono la p�gina
                    redirect(base_url() . $this->FunctionsGeneral->getFieldFromTable("ADM_USUARIO", "PAGINA", $this->session->userdata('usuario')));
                } else {
                    // Redirecciono la p�gina
                    $redirect = "Home/pswHistory";
                    redirect(base_url() . $redirect);
                }
            } else {
                header("Location: " . base_url());
            }
        } else {
            header("Location: " . base_url());
        }
    }

    public function logOut()
    {
        /**
         * Funcion para cerrar la sesi�n del usuario dentro del sistema
         */
        $this->session->sess_destroy();
        header("Location: " . base_url());
    }
}

?>
