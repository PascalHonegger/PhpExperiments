<?php

//    gibt true aus, wenn mail-adresse formal richtig ist
function teste_email($test) {
    return (ereg("^[a-z0-9]+([\._a-z0-9-]+)*@([a-z0-9]+([a-z0-9\.-]+)*\.)+([a-z]{2,4}|museum)$",strtolower(trim($test))));
}

//    gibt true aus, wenn plz vier oder fuenfstellige zahl ist
function teste_plz($test) {
    return (ereg("^[1-9]([0-9]{3,4})$",trim($test)));    
}

/**
* testet telefonnummern mit oder ohne internat. vorwahl, mit schweiz. vorwahl, 
* inkl. unterschiedlichste trennzeichen und mit oder ohne durchwahl
* gibt true aus, falls formal korrekt 
*/
function teste_tel($test) {
    return (ereg("^(((00|\+\+)([1-9][0-9]?)[^a-zA-Z0-9]*(\(0\))?[^a-zA-Z0-9]*[1-9]+)|(0[1-9]+))[^a-zA-Z0-9]+[1-9](([0-9]+[^a-zA-Z0-9]*)+)(-([0-9]{1,8}))?$",trim($test)));
}            

?>