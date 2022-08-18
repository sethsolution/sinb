<div class="row">
    <div class="col-xl-2"></div>
    <div class="col-xl-8">
        <div class="card card-custom card-stretch gutter-b">
            <div class="card-body">
                <div class="d-flex justify-content-between flex-column h-250">
                    <div class="h-250">
                        <div class="d-flex flex-column flex-center">
                            <!--begin::Image-->
                            <div class="bgi-no-repeat bgi-size-cover rounded min-h-300px w-100"
                                 style="background-image: url('/images/principal/error_01.jpg');"></div>
                            <!--end::Image-->
                        </div>
                    </div>
                    <div class="d-flex flex-center mt-3">
                        <h3 class="text-danger font-weight-bold">ERROR !!!</h3>
                    </div>

                    <p class="text-dark-75 font-size-lg font-weight-normal pt-5 mb-2">
                        El dato con código
                        <span class="text-danger font-weight-bold">" {$id} "</span>
                        que quiere acceder  no existe, fue eliminado o no tiene permisos de acceso.
                        <br><br>
                        Para mayor información contáctese con el área de sistemas de la institución:
                        <span class="text-info">{$msg_core.soporte_numero}</span>
                        o escriba al correo <a href="mailto:{$msg_core.msg_core.soporte_whatsapp}">{$msg_core.soporte_email}</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-2"></div>
</div>