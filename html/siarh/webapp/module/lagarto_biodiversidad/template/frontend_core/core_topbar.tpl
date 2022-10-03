<div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">
    <div class="m-stack__item m-topbar__nav-wrapper">
        <ul class="m-topbar__nav m-nav m-nav--inline">
            {*
            {include file="$frontend_topbar_msg"}
            *}

            <li class="m-nav__item m-topbar__quick-actions m-topbar__quick-actions--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push m-dropdown--mobile-full-width m-dropdown--skin-light"  m-dropdown-toggle="click">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                    <span class="m-nav__link-badge m-badge m-badge--dot m-badge--info m--hide"></span>
                    <span class="m-nav__link-icon"><i class="flaticon-share"></i></span>
                </a>
                <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                    <div class="m-dropdown__inner">
                        <div class="m-dropdown__header m--align-center" style="background: url(themes/metro/assets/app/media/img/misc/quick_actions_bg.jpg); background-size: cover;">
                            <span class="m-dropdown__header-title">Soporte SIARH</span>
                            <span class="m-dropdown__header-subtitle">Acceso Directo</span>
                        </div>

                        <div class="m-dropdown__body m-dropdown__body--paddingless">
                            <div class="m-dropdown__content">
                                <div class="data" data="false" data-max-height="380" data-mobile-max-height="200">
                                    <div class="m-nav-grid m-nav-grid--skin-light">
                                        <div class="m-nav-grid__row">
                                            <a href="https://www.facebook.com/siarh.bolivia/" target="_blank" class="m-nav-grid__item">
                                                <i class="m-nav-grid__icon flaticon-facebook-letter-logo"></i>
                                                <span class="m-nav-grid__text">Facebook SIARH</span>
                                            </a>
                                            <a href="https://gitlab.com/sirh/sys" target="_blank" class="m-nav-grid__item">
                                                <i class="m-nav-grid__icon socicon-github "></i>
                                                <span class="m-nav-grid__text">Git Lab SIARH</span>
                                            </a>
                                        </div>
                                        <div class="m-nav-grid__row">
                                            <a href="https://correo.mmaya.gob.bo/" target="_blank" class="m-nav-grid__item">
                                                <i class="m-nav-grid__icon flaticon-mail-1"></i>
                                                <span class="m-nav-grid__text">Correo Electrónico</span>
                                            </a>
                                            <a href="http://www.sirh.gob.bo/" target="_blank" class="m-nav-grid__item">
                                                <i class="m-nav-grid__icon flaticon-squares-3 "></i>
                                                <span class="m-nav-grid__text">Página web SIARH</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>


            <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">
                <a href="#" class="m-nav__link m-dropdown__toggle">
                    <span class="m-topbar__userpic">
                        <img src="images/core/perfil/user.png" class="m--img-rounded m--marginless m--img-centered" alt=""/>
                    </span>
                    <span class="m-topbar__username m--hide">Nick</span>
                </a>

                <div class="m-dropdown__wrapper">
                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                    <div class="m-dropdown__inner">

                        <div class="m-dropdown__header m--align-center" style="background: url(template/user/images/core/perfil/user_profile_bg.jpg); background-size: cover;">
                            <div class="m-card-user m-card-user--skin-dark">
                                <div class="m-card-user__pic">
                                    <img src="index.php?accion=getPhoto" class="m--img-rounded m--marginless" alt=""/>
                                </div>
                                <div class="m-card-user__details">
                                    <span class="m-card-user__name m--font-weight-500">{$usuarioInfo.nombre} {$usuarioInfo.apellido}</span>
                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">Usuario: {$usuarioInfo.usuario}</a></br>
                                    <a href="" class="m-card-user__email m--font-weight-300 m-link">Rol: {$usuarioInfo.nombre_rol}</a>
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
                                        <a href="index.php?module=perfil&smodule=index" class="m-nav__link">
                                            <i class="m-nav__link-icon fab fa fa-hotel"></i>
                                            <span class="m-nav__link-title">
                                                <span class="m-nav__link-wrap">
                                                    <span class="m-nav__link-text">Oficina Virtual</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>

                                    <li class="m-nav__item">
                                        <a href="index.php?module=perfil&smodule=perfil" class="m-nav__link">
                                            <i class="m-nav__link-icon fa fa-user-astronaut"></i>
                                            <span class="m-nav__link-title">
                                                <span class="m-nav__link-wrap">
                                                    <span class="m-nav__link-text">Mi Perfil</span>
                                                </span>
                                            </span>
                                        </a>
                                    </li> *}
                                    {*
                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                    <li class="m-nav__item">
                                        <a href="themes/metro/header/profile.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-info"></i>
                                            <span class="m-nav__link-text">FAQ</span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="themes/metro/header/profile.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                            <span class="m-nav__link-text">Support</span>
                                        </a>
                                    </li>
                                    *}
                                    <li class="m-nav__separator m-nav__separator--fit"></li>

                                    </li>
                                    <li class="m-nav__item">
                                        <a href="index.php?action=close" class="btn btn-danger m-btn m-btn--custom m-btn--bolder m-btn--icon">
                                            <span><i class="fa fa-times"></i><span>Cerrar Sesion</span></span>
                                        </a>
                                    </li>


                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            {*
            <li id="m_quick_sidebar_toggle" class="m-nav__item">
                <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-nav__link-icon">
													<i class="flaticon-grid-menu"></i>
												</span>
                </a>
            </li>
            *}
        </ul>
    </div>
</div>