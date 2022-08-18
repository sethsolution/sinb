{if ($item.id != 0 && $item.id != "" && $type == "update") || $type == "new"}


    {*include file="item/index.css.tpl"*}

    <div class="d-flex flex-column flex-md-row">

        <div class="flex-md-row-fluid ">
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
        {if $type !="new"}
            <div class="flex-md-row-auto w-md-275px w-xl-325px ml-md-6 ml-lg-8">

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card card-custom bgi-no-repeat gutter-b " style="height: 170px; background-color: #663259;
                        background-position: calc(100% + 0.5rem) 100%; background-size: 100% auto;
                        background-image: url(/themes/metro72/assets/media/svg/patterns/taieri.svg)">
                            <!--begin::Body-->
                            <div class="card-body d-flex align-items-center pt-2 pb-2">
                                <div>
                                    <h3 class="text-white font-weight-bolder line-height-lg mb-5">{#title#}</h3>
                                    <a href="{$path_url}" class="btn btn-primary  ">
                                        <i class="ki ki-double-arrow-back"></i> {#glBtnBack#}
                                    </a>
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                    </div>
                </div>

            </div>
        {/if}

    </div>

{else}
    {include file=$frontend.error_01}
{/if}

