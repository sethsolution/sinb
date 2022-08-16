<div class="m-portlet m--padding-bottom-5" >
    <form class="m-form m-form--fit m-form--label-align-right" method="POST" action="{$getModule}"  id="general_form">

        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h4 class="m--font-success">Datos Generales</h4>
                </div>
            </div>
        </div>

        <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5">

            {if $item.itemId != "" or $type == 'new'}


                <div class="form-group m-form__group row m--padding-top-5 m--padding-bottom-5 " >
                    <div class="col-lg-12  m-form__group-sub m--padding-right-5 m--padding-left-5" >
                        <div class="cuadro m--padding-10">
                            <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Datos de la Gestión</div>
                            <div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Gestión:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control m-input mayus"
                                           placeholder="Ingrese la gestión" name="item[gestion]"
                                            {$privFace.input} value="{$item.gestion|escape:'html'}"
                                           data-msg="Campo requerido" required minlength="2">
                                </div>

                            </div><div class="col-lg-12 m-form__group-sub cuadro-padding-0">
                                <label class="form-control-label">Descripción:</label>
                                <div class="input-group">
                                    <textarea class="form-control m-input mayus"
                                              name="item[descripcion]"  rows="3"
                                    >{$item.descripcion|escape:'html'}</textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            <div class="m-form__actions m-form__actions--solid m-form__actions--left">

                    <button type="reset" class="btn btn-primary" id="general_submit">
                        <span>&nbsp;Guardar y continuar <i class="fa fa-angle-double-right"></i>&nbsp; </span>
                    </button>

            </div>
            {else}
                <strong>El registro no existe.</strong>
            {/if}

        </div>
    </form>

</div>
{if $item.estado_id ==1 or $item.estado_id ==3}
    <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
        <span class="m-nav__link-badge">
            <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
        </span>
        <span class="m-nav__link-title">
            <span class="m-nav__link-wrap">
                <span class="m-nav__link-text">Debe continuar con el registro de especies, en la opción <strong> "ESPECIE"</strong> de la parte superior.</span>
                <i class="m-nav__link-icon flaticon-chat-1"></i>
            </span>
        </span>
    </div>
{/if}

{include file="index.js.tpl"}
{include file="index.css.tpl"}