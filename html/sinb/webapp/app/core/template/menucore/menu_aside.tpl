<div id="kt_aside_menu" class="aside-menu mt-0"  data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
    <!--begin::Menu Nav-->
    <ul class="menu-nav pt-0 mt-0">

        {foreach from=$menu_modulo_principal item=row key=idx}
            {if count($row.submenu) > 0}

                {if ($grupo_inicio != $row.padre) or ($idx eq 0 )}
                    {assign var ="grupo_inicio" value=$row.parent }
                    <li class="menu-section" style="border-bottom: 1px solid #387ec9; margin: 0px;">
                        <h4 class="menu-text" style="color:whitesmoke;">{$row.parent_name}</h4>
                        <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                    </li>
                {/if}

                <li class="menu-item menu-item-submenu {if $miga.padre.itemId eq $row.itemId }menu-item-open menu-item-here{/if}" aria-haspopup="true" data-menu-toggle="hover">
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
                                <li class="menu-item {if $miga.smodulo.carpeta eq $submenu.carpeta}menu-item-active{/if}" aria-haspopup="true">
                                    <a class="menu-link"
                                            {if $submenu.type eq 'app'}
                                                href="/{$submenu.folder}"
                                            {elseif $submenu.type eq 'url'}
                                                href="{$submenu.url}"
                                            {/if}
                                            {if $submenu.target}target="_blank"{/if}
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
            {/if}
        {/foreach}
    </ul>
    <!--end::Menu Nav-->
</div>