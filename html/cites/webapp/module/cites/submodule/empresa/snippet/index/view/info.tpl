
<div class="m-card-profile">
    <div class="cuadro-estado m--padding-10 m--margin-bottom-10" >
        <div class="text-center">{$item.estado}</div>
    </div>

    <div class="m-card-profile__details" id="div_perfil">
        <span class="m-widget1__item ">
            Fecha y hora de registro:&nbsp;&nbsp;<br>{$item.dateCreate|date_format:"%d/%m/%Y %H:%M:%S"}
        </span>
    </div>

    <div class="cuadro-verde m--padding-10 m--margin-bottom-10" >
        <div class="titulo m--margin-bottom-5 m--padding-left-5 m--font-bold">Tipo Empresa</div>
        <div >
            {$item.empresa_tipo}
            <br><br>
            {if $item.tipo_id != 8 and $item.tipo_id != 10 and $item.tipo_id != 12}
                <span style="color:green;">
                   Pago por registro anual: <strong>150 Bs.</strong>
                </span>
            {/if}
        </div>
    </div>
</div>


{*
<div class="m-widget1 m--padding-5">
    <div class="m-widget1__item resumen_global" >
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">Total especies </h3>
                <span class="m-widget1__desc">Total de especies registradas</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-info" id="resumen_especies">0</span>
            </div>
        </div>
    </div>

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

    <div class="m-widget1__item"></div>

</div>
*}