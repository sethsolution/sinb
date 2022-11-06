<?PHP
namespace App\Setting\Module\App\Snippet\Index;
use Core\CoreResources;
class Index extends CoreResources {
    var $objTable = "app";
    var $estiloNotNull = "";
    var $estilopk = "";
    var $estilofk = "";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }

    function getDictonary($schema){

        echo "<html><head>";
        echo "<title>Schema Report for database: SINB</title>";
        echo "<style>
        body,td,table{
          font-family: arial;
          font-size: 12px;
          color: #404040;
        }
        .label-nombre{
          width: 200px !important;
          background: #2e027e !important;
        }
        .label-tipodato{
          width: 100px !important;
        }
        .label-comentario{
          background: #fff7d9 !important;
          color: #583f08;
        }
        .label-gen{
          width: 50px !important;
        }
        td,th {
          text-align:left;
          vertical-align:middle;
        }
        table {
          border-collapse: collapse;
          border: 1px solid;
        }
        caption, th, td {
          padding: .2em .8em;
          border: 1px solid #000000;
        }
        caption {
          background: #ffffe6;
          font-weight: bold;
          font-size: 1.1em;
        }
        th {
          font-weight: bold;
          background: #0a57ae;
          color: white;
        }
        td {
          background: #FFFFFF;
        }
        .est_yes {
            color: #04530e    !important; 
            font-weight: bold;
        }
        .est_not {
           color: #999999  !important; 
        }
        
       
        </style>
      </head>
     <body>
     ";


        /**
         * Verlista de tablas
         */


        $sql = "SELECT t.table_name, pg_catalog.obj_description(pgc.oid, 'pg_class')
            FROM information_schema.tables t
            INNER JOIN pg_catalog.pg_class pgc
            ON t.table_name = pgc.relname 
            WHERE t.table_type='BASE TABLE'
            AND t.table_schema='".$schema."'";

        $itemTable = $this->dbm->execute($sql);
        $itemTable = $itemTable->GetRows();

        echo "<h1>Informe de esquema para base de datos: ".$schema."</h1> ";
        echo "<h2><a id=\"home\">Lista de Tablas </a></h2><ul>";
        foreach ($itemTable as $row){
            echo  "<li><a href=\"#".$row["table_name"]."\">".$row["table_name"]." </a></li> ";
        }
        echo "</ul>";


        foreach ($itemTable as $table) {
//            $this->dbm->debug = true;
            $sql = "select
                col.table_schema, col.table_name, col.column_name, col.data_type, col.character_maximum_length, col.is_nullable,
                col.column_default, pgd.description
                from pg_catalog.pg_statio_all_tables as st
                inner join information_schema.columns col
                on col.table_schema = st.schemaname
                and col.table_name = st.relname
                left join pg_catalog.pg_description pgd
                on pgd.objoid=st.relid
                and pgd.objsubid=col.ordinal_position
                where  col.table_schema = '".$schema."' and st.relname = '". $table["table_name"]."'";
            $item = $this->dbm->execute($sql);
            $item = $item->GetRows();

            echo "<a id=\"" . $table["table_name"] . "\"></a><table style=\"width:100%\"><caption>Tabla: " . $table["table_name"] . " </caption>";
            echo "<tr><td><b>Comentarios de la tabla</b></td><td colspan=\"6\">" . $table["obj_description"] . "</td></tr>";
            echo "<tr><td><b>Secuencia</b></td><td colspan=\"6\">". $item[0]["column_default"] . "</td></tr>";
            echo "<tr><td colspan=\"7\"><b>Columnas</b></td></tr>
                <tr>
                <th class='label-nombre'>Nombre</th>
                <th class='label-tipodato'>Tipo de dato</th>
                <th class='label-gen'>Not Null</th>
                <th class='label-gen'>PK</th>
                <th class='label-gen'>FK</th>
                <th class='label-gen'>Default</th>
                <th class='label-comentario'>Comentario <i class='la la-thumb-tack m--font-success'></i> </th>
                </tr>";

            //Obtener lista de los FKs
            $sqlFK = "select
                           string_agg(kcu.column_name, ', ') as fk_columns,
                           kcu.constraint_name
                    from information_schema.table_constraints tco
                    join information_schema.key_column_usage kcu
                              on tco.constraint_schema = kcu.constraint_schema
                              and tco.constraint_name = kcu.constraint_name
                    join information_schema.referential_constraints rco
                              on tco.constraint_schema = rco.constraint_schema
                              and tco.constraint_name = rco.constraint_name
                    join information_schema.table_constraints rel_tco
                              on rco.unique_constraint_schema = rel_tco.constraint_schema
                              and rco.unique_constraint_name = rel_tco.constraint_name
                    where tco.constraint_type = 'FOREIGN KEY' AND kcu.table_schema='".$schema."' AND kcu.table_name='". $table["table_name"]."'
                    group by kcu.table_schema,
                             kcu.table_name,
                             rel_tco.table_name,
                             rel_tco.table_schema,
                             kcu.constraint_name
                    order by kcu.table_schema,
                             kcu.table_name";
            $FKs = $this->dbm->execute($sqlFK);
            $FKs = $FKs->GetRows();
//            print_struc($FKs);exit;

            foreach ($item as $column) {
                $estiloNotNull = "est_not";
                $estilopk = "est_not";
                $estilofk = "est_not";
                $iconpk = "";
                $iconfk = "";
                if(strlen($column["column_default"])>10){
                    $column["column_default"] = "";
                }
//                print_struc($column["column_name"]);exit;
                    $PK="No";
                    $FK="No";

                if ($column["column_name"]==="id") {
                    $PK= "Yes";
                    $estilopk = "est_yes";
                    $iconpk = "<img src='/images/principal/pk.png' width='20' height='20'/>";
                }
                foreach ($FKs as $fk){
                    if($fk["fk_columns"]===$column["column_name"]){
                        $FK="Yes";
                        $estilofk = "est_yes";
                        $iconfk = "<img src='/images/principal/fk.png' width='20' height='20'/>";
                    }
                }
                if ($column["is_nullable"] ==="YES") {
                    $estiloNotNull = "est_yes";
                }

                echo "<tr>
                            <td>" . $column["column_name"] . "</td>
                            <td>" . $column["data_type"] . "</td>
                            <td class='".$estiloNotNull."'>" . ucwords(strtolower($column["is_nullable"])) . "</td>
                            <td class='".$estilopk."'>  ".$PK."$iconpk</td>
                            <td class='".$estilofk."'> ".$FK. " $iconfk </td>
                            <td>" . $column["column_default"] . "</td>
                            <td>" . $column["description"] . "</td>
                            
                        </tr>";
            }
        }

        echo "</body></html>";
        exit;
    }

    function getItem($idItem){
        $info = '';
        if($idItem!=''){
            $sqlSelect = ' i.*
                           , concat(u1.name,\' \',u1.last_name) AS user_creater
                            , CONCAT(u2.name,\' \',u2.last_name) as user_updater';
            $sqlFrom = ' '.$this->table[$this->objTable].' i
                         LEFT JOIN '.$this->table_core["user"].' u1 on u1.id=i.user_create
                         LEFT JOIN '.$this->table_core["user"].' u2 on u2.id=i.user_update';
            $sqlWhere = ' i.id='.$idItem;
            $sqlGroup = ' ';

            $sql = 'SELECT '.$sqlSelect.'
                  FROM '.$sqlFrom.'
                  WHERE '.$sqlWhere.'
                  '.$sqlGroup;
            $info = $this->dbm->Execute($sql);
            $info = $info->fields;
        }
        return $info;
    }


    public function getItemDatatableRows(){
        global $dbSetting;
        $table = $this->table[$this->objTable];
        $primaryKey = 'id';
        $grid = "item";
        $db=$dbSetting[0];
        /**
         * Additional configuration
         */
        $extraWhere = "";
        $groupBy = "";
        $having = "";
        /**
         * Result of the query sent
         */
        $result = $this->getGridDatatableSimple($db,$grid,$table, $primaryKey, $extraWhere);
        return $result;
    }

    /**
     * Index::deleteData($id)
     *
     * Delete a record from the database
     *
     * @param $id
     * @return mixed
     */
    function deleteData($id){
        $field_id="id";
        $res = $this->deleteItem($id,$field_id,$this->table[$this->objTable]);
        return $res;
    }

}