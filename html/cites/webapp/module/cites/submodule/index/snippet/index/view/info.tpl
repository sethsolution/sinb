
<div class="m-card-profile">
    <div class="cuadro-estado m--padding-10 m--margin-bottom-10" >
        <div class="titulo-estado text-center">{$item.estado}</div>
    </div>

    <div class="m-card-profile__details" id="div_perfil">
        <span class="m-widget1__item ">
              Fecha y hora de registro:&nbsp;&nbsp;<br>{$item.dateCreate|date_format:"%d/%m/%Y %H:%M:%S"}
        </span>
    </div>

    <div class="cuadro-verde m--padding-10 m--margin-bottom-10" >
        <div class="titulo m--margin-bottom-5 m--padding-left-5 m--font-bold">Tipo Empresa:</div>
        <div >
            {$item.empresa_tipo}
            <br><br>
            {if $item.tipo_id != 10 and $item.tipo_id != 12}
                <span style="color:green;">
                  Pago por registro anual: <strong>150 Bs.</strong>
                </span>
            {/if}

        </div>
    </div>
</div>
<div class="m-section m--padding-bottom-5 m--margin-bottom-5">
    <h2 class="m-section__heading titulo">Datos del Usuario</h2>
    <div class="m-section__content">
        <p>
            <strong>Nombre:</strong><br>
            {$item.nombre}
        </p>

        <p>
            {if $item.representante_legal_nombre != ""}
            <strong>Representante Legal:</strong><br>
            {$item.representante_legal_nombre}
            {$item.representante_legal_paterno}
            {$item.representante_legal_materno}
            <br>
            {/if}
        </p>
        {*
        <p>
            <strong>Convenio Código:</strong><br> {$item.convenio_codigo}<br>
            <strong>Convenio Nombre:</strong><br> {$item.convenio_nombre}<br>
            <strong>Convenio Fecha de Registro:</strong><br> {$item.convenio_fecha_firma}<br>
        </p>
        *}
    </div>
</div>

{if $item.tipo_id != 10 and $item.tipo_id != 12}
<div class="m-widget1 m--padding-5">
    <div class="m-widget1__item resumen_global" >
        <div class="row m-row--no-padding align-items-center">
            <div class="col-lg-8">
                <h3 class="m-widget1__title">Nro. de solicitudes CITES </h3>
                <span class="m-widget1__desc"></span>
            </div>
            <div class="col-lg-4 m--align-right">
                <span class="m-widget1__number m--font-info" id="resumen_especies">{$item.total_cites}</span>
            </div>
        </div>
    </div>

    <div class="m-widget1__item resumen_global">
        <div class="row m-row--no-padding align-items-center">
            <div class="col-lg-8">
                <h3 class="m-widget1__title">Nro. de solicitudes de Dispensación</h3>
                <span class="m-widget1__desc"></span>
            </div>
            <div class="col-lg-4 m--align-right">
                <span class="m-widget1__number m--font-danger" id="resumen_certificados">{$item.total_dispensacion}</span>
            </div>
        </div>
    </div>
    {/if}
{*
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
*}
</div>
