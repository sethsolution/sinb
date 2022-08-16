<?php
/**
 * db.php
 * Contiene la conexion a base de datos
 * mysql y postgresql del sistema
 */

   include_once("./lib/adodb/adodb.inc.php");
   include_once("./lib/adodb/tohtml.inc.php");
   global $db,$dbsig;
   $db = ADONewConnection($CFG->dbType);
   $db->setCharset('utf8');
   $res = $db->Connect($CFG->dbServer,$CFG->dbUser, $CFG->dbPassword, $CFG->dbDatabase);
   if(!$res){
      echo "<span style='color:red;font-family: Arial;'><strong>[Error]</strong> Connection</span>";
      print_struc($db->ErrorMsg());
      exit;
   }
   
   $db->SetFetchMode(ADODB_FETCH_ASSOC);
   if ($CFG->debug){
      $db->debug = true;
   }

