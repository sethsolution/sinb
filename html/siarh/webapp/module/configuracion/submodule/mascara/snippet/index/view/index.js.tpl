{include file="lista/lista.js.tpl"}
{literal}
<script>
    var snippet_button_update = function () {
        var btn_update = $('#btn_update');
        var handle_button_update = function(){
            btn_update.click(function(e){
                e.preventDefault();
                item_Update("","new");
            });
        }
        return {
            // public functions
            init: function() {
                handle_button_update();
            }
        };
    }();

    jQuery(document).ready(function() {
        snippet_button_update.init();
    });
    function item_Update(id,type){
        var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id='+id+'&type='+type;
        location = url;
    }
</script>
{/literal}