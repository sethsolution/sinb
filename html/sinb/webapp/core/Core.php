<?php
namespace Core;
use App\Models\User;
use App\Models\App;
use App\Models\AppGroup;
use App\Models\AppModule;
use App\Models\UserModule;
use function Symfony\Component\String\b;

class Core{

    public static function createDirectory($dir){
        if(!file_exists($dir)){$res= mkdir($dir, 0777);}
    }

    public static function getUserDirectory($id){
        if($id!=""){
            $userGruop = floor($id/1000);
            $dir = $_ENV['DATA_FILE']."users/".$userGruop."/".$id."/";
            if(!file_exists($dir)) {
                core::createDirectory($_ENV['DATA_FILE']."users/");
                core::createDirectory($_ENV['DATA_FILE']."users/".$userGruop."/");
                core::createDirectory($dir);
            }
        }else{
            $dir ="";
        }

        return $dir;
    }

    public static function getRoutePath(){
        $url = parse_url($_SERVER['REQUEST_URI']) ;
        $ruta = $url["path"];
        $ruta = explode('/',$ruta);
        foreach ($ruta as $key => $val){
            $ruta[$key] = trim(str_replace('%20','',$val));
        }
        return $ruta;
    }
    public static function getRouteVars(){
        $ruta = core::getRoutePath();
        if( !isset($ruta[1]) || $ruta[1]== "index.php" || $ruta[1]== ""){
            $app = "core";
        }else{
            $app =$ruta[1];
        }
        /**
         * Un Hack para ver si el segundo parametro es un numero
         * si es numero por defecto colocaremos index
         */

        if( !isset($ruta[2]) || $ruta[2]==""){
            $module = "index";
        }else{
            if(is_numeric($ruta[2])){
                $module = "index";
                $core_id = $ruta[2];
            }else{
                $module =$ruta[2];
            }
        }

        if( isset($ruta[3]) || $ruta[3] !="" ){
            $ruta_accion =$ruta[3];
            $ruta_id =$ruta[3];
        }

        if(count($ruta)>3){
            $variables  = array();
            for($i=3;$i<count($ruta);$i++){
                $variables[] = $ruta[$i];
            }
        }

        $res =array();
        $res["app"] = $app;
        $res["module"] = $module;
        $res["core_id"] = $core_id;
        $res["route_action"] = $ruta_accion;
        $res["vars"] = $variables;
        return $res;
    }

    public static function getIp(){
        global $_SERVER;
        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            $ipadd = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }else{
            $ipadd = $_SERVER["REMOTE_ADDR"];
        }
        return $ipadd;
    }

    public static function printJson($result){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');
        echo json_encode( $result, JSON_PRETTY_PRINT );
        exit;
    }
    /**
     * Telegram
     * ------------------------------------------------------------------------------------
     */
    public static function telegramSendmsgCore($text,$data=""){
        if(is_array($data)){
            /*
            $data = json_encode($data);
            $text .= ",  <b>JSON</b>: ".$data;
            */
            $string_log = "";
            foreach($data as $key => $row){
                $string_log .= $key." : ".$row." |";
            }
            $string_log .= "\r\n";
            $text .= ",  <b>[Info]</b> ".$string_log;
        }

        if($_ENV["TELEGRAM_ACTIVE"]){
            $response = Core::telegramSendMessage($_ENV["TELEGRAM_CHAT_ID"],$text,$_ENV["TELEGRAM_PARSE_MODE"]);
        }
    }

    public static function telegramSendMessage($chatId, $text,$parce_mode){
        $telegram = "https://api.telegram.org/bot".$_ENV["TELEGRAM_TOKEN"];
        $query = http_build_query(array(
            'chat_id'=> $chatId,
            'text'=> $text,
            'parse_mode'=> $parce_mode, // Optional: Markdown | HTML
        ));
        $url = $telegram."/sendMessage?".$query;
        $response = file_get_contents($url);
        return $response;
    }
    /**
     * Datos del Usuario
     */
    public static function getUserInfo($id){
        $user = User::find($id);
        return $user->toArray();
    }
    /**
     * Datos de la aplicación
     * -------------------------------------------------------------------------------------------
     */
    public static function getAppData($appSearh){
        if($appSearh!=""){
            $where = [
                ['folder', '=', $appSearh],
                ['active', '=', 'TRUE']
            ];
            $app = App::where($where)->get();
            if(count($app)==1){
                return $app[0]->toArray();
            }else{
                return array();
            }
        }else{
            return array();
        }
    }
    public static function getAppMenu($appData){

        $folder = $appData["folder"];
        $where = [
            ['app_id', '=', $appData["id"]],
            ['active', '=', 'TRUE']
        ];
        $appGroup = AppGroup::where($where)->orderBy('order','ASC')->get();

        $menu = array();
        foreach ($appGroup as $row){

            if($_SESSION["userv"]["type"]==0 || $_SESSION["userv"]["type"]==1)
            {
                $where = [
                    ['app_id', '=', $appData["id"]],
                    ['app_group_id', '=', $row->id],
                    ['active', '=', 'TRUE'],
                ];
                $appModule = AppModule::where($where)->orderBy('order','ASC')->get();
            }else{
                $where = [
                    ['core.app_module.app_id', '=', $appData["id"]]
                    ,  ['core.app_module.app_group_id', '=', $row->id]
                    ,  ['core.app_module.active', '=', 'TRUE']
                    ,  ['core.user_module.user_id', '=', $_SESSION["userv"]["id"]]
                ];
                $appModule = AppModule::select('core.app_module.id'
                    ,'core.app_module.app_id'
                    ,'core.app_module.name'
                    ,'core.app_module.description'
                    ,'core.app_module.active'
                    //,'core.app_module.app_group_id'
                    ,'core.app_module.order'
                    ,'core.app_module.target'
                    ,'core.app_module.class'
                    ,'core.app_module.type'
                    ,'core.app_module.folder'
                    ,'core.app_module.url'
                )
                    ->leftjoin('core.app','core.app_module.app_id','=','core.app.id')
                    ->leftjoin('core.user_module','core.user_module.app_module_id','=','core.app_module.id')
                    ->where($where)
                    ->get();
            }
            if(count($appModule)>0){
                $submenu = $appModule->toArray();
                foreach ($submenu as $key => $value){
                    $submenu[$key]["app_folder"] = $folder;
                }
                $appGroupArray = $row->toArray();
                $appGroupArray["submenu"] = $submenu;
                $menu[]=$appGroupArray;
            }
        }
        return $menu;
    }


    public static function getAppPrivileges($appData,$module,$menuPrincipal){
        $res["res"] = 0;
        /**
         * Sacamos los datos de la base de datos
         */
        if($_SESSION["userv"]["id"]>0){
            $_SESSION["userv"] = Core::getUserInfo($_SESSION["userv"]["id"]);

            if(!isset($_SESSION["userv"]["id"]) || $_SESSION["userv"]["id"]==''){
                $_SESSION["userv"]["id"]=0;
            }
            if($_SESSION["userv"]["type"] == 0 || $_SESSION["userv"]["type"] == 1){
                $res["res"] = 1;
                $res["admin"] = 1;
            }else{
                $res = Core::getAppPrivilegesUserModule($appData,$module);
                $res["admin"] = 0;
            }
            $res["userId"]= $_SESSION["userv"]["id"];
        }else{
            $res["res"]= 1;
            $res["admin"] = 0;
        }

        if($module=="index"){
            //verificamos si tiene acceso a otros módulos de la aplicación
            if(count($menuPrincipal)==0){
                $res["res"]= 0;
            }
        }
        return $res;
    }


    public static function getModuleDataUser($module,$appId){
        $where = [
            ['core.app_module.folder', '=', $module]
            ,  ['core.app_module.active', '=', 'TRUE']
            ,  ['core.app_module.app_id', '=', $appId]
            ,  ['core.user_module.user_id', '=', $_SESSION["userv"]["id"]]
        ];
        $appModule = AppModule::select('core.app_module.id'
            ,'core.app_module.name'
            /*
            ,'core.app_module.description'
            ,'core.app_module.active'
            ,'core.app_module.order'
            ,'core.app_module.target'
            ,'core.app_module.class'
            ,'core.app_module.type'
            ,'core.app_module.folder'
            ,'core.app_module.url'
            ,'core.user_module.app_module_id as priv'
            */
        )
            ->leftjoin('core.user_module','core.user_module.app_module_id','=','core.app_module.id')
            ->where($where)
            ->first();

        return $appModule;
    }

    function getUserModulePrivileges($id){
        $where = [
                ['user_id', '=', $_SESSION["userv"]["id"]]
            ,   ['app_module_id', '=', $id]
        ];
        $userModule = UserModule::where($where)->first();
        return $userModule->toArray();
    }

    public static function getAppPrivilegesUserModule($appData,$module){

        if ($module=="index") {
            $res = 1;
        }else{
            if($appData["id"]==''){
                $appId = 0;
            }else{
                $appId = $appData["id"];
            }

            $moduleData = core::getModuleDataUser($module,$appId);

            if($moduleData->id > 0){
                $res = 1;
                $resp["permission"] = core::getUserModulePrivileges($moduleData->id);
            }else{
                $res = 0;
            }
        }
        $resp["res"] = $res;
        return $resp;
    }

    /**
     *
     */
    public static function getAppMigaData($app,$module){
        $where = [['folder', '=', $app]];
        $app = App::where($where)->get();
        if(count($app)>0){
            $res["appData"] = $app[0]->toArray();
            if($module!="index"){
                $where = [
                    ['folder','=',$module],
                    ['app_id','=',$res["appData"]["id"] ]
                ];
                $appModule = AppModule::where($where)->get();
                if(isset($appModule[0]->app_group_id)){
                    $appGroup = AppGroup::find($appModule[0]->app_group_id);
                    $res["appModuleData"] = $appModule[0]->toArray();
                    $res["appGroupData"] = $appGroup->toArray();;
                }
            }
        }
        return $res;
    }

    /**
     * Para manejar las referencias de la base de datos
     * --------------------------------------------------------------------------------------------
     */

    public static function getTableConfig($table_name,$delete_prefix="",$new_name=""){
        $res = array();
        $alias = $table_name;
        if($delete_prefix !="") $alias = str_replace($delete_prefix,"",$alias);
        if($new_name!="") $alias=$new_name;
        $res["alias"] = $alias;
        $res["table"] = $table_name;
        return $res;
    }

    public static function getDbTablesFromArray($db_table,$schemaName="",$tableList="",$prefixName=""){
        $res = array();
        $schemaName = trim($schemaName);

        $schemaName_str = "";
        if($schemaName!=""){ $schemaName_str = $schemaName."."; }
        $prefixName_str = "";
        if($prefixName!=""){ $prefixName_str = $prefixName."."; }

        foreach ($db_table as $valor) {
            if( isset($valor["alias"]) and isset($valor["table"]) ){
                if($prefixName!="" and $prefixName !="o" and $prefixName!="c"){
                    $valor["alias"] = $prefixName."_" .$valor["alias"];
                    $valor["table"] = $schemaName.".".$valor["table"];
                }else{
                    $valor["alias"] = $prefixName_str.$valor["alias"];
                    $valor["table"] = $schemaName_str.$valor["table"];
                }
                $res[$valor["alias"]] = $valor["table"];
            }
        }

        if(is_array($tableList)){
            $res = array_merge($tableList,$res);
        }
        return $res;
    }
    /**
     * Idiomas
     */
    public static function setLenguage($section):void{
        global $languageSbm,$smarty;
        if(file_exists($languageSbm))$smarty->configLoad($languageSbm,$section);
    }
    /**
     * Devolvemos si una aplicaciones se puede acceder o no al sistema
     */
    public static function getAppOk($app){
        global $smarty,$privFace;
        $appOk = 0;
        $appAuth = 0;
        if($app!="core" && $app!="login") {
            $appData = Core::getAppData($app);

            if($appData["id"]){ //Si es verdadero, la aplicación existe
                /**
                 * si es  un módulo del core, necesita saber si esta con una sessión iniciada
                 */
                if (  ($appData["admin"]==1  || $appData["private"]==1 ) && ($appData["type"]=="app")   ){
                    if ( isset($_SESSION["auth"]) and $_SESSION["auth"] == 1) $appAuth = 1;
                }else{ // Si existe la aplicación y tiene privilegios de público, se podra ingresar
                    $appAuth = 1;
                }
                $appOk = 1;
                /**
                 * Otros
                 */
                $menu_modulo_principal = Core::getAppMenu($appData);

                $smarty->assign("menu_modulo_principal",$menu_modulo_principal);
                //d($menu_modulo_principal);
                /**
                 * Sacamos los permisos del usuario
                 */
                $privSM = Core::getAppPrivileges($appData,APP_MODULE,$menu_modulo_principal);

                if($privSM["res"] == 0){
                    $appAuth = 0;
                }
                /**
                 * Asignamos permisos a los usuarios
                 */
                if ($privSM["admin"]==0 && isset($privSM["permission"]) && $privSM["permission"]["edit"]==0){
                    $privFace["checkbox"] = " disabled='true' ";
                    $privFace["input"] = " disabled='true' ";
                    $privFace["edit"] = false;
                }else{
                    $privFace["edit"] = true;
                }

                if ($privSM["admin"]==0 && isset($privSM["permission"]) && $privSM["permission"]["delete"]==0){
                    $privFace["delete"] = false;
                }else{
                    $privFace["delete"] = true;
                }
                if ($privSM["admin"]==0 && isset($privSM["permission"]) && $privSM["permission"]["add"]==0){
                    $privFace["add"] = false;
                }else{
                    $privFace["add"] = true;
                }

                $smarty->assign("privFace",$privFace);
                $smarty->assign("privSM",$privSM);

            }

        }else{
            $appOk = 1;
            $appAuth = 1;
        }

        $res = 0;
        if($appOk==0){
            $res = 0;
        }else{
            if($appAuth==0){
                $res = 2;
            }else{
                $res = 1;
            }
        }

        return $res;
    }

}
