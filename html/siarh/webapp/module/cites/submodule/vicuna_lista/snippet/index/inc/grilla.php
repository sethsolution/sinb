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
$field_name = "empresa_nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nombre de la Empresa"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "representante_legal_nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nombre del Representante"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "venta_monto";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Monto de Venta (Bs.)"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "venta_cantidad";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Cantidad Venta"
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

/*
//-------------------------------------------------------------
$field_name = "dateCreate";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha de envío"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "vicuna_fecha_emision";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha de emisión"
,   "activo"=> 1
);
*/
//-------------------------------------------------------------

$field_name = "dateCreate";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha de creación"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "enviado_fecha";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha de Envio"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "aprobado_fecha";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha de Aprobación"
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
