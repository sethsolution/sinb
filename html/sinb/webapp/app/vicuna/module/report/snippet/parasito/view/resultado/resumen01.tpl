<!--begin::Bottom-->
<div class="d-flex align-items-center flex-wrap">

        <!--begin: Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
        <span class="mr-4"><i class="fas fa-window-restore icon-2x text-muted font-weight-bold"></i></span>
        <div class="d-flex flex-column text-dark-75">
            <span class="font-weight-bolder font-size-sm">Total vicuñas con Garrapata</span>
            <span class="font-weight-bolder font-size-h5 text-info" >{$res.totalGarrapata|number_format:0:'.':','} <span class="text-dark-50 font-weight-bold"></span> </span>
        </div>
    </div>
    <!--end: Item-->
    <!--begin: Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
        <span class="mr-4"><i class="fas fa-window-restore icon-2x text-muted font-weight-bold"></i></span>
        <div class="d-flex flex-column text-dark-75">
            <span class="font-weight-bolder font-size-sm">Total vicuñas con Piojo</span>
            <span class="font-weight-bolder font-size-h5 text-info" >{$res.totalPiojo|number_format:0:'.':','} <span class="text-dark-50 font-weight-bold"></span> </span>
        </div>
    </div>
    <!--end: Item-->
    <!--begin: Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
        <span class="mr-4"><i class="fas fa-window-restore icon-2x text-muted font-weight-bold"></i></span>
        <div class="d-flex flex-column text-dark-75">
            <span class="font-weight-bolder font-size-sm">Total vicuñas con Sarna</span>
            <span class="font-weight-bolder font-size-h5 text-info" >{$res.totalSarna|number_format:0:'.':','} <span class="text-dark-50 font-weight-bold"></span> </span>
        </div>
    </div>
    <!--end: Item-->
</div>
<!--end::Bottom-->

<!--begin::Bottom-->
<div class="d-flex align-items-center flex-wrap">

    <!--begin: Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
        <span class="mr-4"><i class="fas fa-window-restore icon-2x text-muted font-weight-bold"></i></span>
        <div class="d-flex flex-column text-dark-75">
            <span class="font-weight-bolder font-size-sm">Total vicuñas con Caspa</span>
            <span class="font-weight-bolder font-size-h5 text-success" >{$res.totalCSi|number_format:0:'.':','} <span class="text-dark-50 font-weight-bold"></span> </span>
        </div>
    </div>
    <!--end: Item-->
    <!--begin: Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
        <span class="mr-4"><i class="fas fa-window-restore icon-2x text-muted font-weight-bold"></i></span>
        <div class="d-flex flex-column text-dark-75">
            <span class="font-weight-bolder font-size-sm">Total vicuñas sin Caspa</span>
            <span class="font-weight-bolder font-size-h5 text-success" >{$res.totalCNo|number_format:0:'.':','} <span class="text-dark-50 font-weight-bold"></span> </span>
        </div>
    </div>
    <!--end: Item-->
</div>
<!--end::Bottom-->