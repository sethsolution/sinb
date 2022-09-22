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
    "tabla" => $CFGm->tabla["empresa"]
,    "alias"=> "e"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"empresa_id"
,   "activo"=> 1
);

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_tipo_documento"]
,    "alias"=> "td"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"tipo_documento_id"
,   "activo"=> 1
);


//$grilla_tablas[] = array(
//    "tabla" => $CFGm->tabla["c_pais"]
//,    "alias"=> "pais_exportador"
//,   "campo_id"=>"itemId"
//,   "relacion_id"=>"exportador_pais_id"
//,   "activo"=> 1
//);

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_estado"]
,    "alias"=> "es"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"estado_id"
,   "activo"=> 1
);

/**
 * Item de las lista que se tiene desplegar
 */
$grilla_items[]=array("campo" => "nombre", "label"=>"Empresa", "activo"=> 1
,   "tabla_alias"=> "e", "as" => "empresa");

$grilla_items[]=array("campo" => "nombre", "label"=>"Tipo de Documentación", "activo"=> 1
,   "tabla_alias"=> "td", "as" => "tipo_documento");

$grilla_items[]=array("field"=> "empresa_id",  "campo" => "empresa_id"
,   "label"=>"Empresa ID",   "activo"=> 1);



$grilla_items[]=array("field"=> "importador_nombre",  "campo" => "importador_nombre"
,   "label"=>"Nombre del Importador",   "activo"=> 1);

$grilla_items[]=array("field"=> "exportador_nombre",  "campo" => "exportador_nombre"
,   "label"=>"Nombre del  Exportador",   "activo"=> 1);

//$grilla_items[]=array("campo" => "nombre", "label"=>"Exportador País", "activo"=> 1
//,   "tabla_alias"=> "pais_exportador", "as" => "exportador_pais_id");

$grilla_items[]=array("campo" => "nombre", "label"=>"Estado", "activo"=> 1
,   "tabla_alias"=> "es", "as" => "estado");

$grilla_items[]=array("field"=> "estado_id", "campo" => "estado_id",   "label"=>"Enviado",  "activo"=> 1);
$grilla_items[]=array("field"=> "estado_id", "campo" => "estado_id",   "label"=>"Verificado",   "as"=>"estado_id_verificado",   "activo"=> 1);
$grilla_items[]=array("field"=> "estado_id", "campo" => "estado_id",   "label"=>"Observado",   "as"=>"estado_id_observado",   "activo"=> 1);

$grilla_items[]=array("field"=> "sustitucion_dispensacion", "campo" => "sustitucion_dispensacion",   "label"=>"Tipo",   "activo"=> 1);
//$grilla_items[]=array("field"=> "enviado_fecha", "campo" => "enviado_fecha",   "label"=>"Fecha de Envio",   "activo"=> 1);
$grilla_items[]=array("field"=> "emitido_fecha", "campo" => "emitido_fecha",   "label"=>"Fecha de emisión",   "activo"=> 1);
$grilla_items[]=array("field"=> "fecha_expiracion", "campo" => "fecha_expiracion",   "label"=>"Fecha de Expiración",   "activo"=> 1);

$grilla_items[]=array("field"=> "dateCreate", "campo" => "dateCreate",   "label"=>"Fecha de creación",   "activo"=> 1);
$grilla_items[]=array("field"=> "dateUpdate", "campo" => "dateUpdate",   "label"=>"Fecha Actualización",   "activo"=> 1);
//$field_name = "empresa_id";
//$field_alias = "empresa";
//$field_activo = 1;
//$grilla_items[]=array(
//    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
//,   "field"=> $field_name
//,   "label"=>"Empresa"
//,   "as" => $field_name
//,   "tabla_alias"=> $field_alias
//,   "activo"=> $field_activo
//);
//$grilla_tablas[] = array(
//    "tabla" => $CFGm->tabla["empresa"]
//,    "alias"=> $field_alias
//,   "campo_id"=>"itemId"
//,   "relacion_id"=>$field_name
//,   "activo"=> $field_activo
//);
////-------------------------------------------------------------
//
//$field_name = "empresa_id";
//$grilla_items[]=array(
//    "campo" => $field_name
//,   "field"=> $field_name
//,   "label"=>"Empresa ID"
//,   "as"=>"empresa_id_num" //
//,   "activo"=> 1
//);
//
////-------------------------------------------------------------
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
////-------------------------------------------------------------
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
///*//-------------------------------------------------------------
//$field_name = "exportador_pais_id";
//$field_alias = "pais_exportador";
//$field_activo = 1;
//$grilla_items[]=array(
//    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
//,   "field"=> $field_name
//,   "label"=>"Exportador País"
//,   "as" => $field_name
//,   "tabla_alias"=> $field_alias
//,   "activo"=> $field_activo
//);
//        $grilla_tablas[] = array(
//            "tabla" => $CFGm->tabla["c_pais"]
//        ,    "alias"=> $field_alias
//        ,   "campo_id"=>"itemId"
//        ,   "relacion_id"=>$field_name
//        ,   "activo"=> $field_activo
//        );
//*/
//
//
////-------------------------------------------------------------
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
//
////-------------------------------------------------------------
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
//
////-------------------------------------------------------------
//$field_name = "sustitucion_dispensacion";
//$grilla_items[]=array(
//    "campo" => $field_name // el campo de la base de datos que recupera
//,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
//,   "label"=>"Tipo" //
////,   "as"=>"estado_id_observado" //
//,   "activo"=> 1
//);
//
////-------------------------------------------------------------
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

$grilla_items[]=array("field"=> "dateCreate", "campo" => "dateCreate",   "label"=>"Fecha de creación",   "activo"=> 1);
$grilla_items[]=array("field"=> "dateUpdate", "campo" => "dateUpdate",   "label"=>"Fecha Actualización",   "activo"=> 1);
/**
 * Se añade el arreglo de grilla configurada a grilla
 */
$grupo = "index";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
//-------------------------------------------------------------
