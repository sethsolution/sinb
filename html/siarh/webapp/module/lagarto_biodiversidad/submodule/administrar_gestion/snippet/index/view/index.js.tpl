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
            'nombre': "Administrar gestion",
            'descripcion': 'Administrar gestion',
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
                console.log("{/literal}{$getModule}{literal}&accion=verGestion");
        $.get( "{/literal}{$getModule}{literal}",
            {accion:"verGestion"},
            function(res){
                if(!res){
                    //swal('Eliminado!','El registro fue eliminado','success');
                    swal({position: 'top-center',type: 'warning',title: 'La gestion actual ya esta registrada.',showConfirmButton: false,timer: 2000});
                    table_list.draw();
                }else if(res){
                    var url = '{/literal}{$getModule}{literal}&accion=itemUpdate&id=1&type='+type;
                    location = url;
                }
            },"json");
        
    }
</script>
{/literal}