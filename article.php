<?php

sleep(1);

$articles = [];

for($i = 0;$i<4; $i++){
    $article = array(
        "name" => "Thumbnail label",
        "text" => "Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.",
        "img" => "holder.js/242x200"
    );

    array_push($articles,$article);
}


echo json_encode($articles);