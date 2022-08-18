<!--begin::Subheader-->
<div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-2">

            {if $miga.appModuleData.folder != 'index'}
                <a href="/{$miga.appData.folder}" class="btn btn-light-facebook font-weight-bolder btn-sm mr-2">
                    <i class="la la-home"></i>{#gl_home#}</a>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-2 bg-gray-200"></div>
                <span class="text-muted font-weight-bold ">{if $miga.appModuleData.folder  != ''}{$miga.appGroupData.name}{else}{#sbmTitleMenu#}{/if}</span>
                {if $miga.appModuleData.folder  != ''}
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-2 ml-2 bg-gray-200"></div>
                    <span class="text-muted font-weight-bold ">
                {*<a href="/{$miga.modulo.carpeta}/{$miga.smodulo.carpeta}" class="m-nav__link"><span class="m-nav__link-text">*}
                        {$miga.appModuleData.name}
                        {*</a>*}
                    </span>
                {/if}
            {else}
                <!--begin::Page Title-->
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                    <i class="la la-home mr-2"></i>
                    {$module_conf.dashboard_titulo}
                </h5>
                <!--end::Page Title-->
            {/if}

            <!--begin::Actions-->
            <!--end::Actions-->
        </div>
        <!--end::Info-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <a href="{$path_url}" class="btn btn-primary d-none btn-sm" id="btn_back"><i class="ki ki-double-arrow-back"></i>{#glBtnBack#}</a>
            <a href="#"           class="btn btn-success d-none btn-sm" id="btn_new" rel="new"><i class="fa fa-plus"></i>{#btnNew#}</a>
        </div>
        <!--end::Toolbar-->

    </div>
</div>
<!--end::Subheader-->