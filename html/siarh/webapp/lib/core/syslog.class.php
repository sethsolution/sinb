<?
/**
 * Statistics
 * 
 * @package SAIG
 * @author sethsolution
 * @copyright 2012
 * @version $Id$
 * @access public
 */
class SysLog{
    var $folder;
    var $year;
    var $month;
    var $day;
    var $nameStart;
    
    public function __construct() {
        global $CFG;
        $this->folder = $CFG->logSysDir;
        $this->year = date("Y");
        $this->month = date("m");
        $this->day = date("d");
        $this->nameStart = date("Ymd");
    }
    function createLogFolder($modulo,$submodulo){
        $folder = $this->folder;
        $folder .= $modulo."/";
        $this->viewDirectory($folder);
        $folder .= $submodulo."/";
        $this->viewDirectory($folder);
        $folder .= $this->year."/";
        $this->viewDirectory($folder);        
        $folder .= $this->month."/";
        $this->viewDirectory($folder);
        return $folder;
    }
    
    /**
     * statistics:writeLogSys()
     * 
     * Escribe un archivo de log, de las acciones de los usuarios.
     * 1: Logs de acceso al sistema, login
     * 
     */
	function writeLog($tipo,$accion,$respuesta,$datos="",$datosAntes = "",$tabla,$idDato="0" ){
	   global $_SERVER,$core,$CFG,$db;
        $fecha = date("Y-m-d H:i:s");        
        $ipadd = $core->getIp();
        switch($tipo){
            case "login": //Login
                $file = $this->nameStart."-login.log";
                $modulo = "core";
                $submodulo = "login";
                if($respuesta =="error"){
                    $usuarioErro = $datos["usuario"];

                    $sql = "select * from ".$CFG->tabla["usuario"]." as u where u.usuario='".$usuarioErro."'";
                    $info = $db->Execute($sql);
                    $info =$info->fields;
                    if($info["itemId"]){
                        $_SESSION["userv"]["itemId"] = $info["itemId"];
                    }
                }




            break;
            default:
            break;
        }
        $folder = $this->createLogFolder($modulo,$submodulo);
        $logFile = $folder.$file;
        /**
         * Guardamos en la Base de Datos
         */
        $rec = array();
        $rec["dateCreate"] = $fecha;
        $rec["ip"] = $ipadd;
        $rec["modulo"] = $modulo;
        $rec["submodulo"] = $submodulo;
        $rec["accion"] = $accion;
        $rec["respuesta"] = $respuesta;
        
        $dat = array();
        $dat["datos"] =  $datos;
        $rec["detalle"] = json_encode($dat);


        $rec["usuarioId"] = (isset($_SESSION["userv"]["itemId"]))? $_SESSION["userv"]["itemId"]:'0';

        $rec["agent"] = $_SERVER["HTTP_USER_AGENT"];
        
        if(isset($_SESSION["userv"]["usuario"])) $rec["usuario"] = $_SESSION["userv"]["usuario"];
        if(isset($usuarioErro)) $rec["usuario"] = $usuarioErro;
        
        $rec["tabla"] = $tabla;
        $rec["idDato"] = $idDato;
        //if($idDato!="") $rec["idDato"] = $idDato;

        //print_struc($rec);exit;
        $this->dbLog($rec);
        /**
         * Creamos Archivo de Logs
         */
        $this->writelogFile($rec,$logFile);
    }
    function writelogFile($data,$logFile){
        $string_log = "";

        foreach($data as $row){
            $string_log .= $row."|";
        }
        $string_log .= "\r\n";
        error_log($string_log, 3,$logFile);
    }
    /**
     * core: viewDirectory()
     * 
     * Verificamos si existe un directorio, si no existe el sistema crea
     * 
     * @param varchar $dir
	 * @return void
     */
     
    function viewDirectory($dir){
		if(!file_exists($dir)){	mkdir($dir, 0777);}
	}
    
    function dbLog($rec){
        global $db,$CFG;
        //$db->debug = true;
        $db->AutoExecute("core_logs",$rec);
    }
}
?>