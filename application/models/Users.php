<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electrónico:         jcescobarba@gmail.com
  Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:                  Funciones de las actividades generales que se tienen que realizar hacia la tabla usuarios
*/

class Users extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	/* ---------------------------------------------------------- INSERT ---------------------------------------------------------*/
    
	public function insertUser($id,$nombres, $apellidos, $correo ,$clave,$pagina ,$usuario){
		/** Rutina para hacer el insert sobre la tabla usuarios, se reciben los valores de 
		 *  nombres apellidos, clave, y usuario que realiza la operación*/
		$data = array(
				'ID' => $id,
                'NOMBRES' => $nombres,
				'APELLIDOS' => $apellidos,
                'CORREO' => $correo,
				'CLAVE' => $clave,
				'PAGINA' => $pagina,
				'ESTADO' => 'I',
				'UCREA' => $usuario,
				'FCREA' => cambiaHoraServer(),
				'UMOD' => $usuario,
				'FMOD' => cambiaHoraServer()
		);
		//Realizo el insert sobre la base de datos en la tabla ADM_USUARIO
		$this->db->insert('ADM_USUARIO', $data);
        return $this->db->insert_id();
	}
	
	public function insertUserReporte($usuario,$modulo,$usuario2,$estadoDefecto){
		/** Rutina para hacer el insert sobre la tabla reporte de usuarios, se reciben los valores de
		 *  usuario que realizará el reporte*/
		$data = array(
				'USUARIO' => $usuario,
				'MODULO' => $modulo,
				'NOMBRES' => '1',
				'DOCUMENTO' => '1',
				'CORREO' => '1',
				'DIRECCION' => '1',
				'CELULAR' => '1',
				'FIJO' => '2',
				'ID_CONTRATO' => '1',
				'OPERADOR' => '1',
				'ESTADO' => '1',
				'FCREA' => '1',
				'HCREA' => '2',
				'ORDEN1' => 'ESTADO',
				'MODO1' => 'ASC',
				'ORDEN2' => 'FCREA',
				'MODO2' => 'DESC',
				'EST_DEFECTO' => $estadoDefecto,
				'UMOD' => $usuario2,
				'FMOD' => cambiaHoraServer()
				
				
		);
		//Realizo el insert sobre la base de datos en la tabla ADM_USUREPORTE
		$this->db->insert('ADM_USUREPORTE', $data);
		return $this->db->insert_id();
	}
    
    public function insertUserHistory($idUsuario,$origen){
        /** Guardo el historico de ingreso de sesión*/
    	
    	//Traigo el valor de ID
    	$table='ADM_HISINGUSU';
    	$consecutivo =$this->FunctionsGeneral->countMax($table,'ID',1);
        $data = array(
        		'ID' => $consecutivo,
                'ID_USUARIO' => $idUsuario,
                'ORIGEN' => $origen,
                'FECHA' => cambiaHoraServer()
        );
        //Realizo el insert sobre la base de datos en la tabla ADM_HISINGUSU
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    public function insertUserHistoryPsw($id,$clave){
        /** Guardo el historico de ingreso de sesión*/
    	
    	$table='ADM_HISCLAUSU';
    	$consecutivo =$this->FunctionsGeneral->countMax($table,'ID',1);
        $data = array(
        		'ID' => $consecutivo,
                'ID_USUARIO' => $id,
                'CLAVE' => $clave,
                'FECHA' => cambiaHoraServer()
        );
        //Realizo el insert sobre la base de datos en la tabla ADM_HISCLAUSU
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    
    public function insertUsuRolPer($id,$idRolPer, $usuario){
        /** Rutina para hacer el insert sobre la tabla usuario roles perfiles ADM_USUROLPER*/
    	
    	$table='ADM_USUROLPER';
    	$consecutivo =$this->FunctionsGeneral->countMax($table,'ID',1);
    	
        $data = array(
        		'ID' => $consecutivo,
        		'ID_USUARIO' => $id,
                'ID_ROLPERFIL' => $idRolPer,
                'ESTADO' => 'S',
                'UCREA' => $usuario,
                'FCREA' => cambiaHoraServer(),
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el insert sobre la base de datos en la tabla ADM_USUROLPER
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }	
    
     
	
    /* ---------------------------------------------------------- UPDATE ---------------------------------------------------------*/
    
    public function updateUser($id,$nombres, $apellidos, $correo ,$pagina ,$usuario){
        /** Rutina para hacer el insert sobre la tabla usuarios, se reciben los valores de 
         *  nombres apellidos, clave, y usuario que realiza la operación*/
    	if ($pagina==null){
    		$data = array(
    				'NOMBRES' => $nombres,
    				'APELLIDOS' => $apellidos,
    				'CORREO' => $correo,
    				'UMOD' => $usuario,
    				'FMOD' => cambiaHoraServer()
    		);
    	}else{
    		$data = array(
    				'NOMBRES' => $nombres,
    				'APELLIDOS' => $apellidos,
    				'CORREO' => $correo,
    				'PAGINA' => $pagina,
    				'UMOD' => $usuario,
    				'FMOD' => cambiaHoraServer()
    		);
    	}
        
        //Realizo el update sobre la base de datos en la tabla ADM_USUARIO
        $this->db->where('ID', $id);
        $this->db->update('ADM_USUARIO', $data);
    }
    
    public function updateUsuRolPer($id,$idRolPer, $usuario){
        /** Rutina para hacer el insert sobre la tabla usuario roles perfiles ADM_USUROLPER*/
        $data = array(
                'ID_ROLPERFIL' => $idRolPer,
                'UMOD' => $usuario,
                'FMOD' => cambiaHoraServer()
        );
        //Realizo el update sobre la base de datos en la tabla ADM_USUROLPER
        $this->db->where('ID_USUARIO', $id);
        $this->db->update('ADM_USUROLPER', $data);
    }    
    
    

     /* ---------------------------------------------------------- DELETE ---------------------------------------------------------*/
    public function deletePswHistory($id){
        /** Elimina relaciones de los representantes*/
        $this->db->where('ID', $id);
        $this->db->delete('ADM_HISCLAUSU');
    }
    
    /* ---------------------------------------------------------- SELECT ---------------------------------------------------------*/
    
    public function getUsers(){
        return $this->db->get('ADM_USUARIO');
    }
    
    public function getUsersCondition($usuario){
        /** Obtiene el nombre de usuario y clave para ser revisandos dentro del login */
        $sql="select ADM_USUARIO.ID, 
                     ADM_USUARIO.CLAVE,
                     ADM_USUARIO.ESTADO,
                     ADM_USUARIO.FCCON
                from ADM_USUARIO
                where ADM_USUARIO.ID='".$usuario."'
                and ADM_USUARIO.ESTADO !='N'";
        $result=$this->db->query($sql);
        if($result->num_rows()>0){
            return $result->row();
        }else{
            return null;
        }
    }
    
    public function getNombresUsuario($usuario){
        /** Obtiene nombres y apellidos del usuario teniendo en cuenta el identificador*/
        
        $this->db->select('NOMBRES, APELLIDOS');
        $this->db->from('ADM_USUARIO');
        $this->db->where('ID', $usuario);
        $consulta = $this->db->get();
        if($consulta->num_rows()>0){
            $resultado = $consulta->row();
            return $resultado;
        }else{
            return null;
        }
    }
    
    public function getListUsers(){
        /** Obtengo el listado de contactos actuales dentro del sistema*/
        $sql="select 	ADM_USUARIO.ID,
						ADM_USUARIO.NOMBRES,
						ADM_USUARIO.APELLIDOS,
						ADM_USUARIO.CORREO,
						ADM_USUARIO.CLAVE,
						ADM_USUARIO.FCCON,
						ADM_USUARIO.FUING,
						ADM_USUARIO.ESTADO,
						ADM_USUARIO.UCREA,
						ADM_USUARIO.FCREA,
						ADM_USUARIO.UMOD,
						ADM_USUARIO.FMOD,
						ADM_USUARIO.PAGINA,
        				ADM_USUROLPER.ID AS ID_USUROLPER,
        				ADM_PERFIL.ID AS ID_PERFIL,
        				ADM_PERFIL.NOMBRE AS PERFIL
        		from ADM_USUARIO, 
        			 ADM_USUROLPER, 
        			 ADM_ROLPERFIL, 
        			 ADM_PERFIL
        		where ADM_USUARIO.ID=ADM_USUROLPER.ID_USUARIO
        		and ADM_USUROLPER.ID_ROLPERFIL=ADM_ROLPERFIL.ID
        		AND ADM_ROLPERFIL.ID_PERFIL=ADM_PERFIL.ID
                order by ADM_USUARIO.ID DESC";
        $result=$this->db->query($sql);
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return null;
        }
    }
    
    public function getListUsersForList($idPerfil){
    	/** Obtengo el listado de contactos actuales dentro del sistema*/
    	$sql="select 	ADM_USUARIO.ID,
						ADM_USUARIO.NOMBRES,
						ADM_USUARIO.APELLIDOS,
						ADM_USUARIO.CORREO,
						ADM_USUARIO.CLAVE,
						ADM_USUARIO.FCCON,
						ADM_USUARIO.FUING,
						ADM_USUARIO.ESTADO,
						ADM_USUARIO.UCREA,
						ADM_USUARIO.FCREA,
						ADM_USUARIO.UMOD,
						ADM_USUARIO.FMOD,
						ADM_USUARIO.PAGINA,
        				ADM_USUROLPER.ID AS ID_USUROLPER,
        				ADM_PERFIL.ID AS ID_PERFIL,
        				ADM_PERFIL.NOMBRE AS PERFIL
        		from ADM_USUARIO,
        			 ADM_USUROLPER,
        			 ADM_ROLPERFIL,
        			 ADM_PERFIL
        		where ADM_USUARIO.ID=ADM_USUROLPER.ID_USUARIO
        		and ADM_USUROLPER.ID_ROLPERFIL=ADM_ROLPERFIL.ID
        		AND ADM_ROLPERFIL.ID_PERFIL=ADM_PERFIL.ID
    			AND ADM_PERFIL.ID IN ($idPerfil)
                order by ADM_USUARIO.ID DESC";
    	$result=$this->db->query($sql);
    	if($result->num_rows()>0){
    		return $result->result();
    	}else{
    		return null;
    	}
    }
    
    public function getUsersProfile($usuario){
    	/** Obtengo el perfil del usuario*/
    	$sql="select 	
        				ADM_PERFIL.ID AS ID_PERFIL,
        				ADM_PERFIL.NOMBRE AS PERFIL
        		from ADM_USUARIO,
        			 ADM_USUROLPER,
        			 ADM_ROLPERFIL,
        			 ADM_PERFIL
        		where ADM_USUARIO.ID=ADM_USUROLPER.ID_USUARIO
        		and ADM_USUROLPER.ID_ROLPERFIL=ADM_ROLPERFIL.ID
        		AND ADM_ROLPERFIL.ID_PERFIL=ADM_PERFIL.ID
    			and ADM_USUARIO.ID='$usuario'
                order by ADM_USUARIO.ID DESC";
	    $result=$this->db->query($sql);
	        if($result->num_rows()>0){
	            return $result->row();
	        }else{
	            return null;
	        }
    }
    
    public function getClaveUsuarioHistorico($usuario){
        /** Obtiene nombres y apellidos del usuario teniendo en cuenta el identificador*/
        
        $sql="select CLAVE,ID
                from ADM_HISCLAUSU
                where ID_USUARIO='$usuario'";
        $result=$this->db->query($sql);
        if($result->num_rows()>0){
            return $result->result();
        }else{
            return null;
        }
    }
    
    public function selectUsersFromProfile($condition){
    	/** Obtiene id, nombres y apellidos del usuario teniendo en cuenta $condition*/
    
    	$sql="SELECT
				ADM_USUARIO.ID,
    			ADM_USUARIO.NOMBRES,
    			ADM_USUARIO.APELLIDOS
				FROM
				ADM_USUARIO, 
    			ADM_USUROLPER, 
    			ADM_PERFIL,
    			ADM_ROLPERFIL
    			WHERE ADM_USUARIO.ESTADO = '".ACTIVO_ESTADO."'
    			AND ADM_USUARIO.ID=ADM_USUROLPER.ID_USUARIO 
    			AND ADM_ROLPERFIL.ID_PERFIL = ADM_PERFIL.ID 
    			AND ADM_USUROLPER.ID_ROLPERFIL = ADM_ROLPERFIL.ID 
    			AND ADM_USUROLPER.ESTADO = '".ACTIVO_ESTADO."'
    			$condition";
    	//ECHO $sql;
    	$result=$this->db->query($sql);
    	if($result->num_rows()>0){
    		return $result->result();
    	}else{
    		return null;
    	}
    }
    
}
?>
