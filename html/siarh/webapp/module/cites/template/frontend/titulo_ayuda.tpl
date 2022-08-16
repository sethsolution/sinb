{if $manual_ayuda.general}
    <li class="m-portlet__nav-item">
        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
            <a href="#" class="m-portlet__nav-link btn btn-lg btn-warning  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                <i class="fa fa-question "></i>
            </a>
            <div class="m-dropdown__wrapper">
                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                <div class="m-dropdown__inner">
                    <div class="m-dropdown__body m--padding-10">
                        <div class="m-dropdown__content  m--padding-5 m--margin-5">

                            <ul class="m-nav ">

                                {if $manual_ayuda.soporte}
                                    <li class="m-nav__section m--margin-5" style="margin: 0px!important;">
                                        <span class="m-nav__section-text">Soporte</span>
                                    </li>
                                    {if $manual_ayuda.pdf}
                                        <li class="m-nav__item">
                                            <a href="index.php?accion=manual?module={$miga.modulo.carpeta}&smodule={$miga.smodulo.carpeta}" target="_blank" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                <span class="m-nav__link-text">Manual de Usuario (PDF)</span>
                                            </a>
                                        </li>
                                    {/if}

                                    {if $manual_ayuda.online}
                                        <li class="m-nav__item">
                                            <a href="{$manual_ayuda.online_url}" target="_blank" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-info"></i>
                                                <span class="m-nav__link-text">Manual de Usuario (Web)</span>
                                            </a>
                                        </li>
                                    {/if}

                                    {if $manual_ayuda.ticket}
                                        <li class="m-nav__item">
                                            <a href="{$manual_ayuda.ticket_url}" target="_blank" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                <span class="m-nav__link-text">{$manual_ayuda.ticket_nombre}</span>
                                            </a>
                                        </li>
                                    {/if}

                                {/if}


                                {if $manual_ayuda.otro}
                                    <li class="m-nav__section m-nav__section--first">
                                        <span class="m-nav__section-text">{$manual_ayuda.otro_titulo}</span>
                                    </li>
                                    {if $manual_ayuda.web}
                                        <li class="m-nav__item">
                                            <a href="{$manual_ayuda.web_url}" target="_blank" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                <span class="m-nav__link-text">{$manual_ayuda.web_nombre}</span>
                                            </a>
                                        </li>
                                    {/if}
                                    {if $manual_ayuda.fb}
                                        <li class="m-nav__item">
                                            <a href="{$manual_ayuda.fb_url}" target="_blank" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                <span class="m-nav__link-text">{$manual_ayuda.fb_nombre}</span>
                                            </a>
                                        </li>
                                    {/if}
                                {/if}


                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
{/if}