{include file="formprincipal/index.css.tpl"}
<div class="card card-custom gutter-b ">
    <!--begin::Form-->
    <form method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}save.principal/"
          id="general_form">

        <div class="card-header py-3">
            <div class="card-title  m-0">
                <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
                <span class="font-weight-bold font-size-h4 text-primary">{#title_datos#}</span>
            </div>
        </div>

        <div class="card-body py-0">
            <div class="form-group">
                <div id="map" style="height:400px;"></div>
            </div>
            <div class="form-group row">


                <div class="col-lg-6">
                    <label>{#fiel_location_latitude_decimal#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               name="item[location_latitude_decimal]"
                               id="location_latitude_decimal"
                               required
                               value="{$item.location_latitude_decimal|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i
                                        class="fa fa-map-marker-alt text-danger"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_location_latitude_decimal#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#fiel_location_longitude_decimal#}  <span class="text-danger bold">*</span> :</label>
                    <div class="input-group">
                        <input type="text" class="form-control"
                               id="location_longitude_decimal"
                               required
                               name="item[location_longitude_decimal]"
                               value="{$item.location_longitude_decimal|escape:"html"}"
                               data-fv-not-empty___message="{#glFieldRequired#}"
                        >
                        <div class="input-group-append"><span class="input-group-text"><i
                                        class="fa fa-map-marker-alt text-danger"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_location_longitude_decimal#}</span>
                </div>
            </div>
        </div>


        <div class="card-footer">
            {if $privFace.edit == 1}
                <button type="reset" class="btn btn-primary mr-2" id="general_submit">
                    <i class="la la-save"></i>
                    {#glBtnSaveChanges#}</button>
            {/if}
            {*
            <a href="{$path_url}" class="btn btn-light-primary ">
                <i class="la la-angle-double-left"></i>{if $type =="new"} {#glBtnCancel#} {else} {#glBtnBackToList#}{/if}
            </a>
*}
        </div>
    </form>
    <!--end::Form-->
</div>

{include file="formprincipal/index.js.tpl"}