{include file="index.css.tpl"}
<div class="d-flex flex-column flex-md-row">
    <div class="flex-md-row-fluid ">
        <div class="card card-custom gutter-b">
            <div class="card-header card-header-tabs-line">
                <div class="card-toolbar">
                    <ul class="nav nav-tabs nav-tabs-space-lg nav-tabs-line nav-tabs-bold nav-tabs-line-3x" id="myTab" role="tablist">
                        {foreach from=$menu_tab item=row key=idx}
                            <li class="nav-item">
                                <a class="nav-link"
                                   role="tab"
                                   data-toggle="tabajax"
                                   data-target="#{$row.id_name}_pane"
                                   id = "{$row.id_name}_tab"
                                   href="{$path_url}/{$row.id_name}_/{$id}"
                                >
                                    <span class="nav-icon"><i class="{$row.icon}"></i></span>
                                    <span class="nav-text">{$row.label}</span>
                                </a>
                            </li>
                        {/foreach}

                    </ul>
                </div>
            </div>
            <div class="card-body p-0" >
                <div class="tab-content mt-5" >
                    {foreach from=$menu_tab item=row key=idx}
                        <div class="tab-pane fade" id="{$row.id_name}_pane" role="tabpanel" aria-labelledby="{$row.id_name}-tab"></div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
</div>