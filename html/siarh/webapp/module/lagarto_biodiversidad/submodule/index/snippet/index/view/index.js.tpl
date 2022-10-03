{literal}
    <script src="js/reportes_log/reportes-log.js"></script>
    <script>
    var snippet_button_update = function () {
        var btn_update = $('#btn_update');
        var handle_button_update = function(){
            btn_update.click(function(e){
                e.preventDefault();
                //btn_update.attr("rel");
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
            'recurso_id': 1,  //1: acceso a un sistema, 2: acceso a un modulo, 3: accesos a submodulo o tab, 4: descarga de reporte, 5: visita a una pagina, 6: accesos a geoserver
            'nombre': "Sistema de traza de la caza y manejo del lagarto",
            'descripcion': 'Acceso al sistema de Trazabilidad de Lagarto',
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
        var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id='+id+'&type='+type;
        location = url;
    }
</script>
{/literal}