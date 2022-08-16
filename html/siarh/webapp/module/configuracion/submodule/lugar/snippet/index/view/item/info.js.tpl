{literal}
<script>
    var snippet_resumen = function () {

        var handler_resumen01 = function(){
            loadurl = "{/literal}{$getModule}&accion=resumen01&id={$id}{literal}";
            $.get(loadurl, function(data) {
                $("#resumen01").html(data);
            });
        };
        var handler_resumen02 = function(){
            var loadurl = "{/literal}{$getModule}&accion=resumen02&id={$id}{literal}";
            alert("hola snippet 02");
        };

        return {
            init: function() {
                handler_resumen01();
            }
            ,r01: function () {
                handler_resumen01();
            }
            ,r02: function () {
                handler_resumen02();
            }
        };
    }();

    jQuery(document).ready(function() {
        snippet_resumen.r01();
    });


</script>
{/literal}
