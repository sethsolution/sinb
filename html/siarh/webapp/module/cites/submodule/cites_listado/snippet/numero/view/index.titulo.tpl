<div class="m-portlet__head">

    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
                {if $privFace.editar == 1 and $privFace.crear == 1}
                    <a href="#" class="btn btn-success m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_form_{$subcontrol}" rel="new">
                        <span><i class="fa fa-plus"></i><span>Asignar un Número al CITES</span></span>
                    </a>
                {/if}
        </ul>
    </div>
    <div class="m-portlet__head-caption"></div>
</div>