<?
$type = array();
$type[]= "Airy";
$type[]= "Australian National";
$type[]= "Bessel 1841";
$type[]= "Bessel 1841 Nambia";
$type[]= "Clarke 1866";
$type[]= "Clarke 1880";
$type[]= "Everest";
$type[]= "Fischer 1960 Mercury";
$type[]= "Fischer 1968";
$type[]= "GRS 1967";
$type[]= "GRS 1980";
$type[]= "Helmert 1906";
$type[]= "Hough";
$type[]= "International";
$type[]= "Krassovsky";
$type[]= "Modified Airy";
$type[]= "Modified Everest";
$type[]= "Modified Fischer 1960";
$type[]= "South American 1969";
$type[]= "WGS 60";
$type[]= "WGS 66";
$type[]= "WGS 72";
$type[]= "WGS 84";//
?>

<form enctype="multipart/form-data" method="POST" action="">
<table>
    <tr>
        <td>Latitud Sur</td>
        <td align="center">
            <input type="text" name="item[LSgradeD]" id="gradoLSD"  />
            <input type="text" name="item[LSminuteD]" id="minuteLSD"  />
            <input type="text" name="item[LSsecondD]" id="secondLSD" /></td>
        
       
    </tr>
    <tr>
        <td>Longitud Oeste</td>
        <td align="center">
            <input type="text" name="item[LOgradeD]" id="gradoLOD"  />
            <input type="text" name="item[LOminuteD]" id="minuteLOD" />
            <input type="text" name="item[LOsecondD]" id="secondLOD"  />
        </td>
        
    </tr>
    <tr>
        <td>Tipo</td>
        <td>
        <select name="item[type]"><?
          foreach($type as $row){
            if($row == 'International'){
             $select = "selected";   
            }else{
                $select = "";
            }?>
            
            <option value="<? echo $row;?>"<? echo $select;?>><? echo $row;?></option>
          <?}  
        ?></select>
        
        </td>
    </tr>
    <tr>
        <td colspan="2"><input type="submit" value="Calcular" /></td>
    </tr>
</table>
</form> 

<? if(isset($_POST['item'])){
    $item = $_POST['item'];
    //echo "<pre>";print_r($item);echo"</pre>";
    require ('Class.GeoConversao.php');
    $conv = new GeoConversao();
    
    require ('gPoint.php'); 
    $myHome = new gPoint($item['type']);
    
    
    //$lat1 = '-17º28\'52.46"';
    $lat1 = '-'.$item['LSgradeD'].'º'.$item['LSminuteD'].'\''.$item['LSsecondD'].'"';
    $lat = $conv->DMS2Dd($lat1);
    echo "Latitud: $lat1 - (".$lat.")<br />";
    
    $log1 = '-'.$item['LOgradeD'].'º'.$item['LOminuteD'].'\''.$item['LOsecondD'].'"';
    $long = $conv->DMS2Dd($log1);
    //$logn = 'dd-'.$long ;
    echo "Longitud: ".$log1." - (".$long.")<br />";
    
$myHome->setLongLat($long,$lat);
//echo "I live at: "; $myHome->printLatLong(); echo "<br>";
$myHome->convertLLtoTM();
//echo "Which in a UTM projection is: "; $myHome->printUTM(); echo "<br>";
$myHome->printUTM();

   }else{
    
    
   }
    
    

?>   