<?php

// This code demonstrates how to lookup the country by IP Address

include("geoip.inc");

$gi = geoip_open("GeoIP.dat",GEOIP_STANDARD);

echo geoip_country_code_by_addr($gi, $REMOTE_ADDR) . "\t" .
     geoip_country_name_by_addr($gi, $REMOTE_ADDR) . "\n";


geoip_close($gi);

?>
