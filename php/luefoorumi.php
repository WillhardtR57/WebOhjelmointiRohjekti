<?php 
include "../html/header.html";
?>

<?php

try {
    $yhteys=mysqli_connect("db", "root", "password", "foorumi");
    }
    catch(Exception $e){
        header("Location:../html/yhteysvirhe.html");
        exit;
    }

$tulos=mysqli_query($yhteys, "select * from foorumipost");

print "<ol>";
while ($rivi=mysqli_fetch_object($tulos)) {
    print "<li>$rivi-> id $rivi->otsikko $rivi->teksti"; 
}
print"</ol>";

mysqli_close($yhteys);

?>
