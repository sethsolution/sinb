{include file="index.css.tpl"}
<div class="card card-custom gutter-b example example-compact">
    <div class="card-body pt-0 pb-0 pl-5 pr-5">
        <div class="alert alert-custom fade show pt-1 pb-1 pl-5 pr-5 ayuda" role="alert">
            <div class="alert-icon"><i class="flaticon-notes"></i></div>
            <div class="alert-text text-justify text-dark-65" >{#message#}</div>
        </div>
    </div>

    <div class="card-header py-3">
        <div class="card-title">
            <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
            <span class="font-weight-bold font-size-h4 text-primary">{#title#}</span>
        </div>
    </div>
    <!--begin::Form-->
    <form method="POST"
          action="{$path_url}/{$subcontrol}_/{if $type=="update"}{$id}/{/if}save/"
          id="general_form">

        <div class="card-body  pt-1 pb-0">
            <div class="form-group row">
                <div class="col-lg-4">
                    <label>{#field_numero_vicuna_sitio_captura#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[numero_vicuna_sitio_captura]" value="{$item.numero_vicuna_sitio_captura|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-centercode"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_numero_vicuna_sitio_captura#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_numero_vicuna_capturadas#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[numero_vicuna_capturadas]" value="{$item.numero_vicuna_capturadas|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-centercode"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_numero_vicuna_capturadas#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_tasa_captura#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_decimal"
                               name="item[tasa_captura]" value="{$item.tasa_captura|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-percent"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_tasa_captura#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_numero_vicuna_esquiladas#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[numero_vicuna_esquiladas]" value="{$item.numero_vicuna_esquiladas|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-centercode"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_numero_vicuna_esquiladas#}</span>
                </div>

                <div class="col-lg-4">
                    <label>{#field_tasa_esquila#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_decimal"
                               name="item[tasa_esquila]" value="{$item.tasa_esquila|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-percent"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_tasa_esquila#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_numero_vicuna_muertas_accidente#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[numero_vicuna_muertas_accidente]" value="{$item.numero_vicuna_muertas_accidente|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-centercode"></i></span></div>
                    </div>
                    <span class="form-text text-muted">{#field_msg_numero_vicuna_muertas_accidente#}</span>
                </div>
            </div>
        </div>

        <div class="card-header py-3">
            <div class="card-title  m-0">
                <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
                <span class="font-weight-bold font-size-h4 text-primary">{#title2#}</span>
            </div>
        </div>
        <div class="card-body  pt-1 pb-2 proyecto" >
            <div class="form-group row  pt-0 pb-0 mb-0">
                <div class="col-lg-4">
                    <label>{#field_captura_machos#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[captura_machos]" value="{$item.captura_machos|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-sticker-mule"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_captura_machos#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_captura_hembras#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[captura_hembras]" value="{$item.captura_hembras|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-sticker-mule"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_captura_hembras#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_prueba_a#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[prueba_a]" value="{$item.prueba_a|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-searchengin"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_prueba_a#}</span>
                </div>
            </div>
        </div>

        <div class="card-header py-3">
            <div class="card-title  m-0">
                <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
                <span class="font-weight-bold font-size-h4 text-primary">{#title_vicunas_edad#}</span>
            </div>
        </div>

        <div class="card-body  pt-1 pb-0">
            <div class="form-group row pt-0 pb-0 mb-0">
                <div class="col-lg-3">
                    <label>{#field_cria#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[edad_cria]" value="{$item.edad_cria|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-sticker-mule"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_cria#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_juvenil#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[edad_juvenil]" value="{$item.edad_juvenil|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-sticker-mule"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_juvenil#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_adulto#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[edad_adulto]" value="{$item.edad_adulto|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-sticker-mule"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_adulto#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_prueba_b#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[edad_prueba_b]" value="{$item.edad_prueba_b|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-searchengin"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_prueba_b#}</span>
                </div>
            </div>
        </div>

        <div class="card-header py-3">
            <div class="card-title  m-0">
                <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
                <span class="font-weight-bold font-size-h4 text-primary">{#title_vicunas_condicion_corporal#}</span>
            </div>
        </div>


        <div class="card-body  pt-1 pb-0">
            <div class="form-group row pt-0 pb-0 mb-0">
                <div class="col-lg-4">
                    <label>{#field_condicion_corporal_malo#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[condicion_corporal_malo]" value="{$item.condicion_corporal_malo|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-plus-circle"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_condicion_corporal_malo#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_condicion_corporal_regular#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[condicion_corporal_regular]" value="{$item.condicion_corporal_regular|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-plus-circle"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_condicion_corporal_regular#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_condicion_corporal_bueno#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[condicion_corporal_bueno]" value="{$item.condicion_corporal_bueno|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-plus-circle"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_condicion_corporal_bueno#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_gestacion_si#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[gestacion_si]" value="{$item.gestacion_si|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="far fa-hospital"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_gestacion_si#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_gestacion_si_ultimo_tercio#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[gestacion_si_ultimo_tercio]" value="{$item.gestacion_si_ultimo_tercio|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="far fa-hospital"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_gestacion_si_ultimo_tercio#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_gestacion_no#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[gestacion_no]" value="{$item.gestacion_no|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="far fa-hospital"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_gestacion_no#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_gestacion_prueba_2#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[gestacion_prueba_2]" value="{$item.gestacion_prueba_2|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-searchengin"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_gestacion_prueba_2#}</span>
                </div>
            </div>
        </div>

        <div class="card-header py-3">
            <div class="card-title  m-0">
                <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
                <span class="font-weight-bold font-size-h4 text-primary">{#title_vicunas_parasitos_externos#}</span>
            </div>
        </div>

        <div class="card-body  pt-1 pb-0">
            <div class="form-group row pt-0 pb-0 mb-0">
                <div class="col-lg-4">
                    <label>{#field_parasito_externo_garrapata#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[parasito_externo_garrapata]" value="{$item.parasito_externo_garrapata|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-hubspot"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_parasito_externo_garrapata#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_parasito_externo_piojo#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[parasito_externo_piojo]" value="{$item.parasito_externo_piojo|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-hubspot"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_parasito_externo_piojo#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_parasito_externo_sarna#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[parasito_externo_sarna]" value="{$item.parasito_externo_sarna|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-hubspot"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_parasito_externo_sarna#}</span>
                </div>
                <!--Severidad de sarna-->
                <div class="col-lg-4">
                    <label>{#field_severidad_sarna_leve#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[severidad_sarna_leve]" value="{$item.severidad_sarna_leve|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-level-up-alt"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_severidad_sarna_leve#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_severidad_sarna_moderado#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[severidad_sarna_moderado]" value="{$item.severidad_sarna_moderado|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-level-up-alt"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_severidad_sarna_moderado#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_severidad_sarna_severo#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[severidad_sarna_severo]" value="{$item.severidad_sarna_severo|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-level-up-alt"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_severidad_sarna_severo#}</span>
                </div>
                <!--Caspa-->
                <div class="col-lg-6">
                    <label>{#field_caspa_si#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[caspa_si]" value="{$item.caspa_si|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-plus"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_caspa_si#}</span>
                </div>
                <div class="col-lg-6">
                    <label>{#field_caspa_no#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[caspa_no]" value="{$item.caspa_no|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-minus"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_caspa_no#}</span>
                </div>
            </div>
        </div>

        <div class="card-header py-3">
            <div class="card-title  m-0">
                <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
                <span class="font-weight-bold font-size-h4 text-primary">{#title_vicunas_fibra_obtenida#}</span>
            </div>
        </div>

        <div class="card-body  pt-1 pb-0">
            <div class="form-group row pt-0 pb-0 mb-0">
                <div class="col-lg-3">
                    <label>{#field_tecnica_esquila_tijera_manual#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[tecnica_esquila_tijera_manual]" value="{$item.tecnica_esquila_tijera_manual|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-cut"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_tecnica_esquila_tijera_manual#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_tecnica_esquila_maquina_electrica#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[tecnica_esquila_maquina_electrica]" value="{$item.tecnica_esquila_maquina_electrica|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-truck-loading"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_tecnica_esquila_maquina_electrica#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_tecnica_esquila_prueba_1#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[tecnica_esquila_prueba_1]" value="{$item.tecnica_esquila_prueba_1|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fab fa-searchengin"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_tecnica_esquila_prueba_1#}</span>
                </div>

                <div class="col-lg-3">
                    <label>{#field_fibra_en_bruto#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[fibra_en_bruto]" value="{$item.fibra_en_bruto|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-info-circle"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fibra_en_bruto#}</span>
                </div>
                <!--fibra obtenida-->
                <div class="col-lg-3">
                    <label>{#field_fibra_predescerdada#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[fibra_predescerdada]" value="{$item.fibra_predescerdada|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-mountain"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fibra_predescerdada#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_fibra_vellon#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[fibra_vellon]" value="{$item.fibra_vellon|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-mountain"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fibra_vellon#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_fibra_braga#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[fibra_braga]" value="{$item.fibra_braga|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-mountain"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fibra_braga#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_fibra_total#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[fibra_total]" value="{$item.fibra_total|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-sort-amount-up"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_fibra_total#}</span>
                </div>
            </div>
        </div>

        <div class="card-header py-3">
            <div class="card-title  m-0">
                <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
                <span class="font-weight-bold font-size-h4 text-primary">{#title_participacion_sociorganizativos#}</span>
            </div>
        </div>

        <div class="card-body  pt-1 pb-0">
            <div class="form-group row pt-0 pb-0 mb-0">
                <div class="col-lg-4">
                    <label>{#field_participacion_comunidades_mujeres#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[participacion_comunidades_mujeres]" value="{$item.participacion_comunidades_mujeres|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_mujer"><i class="fas fa-female"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_participacion_comunidades_mujeres#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_participacion_comunidades_hombres#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[participacion_comunidades_hombres]" value="{$item.participacion_comunidades_hombres|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_hombre"><i class="fas fa-male"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_participacion_comunidades_hombres#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_participacion_comunidades_total#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[participacion_comunidades_total]" value="{$item.participacion_comunidades_total|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-users"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_participacion_comunidades_total#}</span>
                </div>
                <!--participacion otras CMV-->
                <div class="col-lg-4">
                    <label>{#field_participacion_otrascmv_mujeres#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[participacion_otrascmv_mujeres]" value="{$item.participacion_otrascmv_mujeres|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_mujer"><i class="fas fa-female"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_participacion_otrascmv_mujeres#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_participacion_otrascmv_hombres#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[participacion_otrascmv_hombres]" value="{$item.participacion_otrascmv_hombres|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_hombre"><i class="fas fa-male"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_participacion_otrascmv_hombres#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_participacion_otrascmv_total#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[participacion_otrascmv_total]" value="{$item.participacion_otrascmv_total|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-users"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_participacion_otrascmv_total#}</span>
                </div>
                <!--participacion visitantes-->
                <div class="col-lg-4">
                    <label>{#field_participacion_visitantes_mujeres#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[participacion_visitantes_mujeres]" value="{$item.participacion_visitantes_mujeres|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_mujer"><i class="fas fa-female"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_participacion_visitantes_mujeres#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_participacion_visitantes_hombres#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[participacion_visitantes_hombres]" value="{$item.participacion_visitantes_hombres|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_hombre"><i class="fas fa-male"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_participacion_visitantes_hombres#}</span>
                </div>
                <div class="col-lg-4">
                    <label>{#field_participacion_visitantes_total#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[participacion_visitantes_total]" value="{$item.participacion_visitantes_total|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-users"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_participacion_visitantes_total#}</span>
                </div>
            </div>
        </div>

        <div class="card-header py-3">
            <div class="card-title  m-0">
                <span class="card-icon"><i class="flaticon2-next text-dark-25"></i></span>
                <span class="font-weight-bold font-size-h4 text-primary">{#title_fibra_venta#}</span>
            </div>
        </div>
        <div class="card-body  pt-1 pb-2 fibra_venta" >
            <div class="form-group row  pt-0 pb-0 mb-0">
                <div class="col-lg-3">
                    <label>{#field_venta_fibra_predescerdada#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[venta_fibra_predescerdada]" value="{$item.venta_fibra_predescerdada|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-poll"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_venta_fibra_predescerdada#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_venta_fibra_vellon#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[venta_fibra_vellon]" value="{$item.venta_fibra_vellon|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-poll"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_venta_fibra_vellon#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_venta_fibra_braga#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[venta_fibra_braga]" value="{$item.venta_fibra_braga|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-poll"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_venta_fibra_braga#}</span>
                </div>
                <div class="col-lg-3">
                    <label>{#field_venta_fibra_total#}:</label>
                    <div class="input-group">
                        <input type="text" class="form-control number_integer2"
                               name="item[venta_fibra_total]" value="{$item.venta_fibra_total|escape:"html"}"
                        >
                        <div class="input-group-append"><span class="input-group-text field_info"><i class="fas fa-poll"></i></span></div>
                    </div>
                    <span class="form-text text-black-50">{#field_msg_venta_fibra_total#}</span>
                </div>
            </div>
        </div>
        <div class="card-footer">
            {if $privFace.edit == 1}
                <button type="reset" class="btn btn-primary mr-2" id="general_submit">
                    <i class="la la-save"></i>
                    {#glBtnSaveChanges#}</button>
            {/if}
            <a href="{$path_url}" class="btn btn-light-primary ">
                <i class="la la-angle-double-left"></i>{if $type =="new"} {#glBtnCancel#} {else} {#glBtnBackToList#}{/if}
            </a>
        </div>

    </form>
    <!--end::Form-->
</div>

{include file="index.js.tpl"}