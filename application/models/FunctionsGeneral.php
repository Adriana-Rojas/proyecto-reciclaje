<?php

/** 
 *************************************************************************
 *************************************************************************
     Creado por:                 Juan Carlos Escobar Baquero
     Correo electr�nico:         jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
     Prop�sito:                  Funciones varias para registros sobre las tablas de la base de datos 
 */
class FunctionsGeneral extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}


	/* ---------------------------------------------------------- INSERT ---------------------------------------------------------*/
	public function insertOneParameter($table, $field, $value, $usuario)
	{
		/** Se se inserta la informaci�n en la tabla $table para el campo $field con el valor $value*/

		//Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax($table, 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			$field => $value,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		//Realizo el insert sobre la base de datos en la tabla $table
		$this->db->insert($table, $data);
		return $consecutivo;
	}

	public function insertTwoParameter($table, $field, $value, $field2, $value2, $usuario)
	{
		/** Se se inserta la informaci�n en la tabla $table para el campo $field con el valor $value*/

		//Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax($table, 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			$field => $value,
			$field2 => $value2,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		//Realizo el insert sobre la base de datos en la tabla $table
		$this->db->insert($table, $data);
		return $consecutivo;
	}

	public function insertcuatroParameter($table, $usuario, $field, $value, $field2, $value2, $field3, $value3, $field4, $value4)
	{
		/** Se se inserta la informaci�n en la tabla $table para el campo $field con el valor $value*/

		//Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax($table, 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			$field => $value,
			$field2 => $value2,
			$field3 => $value3,
			$field4 => $value4,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		//Realizo el insert sobre la base de datos en la tabla $table
		$this->db->insert($table, $data);
		return $consecutivo;
	}
	public function insertcincoParameter($table, $usuario, $field, $value, $field2, $value2, $field3, $value3, $field4, $value4, $field5, $value5)
	{
		/** Se se inserta la informaci�n en la tabla $table para el campo $field con el valor $value*/

		//Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax($table, 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			$field => $value,
			$field2 => $value2,
			$field3 => $value3,
			$field4 => $value4,
			$field5 => $value5,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		//Realizo el insert sobre la base de datos en la tabla $table
		$this->db->insert($table, $data);
		return $consecutivo;
	}
	/* public function updateByIva($tabla, $campo, $valor, $id){
		$data = array(
			$campo => $valor
		);
		$this->db->where('ID', $id);
		$this->db->update($tabla, $data);
	} */

	/* ---------------------------------------------------------- UPDATE ---------------------------------------------------------*/

	public function updateByID($tabla, $campo, $valor, $id, $usuario)
	{
		/** Rutina para actualizar el campo $campo de la tabla $tabla para el registro de id con valor $id*/
		$data = array(
			$campo => $valor,
			'FMOD' =>  cambiaHoraServer(),
			'UMOD' => $usuario
		);
		$this->db->where('ID', $id);
		$this->db->update($tabla, $data);
	}

	public function updateByField($tabla, $campo, $valor, $update, $id, $usuario, $campo2 = NULL, $valor2 = null, $campo3 = null, $valor3 = null)
	{
		/** Rutina para actualizar el campo $campo de la tabla $tabla para el registro de id con valor $id*/
		$data = array(
			$campo => $valor,
			'FMOD' =>  cambiaHoraServer(),
			'UMOD' => $usuario
		);
		$this->db->where($update, $id);
		if ($campo2 != NULL) {
			$this->db->where($campo2, $valor2);
		}
		if ($campo3 != NULL) {
			$this->db->where($campo3, $valor3);
		}
		$this->db->update($tabla, $data);
	}

	/* ---------------------------------------------------------- DELETE ---------------------------------------------------------*/


	/* ---------------------------------------------------------- SELECT ---------------------------------------------------------*/
	public function getDocumentUser($table, $campo, $document)
	{
		/** Selecciono el valor actual para el campo $campo del registro con id $id*/
		//echo "campo: ".$campo." tabla: ".$table." ID:".$id."<br>";
		$this->db->select($campo);
		$this->db->from($table);
		$this->db->where('DOCUMENTO', $document);
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		if ($resultado != null) {
			$return = $resultado->$campo;
		} else {
			$return = null;
		}
		//echo $return;
		return $return;
	}
	public function getFieldFromTable($table, $campo, $id)
	{
		/** Selecciono el valor actual para el campo $campo del registro con id $id*/
		//echo "campo: ".$campo." tabla: ".$table." ID:".$id."<br>";
		$this->db->select($campo);
		$this->db->from($table);
		$this->db->where('ID', $id);
		$consulta = $this->db->get();
		$resultado = $consulta->row();
		if ($resultado != null) {
			$return = $resultado->$campo;
		} else {
			$return = null;
		}
		//echo $return;
		return $return;
	}

	public function getFieldFromTableNotId($table, $campo, $campoBusqueda, $valor)
	{
		/** Selecciono el valor actual para el campo $campo del registro con $campoBusqueda $valor*/
		$this->db->select($campo);
		$this->db->from($table);
		$this->db->where($campoBusqueda, $valor);
		$consulta = $this->db->get();
		if ($consulta->num_rows() > 0) {
			$resultado = $consulta->row();
			$return = $resultado->$campo;
			return $return;
			//  echo "<script>console.log('Console: " . $return . "' );</script>";
		}
	}

	public function getSeguimiento($CONSECUTIVO, $campo = 'TIPO')
	{

		if ($CONSECUTIVO == null) {
			$CONSECUTIVO = 0;
		}
		$sql = "SELECT
		TOP 1 T.NOMBRE AS TIPO
		FROM
			COT_TIPOSEG T,
			COT_COTIZACION C,
			COT_SEGUIMIENTO S,
			ADM_USUROLPER U,
			ADM_USUARIO US,
			ADM_ROLPERFIL R,
			ADM_PERFIL P
		WHERE
			C.CONSECUTIVO = $CONSECUTIVO
		AND C.ID = S.ID_COTIZACION
		AND S.ID_TIPOSEG = T.ID
		AND S.ESTADO = 'S'
		AND U.ID_USUARIO = US.ID
		AND U.ID_ROLPERFIL = R.ID
		AND R.ID_PERFIL = P.ID
		AND S.UCREA = US.ID 
		ORDER BY
		S.ID DESC";
		//echo $sql;
		$consulta = $this->db->query($sql);
		if ($consulta->num_rows() > 0) {
			$resultado = $consulta->row();
			$return = $resultado->TIPO;
			return $return;
			//  echo "<script>console.log('Console: " . $return . "' );</script>";
		}
	}


	public function getFieldFromTableNotIdFields($table, $campo, $campoBusqueda, $valor, $campo2 = NULL, $valor2 = null, $campo3 = null, $valor3 = null, $campo4 = null, $valor4 = null, $campo5 = null, $valor5 = null)
	{
		/** Selecciono el valor actual para la condici�n que cumplen los diferentes campos*/

		$this->db->select($campo);
		$this->db->from($table);
		$this->db->where($campoBusqueda, $valor);
		if ($campo2 != NULL) {
			$this->db->where($campo2, $valor2);
		}
		if ($campo3 != NULL) {
			$this->db->where($campo3, $valor3);
		}
		if ($campo4 != NULL) {
			$this->db->where($campo4, $valor4);
		}
		if ($campo5 = NULL) {
			$this->db->where($campo5, $valor5);
		}
		$consulta = $this->db->get();

		//echo "<script>console.log('consulta: " . $consulta . "' );</script>";

		if ($consulta->num_rows() > 0) {
			$resultado = $consulta->row();
			$return = $resultado->$campo;
			return $return;
		}
	}

	public function numRowsAll($table, $increase, $campoBusqueda, $valor)
	{
		/**Cuent la cantidad de filas que tiene la tabla $table, cuando no se requiere condici�n*/
		$this->db->select('count(id) as rows');
		$this->db->from($table);
		$this->db->where($campoBusqueda, $valor);
		$query = $this->db->get();
		foreach ($query->result() as $r) {
			$r->rows;
		}
		return  $increase + $r->rows;
	}

	public function numRows($table, $increase)
	{
		/**Cuent la cantidad de filas que tiene la tabla $table, cuando no se requiere condici�n*/
		$this->db->select('count(id) as rows');
		$this->db->from($table);
		$query = $this->db->get();
		foreach ($query->result() as $r) {
			$r->rows;
		}
		return  $increase + $r->rows;
	}

	public function countMax($table, $field, $increase)
	{
		/**Encuentra el m�ximo del campo $id dentro de una tabla $table y los incrementa al valor $increase*/
		/*$this->db->select('count(id) as rows');
    	$this->db->from($table);
    	$query = $this->db->get();
    	foreach($query->result() as $r)
    	{
    		$r->rows;
    	}*/

		$this->db->select_max($field);
		$this->db->from($table);

		$query = $this->db->get();
		//$r=$query->result();
		foreach ($query->result() as $r) {
			$r->$field;
		}

		//Retornar el valor siguiente (mayor)
		return  $increase + $r->$field;
	}

	public function countMaxCondition($table, $field, $campoBusqueda, $valor, $campo2 = NULL, $valor2 = null, $campo3 = null, $valor3 = null, $campo4 = null, $valor4 = null, $campo5 = null, $valor5 = null)
	{


		$this->db->select_max($field);
		$this->db->from($table);
		$this->db->where($campoBusqueda, $valor);
		if ($campo2 != NULL) {
			$this->db->where($campo2, $valor2);
		}
		if ($campo3 != NULL) {
			$this->db->where($campo3, $valor3);
		}
		if ($campo4 != NULL) {
			$this->db->where($campo4, $valor4);
		}
		if ($campo5 = NULL) {
			$this->db->where($campo5, $valor5);
		}

		$query = $this->db->get();
		$r = $query->result();
		foreach ($query->result() as $r) {
			$r->$field;
		}

		//Retornar el valor siguiente (mayor)
		return  $r->$field;
	}


	public function getQuantityFieldFromTable($table, $campo, $valor, $campo2 = NULL, $valor2 = null, $campo3 = null, $valor3 = null, $campo4 = null, $valor4 = null, $campo5 = null, $valor5 = null)
	{
		/** Selecciono la cantidad de registros que cumplen de acuerdo a la condiciones dadas*/

		$this->db->where($campo, $valor);
		if ($campo2 != NULL) {
			$this->db->where($campo2, $valor2);
		}
		if ($campo3 != NULL) {
			$this->db->where($campo3, $valor3);
		}
		if ($campo4 != NULL) {
			$this->db->where($campo4, $valor4);
		}
		if ($campo5 != NULL) {
			$this->db->where($campo5, $valor5);
		}
		$this->db->from($table);
		$query = $this->db->get();
		return count($query->result());
	}

	public function selectValoresListaTabla($tabla, $order = null, $estado = null, $campoBusqueda = NULL, $valor = null)
	{
		/** Seleccciona los registros de una tabla dada no tiene en cuenta el estado de los registros encontrados*/
		if ($order == null) {
			$order = 'ASC';
		}
		if ($estado != null) {
			$this->db->where("ESTADO", $estado);
		}
		if ($campoBusqueda != null) {
			$this->db->where($campoBusqueda, $valor);
		}


		$this->db->order_by('NOMBRE', $order);

		$consulta = $this->db->get($tabla);
		//print_r($consulta);
		return $consulta;
	}

	public function selectValoresListaTablaOrder($tabla,  $campoOrder = null, $order = null, $estado = null, $campoBusqueda = NULL, $valor = null)
	{
		/** Seleccciona los registros de una tabla dada no tiene en cuenta el estado de los registros encontrados*/
		if ($order == null) {
			$order = 'ASC';
		}
		if ($estado != null) {
			$this->db->where("ESTADO", $estado);
		}
		if ($campoBusqueda != null) {
			$this->db->where($campoBusqueda, $valor);
		}


		$this->db->order_by($campoOrder, $order);

		$consulta = $this->db->get($tabla);
		//print_r($consulta);
		return $consulta;
	}

	public function selectValoresListaTablaGenerico($tabla)
	{
		/** Seleccciona los registros de una tabla dada no tiene en cuenta el estado de los registros encontrados*/

		$consulta = $this->db->get($tabla);
		//print_r($consulta);
		return $consulta;
	}

	public function selectValoresListaTablaConPadre($hija, $campoHija, $padre)
	{
		/**Selecciono los registros de una tabla con su respectiva relaci�n con la tabla padre*/

		$sql = "select $hija.ID,
				     $hija.NOMBRE,
					 $padre.ID AS ID_PADRE,
					 $padre.NOMBRE as PADRE,
					 $hija.ESTADO
				 from $hija, $padre " .
			"where $padre.ID=$hija.$campoHija
    			order by  $hija.ID";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectValoresListaTablaConPadreCondicion($hija, $campoHija, $padre, $valor, $estado)
	{
		/**Selecciono los registros de una tabla con su respectiva relaci�n con la tabla padre con condiciones*/

		$sql = "select $hija.ID,
    	$hija.NOMBRE,
    	$padre.ID AS ID_PADRE,
    	$padre.NOMBRE as PADRE,
    	$hija.ESTADO
    	from $hija, $padre " .
			"where $padre.ID=$hija.$campoHija
    	and $hija.$campoHija='$valor'
    	and $hija.ESTADO='$estado'
    	order by  $hija.ID";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectMaxCondicion($tabla, $campo, $condicion)
	{
		/**Selecciono EL VALOR M�XIMO CONFORME A LA CONDICION*/

		$sql = "select max($campo) as MAXIMO
        from $tabla " .
			"where $condicion";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
}
