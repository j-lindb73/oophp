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
    <legend>Redigera</legend>
    <input type="hidden" name="movieId" value="<?= e($movie->id) ?>"/>

    <p>
        <label>Titel:<br> 
        <input type="text" name="movieTitle" value="<?= e($movie->title)?>"/>
        </label>
    </p>

    <p>
        <label>År:<br> 
        <input type="number" name="movieYear" value="<?= e($movie->year) ?>"/>
    </p>

    <p>
        <label>Bild:<br> 
        <input type="text" name="movieImage" value="<?= e($movie->image) ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Spara">
        <input type="reset" value="Återställ">
    </p>

    </fieldset>
</form>
