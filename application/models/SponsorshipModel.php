<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electrónico:         jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:                  Clase en las cuales se definen las operaciones CRUD frente a las tablas que tienen relación con la aplicaciónPatrocinios y todos sus modulos
 */
class SponsorshipModel extends CI_Model {
	public function __construct() {
		parent::__construct ();
	}
	
	/* ---------------------------------------------------------- INSERT --------------------------------------------------------- */
	public function insertBalanceFund($idFondo, $mes, $ano,$valor, $usuario) {
		/**
		 * Se inserta la información de la tabla PAT_FONSAL
		 */
		
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax ( 'PAT_FONSAL', 'ID', 1 );
		$data = array (
				'ID' => $consecutivo,
				'ID_FONDOS' => $idFondo,
				'MES' => $mes,
				'ANO' => $ano,
				'VALOR' => $valor,
				'ESTADO' => 'S',
				'UCREA' => $usuario,
				'FCREA' => cambiaHoraServer (),
				'UMOD' => $usuario,
				'FMOD' => cambiaHoraServer () 
		);
		// Realizo el insert sobre la base de datos en la tabla PAT_FONSAL
		$this->db->insert ( 'PAT_FONSAL', $data );
		return $consecutivo;
	}
	
	public function insertOperationBalanceFund($idFondo,$accion, $mes, $ano,$valor, $usuario) {
		/**
		 * Se inserta la información de la tabla PAT_FONSALHIST
		 */
	
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax ( 'PAT_FONSALHIST', 'ID', 1 );
		$data = array (
				'ID' => $consecutivo,
				'ID_FONSAL' => $idFondo,
				'ACCION' => $accion,
				'MES' => $mes,
				'ANO' => $ano,
				'VALOR' => $valor,
				'ESTADO' => 'S',
				'UCREA' => $usuario,
				'FCREA' => cambiaHoraServer (),
				'UMOD' => $usuario,
				'FMOD' => cambiaHoraServer ()
		);
		// Realizo el insert sobre la base de datos en la tabla PAT_FONSALHIST
		$this->db->insert ( 'PAT_FONSALHIST', $data );
		return $consecutivo;
	}
	
	
	
	
	public function insertSponsorShipHead($id,$tipo,$tipoDoc,$documento,$idCoti, $mes, $ano,$observacion,$usuide,$estado, $usuario) {
	    /**
	     * Se inserta la información de la tabla PAT_PATROCINIOS
	     */
	    
	    $fecha= $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", cambiaHoraServer (2));
	    // Obtiene el siguiente ID
	    $data = array (
	        'ID' => $id,
	        'ID_TIPO' => $tipo,
	        'TIPO_DOC' => $tipoDoc,
	        'DOCUMENTO' => $documento,
	        'IDCOTI' => $idCoti,
	        'MES' => $mes,
	        'ANO' => $ano,
	        'FECHA' => $fecha ,
	        'ESTADO' => $estado,
	        'OBSERVACIONES' => $observacion,
	        'USUIDE' => $usuide,
	        'UCREA' => $usuario,
	        'FCREA' => cambiaHoraServer (),
	        'UMOD' => $usuario,
	        'FMOD' => cambiaHoraServer ()
	    );
	    // Realizo el insert sobre la base de datos en la tabla PAT_PATROCINIOS
	    $this->db->insert ( 'PAT_PATROCINIOS', $data );
	    return $id;
	}
	
	
	public function insertSponsorShipDetailSpecial($id,$descripcion,$valor, $usuario) {
	    /**
	     * Se inserta la información de la tabla PAT_PATESP
	     */
	    
	    // Obtiene el siguiente ID
	    $consecutivo = $this->FunctionsGeneral->countMax ( 'PAT_PATESP', 'ID', 1 );
	    
	    $data = array (
	        'ID' => $consecutivo,
	        'ID_PATROCINIO' => $id,
	        'PATROCINIO' => $descripcion,
	        'VALOR' => $valor,
	        'ESTADO' => ACTIVO_ESTADO,
	        'UCREA' => $usuario,
	        'FCREA' => cambiaHoraServer (),
	        'UMOD' => $usuario,
	        'FMOD' => cambiaHoraServer ()
	    );
	    // Realizo el insert sobre la base de datos en la tabla PAT_PATESP
	    $this->db->insert ( 'PAT_PATESP', $data );
	    return $consecutivo;
	}
	
	public function insertSponsorShipDetailFromStokePrice($id,$valor, $usuario) {
	    /**
	     * Se inserta la información de la tabla PAT_PATART
	     */
	    
	    // Obtiene el siguiente ID
	    $consecutivo = $this->FunctionsGeneral->countMax ( 'PAT_PATART', 'ID', 1 );
	    
	    $data = array (
	        'ID' => $consecutivo,
	        'ID_PATROCINIO' => $id,
	        'VALOR' => $valor,
	        'ESTADO' => ACTIVO_ESTADO,
	        'UCREA' => $usuario,
	        'FCREA' => cambiaHoraServer (),
	        'UMOD' => $usuario,
	        'FMOD' => cambiaHoraServer ()
	    );
	    // Realizo el insert sobre la base de datos en la tabla PAT_PATART
	    $this->db->insert ( 'PAT_PATART', $data );
	    return $consecutivo;
	}
	
	public function insertSponsorShipFund($id,$idFondo,$valor, $usuario) {
	    /**
	     * Se inserta la información de la tabla PAT_PATFON
	     */
	    
	    // Obtiene el siguiente ID
	    $consecutivo = $this->FunctionsGeneral->countMax ( 'PAT_PATFON', 'ID', 1 );
	    
	    $data = array (
	        'ID' => $consecutivo,
	        'ID_PATROCINIO' => $id,
	        'ID_FONDOS' => $idFondo,
	        'PORCENTAJE' => $valor,
	        'ESTADO' => ACTIVO_ESTADO,
	        'UCREA' => $usuario,
	        'FCREA' => cambiaHoraServer (),
	        'UMOD' => $usuario,
	        'FMOD' => cambiaHoraServer ()
	    );
	    // Realizo el insert sobre la base de datos en la tabla PAT_PATFON
	    $this->db->insert ( 'PAT_PATFON', $data );
	    return $consecutivo;
	}
	
	
	/**
	 * ---------------------------------------------------------- TODO UPDATE ---------------------------------------------------------
	 */
	
	
	/* ---------------------------------------------------------- TODO DELETE --------------------------------------------------------- */
	
	/* ---------------------------------------------------------- SELECT --------------------------------------------------------- */
	
	public function selectBalanceFromFund($mes,$ano,$condicion=null) {
		/** Seleccciona los valores actuales de los fondos, para el año mes*/
		$sql="SELECT
				PAT_FONDOS.NOMBRE,
				PAT_FONSAL.MES,
				PAT_FONSAL.ANO,
				PAT_FONSAL.VALOR,
				PAT_FONSAL.ID,
				PAT_FONSAL.ID_FONDOS
				
				FROM
				PAT_FONDOS,PAT_FONSAL 
				where PAT_FONSAL.ID_FONDOS = PAT_FONDOS.ID 
				AND PAT_FONSAL.MES = '$mes' 
				AND PAT_FONSAL.ANO = '$ano'
				and PAT_FONDOS.ESTADO='".ACTIVO_ESTADO."'
				and PAT_FONSAL.ESTADO='".ACTIVO_ESTADO."'
				$condicion
		";
		//echo $sql;
		$result=$this->db->query($sql);
		if($result->num_rows()>0){
			return $result->result();
		}else{
			return null;
		}
	}
	
	public function selectSponsorShipDetailForCondition($condicion=null) {
	    /** Seleccciona los valores actuales de los fondos, para el año mes*/
	    $sql="SELECT * 
				
				FROM
				PAT_PATROCINIOS
				where $condicion
		";
				//echo $sql;
				$result=$this->db->query($sql);
				if($result->num_rows()>0){
				    return $result->result();
				}else{
				    return null;
				}
	}
	
	public function selectSponsorShipDetailForFunds($id) {
	    /** obtengo información de los fondos relacionados a un patrocinio*/
	    $sql="SELECT
                PAT_PATFON.ID_FONDOS,
                PAT_PATFON.ID,
                PAT_PATFON.PORCENTAJE,
                PAT_FONDOS.NOMBRE
                FROM
                PAT_PATFON, PAT_FONDOS
                where PAT_PATFON.ID_PATROCINIO='$id'
                and PAT_FONDOS.ID=PAT_PATFON.ID_FONDOS
		";
	    //echo $sql;
	    $result=$this->db->query($sql);
	    if($result->num_rows()>0){
	        return $result->result();
	    }else{
	        return null;
	    }
	}
	
	public function selectSponsorShipInformationFunds($id,$mes,$ano) {
	    /** obtengo información de los fondos relacionados a un patrocinio*/
	    $sql="SELECT sum(PAT_PATFON.PORCENTAJE) AS PORCENTAJE
            from PAT_PATFON,PAT_PATROCINIOS
            WHERE PAT_PATFON.ID_PATROCINIO=PAT_PATROCINIOS.ID
            AND PAT_PATROCINIOS.MES='$mes'
            AND PAT_PATROCINIOS.ANO='$ano'
            AND PAT_PATROCINIOS.ESTADO='".ACTIVO_ESTADO."'
            and PAT_PATFON.ID_FONDOS='$id'
            group by PAT_PATFON.ID_FONDOS
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