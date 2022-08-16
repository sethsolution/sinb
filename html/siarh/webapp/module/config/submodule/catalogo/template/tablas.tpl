<fieldset class="fieldForm">
<legend >Catalagos para editar</legend>

    <table style="width:100%;padding:0px;border-spacing: 0px;padding:0px;" id="oTable_1"
    class="display cell-border hover order-column stripe">
    <thead>
    <tr>
        <th>#</th>
        <th>Catalogos</th></tr>
    </thead>
    <tbody>
    {foreach from=$listTablas item=val key=key name=listTablas}
    <tr>
        <td>{$smarty.foreach.listTablas.iteration}</td>
        <td><a href="javascript:void(0);" onclick="mostrarDatos('{$key}');">{$val}</a></td>
    </tr>          
    {/foreach}
    </tbody>
    </table>

</fieldset>
{include file="tablas.css.tpl"}
{include file="tablas.js.tpl"}