<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electrónico:         jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:                  Clase en las cuales se definen las operaciones CRUD frente a las tablas que tienen relación con la aplicación Brigadas y todos sus modulo
 */

class BrigadesModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/* ---------------------------------------------------------- INSERT ---------------------------------------------------------*/
	public function insertHeadBrigade($contador,$municipio,$monto,$usuario){
		/** Se inserta la información de la tabla BRI_ENCBRIG*/
	
		//Obtiene el siguiente ID
		$consecutivo =$this->FunctionsGeneral->countMax('BRI_ENCBRIG','ID',1);
		$data = array(
				'ID' => $consecutivo,
				'CONTADOR' => $contador,
		        'MONTO' => $monto,
				'ID_MUNICIPIO' => $municipio,
				'ESTADO' => 'S',
				'UCREA' => $usuario,
				'FCREA' => cambiaHoraServer(),
				'UMOD' => $usuario,
				'FMOD' => cambiaHoraServer()
		);
		//Realizo el insert sobre la base de datos en la tabla BRI_ENCBRIG
		$this->db->insert('BRI_ENCBRIG', $data);
		return $consecutivo;
	}
	
	public function insertBodyBrigade($fase,
								$encabezado,
								$convenio,
								$fechaInicial,
								$fechaFinal,
								$tsocial,
								$protesista,
								$medico,
								$fisio,
								$ocupacional,
								$facilitador,
								$visitante,
								$ortesista,
								$usuario){
		/** Se inserta la información de la tabla BRI_BRIGADA*/
	
		//Obtiene el siguiente ID
		$consecutivo =$this->FunctionsGeneral->countMax('BRI_BRIGADA','ID',1);
		$data = array(
				'ID' => $consecutivo,
				'ID_FASEBRIG' => $fase,
				'ID_ENCBRIG' => $encabezado,
				'ID_CONVENIOBRIG' => $convenio,
				'FECHAINI' => $fechaInicial,
				'FECHAFIN' => $fechaFinal,
				'TSOCIAL' => $tsocial,
				'TECNICO' => $protesista,
				'MEDICO' => $medico,
				'FISIO' => $fisio,
				'TOCU' => $ocupacional,
				'FACILITADOR' => $facilitador,
				'INVITADO' => $visitante,
				'TORTE' => $ortesista,
				'ESTADO' => 'S',
				'UCREA' => $usuario,
				'FCREA' => cambiaHoraServer(),
				'UMOD' => $usuario,
				'FMOD' => cambiaHoraServer()
		);
		//Realizo el insert sobre la base de datos en la tabla BRI_BRIGADA
		$this->db->insert('BRI_BRIGADA', $data);
		return $consecutivo;
	}
	
	
	/** ---------------------------------------------------------- TODO UPDATE ---------------------------------------------------------*/
	
	public function updateBodyBrigade(
			$id,
			$fase,
			$encabezado,
			$convenio,
			$fechaInicial,
			$fechaFinal,
			$tsocial,
			$protesista,
			$medico,
			$fisio,
			$ocupacional,
			$facilitador,
			$visitante,
			$ortesista,
			$usuario){
				/** Se actualiza la información de la tabla BRI_BRIGADA*/
	
				//Obtiene el siguiente ID
				$consecutivo =$this->FunctionsGeneral->countMax('BRI_BRIGADA','ID',1);
				$data = array(
						'ID_FASEBRIG' => $fase,
						'ID_ENCBRIG' => $encabezado,
						'ID_CONVENIOBRIG' => $convenio,
						'FECHAINI' => $fechaInicial,
						'FECHAFIN' => $fechaFinal,
						'TSOCIAL' => $tsocial,
						'TECNICO' => $protesista,
						'MEDICO' => $medico,
						'FISIO' => $fisio,
						'TOCU' => $ocupacional,
						'FACILITADOR' => $facilitador,
						'INVITADO' => $visitante,
						'TORTE' => $ortesista,
						'UMOD' => $usuario,
						'FMOD' => cambiaHoraServer()
				);
				//Realizo el update sobre la base de datos en la tabla BRI_BRIGADA
				$this->db->where('ID', $id);
				$this->db->update('BRI_BRIGADA', $data);
	}
	
	
	
	
	/* ---------------------------------------------------------- TODO DELETE ---------------------------------------------------------*/
	
	
	
	
	
	/* ---------------------------------------------------------- SELECT ---------------------------------------------------------*/
	
	public function selectListBrigades($condicion=null) {
		/** Seleccciona el listado de brigadas que están definidas dentro del sistema*/
		$sql="select BRI_ENCBRIG.ID,
					 BRI_ENCBRIG.ID_MUNICIPIO,
					 ADM_MUNICIPIO.NOMBRE AS MUNICIPIO,
					 ADM_DEPARTAMENTO.NOMBRE AS DEPARTAMENTO,
					 BRI_BRIGADA.FECHAINI AS FECHA,
					 BRI_ENCBRIG.ESTADO AS ESTADO
				from ADM_MUNICIPIO,ADM_DEPARTAMENTO, BRI_ENCBRIG
						LEFT JOIN BRI_BRIGADA
							ON BRI_ENCBRIG.ID=BRI_BRIGADA.ID_ENCBRIG
							$condicion
				where BRI_ENCBRIG.ID_MUNICIPIO=ADM_MUNICIPIO.ID
				and ADM_MUNICIPIO.ID_DEPARTAMENTO=ADM_DEPARTAMENTO.ID
				
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