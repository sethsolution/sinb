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
        snippet_tab_item.init();
        $('#{/literal}{$menu_tab_active}{literal}_tab').trigger('click');
    });
</script>
{/literal}
