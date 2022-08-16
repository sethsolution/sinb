
<div class="m-card-profile">
    <div class="cuadro-estado m--padding-10 m--margin-bottom-10" >
        <div class="titulo-estado text-center">{$item.estado}</div>
    </div>

    <div class="m-card-profile__details" id="div_perfil">
        <span class="m-widget1__item ">{$item.programa_sigla}Fecha de creación: {$item.dateCreate}</span>
    </div>

    <div class="cuadro-verde m--padding-10 m--margin-bottom-10" >
        <div class="titulo m--margin-bottom-5 m--padding-left-5 m--font-bold">Tipo de Cites:</div>
        <div >
            {$item.cites_tipo}
            <br><br>
            {if $item.monto != 0}
                <span style="color:green;">
                    Costo por Certificado:<strong>{$item.monto} Bs.</strong>
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
                {*
                <span class="m-widget1__desc">Monto programado en General</span>
                *}
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-info" id="resumen_programado">0</span>
            </div>
        </div>
    </div>

    <div class="m-widget1__item resumen_global">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">Total certificados</h3>
                {*
                <span class="m-widget1__desc">Suma de todos los componentes</span>
                *}
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-danger" id="resumen_componente">0</span>
            </div>
        </div>
    </div>

    <div class="m-widget1__item resumen_global">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">Total Depositado</h3>
                {*
                <span class="m-widget1__desc">Suma de todos los desembolsos</span>
                *}
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-success" id="resumen_desembolsado">0</span>
            </div>
        </div>
    </div>


    <div class="m-widget1__item resumen_global">
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h4 class="m-widget1__title ">Total a Depositar</h4>
                {*
                <span class="m-widget1__desc">Suma de todos los desembolsos</span>
                *}
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-brand" id="resumen_saldo">0</span>
            </div>
        </div>
    </div>
    <div class="m-widget1__item"></div>

</div>