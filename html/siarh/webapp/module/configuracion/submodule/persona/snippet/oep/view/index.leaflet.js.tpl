{literal}
<script>

    //== Class definition
    var snippet_oep_map = function() {

        var oep_map_view = function() {



            var base_osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                id: 'osm_map'
            });
            /*
            var base_google = L.gridLayer.googleMutant({
                maxZoom: 24,
                type:'roadmap',
                id: 'google_roadmap'
            });
            */

            var base_google_satellite = L.gridLayer.googleMutant({
                maxZoom: 24,
                type:'satellite',
                id: 'google_satellite'
            });

            var baseLayers = {
                "Google Satelite": base_google_satellite,
                "OSM": base_osm,

            };

            var mymap = L.map('oep_map',{
                layers: [base_osm, base_google_satellite]
            }).setView([{/literal}{$item_oep.recinto_latitud}{literal}, {/literal}{$item_oep.recinto_longitud}{literal}], 17);

            L.control.layers(baseLayers).addTo(mymap);

            L.marker([{/literal}{$item_oep.recinto_latitud}{literal}, {/literal}{$item_oep.recinto_longitud}{literal}]).addTo(mymap)
                .bindPopup("<b>{/literal}{$item_oep.recinto_nombre|escape:"html"}{literal}</b><br />{/literal}{$item_oep.recinto_direccion|escape:"html"}{literal}").openPopup();
            var popup = L.popup();


            // create fullscreen control
            var fsControl = new L.Control.FullScreen();
            // add fullscreen control to the map
            mymap.addControl(fsControl);

            // detect fullscreen toggling
            mymap.on('enterFullscreen', function(){
                if(window.console) window.console.log('enterFullscreen');
            });
            mymap.on('exitFullscreen', function(){
                if(window.console) window.console.log('exitFullscreen');
            });

        }
        return {
            // public functions
            init: function() {
                // default charts
                oep_map_view();
            }
        };
    }();

    jQuery(document).ready(function() {
        snippet_oep_map.init();
    });


</script>
{/literal}