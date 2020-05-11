<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<div class= "dice-container">
    <div class="dice-standings">
        <p>Din totala poäng:</p>
        <p class="dice-score"> <?= $playerScore ?></p>
        <p>Datorns totala poäng: </p>
        <p class="dice-score"> <?= $cpuScore ?></p>
    </div>