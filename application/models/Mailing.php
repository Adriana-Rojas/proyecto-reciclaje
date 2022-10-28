<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electrónico:         jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:                  Funciones de las actividades generales que se tienen que realizar hacia las tablas de Contacto
 */

class Mailing extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    /* ---------------------------------------------------------- INSERT ---------------------------------------------------------*/
    
    public function insertMailing($correo, $nombres, $apellido1,$apellido2,$usuario){
    	/** Rutina para hacer el insert sobre la tabla OPE_MAILING*/
    
    
    	$data = array(
    			'NOMBRES' => $nombres,
    			'APELLIDO1' => $apellido1,
    			'APELLIDO2' => $apellido2,
    			'CORREO' => $correo,
    			'ESTADO' =>'S',
    			'UCREA' => $usuario,
    			'FCREA' => cambiaHoraServer(),
    			'UMOD' => $usuario,
    			'FMOD' => cambiaHoraServer()
    	);
    	//Realizo el insert sobre la base de datos en la tabla OPE_CONTACTO
    	$this->db->insert('OPE_MAILING', $data);
    	return $this->db->insert_id();
    }
    
    public function insertMailText($nombre,$asunto, $saludo, $cuerpo1,$cuerpo2,$cuerpo3,$cuerpo4,$usuario){
    	/** Rutina para hacer el insert sobre la tabla OPE_MAILTEXT*/
    
    
    	$data = array(
    			'NOMBRE' => $nombre,
    			'SALUDO' => $saludo,
    			'ASUNTO' => $asunto,
    			'CUERPO1' => $cuerpo1,
    			'CUERPO2' => $cuerpo2,
    			'CUERPO3' => $cuerpo1,
    			'CUERPO4' => $cuerpo2,
    			'ESTADO' =>'S',
    			'UCREA' => $usuario,
    			'FCREA' => cambiaHoraServer(),
    			'UMOD' => $usuario,
    			'FMOD' => cambiaHoraServer()
    	);
    	//Realizo el insert sobre la base de datos en la tabla OPE_CONTACTO
    	$this->db->insert('OPE_MAILTEXT', $data);
    	return $this->db->insert_id();
    }
    
    public function insertMailAudit($idCorreo,$idMensaje,$usuario){
    	/** Rutina para hacer el insert sobre la tabla OPE_MAILAUDIT*/
    
    
    	$data = array(
    			'ID_MAILING' => $idCorreo,
    			'ID_MAILTEXT' => $idMensaje,
    			'UCREA' => $usuario,
    			'FCREA' => cambiaHoraServer(),
    			'UMOD' => $usuario,
    			'FMOD' => cambiaHoraServer()
    	);
    	//Realizo el insert sobre la base de datos en la tabla OPE_CONTACTO
    	$this->db->insert('OPE_MAILAUDIT', $data);
    	return $this->db->insert_id();
    }
    
    /* ---------------------------------------------------------- UPDATE ---------------------------------------------------------*/
    public function updateMailText($id,$nombre,$asunto, $saludo, $cuerpo1,$cuerpo2,$cuerpo3,$cuerpo4,$usuario){
    	/** Rutina para hacer el update sobre la tabla OPE_MAILTEXT*/
    
    
    	$data = array(
    			'NOMBRE' => $nombre,
    			'SALUDO' => $saludo,
    			'ASUNTO' => $asunto,
    			'CUERPO1' => $cuerpo1,
    			'CUERPO2' => $cuerpo2,
    			'CUERPO3' => $cuerpo1,
    			'CUERPO4' => $cuerpo2,
    			'ESTADO' =>'S',
    			'UCREA' => $usuario,
    			'FCREA' => cambiaHoraServer(),
    			'UMOD' => $usuario,
    			'FMOD' => cambiaHoraServer()
    	);
    	//Realizo el update sobre la base de datos en la tabla OPE_CONTACTO
    	$this->db->where('ID', $id);
        $this->db->update('OPE_MAILTEXT', $data);
    	return $this->db->insert_id();
    }
    
    
    /* ---------------------------------------------------------- SELECT ---------------------------------------------------------*/
    
    public function getListMails($condition = null){
    	/** Obtengo el listado de los correos electrónicos creados*/
    	$sql="select *
    	from OPE_MAILING
    	$condition
    	";
    	//echo $sql;
    	$result=$this->db->query($sql);
    	if($result->num_rows()>0){
    		return $result->result();
    	}else{
    		return null;
    	}
    }
    
    public function getMailText($condition = null){
    	/** Obtengo el listado de los correos electrónicos creados*/
    	$sql="select *
    	from OPE_MAILTEXT
    	$condition
    	";
    	//echo $sql;
    	$result=$this->db->query($sql);
    	if($result->num_rows()>0){
    		return $result->result();
    	}else{
    		return null;
    	}
    }
}



?>