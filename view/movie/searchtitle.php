<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
// echo showEnvironment(get_defined_vars(), get_defined_functions());

?>


<form method="get">
    <fieldset>
    <legend>Sök titel</legend>
    <input type="hidden" name="route" value="search-title">
    <p>
        <label>Titel (använd % som wildcard):
            <input type="search" name="searchTitle" value="<?= e($searchTitle) ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Sök">
    </p>
    </fieldset>
</form>

