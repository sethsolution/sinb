<?php
class Snippet extends Table
{
    var $item_form;
    var $dbm_personal;
    function __construct()
    {
        global $dbm_personal;
        /**
         * Inicializamos todas las librerias y variables para el submodulo
         */
        $this->submodule_init_sbm();
        /**
         * Base de control de personal
         */
        $this->dbm_personal = $dbm_personal;

    }
    function get_item($id,$tabla,$id_name="itemId",$where=""){

        $sql = "select * from ".$tabla." as i where i.".$id_name." = '".$id."' ";
        if($where !=''){
            $sql .= " and ".$where;
        }
        //$this->dbm->debug = true;
        $item = $this->dbm->Execute($sql);
        $item = $item->fields;
        return $item;
    }

    public function ver_asistencia($id,$item){
        //print_struc($this->tabla);
        $persona = $this->get_item($id,$this->tabla["persona"]);
        //print_struc($persona);exit;
        /**
         * Generamos las fechas
         */
        $item["fecha_inicio"] = $this->change_date($item["fecha_inicio"]);
        $item["fecha_fin"] = $this->change_date($item["fecha_fin"]);
        $fecha_fin = $item["fecha_fin"];
        $fecha_inicio = $item['fecha_inicio'];

        $fechas = $this->get_days($fecha_inicio,$fecha_fin);
        $feriado = $this->get_feriados($fecha_inicio,$fecha_fin);
        /**
         * Sacamos datos de la base de datos
         * tipo:
         * 1 : feriado
         * 2 : registro
         * 3 :
         */

        $lista = array();
        foreach ($fechas as $row){
            $dato = array();
            $dato["fecha"] =$row;
            if(isset($feriado[$row])){
                $dato["feriado"] =1;
            }else{
                $dato["feriado"] =0;
                $registro = $this->get_registro($row,$persona["ci_num"]);
                if(isset($registro["id"])){
                    $dato["registro"] =1;
                    $dato["dato"] =$registro;
                }else{
                    $dato["registro"] =0;
                }

            }
            $lista[] = $dato;
        }
        /*
        print_struc($lista);
        print_struc($feriado);
        print_struc($item);
        */
        return $lista;
    }

    private function get_registro($fecha,$ci){
        $sql = "select * from  ".$this->tabla["per_individual"]." as i where i.ci ='".$ci."' and i.fecha='".$fecha."'";
        $item = $this->dbm_personal->Execute($sql);
        $item = $item->fields;

        return $item;
    }
    private function get_feriados($fecha_inicio,$fecha_fin){
        $sql = "select * from ".$this->tabla["per_feriados"]." as f where f.fecha>='".$fecha_inicio."' and f.fecha<='".$fecha_fin."'";
        $item = $this->dbm_personal->Execute($sql);
        $item = $item->getRows();
        $res = array();
        foreach ($item as $row){
            $res[$row["fecha"]] = $row["desc_feriado"];
        }
        return $res;
    }
    private function get_days($fecha_inicio,$fecha_fin){
        $fecha = $fecha_inicio;
        $fechas = array();
        while ($fecha_fin > $fecha){
            $i = strtotime($fecha);
            if ((jddayofweek(cal_to_jd(CAL_GREGORIAN, date("m",$i),date("d",$i), date("Y",$i)) , 0 )!=0)&&(jddayofweek(cal_to_jd(CAL_GREGORIAN, date("m",$i),date("d",$i), date("Y",$i)) , 0 )!=6))
                $fechas[]=$fecha;
            $fecha = $this->dia_suma($fecha,1);
        }
        return $fechas;
    }

    private function change_date($date){
        $date = str_replace("/","-",$date);
        $date = $this->invertDate_sbm($date);
        return $date;
    }
    private function dia_suma($fecha,$dia)
    {
        list($year,$mon,$day) = explode('-',$fecha);
        return date('Y-m-d',mktime(0,0,0,$mon,$day+$dia,$year));
    }

}