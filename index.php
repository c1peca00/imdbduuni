<?php
//muodosta tietokantayhteys
//require_once('datasets/namebyprofession.php'); //ota .php tiedosto käyttöön tässä tiedostossa
//require_once('datasets/workersbymovie.php');
include('profession.php');
require_once('title.php');
// hakukriteerit
$html = "<h2>IMDB</h2>";
$html .= '<form action="GET">';
//profession-pudotusvalikko
$html .= createProfessionDropDown();
//movie-pudotusvalikko
$html .= createMovieDropDown();
// looppaa läpi tiedostot datasets-hakemistosta
$path = 'datasets';

if ($handle = opendir($path)) {

    while (false !== ($file = readdir($handle))) {

        if ('.' === $file) continue;
        if ('..' === $file) continue;

        $html .= '<div><input type="submit" value="' . 
        basename($file, ".php") . '" formaction="' . $path
         . "/" . $file . '"></div>';
    }
    closedir($handle);
}
$html .= '</form>';
//luo painike, joka lähettää lomakkeen käsiteltävänä olevalle tiedostolle.

echo $html;
