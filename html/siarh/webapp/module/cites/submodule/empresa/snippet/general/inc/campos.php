<?PHP
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


/**
 * -----------------------------------------------------------------------------------
 */

$campos_item = array();
$campos_item["observado"]=array(
    "tipo"=>"checkbox_01"
,   "label"=>"observado");
$campos_item["observacion"]=array(
    "tipo"=>"text"
,   "label"=>"observacion");

$grupo = "general";
$campos[$grupo]= $campos_item;
unset($campos_item);



/**
 * Apartir de aca, puedes configurar otros campos
 */
