<div class="row mb-7">
    {foreach from=$menu_modulo_principal item=row key=idx}
        {if count($row.submenu) > 0}

            <div class="col-lg-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">

                    <div class="card-body p-2" >

                        <!--begin::Top-->
                        <div class="d-flex align-items-center" >
                            <!--begin::Symbol-->
                            <div class="symbol symbol-40  mr-5" >
                                <span class="symbol-label"><i class="{$row.class} text-primary"></i></span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column flex-grow-1">
                                <span class=" text-primary mb-1 font-size-lg font-weight-bolder">{$row.name}</span>
                                {*<a href="#" class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{$row.name}</a>*}
                                {*<span class="text-muted font-weight-bold">Yestarday at 5:06 PM</span>*}
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Top-->

                        <div class="pt-2">
                            <!--begin::Image-->
                            <div class="bgi-no-repeat bgi-size-cover rounded min-h-165px" rel="color_{$idx}"
                                 style="background-image: url(/app/core/template/images/home/{$row.id}.jpg)"></div>
                            <!--end::Image-->
                            <!--begin::Text-->
                            {if $row.description != ''}
                                <p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2">
                                    {$row.description}
                                </p>
                            {/if}
                            <!--end::Text-->
                        </div>


                        <div class="separator separator-solid mt-0 mb-2"></div>

                        {foreach from=$row.submenu item=submenu key=sidx}
                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-0">
                                <!--begin::Symbol-->
                                <div class="symbol symbol-40 symbol-light-success mr-5">
                                    <span class="symbol-label"><i class="{$submenu.class} text-success"></i></span>
                                </div>
                                <!--end::Symbol-->

                                <!--begin::Text-->
                                <div class="d-flex flex-column font-weight-bold">
                                    <a class="text-dark text-hover-primary mb-1 font-size-lg"
                                            {if $submenu.type eq 'app'}
                                                href="/{$submenu.folder}"
                                            {elseif $submenu.type eq 'url'}
                                                href="{$submenu.url}"
                                            {/if}
                                            {if $submenu.target}target="_blank"{/if}
                                    >{$submenu.name}</a>
                                    <span class="text-muted">{$submenu.description}</span>
                                </div>
                                <!--end::Text-->
                            </div>
                            <!--end::Item-->
                            <div class="separator separator-solid mt-0 mb-2"></div>
                        {/foreach}
                    </div>
                </div>
                <!--end::Card-->
            </div>
        {/if}
    {/foreach}
</div>

{include file="index.css.tpl"}