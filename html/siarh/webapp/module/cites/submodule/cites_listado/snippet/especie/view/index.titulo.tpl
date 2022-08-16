<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        Adicione la(s) especie(s) y sus características, que va a movilizar en su solicitud, una por una.
    </div>
    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
                {if $privFace.editar == 1 and $privFace.crear == 1}
                    <a href="#" class="btn btn-focus m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_form_{$subcontrol}" rel="new">
                    <span><i class="fa fa-plus"></i><span>Ingrese los datos de la(s) especie(s)</span></span>
                </a>
                {/if}
            </li>
        </ul>
    </div>
</div>