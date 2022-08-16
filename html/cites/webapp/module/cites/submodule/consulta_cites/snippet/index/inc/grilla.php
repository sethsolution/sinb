<?php
/**
 * Configuramos todas las grillas que utilizaremos en este snippet
 */

/**
 * Arreglos que se utilizaran en esta configuración
 */
$grilla = array();
$grilla_tablas_adicionales = array();


/**
 * Configuramos las tablas adicionales para realizar un join con la tabla principal
 * estas tablas estan configuradas en el archivo db.referencia.php del submodulo
 * puede hacer un :
 *
 * print_struc($CFGm->tabla);exit;
 *
 * para ver el contenido de las tablas configuradas
 *
 * es una tabla de configuración para cada grilla
 */

/**
 * Item de las lista que se tiene desplegar
 */
//-------------------------------------------------------------

$field_name = "tipo_documento_id";
$field_alias = "tipodocumento";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Tipo de Documentación"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_tipo_documento"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "importador_nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nombre del Importador"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "exportador_nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nombre del  Exportador"
,   "activo"=> 1
);
/*//-------------------------------------------------------------
$field_name = "exportador_pais_id";
$field_alias = "pais_exportador";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Exportador País"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_pais"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
*/
//-------------------------------------------------------------
$field_name = "emitido_fecha";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha de emisión"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "fecha_expiracion";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha de Expiración"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "estado_id";
$field_alias = "estado";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Estado"
//,   "as" => $field_name
,   "as"=>"estado_id_texto" //
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_estado"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
     /*
//-------------------------------------------------------------
$field_name = "estado_id";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Enviado" //
,   "activo"=> 1
);
//-------------------------------------------------------------

$field_name = "estado_id";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Verificado" //
,   "as"=>"estado_id_verificado" //
,   "activo"=> 1
);
//-------------------------------------------------------------

$field_name = "estado_id";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Observado" //
,   "as"=>"estado_id_observado" //
,   "activo"=> 1
);
/**
 * Se añade el arreglo de grilla configurada a grilla
 */
$grupo = "index";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
//-------------------------------------------------------------
$field_name = "item_id";
$field_alias = "programasigla";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "sigla" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Abreviación"
,   "as" => "sigla"
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["item"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "item_id";
$field_alias = "programa";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Programa"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["item"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "codigo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Código"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "nombre";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Nombre"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "moneda_id";
$field_alias = "mon";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Moneda"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_convenio_moneda"]
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);

//-------------------------------------------------------------
$field_name = "cartera";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Cartera"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "fecha_firma";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha Firma"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "fecha_finalizacion";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha Fin"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "fecha_aprobacion";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha Aprob."
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "fecha_max_ultimo_desembolso";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha Ult. Desem."
,   "activo"=> 1
);
//-------------------------------------------------------------
/*
$field_name = "activo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Activo"
,   "activo"=> 1
);*/
//-------------------------------------------------------------

//-------------------------------------------------------------

$field_name = "estado_id";
$field_alias = "est";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Estado"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_convenio_estado"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "componente_monto";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Monto Convenio (moneda convenio)"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "componente_monto_bs";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Monto Convenio (Bs.)"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "componente_monto_apl";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Monto APL (moneda convenio)"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "componente_monto_apl_bs";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Monto APL (Bs.)"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "componente_monto_total";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Monto Total (moneda convenio)"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "componente_monto_total_bs";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Monto Total (Bs.)"
,   "activo"=> 1
);
//-------------------------------------------------------------
/**
 * Se añade el arreglo de grilla configurada a grilla
 */
$grupo = "index2";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
/**
 * A partir de aca puede añadir todas las grillas que sean necesarias para esta vista
 */
/*
$grilla_items = array();

$field_name = "activo";
$grilla_items[]=array(
    "campo" => $field_name
,    "field"=> $field_name
,   "label"=>"Ac"
,   "type_field"=>"text"
,   "as" => ""
);

$field_name = "nombres";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => "$field_name"
,   "label"=>"Nombres"
,   "type_field"=>"text"
,   "as" => ""
);
$grilla["otra_grilla"]= $grilla_items;
*/