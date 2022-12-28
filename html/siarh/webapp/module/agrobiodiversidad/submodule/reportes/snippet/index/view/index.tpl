{include file="index.css.tpl"}
<!--begin::Portlet-->
<div class="m-portlet m-portlet--tabs">
	<div class="m-portlet__head">
		<div class="m-portlet__head-tools">
			<ul class="nav nav-tabs m-tabs-line m-tabs-line--primary m-tabs-line--2x" role="tablist">
				<li class="nav-item m-tabs__item">
					<a class="nav-link m-tabs__link active show" data-toggle="tab" href="#m_tabs_6_1" role="tab" aria-selected="true">
						<i class="la la-file"></i>&nbsp;Reportes
					</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="m-portlet__body">
		<div class="tab-content">
			<div class="tab-pane active show" id="m_tabs_6_1" role="tabpanel">
				<form id="formMain" autocomplete="off">
					<div class="row">
						<div class="col-lg-3">
							<div class="form-group m-form__group">
								<label for="cboTipoId">Tipo de reporte</label>
								<select class="form-control select2" id="cboTipoId" required>
									<option value="">--Seleccione una opción--</option>
									<option value="1">Reporte Técnico</option>
									<option value="2">Reporte General</option>
									<option value="3">Reporte de Metas</option>
								</select>
							</div>
						</div>
						<div class="col-lg-9" id="pnlProyecto">
							<div class="form-group m-form__group">
								<label for="cboProyId">Proyecto</label>
								<select class="form-control select2" name="proy_id" id="cboProyId" required>
									<option value="">--Seleccione una opción--</option>
									{html_options options=$cataobj.proyectos selected=''}
								</select>
							</div>
						</div>
					</div>
					<div class="row" id="pnlFechas">
						<div class="col-lg-3">
							<div class="form-group m-form__group">
								<label for="txtFechaInicio">Desde fecha</label>
								<input type="date" class="form-control" name="fecha_inicio" id="txtFechaInicio" placeholder="Ingrese desde fecha">
							</div>
						</div>
						<div class="col-lg-3">
							<div class="form-group m-form__group">
								<label for="txtFechaFinal">Hasta fecha</label>
								<input type="date" class="form-control" name="fecha_final" id="txtFechaFinal" placeholder="Ingrese hasta fecha">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="m-form__actions">
								<button type="submit" class="btn btn-primary">Generar reporte</button>
								<button type="reset" class="btn btn-secondary" id="btnCancelar">Cancelar</button>
							</div>
						</div>
					</div>
				</form>
				<div class="row">
					<div class="col-lg-12">
						<div id="pnlReporteMetas" style="padding-top: 30px;">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end::Portlet-->