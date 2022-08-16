{literal}
<script>
    var snippet_tab_item = function () {
        var borra_contenido_tabs = function () {
            {/literal}
            {foreach from=$menu_tab item=row key=idx}
            $("#{$row.id_name}_pane").html("");
            {/foreach}
            {literal}
        };
        var handler_tab_build = function(){
            $('[data-toggle="tabajax"]').click(function(e) {

                //e.preventDefault();
                var $this = $(this),
                    loadurl = $this.attr('href'),
                    targ = $this.attr('data-target');
                //Vaciamos el tab
                borra_contenido_tabs();
                $(targ).html(" Cargando su solicitud.. ");
                swal({
                    title: 'Cargando su solicitud!',
                    html: 'Procesando datos '+cargando_vista,
                    showConfirmButton: false,
                    allowEnterKey: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })

                $.get(loadurl, function(data) {
                    $(targ).html(data);
                    swal.close();
                });
                snippet_resumen.resumen();
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


{/literal}{if $type == "update"}{literal}
    var snippet_resumen = function () {
            var resumen = function (){
                url = '{/literal}{$path_url}/{$id}/resumen{literal}';
                $.get( url, {},
                    function(res){
                        $("#resumen_especies").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.total_especie));
                        $("#resumen_certificados").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.total_certificado));
                        $("#resumen_depositar").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(res.total_depositar));
                        $("#resumen_depositos").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(res.total_depositado));
                    },"json");
            };

            return {
                init: function() {
                    resumen();
                },
                resumen:function() {
                    resumen();
                },
            };
    }();

        var snippet_item = function () {
            var print = function () {
                randomnumber=Math.floor(Math.random()*11);
                url = "{/literal}{$path_url}{literal}/"+idficha+"/print/?rand="+randomnumber;
                window.open(url,'Impresion_dispensacion');
            };
            return {
                init: function() {

                },
                print:function() {
                    print();
                },
            };
        }();
    {/literal}{/if}{literal}


    jQuery(document).ready(function() {
        snippet_tab_item.init();
        $('#{/literal}{$menu_tab_active}{literal}_tab').trigger('click');
        $('#tabs_principal').removeClass('m--hide');


        {/literal}{if $type == "update"}{literal}
        snippet_resumen.init();
        {/literal}{/if}{literal}

    });
</script>

{/literal}

