{include file="index.css.tpl"}


    <form class="m-form m-form--fit m-form--label-align-right" method="POST"
          action="{$getModule}"  id="general_form">


    <div class="m-form__content">
        <div class="m-alert m-alert--icon alert alert-danger m--hide m--margin-top-5" role="alert" id="m_form_1_msg">
            <div class="m-alert__icon">
                <i class="la la-warning"></i>
            </div>
            <div class="m-alert__text">
                ¡Atención! Revise la información faltante e intente continuar con su registro.
            </div>
            <div class="m-alert__close">
                <button type="button" class="close" data-close="alert" aria-label="Close">
                </button>
            </div>
        </div>
    </div>
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h4 class="m--font-brand">Datos complementarios para la certificacion CITES</h4>
            </div>
        </div>
    </div>

        <div class="col-lg-12 m--margin-bottom-5 m--padding-left-5">Verifique y confirme la siguiente información adicional:</div>
        <div class="form-group m-form__group row m--padding-bottom-5 m--padding-top-5" >

            <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Autoridad Administrativa:</div>
                    <div class="input-group">
                        <div class="input-group">
                            <textarea cols="3" rows="5" required class="form-control m-input" placeholder="Descripcion del producto" name="item[autoridad_administrativa]"{$privFace.input} >{$item.autoridad_administrativa|escape:'html'}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Lugar de Emision:</div>
                    <input type="text" class="form-control m-input mayus"
                           placeholder="Ingrese el lugar de emision de la certificación" required name="item[emitido_lugar]"
                            {$privFace.input} value="{$item.emitido_lugar|escape:'html'}">
                </div>
            </div>
            <div class="col-lg-6 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Fecha de emisión:</div>
                    <div class="input-group">
                        <input type="text" class="form-control m-input fecha_general" id="fechaemision"
                               placeholder="01/01/1900" name="item[emitido_fecha]"
                               required {$privFace.input} value="{if $item.emitido_fecha}{$item.emitido_fecha|date_format:'%d/%m/%Y'}{/if}">
                        <div class="input-group-append"><span class="input-group-text" id="basic-addon2"><i class="fa fa-calendar"></i></span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 m-form__group-sub m--padding-right-5 m--padding-left-5" >
                <div class="cuadro m--padding-10">
                    <div class="col-lg-12 titulo m--margin-bottom-5 m--padding-left-5">Confirmar la impresión del Certificado o Permiso:</div>
                    <div class="input-group"> ¿Realizó la impresión del Documento?&nbsp;&nbsp;&nbsp;
                        <div class="m-radio-list">
                            <input type="radio" name="item[impreso]" {$privFace.input} value="1" {if $item.impreso == 1} checked{/if}> SI
                            <input type="radio" name="item[impreso]" {$privFace.input} value="0" {if $item.impreso == 0} checked{/if}> NO
                        </div>
                    </div>
                    <span class="m-form__help text-info ">(Debe realizar la impresión del documento antes de aprobarlo)</span>
                </div>
            </div>
        </div>

        <div class="m-form__actions m-form__actions--solid m-form__actions--left">
        {if $privFace.editar == 1}
            <button type="reset" class="btn btn-info" id="general_submit">
                {if $type == 'new'}
                    <span>&nbspGuardar la información y continuar <i class="fa fa-angle-double-right"></i>&nbsp; </span>
                {else}
                    <span>&nbspGuardar la información y continuar <i class="fa fa-angle-double-right"></i>&nbsp; </span>
                {/if}
            </button>
        {/if}
    </div>

</form>
{include file="form.js.tpl"}