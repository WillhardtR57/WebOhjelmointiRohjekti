<?php 
include "../html/header.html";
?>

<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$otsikko=isset($_POST["otsikko"]) ? $_POST["otsikko"] : "";
$teksti=isset($_POST["teksti"]) ? $_POST["teksti"] : "";

if (empty($otsikko) || empty($teksti)) {
    header("Location:../html/forum.html");
    exit;
}

try {
    $yhteys=mysqli_connect("db", "root", "password", "foorumi");
    }
    catch(Exception $e){
        header("Location:../html/yhteysvirhe.html");
        exit;
    }

$sql="insert into foorumipost (id, otsikko, teksti) values(?, ?, ?)";

$stmt=mysqli_prepare($yhteys, $sql);

mysqli_stmt_bind_param($stmt, 'ss', $otsikko, $teksti);

mysqli_stmt_execute($stmt);

mysqli_close($yhteys);

header("Location:./luefoorumi.php");

?>