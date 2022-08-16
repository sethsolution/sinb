{literal}
<script>

    //== Class definition
    var snippet_oep_map = function() {

        var oep_map_view = function() {

            var map = new GMaps({
                div: '#oep_map',
                lat: {/literal}{$item_oep.recinto_latitud}{literal},
                lng: {/literal}{$item_oep.recinto_longitud}{literal},
            });
            var icon = {
                url: "/template/user/images/sig/marker-purpura02.png", // url
                scaledSize: new google.maps.Size(50, 50), // scaled size
                origin: new google.maps.Point(0,0), // origin
                anchor: new google.maps.Point(26, 46) // anchor
            };
            map.addMarker({
                lat: {/literal}{$item_oep.recinto_latitud}{literal},
                lng: {/literal}{$item_oep.recinto_longitud}{literal},
                title: '{/literal}{$item_oep.recinto_nombre|escape:"html"}{literal}',
                icon: icon,
                size : 24,
                infoWindow: {
                    content: '<p><b>{/literal}{$item_oep.recinto_nombre|escape:"html"}{literal}</b><br />{/literal}{$item_oep.recinto_direccion|escape:"html"}{literal}</p>'
                }
            });
            map.setZoom(17);

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