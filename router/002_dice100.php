<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game
 */
$app->router->get("dice100/init", function () use ($app) {
    // init the sesson for the gamestart";
    $title = "Spela spelet";

    return $app->response->redirect("dice100/play");
});


/**
 * Play the game
 */
$app->router->get("dice100/play", function () use ($app) {
    $title = "Spela spelet";

    $game = new Lefty\Dice100\Game();
    $playerScore = $game->player();
    $cpuScore = "";


    $data = [
        "playerScore" => $playerScore,
        "cpuScore" => $cpuScore,
    ];

    $app->page->add("dice100/play", $data);
    $app->page->add("dice100/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
