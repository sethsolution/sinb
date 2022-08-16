<?php
/**
 * configuración de conexión a base de datos del sub módulo
 */
$db_conf = array();
/**
 * configuraciòn de Conexion a base de datos de datatable,
 * este arreglo sera usado para las conexiones, para generar los json de la grilla
 */
$db_conf_datatable = array();
/**
 * Conexión a la base de datos del módulo
 */
$db_conf["type"]        = "mysqli";
$db_conf["server"]      = $CFG->dbServer;
$db_conf["user"]        = $CFG->dbUser;
$db_conf["password"]    = $CFG->dbPassword;
$db_conf["database"]    = $CFG->prefix."mmaya_personal";

$db_conf_datatable["principal"] = $db_conf;

$dbm = ADONewConnection($db_conf["type"]);
$dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
$dbm->setCharset('utf8');
$dbm->SetFetchMode(ADODB_FETCH_ASSOC);

/**
 * Conexión a otras bases de datos de ejemplo
 */

/**/
$db_conf["type"]        = "mysqli";
$db_conf["server"]      = $CFG->dbServer;
//$db_conf["server"]      = "codice.sirh.bo";
$db_conf["user"]        = $CFG->dbUser;
$db_conf["password"]    = $CFG->dbPassword;
$db_conf["database"]    = "codice_codice";

$db_conf_datatable["codice"] = $db_conf;

$dbm_codice = ADONewConnection($db_conf["type"]);
//$dbm_codice->debug = true;
$dbm_codice->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
$dbm_codice->SetFetchMode(ADODB_FETCH_ASSOC);
$dbm_codice->setCharset('utf8');
/**/

/**
 * Control de personal
 */
$db_conf["type"]        = "mysqli";
$db_conf["server"]      = $CFG->dbServer;
$db_conf["user"]        = $CFG->dbUser;
$db_conf["password"]    = $CFG->dbPassword;
$db_conf["database"]    = "personal_mmaya";

$db_conf_datatable["personal"] = $db_conf;

$dbm_personal = ADONewConnection($db_conf["type"]);
//$dbm_personal->debug = true;
$dbm_personal->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
$dbm_personal->SetFetchMode(ADODB_FETCH_ASSOC);
$dbm_personal->setCharset('utf8');

