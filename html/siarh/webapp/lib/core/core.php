<?php
 /**
  * This file contain the core classes
  * 
  * This file contains the core classes, with all the tools for system.
  * if you need to implement more useful method for the system must be implemented
  * in this file and within the class core
  * 
  * @package Core
  */
 /**
  * Core. Set of tools for system
  * 
  * Create: <b>01/06/2009</b>. <br>
  * This class contains several useful<br/>
  * features when using the system.<br/>
  * 
  * @package Auction
  * @subpackage Core   
  * @author SethSolution
  * @copyright SethSolution
  * @version 201
  */
 class core{
     var $tabla;
     function __construct()
     {

     }

     function cargar_tablas($tabla){
         $this->tabla = $tabla;
     }

     function getIp(){
        global $_SERVER;
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $ipadd = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }else{
            $ipadd = $_SERVER["REMOTE_ADDR"];
        }
        return $ipadd;
    }
 	/**
 	 * core::printStruc()
 	 * 
 	 * Prints on display the contents of an array
 	 * 
 	 * @param array $obj the array to be printed on the screen
 	 * @return void
 	 */
 	function printStruc($obj){
 		echo("<pre>");
		print_r($obj);
		echo("</pre>");
 	}
 	
    /**
     * core::zpLog()
     * 
     * @param string $accion
     * @param string $module
     * @param integer $id
     * @param string $submodule
     * @param string $usr
     * @return void
     */
    function addLog($accion,$module=null,$id=null,$submodule=null,$usr=null){
        global $db,$CFG;
        $record = array();
        $record["dateTime"] = date('Y-m-d H:i:s');
        $record["ip"] = $_SERVER["REMOTE_ADDR"];
        $record["module"] = $module;
        $record["action"] = $accion;
        $record["code"] = $id;
        if($usr==null){
        	$record["user"] = $_SESSION["userv"]["user"];
        }else{
        	$record["user"] = $usr;
        }
        
        $record["agent"] = $_SERVER["HTTP_USER_AGENT"];
        $record["submodule"] = $submodule;
        $db->AutoExecute($this->tabla["logs"],$record);
    }

 	/**
 	 * core::transCode()
 	 * 
 	 * encodes the string for display as html
 	 * 
 	 * @param string $str string html cofificar
 	 * @return string html encrypted string
 	 */
 	function transCode($str){
		$str =  htmlspecialchars(stripslashes($str));
		return $str;
	}
	
	/**
	 * core::writeLog()
	 * 
	 * writes a log file. 
	 * Must first set the object $cfg variable debugFileLogo and set <b>True</b> debugFile varible.<br>
	 * Exampel to use:<br>
	 * $core->writeLog("This is an example",basename(__FILE__)." line:".__LINE__);<br>	
	 * 
	 * @global object $CFG object have configuration parameters
	 * @param mixed $output string or array that will be printed in the log file
	 * @param string $line_file_info file information and line of execution
	 * @param integer $title 1 if you want to print as title
	 * @return void
	 */
	function writeLog($output,$file="",$line="",$title=0){
		global $CFG;

		if(is_array($output)) $output = print_r($output,true);
		if(is_object($output)) $output = print_r($output,true);

		if ($CFG->debugFile){
			if ($title==0){
				$string_log = date("d/m/Y H:i:s")." ".$_SERVER["REMOTE_ADDR"]." ".basename($file)." Line:".$line." $output\n";
			}else if($title==1){
				$string_log = "=============================================================\n";
				$string_log .=	 $line_file_info;
				$string_log .= "\n=============================================================\n";
			}
			error_log($string_log, 3,$CFG->debugFileLogManager);
		}
	}
	
    function errordb_log($type = "",$output,$file="",$line=""){
        global $CFG;
        if ($type=="")$type = "nodb";
        //$string_log = date("d/m/Y H:i:s")." ".$_SERVER["REMOTE_ADDR"]." [".$type."] ".basename($file)." Line:".$line." $output\n";
        $string_log = date("d/m/Y H:i:s")." ".$_SERVER["REMOTE_ADDR"]." [".$type."] ".$file." Line:".$line." $output\n";
        error_log($string_log, 3,$CFG->errordb_log);
    }
	/**
	 * core::roundedTwoDecimal()
	 * 
	 * Rounded two decimal
	 * 
	 * @param float $val decimal number to be rounded to 2 decimal places
	 * @return float 
	 */
	function roundedTwoDecimal($val){ 
		$result=round($val*100)/100;
		return $result; 
	}
	
	
	/**
	 * core::parseToXML()
	 * 
	 * clean string that are not allowed in xml
	 * 
	 * @param string $htmlStr
	 * @return string clean string to be printed as a parameter in xml
	 */
	function parseToXML($htmlStr){
		$xmlStr=str_replace('<','&lt;',$htmlStr);
		$xmlStr=str_replace('>','&gt;',$xmlStr);
		$xmlStr=str_replace('"','&quot;',$xmlStr);
		$xmlStr=str_replace("'",'&#39;',$xmlStr);
		$xmlStr=str_replace("&",'&amp;',$xmlStr);
		return $xmlStr;
	}
	/**
	 * core::SortDataSet()
	 * 
	 * form an ordered array desendente or asendente through a field of meaning
	 * 
	 * @param array $aArray array you want to order
	 * @param string $sField field in which you want to order
	 * @param bool $bDescending True asenden asending, false desending
	 * @return array orderly arrangement
	 */
	function SortDataSet($aArray, $sField, $bDescending = false){
    	$bIsNumeric = $this->IsNumeric($aArray);
    	$aKeys = array_keys($aArray);
    	$nSize = sizeof($aArray);
    	for ($nIndex = 0; $nIndex < $nSize - 1; $nIndex++){
	        $nMinIndex = $nIndex;
	        $objMinValue = $aArray[$aKeys[$nIndex]][$sField];
	        $sKey = $aKeys[$nIndex];
     	   for ($nSortIndex = $nIndex + 1; $nSortIndex < $nSize; ++$nSortIndex){
	            if ($aArray[$aKeys[$nSortIndex]][$sField] < $objMinValue){
	                $nMinIndex = $nSortIndex;
	                $sKey = $aKeys[$nSortIndex];
	                $objMinValue = $aArray[$aKeys[$nSortIndex]][$sField];
	            }
    	    }
    	    $aKeys[$nMinIndex] = $aKeys[$nIndex];
	        $aKeys[$nIndex] = $sKey;
    	}
    	$aReturn = array();
    	for($nSortIndex = 0; $nSortIndex < $nSize; ++$nSortIndex){
        	$nIndex = $bDescending ? $nSize - $nSortIndex - 1: $nSortIndex;
        	$aReturn[$aKeys[$nIndex]] = $aArray[$aKeys[$nIndex]];
    	}
	    return $bIsNumeric ? array_values($aReturn) : $aReturn;
	}
	
	/**
	 * core::IsNumeric()
	 * 
	 * sked whether the arrangement is numerical
	 * 
	 * @param array $aArray array being verified
	 * @return boolean true if is numeric
	 */
	function IsNumeric($aArray){
    	$aKeys = array_keys($aArray);
    	for ($nIndex = 0; $nIndex < sizeof($aKeys); $nIndex++){
        	if (!is_int($aKeys[$nIndex]) || ($aKeys[$nIndex] != $nIndex)){
            	return false;
        	}
    	}
	    return true;
	}
    
    function getMonth($month){
        $monthList = $this->getArrayMonth();
        return $monthList[$month];
 	}

 	function getArrayMonth()
 	{
 		$meses[1] = "Enero";
 		$meses[2] = "Febrero";
 		$meses[3] = "Marzo";
 		$meses[4] = "Abril";
 		$meses[5] = "Mayo";
 		$meses[6] = "Junio";
 		$meses[7] = "Julio";
 		$meses[8] = "Agosto";
 		$meses[9] = "Septiembre";
 		$meses[10] = "Octubre";
 		$meses[11] = "Noviembre";
 		$meses[12] = "Diciembre";
 		return $meses;
 	} 

     function getSModulePrivileges($module,$smodule){
        global $_SESSION;
        //echo $module.": ".$smodule."||<br>";
        $res["res"] = 0;
        //Usuario Root = 0 , Administrador = 1
        //print_struc($_SESSION["userv"]);
        if( $_SESSION["userv"]["tipoUsuario"] == 0 || $_SESSION["userv"]["tipoUsuario"] == 1){
            $res["res"] = 1;
            $res["admin"] = 1;
           
        //Usuario Normal = 3
        //}else if ( $_SESSION["userv"]["tipoUsuario"] == 2 ){
        }else{
            $res = $this->getSModulePrivilegesUser($module,$smodule);
            $res["admin"] = 0;
        }
         $res["userId"]= $_SESSION["userv"]["itemId"];
        //print_struc($res);exit;
        return $res;
        
    }

    public function get_datos_miga($module,$smodule){
	    global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);

	    /*
	     * Sacamos datos del modulo
	     */
        $sql = "select * from  ".$this->tabla["modulo"]." as m where m.carpeta ='".$module."' ";
        $modulo =  $db->Execute($sql);
        $modulo = $modulo->fields;

        /*
         * Sacamos datos del submódulo
         */
        $sql = "select * from  ".$this->tabla["submodulo"]." as sm where sm.carpeta ='".$smodule."' and sm.moduloId='".$modulo["itemId"]."' ";
        $smodulo =  $db->Execute($sql);
        $smodulo = $smodulo->fields;
        /**
         * Sacamos el padre del sub módulo
         */
        $sql = "select * from ".$this->tabla["submodulo"]." as sm where sm.itemId = '".$smodulo["parent"]."' ";

        $padre =  $db->Execute($sql);
        $padre = $padre->fields;



        $res = array();
        $res["modulo"] = $modulo;
        $res["smodulo"] = $smodulo;
        $res["padre"] = $padre;
        //print_struc($res);exit;
        return $res;
    }
    
    function getUsuarioInfo($id){
        global $db;
        $sql = "select 
        u.usuario
        , u.ingresos,u.ingresos_fallidos
        ,p.* 
        from  ".$this->tabla["usuario"]." as u   
        left join ".$this->tabla["o_persona"]." as p on p.itemId=u.persona_id
         where u.itemId ='".$id."' ";
        //echo $sql;exit;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item =  $db->Execute($sql);
        //print_struc($item->fields);exit;
        return $item->fields;
    }

     /**
      * Datos del subsistema antes de iniciar cualquiera de los módulos
      */

     public function get_subsistema_data($module){
         global $db;
         $sql = "select * from  ".$this->tabla["modulo"]." as u where u.carpeta ='".$module."' and activo = 1 ";
         $db->SetFetchMode(ADODB_FETCH_ASSOC);
         $item =  $db->Execute($sql);
         return $item->fields;
     }
    
       function getSModulePrivilegesUser($module,$smodule){
        global $core,$_SESSION;
        $moduleData = $this->getModuleId($module);
        //print_struc($moduleData);
        if ($moduleData["itemId"]==''){
            $moduleId = 0;
        }else{
            $moduleId = $moduleData["itemId"];
        }
        $smoduleData = $this->getSmoduleId($smodule,$moduleId);
        //print_struc($smoduleData);
        
        $resp = array();
        
        
        if ( ($module=="inventory") && !isset($smoduleData['priv'])){
            $smoduleData['priv'] = 1;
        }
        if ($smoduleData['priv'] == 0){
            $res = 0;
        }else{
            $res = 1;
            /**
            * en caso de tener acceso al módulo recogeremos
            * el tipo de acceo que tiene
            */
            $resp["permiso"] = $this->getUserSubModulePrivileges($smoduleData["itemId"]);
        }
        $resp["res"] = $res;
        //print_struc($resp);
        
        return $resp;
    }
   function getUserSubModulePrivileges($smodule){
        global $db;
        $sql = "select * from ".$this->tabla["usuario_permisos"]." as up
                where up.usuarioId=".$_SESSION["userv"]["itemId"]."
                and up.subModuloId='".$smodule."' ";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $item = $db->Execute($sql);
        return $item->fields;
    }
    function getModuleId($module){
        global $db;
        $sql = "select * from ".$this->tabla["modulo"]." where carpeta = '".$module."'";
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$item = $db->Execute($sql);	
		return $item->fields;
    }
    
    function getSmoduleId($smodule,$id){
        global $db,$_SESSION;
        $sql = "select 
                ifnull(
                    (
                    select  up.subModuloId from ".$this->tabla["usuario_permisos"]." as up 
                    where up.subModuloId = sm.itemId 
                    and up.usuarioId=".$_SESSION["userv"]["itemId"]."
                    )
                    ,0
                ) as priv,sm.*
                
                from ".$this->tabla["submodulo"]." as sm 
                where sm.carpeta='".$smodule."'  
                and sm.parent!=0  
                and activo=1 
                and sm.moduloId=".$id;

        $db->SetFetchMode(ADODB_FETCH_ASSOC);
		$item = $db->Execute($sql);	
		return $item->fields;
    }

     /**
      * core::db_tableConvert()
      * Convierte un arreglo en formato para utilizar en query SQL
      *
      * @param array $tablas
      * @param string $tipo
      * @param string $dbname
      * @param string $prefijo
      *
      * @return array
      */
    function db_tableConvert($tablas,$tipo="",$dbname="",$prefijo="",$borra_en_nombre=""){
        $res = array();
        foreach ($tablas as $valor) {
            if ($tipo == "c") { //catalogo
                $name = "c_" . $valor;
                $table = "catalogo_" . $valor;
            }elseif($tipo=="o"){
                if($prefijo<>""){
                    $valor = $prefijo."_".$valor;
                }
                $name = "o_" .$valor;
                $table = $dbname.".".$valor;
            }else{
                $name = $valor;
                $table = $valor;
            }
            if($borra_en_nombre !="") $name = str_replace($borra_en_nombre,"",$name);


            $res[$name] = $table;
        }
        return $res;
    }

    function get_tablas_from_array($tablas,$tipo,$dbname){
        $res = array();
        foreach ($tablas as $valor) {
            //print_struc($valor);
            if( isset($valor["alias"]) and isset($valor["tabla"]) ){
                if ($tipo == "c") { //catalogo
                    $valor["alias"] = "c_" . $valor["alias"];
                    $valor["tabla"] = "catalogo_" . $valor["tabla"];
                }elseif($tipo=="o"){
                    $valor["alias"] = "o_" .$valor["alias"];
                    $valor["tabla"] = $dbname.".".$valor["tabla"];
                }elseif($tipo!="" and $tipo !="o" and $tipo!="c"){
                    $valor["alias"] = $tipo."_" .$valor["alias"];
                    $valor["tabla"] = $dbname.".".$valor["tabla"];
                }
                $res[$valor["alias"]] = $valor["tabla"];
            }
        }


        return $res;
    }


    function get_alias_campo($campo,$borrar_prefijo="",$nuevo_nombre=""){
        $res = array();
        $alias = $campo;
        if($borrar_prefijo !="") $alias = str_replace($borrar_prefijo,"",$alias);
        if($nuevo_nombre!="") $alias=$nuevo_nombre;
        $res["alias"] = $alias;
        $res["tabla"] = $campo;
        return $res;

    }

    public function directorio_crear($dir){
         if(!file_exists($dir)){$res= mkdir($dir, 0777);}
    }

    /**
     * Generamos el arreglo de menu de cada uno de los módulos
     */
     public function get_module_menu($id){
         global $db;

         $db->SetFetchMode(ADODB_FETCH_ASSOC);
         /*
          * Sacamos datos del modulo
          */
         $sql = "select * from ".$this->tabla["submodulo"]." as sm where sm.moduloId = '".$id."' and sm.parent=0 and sm.principal=0 and sm.activo=1 order by sm.orden";
         $modulo =  $db->Execute($sql);
         $modulo = $modulo->getRows();

         $menu = array();
         foreach ($modulo as $row){



             //print_struc($_SESSION["userv"]);
             if($_SESSION["userv"]["tipoUsuario"]==0 || $_SESSION["userv"]["tipoUsuario"]==1){
                 $sql = "select m.carpeta as modulo_id_tipo_carpeta
                    , sb.carpeta as submodulo_id_carpeta
                    , m2.carpeta as submodulo_id_carpeta_padre
                    ,sm.*
                    
                    from ".$this->tabla["submodulo"]." as sm 
                    
                    left join ".$this->tabla["modulo"]."  as m on m.itemId = sm.modulo_id_tipo
                    left join ".$this->tabla["submodulo"]."  as sb on sb.itemId = sm.submodulo_id
                    left join ".$this->tabla["modulo"]." as m2 on m2.itemId = sb.moduloId 

                    where sm.moduloId = '".$id."' 
                    and sm.parent='".$row["itemId"]."' 
                    and sm.principal=0 and sm.activo=1 order by sm.orden";
             }else{


                 $sql = "select m.carpeta as modulo_id_tipo_carpeta
                    , sb.carpeta as submodulo_id_carpeta
                    , m2.carpeta as submodulo_id_carpeta_padre
                    ,sm.*
                    
                    from ".$this->tabla["submodulo"]." as sm 
                    
                    left join ".$this->tabla["modulo"]."  as m on m.itemId = sm.modulo_id_tipo
                    left join ".$this->tabla["submodulo"]."  as sb on sb.itemId = sm.submodulo_id
                    left join ".$this->tabla["modulo"]." as m2 on m2.itemId = sb.moduloId 

                    join ".$this->tabla["usuario_permisos"]." as up on up.subModuloId = sm.itemId
                    
                    where sm.moduloId = '".$id."' 
                    and sm.parent='".$row["itemId"]."' 
                    and sm.principal=0 and sm.activo=1 
                    and up.usuarioId = '".$_SESSION["userv"]["itemId"]."'
                    order by sm.orden";

             }
             //print_struc($this->tabla);
             //echo $sql;exit;

             //$sql = "select * from ".$this->tabla["submodulo"]." as sm where sm.moduloId = '".$id."' and sm.parent='".$row["itemId"]."' and sm.principal=0 and sm.activo=1 order by sm.orden";

             $child =  $db->Execute($sql);
             $child = $child->getRows();

             $row["submenu"] = $child;
             //echo count($child); exit;
             if(count($child)>0){
                $menu[]=$row;
             }
         }

         //print_struc($menu);exit;
         return($menu);

     }


   public function print_json($result){
       header('Content-Type: application/json');
       header('Access-Control-Allow-Origin: *');
       header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
       header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

       echo json_encode( $result, JSON_PRETTY_PRINT );
       exit;
   }

     /**
      * --------------------------------------------------------------------------------------------------------------------------------------------
      * Telegram
      * --------------------------------------------------------------------------------------------------------------------------------------------
      */

     public function telegram_sendmsg_core($text,$data="")
     {
         global $CFG;

         if(is_array($data)){
             /* /
             $data = json_encode($data);
             $text .= ",  <b>JSON</b>: ".$data;
             /**/
             $string_log = "";
             foreach($data as $key => $row){
                 $string_log .= $key." : ".$row."|";
             }
             $string_log .= "\r\n";
             $text .= ",  <b>[Datos]</b> ".$string_log;

         }

         //echo $text;
         if($CFG->telegram["activo"]){
             $response = $this->telegram_sendMessage($CFG->telegram["chat_id"],$text,$CFG->telegram["parse_mode"]);
         }
         //return $response;
     }

     public function telegram_sendMessage($chatId, $text,$parce_mode)
     {
         global $CFG;

         //date_default_timezone_set("America/La_Paz");
         date_default_timezone_set("America/Adak");


         $TOKEN = $CFG->telegram["token"];
         //$TELEGRAM = "https://api.telegram.org:443/bot$TOKEN";
         $TELEGRAM = "https://api.telegram.org/bot$TOKEN";

         $query = http_build_query(array(
             'chat_id'=> $chatId,
             'text'=> $text,
             'parse_mode'=> $parce_mode, // Optional: Markdown | HTML
         ));

         $datos_envia = "$TELEGRAM/sendMessage?$query";
         //echo $datos_envia;
         $response = file_get_contents("$TELEGRAM/sendMessage?$query");
         //print_struc($response);
         return $response;
     }


     function telegram_log_modulo($texto = "")
     {
         global $core,$CFG;
         if($CFG->telegram["log_modulo"]==true){
             $record = array();
             // $record["usuario"] = $user;
             $record["ip"] = $this->getIp();
             $record["Fecha"] = date('Y-m-d H:i:s');
             $core->telegram_sendmsg_core($texto, $record);
         }

     }
}