<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electr�nico:         jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:                  Clase en las cuales se definen las operaciones CRUD frente a las tablas que tienen relaci�n con la aplicaci�n Calificador y todos sus modulo
 */

class PollsModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	/* ---------------------------------------------------------- INSERT ---------------------------------------------------------*/

	public function insertQuestions($nombre,$descripcion,$usuario){
	    /** Se inserta la informaci�n de la tabla CAL_PREGUNTA*/
	    
	    //Obtiene el siguiente ID
	    $consecutivo =$this->FunctionsGeneral->countMax('CAL_PREGUNTA','ID',1);
	    $data = array(
	        'ID' => $consecutivo,
	        'NOMBRE' => $nombre,
	        'DESCRIPCION' => $descripcion   ,
	        'ESTADO' => 'S',
	        'UCREA' => $usuario,
	        'FCREA' => cambiaHoraServer(),
	        'UMOD' => $usuario,
	        'FMOD' => cambiaHoraServer()
	    );
	    //Realizo el insert sobre la base de datos en la tabla CAL_PREGUNTA
	    $this->db->insert('CAL_PREGUNTA', $data);
	    return $consecutivo;
	}
	
	public function insertOptionsQuestions($contador,$valor,$usuario){
		/** Se inserta la informaci�n de la tabla CAL_RESPUESTA*/
	
		//Obtiene el siguiente ID
		$consecutivo =$this->FunctionsGeneral->countMax('CAL_RESPUESTA','ID',1);
		$data = array(
				'ID' => $consecutivo,
				'ID_PREGUNTA' => $contador,
		        'NOMBRE' => $valor,
				'ESTADO' => 'S',
				'UCREA' => $usuario,
				'FCREA' => cambiaHoraServer(),
				'UMOD' => $usuario,
				'FMOD' => cambiaHoraServer()
		);
		//Realizo el insert sobre la base de datos en la tabla CAL_RESPUESTA
		$this->db->insert('CAL_RESPUESTA', $data);
		return $consecutivo;
	}
	
	public function insertPoll($nombre,$descripcion,$datos,$observacion,$usuario){
	    /** Se inserta la informaci�n de la tabla CAL_ENCUESTA*/
	    
	    //Obtiene el siguiente ID
	    $consecutivo =$this->FunctionsGeneral->countMax('CAL_ENCUESTA','ID',1);
	    $data = array(
	        'ID' => $consecutivo,
	        'NOMBRE' => $nombre,
	        'DESCRIPCION' => $descripcion   ,
	        'DATOPERSONAL' => $datos   ,
	        'OBSERVACION' => $observacion   ,
	        'ESTADO' => 'S',
	        'UCREA' => $usuario,
	        'FCREA' => cambiaHoraServer(),
	        'UMOD' => $usuario,
	        'FMOD' => cambiaHoraServer()
	    );
	    //Realizo el insert sobre la base de datos en la tabla CAL_ENCUESTA
	    $this->db->insert('CAL_ENCUESTA', $data);
	    return $consecutivo;
	}
	
	public function insertPollQuestions($encuesta,$pregunta,$usuario){
	    /** Se inserta la informaci�n de la tabla CAL_ENCUPREG*/
	    
	    //Obtiene el siguiente ID
	    $consecutivo =$this->FunctionsGeneral->countMax('CAL_ENCUPREG','ID',1);
	    $data = array(
	        'ID' => $consecutivo,
	        'ID_PREGUNTA' => $pregunta,
	        'ID_ENCUESTA' => $encuesta,
	        'ESTADO' => 'S',
	        'UCREA' => $usuario,
	        'FCREA' => cambiaHoraServer(),
	        'UMOD' => $usuario,
	        'FMOD' => cambiaHoraServer()
	    );
	    //Realizo el insert sobre la base de datos en la tabla CAL_ENCUPREG
	    $this->db->insert('CAL_ENCUPREG', $data);
	    return $consecutivo;
	}
	
	
	public function insertPollActual($encuesta,$usuario){
	    /** Se inserta la informaci�n de la tabla CAL_EJECUTA*/
	    
	    //Obtiene el siguiente ID
	    $consecutivo =$this->FunctionsGeneral->countMax('CAL_EJECUTA','ID',1);
	    $data = array(
	        'ID' => $consecutivo,
	        
	        'ID_ENCUESTA' => $encuesta,
	        'ESTADO' => 'S',
	        'UCREA' => $usuario,
	        'FCREA' => cambiaHoraServer(),
	        'UMOD' => $usuario,
	        'FMOD' => cambiaHoraServer()
	    );
	    //Realizo el insert sobre la base de datos en la tabla CAL_EJECUTA
	    $this->db->insert('CAL_EJECUTA', $data);
	    return $consecutivo;
	}
	
	public function insertPollEvaluation($fecha,$hora,$encuesta,$tipo,$documento,$nombres,$apellidos,$correo,$telefono,$tratamiento,$observacion,$usuario){
	    /** Se inserta la informaci�n de la tabla CAL_CALIFICADOR*/
	    
	    //Obtiene el siguiente ID
	    $consecutivo =$this->FunctionsGeneral->countMax('CAL_CALIFICADOR','ID',1);
	    $data = array(
	        'ID' => $consecutivo,
	        'FECHA' => $fecha,
	        'HORA' => $hora,
	        'ID_ENCUESTA' => $encuesta,
	        'ID_TIPO' => $tipo,
	        'DOCUMENTO' => $documento,
	        'NOMBRES' => $nombres,
	        'APELLIDOS' => $apellidos,
	        'CORREO' => $correo,
	        'TELEFONO' => $telefono,
	        'TRATAMIENTO' => $tratamiento,
	        'OBSERVACION' => $observacion,
	        'ESTADO' => 'S',
	        'UCREA' => $usuario,
	        'FCREA' => cambiaHoraServer(),
	        'UMOD' => $usuario,
	        'FMOD' => cambiaHoraServer()
	    );
	    //Realizo el insert sobre la base de datos en la tabla CAL_CALIFICADOR
	    $this->db->insert('CAL_CALIFICADOR', $data);
	    return $consecutivo;
	}
	
	public function insertPollEvaluationDetail($encuesta,$respuesta,$usuario){
	    /** Se inserta la informaci�n de la tabla CAL_CALIFVALOR*/
	    
	    //Obtiene el siguiente ID
	    $consecutivo =$this->FunctionsGeneral->countMax('CAL_CALIFVALOR','ID',1);
	    $data = array(
	        'ID' => $consecutivo,
	        'ID_CALIFICADOR' => $encuesta,
	        'ID_RESPUESTA' => $respuesta,
	        'ESTADO' => 'S',
	        'UCREA' => $usuario,
	        'FCREA' => cambiaHoraServer(),
	        'UMOD' => $usuario,
	        'FMOD' => cambiaHoraServer()
	    );
	    //Realizo el insert sobre la base de datos en la tabla CAL_CALIFVALOR
	    $this->db->insert('CAL_CALIFVALOR', $data);
	    return $consecutivo;
	}
	
	/* ---------------------------------------------------------- TODO UPDATE ---------------------------------------------------------*/
	
	
	
	
	
	
	/* ---------------------------------------------------------- TODO DELETE ---------------------------------------------------------*/
	
	public function deleteQuestionsOption($id) {
	    /**
	     * Elimina relaciones de las respuestas asocidas a la pregunta con id $id
	     */
	    $this->db->where ( 'ID_PREGUNTA', $id );
	    $this->db->delete ( 'CAL_RESPUESTA' );
	}
	
	public function deleteQuestionsPoll($id) {
	    /**
	     * Elimina relaciones de las preguntas asocidas a la encuesta con id $id
	     */
	    $this->db->where ( 'ID_ENCUESTA', $id );
	    $this->db->delete ( 'CAL_ENCUPREG' );
	}
	
	
	
	
	
	/* ---------------------------------------------------------- SELECT ---------------------------------------------------------*/
	
	
	public function getListValueQuestions() {
	    /**
	     * Obtiene el detalle de las lista de la relaci�n de $id la cual corresponde la pregunta $id
	     */
	    $sql = "select *
                from CAL_PREGUNTA
                where CAL_PREGUNTA.ESTADO='".ACTIVO_ESTADO."'
                ";
	    $result = $this->db->query ( $sql );
	    if ($result->num_rows () > 0) {
	        return $result->result ();
	    } else {
	        return null;
	    }
	}
	
	public function getListValueQuestionsOption($id) {
	    /**
	     * Obtiene el detalle de las lista de la relaci�n de $id la cual corresponde la pregunta $id
	     */
	    $sql = "select *
                from CAL_RESPUESTA
                where CAL_RESPUESTA.ID_PREGUNTA='" . $id . "'
                AND CAL_RESPUESTA.ESTADO='".ACTIVO_ESTADO."'
                ";
	    $result = $this->db->query ( $sql );
	    if ($result->num_rows () > 0) {
	        return $result->result ();
	    } else {
	        return null;
	    }
	}
	
	public function getListPolls() {
	    /**
	     * Lista las diferentes encuestas que se encuentran definidas dentro de la aplicaci�n
	     */
	    $sql = "select *
                from CAL_ENCUESTA
                where CAL_ENCUESTA.ESTADO='".ACTIVO_ESTADO."'
                ";
	    $result = $this->db->query ( $sql );
	    if ($result->num_rows () > 0) {
	        return $result->result ();
	    } else {
	        return null;
	    }
	}
	public function getListValueQuestionsPoll($id) {
	    /**
	     * Obtiene el listado de preguntas que se han asignado a la encuesta   
	     */
	    $sql = "select *
                from CAL_ENCUPREG
                where CAL_ENCUPREG.ID_ENCUESTA='" . $id . "'
                AND CAL_ENCUPREG.ESTADO='".ACTIVO_ESTADO."'
                ";
	   // echo $sql;
	    $result = $this->db->query ( $sql );
	    if ($result->num_rows () > 0) {
	        return $result->result ();
	    } else {
	        return null;
	    }
	}
	
	
	public function getListValueQuestionsPollDetail($id) {
	    /**
	     * Obtiene el listado de preguntas que se han asignado a la encuesta
	     */
	    $sql = "select CAL_PREGUNTA.ID,
                       CAL_PREGUNTA.DESCRIPCION
                from CAL_ENCUPREG, CAL_PREGUNTA
                where CAL_ENCUPREG.ID_ENCUESTA='" . $id . "'
                AND CAL_PREGUNTA.ID=CAL_ENCUPREG.ID_PREGUNTA
                AND CAL_ENCUPREG.ESTADO='".ACTIVO_ESTADO."'
                ";
	    //ECHO $sql;
	    $result = $this->db->query ( $sql );
	    if ($result->num_rows () > 0) {
	        return $result->result ();
	    } else {
	        return null;
	    }
	}
	
	public function getQuantityOfResponse($id,$fechaInicial, $fechaFinal) {
	    /**
	     * Obtiene el listado de preguntas que se han asignado a la encuesta
	     */
	    $sql = "SELECT count(*) as CANTIDAD
                FROM CAL_CALIFICADOR, CAL_CALIFVALOR , CAL_RESPUESTA, CAL_PREGUNTA
                where CAL_CALIFVALOR.ID_CALIFICADOR = CAL_CALIFICADOR.ID
                and CAL_CALIFVALOR.ID_RESPUESTA = CAL_RESPUESTA.ID
                and CAL_RESPUESTA.ID_PREGUNTA = CAL_PREGUNTA.ID
                and CAL_CALIFICADOR.FECHA BETWEEN '$fechaInicial' and '$fechaFinal'
                and CAL_CALIFVALOR.ID_RESPUESTA='$id'";
	    
	    //ECHO $sql;
	    $result = $this->db->query ( $sql );
	    if ($result->num_rows () > 0) {
	        $return= $result->result ();
	    } else {
	        $return= null;
	    }
	    
	    if($return!=null){
	        foreach ($return as $value){
	            return     $value->CANTIDAD;
	        }
	    }else{
	        return 0;
	    }
	}
	
	public function getQuantityOfQuestion($id,$fechaInicial, $fechaFinal) {
	    /**
	     * Obtiene el listado de preguntas que se han asignado a la encuesta
	     */
	    $sql = "SELECT count(*) as CANTIDAD
                FROM CAL_CALIFICADOR, CAL_CALIFVALOR , CAL_RESPUESTA, CAL_PREGUNTA
                where CAL_CALIFVALOR.ID_CALIFICADOR = CAL_CALIFICADOR.ID
                and CAL_CALIFVALOR.ID_RESPUESTA = CAL_RESPUESTA.ID
                and CAL_RESPUESTA.ID_PREGUNTA = CAL_PREGUNTA.ID
                and CAL_CALIFICADOR.FECHA BETWEEN '$fechaInicial' and '$fechaFinal'
                and CAL_PREGUNTA.ID='$id'";
	    
	    //ECHO $sql;
	    $result = $this->db->query ( $sql );
	    if ($result->num_rows () > 0) {
	        $return= $result->result ();
	    } else {
	        $return= null;
	    }
	    
	    if($return!=null){
	        foreach ($return as $value){
	            return     $value->CANTIDAD;
	        }
	    }else{
	        return 0;
	    }
	}
}
?>