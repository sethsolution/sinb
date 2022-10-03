{literal}
<script>
    var snippet_general_form = function() {
        var idficha = '{/literal}{$id}{literal}';
        var type = '{/literal}{$type}{literal}';
        var general_form = $('#general_form');
        var general_btn_submit = $('#general_submit');
        var preview_btn_submit = $('#preview_submit');
        var showRequest= function(formData, jqForm, op) {
            general_btn_submit.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
            return true;
        };
        var showResponse = function (responseText, statusText) {
            general_btn_submit.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
            if(responseText.res ==1){
                console.log("test: "+responseText.accion);
                if(responseText.accion =='update')
                { 
                    var title='Buen Trabajo! Se guardo todo con exito!';
                    if(responseText.prev=="yes"){
                        title='Buen Trabajo! Se guardo el borrador con exito!';                    
                    }
                    swal({type: 'success',title: 'Buen Trabajo! Se guardo todo con exito!',showConfirmButton: false,timer: 1000});
                
                   
                    if(responseText.prev!="yes"){
                        location = "{/literal}{$getModule}{literal}";
                    }

                   // swal("Buen Trabajo!", "Se guardo todo con exito!", "success")
                     //console.log("Actualizó : "+responseText.id);
                }else{
                    location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id="+responseText.id+"&type=update";
                    console.log("es nuevo : "+responseText.id);
                }
            }else if(responseText.res ==2){
                swal("!Ocurrió un error!", responseText.msg, "error")
            }else{
                swal("!Ocurrió un error!", responseText.msg, "error")
            }
        };

        var options = {
            beforeSubmit:showRequest
            , dataType: 'json'
            , success:  showResponse
            , data: {
                accion:'{/literal}{$subcontrol}_itemupdatesql{literal}'
                ,itemId:idficha
                ,type:type

            }
        };
        var handle_form_submit=function(){
            obtenerDatosFilas();
            general_form.ajaxForm(options);
        };
        var obtenerDatosFilas=function(){
        var aux=JSON.parse('{/literal}{$filas|json_encode}{literal}')
        var type = '{/literal}{$type}{literal}';
            var filas=[];
            for(i=0;i<8;i++){
                    filas[i]=[
                        aux[i]["itemId"],
                        $("#primera"+(i+1)).val(),
                        $("#segunda"+(i+1)).val(),
                        $("#rechazados"+(i+1)).val(),
                        $("#pieCuadrado"+(i+1)).val(),
                        $("#precioUnidad"+(i+1)).val(),
                        $("#precioTotal"+(i+1)).val(),
                    ]
                }
            return filas;
        }
        var cargarPieCudrado=function(){
            console.log("pie");
            var longitudes=[0.575,1.17,1.225,1.27,1.325,1.37,1.445,1.5];
            var total=0;
            for(i=0;i<8;i++){
                        var pie=Number($("#cantidad"+(i+1)).val()*3.28084*longitudes[i]);
                        $("#pieCuadrado"+(i+1)).val(pie.toFixed(2));
                        total+=pie;
                }
            $("#totalPieCuadrado").val(total.toFixed(2));   

        }
        var modificarTotal=function(){
            for(i=0;i<8;i++){
                $("#cantidad"+(i+1)).change(function(){
                   calcularTotalInput();   
                });
            }
        }
         var modificarPrecio=function(){
            for(i=0;i<8;i++){
                $("#precioTotal"+(i+1)).change(function(){
                   calcularTotalPrecioInput();   
                });
            }
        }
         var modificarPie=function(){
            for(i=0;i<8;i++){
                $("#pieCuadrado"+(i+1)).change(function(){
                   calcularTotalPieInput(); 
                });
            }
        }
         var calcularTotalInput=function(){
            var filas=JSON.parse('{/literal}{$filas|json_encode}{literal}');
            var total=0;
            for(i=0;i<filas.length;i++){
                total+=Number($("#cantidad"+(i+1)).val());

            }  
            $("#total_chalecos").val(total);       


        };
        var calcularTotalPrecioInput=function(){
            var filas=JSON.parse('{/literal}{$filas|json_encode}{literal}');
            var total=0;
            for(i=0;i<filas.length;i++){
                total+=Number($("#precioTotal"+(i+1)).val());
            }  
            $("#totalPrecio").val(total);       

        };
        
        var calcularTotalPieInput=function(){
            var filas=JSON.parse('{/literal}{$filas|json_encode}{literal}');
            var total=0;
            for(i=0;i<filas.length;i++){
                total+=Number($("#pieCuadrado"+(i+1)).val());
            }  
            $("#totalPieCuadrado").val(total);       

        };
        var calcularTotal=function(){
            var filas=JSON.parse('{/literal}{$filas|json_encode}{literal}');
            var total=0;
            for(i=0;i<filas.length;i++){
                total+=Number(filas[i]["cantidad"]);

            }  
            $("#total_chalecos").val(total);       


        };
        var calcularTotalPrecio=function(){
            var filas=JSON.parse('{/literal}{$filas|json_encode}{literal}');
            var total=0;
            for(i=0;i<filas.length;i++){
                total+=Number(filas[i]["precio_total"]);

            }  
            $("#totalPrecio").val(total);       


        };

        var handle_general_form_submit = function() {

            general_btn_submit.click(function(e) {
                
                options={
                beforeSubmit:showRequest
                , dataType: 'json'
                , success:  showResponse
                , data: {
                    accion:'{/literal}{$subcontrol}_itemupdatesql{literal}'
                    ,itemId:idficha
                    ,type:type
                    ,filas:JSON.stringify(obtenerDatosFilas())

                }};  
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');
                handle_form_submit();

                if (!form.valid()) {
                    return;
                }
                Swal.fire({
                    type: 'warning',
                    title: 'Una vez guardados estos cambios no podra revertirlos.',
                    showCancelButton: true,
                    confirmButtonText: `Guardar`,
                    cancelButtonText: `Cancelar`,
                    }).then((result) => {
                    if (result.value) {
                            general_form.submit();
                    } 
                    })
            });
        };
        var handle_preview_form_submit = function() {

            preview_btn_submit.click(function(e) {
                
                options={
                beforeSubmit:showRequest
                , dataType: 'json'
                , success:  showResponse
                , data: {
                    accion:'{/literal}{$subcontrol}_itemupdatesql{literal}'
                    ,itemId:idficha
                    ,type:type,
                    prev:true                    
                    ,filas:JSON.stringify(obtenerDatosFilas())

                }};  
                e.preventDefault();
                var btn = $(this);
                var form = $(this).closest('form');
                handle_form_submit();

                if (!form.valid()) {
                    return;
                }
                general_form.submit();
            });
        };

        var handle_general_components = function(){

            $('.select2_general').select2({
                placeholder: "Seleccione una opción"
            });

        };


        //== Public Functions
        return {
            // public functions
            init: function() {
                handle_general_form_submit();
                handle_preview_form_submit();
                handle_form_submit();
                handle_general_components();
                calcularTotal();
                modificarTotal();
                calcularTotalPrecio();
                modificarPrecio();
                cargarPieCudrado();
                modificarPie();
            }
        };
    }();

    //== Class Initialization
    jQuery(document).ready(function() {
        snippet_general_form.init();
    });

</script>
{/literal}