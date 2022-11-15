<div class="row mb-7">
    {foreach from=$menu_modulo_principal item=row key=idx}
    <div class="col-lg-6">
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            {*
            <div class="card-header ribbon ribbon-clip ribbon-right">
                <div class="ribbon-target" style="top: 15px; height: 45px;">
                    <span class="ribbon-inner bg-primary"></span><i class="{$row.class} text-white"></i>
                </div>
                <h3 class="card-title">{$row.nombre}</h3>
            </div>
            *}
            <div class="card-body p-2">
                <!--begin::Top-->
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-40  mr-5" >
                        <span class="symbol-label"><i class="{$row.class} text-primary"></i></span>
                    </div>
                    <div class="d-flex flex-column flex-grow-1">
                        <span class=" text-primary mb-1 font-size-lg font-weight-bolder">{$row.name}</span>
                        {*
                        <a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{$row.name}</a>
                        <span class="text-muted font-weight-bold">Yestarday at 5:06 PM</span>*}
                    </div>
                </div>

                <!--end::Top-->
                <div class="pt-2">
                    <div class="bgi-no-repeat bgi-size-cover rounded min-h-165px" rel="color_{$idx}"
                         style="background-image: url(/app/{$app}/template/images/home/{$row.id}.jpg)"></div>
                    <p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2">
                        {$row.description}
                    </p>
                </div>
                <div class="separator separator-solid mt-0 mb-2"></div>
                {foreach from=$row.submenu item=submenu key=sidx}
                    <!--begin::Item-->
                    <div class="d-flex align-items-center mb-0">
                        <div class="symbol symbol-40 symbol-light-success mr-5">
                            <span class="symbol-label"><i class="{$submenu.class} text-success"></i></span>
                        </div>

                        <!--begin::Text-->
                        <div class="d-flex flex-column font-weight-bold">
                            <a class="text-dark text-hover-primary mb-1 font-size-lg"
                                    {if $submenu.type  eq 'module'}
                                        href="/{$app}/{$submenu.folder}"
                                        {if $submenu.target}target="_blank"{/if}
                                    {elseif $submenu.type  eq 'url'}
                                        href="{$submenu.url}"
                                        {if $submenu.target}target="_blank"{/if}
                                    {/if}
                            >{$submenu.name}</a>
                            <span class="text-muted">{$submenu.description}</span>
                        </div>
                        <!--end::Text-->
                    </div>
                    <!--end::Item-->
                    <div class="separator separator-solid mt-2 mb-2"></div>
                {/foreach}
            </div>
        </div>
        <!--end::Card-->
    </div>
    {/foreach}
</div>

{include file="index.css.tpl"}