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

    function get_item($idItem, $tipoTabla, $variante="") {
        $this->dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $info = '';
        if($idItem!=''){
            if($tipoTabla=='item'){
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
                $sqlGroup = '';
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
        $table = $this->tabla["proyectos"];
        /**
         * El nombre del campo que guarda id principal
         */
        $primaryKey = "itemId";
        /**
         * Que configuraciòn de grilla utilizaremos
         */
        $grilla = "grilla_proyectos";
        /**
         * la configuración de base de datos que utilizaremos
         * que se la realiza en inc/db.php
         */
        $db = $db_conf_datatable["principal"];
        /**
         * Configuraciones adicionales
         */
        $extraWhere = "";
        $groupBy = "";
        $having = "";
        /**
         * Resultado de la consulta enviada
         */
        $resultado = $this->get_grilla_datatable_simple($db, $grilla, $table, $primaryKey, $extraWhere, $groupBy, $having);
        /**
         * apartir de aca podemos transformar datos, de acuerdo a requerimiento
         */
        return $resultado;
    }

    /**
     * Borrar un registro de la base de datos
     */
    function item_delete($id, $campo_referencia, $tabla_referencia) {
        $campo_id=$campo_referencia;
        $where = "";
        $res = $this->item_delete_sbm($id, $campo_id, $this->tabla[$tabla_referencia], $where);
        return $res;
    }

    /**
     * Método que genera ficha de la especie
     */
    public function getFicha($id) {
        //Crear documento a partir de plantilla
        $archivo = 'proyectos.docx';
        $doc = new \PhpOffice\PhpWord\TemplateProcessor('module/agrobiodiversidad/submodule/proyectos/snippet/index/templates/'.$archivo);

        //Consulta información a la base de datos
        $info_general = $this->get_info_general($id);
        $info_departamentos = $this->get_info_departamentos($id);
        $info_municipios = $this->get_info_municipios($id);
        $info_financiamiento = $this->get_info_financiamiento($id);
        $info_componentes = $this->get_info_componentes($id);
        $info_metas = $this->get_info_metas($id);
        $info_contrapartes = $this->get_info_contrapartes($id);
        $info_adjuntos = $this->get_info_adjuntos($id);
        $info_referencias = $this->get_info_referencias($id);
        
        //Datos información general
        $doc->setValue('nombre', $info_general[0]['nombre']);
        $doc->setValue('sigla', $info_general[0]['sigla']);
        $doc->setValue('codigo', $info_general[0]['codigo']);
        $doc->setValue('implementador', $info_general[0]['implementador']);
        $doc->setValue('fecha_inicio', $info_general[0]['fecha_inicio']);
        $doc->setValue('fecha_final', $info_general[0]['fecha_final']);
        $doc->setValue('objetivo_principal', $info_general[0]['objetivo_principal']);
        $doc->setValue('descrip', $info_general[0]['descrip']);
        $doc->setValue('deptos', $info_departamentos[0]['deptos']);
        $doc->setValue('municipios', $info_municipios[0]['municipios']);

        //Datos información de financiamiento
        $contador = 1;
        $tamanio = count($info_financiamiento);
        $doc->cloneRow('financiador.nombre', $tamanio);
        for ($i=0; $i < $tamanio; $i++) {
            $doc->setValue('financiador.nombre#'.$contador, $info_financiamiento[$i]['nombre']);
            $doc->setValue('financiador.monto#'.$contador, $info_financiamiento[$i]['monto']);
            $doc->setValue('financiador.tipo#'.$contador, $info_financiamiento[$i]['tipo']);
            $contador++;
        }

        //Datos información de componentes
        $contador = 1;
        $tamanio = count($info_componentes);
        $doc->cloneRow('componente.descrip', $tamanio);
        for ($i=0; $i < $tamanio; $i++) {
            $doc->setValue('componente.descrip#'.$contador, $info_componentes[$i]['descrip']);
            $contador++;
        }

        //Datos información de metas
        $contador = 1;
        $tamanio = count($info_metas);
        $doc->cloneRow('metas.nombre', $tamanio);
        for ($i=0; $i < $tamanio; $i++) {
            $doc->setValue('metas.nombre#'.$contador, $info_metas[$i]['nombre']);
            $doc->setValue('metas.linea_base#'.$contador, $info_metas[$i]['linea_base']);
            $doc->setValue('metas.meta#'.$contador, $info_metas[$i]['meta']);
            $contador++;
        }

        //Datos información de contrapartes
        $contador = 1;
        $tamanio = count($info_contrapartes);
        $doc->cloneRow('contrapartes.entidad', $tamanio);
        for ($i=0; $i < $tamanio; $i++) {
            $doc->setValue('contrapartes.entidad#'.$contador, $info_contrapartes[$i]['entidad']);
            $doc->setValue('contrapartes.tipo#'.$contador, $info_contrapartes[$i]['tipo']);
            $contador++;
        }
        
        //Datos información de archivos adjuntos
        $contador = 1;
        $tamanio = count($info_adjuntos);
        $doc->cloneRow('adjunto.nombre', $tamanio);
        for ($i=0; $i < $tamanio; $i++) {
            $doc->setValue('adjunto.nombre#'.$contador, htmlspecialchars($info_adjuntos[$i]['adjunto_nombre']));
            $doc->setValue('adjunto.descrip#'.$contador, htmlspecialchars($info_adjuntos[$i]['descrip']));
            $contador++;
        }

        //Datos información de referencias
        $contador = 1;
        $tamanio = count($info_referencias);
        $doc->cloneRow('referencias.contacto', $tamanio);
        for ($i=0; $i < $tamanio; $i++) {
            $doc->setValue('referencias.contacto#'.$contador, $info_referencias[$i]['contacto']);
            $doc->setValue('referencias.email#'.$contador, $info_referencias[$i]['email']);
            $doc->setValue('referencias.telefono#'.$contador, $info_referencias[$i]['telefono']);
            $contador++;
        }

        //Permite descargar archivo
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=".$archivo);
        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header("Content-Transfer-Encoding: binary");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Expires: 0");
        $doc->saveAs("php://output");
        echo file_get_contents($archivo);
        exit();
    }

    /**
     * Función que obtiene informacion general de proyecto
     **/
    function get_info_general($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, 
        codigo, 
        sigla, 
        nombre, 
        implementador, 
        DATE_FORMAT(fecha_inicio,'%d/%m/%Y') AS fecha_inicio, 
        DATE_FORMAT(fecha_final,'%d/%m/%Y') AS fecha_final, 
        objetivo_principal, 
        descrip 
        FROM proyectos 
        WHERE itemId=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de departamentos del proyecto
     **/
    function get_info_departamentos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT GROUP_CONCAT(t2.nombre) AS deptos
        FROM proyecto_deptos t1 INNER JOIN mapa_departamentos t2
        ON t1.depto_itemid=t2.id
        WHERE t1.proy_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de municipios del proyecto
     **/
    function get_info_municipios($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT GROUP_CONCAT(t2.municipio) AS municipios
        FROM proyecto_municipios t1 INNER JOIN mapa_municipios t2
        ON t1.municipio_itemid=t2.id
        WHERE t1.proy_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de financiamiento de proyecto
     **/
    function get_info_financiamiento($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.itemId, t2.nombre, t1.monto, t1.tipo  
        FROM proyecto_financiamiento t1 INNER JOIN catalogo_proyecto_financiadores t2 
        WHERE t1.proy_itemid=".$id." 
        ORDER BY t2.nombre ASC";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de componentes de proyecto
     **/
    function get_info_componentes($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, descrip 
        FROM proyecto_componentes 
        WHERE proy_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de metas de proyecto
     **/
    function get_info_metas($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT t1.itemId, t2.nombre, t1.linea_base, t1.meta  
        FROM proyecto_metas t1 INNER JOIN catalogo_proyecto_metas t2 
        WHERE t1.proy_itemid=".$id." 
        ORDER BY t2.nombre ASC";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de contrapartes de proyecto
     **/
    function get_info_contrapartes($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, entidad, tipo  
        FROM proyecto_contrapartes 
        WHERE proy_itemid=".$id." 
        ORDER BY entidad ASC";
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de archivos adjuntos de proyecto
     **/
    function get_info_adjuntos($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT adjunto_nombre, descrip 
        FROM proyecto_adjuntos 
        WHERE proy_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene informacion de referencias de proyecto
     **/
    function get_info_referencias($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT itemId, contacto, email, telefono 
        FROM proyecto_referencias 
        WHERE proy_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

    /**
     * Función que obtiene permisos de usuario
     **/
    function getUserPermisos($privFace){
        $permisos = $this->getUser($_SESSION['userv']['itemId']);
        if (empty($permisos)) {
            $privFace['crear'] = 0;
            $privFace['editar'] = 0;
            $privFace['eliminar'] = 0;
        } else {
            $privFace['crear'] = $permisos[0]['crear'];
            $privFace['editar'] = $permisos[0]['editar'];
            $privFace['eliminar'] = $permisos[0]['eliminar'];
        }
        return $privFace;
    }

    /**
     * Función que obtiene permisos de usuario
     **/
    function getUser($id){
        global $db_conf_datatable;
        $db_conf = $db_conf_datatable["principal"];
        $dbm = ADONewConnection($db_conf["type"]);
        $dbm->Connect($db_conf["server"],$db_conf["user"] ,$db_conf["password"],$db_conf["database"]) or die("ERROR CONNECT " . $db_conf["database"]);
        $dbm->setCharset('utf8');
        $dbm->SetFetchMode(ADODB_FETCH_ASSOC);
        $sql = "SELECT user_itemid, crear, editar, eliminar 
        FROM usuario_permisos 
        WHERE user_itemid=".$id;
        $datos = $dbm->Execute($sql);
        $respuesta = $datos->GetRows();
        $dbm->Close();
        return $respuesta;
    }

}
