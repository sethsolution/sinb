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
 * Configuración de tablas relacionales, (JOIN)
 */

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_tipo_documento"]
,    "alias"=> "tipodocumento"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"tipo_documento_id"
,   "activo"=> 1
);

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_estado"]
,    "alias"=> "estado"
,   "campo_id"=> "itemId"
,   "relacion_id"=> "estado_id"
,   "activo"=> 1
);

/**
 * Item de las lista que se tiene desplegar
 */
$grilla_items[]=array("field"=> "nombre","label"=>"Tipo de Documentación"
,   "tabla_alias"=> "tipodocumento", "as" => "tipo_documento_id", "activo"=> 1);

$grilla_items[]=array("field"=> "importador_nombre",   "label"=>"Nombre del Importador",   "activo"=> 1);
$grilla_items[]=array("field"=> "exportador_nombre", "label"=>"Nombre del  Exportador", "activo"=> 1);
$grilla_items[]=array("field"=> "emitido_fecha",   "label"=>"Fecha de emisión", "activo"=> 1);
$grilla_items[]=array("field"=> "fecha_expiracion", "label"=>"Fecha de Expiración","activo"=> 1);

$grilla_items[]=array("field"=> "nombre", "label"=>"Estado"
,   "tabla_alias"=> "estado",   "as"=>"estado_id_texto", "activo"=> 1);

$grilla_items[]=array("field" => "estado_id","label"=>"Enviado", "activo"=> 1);
$grilla_items[]=array("field" => "estado_id", "label"=>"Verificado", "as"=>"estado_id_verificado","activo"=> 1);
$grilla_items[]=array("field" => "estado_id",   "label"=>"Observado",   "as"=>"estado_id_observado",   "activo"=> 1);
$grilla_items[]=array("field" => "sustitucion_cites",   "label"=>"Tipo",   "activo"=> 1);
//$field_name = "tipo_documento_id";
//$field_alias = "tipodocumento";
//$field_activo = 1;
//$grilla_items[]=array(
//    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
//,   "field"=> $field_name
//,   "label"=>"Tipo de Documentación"
//,   "as" => $field_name
//,   "tabla_alias"=> $field_alias
//,   "activo"=> $field_activo
//);
//$grilla_tablas[] = array(
//    "tabla" => $CFGm->tabla["c_tipo_documento"]
//,    "alias"=> $field_alias
//,   "campo_id"=>"itemId"
//,   "relacion_id"=>$field_name
//,   "activo"=> $field_activo
//);
//-------------------------------------------------------------
//$field_name = "importador_nombre";
//$grilla_items[]=array(
//    "campo" => $field_name
//,   "field"=> $field_name
//,   "label"=>"Nombre del Importador"
//,   "activo"=> 1
//);
////-------------------------------------------------------------
//$field_name = "exportador_nombre";
//$grilla_items[]=array(
//    "campo" => $field_name
//,   "field"=> $field_name
//,   "label"=>"Nombre del  Exportador"
//,   "activo"=> 1
//);
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
//$field_name = "emitido_fecha";
//$grilla_items[]=array(
//    "campo" => $field_name
//,   "field"=> $field_name
//,   "label"=>"Fecha de emisión"
//,   "activo"=> 1
//);
////-------------------------------------------------------------
//$field_name = "fecha_expiracion";
//$grilla_items[]=array(
//    "campo" => $field_name
//,   "field"=> $field_name
//,   "label"=>"Fecha de Expiración"
//,   "activo"=> 1
//);

//-------------------------------------------------------------
//$field_name = "estado_id";
//$field_alias = "estado";
//$field_activo = 1;
//$grilla_items[]=array(
//    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
//,   "field"=> $field_name
//,   "label"=>"Estado"
////,   "as" => $field_name
//,   "as"=>"estado_id_texto" //
//,   "tabla_alias"=> $field_alias
//,   "activo"=> $field_activo
//);
//$grilla_tablas[] = array(
//    "tabla" => $CFGm->tabla["c_estado"]
//,    "alias"=> $field_alias
//,   "campo_id"=>"itemId"
//,   "relacion_id"=>$field_name
//,   "activo"=> $field_activo
//);

//-------------------------------------------------------------
//$field_name = "estado_id";
//$grilla_items[]=array(
//    "campo" => $field_name // el campo de la base de datos que recupera
//,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
//,   "label"=>"Enviado" //
//,   "activo"=> 1
//);
////-------------------------------------------------------------
//
//$field_name = "estado_id";
//$grilla_items[]=array(
//    "campo" => $field_name // el campo de la base de datos que recupera
//,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
//,   "label"=>"Verificado" //
//,   "as"=>"estado_id_verificado" //
//,   "activo"=> 1
//);
////-------------------------------------------------------------
//
//$field_name = "estado_id";
//$grilla_items[]=array(
//    "campo" => $field_name // el campo de la base de datos que recupera
//,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
//,   "label"=>"Observado" //
//,   "as"=>"estado_id_observado" //
//,   "activo"=> 1
//);

//-------------------------------------------------------------
//$field_name = "sustitucion_cites";
//$grilla_items[]=array(
//    "campo" => $field_name // el campo de la base de datos que recupera
//,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
//,   "label"=>"Tipo" //
////,   "as"=>"estado_id_observado" //
//,   "activo"=> 1
//);
//-------------------------------------------------------------
$grupo = "archivo";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
