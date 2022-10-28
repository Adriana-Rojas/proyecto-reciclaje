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

class SystemPermissionsDefine extends CI_Controller {


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
        $mainPage="SystemPermissionsDefine/board";
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
            //Pinto las vistas adicionales a través de la función pintaComun del helper hospitium
            $mainPage="SystemPermissionsDefine/board";
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
            $condicion="and ADM_MODULO.PAGINA !='---'";
            $data['listaLista']=$this->SystemModel->getListModulos($condicion);
           
           
           
            //Pinto plantilla principal
            $this->load->view('system/permissionDefine/board',$data);
            /** Fin: Información relacionada con la plantilla principal Pinto la pantalla*/
           
            //Pinto el final de la página (páginas internas)
            showCommonEnds($this,null,null);
        }else{
            //Retorno a la página principal
            header("Location: ". base_url());
        }
    }
   
 public function editPermissions($id){
        /**Formulario para pintar la inscripción de polizas del soat*/
        //Valido si la sessión existe en caso contrario saco al usuario
        $mainPage="SystemPermissionsDefine/board";
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
            $id=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID",$this->encryption->decrypt($id));
            if ($id!=''){
                $mainPage="SystemPermissionsDefine/board";
               
                $data=null;
                //Pinto la cabecera principal de las páginas internas
                showCommon($this->session->userdata('auxiliar'),$this,$mainPage,null,null);
               
                /** Información relacionada con la plantilla principal Pinto la pantalla    **/
               
                //Inicializo variables de la vista
                $data['valida']=$this->encryption->encrypt('editModule');
                $data['id']=$this->encryption->encrypt($id);
                $data['idModulo']=$id;
                $idTipo=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID_TIPO",$id);
                $data['tipo']=$this->FunctionsGeneral->getFieldFromTable("ADM_DETLISTA","NOMBRE",$idTipo);
                $data['tipoMod']=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID_TIPOMOD",$id);
                $idModulo=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID_MODULO",$id);
                $data['principal']=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODNOMBRE","NOMBRE","ID_MODULO",$idModulo);
                $data['nombre']=$this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODNOMBRE","NOMBRE","ID_MODULO",$id);
                //Traigo la información de los perfiles
                $data['listaPerfil']=$this->FunctionsGeneral->selectValoresListaTabla("ADM_PERFIL");
//Listas adicionales
                $data['listaSiNo']=$this->FunctionsAdmin->selectValoresListaAdministracion('SI_NO','1');
                //Paginas siguiente o anteriores
                $data['pagina']="SystemPermissionsDefine/savePermissions";
                $data['mainPage']=$mainPage;
                 
                //Cargo vista
                $this->load->view('system/permissionDefine/formPermissionDefine',$data);
                // Cargo validación de formulario
                $this->load->view('validation/orders/configuration/ordersConfigurationElementGroupValidation');
               
                /** Fin: Información relacionada con la plantilla principal Pinto la pantalla*/
               
                //Pinto el final de la página (páginas internas)
                showCommonEnds($this,null,null);
                       
            }else{
                //Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
                 $this->session->set_userdata('id', $id);
                 $this->session->set_userdata('auxiliar', "notInformationGeneral");
                 //Redirecciono la página
                 redirect(base_url()."SystemPermissionsDefine/board");    
            }
           
        }else{
            //Retorno a la página principal
            header("Location: ". base_url());
        }
    }
   
    /** ***********************************************************************************************************
      RUTINAS PARA GUARDAR INFORMACIÒN
     ******************************************************************************************************* **/
   
    public function savePermissions(){
    /** Guardo la información del nuevo usuario creado dentro del sistema*/
   
    $mainPage="SystemPermissionsDefine/board";
if ($this->FunctionsAdmin->validateSession ( $mainPage )) {
    $id=$this->encryption->decrypt($this->security->xss_clean($this->input->post('id')));
    $nombre=$this->FunctionsGeneral->
    getFieldFromTableNotId("ADM_MODNOMBRE","NOMBRE","ID_MODULO",$id);
    if ($nombre!=''){
    //Elimino relaciones definidas con anticipación
    $this->SystemModel->deletePermissions($id);
   
    //Obtengo el id principal del modulo que contiene la información
    $idPadre=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID_MODULO",$id);

    //Principal cuando hay más de uno
    $idAbuelo=$this->FunctionsGeneral->getFieldFromTable("ADM_MODULO","ID_MODULO",$idPadre);
   
    //Creo las nuevas relaciones
    $perfiles=$this->FunctionsGeneral->selectValoresListaTabla("ADM_PERFIL");
    foreach($perfiles->result() as $valuePerfil){
    $tempo='perfil'.$valuePerfil->ID;
    //Obtengo el rol perfil
    $rolPerfil=$this->FunctionsGeneral->getFieldFromTableNotIdFields(
    "ADM_ROLPERFIL",
    "ID",
    "ID_PERFIL",
    $valuePerfil->ID,
    "ID_ROL",
    1);
   
   
    if($this->security->xss_clean($this->input->post($tempo))==CTE_VALOR_SI){
    //echo "Rolperfil: ".$rolPerfil," Abuelo: ",$idAbuelo." Padre:",$idPadre." ID:",$id."<br>";
    //Verifico si existe el abuelo
    if($idAbuelo!=''){
    if ($this->FunctionsGeneral->getQuantityFieldFromTable("ADM_MODROLPER","ID_MODULO",$idAbuelo,"ID_ROLPERFIL",$rolPerfil)==0){
    //Inserto el registro abuelo
    $this->SystemModel->insertModuleProfile($idAbuelo,
    $rolPerfil,
    $this->session->userdata('usuario'));
    }else{
    //Actualizo estado
    $this->FunctionsGeneral->updateByField("ADM_MODROLPER",
    "ESTADO",
    ACTIVO_ESTADO,
    "ID_MODULO",
    $idAbuelo,
    $this->session->userdata('usuario'),
    "ID_ROLPERFIL",
    $rolPerfil);
    }
    }
    if($idPadre!=''){

    //Verifico si existe el padre
    if ($this->FunctionsGeneral->getQuantityFieldFromTable("ADM_MODROLPER","ID_MODULO",$idPadre,"ID_ROLPERFIL",$rolPerfil)==0){
    //Inserto el registro padre
    $this->SystemModel->insertModuleProfile($idPadre,
    $rolPerfil,
    $this->session->userdata('usuario'));
    }else{
    //Actualizo estado
    $this->FunctionsGeneral->updateByField("ADM_MODROLPER",
    "ESTADO",
    ACTIVO_ESTADO,
    "ID_MODULO",
    $idPadre,
    $this->session->userdata('usuario'),
    "ID_ROLPERFIL",
    $rolPerfil);
    }
    }
    //Inserto el registro hijo
    $this->SystemModel->insertModuleProfile($id,
    $rolPerfil,
    $this->session->userdata('usuario'));
    }else{
    //Tengo el padre y el abuelo debo verificar si puedo eliminar relaciones de ellos
    $condicion="and ADM_MODULO.ID_MODULO='".$idPadre."'";
    $modulosPadre=$this->SystemModel->getListModulos($condicion);
    $cantidad=0;
                        if($modulosPadre!=null){
        foreach ($modulosPadre as $modulo){
        //Verifico si existe relación
        if ($this->FunctionsGeneral->getQuantityFieldFromTable("ADM_MODROLPER","ID_MODULO",$modulo->ID,"ID_ROLPERFIL",$rolPerfil)>0){
        $cantidad++;
        }
        }
                        }
    if ($cantidad==0){
    //No existe relación de los modulos hijos con el perfil
    $this->SystemModel->deletePermissionsModuleRol($idPadre,$rolPerfil);
    }
   
    $condicion="and ADM_MODULO.ID_MODULO='$idAbuelo'";
    $modulosAbuelo=$this->SystemModel->getListModulos($condicion);
    $cantidad=0;
                        if($modulosAbuelo!=null){
    foreach ($modulosAbuelo as $modulo){
    //Verifico si existe relación
    if ($this->FunctionsGeneral->getQuantityFieldFromTable("ADM_MODROLPER","ID_MODULO",$modulo->ID,"ID_ROLPERFIL",$rolPerfil)>0){
    $cantidad++;
    }
    }
                        }
    if ($cantidad==0){
    //No existe relación de los modulos hijos con el perfil
    $this->SystemModel->deletePermissionsModuleRol($idAbuelo,$rolPerfil);
    }
   
    }
    }
    //Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
    $this->session->set_userdata('id', $nombre);
    $this->session->set_userdata('auxiliar', "permissionsOk");
    //Redirecciono la página
    redirect(base_url()."SystemPermissionsDefine/board");
    }else{
    //Pinto mensaje para retornar a la aplicación informando que no hay información para la consulta realizada
    $this->session->set_userdata('id', $id);
    $this->session->set_userdata('auxiliar', "notInformationGeneral");
    //Redirecciono la página
    redirect(base_url()."SystemPermissionsDefine/board");
    }
   
   
   
    }else{
    //Retorno a la página principal
    header("Location: ". base_url());
    }
    }
   
}
?>