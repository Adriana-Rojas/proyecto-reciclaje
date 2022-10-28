<?php
/**
 *************************************************************************
 *************************************************************************
 Creado por:                     Juan Carlos Escobar Baquero
 Correo electrónico:              jcescobarba@gmail.com
 Creación:                        27/02/2018
 Modificación:                	2019/11/06
 Propósito:                       Cabecera dentro del sistema para presentar mensajes de la aplicación
 *************************************************************************
 *************************************************************************
 ******************** BOGOTa COLOMBIA 2017 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- BEGIN PAGE SWEET ALERT PLUGINS-->
<script type="text/javascript">
                   $(document).ready(function() {
                        swal({
                          title: "<?= $titulo ?>",
                          text: "<?= $mensaje ?>",
                          type: "<?= $clase ?>",
                          confirmButtonClass: "",
                          confirmButtonText: "Continuar",
                          closeOnConfirm: true
                        }
                        );
                    });
                </script>
<!-- END PAGE SWEET ALERT PLUGINS-->

