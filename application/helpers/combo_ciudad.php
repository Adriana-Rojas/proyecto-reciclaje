<?php
$usuario = 'sa';
$pass = 'reciclaje2022..';
$servidor = 'INGADRIANA\SQLEXPRESS';
$basedatos = 'produccion';
$info = array('Database'=>$basedatos, 'UID'=>$usuario, 'PWD'=>$pass);
$conn = sqlsrv_connect($servidor, $info);


$salida="";




$id_pais=$_POST["elegido"];

$sql1 = "SELECT *  FROM  ADM_MUNICIPIO WHERE ID_DEPARTAMENTO = '$id_pais'";
         $stmt1 = sqlsrv_query($conn, $sql1 );
        

// construimos el combo de ciudades deacuerdo al pais seleccionado
while($arr = sqlsrv_fetch_array($sql1, SQLSRV_FETCH_ASSOC) )

  {
   $salida.= "<option value='".$sql_p['ID']."'>".$sql_p['NOMBRE']."</option>";
  }
echo $salida;
?>
