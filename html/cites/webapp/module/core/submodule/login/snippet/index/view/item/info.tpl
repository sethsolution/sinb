<!--begin::Portlet-->
<div class="m-portlet  m-portlet--bordered-semi " style="margin-bottom: 0px !important;">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
						<span class="m-portlet__head-icon">
							<i class="la la-thumb-tack m--font-success"></i>
						</span>
                <h3 class="m-portlet__head-text">
                    IP Pública: &nbsp; <strong><span class="m--font-success">{$item.ip}</span></strong>
                </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <ul class="m-portlet__nav">

                {*
                <li class="m-portlet__nav-item">
                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" m-dropdown-toggle="hover" aria-expanded="true">
                        <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                            <i class="flaticon-interface-2"></i>
                        </a>
                        <div class="m-dropdown__wrapper">
                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__content">
                                        <ul class="m-nav">
                                            <li class="m-nav__section m-nav__section--first">
                                                <span class="m-nav__section-text">Reporte</span>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link reporte_descarga">
                                                    <i class="m-nav__link-icon flaticon-logout"></i>
                                                    <span class="m-nav__link-text">PDF</span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link reporte_descarga">
                                                    <i class="m-nav__link-icon fa flaticon-graphic-2"></i>
                                                    <span class="m-nav__link-text">Excel</span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link reporte_descarga">
                                                    <i class="m-nav__link-icon flaticon-interface-1"></i>
                                                    <span class="m-nav__link-text">RTF / Documento</span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="#" class="m-nav__link reporte_descarga">
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
                *}

                <li class="m-portlet__nav-item">
                    <a href="index.php?module={$miga.modulo.carpeta}&smodule={$miga.smodulo.carpeta}" class="btn btn-success m-btn m-btn--icon m-btn--icon-only m-btn--custom m-btn--pill" title="Atras">
                        <i class="la la-mail-reply"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    {*
    <div class="m-portlet__body m--padding-bottom-5" >
        <strong>ID: <span class="m--font-success">{$item.itemId}</span></strong>
    </div>
*}
</div>
<!--end::Portlet-->
