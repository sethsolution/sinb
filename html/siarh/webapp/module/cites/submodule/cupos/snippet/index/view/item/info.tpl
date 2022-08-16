<div class="modal fade" id="form_modal_ver" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="false"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" id="modal-content_ver">

        </div>
    </div>
</div>
<div class="m-card-profile">
    <div class="m-card-profile__details" id="div_perfil">
        <span class="m-widget1__item ">{*{$item.programa_sigla}*}
            Fecha y hora de solicitud:&nbsp;&nbsp;<br> {$item.dateCreate|date_format:"%d/%m/%Y %H:%M:%S"}
        </span>
    </div>
</div>



<div class="m-widget1 m--padding-5">
    <div class="m-widget1__item resumen_global" >
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">Total Cupos </h3>
                <span class="m-widget1__desc">Total Cupos Configurados</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-info" id="cupo_total">0</span>
            </div>
        </div>
    </div>

    {*
    <div class="m-widget1__item resumen_global">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">Total certificados</h3>
                <span class="m-widget1__desc">Número de Certificados que necesitará</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-danger" id="resumen_certificados">0</span>
            </div>
        </div>
    </div>

    <div class="m-widget1__item resumen_global">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h4 class="m-widget1__title ">Total a Depositar</h4>
                <span class="m-widget1__desc">El mónto que tiene que depositar</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-success" id="resumen_depositar">0</span>
            </div>
        </div>
    </div>

    <div class="m-widget1__item resumen_global">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">Deposito registrado</h3>
                <span class="m-widget1__desc">Depositos registrados</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-brand" id="resumen_depositos">0</span>
            </div>
        </div>
    </div>

*}

    <div class="m-widget1__item"></div>

</div>