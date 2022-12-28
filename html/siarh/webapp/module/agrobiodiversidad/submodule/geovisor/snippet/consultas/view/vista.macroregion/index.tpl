{include file="vista.macroregion/index.css.tpl"}
<!--begin:: Datos estadísticos -->
<div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<span class="m-portlet__head-icon m--hide">
					<i class="flaticon-statistics"></i>
				</span>
				<h3 class="m-portlet__head-text">
					A continuación se muestra información sobre la cantidad y superficie de cultivos de especies por macroregión.
				</h3>
				<h2 class="m-portlet__head-label m-portlet__head-label--warning">
					<span id="titulo_consulta">Información Reporte</span>
				</h2>
			</div>			
		</div>
	</div>

	<div class="m-portlet__body  m-portlet__body--no-padding" id="panelReporte">
		<div class="row m-row--no-padding m-row--col-separator-xl">			
			<div class="col-xl-12">
				<!--begin:: Widgets/Stats2-1 -->
				<div class="m-widget1">
					<div class="m-widget1__item">
						<table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-sm">
							<thead>
								<tr>
									<th colspan="3">Cultivo de especies por macroregión</th>
								</tr>
							</thead>
							<tbody>
								{foreach key=clave item=valor from=$datos_macroregion}
								<tr>
									<td class="text-left">{$valor.macroregion}</td>
									<td class="text-left">{$valor.categoria}</td>
									<td class="text-center">{$valor.total}</td>
								</tr>
								{/foreach}
							</tbody>
						</table>
					</div>

					<div class="m-widget1__item">
						<div class="row m-row--no-padding">
							<div class="col-md-6 col-lg-12 text-left">
								<p>Especies silvestres y especies cultivadas</p>
								<canvas id="macroregionChart" width="auto" height="180"></canvas>
							</div>
						</div>
					</div>

					<div class="m-widget1__item">
						<table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-sm">
							<thead>
								<tr>
									<th colspan="3">Superficie cultivado de especies por macroregión</th>
								</tr>
							</thead>
							<tbody>
								{foreach key=clave item=valor from=$datos_macroregion}
								<tr>
									<td class="text-left">{$valor.macroregion}</td>
									<td class="text-left">{$valor.categoria}</td>
									<td class="text-right">{$valor.total_superficie} Has.</td>
								</tr>
								{/foreach}
							</tbody>
						</table>
					</div>

					<div class="m-widget1__item">
						<div class="row m-row--no-padding">
							<div class="col-md-6 col-lg-12 text-left">
								<p>Superficie especies silvestres y especies cultivadas</p>
								<canvas id="macroregionSupChart" width="auto" height="180"></canvas>
							</div>
						</div>
					</div>

					<div class="m-widget1__item">
						<table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-sm">
							<thead>
								<tr>
									<th colspan="2">Superficie especies silvestres y especies cultivadas</th>
								</tr>
							</thead>
							<tbody>
								{foreach key=clave item=valor from=$datos_macroregion_especie}
								<tr>
									<td class="text-left">{$valor.especie}</td>
									<td class="text-right">{$valor.total_superficie} Has.</td>
								</tr>
								{/foreach}
							</tbody>
						</table>
					</div>

					<div class="m-widget1__item">
						<div class="row m-row--no-padding">
							<div class="col-md-6 col-lg-12 text-left">
								<p>Superficie especies silvestres y especies cultivadas</p>
								<canvas id="macroregionEspecieChart" width="auto" height="180"></canvas>
							</div>
						</div>
					</div>

					<div class="m-widget1__item">
						<button class="btn btn-default" id="btnImprimirReporte">Imprimir</button>
					</div>
				</div>
				<!--end:: Widgets/Stats2-1 -->
			</div>
		</div>
	</div>
</div>
<!--end:: Datos estadísticos -->
{include file="vista.macroregion/index.js.tpl"}