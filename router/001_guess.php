<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game
 */
$app->router->get("guess/init", function () use ($app) {
    // init the sesison for the gamestart";
    $title = "Spela spelet";
    $objGame = new Lefty\Guess\Guess();
    $_SESSION["number"] = $objGame->number();
    $_SESSION["tries"] = $objGame->tries();
    $_SESSION["message"] = "Gissa gärna på en siffra...";
    $_SESSION["doCheat"] = null;
    return $app->response->redirect("guess/play");
});



/**
 * Play the game
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Spela spelet";
    // Take care of session variables
    $number = $_SESSION["number"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;
    $message = $_SESSION["message"] ?? null;

    // reset session-variables
    $_SESSION["message"] = null;
    $_SESSION["guess"] = null;

    $data = [
        "message" => $message,
        "number" => $number,
        "doCheat" => $doCheat,
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game
 */
$app->router->post("guess/play", function () use ($app) {

    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $guess = $_POST["guess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $message = $_SESSION["message"] ?? null;

    if ($doGuess) {
        $objGame = new Lefty\Guess\Guess($number, $tries);
        $_SESSION["message"] = $objGame->makeGuess($guess);
        $_SESSION["tries"] = $objGame->tries();
    }

    if ($doInit) {
        return $app->response->redirect("guess/init");
    }

    if ($doCheat) {
        $_SESSION["doCheat"] = $doCheat;
    }

    return $app->response->redirect("guess/play");
});
