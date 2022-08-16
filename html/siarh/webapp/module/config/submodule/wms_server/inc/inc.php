<?
/**
 * configuracion de conexion a base de datos del módulo
 */
global $dbm;

class confm{}

$CFGm = new confm;
$CFGm->dbType = "mysqli";
$CFGm->dbServer = $CFG->dbServer;
$CFGm->dbUser = $CFG->dbUser;
$CFGm->dbPassword = $CFG->dbPassword;
$CFGm->dbDatabase = "vrhr_sig";
$CFGm->prefix = "";

$dbm = ADONewConnection($CFGm->dbType);
$dbm->Connect($CFGm->dbServer,$CFGm->dbUser,$CFGm->dbPassword,$CFGm->dbDatabase);
