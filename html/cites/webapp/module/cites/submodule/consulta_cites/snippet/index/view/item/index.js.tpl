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
            componente = $('#componente_f').val();
            subcomponente = $('#subcomponente_f').val();
            tipo_aporte = $('#tipo_aporte_f').val();

            $.get( "{/literal}{$path_url}{literal}",
                {accion:"get.resumen",
                    'item[componente]':componente,
                    'item[subcomponente]':subcomponente,
                    'item[tipo_aporte]':tipo_aporte,
                    'item[item_id]':{/literal}{$id}{literal},
                },
                function(res){
                    $("#resumen_programado").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(res.programado));
                    $("#resumen_componente").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(res.componente));
                    $("#resumen_desembolsado").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(res.desembolsado));

                    resumen_saldo = res.componente - res.desembolsado;
                    $("#resumen_saldo").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(resumen_saldo));
                },"json");
        };

        return {
            // public functions
            init: function() {
                resumen();
            },
            resumen:function() {
                resumen();
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

    function itemPrint(idficha){
        randomnumber=Math.floor(Math.random()*11);
        url = "{/literal}{$path_url}{literal}/"+idficha+"/print/?rand="+randomnumber;
        window.open(url,'Impresion_ficha_fiv');

    }
</script>

{/literal}

