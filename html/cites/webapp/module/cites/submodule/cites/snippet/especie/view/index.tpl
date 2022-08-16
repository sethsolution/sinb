
<!--begin::Modal-->
<div class="modal fade" id="form_modal_{$subcontrol}" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="true"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="modal-content_{$subcontrol}"></div>
    </div>
</div>
<!--end::Modal-->

{include file="index.css.tpl"}
<div class="m-portlet " >
    <div class="m-portlet__body m--padding-10">
        <div class="alert m-alert m-alert--default m-alert--icon ayuda" role="alert">
            <div class="m-alert__icon"><i class="flaticon-notes"></i></div>
            <div class="m-alert__text" style="text-align: justify;">
                <strong>Adicionar una Especie a la solicitud</strong><br>
                Haga clic en el boton <strong>"Adicionar otra fila de datos"</strong> para adicionar otra fila de datos
            </div>
        </div>
    </div>

    <div class="m-portlet__head m--padding-bottom-5 m--padding-top-5 m--padding-left-5 m--padding-right-5">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h5 class="m--font-primary">Paso 2: Registro de las especies </h5>
            </div>
        </div>
        {if $item_padre.estado_id == 1 or  $item_padre.estado_id == 3}
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">
                    <li class="m-portlet__nav-item">
                        {if $privFace.editar == 1 and $privFace.crear == 1}
                            <a href="#" class="btn btn-success m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_form_{$subcontrol}" rel="new">
                                <span><i class="fa fa-plus"></i><span>Adicionar otra fila de datos</span></span>
                            </a>
                        {/if}
                    </li>
                </ul>
            </div>
        {/if}
    </div>

    <div class="m-portlet__body m--padding-bottom-5 m--padding-top-5 m--padding-left-5 m--padding-right-5">

        <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-success m--hide" id="tabla_{$subcontrol}">
            <thead>
            <tr>
                {foreach from=$grill_list item=row key=idx}
                    <th>{$row.label|escape:"html"}</th>
                {/foreach}
            </tr>
            </thead>
            <tfoot></tfoot>
        </table>
    </div>

</div>


{if $item_padre.estado_id ==1 or $item_padre.estado_id ==3}
<div class="m-portlet__body ">
    <div class="m-form__actions m-form__actions--solid m-form__actions--left">
        <button type="reset" class="btn btn-success" id="general_submit">
            <span>&nbsp;Continuar con el registro de requisitos&nbsp;&nbsp;<i class="fa fa-angle-double-right"></i>&nbsp; </span>
        </button>
    </div>
</div>
{/if}

{if $item_padre.estado_id ==1 or $item_padre.estado_id ==3}
    <div class="alert alert-primary alert-dismissible fade show   m-alert m-alert--air m-alert--outline" role="alert">
        <span class="m-nav__link-badge">
            <span class="m-badge m-badge--danger m-badge--wide m-badge--rounded">NOTA</span>
        </span>
        <span class="m-nav__link-title">
            <span class="m-nav__link-wrap">
                <span class="m-nav__link-text">Debe continuar con el registro de los documentos, en la opción <strong> "PASO 3"</strong> de la parte superior.</span>
                <i class="m-nav__link-icon flaticon-chat-1"></i>
            </span>
        </span>
    </div>
{/if}
{include file="index.js.tpl"}
