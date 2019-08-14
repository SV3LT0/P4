<?php
require('model/model.php');

function listEpisodes()
{
    $episodes = getEpisodes();
    require('view/listEpisodeView.php');   
}

function post()
{
    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require('view/postView.php');
}