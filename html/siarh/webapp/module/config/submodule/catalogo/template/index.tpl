<div class="titulo2">
Administrador de catalogos
</div>

<div id="modalDialog_Catalogo" title="Tabla del catalogo">
    <div id="progressbar"></div>
    <div id="contentTable"> 
    </div>
</div>  

<div class="dizq50">
<fieldset class="fieldForm">
<legend >Categor&iacute;s Principales</legend>
    <table style="width:100%;padding:0px;border-spacing: 0px;margin:0px auto;" id="oTable_0"
    class="display cell-border hover order-column stripe">
    <thead>
    <tr>
        <th>#</th>
        <th>Categoria</th>
        <th></th>
        <th>Subcategoria</th></tr>
    </thead>
    <tbody>
    {foreach from=$ListCategoria item=val key=key name=listCategoria}
    <tr>
        <td>{$smarty.foreach.listCategoria.iteration}</td>
        <td>{$val.1}</td>
        <td><input type="radio" name="subcategoria" value="{$key}" onclick="getSubCategoria(this.value);"/></td>
        <td>{$val.2}</td>
    </tr>          
    {/foreach}
    </tbody>
    </table>
</fieldset>
</div>

<div class="dder50" id="content_subCategorias">

</div>

<br class="dclear" />

{include file="item_js.tpl"}