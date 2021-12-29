<?php

// funktio joka luo pudotusvalikon
function createMovieDropDown()
{
    // muodosta tietokantayhteys
    require_once('db.php'); // ota db.php tiedosto käyttöön tässä tiedostossa
    $conn = createDbConnection(); //kutsutaan db.php-tiedostossa olevaa createdbconnetion()-funktiota 
    //joka avaa tietokantayhteysen
    //muodosta sql lause muuttujaan. tässä vaiheessa tätä ei vielä ajeta kantaaan.
    $sql = "SELECT DISTINCT primary_title FROM titles limit 10;";
    //aja kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    //tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
   $html = '<select name="primary_title">';
    //looppaa tietokannasta saadut rivit läpi
    foreach($rows as $row) {
      //  tulosta jokaiselle riville li-elementti
        $html .= '<option>' . $row['primary_title'] . '</option>';
    }
    $html .= '</select>';
    return $html;
}