<?php


// muodosta tietokantayhteys
require_once('../db.php'); // ota db.php tiedosto käyttöön tässä tiedostossa
//lue genre get-parametri muuttujaan
$primary_title = $_GET['primary_title'];
$conn = createDbConnection(); //kutsutaan db.php-tiedostossa olevaa createdbconnetion()-funktiota 
//joka avaa tietokantayhteyden
//muodosta sql lause muuttujaan. tässä vaiheessa tätä ei vielä ajeta kantaan.
//TOIMII MUTTA ON HIDAS: YRITÄ TEHDÄ VIEW...
$sql = "SELECT DISTINCT name_
from names_ INNER JOIN name_worked_as ON names_.name_id = name_worked_as.name_id 
INNER JOIN principals ON name_worked_as.name_id = principals.name_id
INNER JOIN titles ON principals.title_id = titles.title_id
WHERE primary_title LIKE '%" . $primary_title . "%'
LIMIT 10;";
//tarkista yhteydet yms
//aja kysely kantaan
$prepare = $conn->prepare($sql);
//bindaa arvot parametrit
////$prepare->bindParam(':genre', $genre, PDO::PARAM_STR);
$prepare->execute();
//tallenna vastaus muuttujaan
$rows = $prepare->fetchAll();
/////var_dump($rows);
//tulosta
$html = '<h1>' . $primary_title . '</h1>';

$html .= '<ul>';
//looppaa tietokannasta saadut rivit läpi
foreach($rows as $row) {
    $html .= '<li>' . $row['name_'] . 
    '</li>' ;
}
$html .= '</ul>';
echo $html;