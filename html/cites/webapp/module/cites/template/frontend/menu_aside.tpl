<div id="m_ver_menu"
     class="m-aside-menu m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark m-scroller ps ps--active-y"

     m-menu-vertical="1"
     m-menu-scrollable="1"
     m-menu-dropdown-timeout="500"
     style="position: relative; overflow: hidden;">

    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow" style="padding: 0px;">

        {*
        <li class="m-menu__item text-center" aria-haspopup="true"  style=" border-bottom: 1px dotted #525780;">
            <a  href="/cites" class="m-menu__link ">

                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text"><img alt="MMAyA" src="/images/logo/logo_bolivia_blanco2.png" width="160"/></span>
                    </span>
                </span>
            </a>
        </li>
        <li class="m-menu__item " aria-haspopup="true" style=" border-bottom: 1px dotted #525780;">
            <a  href="/" class="m-menu__link ">
                <i class="m-menu__link-icon fa fa-chevron-left"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">{$module_conf.btn_inicio_principal}</span>
                        <span class="m-menu__link-badge"><span class="m-badge m-badge--square">&nbsp;</span></span>
                    </span>
                </span>
            </a>
        </li>
        *}

        <li class="m-menu__item " aria-haspopup="true"  style=" border-bottom: 1px dotted #525780;">
            <a  href="/{$miga.modulo.carpeta}" class="m-menu__link ">
                <i class="m-menu__link-icon fa fa-home"></i>
                <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                        <span class="m-menu__link-text">{$module_conf.btn_inicio}</span>
                        {*<span class="m-menu__link-badge"><span class="m-badge badge m-badge--info">&nbsp;</span></span>*}
                    </span>
                </span>
            </a>
        </li>

        <li class="m-menu__section" style="border-bottom: 2px solid #387ec9; margin: 0px;">
            <h4 class="m-menu__section-text" style="color:whitesmoke; font-size: 16px" >    {$module_conf.menu_titulo}</h4>
            <i class="m-menu__section-icon flaticon-more-v2"></i>
        </li>

        {foreach from=$menu_modulo_principal item=row key=idx}
            <li class="m-menu__item m-menu__item--submenu {if $miga.padre.itemId eq $row.itemId } m-menu__item--open m-menu__item--expanded m-menu__item--hover{/if}"
                aria-haspopup="true"  {*m-menu-submenu-toggle="hover"*}>

            <a  href="javascript:;" class="m-menu__link m-menu__toggle" style=" border-bottom: 1px dotted #0699b3;">
                <i class="m-menu__link-icon {$row.class}"></i>
                <span class="m-menu__link-text">{$row.nombre}</span>
                <i class="m-menu__ver-arrow la la-angle-right"></i>
            </a>
            <div class="m-menu__submenu ">
                <span class="m-menu__arrow"></span>
                <ul class="m-menu__subnav">
                    <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true" >
                        <span class="m-menu__link">
                            <span class="m-menu__link-text">{$row.nombre}</span>
                        </span>
                    </li>
                    {foreach from=$row.submenu item=submenu key=sidx}
                        <li class="m-menu__item {if $miga.smodulo.carpeta eq $submenu.carpeta}m-menu__item--active{/if}" aria-haspopup="true" >
                            <a class="m-menu__link "

                                    {if $submenu.tipo eq 'INDEX'}
                                        href="/{$submenu.modulo_id_tipo_carpeta}"
                                        {if $submenu.target}target="_blank"{/if}
                                    {elseif $submenu.tipo eq 'SB'}
                                        href="/{$submenu.submodulo_id_carpeta_padre}/{$submenu.submodulo_id_carpeta}"
                                        {if $submenu.target}target="_blank"{/if}
                                    {elseif $submenu.tipo eq 'URL'}
                                        href="{$submenu.url}"
                                        {if $submenu.target}target="_blank"{/if}
                                    {else}
                                        href="/{$miga.modulo.carpeta}/{$submenu.carpeta}"
                                        {if $submenu.target}target="_blank"{/if}
                                    {/if}


                            >
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                                <span class="m-menu__link-text">{$submenu.nombre} </span>
                            </a>
                        </li>
                    {/foreach}
                </ul>
            </div>
        </li>
        {/foreach}
    </ul>
</div>