<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<!-- <header> -->
    <h1>Gissa ett nummer...</h1>
<!-- </header> -->
    <h3>...mellan 1-100...</h3>
<form method="post">
    <input type="text" name="guess">
    <p>
    <input id="submit" type="submit" name="doGuess" value="Gissa">
    <input id="submit" type="submit" name="doInit" value="Omstart">
    <input id="submit" type="submit" name="doCheat" value="FUSK">
    </p>
</form>

<?php if ($message) : ?>
    <p class="result"><?= $message ?></p>
<?php endif; ?>


<?php if ($doCheat) : ?>
    <p>FUSK Aktuellt nummer är <?= $number ?>. </p>
<?php endif; ?>
