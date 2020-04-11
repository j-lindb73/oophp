<?php
require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";
require __DIR__ . "/session.php";

// $_SESSION["number"] = $_GET["number"];
// $_SESSION["tries"] = isset($_GET["tries"]) ? $_GET["tries"] : null ;
$_SESSION["guess"] = isset($_POST["guess"]) ? $_POST["guess"] : null ;
$doInit = $_POST["doInit"] ?? null;
$_SESSION["doGuess"] = $_POST["doGuess"]  ?? null;
$_SESSION["doCheat"] = $_POST["doCheat"]  ?? null;

if ($doInit || $_SESSION["number"] === null) {
    $objGame = new Guess();
    $_SESSION["number"] = $objGame->number();
    $_SESSION["tries"] = $objGame->tries();
    $_SESSION["message"] = "Please make a guess";
    // header("Location: index.php");
}
if ($_SESSION["doGuess"]) {
    // $_SESSION["doInit"] = null;
    $objGame = new Guess($_SESSION["number"], $_SESSION["tries"]);
    // $_SESSION["objGuess"] = $objGame;
    $_SESSION["message"] = $objGame->makeGuess($_SESSION["guess"]);
    $_SESSION["tries"] = $objGame->tries();
}

header("Location: index.php");
