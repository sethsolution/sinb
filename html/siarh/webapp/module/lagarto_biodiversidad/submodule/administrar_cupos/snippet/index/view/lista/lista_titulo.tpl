<div class="m-portlet__head">

    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
            </li>
        </ul>
    </div>

    <div class="m-portlet__head-tools">
        <ul class="m-portlet__nav">
            {if $rol_itemId=="1" and $gestionVer}
            <li class="m-portlet__nav-item">
                <a href="#" class="btn btn-success m-btn m-btn--custom m-btn--bolder m-btn--icon" id="btn_update" rel="new">
						<span><i class="fa fa-plus"></i><span>Nuevo registro</span></span>
                </a>
            </li>
            {/if}
            {include file="$modulo_frontend_titulo_ayuda"}
        </ul>
    </div>
</div>