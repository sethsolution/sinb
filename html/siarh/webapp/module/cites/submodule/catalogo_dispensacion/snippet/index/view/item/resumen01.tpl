<div class="row m-row--no-padding" style="margin-bottom: 0px!important;">


    <div class="col-xl-8 m-row--no-padding" >
        <!--begin:: Widgets/Authors Profit-->
        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height  m-row--no-padding">

            <div class="m-widget4">

                <div class="m-widget4__item txt_info">
                    <div class="m-widget4__info">
                        <span class="m-widget4__title">{$item.nombres}</span><br>
                        <span class="m-widget4__sub">Nombres</span>
                    </div>
                    <span class="m-widget4__ext">&nbsp;</span>
                </div>
                <div class="m-widget4__item txt_info">
                    <div class="m-widget4__info">
                        <span class="m-widget4__title">{$item.apellido_paterno} {$item.apellido_materno}</span><br>
                        <span class="m-widget4__sub">Apellido</span>
                    </div>
                    <span class="m-widget4__ext">&nbsp;</span>
                </div>
                <div class="m-widget4__item txt_info">
                    <div class="m-widget4__info">
                        <span class="m-widget4__title">{$item.ci}</span><br>
                        <span class="m-widget4__sub">C.I.</span>
                    </div>
                    <span class="m-widget4__ext">&nbsp;</span>
                </div>
                <div class="m-widget4__item txt_info">
                    <div class="m-widget4__info">
                        <span class="m-widget4__title">{$item.ci_expedido}</span><br>
                        <span class="m-widget4__sub">Expedido en</span>
                    </div>
                    <span class="m-widget4__ext">&nbsp;</span>
                </div>
                <div class="m-widget4__item txt_info">
                    <div class="m-widget4__info">
                        <span class="m-widget4__title">{$item.fecha_nacimiento|date_format:"%A, %B %e, %Y"}</span><br>
                        <span class="m-widget4__sub">Fecha de Nacimiento</span>
                    </div>
                    <span class="m-widget4__ext">&nbsp;</span>
                </div>


            </div>




        </div>
    </div>



    <div  class="col-xl-4 m-row--no-padding">
        <div class="m-portlet m-portlet--bordered-semi m-portlet--full-height ">

            <div class="m-portlet__body222">
                <div class="m-widget4">
                    <div class="m-widget4__item txt_info">

                        <div class="m-widget4__info">
                            <span class="m-widget4__title">Edad</span><br>
                            <span class="m-widget4__sub">Años</span>
                        </div>
                        <span class="m-widget4__ext m--padding-right-10"><span class="m-widget4__number m--font-brand">{$item.edad}</span></span>
                    </div>

                    <div class="m-widget4__item txt_info">
                        <div class="m-widget4__info">
                            <span class="m-widget4__title">Hijos</span><br>
                        </div>
                        <span class="m-widget4__ext m--padding-right-10"><span class="m-widget4__number m--font-brand">{$item.hijos}</span></span>
                    </div>

                    <div class="m-widget4__item txt_info">
                        <div class="m-widget4__info">
                            <span class="m-widget4__title">{$item.nua}</span><br>
                            <span class="m-widget4__sub">AFP N# de NUA/CUA </span>
                        </div>
                        <span class="m-widget4__ext">&nbsp;</span>
                    </div>

                    <div class="m-widget4__item txt_info">
                        <div class="m-widget4__info">
                            <span class="m-widget4__title">{$item.numero_cuenta}</span><br>
                            <span class="m-widget4__sub">N# de Cuenta Bancaria </span>
                        </div>
                        <span class="m-widget4__ext">&nbsp;</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>