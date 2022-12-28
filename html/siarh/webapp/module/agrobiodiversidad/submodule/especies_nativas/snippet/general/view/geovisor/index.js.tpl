{literal}
<script>
var snippet_geovisor = function() {
	var mapa_center_default = [-16.2901535, -63.5886536];
    var mapa_zoom_default = 5;

    var mapa = false;
    var puntos = false;

    var panel_mapa = 'mapa';

    var fn_agregar_punto = false;
    var fn_obtener_ubicacion = false;
    var fn_obtener_ubicacion_utm = false;
    var fn_asignar_datos_ubicacion = false;

    var btnUbicar = $('#btnUbicar');
    var btnUbicarUtm = $('#btnUbicarUtm');
    var btnLimpiar = $('#btnLimpiar');

	/**
     * FUNCIÓN DEFINE MAPA Y CAPAS
     */
    var handle_map = function() {
    	/**
         * DEFINE CAPAS BASE
         * OpenStreetMap, Bing, Google
         */
        var osmLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        });

        var bingRoadmapLayer = L.tileLayer.bing({
            bingMapsKey: 'AuhiCJHlGzhg93IqUH_oCpl_-ZUrIE6SPftlyGYUvr9Amx5nzA-WqGcPquyFZl4L',
            imagerySet: 'Road'
        });

        var bingSatelliteLayer = L.tileLayer.bing({
            bingMapsKey: 'AuhiCJHlGzhg93IqUH_oCpl_-ZUrIE6SPftlyGYUvr9Amx5nzA-WqGcPquyFZl4L',
            imagerySet: 'AerialWithLabels'
        });

        /**
         * DEFINE CAPAS REFERENCIALES
         */
        var comunidadesLayer = L.tileLayer.wms('http://geo.siarh.gob.bo/geoserver/geonode/wms', {
            layers: 'geonode:comunidades_2012_',
            transparent: true,
            format: 'image/png'
        });

        var limiteDepartamentalLayer = L.tileLayer.wms('http://geo.siarh.gob.bo/geoserver/geonode/wms', {
            layers: 'geonode:limite_departamentos_2018_wgs',
            transparent: true,
            format: 'image/png'
        });

        /**
         * DEFINE MAPA PRINCIPAL
         */
        mapa = L.map(panel_mapa, {
            center: mapa_center_default,
            zoom: mapa_zoom_default,
            layers: [bingSatelliteLayer, limiteDepartamentalLayer]
        });

        var baseLayers = {
		    "Open Street Map": osmLayer,
		    "Bing (Road)": bingRoadmapLayer,
		    "Bing (Aerial)": bingSatelliteLayer

		};

		var overlayLayers = {
		    "Límite departamental": limiteDepartamentalLayer
		};

		L.control.layers(baseLayers, overlayLayers).addTo(mapa);

        mapa.on('click', function(e) {
			//fn_agregar_punto(e.latlng.lat, e.latlng.lng);
			fn_obtener_ubicacion(e.latlng.lat, e.latlng.lng);
        });
    };

    /**
     * DEFINE MÉTODOS
     */
    var fn_agregar_punto = function(lat, lon) {
    	if (puntos != false) {
    		puntos.remove();
    	}
		puntos = new L.marker([lat, lon]).addTo(mapa);
    };

    var fn_obtener_ubicacion = function(lat, lon) {
    	swal({
            title: 'Cargando!',
            text: 'Procesando datos',
            imageUrl: 'images/loading/loading05.gif',
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        $.ajax({
            url: "?module=agrobiodiversidad&smodule=especies_nativas&accion=general_obtenerUbicacion",
            type: "POST",
            crossDomain: true,
            data: {latitud: lat, longitud: lon},
            dataType: "html",
            success: function (response) {
                var respuesta = JSON.parse(response)
                if (respuesta.res == 1) {
                    swal.close();
                    fn_agregar_punto(respuesta.data.lat_decimal, respuesta.data.lon_decimal);
                    fn_asignar_datos_ubicacion(respuesta.data);
                } else {
                    swal.close();
                    swal('Advertencia!', respuesta.msg, 'warning');
                }
            },
            error: function (xhr, status) {
                swal.close();
                swal('Advertencia!', 'Ocurrió un error.', 'warning');
            }
        });
    };

    var fn_obtener_ubicacion_utm = function(utm_este, utm_norte, utm_zona) {
        swal({
            title: 'Cargando!',
            text: 'Procesando datos',
            imageUrl: 'images/loading/loading05.gif',
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        $.ajax({
            url: "?module=agrobiodiversidad&smodule=especies_nativas&accion=general_obtenerUbicacionUtm",
            type: "POST",
            crossDomain: true,
            data: {utm_este: utm_este, utm_norte: utm_norte, utm_zona: utm_zona},
            dataType: "html",
            success: function (response) {
                var respuesta = JSON.parse(response)
                if (respuesta.res == 1) {
                    swal.close();
                    fn_agregar_punto(respuesta.data.lat_decimal, respuesta.data.lon_decimal);
                    fn_asignar_datos_ubicacion(respuesta.data);
                } else {
                    swal.close();
                    swal('Advertencia!', respuesta.msg, 'warning');
                }
            },
            error: function (xhr, status) {
                swal.close();
                swal('Advertencia!', 'Ocurrió un error.', 'warning');
            }
        });
    };

    var fn_asignar_datos_ubicacion = function(datos) {
    	$('#txtLongitud').val(datos.lon_decimal);
    	$('#txtLatitud').val(datos.lat_decimal);
    	$('#txtUtmEste').val(datos.utm_este);
    	$('#txtUtmNorte').val(datos.utm_norte);
    	$('#txtUtmZona').val(datos.utm_zona);
        /*$('#txtDeptoId').val(datos.depto_id);
        $('#txtDepto').val(datos.depto_nombre);
        $('#txtMunicipioId').val(datos.municipio_id);
        $('#txtMunicipio').val(datos.municipio_nombre);
        $('#txtComunidad').val(datos.comunidad_nombre);
        $('#txtMacroId').val(datos.macroreg_id);
        $('#txtMacro').val(datos.macroreg_nombre);*/

        $('#txtMapaLongitud').val(datos.lon_decimal);
        $('#txtMapaLatitud').val(datos.lat_decimal);
        $('#txtMapaUtmEste').val(datos.utm_este);
        $('#txtMapaUtmNorte').val(datos.utm_norte);
        $('#cboMapaUtmZona').val(datos.utm_zona).trigger('change');

        fnMostrarPanelUbicacion();
    };

    var fn_asignar_datos_form_mapa = function() {
        $('#txtMapaLongitud').val($('#txtLongitud').val());
        $('#txtMapaLatitud').val($('#txtLatitud').val());
        $('#txtMapaUtmEste').val($('#txtUtmEste').val());
        $('#txtMapaUtmNorte').val($('#txtUtmNorte').val());
        $('#cboMapaUtmZona').val($('#txtUtmZona').val()).trigger('change');
    };

    var fnMostrarPanelUbicacion = function() {
        $('#pnlUbicacion').show();
    };

    var fnOcultarPanelUbicacion = function() {
        $('#pnlUbicacion').hide();
    };

	/**
     * FUNCIÓN DEFINE ACCIONES
     */
    var handle_actions = function() {
    	$('#modal_mapa').on('shown.bs.modal', function() {
			mapa.invalidateSize();
			if ($('#txtLatitud').val() != '' && $('#txtLongitud').val() != '') {
				fn_agregar_punto($('#txtLatitud').val(), $('#txtLongitud').val());
                fn_asignar_datos_form_mapa();
			}
		});

        btnUbicarUtm.click(function() {
            var utm_este = $('#txtMapaUtmEste').val();
            var utm_norte = $('#txtMapaUtmNorte').val();
            var utm_zona = $('#cboMapaUtmZona').val();
            if (utm_este != '' && utm_norte != '' && utm_zona != '') {
                fn_obtener_ubicacion_utm(utm_este, utm_norte, utm_zona);
            }
        });

        btnUbicar.click(function() {
            var longitud = $('#txtMapaLongitud').val();
            var latitud = $('#txtMapaLatitud').val();
            if (longitud != '' && latitud != '') {
                fn_obtener_ubicacion(latitud, longitud);
            }
        });

        btnLimpiar.click(function() {
            if (puntos != false) {
                puntos.remove();
            }
            $('#txtMapaLongitud').val('');
            $('#txtMapaLatitud').val('');
            $('#txtMapaUtmEste').val('');
            $('#txtMapaUtmNorte').val('');
            $('#cboMapaUtmZona').val('').trigger('change');
        });
    };

	/**
     * FUNCIÓN DEFINE ESTADOS
     */
    var handle_states = function() {
		$('.select2_zona').select2({
            placeholder: "UTM Zona"
        });
    };

return {
        init: function() {
            handle_map();
            handle_actions();
            handle_states();
        }
    };
}();

jQuery(document).ready(function() {
    snippet_geovisor.init();
});
</script>
{/literal}