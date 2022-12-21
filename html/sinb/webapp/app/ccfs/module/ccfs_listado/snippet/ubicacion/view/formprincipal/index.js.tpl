{literal}
<script>
    var snippet_general_form = function(){
        "use strict";
        /**
         * Datos del formulario y el boton
         */
        var form = $('#general_form');
        var btn_submit = $('#general_submit');

        var formv;
        /**
         * Antes de enviar el formulario se ejecuta la siguiente funcion
         */
        var showRequest= function(formData, jqForm, op)  {
            btn_submit.addClass('spinner spinner-white spinner-right').attr('disabled', true);
            return true;
        };

        var showResponse = function (res, statusText) {
            btn_submit.removeClass('spinner spinner-white spinner-right').attr('disabled', false);
            let url = "{/literal}{$path_url}{literal}";
            coreUyuni.generalShowResponse(res,url);

        };

        /**
         * Opciones para generar el objeto del formulario
         */
        var options = {
            beforeSubmit:showRequest
            , success:  showResponse
            , data: {type:'{/literal}{$type}{literal}'}
        };

        /**
         * Se da las propiedades de ajaxform al formulario
         */
        var handle_form_submit=function(){
            form.ajaxForm(options);
            formv = FormValidation.formValidation(
                document.getElementById('general_form'),
                {
                    plugins: {
                        declarative: new FormValidation.plugins.Declarative({html5Input: true,}),
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                    }
                }
            );

        };
        /**
         * Se da las funcionalidades al boton enviar
         */
        var handle_btn_submit = function() {
            btn_submit.click(function(e) {
                e.preventDefault();
                /**
                 * Copiamos los datos de summerNote a una variable
                 */
                //$('#descripcion_input').val($('#descripcion').summernote('code'));

                formv.validate().then(function(status) {
                    if(status === 'Valid'){
                        form.submit();
                    }else{
                        Swal.fire({icon: 'error',title: lngUyuni.formFieldControlTitle, text: lngUyuni.formFieldControlMsg});
                    }
                });

            });
        };
        /**
         * Iniciamos los componentes necesarios como , summernote, select2 entre otros
         */
        var handle_components = function(){
            coreUyuni.setComponents();
        };

        return {
            init: function() {
                handle_form_submit();
                handle_btn_submit();
                handle_components();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
    });


    var snippet_geovisor = function () {

        var marker;
        var leaflet;
        var map;
        var punto = [{/literal}{$item.location_latitude_decimal|escape:"html"},{$item.location_longitude_decimal|escape:"html"}{literal}];
        var geoserver_mmaya = '/geoserver/wms';
        var layer_departamento,layer_municipio;
        var uh_nivel1,uh_nivel2,uh_nivel3,uh_nivel4,uh_nivel5, macroregion,cuencas_operativas;
        var getBaseLayers = function(){
            Grayscale =  L.tileLayer(
                'https://tiles.stadiamaps.com/tiles/alidade_smooth/{z}/{x}/{y}{r}.png?api_key={apikey}', {
                    maxZoom: 20,
                    attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>',
                    apikey:"{/literal}{$stadiamaps_key}{literal}",
                });


            mapLink = '<a href="https://openstreetmap.org">OpenStreetMap</a>';
            osmLayer = L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; ' + mapLink + ' Contributors',
                    maxZoom: 19,
                    id: 'osm'
                }).addTo(map);
            OpenTopoMap = L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                maxZoom: 17,
                attribution: 'Map data: &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, <a href="https://viewfinderpanoramas.org">SRTM</a> | Map style: &copy; <a href="https://opentopomap.org">OpenTopoMap</a> (<a href="https://creativecommons.org/licenses/by-sa/3.0/">CC-BY-SA</a>)'
            });
            googleHybrid = L.gridLayer.googleMutant({
                maxZoom: 24,
                type: "hybrid", // valid values are 'roadmap', 'satellite', 'terrain' and 'hybrid'
            });
            var baseLayers = {
                "Grayscale":Grayscale,
                "OpenStreetMap": osmLayer,
                "OpenTopoMap": OpenTopoMap,
                "googleHybrid": googleHybrid
            };
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
            }).addTo(map);
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
            var overLayers = {
                "Administrativos": {
                    "Departamento": layer_departamento,
                    "Municipio": layer_municipio
                },
                "Unidad Hidrográfica": {
                    "51 Cuencas_Operativas": cuencas_operativas,
                    "Macroregion": macroregion,
                    "UH Nivel5": uh_nivel5,
                    "UH Nivel4": uh_nivel4,
                    "UH Nivel3": uh_nivel3,
                    "UH Nivel2": uh_nivel2,
                    "UH Nivel1": uh_nivel1,
                }
            };
            
            return overLayers;
        };

        var initialiseMap = function(){
            var mapOptions = {
                center: punto
                , zoom: {/literal}{if $type == 'new'}8{else}10{/if}{literal}
                ,fullscreenControl: true
                ,scrollWheelZoom: true
            };
            var m = L.map('map',mapOptions);
            L.control.scale({metric: true, imperial: false}).addTo(m);
            return m;
        };

        var createMap = function(){
            map = initialiseMap();
            /**
             * Grupo de layers
             */
            var options = {
                // Make the "Landmarks" group exclusive (use radio inputs)
                exclusiveGroups: ["Overlays"],
                // Show a checkbox next to non-exclusive group labels for toggling all
                //groupCheckboxes: true
            };
            layerControl = L.control.groupedLayers(getBaseLayers(), getGroupedOverlays(), options).addTo(map);

            var leafletIcon = L.divIcon({
                html: `<span class="svg-icon svg-icon-danger svg-icon-3x"><svg xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="24" width="24" height="0"/><path d="M5,10.5 C5,6 8,3 12.5,3 C17,3 20,6.75 20,10.5 C20,12.8325623 17.8236613,16.03566 13.470984,20.1092932 C12.9154018,20.6292577 12.0585054,20.6508331 11.4774555,20.1594925 C7.15915182,16.5078313 5,13.2880005 5,10.5 Z M12.5,12 C13.8807119,12 15,10.8807119 15,9.5 C15,8.11928813 13.8807119,7 12.5,7 C11.1192881,7 10,8.11928813 10,9.5 C10,10.8807119 11.1192881,12 12.5,12 Z" fill="#000000" fill-rule="nonzero"/></g></svg></span>`,
                bgPos: [10, 10],
                iconAnchor: [20, 37],
                popupAnchor: [0, -37],
                className: 'leaflet-marker'
            });
            //marker = L.marker(map.getCenter(),{ icon: leafletIcon }).addTo(map);
            marker = L.marker(map.getCenter()).addTo(map);
            marker.setLatLng(punto).update();

            map.on('click', function (e) {
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;
                $('#location_longitude_decimal').val(Math.round(lng * 100000) / 100000);
                $('#location_latitude_decimal').val(Math.round(lat * 100000) / 100000);
                marker.setLatLng([lat,lng]).update();
            });
        };

        var latitude=$('#location_latitude_decimal');
        var longitude= $('#location_longitude_decimal');

        var changeLngLat = function(){
            if (longitude.val() && latitude.val() && longitude != 0 && latitude.val() != 0) {
                var lat = latitude.val();
                var lng = longitude.val();
                changeLocation(lat, lng);
                //map.setView(new L.LatLng(lat, lng), 13);
                map.setView(new L.LatLng(lat, lng));
                $('#lng').val(Math.round(lng * 100000) / 100000);
                $('#lat').val(Math.round(lat * 100000) / 100000);
            }
        };

        var changeLocation = function (lat, lng) {
            marker.setLatLng({lat: lat, lng: lng});
            /*
            $.ajax({
                method: "GET",
                url: "json/json_intesect_municipality",
                data: {longitude: lng, latitude: lat}
            }).done(function (data) {
                if (data[0]) {
                    $('#department').val(data[0].nom_dep);
                    if (!($("#province option[value='" + data[0].nom_prov + "']").length > 0)) {
                        $('#province').empty();
                        $('#province').append($('<option>', {
                            value: data[0].nom_prov,
                            text: data[0].nom_prov
                        }));
                    }
                    $('#province').val(data[0].nom_prov);
                    if (!($("#municipality option[value='" + data[0].nom_mun + "']").length > 0)) {
                        $('#municipality').empty();
                        $('#municipality').append($('<option>', {
                            value: data[0].nom_mun,
                            text: data[0].nom_mun
                        }));
                    }
                    $('#municipality').val(data[0].nom_mun);
                }
            });
             */
        };

        var handle_ll =  function(){
            longitude.change(function () {
                console.log("cambio longitud");
                changeLngLat()
            });
            latitude.change(function () {
                console.log("cambio latitud");
                changeLngLat()
            })
        };

        return {
            // public functions
            init: function () {
                // default charts
                createMap();
                handle_ll();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
        snippet_geovisor.init();
    });
</script>
{/literal}