<?
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



$campos_item["usuario"]=array(
    "tipo"=>"text"
,   "label"=>"Usuario");

$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre");

$campos_item["apellido"]=array(
    "tipo"=>"text"
,   "label"=>"Apellido");

$campos_item["password"]=array(
    "tipo"=>"text"
,   "label"=>"Password");

$campos_item["email"]=array(
    "tipo"=>"text"
,   "label"=>"Email");

$campos_item["rol_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"Rol");

/*
$campos_item["ci"]=array(
    "tipo"=>"text"
,   "label"=>"CI");
*/
$campos_item["telefono"]=array(
    "tipo"=>"text"
,   "label"=>"Telefono");
/*
$campos_item["ci_exp_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"CI Expedicion ");*/

$grupo = "vrhr_snir.core_usuario";
$campos[$grupo]= $campos_item;
$campos_item2 = array();



$campos_item2["tco_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"TcoId");

$campos_item2["usuario_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"UsuarioId");



$grupo = "cazador";
$grupo2 = "representante_legal";
$campos[$grupo]= $campos_item2;
$campos[$grupo2]= $campos_item2;
$campos_item3 = array();



$campos_item3["curtiembre_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"CurtiembreId");
$campos_item3["usuario_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"UsuarioId");



$grupo = "responsable_curtiembre";
$campos[$grupo]= $campos_item3;
$campos_item4 = array();



$campos_item4["empresa_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"EmpresaId");
$campos_item4["usuario_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"UsuarioId");



$grupo = "representante_empresa";
$campos[$grupo]= $campos_item4;

$campos_item5 = array();



$campos_item5["ci"]=array(
    "tipo"=>"text"
,   "label"=>"ci");
$campos_item5["ci_exp_itemId"]=array(
    "tipo"=>"text"
,   "label"=>"ciexpitem");



$grupo = "usuario_rol";
$campos[$grupo]= $campos_item5;



unset($campos_item);
unset($campos_item2);
unset($campos_item3);
unset($campos_item4);
unset($campos_item5);
/**
 * Apartir de aca, puedes configurar otros campos
 */
