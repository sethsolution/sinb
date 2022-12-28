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
$field_name = "itemId";
$field_alias = "t1";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "fecha_levantamiento" // nombre del campo pero de la tabla que relaciona
,   "field"=> "fecha_levantamiento"
,   "label"=>"Fecha de levantamiento"
,   "as" => "fecha_levantamiento"
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["cultivo_informacion_adicional"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "itemId";
$field_alias = "t2";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "fecha_vigencia" // nombre del campo pero de la tabla que relaciona
,   "field"=> "fecha_vigencia"
,   "label"=>"Fecha de vigencia"
,   "as" => "fecha_vigencia"
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["cultivo_informacion_adicional"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "espe_itemid";
$field_alias = "espe";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre_comun" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Especie"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["especies"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemid"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "ecotipo_itemid";
$field_alias = "ecotipo";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Ecotipo"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["especie_ecotipos"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "vincula_itemid";
$field_alias = "vincula";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Vinculación"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_vinculaciones"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
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
$field_name = "depto_itemid";
$field_alias = "depto";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Departamento"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["mapa_departamentos"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"id"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "municipio_itemid";
$field_alias = "municip";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "municipio" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Municipio"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["mapa_municipios"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"id"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "comunidad";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "Comunidad"
,   "activo"=> 1
);

//-------------------------------------------------------------

/**
 * Se añade el arreglo de grilla configurada a grilla
 */
$grupo = "grilla_cultivos";
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