<?php
/**
 * Index
 * 
 * @package gadc
 * @author seeyourweb
 * @copyright 2012
 * @version $Id$
 * @access public
 */
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Index extends Table {
     var $objExcel;
    var $table01;
	function __construct(){	
	   global $CFG,$module,$smoduleName;
       $smoduleTableName = "ficha";
       $this->pref = $CFG->prefix;
       $this->tableName = $this->pref.$smoduleTableName;
	   $this->idName = "itemId";
       
       $this->userId = $_SESSION["userv"]["memberId"];
       
       $this->table01 = "territorio.";
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();

    }
    
    function setOptions($list){
        $options = '<option value="0">Seleccione una Provincia</option>';
        foreach($list as $key=>$row){
            $options.='<option value="'.$key.'">'.utf8_encode($row).'</option>';
        }
        $res["option"] = $options;
        $res["res"] = 1; 
        return $res;
    }

    /**
     * -----------------------------------------------------------------------------------------------------------------
     * Generamos el archivo Excel
     * -----------------------------------------------------------------------------------------------------------------
     */

    function get_excel_file($item,$userprint){
        global $core, $_REQUEST,$CFG,$dbm,$module,$smoduleName;
        $archivo = "./module/$module/submodule/$smoduleName/template/excel/reporteGral_01.xlsx";
        $this->sbm_exel_init_lee($archivo);

        /**
         * Recogemos los datos a ser visualizados en el Excel
         */
        $data = $this->excel_get_data($item);

        /**
         * Iniciamos con el llenado de información al archivo excel
         * para esta primera parte, se pone la fila por la cual iniciamos el llenado
         * $c -> numero de columna para iniciar el llenado
         */

        $c = 3;
        $this->excel_set_data($c,$data,$item,$userprint);

        /**
         * Nombre del archivo
         */
        $nombre_archivo = "Sora ".date("Ymd-His");
        $this->sbm_excel_write_excel($nombre_archivo);

    }

    private function excel_get_data($item){
        /**
         * Sacamos datos para mostrar en excel
         */
        $sql = $this->excel_get_sql($item);
        $info = $this->dbm->Execute($sql);
        $data = $info->GetRows();
        return $data;
    }

    function excel_get_sql($item){
        global $CFG;
        $table2 = "vrhr_territorio.provincia";
        $res = 0;
        $sWhere="";
       
        if($item["institucionId"] !=0){
            $sWhere .=" where  i.institucionId IN (".$item["institucionId"]." )";            
        }
        if($item["tipo"] !=0){
            $sWhere .=($sWhere==""?" where i.tipoUsuario IN (".$item["tipo"].")":" and i.tipoUsuario IN (".$item["tipo"].")");              
        }
        if($item["grupoId"] !=0){
            $sWhere .=($sWhere==""?" where i.grupoId IN (".$item["grupoId"].")":" and i.grupoId IN (".$item["grupoId"].")");              
        }      
        if($item["activo"] !="null"){
            $sWhere .=($sWhere==""?" where i.activo IN (".$item["activo"].")":" and i.activo IN (".$item["activo"].")");              
        }     
                
        $sql = 'select i.usuario, CONCAT_WS(" ",i.nombre,i.apellido) as nombre, i.descripcion,i.tipoUsuario,
                       i.telefono, i.celular, i.email,i.direccion, i.ip, i.lastLogin,
                       i.lastLogout,i.dateCreate,i.dateUpdate, g.nombre as grupo, ins.nombre as institucion
                       from core_usuario i
                       left join core_grupo g on i.grupoId=g.itemId
                       left join vrhr_institucion.item ins on i.institucionId=ins.itemId               
                '.$sWhere.'
                order by i.itemId ASC';
        //echo "<pre>".$sql."<pre/>";exit;
        return $sql;
    }

    /** Get excel file*/

    function excel_set_data($c,$item,$ocultar,$userprint){
        global $core, $objCatalog;
        //$condicional = $objCatalog->getCondicional();
        /**
         * Sacamos array de tipo de proyecto
         */
        //$tipoProyecto = $objCatalog->getTipoProyecto();
        /**
         * Recogemos lista de columnas
         */
        $col = $this->sbm_excel_get_col();
        /**
         * 
         */
        $c2 = $c +1;
        //verificar velocidad
        $hojaActiva = $this->objExcel->getActiveSheet();
        
        $tipo = $objCatalog->getArrayTipoUsuario();
        $i=0;
        /**
         * Estilo de la letra
         */
        $styleArray = $this->sbm_excel_get_style_cel();

        foreach($item as $row){
            /**
             * Iniciamos las columnas
             */
            $p = 0;
  
            /*
            Otras datos*/
          
            $c = $c +1;//fila4
           // $types = PHPExcel_Cell_DataType::TYPE_STRING;
            
            $hojaActiva
                    ->setCellValue($col[$p++].$c, ($i + 1) )//n~
                    ->setCellValue($col[$p++].$c, $row["usuario"])
                    ->setCellValue($col[$p++].$c, $row["nombre"])
                    ->setCellValue($col[$p++].$c, $row["institucion"])
                    ->setCellValue($col[$p++].$c, $row["grupo"])
                    ->setCellValue($col[$p++].$c, $tipo[$row["tipoUsuario"]])
                    ->setCellValue($col[$p++].$c, $row["telefono"])
                    ->setCellValue($col[$p++].$c, $row["celular"])
                    ->setCellValue($col[$p++].$c, $row["email"])
                    ->setCellValue($col[$p++].$c, $row["direccion"])
                    ->setCellValue($col[$p++].$c, $row["descripcion"])
                    ->setCellValue($col[$p++].$c, $row["ip"])
                    ->setCellValue($col[$p++].$c, date("d/m/Y H:i:s", strtotime($row["lastLogin"])))
                    ->setCellValue($col[$p++].$c, date("d/m/Y H:i:s", strtotime($row["lastLogout"])))
                    ->setCellValue($col[$p++].$c, date("d/m/Y H:i:s", strtotime($row["dateCreate"])))
                    ->setCellValue($col[$p++].$c, date("d/m/Y H:i:s", strtotime($row["dateUpdate"])));
                   
                         
            
             $i++;
            /**
             * pintamos el fondo de las filas, y aplicamos el estilo global
             */
            if(($c%2) != 0){
                $styleArray["fill"]["color"]["argb"] = "FFE5E5E5";
            }else{
                $styleArray["fill"]["color"]["argb"] = "FFffffff";
            }
            $hojaActiva->getStyle($col[0].$c.':P'.$c)->applyFromArray($styleArray);

        }//END FOR
        /** Ocultar los Chequeados
        */
        
        $ocultos =$ocultar["listCheckbox"];
        
        $ocultosArray = explode(" ", $ocultos);
  
        foreach ( $ocultosArray as $chBx){ 
        if($chBx != ''){
        $hojaActiva->getColumnDimension($chBx)->setVisible(false);
        }
        }

        /**
         * Formato
         */
        $hojaActiva->getStyle('T'.$c2.':T'.$c)->getAlignment()->setWrapText(true);
        $hojaActiva->getStyle('D'.$c2.':E'.$c)->getAlignment()->setWrapText(true);
    }

   
    /**
     * Inicializamos un arreglo de columnas para crear nuestro Excel
     */
    function getUserPrint(){
        global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CONCAT(u.nombre,' ',u.apellido) as username FROM core_usuario u WHERE u.itemId=".$this->userId;
        $info = $db->Execute($sql);
        return $info->fields;
    }

}

