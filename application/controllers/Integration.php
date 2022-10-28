<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						COntrolador de las integraciones de las consultas de los datos de la aplicaci�n. 
 Por lo general la integraci�n de las funcionalidades del presente controlador se encuentran
 dadas a trav�s de la solicitud de informaci�n v�a JQuery
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');
class Integration extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	/************************************************************************************************************************************/
	/** ---------------------------------------- Administration Integration ------------------------------------------------------------------- */


	public function reloadCity($departamento = null)
	{
		/**
		 * Recargo las ciudades teniendo en cuenta el valor del departamento, que es recibido por el post
		 */
		// if ($this->FunctionsAdmin->validateSession ($this->defineMainPage)) {
		if ($departamento == null) {
			if ($this->input->post('departamento')) {
				$departamento = $this->input->post('departamento');
				$tipoUbicacion = $this->FunctionsAdmin->selectMunicipiosFromDepartamento($departamento);
				echo "<option value=\"\"></option>";
				foreach ($tipoUbicacion as $fila) {
					echo "<option value=\"" . $fila->ID . "\">" . $fila->NOMBRE . "</option>";
				}
			}
		} else {
			$return = '';
			$tipoUbicacion = $this->FunctionsAdmin->selectMunicipiosFromDepartamento($departamento);
			$return .= "<option value=\"\"></option>";
			foreach ($tipoUbicacion as $fila) {
				$return .= "<option value=\"" . $fila->ID . "\">" . $fila->NOMBRE . "</option>";
			}
			return $return;
		}

		/*
		 * }else{
		 * //Retorno a la p�gina principal
		 * header("Location: ". base_url());
		 * }
		 */
	}

	public function loadedComboCity()
	{

		$usuario = 'sa';
		$pass = 'cirec2020..';
		$servidor = 'LAPTOPCIREC1055\SQLEXPRESS';
		$basedatos = 'produccion';
		$info = array('Database' => $basedatos, 'UID' => $usuario, 'PWD' => $pass);
		$conn = sqlsrv_connect($servidor, $info);


		$salida = "";

		$elegido = $this->input->post('elegido');

		$sql1 = "SELECT *  FROM  ADM_MUNICIPIO WHERE ID_DEPARTAMENTO = '$elegido'";
		$stmt1 = sqlsrv_query($conn, $sql1);


		// construimos el combo de ciudades deacuerdo al pais seleccionado
		while ($arr = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC)) {
			$salida .= "<option value='" . $sql_p['ID'] . "'>" . $sql_p['NOMBRE'] . "</option>";
		}
		return $salida;
	}






	public function reloadDocumentType()
	{
		/**
		 * Selecciono los tipos de identificaci�n, teniendo en cuenta la variable post tipoPersona
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('tipoPersona')) {
				$tipoPersona = $this->input->post('tipoPersona');
				if ($tipoPersona == 80) {
					$id = 5;
				} else {
					$id = 6;
				}
				$tipoUbicacion = $this->FunctionsAdmin->selectTipoDocumento($id);

				echo "<option value=\"\"></option>";
				foreach ($tipoUbicacion as $fila) {
					echo "<option value=\"" . $fila->ID . "\">" . $fila->NOMBRE . "</option>";
				}
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function reloadList()
	{
		/**
		 * Recargo los usuarios que se tienen en cuenta dentro del proceso
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('nombre')) {
				$nombre = strtoupper($this->input->post('nombre'));
				echo $this->FunctionsGeneral->getQuantityFieldFromTable("ADM_ENCLISTA", "NOMBRE", $nombre);
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function reloadProfile()
	{
		/**
		 * Recargo los perfiles definidos dentro de la aplicaci�n
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('nombre')) {
				$nombre = strtoupper($this->input->post('nombre'));
				echo $this->FunctionsGeneral->getQuantityFieldFromTable("ADM_PERFIL", "NOMBRE", $nombre);
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function reloadCodeUser()
	{
		/**
		 * Recargo los c�digos de los usuarios para validar si existeno o no dentro del listado de usuarios
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('codigo')) {
				$codigo = $this->input->post('codigo');
				echo $this->FunctionsGeneral->getQuantityFieldFromTable("ADM_USUARIO", "ID", $codigo);
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function reloadEmailUser()
	{
		/**
		 * Recargo los correos de los usuarios para validar si existeno o no dentro del listado de usuarios
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('correo')) {
				$codigo = strtolower($this->input->post('correo'));
				echo $this->FunctionsGeneral->getQuantityFieldFromTable("ADM_USUARIO", "CORREO", $codigo);
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function reloadUserPage()
	{
		/**
		 * Recargo las p�ginas para los usuarios
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('pagina')) {
				$pagina = $this->input->post('pagina');
				echo $this->FunctionsGeneral->getQuantityFieldFromTable("ADM_MODULO", "PAGINA", $pagina);
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}


	/************************************************************************************************************************************/
	/** ---------------------------------------- Orders Integration ------------------------------------------------------------------- */

	public function reloadCharacteristics()
	{
		/**
		 * Recargo las caracteristicas que no han sido seleccionadas para el grupo
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('grupo')) {
				$grupo = $this->input->post('grupo');
				$caracteristicas = $this->FunctionsGeneral->selectValoresListaTabla("ORD_PARELEM", 'DESC');
				echo "<option value=\"\"></option>";
				foreach ($caracteristicas->result() as $fila) {
					if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_PARGRUELEM", "ID_GRUELEM", $grupo, "ID_PARELEM", $fila->ID) == 0) {
						echo "<option value=\"" . $fila->ID . "\">" . $fila->NOMBRE . "</option>";
					}
				}
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}
	public function reloadStatesConfiguration()
	{
		/**
		 * Recargo los estados que no es encuentran configurados dentro de la relaci�n de Proceso, Tipo de orden y estados
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('proceso') != '' && $this->input->post('tipo') != '') {
				$proceso = $this->input->post('proceso');
				$tipo = $this->input->post('tipo');
				/* Busco la relaci�n entre el tipo de orden y el proceso */
				$tordPro = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_TORDPRO", "ID", "ID_PROCESO", $proceso, "ID_TIPOORDEN", $tipo);
				$estados = $this->FunctionsGeneral->selectValoresListaTabla("ORD_ESTADOS", 'ASC');
				echo "<option value=\"\"></option>";
				foreach ($estados->result() as $fila) {
					if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_TORDPROEST", "ID_TORDPRO", $tordPro, "ID_ESTADO", $fila->ID) == 0) {
						echo "<option value=\"" . $fila->ID . "\">" . $fila->NOMBRE . "</option>";
					}
				}
				// echo "proceso: ".$proceso." Tipo de orden: ".$tipo." Relaci�n: ".$tordPro;
			} else {
				echo "error";
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}
	public function reloadBodyPartsSection()
	{
		/**
		 * Recargo las partes del cuerpo de acuerdo a los valores de $miembros y $tipo
		 */
		$this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a �rdenes
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {

			if ($this->input->post('miembros') != '' && $this->input->post('tipo') != '') {
				$miembros = $this->input->post('miembros');
				$tipo = $this->input->post('tipo');
				// Obtengo id de la relaci�n entre miembros y tipo en la tabla ORD_TIPOMIEM
				$idTipoMiem = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_TIPOMIEM", "ID", "ID_TIPOORDEN", $tipo, "ID_MIEMBROS", $miembros);

				// Identifico en donde debo buscar de acuerdo al tipo de orden
				if ($this->FunctionsGeneral->getFieldFromTable("ORD_TIPOORDEN", "ID_VALIDA", $tipo) == 1) {
					// Productos
					$tabla = "ORD_NAMPTMIEM";
					$campo = "ID_NIVELAMP";
					/* Busco la relaci�n entre el tipo de orden y el proceso */
					$ubicacion = $this->OrdersModel->selectBodyPartsSection($miembros);
				} else {
					// Servicios
					$tabla = "ORD_NIVSERTIPORD";
					$campo = "ID_NIVSERVICIO";
					/* Busco la relaci�n entre el tipo de orden y el proceso */
					$ubicacion = $this->OrdersModel->selectLevelServices($miembros);
				}

				// Valor por defecto vacio
				echo "<option value=\"\"></option>";
				foreach ($ubicacion as $fila) {
					// Verifico que no exista el registro
					$cantidad = $this->FunctionsGeneral->getQuantityFieldFromTable($tabla, "ID_TIPOMIEM", $idTipoMiem, $campo, $fila->ID, "ESTADO", ACTIVO_ESTADO);
					if ($cantidad != 0) {
						$selected = "selected='selected'";
					} else {
						$selected = "";
					}
					echo "<option value=\"" . $fila->ID . "\" $selected>" . $fila->NOMBRE . "</option>";
				}
			} else {
				echo "error";
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}
	public function reloadCodeProduct()
	{
		/**
		 * Recargo los c�digos de los productos y/ servicios
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('codigo')) {
				$codigo = $this->input->post('codigo');
				echo $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "NOMBRE", "CODIGO", $codigo);
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}



	public function reloadTree()
	{
		/**
		 * Recargo el �rbol de los productos y/ servicios
		 */
		$this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a �rdenes

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			// Retorno el �rbol, adicionalmente retorno la p�gina en la cual se seguir� despu�s de la b�squeda

			if ($this->input->post('proceso') == CTE_VALOR_SI) {
				$proceso = $this->session->userdata('proceso');
			} else {
				$proceso = null;
			}
			echo $this->OrdersModel->selectTreeInformation($this->input->post('variable'), 0, 'nestable', $proceso);
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function reloadCodeInformation()
	{
		/**
		 * Recargo el �rbol de los productos y/ servicios
		 */
		$this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a �rdenes

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			// Retorno la informaci�n de acuerdo al c�digo ingresado busco la descripci�n del producto

			$codigo = $this->input->post('codigo');
			$claseTipo = $this->input->post('claseTipo');
			$tempoCodigo = $codigo;

			if ($this->input->post('opcion') == 0) {
				$codigo =  $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ARBOLCODIGO", "ID", "CODIGO", $codigo);
			}

			$nombre = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "NOMBRE", $codigo);
			if ($nombre != '') {
				$descripcion = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "DESCRIPCION", $codigo);
				if ($claseTipo == 1) {
					$listDespiece = $this->OrdersModel->selectElementProductoList($codigo);

					if ($listDespiece != null) {
						$despiece = "
	                        <h3 >Despiece del producto</h3>
	        		        <table id=\"myTable\" class=\"display nowrap table table-hover table-striped table-bordered\">
	        			         <thead>
	        			             <tr>
	        			                 <th>C&oacute;digo</th>
	        			                 <th>Comod&iacute;n</th>
	        			                 <th width=\"40%\">Nombre</th>
	        	                    
	        			                 <th>Cantidad</th>
	        			             </tr>
	                              </thead>
	        			          <tbody>
	                    ";
						foreach ($listDespiece as $value) {
							$despiece .= "<tr>
				                         <td>" . $value->CODIGO . "</td>
				                         <td align= \"center\">
				                             <span class=\"" . validaComodin($value->COMODIN, 'CLASE') . "\">" . validaComodin($value->COMODIN, 'NOMBRE') . "</span>
				                         </td>
				                         <td>" . $value->NOMBRE . "</td>
				                             
	                                     <td>" . $value->CANTIDAD . "</td>
				                    </tr>";
						}
						$despiece .= "</tbody>
				             </table>";
					} else {
						$despiece = "";
					}
				} else {
					$despiece = "";
				}
			} else {
				$nombre = $this->FunctionsGeneral->getFieldFromTable("ORD_ELEMENTO", "NOMBRE", $codigo);
				$descripcion = "Este item pertenece al listado de elementos. No hay descripci&oacute;n disponible";
				$despiece = "";
			}

			if ($this->input->post('opcion') == 0) {
				$empresa = $this->input->post('empresa');
				$tarifa = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFAEMPRESA", "ID_TARIFA", "ID", $empresa);

				//Obtengo ide temporal del c�digo asociado
				$tempoCodigo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID", "CODIGO", $tempoCodigo);



				$tipo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID_TIPO", "ID", $tempoCodigo);
				if ($tipo == '39') {
					$margen = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFA", "MARGEN_ELEMENTOS", "ID", $tarifa);
				} else if ($tipo == 40) {
					$margen = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFA", "MARGEN_PRODUCTOS", "ID", $tarifa);
				} else {
					$margen = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFA", "MARGEN_SERVICIOS", "ID", $tarifa);
				}
				$margen = $margen . " %";
				//Valido si es colombiano el producto

				$materiales = " $ " . numberFormatApp(defineValueElementsMaterials($this, $this->input->post('codigo')));

				$manoobra = " $ " . numberFormatApp($this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "MANOOBRA", "ID", $tempoCodigo));

				$adicionales = " $ " . numberFormatApp($this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ASOCIADOS", "ID", $tempoCodigo));


				//$adicionales= " $ ".numberFormatApp(defineValueElementsMaterials($this,$this->input->post ( 'codigo' ),'ASOCIADOS'));


			} else {
				$materiales = '';
				$manoobra = '';
				$adicionales = '';
				$empresa = '';
				$margen = '';
			}

			echo $nombre . "|" . $descripcion . "|" . $despiece . "|" . $materiales . "|" . $manoobra . "|" . $adicionales . "|" . $margen;
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}
	public function reloadElements()
	{
		/**
		 * Recargo las caracteristicas que no han sido seleccionadas para el grupo
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('grupo')) {
				$grupo = $this->input->post('grupo');
				$id = $this->FunctionsGeneral->getFieldFromTable("ORD_ARBOLCODIGO", "ID", $this->encryption->decrypt($this->input->post('id')));

				$elementos = $this->FunctionsGeneral->selectValoresListaTabla("ORD_ELEMENTO", 'DESC', ACTIVO_ESTADO, 'ID_GRUELEM', $grupo);
				// , $order= null,$estado=null,$campoBusqueda=NULL, $valor=null
				echo "<option value=\"\"></option>";
				foreach ($elementos->result() as $fila) {
					if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_DESPIECE", "ID_ARBOLCODIGO", $id, "ID_ELEMENTO", $fila->ID, "ESTADO", ACTIVO_ESTADO) == 0) {
						echo "<option value=\"" . $fila->ID . "\">" . $fila->CODIGO . " - " . $fila->NOMBRE . "</option>";
					}
				}
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}


	public function reloadCharacteristicsGroupElements()
	{
		/**
		 * Recargo las caracteristicas de los elementos de acuerdo al grupo
		 */
		$this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a �rdenes
		$return = '';
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('grupo')) {
				// Recibo el grupo
				$grupo = $this->input->post('grupo');
				$caracteristicas = $this->OrdersModel->selectListCharacteristicsElementGroup($grupo);
				$i = 0;
				if ($caracteristicas != null) {
					// Hay como m�nimo una caracteristica
					foreach ($caracteristicas as $value) {
						// Verifico el listado de valores por cada una de las caracteristicas
						$valoresCaracteristicas = $this->OrdersModel->getListValueGroupCharacteristics($value->ID_PARGRUELEM);
						$lista = "<option value=\"\"></option>";
						foreach ($valoresCaracteristicas as $valor) {
							$lista .= "<option value=\"" . $valor->ID . "\">" . $valor->VALOR . "</option>";
						}
						$return .= $value->NOMBRE . "&" . "ok" . "&" . $lista . "|";
						$i++;
					}
					echo $i . "!" . $return;
				} else {
					// NO hay caracteristica
					echo '0' . "!" . '0';
				}
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}
	public function reloadProviderListFromGroup()
	{
		/**
		 * Recargo las caracteristicas de los elementos de acuerdo al grupo
		 */
		$this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a �rdenes
		$return = '';
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('grupo')) {
				// Recibo el grupo
				$grupo = $this->input->post('grupo');
				$caracteristicas = $this->OrdersModel->selectListProvidersElementsFromGroups($grupo);
				$i = 0;
				if ($caracteristicas != null) {
					$lista = "<option value=\"\"></option>";
					foreach ($caracteristicas as $value) {
						// Verifico el listado de valores por cada una de las caracteristicas
						$lista .= "<option value=\"" . $value->ID . "\">" . $value->NOMBRE . "</option>";
					}
					echo $lista;
				} else {
					// NO hay caracteristica
					echo "<option value=\"\"></option>";
				}
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}
	public function reloadCharacteristicsGroupElementsDefineElement($grupo = null, $proveedor = null, $caracteristica = null)
	{
		/**
		 * Recargo las caracteristicas de los elementos de acuerdo al grupo
		 */
		$this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a �rdenes
		$return = '';
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('grupo')) {
				$grupo = $this->input->post('grupo');
			}
			if ($this->input->post('proveedor')) {
				$proveedor = $this->input->post('proveedor');
			}
			if ($this->input->post('caracteristica')) {
				$caracteristica = $this->input->post('caracteristica');
			}
			if ($grupo != null) {

				// $caracteristica =substr(str_replace("|", ",", $caracteristica),0,-1);
				$caracteristica = explode('A', $caracteristica);
				//print_r($caracteristica);
				// echo "<br>";
				// Elementos que cumplen con el proveedor

				//Verifico si el grupo tiene caracteristicas definidas
				if ($this->FunctionsGeneral->getQuantityFieldFromTable("ORD_PARGRUELEM", "ID_GRUELEM", $grupo, "ESTADO", ACTIVO_ESTADO) > 0) {
					if ($caracteristica[0] != '') {
						$elementos = $this->OrdersModel->selectListElementsFromConditions($grupo, $proveedor, null, null);
					} else {
						$elementos = null;
					}
				} else {
					$elementos = $this->OrdersModel->selectListElementsFromConditions($grupo, $proveedor, null, null);
				}


				// print_r($elementos);
				// echo "<br>";
				for ($i = 0; $i < count($caracteristica); $i++) {
					if ($caracteristica[$i] != '') {
						$elementos = $this->OrdersModel->selectListElementsFromConditions(null, null, $caracteristica[$i], $elementos);
						// echo "<br>";
						// print_r($elementos);
						// echo "<br>";
					}
				}
				$lista = "<option value=\"\"></option>";

				if ($elementos != null) {
					foreach ($elementos as $value) {
						$lista .= "<option value=\"" . $value->ID . "\">" . $value->CODIGO . " - " . $value->NOMBRE . "</option>";
					}
				}

				echo $lista;
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}

	public function reloadObservationKind()
	{
		/**
		 * Selecciono las observaciones que se han definido dentro de la aplicaci�n para el estado que se recibe dentro del post
		 */
		$this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a �rdenes

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('estado')) {

				$observaciones = $this->OrdersModel->selectObservationListFromState($this->input->post('estado'));
				echo "<option value=\"\"></option>";
				foreach ($observaciones as $fila) {
					//Pinto el detalle del campo
					echo "<option value=\"" . $fila->ID . "\">" . $fila->NOMBRE . "</option>";
				}
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}


	public function reloadStatesBackProcess()
	{
		/**
		 * Selecciono las observaciones que se han definido dentro de la aplicaci�n para el estado que se recibe dentro del post
		 */
		$this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a �rdenes

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('estado')) {

				$information = $this->OrdersModel->getStateRelatationFromOrderState(
					$this->encryption->decrypt($this->input->post('idOrden')),
					$this->input->post('estado')
				);
				$estadosReproceso = $this->OrdersModel->selectNextStatesProcess($information->ID_TORDPROEST, ANORMAL_FLOW);

				//echo "<option value=\"\">".$information->idTordProEst."</option>";
				echo "<option value=\"\"></option>";
				foreach ($estadosReproceso as $fila) {
					//Pinto el detalle del campo
					$idEstado = $this->FunctionsGeneral->getFieldFromTableNotId('ORD_TORDPROEST', 'ID_ESTADO', "ID", $fila->ID_FIN);
					echo "<option value=\"" . $fila->ID_FIN . "\">" . $this->FunctionsGeneral->getFieldFromTableNotId('ORD_ESTADOS', 'NOMBRE', "ID", $idEstado) . "</option>";
				}
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function reloadStateInformationAdd()
	{
		/**
		 * Selecciono las observaciones que se han definido dentro de la aplicaci�n para el estado que se recibe dentro del post
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('estado')) {
				echo $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "ADJUNTO", $this->input->post('estado'));
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}


	public function reloadStateInformationDate()
	{
		/**
		 * Selecciono las observaciones que se han definido dentro de la aplicaci�n para el estado que se recibe dentro del post
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('estado')) {
				echo $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "FESTIMADA", $this->input->post('estado'));
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function reloadObservationStateInformation()
	{
		/**
		 * Selecciono las observaciones que se han definido dentro de la aplicaci�n para el estado que se recibe dentro del post
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('tipo')) {

				echo $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "CIERRA", $this->input->post('tipo')); //0
				echo "|";
				echo $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "TIPOOBSE", $this->input->post('tipo')); //1
				echo "|";
				echo $this->FunctionsGeneral->getFieldFromTable("ORD_OBSESTADO", "DESPIECE", $this->input->post('tipo')); //2
				// Inicio Valores Adicionales campo 1

				echo "|";
				if ($this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC1", $this->input->post('estado')) == VALUE_STATE_NOT) {
					echo "N/A"; //3
					echo "|";
					echo "N/A"; //4
					$valida = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC1", $this->input->post('estado'));
				} else {
					echo $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC1", $this->input->post('estado')); //3
					echo "|";
					$valida = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC1", $this->input->post('estado'));
					if ($valida == 52 || $valida == 54) {
						echo "L"; //4
						$valoresLista = $this->loadListFromAditionalValue($this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC1", $this->input->post('estado')));
					} else {
						if ($valida == 51 || $valida == 53) {
							echo "T"; //4
							$valoresLista = "N/A";
						} else if ($valida == 57 || $valida == 59) {
							echo "D"; //4
							$valoresLista = "N/A";
						} else if ($valida == 58 || $valida == 60) {
							echo "N"; //4
							$valoresLista = "N/A";
						}
					}
				}
				echo "|";
				echo $valida; //5
				echo "|";
				echo $valoresLista; //6

				// Fin Valores Adicionales campo 1

				// Inicio Valores Adicionales campo 2

				echo "|";
				if ($this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC1", $this->input->post('estado')) == VALUE_STATE_NOT) {
					echo "N/A"; //7
					echo "|";
					echo "N/A"; //8
					$valida = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC2", $this->input->post('estado'));
				} else {
					echo $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC2", $this->input->post('estado')); //7
					echo "|";
					$valida = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC2", $this->input->post('estado'));
					if ($valida == 52 || $valida == 54) {
						echo "L"; //8
						$valoresLista = $this->loadListFromAditionalValue($this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC2", $this->input->post('estado')));
					} else {
						if ($valida == 51 || $valida == 53) {
							echo "T"; //8
							$valoresLista = "N/A";
						} else if ($valida == 57 || $valida == 59) {
							echo "D"; //8
							$valoresLista = "N/A";
						} else if ($valida == 58 || $valida == 60) {
							echo "N"; //8
							$valoresLista = "N/A";
						}
					}
				}
				echo "|";
				echo $valida; //9
				echo "|";
				echo $valoresLista; //10

				// Fin Valores Adicionales campo 2


				// Inicio Valores Adicionales campo 3

				echo "|";
				if ($this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC3", $this->input->post('estado')) == VALUE_STATE_NOT) {
					echo "N/A"; //11
					echo "|";
					echo "N/A"; //12
					$valida = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC3", $this->input->post('estado'));
				} else {
					echo $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC3", $this->input->post('estado')); //11
					echo "|";
					$valida = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC3", $this->input->post('estado'));
					if ($valida == 52 || $valida == 54) {
						echo "L"; //12
						$valoresLista = $this->loadListFromAditionalValue($this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC3", $this->input->post('estado')));
					} else {
						if ($valida == 51 || $valida == 53) {
							echo "T"; //12
							$valoresLista = "N/A";
						} else if ($valida == 57 || $valida == 59) {
							echo "D"; //12
							$valoresLista = "N/A";
						} else if ($valida == 58 || $valida == 60) {
							echo "N"; //12
							$valoresLista = "N/A";
						}
					}
				}
				echo "|";
				echo $valida; //13
				echo "|";
				echo $valoresLista; //14

				// Fin Valores Adicionales campo 3


				// Inicio Valores Adicionales campo 4

				echo "|";
				if ($this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC4", $this->input->post('estado')) == VALUE_STATE_NOT) {
					echo "N/A"; //15
					echo "|";
					echo "N/A"; //16
					$valida = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC4", $this->input->post('estado'));
				} else {
					echo $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC4", $this->input->post('estado')); //15
					echo "|";
					$valida = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC4", $this->input->post('estado'));
					if ($valida == 52 || $valida == 54) {
						echo "L"; //16
						$valoresLista = $this->loadListFromAditionalValue($this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC4", $this->input->post('estado')));
					} else {
						if ($valida == 51 || $valida == 53) {
							echo "T"; //16
							$valoresLista = "N/A";
						} else if ($valida == 57 || $valida == 59) {
							echo "D"; //16
							$valoresLista = "N/A";
						} else if ($valida == 58 || $valida == 60) {
							echo "N"; //6
							$valoresLista = "N/A";
						}
					}
				}
				echo "|";
				echo $valida; //17
				echo "|";
				echo $valoresLista; //18

				// Fin Valores Adicionales campo 4

				// Inicio Valores Adicionales campo 5

				echo "|";
				if ($this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC5", $this->input->post('estado')) == VALUE_STATE_NOT) {
					echo "N/A"; //19
					echo "|";
					echo "N/A"; //20
					$valida = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC5", $this->input->post('estado'));
				} else {
					echo $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "NOMCAMPO_ADC5", $this->input->post('estado')); //19
					echo "|";
					$valida = $this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "CAMPO_ADC5", $this->input->post('estado'));
					if ($valida == 52 || $valida == 54) {
						echo "L"; //20
						$valoresLista = $this->loadListFromAditionalValue($this->FunctionsGeneral->getFieldFromTable("ORD_ESTADOS", "LISTA_ADC5", $this->input->post('estado')));
					} else {
						if ($valida == 51 || $valida == 53) {
							echo "T"; //20
							$valoresLista = "N/A";
						} else if ($valida == 57 || $valida == 59) {
							echo "D"; //20
							$valoresLista = "N/A";
						} else if ($valida == 58 || $valida == 60) {
							echo "N"; //20
							$valoresLista = "N/A";
						}
					}
				}
				echo "|";
				echo $valida; //21
				echo "|";
				echo $valoresLista; //22

				// Fin Valores Adicionales campo 5
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	private function loadListFromAditionalValue($lista)
	{
		/**Cargo los valores adicionales de la lista*/

		return listAditionalInformation($this, $lista, null);
	}



	public function reloadTordProInformation()
	{
		/**
		 * Selecciono las observaciones que se han definido dentro de la aplicaci�n para el estado que se recibe dentro del post
		 */
		$this->load->model('OrdersModel'); // Libreria principal de las funciones referentes a �rdenes

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('tipo') != '' && $this->input->post('proceso') != '') {
				$condition = "and ORD_ESTADOS.BLOQUE='" . CTE_VALOR_SI . "' ";
				$observaciones = $this->OrdersModel->selectStatesFromProcessKind(
					$this->session->userdata('usuario'),
					$this->input->post('proceso'),
					$this->input->post('tipo'),
					$condition
				);

				echo "<option value=\"\"></option>";
				if ($observaciones != null) {
					foreach ($observaciones as $fila) {
						//Pinto el detalle del campo
						echo "<option value=\"" . $fila->ID . "\">" . $fila->NOMBRE . "</option>";
					}
				}
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}


	public function reloadCodeElement()
	{
		/**
		 * Recargo los c�digos de los elementos
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('codigo')) {
				$codigo = $this->input->post('codigo');
				echo $this->FunctionsGeneral->getQuantityFieldFromTable("ORD_ELEMENTO", "CODIGO", $codigo);
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	/*public function reloadCodeElementEsalud() {
	    /**
	     * Recargo los c�digos de los elementos validando informaci�n en Esalud
	     
	    $this->load->model ( 'EsaludModel' );
	    if ($this->FunctionsAdmin->validateSession ( $this->encryption->encrypt ( CTE_SAVE_INFORMATION_PROGRAM ) )) {
	        if ($this->input->post ( 'codigo' )) {
	            $codigo = $this->input->post ( 'codigo' );
	           /* echo substr (
	                       $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_ELEMENTOS", "NOM_ELEMENTO", "COD_RIPS_ELE", $codigo )
	                ,CHAR_INIT
	                ,CHAR_END); ;
	            echo $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_ELEMENTOS", "NOM_ELEMENTO", "COD_RIPS_ELE", $codigo );
	            
	            
	        }
	    } else {
	        // Retorno a la p�gina principal
	        header ( "Location: " . base_url () );
	    }
	}*/

	public function reloadCodeProductsServicesEsalud()
	{
		/**
		 * Recargo los c�digos de los elementos validando informaci�n en Esalud
		 */
		$this->load->model('EsaludModel');
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($this->input->post('codigo')) {
				$codigo = $this->input->post('codigo');
				$tipo = $this->input->post('tipo');
				/* echo substr (
	             $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud ( "T_ELEMENTOS", "NOM_ELEMENTO", "COD_RIPS_ELE", $codigo )
	             ,CHAR_INIT
	             ,CHAR_END); ;*/
				if ($tipo != INTERCONSULTAS) {
					echo $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_ELEMENTOS", "NOM_ELEMENTO", "COD_RIPS_ELE", $codigo);
				} else {
					echo $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_SER", "NOM_SER", "COD_SER", $codigo);
				}
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	/************************************************************************************************************************************/
	/** ---------------------------------------- Shelter Integration ------------------------------------------------------------------- */

	public function reloadShelterAvailability()
	{
		/**
		 * Selecciono la disponibilidad del hogar de paso de acuerdo al periodo recibido
		 */
		$this->load->model('ShelterModel'); // Libreria principal de las funciones referentes a �rdenes
		$return = '';
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			// Recibo la informaci�n
			$periodo = $this->input->post('periodo');
			$idHabCama = $this->input->post('idHabCama');
			//$periodo ="2018/07/14 - 2018/07/31";
			list($fechaInicial, $fechaFinal) = explode(" - ", $periodo);

			$diferencia = intervaloTiempo($fechaInicial, $fechaFinal, 86400) + 1;

			$diferencia = intervaloTiempo(defineFormatoFecha($fechaInicial, FORMAT_DATE), defineFormatoFecha($fechaFinal, FORMAT_DATE), 86400) + 1;

			// ECHO "---------------->".$diferencia;
			$lista = "<option value=\"\"></option>";
			$condicionApoyo = "and HP_HOGARPASO.ESTADO ='" . SHELTER_FREE . "'";
			//Obtengo los id de acuerdo a la fecha inicial y final
			$fechaInicial = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", defineFormatoFecha($fechaInicial, FORMAT_DATE));
			$fechaFinal = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", defineFormatoFecha($fechaFinal, FORMAT_DATE));

			$disponibilidad = $this->ShelterModel->selectListOcupationShelterByRoomBed($fechaInicial, $fechaFinal, $condicionApoyo);

			//print_r($disponibilidad);
			if ($disponibilidad != null) {
				foreach ($disponibilidad as $value) {
					if ($value->CANTIDAD >= $diferencia) {
						if ($idHabCama == $value->ID) {
							$selected = "selected='selected'";
						} else {
							$selected = "";
						}
						$lista .= "<option value=\"" . $value->ID . "\" " . $selected . ">" . $value->HABITACION . " - " . $value->CAMA . "</option>";
					}
				}
			}
			echo $lista;
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}

	public function reloadInformationUserShelter($tipo = null, $tipoDoc = null, $documento = null)
	{
		/**
		 * Selecciono la informaci�n de usuario dentro de las bases de datos
		 */
		$this->load->model('ShelterModel');
		$this->load->model('EsaludModel');
		$return = '';
		// Tomo los valores
		if ($tipo == null) {
			$tipo = $this->input->post('tipo');
			$tipoDoc = $this->input->post('tipoDoc');
			$documento = $this->input->post('documento');
		}

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			if ($tipo == '1') {
				// Usuario registrado como paciente
				// echo "jjjjj|ssssss|2000/14/14|2522|23570";
				$id = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "ID_PCTE", "TP_ID_PCTE", traslateIdToEsalud($tipoDoc), "NUM_ID_PCTE", $documento);
				$idAdicional = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_ENCUSUARIO", "ID", "TIPODOC", $tipoDoc, "DOCUMENTO", $documento, "TIPOUSUARIO", $tipo);
				if ($id != '') {
					$nombres = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_NOM_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_NOM_PCTE", "ID_PCTE", $id);
					$apellidos = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_APELL_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_APELL_PCTE", "ID_PCTE", $id);
					$nacimiento = explode(" ", $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "FECH_NCTO_PCTE", "ID_PCTE", $id));
					$nacimiento = $nacimiento[0];
					$entidad = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_ENCUSUARIO", "ENTIDAD", "ID", $idAdicional);
					$procedencia = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_ENCUSUARIO", "PROCEDENCIA", "ID", $idAdicional);
					$departamento = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_MUNICIPIO", "ID_DEPARTAMENTO", "ID", $procedencia);
					$datos = $this->reloadCity($departamento);
					// Retorno valores
					echo $nombres . "|" . $apellidos . "|" . $nacimiento . "|" . $entidad . "|" . $departamento . "|" . $datos . "|" . $procedencia;
				} else {
					// No ha estado dentro del hogar de paso
					echo '';
				}
			} else {
				// Usuario no registrado como paciente
				$id = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_ENCUSUARIO", "ID", "TIPODOC", $tipoDoc, "DOCUMENTO", $documento, "TIPOUSUARIO", $tipo);
				if ($id != '') {
					$nombres = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_USUARIO", "NOMBRES", "ID_ENCUSUARIO", $id));
					$apellidos = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_USUARIO", "APELLIDOS", "ID_ENCUSUARIO", $id));
					$nacimiento = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_USUARIO", "FECHA_NAC", "ID_ENCUSUARIO", $id);
					$entidad = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_ENCUSUARIO", "ENTIDAD", "ID", $id);
					$procedencia = $this->FunctionsGeneral->getFieldFromTableNotIdFields("HP_ENCUSUARIO", "PROCEDENCIA", "ID", $id);
					$departamento = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_MUNICIPIO", "ID_DEPARTAMENTO", "ID", $procedencia);
					$datos = $this->reloadCity($departamento);
					// Retorno valores
					echo $nombres . "|" . $apellidos . "|" . $nacimiento . "|" . $entidad . "|" . $departamento . "|" . $datos . "|" . $procedencia;
				} else {
					// No ha estado dentro del hogar de paso
					echo '';
				}
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}

	public function reloadInformationUserShelterFromLocation()
	{
		/**
		 * Selecciono la informaci�n de usuario dentro de las bases de datos
		 */
		$this->load->model('ShelterModel');
		$this->load->model('EsaludModel');
		$return = '';
		// Tomo los valores
		$id = $this->input->post('id');
		//$id=866;
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {

			// Obtengo el id Habcama
			$idHabCama = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ID_HABCAMA", $id);
			$estado = $this->FunctionsGeneral->getFieldFromTable("HP_HOGARPASO", "ESTADO", $id);
			$idHabitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_HABITACION", $idHabCama);
			$idCama = $this->FunctionsGeneral->getFieldFromTable("HP_HABCAMA", "ID_CAMA", $idHabCama);
			$habitacion = $this->FunctionsGeneral->getFieldFromTable("HP_HABITACIONES", "NOMBRE", $idHabitacion);
			$cama = $this->FunctionsGeneral->getFieldFromTable("HP_CAMAS", "NOMBRE", $idCama);

			if ($estado == SHELTER_RESERVE) {
				$titulo = "Reserva desde: ";
			} else {
				$titulo = "Ocupaci&oacute;n desde: ";
			}
			//Pinto informaci�n del hu�sped

			// Obtengo la fecha de inicio
			$fecha = cambiaHoraServer(2);
			$fecha = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "ID", "FECHA", $fecha);

			$datos = $this->ShelterModel->selectBooking($idHabCama, $fecha);
			foreach ($datos as $value) {
				$fecha = $value->INICIO;
				$fechaFin = $value->FIN;
				//Traigo informaci�n del hu�sped
				$huesped = retornaInformacionHuesped($value->ID_USUARIOHP, $this);
				echo '<div class="row">
										<div class="col-md-6 col-xs-6 b-r">
											<strong>Documento de identidad</strong> <br>
											<p class="text-muted">' . $huesped['tipoDoc'] . ' ' . $huesped['documento'] . '</p>
										</div>
				
										<div class="col-md-6 col-xs-6 b-r">
											<strong>Nombre Completo</strong> <br>
											<p class="text-muted">
				                                        ' . $huesped['nombre'] . '</p>
										</div>
				
										<div class="col-md-6 col-xs-6">
											<strong>Habitaci&oacute;n</strong> <br>
											<p class="text-muted">
				                                        	' . $habitacion . ' - ' . $cama . '
				                                         </p>
										</div>
				                         <div class="col-md-6 col-xs-6">
											<strong>' . $titulo . '</strong> <br>
											<p class="text-muted">
				                                        	' . $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $fecha) . ' - ' . $this->FunctionsGeneral->getFieldFromTableNotId("ADM_CALENDARIO", "FECHA", "ID", $fechaFin) . '
				                                         </p>
										</div>
									</div>';
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}

	/************************************************************************************************************************************/
	/** ---------------------------------------- Sponsorship Integration ------------------------------------------------------------------- */

	public function reloadInformationUserSponsorship($tipoDoc = null, $documento = null)
	{
		/**
		 * Selecciono la informaci�n de usuario dentro de las bases de datos
		 */
		$this->load->model('ShelterModel');
		$this->load->model('EsaludModel');
		$return = '';
		// Tomo los valores
		if ($tipoDoc == null) {
			$tipoDoc = $this->input->post('tipoDoc');
			$documento = $this->input->post('documento');
		}

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			$id = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "ID_PCTE", "TP_ID_PCTE", traslateIdToEsalud($tipoDoc), "NUM_ID_PCTE", $documento);
			if ($id != '') {
				$nombres = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_NOM_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_NOM_PCTE", "ID_PCTE", $id);
				$apellidos = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_APELL_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_APELL_PCTE", "ID_PCTE", $id);
				// Retorno valores
				echo $nombres . "|" . $apellidos;
			} else {
				// No ha estado dentro del hogar de paso
				echo '';
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}

	/************************************************************************************************************************************/
	/** ---------------------------------------- StokePrice Integration ------------------------------------------------------------------- */

	public function reloadInformationForStokePrice($codigo = null)
	{
		/**
		 * Recargo los c�digos de los productos y/ servicios
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			// Tomo los valores
			if ($codigo == null) {
				$codigo = $this->input->post('codigo');
			}
			$to = null;
			if ($codigo) {

				$id = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID", "CODIGO", $codigo);
				if ($id != '') {

					//Esta en el arbol, busco si es producto o interconsulta
					$nombre = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "NOMBRE", "CODIGO", $codigo);
					$idTipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID_TIPOORDEN", "CODIGO", $codigo);
					$tipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "TIPOORDEN", "CODIGO", $codigo);
					$descripcion = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ARBOLCODIGO", "DESCRIPCION", "CODIGO", $codigo);
					$id = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID", "CODIGO", $codigo);
					$proveedor = '';
					$validador = '1';
					$to = "40";
				} else {
					//Valido si es elemento
					$id = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "ID", "CODIGO", $codigo);
					if ($id != '') {
						//Esta en el arbol, busco si es producto o interconsulta
						$nombre = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "NOMBRE", "CODIGO", $codigo);
						$proveedor = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "ID_PROVEEDOR", "CODIGO", $codigo);
						//$id = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO","ID","CODIGO",$codigo);
						$idTipoOrden = '0';
						$tipoOrden = 'Elementos';
						$descripcion = '';
						$to = "39";
					} else {
						//Valido si es elemento
						$id = '-';
						$nombre = '-';
						$idTipoOrden = '-';
						$tipoOrden = '-';
						$descripcion = '-';
						$proveedor = '-';
						$to = '-';
					}
					$validador = '0';
				}
				//echo $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DESCRIPCION","ID","CODIGO",$id, "ID_TIPO",$to);

				if ($this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DESCRIPCION", "ID", "CODIGO", $id, "ID_TIPO", $to) != '') {
					echo '*' . "|" . '*' . "|" . '*' . "|" . '*' . "|" . '*';
				} else {
					echo $idTipoOrden . "|" . $tipoOrden . "|" . $id . "|" . $nombre . " " . $id . "|" . $descripcion . "|" . $proveedor . "|" . $validador;
				}
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}

	public function reloadInformationForStokePriceCloseList($codigo = null)
	{
		/**
		 * Recargo los c�digos de los productos y/ servicios
		 */
		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			// Tomo los valores
			if ($codigo == null) {
				$codigo = $this->input->post('codigo');
			}
			if ($codigo) {
				//echo "<script>console.log('codigo: " . $codigo . "' );</script>";
				$id = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID", "CODIGO", $codigo);
				echo "<script>console.log('id: " . $id . "' );</script>";
				if ($id != '') {
					//Esta en el arbol, busco si es producto o interconsulta
					$nombre = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "NOMBRE", "CODIGO", $codigo);
					echo "<script>console.log('nombre: " . $nombre . "' );</script>";
					$idTipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID_TIPOORDEN", "CODIGO", $codigo);
					$tipoOrden = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "TIPOORDEN", "CODIGO", $codigo);
					$descripcion = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ARBOLCODIGO", "DESCRIPCION", "CODIGO", $codigo);
					$id = $this->FunctionsGeneral->getFieldFromTableNotId("VIEW_ORD_ARBOLPRODUCTOS", "ID", "CODIGO", $codigo);
					$proveedor = '';
					$validador = '1';
					$tem = '40';
				} else {
					//Valido si es elemento
					$id = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "ID", "CODIGO", $codigo);
					$tem = '39';
					if ($id != '') {
						//Esta en el arbol, busco si es producto o interconsulta
						$nombre = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "NOMBRE", "CODIGO", $codigo);
						echo "<script>console.log('nombre: " . $nombre . "' );</script>";
						$proveedor = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO", "ID_PROVEEDOR", "CODIGO", $codigo);
						//$id = $this->FunctionsGeneral->getFieldFromTableNotId("ORD_ELEMENTO","ID","CODIGO",$codigo);
						$idTipoOrden = '0';
						$tipoOrden = 'Elementos';
						$descripcion = '';
					} else {
						//Valido si es elemento
						$id = '-';
						$nombre = '-';
						$idTipoOrden = '-';
						$tipoOrden = '-';
						$descripcion = '-';
						$proveedor = '-';
					}
					$validador = '0';
				}

				//echo "aca:  . $nombre . ";
				//if ($this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_DESCRIPCION", "ID", "CODIGO", $id, "ID_TIPO", $tem) != '') {
					echo $idTipoOrden . "|" . $tipoOrden . "|" . $id . "|" . $nombre . " " . $id . "|" . $descripcion . "|" . $proveedor . "|" . $validador;
				//} else {
				//	echo '*' . "|" . '*' . "|" . '*' . "|" . '*' . "|" . '*';
				//}
			}
		} else {
			// Retorno a la p�gina principal
			header("Location: " . base_url());
		}
	}



	public function reloadInformationUserStokePrice($tipoDoc = null, $documento = null)
	{
		/**
		 * Selecciono la informaci�n de usuario dentro de las bases de datos
		 */
		$this->load->model('StokePriceModel');
		// $this->load->model ( 'EsaludModel' );
		$return = '';
		// Tomo los valores
		if ($tipoDoc == null) {
			$tipoDoc = $this->input->post('tipoDoc');
			$documento = $this->input->post('documento');
		}

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			$id = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "ID_PCTE", "TP_ID_PCTE", traslateIdToEsalud($tipoDoc), "NUM_ID_PCTE", $documento);
			if ($id != '') {
				$nombres = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_NOM_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_NOM_PCTE", "ID_PCTE", $id);
				$apellidos = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "PRI_APELL_PCTE", "ID_PCTE", $id) . " " . $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "SEG_APELL_PCTE", "ID_PCTE", $id);
				$telefono = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "TEL_PCTE", "ID_PCTE", $id);
				$direccion = $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_PACIENTES", "DIR_PCTE", "ID_PCTE", $id);
				// Retorno valores
				echo $nombres . "|" . $apellidos . "|" . $telefono . "|" . '' . "|" . $direccion . "|" . '';
			} else {
				// Ahora valido si esta dentro de las cotizaciones
				$nombres = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_USUARIO", "NOMBRES", "DOCUMENTO", $documento, "TIPODOC", $tipoDoc));
				if ($nombres != '') {
					$apellidos = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_USUARIO", "APELLIDOS", "DOCUMENTO", $documento, "TIPODOC", $tipoDoc));
					$telefono = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_USUARIO", "TELEFONO", "DOCUMENTO", $documento, "TIPODOC", $tipoDoc));
					$correo = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_USUARIO", "CORREO", "DOCUMENTO", $documento, "TIPODOC", $tipoDoc));
					$direccion = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_USUARIO", "DIRECCION", "DOCUMENTO", $documento, "TIPODOC", $tipoDoc));
					$fijo = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_USUARIO", "FIJO", "DOCUMENTO", $documento, "TIPODOC", $tipoDoc));

					echo $nombres . "|" . $apellidos . "|" . $telefono . "|" . $correo . "|" . $direccion . "|" . $fijo;
				} else {
					echo '';
				}
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}



	public function reloadInformationUserStokePriceElements($codigo = null, $empresa = null, $margen = null)
	{
		/**
		 * Selecciono la informaci�n de usuario dentro de las bases de datos
		 */
		$this->load->model('StokePriceModel');
		// Tomo los valores
		if ($codigo == null) {
			$codigo = $this->input->post('codigo');
			$empresa = $this->input->post('empresa');
			$margen = $this->input->post('margen');
		}

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			//Obtengo la tarifa asociada a al empresa
			$tarifa = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFAEMPRESA", "ID_TARIFA", "ID", $empresa);

			//Obtengo id de empresa de Esalud
			$idEmpresa = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFAEMPRESA", "ID_EMPRESA", "ID", $empresa);
			//Verifico si esta empresa tiene relaci�n en empresas especiales con lista cerrada
			$idCerrada = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_EMPRESALISTA", "ID_CERRADA", "ID_EMPRESA", $idEmpresa);
			$idLista = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_EMPRESALISTA", "ID", "ID_EMPRESA", $idEmpresa);


			if ($tarifa != '') {
				$margenElementos = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFA", "MARGEN_ELEMENTOS", "ID", $tarifa);
				$margenServicios = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFA", "MARGEN_SERVICIOS", "ID", $tarifa);
				$margenProductos = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFA", "MARGEN_PRODUCTOS", "ID", $tarifa);
				// Ahora valido si esta dentro de las cotizaciones
				$nombre = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "NOMBRE", "CODIGO", $codigo);
				$idElemento = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID", "CODIGO", $codigo);
				if ($nombre != '') {
					$tipo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "TIPO", "CODIGO", $codigo);

					$idTipo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID_TIPO", "CODIGO", $codigo);
					$idCodigo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID", "CODIGO", $codigo);

					//Get Value IVA
					//$idIva=$this->FunctionsGeneral->getFieldFromTableNotIdFields ( "ORD_ELEMENTO", "IVA", "CODIGO",$codigo);
					$idGruElem = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_ELEMENTO", "ID_GRUELEM", "CODIGO", $codigo);
					$idIva = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ORD_GRUELEM", "IVA", "ID", $idGruElem);
					$iva = $this->FunctionsGeneral->getFieldFromTableNotIdFields("ADM_DETLISTA", "VALOR", "ID", $idIva);

					//Tomo valor de materiales
					$materiales = defineValueElementsMaterials($this, $codigo) * 1;

					//Tomo valor de mano de obra que se tiene definido
					$manoObra = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "MANOOBRA", "CODIGO", $codigo) * 1;
					//$manoObra = $this->FunctionsGeneral->getFieldFromTableNotIdFields ( "COT_DESCRIPCION", "MANOOBRA", "AUXILIAR",$codigo )*1;

					//Tomo valor de los costos indirectos que se tienen asociados
					/*$asociados = $this->FunctionsGeneral->getFieldFromTableNotIdFields ( "VIEW_COT_DESCRIPCION", "ASOCIADOS", "CODIGO",$codigo );*/

					$asociados = defineValueElementsMaterials($this, $codigo, 'ASOCIADOS') * 1;


					//Calculo el valor unitario de acuerdo al costo
					if ($idCerrada == CTE_VALOR_SI) {
						//Obtengo el precio de la lista cerrada
						$unitario = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_LISTAELEMENTOS", "PRECIO", "ID_EMPRESA", $idLista, "ID_CODIGO", $idElemento);
						if ($unitario == '' || $unitario == null) {
							//No tiene c�digo definido se pondr� el valor calculado por costo
							$unitario = defineValue($margenElementos, $margenServicios, $margenProductos, $idTipo, $materiales, $manoObra, $asociados);
							//$bandera=false;

						}
						$margen = 30;
						$valida = 0;
					} else {
						$unitario = defineValue(
							$margenElementos,
							$margenServicios,
							$margenProductos,
							$idTipo,
							$materiales,
							$manoObra,
							$asociados
						);
						if ($idTipo == 39) {
							$margen = $margenElementos;
						} else if ($idTipo == 40) {
							$margen = $margenElementos;
						} else if ($idTipo == 41) {
							$margen = $margenServicios;
						}
						$valida = 0;
						//Valido si es la empresa es nueva eps y si el valor unitario supera al tope establecido
						if ($idEmpresa == 2689) {
							//identifico el valor interno
							$idInterno = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_EMPRESALISTA", "ID", "ID_EMPRESA", $idEmpresa);
							$auxiliar = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_LISTAELEMENTOS", "AUXILIAR", "ID_EMPRESA", $idInterno, "ID_CODIGO", $idCodigo);
							//Obtengo el valor tope definido
							$tope = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_CODIGONEPS", "MONTO", "CODIGO", $auxiliar);
							if ($unitario > $tope) {
								$unitario = $tope;
								$valida = 1;
							}
						}
					}

					//Retorno valores
					echo $nombre . "|" .
						$tipo . "|" .
						$unitario . "|" .
						$margen . "|" .
						$materiales . "|" .
						$manoObra . "|" .
						$asociados . "|" .
						$valida . "|" .
						numberFormatEvolution($unitario) . "|" .
						$iva . "|" .
						$idIva . "|" .
						$idGruElem;
				} else {
					echo '';
				}
			} else {
				echo '';
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}

	public function reloadInformationStokePriceForSponsorShip($documento = null, $tipoDocumento = null)
	{
		/**
		 * Selecciono la informaci�n de usuario dentro de las bases de datos
		 */
		$this->load->model('StokePriceModel');
		// Tomo los valores
		if ($documento == null) {
			$documento = $this->input->post('documento');
			$tipoDocumento = $this->input->post('tipoDoc');
		}

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			//Obtengo la tarifa asociada a al empresa
			$condicion = "and COT_USUARIO.DOCUMENTO='$documento' and COT_USUARIO.TIPODOC='$tipoDocumento' and COT_COTIZACION.ESTADO='" . ACTIVO_ESTADO . "'";
			$cotizaciones = $this->StokePriceModel->selectListStokePrice($condicion);
			$return = '<option value="">--- Seleccione una opci&oacute;n ---</option>';
			if ($cotizaciones != null) {
				$i = 0;
				foreach ($cotizaciones as $value) {
					//Genero listado de cotizaciones
					//Verifico que la cotizaci�n no este relacionada a otro patrocinio activo
					$cantidad = $this->FunctionsGeneral->getQuantityFieldFromTable("PAT_PATROCINIOS", "IDCOTI", $value->ID, "ESTADO", ACTIVO_ESTADO) +
						$this->FunctionsGeneral->getQuantityFieldFromTable("PAT_PATROCINIOS", "IDCOTI", $value->ID, "ESTADO", "P");

					if ($cantidad == 0) {
						$return .= "<option value=\"" . $value->ID . "\">Consecutivo: " . $value->CONSECUTIVO . " --- Fecha de generaci&oacute;n: " . $value->FECHA . " --- Valor: $ " . ($value->TOTAL - ($value->TOTAL * ($value->DESCUENTO / 100))) . "</option>";
						$i++;
					}
				}
				if ($i != 0) {
					echo $return;
				} else {
					echo '**';
				}
			} else {
				echo '**';
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}

	public function reloadInformationStokePriceForSponsorShipDefineValue($cotizacion = null)
	{
		/**         reloadInformationStokePriceForSponsorShipDefineValue
		 * Selecciono la informaci�n de usuario dentro de las bases de datos
		 */
		$this->load->model('StokePriceModel');
		// Tomo los valores
		if ($cotizacion == null) {
			$cotizacion = $this->input->post('cotizacion');
		}

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {
			//Obtengo la tarifa asociada a al empresa
			$condicion = "and COT_COTIZACION.ID='$cotizacion' and COT_COTIZACION.ESTADO='" . ACTIVO_ESTADO . "'";
			$cotizaciones = $this->StokePriceModel->selectListStokePrice($condicion);
			$return = '';
			if ($cotizaciones != null) {
				foreach ($cotizaciones as $value) {
					//Genero listado de cotizaciones
					$return = $value->TOTAL - ($value->TOTAL * ($value->DESCUENTO / 100));
				}
				echo $return;
			} else {
				echo '**';
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}


	public function reloadCodeCostStokePrice($margen = null, $manoobra = null, $materiales = null, $adicionales = null, $codigo = null, $empresa = null)
	{
		/**  Retorno el c�lculo del valor unitario teniendo en cuenta los costos definidos y el margen
		 */
		$this->load->model('StokePriceModel');
		// Tomo los valores
		if ($margen == null) {
			$margen = $this->input->post('margen');
			$manoobra = $this->input->post('manoobra');
			$materiales = $this->input->post('materiales');
			$adicionales = $this->input->post('adicionales');
			$cantidad = $this->input->post('cantidad');
			$codigo = $this->input->post('codigo');
			$empresa = $this->input->post('empresa');
		}

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {

			//Obtengo la tarifa asociada a al empresa
			$tarifa = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFAEMPRESA", "ID_TARIFA", "ID", $empresa);

			//Obtengo id de empresa de Esalud
			//Verifico si esta empresa tiene relaci�n en empresas especiales con lista cerrada

			$idEmpresa = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_TARIFAEMPRESA", "ID_EMPRESA", "ID", $empresa);
			$idCerrada = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_EMPRESALISTA", "ID_CERRADA", "ID_EMPRESA", $idEmpresa);
			$idLista = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_EMPRESALISTA", "ID", "ID_EMPRESA", $idEmpresa);


			if ($tarifa != '') {
				$margenElementos = $margen;
				$margenServicios = $margen;
				$margenProductos = $margen;

				// Ahora valido si esta dentro de las cotizaciones
				$nombre = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "NOMBRE", "CODIGO", $codigo);
				$idElemento = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID", "CODIGO", $codigo);
				if ($nombre != '') {
					$tipo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "TIPO", "CODIGO", $codigo);
					$idTipo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID_TIPO", "CODIGO", $codigo);
					$idCodigo = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "ID", "CODIGO", $codigo);
					//Tomo valor de materiales
					$materiales = defineValueElementsMaterials($this, $codigo);

					//Tomo valor de mano de obra que se tiene definido
					$manoObra = $this->FunctionsGeneral->getFieldFromTableNotIdFields("VIEW_COT_DESCRIPCION", "MANOOBRA", "CODIGO", $codigo);

					//Tomo valor de los costos indirectos que se tienen asociados
					/*$asociados = $this->FunctionsGeneral->getFieldFromTableNotIdFields ( "VIEW_COT_DESCRIPCION", "ASOCIADOS", "CODIGO",$codigo );*/

					$asociados = defineValueElementsMaterials($this, $codigo, 'ASOCIADOS');


					//Calculo el valor unitario de acuerdo al costo
					if ($idCerrada == CTE_VALOR_SI) {
						//Obtengo el precio de la lista cerrada
						$unitario = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_LISTAELEMENTOS", "PRECIO", "ID_EMPRESA", $idLista, "ID_CODIGO", $idElemento);
						if ($unitario == '' || $unitario == null) {
							//No tiene c�digo definido se pondr� el valor calculado por costo
							$unitario = defineValue($margenElementos, $margenServicios, $margenProductos, $idTipo, $materiales, $manoObra, $asociados);
							//$bandera=false;

						}
						$margen = null;
						$valida = null;
					} else {
						$unitario = defineValue(
							$margenElementos,
							$margenServicios,
							$margenProductos,
							$idTipo,
							$materiales,
							$manoObra,
							$asociados
						);
						if ($idTipo == 39) {
							$margen = $margenElementos;
						} else if ($idTipo == 40) {
							$margen = $margenElementos;
						} else if ($idTipo == 41) {
							$margen = $margenServicios;
						}
						$valida = null;
						//Valido si es la empresa es nueva eps y si el valor unitario supera al tope establecido
						if ($idEmpresa == 2689) {
							//identifico el valor interno
							$idInterno = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_EMPRESALISTA", "ID", "ID_EMPRESA", $idEmpresa);
							$auxiliar = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_LISTAELEMENTOS", "AUXILIAR", "ID_EMPRESA", $idInterno, "ID_CODIGO", $idCodigo);
							//Obtengo el valor tope definido
							$tope = $this->FunctionsGeneral->getFieldFromTableNotIdFields("COT_CODIGONEPS", "MONTO", "CODIGO", $auxiliar);
							if ($unitario > $tope) {
								$unitario = $tope;
								$valida = 1;
							}
						}
					}
					/*
    	            //Retorno valores
    	            echo $nombre . "|" . $tipo. "|" . $unitario . "|" . $margen. "|" . $materiales. "|" . $manoObra. "|" . $asociados. "|" . $valida. "|" . numberFormatEvolution($unitario);*/

					/*
			        $temporalValor=defineValueFormule($margen,$materiales,$manoobra,$adicionales);
			        $total=$temporalValor*$cantidad;
			        echo $temporalValor."|".numberFormatEvolution($temporalValor)."|".$total."|".numberFormatEvolution($total);
					*/

					$total = $unitario * $cantidad;
					echo $unitario . "|" . numberFormatEvolution($unitario) . "|" . $total . "|" . numberFormatEvolution($total);
				} else {
					echo '';
				}
			} else {
				echo '';
			}
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}


	public function reloadCostTextStokePrice($total = null, $totalFinal = null)
	{
		/**  Retorno el c�lculo del valor unitario teniendo en cuenta los costos definidos y el margen
		 */
		$this->load->model('StokePriceModel');
		// Tomo los valores
		if ($total == null) {
			$total = $this->input->post('total');
			$totalFinal = $this->input->post('totalFinal');
		}

		if ($this->FunctionsAdmin->validateSession($this->encryption->encrypt(CTE_SAVE_INFORMATION_PROGRAM))) {


			echo numberFormatEvolution($total) . "|" . numberFormatEvolution($totalFinal);
		} else {
			// Retorno a la p�gina principal

			header("Location: " . base_url());
		}
	}

	public function reloadSaveAutName($idOrden = null, $nameAut = null)
	{
		$this->load->model('OrdersModel');
		$nameAut = $this->input->post('name');
		$idOrden = $this->encryption->decrypt($this->input->post('idOrden'));
		if ($nameAut != null && $idOrden != null) {
			$saveAut = $this->OrdersModel->updateOrderNameAut($idOrden, $nameAut);
			echo json_encode("Dato almacenado correctamente");
		}
	}
}
