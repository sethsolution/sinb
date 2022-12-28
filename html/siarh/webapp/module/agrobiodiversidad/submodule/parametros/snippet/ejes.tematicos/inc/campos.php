<?php
/**
 * Configuramos todas los grupos de campos, para creación y verificación de formulaios
 */

/**
 * Arreglos que se utilizaran en esta configuración para guardar los grupos de campos
 */
$campos = array();

/***
 * Configuraciòn de los grupos de campos a utilizar
 */
$campos_item = array();

$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"nombre");

$campos_item["descrip"]=array(
    "tipo"=>"text"
,   "label"=>"descrip");

$campos_item["activo"]=array(
    "tipo"=>"text"
,   "label"=>"activo");

$grupo = "campos_ejes_tematicos";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */