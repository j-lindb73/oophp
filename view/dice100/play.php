<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<!-- <header> -->
    <h1>Tärning 100</h1>
<!-- </header> -->
    <h3>...mellan 1-100...</h3>
<p>Din poäng: <?php $playerScore ?></p>
<p>Datorns poäng: <?php $cpuScore ?></p>


<a href="init">Starta ett nytt spel!</a>
