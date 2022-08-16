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

/*

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_genero"]
,    "alias"=> "ge"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"ci_exp"
,   "activo"=> 1
);
*/

/**
 * Item de las lista que se tiene desplegar
 */

//-------------------------------------------------------------
$field_name = "nombres";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Nombres" //
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "apellido_paterno";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "Apellido Paterno"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "apellido_materno";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=> "Apellido Materno"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "ci";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"C.I."
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "ci_exp";
$field_alias = "depa";
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
            "tabla" => $CFGm->tabla["o_departamento"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=> $field_name
        ,   "activo"=> $field_activo
        );

//-------------------------------------------------------------
$field_name = "activo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Ac"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "genero_id";
$field_alias = "ge";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Genero"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_genero"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "fecha_nacimiento";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Fecha Nacimiento"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "movil";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Cel. Personal"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "movil_corporativo";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Cel. Corporativo"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "telefono_interno";
$grilla_items[]=array(
    "campo" => $field_name
,   "field"=> $field_name
,   "label"=>"Int."
,   "activo"=> 1
);
//-------------------------------------------------------------
/*
$field_name = "modalidad_id";
$field_alias = "mo";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Modalidad"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["c_modalidad"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
*/
//-------------------------------------------------------------
$field_name = "correo_electronico";
$grilla_items[]=array(
    "campo" => $field_name
,    "field"=> $field_name
,   "label"=>"E-mail"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "facebook_url";
$grilla_items[]=array(
    "campo" => $field_name
,    "field"=> $field_name
,   "label"=>"Facebook"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "twitter_url";
$grilla_items[]=array(
    "campo" => $field_name
,    "field"=> $field_name
,   "label"=>"Twitter"
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "entidad_id";
$field_alias = "en";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Entidad"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["o_entidad"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "direccion_id";
$field_alias = "dir";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Dirección"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["o_direccion"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
        );
//-------------------------------------------------------------
$field_name = "unidad_id";
$field_alias = "uni";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Unidad"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
        $grilla_tablas[] = array(
            "tabla" => $CFGm->tabla["o_unidad"]
        ,    "alias"=> $field_alias
        ,   "campo_id"=>"itemId"
        ,   "relacion_id"=>$field_name
        ,   "activo"=> $field_activo
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