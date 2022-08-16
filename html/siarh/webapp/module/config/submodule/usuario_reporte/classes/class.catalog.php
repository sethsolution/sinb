<?php
class Catalogo extends Table{
    var $table01;
    var $table02;
	function __construct(){
       global $CFGcatalogo,$CFG, $dbm;
       
       $this->dbm = $dbm;
       $this->pref = $CFG->prefix;
       $this->prefCatalogo = $CFGcatalogo->prefix;
      
        $this->table01="vrhr_snir".".";
        $this->table02="vrhr_institucion".".";
       
       /** Implementacion
        * 
        * Configuramos el arreglo de tablas a generar los catalogos
        * pasara parametros de la conexion a la base de datos
        */
       $this->dbm = $dbm;
       //$this->configCatalogList();
	}
    
    /**
     * Catalogo::configCatalogList()
     * 
     * configura el arreglo de tablas de donde sacara los catalogos,
     * utilizando el metodo addCatalogList de la clase padres
     * 
     * parametros: Tabla, id, dato, noutf8, orden
     * 
     * si tuviera que sacar datos de una tabla que se encuentra en otra
     * base de datos se utilizara:   base_de_datos.Tabla
     * 
     * como ayuda para sacar la lista de tablas,
     * se puede utilizar la funcion sql en mysql
     * 
     * "show tables"
     * 
     * @return void
     */   
  function configCatalogListIndex(){
        $this->addCatalogList($this->table01."core_grupo","grupo","","","");
        $this->addCatalogList($this->table02."item","institucion","","","","","");
    }
    
     function getArrayData($item,$var1,$var2,$tipo=0){
        $opt = array();
        foreach($item as $row){
            if ($tipo==1){
                $opt[$row[$var1]] = $row[$var2];
            }else{
                $opt[$row[$var1]] = utf8_encode($row[$var2]);
            }
        }
        return $opt;
    }
    
     function setUTF8_array($list){
       // echo "<br>ANTES::".$value["nombre"];
       $res = array();
       $i=0;
       foreach($list as $row){
         $res[$i]["nombre"] = utf8_encode($row["nombre"]);
         $res[$i]["itemId"] = $row["itemId"];
         $i++;
       }
        
       return $res; 
    }

    function getArrayTipoUsuario($bUser=1){
        $res = array();
        if($bUser==1){
          $res[0] = "Super administrador";
        }
        $res[1] = "Administrador";
        $res[2] = "Normal";
        
        return $res;
    }    

    function getArrayCondicion(){
        $res = array();
        
        $res[1] = '1. Si';
        $res[0] = '2. No';
        
        return $res;
    }

    function getArrayColor(){
        $res = array();

        $res["h"][] = "#57acda";
        $res["h"][] = "#93e24e";
        $res["h"][] = "#f26c5b";
        $res["h"][] = "#f5d34a";
        $res["h"][] = "#f89553";
        $res["h"][] = "#65c773";
        $res["h"][] = "#5abec7";
        $res["h"][] = "#ce9884";
        $res["h"][] = "#a7a7a7";
        $res["h"][] = "#e9ea52";
        $res["h"][] = "#e04e61";
        $res["h"][] = "#6fe4c8";
        $res["h"][] = "#eca63f";
        $res["h"][] = "#99d0a0";
        $res["h"][] = "#ce8fbe";
        $res["h"][] = "#8dc3e0";
        
        $res["r"][] = "#b8d7e8";
        $res["r"][] = "#cdeeaf";
        $res["r"][] = "#f7bbb3";
        $res["r"][] = "#f9edbe";
        $res["r"][] = "#ffd4b8";
        $res["r"][] = "#acdfb4";
        $res["r"][] = "#a1dadf";
        $res["r"][] = "#e4c8be";
        $res["r"][] = "#dbdbdb";
        $res["r"][] = "#ffffc1";
        $res["r"][] = "#ffbec6";
        $res["r"][] = "#b9ffee";
        $res["r"][] = "#feddab";
        $res["r"][] = "#c6dec9";
        $res["r"][] = "#e1c6da";
        $res["r"][] = "#c1e0f0";
        
        
        return $res;
    }    
}
