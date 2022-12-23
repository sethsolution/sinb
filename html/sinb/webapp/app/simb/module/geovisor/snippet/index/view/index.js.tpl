{*
https://leaflet-extras.github.io/leaflet-providers/preview/
*}
<script src="https://maps.googleapis.com/maps/api/js?key={$google_map_key}"></script>
<script src="/js/geo/leaflet.1.7.1/leaflet.js"></script>


<script src="/js/geo/leaflet.spin/example/spin/dist/spin.min.js"></script>
<script src="/js/geo/leaflet.spin/leaflet.spin.min.js"></script>

<script src="/js/geo/leaflet.sidebar-v2/js/leaflet-sidebar.js"></script>


<script src="/js/geo/leaflet.extramarkers/dist/js/leaflet.extra-markers.js">

<script src="/js/geo/leaflet.fullscreen/Control.FullScreen.js"></script>
<script src="/js/geo/Leaflet.GoogleMutant.js"></script>

<script src="/js/geo/leaflet.ajax/dist/leaflet.ajax.js"></script>
<script src="/js/geo/leaflet.ajax/example/spin.js"></script>

<!--script src="/js/geo/leaflet.groupedlayercontrol/dist/leaflet.groupedlayercontrol.min.js"></script-->
<script src="/js/geo/leaflet.panel-layers/dist/leaflet-panel-layers.min.js"></script>
<script src="/js/geo/leaflet.wms/dist/leaflet.wms.js"></script>
<script src="/js/geo/leaflet.minimap/dist/Control.MiniMap.min.js"></script>
<script src="/js/geo/leaflet.control.custom/Leaflet.Control.Custom.js"></script>


<script src="/js/geo/leaflet.wms-legend/leaflet.wmslegend.js"></script>


<script src="/js/geo/leaflet.gibs/src/GIBSMetadata.js"></script>
<script src="/js/geo/leaflet.gibs/src/GIBSLayer.js"></script>

<script src="/js/chart.js/Chart.min.js"></script>


{literal}
<script>
    var filtro_var="";
    var filtro_departamento, filtro_programa;
    var filtro_estado,filtro_gd_tipo_fuente_generacion;
    var urlsys = '{/literal}{$path_url}{literal}';
    var urljson = urlsys+'/get.point';

    var json_layer;
    var recargar;
    var fechaver,fechavernasa;



    var snippet_tab_item = function () {
        var borra_contenido_tabs = function () {
            {/literal}
            {foreach from=$menu_tab item=row key=idx}
            $("#{$row.id_name}_pane").html("");
            {/foreach}
            {literal}
            reset_estado();
        };
        var handler_tab_build = function(){
            $('[data-toggle="tabajax"]').click(function(e) {
                e.preventDefault();
                var $this = $(this),
                    loadurl = $this.attr('data-href') + filtro_var,
                    targ = $this.attr('data-target');
                id_name =targ;
                targ = "#"+targ+"_pane";
                //Vaciamos el tab
                recargar = 0;
                switch(id_name) {
                {/literal}
                {foreach from=$menu_tab item=row key=idx}
                    case '{$row.id_name}':
                        if ({$row.id_name}_var ==0){
                            {$row.id_name}_var =1;
                            recargar = 1;
                        }
                        break;
                {/foreach}
                {literal}
                }

                if(recargar==1){
                    borra_contenido_tabs();
                    cargando = "<div style='text-align: center;padding-top: 50px;'>Cargando datos...</div>";
                    $(targ).html(cargando);
                    $.get(loadurl, function(data) {
                        $(targ).html(data);
                    });

                    switch(id_name) {
                    {/literal}
                    {foreach from=$menu_tab item=row key=idx}
                        case '{$row.id_name}':
                            {$row.id_name}_var =1;
                            break;
                    {/foreach}
                    {literal}
                    }
                }

                return false;
            });
        };


        {/literal}
        {foreach from=$menu_tab item=row key=idx}
        var {$row.id_name}_var;
        {/foreach}
        {literal}


        var reset_estado = function(){
            {/literal}
            {foreach from=$menu_tab item=row key=idx}
            {$row.id_name}_var = 0;
            {/foreach}
            {literal}
        };

        return {
            init: function() {
                handler_tab_build();
                reset_estado();
            },
            reset_estado: function () {
                reset_estado();
            }
        };
    }();



    var map;
    var snippet_geovisor = function () {

        var map_default_center = [-17.403918, -64.354500];
        var map_default_zoom= 6;
        var geoserver_mmaya = '/geoserver/wms';
        var geoserver_sig01 = 'https://sig01.mmaya.gob.bo/geoserver/wms';
        var layer_departamento,layer_municipio;
        var uh_nivel1,uh_nivel2,uh_nivel3,uh_nivel4,uh_nivel5, macroregion,cuencas_operativas;

        /**
         * configuración de variables de los departamentos segun geoserver para geosiarh
         */

        var departamento_geo = {
            "2": "Beni",
            "9": "Chuquisaca",
            "1": "Cochabamba",
            "3": "La Paz",
            "6": "Oruro",
            "5": "Pando",
            "4": "Potosí",
            "8": "Santa Cruz",
            "7": "Tarija"
        };
        var iconByName = function(name) {
            return '<i class="icon icon-'+name+'"></i>';
        };
        var getBaseLayers = function(){

            var Stamen_Terrain = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/terrain/{z}/{x}/{y}{r}.{ext}', {
                attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                subdomains: 'abcd',
                minZoom: 0,
                maxZoom: 18,
                ext: 'png'
            });
            var Stadia_AlidadeSmooth =  L.tileLayer(
                'https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.png?api_key={apikey}', {
                    maxZoom: 20,
                    attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>',
                    apikey:"{/literal}{$stadiamaps_key}{literal}",
                }).addTo(map);

            mapLink = '<a href="https://openstreetmap.org">OpenStreetMap</a>';
            osmLayer = L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; ' + mapLink + ' Contributors',
                    maxZoom: 19,
                    id: 'osm'
                });

            OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                maxZoom: 17,
                attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="https://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
            });
            googleHybrid = L.gridLayer.googleMutant({
                maxZoom: 24,
                type: "hybrid", // valid values are 'roadmap', 'satellite', 'terrain' and 'hybrid'
            });

            var baseLayers = [{
                group: "Mapas Base",
                icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                collapsed: true,
                layers: [
                    { name: "Stamen Terrain", layer: Stamen_Terrain},
                    { name: "Stadia Alidade Smooth", layer: Stadia_AlidadeSmooth},
                    { name: "OpenStreetMap", layer: osmLayer},
                    { name: "OpenTopoMap", layer: OpenTopoMap},
                    { name: "Google Hybrid", layer: googleHybrid}
                ]
            }];
            return baseLayers;
        };
        var getGroupedOverlays = function(){
            /**
             * Base
             */
            layer_departamento = L.tileLayer.wms(geoserver_mmaya+'?', {
                layers: 'sinb:departamento',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.5,
                //styles:'siarh_geovisor_rojo'
            });
            layer_municipio = L.tileLayer.wms(geoserver_mmaya+'?', {
                layers: 'sinb:municipio',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 1,
            });

            uh_nivel1 = L.tileLayer.wms(geoserver_mmaya+'?', {
                layers: 'sinb:uh_nivel1',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.5
            });
            uh_nivel2 = L.tileLayer.wms(geoserver_mmaya+'?', {
                layers: 'sinb:uh_nivel2',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.5
            });
            uh_nivel3 = L.tileLayer.wms(geoserver_mmaya+'?', {
                layers: 'sinb:uh_nivel3',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.5
            });
            uh_nivel4 = L.tileLayer.wms(geoserver_mmaya+'?', {
                layers: 'sinb:uh_nivel4',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.5
            });
            uh_nivel5 = L.tileLayer.wms(geoserver_mmaya+'?', {
                layers: 'sinb:uh_nivel5',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.5
            });
            macroregion = L.tileLayer.wms(geoserver_mmaya+'?', {
                layers: 'sinb:macroregion',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.5
            });
            cuencas_operativas = L.tileLayer.wms(geoserver_mmaya+'?', {
                layers: 'sinb:51_cuencas_operativas',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.5
            });

            var ecorregiones_ibish = L.tileLayer.wms(geoserver_mmaya+'?', {
                layers: 'sinb:ecorregiones_ibish',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.5
            });

            var areas_protegidas = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'areas_protegidas',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });
            var reservas_forestales = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'reservas_forestales',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });
            var deforestacion = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'deforestacion',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });

            //L.wmsLegend(geoserver_sig01 + '?REQUEST=GetLegendGraphic&VERSION=1.0.0&FORMAT=image/png&WIDTH=20&HEIGHT=20&LAYER=simb:deforestacion','test',"bottomleft");

            var view_bosques = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'view_bosques',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });

            var OWM_API_KEY = "984e73b3563940808aaece5ffcbfa7c1";
            var clima_nubes = L.tileLayer('https://tile.openweathermap.org/map/{layer}/{z}/{x}/{y}.png?appid={appId}', {
                maxZoom: 17,
                opacity: 0.8,
                layer: "clouds" ,
                appId: OWM_API_KEY,
//                legendImagePath: 'https://simb.siarh.gob.bo/simb/resources/leaflet/openweathermap/files/NT2.png',
            });
            var clima_precipitacion = L.tileLayer('https://tile.openweathermap.org/map/{layer}/{z}/{x}/{y}.png?appid={appId}', {
                maxZoom: 17,
                opacity: 0.8,
                layer: "precipitation_cls" ,
                appId: OWM_API_KEY,
            });
            var clima_temperatura = L.tileLayer('https://tile.openweathermap.org/map/{layer}/{z}/{x}/{y}.png?appid={appId}', {
                maxZoom: 17,
                opacity: 0.8,
                layer: "temp" ,
                appId: OWM_API_KEY,
            });
            var clima_viento = L.tileLayer('https://tile.openweathermap.org/map/{layer}/{z}/{x}/{y}.png?appid={appId}', {
                maxZoom: 17,
                opacity: 0.8,
                layer: "wind" ,
                appId: OWM_API_KEY,
            });


            var redvial_principal = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'caminos_principales',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });
            var redvial_secundario = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'caminos_secundarios',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });

            var saludedu_salud = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'establ_salud',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });
            var saludedu_educacion = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'establ_educacion',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });

            var hidro_rios_principales = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'rios_principales',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });
            var hidro_rios_secundarios = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'rios_secundarios',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });
            var hidro_lagunas = L.tileLayer.wms(geoserver_sig01+'?', {
                layers: 'lagunas',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });

            var geoserver_senamhi="https://bolivia.dewetra.cimafoundation.org/geoserver/simb/wms";
            var senamhi_temperatura = L.tileLayer.wms(geoserver_senamhi+'?', {
                layers: 'CPTEC_WRF5KM-Temperature',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });
            var senamhi_humedad = L.tileLayer.wms(geoserver_senamhi+'?', {
                layers: 'CPTEC_WRF5KM-Relative_humidity',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });
            var senamhi_precipitacion_acumulada = L.tileLayer.wms(geoserver_senamhi+'?', {
                layers: 'CPTEC_WRF5KM-Total_precipitation',
                format: 'image/png',
                uppercase: true,
                transparent: true,
                continuousWorld : true,
                opacity: 0.8
            });

            var geoserver_mnhn = "http://sib.mnhn.gob.bo/geoserver/wms";
            var mnhn_geologia = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:geologia',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });
            var mnhn_ecoregiones = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:ecoregion',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });
            var mnhn_vegetacion = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:vegetacion',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });
            var mnhn_Apn = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:areas_prot_nal',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });
            var mnhn_Apm = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:areas_prot_mun',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });
            var mnhn_Apd = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:areas_prot_dep',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });
            var mnhn_sitiosramsar = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:sitios_ramsar',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });
            var mnhn_biogeografia = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:geologia',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });
            var mnhn_zonasvida = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:zonasvida',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });
            var mnhn_reservasforestales = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:reservasforestales',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });
            var mnhn_tcos = L.tileLayer.wms(geoserver_mnhn+'?', {
                layers: 'bioadmin:tcos',
                format: 'image/png',
                transparent: true,
                opacity: 0.8
            });

            //var dia = '2022/11/26';
            var dia = fechaver;

            var nasa_01 = new L.GIBSLayer('VIIRS_CityLights_2012', {
                date: new Date(dia),
                transparent: true,
                opacity: 0.8
            });

            var nasa_02 = new L.GIBSLayer('VIIRS_SNPP_CorrectedReflectance_TrueColor', {
                date: new Date(dia),
                transparent: true,
                opacity: 0.8
            });
            var nasa_03 = new L.GIBSLayer('VIIRS_SNPP_CorrectedReflectance_BandsM11-I2-I1', {
                date: new Date(dia),
                transparent: true,
                opacity: 0.8
            });

            var nasa_04 = new L.GIBSLayer('VIIRS_SNPP_CorrectedReflectance_BandsM3-I3-M11', {
                date: new Date(dia),
                transparent: true,
                opacity: 0.8
            });



            var nasa_modis_01 = new L.GIBSLayer('MODIS_Terra_Land_Surface_Temp_Day', {
                date: new Date(dia),
                transparent: true,
                opacity: 0.8
            });
            var nasa_modis_02 = new L.GIBSLayer('MODIS_Terra_Land_Surface_Temp_Night', {
                date: new Date(dia),
                transparent: true,
                opacity: 0.8
            });
            var nasa_modis_03 = new L.GIBSLayer('MODIS_Terra_Brightness_Temp_Band31_Day', {
                date: new Date(dia),
                transparent: true,
                opacity: 0.8
            });
            var nasa_modis_04 = new L.GIBSLayer('MODIS_Terra_Brightness_Temp_Band31_Night', {
                date: new Date(dia),
                transparent: true,
                opacity: 0.8
            });

            var overLayers =[
                {
                    group: "NASA",
                    collapsed: true,
                    layers: [
                        {
                            active: false,
                            name: "VIIRS CityLights 2012",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: nasa_01
                        },
                        {
                            active: false,
                            name: "VIIRS SNPP CorrectedReflectance TrueColor",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: nasa_02
                        },
                        {
                            active: false,
                            name: "VIIRS SNPP CorrectedReflectance Bands M11-I2-I1",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: nasa_03
                        },
                        {
                            active: false,
                            name: "VIIRS SNPP CorrectedReflectance Bands M3I3-M11",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: nasa_04
                        },
                        {
                            active: false,
                            name: "MODIS Terra Land Surface Temp Day",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: nasa_modis_01
                        },
                        {
                            active: false,
                            name: "MODIS Terra Land Surface Temp Night",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: nasa_modis_02
                        },
                        {
                            active: false,
                            name: "MODIS Terra Brightness Temp Band31 Day",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: nasa_modis_03
                        },
                        {
                            active: false,
                            name: "MODIS Terra Brightness Temp Band31 Night",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: nasa_modis_04
                        },
                    ]
                },
                {
                    group: "Administrativos",
                    collapsed: true,
                    layers: [
                        {
                            active: true,
                            name: "Departamento",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: layer_departamento
                        },
                        {
                            name: "Municipio",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: layer_municipio
                        }

                    ]
                },
                {
                    group: "Unidad Hidrográfica",
                    collapsed: true,
                    layers: [
                        {
                            active: false,
                            name: "UH Nivel5",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: uh_nivel5
                        },
                        {
                            active: false,
                            name: "UH Nivel4",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: uh_nivel4
                        },
                        {
                            active: false,
                            name: "UH Nivel3",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: uh_nivel3
                        },
                        {
                            active: false,
                            name: "UH Nivel2",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: uh_nivel2
                        },
                        {
                            active: false,
                            name: "UH Nivel1",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: uh_nivel1
                        },
                    ]
                },

                {
                    group: "Bosques y Conservación",
                    collapsed: true,
                    layers: [
                        {
                            active: false,
                            name: "Áreas protegidas",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: areas_protegidas,
                        },
                        {
                            active: false,
                            name: "Reservas Forestales",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: reservas_forestales,
                        },
                        {
                            active: false,
                            name: "Deforestación",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: deforestacion,
                        },
                        {
                            active: false,
                            name: "Bosques",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: view_bosques,
                        },
                    ]
                },

                {
                    group: "Biodiversidad",
                    collapsed: true,
                    layers: [
                        {
                            active: false,
                            name: "Mapa Geológico",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_geologia,
                        },
                        {
                            active: false,
                            name: "Ecorregiones",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_ecoregiones,
                        },
                        {
                            name: "Ecorregiónes Ibish",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: ecorregiones_ibish
                        },
                        {
                            active: false,
                            name: "Vegetación",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_vegetacion,
                        },
                        {
                            active: false,
                            name: "Áreas Protegidas Nacional",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_Apn,
                        },
                        {
                            active: false,
                            name: "Áreas Protegidas Departamental",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_Apd,
                        },
                        {
                            active: false,
                            name: "Áreas Protegidas Municipal",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_Apm,
                        },
                        {
                            active: false,
                            name: "Sitios Ramsar",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_sitiosramsar,
                        },
                        {
                            active: false,
                            name: "Provincias biogeográficas",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_biogeografia,
                        },
                        {
                            active: false,
                            name: "Zonas de vida",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_zonasvida,
                        },
                        {
                            active: false,
                            name: "Reservas forestales",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_reservasforestales,
                        },
                        {
                            active: false,
                            name: "TCOs",
                            icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: mnhn_tcos,
                        },

                    ]
                },


                {
                    group: "Servicios climáticos globales",
                    collapsed: true,
                    layers: [
                        {
                            active: false,
                            name: "Nubes",
                            //icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: clima_nubes,
                        },
                        {
                            active: false,
                            name: "Precipitación",
                            //icon: '<i class="fa fa-map-marked-alt icon-sm"></i>',
                            layer: clima_precipitacion,
                        },
                        {
                            active: false,
                            name: "Temperatura",
                            layer: clima_temperatura,
                        },
                        {
                            active: false,
                            name: "Viento",
                            layer: clima_viento,
                        },
                    ]
                },
                {
                    group: "Red vial",
                    collapsed: true,
                    layers: [
                        {
                            active: false,
                            name: "Caminos Principales",
                            layer: redvial_principal,
                        },
                        {
                            active: false,
                            name: "Caminos Secundarios",
                            layer: redvial_secundario,
                        },
                    ]
                },
                {
                    group: "Salud y Educación",
                    collapsed: true,
                    layers: [
                        {
                            active: false,
                            name: "Establecimientos de salud",
                            layer: saludedu_salud,
                        },
                        {
                            active: false,
                            name: "Establecimientos de Educación",
                            layer: saludedu_educacion,
                        },
                    ]
                },
                {
                    group: "Hidrología",
                    collapsed: true,
                    layers: [
                        {
                            active: false,
                            name: "Ríos Principales",
                            layer: hidro_rios_principales,
                        },
                        {
                            active: false,
                            name: "Ríos Secundarios",
                            layer: hidro_rios_secundarios,
                        },
                        {
                            active: false,
                            name: "Lagunas",
                            layer: hidro_lagunas,
                        },
                    ]
                },
                {
                    group: "SENAMHI",
                    collapsed: true,
                    layers: [
                        {
                            active: false,
                            name: "Temperatura a 2 m hora: 18:00",
                            layer: senamhi_temperatura,
                        },
                        {
                            active: false,
                            name: "Humedad relativa % hora: 1800",
                            layer: senamhi_humedad,
                        },
                        {
                            active: false,
                            name: "Precipitación acumulada de las 24h",
                            layer: senamhi_precipitacion_acumulada,
                        },
                    ]
                },
            ];
            return overLayers;
        };


        var initialiseMap = function(){
            var mapOptions = {
                center: map_default_center//punto
                , zoom: map_default_zoom
                ,fullscreenControl: true
                ,scrollWheelZoom: true
            };
            var m = L.map('map',mapOptions);
            L.control.scale({metric: true, imperial: false}).addTo(m);
            return m;
        };

        var getIconStyle = function(cate,fuente){
            if(cate === null){
                cate = 0;
            }
            var icons1 = [
                { markerColor: '#a5a5a5'}, //nada *
                { markerColor: 'purple'}, //CERRADO *
                { markerColor: 'violet'}, //PARALIZADO *
                { markerColor: '#ff00f0'}, //DEBITO *
                { markerColor: 'green'}, //CONCLUIDO *
                { markerColor: '#bf0101'}, //CANCELADO *
                { markerColor: 'cyan'}, //EJECUCION *
                { markerColor: 'yellow'}, //PROGRAMADO *
            ];
            var icons2 = [
                { icon: 'fa-compress',shape: 'circle'}, //nada *
                { icon: 'fa-lock',shape: 'circle'}, //CERRADO
                { icon: 'fa-hand-paper',shape: 'circle'}, //PARALIZADO *
                { icon: 'fa-fan',shape: 'square'}, //DEBITO
                { icon: 'fa-check',shape: 'star'}, //CONCLUIDO *
                { icon: 'fa-times-circle',shape: 'circle'}, //CANCELADO *
                { icon: 'fa-thumbs-up',shape: 'star'}, //EJECUCION *
                { icon: 'fa-clock',shape: 'penta'}, //PROGRAMADO *
            ];
            let resp = L.ExtraMarkers.icon({
                //icon: icons2[fuente].icon,
                icon: icons2[cate].icon,
                markerColor: icons1[cate].markerColor,
                shape: icons2[cate].shape,
                svg:true,
                prefix: 'fa'
            });
            return resp;
        };


        var sumarDias = function(fecha, dias){
            fecha.setDate(fecha.getDate() + dias);
            return fecha;
        }

        var createMap = function(){
            var mapDiv = $('#map');
            mapDiv.parent().addClass("p-0");
            $('#kt_content').addClass("p-0");


            fechaver = new Date();
            // si la hora es menor a las 9 de la mañana, se resta 1 dia.
            if(fechaver.getHours()<=9){
                fechaver = sumarDias(fechaver,-1);
            }
            fechaver = fechaver.toISOString().slice(0, 10);
            fechavernasa = fechaver.replace('-', '/');

            console.log(fechaver);
            console.log(fechavernasa);
            var  urljson2 = "https://simb.siarh.gob.bo/simb/heatjson/geojson_heat_sources?departaments=0&provincia=&municipio=&satelite=&fecha_inicial="+fechaver+"&fecha_final=&apn=&apd=&apm=";

            map = initialiseMap();

            json_layer = new L.GeoJSON.AJAX([urljson2],{
                pointToLayer: function(point, latlng) {
                    //let ic = getIconStyle(point.properties["gd_categoria_id"],point.properties["gd_tipo_fuente_generacion_id"]);
                    /*
                    let ic = getIconStyle(point.properties["estado_id"],2);
                    return L.marker(latlng, {icon: ic});

                     */
                    //return L.marker(latlng);
                    return new L.CircleMarker(latlng, {
                        radius: 5,
                        fillOpacity: 0.50,
                        fillColor: "#ffae00",
                        color: "#8b4500",
                        weight: 1,
                        //color: 'orange'
                    });
                },
                onEachFeature:popUp

            }).addTo(map);

            /**
             * Mini Mapa
             */
            var osmUrl='https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            var osmAttrib='';
            var osm2 = new L.TileLayer(osmUrl, {minZoom: 0, maxZoom: 13, attribution: osmAttrib });
            var miniMap = new L.Control.MiniMap(osm2, {
                toggleDisplay: true,
                minimized: true,
                position: "bottomleft",
                //collapsedWidth: 25,
                //collapsedHeight: 25,
                //zoomLevelFixed: 3
            }).addTo(map);

            var sidebar = L.control.sidebar({ container: 'sidebar' }).addTo(map);

            /**
             * Geoserver
             */
            var options = {
                compact: true,
                collapsibleGroups: true,
                className: "sinb-group",
                //collapsed: !0,
                //title:"Mapas",
            };
            //layerControl = L.control.groupedLayers(getBaseLayers(), getGroupedOverlays(), options).addTo(map);
            var controlLayers = new L.Control.PanelLayers(getBaseLayers(), getGroupedOverlays(), options);
            map.addControl(controlLayers);
            //controlLayers._map = map;
            //var panelLayers = controlLayers.onAdd(map);
            //$('#vista_control_capas').append(panelLayers)



            L.Control.Watermark=L.Control.extend({
                onAdd:function(map){
                    var img = L.DomUtil.create('img');
                    img.src = '/images/logo/sinb-logo.png';
                    img.style.width = '150px';
                    return img;
                },
                onRemove:function(map){},
            });
            L.control.watermark = function(opts){
                return new L.Control.Watermark(opts);
            }
            L.control.watermark({position:'bottomleft'}).addTo(map);


        };



        var popUp = function(f,l){
            var out = [];
            if (f.properties){
                let info = "";
                info += "<h2 class='titulo'>Foco de calor</h2>";
                info += "<strong>Fecha y Hora:</strong> <BR>"+ f.properties["fecha_hora"]+" ";
                out.push(info);

                out.push("<strong>Departamento:</strong> "+ f.properties["dep"]);
                out.push("<strong>Provincia:</strong> "+ f.properties["pro"]);
                out.push("<strong>Municipio:</strong> "+ f.properties["mun"]);


                info ="";
                info +="<div class='titulo2'>Satélite </div>";
                info +="<span class=''> Satélite: "+ f.properties["sat"]+"</span>";

                info +="<div class='titulo2'>Otros </div>";
                info +="<span class=''>"+ f.properties["tbos"]+"</span>";
                out.push(info);



                ubicacion ="";
                ubicacion += "<div class='ubicacion_titulo'>Ubicación:</div>";
                ubicacion += "<div class='ubicacion'>Latitud :"+ f.properties["location_latitude_decimal"];
                ubicacion += "/ Longitud:"+ f.properties["location_longitude_decimal"];
                ubicacion += "</div>";
                out.push(ubicacion);

                l.bindPopup(out.join("<br />"));
            }
        };

        var editGd = function(id){
            url = "/sinpreh/proyecto/"+id;
            var win = window.open(url, '_blank');
            win.focus();
        }



        var handle_filtro = function () {
            $('.filtro-buscar').change(function(evt, params){
                filtro_accion();
            });
        };

        var get_filtros_var = function(){
            /**
             * recogemos los datos de los filtros
             */
            filtro_departamento =  $("#filtro_departamento").val();
            filtro_departamento = filtro_departamento==null? '': filtro_departamento.toString();

            filtro_estado =  $("#filtro_estado").val();
            filtro_estado = filtro_estado==null? '': filtro_estado.toString();

            filtro_gd_tipo_fuente_generacion =  $("#filtro_gd_tipo_fuente_generacion").val();
            filtro_gd_tipo_fuente_generacion = filtro_gd_tipo_fuente_generacion==null? '': filtro_gd_tipo_fuente_generacion.toString();

            /**
             * variables Get
             */
            filtro_var = "?filter[departamento]="+filtro_departamento+"&filter[filtro_estado]="+filtro_estado+"&filter[filtro_gd_tipo_fuente_generacion]="+filtro_gd_tipo_fuente_generacion;
        };

        var wmsGetDepartamentFilter = function(){
            var filtro_cql_str="";
            if (filtro_departamento=="") {
                filtro_cql_str = " name <> 'dato'";
            }else{
                filtro_cql_str = " id in ("+filtro_departamento+")";
            }
            return filtro_cql_str;
        };
        var wmsGetDepartamentFilterMunicipio = function(){
            var filtro_cql_str="";
            if (filtro_departamento=="") {
                filtro_cql_str = " name <> 'dato'";
            }else{
                filtro_cql_str = " departamento_id in ("+filtro_departamento+")";
            }
            return filtro_cql_str;
        };

        var filtro_accion = function(){
            get_filtros_var();
            snippet_tab_item.reset_estado();
            urljson_filter = urljson + filtro_var;
            json_layer.refresh(urljson_filter);
            /**
             * Para la capa de departamentos
             */
            filtro_cql_str =  wmsGetDepartamentFilter();
            layer_departamento.setParams({CQL_FILTER: filtro_cql_str });
            /**
             * Para la capa de municipio
             */
            filtro_cql_str =  wmsGetDepartamentFilterMunicipio();
            layer_municipio.setParams({CQL_FILTER: filtro_cql_str });

            handle_summary();
        };
        var handle_summary = function (){
            $.get( urlsys+'/get.summary',
                {
                    'item[departamento]': filtro_departamento
                    ,'item[filtro_estado]': filtro_estado
                    ,'item[filtro_gd_tipo_fuente_generacion]': filtro_gd_tipo_fuente_generacion
                },
                function(res){
                    $("#total").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.total)+" ");
                    $("#total_programado").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.programado)+" ");
                    $("#total_cerrado").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.cerrado)+" ");
                    $("#total_cancelado").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.cancelado)+" ");

                    $("#total_paralizado").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.paralizado)+" ");
                    $("#total_concluido").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.concluido)+" ");
                    $("#total_ejecucion").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.ejecucion)+" ");
                    $("#total_debito").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.debito)+" ");
                    $("#total_none").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.none)+" ");
                },"json");
        };
        /**
         * Funcionalidades de botones
         */
        var setCenterMap = function() {
            map.flyTo(map_default_center, map_default_zoom);
        };

        var window_layers = $('#window_layers');

        var toolButtons = function () {
            /*
            $('#btn_center_map').click(function() {
                setCenterMap();
            });
             */
        };

        var handle_components = function(){
            coreUyuni.setComponents();
            $("#kt_subheader").addClass('d-none');
        };

        return {
            //main function to initiate the module
            init: function() {
                createMap();
                //toolButtons();
                //closeLayersWindow();

                handle_components();
                handle_filtro();
                //handle_summary();
            },
            resumen:function() {
                //resumen();
            },
            editGd:function(id){
                editGd(id);
            }

        };

    }();


    jQuery(document).ready(function() {
        snippet_geovisor.init();
        snippet_tab_item.init();
    });

</script>
{/literal}