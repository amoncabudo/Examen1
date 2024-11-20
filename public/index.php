<?php

/**
 * Aquest fitxer és un exemple de Front Controller, pel qual passen totes les requests.
 */

include "../src/config.php";
include "../src/controllers/ctrlIndex.php";
include "../src/controllers/ctrlJson.php";
include "../src/controllers/ctrlformsong.php";
include "../src/controllers/ctrladdsong.php";
include "../src/controllers/ctrlsongslist.php";
include "../src/controllers/ctrleditformsong.php";
include "../src/controllers/ctrlupdatesong.php";
include "../src/controllers/ctrlDeleteSong.php";
include "../src/controllers/ctrlCredits.php";

/**
 * Carreguem les classes del Framework Emeset
 */

include "../src/Emeset/Container.php";
include "../src/ProjectContainer.php";
include "../src/Emeset/Request.php";
include "../src/Emeset/Response.php";
include "../src/models/Db.php";
include "../src/models/Songs.php";

$request = new \Emeset\Request();
$response = new \Emeset\Response();
$container = new ProjectContainer($config);

/* 
  * Aquesta és la part que fa que funcioni el Front Controller.
  * Si no hi ha cap paràmetre, carreguem la pàgina d'inici.
  * Si hi ha paràmetre, carreguem la pàgina que correspongui.
  * Si no existeix la pàgina, carreguem la pàgina d'error.
  */
$r = '';
if (isset($_REQUEST["r"])) {
  $r = $_REQUEST["r"];
}

/* Front Controller, aquí es decideix quina acció s'executa */
if ($r == "") {
  $response = ctrlIndex($request, $response, $container);
} elseif($r == "updatesong"){
  $response = ctrlupdatesong($request, $response, $container);
}elseif($r == "editsong"){
  $response = ctrleditformsong($request, $response, $container);
}elseif($r == "songs"){
  $response = ctrlsongslist($request, $response, $container);
}elseif($r == "addsong"){
  $response = ctrladdsong($request, $response, $container);
} elseif ($r == "formsongs") {
  $response = ctrlformsong($request, $response, $container);
} elseif ($r == "json") {
  $response = ctrlJson($request, $response, $container);
} elseif ($r == "deletesong") {
  $response = ctrlDeleteSong($request, $response, $container);
} elseif ($r == "credits") {
  $response = ctrlCredits($request, $response, $container);
} else {
  echo "No existeix la ruta";
}

/* Enviem la resposta al client. */
$response->response();
