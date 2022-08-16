<?
/**
 * Configuracion'
 * 
 * Classe que contiene la configuraci�n general del sistema,
 * tambien se encuentra la configuraci�n de la base datos
 * 
 * @package sysvrhr
 * @subpackage Configuracion   
 * @author SethSolution
 * @copyright SethSolution
 * @version 2012
 * @access public
 */

class configuration{
    var $snir = false;
    
    var $session_name = "vrhr_sirh";
    var $urlApp ="";
	var $data = "./../../dataFile/";
    
	var $compilerDir;

    var $smarty_template;
    var $smarty_config = "./config/";
    var $smarty_cache;

    //var $cacheDir;
	//var $templateDir =  "./template/";
	//var $langDir = "./lang/";

	var $template = "user";
	var $language = "es";

    var $homeSis = "./home/";
    /* Configuración de la base de datos */
	var $dbType         = "mysqli";
    var $dbServer       = "localhost";
    var $dbUser         = "root";
	var $dbPassword     = "";
    var $dbDatabase     = "vrhr_snir";
	var $prefix     = "seth_"; //Prefijo de base de datos a ser utilizado, si que tuviera
	var $idle_timeout	= "60"; //Tiempo de cierre de sesion
    /******************************/
    var $emailSys       = "it@sethsolutino.com";
    var $emailSysName   = "Administrador de Sistema";
    var $paginationNum  = 20;
    var $dbcode         = "ISO-8859-1";
    var $smscSysShortCode = "959";
    /**
    * Log de sistema en archivo
    */
    var $logSysDir;
    var $debug = false;
    var $debugSmarty = false;
    var $debugFile = true;
    var $debugFileLog = "";
    
    var $dbTypeSig = "postgres";
    var $dbServerSig = "192.168.5.105";
    var $dbUserSig = "snir";
    var $dbPasswordSig = "9D3cD1p";
    var $dbDatabaseSig = "vrhr_sig";
    var $proyeccion = "4326";
    
    var $errordb_log;
    /**
     * Item por directorio para almacenamiento
     */
    var $itemDir = 250;
    function __construct(){
        global $dbType, $dbServer, $dbUser, $dbPassword, $dbDatabase, $prefix,$dataFile;
        /**
         * dirección de la carpeta de archivos
         */
        $this->data = $dataFile;

        $this->logSysDir = $this->data;
        
        $this->debugFileLogManager =$this->logSysDir."debugManager.log";
        $this->errordb_log = $this->logSysDir."errordb.log";
        
        //$this->compilerDir = $this->data."template/";
        //$this->cacheDir = $this->data."cache/";
        $this->smarty_compiler = $this->data."template/".$this->template."/";
        $this->smarty_cache = $this->data."cache/";
        $this->smarty_template =  "./template/".$this->template."/";
        /**
         * Conexión a la base de datos y prefijo de conexión
         */
        $this->dbType         = $dbType;
        $this->dbServer       = $dbServer;
        $this->dbUser         = $dbUser;
        $this->dbPassword     = $dbPassword;
        $this->dbDatabase     = $dbDatabase;
        $this->prefix     = $prefix;


    }
    
    var $situacionGlobal = "2,3,4";
    /**
     * Bandera de control de regisrto en la B.D. de posgresql
     **/
    var $bPosgresql = false;
}
/* Creación del Objeto de configuración */
global $CFG;
$CFG = new configuration;