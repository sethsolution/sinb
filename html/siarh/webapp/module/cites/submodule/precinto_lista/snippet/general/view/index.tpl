<div class="m-portlet m--padding-bottom-5" >
    <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{$getModule}"  id="general_form">


        <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">
            {if $item.itemId != "" or $type == 'new'}
            <div class="m-form__content">
                <div class="m-alert m-alert--icon alert alert-danger m--hide" role="alert" id="m_form_1_msg">
                    <div class="m-alert__icon">
                        <i class="la la-warning"></i>
                    </div>
                    <div class="m-alert__text">
                        ¡Atención! Revise la información faltante e intente continuar con su solicitud.
                    </div>
                    <div class="m-alert__close">
                        <button type="button" class="close" data-close="alert" aria-label="Close">
                        </button>
                    </div>
                </div>
            </div>
                {*******************mensaje de observacion************}
                {if $item.estado_id == 3 and $item.observacion!="" and $item.observado==1}
                    <div class="form-group m-form__group m-form row">
                        <div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                            <div class="m-alert__icon">
                                <i class="flaticon-exclamation-2"></i>
                                <span></span>
                            </div>
                            <div class="m-alert__text">
                                <strong>Observación:</strong> {$item.observacion}
                            </div>
                            <div class="m-alert__close">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                </button>
                            </div>
                        </div>
                    </div>
                {/if}


                <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5 m--padding-bottom-5" >
                    <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5 " >
                        <div class="cuadro-verde m--padding-10" >
                            <label class="form-control-label">Tipo de Usuario:</label>
                            <div class="input-group">
                                {if $type == 'new'}
                                    <select class="form-control m-select2 select2_general "
                                            name="item[tipo_id]"  {$privFace.input} id="tipo_id"
                                            required
                                            data-msg="Campo requerido" >
                                        <option value=""></option>
                                        {html_options options=$cataobj.vicuna_tipo selected=$item.tipo_id}
                                    </select>

                                {else}
                                    {$item.vicuna_tipo}
                                {/if}

                            </div>
                        </div>
                    </div>
                </div>
            {else}
                <strong>El registro no existe.</strong>
            {/if}

        </div>
    </form>

</div>
{if $item.estado_id ==1 or $item.estado_id ==3}
    <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
        <i class="m-nav__link-icon flaticon-chat-1"></i>
        <strong>NOTA: </strong>
        <span class="m-nav__link-title">
            <span class="m-nav__link-wrap">
                <span class="m-nav__link-text">Debe realizar la revicion del tramite en la pestaña "REQUISITOS" de la parte superior.</span>
                <span class="m-nav__link-badge">
                    <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
                </span>
            </span>
        </span>
    </div>
{/if}

{include file="index.js.tpl"}
{include file="index.css.tpl"}