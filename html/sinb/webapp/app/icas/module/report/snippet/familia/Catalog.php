<?PHP
namespace App\Icas\Module\Report\Snippet\Familia;
use Core\CoreResources;
class Catalog extends CoreResources{

    function __construct(){
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->appInit();
    }

    public function confCatalog($item){

        $this->addCatalogList($this->table["tipo"]
            ,"tipo","","nombre",""
            ,"nombre","","","");
        $this->addCatalogList($this->table["estado"]
            ,"estado","","nombre",""
            ,"nombre","","","");

        $where = "cod_dep<>'0'";
        $this->addCatalogList($this->table["departamento"]
            ,"departamento","","name",""
            ,"name",$where,"","");


        $this->addCatalogList($this->table["tipo_proyecto"]
            ,"tipo_proyecto","","nombre",""
            ,"nombre","","","");
        /*






        $where = $item["tipo_id"] != ""?" tipo_id = ".$item["tipo_id"]:"";
        $this->addCatalogList($this->table["convenio"]
            ,"convenio","","numero_convenio_txt",""
            ,"numero_convenio",$where,"","");

        */

    }

    function getConvenioOptions($id){
        /**
         * sacamos los convencios segun el tipo
         */
        if($id!="" and $id>0){
            $sql = "select * from ".$this->table["convenio"]." as sr where sr.tipo_id = '".$id."'";
            $item = $this->dbm->Execute($sql);
            $item = $item->GetRows();
        }
        return $item;
    }

    function getMunicipioOptions($id){
        $id =  implode(',',$id);
        /**
         * sacamos los convenio segun el programa
         */
        if($id!=""){
            $sql = "select m.id,m.departamen, m.name 
                    from ".$this->table["municipio"]." as m where m.departamento_id in (".$id.") 
                    order by m.departamen
                    ";
            $item = $this->dbm->Execute($sql);
            $item = $item->GetRows();
        }
        return $item;
    }

}