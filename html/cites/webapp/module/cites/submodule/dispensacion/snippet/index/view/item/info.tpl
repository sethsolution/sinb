<div class="modal fade" id="form_modal_ver" tabindex="-1" role="dialog"
     data-backdrop="static"
     data-keyboard="false"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" id="modal-content_ver">

        </div>
    </div>
</div>
<div class="m-card-profile">

    {if $item.sustitucion_dispensacion}
        <div class="cuadro-estado m--padding-5 m--margin-bottom-5" >
            <div class="titulo-estado text-center tipo-sustituido">SUSTITUCIÓN</div>
        </div>

        <div class="cuadro-padre m--padding-5 m--margin-bottom-5" >
            <div class=" text-center tipo-padre"><a href="/cites/dispensacion/{$item.dispensacion_id}" target="_blank">IR AL CERTIFICADO ORIGINAL</a></div>
        </div>
    {/if}


    <div class="cuadro-estado m--padding-10 m--margin-bottom-10" >
        <div class="titulo-estado text-center">{$item.estado}</div>
    </div>

    <div class="m-card-profile__details" id="div_perfil">
        <span class="m-widget1__item ">
            Fecha y hora de solicitud&nbsp;&nbsp;<br>{$item.dateCreate|date_format:"%d/%m/%Y %H:%M:%S"}
        </span>
    </div>

    <div class="cuadro-verde m--padding-10 m--margin-bottom-10" >
        <div class="titulo2 m--margin-bottom-5 m--padding-left-5 m--font-bold">Tipo de solicitud:</div>
        <div >
            {$item.dispensacion_tipo}
            {if $item.monto != 0 and $item.sustitucio_dispensacion == 0}
            <br><br>

                <span style="color:green;">
                    Costo por Certificado:&nbsp;&nbsp;<strong>{$item.monto} Bs.</strong>
                </span>
            {/if}
            {if $item.monto_sustitucion != 0 and $item.sustitucion_dispensacion == 1}
                <br>
                <br>
                <div class="titulo2 m--margin-bottom-5 m--padding-left-5 m--font-bold">Tipo de Sustitución:</div>
                {$item.sustitucion_tipo}
                <br><br>
                <span style="color:green;">
                    Costo Sustitución:&nbsp;&nbsp;<strong>{$item.monto_sustitucion} Bs.</strong>
                </span>
            {/if}

        </div>
    </div>
</div>


<div class="m-widget1 m--padding-5">
    <div class="m-widget1__item resumen_global" >
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h4 class="m-widget1__title">Total especies </h4>
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
                <h4 class="m-widget1__title">Total certificados</h4>
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
                <h4 class="m-widget1__title">Depósito registrado</h4>
                <span class="m-widget1__desc">Depósitos registrados</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-brand" id="resumen_depositos">0</span>
            </div>
        </div>
    </div>
    <div class="m-widget1__item"></div>
</div>