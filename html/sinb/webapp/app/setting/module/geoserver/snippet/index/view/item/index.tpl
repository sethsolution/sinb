{if ($item.id != 0 && $item.id != "" && $type == "update") || $type == "new"}

    <div class="card card-custom">
        <div class="card-header py-3">
            <div class="card-title">
                <span class="card-icon"><i class="la la-thumb-tack text-success icon-lg "></i></span>
                <h3 class="card-label">{#title#} {if $item.titulo !=""}:  <span class="text-success">{$item.titulo}</span> {/if}</h3>
            </div>
            <div class="card-toolbar">
                {if $privFace.edit == 1 and $privFace.add == 1}
                    <!--begin::Button-->
                    <a href="{$path_url}" class="btn btn-primary  ">
                        <i class="ki ki-double-arrow-back"></i> {#glBtnBack#}
                    </a>
                    <!--end::Button-->
                {/if}
            </div>
        </div>

        <div class="card card-custom">
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
                                        {if $type == 'update'}
                                            href="{$path_url}/{$row.id_name}_/{$id}"
                                        {else}
                                            href="{$path_url}/{$row.id_name}_/new/"
                                        {/if}
                                >
                                    <span class="nav-icon"><i class="{$row.icon}"></i></span>
                                    <span class="nav-text">{$row.label}</span>
                                </a>
                            </li>
                        {/foreach}

                    </ul>
                </div>
            </div>
            <div class="card-body" style="padding: 0px;">
                <div class="tab-content mt-5" >
                    {foreach from=$menu_tab item=row key=idx}
                        <div class="tab-pane fade" id="{$row.id_name}_pane" role="tabpanel" aria-labelledby="{$row.id_name}-tab"></div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>

{else}
    {include file=$frontend.error_01}
{/if}

