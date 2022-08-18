<?php
use Illuminate\Database\Capsule\Manager as Capsule;
use Core\Core;

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => $_ENV["DB_CONNECTION"],
    'host' => $_ENV["DB_HOST"],
    'database' => $_ENV["DB_DATABASE"],
    'username' => $_ENV["DB_USERNAME"],
    'password' => $_ENV["DB_PASSWORD"],
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);
// Set the event dispatcher used by Eloquent models... (optional)
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;
$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

//$usuarios = $capsule::table('core.user')->get();
//$usuarios = $capsule::table('core.user')->where('id','=',2)->get();
//d($usuarios);
//echo $usuarios[0]->name;

/**
 * Configuración de antigua forma de conexión a db por phpAdoDB
 */

/**
 * Configuración con PHPADODB
 */
$dsn  = $_ENV["DB_CONNECTION"].':host='.$_ENV["DB_HOST"].';dbname='.$_ENV["DB_DATABASE"].';port='.$_ENV["DB_PORT"] ;

$db = newAdoConnection('pdo');
$db->setCharset('utf8');
$res = $db->connect($dsn,$_ENV["DB_USERNAME"],$_ENV["DB_PASSWORD"]);
if(!$res){
    echo "<span style='color:red;font-family: Arial;'><strong>[Error]</strong> Connection</span>";
    print_struc($db->ErrorMsg());
    exit;
}
$db->SetFetchMode(ADODB_FETCH_ASSOC);
$ADODB_QUOTE_FIELDNAMES = 'NATIVE';
/*
if ($CFG->debug){
    $db->debug = true;
}
*/

/**
 * Configuración para la antigua forma de usar base de datos
 */
$coreDB =[
    "type" =>$_ENV["DB_CONNECTION"],
    "server" => $_ENV["DB_HOST"],
    "user"=> $_ENV["DB_USERNAME"],
    "password" => $_ENV["DB_PASSWORD"],
    "database" => $_ENV["DB_DATABASE"],
    "port" => $_ENV["DB_PORT"],
    "schema" => $_ENV["DB_SCHEMA"],
];

/**
 * Tablas de información principal, configuración de los objetos principales
 */

$db_prefix = "";
$dbSchemaName = $coreDB["schema"];
$db_table = array();
$db_table[] = Core::getTableConfig("app");
$db_table[] = Core::getTableConfig("app_group");
$db_table[] = Core::getTableConfig("app_module");
$db_table[] = Core::getTableConfig("config");
$db_table[] = Core::getTableConfig("group");
$db_table[] = Core::getTableConfig("logs");
$db_table[] = Core::getTableConfig("user");
$db_table[] = Core::getTableConfig("user_module");

$tableCore = Core::getDbTablesFromArray($db_table,$dbSchemaName);
unset($db_table);
unset($db_prefix);
