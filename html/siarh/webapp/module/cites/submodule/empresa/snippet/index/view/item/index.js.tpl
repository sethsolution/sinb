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
                $(targ).html(" Cargando información.. ");
                swal({
                    title: 'Cargando información!',
                    html: 'Procesando datos<br>'+cargando_vista,
                    showConfirmButton: false,
                    allowEnterKey: false,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })

                $.get(loadurl, function(data) {
                    $(targ).html(data);
                    swal.close();
                });

                {/literal}{if $type == "update"}{literal}
                snippet_resumen.resumen();
                {/literal}{/if}{literal}

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
            url = '{/literal}{$getModule}{literal}';
            $.get( url, {
                accion:"resumen",
                    'item[item_id]':{/literal}{$id}{literal},},
                function(res){
                    $("#obs_general").removeClass("m--font-info").removeClass("m--font-danger");
                    if(res.obs_general==0){
                        $("#obs_general").addClass("m--font-info");
                    }else{
                        $("#obs_general").addClass("m--font-danger");
                    }
                    $("#obs_general").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.obs_general));

                    $("#obs_form2").removeClass("m--font-info").removeClass("m--font-danger");
                    if(res.obs_form2==0){
                        $("#obs_form2").addClass("m--font-info");
                    }else{
                        $("#obs_form2").addClass("m--font-danger");
                    }
                    $("#obs_form2").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.obs_form2));

                    $("#obs_requisitos").removeClass("m--font-info").removeClass("m--font-danger");
                    if(res.obs_requisitos==0){
                        $("#obs_requisitos").addClass("m--font-info");
                    }else{
                        $("#obs_requisitos").addClass("m--font-danger");
                    }
                    $("#obs_requisitos").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.obs_requisitos));

                    $("#obs_pagos").removeClass("m--font-info").removeClass("m--font-danger");
                    if(res.obs_pagos==0){
                        $("#obs_pagos").addClass("m--font-info");
                    }else{
                        $("#obs_pagos").addClass("m--font-danger");
                    }
                    $("#obs_pagos").html(new Intl.NumberFormat('en-US',{ minimumFractionDigits: 0 }).format(res.obs_pagos));
                    /**
                     * Verificamos los botones
                     */
                    {/literal}{if $item.estado_id == 2}{literal}
                    if(res.obs_total==0){
                        $("#obs_cuadro").addClass("m--hide");
                        $("#btn_obs_enviar").addClass("m--hide");
                        $("#btn_aprobar").removeClass("m--hide");
                    }else{
                        $("#obs_cuadro").removeClass("m--hide");
                        $("#btn_obs_enviar").removeClass("m--hide");
                        $("#btn_aprobar").addClass("m--hide");
                    }
                    {/literal}{/if}{literal}

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
        var btn_obs_enviar = $('#btn_obs_enviar');
        var btn_aprobar = $('#btn_aprobar');

        /**
         * Envio la aprobación btn_aprobar
         */
        var aprobar_accion = function () {
            swal({
                title: 'Enviando',
                html: cargando_vista,
                showConfirmButton: false,
                allowEnterKey: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
            var url = '{/literal}{$getModule}{literal}';;
            $.get( url,{
                    accion:"enviar.aprobar"
                    ,'item[item_id]':{/literal}{$id}{literal}
                },
                function(res){
                    btn_aprobar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    if(res.res == 1){
                        swal.close();
                        swal({position: 'top-center',type: 'success',title: 'El usuario fue Aprobado',showConfirmButton: false,timer: 1000});
                        location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id={/literal}{$path_url}{$id}{literal}&type=update";
                    }else if(res.res ==3){
                        msg_error = '<span style="color:red;"><strong>Datos faltantes</strong><br></span>'+res.msg;

                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la aprobación'});
                    }else{
                        msg_error = '<strong>Ocurrio error al guardar</strong><br>'+res.msg;
                        if (res.msgdb !== undefined){
                            msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                            msg_error += '<strong>Dato Técnico: </strong>'+res.msgdb+'</div>';
                        }
                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la aprobación'});
                    }
                },"json");
        };

        var aprobar = function (){
            swal({
                title: '¿Esta seguro de aprobar la solicitud?',
                html: 'Recuerde que una vez aprobada la solicitud, se enviara un correo de aprobación al usuario y  <br>'+
                    '<span style="color:red;"><strong>no podrá realizar alguna modificación </strong></span>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '¡Si, Enviar!',
                cancelButtonText: "No, Cancelar"
            }).then(function(result) {
                if (result.value) {
                    aprobar_accion();
                }else{
                    btn_aprobar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                }
            });
        };
        var boton_aprobar = function () {
            btn_aprobar.click(function(e) {
                e.preventDefault();
                btn_aprobar.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                aprobar();
            });
        };
        /**
         * Envio de observaciones
         */
        var enviar_obs_accion = function () {
            swal({
                title: 'Enviando',
                html: cargando_vista,
                showConfirmButton: false,
                allowEnterKey: false,
                allowOutsideClick: false,
                allowEscapeKey: false,
            });
            var url = '{/literal}{$getModule}{literal}';;
            $.get( url,{
                    accion:"enviar.obs"
                    ,'item[item_id]':{/literal}{$id}{literal}
                },
                function(res){
                    btn_obs_enviar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    if(res.res == 1){
                        swal.close();
                        swal({position: 'top-center',type: 'success',title: 'El usuario fue observado',showConfirmButton: false,timer: 1000});
                        location = "{/literal}{$getModule}{literal}&accion=itemUpdate&id={/literal}{$path_url}{$id}{literal}&type=update";
                    }else if(res.res ==3){
                        msg_error = '<span style="color:red;"><strong>Datos faltantes</strong><br></span>'+res.msg;

                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la observación'});
                    }else{
                        msg_error = '<strong>Ocurrio error al guardar</strong><br>'+res.msg;
                        if (res.msgdb !== undefined){
                            msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                            msg_error += '<strong>Dato Técnico: </strong>'+res.msgdb+'</div>';
                        }
                        swal({position: 'top-center'
                            ,html:msg_error
                            ,type: 'error'
                            ,title: 'No se puede enviar la observación'});
                    }
                },"json");
        };

        var enviar_obs = function (){

            swal({
                title: '¿Esta seguro de Enviar las observaciones?',
                html: 'Recuerde que una vez enviado las observaciones, se enviara un email al usuario y  <br>'+
                    '<span style="color:red;"><strong>no podrá realizar alguna modificación </strong></span>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '¡Si, Enviar!',
                cancelButtonText: "No, Cancelar"
            }).then(function(result) {
                if (result.value) {
                    enviar_obs_accion();
                }else{
                    btn_obs_enviar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                }
            });
        };
        var boton_enviar_obs = function () {
            btn_obs_enviar.click(function(e) {
                e.preventDefault();
                btn_obs_enviar.addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                enviar_obs();
            });
        };

        return {
            init: function() {
                boton_enviar_obs();
                boton_aprobar();
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
        snippet_item.init();
        //snippet_resumen.init();
        {/literal}{/if}{literal}

    });

    function itemPrint(idficha){
        randomnumber=Math.floor(Math.random()*11);
        url = "{/literal}{$getModule}{literal}&accion=print&rand="+randomnumber+"&idficha="+idficha;
        window.open(url,'Impresion_ficha_fiv');      
      
    }
</script>

{/literal}

