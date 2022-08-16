<?
/**
 * configuracion de conexion a base de datos del m�dulo
 */
global $dbm;

class confm{}

$CFGm = new confm;
$CFGm->dbType = "mysqli";
$CFGm->dbServer = $CFG->dbServer;
$CFGm->dbUser = $CFG->dbUser;
$CFGm->dbPassword = $CFG->dbPassword;
$CFGm->dbDatabase = "vrhr_snir";
$CFGm->prefix = "";
$CFGm->database = $CFGm->dbDatabase;

$dbm = ADONewConnection($CFGm->dbType);
$dbm->Connect($CFGm->dbServer,$CFGm->dbUser,$CFGm->dbPassword,$CFGm->dbDatabase);
$dbm->setCharset('utf8');
//$dbm->setCharset('utf8');
//$dbm->debug = true;