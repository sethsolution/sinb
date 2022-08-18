<div class="m-portlet__head">

    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">

                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-left m-dropdown--align-push"
                     m-dropdown-toggle="hover" aria-expanded="true">
                    <a href="#" class="m-portlet__nav-link btn btn-success                m-btn m-btn--icon m-btn--icon-only m-btn--bolder m-dropdown__toggle">
                        <i class="flaticon-interface-2"></i>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav">
                                        <li class="m-nav__section m-nav__section--first">
                                            <span class="m-nav__section-text">Reporte</span>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{$getModule}&accion=reporte&tipo=pdf" class="m-nav__link reporte_descarga">
                                                <i class="m-nav__link-icon flaticon-logout"></i>
                                                <span class="m-nav__link-text">PDF</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{$getModule}&accion=reporte&tipo=excel" class="m-nav__link reporte_descarga">
                                                <i class="m-nav__link-icon fa flaticon-graphic-2"></i>
                                                <span class="m-nav__link-text">Excel</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{$getModule}&accion=reporte&tipo=rtf" class="m-nav__link reporte_descarga">
                                                <i class="m-nav__link-icon flaticon-interface-1"></i>
                                                <span class="m-nav__link-text">RTF / Documento</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{$getModule}&accion=reporte&tipo=text" class="m-nav__link reporte_descarga">
                                                <i class="m-nav__link-icon flaticon-menu-1"></i>
                                                <span class="m-nav__link-text">Texto</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>

    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
                <a href="#" class="btn btn-success m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_update" rel="new">
						<span><i class="fa fa-plus"></i><span>Nuevo registro</span></span>
                </a>
            </li>

        </ul>
    </div>
</div>