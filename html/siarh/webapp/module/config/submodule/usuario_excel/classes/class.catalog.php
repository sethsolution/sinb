<?php
class Catalogo extends Table{
      var $table01;
    var $table02;
    var $table04;
    var $table05;
	function __construct(){
	   global $CFGcatalogo,$CFG, $dbm;
       
       $this->dbm = $dbm;
       $this->pref = $CFG->prefix;
       $this->prefCatalogo = $CFGcatalogo->prefix;
      
        $this->table01="vrhr_snir".".";
        $this->table02="vrhr_institucion".".";
	}
    //----------------------------------
    
  
    /**
     * Nuevos Catalogos
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
    
}
