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
//0-------------------------------------------------------------
$field_name = "numero_informe";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Número de Informe"
,   "activo"=> 1
);

//1-------------------------------------------------------------
$field_name = "fecha_reporte";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Fecha de reporte" //
//,   "as"=>"estado_id_observado" //
,   "activo"=> 1
);

//2
$field_name = "emite_nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nombre del encargado del reporte"
,   "activo"=> 1
);

//3
$field_name = "emite_cargo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Cargo del encargado del reporte"
,   "activo"=> 1
);
//4
$field_name = "para_nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nombre del destinatario del reporte"
,   "activo"=> 1
);


//5-------------------------------------------------------------
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
        
//6-------------------------------------------------------------
$field_name = "estado_id";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Enviado" //
,   "activo"=> 1
);
//7-------------------------------------------------------------

$field_name = "estado_id";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Verificado" //
,   "as"=>"estado_id_verificado" //
,   "activo"=> 1
);
//8-------------------------------------------------------------

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
