<?
/**
 * Configuracion'
 * 
 * Classe que contiene la configuración general del sistema,
 * tambien se encuentra la configuración de la base datos
 * 
 * @package eva
 * @subpackage Configuracion   
 * @author seth.com.bo
 * @copyright Seth Solution
 * @version 2019
 * @access public
 */

class configuration{
    var $snir = false;
    
    var $session_name = "cites_publico";
    var $urlApp ="";
	var $data = "./../../dataFile/";
    
	var $compilerDir;

	var $smarty_template;
	var $smarty_config = "./config/";
    var $smarty_cache;

	var $template = "user";
	var $language = "es";

    var $homeSis = "./home/";
    /* Configuración de la base de datos */
	var $dbType         = "mysqli";
    var $dbServer       = "localhost";
    var $dbUser         = "root";
	var $dbPassword     = "";
    var $dbDatabase     = "cites";
	var $prefix     = "";
	var $idle_timeout	= "60"; //Tiempo de cierre de sesion
    /******************************/
    var $emailSys       = "contacto@seth.com.bo";
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
    /*
    var $dbTypeSig = "postgres";
    var $dbServerSig = "192.168.0.0";
    var $dbUserSig = "usuario";
    var $dbPasswordSig = "password";
    var $dbDatabaseSig = "basededatos";
    var $proyeccion = "4326";
    */
    
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
        
        $this->smarty_compiler = $this->data."template/".$this->template."/";
        $this->smarty_cache = $this->data."cache/";


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
}
/* Creación del Objeto de configuración */
global $CFG;
$CFG = new configuration;
