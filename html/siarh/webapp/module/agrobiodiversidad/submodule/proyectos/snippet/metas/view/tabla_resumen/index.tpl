{include file="form/index.css.tpl"}
    <div class="modal-header">
        <h4 class="modal-title">Metas del proyecto en agrobiodiversidad</h4>
    </div>
    <div class="modal-body">
        <table class="table table-sm table-bordered m-table m-table--border-brand">
            {$cat_id = null}
            {$promedio = 0}
            {$contador = 0}
            {foreach key=key item=row from=$metas}
            {if $cat_id neq $row.cat_itemid}
                {if $contador gt 0}
                    {$prom = $promedio/$contador}
                <tr>
                    <td colspan="4"></td>
                    <td class="text-center">
                    {if $prom > 100}
                        100%
                    {else}
                        {$prom}%
                    {/if}
                    </td>
                </tr>
                {$promedio = 0}
                {$contador = 0}
                {/if}
            <thead>
                <tr>
                    <th>{$row.categoria}</th>
                    <th class="text-center">Línea base</th>
                    <th class="text-center">Meta</th>
                    <th class="text-center">Realizado</th>
                    <th class="text-center">%</th>
                </tr>
            </thead>
            {/if}
            <tr>
                <td>{$row.detalle}</td>
                <td class="text-center">{$row.linea_base}</td>
                <td class="text-center">{$row.meta}</td>
                <td class="text-center">{$row.total}</td>
                <td class="text-center">{$row.porcentaje}%</td>
            </tr>
            {$cat_id=$row.cat_itemid}
            {$contador = $contador + 1}
            {$promedio = $promedio + $row.porcentaje}
            {/foreach}
            {if $contador gt 0}
                {$prom = $promedio/$contador}
            <tr>
                <td colspan="4"></td>
                <td class="text-center">
                {if $prom > 100}
                    100%
                {else}
                    {$prom}%
                {/if}
                </td>
            </tr>
            {$promedio = 0}
            {$contador = 0}
            {/if}
        </table>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-block-custom" data-dismiss="modal" id="btn_modal_close">Cerrar</button>
    </div>
{include file="form/index.js.tpl"}