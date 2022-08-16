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

$field_name = "estado_id";
$field_alias = "estado";
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
            "tabla" => $CFGm->tabla["c_empresa_estado"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nombre (Institución)"
,   "activo"=> 1
);


//-------------------------------------------------------------
$field_name = "representante_legal_nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Nombre (Persona)"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "representante_legal_paterno";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Apellido Paterno"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "representante_legal_materno";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Apellido Materno"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "representante_legal_telefono";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Teléfono"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "representante_legal_ci";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"C.I."
,   "activo"=> 1
);
//-------------------------------------------------------------

$field_name = "representante_legal_ci_exp";
$field_alias = "Expedido";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Expedido"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_departamento"]
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
//-------------------------------------------------------------
/*$field_name = "telefono";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Teléfono"
,   "activo"=> 1
);
*/

//-------------------------------------------------------------
$field_name = "email";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Email"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "direccion";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Dirección"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "nit";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"NIT"
,   "activo"=> 1
);
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


//-------------------------------------------------------------

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