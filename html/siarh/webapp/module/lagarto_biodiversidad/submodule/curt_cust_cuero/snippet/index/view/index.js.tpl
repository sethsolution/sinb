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
           /**--========================================
        =            APLICACION DE LOGS            =
        ============================================**/
        Logs.create({
            'sistema_id': 16,
            'recurso_id': 2,  //1: acceso a un sistema, 2: acceso a un modulo, 3: accesos a submodulo o tab, 4: descarga de reporte, 5: visita a una pagina, 6: accesos a geoserver
            'nombre': "Custodia de cuero",
            'descripcion': 'Custodia de cuero',
            'base_datos': 'mmaya_biodiversidad_trazabilidad',
            'userCreate': {/literal}{$smarty.session.userv.memberId}{literal}
        }).then(response => {
            if (response.status == 201) {
                // console.log('Registrado');
            }
        });
        /**--====  End of APLICACION DE LOGS  ====**/
    });
    function item_Update(id,type){
                var filtro_id = $("#filtro_gestion option:selected").val();
                console.log(filtro_id);
        var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id='+id+'&type='+type+'&gestion='+filtro_id;
        location = url;
    }
</script>
{/literal}