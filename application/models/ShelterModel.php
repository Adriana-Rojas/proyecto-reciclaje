<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 Juan Carlos Escobar Baquero
 Correo electrónico:         jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:                  Clase en las cuales se definen las operaciones CRUD frente a las tablas que tienen relación con la aplicación Hogar de paso y todos sus modulos
 */
class ShelterModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    /* ---------------------------------------------------------- INSERT --------------------------------------------------------- */
    public function insertShelterState($nombre, $permite, $icono, $usuario)
    {
        /**
         * Se inserta la información de la tabla HP_ESTADO
         */
        
        // Obtiene el siguiente ID
        $consecutivo = $this->FunctionsGeneral->countMax('HP_ESTADO', 'ID', 1);
        $data = array(
            'ID' => $consecutivo,
            'NOMBRE' => $nombre,
            'PERMITE' => $permite,
            'ICONO' => $icono,
            'ESTADO' => 'S',
            'UCREA' => $usuario,
            'FCREA' => cambiaHoraServer(),
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el insert sobre la base de datos en la tabla HP_ESTADO
        $this->db->insert('HP_ESTADO', $data);
        return $consecutivo;
    }

    public function insertShelter($idHabCama, $fecha, $usuario)
    {
        /**
         * Se inserta la información de la tabla HP_HOGARPASO
         */
        
        // Obtiene el siguiente ID
        $consecutivo = $this->FunctionsGeneral->countMax('HP_HOGARPASO', 'ID', 1);
        $data = array(
            'ID' => $consecutivo,
            'ID_HABCAMA' => $idHabCama,
            'FECHAINICIO' => $fecha,
            'ESTADO' => '1',
            'UCREA' => $usuario,
            'FCREA' => cambiaHoraServer(),
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el insert sobre la base de datos en la tabla HP_HOGARPASO
        $this->db->insert('HP_HOGARPASO', $data);
        return $consecutivo;
    }

    public function insertShelterMaintenance($idHabCama, $fechaInicio, $fechaFin, $usuario)
    {
        /**
         * Se inserta la información de la tabla HP_MANTENIMIENTO
         */
        
        // Obtiene el siguiente ID
        $consecutivo = $this->FunctionsGeneral->countMax('HP_MANTENIMIENTO', 'ID', 1);
        $data = array(
            'ID' => $consecutivo,
            'ID_HABCAMA' => $idHabCama,
            'FECHAINICIO' => $fechaInicio,
            'FECHAFIN' => $fechaFin,
            'ESTADO' => 'S',
            'UCREA' => $usuario,
            'FCREA' => cambiaHoraServer(),
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el insert sobre la base de datos en la tabla HP_HOGARPASO
        $this->db->insert('HP_MANTENIMIENTO', $data);
        return $consecutivo;
    }

    public function insertShelterEncUser($tipoUsuario, $entidad, $tipoDoc, $documento, $historia, $procedencia, $usuario)
    {
        /**
         * Se inserta la información de la tabla HP_ENCUSUARIO
         */
        
        // Obtiene el siguiente ID
        $consecutivo = $this->FunctionsGeneral->countMax('HP_ENCUSUARIO', 'ID', 1);
        $data = array(
            'ID' => $consecutivo,
            'TIPOUSUARIO' => $tipoUsuario,
            'ENTIDAD' => $entidad,
            'TIPODOC' => $tipoDoc,
            'DOCUMENTO' => $documento,
            'HISTORIA' => $historia,
            'PROCEDENCIA' => $procedencia,
            'ESTADO' => 'S',
            'UCREA' => $usuario,
            'FCREA' => cambiaHoraServer(),
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // print_r($data);
        // Realizo el insert sobre la base de datos en la tabla HP_ENCUSUARIO
        $this->db->insert('HP_ENCUSUARIO', $data);
        return $consecutivo;
    }

    public function insertShelterUser($idEncUsuario, $nombres, $apellidos, $nacimiento, $usuario)
    {
        /**
         * Se inserta la información de la tabla HP_USUARIO
         */
        
        // Obtiene el siguiente ID
        $consecutivo = $this->FunctionsGeneral->countMax('HP_USUARIO', 'ID', 1);
        $data = array(
            'ID' => $consecutivo,
            'ID_ENCUSUARIO' => $idEncUsuario,
            'NOMBRES' => $nombres,
            'APELLIDOS' => $apellidos,
            'FECHA_NAC' => $nacimiento,
            'ESTADO' => 'S',
            'UCREA' => $usuario,
            'FCREA' => cambiaHoraServer(),
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el insert sobre la base de datos en la tabla HP_USUARIO
        $this->db->insert('HP_USUARIO', $data);
        return $consecutivo;
    }

    public function insertShelterRelationWithUser($idEncUsuario, $tsocial, $reserva, $ocupacion, $acompanante, $usuario)
    {
        /**
         * Se inserta la información de la tabla HP_USUARIOHP
         */
        
        // Obtiene el siguiente ID
        $consecutivo = $this->FunctionsGeneral->countMax('HP_USUARIOHP', 'ID', 1);
        
        if ($reserva) {
            // Si hay reserva
            $consReserva = $this->FunctionsGeneral->countMax('HP_USUARIOHP', 'RESERVA', 1);
        } else {
            $consReserva = null;
        }
        if ($ocupacion) {
            // Si hay reserva
            $consOcupacion = $this->FunctionsGeneral->countMax('HP_USUARIOHP', 'OCUPACION', 1);
        } else {
            $consOcupacion = null;
        }
        $data = array(
            'ID' => $consecutivo,
            'ID_ENCUSUARIO' => $idEncUsuario,
            'TSOCIAL' => $tsocial,
            'RESERVA' => $consReserva,
            'OCUPACION' => $consOcupacion,
            'ACOMPANANTE' => $acompanante,
            'ESTADO' => 'S',
            'UCREA' => $usuario,
            'FCREA' => cambiaHoraServer(),
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el insert sobre la base de datos en la tabla HP_USUARIOHP
        $this->db->insert('HP_USUARIOHP', $data);
        return $consecutivo;
    }

    public function insertShelterRelationWithUserDefinition($idReserva, $idHabCama, $inicio, $fin, $horaIng, $fechaIng, $horaFin, $fechaFin, $usuario)
    {
        /**
         * Se inserta la información de la tabla HP_USUARIOOCUPA
         */
        
        // Obtiene el siguiente ID
        $consecutivo = $this->FunctionsGeneral->countMax('HP_USUARIOOCUPA', 'ID', 1);
        
        $data = array(
            'ID' => $consecutivo,
            'ID_USUARIOHP' => $idReserva,
            'ID_HABCAMA' => $idHabCama,
            'INICIO' => $inicio,
            'FIN' => $fin,
            'HINGRESO' => $horaIng,
            'HEGRESO' => $horaFin,
            'FINGRESO' => $fechaIng,
            'FEGRESO' => $fechaFin,
            'ESTADO' => 'S',
            'UCREA' => $usuario,
            'FCREA' => cambiaHoraServer(),
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el insert sobre la base de datos en la tabla HP_USUARIOOCUPA
        $this->db->insert('HP_USUARIOOCUPA', $data);
        return $consecutivo;
    }

    public function insertShelterRelationWithUsers($idReservaPrincipal, $idReservaAuxiliar, $usuario)
    {
        /**
         * Se inserta la información de la tabla HP_PACACOMP
         */
        
        // Obtiene el siguiente ID
        $consecutivo = $this->FunctionsGeneral->countMax('HP_PACACOMP', 'ID', 1);
        
        $data = array(
            'ID' => $consecutivo,
            'ID_USUARIOHP' => $idReservaPrincipal,
            'ID_ACOMP' => $idReservaAuxiliar,
            'ESTADO' => 'S',
            'UCREA' => $usuario,
            'FCREA' => cambiaHoraServer(),
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el insert sobre la base de datos en la tabla HP_PACACOMP
        $this->db->insert('HP_PACACOMP', $data);
        return $consecutivo;
    }

    /**
     * ---------------------------------------------------------- TODO UPDATE ---------------------------------------------------------
     */
    public function updateShelterState($id, $nombre, $permite, $icono, $usuario)
    {
        /**
         * Se actualizaa la información de la tabla HP_ESTADO
         */
        $data = array(
            'NOMBRE' => $nombre,
            'PERMITE' => $permite,
            'ICONO' => $icono,
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el update sobre la base de datos en la tabla HP_ESTADO
        $this->db->where('ID', $id);
        $this->db->update('HP_ESTADO', $data);
    }

    public function updateShelterStateByDates($id, $initialDate, $endDate, $state, $usuario, $condicion = null)
    {
        /**
         * Se actualizaa la información de la tabla HP_HOGARPASO
         */
        // Acondiciono variables
        /*
         * $initialDate=defineFormatoFecha($initialDate,FORMAT_DATE);
         * $endDate=defineFormatoFecha($endDate,FORMAT_DATE);
         */
        $sql = "update 	HP_HOGARPASO 
				SET ESTADO='$state' ,
						UMOD='$usuario', 
					 	FMOD='" . cambiaHoraServer() . "'
				WHERE ID_HABCAMA='$id' 
					 and FECHAINICIO BETWEEN '$initialDate' AND '$endDate'
					 $condicion";
        // echo $sql;
        $result = $this->db->query($sql);
    }

    public function updateShelterEncUser($id, $entidad, $historia, $procedencia, $usuario)
    {
        /**
         * Se actualizaa la información de la tabla HP_ENCUSUARIO
         */
        $data = array(
            'ENTIDAD' => $entidad,
            'HISTORIA' => $historia,
            'PROCEDENCIA' => $procedencia,
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el update sobre la base de datos en la tabla HP_ENCUSUARIO
        $this->db->where('ID', $id);
        $this->db->update('HP_ENCUSUARIO', $data);
    }

    public function updateShelterUser($idEncUsuario, $nombres, $apellidos, $nacimiento, $usuario)
    {
        /**
         * Se actualizaa la información de la tabla HP_USUARIO
         */
        $data = array(
            'NOMBRES' => $nombres,
            'APELLIDOS' => $apellidos,
            'FECHA_NAC' => $nacimiento,
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el update sobre la base de datos en la tabla HP_USUARIO
        $this->db->where('ID_ENCUSUARIO', $idEncUsuario);
        $this->db->update('HP_USUARIO', $data);
    }

    public function updateShelterCheckIn($id, $dingreso, $hingreso, $usuario)
    {
        /**
         * Se actualizaa la información de la tabla HP_USUARIOOCUPA
         */
        $data = array(
            'FINGRESO' => $dingreso,
            'HINGRESO' => $hingreso,
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el update sobre la base de datos en la tabla HP_USUARIO
        $this->db->where('ID', $id);
        $this->db->update('HP_USUARIOOCUPA', $data);
    }

    public function updateShelterCheckOut($id, $degreso, $hegreso, $usuario)
    {
        /**
         * Se actualizaa la información de la tabla HP_USUARIOOCUPA
         */
        $data = array(
            'FEGRESO' => $degreso,
            'HEGRESO' => $hegreso,
            'UMOD' => $usuario,
            'FMOD' => cambiaHoraServer()
        );
        // Realizo el update sobre la base de datos en la tabla HP_USUARIO
        $this->db->where('ID', $id);
        $this->db->update('HP_USUARIOOCUPA', $data);
    }

    /* ---------------------------------------------------------- TODO DELETE --------------------------------------------------------- */
    
    /* ---------------------------------------------------------- SELECT --------------------------------------------------------- */
    public function selectListDefineRelation($condicion = null)
    {
        /**
         * Seleccciona el listado de la relación entre habitaciones y camas
         */
        $sql = "select HP_HABCAMA.ID, 
					 HP_CAMAS.ID AS ID_CAMA,
					 HP_CAMAS.NOMBRE AS CAMA,
					 HP_HABITACIONES.ID AS ID_HABITACION,
					 HP_HABITACIONES.NOMBRE AS HABITACION,
					 HP_HABCAMA.ESTADO 
			from HP_HABCAMA,HP_CAMAS, HP_HABITACIONES
			where HP_HABCAMA.ID_CAMA=HP_CAMAS.ID
			and HP_HABCAMA.ID_HABITACION=HP_HABITACIONES.ID
			and HP_CAMAS.ESTADO='" . ACTIVO_ESTADO . "'
			and HP_HABITACIONES.ESTADO='" . ACTIVO_ESTADO . "'
			$condicion		 
		";
        // echo $sql;
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function selectQuantityFromShelter($id, $initialDate, $endDate, $condition)
    {
        /**
         * Seleccciona el listado de la relación entre habitaciones y camas
         */
        $sql = "select count(*) as CANTIDAD
			from HP_HOGARPASO
			where ID_HABCAMA='$id' 
			and FECHAINICIO BETWEEN '" . defineFormatoFecha($initialDate, FORMAT_DATE) . "' AND '" . defineFormatoFecha($endDate, FORMAT_DATE) . "'
			$condition";
        
        $sql = "select count(*) as CANTIDAD
			from HP_HOGARPASO
			where ID_HABCAMA='$id'
			and FECHAINICIO BETWEEN '" . $initialDate . "' AND '" . $endDate . "'
			$condition";
        
        // echo $sql;
        $result = $this->db->query($sql);
        
        if ($result->num_rows() > 0) {
            $tempo = $result->result();
        } else {
            $tempo = null;
        }
        IF ($tempo!=null) {
            foreach ($tempo as $t) {
                return $t->CANTIDAD;
            }
        } else {
            return null;
        }
    }

    public function selectListOcupationShelter($inicio, $fin = null, $condicionApoyo = null)
    {
        /**
         * Seleccciona el listado de la relación entre habitaciones y camas para una(s) fecha(s) dada(s)
         */
        
        /*
         * if ($fin==null){
         * $condicion="HP_HOGARPASO.FECHAINICIO='".defineFormatoFecha($inicio,FORMAT_DATE)."'";
         * }else{
         * $condicion="HP_HOGARPASO.FECHAINICIO BETWEEN '".defineFormatoFecha($inicio,FORMAT_DATE)."' AND '".defineFormatoFecha($fin,FORMAT_DATE)."'";
         * }
         */
        if ($fin == null) {
            $condicion = "HP_HOGARPASO.FECHAINICIO='" . $inicio . "'";
        } else {
            $condicion = "HP_HOGARPASO.FECHAINICIO BETWEEN '" . $inicio . "' AND '" . $fin . "'";
        }
        $sql = "select 
					 HP_HOGARPASO.ID AS ID,
					 HP_HABCAMA.ID as ID_HABCAMA,
					 HP_CAMAS.ID AS ID_CAMA,
					 HP_CAMAS.NOMBRE AS CAMA,
					 HP_HABITACIONES.ID AS ID_HABITACION,
					 HP_HABITACIONES.NOMBRE AS HABITACION,
					 HP_HOGARPASO.ESTADO AS ID_ESTADO,
					 HP_ESTADO.NOMBRE AS ESTADO,
					 HP_ESTADO.ID AS ID_ESTADO,
					 HP_ESTADO.ICONO AS ICONO
			from HP_HABCAMA,HP_CAMAS, HP_HABITACIONES,HP_HOGARPASO,HP_ESTADO
			where HP_HABCAMA.ID_CAMA=HP_CAMAS.ID
			and HP_HABCAMA.ID_HABITACION=HP_HABITACIONES.ID
			and HP_CAMAS.ESTADO='" . ACTIVO_ESTADO . "'
			and HP_HABITACIONES.ESTADO='" . ACTIVO_ESTADO . "'
			and HP_HOGARPASO.ID_HABCAMA=HP_HABCAMA.ID 
			and HP_ESTADO.ID=HP_HOGARPASO.ESTADO
			and $condicion
			$condicionApoyo
			order by HP_HABITACIONES.NOMBRE, HP_CAMAS.NOMBRE
				";
         //echo $sql."<br>";
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function selectListOcupationShelterByRoomBed($inicio, $fin, $condicionApoyo)
    {
        /**
         * Seleccciona el listado de la relación entre habitaciones y camas para una(s) fecha(s) dada(s)
         */
        /*
         * if ($fin==null){
         * $condicion="HP_HOGARPASO.FECHAINICIO='".defineFormatoFecha($inicio,FORMAT_DATE)."'";
         * }else{
         * $condicion="HP_HOGARPASO.FECHAINICIO BETWEEN '".defineFormatoFecha($inicio,FORMAT_DATE)."' AND '".defineFormatoFecha($fin,FORMAT_DATE)."'";
         * }
         */
        if ($fin == null) {
            $condicion = "HP_HOGARPASO.FECHAINICIO='" . $inicio . "'";
        } else {
            $condicion = "HP_HOGARPASO.FECHAINICIO BETWEEN '" . $inicio . "' AND '" . $fin . "'";
        }
        $sql = "select distinct
					 HP_HABCAMA.ID as ID,
					 HP_CAMAS.NOMBRE AS CAMA, 
					 HP_HABITACIONES.NOMBRE AS HABITACION,
					 count(HP_HABCAMA.ID) as  CANTIDAD
			from HP_HABCAMA,HP_CAMAS, HP_HABITACIONES,HP_HOGARPASO,HP_ESTADO
			where HP_HABCAMA.ID_CAMA=HP_CAMAS.ID
			and HP_HABCAMA.ID_HABITACION=HP_HABITACIONES.ID
			and HP_CAMAS.ESTADO='" . ACTIVO_ESTADO . "'
			and HP_HABITACIONES.ESTADO='" . ACTIVO_ESTADO . "'
				and HP_HOGARPASO.ID_HABCAMA=HP_HABCAMA.ID
				and HP_ESTADO.ID=HP_HOGARPASO.ESTADO
				and $condicion
				$condicionApoyo
			group by HP_CAMAS.NOMBRE, 
					HP_HABITACIONES.NOMBRE,
					HP_HABCAMA.ID
			ORDER BY HP_HABITACIONES.NOMBRE , HP_CAMAS.NOMBRE";
        
         //echo $sql."<br>";
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function selectMaintenance($idHabCama, $fecha)
    {
        /**
         * Seleccciona el listado de la relación entre habitaciones y camas
         */
        // $fecha= defineFormatoFecha($fecha,FORMAT_DATE);
        $sql = "select HP_MANTENIMIENTO.ID,
					HP_MANTENIMIENTO.FECHAINICIO,
					HP_MANTENIMIENTO.FECHAFIN
				from HP_MANTENIMIENTO
				where HP_MANTENIMIENTO.ID_HABCAMA='$idHabCama'
				and HP_MANTENIMIENTO.FECHAINICIO<='" . $fecha . "'
				and HP_MANTENIMIENTO.FECHAFIN>='" . $fecha . "'
				and HP_MANTENIMIENTO.ESTADO='" . ACTIVO_ESTADO . "'	
			
				";
        // echo $sql;
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function selectBooking($idHabCama, $fecha)
    {
        /**
         * Seleccciona el listado de la relación entre habitaciones y camas
         */
        // $fecha= defineFormatoFecha($fecha,FORMAT_DATE);
        $sql = "select HP_USUARIOOCUPA.ID,
					 HP_USUARIOOCUPA.INICIO,
					 HP_USUARIOOCUPA.FIN,
					 HP_USUARIOOCUPA.ID_USUARIOHP
		from HP_USUARIOOCUPA
		where HP_USUARIOOCUPA.ID_HABCAMA='$idHabCama'
		and HP_USUARIOOCUPA.INICIO<='" . $fecha . "'
				and HP_USUARIOOCUPA.FIN>='" . $fecha . "'
				and HP_USUARIOOCUPA.ESTADO='" . ACTIVO_ESTADO . "'
		
				";
        // echo $sql;
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function selectBookingFromUser($idUser, $fecha)
    {
        /**
         * Seleccciona el listado de la relación entre habitaciones y camas
         */
        // $fecha= defineFormatoFecha($fecha,FORMAT_DATE);
        $sql = "select HP_USUARIOOCUPA.ID,
		HP_USUARIOOCUPA.INICIO,
		HP_USUARIOOCUPA.FIN,
		HP_USUARIOOCUPA.ID_USUARIOHP,
		HP_USUARIOOCUPA.ID_HABCAMA
		from HP_USUARIOOCUPA
		where HP_USUARIOOCUPA.ID_USUARIOHP='$idUser'
		and HP_USUARIOOCUPA.INICIO<='" . $fecha . "'
				and HP_USUARIOOCUPA.FIN>='" . $fecha . "'
				and HP_USUARIOOCUPA.ESTADO='" . ACTIVO_ESTADO . "'
	
				";
        // echo $sql;
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }

    public function selectBookingShelter($fecha)
    {
        /**
         * Selecciona el estado actual de las reservas vigentes que hay para el hogar de paso
         */
        
        // $fecha= defineFormatoFecha($fecha,FORMAT_DATE);
        $sql = "SELECT
				HP_USUARIOOCUPA.INICIO,
				HP_USUARIOOCUPA.FIN,
				HP_HABITACIONES.NOMBRE AS HABITACION,
				HP_CAMAS.NOMBRE AS CAMA,
				HP_HABCAMA.ID AS ID,
				HP_ENCUSUARIO.TIPOUSUARIO AS ID_TIPOUSUARIO,
				HP_TIPOUSUARIO.NOMBRE AS TIPOUSUARIO,
				HP_ENCUSUARIO.ID as ID_USUARIO,
				HP_ENCUSUARIO.TIPODOC,
				HP_ENCUSUARIO.DOCUMENTO,
				HP_USUARIOOCUPA.ESTADO
			
			FROM
				HP_USUARIOOCUPA
					INNER JOIN HP_HABCAMA ON HP_USUARIOOCUPA.ID_HABCAMA = HP_HABCAMA.ID
					INNER JOIN HP_HABITACIONES ON HP_HABCAMA.ID_HABITACION = HP_HABITACIONES.ID
					INNER JOIN HP_CAMAS ON HP_HABCAMA.ID_CAMA = HP_CAMAS.ID
					INNER JOIN HP_USUARIOHP ON HP_USUARIOOCUPA.ID_USUARIOHP = HP_USUARIOHP.ID
					INNER JOIN HP_ENCUSUARIO ON HP_USUARIOHP.ID_ENCUSUARIO = HP_ENCUSUARIO.ID
					INNER JOIN HP_TIPOUSUARIO ON HP_ENCUSUARIO.TIPOUSUARIO = HP_TIPOUSUARIO.ID
			WHERE HP_USUARIOOCUPA.INICIO<= '" . $fecha . "' 
			and HP_USUARIOOCUPA.FIN >= '" . $fecha . "' 
			AND HP_USUARIOOCUPA.ESTADO = '" . ACTIVO_ESTADO . "'
			AND HP_USUARIOOCUPA.FINGRESO is NULL
	
				";
        // echo $sql;
        $result = $this->db->query($sql);
        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return null;
        }
    }
}
?>