<?PHP
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */

/**
 * Arreglos que se utilizaran en esta configuración para guardar los grupos de campos
 */
$fields = array();

/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$field_item = array();
//*******caracteristicas generales
$field_item["nacional_id"]=array("type"=>"text");
$field_item["anio"]=array("type"=>"text");
$field_item["departamento_id"]=array("type"=>"text");
$field_item["provincia_id"]=array("type"=>"text");
$field_item["arcmv"]=array("type"=>"text");
$field_item["cmv"]=array("type"=>"text");

// fecha y lugar autorizacion esquilas
$field_item["numero_acta"]=array("type"=>"text");
$field_item["sitio_captura"]=array("type"=>"text");
$field_item["fecha_captura"]=array("type"=>"date_01");

// VICUÑAS PRE CAPTURA, VICUÑAS CAPTURADAS
$field_item["numero_vicuna_sitio_captura"]=array("type"=>"text");
$field_item["numero_vicuna_capturadas"]=array("type"=>"text");
$field_item["tasa_captura"]=array("type"=>"text");
$field_item["numero_vicuna_esquiladas"]=array("type"=>"text");
$field_item["tasa_esquila"]=array("type"=>"text");
$field_item["numero_vicuna_muertas_accidente"]=array("type"=>"text");

// captura por sexo
$field_item["captura_machos"]=array("type"=>"text");
$field_item["captura_hembras"]=array("type"=>"text");
$field_item["prueba_a"]=array("type"=>"text");

//Captura por edad
$field_item["edad_cria"]=array("type"=>"text");
$field_item["edad_juvenil"]=array("type"=>"text");
$field_item["edad_adulto"]=array("type"=>"text");
$field_item["edad_prueba_b"]=array("type"=>"text");

//Captura condicion corporal
$field_item["condicion_corporal_malo"]=array("type"=>"text");
$field_item["condicion_corporal_regular"]=array("type"=>"text");
$field_item["condicion_corporal_bueno"]=array("type"=>"text");

// Captura gestacion porr esquila
$field_item["gestacion_si"]=array("type"=>"text");
$field_item["gestacion_si_ultimo_tercio"]=array("type"=>"text");
$field_item["gestacion_no"]=array("type"=>"text");
$field_item["gestacion_prueba_2"]=array("type"=>"text");

//PARÁSITOS DE LAS VICUÑAS POR ESQUILA Y CMV.
// Parasitos externos
$field_item["parasito_externo_garrapata"]=array("type"=>"text");
$field_item["parasito_externo_piojo"]=array("type"=>"text");
$field_item["parasito_externo_sarna"]=array("type"=>"text");

//Severidad de sarna
$field_item["severidad_sarna_leve"]=array("type"=>"text");
$field_item["severidad_sarna_moderado"]=array("type"=>"text");
$field_item["severidad_sarna_severo"]=array("type"=>"text");

//Caspa
$field_item["caspa_si"]=array("type"=>"text");
$field_item["caspa_no"]=array("type"=>"text");

// DATOS DE LA FIBRA DE VICUÑA OBTENIDA.
$field_item["tecnica_esquila_numero_vicuna_esquiladas"]=array("type"=>"text");
$field_item["tecnica_esquila_tijera_manual"]=array("type"=>"text");
$field_item["tecnica_esquila_maquina_electrica"]=array("type"=>"text");
$field_item["tecnica_esquila_prueba_1"]=array("type"=>"text");
$field_item["fibra_en_bruto"]=array("type"=>"text");
$field_item["fibra_predescerdada"]=array("type"=>"text");
$field_item["fibra_vellon"]=array("type"=>"text");
$field_item["fibra_braga"]=array("type"=>"text");
$field_item["fibra_total"]=array("type"=>"text");

//RESULTADOS DE PARTICIPACIÓN Y SOCIORGANIZATIVOS.
//PARTICIPACIÓN DE LAS COMUNIDADES.
$field_item["participacion_comunidades_mujeres"]=array("type"=>"text");
$field_item["participacion_comunidades_hombres"]=array("type"=>"text");
$field_item["participacion_comunidades_total"]=array("type"=>"text");

//PARTICIPANTES DE OTRAS CMV.
$field_item["participacion_otrascmv_mujeres"]=array("type"=>"text");
$field_item["participacion_otrascmv_hombres"]=array("type"=>"text");
$field_item["participacion_otrascmv_total"]=array("type"=>"text");

//VISITANTES
$field_item["participacion_visitantes_mujeres"]=array("type"=>"text");
$field_item["participacion_visitantes_hombres"]=array("type"=>"text");
$field_item["participacion_visitantes_total"]=array("type"=>"text");

// DATOS DE LA FIBRA DE VICUÑA PARA LA VENTA
$field_item["venta_fibra_predescerdada"]=array("type"=>"text");
$field_item["venta_fibra_vellon"]=array("type"=>"text");
$field_item["venta_fibra_braga"]=array("type"=>"text");
$field_item["venta_fibra_total"]=array("type"=>"text");

$fields["module"]= $field_item;
unset($field_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
