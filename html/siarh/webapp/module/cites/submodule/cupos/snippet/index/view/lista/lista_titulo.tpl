<div class="m-portlet__head">

    <div class="m-portlet__head-tools" style="font-size: 15px">
        Control de la cantidad de partes y derivados exportados en función
        a las autorizaciones de aprovechamiento autorizadas y en caso correspondiente
        cupos asignados de acuerdo a la especie por usuario respectivo.

    </div>

    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
                {if $privFace.editar == 1 and $privFace.crear == 1}
                    <a href="#" class="btn btn-success m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_update" rel="new">
                        <span><i class="fa fa-plus"></i><span>Adicionar una nueva Gestión</span></span>
                    </a>

                {/if}
            </li>
        </ul>
    </div>
</div>