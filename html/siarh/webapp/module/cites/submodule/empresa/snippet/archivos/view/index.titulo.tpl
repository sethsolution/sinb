<div class="m-portlet__head">
    <div class="m-portlet__head-caption">

    </div>
    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
                {if $privFace.editar == 1 and $privFace.crear == 1}
                <a href="#" class="btn btn-focus m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_form_{$subcontrol}" rel="new">
                    <span><i class="fa fa-plus"></i><span>Nuevo Archivo</span></span>
                </a>
                {/if}
            </li>
            <li class="m-portlet__nav-item"></li>
        </ul>
    </div>
</div>