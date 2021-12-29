<?php


// muodosta tietokantayhteys
require_once('../db.php'); // ota db.php tiedosto käyttöön tässä tiedostossa
//lue region get-parametri muuttujaan
$profession = $_GET['profession'];
$conn = createDbConnection(); //kutsutaan db.php-tiedostossa olevaa createdbconnetion()-funktiota 
//joka avaa tietokantayhteysen
//muodosta sql lause muuttujaan. tässä vaiheessa tätä ei vielä ajeta kantaaan.
$sql = "SELECT DISTINCT `name_`
from `names_` INNER JOIN name_worked_as ON names_.name_id = name_worked_as.name_id
WHERE profession LIKE '%" . $profession . "%'
limit 10;";
//aja kysely kantaan
$prepare = $conn->prepare($sql);
//bindaa arvot parametrit
//$prepare->bindParam(':profession', $profession, PDO::PARAM_STR);
$prepare->execute();
//tallenna vastaus muuttujaan
$rows = $prepare->fetchAll();
/////var_dump($rows);
//tulosta
$html = '<h1>' . $profession . '</h1>';

$html .= '<ul>';
//looppaa tietokannasta saadut rivit läpi
foreach($rows as $row) {
    $html .= '<li>' . $row['name_'] . 
   '</li>' ;
}
$html .= '</ul>';
echo $html;