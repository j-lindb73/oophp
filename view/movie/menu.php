<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>


<div class="movie-container">
    <div class="movie-menu">

        <a href="showall">Visa alla filmer</a>
        <a href="?route=reset">Återställ databas</a>
        <a href="search-title">Sök titel</a>
        <a href="search-year">Sök år</a>
        <a href="select">Välj film</a>
        <!-- <a href="?route=movie-edit">Edit</a> | -->
        <!-- <a href="?route=show-all-sort">Show all sortable</a> | -->
        <!-- <a href="?route=show-all-paginate">Show all paginate</a> | -->
    </div>