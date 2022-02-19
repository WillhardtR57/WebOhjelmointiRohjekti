<?php
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
require_once "config.php";
?>
<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

$json=isset($_POST["postaus"]) ? $_POST["postaus"] : "";

if (!($postaus=tarkistaJson($json))) {
    print "Täytä kaikki kentät";
    exit;
}
print "postia".$json;

try {
    $yhteys=mysqli_connect("db", "root", "password", "forumkanta");
    }
    catch(Exception $e){
        header("Location:../html/yhteysvirhe.html");
        exit;
    }

$sql="insert into postaus (otsikko, teksti) values(?, ?)";

$stmt=mysqli_prepare($yhteys, $sql);

mysqli_stmt_bind_param($stmt, 'ss', $postaus->otsikko, $postaus->teksti);

mysqli_stmt_execute($stmt);

$tulos=mysqli_query($yhteys, "select * from postaus left join users on users.username=postaus.id");

print "<table border='1'>";
while ($rivi=mysqli_fetch_object($tulos)) {
    print "<tr><td>"."<td>".$postaus->id=$rivi->id."<td>".$postaus->username=$rivi->username."<td>".$postaus->otsikko=$rivi->otsikko."<td>".$postaus->teksti=$rivi->teksti; 
}
print"</table>";

mysqli_close($yhteys);

?>

<?php
function tarkistaJson($json) {
    if (empty($json)) {
        return false;
    }
    $postaus=json_decode($json, false);
    if (empty($postaus->otsikko) || empty($postaus->teksti)) {
        return false;
    }
    return $postaus;
}

?>