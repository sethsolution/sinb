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
$field_name = "itemId";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "ID"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "macroreg_itemid";
$field_alias = "macro";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "descrip" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Macroregión"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["mapa_macroregiones"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"id"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "territorio_itemid";
$field_alias = "territorio";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Territorio"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_territorios"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "tipodoc_itemid";
$field_alias = "tipodoc";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Tipo"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_tipo_documentos"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "titulo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "Título"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "ejetem_itemid";
$field_alias = "ejetem";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Eje temático"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_ejes_tematicos"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "anio_publicacion";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "Año de publicación"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "pais_origen";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "Origen"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "autor";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "Autor"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "nombre_cientifico";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "Nombre científico"
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "especies";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "Especies"
,   "activo"=> 1
);

//-------------------------------------------------------------

/**
 * Se añade el arreglo de grilla configurada a grilla
 */
$grupo = "grilla_documentos";
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