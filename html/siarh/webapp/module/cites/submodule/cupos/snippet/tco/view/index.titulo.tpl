<div class="m-portlet__head">
    <div class="m-portlet__head-caption">
        <div class="m-portlet__head-title">
            <h4 class="m--font-primary">TCO / PREDIO</h4>
        </div>
    </div>

    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
                {if $privFace.editar == 1 and $privFace.crear == 1}
                <a href="#" class="btn btn-success m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_form_{$subcontrol}" rel="new">
                    <span><i class="fa fa-plus"></i><span>Añadir TCO / PREDIO</span></span>
                </a>
                {/if}
            </li>
        </ul>
    </div>


</div>