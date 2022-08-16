
<div class="m-card-profile">
    <div class="cuadro-estado m--padding-10 m--margin-bottom-10" >
        <div class="titulo-estado text-center">{$item.estado}</div>
    </div>

    <div class="m-card-profile__details" id="div_perfil">
        <span class="m-widget1__item ">

            {$item.programa_sigla}Fecha de creación: {$item.dateCreate|date_format:"%d/%m/%Y %H:%M:%S"}

        </span>
    </div>
    <div class="cuadro-verde m--padding-10 m--margin-bottom-10" >
        <div class="titulo m--margin-bottom-5 m--padding-left-5 m--font-bold">Tipo de Usuario:</div>
        <div >
            {$item.precinto_tipo}
        </div>
    </div>
</div>


<div class="m-widget1 m--padding-5">
    <div class="m-widget1__item resumen_global" >
        <div class="row m-row--no-padding align-items-center">
            <div class="col">
                <h3 class="m-widget1__title">Total Precintos Aprobados </h3>
                <span class="m-widget1__desc">Precintos no utilizados de todas las cosechas</span>
            </div>
            <div class="col m--align-right">
                <span class="m-widget1__number m--font-info" id="resumen_precintos">0</span>
            </div>
        </div>
    </div>

    <div class="m-widget1__item"></div>

</div>