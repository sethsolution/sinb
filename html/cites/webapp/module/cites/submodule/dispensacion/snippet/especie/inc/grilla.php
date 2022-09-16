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
    "tabla" => $CFGm->tabla["c_especie"]
,    "alias"=> "especie_comun"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"especie_id"
,   "activo"=> 1
);

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_especie"]
,    "alias"=> "especie"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"especie_id"
,   "activo"=> 1
);

$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_tipo_unidad"]
,    "alias"=> "unidad"
,   "campo_id"=>"itemId"
,   "relacion_id"=>"unidad_id"
,   "activo"=> 1
);
/**
 * Item de las lista que se tiene desplegar
 */

$grilla_items[]=array("field"=> "nombre","label"=>"Nombre comun"
,   "tabla_alias"=> "especie_comun", "as" => "especie_id_comun", "activo"=> 1);

$grilla_items[]=array("field"=> "especie_id",   "label"=>"id Especie", "as"=>"especie_id_id", "activo"=> 1);
$grilla_items[]=array("field"=> "especie_nombre", "label"=>"Nombre Especie", "activo"=> 1);

$grilla_items[]=array("field"=> "nombre","label"=>"7/8 Nombre Científico y Nombre Común"
,   "tabla_alias"=> "especie", "as" => "especie_id", "activo"=> 1);

$grilla_items[]=array("field"=> "descripcion", "label"=>"9. Descripción de los especímenes", "activo"=> 1);
$grilla_items[]=array("field"=> "cantidad", "label"=>"10. Cantidad", "activo"=> 1);

$grilla_items[]=array("field"=> "nombre","label"=>"10. unidad"
,   "tabla_alias"=> "unidad", "as" => "unidad_id", "activo"=> 1);

////1-------------------------------------------------------------
//$field_name = "especie_id";
//$grilla_items[]=array(
//    "campo" => $field_name
//,   "field" => $field_name
//,   "label"=>"id Especie" //
//,   "as" => $field_name."_id"
//,   "activo"=> 1
//);
//2-------------------------------------------------------------
//$field_name = "especie_id";
//$field_alias = "especie_comun";
//$field_activo = 1;
//$grilla_items[]=array(
//    "campo" => "nombre_comun" // nombre del campo pero de la tabla que relaciona
//,   "field"=> $field_name
//,   "label"=>"Nombre comun"
//,   "as" => $field_name."_comun"
////,   "as"=>"estado_id_texto" //
//,   "tabla_alias"=> $field_alias
//,   "activo"=> $field_activo
//);
//        $grilla_tablas[] = array(
//            "tabla" => $CFGm->tabla["c_especie"]
//        ,    "alias"=> "especie_comun"
//        ,   "campo_id"=>"itemId"
//        ,   "relacion_id"=>"especie_id"
//        ,   "activo"=> 1
//        );
//3-------------------------------------------------------------
//$field_name = "especie_nombre";
//$grilla_items[]=array(
//    "campo" => $field_name
//,   "field" => $field_name
//,   "label"=>"Nombre Especie"
//,   "activo"=> 1
//);
//4-------------------------------------------------------------
//$field_name = "especie_id";
//$field_alias = "especie";
//$field_activo = 1;
//$grilla_items[]=array(
//    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
//,   "field"=> $field_name
//,   "label"=>"7/8 Nombre Científico y Nombre Común"
//,   "as" => $field_name
//,   "tabla_alias"=> $field_alias
//,   "activo"=> $field_activo
//);
//        $grilla_tablas[] = array(
//            "tabla" => $CFGm->tabla["c_especie"]
//        ,    "alias"=> "especie"
//        ,   "campo_id"=>"itemId"
//        ,   "relacion_id"=>"especie_id"
//        ,   "activo"=> 1
//        );




//5-------------------------------------------------------------
//$field_name = "descripcion";
//$grilla_items[]=array(
//    "campo" => $field_name
//,   "field" => $field_name
//,   "label"=>"9. Descripción de los especímenes" //
//,   "activo"=> 1
//);


//-------------------------------------------------------------

//6-------------------------------------------------------------
//$field_name = "cantidad";
//$grilla_items[]=array(
//    "campo" => $field_name
//,   "field" => $field_name
//,   "label"=> "10. Cantidad"
//,   "activo"=> 1
//);
//7-------------------------------------------------------------
//$field_name = "unidad_id";
//$field_alias = "unidad";
//$field_activo = 1;
//$grilla_items[]=array(
//    "campo" => "unidad" // nombre del campo pero de la tabla que relaciona
//,   "field"=> $field_name
//,   "label"=>"10. unidad"
//,   "as" => $field_name
////,   "as"=>"estado_id_texto" //
//,   "tabla_alias"=> $field_alias
//,   "activo"=> $field_activo
//);
//        $grilla_tablas[] = array(
//            "tabla" => $CFGm->tabla["c_tipo_unidad"]
//        ,    "alias"=> "unidad"
//        ,   "campo_id"=>"itemId"
//        ,   "relacion_id"=>"unidad_id"
//        ,   "activo"=> 1
//        );

//-------------------------------------------------------------
$grupo = "archivo";
$grilla[$grupo]= $grilla_items;
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
