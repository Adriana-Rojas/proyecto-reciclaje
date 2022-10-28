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
<!-- JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->
<!-- Librerias para gráficos -->
<link rel="stylesheet"
	href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script
	src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script
	src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>



<!-- ============================================================== -->
<!-- FIn JavaScript para pintar campos adicionales -->
<!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->



<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><i class="fa fa-bar-chart" aria-hidden="true"></i> Estad&iacute;stica del Calificador, para el rango <?= $periodo;?></h4>
				
			</div>

		</div>
	</div>
</div>
<?php
if ($informe == 1) {
    if ($preguntas != null) {
        foreach ($preguntas as $value) {
            $listadoRespuestas=$this->PollsModel->getListValueQuestionsOption($value->ID);
            ?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title"><?= $value->DESCRIPCION;?> </h4>
				<div class="row">
					<div class="col-6">
						<div id="myfirstchart<?= $value->ID;?>" style="height: 340px;"></div>
						<script>
                        	new Morris.Bar({
                            	// ID of the element in which to draw the chart.
                                element: 'myfirstchart<?= $value->ID;?>',
                                // Chart data records -- each entry in this array corresponds to a point on
                                // the chart.
                                data: [
                                    <?php
                                    if($listadoRespuestas!=null){
                                        foreach ($listadoRespuestas as $v) { 
                                            $cantidad= $this->PollsModel->getQuantityOfResponse($v->ID,$fechaInicial, $fechaFinal) ;
                                    ?>
                                	{ tipo: '<?= $v->NOMBRE;?>', value: <?=$cantidad; ?> },
                                    <?php 
                                        }
                                    }
                                    ?>
                                        	
                                ],
                                // The name of the data record attribute that contains x-values.
                                xkey: 'tipo',
                                // A list of names of data record attributes that contain y-values.
                                ykeys: ['value'],
                                // Labels for the ykeys -- will be displayed when you hover over the
                                // chart.
                                labels: ['Value']
                                });
                        </script>
					</div>
					<div class="col-6">
						<table id="dynamic-table" class="table m-t-30 table-hover ">
							<thead>
								<tr>
									<th >Respuesta</th>
									<th >Cantidad</th>
									<th >Porcentaje %</th>
								</tr>
							</thead>

							<tbody>
								<?php
                                    if($listadoRespuestas!=null){
                                        foreach ($listadoRespuestas as $v) { 
                                            $cantidad= $this->PollsModel->getQuantityOfResponse($v->ID,$fechaInicial, $fechaFinal) ;
                                            $total= $this->PollsModel->getQuantityOfQuestion($value->ID,$fechaInicial, $fechaFinal) ;
                                            if($total==0){
                                                $general=0;
                                            }else{
                                                $general=$cantidad/$total;
                                            }
                                    ?>
								<tr>
									<td ><?= $v->NOMBRE;?></td>
									<td ><?=$cantidad; ?></td>
									<td ><?= numberFormatEvolution( round($general,2)*100); ?></td>
								</tr>
								<?php 
                                        }
                                    }
                                    ?>
							</tbody>
						</table>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>


<?php
        }
    }
}
?>

<a href="<?= base_url()?>/PollReportStatistics/board" class="btn  btn-primary btn-rounded pull-left waves-effect waves-light m-r-10"> 
			                                                <i class="fa fa-arrow-left"></i>
			                                                <span class="hidden-xs"> Retornar</span>
			                                            </a>
<br/><br/><br/>

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->


