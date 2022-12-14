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
//3-------------------------------------------------------------
$field_name = "especie_id";
$field_alias = "especie";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"7/8 Nombre Científico y Nombre Común"
,   "as" => $field_name
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_especie"]
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
//1-------------------------------------------------------------
$field_name = "especie_id";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=>"id Especie" //
,   "as" => $field_name."_id"
,   "activo"=> 1
);
//2-------------------------------------------------------------
$field_name = "especie_id";
$field_alias = "especie_comun";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre_comun" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Nombre comun"
,   "as" => $field_name."_comun"
//,   "as"=>"estado_id_texto" //
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_especie"]
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
//3-------------------------------------------------------------
$field_name = "especie_nombre";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=>"Nombre Especie"
,   "activo"=> 1
);





//5-------------------------------------------------------------
$field_name = "descripcion";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=>"9. Descripción de los especímenes" //
,   "activo"=> 1
);


//6-------------------------------------------------------------
$field_name = "apendice_id";
$field_alias = "apendice";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"10. Apéndice y Origen"
,   "as" => $field_name
//,   "as"=>"estado_id_texto" //
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_apendice"]
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
//7-------------------------------------------------------------
$field_name = "origen_id";
$field_alias = "origen_sigla";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "sigla" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"Origen - sigla"
,   "as" => $field_name."_sigla"
//,   "as"=>"estado_id_texto" //
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_tipo_origen"]
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
//8-------------------------------------------------------------
$field_name = "origen_id";
$field_alias = "origen";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"10. Origen"
,   "as" => $field_name
//,   "as"=>"estado_id_texto" //
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_tipo_origen"]
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
//9-------------------------------------------------------------
$field_name = "cantidad";
$grilla_items[]=array(
    "campo" => $field_name
,   "field" => $field_name
,   "label"=> "11. Cantidad"
,   "activo"=> 1
);
//10-------------------------------------------------------------
$field_name = "unidad_id";
$field_alias = "unidad";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "unidad" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"11. unidad"
,   "as" => $field_name
//,   "as"=>"estado_id_texto" //
,   "tabla_alias"=> $field_alias
,   "activo"=> $field_activo
);
$grilla_tablas[] = array(
    "tabla" => $CFGm->tabla["c_tipo_unidad"]
,    "alias"=> $field_alias
,   "campo_id"=>"itemId"
,   "relacion_id"=>$field_name
,   "activo"=> $field_activo
);
//11-------------------------------------------------------------
$field_name = "pais_id";
$field_alias = "pais";
$field_activo = 1;
$grilla_items[]=array(
    "campo" => "nombre" // nombre del campo pero de la tabla que relaciona
,   "field"=> $field_name
,   "label"=>"12a. País de Origen"
,   "as" => $field_name
//,   "as"=>"estado_id_texto" //
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
//-------------------------------------------------------------

$field_name = "estado_id";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Verificado" //
,   "as"=>"estado_id_verificado" //
,   "activo"=> 1
);
//-------------------------------------------------------------

$field_name = "estado_id";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Observado" //
,   "as"=>"estado_id_observado" //
,   "activo"=> 1
);

//-------------------------------------------------------------
$field_name = "observacion_fecha";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Fecha de Observación" //
,   "activo"=> 1
);
//-------------------------------------------------------------
$field_name = "aprobado_fecha";
$grilla_items[]=array(
    "campo" => $field_name // el campo de la base de datos que recupera
,   "field" => "$field_name" // se da formato o se configura el nombre del campo resultado
,   "label"=>"Fecha de Aprobación" //
,   "activo"=> 1
);

//-------------------------------------------------------------
$grupo = "archivo";
$grilla[$grupo]= $grilla_items;
//print_struc($grilla[$grupo]); exit();
$grilla_tablas_adicionales[$grupo]= $grilla_tablas;
unset($grilla_items); // siempre se borrar la variable para iniciar una nueva configuración
unset($grilla_tablas); // siempre se borrar la variable para iniciar una nueva configuración
