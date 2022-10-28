<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electrónico:         jcescobarba@gmail.com
  Creación:                  27/02/2018
 Modificación:               2019/11/06
 Propósito:                  Clase en las cuales se definen las operaciones CRUD frente a las tablas que tienen relación con la aplicación Sistema y todos sus módulos
*/

class SystemModel extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	/* ---------------------------------------------------------- INSERT ---------------------------------------------------------*/
    
	public function insertEncList($nombre, $usuario){
		/** Se inserta la información de la tabla ADM_ENCLISTA*/
		
		//Obtiene el siguiente ID
		$consecutivo =$this->FunctionsGeneral->countMax('ADM_ENCLISTA','ID',1);
		$data = array(
				'ID' => $consecutivo,
				'NOMBRE' => $nombre,
				'ESTADO' => 'S',
				'UCREA' => $usuario,
				'FCREA' => cambiaHoraServer(),
				'UMOD' => $usuario,
				'FMOD' => cambiaHoraServer()
		);
		//Realizo el insert sobre la base de datos en la tabla ADM_ENCLISTA
		$this->db->insert('ADM_ENCLISTA', $data);
        return $consecutivo;
	}
    
    public function insertDetList($idEncList,$idioma,$valor,$nombre, $usuario){
        /** Se inserta la información de la tabla ADM_DETLISTA*/
    	
    	//Obtiene el siguiente ID
    	$consecutivo =$this->FunctionsGeneral->countMax('ADM_DETLISTA','ID',1);
    	$data = array(
        		'ID' => $consecutivo,
                'NOMBRE' => $nombre,
                'VALOR' => $valor,
                'ID_IDIOMA' => $idioma,
                'ID_ENCLISTA' => $idEncList,
                'ESTADO' => 'S',
                'UCREA' => $usuario,
                'FCREA' => cambiaHoraServer(),
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el insert sobre la base de datos en la tabla ADM_DETLISTA
        $this->db->insert('ADM_DETLISTA', $data);
        return $consecutivo;
    }
    
    public function insertEncMessage($nombre, $tipo,$usuario){
    	/** Se inserta la información de la tabla ADM_ENCMENSAJE*/
    
    	//Obtiene el siguiente ID
    	$consecutivo =$this->FunctionsGeneral->countMax('ADM_ENCMENSAJE','ID',1);
    	$data = array(
    			'ID' => $consecutivo,
    			'NOMBRE' => $nombre,
    			'CLASE' => $tipo,
    			'ESTADO' => 'S',
    			'UCREA' => $usuario,
    			'FCREA' => cambiaHoraServer(),
    			'UMOD' => $usuario,
    			'FMOD' => cambiaHoraServer()
    	);
    	//Realizo el insert sobre la base de datos en la tabla ADM_ENCMENSAJE
    	$this->db->insert('ADM_ENCMENSAJE', $data);
    	return $consecutivo;
    }
    
    public function insertDetMessage($id,$titulo, $mensaje,$idioma,$usuario){
    	/** Se inserta la información de la tabla ADM_DETMENSAJE*/
    
    	//Obtiene el siguiente ID
    	$consecutivo =$this->FunctionsGeneral->countMax('ADM_DETMENSAJE','ID',1);
    	$data = array(
    			'ID' => $consecutivo,
    			'ID_ENCMENSAJE' => $id,
    			'TITULO' => $titulo,
    			'MENSAJE' => $mensaje,
    			'ID_IDIOMA' => $idioma,
    			'ESTADO' => 'S',
    			'UCREA' => $usuario,
    			'FCREA' => cambiaHoraServer(),
    			'UMOD' => $usuario,
    			'FMOD' => cambiaHoraServer()
    	);
    	//Realizo el insert sobre la base de datos en la tabla ADM_ENCMENSAJE
    	$this->db->insert('ADM_DETMENSAJE', $data);
    	return $consecutivo;
    }
    
    public function insertProfile($nombre, $usuario){
        /** Se inserta la información de la tabla ADM_PERFIL*/
    	
    	//Obtiene el siguiente ID
    	$consecutivo =$this->FunctionsGeneral->countMax('ADM_PERFIL','ID',1);
    	 
        $data = array(
        		'ID' => $consecutivo,
        		
        		'NOMBRE' => $nombre,
                'ESTADO' => 'S',
                'UCREA' => $usuario,
                'FCREA' => cambiaHoraServer(),
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el insert sobre la base de datos en la tabla ADM_PERFIL
        $this->db->insert('ADM_PERFIL', $data);
        return $consecutivo;
    }
    
    public function insertProfileRol($perfil,$rol, $usuario){
        /** Se inserta la información de la tabla ADM_ROLPERFIL*/
    	
    	//Obtiene el siguiente ID
    	$consecutivo =$this->FunctionsGeneral->countMax('ADM_ROLPERFIL','ID',1);
        $data = array(
        		'ID' => $consecutivo,
        		'ID_PERFIL' => $perfil,
                'ID_ROL' => $rol,
                'ESTADO' => 'S',
                'UCREA' => $usuario,
                'FCREA' => cambiaHoraServer(),
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el insert sobre la base de datos en la tabla ADM_ROLPERFIL
        $this->db->insert('ADM_ROLPERFIL', $data);
        return $consecutivo;
    }
    
    public function insertModule($idModule,$tipoModulo,$tipo,$pagina,$clase, $usuario){
        /** Se inserta la información de la tabla ADM_MODULO*/
    	$consecutivo =$this->FunctionsGeneral->countMax('ADM_MODULO','ID',1);
    	
        $data = array(
                'ID' => $consecutivo,
                'ID_MODULO' => $idModule,
                'ID_TIPOMOD' => $tipoModulo,
                'ID_TIPO' => $tipo,
                'PAGINA' => $pagina,
                'CLASE' => $clase,
                'ESTADO' => 'S',
                'UCREA' => $usuario,
                'FCREA' => cambiaHoraServer(),
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el insert sobre la base de datos en la tabla ADM_MODULO
        $this->db->insert('ADM_MODULO', $data);
        return $consecutivo;
    }
    
    public function insertModuleName($idModule,$nombre,$idioma,$usuario){
        /** Se inserta la información de la tabla ADM_MODNOMBRE*/
        $data = array(
                'ID_MODULO' => $idModule,
                'ID' => $idModule,
                'NOMBRE' => $nombre,
                'ID_IDIOMA' => $idioma,
                'ESTADO' => 'S',
                'UCREA' => $usuario,
                'FCREA' => cambiaHoraServer(),
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el insert sobre la base de datos en la tabla ADM_MODNOMBRE
        $this->db->insert('ADM_MODNOMBRE', $data);
    }
    
    public function insertModuleProfile($idModule,$profile,$usuario){
        /** Se inserta la información de la tabla ADM_MODROLPER*/
    	
    	$consecutivo =$this->FunctionsGeneral->countMax('ADM_MODROLPER','ID',1);
    	
        $data = array(
        		'ID' => $consecutivo,
                'ID_MODULO' => $idModule,
                'ID_ROLPERFIL' => $profile,
                'ESTADO' => 'S',
                'UCREA' => $usuario,
                'FCREA' => cambiaHoraServer(),
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el insert sobre la base de datos en la tabla ADM_MODROLPER
        $this->db->insert('ADM_MODROLPER', $data);
    }
	
    public function insertEncFunction($modulo, $nombre,$tipo,$pagina,$funcion,$icono,$usuario){
    	/** Se inserta la información de la tabla ADM_MODFUNCIONES*/
    
    	//Obtiene el siguiente ID
    	$consecutivo =$this->FunctionsGeneral->countMax('ADM_MODFUNCIONES','ID',1);
    	$data = array(
    			'ID' => $consecutivo,
    			'ID_MODULO' => $modulo,
    			'NOMBRE' => $nombre,
    			'ID_TIPO' => $tipo,
    			'PAGINA' => $pagina,
    			'FUNCION' => $funcion,
    			'ICONO' => $icono,
    			'ESTADO' => 'S',
    			'UCREA' => $usuario,
    			'FCREA' => cambiaHoraServer(),
    			'UMOD' => $usuario,
    			'FMOD' => cambiaHoraServer()
    	);
    	//Realizo el insert sobre la base de datos en la tabla ADM_MODFUNCIONES
    	$this->db->insert('ADM_MODFUNCIONES', $data);
    	return $consecutivo;
    }
    
    public function insertDetFunction($encabezado, $perfil,$usuario){
    	/** Se inserta la información de la tabla ADM_MODFUNROLPER*/
    
    	//Obtiene el siguiente ID
    	$consecutivo =$this->FunctionsGeneral->countMax('ADM_MODFUNROLPER','ID',1);
    	$data = array(
    			'ID' => $consecutivo,
    			'ID_MODFUNCIONES' => $encabezado,
    			'ID_ROLPERFIL' => $perfil,
    			'ESTADO' => 'S',
    			'UCREA' => $usuario,
    			'FCREA' => cambiaHoraServer(),
    			'UMOD' => $usuario,
    			'FMOD' => cambiaHoraServer()
    	);
    	//Realizo el insert sobre la base de datos en la tabla ADM_MODFUNROLPER
    	$this->db->insert('ADM_MODFUNROLPER', $data);
    	return $consecutivo;
    }
    
    
    /* ---------------------------------------------------------- UPDATE ---------------------------------------------------------*/
    
    public function updateEncList($id,$nombre, $usuario){
        /** Se actualiza la información de la tabla ADM_ENCLISTA*/
        $data = array(
                'NOMBRE' => $nombre,
                'ESTADO' => 'S',
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el update sobre la base de datos en la tabla ADM_ENCLISTA
        $this->db->where('ID', $id);
        $this->db->update('ADM_ENCLISTA', $data);
    }
    
    public function updateDetList($id,$valor,$nombre, $usuario){
        /** Se inserta la información de la tabla ADM_DETLISTA*/
        $data = array(
                'NOMBRE' => $nombre,
                'VALOR' => $valor,
        		'ESTADO' => 'S',
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el insert sobre la base de datos en la tabla ADM_DETLISTA
        $this->db->where('ID', $id);
        $this->db->update('ADM_DETLISTA', $data);
    }
    
    public function updateProfile($id,$nombre, $usuario){
        /** Se actualiza la información de la tabla ADM_PERFIL*/
        $data = array(
                'NOMBRE' => $nombre,
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el update sobre la base de datos en la tabla ADM_PERFIL
        $this->db->where('ID', $id);
        $this->db->update('ADM_PERFIL', $data);
    }
    
    public function updateModulo($id,$pagina,$clase,$tipo,$tipoMod,$modulo, $usuario){
        /** Se actualiza la información de la tabla ADM_MODULO*/
        $data = array(
                'PAGINA' => $pagina,
                'CLASE' => $clase,
                'ID_TIPO' => $tipo,
                'ID_TIPOMOD' => $tipoMod,
                'ID_MODULO' => $modulo,
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el update sobre la base de datos en la tabla ADM_MODULO
        $this->db->where('ID', $id);
        $this->db->update('ADM_MODULO', $data);
    }
    
    public function updateFunction($id,$nombre,$idModule,$tipo,$pagina,$clase,$ubicacion,$color, $usuario){
        /** Se inserta la información de la tabla ADM_MODFUNCIONES*/
        $data = array(
                'NOMBRE' => $nombre,
                'ID_MODULO' => $idModule,
                'ID_TIPO' => $tipo,
                'PAGINA' => $pagina,
                'ICONO' => $clase,
                'FUNCION' => $ubicacion,
                'COLOR' => $color,
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el update sobre la base de datos en la tabla ADM_MODFUNCIONES
        $this->db->where('ID', $id);
        $this->db->update('ADM_MODFUNCIONES', $data);
    }

     /* ---------------------------------------------------------- DELETE ---------------------------------------------------------*/
     
     public function deletePermissions($id){
        /** Elimina relaciones de los módulos para el modulo con id: $id*/
        $this->db->where('ID_MODULO', $id);
        $this->db->delete('ADM_MODROLPER');
    }
    
    public function deletePermissionsModuleRol($id,$rolPerfil){
    	 /** Elimina relaciones de los módulos para el modulo con id: $id y rolperfil:$rolPerfil */
    	$this->db->where('ID_MODULO', $id);
    	$this->db->where('ID_ROLPERFIL', $rolPerfil);
    	$this->db->delete('ADM_MODROLPER');
    }
    public function deletePermissionsFunction($id){
        /** Elimina relaciones de los módulos con los permisos de perfil de usuario*/
        $this->db->where('ID_MODFUNCIONES', $id);
        $this->db->delete('ADM_MODFUNROLPER');
    }
    
    /* ---------------------------------------------------------- SELECT ---------------------------------------------------------*/
    
    public function getListDet($id){
        /** Obtiene el detalle de las listas*/
        
        $sql="select *
                from ADM_DETLISTA
                where ADM_DETLISTA.ID_ENCLISTA='".$id."'
                and ADM_DETLISTA.ESTADO !='N'";
        
		$result=$this->db->query($sql);
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return null;
        }
    }
    
    
    public function getListModulos($condicion=null){
        /** Obtiene los diferentes módulos que se tienen creados dentro de la aplicación*/
        
        $sql="select ADM_MODULO.ID, ADM_MODULO.PAGINA, ADM_MODNOMBRE.NOMBRE, ADM_MODULO.ESTADO
                from ADM_MODULO, ADM_MODNOMBRE
                where ADM_MODULO.ID=ADM_MODNOMBRE.ID_MODULO
                $condicion
                order by ADM_MODULO.ID";
                //echo $sql;
        $result=$this->db->query($sql);
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return null;
        }
    }
    public function getListFunciones($condicion=null){
        /** Obteniene las diferentes funciones definidas para los modulos*/
        
        $sql="select  ADM_MODNOMBRE.NOMBRE as MODULO, 
                      ADM_MODFUNCIONES.ID,
                      ADM_MODFUNCIONES.NOMBRE as NOMBRE,
                      ADM_MODFUNCIONES.ESTADO as ESTADO
                from ADM_MODULO, ADM_MODNOMBRE, ADM_MODFUNCIONES
                where ADM_MODULO.ID=ADM_MODNOMBRE.ID_MODULO
                and ADM_MODFUNCIONES.ID_MODULO=ADM_MODULO.ID
                $condicion
                order by ADM_MODULO.ID";
        $result=$this->db->query($sql);
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return null;
        }
    }
    public function getListModulosPrincipales(){
        /** Obtiene los diferentes módulos que se tienen creados dentro de la aplicación*/
        
        $sql="select DISTINCT ADM_MODULO.ID, ADM_MODNOMBRE.NOMBRE, ADM_MODULO.ID_MODULO
                from ADM_MODULO, ADM_MODNOMBRE
                where ADM_MODULO.ID=ADM_MODNOMBRE.ID_MODULO
                and ADM_MODULO.ID_MODULO is null
                AND ADM_MODULO.ID_TIPOMOD='2' 
        	  union all
        		select DISTINCT ADM_MODULO.ID, ADM_MODNOMBRE.NOMBRE, ADM_MODULO.ID_MODULO
                from ADM_MODULO, ADM_MODNOMBRE
                where ADM_MODULO.ID=ADM_MODNOMBRE.ID_MODULO
                and ADM_MODULO.PAGINA ='---'
        		and ADM_MODULO.ID_MODULO is NOT null
                
                AND ADM_MODULO.ID_TIPOMOD='2' ";
        $result=$this->db->query($sql);
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return null;
        }
    }
    
    public function getListModulosSecundarios(){
        /** Obtiene los diferentes módulos que se tienen creados dentro de la aplicación*/
        
        $sql="select ADM_MODULO.ID, ADM_MODNOMBRE.NOMBRE
                from ADM_MODULO, ADM_MODNOMBRE
                where ADM_MODULO.ID=ADM_MODNOMBRE.ID_MODULO
                and ADM_MODULO.ID_MODULO is not null
                order by ADM_MODULO.ID";
        $result=$this->db->query($sql);
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return null;
        }
    }
    
    public function getParameters($id){
        /** Obtiene los diferentes módulos que se tienen creados dentro de la aplicación*/
        
        $sql="select *
                from ADM_PARAMETROS
                where ID='$id'";
        $result=$this->db->query($sql);
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return null;
        }
    }
    
    public function getParametersReport($usuario,$reporte){
    	/** Obtiene los diferentes módulos que se tienen creados dentro de la aplicación*/
    
    	$sql="select *
    	from ADM_USUREPORTE
    	where USUARIO='$usuario'
    	and MODULO='$reporte'";
    	$result=$this->db->query($sql);
    	if($result->num_rows()>0){
    		return $result->result();
    	}else{
    		return null;
    	}
    }
    
    public function getListMailFromProfile($id){
        /** Obtiene los correos electrónicos de los usuarios que tienen el perfil $id*/
        
        $sql="SELECT
                ADM_USUARIO.CORREO,
                ADM_USUARIO.APELLIDOS,
                ADM_USUARIO.NOMBRES
                
                FROM
                ADM_ROLPERFIL, ADM_USUROLPER,ADM_USUARIO
                where ADM_USUROLPER.ID_ROLPERFIL = ADM_ROLPERFIL.ID
                and ADM_USUROLPER.ID_USUARIO = ADM_USUARIO.ID
                and ADM_USUARIO.ESTADO='".ACTIVO_ESTADO."'
                AND ADM_ROLPERFIL.ID_PERFIL='$id'

";
        $result=$this->db->query($sql);
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return null;
        }
    }
    
    
}
?>
