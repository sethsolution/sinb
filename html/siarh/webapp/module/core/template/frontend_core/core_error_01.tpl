<div class="row">
    <div class="col-xl-3">
    </div>
    <div class="col-xl-6">
        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-portlet--rounded-force">
            <div class="m-portlet__body">
                <div class="m-widget19">
                    <div class="m-widget19__pic m-portlet-fit--top m-portlet-fit--sides" style="min-height-: 286px">
                        <img src="images/principal/error_01.jpg" alt="">
                        <h3 class="m-widget19__title m--font-light">Error de dato !!!</h3>
                    </div>

                    <div class="m-widget19__content">
                        <div class="m-widget19__header">
                            <div class="m-widget19__info">
                                <span class="m-widget19__username">Ocurrio  un error de dato</span><br>
                                <span class="m-widget19__time">
                                    SIARH - <span class="m--font-danger">Número de error #21</span>
                                </span>
                            </div>
                            <div class="m-widget19__stats">
                                <span class="m-widget19__number m--font-brand">{$smarty.now|date_format:"%d/%m/%y"}</span>
                                <span class="m-widget19__comment">Fecha</span>
                            </div>
                        </div>
                        <div class="m-widget19__body">
                            El dato con código
                            <span class="m--font-danger">" {$id} "</span>
                            que quiere acceder  no existe o fue eliminado o No tienes acceso.
                            <br><br>
                            Para mayor información contáctese con los teléfonos:
                            <span class="m--font-info">{$msg_core.soporte_numero}</span>
                            o escriba al correo <a href="mailto:{$msg_core.msg_core.soporte_whatsapp}">{$msg_core.soporte_email}</a>
                            {*
                            <br>
                            Tambien puede ingresar al grupo de Whatsapp de SIARH <a href="{$msg_core.soporte_whatsapp}">Whatsapp</a>
*}


                        </div>
                    </div>

                    <ul class="m-nav">
                        <li class="m-nav__item">
                            <a class="m-nav__link" href="https://gitlab.com/sirh/sys/issues/new" target="_blank">
                                <i class="m-nav__link-icon flaticon-notes"></i>
                                <span class="m-nav__link-text">Crear un Ticket de Soporte (Issue)</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a class="m-nav__link" href="https://www.facebook.com/siarh.bolivia" target="_blank">
                                <i class="m-nav__link-icon fa fa-facebook"></i>
                                <span class="m-nav__link-text">Ingresar a Facebook de SIARH</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a class="m-nav__link" href="https://www.sirh.gob.bo" target="_blank">
                                <i class="m-nav__link-icon flaticon-imac"></i>
                                <span class="m-nav__link-text">Ingresar a la página web de SIARH</span>
                            </a>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
        <!--end:: Widgets/Blog-->
    </div>

    <div class="col-xl-3">
    </div>


</div>