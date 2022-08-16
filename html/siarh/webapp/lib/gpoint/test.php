<?
require ('Class.GeoConversao.php');
$conv = new GeoConversao();


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
$type[]= "WGS 84";

require ('gPoint.php');
//$myHome = new gPoint("International");

/*
$myHome->setLongLat($long,$lat);
echo "I live at: "; $myHome->printLatLong(); echo "<br>";
$myHome->convertLLtoTM();
echo "Which in a UTM projection is: "; $myHome->printUTM(); echo "<br>";
$myHome->printUTM();
*/

$myHome = new gPoint($type[13]);
//$myHome = new gPoint("International");
$lat1 = '-17º28\'52.46"';
$lat = $conv->DMS2Dd($lat1);
echo "Latitud: $lat1 - ".$lat."<br />";

$long = $conv->DMS2Dd('-65º41\'17.33"');
//$logn = 'dd-'.$long ;
$logn = '-'.$long ;
echo "Longitud: ".$long."<br />";


$myHome->setLongLat($long,$lat);
//echo "I live at: "; $myHome->printLatLong(); echo "<br>";
$myHome->convertLLtoTM();
//echo "Which in a UTM projection is: "; $myHome->printUTM(); echo "<br>";
$myHome->printUTM();

?>