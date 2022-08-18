<?PHP
namespace App\Core\Module\Index\Snippet\Index;
use Core\CoreResources;

class Index extends CoreResources {

    function __construct()
    {
        /**
         * We initialize all the libraries and variables for the new class
         */
        $this->appInit();
    }

    function get_menu_principal(){
        global $db;
        $userInfo  = $_SESSION["userv"];
        $sql = "SELECT 
                c.id
                ,c.name
                ,c.class
                ,c.description
                ,c.order
                ,c.active
                ,c.user_create
                ,c.user_update
                ,c.parent
                 ,c.admin, c.private
                ,c2.name as parent_name
                , c2.admin AS parent_admin
                , c2.private AS parent_private
                from  ".$this->table_core["group"]." as c 
                left join ".$this->table_core["group"]." as c2 on c2.id = c.parent
                WHERE c.active=TRUE
                AND c.parent is not NULL ";

        //print_struc($userInfo);exit;

        if($userInfo){
            if($userInfo["type"] != 1){
                $sql .= " and c.admin=false and c2.admin = false ";
            }
        }else{
            // Genera grupos para el público en general
            $sql .= " and c.admin=false and c.private=false and c2.admin =false and c2.private=false ";
        }
        $sql .= " order by c2.order, c.order";
        $item = $db->Execute($sql);
        $item = $item->getRows();

        for ($i=0;$i<count($item);$i++){
            $sql2 = "select ";

            if($userInfo["type"]!=1){
                $sql2.=" (select count(*) as total from ".$this->table_core["user_module"]." as um
                left JOIN ".$this->table_core["app_module"]." as m on m.id = um.app_module_id
                where um.user_id= ".$_SESSION["userv"]["id"]." and m.app_id = a.id ) as total ,";
            }
            $sql2 .=" a.id,a.name,a.description
                    ,a.class,a.type,a.folder
                    ,a.url,a.target,a.order
                    ,a.group_id,a.admin,a.private
                    FROM ".$this->table_core["app"]." as a
                    WHERE a.active=TRUE AND a.group_id='".$item[$i]["id"]."'
                    and a.hide=FALSE
                    ORDER BY a.order";

            $submenu = $db->Execute($sql2);
            $submenu = $submenu->getRows();


            if($userInfo["type"]!=1){
                $submenu2 = array();
                foreach ($submenu as $row){
                    if(($row["type"]=="url")
                    || ($row["type"]=="app" && $row["total"]>0)
                    ){
                        $submenu2[] = $row;
                    }
                }

                $item[$i]["submenu"] = $submenu2;
            }else{
                $item[$i]["submenu"] = $submenu;
            }
        }
        //print_struc($item); exit;
        return $item;
    }

    public function getPhoto($type){

        $type = "image/png";
        $file = "./images/core/perfil/user2.png";
        $ext = "png";

        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-Type: $type");
        header ('Content-Disposition: '.$conten_Disposition.'; filename="perfil.'.$ext.'"');
        //header ("Content-Length: ".$item["photoSize"]);
        readfile($file);
        exit;
    }
}