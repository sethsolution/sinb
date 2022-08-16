{literal}
<script>
var snippet_button_form = function () {
    var btn_update = $('#btn_form_{/literal}{$subcontrol}{literal}');
    var handle_button_form = function(){
        btn_update.click(function(e){
            e.preventDefault();
            item_form_{/literal}{$subcontrol}{literal}("","new");
        });
    }

    return {
        // public functions
        init: function() {
            handle_button_form();

        }
    };
}();

jQuery(document).ready(function() {
    snippet_button_form.init();
    //form_item.modal("show");

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