<?PHP
namespace App\Setting\Module\App\Snippet\Index;
use Core\CoreResources;
class Index extends CoreResources {
    var $objTable = "app";
    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }

    function getDictonary($schema){


        $table = "institucion";
        $this->dbm->debug = true;
        $sql = "select 
col.table_schema, col.table_name, col.column_name, col.data_type, col.character_maximum_length, col.is_nullable,
col.column_default, des.description
from 
information_schema.columns col 
left join pg_description des on col.table_name::regclass = des.objoid and col.ordinal_position = des.objsubid
where table_schema = '".$schema."' and table_name = '".$table."'
order by ordinal_position
";


        $sql = "select 
col.table_schema, col.table_name, col.column_name, col.data_type, col.character_maximum_length, col.is_nullable,
col.column_default
from 
information_schema.columns col 

where table_schema = 'icas' and table_name = 'institucion'";

        $item = $this->dbm->execute($sql);
        $item = $item->GetRows();

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
          background: #5f2dbb !important;
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
        </style>
      </head>
     <body>
     ";
        print_struc($item);


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