<?php
/*------------------------------------------------------------------------------
** File:		sa.php
** Description:	PHP script to check if a geographic point is within a specified
**				area. 
** Version:		1.0
** Author:		Brenor Brophy
** Email:		brenor dot brophy at gmail dot com
** Homepage:	brenorbrophy.com 
** Usage:		Pass in a long/lat coordinate when the script is called.
**
** 				sa.php?long=119.1234&lat=38.1234
*/

extract($_GET); // Get the Lat/Long Coordinate passed in
require ('polygon.php');
require ('gPoint.php');

//echo "Long: ",$long," Lat: ",$lat,"<br>";

/*
** This is an iregular area in Nevada that was the search area for Steve
** fossett. This script was created to show how to use the gpoint and
** polygon classes to check if a point was within the search area or
** not.
*/
$my_area = array (	array (-119.5175482105071,37.98688873464163),
					array (-119.5243972221322,38.11299739932525),
					array (-119.6511286498300,38.12244906405045),
					array (-119.6591522199431,38.34530975202757),
					array (-119.7951319233929,38.36641901680164),
					array (-119.7962620788580,38.67196063485969),
					array (-119.6618205881369,38.65403564970814),
					array (-119.6560159620819,38.72499250740221),
					array (-119.5498646743089,38.71526798464016),
					array (-119.5500121365328,38.73384622603417),
					array (-119.4634380887776,38.72906197393083),
					array (-119.4583583874869,38.94391347199031),
					array (-119.3432726303644,38.94588745424145),
					array (-119.3389808426059,38.95776309899176),
					array (-119.1826168036638,38.97501420820962),
					array (-119.1825986672560,38.95466523036326),
					array (-119.0565384104155,38.98027516930284),
					array (-118.9172807861185,38.98209550791582),
					array (-118.9199085341449,38.88544671686901),
					array (-118.6834531927899,38.88466537121720),
					array (-118.5794132366689,38.87752791481483),
					array (-118.5711321456884,38.82336027769676),
					array (-118.4519320118116,38.82794029134773),
					array (-118.4466310457910,38.70118508939510),
					array (-118.3493433660895,38.69732085547870),
					array (-118.3425844190672,37.86417537218252),
					array (-118.8168133196997,37.85433424905463),
					array (-118.8228710054539,37.95887460624230),
					array (-118.9255580308644,37.96072557249462),
					array (-118.9276411116996,37.99445299427209),
					array (-119.0133212937758,37.99453046340661),
					array (-119.0133953500001,38.24434916879308),
					array (-119.0413753173384,38.24776641983449),
					array (-119.2136128607609,38.21745634214744),
					array (-119.2158846406344,38.24282394511882),
					array (-119.2439345934981,38.24282835875192),
					array (-119.2458765603988,37.98763436524967),
					array (-119.5175482105071,37.98688873464163));
/*
** These min/max values are just taken from the data in the array
*/
$minLong = -119.7962621;
$minLat = 37.85433425;
$maxLong = -118.3425844;
$maxLat = 38.98209551;
/*
** Mid-point longitude of my area used for local transverse mercator
** projection.
*/
$longOrigin = ($minLong + $maxLong)/2;

/*
** First perform a quick check of lat/long and exit if not within bounding box
*/
if (!empty($lat) && !empty($long))
	if ($lat>=$minLat && $lat<=$maxLat && $long>=$minLong && $long<=$maxLong)
	{ // Lat/Long values are good and within the correct range
		$my_pt = new gPoint();	// create a new gpoint object for converting to TM
		$my_sa = new polygon(); // create a new polygon object
		foreach ($my_area as $pt) // for each vertex coordinate in the $my_area array
		{
			$my_pt->setLongLat($pt[0],$pt[1]);	// Set the Long/Lat of the vertex
			$my_pt->convertLLtoTM($longOrigin); // Convert to TM projection based in mid-point of $my_area
			$my_sa->addv($my_pt->E(),$my_pt->N());	// Add the vertex in Easting/Northing coordinates
//			$my_pt->printUTM(); echo "<br>";
		} // $my_sa is now a polygon of the area using Transverse Mercator coordinates
		$my_pt->setLongLat($long,$lat); // The point to check
		$my_pt->convertLLtoTM($longOrigin); // Coverted to TM coordinates
		$my_vt = new vertex ($my_pt->E(),$my_pt->N(),0,0,0); // Now convert to a vertex object
		if ($my_sa->isInside($my_vt)) {
//			$my_pt->printUTM(); echo "<br>";
		   echo "TRUE"; }
		else {
//			$my_pt->printUTM(); echo "<br>";
		   echo "FALSE"; }		
	}
	else {
	   echo "FALSE"; }
else {
	echo "FALSE"; }
?>