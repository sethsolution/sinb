<?php
/**
 * Created by PhpStorm.
 * User: henrytaby
 * Date: 3/5/2018
 * Time: 15:23
 */

class Index extends Table {

    function __construct()
    {
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
    }

    public function get_report($tipo){
        /**
         * Si mandaremos algun parametro
         */
        $parametros = array();
        /**
         * Archivo de reporte que utilizaremos
         */
        $reporte_file = "configuracion_monitoreo_lista.prpt";
        /**
         * Nombre del archivo
         */
        $nombre = "Monitoreo - Lista";
        /**
         * Generamos el reporte mediante pentaho
         */
        $this->pentaho_get_report($reporte_file,$tipo,$nombre,$parametros);
    }


    function get_item($idItem,$tipoTabla){


        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = '';
        if($idItem!=''){
            if($tipoTabla=='tipo'){
                $sqlSelect = ' i.*
                           , CONCAT_WS(" ",u1.nombre,u1.apellido) as userCreater
                           , CONCAT_WS(" ",u2.nombre,u2.apellido) as userUpdater';
                $sqlFrom = ' '.$this->tabla[$tipoTabla].' i
                         LEFT JOIN '.$this->tabla["o_usuario"].' u1 on u1.itemId=i.userCreate
                         LEFT JOIN '.$this->tabla["o_usuario"].' u2 on u2.itemId=i.userUpdate';
                $sqlWhere = ' i.itemId='.$idItem;
                $sqlGroup = ' GROUP BY i.itemId';
            }else{
                $sqlSelect = ' i.*';
                $sqlFrom = ' '.$this->tabla[$tipoTabla].' i ';
                $sqlWhere = ' i.itemId='.$idItem;
            }

            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }


    public function get_item_datatable_Rows(){
        global $db_conf_datatable;
        /**
         * tabla de la base de datos que listaremos
         */
        $table = $this->tabla["c_categoria"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = 'itemId';
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "item";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db=$db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = "i.padre!=0";
        $groupBy = "";
        $having = "";
        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db,$grilla,$table, $primaryKey, $extraWhere, $groupBy, $having);
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;

    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id){
        $campo_id="itemId";
        $res = $this->item_delete_sbm($id,$campo_id,$this->tabla["c_categoria"]);
        return $res;
    }





































































































    /**
     * Construye el json del datatable para listado de proyectos
     * @param $arrayGet : array
     *
     * @return $output : json
     **/
    function itemDatatableRows($arrayGet){
        global $dbm,$getModule,$module, $smoduleName, $privFace, $objCatalog, $subcontrol, $objItem,$CFGm;

        /**
         * Configuración de acceso
         */
        $tabla_nom = $this->tabla["riego"];
        $tabla_id = "num";
        $tabla_id_catalogo = "item_id";

        $columns = $columnsSelect = array();
        /* Easy set variables*/

        // Array of database columns which should be read and sent back to DataTables.
        // The `db` parameter represents the column name in the database, while the `dt`
        // parameter represents the DataTables column identifier. In this case simple indexes
        $dataItem = $objItem->getConfig("index");

        //$columnsDefault = array(array("db"=>' ',"dt"=>0),array("db"=>'itemId',"dt"=>1));
        $columnsDefault = array(array("db"=>' ',"dt"=>0),array("db"=>$tabla_id,"dt"=>1));
        $contColumnDefault = count($columnsDefault)-1;
        $columnsSelect = $this->pluck($columnsDefault,"db");

        foreach($dataItem as $idx => $row){

            if(is_array($row["campo"])){
                foreach($row["campo"] as $idx2 => $row2){
                    array_push($columns,array( 'db' => $row2,   'dt' => $idx2 ));
                    array_push($columnsSelect,$row["campo"]);
                }//END FOREACH

            }else{
                array_push($columns,array( 'db' => $row["campo"],   'dt' => $idx+$contColumnDefault ));
                array_push($columnsSelect,$row["campo"]);
            } //END IF

        }//END FOREACH

        $columns = array_merge($columnsDefault,$columns);
        /* Indexed column (used for fast and accurate table cardinality) */


        /* DB table to use */
        $table = $tabla_nom." i ";

        /* If you just want to use the basic configuration for DataTables with PHP server-side, there is
         * no need to edit below this line */

        /* Paging*/
        $limit = '';
        if ( isset($arrayGet['start']) && $arrayGet['length'] != -1 ) {
            $limit = "LIMIT ".intval($arrayGet['start']).", ".intval($arrayGet['length']);
        }

        /* Ordering*/
        $order = '';

        if ( isset($arrayGet['order']) && count($arrayGet['order']) ) {
            $orderBy = array();
            $dtColumns = $this->pluck( $columns, 'dt' );
            for ( $i=0, $ien=count($arrayGet['order']) ; $i<$ien ; $i++ ) {
                // Convert the column index into the column data property
                $columnIdx = intval($arrayGet['order'][$i]['column']);
                $requestColumn = $arrayGet['columns'][$columnIdx];

                $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                $tablaIdx = $columnIdx-1;
                if(isset($dataItem[$tablaIdx]["tabla"])){

                    $column['db'] = "i".$tablaIdx.".nombre ";

                }else{
                    $columnaux = $columns[ $columnIdx ]["db"];
                    $column['db'] = "i.".$columnaux;
                }//END IF

                if ( $requestColumn['orderable'] == 'true' ) {

                    $dir = $arrayGet['order'][$i]['dir'] === 'asc' ? 'ASC' : 'DESC';
                    $orderBy[] = ''.$column['db'].' '.$dir;
                }//END IF
            }//ENDFOR

            $order = 'ORDER BY '.implode(', ', $orderBy);//echo "=>>".$order;
        }

        /* Filtering
         * NOTE this does not match the built-in DataTables filtering which does it
         * word by word on any field. It's possible to do here, but concerned about efficiency
         * on very large tables, and MySQL's regex functionality is very limited
         */

        $globalSearch = array();
        $columnSearch = array();
        //	$dtColumns = $this->pluck( $columns, 'dt' );

        if ( isset($arrayGet['search']) && $arrayGet['search']['value'] != '' ) {
            $str = $arrayGet['search']['value'];

            for ( $i=0, $ien=count($arrayGet['columns']) ; $i<$ien ; $i++ ) {

                $requestColumn = $arrayGet['columns'][$i];
                $columnIdx = array_search( $requestColumn['data'], $dtColumns );
                $column = $columns[ $columnIdx ];

                if ( $requestColumn['searchable'] == 'true' ) {
                    $columnIdx--;
                    $valFilter = $arrayGet["search"]["value"];
                    $pos = strpos($valFilter, "'");
                    if($pos !== false ){
                        $valFilter = str_replace("'", "\'", $valFilter);
                    }
                    if(isset($dataItem[$columnIdx]["tabla"])){

                        $globalSearch[] = "i".$columnIdx.".nombre LIKE '%".$valFilter."%'";
                    }else{
                        $globalSearch[] = " i.".$column['db']." LIKE '%".$valFilter."%'";
                    }//END IF

                }//END IF

            }//END FOR
        }//END IF

        /**
         * Filtros individuales
         */
        for ( $i=0, $ien=count($arrayGet['columns']) ; $i<$ien ; $i++ ) {
            $requestColumn = $arrayGet['columns'][$i];
            //print_struc($requestColumn);
            //print_struc($requestColumn['data']);
            $columnIdx = array_search( $requestColumn['data'], $dtColumns );
            //print_struc($columnIdx);
            $column = $columns[ $columnIdx ];
            $str = $requestColumn['search']['value'];



            if ( $requestColumn['searchable'] == 'true' && $str != '' ) {
                //$binding = $this->bind( $bindings, '%'.$str.'%', PDO::PARAM_STR );
                //$binding = $this->bind($bindings);
                /*
                if($columnIdx==10 ){
                    $columnSearch[] = " i.".$column['db']." IN (".implode(',', $str).") ";
                }elseif($columnIdx==4 || $columnIdx==5){
                    $columnSearch[] = " i.".$column['db']." IN (".$str.") ";
                }else{
                    $columnSearch[] = " i.".$column['db']." LIKE '%".$str."%' ";
                }
                */
                if(is_array($str)){
                    $columnSearch[] = " i.".$column['db']." IN (".implode(',', $str).") ";
                }else{
                    $columnSearch[] = " i.".$column['db']." LIKE '%".$str."%' ";
                }
            }
            /*
            if($i==10){
                print_struc($column);
                print_struc($requestColumn);
                print_struc($str);
                print_struc($requestColumn);
                print_struc($columnSearch);

            }
            */
        }
        /**
         * Fin del filtro individual
         */
        $where = '';

        //Filtro Por Instutcion
        /*if ($_SESSION["userv"]["tipoUsuario"] != 0 && $_SESSION["userv"]["tipoUsuario"] != 1)
            $where.= ' i.institucionId = '.$_SESSION["userv"]["institucionId"]." AND";*/

        //print_struc($columnSearch);
        if ( count( $globalSearch ) ) {
            $where.= ' ('.implode(' OR ', $globalSearch).') AND';
        }

        if ( count( $columnSearch ) ) {
            $where = $where === '' ?
                implode(' AND ', $columnSearch).' AND' :
                $where .' '. implode(' AND ', $columnSearch).' AND';
        }

        if ( $where !== '' ) {
            $where = 'WHERE '.$where;
            $where = substr($where,0, -3);
        }


        /* SQL queries
    	 * Get data to display */
        //$columns = $this->pluck($columns,'db');
        $columns = $columnsSelect;

        $sql = "SELECT SQL_CALC_FOUND_ROWS ".str_replace(" , ", " ", implode(", i.", $columns))."

                        ";

        $sForm = '';

        /**
         * Generamos los joins correspondientes
         */
        foreach($dataItem as $idx => $row){
            if(isset($row["tabla"])){
                $idxAux = $idx;
                if(isset($row["nombre_campo"])){
                    $nombre = $row["nombre_campo"];
                }else{
                    $nombre = "nombre";
                }
                $sql.= " , i".$idxAux.".".$nombre." as ".$row["campo"]."Name ";
                $sForm.=" LEFT JOIN ".$row["tabla"]." i".$idxAux." ON i.".$row["campo"]."=i".$idxAux.".".$tabla_id_catalogo;
            }
        }
        /**
         * Fin de los Joins
         */

        $sql.= " FROM ".$table."
               ".$sForm;
        $sql.= " $where
                 $order
                 $limit";
        //print_struc($sql);
        //exit;

        $rResult = $dbm->Execute($sql);
        $rResult = $rResult->GetRows();
        //print_struc($sql);exit;
        /* Data
             set length after filtering */
        $sql = "SELECT FOUND_ROWS() as totalFilter";
        $rResultFilterTotal = $dbm->Execute($sql);
        $aResultFilterTotal = $rResultFilterTotal->fields;
        $iFilteredTotal = $aResultFilterTotal["totalFilter"];

        /* Total data set length */
        $sql = "select COUNT(3) as resultTotal FROM $table";
        $iTotal = $dbm->Execute($sql);
        $iTotal = $iTotal->fields;
        $iTotal = $iTotal["resultTotal"];

        /* Output */
        $output = array( "sEcho" => intval($arrayGet['sEcho'])
        ,"iTotalRecords" => $iTotal==NULL?0:$iTotal
        ,"iTotalDisplayRecords" => $iFilteredTotal==NULL?0:$iFilteredTotal
        ,"iSummary" => $this->getSummary($where,$sForm, $tabla_nom )
        ,"aaData" => array());

        $contRow = $arrayGet['start'];
        //$listTipoFicha = $objCatalog->getArrayTipoFicha();

        //print_struc($rResult);exit;
        foreach ( $rResult as $aRow ){

            $row = array();
            $contRow++;

            /*
            print_struc($columns);
            print_struc($aRow);
            exit;
            */

            for ( $i=0 ; $i<count($columns) ; $i++ ) {
                if ($i == 0) {
                    //$firstCol = '<img src="./template/user/images/icon/details_open.png" class="iconDetail"/> ';
                    $row[] = $firstCol . $contRow;
                }elseif ($i == 1) {
                    $action = '';
                    $btnEditar = '<a href="javascript:void(0);" onclick="itemUpdate(' . $aRow["itemId"] . ',\'update\')" class="linkAction">
                              <img src="./template/user/images/icon/modificar.gif" border="0" title="Modificar"/></a> &nbsp;';
                    //$action .= $btnEditar;
                    /*
                                      $btnPrint = '<a href="javascript:void(0);" onclick="itemPrint(' . $aRow["itemId"] . ')" class="linkAction">
                                               <img src="./template/user/images/icon/print_icon.png" width="16" height="16" border="0" title="Imprimir"/></a>';
                                      $action .= $btnPrint;
                    */

                    if ($privFace["eliminar"]) {
                        $nameaux = utf8_encode(str_replace('"', "&#034;", $aRow["nombre"]));
                        $nameaux = str_replace("'", "\\'", $nameaux);
                        $nameaux = trim($nameaux);
                        $btnEliminar = '<a href="javascript:void(0);" onclick="itemDelete(' . $aRow["itemId"] . ',\'' . $nameaux . '\')" title="Delete Item" class="linkAction">
                                <img src="./template/user/images/icon/delete.png" title="Eliminar" border="0" /></a>';
                        //$action .= $btnEliminar;
                    }//WND FI
                    $row[] = $action;
                    /**
                     * Muestra el catalogo de la base de datos
                     */
                }
                /*
                elseif($i==2){
                    $ft = utf8_encode($aRow[$columns[$i]]);
                    if($ft==1){
                        $icon = "activo-on.png";
                    }else{
                        $icon = "activo-off.png";
                    }
                    if($ft==""){
                        $row[] ="";
                    }else {
                        $action = '<img src="./template/user/images/icon/' . $icon . '" width="30" height="30" border="0"/>';
                        $row[] = $action;
                    }
                }elseif($i==15){
                    $ft = utf8_encode($aRow[$columns[$i]]);
                    if($ft==1){
                        $icon = "genero-femenino.png";
                    }else{
                        $icon = "genero-masculino.png";
                    }
                    if($ft==""){
                        $row[] ="";
                    }else {
                        $action = '<img src="./template/user/images/icon/' . $icon . '" width="30" height="30" border="0"/>';
                        $row[] = $action;
                    }

                }elseif($i==19 || $i==20){
                    $ft = trim(utf8_encode($aRow[$columns[$i]]));
                    if($i==19){
                        $icon="facebook.png";
                        $title="Facebook:".$ft;
                    }elseif($i==20){
                        $icon="twitter.png";
                        $title="Twitter:".$ft;
                    }

                    if($ft==""){
                        $row[] ="";
                    }else{
                        $action = '<a href="'.$ft.'" target="_blank" class="linkAction">
                             <img src="./template/user/images/icon/'.$icon.'" width="20" height="20" border="0" title="'.$title.'"/></a>';
                        $row[] =$action;
                    }
                }*/
                elseif(
                    $i==18 || $i==16 || $i==15 || $i==14 ||
                    $i==49 || $i==50 || $i==51 ||
                    $i==53 || $i==54 || $i==55

                ){
                    $num = utf8_encode($aRow[$columns[$i]]);
                    $row[] = number_format($num, 0, ',', '.');

                }elseif($i==20 || $i==19 ){
                    $row[] = utf8_encode($aRow[$columns[$i]])." %";
                }else{
                    /**
                     * De forma automática detecta si es un arreglo de información
                     */
                    $busca = $columns[$i];
                    $resp_col =  (array_search($busca,array_column($dataItem,"campo"))+1);


                    if($dataItem[$resp_col]["tipoInput"]=="select"){
                        $row[] = utf8_encode($aRow[$columns[$i]."Name"]);
                    }else{
                        $row[] = utf8_encode($aRow[$columns[$i]]);
                    }

                }
            }//END FOR
            $output['aaData'][] = $row;
        }//END FOREACH
        //print_struc($rResult);
        return json_encode( $output );
    }

    function getSummary($where,$fromLeft='',$tabla){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);

        $sql = 'SELECT COUNT(3) as totalItem
                FROM '.$tabla.' i
                '.$fromLeft.'
                '.$where;

//echo "=>".$sql;exit;
        $info = $dbm->Execute($sql);
        $info = $info->fields;

        return $info;
    }
    /**
     * Pull a particular property from each assoc. array in a numeric array,
     * returning and array of the property values from each item.
     *
     *  @param  array  $a    Array to get data from
     *  @param  string $prop Property to read
     *  @return array        Array of property values
     */
    function pluck ( $a, $prop ){
        $out = array();

        for ( $i=0, $len=count($a) ; $i<$len ; $i++ ) {
            $out[] = $a[$i][$prop];
        }

        return $out;
    }


    /*FICHA*/

    function getItem($id){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);

        $sql = "SELECT i.*
              FROM ".$this->tabla["persona"]." i
              WHERE i.itemId=".$id;
        /*
                    print_struc($this->tabla);
              echo $sql;exit;
        */
        $info = $dbm->Execute($sql);
        $info = $info->fields;

        return $info;
    }

    function pdfDompdf($idficha){
        global $dbm,$CFG,$core,$smarty,$templateModulePrintPage,$pathmodule,$module,$smoduleName,$objCatalog;

        require_once('./lib/dompdf/dompdf_config.inc.php');
        $dompdf = new DOMPDF();
        /**
         * Datos para mostrar en el PDF
         */

        $item = $this->getDataPrintItem($idficha);
        //$item["sectores"] = $objCatalog->getSectorItem($idficha,0);

        $smarty->assign('item',$item);
        $smarty->assign('id',$idficha);

        $listCatalogo = $objCatalog->configCatalogListPrint(1);
        //$listCatalogo["lugar"] = $objCatalog->getLugarList();
        /*$listCatalogo["item_pozo_prueba"] = $objCatalog->getBomveoList();
        $listCatalogo["item_pozo_tipoPrueba"] = $objCatalog->getTipopruebaList();*/
        $smarty->assign("listCatalogo", $listCatalogo);
        //$smarty->assign("cataobj", $cataobj);

        //print_struc($listCatalogo);
        //$dirFoto = $this->directoryFoto.$idficha."/";
        //$smarty->assign("dirFilePhoto","./../dataFile/monitoreo/siasbo/".floor($idficha/100)."/");
        //$smarty->assign("dirFilePhoto",$dirFoto);


        $smarty->assign('userprint', $this->getUserPrint());
        date_default_timezone_set('America/La_Paz');
        $smarty->assign('dateprint', date("d/m/Y  H:i:s"));


        $html = $smarty->fetch($templateModulePrintPage);

        //print_struc($html); exit;
        $dompdf->load_html(utf8_encode($html));
        $dompdf->set_paper("letter");
        $dompdf->render();
        $options[Attachment]=0;

        $dompdf->stream(date("Ymd_His_").'- Ficha_Presa ID-'.$item['itemId'].'.pdf',$options);
    }

    function getUserPrint(){
        global $db;
        $db->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT CONCAT(u.nombre,' ',u.apellido) as username FROM core_usuario u WHERE u.itemId=".$this->userId;
        $info = $db->Execute($sql);
        return $info->fields;
    }

    function getDataPrintItem($id){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT i.*
                FROM ".$this->tableName[0]." AS i
                WHERE i.itemId=".$id;
        //print_struc($sql); exit;
        $item = $dbm->Execute($sql);
        $item = $item->fields;
        $item["listApsb"] = $this->getListApsb($id);
        $item["listResSolidos"] = $this->getListResSolidos($id);
        $item["listRiegos"] = $this->getListRiego($id);
        $item["listCuencas"] = $this->getListCuencas($id);
        $item["listForestacion"] = $this->getListForestacion($id);
        $item["listMiAguaDep"] = $this->getListMiAguaDep($id);
        $item["listMiAguaPro"] = $this->getListMiAguaPro($id);
        $item["listMiRiegoDep"] = $this->getListMiRiegoDep($id);
        $item["listMiRiegoPro"] = $this->getListMiRiegoPro($id);
        $item["listForestalArea"] = $this->getListForestalArea($id, "a");
        $item["listForestalDep"] = $this->getListForestalDep($id, "d");
        $item["listForestalIndicador"] = $this->getListForestalIndicador($id);
        $item["listCalor"] = $this->getListCalor($id);
        $item["listAire"] = $this->getListAire($id);


        return $item;
    }


    function getDataToTable($id,$table,$caso=""){
        global $dbm;
        //$dbm->debug = true;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $res = array();
        $consulta = "SELECT i.*
                FROM ".$table." i";
        if($caso == "" ){
            $where = "WHERE i.itemId=".$id;
        }else{
            $where = "WHERE i.".$caso."=".$id;
        }
        $consulta = $consulta." ".$where;
        $res = $dbm->Execute($consulta);
        $res = $res->GetRows();

        return $res;
    }

    function getListVideo($id){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);

        $res = array();
        $sql = 'SELECT i.*
                FROM '.$this->tabla["item_video"].' i
                WHERE i.fichaId='.$id;//print_struc($sql);
        $res = $dbm->Execute($sql);
        $res = $res->GetRows();

        return $res;
    }

    function getListAnexo($id){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);

        $res = array();
        $sql = 'SELECT i.*, i2.nombre as categoriaName
                FROM '.$this->tabla["item_anexo"].' i
                LEFT JOIN '.$this->tabla["catalogo_anexo_categoria"].' i2 ON i2.itemId=i.categoriaId
                WHERE i.fichaId='.$id;//print_struc($sql);
        $res = $dbm->Execute($sql);
        $res = $res->GetRows();

        return $res;
    }

    function getListFotos($id,$principal){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);

        $res = array();
        $sql = 'SELECT i.*
                FROM '.$this->tabla["item_foto"].' i
                WHERE i.fichaId='.$id.' and i.portada='.$principal.' and  activo=1';
        $res = $dbm->Execute($sql);
        $res = $res->GetRows();

        return $res;
    }


    function deleteItem($id){
        global $dbm;
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        //$dbm->debug=true;

        $sql = "SELECT i.itemId
                FROM ".$this->tableName[0]." i
                WHERE i.itemId=".$id;
        $info = $dbm->Execute($sql);
        $info = $info->fields;

        $msgdb = '';
        $right = $wrong = 0;
        /**
         * Primero Borrar los datos de las tablas relacionadas a las principales
         */
        $listTableDatos = array();
        //$listTableDatos[] = array("tabla" => "item_geofisica_dev_capa","condicional" => "geofisicaId");
        $listTableDatos[] = array("tabla" => "item_pozo_hidra_bombeo_dato","condicional" => "bombeoId");
        $listTableDatos[] = array("tabla" => "item_pozo_hidra_observacion_dato","condicional" => "observacionId");
        foreach ($listTableDatos as $key => $row) {
            $ids = NULL;
            $sql = ' DELETE FROM '.$row["tabla"];
            if($row["condicional"] == "bombeoId" || $row["condicional"] == "observacionId"){
                $listDatosExt = $this->getIdsTables($id,$row["condicional"]);
                if( empty( $listDatosExt ) )
                    $listEmpty = true;
                else
                    $listEmpty = false;
                foreach ($listDatosExt as $k => $val) {
                    $ids .= $val["itemId"].",";
                }
                $ids = substr($ids, 0, -1);
                $sql .= ' WHERE '.$row["condicional"].' IN('.$ids.")";
            }else{
                $sql .= ' WHERE '.$row["condicional"].'='.$id;
                $listEmpty = false;
            }  // echo $sql."\n";

            if (!$listEmpty) {
                $resdelete = $dbm->Execute($sql);
                if($resdelete){
                    $right++;
                }else{
                    $wrong++;
                    $msgdb.=" \n\t - ".$row." : ".$dbm->ErrorMsg();
                }
            }
        }
        /**
         * Borrar las tablas principales
         */
        $listTableCond = array();
        $listTableCond[] = array("tabla" => "item_geofisica_dev_capa","condicional" => "geofisicaId");
        $listTableCond[] = array("tabla" => "item_geofisica","condicional" => "itemId");
        $listTableCond[] = array("tabla" => "item_pozo_constructivo_diseno","condicional" => "pozoId");
        $listTableCond[] = array("tabla" => "item_pozo_constructivo_sello","condicional" => "pozoId");
        $listTableCond[] = array("tabla" => "item_pozo_electrico_parametro","condicional" => "pozoId");
        $listTableCond[] = array("tabla" => "item_pozo_hidra_bombeo","condicional" => "pozoId");
        $listTableCond[] = array("tabla" => "item_pozo_hidra_observacion","condicional" => "pozoId");
        $listTableCond[] = array("tabla" => "item_pozo_hidra_recuperacion","condicional" => "pozoId");
        $listTableCond[] = array("tabla" => "item_pozo_litologica","condicional" => "pozoId");
        $listTableCond[] = array("tabla" => "item_pozo_monitor","condicional" => "pozoId");
        $listTableCond[] = array("tabla" => "item_pozo_proposito","condicional" => "pozoId");
        $listTableCond[] = array("tabla" => "item_pozo_usoagua","condicional" => "pozoId");
        $listTableCond[] = array("tabla" => "manantial_monitoreo","condicional" => "manantialId");
        $listTableCond[] = array("tabla" => "manantial_usoagua","condicional" => "manantialId");
        $listTableCond[] = array("tabla" => "manantial","condicional" => "itemId");
        $listTableCond[] = array("tabla" => "item_pozo","condicional" => "itemId");

        //$listTableCond[] = array("tabla" => "manantial","condicional" => "itemId");
        //$listTableCond[] = array("tabla" => "item_pozo","condicional" => "itemId");
        // print_struc($listTableCond);exit;
        //$listTableDatos = array();
        //exit;
        foreach ($listTableCond as $key => $row) {
            $sql = ' DELETE FROM '.$row["tabla"];
            $sql.= ' WHERE '.$row["condicional"].'='.$id;
            $resdelete = $dbm->Execute($sql);
            if($resdelete){
                $right++;
            }else{
                $wrong++;
                $msgdb.=" \n\t - ".$row." : ".$dbm->ErrorMsg();
            }
        }

        /**
         * Borramos las tablas adicionales finales
         */
        $listTable = $res = array();
        $listTable[0] = "item_anexo";
        $listTable[1] = "item_foto";
        $listTable[2] = "item_tipo";
        $listTable[3] = "item_video";


        foreach($listTable as $row){
            $sql = ' DELETE FROM '.$row;
            $sql.= ' WHERE fichaId='.$id;
            $resdelete = $dbm->Execute($sql);
            if($resdelete){
                $right++;
            }else{
                $wrong++;
                $msgdb.=" \n\t - ".$row." : ".$dbm->ErrorMsg();
            }
        }

        if($wrong==0){
            $sql = 'DELETE FROM item WHERE itemId='.$id;
            $resdelete = $dbm->Execute($sql);

            if($resdelete){
                $res["res"] = 1;

                //ELIMINAR ADJUNTOS
                // $this->deleteDir($this->directoryAnexo.$id."/");
                //$this->deleteDir($this->directoryFoto.$id."/");
                $this->deleteDir($this->directory.floor($id/100)."/".$id."/");

                //$res["posgis"] = $this->postgisDelete($id);
                //$this->postgisDeleteItem($id,'2');

            }else{
                $res["res"] = 2;
                $res["msg"] = utf8_encode("No se logro eliminar la tabla principal de la BD.");
                $res["msgdb"] = $dbm->ErrorMsg();
            }
        }else{
            $res["res"] = 2;
            $res["msg"] = utf8_encode("No se logro eliminar todas las tablas relacionadas BD.");
            $res["msgdb"] = $msgdb;
        }

        return $res;
    }

}