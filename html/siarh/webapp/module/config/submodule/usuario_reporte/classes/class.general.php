<?php
class General extends Table {

	function __construct(){
	   global $CFG,$module,$smoduleName,$getModule;
       
       $smoduleTableName = "vrhr_inventario".".";
       $this->tableName[0] = $smoduleTableName."item";
       $this->tableName[3] = $smoduleTableName."catalogo_tipotecnologia";
       $this->tableName[4] = $smoduleTableName."catalogo_tecnologia";
       
       $smoduleTableName = "vrhr_territorio".".";
       $this->tableName[1] = $smoduleTableName."departamento";
       $this->tableName[2] = $smoduleTableName."municipio";
       
       $this->idName = "itemId";
       
       
       $this->userId = $_SESSION["userv"]["memberId"];
            
        //==================================
		// Directorio de datos del modulo
		//==================================
	   
	}

    function getSummary($sql, $condicionales){
      global $dbm;
      $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
      
      $sql2 = "SELECT ".$condicionales['tipo'].", 
                      COUNT(i2.itemId) as total,
                      SUM(CASE WHEN i2.activo = 1 THEN 1 ELSE 0 END) as totalActivos,
                      SUM(CASE WHEN i2.activo = 0 THEN 1 ELSE 0 END) as totalNoActivos,
                      SUM(CASE WHEN i2.tipoUsuario = 0 OR i2.tipoUsuario = 1 THEN 1 ELSE 0 END) as totalAdmin,
                      SUM(CASE WHEN i2.tipoUsuario = 0 OR i2.tipoUsuario = 1 THEN 0 ELSE 1 END) as totalNormal

                FROM (".$sql.") as i2 ".$condicionales['grupo'];
      $info = $dbm->Execute($sql2); //print_struc($sql2);exit;
      $info = $info->GetRows();
      
      return $info;  
    }

    function getList($reporte,$data){
        if($reporte ==1){
            $condicionales["tipo"] = "ifnull(i2.grupoName,'S/A') as Nombre";
            $condicionales["grupo"] = "group by i2.grupoId";
        }
        if($reporte == 2){
            $condicionales["tipo"] = "ifnull(i2.institucionName,'S/A') as Nombre";
            $condicionales["grupo"] = "group by i2.institucionId";
        }

        $sql = "SELECT i.itemId, i.activo, i.tipoUsuario, g.nombre as grupoName, ins.nombre as institucionName,
                i.grupoId, i.institucionId
                FROM core_usuario i
                LEFT JOIN core_grupo g on i.grupoId=g.itemId
                LEFT JOIN vrhr_institucion.item ins on i.institucionId = ins.itemId";

        $whereaux = ' WHERE';
        
        if(!empty($data["institucion"]))
            $whereaux.= ' i.institucionId IN ('.implode(",",$data["institucion"]). ") and";
        if(!empty($data["tipo"]))
            $whereaux.= ' i.tipoUsuario IN ('.implode(",",$data["tipo"]). ") and";
        if(!empty($data["grupo"]))
            $whereaux.= ' i.grupoId IN ('.implode(",",$data["grupo"]). ") and";
        if(!empty($data["activo"]))
            $whereaux.= ' i.activo IN ('.implode(",",$data["activo"]). ") and";

        if($whereaux!=' WHERE'){
          $whereaux = substr($whereaux,0, -3);
           $sql.=$whereaux;
        }
        $sql .= "  group by i.itemId";//print_struc($sql);exit;
        $res = $this->getSummary($sql,$condicionales);
        return $res;
    }
}
