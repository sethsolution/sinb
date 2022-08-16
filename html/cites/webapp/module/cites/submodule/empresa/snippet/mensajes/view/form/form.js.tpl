{literal}
<script>
    var snippet_form_modal = function() {

        var handle_form_modal_components = function(){
            $('.fecha_general').datepicker({
                todayHighlight: true,
                orientation: "bottom left",
                format: 'dd/mm/yyyy',
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            });

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
                , width: '100%'
            });
            
            $('#input_archivo').on('change', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("archivo").html(fileName);
            });
        };

        return {
            init: function() {
                handle_form_modal_components();
            }
        };
    }();

    jQuery(document).ready(function() {
        snippet_form_modal.init();
    });

</script>
{/literal}