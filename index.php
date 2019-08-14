<?php
require('controller/frontend.php');

try {
    if(isset($_GET['action'])){
        if($_GET['action'] == 'listEpisodes'){
            listEpisodes();
        }
        elseif($_GET['action'] == 'episode'){
            if(isset($_GET['id']) && $_GET['id']>0){
                episode();
            }
        }
    }
}

listEpisodes();