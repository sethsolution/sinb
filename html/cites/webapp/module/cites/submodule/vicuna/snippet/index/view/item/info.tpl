
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
            {$item.vicuna_tipo}
        </div>
    </div>
</div>
    <div class="m-widget1__item"></div>

</div>