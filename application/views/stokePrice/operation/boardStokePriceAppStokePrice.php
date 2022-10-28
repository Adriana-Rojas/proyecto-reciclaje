<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electrónico:          	jcescobarba@gmail.com
 Creación:                    	27/02/2018
 Modificación:                	2019/11/06
 Propósito:						Página Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOTÁ COLOMBIA 2018 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');
?>




<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->

<form class=" form-horizontal" role="form" action="<?= base_url() ?>StokePriceAppStokePrice/board" id="form_sample_3" method="post" autocomplete="off">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Selecci&oacute;n de par&aacute;metros </h4>
                    <h6 class="card-subtitle">Seleccione el periodo para el cual desea validar las cotizaciones</h6>
                </div>
                <div class="form-group">
                    <label class="col-md-12" for="periodo">Periodo *</label>
                    <div class="col-md-12">
                        <input class="form-control input-limit-datepicker" type="text" name="periodo" id="periodo" value="2021/07/04 - <?php echo date("Y-m-d"); ?>" />
                        <div class="form-control-feedback"> </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
    <!-- Botón de envio de formulario -->
    <div class="row">
        <div class="col-sm-12">

            <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light m-r-10 pull-right">Enviar</button>
            <input type="hidden" name="informe" id="informe" value="1">
        </div>
        <div class="col-sm-12">
            <br>
        </div>
    </div>
    <!-- FIN Botón de envio de formulario -->
</form>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><i class="fa fa-newspaper-o fa-2x"></i> Listado de Solicitudes de cotizaci&oacute;n generadas dentro del periodo <?= $fechaInicial; ?> - <?= $fechaFinal; ?></h4>
                <h6 class="card-subtitle"></h6>
                <div class="table-responsive">
                    <table id="myTable" class="display nowrap table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Acci&oacute;n</th>
                                <th>Estado</th>
                                <th>Solicitud</th>
                                <th>Documento</th>
                                <th>Nombres y apellidos</th>
                                <th>Entidad</th>
                                <th>N° Cotización</th>
                                <th>Analista</th>
                                <th>Seguimiento</th>
                                <th>Fecha de solicitud asegurador</th>
                                <th>Fecha creacion solicitud</th>
                                <th>Fecha de emision cotizacion</th>
                                <th>Tiempo en estado</th>
                                <!-- <th >Valor</th> -->

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($listaLista != null) {
                                $i = 1;
                                foreach ($listaLista as $value) {


                            ?>
                                    <tr>
                                        <td>
                                            <!--  
                                                    <button type="button" class="btn btn-sm btn-icon btn-pure btn-outline delete-row-btn" data-toggle="tooltip" data-original-title="Delete"><i class="ti-close" aria-hidden="true"></i></button>
                                                    -->
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info btn-rounded dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa fa-bars"></i>
                                                </button>
                                                <div class="dropdown-menu animated lightSpeedIn">
                                                    <?php
                                                    if ($listaBoard != null) {
                                                        foreach ($listaBoard as $valueBoard) {
                                                            if ($value->CONSECUTIVO != '') {
                                                                if (($valueBoard->PAGINA == 'StokePriceAppStokePrice/inactive/' || $valueBoard->PAGINA == 'StokePriceAppStokePrice/trace/' || $valueBoard->PAGINA == 'StokePriceAppStokePrice/viewRegister/' | $valueBoard->PAGINA == 'StokePriceAppStokePrice/edit/')
                                                                    && ($value->ESTADO == 'S') && ($value->ID_SEGUIMIENTO != '47')
                                                                ) {
                                                    ?>
                                                                    <a class="dropdown-item" href="<?= base_url() . $valueBoard->PAGINA . $this->encryption->encrypt($value->ID); ?>">
                                                                        <i class="<?= $valueBoard->ICONO ?>"></i>
                                                                        <?= $valueBoard->NOMBRE ?>
                                                                    </a>

                                                                <?php


                                                                } else if (($valueBoard->PAGINA == 'StokePriceAppStokePrice/viewRegister/')) {
                                                                ?>
                                                                    <a class="dropdown-item" href="<?= base_url() . $valueBoard->PAGINA . $this->encryption->encrypt($value->ID); ?>">
                                                                        <i class="<?= $valueBoard->ICONO ?>"></i>
                                                                        <?= $valueBoard->NOMBRE ?>
                                                                    </a>
                                                                <?php
                                                                }
                                                            } else {
                                                                if ($valueBoard->PAGINA == 'StokePriceAppStokePrice/newRegister/' || $valueBoard->PAGINA == 'StokePriceAppStokePrice/inactiveRequest/') {
                                                                ?>
                                                                    <a class="dropdown-item" href="<?= base_url() . $valueBoard->PAGINA . $this->encryption->encrypt($value->SOLICITUD); ?>">
                                                                        <i class="<?= $valueBoard->ICONO ?>"></i>
                                                                        <?= $valueBoard->NOMBRE ?>
                                                                    </a>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>


                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="<?= validaEstadosGenerales($value->ESTADO, 'CLASE') ?>">
                                                <?= validaEstadosGenerales($value->ESTADO, 'NOMBRE') ?>
                                            </span>
                                        </td>
                                        <td><?= $value->SOLICITUD; ?></td>
                                        <td><?PHP
                                            if ($value->TIPODOC != '') {
                                                echo $value->TIPODOC . " " . $value->DOCUMENTO;
                                            } else {
                                                $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_USUARIO", "ID", $value->SOLICITUD);
                                                $tipoDoc = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "TIPODOC", "ID", $idUsuario);
                                                $documento = $this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "DOCUMENTO", "ID", $idUsuario);
                                                $tipoDoc = $this->FunctionsGeneral->getFieldFromTableNotId("ADM_DETLISTA", "VALOR", "ID", $tipoDoc);
                                                echo $tipoDoc . " " . $documento;
                                            }


                                            ?></td>

                                        <td><?PHP
                                            if ($value->TIPODOC != '') {
                                                echo $this->encryption->decrypt($value->NOMBRES) . " " . $this->encryption->decrypt($value->APELLIDOS);;
                                            } else {
                                                $idUsuario = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_USUARIO", "ID", $value->SOLICITUD);
                                                $nombres = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "NOMBRES", "ID", $idUsuario));
                                                $apellidos = $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotId("COT_USUARIO", "APELLIDOS", "ID", $idUsuario));

                                                echo $nombres . " " . $apellidos;
                                            }


                                            ?></td>
                                        <td><?php

                                            if ($value->ID_EMPRESA != '') {
                                                echo $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $value->ID_EMPRESA);
                                            } else {
                                                $empresa = $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "ID_EMPRESA", "ID", $value->SOLICITUD);
                                                $empresa = $this->FunctionsGeneral->getFieldFromTableNotId("COT_TARIFAEMPRESA", "ID_EMPRESA", "ID", $empresa);
                                                echo $this->EsaludModel->getFieldFromTableNotIdFieldsFromEsalud("T_APB", "NOM_APB", "ID_APB", $empresa);
                                            }


                                            ?></td>



                                        <td align="right"><?= $value->CONSECUTIVO; ?></td>
                                        <td><?PHP
                                            if ($value->UCREA == '') {
                                                echo $this->FunctionsGeneral->getFieldFromTableNotId("COT_SOLICITUD", "EJECUTIVO", "ID", $value->SOLICITUD);
                                            } else {
                                                echo $this->FunctionsGeneral->getFieldFromTableNotId("COT_COTIZACION", "VENDEDOR", "ID", $value->ID);
                                            }
                                            ?></td>
                                        <td align="right">
                                            <?php
                                            if ($value->ID_SEGUIMIENTO != 47) {
                                                echo $this->FunctionsGeneral->getSeguimiento($value->CONSECUTIVO, "");
                                                // echo $this->FunctionsGeneral->getFieldFromTableNotId("ADM_DETLISTA", "NOMBRE", "ID", $value->ID_SEGUIMIENTO);
                                            } else {
                                                //Busco número de autorización

                                                echo $this->FunctionsGeneral->getFieldFromTableNotId("ADM_DETLISTA", "NOMBRE", "ID", $value->ID_SEGUIMIENTO) . "<BR> <small >" .
                                                    $this->encryption->decrypt($this->FunctionsGeneral->getFieldFromTableNotIdFields(
                                                        "COT_SEGUIMIENTO",
                                                        "AUTORIZACION",
                                                        "ID_TIPOSEG",
                                                        0,
                                                        "ID_COTIZACION",
                                                        $value->ID
                                                    )) . "</small>";
                                            }

                                            ?>
                                        </td>
                                        <td><?php
                                            if ($value->FECHA_SOLICITUD_COTIZACION != null) {
                                                $dateFormat = $value->FECHA_SOLICITUD_COTIZACION;
                                                echo $dateFormat;
                                            } else {
                                                echo $value->FECHA_SOLICITUD_COTIZACION;
                                            }

                                            ?>

                                        </td>

                                        <td><?php


                                            if ($value->FECHA_SOLICITUD != null) {
                                                $dateFormat = $value->FECHA_SOLICITUD;
                                                echo $dateFormat;
                                            } else {
                                                echo $value->FECHA_SOLICITUD;
                                            }

                                            ?>

                                        </td>
                                        <td><?php

                                            if ($value->FECHA != null) {
                                                $dateFormat = $value->FECHA;
                                                echo $dateFormat;
                                            } else {
                                                echo $value->FECHA;
                                            }


                                            ?>

                                        </td>
                                        <?php


                                        $fechaActual = date("Y-m-d H:i");
                                        $fechaSolicitudCotizacion = $value->FECHA_SOLICITUD_COTIZACION;
                                        $fechaEmisionCotizacion = $value->FECHA;
                                        $result = null;
                                        $style = null;
                                        echo trafficLightStokePrice($fechaActual, $fechaSolicitudCotizacion, $fechaEmisionCotizacion);


                                        ?>
                                        <!--cierre de la celda tiempo en estado-->

                                        <!--
                                                <td align="right"><?php
                                                                    if ($value->TIPODOC != '') {
                                                                        echo "$ " . numberFormatEvolution($value->TOTAL - ($value->TOTAL * ($value->DESCUENTO / 100)));
                                                                    } else {
                                                                        echo "----";
                                                                    }



                                                                    ?></td>
                                                -->



                                    </tr>
                            <?php
                                    $i++;
                                } //end foreach
                            } //end if
                            ?>
                        </tbody>

                    </table>
                </div>
                <?php
                if ($botonesBoard != null) {
                    foreach ($botonesBoard as $value) {

                ?>
                        <a href="<?= base_url() . $value->PAGINA; ?>" class="btn btn-info btn-rounded">
                            <i class="<?= $value->ICONO ?>"></i>
                            <span class="hidden-xs"> <?= $value->NOMBRE ?></span>
                        </a>
                <?php

                    }
                } ?>
            </div>
        </div>

    </div>
</div>
<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- BEGIN PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->

<!-- Plugin JavaScript -->
<script src="<?= base_url() ?>assets/node_modules/moment/moment.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="<?= base_url() ?>assets/node_modules/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.es.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="<?= base_url() ?>assets/node_modules/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?= base_url() ?>assets/node_modules/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
    $('.input-limit-datepicker').daterangepicker({
        maxDate: '<?= $fecha; ?>',
        buttonClasses: ['btn', 'btn-sm'],
        locale: {
            "format": "YYYY/MM/DD",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "Desde",
            "toLabel": "Hasta",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "Do",
                "Lu",
                "Ma",
                "Mi",
                "Ju",
                "Vi",
                "Sa"
            ],
            "monthNames": [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            "firstDay": 1
        },
        applyClass: 'btn-info btn-rounded',
        cancelClass: 'btn-inverse btn-rounded'
    });
    $('#periodo').val('');
</script>


<!-- ============================================================== -->
<!-- END PAGE JQUERY ROUTINES -->
<!-- ============================================================== -->