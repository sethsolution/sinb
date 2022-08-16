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
    <div class="cuadro-estado m--padding-10 m--margin-bottom-10" >
        <div class="titulo-estado text-center">{$item.estado}</div>
    </div>

    <div class="m-card-profile__details" id="div_perfil">
        <span class="m-widget1__item ">{*{$item.programa_sigla}*}
            Fecha y hora de solicitud:&nbsp;&nbsp;<br> {$item.dateCreate|date_format:"%d/%m/%Y %H:%M:%S"}
        </span>
    </div>

    <div class="cuadro-verde m--padding-10 m--margin-bottom-10" >
        <div class="titulo m--margin-bottom-5 m--padding-left-5 m--font-bold">Tipo de Usuario:</div>
        <div >
            {$item.vicuna_tipo}
        </div>
    </div>

    <div class="m-section m--padding-bottom-5 m--margin-bottom-5 m--hide" id="obs_cuadro">
        <div class="m-widget1 cuadro-obs m--padding-10 m--margin-bottom-10">
            <div class="titulo-obs text-center">Estado de Observaciones</div>

            <div class="m-widget1__item resumen_global" >
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <span class="m-widget1__item">Observación en Formulario:</span>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-info" id="obs_form2">0</span>
                    </div>
                </div>
            </div>

            <div class="m-widget1__item resumen_global" >
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <span class="m-widget1__item">Observación de Requisitos:</span>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-info" id="obs_requisitos">0</span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
    <div class="m-widget1__item"></div>

</div>