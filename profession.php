<?php


//funktio joka luo pudotusvalikon
function createProfessionDropDown()
{
   
    require_once('db.php'); // ota db.php tiedosto käyttöön tässä tiedostossa
    $conn = createDbConnection(); //kutsutaan db.php-tiedostossa olevaa createdbconnetion()-funktiota 
    //joka avaa tietokantayhteysen
    //muodosta sql lause muuttujaan. tässä vaiheessa tätä ei vielä ajeta kantaaan.
     $sql = "SELECT DISTINCT profession FROM name_worked_as limit 10;";
    //aja kysely kantaan
    $prepare = $conn->prepare($sql);
    $prepare->execute();
    //tallenna vastaus muuttujaan
    $rows = $prepare->fetchAll();
    $html = '<select name="profession">';
    //looppaa tietokannasta saadut rivit läpi
   foreach ($rows as $row) {
        //tulosta jokaiselle riville li-elementti
       $html .= '<option>' . $row['profession'] . '</option>';
    }
    $html .= '</select>';
   return $html;
}

 ////muodostetaan SQL-lause
    //ajetaan SQL-lause kantaan
    //avataan select-elementti
    //Loopataan läpi vastauksena saadut rivit
    //luodaan jokaiselle riville option-elementti
    //suljetaan select-elementti
    //palautetaan luotu html kutsujalle
    // muodosta tietokantayhteys
