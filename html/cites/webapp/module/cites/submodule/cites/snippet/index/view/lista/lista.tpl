{include file="lista/lista.css.tpl"}

<div class="m-portlet m-portlet--last m-portlet--head-lg m-portlet--responsive-mobile" id="main_portlet">
    <div class="m-portlet__head" style="">
        <div class="m-portlet__head-progress"><!-- here can place a progress bar--></div>
        <div class="m-portlet__head-wrapper">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon"><i class="flaticon-map-location"></i></span>
                    <h3 class="m-portlet__head-text">
                        PROCEDIMIENTO PARA SOLICITUD DE CERTIFICACIONES CITES
                    </h3>
                </div>
            </div>
            <div class="m-portlet__head-tools">

                {if $privFace.editar == 1 and $privFace.crear == 1}
                    <a href="#" class="btn btn-primary m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_update" rel="new">
                        <span><i class="fa fa-plus"></i><span>Iniciar una nueva solicitud CITES</span></span>
                    </a>
                {/if}

            </div>
        </div>
    </div>

    <div class="m-portlet__body ">
        {include file="lista/lista_busqueda.tpl"}
        <table class="table table-striped table-bordered table-hover table-checkable table-sm m-table m-table--head-bg-brand {*display responsive nowrap*}  m--hide" id="index_lista">
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






