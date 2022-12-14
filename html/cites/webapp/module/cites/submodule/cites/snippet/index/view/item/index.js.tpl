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
                $(targ).html(" Cargando su solicitud... ");
                swal({
                    title: 'Cargando su solicitud!',
                    html: 'Procesando datos'+cargando_vista,
                    showConfirmButton: false,
                    allowEnterKey: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })

                $.get(loadurl, function(data) {
                    $(targ).html(data);
                    swal.close();
                });

                {/literal}{if $type == "update"}
                snippet_resumen.resumen();
                {/if}{literal}

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
            url = '{/literal}{$path_url}/{$id}/resumen/{literal}';
            $.get( url, {},
                function(res){
                    $("#resumen_especies").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.total_especie));
                    $("#resumen_certificados").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.total_certificado));

                    if(res.sustitucion_cites ==1){
                        $("#resumen_depositar").html(new Intl.NumberFormat('en-US', {minimumFractionDigits: 2}).format(res.monto_sustitucion));
                        $("#resumen_depositos").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(res.total_sustitucion_depositado));
                    }else {
                        $("#resumen_depositar").html(new Intl.NumberFormat('en-US', {minimumFractionDigits: 2}).format(res.total_depositar));
                        $("#resumen_depositos").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 2 }).format(res.total_depositado));
                    }
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

        var btn_enviar = $('#btn_enviar');
        var btn_imprime = $('#btn_imprime');
        var btn_ver = $('#btn_ver');
        var btn_sustituir = $('#btn_sustituir');

        /**
         * Boton de previsualizaci??n
         */
        var boton_ver = function () {
            btn_ver.click(function(e) {
                e.preventDefault();
                var url = "{/literal}{$path_url}/general_/{$id}/ver/{literal}";

                var msgEspere = 'Espere unos segundos hasta que cargue el formulario por favor'+cargando_vista;
                $("#modal-content_ver").html(msgEspere);
                $("#form_modal_ver").modal("show");

                $.get(url, function(data) {
                    $("#modal-content_ver").html(data);
                });
            });
        };
        /**
         * Boton de Sustituci??n
         */
        var boton_sustituir = function () {
            btn_sustituir.click(function(e) {
                e.preventDefault();
                var url = "{/literal}{$path_url}/{$id}/sustituir/{literal}";
                swal({
                    title: 'Realizar Sustituci??n',
                    html: 'Espere unos segundos hasta que carge el formulario por favor'+cargando_vista,
                    showConfirmButton: false,
                    allowEnterKey: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                });

                $.get(url, function(data) {
                    $("#modal-content_ver").html(data);
                    swal.close();

                    $("#form_modal_ver").modal("show");
                });
            });
        };
6
        var boton_imprime = function () {
            btn_imprime.click(function(e) {
                e.preventDefault();
                randomnumber=Math.floor(Math.random()*11);
                url = "{/literal}{$path_url}/{$id}/imprime/{literal}?rand="+randomnumber;
                window.open(url,'impresion_cites');
            });
        };

        /**
         * Boton de enviar
         */
        var enviar = function (){

            swal({
                title: '??Esta seguro de Enviar la solicitud de certificado CITES?',
                html: 'Recuerde que una vez enviada la solicitud  <br>'+
                    '<span style="color:red;"><strong>NO PODR?? REALIZAR NINGUNA MODIFICACI??N </strong></span>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '??Si, Enviar!',
                cancelButtonText: "No, Cancelar"
            }).then(function(result) {
                if (result.value) {
                    enviar_accion();
                }else{
                    btn_enviar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                }
            });
        };

        var enviar_accion = function () {
            swal({
                title: 'Enviando',
                html: cargando_vista,
                showConfirmButton: false,
                allowEnterKey: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            });

            var url = '{/literal}{$path_url}/{$id}/enviar/{literal}';
            $.get( url,{},
                function(res){
                    btn_enviar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    if(res.res == 1){
                        swal.close();
                        swal({position: 'top-center',type: 'success',title: 'El cite fue enviado',showConfirmButton: false,timer: 2000});

                        location = "{/literal}{$path_url}/{$id}/{literal}";

                    }else if(res.res ==3){
                        msg_error = '<span style="color:red;"><strong>Datos faltantes</strong><br></span>'+res.msg;

                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la solicitud'});
                    }else{
                        msg_error = '<strong>Ocurrio error al guardar</strong><br>'+res.msg;
                        if (res.msgdb !== undefined){
                            msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                            msg_error += '<strong>Dato T??cnico: </strong>'+res.msgdb+'</div>';
                        }
                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la solicitud'});
                    }
                },"json");
        };

        var boton_enviar = function () {

            btn_enviar.click(function(e) {
                e.preventDefault();
                btn_enviar.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                enviar();

            });
        };

        return {
            init: function() {
                boton_sustituir();
                boton_enviar();
                boton_imprime();
                boton_ver();
            },
            enviar:function(){
                enviar();
            }
        };
    }();

    {/literal}{/if}{literal}

    jQuery(document).ready(function() {
        snippet_tab_item.init();
        $('#{/literal}{$menu_tab_active}{literal}_tab').trigger('click');
        $('#tabs_principal').removeClass('m--hide');

        {/literal}{if $type == "update"}{literal}
        snippet_resumen.init();
        snippet_item.init();
        {/literal}{/if}{literal}
    });
</script>
{/literal}

