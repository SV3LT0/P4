require('model/model.php')

function listEpisodes() 
{
    $episode = getEpisodes();
    require('view/listEpisodeView.php');   
}