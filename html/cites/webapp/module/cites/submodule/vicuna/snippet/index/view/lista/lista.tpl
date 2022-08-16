{include file="lista/lista.css.tpl"}

<div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
    <div class="m-portlet__head" style="">
        <div class="m-portlet__head-progress"><!-- here can place a progress bar--></div>
        <div class="m-portlet__head-wrapper">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon"><i class="la la-thumb-tack m--font-success"></i></span>
                    <h3 class="m-portlet__head-text">
                        SOLICITUD DE MARCA VICUÑA
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">

                {if $privFace.editar == 1 and $privFace.crear == 1}
                    <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_update" rel="new">
                        <span><i class="fa fa-plus"></i><span>CREAR UNA SOLICITUD</span></span>
                    </a>
                {/if}

            </div>
        </div>
    </div>

    <div class="m-portlet__body ">


        <div class="alert m-alert m-alert--default" role="alert">

            <b>SOLICITUD DE MARCA VICUÑA</b>
            <br>La duración del trámite es de quince (15) días hábiles.
            En caso que la documentación presente observaciones o está incompleta,
            será devuelta al solicitante. La documentación presentada deberá ser legible y en idioma castellano.
        </div>

        <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table
        m-table--head-bg-brand {*display responsive nowrap*}  m--hide" id="index_lista">
            <thead>
            <tr>
                {foreach from=$grill_list item=row key=idx}
                    <th>{$row.label|escape:"html"}</th>
                {/foreach}
            </tr>
            </thead>
        </table>
    </div>
</div>




