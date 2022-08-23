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
    "tabla" => $CFGm->tabla["c_empresa_estado"]
,    "alias"=> "e"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"estado_id"
,   "activo"=> 1
);

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_departamento"]
,    "alias"=> "d"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"representante_legal_ci_exp"
,   "activo"=> 1
);

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["core_cites_usuario"]
,    "alias"=> "u"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"usuario_id"
,   "activo"=> 1
);
/**
 * Item de las lista que se tiene desplegar
 */
$grilla_items[]=array("campo" => "usuario", "label"=>"Usuario", "activo"=> 1
,   "tabla_alias"=> "u", "as" => "usuario");
$grilla_items[]=array("campo" => "activo", "label"=>"Usuario Activo", "activo"=> 1
,   "tabla_alias"=> "u", "as" => "usuario_activo");
$grilla_items[]=array("campo" => "dateCreate", "label"=>"Usuario Fecha de Creación", "activo"=> 1
,   "tabla_alias"=> "u", "as" => "usuario_datecreate");
$grilla_items[]=array("campo" => "verifica_email", "label"=>"Email Verificado", "activo"=> 1
,   "tabla_alias"=> "u", "as" => "usuario_verificaemail");
$grilla_items[]=array("campo" => "verifica_fecha", "label"=>"Email Verificado Fecha", "activo"=> 1
,   "tabla_alias"=> "u", "as" => "usuario_verificafecha");


$grilla_items[]=array("campo" => "nombre", "label"=>"Estado", "activo"=> 1
,   "tabla_alias"=> "e", "as" => "estado_id");


$grilla_items[]=array("field"=> "nombre","campo" => "nombre"
,   "label"=>"Nombre (Institución)",   "activo"=> 1);

$grilla_items[]=array("field"=> "representante_legal_nombre",  "campo" => "representante_legal_nombre"
,   "label"=>"Nombre (Persona)",   "activo"=> 1);
$grilla_items[]=array("field"=> "representante_legal_paterno", "campo" => "representante_legal_paterno"
,   "label"=>"Apellido Paterno",   "activo"=> 1);
$grilla_items[]=array("field"=> "representante_legal_materno","campo" => "representante_legal_materno"
,   "label"=>"Apellido Materno",   "activo"=> 1);


$grilla_items[]=array("field"=> "representante_legal_ci",  "campo" => "representante_legal_ci"
,   "label"=>"C.I.",   "activo"=> 1);
$grilla_items[]=array("campo" => "nombre", "label"=>"Expedido", "activo"=> 1
,   "tabla_alias"=> "d", "as" => "representante_legal_ci_exp");


$grilla_items[]=array("field"=> "representante_legal_telefono","campo" => "representante_legal_telefono"
,   "label"=>"Teléfono",   "activo"=> 1);
$grilla_items[]=array("field"=> "email","campo" => "email"
,   "label"=>"Email",   "activo"=> 1);


$grilla_items[]=array("field"=> "direccion","campo" => "direccion",   "label"=>"Dirección",   "activo"=> 1);
$grilla_items[]=array("field"=> "nit", "campo" => "nit",   "label"=>"NIT",   "activo"=> 1);
$grilla_items[]=array("field"=> "enviado_fecha", "campo" => "enviado_fecha",   "label"=>"Fecha de Envio",   "activo"=> 1);
$grilla_items[]=array("field"=> "aprobado_fecha", "campo" => "aprobado_fecha",   "label"=>"Fecha de Aprobación",   "activo"=> 1);

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