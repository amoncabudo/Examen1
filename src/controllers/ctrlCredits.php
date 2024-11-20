<?php

function ctrlCredits($request, $response, $container){
    $name = $request->get(INPUT_GET, "name");

    $response->set("name", $name);

    $response->setTemplate("credits.php");

    //print_r($_SESSION);
    return $response;
}
