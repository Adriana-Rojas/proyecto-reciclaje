<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electrónico:           jcescobarba@gmail.com
 Creación:                     27/02/2018
 Modificación:                 2019/11/06
 Propósito: Controlador para visualizar el manejo de los módulos entro de la aplicación Perfiles (sistema).
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2017 *******************************
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class SystemProfileDefine extends CI_Controller {


 public function __construct()
    {
        parent::__construct();

        //Cargo modelos, librerias y helpers
$this->load->model('SystemModel');
    }
   
    /** ***********************************************************************************************************
    RUTINAS PARA PINTAR FORMULARIOS
        ******************************************************************************************************* **/
public function board(){
        /** Panel principal en donde se listarán los diferentes registros creados para el parametro al cual se ha ingresado*/
        //Valido si la sessión existe en caso contrario saco al usuario
        $mainPage="SystemProfileDefine/board";
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
            //Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage="SystemProfileDefine/board";
            $data=null;
            //Pinto la cabecera principal de las páginas internas
            showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
            //Pinto la información de los parametros de la aplicación
           
            /** Información relacionada con la plantilla principal Pinto la pantalla    **/
           
            $data['mainPage']=$mainPage;
            //Pinto los permisos del tablero de control
            $idModule=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO","ID","PAGINA",$mainPage);
            $data['listaBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'board',$idModule,VIEW_LIST_PERMISSION) ;
            $data['botonesBoard']=$this->FunctionsAdmin->selectSubModulesUserBoard($this->session->userdata('usuario'),'board',$idModule,VIEW_BUTTON_PERMISSION) ;
           
            $usuRolper=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_USUROLPER","ID_ROLPERFIL","ID_USUARIO",$this->session->userdata('usuario'));
            $data['idPerfil']=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_ROLPERFIL","ID_PERFIL","ID",$usuRolper);
           
            //Lista de listas
            $data['listaLista']=$this->FunctionsGeneral->selectValoresListaTabla("ADM_PERFIL");
           
           
            //Pinto plantilla principal
            $this->load->view('system/profileDefine/board',$data);
            /** Fin: Información relacionada con la plantilla principal Pinto la pantalla*/
           
            //Pinto el final de la página (páginas internas)
            showCommonEnds($this,null,null);
        }else{
            //Retorno a la página principal
            header("Location: ". base_url());
        }
    }
   
    public function newProfile(){
    /**Formulario para crear un nuevo registro del parametro*/
    //Valido si la sessión existe en caso contrario saco al usuario
    $mainPage="SystemProfileDefine/board";
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    //Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
    $mainPage="SystemProfileDefine/board";
    $data=null;
    //Pinto la cabecera principal de las páginas internas
    showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
   
    /** Información relacionada con la plantilla principal Pinto la pantalla    **/
           
            //Inicializo variables de la vista
    $data['valida']=$this->encryption->encrypt('newProfile');
    $data['id']=null;
    $data['nombre']=null;
    //Cargo vista
    $this->load->view('system/profileDefine/newProfile',$data);
    // Cargo validación de formulario
    $this->load->view('validation/system/systemProfileValidation');
   
    /** Fin: Información relacionada con la plantilla principal Pinto la pantalla*/
   
    //Pinto el final de la página (páginas internas)
            showCommonEnds($this,null,null);
    }else{
    //Retorno a la página principal
    header("Location: ". base_url());
    }
    }
   
    public function editProfile($id){
    /**Formulario para editar la información previamente creada para el parametro de la aplicación */
    //Valido si la sessión existe en caso contrario saco al usuario
    $mainPage="SystemProfileDefine/board";
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    $id=$this->FunctionsGeneral->getFieldFromTable("ADM_PERFIL","ID",$this->encryption->decrypt($id));
    if ($id!=''){
    //Pinto las vistas adicionales a través de la función showCommon del helper
    $mainPage="SystemProfileDefine/board";
    $data=null;
    //Pinto la cabecera principal de las páginas internas
    showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
   
    /** Información relacionada con la plantilla principal Pinto la pantalla    **/
   
    //Inicializo variables de la vista
    $data['valida']=$this->encryption->encrypt('editProfile');
    $data['id']=$this->encryption->encrypt($id);
    $data['nombre']=$this->FunctionsGeneral->getFieldFromTable("ADM_PERFIL","NOMBRE",$id);
    //Cargo vista
    $this->load->view('system/profileDefine/newProfile',$data);
    // Cargo validación de formulario
    $this->load->view('validation/system/systemProfileValidation');
   
    /** Fin: Información relacionada con la plantilla principal Pinto la pantalla*/
   
    //Pinto el final de la página (páginas internas)
    showCommonEnds($this,null,null);
   
    }else{
    //Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
    $this->session->set_userdata('id', $id);
    $this->session->set_userdata('auxiliar', "notInformationGeneral");
    //Redirecciono la página
    redirect(base_url()."ProfileDefine/board");
    }
   
    }else{
    //Retorno a la página principal
    header("Location: ". base_url());
    }
    }
   
    /** ***********************************************************************************************************
      RUTINAS PARA GUARDAR INFORMACIÒN
     ******************************************************************************************************* **/
   
   
    public function saveProfile(){
    /** Guardo la información del parametro, para lo cual se puede crear o actualizar la misma dependiendo el valor que se reciba dentro de la variable valida*/
    $mainPage="SystemProfileDefine/board";
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    // Página principal a donde debo retornar
    $mainPage="SystemProfileDefine/board";
   
    $nombre=$this->security->xss_clean($this->input->post('nombre'));
    if ($this->encryption->decrypt($this->security->xss_clean($this->input->post('valida')))=='newProfile'){
    if ($this->FunctionsGeneral->getQuantityFieldFromTable("ADM_PERFIL","NOMBRE",$nombre)==0){
    //Creo el encabezado de la lista
    $id=$this->SystemModel->insertProfile($nombre,
    $this->session->userdata('usuario'));
    //Creo la relación del perfil con el rol empresa
    $this->SystemModel->insertProfileRol($id,1, $this->session->userdata('usuario'));
    //Pinto mensaje para retornar a la aplicación
    $this->session->set_userdata('id', $nombre);
    $this->session->set_userdata('auxiliar','configUpdate');
    //Redirecciono la página
    redirect(base_url().$mainPage);
    }else{
    //Creo mensaje de creaciòn de usuario
    $mensaje="ConfigExist";
    //Pinto mensaje para retornar a la aplicación
    $this->session->set_userdata('id', $nombre);
    $this->session->set_userdata('auxiliar',$mensaje);
    //Redirecciono la página
    redirect(base_url().$mainPage);
    }
    }else{
    //Actualizo los valores
    $this->SystemModel->updateProfile(
    $this->encryption->decrypt($this->security->xss_clean($this->input->post('id'))),
    $nombre,
    $this->session->userdata('usuario'));
    //Pinto mensaje para retornar a la aplicación
    $this->session->set_userdata('id', $nombre);
    $this->session->set_userdata('auxiliar','configUpdate');
    //Redirecciono la página
    redirect(base_url().$mainPage);
    }
    }else{
    //Retorno a la página principal
    header("Location: ". base_url());
    }
    }
   
    public function inactiveProfile ($id){
    /** Inactivo el registro para el cual se tiene asociado el valor $id*/
   
    //Valido si la sessión existe en caso contrario saco al usuario
    $mainPage="SystemProfileDefine/board";
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    // Página principal a donde debo retornar
    $mainPage="SystemProfileDefine/board";
   
    //Cargo información de la lista teniendo en cuenta el id dado
    //Obtengo el id del contacto
    $id=$this->FunctionsGeneral->getFieldFromTable("ADM_PERFIL","ID",$this->encryption->decrypt($id));
    if ($id!=''){
    $estado=$this->FunctionsGeneral->getFieldFromTable("ADM_PERFIL","ESTADO",$id);
    if($estado=='S'){
    $estado='N';
   
    }else if($estado=='N'){
    $estado='S';
    }
    $message='changeStateGeneral';
    $this->FunctionsGeneral->updateByID(
    "ADM_PERFIL",
    "ESTADO",
    $estado,
    $id,
    $this->session->userdata('usuario'));
    //Pinto mensaje para retornar a la aplicación
    $this->session->set_userdata('id', $id);
    $this->session->set_userdata('auxiliar',$message);
    //Redirecciono la página
    redirect(base_url().$mainPage);
    }else{
    //Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
    $this->session->set_userdata('id', $id);
    $this->session->set_userdata('auxiliar', "notInformationGeneral");
    //Redirecciono la página
    redirect(base_url().$mainPage);
    }
    }else{
    //Retorno a la página principal
    header("Location: ". base_url());
    }
    }
   
}
?>
