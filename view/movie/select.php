<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<form method="post">
    <fieldset>
    <legend>Välj film</legend>

    <p>
        <label>Film:<br>
        <select name="movieId">
            <option value="">Välj film...</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Lägg till">
        <input type="submit" name="doEdit" value="Redigera">
        <input type="submit" name="doDelete" value="Ta bort">
    </p>
    </fieldset>
</form>
