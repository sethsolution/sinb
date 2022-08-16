
<div class="m-card-profile">
    <div class="cuadro-estado m--padding-10 m--margin-bottom-10" >
        <div class="titulo-estado text-center">{$item.estado}</div>
    </div>

</div>


<div class="m-section m--padding-bottom-5 m--margin-bottom-5" id="obs_cuadro">
    <div class="m-widget1 cuadro-obs m--padding-10 m--margin-bottom-10">
        <div class="titulo-obs text-center">Estado de Observaciones</div>

        <div class="m-widget1__item resumen_global" >
            <div class="row m-row--no-padding align-items-center">
                <div class="col">
                    <span class="m-widget1__item">Observación en General </span>
                </div>
                <div class="col m--align-right">
                    <span class="m-widget1__number m--font-info" id="obs_general">0</span>
                </div>
            </div>
        </div>

        <div class="m-widget1__item resumen_global" >
            <div class="row m-row--no-padding align-items-center">
                <div class="col">
                    <span class="m-widget1__item">Observación Formulario Adicional</span>
                </div>
                <div class="col m--align-right">
                    <span class="m-widget1__number m--font-info" id="obs_form2">0</span>
                </div>
            </div>
        </div>

        <div class="m-widget1__item resumen_global" >
            <div class="row m-row--no-padding align-items-center">
                <div class="col">
                    <span class="m-widget1__item">Requisitos Observados</span>
                </div>
                <div class="col m--align-right">
                    <span class="m-widget1__number m--font-info" id="obs_requisitos">0</span>
                </div>
            </div>
        </div>
        <div class="m-widget1__item resumen_global" >
            <div class="row m-row--no-padding align-items-center">
                <div class="col">
                    <span class="m-widget1__item">Depósitos Observados</span>
                </div>
                <div class="col m--align-right">
                    <span class="m-widget1__number m--font-info" id="obs_pagos">0</span>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="m-card-profile">
    <div class="m-card-profile__details" id="div_perfil">
        <span class="m-widget1__item ">Fecha de creación: {$item.dateCreate}</span>
    </div>

    <div class="cuadro-verde m--padding-10 m--margin-bottom-10" >
        <div class="titulo m--margin-bottom-5 m--padding-left-5 m--font-bold">Tipo Empresa:</div>
        <div >
            {$item.empresa_tipo}
            <br><br>

            <span style="color:green;">
                   Pago Anual: <strong>150 Bs.</strong>
                </span>
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


<div class="m-section">
    <h2 class="m-section__heading titulo-info">Datos del Usuario</h2>
    <div class="m-section__content">
        <p>
            <strong>Nombre:</strong><br>{$item.nombre}<br>
            {if $item.telefono !=""}<strong>Teléfono:</strong> {$item.telefono}<br>{/if}
            {if $item.email !=""}<strong>Email:</strong> {$item.email}<br>{/if}
            {if $item.direccion !=""}<strong>Dirección:</strong><br>{$item.direccion}<br>{/if}
            {if $item.nit !=""}<strong>NIT:</strong> {$item.nit}<br>{/if}
            {if $item.ruex !=""}<strong>RUEX:</strong> {$item.ruex}<br>{/if}
            {if $item.ciudad !=""}<strong>Ciudad:</strong> {$item.ciudad}<br>{/if}
            {if $item.universidad_asociada !=""}<strong>Universidad Asociada:</strong><br>{$item.universidad_asociada}<br>{/if}
        </p>
    </div>

    {if $item.representante_legal_nombre !=""}
    <h2 class="m-section__heading titulo-info">Representante Legal</h2>
    <div class="m-section__content">
        <p>
            {if $item.representante_legal_nombre !=""}<strong>Nombre:</strong> {$item.representante_legal_nombre}<br>{/if}
            {if $item.representante_legal_paterno !=""}<strong>Apellido Paterno:</strong> {$item.representante_legal_paterno}<br>{/if}
            {if $item.representante_legal_materno !=""}<strong>Apellido Materno:</strong> {$item.representante_legal_materno}<br>{/if}
            {if $item.representante_legal_telefono !=""}<strong>Teléfono:</strong> {$item.representante_legal_telefono}<br>{/if}
            {if $item.representante_legal_ci !=""}<strong>CI:</strong> {$item.representante_legal_ci}<br>{/if}
        </p>
    </div>
    {/if}

</div>