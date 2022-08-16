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

$campos_item["nombre"]=array(
    "tipo"=>"text"
,   "label"=>"Nombre");

$campos_item["nit"]=array(
    "tipo"=>"text"
,   "label"=>"Nit");


$campos_item["fundempresa_objeto"]=array(
    "tipo"=>"text"
,   "label"=>"FundEmpresa");

$campos_item["entidad_cientifica_id"]=array(
    "tipo"=>"text"
,   "label"=>"entidad_cientifica_id");

$campos_item["universidad_asociada"]=array(
    "tipo"=>"text"
,   "label"=>"universidad_asociada");

$campos_item["ruex"]=array(
    "tipo"=>"text"
,   "label"=>"Ruex");


$campos_item["pais_id"]=array(
    "tipo"=>"text"
,   "label"=>"Pais");

$campos_item["departamento_id"]=array(
    "tipo"=>"text"
,   "label"=>"Departamento");

$campos_item["ciudad"]=array(
    "tipo"=>"text"
,   "label"=>"ciudad");

$campos_item["telefono"]=array(
    "tipo"=>"text"
,   "label"=>"Telefono");

$campos_item["email"]=array(
    "tipo"=>"text"
,   "label"=>"Email");

$campos_item["direccion"]=array(
    "tipo"=>"text"
,   "label"=>"Direccion");


//REPRESENTANTE LEGAL

$campos_item["representante_legal_nombre"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_nombre");

$campos_item["representante_legal_paterno"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_paterno");

$campos_item["representante_legal_materno"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_materno");

$campos_item["representante_legal_ci"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_ci");

$campos_item["representante_legal_ci_exp"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_ci_exp");

$campos_item["representante_legal_telefono"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_telefono");


$campos_item["ocasional_id"]=array(
    "tipo"=>"text"
,   "label"=>"ocasional_id");

//ENTIDADES PUBLICAS

$campos_item["representante_legal_cargo"]=array(
    "tipo"=>"text"
,   "label"=>"representante_legal_cargo");

$campos_item["telefono_fijo"]=array(
    "tipo"=>"text"
,   "label"=>"telefono_fijo");

$campos_item["tipo_institucion_id"]=array(
    "tipo"=>"text"
,   "label"=>"tipo_institucion_id");

$campos_item["tipo_institucion"]=array(
    "tipo"=>"text"
,   "label"=>"tipo_institucion");


$grupo = "general";
$campos[$grupo]= $campos_item;
unset($campos_item);
/**
 * Apartir de aca, puedes configurar otros campos
 */
