<?php
function getEpisodes()
{
    $db = dbConnect();
    $req = $db ->query('SELECT id, titre, auteur, contenu, FROM episode ORDER BY creation_date ');
}

function dbConnect()
{
    $db = new PDO ('mysql:host=localhost;dbname=p4;charset=utf8','root', '');
    return $db;
}

