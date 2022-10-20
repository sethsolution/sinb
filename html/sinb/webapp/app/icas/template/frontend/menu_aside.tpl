<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
    <!--begin::Menu Nav-->
    <ul class="menu-nav">

        {*
        <li class="menu-item menu-item-active" aria-haspopup="true">
            <a href="/" class="menu-link">
                <span class="menu-icon"><i class="la la-angle-double-left icon-xl "></i></span>
                <span class="menu-text">{#sbmBtnMain#}</span>
            </a>
        </li>
        *}
        <li class="menu-item menu-item-active" aria-haspopup="true">
            <a href="/{$app}" class="menu-link">
                <span class="menu-icon "><i class="fa fa-home text-primary"></i></span>
                <span class="menu-text">{#sbmBtnHome#}</span>
            </a>
        </li>

        <li class="menu-section" style="border-bottom: 1px solid #387ec9; margin: 0px;">
            <h4 class="menu-text">{#sbmTitleMenu#}</h4>
            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
        </li>

        {foreach from=$menu_modulo_principal item=row key=idx}

            <li class="menu-item menu-item-submenu {if $miga.appGroupData.id eq $row.id }menu-item-open menu-item-here{/if}" aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:;" class="menu-link menu-toggle">
                    <i class="menu-icon {$row.class}"></i>
                    <span class="menu-text">{$row.name}</span>
                    <i class="menu-arrow"></i>
                </a>

                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                            <span class="menu-link"><span class="menu-text">{$row.name}</span></span>
                        </li>
                        {foreach from=$row.submenu item=submenu key=sidx}
                            <li class="menu-item {if $miga.appModuleData.folder eq $submenu.folder}menu-item-active{/if}" aria-haspopup="true">
                                <a class="menu-link"
                                        {if $submenu.type  eq 'module'}
                                            href="/{$app}/{$submenu.folder}"
                                            {if $submenu.target}target="_blank"{/if}
                                        {elseif $submenu.type eq 'url'}
                                            href="{$submenu.url}"
                                            {if $submenu.target}target="_blank"{/if}
                                        {/if}
                                >
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="menu-text">{$submenu.name}</span>
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                </div>
            </li>
        {/foreach}
    </ul>
    <!--end::Menu Nav-->
</div>