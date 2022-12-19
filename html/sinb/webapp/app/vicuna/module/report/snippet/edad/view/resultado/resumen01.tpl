<!--begin::Bottom-->
<div class="d-flex align-items-center flex-wrap">

        <!--begin: Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
        <span class="mr-4"><i class="fas fa-window-restore icon-2x text-muted font-weight-bold"></i></span>
        <div class="d-flex flex-column text-dark-75">
            <span class="font-weight-bolder font-size-sm">Total vicuñas crias</span>
            <span class="font-weight-bolder font-size-h5 text-info" >{$res.totalCrias|number_format:0:'.':','} <span class="text-dark-50 font-weight-bold"></span> </span>
        </div>
    </div>
    <!--end: Item-->
    <!--begin: Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
        <span class="mr-4"><i class="fas fa-window-restore icon-2x text-muted font-weight-bold"></i></span>
        <div class="d-flex flex-column text-dark-75">
            <span class="font-weight-bolder font-size-sm">Total vicuñas juveniles</span>
            <span class="font-weight-bolder font-size-h5 text-info" >{$res.totalJuvenil|number_format:0:'.':','} <span class="text-dark-50 font-weight-bold"></span> </span>
        </div>
    </div>
    <!--end: Item-->
    <!--begin: Item-->
    <div class="d-flex align-items-center flex-lg-fill mr-5 my-1">
        <span class="mr-4"><i class="fas fa-window-restore icon-2x text-muted font-weight-bold"></i></span>
        <div class="d-flex flex-column text-dark-75">
            <span class="font-weight-bolder font-size-sm">Total vicuñas adultos</span>
            <span class="font-weight-bolder font-size-h5 text-info" >{$res.totalAdulto|number_format:0:'.':','} <span class="text-dark-50 font-weight-bold"></span> </span>
        </div>
    </div>
    <!--end: Item-->
</div>
<!--end::Bottom-->