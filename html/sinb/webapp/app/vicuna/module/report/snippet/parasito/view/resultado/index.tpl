{include file="resultado/index.css.tpl"}

{if $res.totalGarrapata >0 || $res.totalPiojo>0 || $res.totalSarna>0 || $res.totalCSi>0 || $res.totalCNo>0}
    {include file="resultado/resumen01.tpl"}

    <table class="table {*table-separate table-striped*}  table-bordered table-hover table-head-custom table-checkable  table-sm  "
           id="tabla_{$subcontrol}" >
        <thead>
        <tr class="thead-dark thead-color">
            <th >Departamento</th>
            <th >Municipio</th>
            <th >Total con Garrapata</th>
            <th >Total con Piojo</th>
            <th >Total con Sarna</th>
            <th >Total con Caspa</th>
            <th >Total sin Caspa</th>
        </tr>
        </thead>
    <tbody>
        {foreach from=$res.resultado item=row key=idx}
            <tr>
                <td>{$row.departamento}</td>
                <td>{$row.municipio}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_garrapata|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_piojo|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_sarna|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_csi|string_format:'%.0f'}</td>
                <td style="text-align: right;color:#066d12;">{$row.total_cno|string_format:'%.0f'}</td>
            </tr>
        {/foreach}
        </tbody>
        <tfoot></tfoot>
    </table>
{/if}
{include file="resultado/index.js.tpl"}