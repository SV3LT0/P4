<?php
function getEpisodes()
{
    $db = dbConnect();
    $req = $db ->query('SELECT id, titre, contenu, DATE_FORMAT(creation_date, "%d/%m/%Y")AS creation_date_fr FROM episode ORDER BY creation_date ');

    return $req;
}

function dbConnect()
{
    $db = new PDO('mysql:host=localhost;dbname=p4;charset=utf8', 'root', '');
    return $db;
}

