{include file="vista.general/index.css.tpl"}
<!--begin:: Datos estadísticos -->
<div class="m-portlet m-portlet--creative m-portlet--first m-portlet--bordered-semi">
	<div class="m-portlet__head">
		<div class="m-portlet__head-caption">
			<div class="m-portlet__head-title">
				<span class="m-portlet__head-icon m--hide">
					<i class="flaticon-statistics"></i>
				</span>
				<h3 class="m-portlet__head-text">
					A continuación se muestra información sobre especies, cultivos y documentos.
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
									<th colspan="2">Información de Especies</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">Total especies</th>
									<td class="text-center">{$datos_especies.total_especies}</td>
								</tr>
								<tr>
									<th scope="row">Total especies silvestres</th>
									<td class="text-center">{$datos_especies.total_especie_silvestre}</td>
								</tr>
								<tr>
									<th scope="row">Total especies nativas</th>
									<td class="text-center">{$datos_especies.total_especie_cultivado}</td>
								</tr>
								<tr>
									<th scope="row">Total especies gestión actual</th>
									<td class="text-center">{$datos_especies.total_especies_actual}</td>
								</tr>
								<tr>
									<th scope="row">Porcentaje de especies gestión actual</th>
									<td class="text-center">{$datos_especies.porcentaje_especies_actual}%</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="m-widget1__item">
						<table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-sm">
							<thead>
								<tr>
									<th colspan="2">Información de Cultivos</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">Total cultivos</th>
									<td class="text-center">{$datos_cultivos.total_cultivos}</td>
								</tr>
								<tr>
									<th scope="row">Superficie total cultivada</th>
									<td class="text-center">{$datos_cultivos.superficie_total} Has</td>
								</tr>
								<tr>
									<th scope="row">N° de departamentos involucrados</th>
									<td class="text-center">{$datos_cultivos.total_deptos}</td>
								</tr>
								<tr>
									<th scope="row">Total cultivos gestión actual</th>
									<td class="text-center">{$datos_cultivos.total_cultivos_actual}</td>
								</tr>
								<tr>
									<th scope="row">Porcentaje de cultivos gestión actual</th>
									<td class="text-center">{$datos_cultivos.porcentaje_cultivos_actual}%</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="m-widget1__item">
						<table class="table table-bordered m-table m-table--border-brand m-table--head-bg-brand table-sm">
							<thead>
								<tr>
									<th colspan="2">Información de Documentos</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">Total documentos</th>
									<td class="text-center">{$datos_docs.total_docs}</td>
								</tr>
								<tr>
									<th scope="row">Total documentos gestión actual</th>
									<td class="text-center">{$datos_docs.total_docs_actual}</td>
								</tr>
								<tr>
									<th scope="row">Porcentaje de documentos gestión actual</th>
									<td class="text-center">{$datos_docs.porcentaje_docs_actual}%</td>
								</tr>
							</tbody>
						</table>
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
{include file="vista.general/index.js.tpl"}