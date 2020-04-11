<?php


require __DIR__ . "/autoload.php";
require __DIR__ . "/config.php";
require __DIR__ . "/session.php";

// Take care of incoming variables
$doInit = $_SESSION["doInit"] ?? null;
$doGuess = $_SESSION["doGuess"] ?? null;
$guess = $_SESSION["guess"] ?? null;
$number = $_SESSION["number"] ?? null;
$tries = $_SESSION["tries"] ?? null;
$message = $_SESSION["message"] ?? null;
$doCheat = $_SESSION["doCheat"] ?? null;

// Initiate game
if ($number === null) {
    header("Location: guess_process.php");
}

include("view/guess.php");
include("view/footer.php");
