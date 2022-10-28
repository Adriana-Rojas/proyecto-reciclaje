<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electr�nico:         jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:                  Clase en las cuales se definen las operaciones CRUD frente a las tablas que tienen relaci�n con la aplicaci�n �rdenes y todos sus m�dulos
 */
class OrdersModel extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* ---------------------------------------------------------- INSERT --------------------------------------------------------- */
	public function insertElementGroup($nombre, $miembros, $tipo, $unidad, $iva, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla ORD_GRUELEM
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_GRUELEM', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'NOMBRE' => $nombre,
			'ID_NIVGRU' => $tipo,
			'ID_MIEMBROS' => $miembros,
			'UNIDAD' => $unidad,
			'IVA' => $iva,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_GRUELEM
		$this->db->insert('ORD_GRUELEM', $data);
		return $consecutivo;
	}
	public function insertBodyPartsSection($nombre, $tiempo, $miembros, $usuario)
	{
		/**
		 * Se inserta la informaci�n de la tabla ORD_NIVELAMP
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_NIVELAMP', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'NOMBRE' => $nombre,
			'ID_TIEMPO' => $tiempo,
			'ID_MIEMBROS' => $miembros,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_NIVELAMP
		$this->db->insert('ORD_NIVELAMP', $data);
		return $consecutivo;
	}
	public function insertValidateTablesOrders($nombre, $despiece, $tabla, $codigo, $nombreCampo, $adicional, $tablaAuxiliar, $codigoAuxiliar, $nombreCampoAuxiliar, $adicionalAuxiliar, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_VALIDA
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_VALIDA', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'DESPIECE' => $despiece,
			'NOMBRE' => $nombre,
			'TABLA' => $tabla,
			'CAM_COD' => $codigo,
			'CAM_NOM' => $nombreCampo,
			'CAM_ADI' => $adicional,
			'TABLA_ADI' => $tablaAuxiliar,
			'CAM_CODADI' => $codigoAuxiliar,
			'CAM_NOMADI' => $nombreCampoAuxiliar,
			'CAM_ADIADI' => $adicionalAuxiliar,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_VALIDA
		$this->db->insert('ORD_VALIDA', $data);
		return $consecutivo;
	}
	public function insertOrdersType($nombre, $prioridad, $clase, $impresion, $valida, $clasificacion, $niveles, $prefijo, $maximo, $iva, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_TIPOORDEN
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_TIPOORDEN', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'NOMBRE' => $nombre,
			'ID_PRIORTIPO' => $prioridad,
			'ID_CLASETIPO' => $clase,
			'ID_IMPTIPO' => $impresion,
			'ID_VALIDA' => $valida,
			'IVA' => $iva,
			'POS' => $clasificacion,
			'NIVELES' => $niveles,
			'PREFIJO' => $prefijo,
			'MAXIMO' => $maximo,
			'CONS' => 1,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_VALIDA
		$this->db->insert('ORD_TIPOORDEN', $data);
		return $consecutivo;
	}
	public function insertGroupCharacteristicsElements($grupo, $caracteristica, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_PARGRUELEM
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_PARGRUELEM', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_GRUELEM' => $grupo,
			'ID_PARELEM' => $caracteristica,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_VALIDA
		$this->db->insert('ORD_PARGRUELEM', $data);
		return $consecutivo;
	}
	public function insertValuesGroupCharacteristicsElements($idParGruElement, $valor, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_VALPARGRUELEM
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_VALPARGRUELEM', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_PARGRUELEM' => $idParGruElement,
			'VALOR' => $valor,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_VALIDA
		$this->db->insert('ORD_VALPARGRUELEM', $data);
		return $consecutivo;
	}
	public function insertValuesProviderGroupCharacteristicsElements($idParGruElement, $proveedor, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_PROGRUPAR
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_PROGRUPAR', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_PARGRUELEM' => $idParGruElement,
			'ID_PROVEEDOR' => $proveedor,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_PROGRUPAR
		$this->db->insert('ORD_PROGRUPAR', $data);
		return $consecutivo;
	}
	public function insertElements($codigo, $grupo, $proveedor, $nombre,  $comodin, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ELEMENTO
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ELEMENTO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'CODIGO' => $codigo,
			'ID_GRUELEM' => $grupo,
			'ID_PROVEEDOR' => $proveedor,
			'IVA' => -150,
			'NOMBRE' => $nombre,
			'COMODIN' => $comodin,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ELEMENTO
		$this->db->insert('ORD_ELEMENTO', $data);
		return $consecutivo;
	}


	public function insertElementCost($idElemento, $valida, $costo, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ELEMCOSTO
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ELEMCOSTO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ELEMENTO' => $idElemento,
			'ID_VALIDA' => $valida,
			'VALOR' => $costo,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ELEMCOSTO
		$this->db->insert('ORD_ELEMCOSTO', $data);
		return $consecutivo;
	}

	public function insertElementInformation($idElemento, $valor, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ELEPARELEM
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ELEPARELEM', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ELEMENTO' => $idElemento,
			'ID_VALPARGRUELEM' => $valor,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ELEPARELEM
		$this->db->insert('ORD_ELEPARELEM', $data);
		return $consecutivo;
	}
	public function insertStates($nombre, $tipo, $nivel, $grupo, $reproceso, $adjunto, $bloque, $icono, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ESTADOS
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ESTADOS', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'NOMBRE' => $nombre,
			'ICONO' => $icono,
			'TIPOESTADO' => $tipo,
			'NIVEL' => $nivel,
			'ID_GRUPOESTADO' => $grupo,
			'REPROCESO' => $reproceso,
			'ADJUNTO' => $adjunto,
			'BLOQUE' => $bloque,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ESTADOS
		$this->db->insert('ORD_ESTADOS', $data);
		return $consecutivo;
	}
	public function insertStateObservation($nombre, $estado, $tipo, $motivo, $cierra, $despiece, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_OBSESTADO
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_OBSESTADO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'NOMBRE' => $nombre,
			'ID_ESTADO' => $estado,
			'TIPOOBSE' => $tipo,
			'MOTIVO' => $motivo,
			'CIERRA' => $cierra,
			'DESPIECE' => $despiece,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_OBSESTADO
		$this->db->insert('ORD_OBSESTADO', $data);
		return $consecutivo;
	}
	public function insertProcessOrderTypeRelation($proceso, $tipo, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_TORDPRO
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_TORDPRO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_PROCESO' => $proceso,
			'ID_TIPOORDEN' => $tipo,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_TORDPRO
		$this->db->insert('ORD_TORDPRO', $data);
		return $consecutivo;
	}
	public function insertProcessOrderTypeStateRelation($tordPro, $estado, $amin, $amax, $mmin, $mmax, $bmin, $bmax, $aColor, $mColor, $bColor, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_TORDPROEST
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_TORDPROEST', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_TORDPRO' => $tordPro,
			'ID_ESTADO' => $estado,
			'AMIN' => $amin,
			'AMAX' => $amax,
			'MMIN' => $mmin,
			'MMAX' => $mmax,
			'BMIN' => $bmin,
			'BMAX' => $bmax,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer(),
			'ACOLOR' => $aColor,
			'MCOLOR' => $mColor,
			'BCOLOR' => $bColor
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_TORDPROEST
		$this->db->insert('ORD_TORDPROEST', $data);
		return $consecutivo;
	}
	public function insertStatesRelation($inicio, $fin, $orden, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_RELESTADO
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_RELESTADO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_INICIO' => $inicio,
			'ID_FIN' => $fin,
			'ORDEN' => $orden,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_RELESTADO
		$this->db->insert('ORD_RELESTADO', $data);
		return $consecutivo;
	}
	public function insertStatesRelationPass($tordProEst, $perfil, $permiso, $correo, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_TORDPROESTPER
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_TORDPROESTPER', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_TORDPROEST' => $tordProEst,
			'ID_PERFIL' => $perfil,
			'PERMISO' => $permiso,
			'CORREO' => $correo,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_TORDPROESTPER
		$this->db->insert('ORD_TORDPROESTPER', $data);
		return $consecutivo;
	}
	public function insertWorkGroups($tipoOrden, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_DEFEQUIPO
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_DEFEQUIPO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_TIPOORDEN' => $tipoOrden,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_DEFEQUIPO
		$this->db->insert('ORD_DEFEQUIPO', $data);
		return $consecutivo;
	}
	public function insertWorkGroupsRol($idDefEquipo, $rolPer, $obligatorio, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_DETDEFEQUIPO
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_DETDEFEQUIPO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_DEFEQUIPO' => $idDefEquipo,
			'ID_INFROL' => $rolPer,
			'OBLIGATORIO' => $obligatorio,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_DETDEFEQUIPO
		$this->db->insert('ORD_DETDEFEQUIPO', $data);
		return $consecutivo;
	}
	public function insertWorkGroupsOrder($tipoOrden, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_DEFEQUIPOORDEN
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_DEFEQUIPOORDEN', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_TIPOORDEN' => $tipoOrden,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_DEFEQUIPOORDEN
		$this->db->insert('ORD_DEFEQUIPOORDEN', $data);
		return $consecutivo;
	}
	public function insertWorkGroupsRolOrder($idDefEquipo, $rolPer, $obligatorio, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_DETDEFEQUIPOORDEN
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_DETDEFEQUIPOORDEN', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_DEFEQUIPO' => $idDefEquipo,
			'ID_INFROL' => $rolPer,
			'OBLIGATORIO' => $obligatorio,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_DETDEFEQUIPOORDEN
		$this->db->insert('ORD_DETDEFEQUIPOORDEN', $data);
		return $consecutivo;
	}
	public function insertLevelHead($miembros, $valida, $nombre, $nivel, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_DATOSNIV
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_DATOSNIV', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_MIEMBROS' => $miembros,
			'ID_VALIDA' => $valida,
			'NOMBRE' => $nombre,
			'NIVEL' => $nivel,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_DATOSNIV
		$this->db->insert('ORD_DATOSNIV', $data);
		return $consecutivo;
	}
	public function insertLevelBody($encLevel, $nombre, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_DATOSNIVVAL
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_DATOSNIVVAL', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_DATOSNIV' => $encLevel,
			'NOMBRE' => $nombre,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_DATOSNIVVAL
		$this->db->insert('ORD_DATOSNIVVAL', $data);
		return $consecutivo;
	}
	public function insertBodyPartOrderType($tipo, $miembro, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_TIPOMIEM
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_TIPOMIEM', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_TIPOORDEN' => $tipo,
			'ID_MIEMBROS' => $miembro,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_TIPOMIEM
		$this->db->insert('ORD_TIPOMIEM', $data);
		return $consecutivo;
	}
	public function insertTreeHead($nivel, $anterior, $tablaAnterior, $actual, $tablaActual, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ARBOL
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ARBOL', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'NIVEL' => $nivel,
			'ID_ANT' => $anterior,
			'TABLA_ANT' => $tablaAnterior,
			'ID_ACTUAL' => $actual,
			'TABLA_ACTUAL' => $tablaActual,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ARBOL
		$this->db->insert('ORD_ARBOL', $data);
		return $consecutivo;
	}
	public function insertTreeValues($idArbol, $valor, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ARBOLVALORES
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ARBOLVALORES', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ARBOL' => $idArbol,
			'VALOR' => $valor,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ARBOLVALORES
		$this->db->insert('ORD_ARBOLVALORES', $data);
		return $consecutivo;
	}
	public function insertTreeCodes($idArbolValor, $codigo, $nombre, $descripcion,  $tiempo, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ARBOLCODIGO
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ARBOLCODIGO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ARBOLVALORES' => $idArbolValor,
			'CODIGO' => $codigo,
			'NOMBRE' => $nombre,
			'DESCRIPCION' => $descripcion,
			'ID_TIEMPO' => $tiempo,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ARBOLCODIGO
		$this->db->insert('ORD_ARBOLCODIGO', $data);
		return $consecutivo;
	}
	public function insertTreeElementProduct($idArbolCodigo, $idElemento, $cantidad, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_DESPIECE
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_DESPIECE', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ARBOLCODIGO' => $idArbolCodigo,
			'ID_ELEMENTO' => $idElemento,
			'CANTIDAD' => $cantidad,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_DESPIECE
		$this->db->insert('ORD_DESPIECE', $data);
		return $consecutivo;
	}
	public function insertServicePackage($idArbolCodigo, $cantidad, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_PAQUETEVALORA
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_PAQUETEVALORA', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ARBOLCODIGO' => $idArbolCodigo,
			'CANTIDAD' => $cantidad,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_PAQUETEVALORA
		$this->db->insert('ORD_PAQUETEVALORA', $data);
		return $consecutivo;
	}
	public function insertOrderHead($empresaAliada, $idEncbrig, $historia, $cerrado, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ENCORDEN
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ENCORDEN', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ALIADA' => $empresaAliada,
			'ID_ENCBRIG' => $idEncbrig,
			'HISTORIA' => $historia,
			'CERRADO' => $cerrado,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ENCORDEN
		$this->db->insert('ORD_ENCORDEN', $data);
		//echo "<script>console.log('data: " . $data . "' );</script>";
		sleep(10);
		return $consecutivo;
	}
	public function insertOrderBody($idEncOrden, $idTordPro, $cie10, $causa, $diagnostico, $cons, $idOrdenAnterior, $actividad, $cantidad, $observacion, $idCotizacion, $usuario, $adjunto1, $adjunto2)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ORDEN
		 */

		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ORDEN', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ENCORDEN' => $idEncOrden,
			'ID_COTIZACION' => $idCotizacion,
			'ID_TORDPRO' => $idTordPro,
			'ID_DIAGNOSTICO' => $cie10,
			'ID_CAUSAENFERMEDAD' => $causa,
			'DIAGNOSTICO' => $diagnostico,
			'CONS' => $cons,
			'ID_ORDENANT' => $idOrdenAnterior,
			'ACTIVIDAD' => $actividad,
			'CANTIDAD' => $cantidad,
			'OBSERVACION' => $observacion,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer(),
			'ADJUNTO1' => $adjunto1,
			'ADJUNTO2' => $adjunto2

		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ORDEN
		$this->db->insert('ORD_ORDEN', $data);
		return $consecutivo;
	}
	public function insertOrderState($idOrden, $idTordProEst, $momento, $opcion, $contador, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ORDACTEST
		 */
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ORDACTEST', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ORDEN' => $idOrden,
			'ID_TORDPROEST' => $idTordProEst,
			'MOMENTO' => $momento,
			'OPCION' => $opcion,
			'CONTADOR' => $contador,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ORDACTEST
		$this->db->insert('ORD_ORDACTEST', $data);
		return $consecutivo;
	}


	public function insertBackOrder($idOrden, $actual,  $anterior, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_REPROCESO
		 */
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_REPROCESO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ORDEN' => $idOrden,
			'ACTUAL' => $actual,
			'REPROCESO' => $anterior,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_REPROCESO
		$this->db->insert('ORD_REPROCESO', $data);
		return $consecutivo;
	}


	public function insertOrderBinnacleInformation($idOrden, $tipo, $observacion, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ORDENBITACORA
		 */
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ORDENBITACORA', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ORDEN' => $idOrden,
			'ID_TIPOBITACORA' => $tipo,
			'OBSERVACION' => $observacion,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ORDENBITACORA
		$this->db->insert('ORD_ORDENBITACORA', $data);
		return $consecutivo;
	}


	public function insertOrderStateObservation($idOrdActEst, $idObsEstado, $observacion, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ORDACTESTOBS
		 */
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ORDACTESTOBS', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ORDACTEST' => $idOrdActEst,
			'ID_OBSESTADO' => $idObsEstado,
			'OBSERVACION' => $observacion,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ORDACTESTOBS
		$this->db->insert('ORD_ORDACTESTOBS', $data);
		return $consecutivo;
	}


	public function insertOrderStateObservationAditionalInformation($idObservacion, $adc1, $adc2, $adc3, $adc4, $adc5, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ORDACTESTOBSADC
		 */
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ORDACTESTOBSADC', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ORDACTESTOBS' => $idObservacion,
			'ADICIONAL1' => $adc1,
			'ADICIONAL2' => $adc2,
			'ADICIONAL3' => $adc3,
			'ADICIONAL4' => $adc4,
			'ADICIONAL5' => $adc5,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ORDACTESTOBS
		$this->db->insert('ORD_ORDACTESTOBSADC', $data);
		return $consecutivo;
	}

	public function insertOrderElementOfProduct($idOrden, $idElemento, $cantidad, $traslado, $salida, $serial, $lote, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ORDACTDES
		 */
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ORDACTDES', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ORDEN' => $idOrden,
			'ID_ELEMENTO' => $idElemento,
			'CANTIDAD' => $cantidad,
			'TRASLADO' => $traslado,
			'SALIDA' => $salida,
			'SERIAL' => $serial,
			'LOTE' => $lote,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ORDACTDES
		$this->db->insert('ORD_ORDACTDES', $data);
		return $consecutivo;
	}
	public function insertOrderTeamList($idOrdenEstado, $usuEquipo, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ORDENEQUIPO
		 */
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_ORDENEQUIPO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_TORDPROEST' => $idOrdenEstado,
			'ID_USUARIO' => $usuEquipo,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_ORDENEQUIPO
		$this->db->insert('ORD_ORDENEQUIPO', $data);
		return $consecutivo;
	}

	public function insertOrderStatistics($tipo1, $tipo2, $tipo3, $tipo4, $tipo5, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_TIPOUSUARIOESTAD
		 */
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_TIPOUSUARIOESTAD', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_USUARIO' => $usuario,
			'ID_TIPO1' => $tipo1,
			'ID_TIPO2' => $tipo2,
			'ID_TIPO3' => $tipo3,
			'ID_TIPO4' => $tipo4,
			'ID_TIPO5' => $tipo5,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_TIPOUSUARIOESTAD
		$this->db->insert('ORD_TIPOUSUARIOESTAD', $data);
		return $consecutivo;
	}


	public function insertOrderContactUser($idEncOrden, $correo, $movil, $telefono, $direccion, $municipio, $empresa, $convenio, $usuario)
	{

		/**
		 * Se inserta la informacion de la tabla ORD_CONTACTOUSUARIO
		 */
		// Obtiene el siguiente ID
		$consecutivo = $this->FunctionsGeneral->countMax('ORD_CONTACTOUSUARIO', 'ID', 1);
		$data = array(
			'ID' => $consecutivo,
			'ID_ENCORDEN' => $idEncOrden,
			'CORREO' => $correo,
			'MOVIL' => $movil,
			'TELEFONO' => $telefono,
			'DIRECCION' => $direccion,
			'ID_MUNICIPIO' => $municipio,
			'ID_EMPRESA' => $empresa,
			'ID_CONVENIO' => $convenio,
			'ESTADO' => 'S',
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el insert sobre la base de datos en la tabla ORD_CONTACTOUSUARIO
		$this->db->insert('ORD_CONTACTOUSUARIO', $data);
		return $consecutivo;
	}



	/**
	 * ---------------------------------------------------------- TODO UPDATE ---------------------------------------------------------
	 */
	public function updateValidateTablesOrders($id, $nombre, $despiece, $tabla, $codigo, $nombreCampo, $adicional, $tablaAuxiliar, $codigoAuxiliar, $nombreCampoAuxiliar, $adicionalAuxiliar, $usuario)
	{
		/**
		 * Se actualiza la informaci�n de la tabla ORD_VALIDA
		 */
		$data = array(
			'DESPIECE' => $despiece,
			'NOMBRE' => $nombre,
			'TABLA' => $tabla,
			'CAM_COD' => $codigo,
			'CAM_NOM' => $nombreCampo,
			'CAM_ADI' => $adicional,
			'TABLA_ADI' => $tablaAuxiliar,
			'CAM_CODADI' => $codigoAuxiliar,
			'CAM_NOMADI' => $nombreCampoAuxiliar,
			'CAM_ADIADI' => $adicionalAuxiliar,
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el update sobre la base de datos en la tabla ORD_VALIDA
		$this->db->where('ID', $id);
		$this->db->update('ORD_VALIDA', $data);
	}
	public function updateOrdersType($id, $nombre, $prioridad, $clase, $impresion, $valida, $clasificacion, $niveles, $prefijo, $maximo, $iva, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_TIPOORDEN
		 */
		$data = array(
			'NOMBRE' => $nombre,
			'ID_PRIORTIPO' => $prioridad,
			'ID_CLASETIPO' => $clase,
			'ID_IMPTIPO' => $impresion,
			'ID_VALIDA' => $valida,
			'IVA' => $iva,
			'POS' => $clasificacion,
			'NIVELES' => $niveles,
			'PREFIJO' => $prefijo,
			'MAXIMO' => $maximo,
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el update sobre la base de datos en la tabla ORD_TIPOORDEN
		$this->db->where('ID', $id);
		$this->db->update('ORD_TIPOORDEN', $data);
	}

	public function updateElemCosto($id, $valida, $valor, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ELEMCOSTO
		 */

		// Obtiene el siguiente ID
		$data = array(
			'ID_VALIDA' => $valida,
			'VALOR' => $valor,
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el update sobre la base de datos en la tabla ORD_ELEMCOSTO
		$this->db->where('ID_ELEMENTO', $id);
		$this->db->update('ORD_ELEMCOSTO', $data);
	}
	public function updateElements($id, $grupo, $proveedor, $nombre, $usuario)
	{

		/**
		 * Se inserta la informaci�n de la tabla ORD_ELEMENTO
		 */

		// Obtiene el siguiente ID
		$data = array(
			'ID_GRUELEM' => $grupo,
			'ID_PROVEEDOR' => $proveedor,
			'NOMBRE' => $nombre,
			'UCREA' => $usuario,
			'FCREA' => cambiaHoraServer(),
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el update sobre la base de datos en la tabla ORD_ELEMENTO
		$this->db->where('ID', $id);
		$this->db->update('ORD_ELEMENTO', $data);
	}
	public function updateStates($id, $nombre, $tipo, $nivel, $grupo, $reproceso, $adjunto, $bloque, $icono, $usuario)
	{

		/**
		 * Se actualiza la informaci�n de la tabla ORD_ESTADOS
		 */
		$data = array(
			'NOMBRE' => $nombre,
			'ICONO' => $icono,
			'TIPOESTADO' => $tipo,
			'NIVEL' => $nivel,
			'ID_GRUPOESTADO' => $grupo,
			'REPROCESO' => $reproceso,
			'ADJUNTO' => $adjunto,
			'BLOQUE' => $bloque,
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);

		// Realizo el update sobre la base de datos en la tabla ORD_ESTADOS
		$this->db->where('ID', $id);
		$this->db->update('ORD_ESTADOS', $data);
	}
	public function updateStateObservation($id, $nombre, $estado, $tipo, $motivo, $cierra, $despiece, $usuario)
	{

		/**
		 * Se actualiza la informaci�n de la tabla ORD_OBSESTADO
		 */
		$data = array(
			'NOMBRE' => $nombre,
			'ID_ESTADO' => $estado,
			'TIPOOBSE' => $tipo,
			'MOTIVO' => $motivo,
			'CIERRA' => $cierra,
			'DESPIECE' => $despiece,
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);
		// Realizo el update sobre la base de datos en la tabla ORD_OBSESTADO
		$this->db->where('ID', $id);
		$this->db->update('ORD_OBSESTADO', $data);
	}
	public function updateProcessOrderTypeStateRelation($id, $amin, $amax, $mmin, $mmax, $bmin, $bmax, $usuario, $aColor, $mColor, $bColor)
	{
		/**
		 * Se actualiza la informaci�n de la tabla ORD_TORDPROEST
		 */
		// Defino array
		$data = array(
			'AMIN' => $amin,
			'AMAX' => $amax,
			'MMIN' => $mmin,
			'MMAX' => $mmax,
			'BMIN' => $bmin,
			'BMAX' => $bmax,
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer(),
			'ACOLOR' => $aColor,
			'MCOLOR' => $mColor,
			'BCOLOR' => $bColor
		);
		// Realizo el update sobre la base de datos en la tabla ORD_TORDPROEST
		$this->db->where('ID', $id);
		$this->db->update('ORD_TORDPROEST', $data);
	}
	public function updateLevelHead($id, $miembros, $valida, $nombre, $nivel, $usuario)
	{

		/**
		 * Se actualiza la informaci�n de la tabla ORD_DATOSNIV
		 */
		$data = array(
			'ID_MIEMBROS' => $miembros,
			'ID_VALIDA' => $valida,
			'NOMBRE' => $nombre,
			'NIVEL' => $nivel,
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);

		// Realizo el update sobre la base de datos en la tabla ORD_DATOSNIV
		$this->db->where('ID', $id);
		$this->db->update('ORD_DATOSNIV', $data);
	}
	public function updateTreeCodes($id, $codigo, $nombre, $descripcion, $tiempo, $usuario)
	{

		/**
		 * Se actualiza la informaci�n de la tabla ORD_ARBOLCODIGO
		 */
		$data = array(
			'CODIGO' => $codigo,
			'NOMBRE' => $nombre,
			'DESCRIPCION' => $descripcion,
			'ID_TIEMPO' => $tiempo,
			'UMOD' => $usuario,
			'FMOD' => cambiaHoraServer()
		);

		// Realizo el update sobre la base de datos en la tabla ORD_ARBOLCODIGO
		$this->db->where('ID', $id);
		$this->db->update('ORD_ARBOLCODIGO', $data);
	}
	public function updateOrderNameAut($idOrden, $name)
	{

		$data = array(
			'NOMBRE_AUTORIZA' => $name
		);

		//Realizo el insert sobre la base de datos de la tabla ORD_ORDEN y una orden específica
		$this->db->where('ID', $idOrden);
		$this->db->update('ORD_ORDEN', $data);
	}

	/* ---------------------------------------------------------- TODO DELETE --------------------------------------------------------- */
	public function deleteValuesGroupCharacteristicsElements($id)
	{
		/**
		 * Elimina relaciones de los valores de los grupos y caracter�sticas
		 */
		$this->db->where('ID_PARGRUELEM', $id);
		$this->db->delete('ORD_VALPARGRUELEM');
	}
	public function deleteProvidersGroupCharacteristicsElements($id)
	{
		/**
		 * Elimina relaciones de los valores de los grupos y caracter�sticas
		 */
		$this->db->where('ID_PARGRUELEM', $id);
		$this->db->delete('ORD_PROGRUPAR');
	}
	public function deleteWorkGruops($id)
	{
		/**
		 * Elimina los roles asociados al grupo de trabajo con id $id
		 */
		$this->db->where('ID_DEFEQUIPO', $id);
		$this->db->delete('ORD_DETDEFEQUIPO');
	}
	public function deleteWorkGruopsOrder($id)
	{
		/**
		 * Elimina los roles asociados al grupo de trabajo con id $id
		 */
		$this->db->where('ID_DEFEQUIPO', $id);
		$this->db->delete('ORD_DETDEFEQUIPOORDEN');
	}
	public function deleteLevelDetail($id)
	{
		/**
		 * Elimina los roles asociados al grupo de trabajo con id $id
		 */
		$this->db->where('ID_DATOSNIV', $id);
		$this->db->delete('ORD_DATOSNIVVAL');
	}
	public function deleteElementProduct($id)
	{
		/**
		 * Elimina los roles asociados al grupo de trabajo con id $id
		 */
		$this->db->where('ID', $id);
		$this->db->delete('ORD_DESPIECE');
	}
	public function deleteElementProductFromProduct($id)
	{
		/**
		 * Elimina los roles asociados al grupo de trabajo con id $id
		 */
		$this->db->where('ID_ARBOLCODIGO', $id);
		$this->db->delete('ORD_DESPIECE');
	}
	public function deleteObsStateOrder($id)
	{
		/**
		 * Elimina la relaci�n de observaciones para el id $id
		 */
		$this->db->where('ID_ORDACTEST', $id);
		$this->db->delete('ORD_ORDACTESTOBS');
	}
	public function deleteTeamStateOrder($id)
	{
		/**
		 * Elimina la relaci�n del equipo de trabajo para el id $id
		 */
		$this->db->where('ID_TORDPROEST', $id);
		$this->db->delete('ORD_ORDENEQUIPO');
	}
	public function deleteStateOrder($id)
	{
		/**
		 * Elimina la relaci�n de estados para la orden con id $id
		 */
		$this->db->where('ID', $id);
		$this->db->delete('ORD_ORDACTEST');
	}
	public function deleteElementOfOrder($id)
	{
		/**
		 * Elimina la relaci�n de despiece orden con id $id
		 */
		$this->db->where('ID_ORDEN', $id);
		$this->db->delete('ORD_ORDACTDES');
	}
	public function deleteOrder($id)
	{
		/**
		 * Elimina la relaci�n de la orden con id $id
		 */
		$this->db->where('ID', $id);
		$this->db->delete('ORD_ORDEN');
	}
	public function deleteElementOfProductOrder($id)
	{
		/**
		 * Elimina la relaci�n de la orden con id $id
		 */
		$this->db->where('ID', $id);
		$this->db->delete('ORD_ORDACTDES');
	}

	public function deleteStatisticsRelation($usuario)
	{
		/**
		 * Elimina la relaci�n de la orden con id $id
		 */
		$this->db->where('ID_USUARIO', $usuario);
		$this->db->delete('ORD_TIPOUSUARIOESTAD');
	}

	public function deleteOrdersRelation($id)
	{
		/**
		 * Elimina la relaci�n de la orden con id $id
		 */
		$this->db->where('ID_INICIO', $id);
		$this->db->delete('ORD_RELESTADO');
	}

	/* ---------------------------------------------------------- SELECT --------------------------------------------------------- */
	public function selectGroupsCharacteristics()
	{
		/**
		 * Seleccciona los registros que se encuentran definidos dentro de la tabla ORD_PARGRUELEM
		 */
		$sql = "select ORD_PARGRUELEM.ID as ID,
					 ORD_GRUELEM.NOMBRE as GRUPO, 
					 ORD_PARELEM.NOMBRE as CARACTERISTICA,
					 ORD_PARGRUELEM.ESTADO as ESTADO
		from ORD_PARGRUELEM, ORD_GRUELEM,ORD_PARELEM
		where ORD_PARGRUELEM.ID_GRUELEM=ORD_GRUELEM.ID
		and ORD_PARGRUELEM.ID_PARELEM=ORD_PARELEM.ID
		
		order by  ORD_GRUELEM.NOMBRE ASC, ORD_PARELEM.NOMBRE ASC";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function getListValueGroupCharacteristics($id)
	{
		/**
		 * Obtiene el detalle de las lista de la relaci�n de $id la cual corresponde a grupos y caracteristicas
		 */
		$sql = "select *
                from ORD_VALPARGRUELEM
                where ORD_VALPARGRUELEM.ID_PARGRUELEM='" . $id . "'
                ";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function getListProvidersGroupCharacteristics($id)
	{
		/**
		 * Obtiene el detalle de las lista de la relaci�n de $id la cual corresponde a grupos y caracteristicas
		 */
		$sql = "select ID_PROVEEDOR
                from ORD_PROGRUPAR
                where ORD_PROGRUPAR.ID_PARGRUELEM='" . $id . "'
                ";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectElements()
	{
		/**
		 * Seleccciona los registros que se encuentran definidos dentro de la tabla ORD_ELEMENTO
		 */
		$sql = "select ORD_ELEMENTO.ID as ID,
					 ORD_ELEMENTO.CODIGO as CODIGO,
					 ORD_GRUELEM.NOMBRE as GRUPO,
					 ORD_ELEMENTO.NOMBRE as NOMBRE,
					 ORD_ELEMENTO.COMODIN,
					 ORD_ELEMENTO.ESTADO as ESTADO
		from ORD_ELEMENTO, ORD_GRUELEM
		where ORD_ELEMENTO.ID_GRUELEM=ORD_GRUELEM.ID
		order by  ORD_ELEMENTO.NOMBRE ASC, ORD_GRUELEM.NOMBRE ASC";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectBodyPartsSection($miembros)
	{
		/**
		 * Seleccciona los registros que se encuentran definidos dentro de la tabla ORD_NIVELAMP
		 */
		$sql = "select *
		from ORD_NIVELAMP
		where ORD_NIVELAMP.ID_MIEMBROS=$miembros
		and ORD_NIVELAMP.ESTADO='" . ACTIVO_ESTADO . "'
		order by  ORD_NIVELAMP.NOMBRE";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectLevelServices()
	{
		/**
		 * Seleccciona los registros que se encuentran definidos dentro de la tabla ORD_NIVSERVICIO
		 */
		$sql = "select *
		from ORD_NIVSERVICIO
		where ORD_NIVSERVICIO.ESTADO='" . ACTIVO_ESTADO . "'
		order by  ORD_NIVSERVICIO.NOMBRE";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectStatesOrdersTypeProcess($proceso = null, $tipo = null)
	{
		/**
		 * Selecciona la relaci�n de estados que se encuentran frente a un tipo de orden y un proceso de atenci�n
		 */

		// Condiciones adicionales
		if ($proceso != null) {
			$proceso = "and ORD_PROCESO.ID='$proceso' ";
		} else {
			$proceso = "";
		}
		if ($tipo != null) {
			$tipo = "and ORD_TIPOORDEN.ID='$tipo' ";
		} else {
			$tipo = "";
		}
		// Construyo el query
		$sql = "select ORD_TORDPROEST.ID,
				ORD_PROCESO.NOMBRE AS PROCESO,
				ORD_TIPOORDEN.NOMBRE AS TIPOORDEN,
				ORD_ESTADOS.NOMBRE as NOMBRE,
				ORD_ESTADOS.ID as ID_ESTADO,
				ORD_TORDPROEST.ESTADO AS ESTADO
		from ORD_TIPOORDEN, 
				ORD_PROCESO,
				ORD_ESTADOS, 
				ORD_TORDPROEST,
				ORD_TORDPRO
		where ORD_TORDPRO.ID_TIPOORDEN=ORD_TIPOORDEN.ID
		and ORD_TORDPRO.ID_PROCESO=ORD_PROCESO.ID
		and ORD_TORDPRO.ID= ORD_TORDPROEST.ID_TORDPRO
		and ORD_TORDPROEST.ID_ESTADO=ORD_ESTADOS.ID
		$proceso
		$tipo
		order by  ORD_PROCESO.NOMBRE ASC, ORD_TIPOORDEN.NOMBRE ASC, ORD_ESTADOS.NOMBRE ";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectStatesOrdersTypeProcessWithFilter($estado, $tipo, $proceso)
	{
		/**
		 * Selecciona la relaci�n de los estados
		 */
		$sql = "select ORD_TORDPROEST.ID,	
					 ORD_ESTADOS.NOMBRE as NOMBRE
		from ORD_TIPOORDEN,
				ORD_PROCESO,
				ORD_ESTADOS,
				ORD_TORDPROEST,
				ORD_TORDPRO
		where ORD_TORDPRO.ID_TIPOORDEN=ORD_TIPOORDEN.ID
		and ORD_TORDPRO.ID_PROCESO=ORD_PROCESO.ID
		and ORD_TORDPRO.ID= ORD_TORDPROEST.ID_TORDPRO
		and ORD_TORDPROEST.ID_ESTADO=ORD_ESTADOS.ID
		and ORD_PROCESO.ID='$proceso'
		and ORD_TIPOORDEN.ID='$tipo'
		and ORD_TORDPROEST.ID_ESTADO != '$estado'
		order by  ORD_ESTADOS.NOMBRE ";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function getListValueLevelDefinitionDetail($id)
	{
		/**
		 * Obtiene el detalle de las lista de los niveles creados
		 */
		$sql = "select *
                from ORD_DATOSNIVVAL
                where ORD_DATOSNIVVAL.ID_DATOSNIV='" . $id . "'
                ";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectOrdersTypeBodyPartsConfiguration()
	{
		/**
		 * Seleccciona los registros que se encuentran definidos dentro de la tabla ORD_PARGRUELEM
		 */
		$sql = "select ORD_TIPOMIEM.ID as ID,
					 ORD_TIPOORDEN.NOMBRE as TIPO,
					 ORD_MIEMBROS.NOMBRE as MIEMBROS,
					 ORD_TIPOMIEM.ESTADO as ESTADO,
                    ORD_TIPOORDEN.ID_CLASETIPO as CLASE
		from ORD_TIPOMIEM, ORD_TIPOORDEN,ORD_MIEMBROS
		where ORD_TIPOMIEM.ID_TIPOORDEN=ORD_TIPOORDEN.ID
		and ORD_TIPOMIEM.ID_MIEMBROS=ORD_MIEMBROS.ID
	
		order by  ORD_TIPOORDEN.NOMBRE ASC, ORD_MIEMBROS.NOMBRE ASC";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectBodyPartsSectionInTipoMiem($id)
	{
		/**
		 * Seleccciona los registros que se encuentran definidos dentro de la tabla ORD_NAMPTMIEM para el ID_TIPOMIEM $id
		 */
		$sql = "select ORD_NIVELAMP.ID, ORD_NIVELAMP.NOMBRE, ORD_NAMPTMIEM.ID AS ID_NIVELAMP
		from ORD_NIVELAMP, ORD_NAMPTMIEM
		where ORD_NIVELAMP.ID=ORD_NAMPTMIEM.ID_NIVELAMP
		and ORD_NAMPTMIEM.ID_TIPOMIEM='$id'
		and ORD_NAMPTMIEM.ESTADO='" . ACTIVO_ESTADO . "'
		order by  ORD_NIVELAMP.NOMBRE";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectServiceSectionInTipoMiem($id)
	{
		/**
		 * Seleccciona los registros que se encuentran definidos dentro de la tabla ORD_NAMPTMIEM para el ID_TIPOMIEM $id
		 */
		$sql = "select ORD_NIVSERVICIO.ID, ORD_NIVSERVICIO.NOMBRE, ORD_NIVSERTIPORD.ID AS ID_NIVELAMP
		from ORD_NIVSERVICIO, ORD_NIVSERTIPORD
		where ORD_NIVSERVICIO.ID=ORD_NIVSERTIPORD.ID_NIVSERVICIO
		and ORD_NIVSERTIPORD.ID_TIPOMIEM='$id'
		and ORD_NIVSERTIPORD.ESTADO='" . ACTIVO_ESTADO . "'
		order by  ORD_NIVSERVICIO.NOMBRE";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectSubNivelWithFilters($nivelActual, $miembro)
	{
		/**
		 * Selecciona los niveles previamente creados y configurados en ORD_DATOSNIV
		 */
		$sql = "select DISTINCT ORD_DATOSNIV.ID,
				             ORD_DATOSNIV.NOMBRE
				      from ORD_DATOSNIV
				      where ORD_DATOSNIV.ID_MIEMBROS in('$miembro','0')
				      and  ORD_DATOSNIV.NIVEL='$nivelActual'
				      and  ORD_DATOSNIV.ESTADO='" . ACTIVO_ESTADO . "'
				      order by ORD_DATOSNIV.ID";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectValuesLevelDefinition($level)
	{
		/**
		 * Selecciona los niveles previamente creados y configurados en ORD_DATOSNIVVAL
		 */
		$sql = "select DISTINCT ORD_DATOSNIVVAL.ID,
		ORD_DATOSNIVVAL.NOMBRE
		from ORD_DATOSNIVVAL
		where ORD_DATOSNIVVAL.ID_DATOSNIV ='$level'
		and  ORD_DATOSNIVVAL.ESTADO='" . ACTIVO_ESTADO . "'
		order by ORD_DATOSNIVVAL.ID";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectValuesFirstSubLevelDefinition($id, $subnivel, $tabla)
	{
		/**
		 * Selecciona los diferentes niveles que se deben tener en cuenta dentro de la definici�n del arbol
		 */
		if ($subnivel == 2) {
			$sql = "SELECT *
						from VIEW_ORD_ARBOL_PS
						WHERE VIEW_ORD_ARBOL_PS.ID_TIPOMIEM = $id
						AND VIEW_ORD_ARBOL_PS.TABLA_ANT='$tabla'";
		} else {
			$sql = "SELECT *
			from VIEW_ORD_ARBOL_SS
			WHERE VIEW_ORD_ARBOL_SS.ID_TIPOMIEM = $id
			AND VIEW_ORD_ARBOL_SS.TABLA_ANT='$tabla'";
		}

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectTreeInformation($pagina, $variable, $idNestable, $proceso = null)
	{
		/**
		 * Pinto lla estructura del �rbol de productos y servicios, arrancando por el tipo de orden y posterior ejecuci�n de funciones anidadas
		 */


		//echo $pagina;

		if ($pagina == 'OrdersConfigurationProductsDefinition/newRegister/') {
			$sql = "select ORD_TIPOORDEN.ID,
				ORD_TIPOORDEN.NOMBRE
				FROM ORD_TIPOORDEN
				WHERE ORD_TIPOORDEN.ESTADO='" . ACTIVO_ESTADO . "'
                and ORD_TIPOORDEN.ID_CLASETIPO!=3";
		} else {
			$sql = "select ORD_TIPOORDEN.ID,
				ORD_TIPOORDEN.NOMBRE
				FROM ORD_TIPOORDEN
				WHERE ORD_TIPOORDEN.ESTADO='" . ACTIVO_ESTADO . "'";
		}

		//echo $sql;
		// Tengo los resultados principales frente a tipo de orden
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$array = $result->result();
		} else {
			$array = null;
		}

		$nestable = '
				<script type="text/javascript">
			    $(document).ready(function() {
			        // Nestable
			    	$(document).ready(function(){
			    		   $("#' . $idNestable . '").nestable({
			    		      maxDepth: 10,
			    		      collapsedClass:\'dd-collapsed\',
			    		   }).nestable(\'collapseAll\');//Add this line
			    		});
			    });
			    </script>
			    <center>
                
				<div class="myadmin-dd dd" id="' . $idNestable . '">
		        	<ol class="dd-list">
			            ';
		// $primerNivel=null;
		if ($array != null) {
			foreach ($array as $a) {
				// Obtengo Primer nivel
				$anidado = $this->selectTreeInformationFirstLevel($a->ID, $pagina);
				// Valido de acuerdo al valor de proceso
				if ($proceso == '') {
					// Configuraci�n
					$nestable .= '
					<li class="dd-item" data-id="TO_' . $a->ID . '">
			            	<div class="dd-handle ' . BG_BOX_INTERFACE . '" style="color: white;"> ' . $a->NOMBRE . ' </div>
			            	' . $anidado . '
		            </li>';
				} else {
					// Valido si se tiene la relaci�n creada de PRoceso y Tipo de orden
					$idTordPro = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_TORDPRO", "ID", "ID_TIPOORDEN", $a->ID, "ID_PROCESO", $proceso);
					//echo "<script>console.log('Console: " . $idTordPro . "' );</script>";
					//echo "<script>console.log('ID_TIPOORDEN: " . $a->ID . "' );</script>";
					//echo "<script>console.log('ID_PROCESO: " . $proceso . "' );</script>";
					//echo $idTordPro . " ";
					if ($idTordPro != '') {
						// Debo validar adicionalmente que exista como m�nimo el estado ordenar
						$idTordProEst = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_TORDPROEST", "ID", "ID_TORDPRO", $idTordPro, "ID_ESTADO", ORDER_STATE);
						echo "<script>console.log('idTordProEst: " . $idTordProEst . "' );</script>";
						if ($idTordProEst != '') {
							//Verifico adicionalmente si el usuario tiene permiso para crear dicho tipo de orden
							$idRolPerfil = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_USUROLPER", "ID_ROLPERFIL", "ID_USUARIO", $this->session->userdata('usuario'));
							$idPerfil = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_ROLPERFIL", "ID_PERFIL", "ID", $idRolPerfil);
							$idTordProEstPer = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_TORDPROESTPER", "ID", "ID_TORDPROEST", $idTordProEst, "ID_PERFIL", $idPerfil);
							//echo $idRolPerfil." ".$idPerfil." ".$idTordProEstPer."<br>";
							if ($idTordProEstPer != '') {
								// echo  "valor";
								// Se pinta el menu respectivo
								$nestable .= '
							<li class="dd-item" data-id="TO_' . $a->ID . '">
					            	<div class="dd-handle ' . BG_BOX_INTERFACE . '" style="color: white;"> ' . $a->NOMBRE . ' </div>
					            	' . $anidado . '
				            </li>';
							}
						}
					}
				}
			}
		}

		// Cierro el arbol
		$nestable .= '
				   </ol>
				</div>
				</center>';
		// Retorno el valor
		return $nestable;
	}
	public function selectTreeInformationFirstLevel($tipoOrden, $pagina)
	{
		/**
		 * Selecciona el primer subnivel del arbol de ordenes
		 */
		$sql = "select VIEW_ORD_ARBOL_ZS.IDZS AS ID,
				VIEW_ORD_ARBOL_ZS.NIVELAMP AS NOMBRE,
				VIEW_ORD_ARBOL_ZS.TABLA
				FROM VIEW_ORD_ARBOL_ZS
				WHERE VIEW_ORD_ARBOL_ZS.TIPOORDENID='" . $tipoOrden . "'";
		// echo $sql;
		// Tengo los resultados principales frente a tipo de orden
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$array = $result->result();
		} else {
			$array = null;
		}

		$nestable = '<ol class="dd-list">
			            ';
		if ($array != null) {
			foreach ($array as $a) {
				// Obtengo Primer nivel
				$anidado = $this->selectTreeInformationSecondLevelFirstSub($a->ID, $a->TABLA, $tipoOrden, $pagina);

				$nestable .= '
    						<li class="dd-item " data-id="FL_' . $a->ID . '">
    				            	<div class="dd-handle ' . BG_BOX_INTERFACE2 . '" style="color: white;"> ' . $a->NOMBRE . ' </div>
    				            	' . $anidado . '
    			            </li>';
			}
		}
		// Cierro el arbol
		$nestable .= '
				</ol>';
		// Retorno el valor
		return $nestable;
	}
	public function selectTreeInformationSecondLevelFirstSub($id, $tabla, $tipoOrden, $pagina)
	{
		/**
		 * Selecciona el primer subinivel del segundo Nivel del arbol de ordenes
		 */
		if ($this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOORDEN", "ID_CLASETIPO", "ID", $tipoOrden) == 3) {
			//Debo seleccionar el grupo de elementos de acuerdo al nivel de amputaci�n relacionada  para esto encuentro el di_miembro
			$idMiembro = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_TIPOMIEM", "ID_MIEMBROS", "ID_TIPOORDEN", $tipoOrden);
			$nestable = '
				<ol class="dd-list">
			            ';
			$sql = "SELECT
                    ORD_GRUELEM.ID,
                    ORD_GRUELEM.NOMBRE
                    
                    FROM
                    ORD_GRUELEM
                    WHERE
                    ORD_GRUELEM.ESTADO = '" . ACTIVO_ESTADO . "' AND
                    ORD_GRUELEM.ID_MIEMBROS = $idMiembro
                    ";
			echo "<script>console.log('Console: " . $sql . "' );</script>";
			$result = $this->db->query($sql);
			if ($result->num_rows() > 0) {
				$array = $result->result();
			} else {
				$array = null;
			}

			if ($array != null) {
				foreach ($array as $a) {
					// Obtengo Primer nivel
					// Pinto el enlace para continuar
					$nestable .= nestableFunction($pagina, $a->ID, $tipoOrden, $a->NOMBRE, $this);
				}
			}

			// Cierro el arbol
			$nestable .= '
				   </ol>';
		} else {
			$sql = "select VIEW_ORD_ARBOL_PS.ID AS ID,
				VIEW_ORD_ARBOL_PS.SUBNIVEL AS NOMBRE
				FROM VIEW_ORD_ARBOL_PS
				WHERE VIEW_ORD_ARBOL_PS.IDZS='" . $id . "'
				AND  VIEW_ORD_ARBOL_PS.TABLA_ANT='$tabla'";
			// echo $sql;
			// Tengo los resultados principales frente a tipo de orden
			$result = $this->db->query($sql);
			if ($result->num_rows() > 0) {
				$array = $result->result();
			} else {
				$array = null;
			}

			$nestable = '
				<ol class="dd-list">
			            ';
			// $primerNivel=null;
			if ($array != null) {
				foreach ($array as $a) {
					// Obtengo Primer nivel
					if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden) == 1) {
						// Pinto el enlace para continuar
						$nestable .= nestableFunction($pagina, $a->ID, $tipoOrden, $a->NOMBRE, $this);
					} else {
						// Pinto el siguiente nivel
						$aninado = $this->selectTreeInformationSecondLevelSecondSub($a->ID, $tipoOrden, $pagina);
						$nestable .= '
						<li class="dd-item" data-id="SL1_' . $a->ID . '">
				            	<div class="dd-handle ' . BG_BOX_INTERFACE . '" style="color: white;"> ' . $a->NOMBRE . ' </div>
				            	' . $aninado . '
			            </li>';
					}
				}
			}
			// Cierro el arbol
			$nestable .= '
				   </ol>';
		}



		// Retorno el valor
		return $nestable;
	}
	public function selectTreeInformationSecondLevelSecondSub($id, $tipoOrden, $pagina)
	{
		/**
		 * Selecciona el primer subinivel del segundo Nivel del �rbol de ordenes
		 */
		$sql = "select VIEW_ORD_ARBOL_SS.ID AS ID,
				VIEW_ORD_ARBOL_SS.SUBNIVEL2 AS NOMBRE
				FROM VIEW_ORD_ARBOL_SS
				WHERE VIEW_ORD_ARBOL_SS.VIEW_ORD_ARBOL_PS='" . $id . "'";
		// echo $sql;
		// Tengo los resultados principales frente a tipo de orden
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$array = $result->result();
		} else {
			$array = null;
		}

		$nestable = '
				<ol class="dd-list">
			            ';
		// $primerNivel=null;
		if ($array != null) {
			foreach ($array as $a) {
				// Obtengo Primer nivel
				if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "NIVELES", $tipoOrden) == 2) {
					// Pinto el enlace para continuar
					$nestable .= nestableFunction($pagina, $a->ID, $tipoOrden, $a->NOMBRE, $this);
				} else {
					// Pinto el siguiente nivel
					$aninado = $this->selectTreeInformationSecondLevelThirdSub($a->ID, $tipoOrden, $pagina);
					$nestable .= '
						<li class="dd-item" data-id="SL1_' . $a->ID . '">
				            	<div class="dd-handle ' . BG_BOX_INTERFACE2 . '" style="color: white;"> ' . $a->NOMBRE . ' </div>
				            	' . $aninado . '
			            </li>';
				}
			}
		}
		// Cierro el arbol
		$nestable .= '
				   </ol>';
		// Retorno el valor
		return $nestable;
	}
	public function selectTreeInformationSecondLevelThirdSub($id, $tipoOrden, $pagina)
	{
		/**
		 * Selecciona el primer subinivel del tercer Nivel del arbol de ordenes
		 */
		$sql = "select VIEW_ORD_ARBOL_TS.ID AS ID,
				VIEW_ORD_ARBOL_TS.SUBNIVEL3 AS NOMBRE
				FROM VIEW_ORD_ARBOL_TS
				WHERE VIEW_ORD_ARBOL_TS.VIEW_ORD_ARBOL_SS='" . $id . "'";
		// echo $sql;
		// Tengo los resultados principales frente a tipo de orden
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$array = $result->result();
		} else {
			$array = null;
		}

		$nestable = '
				<ol class="dd-list">
			            ';
		// $primerNivel=null;
		if ($array != null) {
			foreach ($array as $a) {
				// Obtengo Primer nivel

				$nestable .= nestableFunction($pagina, $a->ID, $tipoOrden, $a->NOMBRE, $this);
			}
		}
		// Cierro el arbol
		$nestable .= '
				   </ol>';
		// Retorno el valor
		return $nestable;
	}




	public function selectProductListDefinition($id = null)
	{
		/**
		 * Seleccionalos elementos que se encuentran creados dentro del arbol de productos y servicios
		 */
		if ($id != '') {
			$sql = "SELECT *
			from VIEW_ORD_ARBOLPRODUCTOS
			where VIEW_ORD_ARBOLPRODUCTOS.ID_ARBOLVALORES='$id'";
		} else {
			$sql = "SELECT *
			from VIEW_ORD_ARBOLPRODUCTOS";
		}

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectGroupElementListByBodyPart($idMiembros)
	{
		/**
		 * Selecciona el grupo de elementos respectivo teniendo en cuenta los Miembros
		 */
		$sql = "SELECT *
			from ORD_GRUELEM
			where ORD_GRUELEM.ID_MIEMBROS in('$idMiembros','-1')";

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectElementProductoList($id)
	{
		/**
		 * Listo los elementos asociados a un despiece
		 */
		$sql = "SELECT ORD_DESPIECE.ID as ID_DESPIECE, 
					 ORD_ELEMENTO.NOMBRE,
					 ORD_ELEMENTO.ID as ID_ELEMENTO,
					 ORD_ELEMENTO.CODIGO,
					 ORD_ELEMENTO.COMODIN,
					 ORD_DESPIECE.CANTIDAD,
					 ADM_DETLISTA.VALOR AS UNIDAD
		from ORD_DESPIECE, ORD_ELEMENTO, ORD_GRUELEM,ADM_DETLISTA
		where ORD_DESPIECE.ID_ARBOLCODIGO='$id'
		and ORD_DESPIECE.ID_ELEMENTO=ORD_ELEMENTO.ID
		and ORD_ELEMENTO.ID_GRUELEM= ORD_GRUELEM.ID
		and ORD_GRUELEM.UNIDAD=ADM_DETLISTA.ID

		and ORD_DESPIECE.ESTADO='" . ACTIVO_ESTADO . "'";

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectOrdersPredecessor($historia)
	{
		/**
		 * Listo las ordenes anteriores asociadas al paciente
		 */
		$sql = "select ORD_ORDEN.ID,
				     ORD_ORDEN.ID_TORDPRO,
					 ORD_ORDEN.CONS,
				     ORD_TIPOORDEN.PREFIJO
				     " . "from ORD_ORDEN," . "	  ORD_ENCORDEN,
				 ORD_TORDPRO,
				 ORD_TIPOORDEN " . "where ORD_ENCORDEN.HISTORIA='$historia' " . "and ORD_ENCORDEN.ID=ORD_ORDEN.ID_ENCORDEN " . "and ORD_ENCORDEN.ESTADO='" . ACTIVO_ESTADO . "' " . "and ORD_ENCORDEN.CERRADO='0' " . "and ORD_ORDEN.ESTADO='" . ACTIVO_ESTADO . "' 
			 AND ORD_TORDPRO.ID=ORD_ORDEN.ID_TORDPRO
			 and ORD_TORDPRO.ID_TIPOORDEN=ORD_TIPOORDEN.ID " . "order by ORD_ORDEN.FCREA DESC ";

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectElementsOfTree($idArbol, $condicion = null)
	{
		/**
		 * Listo los elemento o servicios de acuerdo al valor del arbol $idArbol
		 */
		$sql = "select * from ORD_ARBOLCODIGO
				WHERE ORD_ARBOLCODIGO.ESTADO='" . ACTIVO_ESTADO . "' 
				AND ORD_ARBOLCODIGO.ID_ARBOLVALORES='$idArbol'
                $condicion";

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectMedicalServiceOfTree()
	{
		/**
		 * Listo los elemento o servicios de acuerdo al valor del arbol $idArbol
		 */
		$sql = "SELECT
					ORD_ARBOLCODIGO.ID,
					ORD_ARBOLCODIGO.CODIGO,
					ORD_ARBOLCODIGO.NOMBRE
					
			 FROM
					ORD_ARBOLCODIGO
						INNER JOIN ORD_PAQUETEVALORA 
							ON ORD_PAQUETEVALORA.ID_ARBOLCODIGO = ORD_ARBOLCODIGO.ID
			WHERE
					ORD_ARBOLCODIGO.ESTADO = '" . ACTIVO_ESTADO . "' 
			AND     ORD_PAQUETEVALORA.ESTADO = '" . ACTIVO_ESTADO . "'
			";

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function searchStateOrderType($tipoEstado, $tordPro)
	{
		/**
		 * Selecccion el id de la relaci�n tipo de orden proceso estado para el tipoProceso $tordPro y el tipo Estado $tipoEstado
		 */
		$sql = "select ORD_TORDPROEST.ID
		  from ORD_ESTADOS,
		  ORD_TORDPROEST
		  where ORD_TORDPROEST.ID_TORDPRO='$tordPro'
		  and ORD_TORDPROEST.ID_ESTADO=ORD_ESTADOS.ID
		  and ORD_ESTADOS.TIPOESTADO='$tipoEstado'";
		// ejecuto la consulta
		//ECHO $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$resultado = $result->row();
			$return = $resultado->ID;
			return $return;
		}
	}
	public function selectListWorkGroup($idTipoOrden, $opcion)
	{
		/**
		 * Listo los perfiles seleccionados, de acuerdo al tipo de orden
		 */
		if ($opcion == 1) {
			$sql = "SELECT
			ADM_PERFIL.ID,
			ADM_PERFIL.NOMBRE
			FROM
			ORD_DETDEFEQUIPO
			INNER JOIN ORD_DEFEQUIPO ON ORD_DETDEFEQUIPO.ID_DEFEQUIPO = ORD_DEFEQUIPO.ID
			INNER JOIN ADM_PERFIL ON ORD_DETDEFEQUIPO.ID_INFROL = ADM_PERFIL.ID
			WHERE
			ORD_DEFEQUIPO.ID_TIPOORDEN = '$idTipoOrden'";
		} else {
			$sql = "SELECT
				ADM_PERFIL.ID,
				ADM_PERFIL.NOMBRE
			FROM
				ORD_DETDEFEQUIPOORDEN
			INNER JOIN ORD_DEFEQUIPOORDEN ON ORD_DETDEFEQUIPOORDEN.ID_DEFEQUIPO = ORD_DEFEQUIPOORDEN.ID
			INNER JOIN ADM_PERFIL ON ORD_DETDEFEQUIPOORDEN.ID_INFROL = ADM_PERFIL.ID
			WHERE
				ORD_DEFEQUIPOORDEN.ID_TIPOORDEN = '$idTipoOrden'";
		}

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectListOrdersFromHead($encabezado, $cc)
	{
		/**
		 * Listo las ordenes que se han creado dentro de la cabecera de orden $encabezado
		 */
		$sql = "SELECT
		ORD_ORDEN.ID,
		ORD_ARBOLCODIGO.CODIGO,
		ORD_ARBOLCODIGO.NOMBRE,
		ORD_ORDEN.CONS,
		ORD_ORDEN.CANTIDAD,
		ORD_TIPOORDEN.PREFIJO,
		ORD_ORDEN.OBSERVACION,
		COT_USUARIOCOTI.ID_USUARIO,
		COT_USUARIO.DOCUMENTO
	FROM
		ORD_ARBOLCODIGO,
		ORD_ORDEN,
		ORD_TORDPRO,
		ORD_TIPOORDEN,
		COT_USUARIOCOTI,
		COT_USUARIO
	WHERE
		ORD_ORDEN.ID_ENCORDEN = '$encabezado'
	AND COT_USUARIO.DOCUMENTO= $cc
	AND ORD_ORDEN.ID_COTIZACION = COT_USUARIOCOTI.ID_COTIZACION
	AND COT_USUARIOCOTI.ID_USUARIO = COT_USUARIO.ID
	AND ORD_ORDEN.ACTIVIDAD = ORD_ARBOLCODIGO.ID
	AND ORD_ORDEN.ACTIVIDAD = ORD_ARBOLCODIGO.ID
	AND ORD_ORDEN.ACTIVIDAD = ORD_ARBOLCODIGO.ID
	AND ORD_ORDEN.ESTADO = '" . ACTIVO_ESTADO . "'
	AND ORD_TORDPRO.ID = ORD_ORDEN.ID_TORDPRO
	AND ORD_TORDPRO.ID_TIPOORDEN = ORD_TIPOORDEN.ID
	AND ORD_TIPOORDEN.ID_CLASETIPO ! = '3'
	UNION ALL
		SELECT
			ORD_ORDEN.ID,
			ORD_ELEMENTO.CODIGO,
			ORD_ELEMENTO.NOMBRE,
			ORD_ORDEN.CONS,
			ORD_ORDEN.CANTIDAD,
			ORD_TIPOORDEN.PREFIJO,
			ORD_ORDEN.OBSERVACION,
			COT_USUARIOCOTI.ID_USUARIO,
			COT_USUARIO.DOCUMENTO
		FROM
			ORD_ELEMENTO,
			ORD_ORDEN,
			ORD_TORDPRO,
			ORD_TIPOORDEN,
			COT_USUARIOCOTI,
			COT_USUARIO
		WHERE
			ORD_ORDEN.ID_ENCORDEN = '$encabezado'			
		AND COT_USUARIO.DOCUMENTO= $cc
		AND ORD_ORDEN.ID_COTIZACION = COT_USUARIOCOTI.ID_COTIZACION
		AND COT_USUARIOCOTI.ID_USUARIO = COT_USUARIO.ID
		AND ORD_ORDEN.ACTIVIDAD = ORD_ELEMENTO.ID
		AND ORD_ORDEN.ESTADO = '" . ACTIVO_ESTADO . "'
		AND ORD_TORDPRO.ID = ORD_ORDEN.ID_TORDPRO
		AND ORD_TORDPRO.ID_TIPOORDEN = ORD_TIPOORDEN.ID
		AND ORD_TIPOORDEN.ID_CLASETIPO = '3'
			";

		//echo $sql;
		//echo "<script>console.log('Console: " . $sql . "' );</script>";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListOrdersFromHead1($encabezado, $cc)
	{
		/**
		 * Listo las ordenes que se han creado dentro de la cabecera de orden $encabezado
		 */
		$sql = "SELECT
		ORD_ORDEN.ID,
		ORD_ARBOLCODIGO.CODIGO,
		ORD_ARBOLCODIGO.NOMBRE,
		ORD_ORDEN.CONS,
		ORD_ORDEN.CANTIDAD,
		ORD_TIPOORDEN.PREFIJO,
		ORD_ORDEN.OBSERVACION,
		COT_USUARIOCOTI.ID_USUARIO,
		COT_USUARIO.DOCUMENTO
	FROM
		ORD_ARBOLCODIGO,
		ORD_ORDEN,
		ORD_TORDPRO,
		ORD_TIPOORDEN,
		COT_USUARIOCOTI,
		COT_USUARIO
	WHERE
		ORD_ORDEN.ID_ENCORDEN = '$encabezado'
	AND COT_USUARIO.DOCUMENTO= $cc
	AND ORD_ORDEN.ID_COTIZACION = COT_USUARIOCOTI.ID_COTIZACION
	AND COT_USUARIOCOTI.ID_USUARIO = COT_USUARIO.ID
	AND ORD_ORDEN.ACTIVIDAD = ORD_ARBOLCODIGO.ID
	AND ORD_ORDEN.ACTIVIDAD = ORD_ARBOLCODIGO.ID
	AND ORD_ORDEN.ACTIVIDAD = ORD_ARBOLCODIGO.ID
	AND ORD_TORDPRO.ID = ORD_ORDEN.ID_TORDPRO
	AND ORD_TORDPRO.ID_TIPOORDEN = ORD_TIPOORDEN.ID
	AND ORD_TIPOORDEN.ID_CLASETIPO ! = '3'
	UNION ALL
		SELECT
			ORD_ORDEN.ID,
			ORD_ELEMENTO.CODIGO,
			ORD_ELEMENTO.NOMBRE,
			ORD_ORDEN.CONS,
			ORD_ORDEN.CANTIDAD,
			ORD_TIPOORDEN.PREFIJO,
			ORD_ORDEN.OBSERVACION,
			COT_USUARIOCOTI.ID_USUARIO,
			COT_USUARIO.DOCUMENTO
		FROM
			ORD_ELEMENTO,
			ORD_ORDEN,
			ORD_TORDPRO,
			ORD_TIPOORDEN,
			COT_USUARIOCOTI,
			COT_USUARIO
		WHERE
			ORD_ORDEN.ID_ENCORDEN = '$encabezado'			
		AND COT_USUARIO.DOCUMENTO= $cc
		AND ORD_ORDEN.ID_COTIZACION = COT_USUARIOCOTI.ID_COTIZACION
		AND COT_USUARIOCOTI.ID_USUARIO = COT_USUARIO.ID
		AND ORD_ORDEN.ACTIVIDAD = ORD_ELEMENTO.ID
		AND ORD_TORDPRO.ID = ORD_ORDEN.ID_TORDPRO
		AND ORD_TORDPRO.ID_TIPOORDEN = ORD_TIPOORDEN.ID
		AND ORD_TIPOORDEN.ID_CLASETIPO = '3'
			";

		//echo $sql;
		//echo "<script>console.log('Console: " . $sql . "' );</script>";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListOrdersFromHead2($idOrden, $cc)
	{
		/**
		 * Listo las ordenes que se han creado dentro de la cabecera de orden $encabezado
		 */
		$sql = "SELECT
		ORD_ORDEN.ID,
		ORD_ARBOLCODIGO.CODIGO,
		ORD_ARBOLCODIGO.NOMBRE,
		ORD_ORDEN.CONS,
		ORD_ORDEN.CANTIDAD,
		ORD_TIPOORDEN.PREFIJO,
		ORD_ORDEN.OBSERVACION,
		COT_USUARIOCOTI.ID_USUARIO,
		COT_USUARIO.DOCUMENTO
	FROM
		ORD_ARBOLCODIGO,
		ORD_ORDEN,
		ORD_TORDPRO,
		ORD_TIPOORDEN,
		COT_USUARIOCOTI,
		COT_USUARIO
	WHERE
	ORD_ORDEN.ID = '$idOrden'
	AND COT_USUARIO.DOCUMENTO= $cc
	AND ORD_ORDEN.ID_COTIZACION = COT_USUARIOCOTI.ID_COTIZACION
	AND COT_USUARIOCOTI.ID_USUARIO = COT_USUARIO.ID
	AND ORD_ORDEN.ACTIVIDAD = ORD_ARBOLCODIGO.ID
	AND ORD_ORDEN.ACTIVIDAD = ORD_ARBOLCODIGO.ID
	AND ORD_ORDEN.ACTIVIDAD = ORD_ARBOLCODIGO.ID
	AND ORD_ORDEN.ESTADO = '" . ACTIVO_ESTADO . "'
	AND ORD_TORDPRO.ID = ORD_ORDEN.ID_TORDPRO
	AND ORD_TORDPRO.ID_TIPOORDEN = ORD_TIPOORDEN.ID
	AND ORD_TIPOORDEN.ID_CLASETIPO ! = '3'
	UNION ALL
		SELECT
			ORD_ORDEN.ID,
			ORD_ELEMENTO.CODIGO,
			ORD_ELEMENTO.NOMBRE,
			ORD_ORDEN.CONS,
			ORD_ORDEN.CANTIDAD,
			ORD_TIPOORDEN.PREFIJO,
			ORD_ORDEN.OBSERVACION,
			COT_USUARIOCOTI.ID_USUARIO,
			COT_USUARIO.DOCUMENTO
		FROM
			ORD_ELEMENTO,
			ORD_ORDEN,
			ORD_TORDPRO,
			ORD_TIPOORDEN,
			COT_USUARIOCOTI,
			COT_USUARIO
		WHERE
		ORD_ORDEN.ID = '$idOrden'			
		AND COT_USUARIO.DOCUMENTO= $cc
		AND ORD_ORDEN.ID_COTIZACION = COT_USUARIOCOTI.ID_COTIZACION
		AND COT_USUARIOCOTI.ID_USUARIO = COT_USUARIO.ID
		AND ORD_ORDEN.ACTIVIDAD = ORD_ELEMENTO.ID
		AND ORD_ORDEN.ESTADO = '" . ACTIVO_ESTADO . "'
		AND ORD_TORDPRO.ID = ORD_ORDEN.ID_TORDPRO
		AND ORD_TORDPRO.ID_TIPOORDEN = ORD_TIPOORDEN.ID
		AND ORD_TIPOORDEN.ID_CLASETIPO = '3'
			";

		//echo $sql;
		//echo "<script>console.log('Console: " . $sql . "' );</script>";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectNextStatesProcess($idTordProEst, $orden)
	{
		/**
		 * Listo los estados siguientes para el estado seleccionado, de acuerdo al orden dado
		 */
		$sql = "select ORD_RELESTADO.ID_FIN,
					 ORD_RELESTADO.ID_INICIO
				from ORD_RELESTADO 
				where ORD_RELESTADO.ID_INICIO='$idTordProEst' 
				and ORD_RELESTADO.ORDEN='$orden' 
				and ORD_RELESTADO.ESTADO='S' 
				order by ORD_RELESTADO.ID ";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectLastStatesProcess($idTordProEst, $orden)
	{
		/**
		 * Listo los estados anteriores para el estado seleccionado, de acuerdo al orden dado
		 */
		$sql = "select ORD_RELESTADO.ID_FIN,
					 ORD_RELESTADO.ID_INICIO
		from ORD_RELESTADO
		where ORD_RELESTADO.ID_FIN='$idTordProEst'
		and ORD_RELESTADO.ORDEN='$orden'
		and ORD_RELESTADO.ESTADO='S'
		order by ORD_RELESTADO.ID ";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectListOrdersFromHistory($historia)
	{
		/**
		 * Listo las ordenes que se han creado dentro de la cabecera de orden $encabezado
		 */
		$sql = "
		SELECT
			ORD_ORDEN.ID,
			ORD_ELEMENTO.CODIGO,
			ORD_ELEMENTO.NOMBRE,
			ORD_ORDEN.CONS,
			ORD_ORDEN.CANTIDAD,
			ORD_TIPOORDEN.PREFIJO,
			ORD_ENCORDEN.FCREA AS FECHA,
			ORD_PROCESO.NOMBRE AS PROCESO,
			ORD_ENCORDEN.ID AS ID_ENCORDEN,
			ORD_ENCORDEN.HISTORIA AS HISTORIA,
			COT_COTIZACION.CONSECUTIVO AS CONSECUTIVO
		from 
			ORD_ELEMENTO,
			ORD_TORDPRO,
			ORD_TIPOORDEN,
			ORD_ENCORDEN,
			ORD_PROCESO,
			ORD_ORDEN LEFT JOIN 	COT_COTIZACION on COT_COTIZACION.ID = ORD_ORDEN.ID_COTIZACION 
		where ORD_ENCORDEN.HISTORIA='$historia'
		and ORD_ORDEN.ID_ENCORDEN=ORD_ENCORDEN.ID
		and ORD_ORDEN.ACTIVIDAD=ORD_ELEMENTO.ID
		and ORD_TORDPRO.ID=ORD_ORDEN.ID_TORDPRO
		and ORD_TORDPRO.ID_TIPOORDEN=ORD_TIPOORDEN.ID
		and ORD_PROCESO.ID=ORD_TORDPRO.ID_PROCESO
		and ORD_TIPOORDEN.ID_CLASETIPO in('" . CLASE_TIPOORDEN_3 . "','" . CLASE_TIPOORDEN_4 . "')
		AND COT_COTIZACION.ID= ORD_ORDEN.ID_COTIZACION
		UNION ALL 
		SELECT
			ORD_ORDEN.ID,
			ORD_ARBOLCODIGO.CODIGO,
			ORD_ARBOLCODIGO.NOMBRE,
			ORD_ORDEN.CONS,
			ORD_ORDEN.CANTIDAD,
			ORD_TIPOORDEN.PREFIJO,
			ORD_ENCORDEN.FCREA AS FECHA,
			ORD_PROCESO.NOMBRE AS PROCESO,
			ORD_ENCORDEN.ID AS ID_ENCORDEN,
			ORD_ENCORDEN.HISTORIA AS HISTORIA,
			COT_COTIZACION.CONSECUTIVO AS COTIZACION
		from 
			ORD_ARBOLCODIGO,
			ORD_TORDPRO,
			ORD_TIPOORDEN,
			ORD_ENCORDEN,
			ORD_PROCESO,
			ORD_ORDEN LEFT JOIN 	COT_COTIZACION on COT_COTIZACION.ID = ORD_ORDEN.ID_COTIZACION 
			
		where ORD_ENCORDEN.HISTORIA='$historia'
		and ORD_ORDEN.ID_ENCORDEN=ORD_ENCORDEN.ID
		and ORD_ORDEN.ACTIVIDAD=ORD_ARBOLCODIGO.ID
		and ORD_TORDPRO.ID=ORD_ORDEN.ID_TORDPRO
		and ORD_TORDPRO.ID_TIPOORDEN=ORD_TIPOORDEN.ID
		and ORD_PROCESO.ID=ORD_TORDPRO.ID_PROCESO
		and ORD_TIPOORDEN.ID_CLASETIPO in('" . CLASE_TIPOORDEN_1 . "','" . CLASE_TIPOORDEN_2 . "')
		";

		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}



	public function selectListOrdersFromHistoryFull($usuario)
	{
		/**
		 * Listo las ordenes que se han creado dentro de la cabecera de orden $encabezado
		 */
		$sql = "SELECT * FROM VIEW_ORD_ORDENESACTUALES 
        where VIEW_ORD_ORDENESACTUALES.ID_USUARIO='$usuario'
        ORDER BY VIEW_ORD_ORDENESACTUALES.FECHA_ORDEN ASC ";

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectActualState($idOrden)
	{
		/**
		 * Pinto los estados actuales a los cuales tiene relaci�n la orden
		 */
		$sql = "select ORD_ESTADOS.NOMBRE,
					   ORD_ESTADOS.ID,
					   ORD_ORDACTEST.MOMENTO
			from ORD_ORDACTEST, 
				ORD_ESTADOS,
				ORD_TORDPROEST,
				ORD_ORDEN
			where ORD_ORDACTEST.ID_ORDEN='$idOrden' 
			and ORD_ORDACTEST.ID_ORDEN=ORD_ORDEN.ID 
			and ORD_ORDEN.ID_TORDPRO=ORD_TORDPROEST.ID_TORDPRO 
			and ORD_TORDPROEST.ID=ORD_ORDACTEST.ID_TORDPROEST 
			and ORD_ORDACTEST.MOMENTO in('" . OPEN_STATE . "','" . SUSPEND_STATE . "') 
			and ORD_TORDPROEST.ID_ESTADO=ORD_ESTADOS.ID 
			and ORD_ESTADOS.TIPOESTADO not in(4)
			order by ORD_ESTADOS.ID";
		//		echo $sql;
		//echo "<script>console.log('$sql: " .$sql. "' );</script>";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectListOrdersBeforeOrder($idOrden)
	{
		/**
		 * Listo las ordenes que tienen relacionada la orden $idOrden como anterior
		 */
		$sql = "select ID from ORD_ORDEN " . "where ID_ORDENANT='$idOrden' " . "order by ID";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function getQuantityElementsOrder($orden)
	{
		/**
		 * Verifico si tiene despiece y elementos comodin
		 */
		$sql = "select count(*) as CANTIDAD
				from ORD_ORDACTDES, ORD_ELEMENTO
		 		where ORD_ORDACTDES.ID_ORDEN='" . $orden . "'
				and ORD_ORDACTDES.ID_ELEMENTO=ORD_ELEMENTO.ID
 				and ORD_ELEMENTO.COMODIN='1'
 				and ORD_ORDACTDES.ESTADO='" . ACTIVO_ESTADO . "'";
		// ejecuto la consulta
		// echo $sql."<br>";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$resultado = $result->row();
			$return = $resultado->CANTIDAD;
			return $return;
		}
	}
	public function getListElementOfProductOrder($idOrder)
	{
		/**
		 * Listo los elemento o servicios de acuerdo al valor del arbol $idArbol
		 */
		$sql = "SELECT
				 ORD_ORDACTDES.ID,
				 ORD_ELEMENTO.CODIGO,
				 ORD_ELEMENTO.COMODIN,
				 ORD_ORDACTDES.CANTIDAD,
				 ORD_ELEMENTO.NOMBRE,
				 ORD_ORDACTDES.ID,
				 ORD_GRUELEM.UNIDAD,
				 ADM_DETLISTA.NOMBRE as NOMBRE_UNIDAD,
				 ADM_DETLISTA.VALOR as VALOR,
                 ORD_ORDACTDES.TRASLADO,
                 ORD_ORDACTDES.SALIDA,
                 ORD_ORDACTDES.LOTE,
                 ORD_ORDACTDES.SERIAL,
				 ORD_ELEMCOSTO.VALOR as PRICE,
				 ORD_ELEMCOSTO.ID_VALIDA AS MONEDA
				FROM
					ORD_ORDACTDES
					INNER JOIN ORD_ELEMENTO ON ORD_ORDACTDES.ID_ELEMENTO = ORD_ELEMENTO.ID
					INNER JOIN ORD_GRUELEM ON ORD_ELEMENTO.ID_GRUELEM = ORD_GRUELEM.ID
						INNER JOIN ADM_DETLISTA ON ORD_GRUELEM.UNIDAD = ADM_DETLISTA.ID
						INNER JOIN ORD_ELEMCOSTO ON ORD_ELEMCOSTO.ID_ELEMENTO = ORD_ELEMENTO.ID
				WHERE
					ORD_ORDACTDES.ESTADO = '" . ACTIVO_ESTADO . "'
				AND ORD_ELEMENTO.ESTADO = '" . ACTIVO_ESTADO . "'
				AND ORD_ORDACTDES.ID_ORDEN = '$idOrder'
				ORDER BY
					ORD_ELEMENTO.ID ASC
		";

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function getListElementOfProductOrderValidation($idOrder)
	{
		/**
		 * Listo los elemento o servicios de acuerdo al valor del arbol $idArbol
		 */
		$sql = "
			SELECT 
				MAX(ORD_ORDACTDES.ID) as 'ID'
				FROM ORD_ORDACTDES
				WHERE ORD_ORDACTDES.ID_ORDEN = '$idOrder'
				
		";

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectListCharacteristicsElementGroup($grupo)
	{
		/**
		 * Listo las caracteristicas que debe tener el grupo
		 */
		$sql = "select ORD_PARELEM.ID, 
				ORD_PARELEM.NOMBRE, 
				ORD_PARGRUELEM.ID AS ID_PARGRUELEM
				 from ORD_PARELEM, ORD_PARGRUELEM " . "where ORD_PARELEM.ID=ORD_PARGRUELEM.ID_PARELEM
				 and ORD_PARGRUELEM.ID_GRUELEM='$grupo'
				 and ORD_PARGRUELEM.ESTADO='" . ACTIVO_ESTADO . "'
				 and ORD_PARELEM.ESTADO='" . ACTIVO_ESTADO . "'		" . "order by  ORD_PARELEM.ID";
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectListProvidersElementsFromGroups($grupo)
	{
		/**
		 * Listo las caracteristicas que debe tener el grupo
		 */
		$sql = "select DISTINCT ORD_PROVEEDOR.ID, ORD_PROVEEDOR.NOMBRE
				 from ORD_PROVEEDOR, ORD_ELEMENTO " . "where ORD_ELEMENTO.ID_GRUELEM='$grupo'
					 and ORD_ELEMENTO.ESTADO='" . ACTIVO_ESTADO . "'
				 and ORD_ELEMENTO.ID_PROVEEDOR=ORD_PROVEEDOR.ID	" . "order by  ORD_PROVEEDOR.ID";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
	public function selectListElementsFromConditions($group, $provider, $valor, $elementos)
	{
		/**
		 * Listo las caracteristicas que debe tener el grupo
		 */
		if ($valor == null) {
			$sql = "select DISTINCT ORD_ELEMENTO.ID, ORD_ELEMENTO.NOMBRE,ORD_ELEMENTO.CODIGO
			from  ORD_ELEMENTO
			where ORD_ELEMENTO.ID_GRUELEM='$group'
			and ORD_ELEMENTO.ESTADO='" . ACTIVO_ESTADO . "'
			and ORD_ELEMENTO.ID_PROVEEDOR='$provider'";
			// echo $sql;
			$result = $this->db->query($sql);
			if ($result->num_rows() > 0) {
				return $result->result();
			} else {
				return null;
			}
		} else {
			// Navego dentro de las caracteristicas
			if (count($elementos) > 0) {
				$tempo = '';
				foreach ($elementos as $idElemento) {
					$tempo .= $idElemento->ID . ",";
				}
				$tempo = substr($tempo, 0, -1);
				$sql = " select DISTINCT ORD_ELEMENTO.ID, ORD_ELEMENTO.NOMBRE,ORD_ELEMENTO.CODIGO " . " from ORD_ELEPARELEM, ORD_ELEMENTO" . " where ORD_ELEPARELEM.ID_VALPARGRUELEM='$valor' " . " and ORD_ELEPARELEM.ID_ELEMENTO in($tempo) " . " and ORD_ELEPARELEM.ESTADO='" . ACTIVO_ESTADO . "' " . " and ORD_ELEMENTO.ID = ORD_ELEPARELEM.ID_ELEMENTO";
				// echo $sql;
				$result = $this->db->query($sql);
				if ($result->num_rows() > 0) {
					return $result->result();
				} else {
					return null;
				}
			}
		}
	}

	public function selectOrderStateQuantity($idOrden, $opcion)
	{
		/** Selecciono la cantidad de ordenes que se han realizado*/
		if ($opcion == 1) {
			$sql = "select COUNT(*) as CANTIDAD
			from ORD_TORDPROEST, ORD_ESTADOS,ORD_ORDEN
			where ORD_ORDEN.ID='$idOrden'
			and ORD_ORDEN.ID_TORDPRO= ORD_TORDPROEST.ID_TORDPRO
			and ORD_TORDPROEST.ID_ESTADO=ORD_ESTADOS.ID
			and ORD_TORDPROEST.ESTADO='" . ACTIVO_ESTADO . "'
				 and ORD_ESTADOS.ID  not in('" . STATE_CANCEL . "','" . STATE_SUSPEND . "')
				 and ORD_ESTADOS.ESTADO='" . ACTIVO_ESTADO . "'";
		} else {
			$sql = "select COUNT(*) as CANTIDAD 
					from ORD_ORDACTEST 
					where ORD_ORDACTEST.ID_ORDEN='$idOrden'
			 and ORD_ORDACTEST.MOMENTO='" . CLOSE_STATE . "'
			 and ORD_ORDACTEST.CONTADOR=1";
		}
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$dato = $result->result();
		} else {
			$dato = null;
		}
		if ($dato != null) {
			foreach ($dato as $value) {
				return $value->CANTIDAD;
			}
		} else {
			return null;
		}
	}

	public function selectListPeopleFromOrder($idOrden)
	{
		/** Selecciono el listado de profesionales involucrados dentro del proceso de atenci�n*/

		$sql = "SELECT distinct
				ORD_ESTADOS.ID,
				ADM_USUARIO.NOMBRES ,
				    ADM_USUARIO.APELLIDOS ,
				ADM_PERFIL.NOMBRE AS PERFIL,
				ORD_ESTADOS.NOMBRE AS ESTADO
				
				FROM
				ADM_USUARIO ,
				ADM_ROLPERFIL,
				ADM_PERFIL,
				ADM_USUROLPER,
				ORD_ORDACTEST,
				ORD_ORDENEQUIPO,
				ORD_ESTADOS,
				ORD_TORDPROEST
				where ADM_ROLPERFIL.ID_PERFIL = ADM_PERFIL.ID
				and ADM_USUROLPER.ID_ROLPERFIL = ADM_ROLPERFIL.ID 
				AND ADM_USUROLPER.ID_USUARIO = ADM_USUARIO.ID
				and ORD_ORDENEQUIPO.ID_USUARIO = ADM_USUARIO.ID
				and ORD_ORDACTEST.ID_ORDEN='$idOrden'
				and ORD_ORDACTEST.UCREA =ADM_USUARIO.ID
				and ORD_ORDACTEST.MOMENTO !='A'
				and ORD_TORDPROEST.ID=ORD_ORDENEQUIPO.ID_TORDPROEST
				and ORD_ORDACTEST.ID_TORDPROEST=ORD_TORDPROEST.ID
				and ORD_TORDPROEST.ID_ESTADO=ORD_ESTADOS.ID
				and ORD_ORDENEQUIPO.ESTADO='" . ACTIVO_ESTADO . "'
				ORDER BY ORD_ESTADOS.ID
				";

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectHistoryOrder($idOrden)
	{
		/** Selecciono el listado de profesionales involucrados dentro del proceso de atenci�n*/

		$sql = "SELECT
					ORD_OBSESTADO.NOMBRE as TIPO_OBSERVACION,
					ORD_ORDACTESTOBS.OBSERVACION AS OBSERVACION,
					ORD_ORDACTESTOBS.UCREA AS USUARIO,
					ORD_ORDACTESTOBS.ID AS ID,
					ADM_USUARIO.NOMBRES AS NOMBRES,
					ADM_USUARIO.APELLIDOS AS APELLIDOS,
					ADM_PERFIL.NOMBRE AS PERFIL,
					ORD_ORDACTEST.ID_ORDEN AS ID_ORDEN,
					ORD_ESTADOS.NOMBRE AS ESTADO,
					ORD_ORDACTEST.FCREA AS INICIO,
					ORD_ORDACTEST.FMOD AS FIN,
					ORD_ESTADOS.ICONO AS ICONO,
					ORD_ORDACTESTOBS.FCREA AS FOBS,
					ORD_ORDACTESTOBS.ADJUNTO,
					ORD_ESTADOS.ID AS ID_ESTADO,
					ORD_ORDACTESTOBS.ID AS ID_OBSERVACION
			 FROM
					ORD_ORDACTESTOBS,
					ORD_OBSESTADO,
					ADM_USUROLPER,
					ADM_USUARIO,
					ADM_ROLPERFIL,
					ADM_PERFIL,
					ORD_ORDACTEST,	
					ORD_TORDPROEST,
					ORD_ESTADOS
			WHERE	
					ORD_ORDACTESTOBS.ID_ORDACTEST = ORD_ORDACTEST.ID
					AND ORD_ORDACTESTOBS.ID_OBSESTADO = ORD_OBSESTADO.ID 
					AND ADM_USUROLPER.ID_USUARIO = ADM_USUARIO.ID
					AND ADM_USUROLPER.ID_ROLPERFIL = ADM_ROLPERFIL.ID
					AND ADM_ROLPERFIL.ID_PERFIL = ADM_PERFIL.ID
					AND ORD_ORDACTESTOBS.ID_ORDACTEST = ORD_ORDACTEST.ID
					AND ORD_ORDACTEST.ID_TORDPROEST = ORD_TORDPROEST.ID 
					AND ORD_ORDACTEST.ID_TORDPROEST = ORD_TORDPROEST.ID
					AND ORD_OBSESTADO.ID_ESTADO = ORD_ESTADOS.ID 
					AND ORD_TORDPROEST.ID_ESTADO = ORD_ESTADOS.ID
					AND ORD_ORDACTESTOBS.UCREA = ADM_USUARIO.ID 
					AND ORD_ORDACTEST.ID_ORDEN = '$idOrden' 
					AND ORD_ORDACTESTOBS.ESTADO = '" . ACTIVO_ESTADO . "'";

		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectHistoryOrderFull($idOrden)
	{
		/** Selecciono el listado de profesionales involucrados dentro del proceso de atenci�n*/

		$sql = "SELECT
					*
			 FROM
					ORD_HISTORY_ORDEN
			WHERE	
					ORD_HISTORY_ORDEN.ID_ORDEN = '$idOrden' 
					AND ORD_HISTORY_ORDEN.ESTADO_OBS = '" . ACTIVO_ESTADO . "'
			order by ORD_HISTORY_ORDEN.FOBS asc";
		//echo $sql;
		echo "<script>console.log('Console: " . $sql . "' );</script>";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectActualStateFromOrden($idOrden, $usuario)
	{
		/** Selecciono los estados actuales para la orden $idOrden*/

		$sql = "select ORD_ESTADOS.NOMBRE,
					ORD_ORDACTEST.ID_TORDPROEST,
					ORD_ORDACTEST.ID ,
					ORD_ESTADOS.ID as ID_ESTADO,
					ORD_ORDACTEST.MOMENTO
			from ORD_ORDACTEST, 
				ORD_ESTADOS,
				ORD_TORDPROEST, 
				ORD_ORDEN,
				ORD_TORDPROESTPER,
				ADM_USUROLPER,
				ADM_ROLPERFIL
			where ORD_ORDACTEST.ID_ORDEN='$idOrden' 
			and ORD_ORDACTEST.ID_ORDEN=ORD_ORDEN.ID 
			and ORD_ORDEN.ID_TORDPRO=ORD_TORDPROEST.ID_TORDPRO 
			and ORD_TORDPROEST.ID=ORD_ORDACTEST.ID_TORDPROEST 
			and ORD_ORDACTEST.MOMENTO='" . OPEN_STATE . "' 
			and ORD_TORDPROEST.ID_ESTADO=ORD_ESTADOS.ID 
			and ORD_TORDPROEST.ID=ORD_TORDPROESTPER.ID_TORDPROEST 
			and	ADM_ROLPERFIL.ID_PERFIL=ORD_TORDPROESTPER.ID_PERFIL
			and ADM_ROLPERFIL.ID=ADM_USUROLPER.ID_ROLPERFIL
			and ADM_USUROLPER.ID_USUARIO='$usuario'
			and ADM_USUROLPER.ESTADO='" . ACTIVO_ESTADO . "'
			and ADM_ROLPERFIL.ESTADO='" . ACTIVO_ESTADO . "'
			and ORD_TORDPROESTPER.ESTADO='" . ACTIVO_ESTADO . "'
			and ORD_TORDPROESTPER.PERMISO='20'
			AND ORD_TORDPROEST.ESTADO = '" . ACTIVO_ESTADO . "'
			AND ORD_ORDACTEST.ESTADO = '" . ACTIVO_ESTADO . "'
			AND ORD_ESTADOS.ESTADO = '" . ACTIVO_ESTADO . "'
			order by ORD_ESTADOS.NOMBRE";/*
		$sql = "SELECT
				ORD_ESTADOS.NOMBRE,
				ORD_RELESTADO.ID_INICIO,
				ORD_RELESTADO.ID_FIN,
				ORD_RELESTADO.ORDEN,
				ORD_TORDPROEST.ID_ESTADO,
				ORD_ESTADOS.ID,
				ORD_RELESTADO.ID_FIN,
				ORD_TORDPROEST.ID
			FROM
				ORD_RELESTADO,
				ORD_TORDPROEST,
				ORD_ESTADOS
			WHERE
				ORD_RELESTADO.ID_INICIO = (
					SELECT
						TOP 1 ID_TORDPROEST
					FROM
						ORD_ORDACTEST
					WHERE
						ID_ORDEN = $idOrden
					ORDER BY
						ID DESC
				)
			AND ORD_RELESTADO.ORDEN = 1
			AND ORD_RELESTADO.ESTADO = 'S'
			AND ORD_TORDPROEST.ID_ESTADO = ORD_ESTADOS.ID
			AND ORD_RELESTADO.ID_FIN = ORD_TORDPROEST.ID";*/

		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectActualStateFromOrdenFromSuspend($idOrden, $usuario)
	{
		/** Selecciono los estados actuales para la orden $idOrden*/

		$sql = "select ORD_ESTADOS.NOMBRE,
		ORD_ORDACTEST.ID_TORDPROEST,
		ORD_ORDACTEST.ID ,
		ORD_ESTADOS.ID as ID_ESTADO,
		ORD_ORDACTEST.MOMENTO
		from ORD_ORDACTEST,
		ORD_ESTADOS,
		ORD_TORDPROEST,
		ORD_ORDEN,
		ORD_TORDPROESTPER,
		ADM_USUROLPER,
		ADM_ROLPERFIL
		where ORD_ORDACTEST.ID_ORDEN='$idOrden'
		and ORD_ORDACTEST.ID_ORDEN=ORD_ORDEN.ID
		and ORD_ORDEN.ID_TORDPRO=ORD_TORDPROEST.ID_TORDPRO
		and ORD_TORDPROEST.ID=ORD_ORDACTEST.ID_TORDPROEST
		and ORD_ORDACTEST.MOMENTO='" . SUSPEND_STATE . "'
		and ORD_ESTADOS.ID='" . STATE_SUSPEND . "'
		and ORD_TORDPROEST.ID_ESTADO=ORD_ESTADOS.ID
		and ORD_TORDPROEST.ID=ORD_TORDPROESTPER.ID_TORDPROEST
		and	ADM_ROLPERFIL.ID_PERFIL=ORD_TORDPROESTPER.ID_PERFIL
		and ADM_ROLPERFIL.ID=ADM_USUROLPER.ID_ROLPERFIL
		and ADM_USUROLPER.ID_USUARIO='$usuario'
		and ADM_USUROLPER.ESTADO='" . ACTIVO_ESTADO . "'
		and ADM_ROLPERFIL.ESTADO='" . ACTIVO_ESTADO . "'
		and ORD_TORDPROESTPER.ESTADO='" . ACTIVO_ESTADO . "'
		and ORD_TORDPROESTPER.PERMISO='20'
		AND ORD_TORDPROEST.ESTADO = '" . ACTIVO_ESTADO . "'
		AND ORD_ORDACTEST.ESTADO = '" . ACTIVO_ESTADO . "'
		AND ORD_ESTADOS.ESTADO = '" . ACTIVO_ESTADO . "'
		order by ORD_ESTADOS.NOMBRE";

		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectObservationListFromState($idState)
	{
		/** Selecciono las observaciones relacionas al estado $idState*/

		$sql = "SELECT
					ORD_OBSESTADO.ID,
					ORD_OBSESTADO.ID_ESTADO,
					ORD_OBSESTADO.MOTIVO,
					ORD_OBSESTADO.CIERRA,
					ORD_OBSESTADO.NOMBRE
			   FROM
				ORD_OBSESTADO
			where ORD_OBSESTADO.ID_ESTADO='$idState'
			and ORD_OBSESTADO.ESTADO='" . ACTIVO_ESTADO . "'
			and ORD_OBSESTADO.ID !='" . SUSPEND_OBSERVATION . "'";

		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function getStateRelatationFromOrderState($idOrden, $estado)
	{
		/**
		 * Obtengo la relaci�n del estado actual $estado y la orden $idOrden
		 */
		$sql = "SELECT
					ORD_ORDACTEST.ID,
					ORD_TORDPROEST.ID AS ID_TORDPROEST
				FROM
					ORD_ORDACTEST, 
					ORD_TORDPROEST,
					ORD_ESTADOS 
								
				WHERE ORD_ORDACTEST.ID_ORDEN = '$idOrden'
				and ORD_ORDACTEST.MOMENTO in('" . OPEN_STATE . "','" . SUSPEND_STATE . "')
				and ORD_ORDACTEST.ID_TORDPROEST = ORD_TORDPROEST.ID
				and ORD_TORDPROEST.ID_ESTADO = ORD_ESTADOS.ID 
				AND ORD_ESTADOS.ID = '$estado'";
		// ejecuto la consulta
		// echo $sql."<br>";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$resultado = $result->row();

			return $resultado;
		}
		//return $sql;
	}

	public function selectEstadosReprocesos($estado)
	{
		/**
		 * Obtengo la relaci�n del estado actual $estado y la orden $idOrden
		 */
		$sql = "SELECT
					ORD_ESTADOS.NOMBRE,
					ORD_TORDPROEST.ID
					
					FROM
					ORD_RELESTADO ,
					ORD_ESTADOS ,
					ORD_TORDPRO,
					ORD_TORDPROEST 
					where ORD_TORDPROEST.ID_ESTADO = ORD_ESTADOS.ID 
					AND ORD_TORDPROEST.ID_TORDPRO = ORD_TORDPRO.ID 
					AND ORD_RELESTADO.ID_INICIO = ORD_TORDPROEST.ID
					AND ORD_ESTADOS.ID = '$estado'";
		// ejecuto la consulta
		// echo $sql."<br>";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$resultado = $result->row();

			return $resultado;
		}
	}

	public function selectListadoObservacionesEstados()
	{
		/**
		 * Listado de observaciones por estado
		 */
		$sql = "SELECT ORD_OBSESTADO.ID AS ID,
					ORD_OBSESTADO.NOMBRE as NOMBRE,
					ORD_ESTADOS.NOMBRE as NOM_ESTADO,
					ORD_ESTADOS.ICONO as ICONO,
					ORD_OBSESTADO.ESTADO AS ESTADO
				FROM
					ORD_OBSESTADO, ORD_ESTADOS 
				WHERE  ORD_OBSESTADO.ID_ESTADO = ORD_ESTADOS.ID";
		// ejecuto la consulta
		//echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}


	public function selectElementsFromGroupToOrder($grupo)
	{
		/**
		 * Seleccciona los registros que se encuentran definidos dentro de la tabla ORD_ELEMENTO
		 */
		$sql = "select ORD_ELEMENTO.ID as ID,
					 ORD_ELEMENTO.CODIGO as CODIGO,
					 ORD_GRUELEM.NOMBRE as GRUPO,
					 ORD_ELEMENTO.NOMBRE as NOMBRE,
					 
					 ORD_ELEMENTO.ESTADO as ESTADO
		from ORD_ELEMENTO, ORD_GRUELEM
		where ORD_ELEMENTO.ID_GRUELEM=ORD_GRUELEM.ID
        AND ORD_GRUELEM.ID='$grupo'
        and ORD_ELEMENTO.ESTADO ='" . ACTIVO_ESTADO . "'
        and ORD_ELEMENTO.COMODIN !='1'
		order by  ORD_ELEMENTO.NOMBRE ASC, ORD_GRUELEM.NOMBRE ASC";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectStatesFromProcessKind($usuario, $proceso, $tipo, $condition)
	{
		/**
		 * Seleccciona los diferentes estados de acuerdo al proceso y tipo recepcionado, al igual que la condici�n definida en $condition
		 */
		$sql = "SELECT
                    ORD_TORDPROEST.ID,
                    ORD_ESTADOS.NOMBRE
                    
                    FROM
                        ORD_PROCESO ,
                        ORD_TIPOORDEN, 
                        ORD_TORDPRO ,
                        ORD_TORDPROEST, 
                        ORD_ESTADOS, 
                        ORD_TORDPROESTPER,
                        ADM_ROLPERFIL,
                        ADM_PERFIL,
                        ADM_USUROLPER,
                        ADM_USUARIO
                    where ORD_TORDPRO.ID_PROCESO = ORD_PROCESO.ID 
                    AND ORD_TORDPRO.ID_TIPOORDEN = ORD_TIPOORDEN.ID
                    and ORD_TORDPROEST.ID_TORDPRO = ORD_TORDPRO.ID
                    and ORD_TORDPROEST.ID_ESTADO = ORD_ESTADOS.ID
                    and ORD_TORDPROESTPER.ID_TORDPROEST = ORD_TORDPROEST.ID
                    and  ORD_PROCESO.ID='$proceso'
                    and  ORD_TIPOORDEN.ID='$tipo'
                    AND ORD_TORDPROESTPER.ID_PERFIL = ADM_PERFIL.ID 
                    AND ADM_ROLPERFIL.ID_PERFIL = ADM_PERFIL.ID
                    AND ADM_USUROLPER.ID_ROLPERFIL = ADM_ROLPERFIL.ID
                    AND ADM_USUROLPER.ID_USUARIO =ADM_USUARIO.ID
                    AND ADM_USUARIO.ID='$usuario'
                    $condition";
		// ejecuto la consulta
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}

	public function selectOrdersFromState($estado)
	{
		/**
		 * Seleccciona los diferentes estados de acuerdo al proceso y tipo recepcionado, al igual que la condici�n definida en $condition
		 */
		$sql = "   SELECT
                    ORD_ORDEN.CONS,
                    ORD_ORDEN.ACTIVIDAD,
                    ORD_ENCORDEN.HISTORIA,
                    ORD_TIPOORDEN.PREFIJO,
                    ORD_ORDEN.ID AS ID
                    
                    FROM
                    ORD_ORDACTEST, ORD_ORDEN , ORD_TORDPROEST, ORD_TORDPRO, ORD_ENCORDEN, ORD_TIPOORDEN
                    where ORD_ORDACTEST.ID_ORDEN = ORD_ORDEN.ID
                    and ORD_ORDACTEST.ID_TORDPROEST = ORD_TORDPROEST.ID
                    AND ORD_ORDEN.ID_TORDPRO = ORD_TORDPRO.ID 
                    AND ORD_TORDPROEST.ID_TORDPRO = ORD_TORDPRO.ID
                    and ORD_ORDEN.ID_ENCORDEN = ORD_ENCORDEN.ID
                    and ORD_ORDACTEST.MOMENTO='" . OPEN_STATE . "'
                    AND ORD_TORDPROEST.ID='$estado'
                    and ORD_ORDACTEST.ESTADO='" . ACTIVO_ESTADO . "'
                    and ORD_ORDEN.ESTADO='" . ACTIVO_ESTADO . "'
                    and ORD_TORDPROEST.ESTADO='" . ACTIVO_ESTADO . "'
                    and ORD_TORDPRO.ESTADO='" . ACTIVO_ESTADO . "'
                    and ORD_ENCORDEN.ESTADO='" . ACTIVO_ESTADO . "'
                    AND ORD_TORDPRO.ID_TIPOORDEN= ORD_TIPOORDEN.ID
";
		// ejecuto la consulta
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}


	public function selectQuantityOrderByProcess($opcion = null)
	{
		/**
		 * Selecciona la cantidad de �rdenes teniendo en cuenta la condici�n dada
		 */
		if ($opcion == null) {
			$sql = "  SELECT *
                    FROM ORD_PROCESO
                    WHERE  ORD_PROCESO.ESTADO!='" . INACTIVO_ESTADO . "'
                ORDER BY ORD_PROCESO.ID";
			// ejecuto la consulta
			// echo $sql;
			$result = $this->db->query($sql);
			if ($result->num_rows() > 0) {
				return $result->result();
			} else {
				return null;
			}
		} else {
			$sql = "  SELECT count(*) AS CANTIDAD
                    FROM ORD_PROCESO, ORD_TORDPRO, ORD_ORDEN
                    WHERE  ORD_PROCESO.ESTADO!='" . INACTIVO_ESTADO . "'
                    AND  ORD_TORDPRO.ESTADO!='" . INACTIVO_ESTADO . "'
                    AND ORD_ORDEN.ESTADO='" . ACTIVO_ESTADO . "'
                    AND ORD_PROCESO.ID=ORD_TORDPRO.ID_PROCESO
                    AND ORD_TORDPRO.ID=ORD_ORDEN.ID_TORDPRO
                    AND ORD_PROCESO.ID='$opcion'
                ";
			// ejecuto la consulta
			// echo $sql;
			$result = $this->db->query($sql);
			if ($result->num_rows() > 0) {
				return $result->result();
			} else {
				return null;
			}
		}
	}

	public function selectQuantityOrderByTipo($tipo)
	{
		/**
		 * Selecciona la cantidad de �rdenes teniendo en cuenta la condici�n dada
		 */
		$sql = "  SELECT count(*) AS CANTIDAD
                    FROM ORD_PROCESO, ORD_TORDPRO, ORD_ORDEN
                    WHERE  ORD_PROCESO.ESTADO!='" . INACTIVO_ESTADO . "'
                    AND  ORD_TORDPRO.ESTADO!='" . INACTIVO_ESTADO . "'
                    AND ORD_ORDEN.ESTADO='" . ACTIVO_ESTADO . "'
                    AND ORD_PROCESO.ID=ORD_TORDPRO.ID_PROCESO
                    AND ORD_TORDPRO.ID=ORD_ORDEN.ID_TORDPRO
                    AND ORD_TORDPRO.ID_TIPOORDEN='$tipo'
                ";
		// ejecuto la consulta
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$tempo = $result->result();
		} else {
			$tempo = null;
		}

		$return = 0;
		if ($tempo != null) {
			foreach ($tempo as $value) {
				$return = $value->CANTIDAD;
			}
		}
		return $return;
	}

	public function selectQuantityOrderByTipoFullDateCondition($tipo, $inicio, $fin)
	{
		/**
		 * Selecciona la cantidad de �rdenes teniendo en cuenta la condici�n dada
		 */
		$sql = "  SELECT count(*) AS CANTIDAD
                    FROM ORD_PROCESO, ORD_TORDPRO, ORD_ORDEN
                    WHERE  ORD_PROCESO.ESTADO!='" . INACTIVO_ESTADO . "'
                    AND  ORD_TORDPRO.ESTADO!='" . INACTIVO_ESTADO . "'
                    AND ORD_PROCESO.ID=ORD_TORDPRO.ID_PROCESO
                    AND ORD_TORDPRO.ID=ORD_ORDEN.ID_TORDPRO
                    AND ORD_TORDPRO.ID_TIPOORDEN='$tipo'
                    and ORD_ORDEN.FCREA BETWEEN '$inicio' and '$fin'

                ";
		// ejecuto la consulta
		// echo $sql."<br>";
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			$tempo = $result->result();
		} else {
			$tempo = null;
		}

		$return = 0;
		if ($tempo != null) {
			foreach ($tempo as $value) {
				$return = $value->CANTIDAD;
			}
		}
		return $return;
	}

	public function selectProfileListFromState($idRelation)
	{
		/**
		 * Seleccciona los perfiles a los que se les debe enviar Correo
		 */
		$sql = "select ORD_TORDPROESTPER.ID_PERFIL
		from ORD_TORDPROESTPER
		where ORD_TORDPROESTPER.ID_TORDPROEST='$idRelation'
        AND ORD_TORDPROESTPER.CORREO='" . CTE_VALOR_SI . "'
        and ORD_TORDPROESTPER.ESTADO ='" . ACTIVO_ESTADO . "'";
		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}


	public function selectListOrdersFromStokePrice($idCotizacion, $condicion = NULL)
	{
		/**
		 * Selecciona las ordenes asociadas a una cotizaci�n
		 */


		$sql = "select ORD_ORDEN.ID
        from ORD_ORDEN
        where ORD_ORDEN.ID_COTIZACION= $idCotizacion
        " . $condicion . "
        and ORD_ORDEN.ESTADO not in('" . INACTIVO_ESTADO . "','" . CERRADO_ESTADO . "')";

		// echo $sql;
		$result = $this->db->query($sql);
		if ($result->num_rows() > 0) {
			return $result->result();
		} else {
			return null;
		}
	}
}
