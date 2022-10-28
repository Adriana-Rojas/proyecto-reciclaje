<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electr�nico:         jcescobarba@gmail.com
  Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:                  Esta clase tiene la funcionalidad de hacer las consultas a la base de datos ESALUD,
 							 para esto se usar� dentro de la estructura de cada funci�n. La conexi�n a la base de datos 
 							 esalud y no la definida por defecto (default).
 							 
 							 Para la conexi�n a este modelo se debe tener en cuenta:
 							 1. Cargar el modelo
 							 	$this->load->model('EsaludModel');
 							 2. Llamar la funci�n respectiva 
            						$RETURN=$this->EsaludModel->FUNCTION(PARAMETERS);
            
*/

class EsaludModel extends CI_Model {

	public function __construct()
    {
        parent::__construct();
    }

	/* ---------------------------------------------------------- SELECT ---------------------------------------------------------*/
    
    public function getFieldFromTableNotIdFieldsFromEsalud($table,$campo,$campoBusqueda,$valor, $campo2= NULL,$valor2= null,$campo3=null,$valor3=null,$campo4=null,$valor4=null,$campo5=null,$valor5=null){
    	/** Selecciono el valor actual para la condici�n que cumplen los diferentes campos*/
    	
    	//con esta l�nea cargamos la base de datos esalud y la asignamos a $esaludDb
    	$esaludDb = $this->load->database('esalud', TRUE);
    	
    	$esaludDb->select($campo);
    	$esaludDb->from($table);
    	$esaludDb->where($campoBusqueda, $valor);
    	if($campo2!=NULL){
    		$esaludDb->where($campo2, $valor2);
    	}
    	if($campo3!=NULL){
    		$esaludDb->where($campo3, $valor3);
    	}
    	if($campo4!=NULL){
    		$esaludDb->where($campo4, $valor4);
    	}
    	if($campo5=NULL){
    		$esaludDb->where($campo5, $valor5);
    	}
    	$consulta = $esaludDb->get();
    	 
    	if($consulta->num_rows()>0){
    		$resultado = $consulta->row();
    		$return =$resultado->$campo;
           // echo $return;
    	   return $return;
    	}
    }
    
    public function getPatientInformationMaxRelation($search){
    	/** Obtengo la relaci�n m�s grande entre empresa y paciente*/
    	//con esta l�nea cargamos la base de datos esalud y la asignamos a $esaludDb
    	$esaludDb = $this->load->database('esalud', TRUE);
    	// Hago la consulta a la base de datos
    	$sql="SELECT
				MAX (T_PCTEXAPB.ID_PCTEXAPB) AS MAXIMO
			FROM T_PCTEXAPB
    		where T_PCTEXAPB.ID_PCTE_PCTEAPB='$search'";
    	//ejecuto la consulta
    	$result=$esaludDb->query($sql);
    	if($result->num_rows()>0){
    		$resultado = $result->row();
    		$return =$resultado->MAXIMO;
    		return $return;
    	}
    }

    public function getPatientInformation($search,$option,$adicional=null){
    	/** Obtengo la informaci�n de la historia cl�nica $id*/
    	//con esta l�nea cargamos la base de datos esalud y la asignamos a $esaludDb
    	$esaludDb = $this->load->database('esalud', TRUE);
    	// Hago la consulta a la base de datos
    	//Lo paso a mayuscula
    	$search=strtoupper($search);
    	if($adicional==''){
    		$adicional="";
    	}else{
    		$adicional="and T_ADMISIONES.ACTIVO_ADM='$adicional'";
    	}
    	$busqueda="T_PACIENTES.ID_PCTE,
					T_PACIENTES.TP_ID_PCTE,
					T_PACIENTES.NUM_ID_PCTE,
                    T_PACIENTES.DIR_PCTE,
					T_PACIENTES.PRI_APELL_PCTE,
					T_PACIENTES.SEG_APELL_PCTE,
					T_PACIENTES.PRI_NOM_PCTE,
					T_PACIENTES.SEG_NOM_PCTE,
					T_PACIENTES.FECH_NCTO_PCTE,
					T_PACIENTES.SEXO,
    				T_APB.NOM_APB as RESPONSABLE,
    				T_ADMISIONES.ACTIVO_ADM as ESTADO,
    				T_ADMISIONES.ID_AMSION AS ADMISION,
                    T_APB.ID_APB AS ID_RESPONSABLE
    		";
    	$tablas="T_PACIENTES, 
    			 T_APB, 
    			 T_ADMISIONES";
    	$condicion="
    			and T_ADMISIONES.ID_APB_ADM =T_APB.ID_APB
    			and T_ADMISIONES.ID_PCTE_ADM= T_PACIENTES.ID_PCTE 
    			$adicional";
    	if($option==1){
    		// Busqueda de informaci�n por historia cl�nica
    		$sql="select $busqueda
    		from $tablas
    		where T_PACIENTES.ID_PCTE='$search'
    		$condicion";
    	}else if($option==2){
    		// Busqueda de informaci�n por documento de identidad
    		$sql="select $busqueda
    		from $tablas
    		where NUM_ID_PCTE='$search'
    		$condicion";
    	}else if($option==3){
    		// Busqueda de informaci�n por nombres del paciente
    		$sql="select $busqueda
    		from $tablas
    		where PRI_NOM_PCTE like '%$search%'
    		$condicion
    		union all
    		select $busqueda
    		from $tablas
    		where SEG_NOM_PCTE like '%$search%'
    		$condicion
    		";
    	}else  if($option==4){
    		// Busqueda de informaci�n por apellidos del paciente
    		$sql="select $busqueda
    		from $tablas
    		where PRI_APELL_PCTE like '%$search%'
    		$condicion
    		union all
    		select $busqueda
    		from $tablas
    		where SEG_APELL_PCTE like '%$search%'
    		$condicion
    		";
    	}else  if($option==5){
    		// Busqueda de informaci�n por admision
    		$sql="select $busqueda
    		from $tablas
    		where T_ADMISIONES.ID_AMSION ='$search'
    		$condicion
    		
    		";
    	}else  if($option==6){
    		// Busqueda de informaci�n por admision
    		$sql="select $busqueda
    		from $tablas
    		where T_PACIENTES.NUM_ID_PCTE ='$search'
    		$condicion
    		
    		";
    	}
    	//ejecuto la consulta
    	//echo $sql;	
    	$result=$esaludDb->query($sql);
    	if($result->num_rows()>0){
    		return $result->result();
    	}else{
    		return null;
    	}
    }
    
    public function getServiceInformation($search,$option){
    	/** Obtengo la informaci�n de los servicios $id*/
    	//con esta l�nea cargamos la base de datos esalud y la asignamos a $esaludDb
    	$esaludDb = $this->load->database('esalud', TRUE);
    	// Hago la consulta a la base de datos
    	$busqueda="COD_SER,
    			   NOM_SER,
				   ESTADO_SER,
    			   COD_ALTER2_SER";
    	if($option==1){
    		// Busqueda de informaci�n por c�digo
    		$sql="select $busqueda
    		from T_SER
    		where COD_SER='$search'";
    	}else {
    		// Busqueda de informaci�n por nombre
    		$sql="select $busqueda
    		from T_SER
    		where NOM_SER LIKE '%$search%'
    		";
    	}
    	 
    	$result=$esaludDb->query($sql);
    	if($result->num_rows()>0){
    		return $result->result();
    	}else{
    		return null;
    	}
    }
    
    public function getElementInformation($search,$option){
    	/** Obtengo la informaci�n de los elementos $id*/
    	//con esta l�nea cargamos la base de datos esalud y la asignamos a $esaludDb
    	$esaludDb = $this->load->database('esalud', TRUE);
    	// Hago la consulta a la base de datos
    	$busqueda="CD_ELE,
    			   NOM_ELE,
				   COD_RIPS_ELE,
    			   COD_ALTER2_ELE";
    	if($option==1){
    		// Busqueda de informaci�n por c�digo
    		$sql="select $busqueda
    		from T_ELEMENTOS
    		where CD_ELE='$search'";
    	}else {
    		// Busqueda de informaci�n por nombre
    		$sql="select $busqueda
    		from T_ELEMENTOS
    		where NOM_ELE LIKE '%$search%'
    		";
    	}
    
    	$result=$esaludDb->query($sql);
    	if($result->num_rows()>0){
    		return $result->result();
    	}else{
    		return null;
    	}
    }
    
    public function getCompaniesInformation(){
    	/** Obtengo la informaci�n de las empresas creadas en Esalud*/
    	//con esta l�nea cargamos la base de datos esalud y la asignamos a $esaludDb
    	$esaludDb = $this->load->database('esalud', TRUE);
    	$sql="select * from T_APB";
    	
    	$result=$esaludDb->query($sql);
    	if($result->num_rows()>0){
    		return $result->result();
    	}else{
    		return null;
    	}
    }
    
    public function getFieldFromTableNotId($table,$campo,$campoBusqueda,$valor){
    	/** Selecciono el valor actual para el campo $campo del registro con $campoBusqueda $valor*/
    	$esaludDb = $this->load->database('esalud', TRUE);
    	$esaludDb->select($campo);
    	$esaludDb->from($table);
    	$esaludDb->where($campoBusqueda, $valor);
    	$consulta = $esaludDb->get();
    	if($consulta->num_rows()>0){
    		$resultado = $consulta->row();
    		$return =$resultado->$campo;
    		return $return;
    	}
    }
	    
}
?>
