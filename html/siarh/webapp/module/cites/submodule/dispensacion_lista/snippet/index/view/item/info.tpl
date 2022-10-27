
<div class="m-card-profile">
    <div class="cuadro-estado m--padding-10 m--margin-bottom-10" >
        <div class="titulo-estado text-center">{$item.estado}</div>
    </div>
    <div class="m-card-profile__details" id="div_perfil">
        <span class="m-widget1__item ">{*{$item.programa_sigla}*}
            Fecha y hora de solicitud:&nbsp;&nbsp;<br> {$item.dateCreate|date_format:"%d/%m/%Y %H:%M:%S"}

        </span>
    </div>


    <div class="m-section m--padding-bottom-5 m--margin-bottom-5 m--hide" id="obs_cuadro">
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
                        <span class="m-widget1__item">Observación Especies</span>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-info" id="obs_especies">0</span>
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

    <div class="cuadro-verde m--padding-10 m--margin-bottom-10" >
        <div class="titulo m--margin-bottom-5 m--padding-left-5 m--font-bold">Tipo de Solicitud:</div>
        <div >
            {$item.dispensacion_tipo}
            <br><br>
            {if $item.monto != 0}
                <span style="color:green;">
                    Costo por Certificado:&nbsp;&nbsp;<strong>{$item.monto} Bs.</strong>
                </span>
            {/if}
        </div>
    </div>




</div>



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
                <span class="m-widget1__desc">El monto que tiene que depositar</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-success" id="resumen_depositar">0</span>
            </div>
        </div>
    </div>

    <div class="m-widget1__item resumen_global">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">Depósito registrado</h3>
                <span class="m-widget1__desc">Depósitos registrados</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-brand" id="resumen_depositos">0</span>
            </div>
        </div>
    </div>



    <div class="m-widget1__item"></div>

</div>