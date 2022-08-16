<?php
/*------------------------------------------------------------------------------
** File:                gPointDemoEur.php
** Description: Simple demo & documentation of gPoint class capabilities
** Version:             1.1
** Author:              Brenor Brophy
** Email:               brenor dot brophy at gmail dot com
** Homepage:    www.brenorbrophy.com 
**------------------------------------------------------------------------------
** COPYRIGHT (c) 2009 BRENOR BROPHY
**
** The source code included in this package is free software; you can
** redistribute it and/or modify it under the terms of the GNU General Public
** License as published by the Free Software Foundation. This license can be
** read at:
**
** http://www.opensource.org/licenses/gpl-license.php
**
** This program is distributed in the hope that it will be useful, but WITHOUT 
** ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS 
** FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details. 
**------------------------------------------------------------------------------
**
** Quick demo to show converting some European Lat/Long's to UTM
*/
//error_reporting ( E_ALL ); // For debug

require ('gPoint.php');

/*
** Lets use a simple database of locations
*/
    $place = array (
				"Waterford" => array (-7.113647,52.254485),
				"Dublin"	=> array (-6.262207,53.333279),
				"London"	=> array (-0.120850,51.497573),
				"Paris"		=> array ( 2.367554,48.838449),
				"Amsterdam"	=> array ( 4.883423,52.364643));

        $myLocation = new gPoint();        // Create an empty point
//
//  We start by setting the points Longitude & Latitude. 
//
	    foreach ($place as $name => $myCity)
		{
            $myLocation->setLongLat($myCity[0], $myCity[1]);      // Set the Lat/Long
            print ($name." located at ");
			$myLocation->printLatLong(); echo "<br>";
            $myLocation->convertLLtoTM(); // Convert to UTM
            echo "Which in a UTM projection is: "; $myLocation->printUTM(); echo "<br><br>";
		}
?>
