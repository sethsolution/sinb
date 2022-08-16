<?php
class Catalogo extends Table{
    var $table01;
    var $table02;
    function __construct(){
       global $CFGcatalogo,$CFG,$dbm;
       $this->pref = $CFG->prefix;
       $this->prefCatalogo = $CFGcatalogo->prefix;
       /**
        * Utilizamos una Tabla diferente a la seleccionada por defecto
        */
       $this->table01="vrhr_snir".".";
       $this->table02="vrhr_institucion".".";
       /**
        * Implementacion
        * 
        * Configuramos el arreglo de tablas a generar los catalogos
        * pasara parametros de la conexion a la base de datos
        * 
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
    function configCatalogListPermiso(){
        $this->addCatalogList($this->table01."core_modulo","core_modulo","","titulo","","titulo","activo=1","");
        //$this->addCatalogList($this->table01."core_submodulo","core_submodulo","","nombre, moduloId","","nombre","activo=1",1);
    }
    
    /**
     * Funcion que te devuelve los valores del arreglo convertidos a utf8 o no
     */
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
    
    function getArrayCondicion(){
        $res = array();
        
        $res[1] = '1. Si';
        $res[2] = '2. No';
        
        return $res;
    }
    
    function getArrayTipoUsuario($bUser=1){
        $res = array();
        if($bUser==1){
          $res[0] = "Super administrador";
        }
        $res[1] = "Adminsitrador";
        $res[2] = "Normal";
        
        return $res;
    }
    
    function configCatalogListIndex($tipo){
        $this->addCatalogList($this->table02."item","item","","","","itemId","");
    }
    
}
