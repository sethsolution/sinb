
{literal}
<script>
    var snippet_iframe = function () {

        var initiframe = function(){

            var oraIframe = $('#oraIframe');
            oraIframe.parent().addClass("p-0");
            $('#kt_content').addClass("p-0");
            //$('#kt_subheader').addClass("d-none");
            //console.log("hola mundo2222");
        };

        return {
            //main function to initiate the module
            init: function() {
                initiframe();
            },
        };
    }();

    jQuery(document).ready(function() {
        snippet_iframe.init();
    });
</script>
{/literal}