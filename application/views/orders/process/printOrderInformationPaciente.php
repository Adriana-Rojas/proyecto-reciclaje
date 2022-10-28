<?php

/**
 *************************************************************************
 *************************************************************************
 Creado por:                 	Juan Carlos Escobar Baquero
 Correo electr�nico:          	jcescobarba@gmail.com
 Creaci�n:                    	27/02/2018
 Modificaci�n:                	2019/11/06
 Prop�sito:						P�gina Web.
 *************************************************************************
 *************************************************************************
 ******************** BOGOT� COLOMBIA 2018 *******************************
 */
defined('BASEPATH') or exit('No direct script access allowed');

?>
<!-- ============================================================== -->
<!-- JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- End JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->
<!-- ============================================================================================================================ -->
<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="row">
  <div class="col-md-12">
    <div class="card card-body printableArea">
      <img src="<?= base_url() ?>/assets/images/logoCirec.png" width="292 px" height="96 px">
      <small style="text-align:right; "> <?= $this->FunctionsGeneral->getFieldFromTableNotId("ADM_PARAMETROS", "COD_ORDENES", "ID", 1); ?></small>
      <hr>
      <div class="row">
        <div class="col-md-12">
          <div class="pull-right text-right">
            <address>
              <p class="m-t-30"><b>Generaci&oacute;n de las &oacute;rdenes :</b> <i class="fa fa-calendar"></i> <?= $fechaOrden; ?></p>

            </address>
          </div>

        </div>
      </div>
      <?php
      foreach ($paciente as $value) {
        $datos = selectPatienInformationFromOrder($this->session->userdata('encOrden'), $this);

        $responsable = $datos[0];

      ?>

        <div class="row">
          <div class="col-md-12">
            <div class="pull-left">
              <address>
                <h3> &nbsp;<b class="text-danger"><?= $value->PRI_NOM_PCTE, " ", $value->SEG_NOM_PCTE, " ", $value->PRI_APELL_PCTE, " ", $value->SEG_APELL_PCTE; ?></b></h3>
                <p class="text-muted m-l-5"><strong>Documento de identidad </strong> <?= $value->TP_ID_PCTE, " ", $value->NUM_ID_PCTE; ?>
                  <br /> <strong>Registro </strong> <?= $value->ID_PCTE; ?>
                  <!--<br/> <strong> Edad </strong>//intervaloTiempo($value->FECH_NCTO_PCTE,cambiaHoraServer(2),31104000);?> A&ntilde;os-->
                  <br /> <strong> Edad </strong>28 A&ntilde;os
                  <br /> <strong>Responsable </strong>NUEVA EMPRESA PROMOTORA DE SALUD S A<?= $responsable; ?>

              </address>
            </div>
          </div>
        </div>
      <?php
      } ?>
      <div class="row">
        <div class="col-md-12">

          <head>
            <meta name="title" content="VT-RE-AEK-01 ACTA DE ENTREGA KIT PRUEBAS" />
            <style type="text/css">
              html {
                font-family: Calibri, Arial, Helvetica, sans-serif;
                font-size: 11pt;
                background-color: white
              }

              a.comment-indicator:hover+div.comment {
                background: #ffd;
                position: absolute;
                display: block;
                border: 1px solid black;
                padding: 0.5em
              }

              a.comment-indicator {
                background: red;
                display: inline-block;
                border: 1px solid black;
                width: 0.5em;
                height: 0.5em
              }

              div.comment {
                display: none
              }

              table {
                border-collapse: collapse;
                page-break-after: always
              }

              .gridlines td {
                border: 1px dotted black
              }

              .gridlines th {
                border: 1px dotted black
              }

              .b {
                text-align: center
              }

              .e {
                text-align: center
              }

              .f {
                text-align: right
              }

              .inlineStr {
                text-align: left
              }

              .n {
                text-align: right
              }

              .s {
                text-align: left
              }

              td.style0 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style0 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style1 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style1 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style2 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style2 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style3 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style3 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style4 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style4 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style5 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style5 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style6 {
                vertical-align: top;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style6 {
                vertical-align: top;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style7 {
                vertical-align: top;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style7 {
                vertical-align: top;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style8 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style8 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style9 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style9 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style10 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style10 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style11 {
                vertical-align: bottom;
                text-align: left;
                padding-left: 0px;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style11 {
                vertical-align: bottom;
                text-align: left;
                padding-left: 0px;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style12 {
                vertical-align: bottom;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style12 {
                vertical-align: bottom;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style13 {
                vertical-align: bottom;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style13 {
                vertical-align: bottom;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style14 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style14 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style15 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style15 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style16 {
                vertical-align: bottom;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style16 {
                vertical-align: bottom;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style17 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style17 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style18 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style18 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style19 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style19 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style20 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style20 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style21 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: 1px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style21 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: 1px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style22 {
                vertical-align: top;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style22 {
                vertical-align: top;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style23 {
                vertical-align: bottom;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style23 {
                vertical-align: bottom;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style24 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style24 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style25 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style25 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style26 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style26 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style27 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style27 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style28 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style28 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style29 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style29 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style30 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style30 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style31 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style31 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style32 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style32 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style33 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style33 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style34 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style34 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style35 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style35 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style36 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style36 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style37 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style37 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style38 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style38 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style39 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style39 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style40 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style40 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style41 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style41 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style42 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style42 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style43 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style43 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style44 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style44 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style45 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style45 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style46 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style46 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style47 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style47 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style48 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style48 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style49 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style49 {
                vertical-align: top;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style50 {
                vertical-align: top;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style50 {
                vertical-align: top;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style51 {
                vertical-align: top;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style51 {
                vertical-align: top;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style52 {
                vertical-align: top;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style52 {
                vertical-align: top;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style53 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style53 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style54 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style54 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style55 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style55 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style56 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style56 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style57 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style57 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style58 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style58 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style59 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style59 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style60 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style60 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style61 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style61 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style62 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style62 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style63 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style63 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style64 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style64 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style65 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style65 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style66 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style66 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style67 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style67 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style68 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style68 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style69 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style69 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style70 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style70 {
                vertical-align: top;
                text-align: left;
                padding-left: 27px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style71 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style71 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style72 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style72 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style73 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style73 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style74 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style74 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style75 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style75 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style76 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style76 {
                vertical-align: middle;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style77 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style77 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style78 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style78 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style79 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style79 {
                vertical-align: middle;
                text-align: center;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                font-weight: bold;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style80 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style80 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style81 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style81 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style82 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style82 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style83 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style83 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style84 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style84 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style85 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style85 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style86 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style86 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style87 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style87 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style88 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style88 {
                vertical-align: middle;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style89 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              th.style89 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                font-weight: bold;
                color: #000000;
                background-color: white
              }

              td.style90 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style90 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style91 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style91 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style92 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style92 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: 2px solid #000000 !important;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style93 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style93 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style94 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style94 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style95 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style95 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style96 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style96 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: 2px solid #000000 !important;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style97 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style97 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style98 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              th.style98 {
                vertical-align: top;
                text-align: left;
                padding-left: 36px;
                border-bottom: 2px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 2px solid #000000 !important;
                color: #000000;
                background-color: white
              }

              td.style99 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style99 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style100 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style100 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style101 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style101 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style102 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style102 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style103 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style103 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style104 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style104 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style105 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              th.style105 {
                vertical-align: bottom;
                text-align: center;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                color: #000000;
                background-color: white
              }

              td.style106 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: 1px solid #000000 !important;
                border-left: 1px solid #000000 !important;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style106 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: 1px solid #000000 !important;
                border-left: 1px solid #000000 !important;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style107 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: 1px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style107 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: 1px solid #000000 !important;
                border-left: none #000000;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style108 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: 1px solid #000000 !important;
                border-left: none #000000;
                border-right: 1px solid #000000 !important;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style108 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: 1px solid #000000 !important;
                border-left: none #000000;
                border-right: 1px solid #000000 !important;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style109 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 1px solid #000000 !important;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style109 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: 1px solid #000000 !important;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style110 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style110 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style111 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 1px solid #000000 !important;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style111 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: none #000000;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 1px solid #000000 !important;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style112 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: 1px solid #000000 !important;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style112 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: 1px solid #000000 !important;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style113 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style113 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: none #000000;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              td.style114 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 1px solid #000000 !important;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              th.style114 {
                vertical-align: top;
                text-align: left;
                padding-left: 0px;
                border-bottom: 1px solid #000000 !important;
                border-top: none #000000;
                border-left: none #000000;
                border-right: 1px solid #000000 !important;
                text-decoration: underline;
                color: #000000;
                background-color: white
              }

              table.sheet0 col.col0 {
                width: 8.13333324pt
              }

              table.sheet0 col.col1 {
                width: 22.36666641pt
              }

              table.sheet0 col.col2 {
                width: 20.3333331pt
              }

              table.sheet0 col.col3 {
                width: 22.36666641pt
              }

              table.sheet0 col.col4 {
                width: 23.04444418pt
              }

              table.sheet0 col.col5 {
                width: 54.89999937pt
              }

              table.sheet0 col.col6 {
                width: 67.09999923pt
              }

              table.sheet0 col.col7 {
                width: 16.26666648pt
              }

              table.sheet0 col.col8 {
                width: 57.61111045pt
              }

              table.sheet0 col.col9 {
                width: 65.74444369pt
              }

              table.sheet0 col.col10 {
                width: 27.1111108pt
              }

              table.sheet0 col.col11 {
                width: 25.07777749pt
              }

              table.sheet0 col.col12 {
                width: 26.43333303pt
              }

              table.sheet0 col.col13 {
                width: 23.72222195pt
              }

              table.sheet0 col.col14 {
                width: 25.07777749pt
              }

              table.sheet0 col.col15 {
                width: 27.1111108pt
              }

              table.sheet0 col.col16 {
                width: 27.1111108pt
              }

              table.sheet0 col.col17 {
                width: 27.1111108pt
              }

              table.sheet0 col.col18 {
                width: 42pt
              }

              table.sheet0 tr {
                height: 13.636363636364pt
              }

              table.sheet0 tr.row0 {
                height: 13.5pt
              }

              table.sheet0 tr.row1 {
                height: 15pt
              }

              table.sheet0 tr.row2 {
                height: 17.25pt
              }

              table.sheet0 tr.row3 {
                height: 21pt
              }

              table.sheet0 tr.row4 {
                height: 21pt
              }

              table.sheet0 tr.row9 {
                height: 12.75pt
              }

              table.sheet0 tr.row13 {
                height: 74.25pt
              }

              table.sheet0 tr.row14 {
                height: 16.5pt
              }

              table.sheet0 tr.row15 {
                height: 12.75pt
              }

              table.sheet0 tr.row41 {
                height: 13.5pt
              }

              table.sheet0 tr.row45 {
                height: 16.5pt
              }

              table.sheet0 tr.row49 {
                height: 147.75pt
              }

              table.sheet0 tr.row50 {
                height: 24.75pt
              }

              table.sheet0 tr.row51 {
                height: 12pt;
                display: none;
                visibility: hidden
              }

              table.sheet0 tr.row52 {
                height: 1.5pt
              }

              table.sheet0 tr.row53 {
                height: 25.5pt
              }

              table.sheet0 tr.row54 {
                height: 13.5pt
              }

              table.sheet0 tr.row55 {
                height: 21.75pt
              }

              table.sheet0 tr.row56 {
                height: 19.5pt
              }

              table.sheet0 tr.row57 {
                height: 18.75pt
              }

              table.sheet0 tr.row58 {
                height: 15.75pt
              }

              table.sheet0 tr.row59 {
                height: 15.75pt
              }

              table.sheet0 tr.row67 {
                height: 13.5pt
              }

              table.sheet0 tr.row68 {
                height: 33pt
              }

              table.sheet0 tr.row71 {
                height: 13.5pt
              }

              table.sheet0 tr.row72 {
                height: 12.75pt
              }

              table.sheet0 tr.row80 {
                height: 13.5pt
              }
            </style>
          </head>

          <body>
            <table width=110% border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0">
              <col class="col0">
              <col class="col1">
              <col class="col2">
              <col class="col3">
              <col class="col4">
              <col class="col5">
              <col class="col6">
              <col class="col7">
              <col class="col8">
              <col class="col9">
              <col class="col10">
              <col class="col11">
              <col class="col12">
              <col class="col13">
              <col class="col14">
              <col class="col15">
              <col class="col16">
              <col class="col17">
              <col class="col18">
              <tbody>
                <tr class="row0">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row1">
                  <td class="column0 style44 null style52" colspan="5" rowspan="4">
                    <div style="position: relative;"><img src="<?= base_url() ?>/assets/images/logoCirec.png" width="100%"  /></div>
                  </td>
                  <td class="column5 style32 s style40" colspan="6" rowspan="4">CENTRO INTEGRAL DE REHABILITACION COLOMBIA. CIREC <br />
                    &nbsp;ACTA DE ENTREGA Y CERTIFICADO DE GARANTIA<br />
                    GESTIÓN DE LOGÍSTICA</td>
                  <td class="column11 style24 s style27" colspan="3" rowspan="2">Código: </td>
                  <td class="column14 style24 s style27" colspan="2" rowspan="2">FO-11-22</td>
                  <td class="column16 style3 null"></td>
                  <td class="column17 style3 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row2">
                  <td class="column16 style3 null"></td>
                  <td class="column17 style3 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row3">
                  <td class="column11 style28 s style29" colspan="3">Versión:</td>
                  <td class="column14 style28 n style29" colspan="2">3</td>
                  <td class="column16 style3 null"></td>
                  <td class="column17 style3 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row4">
                  <td class="column11 style28 s style29" colspan="3">Fecha de Emisión:</td>
                  <td class="column14 style30 n style31" colspan="2">4/2/2018</td>
                  <td class="column16 style9 null"></td>
                  <td class="column17 style9 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row5">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row6">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style99 s style99" colspan="9">EL CENTRO INTEGRAL DE REHABILITACION COLOMBIA hace entrega con fecha </td>
                  <td class="column10 style22 null style22" colspan="3"></td>
                  <td class="column13 style23 s style23" colspan="3">&nbsp;&nbsp;&nbsp;al usuario (a)</td>
                  <td class="column16 style1 null"></td>
                  <td class="column17 style1 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row7">
                  <td class="column0 style6 null"></td>
                  <td class="column1 style104 null style105" colspan="6"></td>
                  <td class="column7 style99 s style99" colspan="3">identificado con tipo de documento </td>
                  <td class="column10 style10 s">R.C</td>
                  <td class="column11 style18 null"></td>
                  <td class="column12 style10 s">T.I. </td>
                  <td class="column13 style15 null"></td>
                  <td class="column14 style12 s">C.C</td>

                  <td class="column17 style8 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row8">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style16 s">CE</td>
                  <td class="column2 style11 null"></td>
                  <td class="column3 style13 s">P.A</td>
                  <td class="column4 style11 null"></td>
                  <td class="column5 style13 s">&nbsp;con numero </td>
                  <td class="column6 style21 null"></td>
                  <td class="column7 style19 s">de </td>
                  <td class="column8 style20 null"></td>
                  <td class="column9 style99 s style99" colspan="7">El siguiente dispositivo médico / ayuda de movilidad:</td>
                  <td class="column16 style4 null"></td>
                  <td class="column17 style4 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row9">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style7 null"></td>
                  <td class="column2 style7 null"></td>
                  <td class="column3 style7 null"></td>
                  <td class="column4 style7 null"></td>
                  <td class="column5 style7 null"></td>
                  <td class="column6 style7 null"></td>
                  <td class="column7 style7 null"></td>
                  <td class="column8 style7 null"></td>
                  <td class="column9 style7 null"></td>
                  <td class="column10 style7 null"></td>
                  <td class="column11 style7 null"></td>
                  <td class="column12 style7 null"></td>
                  <td class="column13 style7 null"></td>
                  <td class="column14 style7 null"></td>
                  <td class="column15 style7 null"></td>
                  <td class="column16 style7 null"></td>
                  <td class="column17 style7 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row10">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style106 null style114" colspan="15" rowspan="4"></td>

                  <td class="column17 style8 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row11">
                  <td class="column0">&nbsp;</td>

                  <td class="column17 style8 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row12">
                  <td class="column0">&nbsp;</td>

                  <td class="column17 style8 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row13">
                  <td class="column0">&nbsp;</td>

                  <td class="column17 style8 null"></td>
                  <td class="column18">&nbsp;</td>
                </tr>
                <tr class="row14">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style89 null style89" colspan="5"></td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row15">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style71 s style79" colspan="4" rowspan="27">VIGENCIA DE LA GARANTÍA:</td>
                  <td class="column5 style90 s style98" colspan="10" rowspan="27">• El período de garantía del dispositivo medico (Prótesis, sillas de ruedas y ayudas de movilidad) inicia desde la firma del Acta de entrega/certificado de garantía.<br />
                    • El tiempo estimado de garantía depende exclusivamente del tipo de elemento entregado y de los componentes utilizados, estos serán determinados por el técnico Preterista, Órtesista o de elementos de movilidad, de acuerdo a lo formulado por el Médico tratante.<br />
                    • Es de aclarar que la garantía aplica después de ser revisada por el técnico y sea aceptada como una garantía.<br />
                    <br />
                    El período de garantía de los elementos entregados:<br />
                    <br />
                    <br />
                  </td>
                </tr>
                <tr class="row16">
                  <td class="column0">&nbsp;</td>
                  <td class="column16">&nbsp;</td>
                  <td class="column17">&nbsp;</td>
                  <td class="column18 style17 null"></td>
                </tr>
                <tr class="row17">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row18">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row19">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row20">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row21">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row22">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row23">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row24">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row25">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row26">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row27">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row28">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row29">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row30">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row31">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row32">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row33">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row34">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row35">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row36">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row37">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row38">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row39">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row40">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row41">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row42">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style71 s style79" colspan="4" rowspan="4">CUBRIMIENTO DE LA GARANTIA:</td>
                  <td class="column5 style80 s style88" colspan="10" rowspan="4">• Cuando en sus condiciones normales de uso presente fallas.<br />
                    • Por defectos de fabricación.<br />
                    • Por defectos de fabricación o deterioro prematuro.</td>
                </tr>
                <tr class="row43">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row44">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row45">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row46">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style71 s style79" colspan="4" rowspan="4">CAUSAS DE ANULACIÓN DE LA GARANTÍA:</td>
                  <td class="column5 style80 s style88" colspan="10" rowspan="4">• Cuando el periodo de garantía haya expirado.<br />
                    • Cuando se utilice el dispositivo médico bajo condiciones para las cuales no fue fabricado y adaptado, o no se tengan en cuenta las recomendaciones de uso.<br />
                    • Cuando los dispositivos médicos han sido modificados por personal no autorizado por CIREC.<br />
                    • Cuando se presenten alteraciones de tipo médico, variaciones antropométricas, de rendimiento o condiciones de discapacidad no presentes al inicio de la vigencia de la garantía y que limite o altere la utilización del dispositivo médico.<br />
                    • Cuando el serial del dispositivo medico recibido por garantía no coincida con el entregado.<br />
                    • Abandono injustificado del proceso de rehabilitación, dejando el dispositivo médico en la institución o llevándolo por más de tres (3) meses en calidad de préstamo.<br />
                    • Perjuicios, pérdidas o daños del dispositivo medico causados intencionalmente. <br />
                  </td>
                </tr>
                <tr class="row47">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row48">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row49">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row50">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row51">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row52">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row53">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row54">
                  <td class="column0 style44 null style52" colspan="5" rowspan="4">
                    <div style="position: relative;"><img style="position: absolute; z-index: 1; left: 0px; top: 14px; width: 129px; height: 65px;" src="zip:///home/CloudConvertio/tmp/in_work/a65b577c4f9d45c0c6f11c650e283462.xlsx#xl/media/image4.png" border="0" /></div>
                  </td>
                  <td class="column5 style32 s style40" colspan="6" rowspan="4">CENTRO INTEGRAL DE REHABILITACION DE COLOMBIA. CIREC <br />
                    CERTIFICADO DE GARANTIA<br />
                    GESTIÓN DE LOGÍSTICA</td>
                  <td class="column11 style24 s style27" colspan="3" rowspan="2">Código: </td>
                  <td class="column14 style24 s style27" colspan="2" rowspan="2">FO-11-22</td>
                  <td class="column16 style3 null"></td>
                </tr>
                <tr class="row55">
                  <td class="column16 style3 null"></td>
                </tr>
                <tr class="row56">
                  <td class="column11 style28 s style29" colspan="3">Versión:</td>
                  <td class="column14 style28 n style29" colspan="2">3</td>
                  <td class="column16 style3 null"></td>
                </tr>
                <tr class="row57">
                  <td class="column11 style28 s style29" colspan="3">Fecha de Emisión:</td>
                  <td class="column14 style30 n style31" colspan="2">4/2/2018</td>
                  <td class="column16 style9 null"></td>
                </tr>
                <tr class="row58">
                  <td class="column0 style5 null"></td>
                  <td class="column1 style5 null"></td>
                  <td class="column2 style5 null"></td>
                  <td class="column3 style5 null"></td>
                  <td class="column4 style5 null"></td>
                  <td class="column5 style2 null"></td>
                  <td class="column6 style2 null"></td>
                  <td class="column7 style2 null"></td>
                  <td class="column8 style2 null"></td>
                  <td class="column9 style2 null"></td>
                  <td class="column10 style2 null"></td>
                  <td class="column11 style3 null"></td>
                  <td class="column12 style3 null"></td>
                  <td class="column13 style3 null"></td>
                  <td class="column14 style9 null"></td>
                  <td class="column15 style9 null"></td>
                  <td class="column16 style9 null"></td>
                </tr>
                <tr class="row59">
                  <td class="column0 style5 null"></td>
                  <td class="column1 style5 null"></td>
                  <td class="column2 style5 null"></td>
                  <td class="column3 style5 null"></td>
                  <td class="column4 style5 null"></td>
                  <td class="column5 style2 null"></td>
                  <td class="column6 style2 null"></td>
                  <td class="column7 style2 null"></td>
                  <td class="column8 style2 null"></td>
                  <td class="column9 style2 null"></td>
                  <td class="column10 style2 null"></td>
                  <td class="column11 style3 null"></td>
                  <td class="column12 style3 null"></td>
                  <td class="column13 style3 null"></td>
                  <td class="column14 style9 null"></td>
                  <td class="column15 style9 null"></td>
                  <td class="column16 style9 null"></td>
                </tr>
                <tr class="row60">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style53 s style61" colspan="4" rowspan="8">EXCLUSIONES Y LIMITACIONES DE LA GARANTÍA:</td>
                  <td class="column5 style62 s style70" colspan="10" rowspan="8">• Recubrimientos cosméticos.<br />
                    • Encaje (Socket).<br />
                    • Componentes susceptibles de desgaste o deterioro de sus condiciones debido al uso para el cual fue formulado (Guayas, bujes, extensores en caucho, Correas, cinturones, velcro, fundas de neopreno, espumas y medias).<br />
                    • Componentes susceptibles de desgaste o deterioro de sus condiciones debido al uso para el cual fue formulado (Correas, cinturones, velcro).<br />
                  </td>
                </tr>
                <tr class="row61">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row62">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row63">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row64">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row65">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row66">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row67">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row68">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style53 s style61" colspan="4" rowspan="4">EVENTOS NO CUBIERTOS:</td>
                  <td class="column5 style62 s style70" colspan="10" rowspan="4">• Eventos fortuitos no previsibles por la institución o por el usuario (desastres naturales, pérdida o robo).<br />
                    • Corrosión <br />
                    • Producida por la exposición a ambientes húmedos, agentes químicos y secreciones corporales como el sudor.<br />
                  </td>
                </tr>
                <tr class="row69">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row70">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row71">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row72">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style53 s style61" colspan="4" rowspan="9">CONDICIONES GENERALES</td>
                  <td class="column5 style62 s style70" colspan="10" rowspan="9">• El usuario tiene derecho a tres (3) revisiones del dispositivo médico durante el periodo de vigencia de la garantía, sin costo alguno.<br />
                    • Si el elemento objeto de la garantía es susceptible de reparación, ésta se efectuará; de lo contrario, se hará la sustitución del elemento previo concepto técnico.<br />
                    • En los casos en que la reparación de algún componente del dispositivo médico no pueda ser efectuada en CIREC, ésta será enviada al fabricante. con un tiempo aproximado de respuesta de cuarenta y cinco (45) días.<br />
                    • Para elementos importados como pies y rodillas, el cambio se hará sólo una vez durante la vigencia de la garantía. <br />
                  </td>
                </tr>
                <tr class="row73">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row74">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row75">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row76">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row77">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row78">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row79">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row80">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row81">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row82">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style100 s style101" colspan="14" rowspan="5">Nota: Si el usuario necesita hacer efectiva su garantía debe comunicarse al área de operaciones al número 7953600 ext 201 a la 206 o Línea Nacional Gratuita 018000423633–y solicitar cita de revisión del producto por garantía (debe aclarar que se trata de una revisión por garantía). El día de la cita programada debe presentar este documento.<br />
                    <br />
                    Los tiempos de análisis por parte de las casas matriz para informar si procede o no garantía son:<br />
                  </td>
                </tr>
                <tr class="row83">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row84">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row85">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row86">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row87">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2 style0 null">
                    <div style="position: relative;"><img style="position: absolute; z-index: 1; left: 13px; top: 5px; width: 317px; height: 82px;" src="zip:///home/CloudConvertio/tmp/in_work/a65b577c4f9d45c0c6f11c650e283462.xlsx#xl/media/image3.png" border="0" /></div>
                  </td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row88">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row89">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row90">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row91">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row92">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row93">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row94">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style100 s style102" colspan="14" rowspan="4">Recibo explicación de las condiciones de manejo y uso de los elementos y firmo el documento aceptando a satisfacción el elemento entregado.</td>
                </tr>
                <tr class="row95">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row96">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row97">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row98">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style103 s style101" colspan="8">ACUDIENTE _______ PACIENTE ______</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row99">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row100">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row101">
                  <td class="column0">&nbsp;</td>
                  <td class="column1">&nbsp;</td>
                  <td class="column2">&nbsp;</td>
                  <td class="column3">&nbsp;</td>
                  <td class="column4">&nbsp;</td>
                  <td class="column5">&nbsp;</td>
                  <td class="column6">&nbsp;</td>
                  <td class="column7">&nbsp;</td>
                  <td class="column8">&nbsp;</td>
                  <td class="column9">&nbsp;</td>
                  <td class="column10">&nbsp;</td>
                  <td class="column11">&nbsp;</td>
                  <td class="column12">&nbsp;</td>
                  <td class="column13">&nbsp;</td>
                  <td class="column14">&nbsp;</td>
                </tr>
                <tr class="row102">
                  <td class="column0">&nbsp;</td>
                  <td class="column1 style100 s style101" colspan="14" rowspan="5">FIRMA USUARIO _____________________________________________<br />
                    NOMBRE COMPLETO _____________________________________________ <br />
                    DOCUMENTO IDENTIFICACION _________________________________________ <br />
                    DIRECCION ________________________ TELEFONO ______________________<br />
                  </td>
                </tr>
                <tr class="row103">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row104">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row105">
                  <td class="column0">&nbsp;</td>
                </tr>
                <tr class="row106">
                  <td class="column0">&nbsp;</td>
                </tr>
              </tbody>
            </table>
        </div>
        <div class="col-md-12">
          <div class="pull-right m-t-30 text-right">
            <p>&nbsp;</p>
            <p>&nbsp; </p>
            <hr>
            <h4>Jorge Morales</h4>
            <h6><?= $especialidad; ?></h6>
          </div>
          <div class="clearfix"></div>

        </div>
      </div>
      <hr>
      <div class="row text-center">
        <div class="col-md-12">
          <?= $empresa; ?>
        </div>

      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <small><i class='fa fa-map-marker '></i> <?= $direccion; ?></small>
        </div>
        <div class="col-md-4">
          <small><i class='fa fa-phone-square '></i> <?= $telefono; ?></small>
        </div>
        <div class="col-md-4">
          <small><i class='fa fa-envelope '></i> <?= $correo; ?></small>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="text-right">
  <a href="<?= base_url() . $returnPage ?>" class="btn btn-info btn-rounded">
    <i class="fa fa-user"></i>
    <span class="hidden-xs"> Nuevo paciente</span>
  </a>

  <button id="print" class="btn btn-default btn-rounded" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
</div>
<br>
<script src="<?= base_url() ?>/assets/dist/js/pages/jquery.PrintArea.js" type="text/JavaScript"></script>
<script>
  $(document).ready(function() {
    $("#print").click(function() {
      var mode = 'iframe'; //popup
      var close = mode == "popup";
      var options = {
        mode: mode,
        popClose: close
      };
      $("div.printableArea").printArea(options);
    });
  });
</script>


<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->