<?php
require('model/model.php');

function listEpisodes()
{
    $episodes = getEpisodes();
    require('view/listEpisodeView.php');   
}