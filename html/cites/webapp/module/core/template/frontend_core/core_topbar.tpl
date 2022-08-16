<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
    <div class="m-stack__item m-topbar__nav-wrapper">
        <ul class="m-topbar__nav m-nav m-nav--inline">
            {*
            {include file="$frontend_topbar_msg"}
            *}

            {if $sess.auth != true}
                <li class="m-nav__item m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                    m-dropdown-toggle="click" aria-expanded="true">
                    <a href="#" id="btn_form_login2" class="m-nav__link m-dropdown__toggle">
                        <span class="m-topbar__username m--hidden-mobile" style="color: #575966;">Entrar  &nbsp;</span>
                        <span class="m-topbar__userpic">
                            <img src="/images/icons/login.png" class="m--img-rounded m--marginless m--img-centered" alt="">
                        </span>
                    </a>
                    <div class="m-dropdown__wrapper" style="z-index: 101;">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust" style="left: auto; right: 22.5px;"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav m-nav--skin-light">
                                        {*
                                        <li class="m-nav__item">
                                            <a href="#" class="m-nav__link" id="btn_form_reg"><i class="m-nav__link-icon fa fa-clipboard-list"></i>
                                                <span class="m-nav__link-text">Registrarse al Sistema</span>
                                            </a>
                                        </li>
                                        *}
                                        <li class="m-nav__item ">
                                            <a href="#" id="btn_form_login" class="m-nav__link m--font-success"><i class="m-nav__link-icon fa fa-archway"></i>
                                                <span class="m-nav__link-text">Entrar al Sistema</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            {/if}

            {if $sess.auth}
            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img
            m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right
            m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                   <span class="m-topbar__userpic">
                        Mi Perfil&nbsp;&nbsp;
                    </span>
                    <span class="m-topbar__userpic">
                        <img src="/?accion=getPhoto" class="m--img-rounded m--marginless m--img-centered" alt=""/>
                    </span>
                </a>

                <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                    <div class="m-dropdown__inner">

                        <div class="m-dropdown__header m--align-center" style="background: #434441; background-size: cover;">
                            <div class="m-card-user m-card-user--skin-dark">
                                <div class="m-card-user__pic">
                                    <img src="/?accion=getPhoto" class="m--img-rounded m--marginless" alt=""/>
                                </div>
                                <div class="m-card-user__details">
                                    <span class="m-card-user__name m--font-weight-500">{$usuarioInfo.usuario} </span>
                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">{$usuarioInfo.email}</a>
                                </div>
                            </div>
                        </div>

                        <div class="m-dropdown__body">
                            <div class="m-dropdown__content">
                                <ul class="m-nav m-nav--skin-light">
                                    <li class="m-nav__section m--hide">
                                        <span class="m-nav__section-text">Sección</span>
                                    </li>
                                   {* <li class="m-nav__item">
                                        <a href="/perfil" class="m-nav__link">
                                            <i class="m-nav__link-icon fab fa fa-hotel"></i>
                                            <span class="m-nav__link-title">
                                                <span class="m-nav__link-wrap">
                                                    <span class="m-nav__link-text">Oficina Virtual</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>*}

                                    <li class="m-nav__item">
                                        <a href="/perfil/usuario" class="m-nav__link">
                                            <i class="m-nav__link-icon fa fa-user-astronaut"></i>
                                            <span class="m-nav__link-title">
                                                <span class="m-nav__link-wrap">
                                                    <span class="m-nav__link-text">Mi Perfil</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__separator m-nav__separator--fit"></li>

                                    <li class="m-nav__item">
                                        <a href="/?action=close" class="btn btn-danger btn-block m-btn m-btn--custom m-btn--bolder m-btn--icon">
                                            <span><i class="fa fa-times"></i><span>Cerrar Sesion</span></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            {/if}

        </ul>
    </div>
</div>