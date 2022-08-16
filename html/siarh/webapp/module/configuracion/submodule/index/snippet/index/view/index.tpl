    {assign var=numcols value=0}
    {foreach from=$menu_modulo_principal item=row key=idx}
        {assign var="numcols" value="`$numcols+1`"}
        {assign var="mod" value="`$numcols%3`"}
        {if $mod ==1 }
            <div class="row">
        {/if}


        <div class="col-xl-4">
            <!--begin:: Widgets/Blog-->
            <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force" >

                <div class="m-portlet__head m-portlet__head--fit">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-action">

                        </div>
                    </div>
                </div>
                <div class="m-portlet__body ">
                    <div class="m-widget19">
                        <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px" rel="color_{$idx}">
                            <img src="images/principal/{$miga.modulo.carpeta}/{$row.itemId}.jpg" alt="">
                            <h3 class="m-widget19__title m--font-light titulo_menu">{$row.nombre}</h3>
                            <div class="m-widget19__shadow"></div>
                        </div>


                        <div class="m-widget19__content" >
                            <!-- <div class="m-widget19__header">
                                <div class="m-widget19__user-img">
                                    <img class="m-widget19__img" src="./assets/app/media/img//users/user1.jpg" alt="">
                                </div>
                                <div class="m-widget19__info">
						<span class="m-widget19__username">
						Anna Krox
						</span><br>
                                    <span class="m-widget19__time">
						UX/UI Designer, Google
						</span>
                                </div>
                                <div class="m-widget19__stats">
						<span class="m-widget19__number m--font-brand">
						18
						</span>
                                    <span class="m-widget19__comment">
						Comments
						</span>
                                </div>
                            </div>
                            <div class="m-widget19__body">
                                {$row.descripcion}
                            </div> -->
                        </div>
                        {**}
                        <div class="m-widget19__content">
                            <div class="m-widget19__body">
                                {$row.descripcion}

                            </div>
                        </div>


                        <ul class="m-nav">
                            {foreach from=$row.submenu item=submenu key=sidx}
                                <li class="m-nav__item">
                                    <a class="m-nav__link"
                                       {*
                                            {if $submenu.tipo == '0'}
                                                href="index.php?module={$miga.modulo.carpeta}&smodule={$submenu.carpeta}"
                                            {else}
                                                href="{$submenu.url}"
                                                target="_blank"
                                            {/if}
*}
                                            {if $submenu.tipo == 'INDEX'}
                                                href="index.php?module={$submenu.modulo_id_tipo_carpeta}&smodule=index"
                                                {if $submenu.target}target="_blank"{/if}

                                            {elseif $submenu.tipo == 'SB'}
                                                href="index.php?module={$submenu.submodulo_id_carpeta_padre}&smodule={$submenu.submodulo_id_carpeta}" {if $submenu.target}target="_blank"{/if}


                                            {elseif $submenu.tipo == 'URL'}
                                                href="{$submenu.url}"
                                                {if $submenu.target}target="_blank"{/if}
                                            {else}
                                                href="index.php?module={$miga.modulo.carpeta}&smodule={$submenu.carpeta}"
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