{include file="index.css.tpl"}
<!-- begin::contenedor -->
<div id="contenedor" class="contenedor">
	<!-- begin::contenedor mapa -->
	<div id="contenedor_mapa" class="contenedor_mapa">
		<!-- begin::panel mapa -->
		<div id="mapa" class="mapa">
			
			<!-- begin::panel menú -->
			<div id="panel_menu" class="panel_menu">
				<div class="btn-group btn-group-circle">
					<div class="dropdown">
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							TAREAS
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<a class="dropdown-item" href="javascript:;" id="btn_mostrar_ventana_reportes">REPORTES</a>
							<a class="dropdown-item" href="javascript:;" id="btn_mostrar_ventana_filtros">FILTROS</a>
							<a class="dropdown-item" href="javascript:;" id="btn_mostrar_ventana_poly">POLÍGONOS</a>
							<a class="dropdown-item" href="javascript:;" id="btn_mostrar_ventana_shapefile">VER CAPAS SHAPEFILE</a>
						</div>
					</div>
					<!--
					<button id="btn_mostrar_ventana_shapefile" type="button" class="btn btn-default btn-sm" title="Abre la ventana para cargar shapefile">
						<i class="fa fa-plus"></i>&nbsp;CARGAR SHAPEFILE
					</button>
					<button id="btn_mostrar_ventana_poly" type="button" class="btn btn-default btn-sm" title="Abre la ventana de filtros">
						<i class="fa fa-plus"></i>&nbsp;POLÍGONOS
					</button>
					<button id="btn_mostrar_ventana_filtros" type="button" class="btn btn-default btn-sm" title="Abre la ventana de filtros">
						<i class="fa fa-filter"></i>&nbsp;FILTROS
					</button>
					<button id="btn_mostrar_ventana_reportes" type="button" class="btn btn-default btn-sm" title="Abre la ventana de filtros">
						<i class="fa fa-file"></i>&nbsp;REPORTES
					</button>
					-->
					<button id="btn_centrar_mapa" type="button" class="btn btn-default btn-sm" title="Centra el mapa a su posición inicial">
						<i class="fa fa-expand"></i>&nbsp;CENTRAR MAPA
					</button>
					<button id="btn_mostrar_inicio" type="button" class="btn btn-success btn-sm" title="Regresa a la página principal de Agrobiodiversidad">
						<i class="fa fa-home"></i>&nbsp;INICIO
					</button>
					<button id="btn_mostrar_ventana_capas" type="button" class="btn btn-primary btn-sm" title="Abre la ventana de capas">
						<i class="fa fa-globe"></i>&nbsp;CAPAS
					</button>
				</div>
			</div>
			<!-- end::panel menú -->

			<!-- begin::ventana capas -->
			<div id="ventana_capas" class="panel">
				<div class="panel_header">
					<div style="float: left;">
						<h5>CAPAS</h5>
					</div>
					<div style="float: right;">
						<div class="btn-group m-btn-group" role="group" aria-label="...">
							<button id="btn_cerrar_ventana_capas" type="button" class="btn btn-warning btn-sm">
								<i class="fa fa-times"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="panel_content">
					<div class="row">
						<div class="col-lg-12">
							<div id="vista_control_capas" class="control_capas"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<button id="btn_mostrar_capa_externa" type="button" class="btn btn-default btn-sm btn-block">
								<i class="fa fa-plus"></i>&nbsp;Agregar Shapefile
							</button>
						</div>
						<div class="col-lg-6">
							<button id="btn_mostrar_capa_wms" type="button" class="btn btn-default btn-sm btn-block">
								<i class="fa fa-plus"></i>&nbsp;Agregar capa WMS
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- end::ventana capas -->

		</div>
		<!-- end::panel mapa -->

	</div>
	<!-- end::panel mapa -->

	<!-- begin::contenedor datos estadísticos -->
	<div class="contenedor_estadistica">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="estadistica_contenido" id="estadistica_contenido">
					
					</div>
				</div>
			</div>
		</div>
		<!-- begin::contenedor reportes -->
		<div class="contenedor_filtros" id="contenedor_reportes">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12" style="padding-top: 10px;">
						<div class="m-portlet">
							<div class="m-portlet__body">
								<h5>REPORTES</h5>
								<hr>
								<ul class="nav nav-tabs" role="tablist">
								    <li class="nav-item">
								        <a class="nav-link active show" data-toggle="tab" href="#tab_rcobertura"><i class="fa fa-filter"></i>Cobertura</a>
								    </li>
								</ul>
								<div class="tab-content">
					        		<div class="tab-pane active" id="tab_rcobertura" role="tabpanel">
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label for="">Tipo de reporte</label>
					        					<select class="form-control select2" name="cboTipoReporte" id="cboTipoReporte" style="width: 100%">
					        						<option value="">--Seleccione una opción--</option>
					        						<option value="1" selected>General</option>
					        						<option value="2">Macroregiones</option>
					        						<option value="3">Departamentos</option>
					        					</select>
					        				</div>
					        			</div>
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label>Macroregión</label>
					        					<select class="form-control select2" name="cboReporteMacroregion" id="cboReporteMacroregion" multiple style="width: 100%" disabled="true">
					        						{html_options options=$macroregiones}
					        					</select>
					        				</div>
					        			</div>
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label>Departamento</label>
					        					<select class="form-control select2" name="cboReporteDepto" id="cboReporteDepto" multiple style="width: 100%" disabled="true">
					        						{html_options options=$deptos}
					        					</select>
					        				</div>
					        			</div>
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<button type="button" class="btn btn-primary" id="btnVerReporte">Ver reporte</button>
					        					<button type="button" class="btn btn-default" id="btnLimpiarReporte">Limpiar</button>
					        					<button type="button" class="btn btn-default" id="btnCerrarReporte">Cerrar</button>
					        				</div>
					        			</div>
					        		</div>
					        	</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end::contenedor reportes -->
		<!-- begin::contenedor filtros -->
		<div class="contenedor_filtros" id="contenedor_filtros">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12" style="padding-top: 10px;">
						<div class="m-portlet">
							<div class="m-portlet__body">
								<h5>FILTROS</h5>
								<hr>
								<ul class="nav nav-tabs" role="tablist">
								    <li class="nav-item">
								        <a class="nav-link active show" data-toggle="tab" href="#tab_cobertura"><i class="fa fa-filter"></i>Cobertura</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" data-toggle="tab" href="#tab_especies"><i class="fa fa-filter"></i>Especies</a>
								    </li>
								    <li class="nav-item">
								        <a class="nav-link" data-toggle="tab" href="#tab_cultivos"><i class="fa fa-filter"></i>Cultivos</a>
								    </li>
								</ul>
								<div class="tab-content">
					        		<div class="tab-pane active" id="tab_cobertura" role="tabpanel">
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label>Macroregión</label>
					        					<select class="form-control select2" name="cboFiltroMacroregion" id="cboFiltroMacroregion" multiple style="width: 100%">
					        						{html_options options=$macroregiones}
					        					</select>
					        				</div>
					        			</div>
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label>Departamento</label>
					        					<select class="form-control select2" name="cboFiltroDepto" id="cboFiltroDepto" multiple style="width: 100%">
					        						{html_options options=$deptos}
					        					</select>
					        				</div>
					        			</div>
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label>Municipio</label>
					        					<select class="form-control select2" name="cboFiltroMunicipio" id="cboFiltroMunicipio" multiple style="width: 100%">
					        					</select>
					        				</div>
					        			</div>
					        		</div>
					        		<div class="tab-pane" id="tab_especies" role="tabpanel">
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label>Categoría</label>
					        					<select class="form-control select2" name="cboFiltroCategoria" id="cboFiltroCategoria" style="width: 100%">
					        						{html_options options=$cataobj.categorias}
					        					</select>
					        				</div>
					        			</div>
					        		</div>
					        		<div class="tab-pane" id="tab_cultivos" role="tabpanel">
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label>Especie cultivado</label>
					        					<select class="form-control select2" name="cboFiltroEspecie" id="cboFiltroEspecie" style="width: 100%" multiple>
					        						{html_options options=$especies}
					        					</select>
					        				</div>
					        			</div>
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label>Especie asociado con cultivo</label>
					        					<select class="form-control select2" name="cboFiltroEspecieAsociaCultivo" id="cboFiltroEspecieAsociaCultivo" style="width: 100%">
					        						{html_options options=$especie_asocia_cultivo}
					        					</select>
					        				</div>
					        			</div>
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label>Vinculación</label>
					        					<select class="form-control select2" name="cboFiltroVinculacion" id="cboFiltroVinculacion" style="width: 100%">
					        						{html_options options=$cataobj.vinculaciones}
					        					</select>
					        				</div>
					        			</div>
					        		</div>
									<div class="row" style="padding-top: 15px">
				        				<div class="col-lg-12">
				        					<button type="button" class="btn btn-primary" id="btnFiltrar">Filtrar</button>
				        					<button type="button" class="btn btn-default" id="btnLimpiarFiltro">Limpiar</button>
				        					<button type="button" class="btn btn-default" id="btnCerrarFiltro">Cerrar</button>
				        				</div>
				        			</div>
					        	</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end::contenedor filtros -->
		<!-- begin::contenedor polygono -->
		<div class="contenedor_filtros" id="contenedor_poly">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-12" style="padding-top: 10px;">
						<div class="m-portlet">
							<div class="m-portlet__body">
								<h5>POLÍGONOS</h5>
								<hr>
								<ul class="nav nav-tabs" role="tablist">
								    <li class="nav-item">
								        <a class="nav-link active show" data-toggle="tab" href="#tab_poly"><i class="fa fa-square"></i>Crear polígono</a>
								    </li>
								</ul>
								<div class="tab-content">
					        		<div class="tab-pane active" id="tab_poly" role="tabpanel">
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label for="">Tipo</label>
					        					<select class="form-control select2" name="cboTipoPoly" id="cboTipoPoly" style="width: 100%">
					        						<option value="">--Seleccione una opción--</option>
					        						<option value="3">Polígono de 3 lados</option>
					        						<option value="4">Polígono de 4 lados</option>
					        					</select>
					        					<br>
					        				</div>
					        			</div>
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<label for="">Nombre</label>
					        					<input class="form-control" type="text" name="capa_nombre" id="txtCapaNombre" autocomplete="off">
					        				</div>
					        			</div>
					        			<div class="row" style="padding-bottom: 8px">
					        				<div class="col-lg-12">
					        					<button type="button" class="btn btn-primary" id="btnGuardarPoly">Guardar</button>
					        					<button type="button" class="btn btn-default" id="btnLimpiarPoly">Limpiar</button>
					        					<button type="button" class="btn btn-default" id="btnCerrarPoly">Cerrar</button>
					        				</div>
					        			</div>
					        		</div>
					        	</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end::contenedor polygono -->
	</div>
	<!-- end::contenedor datos estadísticos -->

</div>
<!-- end::contenedor-->

<!-- begin:: modal capa externa -->
<div class="modal fade" id="modal_capa_externa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
			<div class="modal-header">
		        <h4 class="modal-title" id="myModalLabel">Agregar Shapefile</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		        	<span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">
	      		<form class="m-form m-form--label-align-left" id="form_capa_externa" autocomplete="off">
					<div class="form-group m-form__group row">
						<label class="col-lg-3 col-form-label">Nombre</label>
						<div class="col-lg-9">
							<input class="form-control m-input" type="text" id="ext_nombre" required>
							<span class="m-form__help">Ej. Municipios</span>
						</div>
					</div>
					<div class="form-group m-form__group">
						<label for="exampleInputEmail1">Archivo</label>
						<div></div>
					 	<div class="custom-file">
							<input type="file" class="custom-file-input" id="ext_archivo" required>
					 		<label class="custom-file-label" for="archivo">Examinar archivo</label>
					 		<span class="m-form__help">Seleccione un archivo shapefile (comprimido .zip)</span>
						</div>
					</div>
					<div class="form-group m-form__group row">
		        		<button type="submit" class="btn btn-primary" id="btn_agregar_capa_externa">Agregar</button>&nbsp;
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</form>
	      	</div>
	    </div>
	</div>
</div>
<!-- end:: modal capa externa -->

<!-- begin:: modal capa wms -->
<div class="modal fade" id="modal_capa_wms" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-md" role="document">
	    <div class="modal-content">
			<div class="modal-header">
		        <h4 class="modal-title" id="myModalLabel">Agregar capa WMS</h4>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	      	</div>
	      	<div class="modal-body">
	      		<form class="m-form m-form--label-align-right" id="form_capa_wms" autocomplete="off">
					<div class="form-group m-form__group row">
						<label class="col-lg-3 col-form-label">Dirección URL</label>
						<div class="col-lg-9 input-group">
							<input class="form-control" type="url" id="wms_url" required>
							<div class="input-group-append">
								<button id="btn_wms_lista" class="btn btn-primary btn-sm" type="button" title="Listar capas"><span class="flaticon-search"></span></button>
							</div>
						</div>
						<span class="m-form__help"><i>Ejemplo:&nbsp;</i>https://geo.gob.bo/geoserver/ows?</span>
					</div>
					<div class="form-group m-form__group row">
						<label class="col-lg-3 col-form-label">Capa</label>
						<div class="col-lg-9">
							<select id="wms_capa" class="form-control select2_wms_capa">
								<option value=""></option>
							</select>
						</div>
					</div>
					<div class="form-group m-form__group row">
						<label class="col-lg-3 col-form-label">Alias de capa</label>
						<div class="col-lg-9">
							<input class="form-control m-input" type="text" id="wms_alias">
						</div>
					</div>
					<div class="form-group m-form__group row">
		        		<button type="submit" class="btn btn-primary" id="btn_agregar_capa_wms">Agregar</button>&nbsp;
		        		<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
				</form>
	      	</div>
	    </div>
	</div>
</div>
<!-- end:: modal capa wms -->

<!-- begin:: modal feature -->
<div id="modal_feature" class="modal fade" tabindex="-1" data-replace="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            	<h4 class="modal-title">Características de capa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div id="modal_feature_content" style="overflow:auto;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- end:: modal feature -->

<!-- begin:: modal capa shapefile -->
<div class="modal fade" id="modal_shapefile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
			<div class="modal-header">
		        <h4 class="modal-title" id="myModalLabel">Listado de capas shapefile</h4>
				<div class="button-group" style="float: right; margin-top: 0px;">
					<button type="button" class="btn btn-default btn-sm" id="btnActualizarListaShapefiles" title="Actualizar lista">
						<span class="la la-refresh"></span>&nbsp;Actualizar lista
					</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal" aria-label="Close" title="Cerrar">
						<span class="la la-close"></span>
					</button>
				</div>
				
		        
	      	</div>
	      	<div class="modal-body">
	      		<table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-brand" id="dtShapefiles">
					<thead>
						<tr>
							<th>Acción</th>
							<th>Nombre</th>
						</tr>
					</thead>
				</table>
	      	</div>
	    </div>
	</div>
</div>
<!-- end:: modal capa shapefile -->