{literal}
<script>
    var snippet_tab_item = function () {
        "use strict";
        var handler_tab_build = function(){
            coreUyuni.setTabs();
        };
        return {
            init: function() {
                handler_tab_build();
            }
        };
    }();

    jQuery(document).ready(function() {
        $('#btn_back').removeClass('d-none');
        snippet_tab_item.init();
        $('#{/literal}{$menu_tab_active}{literal}_tab').trigger('click');
    });
</script>
{/literal}


<script src="https://maps.googleapis.com/maps/api/js?key={$google_map_key}"></script>
<script src="/js/geo/leaflet.1.7.1/leaflet.js"></script>
<script src="/js/geo/leaflet.fullscreen/Control.FullScreen.js"></script>
<script src="/js/geo/Leaflet.GoogleMutant.js"></script>

<script src="/js/geo/leaflet.ajax/dist/leaflet.ajax.js"></script>
<script src="/js/geo/leaflet.ajax/example/spin.js"></script>

<script src="/js/geo/leaflet.groupedlayercontrol/dist/leaflet.groupedlayercontrol.min.js"></script>
<script src="/js/geo/leaflet.wms/dist/leaflet.wms.js"></script>


