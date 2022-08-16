{literal}
<script>
    var snippet_button_login = function () {
        var btn_login = $('#btn_form_login');
        var btn_reg = $('#btn_form_reg');

        var handle_button_form = function(){
            btn_login.click(function(e){
                e.preventDefault();
                handle_item_form_login("get.form.login");
            });
            btn_reg.click(function(e){
                e.preventDefault();
                handle_item_form_login("get.form.reg");
            });
        };

        var handle_item_form_login = function(type){
            var load_url = '/core/login/?accion='+type;
            $.get(load_url, function(data) {
                $("#modal-content_login").html(data);
                $("#form_modal_login").modal("show");
            });
        };


        return {
            // public functions
            init: function() {
                handle_button_form();
            }
        };
    }();

    jQuery(document).ready(function() {
        snippet_button_login.init();
    });

    function item_form_{/literal}{$subcontrol}{literal}(id,type){
        var load_url = '{/literal}{$getModule}&accion={$subcontrol}_get.form{literal}&id='+id+'&type='+type+'&item_id={/literal}{$id}{literal}';
        $.get(load_url, function(data) {
            $("#modal-content_{/literal}{$subcontrol}{literal}").html(data);
            $("#form_modal_{/literal}{$subcontrol}{literal}").modal("show");
        });
    }

</script>
{/literal}