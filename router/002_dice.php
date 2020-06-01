<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game
 */
$app->router->get("dice/init", function () use ($app) {
    // init the sesson for the gamestart";
    $title = "Spela spelet";
    $game = new Lefty\Dice\Game(2);

    $_SESSION["game"] = $game;

    return $app->response->redirect("dice/play");
});


/**
 * Play the game
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Spela spelet";

    $game = $_SESSION["game"];
    $badThrow = $game->badThrow();
    $currentPlayer = $game->getCurrentPlayer();

    $playerScore = $game->player->getScore();
    $cpuScore = $game->cpu->getScore() ;

    $rollScore = $currentPlayer->getPlayerHand()->getSum();
    $roundScore = $game->getCurrentRound()->getRoundScore();
    $isComputer = $currentPlayer->isComputer();
    
    $scoreToWin = $game->scoreToWin();
    $computerChoice = ($isComputer == true) ? $computerChoice = $currentPlayer->makePlay($roundScore, $rollScore, $scoreToWin) : null;
    $histogram = $game->getHistogram();



    // print_r($computerChoice);
    $data = [
        "playerScore" => $playerScore,
        "cpuScore" => $cpuScore,
        "roundScore" => $roundScore,
        "rollScore" => $rollScore,
        "isComputer" => $isComputer,
        "computerChoice" => $computerChoice,
        "badThrow" => $badThrow,
        "currentPlayer" => $currentPlayer,
        "histogram" => $histogram
    ];


    // $game->getCurrentPlayer()->clearPlayerHand();
    $app->page->add("dice/standing", $data);
    $app->page->add("dice/play", $data);
    $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Route to roll dices and continue play
 */
$app->router->get("dice/roll", function () use ($app) {
    $game = $_SESSION["game"] ?? null;
    $game->roll();
    return $app->response->redirect("dice/play");
});

/**
 * Route to save round score, check if someone won and
 * route accordingly
 */
$app->router->get("dice/save", function () use ($app) {
    $game = $_SESSION["game"] ?? null;
    $game->save();
    if ($game->checkWinner()==true) {
        return $app->response->redirect("dice/winner");
    } else {
        return $app->response->redirect("dice/newround");
    }
});

/**
 * Continue to next player
 */
$app->router->get("dice/newround", function () use ($app) {
    $game = $_SESSION["game"] ?? null;
    $game->goToNextRound();
    return $app->response->redirect("dice/roll");
});


/**
 * Route to present final standings and winner
 */
$app->router->get("dice/winner", function () use ($app) {
    $title = "Spela spelet";
    $game = $_SESSION["game"] ?? null;

    $playerScore = $game->player->getScore();
    $cpuScore = $game->cpu->getScore();
    $winner = $game->getWinner()->getName();
    $histogram = $game->getHistogram();

    $data = [
        "playerScore" => $playerScore,
        "cpuScore" => $cpuScore,
        "winner" => $winner,
        "histogram" => $histogram
    ];


    $app->page->add("dice/standing", $data);
    $app->page->add("dice/winner", $data);
    // $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
