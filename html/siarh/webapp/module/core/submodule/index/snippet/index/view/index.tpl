{*include file="menu.demo.tpl"*}

    {assign var=numcols value=0}
    {foreach from=$menu_modulo_principal item=row key=idx}
        {assign var="numcols" value="`$numcols+1`"}
        {assign var="mod" value="`$numcols%3`"}
        {if $mod ==1 }
            <div class="row">
        {/if}
        <div class="col-xl-4 m--padding-5" >
            <!--begin:: Widgets/Blog-->
            <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force" >

                <div class="m-portlet__head m-portlet__head--fit">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-action">

                        </div>
                    </div>
                </div>
                <div class="m-portlet__body m--padding-left-20 m--padding-right-20" >
                    <div class="m-widget19">
                        <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px" rel="color_{$idx}">
                            <img src="images/core_menu/{$row.itemId}.jpg?id=234d3" alt="">
                            <h3 class="m-widget19__title m--font-light">{$row.nombre}</h3>
                            <div class="m-widget19__shadow"></div>
                        </div>

                        <div class="m-widget19__content" >
                            <div class="m-widget19__header m--margin-top-10" >
                                <div class="m-widget19__stats">
                                    {if $row.descripcion != ''}
                                        <button type="button" class="btn btn-accent m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill btn btn-success "
                                                data-toggle="modal" data-target="#m_modal_{$row.itemId}" title="Más Información"><i class="la la-tint"></i></button>
                                    {/if}
                                </div>
                                {*
                                <div class="m-widget19__user-img">
                                    <img class="m-widget19__img" src="images/logo/mmaya_ico01.png" alt="">
                                </div>
                                *}
                                <div class="m-widget19__info" >
                                    <span class="m-widget19__username">{*$row.nombre*}#CuidemosLaMadreTierra</span>
                                    <br>
                                    <span class="m-widget19__time">MMAyA</span>
                                </div>


                            </div>
                        </div>

                        {if $row.descripcion != ''}
                            <!--begin::Modal-->
                            <div class="modal fade" id="m_modal_{$row.itemId}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_{$row.itemId}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header" style=" padding-bottom:10px;">
                                            <h5 class="modal-title" id="exampleModalLabel_{$row.itemId}">{$row.nombre}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">{$row.descripcion}</div>
                                        <div class="modal-footer"><button type="button" class="btn  btn-outline-success active" data-dismiss="modal">Cerrar</button>                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Modal-->
                        {/if}

                        <ul class="m-nav">
                            {foreach from=$row.submenu item=submenu key=sidx}
                                <li class="m-nav__item" style="border-bottom: 1px dotted #e2e1e4;">
                                    <a class="m-nav__link  "
                                            {if $submenu.tipo == 'INDEX'}
                                                href="index.php?module={$submenu.carpeta}&smodule=index" {if $submenu.target}target="_blank"{/if}
                                            {elseif $submenu.tipo == 'URL'}
                                                href="{$submenu.url}"
                                                {if $submenu.target}target="_blank"{/if}
                                            {elseif $submenu.tipo == 'SB'}
                                                href="index.php?module={$submenu.modulo}&smodule={$submenu.submodulo}" {if $submenu.target}target="_blank"{/if}
                                            {/if}
                                    >
                                        <i class="m-nav__link-icon {$submenu.class}"></i>
                                        <span class="m-nav__link-text">{$submenu.nombre}</span>
                                    </a>
                                </li>
                            {/foreach}
                        </ul>

                    </div>
                </div>
            </div>
            <!--end:: Widgets/Blog-->
        </div>

        {if $mod ==0 }
            </div>
        {/if}

    {/foreach}

    {if $mod != 0 }
    </div>
    {/if}

{include file="index.css.tpl"}