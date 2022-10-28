<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electr�nico:         jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:                  Clase en las cuales se definen las operaciones CRUD frente a las tablas que tienen relaci�n con la aplicaci�n Hogar de paso y todos sus modulos
 */
class StokePriceModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* ---------------------------------------------------------- INSERT --------------------------------------------------------- */
	public function insertDetailsInformation($codigo, $auxiliar, $tipo, $proveedor, $descripcion, $materiales, $mano, $asociados, $entrega, $garantia, $origen, $imagen, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_DESCRIPCION
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_DESCRIPCION', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'CODIGO' => $codigo,
			'AUXILIAR' => $auxiliar,
			'ID_TIPO' => $tipo,
			'ID_PROVEEDOR' => $proveedor,
			'DESCRIPCION' => $descripcion,

			'MATERIALES' => $materiales,
			'MANOOBRA' => $mano,
			'ASOCIADOS' => $asociados,

			'TENTREGA' => $entrega,
			'GARANTIA' => $garantia,
			'ID_PAIS' => $origen,
			'IMAGEN' => $imagen,

			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_DESCRIPCION
		$this->db->insert('COT_DESCRIPCION', $data);
		return $consecutivo;
	}

	public function insertRate($nombre, $elementos, $servicios, $productos, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_TARIFA
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_TARIFA', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'NOMBRE' => $nombre,
			'MARGEN_ELEMENTOS' => $elementos,
			'MARGEN_PRODUCTOS' => $productos,
			'MARGEN_SERVICIOS' => $servicios,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_TARIFA
		$this->db->insert('COT_TARIFA', $data);
		return $consecutivo;
	}

	public function insertRateForCompany($empresa, $tarifa, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_TARIFAEMPRESA
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_TARIFAEMPRESA', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_EMPRESA' => $empresa,
			'ID_TARIFA' => $tarifa,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_TARIFAEMPRESA
		$this->db->insert('COT_TARIFAEMPRESA', $data);
		return $consecutivo;
	}

	public function insertListForCompany($empresa, $cerrada, $codigo, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_EMPRESALISTA
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_EMPRESALISTA', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_EMPRESA' => $empresa,
			'ID_CERRADA' => $cerrada,
			'ID_CODIGO' => $codigo,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_EMPRESALISTA
		$this->db->insert('COT_EMPRESALISTA', $data);
		return $consecutivo;
	}

	public function insertListForCompanyElements($empresa, $codigo, $auxiliar, $precio, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_LISTAELEMENTOS
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_LISTAELEMENTOS', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_EMPRESA' => $empresa,
			'ID_CODIGO' => $codigo,
			'AUXILIAR' => $auxiliar,
			'PRECIO' => $precio,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_LISTAELEMENTOS
		$this->db->insert('COT_LISTAELEMENTOS', $data);
		return $consecutivo;
	}

	public function insertUserInformation($tipoDoc, $documento, $nombre, $apellidos, $telefono, $correo, $direccion, $ciudad, $fijo, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_USUARIO
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_USUARIO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'TIPODOC' => $tipoDoc,
			'DOCUMENTO' => $documento,
			'ID_MUNICIPIO' => $ciudad,
			'DIRECCION' => $direccion,
			'FIJO' => $fijo,
			'DOCUMENTO' => $documento,
			'NOMBRES' => $nombre,
			'APELLIDOS' => $apellidos,
			'CORREO' => $correo,
			'TELEFONO' => $telefono,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()


		);
		// Realizo el insert sobre la base de datos en la tabla COT_USUARIO
		$this->db->insert('COT_USUARIO', $data);
		return $consecutivo;
	}

	public function insertRequestInformation($empresa, $proceso, $convenio, $brigada, $ejecutivo, $idUsuario, $adjunto1, $adjunto2, $usuario, $fechaCotizacion)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_SOLICITUD
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_SOLICITUD', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_EMPRESA' => $empresa,
			'ID_PROCESO' => $proceso,
			'ID_ALIADA' => $convenio,
			'ID_BRIGADA' => $brigada,
			'EJECUTIVO' => $ejecutivo,
			'ID_USUARIO' => $idUsuario,
			'ADJUNTO1' => $adjunto1,
			'ADJUNTO2' => $adjunto2,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer(),
			'FECHA_SOLICITUD_COTIZACION' => $fechaCotizacion

		);
		// Realizo el insert sobre la base de datos en la tabla COT_SOLICITUD
		$this->db->insert('COT_SOLICITUD', $data);
		return $consecutivo;
	}
	/*insertRequestInformation('ID', 'ID_EMPRESA', 'ID_PROCESO', 'ID_ALIADA', 'ID_BRIGADA', 'EJECUTIVO', 'ID_USUARIO', 'ADJUNTO1', 'ADJUNTO2', 'ESTADO', 'UCREA', 'FCREA', 'UMOD', 'FMOD');*/

	public function insertStokePriceHead($idSolicitud, $idCoti, $fecha, $idTipo, $idEmpresa, $formula, $observacion, $medico, $especialidad, $pago, $vigencia, $incluye, $descuento, $vendedor, $usuario, $conceptoAdicional)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_COTIZACION
	     $idSolicitud,$idCoti,$fecha,$idTipo,$idEmpresa,$formula,$observacion,$medico,$especialidad,$pago ,$vigencia,$incluye,$descuento,$vendedor,$usuario
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_COTIZACION', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'CONSECUTIVO' => $idCoti,
			'FECHA' => $fecha,
			'ID_SOLICITUD' => $idSolicitud,
			'ID_TIPO' => $idTipo,
			'ID_EMPRESA' => $idEmpresa,
			'COSTO_ADC' => $formula,
			'OBSERVACION' => $observacion,
			'MEDICO' => $medico,
			'ESPECIALIDAD' => $especialidad,
			'ID_PAGO' => $pago,
			'ID_TIEMPO' => $vigencia,
			'ID_INCLUYE' => $incluye,
			'DESCUENTO' => $descuento,
			'VENDEDOR' => $vendedor,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer(),
			'CONCEPTO_ADICIONAL' => $conceptoAdicional
		);
		// Realizo el insert sobre la base de datos en la tabla COT_COTIZACION
		$this->db->insert('COT_COTIZACION', $data);
		return $consecutivo;
	}


	public function insertStokePriceHeadHistory(
		$idCotizacion,
		$fecha,
		$descuento,
		$idTipo,
		$pago,
		$vigencia,
		$idEmpresa,
		$incluye,
		$formula,
		$observacion,
		$medico,
		$especialidad,
		$vendedor,
		$usuario
	) {
		/**
		 * Se inserta la informaci�n de la tabla COT_HISTCOTIZACION
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_HISTCOTIZACION', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_COTIZACION' => $idCotizacion,
			'FECHA' => $fecha,
			'ID_TIPO' => $idTipo,
			'ID_EMPRESA' => $idEmpresa,
			'COSTO_ADC' => $formula,
			'OBSERVACION' => $observacion,
			'MEDICO' => $medico,
			'ESPECIALIDAD' => $especialidad,
			'ID_PAGO' => $pago,
			'ID_TIEMPO' => $vigencia,
			'ID_INCLUYE' => $incluye,
			'DESCUENTO' => $descuento,
			'VENDEDOR' => $vendedor,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_HISTCOTIZACION
		$this->db->insert('COT_HISTCOTIZACION', $data);
		return $consecutivo;
	}


	public function insertStokePriceLog(
		$idCotizacion,

		$observacion,

		$usuario
	) {
		/**
		 * Se inserta la informaci�n de la tabla COT_BITACORA
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_BITACORA', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_COTIZACION' => $idCotizacion,
			'OBSERVACION' => $observacion,

			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_BITACORA
		$this->db->insert('COT_BITACORA', $data);
		return $consecutivo;
	}

	public function insertStokePriceTRM(
		$idCotizacion,

		$trm,

		$usuario
	) {
		/**
		 * Se inserta la informaci�n de la tabla COT_TRM
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_TRM', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_COTIZACION' => $idCotizacion,
			'VALOR' => $trm,

			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_TRM
		$this->db->insert('COT_TRM', $data);
		return $consecutivo;
	}


	public function insertStokePriceUser($idCoti, $idUsuario, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_USUARIOCOTI
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_USUARIOCOTI', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_USUARIO' => $idUsuario,
			'ID_COTIZACION' => $idCoti,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_USUARIOCOTI
		$this->db->insert('COT_USUARIOCOTI', $data);
		return $consecutivo;
	}

	public function insertStokePriceUserHistory($idCoti, $idUsuario, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_HISTUSUARIOCOTI
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_HISTUSUARIOCOTI', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_USUARIO' => $idUsuario,
			'ID_HISTCOTIZACION' => $idCoti,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_HISTUSUARIOCOTI
		$this->db->insert('COT_HISTUSUARIOCOTI', $data);
		return $consecutivo;
	}


	public function insertStokePriceDetail($idCoti, $codigo, $arreglo, $cantidad, $valor, $materiales, $manoobra, $adicionales, $observacion, $margen, $usuario, $valueIva)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_DETALLECOTI
		 */

		// Obtiene el siguiente ID
		if ($margen == 'Null' || $margen == 'NULL' || $margen == ' ' || $margen == '') {
			$margen = 0;
		}
		$consecutivo = $this->FunctionsGeneral->countMax('COT_DETALLECOTI', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_DESCRIPCION' => $codigo,
			'ID_COTIZACION' => $idCoti,
			'ID_ARREGLO' => $arreglo,
			'CANTIDAD' => $cantidad,
			'MANOOBRA' => $manoobra,
			'MATERIALES' => $materiales,
			'ASOCIADOS' => $adicionales,
			'VALOR' => $valor,
			'OBSERVACION' => $observacion,
			'MARGEN' => $margen,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer(),
			'IVA' => $valueIva
		);
		// Realizo el insert sobre la base de datos en la tabla COT_DETALLECOTI
		$this->db->insert('COT_DETALLECOTI', $data);
		// echo $consecutivo;
		echo "<script>console.log('Console: " . $consecutivo . "' );</script>";
		return $consecutivo;
	}

	public function insertStokePriceDetailHistory($idCoti, $codigo, $cantidad, $valor, $materiales, $manoobra, $adicionales,  $margen, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_HISTDETALLECOTI
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_HISTDETALLECOTI', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_DESCRIPCION' => $codigo,
			'ID_HISTCOTIZACION' => $idCoti,
			'CANTIDAD' => $cantidad,
			'VALOR' => $valor,
			'MANOOBRA' => $manoobra,
			'MATERIALES' => $materiales,
			'ASOCIADOS' => $adicionales,
			'MARGEN' => $margen,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_HISTDETALLECOTI
		$this->db->insert('COT_HISTDETALLECOTI', $data);
		return $consecutivo;
	}

	public function insertStokePriceTrace($idCoti, $idTipo, $observacion, $numero, $adjunto, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_SEGUIMIENTO
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_SEGUIMIENTO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_TIPOSEG' => $idTipo,
			'ID_COTIZACION' => $idCoti,
			'OBSERVACION' => $observacion,
			'AUTORIZACION' => $numero,
			'ADJUNTO' => $adjunto,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla COT_SEGUIMIENTO
		$this->db->insert('COT_SEGUIMIENTO', $data);
		return $consecutivo;
	}


	public function insertStokePriceElementList($idCoti, $idElemento, $cantidad, $valor, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_DESPIECE
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_DESPIECE', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ELEMENTO' => $idElemento,
			'ID_DETALLECOTI' => $idCoti,
			'CANTIDAD' => $cantidad,
			'VALOR' => $valor,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		//print_r($data);
		// Realizo el insert sobre la base de datos en la tabla COT_DESPIECE
		$this->db->insert('COT_DESPIECE', $data);
		return $consecutivo;
	}


	public function insertStokePriceNepsElements($codigo, $nombre, $monto, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla COT_CODIGONEPS
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('COT_CODIGONEPS', 'ID', 1);

		$data = array(
			'ID' => $consecutivo,
			'CODIGO' => $codigo,
			'NOMBRE' => $nombre,
			'MONTO' => $monto,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		//print_r($data);
		// Realizo el insert sobre la base de datos en la tabla COT_CODIGONEPS
		$this->db->insert('COT_CODIGONEPS', $data);
		return $consecutivo;
	}

	/*
	 * ---------------------------------------------------------- TODO UPDATE ---------------------------------------------------------
	 */

	public function updateDetailsInformation($id, $auxiliar, $proveedor, $descripcion, $materiales, $mano, $asociados, $entrega, $garantia, $origen, $imagen, $usuario)
	{
		/**
		 *Se actualizaa la informaci�n de la tabla COT_DESCRIPCION
		 */

		// Obtiene el siguiente ID


		$data = array(
			'AUXILIAR' => $auxiliar,
			'ID_PROVEEDOR' => $proveedor,
			'DESCRIPCION' => $descripcion,

			'MATERIALES' => $materiales,
			'MANOOBRA' => $mano,
			'ASOCIADOS' => $asociados,
			'ID_PAIS' => $origen,
			'TENTREGA' => $entrega,
			'GARANTIA' => $garantia,
			'IMAGEN' => $imagen,

			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);

		// Realizo el update sobre la base de datos en la tabla COT_DESCRIPCION
		$this->db->where('ID', $id);
		$this->db->update('COT_DESCRIPCION', $data);
	}

	public function updatetUserInformation($id, $tipoDoc, $documento, $nombre, $apellidos, $telefono, $correo, $direccion, $ciudad, $fijo, $usuario)
	{
		/**
		 * Se actualiza la informaci�n de la tabla COT_USUARIO
		 */


		// Obtiene el siguiente ID
		$data = array(
			'TIPODOC' => $tipoDoc,
			'DOCUMENTO' => $documento,
			'NOMBRES' => $nombre,
			'APELLIDOS' => $apellidos,
			'CORREO' => $correo,
			'TELEFONO' => $telefono,
			'FIJO' => $fijo,
			'ID_MUNICIPIO' => $ciudad,
			'DIRECCION' => $direccion,
			'FIJO' => $fijo,
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el update sobre la base de datos en la tabla COT_USUARIO
		$this->db->where('ID', $id);
		$this->db->update('COT_USUARIO', $data);
	}

	/* ---------------------------------------------------------- TODO DELETE --------------------------------------------------------- */

	public function deleteElementListOfStokePrice($id)
	{
		/**
		 * Elimino las relaciones de las subcuentas con los procesos
		 */
		$this->db->where('ID_DETALLECOTI', $id);
		$this->db->delete('COT_DESPIECE');
	}


	/* ---------------------------------------------------------- SELECT --------------------------------------------------------- */

	public function selectListDefineRelation($condicion = null)
	{
		/** Selecci�n detalle de los elementos y/o productos para cotizaciones*/
		$sql = "SELECT * FROM VIEW_COT_DESCRIPCION";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListDefineRelationListElements($id)
	{
		/** Selecci�n detalle de los elementos y/o productos para cotizaciones*/
		$sql = "SELECT COT_LISTAELEMENTOS.ID, 
		VIEW_COT_DESCRIPCION.CODIGO, 
		VIEW_COT_DESCRIPCION.NOMBRE, 
		COT_LISTAELEMENTOS.AUXILIAR as AUXILIAR,
		COT_LISTAELEMENTOS.PRECIO as PRECIO,
		COT_LISTAELEMENTOS.ESTADO 

		FROM VIEW_COT_DESCRIPCION, COT_LISTAELEMENTOS 

		where COT_LISTAELEMENTOS.ID_CODIGO=VIEW_COT_DESCRIPCION.ID
		and COT_LISTAELEMENTOS.ID_EMPRESA='$id'";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}


	public function selectListTraceList($condicion = null)
	{
		/** Selecci�n detalle de los elementos y/o productos para cotizaciones*/
		$sql = "SELECT * FROM COT_TIPOSEG";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListDefineRelationCompanyRates($condicion = null)
	{
		/** Selecci�n la relaci�n entre empresas y tarifas*/
		$sql = "select
                COT_TARIFAEMPRESA.ID,
                COT_TARIFAEMPRESA.ID_EMPRESA,
                COT_TARIFA.NOMBRE AS TARIFA,
                COT_TARIFAEMPRESA.ESTADO   
               from COT_TARIFAEMPRESA,COT_TARIFA
               where COT_TARIFAEMPRESA.ID_TARIFA= COT_TARIFA.ID
               $condicion
		";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListDefineRelationCompanyListCompany($condicion = null)
	{
		/** Selecci�n la relaci�n entre empresas y tarifas*/
		$sql = "select
                *
               from COT_EMPRESALISTA
               
		";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}



	public function selectListStokePriceDetail($id)
	{
		/** Selecci�n detalle de los elementos y/o productos para cotizaciones con $id */
		$sql = "SELECT VIEW_COT_DESCRIPCION.ID AS ID,
                     VIEW_COT_DESCRIPCION.ID_TIPO,
                     VIEW_COT_DESCRIPCION.TIPO,
                     VIEW_COT_DESCRIPCION.NOMBRE,
                     VIEW_COT_DESCRIPCION.CODIGO,
                     VIEW_COT_DESCRIPCION.DESCRIPCION,
                     VIEW_COT_DESCRIPCION.TENTREGA,
                     VIEW_COT_DESCRIPCION.GARANTIA,
                     COT_DETALLECOTI.CANTIDAD,
                     COT_DETALLECOTI.VALOR,
                     COT_DETALLECOTI.OBSERVACION,
                     COT_DETALLECOTI.ID AS ID_ELEMENTO_COTIZACION,
                     COT_DETALLECOTI.MARGEN,
                     COT_DETALLECOTI.MATERIALES,
                     COT_DETALLECOTI.MANOOBRA,
                     COT_DETALLECOTI.ASOCIADOS,
					 COT_DETALLECOTI.IVA
                FROM 
                VIEW_COT_DESCRIPCION, 
                COT_DETALLECOTI
                WHERE VIEW_COT_DESCRIPCION.ID=COT_DETALLECOTI.ID_DESCRIPCION
                AND COT_DETALLECOTI.ID_COTIZACION=$id
	            AND COT_DETALLECOTI.ESTADO='" . ACTIVO_ESTADO . "'";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListStokePriceFromRequest($condicion = null, $opcion)
	{
		/** Selecci�n detalle de los elementos y/o productos para cotizaciones*/

		if ($opcion != 1) {
			$select = "COT_SOLICITUD.ID AS SOLICITUD,
                COT_SOLICITUD.FCREA AS FECHA_SOLICITUD,
                COT_SOLICITUD.FECHA_SOLICITUD_COTIZACION,
                COT_VIEW_RESUME.ID,
                COT_VIEW_RESUME.CONSECUTIVO,
                COT_VIEW_RESUME.FECHA,
                COT_VIEW_RESUME.ID_EMPRESA,
                COT_VIEW_RESUME.TIPODOC,
                COT_VIEW_RESUME.DOCUMENTO,
                COT_VIEW_RESUME.NOMBRES,
                COT_VIEW_RESUME.APELLIDOS,
                COT_VIEW_RESUME.CORREO,
                COT_VIEW_RESUME.TELEFONO,
                COT_VIEW_RESUME.UCREA,
                COT_VIEW_RESUME.ESTADO,
                COT_VIEW_RESUME.ID_SEGUIMIENTO,
                COT_VIEW_RESUME.DESCUENTO,
                COT_VIEW_RESUME.TOTAL,
                COT_DETALLECOTI.ID_DESCRIPCION,
                COT_DESCRIPCION.CODIGO,
                COT_DESCRIPCION.AUXILIAR, 
                COT_DESCRIPCION.DESCRIPCION";
		} else {
			$select = "COT_SOLICITUD.ID AS SOLICITUD,
                COT_SOLICITUD.FCREA AS FECHA_SOLICITUD,
                COT_SOLICITUD.FECHA_SOLICITUD_COTIZACION,
                COT_VIEW_RESUME.ID,
                COT_VIEW_RESUME.CONSECUTIVO,
                COT_VIEW_RESUME.FECHA,
                COT_VIEW_RESUME.ID_EMPRESA,
                COT_VIEW_RESUME.TIPODOC,
                COT_VIEW_RESUME.DOCUMENTO,
                COT_VIEW_RESUME.NOMBRES,
                COT_VIEW_RESUME.APELLIDOS,
                COT_VIEW_RESUME.CORREO,
                COT_VIEW_RESUME.TELEFONO,
                COT_VIEW_RESUME.UCREA,
                COT_VIEW_RESUME.ESTADO,
                COT_VIEW_RESUME.ID_SEGUIMIENTO,
                COT_VIEW_RESUME.DESCUENTO,
                COT_VIEW_RESUME.TOTAL";
		}
		$sql = "SELECT DISTINCT
                " . $select . "
                
                FROM
                COT_SOLICITUD LEFT JOIN
                COT_VIEW_RESUME
                ON COT_SOLICITUD.ID=COT_VIEW_RESUME.ID_SOLICITUD
                LEFT JOIN 
                COT_DETALLECOTI
                ON COT_DETALLECOTI.ID_COTIZACION=COT_VIEW_RESUME.ID
                LEFT JOIN 
                COT_DESCRIPCION
                ON COT_DETALLECOTI.ID_DESCRIPCION=COT_DESCRIPCION.ID
                WHERE COT_SOLICITUD.ESTADO='" . ACTIVO_ESTADO . "'
                $condicion
";

		if ($opcion == 5) {
			$sql = "SELECT *
			FROM VIEW_MAL
			RIGHT JOIN  VIEW_NO_SEGUIMIENTO
			ON VIEW_NO_SEGUIMIENTO.CONSECUTIVO=VIEW_MAL.CONSECUTIVO
			$condicion
";
		}
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListStokePriceFromRequestno($condicion = null, $opcion)
	{
		/** Selecci�n detalle de los elementos y/o productos para cotizaciones*/


		$sql = "SELECT COT_VIEW_RESUME.CONSECUTIVO
		FROM
			COT_VIEW_RESUME
		INTERSECT
			(
				SELECT 
					VIEW_SEGUIMIENTOS.CONSECUTIVO
				FROM
					VIEW_SEGUIMIENTOS
			)";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListStokePrice($condicion = null)
	{
		/** Selecci�n detalle de los elementos y/o productos para cotizaciones*/
		$sql = "SELECT COT_COTIZACION.ID,
                     COT_COTIZACION.CONSECUTIVO,
                     COT_COTIZACION.FECHA,
                     COT_TARIFAEMPRESA.ID_EMPRESA,
                     ADM_DETLISTA.VALOR as TIPODOC,
                     COT_USUARIO.DOCUMENTO,
                     COT_USUARIO.NOMBRES,
                     COT_USUARIO.APELLIDOS,
                     COT_USUARIO.CORREO,
                     COT_USUARIO.TELEFONO,
                     COT_COTIZACION.UCREA,
                     COT_COTIZACION.ESTADO,
                     COT_COTIZACION.ID_SEGUIMIENTO,
                     COT_COTIZACION.DESCUENTO,
                     sum(COT_DETALLECOTI.VALOR) AS TOTAL
              FROM COT_COTIZACION,COT_TARIFAEMPRESA,COT_USUARIO,COT_USUARIOCOTI,ADM_DETLISTA, COT_DETALLECOTI
              WHERE COT_COTIZACION.ID_EMPRESA=COT_TARIFAEMPRESA.ID
              AND COT_USUARIOCOTI.ID_COTIZACION=COT_COTIZACION.ID
              AND COT_USUARIOCOTI.ID_USUARIO=COT_USUARIO.ID
              AND ADM_DETLISTA.ID=COT_USUARIO.TIPODOC
              AND COT_DETALLECOTI.ID_COTIZACION=COT_COTIZACION.ID
             AND COT_DETALLECOTI.ESTADO='" . ACTIVO_ESTADO . "'
              $condicion  
             group by COT_COTIZACION.ID,
                     COT_COTIZACION.CONSECUTIVO,
                     COT_COTIZACION.FECHA,
                     COT_TARIFAEMPRESA.ID_EMPRESA,
                     ADM_DETLISTA.VALOR ,
                     COT_USUARIO.DOCUMENTO,
                     COT_USUARIO.NOMBRES,
                     COT_USUARIO.APELLIDOS,
                     COT_USUARIO.CORREO,
                     COT_USUARIO.TELEFONO,
                     COT_COTIZACION.UCREA,
                    COT_COTIZACION.ESTADO,
                     COT_COTIZACION.ID_SEGUIMIENTO,
                    COT_COTIZACION.DESCUENTO
";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListTraceListPriceStoke($id)
	{
		/** Selecci�n el detalle del seguimiento a la cotizaci�n con id $id*/
		$sql = "SELECT COT_SEGUIMIENTO.ID AS ID,
                     COT_SEGUIMIENTO.OBSERVACION AS OBSERVACION, 
                     COT_TIPOSEG.NOMBRE AS TIPO,
                     COT_SEGUIMIENTO.FCREA AS FECHA,
                     ADM_USUARIO.NOMBRES AS NOMBRES,
					ADM_USUARIO.APELLIDOS AS APELLIDOS,
					ADM_PERFIL.NOMBRE AS PERFIL,
					COT_SEGUIMIENTO.AUTORIZACION AS AUTORIZACION
             FROM COT_TIPOSEG, 
                    COT_SEGUIMIENTO,
                    ADM_USUROLPER,
					ADM_USUARIO,
					ADM_ROLPERFIL,
					ADM_PERFIL
             WHERE COT_SEGUIMIENTO.ID_COTIZACION=$id
	          AND COT_SEGUIMIENTO.ID_TIPOSEG=COT_TIPOSEG.ID
             AND COT_SEGUIMIENTO.ESTADO='" . ACTIVO_ESTADO . "'
            AND ADM_USUROLPER.ID_USUARIO = ADM_USUARIO.ID
			AND ADM_USUROLPER.ID_ROLPERFIL = ADM_ROLPERFIL.ID
			AND ADM_ROLPERFIL.ID_PERFIL = ADM_PERFIL.ID
            AND COT_SEGUIMIENTO.UCREA = ADM_USUARIO.ID 
";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListTraceListPriceStokeOne($id)
	{
		/** Selecci�n el detalle del seguimiento a la cotizaci�n con id $id*/
		$sql = "SELECT  
                     COT_TIPOSEG.NOMBRE AS TIPO
             FROM COT_TIPOSEG, 
                    COT_SEGUIMIENTO,
                    ADM_USUROLPER,
					ADM_USUARIO,
					ADM_ROLPERFIL,
					ADM_PERFIL
             WHERE COT_SEGUIMIENTO.ID_COTIZACION=$id
	          AND COT_SEGUIMIENTO.ID_TIPOSEG=COT_TIPOSEG.ID
             AND COT_SEGUIMIENTO.ESTADO='" . ACTIVO_ESTADO . "'
            AND ADM_USUROLPER.ID_USUARIO = ADM_USUARIO.ID
			AND ADM_USUROLPER.ID_ROLPERFIL = ADM_ROLPERFIL.ID
			AND ADM_ROLPERFIL.ID_PERFIL = ADM_PERFIL.ID
            AND COT_SEGUIMIENTO.UCREA = ADM_USUARIO.ID 
";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListTraceHistoryStokePrice($id)
	{
		/** Selecci�n el detalle del seguimiento a la cotizaci�n con id $id*/
		$sql = "SELECT COT_BITACORA.ID AS ID,
                     COT_BITACORA.OBSERVACION AS OBSERVACION, 
                     COT_BITACORA.FCREA AS FECHA,
                     ADM_USUARIO.NOMBRES AS NOMBRES,
					ADM_USUARIO.APELLIDOS AS APELLIDOS,
					ADM_PERFIL.NOMBRE AS PERFIL
             FROM COT_BITACORA,
                    ADM_USUROLPER,
					ADM_USUARIO,
					ADM_ROLPERFIL,
					ADM_PERFIL
             WHERE COT_BITACORA.ID_COTIZACION=$id
             AND ADM_USUROLPER.ID_USUARIO = ADM_USUARIO.ID
			AND ADM_USUROLPER.ID_ROLPERFIL = ADM_ROLPERFIL.ID
			AND ADM_ROLPERFIL.ID_PERFIL = ADM_PERFIL.ID
            AND COT_BITACORA.UCREA = ADM_USUARIO.ID 
	        and  COT_BITACORA.ESTADO='" . ACTIVO_ESTADO . "'
	          ORDER BY COT_BITACORA.ID ASC
";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectValueFromElementListOfProduct($id)
	{
		/** Selecci�n el detalle del seguimiento a la cotizaci�n con id $id*/
		$sql = "SELECT * 
             FROM COT_VIEW_DESPIECE_PRODUCTO
             WHERE COT_VIEW_DESPIECE_PRODUCTO.PRODUCTO='$id' 
";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectElementsDetailsFromStokePrice($id)
	{
		/** Selecci�n el detalle del seguimiento a la cotizaci�n con id $id*/
		$sql = "SELECT * 
             FROM COT_DESPIECE
             WHERE COT_DESPIECE.ID_DETALLECOTI='$id' 
             AND COT_DESPIECE.ESTADO='" . ACTIVO_ESTADO . "'
";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectDetailsTrmCotizacion($id)
	{
		$sql = "SELECT VALOR
			FROM COT_TRM
			WHERE ID_COTIZACION='$id'
		";

		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}


	public function selectElementsDetailsFromStokePriceDetails($id)
	{
		/** Selecci�n el detalle del seguimiento a la cotizaci�n con id $id*/
		$sql = "SELECT COT_DESPIECE.ID, 
		COT_DESPIECE.CANTIDAD, 
		COT_DESPIECE.VALOR, 
		ORD_ELEMENTO.CODIGO, 
		ORD_ELEMENTO.NOMBRE, 
		ORD_ELEMENTO.COMODIN,
		COT_DESPIECE.ID_DETALLECOTI, 
		COT_DESCRIPCION.ID AS ID_DESCRIPCION
             FROM COT_DESPIECE 
             	LEFT JOIN COT_DESCRIPCION ON COT_DESPIECE.ID_ELEMENTO=COT_DESCRIPCION.CODIGO AND COT_DESCRIPCION.ID_TIPO=39
             	LEFT JOIN ORD_ELEMENTO ON COT_DESPIECE.ID_ELEMENTO=ORD_ELEMENTO.ID
	
             WHERE COT_DESPIECE.ID_DETALLECOTI='$id' 
             and COT_DESPIECE.ESTADO='" . ACTIVO_ESTADO . "'

		";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectIdOfDetailsCot($id)
	{
		/** Selecci�n detalle de los elementos y/o productos para cotizaciones con $id */
		$sql = "SELECT ID from COT_DETALLECOTI where ID_COTIZACION = '$id'";

		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$return = $result->result();
		} else {
			$return = null;
		}

		return $return;
	}


	public function selectValueFromElementListOfProductfromStokePrice($id)
	{
		/** Selecci�n el detalle del seguimiento a la cotizaci�n con id $id*/
		$sql = "SELECT
COT_DESPIECE.ID,
COT_DESPIECE.ID_DETALLECOTI,
COT_DESPIECE.ID_ELEMENTO,
COT_DESPIECE.CANTIDAD,
COT_DESPIECE.VALOR,
COT_DESCRIPCION.ID_PAIS

FROM
COT_DESPIECE , COT_DESCRIPCION
WHERE
COT_DESPIECE.ID_DETALLECOTI = '$id' 
AND COT_DESPIECE.ID_ELEMENTO=COT_DESCRIPCION.CODIGO
AND COT_DESPIECE.ESTADO='S'
";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}


	public function selectListFromStokePriceForCompare($id, $codigo)
	{
		/** Selecci�n detalle de los elementos y/o productos para cotizaciones con $id */
		$sql = "SELECT count(*) as CANTIDAD
                FROM 
                VIEW_COT_DESCRIPCION, 
                COT_DETALLECOTI
                WHERE VIEW_COT_DESCRIPCION.ID=COT_DETALLECOTI.ID_DESCRIPCION
                AND COT_DETALLECOTI.ID_COTIZACION=$id
	            AND COT_DETALLECOTI.ESTADO='" . ACTIVO_ESTADO . "'
	            AND VIEW_COT_DESCRIPCION.CODIGO='" . $codigo . "'";

		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$return = $result->result();
		} else {
			$return = null;
		}

		foreach ($return as  $value) {
			return $value->CANTIDAD;
		}
	}
}
