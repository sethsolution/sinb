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

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_estado"]
,    "alias"=> "es"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"estado_id"
,   "activo"=> 1
);

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["core_cites_usuario"]
,    "alias"=> "u"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"e.usuario_id"
,   "activo"=> 1
);

/**
 * Item de las lista que se tiene desplegar
 */
$grilla_items[]=array("campo" => "usuario", "label"=>"Usuario", "activo"=> 1
,   "tabla_alias"=> "u", "as" => "usuario");

$grilla_items[]=array("campo" => "nombre", "label"=>"Empresa", "activo"=> 1
,   "tabla_alias"=> "e", "as" => "empresa");

$grilla_items[]=array("field"=> "empresa_id",  "campo" => "empresa_id"
,   "label"=>"Empresa ID",   "activo"=> 1);


$grilla_items[]=array("campo" => "nombre", "label"=>"Tipo de Documentación", "activo"=> 1
,   "tabla_alias"=> "td", "as" => "tipo_documento");

$grilla_items[]=array("field"=> "importador_nombre",  "campo" => "importador_nombre"
,   "label"=>"Nombre del Importador",   "activo"=> 1);

$grilla_items[]=array("field"=> "exportador_nombre",  "campo" => "exportador_nombre"
,   "label"=>"Nombre del  Exportador",   "activo"=> 1);

$grilla_items[]=array("campo" => "nombre", "label"=>"Estado", "activo"=> 1
,   "tabla_alias"=> "es", "as" => "estado");

$grilla_items[]=array("field"=> "estado_id", "campo" => "estado_id",   "label"=>"Enviado",  "activo"=> 1);
$grilla_items[]=array("field"=> "estado_id", "campo" => "estado_id",   "label"=>"Verificado",   "as"=>"estado_id_verificado",   "activo"=> 1);
$grilla_items[]=array("field"=> "estado_id", "campo" => "estado_id",   "label"=>"Observado",   "as"=>"estado_id_observado",   "activo"=> 1);

$grilla_items[]=array("field"=> "sustitucion_cites", "campo" => "sustitucion_cites",   "label"=>"Tipo",   "activo"=> 1);
$grilla_items[]=array("field"=> "enviado_fecha", "campo" => "enviado_fecha",   "label"=>"Fecha de Envio",   "activo"=> 1);
$grilla_items[]=array("field"=> "emitido_fecha", "campo" => "emitido_fecha",   "label"=>"Fecha de emisión",   "activo"=> 1);
$grilla_items[]=array("field"=> "fecha_expiracion", "campo" => "fecha_expiracion",   "label"=>"Fecha de Expiración",   "activo"=> 1);

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
