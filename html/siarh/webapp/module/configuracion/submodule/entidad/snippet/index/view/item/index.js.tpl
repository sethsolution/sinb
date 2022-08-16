{literal}
<script>
    var snippet_tab_item = function () {
        var tab_activo="";

        var handler_tab_build = function(){
            $('[data-toggle="tabajax"]').click(function(e) {
                //e.preventDefault();
                var $this = $(this),
                    loadurl = $this.attr('href'),
                    targ = $this.attr('data-target');
                //Vaciamos el tab
                $(targ).html(" Cargando Tab.. ");
                swal({
                    title: 'Cargando tab!',
                    text: 'Procesando datos',
                    imageUrl: 'images/loading/loading05.gif',
                    showConfirmButton: false,
                    allowEnterKey: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })

                var div_dropdown = $(this).closest('div');
                div_dropdown.removeClass('show');

                $.get(loadurl, function(data) {
                    if(tab_activo!="") $(tab_activo).html("");
                    $(targ).html(data);
                    tab_activo =targ;
                    swal.close();
                });
                $this.tab('show');
                return false;
            });
        }
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