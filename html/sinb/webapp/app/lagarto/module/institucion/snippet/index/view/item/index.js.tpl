{literal}
<script>
    var snippet_tab_item = function () {
        "use strict";
        var urlsys = '{/literal}{$path_url}/{$id}{literal}';

        var handler_tab_build = function(){
            coreUyuni.setTabs();
        };
        /**
         * PDF
         */
        var btn_pdf;
        var handle_button_pdf = function(){
            {/literal}{if $type =='update'}{literal}
            $('#btn_back').before('<a href="#" class="btn btn-success btn-sm mr-1" id="btn_pdf" rel="new"><i class="fa fa-plus"></i>PDF</a> ');
            {/literal}{/if}{literal}
            btn_pdf = $('#btn_pdf');
            btn_pdf.click(function(e){
                e.preventDefault();
                var url = urlsys+"/pdf";
                window.open(url, '_blank');
            });
        };

        return {
            init: function() {
                handler_tab_build();
                handle_button_pdf();
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

