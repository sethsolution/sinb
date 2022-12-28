{literal}
<script>
var fnDescargarShapefile;
var dtListaShapefiles;
var fnImprimirDiv;

var snippet_geovisor = function() {
    var mapa_center_default = [-16.2901535, -63.5886536];
    var mapa_zoom_default = 6;

    var mapa = false;
    var groupBaseLayers = false;
    var groupOverlayLayers = false;
    var controlLayers = false;
    var puntosIndiceLayer = [];
    var grupoIndiceLayer = false;
    var controlCoordenada = false;
    var popupFeatureLayer = false;
    var infoLayer = {};
    var capaSeleccionada = 0;
    var controlImpresion = false;

    var cultivosLayer = false;
    var especiesLayer = false;
    var cultivosPopup = false;
    var especiesPopup = false;
    var especiesCluster = false;
    var polygonLayerGroup = false;
    var pointLayerGroup = false;
    var pointCounter = 0;
    var polygonArray = [];
    var polygonDataset = [];
    var polygonSides = 0;
    var poligonosLayer = false;
    var especiesNativasLayer = false;
    var especiesNativasPopup = false;
    var especiesNativasCluster = false;

    var fnCentrarMapa = false;
    var fn_imprimir_mapa = false;
    var fn_crear_capa_tile = false;
    var fn_crear_capa_shapefile = false;
    var fn_cargar_archivo_shapefile = false;

    var fnMostrarVentanaCapas = false;
    var fnCerrarVentanaCapas = false;
    var fnMostrarVentanaFiltros = false;
    var fnCerrarVentanaFiltros = false;
    var fnMostrarVentanaPoly = false;
    var fnCerrarVentanaPoly = false;
    var fnHabilitarFiltrosCobertura = false;
    var fnInhabilitarFiltrosCobertura = false;
    
    var panel_mapa = 'mapa';
    var btn_mostrar_ventana_capas = $('#btn_mostrar_ventana_capas');
    var btn_mostrar_ventana_consultas = $('#btn_mostrar_ventana_consultas');
    var btn_mostrar_ventana_netcdf = $('#btn_mostrar_ventana_netcdf');
    var btn_centrar_mapa = $('#btn_centrar_mapa');
    var dataset_leyenda = {};

    var ventana_capas = $('#ventana_capas');
    var btn_cerrar_ventana_capas = $('#btn_cerrar_ventana_capas');
    var btn_link_capas = $('#btn_link_capas');
    var vista_control_capas = document.getElementById('vista_control_capas');
    var btn_mostrar_capa_externa = $('#btn_mostrar_capa_externa');
    var btn_mostrar_capa_wms = $('#btn_mostrar_capa_wms');
    var modal_capa_externa = $('#modal_capa_externa');
    var modal_capa_wms = $('#modal_capa_wms');
    var form_capa_externa = $('#form_capa_externa');
    var form_capa_wms = $('#form_capa_wms');
    var txt_wms_url = $('#wms_url');
    var btn_wms_lista = $('#btn_wms_lista');
    var cbo_wms_capa = $('#wms_capa');
    var btn_agregar_capa_externa = $('#btn_agregar_capa_externa');
    var btn_agregar_capa_wms = $('#btn_agregar_wms');

    var estadistica_contenido = $('#estadistica_contenido');
    var contenedor_reportes = $('#contenedor_reportes');
    var btn_mostrar_ventana_reportes = $('#btn_mostrar_ventana_reportes');
    var bnd_ventana_reportes = 0;
    var contenedor_filtros = $('#contenedor_filtros');
    var btn_mostrar_ventana_filtros = $('#btn_mostrar_ventana_filtros');
    var bnd_ventana_filtros = 0;
    var contenedor_poly = $('#contenedor_poly');
    var btn_mostrar_ventana_poly = $('#btn_mostrar_ventana_poly');
    var bnd_ventana_poly = 0;
    var bnd_point_poly = 0;
    var cboTipoReporte = $('#cboTipoReporte');
    var cboReporteMacroregion = $('#cboReporteMacroregion');
    var cboReporteDepto = $('#cboReporteDepto');
    var btnVerReporte = $('#btnVerReporte');
    var btnLimpiarReporte = $('#btnLimpiarReporte');
    var btnCerrarReporte = $('#btnCerrarReporte');
    var cboFiltroMacroregion = $('#cboFiltroMacroregion');
    var cboFiltroDepto = $('#cboFiltroDepto');
    var cboFiltroMunicipio = $('#cboFiltroMunicipio');
    var btnFiltrar = $('#btnFiltrar');
    var btnLimpiarFiltro = $('#btnLimpiarFiltro');
    var btnCerrarFiltro = $('#btnCerrarFiltro');
    var cboTipoPoly = $('#cboTipoPoly');
    var btnGuardarPoly = $('#btnGuardarPoly');
    var btnLimpiarPoly = $('#btnLimpiarPoly');
    var btnCerrarPoly = $('#btnCerrarPoly');

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

        var googleRoadmapLayer = L.gridLayer.googleMutant({
            maxZoom: 24,
            type:'roadmap'
        });

        var googleSatelliteLayer = L.gridLayer.googleMutant({
            maxZoom: 24,
            type:'hybrid'
        });
        
        // Possible types: SATELLITE, ROADMAP, HYBRID, TERRAIN
        /*var googleSatelliteLayer = new L.Google('SATELLITE');

        var googleRoadmapLayer = new L.Google('ROADMAP');*/
        
        /**
         * DEFINE CAPAS REFERENCIALES
         */
        var departamentosLayer = L.tileLayer.wms('http://localhost:8080/geoserver/agrobiodiversidad/wms', {
            layers: 'agrobiodiversidad:limite_departamentos',
            transparent: true,
            format: 'image/png'
        });

        var municipiosLayer = L.tileLayer.wms('http://localhost:8080/geoserver/agrobiodiversidad/wms', {
            layers: 'agrobiodiversidad:limite_municipios',
            transparent: true,
            format: 'image/png'
        });

        var macroregionesLayer = L.tileLayer.wms('http://localhost:8080/geoserver/agrobiodiversidad/wms', {
            layers: 'agrobiodiversidad:macroregiones',
            transparent: true,
            format: 'image/png'
        });

        /*var comunidadesLayer = L.tileLayer.wms('http://localhost:8080/geoserver/agrobiodiversidad/wms', {
            layers: 'agrobiodiversidad:comunidades',
            transparent: true,
            format: 'image/png'
        });*/

        cultivosLayer = L.geoJSON([], {
            style: function (feature) {
                //return feature.properties && feature.properties.style;
                return {
                    weight: 0.7,
                    outline: "#535353",
                    opacity: 1,
                    fillColor: "#06D147",
                    fillOpacity: 1
                };
            },
            pointToLayer: function (feature, latlng) {
                return L.circleMarker(latlng, {
                    radius: 8,
                    fillColor: "#06D147",
                    color: "#000",
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                });
            }
        });

        especiesLayer = L.geoJSON([], {
            style: function (feature) {
                //return feature.properties && feature.properties.style;
                return {
                    weight: 0.7,
                    outline: "#535353",
                    opacity: 1,
                    fillColor: "#DCD500",
                    fillOpacity: 1
                };
            },
            pointToLayer: function (feature, latlng) {
                return L.circleMarker(latlng, {
                    radius: 8,
                    fillColor: "#DCD500",
                    color: "#000",
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                });
            }
        });

        especiesNativasLayer = L.geoJSON([], {
            style: function (feature) {
                //return feature.properties && feature.properties.style;
                return {
                    weight: 0.7,
                    outline: "#535353",
                    opacity: 1,
                    fillColor: "#ff9900",
                    fillOpacity: 1
                };
            },
            pointToLayer: function (feature, latlng) {
                return L.circleMarker(latlng, {
                    radius: 8,
                    fillColor: "#ff9900",
                    color: "#000",
                    weight: 1,
                    opacity: 1,
                    fillOpacity: 0.8
                });
            }
        });

        poligonosLayer = L.geoJSON([], {
            style: function (feature) {
                //return feature.properties && feature.properties.style;
                return {
                    weight: 2,
                    outline: "#3388FF",
                    opacity: 1,
                    fillColor: "#3388FF",
                    fillOpacity: 0.1
                };
            },
            onEachFeature: function(feature, layer) {
                var popupContent = '<p>'+
                    '<b>ID: </b>'+feature.properties.itemId+'<br>'+
                    '<b>Nombre: </b>'+feature.properties.nombre+'<br>'+
                    '<a href="javascript:;" class="app-popup-delete" data-itemid="'+feature.properties.itemId+'">Eliminar</a><br>'+
                    '<a href="javascript:;" class="app-popup-consulta" data-itemid="'+feature.properties.itemId+'">Obtener datos</a>'+
                    '</p>';
                layer.bindPopup(popupContent);
            }
        });

        /**
         * DEFINE MAPA PRINCIPAL
         */
        mapa = L.map(panel_mapa, {
            center: mapa_center_default,
            zoom: mapa_zoom_default,
            //zoomSnap: 0.5,
            layers: [bingSatelliteLayer]
        });

        /**
         * DEFINE CLUSTERS DE PUNTOS
         */
        cultivosCluster = L.markerClusterGroup({
            disableClusteringAtZoom: 13,
            animate:false,
            spiderfyDistanceMultiplier: 1.5
        });

        cultivosLayer.addTo(cultivosCluster);

        especiesCluster = L.markerClusterGroup({
            disableClusteringAtZoom: 13,
            animate:false,
            spiderfyDistanceMultiplier: 1.5,
            iconCreateFunction: function (cluster) {
                var childCount = cluster.getChildCount();
                return new L.DivIcon({
                    html: '<div><span>' + childCount + '</span></div>', 
                    className: 'marker-cluster-especies',
                    iconSize: new L.Point(40, 40) 
                });
            }
        });

        especiesLayer.addTo(especiesCluster);

        especiesNativasCluster = L.markerClusterGroup({
            disableClusteringAtZoom: 13,
            animate:false,
            spiderfyDistanceMultiplier: 1.5,
            iconCreateFunction: function (cluster) {
                var childCount = cluster.getChildCount();
                return new L.DivIcon({
                    html: '<div><span>' + childCount + '</span></div>', 
                    className: 'marker-cluster-especies-nativas',
                    iconSize: new L.Point(40, 40) 
                });
            }
        });

        especiesNativasLayer.addTo(especiesNativasCluster);

        /**
         * DEFINE CONTROL DE CAPAS (LAYER SWITCHING)
         * 
         * Grupo de capas base
         */
        groupBaseLayers = [
            {
                group: "<strong>BASE</strong>",
                collapsed: false,
                layers: [
                    {
                        name: '&nbsp;Open Street Map',
                        layer: osmLayer
                    },
                    {
                        name: '&nbsp;Bing (Road)',
                        layer: bingRoadmapLayer
                    },
                    {
                        name: '&nbsp;Bing (Aerial)',
                        layer: bingSatelliteLayer
                    },
                    /*{
                        name: '&nbsp;Google (Roadmap)',
                        layer: googleRoadmapLayer
                    },*/
                    {
                        name: '&nbsp;Google (Hibrid)',
                        layer: googleSatelliteLayer
                    }
                ]
            }
        ];

        /**
         * Grupos de capas referenciales, temáticos y acciones - intervenciones
         */
        // CAPAS REFERENCIALES (1-49)

        groupOverlayLayers = [
            {
                group: "<strong>REFERENCIALES</strong>",
                collapsed: true,
                layers: [
                    {
                        active: false,
                        name: 'Macroregiones',
                        icon: '<i class="fa fa-map-marked-alt"></i>',
                        layer: macroregionesLayer,
                        url_legend: '',
                        id_capa: 1
                    },
                    {
                        active: false,
                        name: 'Límite departamentos',
                        icon: '<i class="fa fa-map-marked-alt"></i>',
                        layer: departamentosLayer,
                        url_legend: '',
                        id_capa: 2
                    },
                    {
                        active: false,
                        name: 'Límite municipios',
                        icon: '<i class="fa fa-map-marked-alt"></i>',
                        layer: municipiosLayer,
                        url_legend: '',
                        id_capa: 3
                    }
                ]
            },
            {
                group: "<strong>ABROBIODIVERSIDAD</strong>",
                collapsed: true,
                layers: [
                    {
                        active: true,
                        name: 'Especies',
                        icon: '<i class="fa fa-map-marked-alt"></i>',
                        layer: especiesCluster,
                        url_legend: '',
                        id_capa: 10
                    },
                    {
                        active: true,
                        name: 'Cultivos',
                        icon: '<i class="fa fa-map-marked-alt"></i>',
                        layer: cultivosCluster,
                        url_legend: '',
                        id_capa: 11
                    },
                    {
                        active: true,
                        name: 'Polígonos',
                        icon: '<i class="fa fa-map-marked-alt"></i>',
                        layer: poligonosLayer,
                        url_legend: '',
                        id_capa: 12
                    },
                    {
                        active: true,
                        name: 'Especies Nativas',
                        icon: '<i class="fa fa-map-marked-alt"></i>',
                        layer: especiesNativasCluster,
                        url_legend: '',
                        id_capa: 13
                    }
                ]
            }
        ];

        /*----begin::popup----*/
        cultivosPopup = L.popup({maxWidth: "auto"});
        especiesPopup = L.popup({maxWidth: "auto"});
        especiesNativasPopup = L.popup({maxWidth: "auto"});
        /*----end::popup----*/


        /*----begin::selected layer----*/
        capaSeleccionada = 2;
        /*----end::selected layer----*/

        /*----begin::control layers----*/
        controlLayers = new L.Control.PanelLayers(groupBaseLayers, groupOverlayLayers, {
            collapsibleGroups: true
        });

        controlLayers._map = mapa;

        var panelLayers = controlLayers.onAdd(mapa);
        vista_control_capas.appendChild(panelLayers);
        /*----end::control layers----*/

        /*----begin::measure layers----*/
        var measureControl = L.control.measure({
            position: 'topleft',
            primaryLengthUnit: 'meters',
            secondaryLengthUnit: 'kilometers',
            primaryAreaUnit: 'hectares',
            secondaryAreaUnit: 'sqmeters',
            activeColor: '#ABE67E',
            completedColor: '#C8F2BE'
        });
        measureControl.addTo(mapa);
        /*----end::measure layers----*/

        /*----begin::control coordinates----*/
        controlCoordenada = new L.Control.Coordinates();
        controlCoordenada.addTo(mapa);
        /*----begin::control coordinates----*/

        /*----begin::layerGroup de puntos y polígonos----*/
        pointLayerGroup = L.layerGroup().addTo(mapa);
        polygonLayerGroup = L.layerGroup().addTo(mapa);
        /*----end::layerGroup de puntos y polígonos----*/

        /*----begin::Imprimir mapa----*/
        L.easyPrint({
            title: 'Imprimir mapa',
            position: 'topleft',
            //elementsToHide: 'p, h2, .leaflet-control-zoom',
            sizeModes: ['A4Portrait', 'A4Landscape']
        }).addTo(mapa);
        /*----end::Imprimir mapa----*/

        /*----begin::event layers----*/
        mapa.on('click', function(e) {
            controlCoordenada.setCoordinates(e);
            if (bnd_point_poly != 0 && polygonSides != 0 && pointCounter <= polygonSides) {
                var marker = L.circleMarker([e.latlng.lat, e.latlng.lng], {
                    color: 'red',
                    fillColor: '#f03',
                    fillOpacity: 0.5,
                    radius: 5
                });
                pointLayerGroup.addLayer(marker);
                polygonArray.push([e.latlng.lat, e.latlng.lng]);
                pointCounter++;
                if (polygonArray.length == polygonSides) {
                    polygonDataset.push(polygonArray);
                    pointLayerGroup.clearLayers();
                    var polygon = L.polygon(polygonArray, {color: 'red'});
                    polygonLayerGroup.addLayer(polygon);
                    polygonArray = [];
                    pointCounter++;
                    //pointCounter = 0;
                }
            }
        });

        mapa.on('resize', function(e) {
            if ($(window).width() < 992) {
                mapa_zoom_default = 5.5;
                fnCentrarMapa();
            } else {
                mapa_zoom_default = 6;
                fnCentrarMapa();
            }
        });

        especiesLayer.on('click', function(e) {
            var data = e.layer.feature.properties;
            var popupContent = '';
            var popupHeader = '<center><b>Especie: '+data.nombre_comun.toUpperCase()+'</b></center>';
            var popupBody = '<p style="width: 250px; background-color: #fffc99; padding: 7px; border-radius: 5px;">'+
                '<b>Nombre común: </b>'+data.nombre_comun+'<br>'+
                '<b>Nombre científico: </b><i> '+data.nombre_cientifico+'</i><br>'+
                '<b>Categoría: </b>'+data.categoria+'<br>'+
                '<b>Macroregión: </b>'+data.macroregion+'<br>'+
                '<b>Municipio: </b>'+data.municipio+'<br>'+
                //'<b>Longitud y Latitud: </b><br>['+data.longitud+', '+data.latitud+']<br>'+
                '</p>';
            if (data.fotoId != null) {
                var url = '?module=agrobiodiversidad&smodule=especies&accion=general_descargarRecurso&id='+data.fotoId;
                var popupImage = '<p class="text-center"><img class="img-thumbnail" src="'+url+'" height="80"/></p>';
            } else {
                popupImage = '';
            }
            popupContent = popupHeader+popupBody+popupImage;
            especiesPopup.setLatLng(e.latlng).setContent(popupContent).openOn(mapa);
        });

        cultivosLayer.on('click', function(e) {
            var data = e.layer.feature.properties;
            var popupContent = '';
            var popupHeader = '<center><b>Cultivo de '+data.nombre_comun.toUpperCase()+'</b></center>';
            var popupBody = '<p style="width: 250px; background-color: #e6ff99; padding: 7px; border-radius: 5px;">'+
                '<b>Nombre común: </b>'+data.nombre_comun+'<br>'+
                '<b>Nombre científico: </b><i> '+data.nombre_cientifico+'</i><br>'+
                '<b>Vinculación: </b>'+data.vinculacion+'<br>'+
                '<b>Superficie: </b>'+data.superficie+'m<sup>2</sup><br>'+
                '<b>Macroregión: </b>'+data.macroregion+'<br>'+
                '<b>Departamento: </b>'+data.depto+'<br>'+
                '<b>Municipio: </b>'+data.municipio+'<br>'+
                /*'<b>UTM Este: </b>'+data.utm_este+'<br>'+
                '<b>UTM Norte: </b>'+data.utm_norte+'<br>'+
                '<b>UTM Zona: </b>'+data.utm_zona+'<br>'+
                '<b>Productor: </b>'+data.productor+'<br>'+
                '<b>Custodio: </b>'+data.custodio+*/
                '</p>';
            if (data.fotoId != null) {
                var url = '?module=agrobiodiversidad&smodule=cultivos&accion=general_descargarRecurso&id='+data.fotoId;
                var popupImage = '<p class="text-center"><img class="img-thumbnail" src="'+url+'" height="80"/></p>';
            } else {
                popupImage = '';
            }
            popupContent = popupHeader+popupBody+popupImage;
            especiesPopup.setLatLng(e.latlng).setContent(popupContent).openOn(mapa);
        });

        especiesNativasLayer.on('click', function(e) {
            var data = e.layer.feature.properties;
            var popupContent = '';
            var popupHeader = '<center><b>Especie nativa: '+data.nombre_comun.toUpperCase()+'</b></center>';
            var popupBody = '<p style="width: 250px; background-color: #fffc99; padding: 7px; border-radius: 5px;">'+
                '<b>Nombre común: </b>'+data.nombre_comun+'<br>'+
                '<b>Nombre científico: </b><i> '+data.nombre_cientifico+'</i><br>'+
                '<b>Categoría de uso: </b>'+data.categoria_uso+'<br>'+
                '<b>Macroregión: </b>'+data.macroregion+'<br>'+
                '<b>Municipio: </b>'+data.municipio+'<br>'+
                //'<b>Longitud y Latitud: </b><br>['+data.longitud+', '+data.latitud+']<br>'+
                '</p>';
            popupContent = popupHeader+popupBody;
            especiesPopup.setLatLng(e.latlng).setContent(popupContent).openOn(mapa);
        });

        /*mapa.on('overlayadd', function(e) {
            if (e.id_capa != undefined) {
                fn_mostrar_leyenda_capa(e.id_capa, e.url_legend);
            }
        });

        mapa.on('overlayremove', function(e) {
            if (e.id_capa != undefined) {
                fn_ocultar_leyenda_capa(e.id_capa);
            }
        });*/
        /*----end::event layers----*/

        /*----begin::popup----*/
        popupFeatureLayer = new L.Popup({maxWidth: 1000});
        /*----end::popup----*/
    };

    /**
     * DEFINE MÉTODOS
     */
    fnCentrarMapa = function() {
        mapa.flyTo(new L.LatLng(mapa_center_default[0], mapa_center_default[1]), mapa_zoom_default);
    };

    fnMostrarCoordenada = function(e) {
        controlCoordenada.setCoordinates(e);
        swal("Coordenada [latitud, longitud]", '['+e.latlng.lat+', '+e.latlng.lng+']');
    };

    fnMostrarVentanaCapas = function() {
        ventana_capas.fadeIn();
    };

    fnCerrarVentanaCapas = function() {
        ventana_capas.fadeOut();
    };

    fnMostrarVentanaReportes = function() {
        contenedor_reportes.fadeIn();
    };

    fnCerrarVentanaReportes = function() {
        contenedor_reportes.fadeOut();
    };

    fnMostrarVentanaFiltros = function() {
        contenedor_filtros.fadeIn();
    };

    fnCerrarVentanaFiltros = function() {
        contenedor_filtros.fadeOut();
    };

    fnMostrarVentanaPoly = function() {
        contenedor_poly.fadeIn();
    };

    fnCerrarVentanaPoly = function() {
        contenedor_poly.fadeOut();
    };

    fnHabilitarFiltrosCobertura = function() {
        cboFiltroMacroregion.attr('disabled', false);
        cboFiltroDepto.attr('disabled', false);
        cboFiltroMunicipio.attr('disabled', false);
    };

    fnInhabilitarFiltrosCobertura = function() {
        cboFiltroMacroregion.attr('disabled', true);
        cboFiltroDepto.attr('disabled', true);
        cboFiltroMunicipio.attr('disabled', true);
    };

    var fnObtenerGeojsonCultivos = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getCultivos",
            type: "POST",
            crossDomain: true,
            data: {
                macroregion: cboReporteMacroregion.val(),
                depto: cboReporteDepto.val()
            },
            dataType: "html",
            success: function (respuesta) {
                swal.close();
                cultivosLayer.clearLayers();
                cultivosLayer.addData(JSON.parse(respuesta));
                cultivosCluster.clearLayers();
                cultivosCluster.addLayer(cultivosLayer);
            },
            error: function (xhr, status) {
                swal.close();
                swal('Advertencia!', 'Ocurrió un error.', 'warning');
            }
        });
    };

    var fnObtenerGeojsonEspecies = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getEspecies",
            type: "POST",
            crossDomain: true,
            data: {
                macroregion: cboReporteMacroregion.val(),
                depto: cboReporteDepto.val()
            },
            dataType: "html",
            success: function (respuesta) {
                swal.close();
                especiesLayer.clearLayers();
                especiesLayer.addData(JSON.parse(respuesta));
                especiesCluster.clearLayers();
                especiesCluster.addLayer(especiesLayer);
            },
            error: function (xhr, status) {
                swal.close();
                swal('Advertencia!', 'Ocurrió un error.', 'warning');
            }
        });
    };

    var fnObtenerGeojsonEspeciesNativas = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getEspeciesNativas",
            type: "POST",
            crossDomain: true,
            data: {
                macroregion: $('#cboFiltroMacroregion').val(),
                depto: $('#cboFiltroDepto').val(),
                municipio: $('#cboFiltroMunicipio').val()
            },
            dataType: "html",
            success: function (respuesta) {
                swal.close();
                especiesNativasLayer.clearLayers();
                especiesNativasLayer.addData(JSON.parse(respuesta));
                especiesNativasCluster.clearLayers();
                especiesNativasCluster.addLayer(especiesNativasLayer);
            },
            error: function (xhr, status) {
                swal.close();
                swal('Advertencia!', 'Ocurrió un error.', 'warning');
            }
        });
    };

    var fnObtenerDatosDeptoCultivos = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getDatosDeptoCultivos",
            type: "POST",
            crossDomain: true,
            data: {
                macroregion: cboReporteMacroregion.val(),
                depto: cboReporteDepto.val()
            },
            dataType: "html",
            success: function (respuesta) {
                estadistica_contenido.html('');
                estadistica_contenido.html(respuesta);
                swal.close();
            },
            error: function (xhr, status) {
                estadistica_contenido.html('');
                swal.close();
            }
        });
    };

    var fnObtenerDatosGeneral = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getDatosGeneral",
            type: "POST",
            crossDomain: true,
            data: {},
            dataType: "html",
            success: function (respuesta) {
                estadistica_contenido.html('');
                estadistica_contenido.html(respuesta);
                swal.close();
            },
            error: function (xhr, status) {
                estadistica_contenido.html('');
                swal.close();
            }
        });
    };

    var fnObtenerDatosCobertura = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getDatosCobertura",
            type: "POST",
            crossDomain: true,
            data: {
                macroregion: cboReporteMacroregion.val(),
                depto: cboReporteDepto.val()
            },
            dataType: "html",
            success: function (respuesta) {
                estadistica_contenido.html('');
                estadistica_contenido.html(respuesta);
                swal.close();
            },
            error: function (xhr, status) {
                estadistica_contenido.html('');
                swal.close();
            }
        });
    };

    var fnObtenerDatosMacroregion = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getDatosMacroregion",
            type: "POST",
            crossDomain: true,
            data: {
                macroregion: cboReporteMacroregion.val(),
                depto: cboReporteDepto.val()
            },
            dataType: "html",
            success: function (respuesta) {
                estadistica_contenido.html('');
                estadistica_contenido.html(respuesta);
                swal.close();
            },
            error: function (xhr, status) {
                estadistica_contenido.html('');
                swal.close();
            }
        });
    };

    var fnGuardarPoligono = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=guardarPoligono",
            type: "POST",
            crossDomain: true,
            data: {
                capa_nombre: $('#txtCapaNombre').val(),
                capa_geom: polygonDataset
            },
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.res == 1) {
                    swal.close();
                    fnObtenerGeojsonPoligonos();
                    fnLimpiarConfigPoligonos();
                    swal('Creado!', 'El polígono fue creado con éxito.', 'success');
                } else {
                    swal.close();
                    swal('Error!', 'No se pudo guardar el polígono.', 'danger');
                }
            },
            error: function (xhr, status) {
                swal.close();
                swal('Error!', 'Error en la conexión al servidor.', 'danger');
            }
        });
    };

    var fnEliminarPoligono = function(id) {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=eliminarPoligono",
            type: "POST",
            crossDomain: true,
            data: {
                id: id
            },
            dataType: "json",
            success: function (respuesta) {
                if (respuesta.res == 1) {
                    swal.close();
                    fnObtenerGeojsonPoligonos();
                    swal('Eliminado!', 'El polígono fue eliminado con éxito.', 'success');
                } else {
                    swal.close();
                    swal('Error!', 'No se pudo eliminar el polígono.', 'danger');
                }
            },
            error: function (xhr, status) {
                swal.close();
                swal('Error!', 'Error en la conexión al servidor.', 'danger');
            }
        });
    };

    var fnObtenerGeojsonPoligonos = function() {
        $.ajax({
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getPoligonos",
            type: "POST",
            crossDomain: true,
            data: {},
            dataType: "html",
            success: function (respuesta) {
                poligonosLayer.clearLayers();
                poligonosLayer.addData(JSON.parse(respuesta));
            },
            error: function (xhr, status) {
                swal('Advertencia!', 'Ocurrió un error.', 'warning');
            }
        });
    };

    fnLimpiarConfigPoligonos = function() {
        if (polygonLayerGroup != null) {
            pointLayerGroup.clearLayers();
            polygonLayerGroup.clearLayers();
            polygonArray = [];
            polygonDataset = [];
            pointCounter = 0;
        }
        $('#cboTipoPoly').val('').trigger('change');
        $('#txtCapaNombre').val('');
    };

    var fnObtenerCultivosPoligono = function(id) {
        swal({
            title: 'Cargando!',
            text: 'Procesando datos',
            imageUrl: 'images/loading/loading05.gif',
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false
        });

        $.ajax({
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getCultivosPoligono",
            type: "POST",
            crossDomain: true,
            data: {
                id: id
            },
            dataType: "json",
            success: function (respuesta) {
                swal.close();
                cultivosLayer.clearLayers();
                cultivosLayer.addData(respuesta);
                cultivosCluster.clearLayers();
                cultivosCluster.addLayer(cultivosLayer);
            },
            error: function (xhr, status) {
                swal.close();
                swal('Error!', 'Error en la conexión al servidor.', 'danger');
            }
        });
    };

    var fnObtenerEspeciesPoligono = function(id) {
        swal({
            title: 'Cargando!',
            text: 'Procesando datos',
            imageUrl: 'images/loading/loading05.gif',
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false
        });

        $.ajax({
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getEspeciesPoligono",
            type: "POST",
            crossDomain: true,
            data: {
                id: id
            },
            dataType: "json",
            success: function (respuesta) {
                swal.close();
                especiesLayer.clearLayers();
                especiesLayer.addData(respuesta);
                especiesCluster.clearLayers();
                especiesCluster.addLayer(especiesLayer);
            },
            error: function (xhr, status) {
                swal.close();
                swal('Error!', 'Error en la conexión al servidor.', 'danger');
            }
        });
    };

    var fnObtenerEspeciesNativasPoligono = function(id) {
        swal({
            title: 'Cargando!',
            text: 'Procesando datos',
            imageUrl: 'images/loading/loading05.gif',
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false
        });

        $.ajax({
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getEspeciesNativasPoligono",
            type: "POST",
            crossDomain: true,
            data: {
                id: id
            },
            dataType: "json",
            success: function (respuesta) {
                swal.close();
                especiesNativasLayer.clearLayers();
                especiesNativasLayer.addData(respuesta);
                especiesNativasCluster.clearLayers();
                especiesNativasCluster.addLayer(especiesNativasLayer);
            },
            error: function (xhr, status) {
                swal.close();
                swal('Error!', 'Error en la conexión al servidor.', 'danger');
            }
        });
    };

    var fnObtenerGeojsonCultivosFiltrado = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getCultivosFiltrado",
            type: "POST",
            crossDomain: true,
            data: {
                item: {
                    macroregion: $('#cboFiltroMacroregion').val(),
                    depto: $('#cboFiltroDepto').val(),
                    municipio: $('#cboFiltroMunicipio').val(),
                    categoria: $('#cboFiltroCategoria').val(),
                    especie: $('#cboFiltroEspecie').val(),
                    vinculacion: $('#cboFiltroVinculacion').val(),
                    especie_asocia_cultivo: $('#cboFiltroEspecieAsociaCultivo').val()
                }
            },
            dataType: "html",
            success: function (respuesta) {
                swal.close();
                cultivosLayer.clearLayers();
                cultivosLayer.addData(JSON.parse(respuesta));
                cultivosCluster.clearLayers();
                cultivosCluster.addLayer(cultivosLayer);
            },
            error: function (xhr, status) {
                swal.close();
                swal('Advertencia!', 'Ocurrió un error.', 'warning');
            }
        });
    };

    var fnObtenerGeojsonEspeciesFiltrado = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getEspeciesFiltrado",
            type: "POST",
            crossDomain: true,
            data: {
                item: {
                    macroregion: $('#cboFiltroMacroregion').val(),
                    depto: $('#cboFiltroDepto').val(),
                    municipio: $('#cboFiltroMunicipio').val(),
                    categoria: $('#cboFiltroCategoria').val()
                }
            },
            dataType: "html",
            success: function (respuesta) {
                swal.close();
                especiesLayer.clearLayers();
                especiesLayer.addData(JSON.parse(respuesta));
                especiesCluster.clearLayers();
                especiesCluster.addLayer(especiesLayer);
            },
            error: function (xhr, status) {
                swal.close();
                swal('Advertencia!', 'Ocurrió un error.', 'warning');
            }
        });
    };

    var fnObtenerGeojsonEspeciesNativasFiltrado = function() {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=consultas_getEspeciesNativasFiltrado",
            type: "POST",
            crossDomain: true,
            data: {
                macroregion: $('#cboFiltroMacroregion').val(),
                depto: $('#cboFiltroDepto').val(),
                municipio: $('#cboFiltroMunicipio').val()
            },
            dataType: "html",
            success: function (respuesta) {
                swal.close();
                especiesNativasLayer.clearLayers();
                especiesNativasLayer.addData(JSON.parse(respuesta));
                especiesNativasCluster.clearLayers();
                especiesNativasCluster.addLayer(especiesNativasLayer);
            },
            error: function (xhr, status) {
                swal.close();
                swal('Advertencia!', 'Ocurrió un error.', 'warning');
            }
        });
    };

    var fnLimpiarReportes = function() {
        $('#cboReporteMacroregion').val(null).trigger('change');
        $('#cboReporteDepto').val(null).trigger('change');
    };

    var fnLimpiarFiltros = function() {
        $('#cboFiltroMacroregion').val(null).trigger('change');
        $('#cboFiltroDepto').val(null).trigger('change');
        $('#cboFiltroMunicipio').val(null).trigger('change');

        $('#cboFiltroCategoria').val(null).trigger('change');

        $('#cboFiltroEspecie').val(null).trigger('change');
        $('#cboFiltroVinculacion').val(null).trigger('change');
        $('#cboFiltroEspecieAsociaCultivo').val(null).trigger('change');
    };

    var fnObtenerMunicipios = function () {
        var deptoId = cboFiltroDepto.val();
        cboFiltroMunicipio.empty();
        if(deptoId!="") {
            $.post("{/literal}{$getModule}{literal}&accion=obtenerMunicipios"
                , {deptoId: deptoId}
                , function (respuesta, textStatus, jqXHR) {
                    for (var clave in respuesta) {
                        cboFiltroMunicipio.append($('<option></option>').attr("value", respuesta[clave].itemId).text(respuesta[clave].nombre));
                    }
                }
                , 'json');
        }
    };

    fn_crear_capa_shapefile = function(geojson, name, group) {
        name = '&nbsp;'+name;
        var geojsonLayer = {
            active: true,
            name: name,
            icon: '<i class="fa fa-map-marked-alt"></i>',
            layer: L.shapefile(geojson)
        };
        controlLayers.addOverlay(geojsonLayer, name, group);
    };

    fn_cargar_archivo_shapefile = function(file, name, group) {
        var reader = new FileReader();
        reader.onload = function() {
            if (reader.readyState != 2 || reader.error) {
                return;
            } else {
                shp(reader.result).then(function(geojson) {
                    fn_crear_capa_shapefile(geojson, name, group);
                });
            }
        };
        reader.readAsArrayBuffer(file);
    };

    fn_obtener_capas_wms = function(url) {
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
            url: "?module=agrobiodiversidad&smodule=geovisor&accion=obtenerCapasWms",
            type: "POST",
            crossDomain: true,
            data: {wms_url: url},
            dataType: "html",
            success: function (response) {
                swal.close();
                var x2js = new X2JS();
                var jsonObj = x2js.xml_str2json(response);
                var capas = jsonObj.WMT_MS_Capabilities.Capability.Layer.Layer;
                //console.log(capas);
                //console.log(capas.length);
                var wms_capa = $('#wms_capa');
                wms_capa.empty();
                for (var i = 0; i < capas.length; i++) {
                    //console.log(capas[i].Name);
                    wms_capa.append($('<option></option>').attr("value", capas[i].Name).text(capas[i].Name));
                }
            },
            error: function (xhr, status) {
                swal.close();
                swal('Advertencia!', 'Ocurrió un error.', 'warning');
            }
        });
    };

    fn_crear_capa_tile = function(url, layer, group, alias) {
        alias = '&nbsp;'+alias;
        var wmsLayer = {
            active: true,
            name: alias,
            icon: '<i class="fa fa-map-marked-alt"></i>',
            layer: L.tileLayer.wms(url, {
                layers: layer,
                transparent: true,
                format: 'image/png'
            })
        };
        controlLayers.addOverlay(wmsLayer, alias, group);
    };

    var fnMostrarInicio = function() {
        window.open('?module=agrobiodiversidad&smodule=index', '_self');
    };

    var fnMostrarVentanaShapefile = function() {
        window.open('?module=agrobiodiversidad&smodule=shapefile', '_blank');
    };

    fnDescargarShapefile = function(id, nombre) {
        swal({
            title: 'Cargando!',
            text: 'Procesando datos',
            imageUrl: 'images/loading/loading05.gif',
            showConfirmButton: false,
            allowEnterKey: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
        });

        var url = '?module=agrobiodiversidad&smodule=geovisor&accion=descargarShapefile&id='+id;
        fetch(url)
        .then(res => res.blob())
        .then(blob => {
            var reader = new FileReader();
            reader.onload = function() {
                if (reader.readyState != 2 || reader.error) {
                    swal.close();
                    swal('Advertencia!', 'No se pudo descargar el archivo shapefile.', 'warning');
                    //return;
                } else {
                    swal.close();
                    shp(reader.result).then(function(geojson) {
                        fn_crear_capa_shapefile(geojson, nombre, "MIS CAPAS");
                    });
                }
            };
            reader.readAsArrayBuffer(blob);
        });
    };

    var fnObtenerUrlShapefiles = function() {
        return '?module=agrobiodiversidad&smodule=geovisor&accion=listarShapefiles';
    };

    var fnDatatableShapefiles = function() {
        dtListaShapefiles = $('#dtShapefiles').DataTable({
            language: {"url": "language/datatable.spanish.json"},
            ajax: fnObtenerUrlShapefiles(),
            columnDefs: [
                {
                    targets: [0],
                    title: 'Acción',
                    orderable: false, 
                    render: function(data, type, full, meta) {
                        var boton = '<a class="btn btn-primary btn-sm" href="javascript:;" onclick="fnDescargarShapefile(\''+data+'\',\''+full[1]+'\')">Agregar capa</a>';
                        return boton;
                    }
                }
            ]
        });
    };

    fnImprimirDiv = function(nombreDiv) {
        var elemento = document.getElementById(nombreDiv);
        var ventanaImpresion = window.open(' ', 'PRINT');
        ventanaImpresion.document.write('<html><head><title>Información Reporte</title>');
        ventanaImpresion.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">');
        ventanaImpresion.document.write('</head><body><div class="container"><div class="row"><div class="col-lg-6">');
        ventanaImpresion.document.write('<h2>INFORMACIÓN REPORTE</h2>');
        ventanaImpresion.document.write(elemento.innerHTML);
        ventanaImpresion.document.write('</div></div></div></body></html>');
        ventanaImpresion.document.close();
        ventanaImpresion.focus();
        ventanaImpresion.onload = function () {
            ventanaImpresion.print();
            ventanaImpresion.close();
        };
        return true;
    };

    /**
     * FUNCIÓN DEFINE ACCIONES
     */
    var handle_actions = function() {
        btn_mostrar_ventana_capas.click(function() {
            fnMostrarVentanaCapas();
        });

        btn_cerrar_ventana_capas.click(function() {
            fnCerrarVentanaCapas();
        });
        
        btn_centrar_mapa.click(function() {
            fnCentrarMapa();
        });

        btn_mostrar_ventana_reportes.click(function() {
            if (bnd_ventana_reportes == 0) {
                bnd_ventana_reportes = 1;
                fnMostrarVentanaReportes();
            } else {
                bnd_ventana_reportes = 0;
                fnCerrarVentanaReportes();
            }
        });

        cboTipoReporte.change(function() {
            if (cboTipoReporte.val() == 1) {
                fnLimpiarReportes();
                $('#cboReporteMacroregion').attr('disabled', true);
                $('#cboReporteDepto').attr('disabled', true);
            } else if (cboTipoReporte.val() == 2) {
                fnLimpiarReportes();
                $('#cboReporteMacroregion').attr('disabled', false);
                $('#cboReporteDepto').attr('disabled', true);
            } else if (cboTipoReporte.val() == 3) {
                fnLimpiarReportes();
                $('#cboReporteMacroregion').attr('disabled', true);
                $('#cboReporteDepto').attr('disabled', false);
            }
        });

        btnVerReporte.click(function() {
            if (cboTipoReporte.val() == 1) {
                fnObtenerGeojsonEspecies();
                fnObtenerGeojsonCultivos();
                fnObtenerDatosGeneral();
            } else if (cboTipoReporte.val() == 2) {
                if ($('#cboReporteMacroregion').val() != '') {
                fnObtenerGeojsonEspecies();
                fnObtenerGeojsonCultivos();
                fnObtenerDatosMacroregion();
                } else {
                    swal('Advertencia', 'Seleccione datos en el campo macroregión.', 'warning');
                }
            } else if (cboTipoReporte.val() == 3) {
                if ($('#cboReporteDepto').val() != '') {
                    fnObtenerGeojsonEspecies();
                    fnObtenerGeojsonCultivos();
                    fnObtenerDatosCobertura();
                } else {
                    swal('Advertencia', 'Seleccione datos en el campo departamento.', 'warning');
                }
            }
        });

        btnLimpiarReporte.click(function() {
            fnLimpiarReportes();
        });

        btnCerrarReporte.click(function() {
            bnd_ventana_reportes = 0;
            fnCerrarVentanaReportes();
        });

        btn_mostrar_ventana_filtros.click(function() {
            if (bnd_ventana_filtros == 0) {
                bnd_ventana_filtros = 1;
                fnMostrarVentanaFiltros();
            } else {
                bnd_ventana_filtros = 0;
                fnCerrarVentanaFiltros();
            }
        });

        btnFiltrar.click(function() {
            fnObtenerGeojsonEspeciesFiltrado();
            fnObtenerGeojsonCultivosFiltrado();
            fnObtenerGeojsonEspeciesNativasFiltrado();
        });

        btnLimpiarFiltro.click(function() {
            fnLimpiarFiltros();
        });

        btnCerrarFiltro.click(function() {
            bnd_ventana_filtros = 0;
            fnCerrarVentanaFiltros();
        });

        cboFiltroDepto.on('change', function() {
            fnObtenerMunicipios();
        });

        btn_mostrar_ventana_poly.click(function() {
            if (bnd_ventana_poly == 0) {
                bnd_ventana_poly = 1;
                fnMostrarVentanaPoly();
            } else {
                bnd_ventana_poly = 0;
                bnd_point_poly = 0;
                $('#cboTipoPoly').val('').trigger('change');
                fnCerrarVentanaPoly();
            }
        });

        cboTipoPoly.change(function() {
            bnd_point_poly = 1;
            polygonSides = $('#cboTipoPoly').val();
        });

        btnGuardarPoly.click(function() {
            if (polygonDataset.length != 0 && $('#txtCapaNombre').val() != '') {
                fnGuardarPoligono();
            } else {
                swal('Advertencia', 'Escriba el nombre y dibuje el polígono.', 'warning');
            }
        });

        btnCerrarPoly.click(function() {
            bnd_ventana_poly = 0;
            bnd_point_poly = 0;
            $('#cboTipoPoly').val('').trigger('change');
            fnLimpiarConfigPoligonos();
            fnCerrarVentanaPoly();
        });

        btnLimpiarPoly.click(function() {
            fnLimpiarConfigPoligonos();
        });

        $(document).on('click', '.app-popup-delete', function() {
            var id = $(this).attr('data-itemid');
            swal({
                title: 'Está seguro de borrar el polígono?',
                text: "Recuerde que el polígono se eliminará permanentemente. ID="+id+".",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!!!',
                cancelButtonText: "No, cancelar"
            }).then(function(result) {
                if (result.value) {
                    fnEliminarPoligono(id);
                }
            });
        });

        $(document).on('click', '.app-popup-consulta', function() {
            var id = $(this).attr('data-itemid');
            fnObtenerCultivosPoligono(id);
            fnObtenerEspeciesPoligono(id);
            fnObtenerEspeciesNativasPoligono(id);
        });

        btn_mostrar_capa_externa.click(function() {
            modal_capa_externa.modal('show');
        });

        form_capa_externa.submit(function(event) {
            var nombre = $('#ext_nombre').val();
            var grupo = '<strong>EXTERNAS</strong>';
            var archivos = document.getElementById('ext_archivo').files;

            if (archivos.length == 0) {
                return;
            }

            var archivo = archivos[0];
            var extension = archivo.name.slice(-4);

            switch(extension) {
                case '.zip':
                    fn_cargar_archivo_shapefile(archivo, nombre, grupo);
                    modal_capa_externa.modal('hide');
                    form_capa_externa.get(0).reset();
                    break;
                default:
                    swal('Advertencia!', 'Seleccione un archivo shapefile (comprimido .zip)', 'warning');
                    break;
            }
            event.preventDefault();
        });

        btn_mostrar_capa_wms.click(function() {
            modal_capa_wms.modal('show');
        });

        form_capa_wms.submit(function(event) {
            var url = txt_wms_url.val();
            var capa = cbo_wms_capa.val();
            var alias = $('#wms_alias').val();
            var grupo = '<strong>WMS</strong>';
            if (alias == '') {
                alias = capa;
            }
            fn_crear_capa_tile(url, capa, grupo, alias);
            modal_capa_wms.modal('hide');
            event.preventDefault();
        });

        btn_wms_lista.click(function() {
            var url = txt_wms_url.val()+'service=WMS&version=1.0.0&request=GetCapabilities';
            if (txt_wms_url.val() != '') {
                fn_obtener_capas_wms(url);
            }
        });

        $('#btn_mostrar_inicio').on('click', function() {
            fnMostrarInicio();
        });

        $('#btn_mostrar_ventana_shapefile').on('click', function() {
            $("#modal_shapefile").modal("show");
        });

        $('#btnActualizarListaShapefiles').on('click', function() {
            dtListaShapefiles.clear().draw();
            dtListaShapefiles.ajax.url(fnObtenerUrlShapefiles()).load();
        });
    };

    /**
     * FUNCIÓN DEFINE ESTADOS
     */
    var handle_states = function() {
        fnCerrarVentanaCapas();
        fnCerrarVentanaReportes();
        fnCerrarVentanaFiltros();
        fnCerrarVentanaPoly();
        fnObtenerGeojsonEspecies();
        fnObtenerGeojsonCultivos();
        fnObtenerGeojsonEspeciesNativas();
        fnObtenerDatosGeneral();
        fnObtenerGeojsonPoligonos();
        fnLimpiarReportes();
        fnLimpiarFiltros();
        fnDatatableShapefiles();

        $('.select2').select2({
            placeholder: "--Seleccione una opción--"
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