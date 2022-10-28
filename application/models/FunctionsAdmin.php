<?php

/** 
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electr�nico:         jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:                  Funciones de selecci�n a las tablas de administraci�n, en donde hay interacci�n con m�s de una tabla 
 */
class FunctionsAdmin extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function validateSession($mainPage = null)
    {
        if ($this->session->userdata('login') == 'SI') {
            /*
             * echo $_SERVER['PHP_SELF']."<br>";
             * echo $_SERVER['REQUEST_URI']."<br>";
             * echo base_url(uri_string())."<br>";
             * echo uri_string()."<br>";
             * echo index_page()."<br>";
             */
            
            if ($this->encryption->decrypt($mainPage) == CTE_SAVE_INFORMATION_PROGRAM) {
                return true;
            } else {
                
                // Obtengo id del m�dulo
                $idModulo = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage);
                if ($idModulo == '') {
                    // Verifico con final
                    $idModulo = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODULO", "ID", "PAGINA", $mainPage . "/");
                    if ($idModulo == '') {
                        // Obtengo el id a trav�s de las funciones
                        $idModulo = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODFUNCIONES", "ID_MODULO", "PAGINA", $mainPage);
                        if ($idModulo == '') {
                            // Obtengo el id a trav�s de las funciones
                            $idModulo = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_MODFUNCIONES", "ID_MODULO", "PAGINA", $mainPage . "/");
                        }
                    }
                }
                // Valido informaci�n de acuerdo al rol
                if ($idModulo != '') {
                    // echo " <center>------------ ---------------- --------------------- ------------------".$idModulo." ------------ ---------------- --------------------- ------------------</center>";
                    // Obtengo id del perfil
                    $idRolPer = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_USUROLPER", "ID_ROLPERFIL", "ID_USUARIO", $this->session->userdata('usuario'));
                    // echo " <center>------------ ---------------- --------------------- ------------------".$this->session->userdata ( 'usuario' )." ------------ ---------------- --------------------- ------------------</center>";
                    // echo " <center>------------ ---------------- --------------------- ------------------".$idRolPer." ------------ ---------------- --------------------- ------------------</center>";
                    // Verifico la cantidad de la relaci�n entre el m�dulo y el perfil
                    $cantidad = $this->FunctionsGeneral->getQuantityFieldFromTable("ADM_MODROLPER", "ID_MODULO", $idModulo, "ID_ROLPERFIL", $idRolPer);
                    if ($cantidad > 0) {
                        // echo " <center>------------ ---------------- --------------------- ------------------".$cantidad." ------------ ---------------- --------------------- ------------------</center>";
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }

    public function selectModulesUser($user, $module = null)
    {
        /**
         * Seleccciona los modulos para el usuario de acuerdo al rol que tenga definido dentro del sistema
         */
        if ($module != null) {
            $complement = " and ADM_MODULO.ID_MODULO='$module'";
        } else {
            $complement = " and ADM_MODULO.ID_MODULO is null";
        }
        $sql = "select distinct ADM_MODNOMBRE.NOMBRE as NOMBRE,
							   ADM_MODULO.PAGINA as PAGINA,
							   ADM_MODULO.ID as ID,
							   ADM_MODULO.CLASE as CLASE,
							   ADM_MODULO.ID_MODULO,
							   ADM_MODULO.ID_TIPOMOD
		from ADM_MODNOMBRE, ADM_MODULO, ADM_MODROLPER, ADM_USUROLPER
		where ADM_MODNOMBRE.ID_MODULO=ADM_MODULO.ID
		and ADM_MODROLPER.ID_MODULO=ADM_MODULO.ID
		and ADM_MODROLPER.ID_ROLPERFIL=ADM_USUROLPER.ID_ROLPERFIL
		and ADM_MODROLPER.ESTADO='S'
		and ADM_MODULO.ESTADO='S'
		and ADM_USUROLPER.ESTADO='S'
		and ADM_USUROLPER.ID_USUARIO='$user'
		$complement
		order by  ADM_MODULO.ID
		";
       // echo $sql."<br>";
        // Cargo el resultado de la consulta dentro de un array de resultados
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function selectSubModulesUser($user, $module, $ruta = null)
    {
        /**
         * Seleccciona los modulos para el usuario de acuerdo al rol que tenga definido dentro del sistema
         */
        $complement = " and ADM_MODULO.ID_MODULO='$module'";
        
        $sql = "select distinct 
						ADM_MODNOMBRE.NOMBRE as NOMBRE,
						ADM_MODULO.PAGINA as PAGINA,
						ADM_MODULO.ID as ID,
						ADM_TIPOMOD.CLASE as CLASE,
						ADM_MODULO.ID_MODULO,
						ADM_MODULO.ID_TIPO
				from ADM_MODNOMBRE, 
					 ADM_MODULO, 
					 ADM_MODROLPER, 
					 ADM_USUROLPER,
					 ADM_TIPOMOD
				where ADM_MODNOMBRE.ID_MODULO=ADM_MODULO.ID
				and ADM_MODROLPER.ID_MODULO=ADM_MODULO.ID
				and ADM_MODROLPER.ID_ROLPERFIL=ADM_USUROLPER.ID_ROLPERFIL
				and ADM_MODROLPER.ESTADO='S'
				and ADM_MODULO.ESTADO='S'
				and ADM_USUROLPER.ESTADO='S'
				and ADM_USUROLPER.ID_USUARIO='$user'
				and ADM_TIPOMOD.ID= ADM_MODULO.ID_TIPOMOD
				$complement
		        order by ADM_MODULO.ID
		";
       // echo $sql."<br>";
        // Cargo el resultado de la consulta dentro de un array de resultados
        $result = $this->db->query($sql);
        $submenu = $result->result();
        $return = '';
        $valida = 0;
        foreach ($submenu as $value) {
            // Men� �nico
            if ($ruta == $value->PAGINA) {
                $selected = "selected";
                $active = "active";
                $open = "open";
                
                $valida ++;
            } else {
                $selected = "";
                $active = "";
                $open = "";
            }
            if ($value->ID_TIPO == '-2') {
                // Un solo nivel
                $return .= "<li class=\"" . $active . "\">
						<a href=\"" . base_url() . $value->PAGINA . "\" class=\"" . $active . "\">
									" . $value->NOMBRE . "
					    </a>
					  </li>";
            } else {
                // Dos niveles
                // Multi nivel
                $secundario = $this->selectSubSubModulesUser($user, $value->ID, $ruta);
                $return .= "<li> <a class=\"has-arrow\" href=\"javascript:void(0)\" aria-expanded=\"false\">" . $value->NOMBRE . "</a>
                                    <ul aria-expanded=\"false\" class=\"collapse\">
                                        " . $secundario[1] . "
                                    </ul>
                                </li>";
            }
        }
        $datos[0] = $valida;
        $datos[1] = $return;
        return $datos;
    }

    public function selectSubSubModulesUser($user, $module, $ruta = null)
    {
        /**
         * Seleccciona los modulos para el usuario de acuerdo al rol que tenga definido dentro del sistema
         */
        $complement = " and ADM_MODULO.ID_MODULO='$module'";
        
        $sql = "select distinct
		ADM_MODNOMBRE.NOMBRE as NOMBRE,
		ADM_MODULO.PAGINA as PAGINA,
		ADM_MODULO.ID as ID,
		ADM_TIPOMOD.CLASE as CLASE,
		ADM_MODULO.ID_MODULO,
		ADM_MODULO.ID_TIPO
		from ADM_MODNOMBRE,
		ADM_MODULO,
		ADM_MODROLPER,
		ADM_USUROLPER,
		ADM_TIPOMOD
		where ADM_MODNOMBRE.ID_MODULO=ADM_MODULO.ID
		and ADM_MODROLPER.ID_MODULO=ADM_MODULO.ID
		and ADM_MODROLPER.ID_ROLPERFIL=ADM_USUROLPER.ID_ROLPERFIL
		and ADM_MODROLPER.ESTADO='S'
		and ADM_MODULO.ESTADO='S'
		and ADM_USUROLPER.ESTADO='S'
		and ADM_USUROLPER.ID_USUARIO='$user'
		and ADM_TIPOMOD.ID= ADM_MODULO.ID_TIPOMOD
		$complement
		order by ADM_MODULO.ID
		";
        // echo $sql."<br>";
        // Cargo el resultado de la consulta dentro de un array de resultados
        $result = $this->db->query($sql);
        $submenu = $result->result();
        $return = '';
        $valida = 0;
        foreach ($submenu as $value) {
            // Men� �nico
            if ($ruta == $value->PAGINA) {
                $selected = "selected";
                $active = "active";
                $open = "open";
                
                $valida ++;
            } else {
                $selected = "";
                $active = "";
                $open = "";
            }
            $return .= "<li class=\"" . $active . "\">
						<a href=\"" . base_url() . $value->PAGINA . "\" class=\"" . $active . "\">
									" . $value->NOMBRE . "
					    </a>
					  </li>";
        }
        $datos[0] = $valida;
        $datos[1] = $return;
        return $datos;
    }

    public function selectSubModulesUserBoard($user, $funcion, $module, $opcion)
    {
        /**
         * Seleccciona los modulos para el usuario de acuerdo al rol que tenga definido dentro del sistema
         */
        $sql = "select  
                    ADM_MODFUNCIONES.NOMBRE as NOMBRE,
                    ADM_MODFUNCIONES.PAGINA as PAGINA,
                    ADM_MODFUNCIONES.ICONO as ICONO,
                    ADM_MODFUNCIONES.COLOR as COLOR,
                    ADM_MODFUNCIONES.ID as ID
        from ADM_MODFUNCIONES, ADM_MODFUNROLPER,ADM_USUROLPER
        where ADM_MODFUNCIONES.ID_MODULO='$module'
        and ADM_MODFUNROLPER.ID_MODFUNCIONES=ADM_MODFUNCIONES.ID
        and ADM_MODFUNROLPER.ID_ROLPERFIL=ADM_USUROLPER.ID_ROLPERFIL
        and ADM_MODFUNROLPER.ESTADO='S'
        and ADM_MODFUNCIONES.ESTADO='S'
        and ADM_USUROLPER.ESTADO='S'
        and ADM_USUROLPER.ID_USUARIO='$user'
        and  ADM_MODFUNCIONES.ID_TIPO='$opcion'
        and  ADM_MODFUNCIONES.FUNCION='$funcion'
        order by ADM_MODFUNCIONES.ID
        ";
         //  echo $sql."<br>";
        // Cargo el resultado de la consulta dentro de un array de resultados
        
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function returnRouteActual($route)
    {
        /**
         * Rutina para obtener la ruta actual en la cual se encuentra el usuario navegando
         */
        
        // Creo arreglos para guardar la informaci�n
        $data = array();
        $nomModule = array();
        $nomModuleFather = array();
        // Busco el nombre de la p�gina actual
        $this->db->from('ADM_MODULO');
        $this->db->where('PAGINA', $route);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            
            // Tengo el id del programa actual
            $data = $query->row_array();
            $this->db->from('ADM_MODNOMBRE');
            $this->db->where('ID_MODULO', $data['ID']);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                // Tengo el id del programa actual
                $nomModule = $query->row_array();
            } else {
                return null;
            }
            // Obtengo el id del programa padre
            $this->db->from('ADM_MODNOMBRE');
            $this->db->where('ID_MODULO', $data['ID_MODULO']);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                // Tengo el id del programa actual
                $nomModuleFather = $query->row_array();
            } else {
                return null;
            }
            // return "<li>".$nomModuleFather['NOMBRE']."<i class=\"fa fa-arrow\"></i></li>"."<li>".$nomModule['NOMBRE']."</li>";
            $return[0] = "<li class=\"breadcrumb-item \">" . $nomModuleFather['NOMBRE'] . "<i class=\"breadcrumb-item active\"></i></li>" . "<li class=\"breadcrumb-item active\">" . $nomModule['NOMBRE'] . "</li>";
            $return[1] = $nomModule['NOMBRE'];
            return $return;
        } else {
           
            return null;
        }
    }

    public function selectTypeForLocation()
    {
        /**
         * Selecciono los valores actuales de la tabla ADM_TIPO
         */
        $this->db->where('ESTADO', 'S');
        $this->db->order_by('NOMBRE', 'asc');
        $tipo = $this->db->get('ADM_TIPO');
        if ($tipo->num_rows() > 0) {
            return $tipo->result();
        }
    }

    public function selectLocationType($idTipo)
    {
        /**
         * Selecciono los valores actuales de la tabla ADM_TIPOUBICACION
         */
        $this->db->where('ID_TIPO', $idTipo);
        $this->db->where('ESTADO', 'S');
        $this->db->order_by('NOMBRE', 'asc');
        $tipoUbicacion = $this->db->get('ADM_TIPOUBICACION');
        if ($tipoUbicacion->num_rows() > 0) {
            return $tipoUbicacion->result();
        }
    }

    public function selectValoresListaAdministracion($lista, $idioma, $order = null)
    {
        /**
         * Seleccciona los modulos para el usuario de acuerdo al rol que tenga definido dentro del sistema
         */
        $sql = "select distinct ADM_DETLISTA.ID as ID,
								ADM_DETLISTA.NOMBRE as NOMBRE,
								ADM_DETLISTA.VALOR as VALOR
		from ADM_DETLISTA, ADM_ENCLISTA
		where ADM_ENCLISTA.NOMBRE='$lista'
		and ADM_ENCLISTA.ID=ADM_DETLISTA.ID_ENCLISTA
		and ADM_DETLISTA.ID_IDIOMA='$idioma'
		and ADM_DETLISTA.ESTADO='S'
		and ADM_ENCLISTA.ESTADO='S'
		order by ADM_DETLISTA.ID $order
		";
       //  echo $sql."<br>";
        // Cargo el resultado de la consulta dentro de un array de resultados
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        }
    }

    public function selectValoresMensajeAplicacion($clasificacion, $idioma)
    {
        /**
         * Seleccciona los modulos para el usuario de acuerdo al rol que tenga definido dentro del sistema
         */
        $sql = "select distinct ADM_DETMENSAJE.TITULO as TITULO,
		ADM_DETMENSAJE.MENSAJE as MENSAJE,
		ADM_ENCMENSAJE.CLASE as CLASE
		from ADM_DETMENSAJE, ADM_ENCMENSAJE
		where ADM_ENCMENSAJE.NOMBRE='$clasificacion'
		and ADM_ENCMENSAJE.ID=ADM_DETMENSAJE.ID_ENCMENSAJE
		and ADM_DETMENSAJE.ID_IDIOMA='$idioma'
		and ADM_DETMENSAJE.ESTADO='S'
		and ADM_ENCMENSAJE.ESTADO='S'
		";
        // echo $sql."<br>";
        // Cargo el resultado de la consulta dentro de un array de resultados
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        }
    }

    public function selectMunicipiosFromDepartamento($idDepartamento) 
    {
        /**
         * Selecciono los valores actuales de la tabla ADM_MUNICIPIO, cuando selecciona departamento
         */
		//echo "<script>console.log('ConsoleW: " . $idDepartamento . "' );</script>";
        $this->db->where('ID_DEPARTAMENTO', $idDepartamento);
        $this->db->where('ESTADO', 'S');
        $this->db->order_by('NOMBRE', 'asc');
        $tipoUbicacion = $this->db->get('ADM_MUNICIPIO');
        if ($tipoUbicacion->num_rows() > 0) {
			//echo "<script>console.log('tipoUbicacion6: " .$tipoUbicacion->result() . "' );</script>";
            return $tipoUbicacion->result();
			
        }
    }

    public function selectTipoDocumento($id)
    {
        /**
         * Selecciono los valores actuales de la tabla ADM_DETLISTA
         */
        $this->db->where('ID_ENCLISTA', $id);
        $this->db->where('ESTADO', 'S');
        $this->db->order_by('NOMBRE', 'asc');
        $tipoUbicacion = $this->db->get('ADM_DETLISTA');
        if ($tipoUbicacion->num_rows() > 0) {
            return $tipoUbicacion->result();
        }
    }

    public function selectEmpresaAliada()
    {
        /**
         * Seleccciona los diferentes usuarios que est�n asociados al grupo de la tabla $tabla
         */
        $sql = "select ADM_ALIADA.ID, 
    				  ADM_ALIADA.EMPRESA, 
    				  ADM_MUNICIPIO.NOMBRE as MUNICIPIO,
    				  ADM_DEPARTAMENTO.NOMBRE as DEPARTAMENTO,
    					ADM_ALIADA.ESTADO,
                        ADM_ALIADA.CORREO,
                        ADM_ALIADA.TELEFONO,
                        ADM_ALIADA.DIRECCION
	    	from ADM_ALIADA, ADM_MUNICIPIO, ADM_DEPARTAMENTO
	    	where ADM_ALIADA.ID_MUNICIPIO=ADM_MUNICIPIO.ID
	    	and ADM_MUNICIPIO.ID_DEPARTAMENTO=ADM_DEPARTAMENTO.ID
    	";
        // echo $sql."<br>";
        // Cargo el resultado de la consulta dentro de un array de resultados
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        }
    }
    
    public function selectUsersFromProfile($perfil)
    {
        /**
         * Seleccciona los diferentes usuarios que est�n asociados al grupo de la tabla $tabla
         */
        $sql = "
            SELECT
            ADM_USUARIO.ID,
            ADM_USUARIO.NOMBRES,
            ADM_USUARIO.APELLIDOS
            
            FROM
            ADM_USUARIO
            INNER JOIN ADM_USUROLPER ON ADM_USUROLPER.ID_USUARIO = ADM_USUARIO.ID
            INNER JOIN ADM_ROLPERFIL ON ADM_USUROLPER.ID_ROLPERFIL = ADM_ROLPERFIL.ID
            INNER JOIN ADM_PERFIL ON ADM_ROLPERFIL.ID_PERFIL = ADM_PERFIL.ID
            WHERE
            ADM_PERFIL.ID = $perfil AND
            ADM_USUARIO.ESTADO = '".ACTIVO_ESTADO."'
    	";
        // echo $sql."<br>";
        // Cargo el resultado de la consulta dentro de un array de resultados
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        }
    }
}
