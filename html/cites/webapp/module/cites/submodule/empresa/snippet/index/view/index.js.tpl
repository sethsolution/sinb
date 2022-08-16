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
                var $this = $(this),n
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



    var snippet_item = function () {
        var print = function () {
            randomnumber=Math.floor(Math.random()*11);
            url = "{/literal}{$path_url}{literal}/"+idficha+"/print/?rand="+randomnumber;
            window.open(url,'Impresion_empresa');
        };


        var btn_enviar = $('#btn_enviar');

        var enviar = function (){

            swal({
                title: '¿Esta seguro de Enviar la solicitud de Registro?',
                html: 'Recuerde que una vez enviada la solicitud  <br>'+
                    '<span style="color:red;"><strong>NO PODRÁ REALIZAR NINGUNA MODIFICACIÓN </strong></span>',
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: '¡Si, Enviar!',
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

            var url = '{/literal}{$path_url}/enviar/{literal}';
            $.get( url,{},
                function(res){
                    btn_enviar.removeClass('m-loader m-loader--right m-loader--light').attr('disabled', false);
                    if(res.res == 1){
                        swal.close();
                        swal({position: 'top-center',type: 'success',title: 'La solicitud fue enviado',showConfirmButton: false,timer: 1000});
                        location = "{/literal}{$path_url}/{literal}";
                    }else{
                        msg_error = '<strong>Ocurrio un error al enviar </strong><br>'+res.msg;
                        if (res.msgdb !== undefined){
                            msg_error += '<br><br><div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">';
                            msg_error += '<strong>Dato Técnico: </strong>'+res.msgdb+'</div>';
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
                boton_enviar();
            },
            print:function() {
                print();
            },
            enviar:function(){
                enviar();
            }
        };
    }();



    jQuery(document).ready(function() {
        snippet_tab_item.init();

        //$('#{/literal}{$menu_tab_disabled}{literal}_tab').trigger('click');
       // $('#tabs_principal').addClass('m--hide');
        $('#{/literal}{$menu_tab_active}{literal}_tab').trigger('click');
        $('#tabs_principal').removeClass('m--hide');

        snippet_item.init();
    });
</script>
{/literal}